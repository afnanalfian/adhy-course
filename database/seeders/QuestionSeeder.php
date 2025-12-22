<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\QuestionCategory;
use App\Models\QuestionMaterial;
use App\Models\Question;
use App\Models\QuestionOption;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Matematika',
            'Logika'
        ];

        foreach ($categories as $categoryName) {

            $category = QuestionCategory::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'description' => "Kategori soal $categoryName",
            ]);

            // 2 materi per kategori
            for ($m = 1; $m <= 2; $m++) {

                $material = QuestionMaterial::create([
                    'category_id' => $category->id,
                    'name'        => "Materi $m $categoryName",
                    'slug'        => Str::slug($categoryName . '-materi-' . $m)
                ]);

                /**
                 * 3 soal per materi
                 * type: mcq, mcma, truefalse
                 */
                $types = ['mcq', 'mcma', 'truefalse'];

                foreach ($types as $index => $type) {
                    $question = Question::create([
                        'material_id'  => $material->id,
                        'type'         => $type,
                        'question_text'=> "Contoh soal $type untuk {$material->name}",
                        'explanation'  => 'Ini adalah pembahasan singkat.',
                    ]);

                    if ($type === 'truefalse') {
                        QuestionOption::insert([
                            [
                                'question_id' => $question->id,
                                'option_text'=> 'Benar',
                                'is_correct' => true,
                                'order'      => 1,
                            ],
                            [
                                'question_id' => $question->id,
                                'option_text'=> 'Salah',
                                'is_correct' => false,
                                'order'      => 2,
                            ],
                        ]);
                    } else {
                        // MCQ / MCMA (4 opsi)
                        for ($o = 1; $o <= 4; $o++) {
                            QuestionOption::create([
                                'question_id' => $question->id,
                                'option_text'=> "Opsi $o",
                                'is_correct' => $o === 1, // opsi 1 benar
                                'order'      => $o,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
