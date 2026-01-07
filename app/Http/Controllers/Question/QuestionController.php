<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\{
    Question,
    QuestionOption,
    QuestionMaterial,
    QuestionSubItem,
    QuestionSubAnswer
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index(Request $request, QuestionMaterial $material)
    {
        $questions = Question::with(['options', 'subItems.answers'])
            ->where('material_id', $material->id)
            ->when($request->filled('type'), fn ($q) =>
                $q->where('type', $request->type)
            )
            ->when($request->filled('q'), fn ($q) =>
                $q->where('question_text', 'like', "%{$request->q}%")
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('bank.questions.index', compact('material', 'questions'));
    }

    public function create(QuestionMaterial $material)
    {
        return view('bank.questions.create', compact('material'));
    }

    public function store(Request $request, QuestionMaterial $material)
    {
        $this->validateRequest($request);

        DB::transaction(function () use ($request, $material) {

            $image = $request->file('question_image')
                ? $request->file('question_image')->store('questions', 'public')
                : null;

            $question = Question::create([
                'material_id'   => $material->id,
                'type'          => $request->type,
                'question_text' => $request->question_text,
                'image'         => $image,
                'explanation'   => $request->explanation,
            ]);

            $this->storeQuestionOptions($question, $request);
        });

        toast('success', 'Soal berhasil ditambahkan');
        return redirect()->route('bank.material.questions.index', $material);
    }

    public function edit(Question $question)
    {
        $question->load(['options', 'subItems.answers']);
        return view('bank.questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $this->validateRequest($request);

        DB::transaction(function () use ($request, $question) {

            if ($request->hasFile('question_image')) {
                if ($question->image) {
                    Storage::disk('public')->delete($question->image);
                }

                $question->image = $request->file('question_image')
                    ->store('questions', 'public');
            }

            $question->update([
                'type'          => $request->type,
                'question_text' => $request->question_text,
                'explanation'   => $request->explanation,
            ]);

            $this->updateQuestionOptions($question, $request);
        });

        toast('success', 'Soal diperbarui');
        return redirect()->route('bank.material.questions.index', $question->material);
    }

    public function destroy(Question $question)
    {
        DB::transaction(function () use ($question) {
            if ($question->image) {
                Storage::disk('public')->delete($question->image);
            }

            $question->subItems()->each(function ($sub) {
                $sub->answers()->delete();
            });

            $question->options()->delete();
            $question->subItems()->delete();
            $question->delete();
        });

        toast('warning', 'Soal dihapus');
        return back();
    }

    /* =========================================================
     | VALIDATION
     ========================================================= */
    private function validateRequest(Request $request): void
    {
        $request->validate([
            'type'           => 'required|in:mcq,mcma,truefalse,short_answer,compound',
            'question_text'  => 'required',
            'explanation'    => 'nullable',
            'question_image' => 'nullable|image|max:2048',
        ]);
    }
    /* =========================================================
     | STORE OPTIONS
     ========================================================= */
    private function storeQuestionOptions(Question $question, Request $request): void
    {
        match ($request->type) {
            'mcq', 'mcma'      => $this->storeMcq($question, $request),
            'truefalse'       => $this->storeTrueFalse($question, $request),
            'short_answer'    => $this->storeShortAnswer($question, $request),
            'compound'        => $this->storeCompound($question, $request),
            default           => null
        };
    }
    /* =========================================================
     | UPDATE OPTIONS
     ========================================================= */
    private function updateQuestionOptions(Question $question, Request $request): void
    {
        match ($request->type) {
            'mcq', 'mcma'      => $this->updateMcq($question, $request),
            'truefalse'       => $this->updateTrueFalse($question, $request),
            'short_answer'    => $this->updateShortAnswer($question, $request),
            'compound'        => $this->updateCompound($question, $request),
            default           => null
        };
    }
    /* =========================================================
     | MCQ / MCMA
     ========================================================= */
    private function storeMcq(Question $question, Request $request): void
    {
        $correct = $request->type === 'mcq'
            ? [(int) $request->correct]
            : ($request->correct ?? []);

        foreach ($request->options as $i => $opt) {
            if (empty($opt['text'])) continue;

            QuestionOption::create([
                'question_id' => $question->id,
                'option_text' => $opt['text'],
                'is_correct'  => in_array($i, $correct),
                'order'       => $i + 1,
            ]);
        }
    }

    private function updateMcq(Question $question, Request $request): void
    {
        $correct = $request->type === 'mcq'
            ? [(int) $request->correct]
            : ($request->correct ?? []);

        $sentIds = [];

        foreach ($request->options as $i => $opt) {
            if (empty($opt['text'])) continue;

            $option = QuestionOption::updateOrCreate(
                [
                    'id' => $opt['id'] ?? null,
                    'question_id' => $question->id,
                ],
                [
                    'option_text' => $opt['text'],
                    'is_correct'  => in_array($i, $correct),
                    'order'       => $i + 1,
                ]
            );

            $sentIds[] = $option->id;
        }

        $question->options()
            ->whereNotIn('id', $sentIds)
            ->delete();
    }

    /* =========================================================
     | TRUE / FALSE
     ========================================================= */
    private function storeTrueFalse(Question $question, Request $request): void
    {
        QuestionOption::insert([
            [
                'question_id' => $question->id,
                'option_text' => 'Benar',
                'is_correct'  => ($request->truefalse_correct ?? 1) == 1,
                'order'       => 1,
            ],
            [
                'question_id' => $question->id,
                'option_text' => 'Salah',
                'is_correct'  => ($request->truefalse_correct ?? 1) == 0,
                'order'       => 2,
            ],
        ]);
    }

    private function updateTrueFalse(Question $question, Request $request): void
    {
        $question->options()->update(['is_correct' => false]);

        $correctOrder = ($request->truefalse_correct ?? 1) == 1 ? 1 : 2;

        $question->options()
            ->where('order', $correctOrder)
            ->update(['is_correct' => true]);
    }

    /* =========================================================
     | SHORT ANSWER
     ========================================================= */
    private function storeShortAnswer(Question $question, Request $request): void
    {
        foreach ($request->short_answers as $i => $ans) {
            if (empty($ans['text'])) continue;

            QuestionOption::create([
                'question_id' => $question->id,
                'option_text' => $ans['text'],
                'is_correct'  => true,
                'order'       => $i + 1,
            ]);
        }
    }

    private function updateShortAnswer(Question $question, Request $request): void
    {
        $sentIds = [];

        foreach ($request->short_answers as $i => $ans) {
            if (empty($ans['text'])) continue;

            $opt = QuestionOption::updateOrCreate(
                [
                    'id' => $ans['id'] ?? null,
                    'question_id' => $question->id,
                ],
                [
                    'option_text' => $ans['text'],
                    'is_correct'  => true,
                    'order'       => $i + 1,
                ]
            );

            $sentIds[] = $opt->id;
        }

        $question->options()
            ->whereNotIn('id', $sentIds)
            ->delete();
    }

    /* =========================================================
     | COMPOUND
     ========================================================= */
    private function storeCompound(Question $question, Request $request): void
    {
        foreach ($request->sub_items as $i => $item) {
            if (empty($item['prompt'])) continue;

            $sub = QuestionSubItem::create([
                'question_id' => $question->id,
                'label'       => $item['label'] ?? chr(65 + $i),
                'type'        => $item['type'],
                'prompt'      => $item['prompt'],
                'order'       => $i + 1,
            ]);

            $this->storeSubAnswers($sub, $item);
        }
    }

    private function updateCompound(Question $question, Request $request): void
    {
        $sentSubIds = [];

        foreach ($request->sub_items as $i => $item) {
            if (empty($item['prompt'])) continue;

            $sub = QuestionSubItem::updateOrCreate(
                ['id' => $item['id'] ?? null],
                [
                    'question_id' => $question->id,
                    'label'       => $item['label'] ?? chr(65 + $i),
                    'type'        => $item['type'],
                    'prompt'      => $item['prompt'],
                    'order'       => $i + 1,
                ]
            );

            $sentSubIds[] = $sub->id;

            $this->updateSubAnswers($sub, $item);
        }

        $question->subItems()
            ->whereNotIn('id', $sentSubIds)
            ->each(fn ($sub) => $sub->answers()->delete());

        $question->subItems()
            ->whereNotIn('id', $sentSubIds)
            ->delete();
    }

    /* =========================================================
     | SUB ANSWERS
     ========================================================= */
    private function storeSubAnswers(QuestionSubItem $sub, array $item): void
    {
        if ($item['type'] === 'truefalse') {
            QuestionSubAnswer::create([
                'sub_item_id'    => $sub->id,
                'type'           => 'truefalse',
                'boolean_answer' => (bool) ($item['boolean_answer'] ?? false),
                'is_primary'     => true,
            ]);
        }

        if ($item['type'] === 'short_answer') {
            $primary = $item['primary_index'] ?? 0;

            foreach ($item['answers'] as $i => $ans) {
                if (empty($ans['text'])) continue;

                QuestionSubAnswer::create([
                    'sub_item_id' => $sub->id,
                    'type'        => 'short_answer',
                    'answer_text' => $ans['text'],
                    'is_primary'  => $i == $primary,
                ]);
            }
        }
    }

    private function updateSubAnswers(QuestionSubItem $sub, array $item): void
    {
        $sentIds = [];

        if ($item['type'] === 'truefalse') {
            $ans = QuestionSubAnswer::updateOrCreate(
                ['sub_item_id' => $sub->id],
                [
                    'type'           => 'truefalse',
                    'boolean_answer' => (bool) ($item['boolean_answer'] ?? false),
                    'is_primary'     => true,
                ]
            );

            $sentIds[] = $ans->id;
        }

        if ($item['type'] === 'short_answer') {
            $primary = $item['primary_index'] ?? 0;

            foreach ($item['answers'] as $i => $ans) {
                if (empty($ans['text'])) continue;

                $a = QuestionSubAnswer::updateOrCreate(
                    ['id' => $ans['id'] ?? null],
                    [
                        'sub_item_id' => $sub->id,
                        'type'        => 'short_answer',
                        'answer_text' => $ans['text'],
                        'is_primary'  => $i == $primary,
                    ]
                );

                $sentIds[] = $a->id;
            }
        }

        $sub->answers()
            ->whereNotIn('id', $sentIds)
            ->delete();
    }
}
