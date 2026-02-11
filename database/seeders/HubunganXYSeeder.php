<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HubunganXYSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // --- 1. CEK ATAU BUAT MATERIAL UNTUK BT - HUBUNGAN X DAN Y (category_id = 6) ---
        $btMaterial = DB::table('question_materials')
            ->where('name', 'BT - Hubungan X dan Y')
            ->where('category_id', 6)
            ->first();

        if (!$btMaterial) {
            $btMaterialId = DB::table('question_materials')->insertGetId([
                'category_id' => 6,
                'name' => 'BT - Hubungan X dan Y',
                'slug' => 'bt-hubungan-x-dan-y-' . uniqid(),
                'created_at'=> $now,
                'updated_at'=> $now,
            ]);
        } else {
            $btMaterialId = $btMaterial->id;
        }

        // --- 2. CEK ATAU BUAT MATERIAL UNTUK PT - HUBUNGAN X DAN Y (category_id = 7) ---
        $ptMaterial = DB::table('question_materials')
            ->where('name', 'PT - Hubungan X dan Y')
            ->where('category_id', 7)
            ->first();

        if (!$ptMaterial) {
            $ptMaterialId = DB::table('question_materials')->insertGetId([
                'category_id' => 7,
                'name' => 'PT - Hubungan X dan Y',
                'slug' => 'pt-hubungan-x-dan-y-' . uniqid(),
                'created_at' => $now,
                'updated_at'=> $now,
            ]);
        } else {
            $ptMaterialId = $ptMaterial->id;
        }

        // --- SOAL NOMOR 1-10 (BT - Hubungan X dan Y) ---
        $btQuestions = [
            // Soal 1
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Perhatikan tabel berikut!<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:50%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">P</th>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">Q</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">\(2X - Y\)</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">\(4X - 2Y\)</td>
                    </tr>
                </table><br>
                Jika \(X = 4\) dan \(Y = 2\), maka ...',
                'explanation' => '\(P = 2X - Y = 2(4) - 2 = 8 - 2 = 6\)<br>\(Q = 4X - 2Y = 4(4) - 2(2) = 16 - 4 = 12\)<br>Maka \(P < Q\).',
                'options' => [
                    ['P > Q', 0],
                    ['P < Q', 1],
                    ['P = Q', 0],
                    ['P = 2Q', 0],
                    ['Hubungan P dan Q tidak dapat ditentukan', 0],
                ],
            ],
            // Soal 2
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Perhatikan tabel berikut!<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:50%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">P</th>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">Q</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">\(3(3A + 3B)\)</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">\(6A - 6B\)</td>
                    </tr>
                </table><br>
                Jika \(A = \frac{4}{3}\) dan \(B = -\frac{1}{4}\), maka ...',
                'explanation' => '\(P = 3(3A + 3B) = 9A + 9B = 9(\frac{4}{3}) + 9(-\frac{1}{4}) = 12 - 2,25 = 9,75\)<br>\(Q = 6A - 6B = 6(\frac{4}{3}) - 6(-\frac{1}{4}) = 8 + 1,5 = 9,5\)<br>Maka \(P > Q\).',
                'options' => [
                    ['P > Q', 1],
                    ['P < Q', 0],
                    ['P = Q', 0],
                    ['P = 2Q', 0],
                    ['Hubungan P dan Q tidak dapat ditentukan', 0],
                ],
            ],
            // Soal 3
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Perhatikan tabel berikut!<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:60%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">A</th>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">B</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">\(\frac{32}{2} \times \frac{117}{48}\)</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">\(\frac{21}{48} \times \frac{19}{49} \times 112\)</td>
                    </tr>
                </table><br>
                Manakah hubungan yang benar antara kuantitas A dan B berdasarkan informasi yang diberikan?',
                'explanation' => '\(A = \frac{32}{2} \times \frac{117}{48} = 16 \times \frac{117}{48} = \frac{1872}{48} = 39\)<br>\(B = \frac{21}{48} \times \frac{19}{49} \times 112 = \frac{21 \times 19 \times 112}{48 \times 49} = \frac{21}{49} \times \frac{112}{48} \times 19 = \frac{3}{7} \times \frac{7}{3} \times 19 = 19\)<br>Maka \(3A = 117, 2B = 38\), sehingga \(3A > 2B\).',
                'options' => [
                    ['2A = 3B', 0],
                    ['3A < 2B', 0],
                    ['3A > 2B', 1],
                    ['A > 15B', 0],
                    ['A + B = 0', 0],
                ],
            ],
            // Soal 4
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Diketahui:<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:60%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">M</th>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">N</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">\(5/4 + 36 \times 2/1/2 - 3/1/4\)</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">\(2,5\%\) dari 3700</td>
                    </tr>
                </table><br>
                Manakah hubungan yang benar antara kuantitas M dan N berdasarkan informasi yang diberikan?',
                'explanation' => '\(M = \frac{5}{4} + 36 \times \frac{2}{\frac{1}{2}} - \frac{3}{\frac{1}{4}} = 1,25 + 36 \times 4 - 3 \times 4 = 1,25 + 144 - 12 = 133,25\)<br>\(N = 2,5\% \times 3700 = \frac{2,5}{100} \times 3700 = \frac{9250}{100} = 92,5\)<br>Maka \(M > N\).',
                'options' => [
                    ['3M > 2N', 0],
                    ['2M > 3N', 1],
                    ['Hubungan M dan N tidak dapat ditentukan', 0],
                    ['1/4M = 2N', 0],
                    ['M = 2N', 0],
                ],
            ],
            // Soal 5
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Diketahui:<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:60%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">X</th>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">Y</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">\(4/3 + 13/3 + 9 \times 3\)</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">\(11/3 + 5/3 + 4 \times 9\)</td>
                    </tr>
                </table><br>
                Manakah hubungan yang benar antara kuantitas X dan Y berdasarkan informasi yang diberikan?',
                'explanation' => '\(X = \frac{4}{3} + \frac{13}{3} + 9 \times 3 = \frac{17}{3} + 27 = \frac{17}{3} + \frac{81}{3} = \frac{98}{3} = 32,67\)<br>\(Y = \frac{11}{3} + \frac{5}{3} + 4 \times 9 = \frac{16}{3} + 36 = \frac{16}{3} + \frac{108}{3} = \frac{124}{3} = 41,33\)<br>Maka \(2X = 65,34\) dan \(3Y = 124\), sehingga \(2X < 3Y\).',
                'options' => [
                    ['3X = 2Y', 0],
                    ['2X < 3Y', 1],
                    ['Hubungan X dan Y tidak dapat ditentukan', 0],
                    ['2X = 3Y', 0],
                    ['2X > 3Y', 0],
                ],
            ],
            // Soal 6
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Diketahui:<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:60%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">X</th>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">Y</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">\(3/5 + 9 \times 3 - 12/5\)</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">\(6/7 \times 14 + 27 \div 4\)</td>
                    </tr>
                </table><br>
                Manakah hubungan yang benar antara kuantitas X dan Y berdasarkan informasi yang diberikan?',
                'explanation' => '\(X = \frac{3}{5} + 9 \times 3 - \frac{12}{5} = \frac{3}{5} - \frac{12}{5} + 27 = -\frac{9}{5} + 27 = -1,8 + 27 = 25,2\)<br>\(Y = \frac{6}{7} \times 14 + 27 \div 4 = 12 + 6,75 = 18,75\)<br>Maka \(2X = 50,4\) dan \(Y = 18,75\), sehingga \(2X > Y\).',
                'options' => [
                    ['2X < Y', 0],
                    ['X > 2Y', 0],
                    ['Hubungan X dan Y tidak dapat ditentukan', 0],
                    ['2X > Y', 1],
                    ['X > 3Y', 0],
                ],
            ],
            // Soal 7
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Perhatikan tabel berikut!<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:60%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">X</th>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">Y</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Bilangan yang menyatakan \(16\frac{2}{3}\%\) dari 18</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Bilangan yang menyatakan 40% dari 25</td>
                    </tr>
                </table><br>
                Manakah hubungan yang benar antara kuantitas X dan Y berdasarkan informasi yang diberikan?',
                'explanation' => '\(X = 16\frac{2}{3}\% \times 18 = \frac{50}{3}\% \times 18 = \frac{50}{3} \times \frac{1}{100} \times 18 = \frac{50 \times 18}{300} = \frac{900}{300} = 3\)<br>\(Y = 40\% \times 25 = \frac{40}{100} \times 25 = \frac{1000}{100} = 10\)<br>Maka \(10X = 30\) dan \(3Y = 30\), sehingga \(10X = 3Y\).',
                'options' => [
                    ['X > Y', 0],
                    ['X = Y', 0],
                    ['2X = 3Y', 0],
                    ['3X = 2Y', 0],
                    ['10X = 3Y', 1],
                ],
            ],
            // Soal 8
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Adib mengendarai motor dari kota Surabaya ke kota Semarang. Ia berangkat pada pukul 18.30 dan sampai di Semarang pada pukul 01.30 keesokan paginya.<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:50%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">P</th>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">Q</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Lama perjalanan yang ditempuh oleh Adib adalah ... jam</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">6</td>
                    </tr>
                </table><br>
                Bagaimana hubungan antara P dan Q?',
                'explanation' => 'Lama perjalanan: 18.30 → 24.00 = 5,5 jam, 00.00 → 01.30 = 1,5 jam. Total = 7 jam.<br>\(P = 7\), \(Q = 6\). Maka \(P > Q\).',
                'options' => [
                    ['P > Q', 1],
                    ['P < Q', 0],
                    ['P = Q', 0],
                    ['P = 2Q', 0],
                    ['Hubungan P dan Q tidak dapat ditentukan', 0],
                ],
            ],
            // Soal 9
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Sebuah kantong memuat 4 kelereng merah, 3 kelereng biru, dan 5 kelereng hijau. Dari kelereng-kelereng tersebut akan diambil satu kelereng.<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:50%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">P</th>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">Q</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Peluang terambilnya kelereng berwarna biru</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">0,125</td>
                    </tr>
                </table><br>
                Bagaimana hubungan antara P dan Q?',
                'explanation' => 'Total kelereng = 4 + 3 + 5 = 12.<br>Peluang biru = \(\frac{3}{12} = \frac{1}{4} = 0,25\).<br>\(P = 0,25\), \(Q = 0,125\). Maka \(P > Q\).',
                'options' => [
                    ['P > Q', 1],
                    ['P < Q', 0],
                    ['P = Q', 0],
                    ['P = 2Q', 0],
                    ['Hubungan P dan Q tidak dapat ditentukan', 0],
                ],
            ],
            // Soal 10
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Jarak kota Solo dengan Purwokerto kira-kira 180 km, akan ditempuh dalam waktu 2 jam 15 menit menggunakan sepeda motor.<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:50%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">P</th>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">Q</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Kecepatan rata-rata sepeda motor ... km/jam</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">160</td>
                    </tr>
                </table><br>
                Bagaimana hubungan antara P dan Q?',
                'explanation' => 'Waktu = 2 jam 15 menit = 2,25 jam.<br>Kecepatan = \(\frac{180}{2,25} = 80\) km/jam.<br>\(P = 80\), \(Q = 160\). Maka \(P < Q\).',
                'options' => [
                    ['P > Q', 0],
                    ['P < Q', 1],
                    ['P = Q', 0],
                    ['P = 2Q', 0],
                    ['Hubungan P dan Q tidak dapat ditentukan', 0],
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
                'created_at'=> $now,
                'updated_at'=> $now,
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

        // --- SOAL NOMOR 11-20 (PT - Hubungan X dan Y) ---
        $ptQuestions = [
            // Soal 11
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Jika sebuah dadu dan sekeping uang dilempar satu kali secara bersamaan.<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:60%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">P</th>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">Q</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Peluang untuk memperoleh gambar pada mata uang dan bilangan ganjil pada dadu adalah ...</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">50%</td>
                    </tr>
                </table><br>
                Bagaimana hubungan antara P dan Q?',
                'explanation' => 'Peluang gambar = \(\frac{1}{2}\), peluang ganjil = \(\frac{3}{6} = \frac{1}{2}\).<br>Peluang gabungan = \(\frac{1}{2} \times \frac{1}{2} = \frac{1}{4} = 25\%\).<br>\(P = 25\%\), \(Q = 50\%\). Maka \(P < Q\).',
                'options' => [
                    ['P > Q', 0],
                    ['P < Q', 1],
                    ['P = Q', 0],
                    ['P = 2Q', 0],
                    ['Hubungan P dan Q tidak dapat ditentukan', 0],
                ],
            ],
            // Soal 12
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Ady sudah berlari selama 9 jam dengan jarak tempuh 270 km.<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:50%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">P</th>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">Q</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Kecepatan Ady berlari adalah ... km/jam</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">15</td>
                    </tr>
                </table><br>
                Bagaimana hubungan antara P dan Q?',
                'explanation' => 'Kecepatan = \(\frac{270}{9} = 30\) km/jam.<br>\(P = 30\), \(Q = 15\). Maka \(P > Q\).',
                'options' => [
                    ['P > Q', 1],
                    ['P < Q', 0],
                    ['P = Q', 0],
                    ['P = 2Q', 0],
                    ['Hubungan P dan Q tidak dapat ditentukan', 0],
                ],
            ],
            // Soal 13
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Diketahui Abdi memiliki gandum sebanyak 15 kantong plastik. Berat setiap kantong 10 kg.<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:50%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">X</th>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">Y</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">10</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Berat seluruh gandum Abdi dalam satuan ons</td>
                    </tr>
                </table><br>
                Bagaimana hubungan antara X dan Y?',
                'explanation' => 'Berat gandum = 15 × 10 kg = 150 kg = 150 × 10 ons = 1500 ons.<br>\(X = 10\), \(Y = 1500\). Maka \(X < Y\).',
                'options' => [
                    ['X > Y', 0],
                    ['X < Y', 1],
                    ['X + Y = 0', 0],
                    ['X = Y', 0],
                    ['Hubungan X dan Y tidak dapat ditentukan', 0],
                ],
            ],
            // Soal 14
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Diketahui pekerjaan dapat diselesaikan oleh 25 orang dalam waktu 4 hari.<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:60%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">X</th>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">Y</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">20</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Jumlah pekerja yang diperlukan agar pekerjaan tersebut dapat selesai dalam waktu 5 hari.</td>
                    </tr>
                </table><br>
                Bagaimana hubungan antara X dan Y?',
                'explanation' => '25 orang × 4 hari = \(x\) orang × 5 hari<br>\(100 = 5x \Rightarrow x = 20\)<br>\(X = 20\), \(Y = 20\). Maka \(X = Y\).',
                'options' => [
                    ['X > Y', 0],
                    ['X < Y', 0],
                    ['X + Y = 0', 0],
                    ['X = Y', 1],
                    ['Hubungan X dan Y tidak dapat ditentukan', 0],
                ],
            ],
            // Soal 15
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Harga pembelian sebuah roti adalah Rp 5.000,00. Roti tersebut dijual dengan keuntungan 15%.<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:60%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">P</th>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">Q</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Harga penjualan 100 buah roti adalah ...</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Rp 575.000,00</td>
                    </tr>
                </table><br>
                Bagaimana hubungan antara P dan Q?',
                'explanation' => 'Harga jual 1 roti = Rp 5.000 + 15% × Rp 5.000 = Rp 5.000 + Rp 750 = Rp 5.750.<br>Harga jual 100 roti = 100 × Rp 5.750 = Rp 575.000.<br>\(P = 575.000\), \(Q = 575.000\). Maka \(P = Q\).',
                'options' => [
                    ['P > Q', 0],
                    ['P < Q', 0],
                    ['P = Q', 1],
                    ['P = 2Q', 0],
                    ['Hubungan P dan Q tidak dapat ditentukan', 0],
                ],
            ],
            // Soal 16
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Jumlah pegawai Perusahaan A tiga kali jumlah pegawai di Perusahaan B. Jumlah pegawai A dan B adalah 92 orang.<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:60%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">P</th>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">Q</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">69</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Selisih antara jumlah pegawai Perusahaan A dan Perusahaan B</td>
                    </tr>
                </table><br>
                Manakah hubungan yang benar antara kuantitas P dan Q berdasarkan informasi yang diberikan?',
                'explanation' => '\(A = 3B\), \(A + B = 92\)<br>\(3B + B = 92 \Rightarrow 4B = 92 \Rightarrow B = 23\), \(A = 69\)<br>Selisih = \(A - B = 69 - 23 = 46\)<br>\(P = 69\), \(Q = 46\). Maka \(P > Q\).',
                'options' => [
                    ['P > Q', 1],
                    ['P < Q', 0],
                    ['P = 2Q', 0],
                    ['P = Q', 0],
                    ['Hubungan P dan Q tidak dapat ditentukan', 0],
                ],
            ],
            // Soal 17
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Perhatikan tabel berikut!<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:60%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">A</th>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">B</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Jarak yang ditempuh dari titik A ke titik B dengan kecepatan 35 km/jam dalam waktu 90 menit</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">40,5 km</td>
                    </tr>
                </table><br>
                Manakah hubungan yang benar antara kuantitas A dan B berdasarkan informasi yang diberikan?',
                'explanation' => 'Waktu = 90 menit = 1,5 jam.<br>Jarak = kecepatan × waktu = 35 × 1,5 = 52,5 km.<br>\(A = 52,5\), \(B = 40,5\). Maka \(A > B\).',
                'options' => [
                    ['A = B', 0],
                    ['A > B', 1],
                    ['A < B', 0],
                    ['2A = B', 0],
                    ['Informasi yang diberikan tidak cukup untuk memutuskan salah satu dari keempat pilihan di atas', 0],
                ],
            ],
            // Soal 18
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Harga sebuah baju renang adalah Rp 154.000,00 yang mendapat diskon 25%.<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:50%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:25%; background:#f2f2f2;">X</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Rp 115.000,00</td>
                    </tr>
                </table><br>
                Manakah pernyataan di bawah ini yang benar?',
                'explanation' => 'Harga setelah diskon = 75% × Rp 154.000 = \(\frac{75}{100} \times 154.000 = \frac{3}{4} \times 154.000 = 115.500\).<br>Harga setelah diskon = Rp 115.500, \(X = 115.000\).<br>Maka harga baju renang setelah diskon > X.',
                'options' => [
                    ['Harga baju renang setelah diskon < X', 0],
                    ['Harga baju renang setelah diskon = X', 0],
                    ['Harga baju renang setelah diskon > X', 1],
                    ['Harga baju renang setelah diskon = 1,5X', 0],
                    ['Harga baju renang setelah diskon = 2X', 0],
                ],
            ],
            // Soal 19
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Arfan mengikuti ujian matematika dengan nilai 69, 75, 83, dan 98.<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:60%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">A</th>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">B</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Nilai ujian selanjutnya agar ia mendapat rata-rata 82</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">85</td>
                    </tr>
                </table><br>
                Manakah hubungan yang benar dari kedua kuantitas di bawah ini?',
                'explanation' => 'Jumlah nilai awal = 69 + 75 + 83 + 98 = 325.<br>Target rata-rata 82 dari 5 kali ujian = 5 × 82 = 410.<br>Nilai ke-5 = 410 - 325 = 85.<br>\(A = 85\), \(B = 85\). Maka \(A = B\).',
                'options' => [
                    ['A > B', 0],
                    ['A < B', 0],
                    ['A = B', 1],
                    ['3A = B', 0],
                    ['A = 3B', 0],
                ],
            ],
            // Soal 20
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => 'Perhatikan tabel berikut!<br><br>
                <table style="border-collapse:collapse; border:1px solid #000; width:60%; margin:auto;">
                    <tr>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">P</th>
                        <th style="border:1px solid #000; padding:8px; width:30%; background:#f2f2f2;">Q</th>
                    </tr>
                    <tr>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">Banyak uang yang diterima masing-masing anak jika uang sebesar Rp 720.000,00 dibagikan kepada 3 orang anak</td>
                        <td style="border:1px solid #000; padding:8px; text-align:center;">\(\frac{3}{10} \times 720.000\)</td>
                    </tr>
                </table><br>
                Manakah hubungan yang benar antara kuantitas P dan Q berdasarkan informasi yang diberikan?',
                'explanation' => '\(P = \frac{720.000}{3} = 240.000\)<br>\(Q = \frac{3}{10} \times 720.000 = 216.000\)<br>Maka \(P > Q\) atau \(3P > 2Q\).',
                'options' => [
                    ['P > Q', 1],
                    ['P < Q', 0],
                    ['P = Q', 0],
                    ['2P = Q', 0],
                    ['Hubungan P dan Q tidak dapat ditentukan', 0],
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

        $this->command->info('Seeder untuk Hubungan X dan Y (BT: 1-10, PT: 11-20) berhasil ditambahkan.');
    }
}
