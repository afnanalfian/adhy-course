<?php

namespace Database\Seeders;

use App\Models\QuestionCategory;
use App\Models\QuestionMaterial;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatistikaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data untuk kategori 1 (Blind Test) - soal 1-10
        $materialBT = QuestionMaterial::create([
            'category_id' => 1,
            'name' => 'BT - Statistika 3',
            'slug' => 'bt-statistika-3',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Soal 1-10 untuk Blind Test
        $questionsBT = [
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Diagram lingkaran berikut menggambarkan banyak siswa yang mengikuti olah raga. Jika banyak siswa ada 400 siswa, maka banyak siswa yang mengikuti dance adalah … siswa',
                'explanation' => '<p>Total persentase semua olahraga = 100%</p>
                <p>Dance = 100% – (20% + 10% + 5% + 30%) = 35%</p>
                <p>Banyak siswa dance = \begin{aligned} \frac{35}{100} \times 400 = 140 \text{ siswa} \end{aligned}</p>',
                'options' => [
                    ['option_text' => '40', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '80', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '120', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '140', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '160', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Diagram di atas adalah hasil jejak pendapat mengenai diberlakukannya suatu peraturan daerah. Jika responden yang mengatakan setuju sebanyak 30 orang, maka responden yang "sangat tidak setuju" sebanyak ….',
                'explanation' => '<p>Dari diagram: Setuju = 108° dari 360°</p>
                <p>108° mewakili 30 orang</p>
                <p>Sangat tidak setuju = 360° – (44° + 108° + 142° + 30°) = 36°</p>
                <p>Banyak responden sangat tidak setuju = \begin{aligned} \frac{36}{108} \times 30 = 10 \text{ orang} \end{aligned}</p>',
                'options' => [
                    ['option_text' => '5 orang', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '30 orang', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '10 orang', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '40 orang', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '15 orang', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Data di bawah adalah data peserta ekstrakurikuler kelas XI suatu SMA. Jika jumlah seluruh siswa kelas XI adalah 125 siswa, maka persentase jumlah peserta ekstrakurikuler olah raga adalah .....',
                'explanation' => '<p>Jumlah peserta olahraga = Total siswa – (Peserta lain)</p>
                <p>= 125 – (24 + 20 + 17 + 19) = 125 – 80 = 45 siswa</p>
                <p>Persentase olahraga = \begin{aligned} \frac{45}{125} \times 100\% = 36\% \end{aligned}</p>',
                'options' => [
                    ['option_text' => '20%', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '25%', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '36%', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '45%', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '50%', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Rata-rata nilai ulangan Matematika dari 40 orang siswa adalah 5,1. Jika seorang siswa tidak disertakan dalam perhitungan maka nilai rata-ratanya menjadi 5,0. Nilai siswa tersebut adalah …',
                'explanation' => '<p>Jumlah nilai 40 siswa = \begin{aligned} 40 \times 5,1 = 204 \end{aligned}</p>
                <p>Jumlah nilai 39 siswa = \begin{aligned} 39 \times 5,0 = 195 \end{aligned}</p>
                <p>Nilai siswa tersebut = \begin{aligned} 204 - 195 = 9,0 \end{aligned}</p>',
                'options' => [
                    ['option_text' => '9,0', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '8,0', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '7,5', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '6,0', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '5,5', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Rata-rata 4 buah data adalah 5. Jika data ditambah satu lagi maka rata-rata menjadi 5, maka besarnya data penambah',
                'explanation' => '<p>Sepertinya ada kekurangan informasi pada soal. Jika rata-rata tetap 5 setelah ditambah satu data, maka data penambah harus sama dengan rata-rata yang ada.</p>
                <p>Jumlah 4 data = \begin{aligned} 4 \times 5 = 20 \end{aligned}</p>
                <p>Jumlah 5 data = \begin{aligned} 5 \times 5 = 25 \end{aligned}</p>
                <p>Data penambah = \begin{aligned} 25 - 20 = 5 \end{aligned}</p>',
                'options' => [
                    ['option_text' => '7', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '6', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '5', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '4', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '3', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Perhatikan data tabel berikut!</p>
                <table border="1" style="border-collapse: collapse; margin: 10px 0;">
                <tr><th>Nilai</th><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td></tr>
                <tr><th>Frekuensi</th><td>3</td><td>7</td><td>12</td><td>11</td><td>7</td></tr>
                </table>
                <p>Nilai rataan pada tabel di atas adalah ...',
                'explanation' => '<p>Jumlah semua nilai = \begin{aligned} (4 \times 3) + (5 \times 7) + (6 \times 12) + (7 \times 11) + (8 \times 7) \end{aligned}</p>
                <p>= \begin{aligned} 12 + 35 + 72 + 77 + 56 = 252 \end{aligned}</p>
                <p>Total frekuensi = \begin{aligned} 3 + 7 + 12 + 11 + 7 = 40 \end{aligned}</p>
                <p>Rata-rata = \begin{aligned} \frac{252}{40} = 6,3 \end{aligned}</p>',
                'options' => [
                    ['option_text' => '5,08', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '5,8', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '6,03', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '6,05', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '6,3', 'is_correct' => true, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Tim Bola Basket terdiri dari 5 siswa memiliki rata-rata berat badan 45 kg. Selisih berat badan terbesar dan terkecil 15 kg. Ada satu orang terberat dan lainnya sama beratnya. Berat badan siswa yang terbesar adalah...',
                'explanation' => '<p>Misalkan berat 4 siswa sama = x kg</p>
                <p>Berat siswa terbesar = x + 15 kg</p>
                <p>Rata-rata = \begin{aligned} \frac{4x + (x + 15)}{5} = 45 \end{aligned}</p>
                <p>\begin{aligned}
                4x + x + 15 &= 225 \\
                5x + 15 &= 225 \\
                5x &= 210 \\
                x &= 42
                \end{aligned}</p>
                <p>Berat terbesar = \begin{aligned} 42 + 15 = 57 \text{ kg} \end{aligned}</p>',
                'options' => [
                    ['option_text' => '42 kg', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '55 kg', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '57 kg', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '60 kg', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '65 kg', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Nilai rata-rata dari 16 orang siswa adalah 6,3. Satu siswa yang mempunyai nilai 7,8 tidak disertakan dari kelompok tersebut. Nilai rata-rata yang baru adalah...',
                'explanation' => '<p>Jumlah nilai 16 siswa = \begin{aligned} 16 \times 6,3 = 100,8 \end{aligned}</p>
                <p>Jumlah nilai 15 siswa (setelah dikurangi) = \begin{aligned} 100,8 - 7,8 = 93 \end{aligned}</p>
                <p>Rata-rata baru = \begin{aligned} \frac{93}{15} = 6,2 \end{aligned}</p>',
                'options' => [
                    ['option_text' => '9,8', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '7,2', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '6,2', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '6,1', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '6,0', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Data rata-rata tinggi siswa wanita 134 cm, rata-rata tinggi siswa pria 145 cm. Jika banyak siswa 33 orang dan rata-rata tinggi seluruhnya 142 cm, maka banyak siswa pria adalah...',
                'explanation' => '<p>Misalkan: Wanita = w, Pria = p</p>
                <p>w + p = 33 → w = 33 - p</p>
                <p>Rata-rata gabungan:</p>
                <p>\begin{aligned}
                \frac{134w + 145p}{w + p} &= 142 \\
                134w + 145p &= 142(w + p) \\
                134w + 145p &= 142w + 142p \\
                145p - 142p &= 142w - 134w \\
                3p &= 8w \\
                3p &= 8(33 - p) \\
                3p &= 264 - 8p \\
                11p &= 264 \\
                p &= 24
                \end{aligned}</p>',
                'options' => [
                    ['option_text' => '10 orang', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '12 orang', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '18 orang', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '20 orang', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '24 orang', 'is_correct' => true, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Pada suatu kelas terdapat 14 orang siswa laki-laki dan 16 orang siswa perempuan. Jika rata-rata berat badan siswa laki-laki 54 kg dan rata-rata berat badan siswa perempuan 48 kg, rata-rata berat badan seluruh siswa dalam kelas tersebut adalah...',
                'explanation' => '<p>Jumlah berat laki-laki = \begin{aligned} 14 \times 54 = 756 \text{ kg} \end{aligned}</p>
                <p>Jumlah berat perempuan = \begin{aligned} 16 \times 48 = 768 \text{ kg} \end{aligned}</p>
                <p>Total berat = \begin{aligned} 756 + 768 = 1.524 \text{ kg} \end{aligned}</p>
                <p>Total siswa = \begin{aligned} 14 + 16 = 30 \text{ orang} \end{aligned}</p>
                <p>Rata-rata = \begin{aligned} \frac{1.524}{30} = 50,8 \text{ kg} \end{aligned}</p>',
                'options' => [
                    ['option_text' => '50,2 kg', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '50,4 kg', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '50,6 kg', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '50,8 kg', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '60,0 kg', 'is_correct' => false, 'order' => 5],
                ]
            ],
        ];

        // Simpan soal untuk Blind Test
        foreach ($questionsBT as $questionData) {
            $question = Question::create([
                'material_id' => $questionData['material_id'],
                'type' => $questionData['type'],
                'test_type' => $questionData['test_type'],
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['option_text'],
                    'is_correct' => $optionData['is_correct'],
                    'order' => $optionData['order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Data untuk kategori 2 (Post Test) - soal 11-20
        $materialPT = QuestionMaterial::create([
            'category_id' => 2,
            'name' => 'PT - Statistika 3',
            'slug' => 'pt-statistika-3',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Soal 11-20 untuk Post Test
        $questionsPT = [
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Perhatikan data berat badan (kg) dari 16 siswa berikut! 63, 58, 46, 57, 64, 52, 60, 46, 54, 55, 58, 65, 46, 46, 62, 56. Median dari data tersebut adalah...',
                'explanation' => '<p>Urutkan data dari terkecil ke terbesar:</p>
                <p>46, 46, 46, 46, 52, 54, 55, 56, 57, 58, 58, 60, 62, 63, 64, 65</p>
                <p>Banyak data (n) = 16 (genap)</p>
                <p>Median = \begin{aligned} \frac{\text{data ke-8} + \text{data ke-9}}{2} \end{aligned}</p>
                <p>= \begin{aligned} \frac{56 + 57}{2} = \frac{113}{2} = 56,5 \end{aligned}</p>',
                'options' => [
                    ['option_text' => '46,0', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '50,0', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '55,5', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '56,5', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '60,0', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Ada 25 murid perempuan dalam sebuah kelas. Tinggi rata-rata mereka adalah 130 cm. Bagaimana cara menghitung tinggi rata-rata tersebut?',
                'explanation' => '<p>Rata-rata adalah jumlah semua data dibagi banyak data.</p>
                <p>Pilihan A salah: Tidak harus ada pasangan 132 dan 128, bisa saja semua 130.</p>
                <p>Pilihan B benar: Jika 23 orang tinggi 130, satu orang 133, maka yang satu lagi harus 127 agar rata-rata tetap 130.</p>
                <p>Pilihan C salah: Median (nilai tengah) berbeda dengan rata-rata.</p>',
                'options' => [
                    ['option_text' => 'Jika ada seorang murid perempuan dengan tinggi 132 cm, maka pasti ada seorang murid perempuan dengan tinggi 128 cm', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Jika 23 orang dari murid perempuan tersebut tingginya masing-masing 130 cm dan satu orang tingginya 133 cm, maka satu orang lagi tingginya 127 cm', 'is_correct' => true, 'order' => 2],
                    ['option_text' => 'Jika Anda mengurutkan semua perempuan tersebut dari yang terpendek sampai ke yang tertinggi, maka yang ditengah pasti mempunyai tinggi 130 cm', 'is_correct' => false, 'order' => 3],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Rata-rata 8 buah bilangan adalah 72 dan rata-rata 12 buah bilangan lain adalah 84. Rata-rata 20 buah bilangan adalah...',
                'explanation' => '<p>Jumlah 8 bilangan = \begin{aligned} 8 \times 72 = 576 \end{aligned}</p>
                <p>Jumlah 12 bilangan = \begin{aligned} 12 \times 84 = 1.008 \end{aligned}</p>
                <p>Total jumlah = \begin{aligned} 576 + 1.008 = 1.584 \end{aligned}</p>
                <p>Rata-rata 20 bilangan = \begin{aligned} \frac{1.584}{20} = 79,2 \end{aligned}</p>',
                'options' => [
                    ['option_text' => '79,2', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '78,0', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '76,8', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '66,0', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '65,0', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Jika Ridwan memperoleh nilai 94 pada ujian yang akan datang, maka rata-rata nilainya menjadi 89, tetapi jika Ridwan memperoleh nilai 79, maka rata-ratanya menjadi 86. Banyaknya total ujian yang telah diikutinya adalah …..',
                'explanation' => '<p>Misalkan n = banyak ujian sebelumnya, S = jumlah nilai sebelumnya</p>
                <p>Kasus 1 (nilai 94): \begin{aligned} \frac{S + 94}{n + 1} = 89 \end{aligned}</p>
                <p>Kasus 2 (nilai 79): \begin{aligned} \frac{S + 79}{n + 1} = 86 \end{aligned}</p>
                <p>Dari kedua persamaan:</p>
                <p>\begin{aligned}
                S + 94 &= 89(n + 1) \\
                S + 79 &= 86(n + 1)
                \end{aligned}</p>
                <p>Kurangi persamaan 1 dan 2:</p>
                <p>\begin{aligned}
                (S + 94) - (S + 79) &= 89(n+1) - 86(n+1) \\
                15 &= 3(n+1) \\
                n+1 &= 5 \\
                n &= 4
                \end{aligned}</p>
                <p>Total ujian (termasuk yang akan datang) = 5, jadi ujian sebelumnya = 4</p>',
                'options' => [
                    ['option_text' => '4', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '5', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '6', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '7', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '8', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Sepuluh anak membentuk 2 kelompok bermain yang masing-masing terdiri dari 4 anak dan 6 anak. Rata-rata usia kelompok yang beranggotakan 4 anak adalah 6 tahun, sedangkan rata-rata usia kelompok lainnya adalah 6,5 tahun. Jika satu anak dari masing-masing kelompok ditukar satu sama lain, maka rata-rata usia kedua kelompok sama. Selisih usia kedua anak yang ditukar tersebut adalah …..',
                'explanation' => '<p>Kelompok A (4 anak): rata-rata 6 → jumlah usia = 24</p>
                <p>Kelompok B (6 anak): rata-rata 6,5 → jumlah usia = 39</p>
                <p>Misal anak yang ditukar: dari A usia = a, dari B usia = b</p>
                <p>Setelah ditukar:</p>
                <p>Kelompok A baru: (24 - a + b)/4 = rata-rata baru</p>
                <p>Kelompok B baru: (39 - b + a)/6 = rata-rata baru</p>
                <p>Karena rata-rata sama:</p>
                <p>\begin{aligned}
                \frac{24 - a + b}{4} &= \frac{39 - b + a}{6} \\
                6(24 - a + b) &= 4(39 - b + a) \\
                144 - 6a + 6b &= 156 - 4b + 4a \\
                144 - 6a + 6b - 156 + 4b - 4a &= 0 \\
                -10a + 10b - 12 &= 0 \\
                10b - 10a &= 12 \\
                b - a &= 1,2
                \end{aligned}</p>
                <p>Selisih usia = 1,2 tahun</p>',
                'options' => [
                    ['option_text' => '1,2 tahun', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '0,4 tahun', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '1,0 tahun', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '0,1 tahun', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '0,5 tahun', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Nilai rata-rata ulangan matematika dari 20 siswa adalah 60. Jika ditambah dengan sejumlah siswa yang memiliki rata- rata 70, maka nilai rata-ratanya menjadi 62. Banyak siswa yang ditambahkan adalah …..',
                'explanation' => '<p>Jumlah nilai 20 siswa = \begin{aligned} 20 \times 60 = 1.200 \end{aligned}</p>
                <p>Misalkan tambahan siswa = x</p>
                <p>Jumlah nilai siswa tambahan = \begin{aligned} 70x \end{aligned}</p>
                <p>Total siswa = \begin{aligned} 20 + x \end{aligned}</p>
                <p>Total nilai = \begin{aligned} 1.200 + 70x \end{aligned}</p>
                <p>Rata-rata baru = 62:</p>
                <p>\begin{aligned}
                \frac{1.200 + 70x}{20 + x} &= 62 \\
                1.200 + 70x &= 62(20 + x) \\
                1.200 + 70x &= 1.240 + 62x \\
                70x - 62x &= 1.240 - 1.200 \\
                8x &= 40 \\
                x &= 5
                \end{aligned}</p>',
                'options' => [
                    ['option_text' => '2 orang', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '4 orang', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '5 orang', 'is_correct' => true, 'order' => 3],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Seorang murid menuliskan lima bilangan bulat sedemikian sehingga mediannya satu lebih besar dari rata-rata kelima bilangan bulat tersebut dan modusnya lebih besar satu dari mediannya. Jika mediannya adalah 10, maka bilangan bulat terkecil yang mungkin dari lima bilangan bulat tersebut adalah …..',
                'explanation' => '<p>Median = 10</p>
                <p>Rata-rata = 10 - 1 = 9</p>
                <p>Modus = 10 + 1 = 11</p>
                <p>Misal data terurut: a ≤ b ≤ c ≤ d ≤ e, dengan c = 10 (median)</p>
                <p>Karena modus = 11, maka minimal ada dua data bernilai 11</p>
                <p>Misal d = e = 11</p>
                <p>Rata-rata = 9, maka jumlah semua = 5 × 9 = 45</p>
                <p>a + b + 10 + 11 + 11 = 45</p>
                <p>a + b + 32 = 45</p>
                <p>a + b = 13</p>
                <p>Agar a terkecil, b harus terbesar mungkin</p>
                <p>Jika b = 10, maka modus tidak tunggal (10 dan 11 sama-sama muncul dua kali)</p>
                <p>Jika b = 9, maka a = 4</p>
                <p>Data: 4, 9, 10, 11, 11 → memenuhi semua syarat</p>',
                'options' => [
                    ['option_text' => '1', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '2', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '3', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '4', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '5', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Rata-rata sekelompok bilangan adalah 40. Ada bilangan yang sebenarnya 60, tetapi terbaca 30. Setelah dihitung ulang, rata-rata yang sebenarnya adalah 41. Banyak bilangan dalam kelompok itu adalah …..',
                'explanation' => '<p>Misalkan n = banyak bilangan</p>
                <p>Jumlah salah = 40n</p>
                <p>Kesalahan = 60 - 30 = 30</p>
                <p>Jumlah benar = 40n + 30</p>
                <p>Rata-rata benar = 41:</p>
                <p>\begin{aligned}
                \frac{40n + 30}{n} &= 41 \\
                40n + 30 &= 41n \\
                30 &= n
                \end{aligned}</p>',
                'options' => [
                    ['option_text' => '20', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '25', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '30', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '42', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '45', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Dari nilai ulangan 12 siswa, diketahui nilai terbesarnya 80 dan nilai terkecilnya 20. Nilai rata-rata ulangan mereka tidak mungkin bernilai …..',
                'explanation' => '<p>Kasus ekstrem 1: 11 siswa nilai 20, 1 siswa nilai 80</p>
                <p>Rata-rata minimum = \begin{aligned} \frac{11 \times 20 + 80}{12} = \frac{300}{12} = 25 \end{aligned}</p>
                <p>Kasus ekstrem 2: 11 siswa nilai 80, 1 siswa nilai 20</p>
                <p>Rata-rata maksimum = \begin{aligned} \frac{11 \times 80 + 20}{12} = \frac{900}{12} = 75 \end{aligned}</p>
                <p>Jadi rata-rata mungkin antara 25 dan 75</p>
                <p>Nilai 22 tidak mungkin (di bawah 25)</p>',
                'options' => [
                    ['option_text' => '22', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '25', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '36', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '52', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '75', 'is_correct' => false, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Nilai rata-rata ulangan matematika dari 8 anak adalah 70 dengan selisih nilai tertinggi dan terendahnya adalah 24. Jika ada satu siswa yang mendapat nilai tertinggi dan 7 siswa lainnya mendapat nilai yang sama, maka nilai tertinggi yang diperoleh siswa itu adalah …..',
                'explanation' => '<p>Misalkan nilai tertinggi = x</p>
                <p>Nilai 7 siswa lainnya = x - 24</p>
                <p>Rata-rata = 70</p>
                <p>\begin{aligned}
                \frac{x + 7(x - 24)}{8} &= 70 \\
                x + 7x - 168 &= 560 \\
                8x - 168 &= 560 \\
                8x &= 728 \\
                x &= 91
                \end{aligned}</p>',
                'options' => [
                    ['option_text' => '91', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '87', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '73', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '67', 'is_correct' => false, 'order' => 4],
                ]
            ],
        ];

        // Simpan soal untuk Post Test
        foreach ($questionsPT as $questionData) {
            $question = Question::create([
                'material_id' => $questionData['material_id'],
                'type' => $questionData['type'],
                'test_type' => $questionData['test_type'],
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['option_text'],
                    'is_correct' => $optionData['is_correct'],
                    'order' => $optionData['order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Seeder Statistika berhasil dibuat!');
        $this->command->info('Blind Test (soal 1-10): ' . count($questionsBT) . ' soal');
        $this->command->info('Post Test (soal 11-20): ' . count($questionsPT) . ' soal');
    }
}
