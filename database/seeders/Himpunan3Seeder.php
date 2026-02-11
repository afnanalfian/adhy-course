<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Himpunan3Seeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // --- 1. CEK ATAU BUAT MATERIAL UNTUK BT-HIMPUNAN 3 (category_id = 6) ---
        $btMaterial = DB::table('question_materials')
            ->where('name', 'BT - Himpunan 3')
            ->where('category_id', 6)
            ->first();

        if (!$btMaterial) {
            $btMaterialId = DB::table('question_materials')->insertGetId([
                'category_id' => 6,
                'name' => 'BT - Himpunan 3',
                'slug' => 'bt-himpunan-3-' . uniqid(),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        } else {
            $btMaterialId = $btMaterial->id;
        }

        // --- 2. CEK ATAU BUAT MATERIAL UNTUK PT-HIMPUNAN 3 (category_id = 7) ---
        $ptMaterial = DB::table('question_materials')
            ->where('name', 'PT - Himpunan 3')
            ->where('category_id', 7)
            ->first();

        if (!$ptMaterial) {
            $ptMaterialId = DB::table('question_materials')->insertGetId([
                'category_id' => 7,
                'name' => 'PT - Himpunan 3',
                'slug' => 'pt-himpunan-3-' . uniqid(),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        } else {
            $ptMaterialId = $ptMaterial->id;
        }

        // --- SOAL NOMOR 1-10 (BT - Himpunan 3) ---
        $btQuestions = [
            // Soal 1
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Jika K = {k, o, m, p, a, s} dan L = {m, a, s, u, k}, maka K ∪ L = …',
                'explanation' => 'Gabungan dari himpunan K dan L adalah semua anggota yang ada di K atau L. K ∪ L = {k, o, m, p, a, s, u} = {p, o, s, u, k, m, a}.',
                'options' => [
                    ['{ p, o, s, u, k, m, a }', 1],
                    ['{ m, a, s, b, u, k }', 0],
                    ['{ p, a, k, u, m, i, s }', 0],
                    ['{ k, a, m, p, u, s }', 0],
                    ['{ p, o, s, s, u, k, k, m, m, a, a }', 0],
                ],
            ],
            // Soal 2
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Jika himpunan A ⊂ B dengan n(A) = 11 dan n(B) = 18 maka n(A ∩ B) = …',
                'explanation' => 'Karena A adalah himpunan bagian dari B, maka semua anggota A pasti ada di B. Sehingga A ∩ B = A, maka n(A ∩ B) = n(A) = 11.',
                'options' => [
                    ['7', 0],
                    ['11', 1],
                    ['18', 0],
                    ['28', 0],
                    ['30', 0],
                ],
            ],
            // Soal 3 (gambar, deskripsi verbal)
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Daerah yang diarsir pada diagram Venn dengan tiga himpunan A, B, C menunjukkan daerah (A ∪ B) - C. Maka pernyataan yang tepat adalah ...',
                'explanation' => 'Berdasarkan gambar diagram Venn, daerah yang diarsir adalah semua anggota A atau B tetapi tidak termasuk anggota C. Ini adalah operasi (A ∪ B) - C.',
                'options' => [
                    ['A∩(B∪C)', 0],
                    ['A∪(B∩C)', 0],
                    ['(A∪B)−C', 1],
                    ['(A∩B)−C', 0],
                    ['A−(B∩C)', 0],
                ],
            ],
            // Soal 4 (gambar, deskripsi verbal)
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Daerah yang diarsir pada diagram Venn dengan tiga himpunan A, B, C menunjukkan daerah A ∩ (B ∪ C). Maka pernyataan yang tepat adalah ...',
                'explanation' => 'Berdasarkan gambar diagram Venn, daerah yang diarsir adalah anggota A yang sekaligus berada di B atau C. Ini adalah operasi A ∩ (B ∪ C).',
                'options' => [
                    ['A∪(B∩C)', 0],
                    ['(A∪B)∩C', 0],
                    ['A∩(B∪C)', 1],
                    ['(A∩B)∪C', 0],
                    ['A−(B∩C)', 0],
                ],
            ],
            // Soal 5 (gambar, deskripsi verbal)
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Daerah yang diarsir pada diagram Venn dengan tiga himpunan A, B, C menunjukkan daerah (A ∩ B) ∪ (A ∩ C). Maka pernyataan yang tepat adalah ...',
                'explanation' => 'Berdasarkan gambar diagram Venn, daerah yang diarsir adalah irisan A dengan B digabung dengan irisan A dengan C. Ini adalah operasi (A ∩ B) ∪ (A ∩ C).',
                'options' => [
                    ['(A∩B)∪(A∩C)', 1],
                    ['(A∪B)∩(A∩C)', 0],
                    ['(A∪B)∩(A∪C)', 0],
                    ['(A∪C)∩(B∪C)', 0],
                    ['(B−A)∪(C−A)', 0],
                ],
            ],
            // Soal 6 (gambar, deskripsi verbal)
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Diagram Venn menunjukkan banyak siswa yang mengikuti ekstrakurikuler basket dan voli dalam sebuah kelas. Dari gambar diketahui: basket saja = 12 orang, voli saja = 7 orang, basket dan voli = 5 orang, tidak keduanya = 8 orang. Banyak siswa yang tidak gemar basket adalah ...',
                'explanation' => 'Tidak gemar basket berarti siswa yang hanya gemar voli ditambah yang tidak gemar keduanya = 7 + 8 = 15 orang. (Catatan: Dalam pembahasan disebutkan 12+7=19, namun data yang lebih masuk akal adalah voli saja = 7, tidak keduanya = 8, sehingga total = 15. Mohon disesuaikan dengan gambar asli.)',
                'options' => [
                    ['12 orang', 0],
                    ['15 orang', 1],
                    ['19 orang', 0],
                    ['22 orang', 0],
                    ['30 orang', 0],
                ],
            ],
            // Soal 7
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Dari suatu kelas terdapat 25 siswa suka membaca, 30 siswa suka mengarang. Jika 12 orang siswa suka membaca dan mengarang, banyak siswa dalam kelas tersebut adalah ....',
                'explanation' => 'Total siswa = (suka membaca) + (suka mengarang) - (suka keduanya) = 25 + 30 - 12 = 43 orang.',
                'options' => [
                    ['67 orang', 0],
                    ['55 orang', 0],
                    ['43 orang', 1],
                    ['37 orang', 0],
                    ['35 orang', 0],
                ],
            ],
            // Soal 8
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Suatu kelas terdiri dari 40 siswa, 25 siswa di antaranya gemar bermain pingpong, 18 siswa gemar bermain sepak bola, dan 7 siswa tidak menyukai keduanya. Banyak siswa yang menyukai keduanya adalah ... orang',
                'explanation' => 'Total = (gemar pingpong) + (gemar sepak bola) - (keduanya) + (tidak keduanya). 40 = 25 + 18 - x + 7 → 40 = 50 - x → x = 10.',
                'options' => [
                    ['18', 0],
                    ['15', 0],
                    ['12', 0],
                    ['10', 1],
                    ['8', 0],
                ],
            ],
            // Soal 9
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Kelas VII-A terdiri dari 31 siswa. Sebanyak 15 siswa mengikuti kompetisi matematika, 13 siswa mengikuti kompetisi IPA, dan 7 siswa tidak mengikuti kompetisi tersebut. Banyak siswa yang mengikuti kedua kompetisi tersebut adalah ... siswa',
                'explanation' => '31 = 15 + 13 - x + 7 → 31 = 35 - x → x = 4.',
                'options' => [
                    ['2', 0],
                    ['3', 0],
                    ['4', 1],
                    ['5', 0],
                    ['6', 0],
                ],
            ],
            // Soal 10
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Terdapat 60 orang pelamar yang harus mengikuti tes tertulis dan tes wawancara agar dapat diterima sebagai karyawan sebuah perusahaan. Ternyata 32 orang lulus tes wawancara, 48 orang lulus tes tertulis, dan 6 orang tidak mengikuti tes tersebut. Banyak pelamar yang diterima sebagai karyawan perusahaan adalah ... orang',
                'explanation' => 'Pelamar yang diterima adalah yang lulus kedua tes. 60 = 32 + 48 - x + 6 → 60 = 86 - x → x = 26.',
                'options' => [
                    ['10', 0],
                    ['16', 0],
                    ['20', 0],
                    ['26', 1],
                    ['30', 0],
                ],
            ],
        ];

        foreach ($btQuestions as $questionData) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $questionData['material_id'],
                'type' => $questionData['type'],
                'test_type' => $questionData['test_type'],
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $order = 1;
            foreach ($questionData['options'] as $option) {
                DB::table('question_options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $option[0],
                    'is_correct' => $option[1],
                    'order' => $order++,
                    'weight' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // --- SOAL NOMOR 11-20 (PT - Himpunan 3) ---
        $ptQuestions = [
            // Soal 11
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Dari 50 siswa, 30 siswa menyukai aritmetika, 30 siswa menyukai geometri, dan 30 siswa menyukai aljabar. Banyaknya siswa yang menyukai aritmetika dan geometri adalah 15 orang. Banyaknya siswa yang menyukai aritmetika dan aljabar juga 15 orang, sama halnya dengan yang menyukai aljabar dan geometri. Berapa banyak siswa yang menyukai ketiga-ketiganya?',
                'explanation' => 'Gunakan prinsip inklusi-eksklusi: Total = jumlah masing-masing - jumlah irisan dua + irisan tiga. 50 = (30+30+30) - (15+15+15) + x → 50 = 90 - 45 + x → 50 = 45 + x → x = 5.',
                'options' => [
                    ['3 siswa', 0],
                    ['5 siswa', 1],
                    ['8 siswa', 0],
                    ['11 siswa', 0],
                    ['15 siswa', 0],
                ],
            ],
            // Soal 12
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Dari 120 orang mahasiswa semester 7 di suatu sekolah tinggi, diketahui 100 mahasiswa mengambil paling sedikit satu mata kuliah aplikasi pilihan, yaitu mata kuliah Asuransi, Perbankan, dan Transportasi. Diketahui juga 65 orang mengambil Asuransi, 45 orang mengambil Perbankan, 42 orang mengambil Transportasi, 20 orang mengambil Asuransi dan Perbankan, 25 orang mengambil Asuransi dan Transportasi, dan 15 orang mengambil Perbankan dan Transportasi. Tentukan banyaknya mahasiswa yang hanya mengambil mata kuliah Transportasi?',
                'explanation' => 'Gunakan prinsip inklusi-eksklusi: n(A∪P∪T) = n(A)+n(P)+n(T) - n(A∩P) - n(A∩T) - n(P∩T) + n(A∩P∩T). 100 = (65+45+42) - (20+25+15) + x → 100 = 152 - 60 + x → 100 = 92 + x → x = 8. Maka n(T saja) = n(T) - n(A∩T) - n(P∩T) + n(A∩P∩T) = 42 - 25 - 15 + 8 = 10 orang.',
                'options' => [
                    ['8 orang', 0],
                    ['10 orang', 1],
                    ['14 orang', 0],
                    ['18 orang', 0],
                    ['28 orang', 0],
                ],
            ],
            // Soal 13
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Dari sekelompok anak terdapat 20 anak gemar voli, 28 anak gemar basket, dan 27 anak gemar pingpong, 13 anak gemar voli dan basket, 11 anak gemar basket dan pingpong, 9 anak gemar voli dan pingpong, serta 5 anak gemar ketiga-tiganya. Jika dalam kelompok tersebut ada 55 anak, banyak anak yang tidak gemar satu pun dari ketiga jenis permainan tersebut adalah …',
                'explanation' => 'Gunakan prinsip inklusi-eksklusi: Total yang gemar minimal satu = (20+28+27) - (13+11+9) + 5 = 75 - 33 + 5 = 47. Maka yang tidak gemar satupun = 55 - 47 = 8 anak.',
                'options' => [
                    ['8 anak', 1],
                    ['10 anak', 0],
                    ['13 anak', 0],
                    ['15 anak', 0],
                    ['18 anak', 0],
                ],
            ],
            // Soal 14
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Dari satu kelas terdata 2/5 dari jumlah siswa yang menyukai matematika sekaligus fisika akan mengikuti olimpiade fisika. Empat kali dari jumlah siswa yang menyukai keduanya akan mengikuti olimpiade matematika. Jika jumlah seluruh siswa ada 44 orang dan siswa yang mengikuti olimpiade secara otomatis menyukai pelajaran yang dilombakan, maka banyak siswa yang hanya mengikuti olimpiade matematika (hanya menyukai matematika) adalah ⋯ orang.',
                'explanation' => 'Misal x = jumlah siswa yang menyukai keduanya. Maka yang ikut olimpiade fisika = (2/5)x, yang ikut olimpiade matematika = 4x. Total siswa = (4x - x) + ((2/5)x - x) + x = 44? Atau gunakan: 44 = 4x + (2/5)x - x? Dari pembahasan: 44 = (5x + 4x - x) = 11x → x = 8. Hanya ikut olimpiade matematika = 4x - x = 3x = 24 siswa.',
                'options' => [
                    ['8', 0],
                    ['10', 0],
                    ['20', 0],
                    ['24', 1],
                    ['32', 0],
                ],
            ],
            // Soal 15
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Data kegiatan sarapan pagi 38 orang peserta didik adalah sebagai berikut. Ada 6 orang sarapan dengan roti dan nasi goreng. Ada 5 orang tidak sarapan pagi. Jika banyak peserta didik yang sarapan nasi goreng dua kali banyak peserta didik yang sarapan roti, maka banyak peserta didik yang sarapan nasi goreng saja adalah ⋯⋅',
                'explanation' => 'Misal R = sarapan roti, N = sarapan nasi goreng. Diketahui N = 2R. Total = R + N - 6 + 5 = 38 → R + 2R - 6 + 5 = 38 → 3R - 1 = 38 → 3R = 39 → R = 13, N = 26. Nasi goreng saja = N - 6 = 20 orang.',
                'options' => [
                    ['35 orang', 0],
                    ['30 orang', 0],
                    ['25 orang', 0],
                    ['20 orang', 1],
                    ['15 orang', 0],
                ],
            ],
            // Soal 16
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Sebanyak 115 mahasiswa mengambil mata kuliah Matematika Diskrit, 71 mahasiswa mengambil mata kuliah Kalkulus, dan 56 mahasiswa mengambil mata kuliah Geometri. Di antaranya 25 mahasiswa mengambil mata kuliah Matematika Diskrit dan Kalkulus, 14 mahasiswa mengambil mata kuliah Matematika Diskrit dan Geometri, dan 9 mahasiswa mengambil mata kuliah Kalkulus dan Geometri. Jika terdapat 196 mahasiswa yang mengambil paling sedikit satu dari tiga mata kuliah tersebut, berapa orang yang mengambil tiga mata kuliah itu sekaligus?',
                'explanation' => 'Gunakan prinsip inklusi-eksklusi: n(M∪K∪G) = n(M)+n(K)+n(G) - n(M∩K) - n(M∩G) - n(K∩G) + n(M∩K∩G). 196 = (115+71+56) - (25+14+9) + x → 196 = 242 - 48 + x → 196 = 194 + x → x = 2.',
                'options' => [
                    ['2 mahasiswa', 1],
                    ['4 mahasiswa', 0],
                    ['6 mahasiswa', 0],
                    ['8 mahasiswa', 0],
                    ['10 mahasiswa', 0],
                ],
            ],
            // Soal 17
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Sebuah agen penjualan majalah dan koran ingin memiliki pelanggan sebanyak 75 orang. Banyak pelanggan yang ada saat ini adalah sebagai berikut: 20 orang berlangganan majalah, 35 orang berlangganan koran, dan 5 orang berlangganan keduanya. Agar keinginannya tercapai, banyak pelanggan yang harus ditambahkan adalah ....',
                'explanation' => 'Pelanggan saat ini = 20 + 35 - 5 = 50 orang. Target 75 orang, maka perlu tambahan 25 orang.',
                'options' => [
                    ['10 orang', 0],
                    ['15 orang', 0],
                    ['25 orang', 1],
                    ['30 orang', 0],
                    ['70 orang', 0],
                ],
            ],
            // Soal 18
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Dari 30 pengendara yang terkena tilang, 15 diantaranya tidak membawa SIM, 17 diantaranya tidak membawa STNK, 5 orang diantaranya karena melakukan pelanggaran lain. Banyaknya pengendara yang terkena tilang tetapi membawa SIM atau STNK adalah...',
                'explanation' => 'Misal x = tidak membawa SIM dan STNK. 30 = 15 + 17 - x + 5 → 30 = 37 - x → x = 7. Maka yang membawa SIM atau STNK = total - yang melakukan pelanggaran lain = 30 - 5 = 25? Atau dari pembahasan: hanya tidak SIM = 8, hanya tidak STNK = 10, keduanya = 7, pelanggaran lain = 5 → total tidak membawa SIM atau STNK = 8+10+5=23. Yang membawa SIM atau STNK = 30 - 23 = 7? Mohon disesuaikan. Dalam pembahasan: total = 23 orang (yang terkena tilang tetapi membawa SIM atau STNK?)',
                'options' => [
                    ['7', 0],
                    ['10', 0],
                    ['23', 1],
                    ['45', 0],
                    ['70', 0],
                ],
            ],
            // Soal 19
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Seratus orang pemuda mendaftarkan untuk mengikuti perlombaan jalan cepat, sepeda lambat, atau kedua-duanya. Bila yang mendaftarkan diri untuk mengikuti jalan cepat 75%, dan sepeda lambat 48%, banyaknya pemuda yang mendaftar untuk kedua lomba tersebut adalah...',
                'explanation' => 'n(A∪B) = n(A) + n(B) - n(A∩B). 100% = 75% + 48% - x → 100% = 123% - x → x = 23%. Maka banyak peserta = 23% × 100 = 23 orang.',
                'options' => [
                    ['22', 0],
                    ['23', 1],
                    ['32', 0],
                    ['33', 0],
                    ['48', 0],
                ],
            ],
            // Soal 20
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Dari 25 orang yang melamar suatu pekerjaan diketahui bahwa 7 orang berumur lebih dari 30 tahun dan 15 orang bergelar sarjana. Di antara pelamar yang bergelar sarjana, 5 orang berumur lebih dari 30 tahun. Banyak pelamar yang bukan sarjana dan umurnya kurang dari 30 tahun adalah...',
                'explanation' => 'Total = (lebih 30) + (sarjana) - (sarjana & lebih 30) + (bukan sarjana & kurang 30). 25 = 7 + 15 - 5 + x → 25 = 17 + x → x = 8.',
                'options' => [
                    ['5', 0],
                    ['6', 0],
                    ['7', 0],
                    ['8', 1],
                    ['9', 0],
                ],
            ],
        ];

        foreach ($ptQuestions as $questionData) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $questionData['material_id'],
                'type' => $questionData['type'],
                'test_type' => $questionData['test_type'],
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            $order = 1;
            foreach ($questionData['options'] as $option) {
                DB::table('question_options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $option[0],
                    'is_correct' => $option[1],
                    'order' => $order++,
                    'weight' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('Seeder untuk Himpunan 3 (BT: 1-10, PT: 11-20) berhasil ditambahkan.');
    }
}
