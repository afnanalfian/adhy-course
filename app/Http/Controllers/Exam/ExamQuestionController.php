<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Http\Request;

class ExamQuestionController extends Controller
{
    public function byMaterial(Exam $exam, $materialId, Request $request)
    {
        $exam->load('questions');
        $material = QuestionMaterial::withTrashed()->findOrFail($materialId);
        // Pastikan materi milik kategori yang valid
        if (
            $request->category_id &&
            $material->category_id != $request->category_id
        ) {
            abort(403, 'Materi tidak sesuai kategori');
        }

        $query = Question::where('material_id', $material->id);

        // Filter type (whitelist)
        if ($request->filled('type')) {
            abort_unless(
                in_array($request->type, ['mcq', 'mcma', 'truefalse','short_answer', 'compound']),
                403
            );

            $query->where('type', $request->type);
        }

        return $query
            ->whereNotIn('id', $exam->questions()->pluck('question_id'))
            ->with(['options', 'subItems.answers'])
            ->paginate(10);
    }

    public function attach(Request $request, Exam $exam)
    {
        $data = $request->validate([
            'question_ids' => 'required|array',
            'question_ids.*' => 'exists:questions,id',
        ]);

        foreach ($data['question_ids'] as $qid) {
            $exam->questions()->firstOrCreate([
                'question_id' => $qid,
            ]);
        }

        return redirect()->route('exams.edit', $exam);
    }

    public function detach(Request $request, Exam $exam)
    {
        $data = $request->validate([
            'question_id' => 'required|exists:questions,id',
        ]);

        $exam->questions()
            ->where('question_id', $data['question_id'])
            ->delete();

        return redirect()->route('exams.edit', $exam);
    }
}
