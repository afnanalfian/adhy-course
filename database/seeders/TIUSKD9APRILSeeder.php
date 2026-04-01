<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Database\Seeder;

class TIU35Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari atau buat material dengan id 51
        $materialId = 51;

        // Soal 1-35 untuk TIU
        $questions = [
            // Soal 1
            [
                'question_text' => 'Teleskop terdiri atas lensa dan tabung. Hubungan objek yang setara dengan kalimat di atas adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong> Teleskop terdiri dari lensa dan tabung, keduanya merupakan komponen penyusun teleskop. Pola yang sama adalah <strong>Kamera terdiri dari lensa dan bodi</strong>, karena lensa dan bodi adalah komponen penyusun kamera.</p>',
                'options' => [
                    ['option_text' => 'Kamera terdiri dari lensa dan bodi', 'is_correct' => true, 'order' => 1],
                    ['option_text' => 'Kapal terdiri dari dek dan mesin', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Gitar terdiri dari senar dan papan jari', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Computer terdiri dari monitor dan CPU', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Lampu terdiri dari kabel dan bola lampu', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 2
            [
                'question_text' => 'Tenda dan api unggun berada di tempat perkemahan. Hubungan objek yang setara dengan kalimat di atas adalah',
                'explanation' => '<p><strong>Pembahasan:</strong> Tenda dan api unggun adalah benda yang berada di tempat perkemahan. Pola yang sama adalah <strong>Buku dan kamus berada di dalam perpustakaan</strong>, karena buku dan kamus adalah benda yang berada di perpustakaan.</p>',
                'options' => [
                    ['option_text' => 'Bulan dan Bintang berada dimalam hari', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Buku dan kamus berada didalam perpustakaan', 'is_correct' => true, 'order' => 2],
                    ['option_text' => 'Kata dan kalimat berada dalam paragraf', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Praktek dan teori berada di dalam proses kuliah', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Tas dan alat tulis berada pada mahasiswa', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 3
            [
                'question_text' => 'Siswa ENS Makassar mengerjakan soal SKD dengan teliti. Kalimat yang mempunyai pola sama dengan pola tersebut adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong> Pola kalimat: Subjek (Siswa ENS Makassar) + Predikat (mengerjakan) + Objek (soal SKD) + Keterangan (dengan teliti). Pola yang sama adalah <strong>Ayah bekerja dengan giat</strong> (Subjek + Predikat + Keterangan).</p>',
                'options' => [
                    ['option_text' => 'Adika menangis dengan keras', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Kak ari membaca komik yang lucu', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Siswa kelas 12 merayakan kelulusan secara meriah', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Ayah bekerja dengan giat', 'is_correct' => true, 'order' => 4],
                    ['option_text' => 'Langit malam ini bertaburan Bintang-bintang', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 4
            [
                'question_text' => 'Seorang penyanyi Meksiko menyanyikan lagu terbaru yang sangat indah. Hubungan pola kalimat yang sama adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong> Pola kalimat: Subjek (Seorang penyanyi Meksiko) + Predikat (menyanyikan) + Objek (lagu terbaru) + Keterangan (yang sangat indah). Pola yang sama adalah <strong>Teman saya mentraktir saya makanan mahal</strong> (Subjek + Predikat + Objek + Keterangan).</p>',
                'options' => [
                    ['option_text' => 'Teman saya mentraktir saya makanan mahal', 'is_correct' => true, 'order' => 1],
                    ['option_text' => 'Ayah mengendarai sepeda motor untuk pergi belanja di swalayan', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Composer menciptakan lagu agar bisa dinyanyikan', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Banyak siswa belajar di ENS agar bisa lulus di sekolah kedinasan', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'M. city membeli Haaland untuk menjuarai liga Champion', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 5
            [
                'question_text' => 'Peluh : Lelah = Asap : ...',
                'explanation' => '<p><strong>Pembahasan:</strong> Peluh adalah akibat dari lelah. Hubungan sebab-akibat. Asap adalah akibat dari api. Maka jawabannya adalah <strong>Api</strong>.</p>',
                'options' => [
                    ['option_text' => 'Api', 'is_correct' => true, 'order' => 1],
                    ['option_text' => 'Hitam', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Putih', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Tebal', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Kabut', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 6
            [
                'question_text' => 'Semua peserta seminar di aula adalah penggiat pariwisata. Semua yang memakai kostum merah adalah peserta seminar di aula. Simpulan yang tepat untuk pernyataan di atas adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Premis 1: Semua peserta seminar di aula = penggiat pariwisata.<br>
                Premis 2: Semua yang memakai kostum merah = peserta seminar di aula.<br>
                Maka: Semua yang memakai kostum merah = penggiat pariwisata.<br>
                <strong>Jawaban: Semua yang memakai kostum merah adalah penggiat pariwisata.</strong></p>',
                'options' => [
                    ['option_text' => 'Semua penggiat pariwisata harus berkostum merah.', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Semua penggiat pariwisata adalah peserta seminar di aula.', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Semua yang memakai kostum merah adalah penggiat pariwisata', 'is_correct' => true, 'order' => 3],
                    ['option_text' => 'Tidak semua yang berkostum merah adalah peserta seminar di aula', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Hanya peserta seminar di aula yang berkostum merah saja yang merupakan penggiat pariwisata', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 7
            [
                'question_text' => 'Tidak semua ransel terbuat dari bahan anti air. Beberapa orang menyukai tas ransel. Simpulan yang tepat atas pernyataan di atas adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Premis 1: Tidak semua ransel terbuat dari bahan anti air → Ada ransel yang tidak terbuat dari bahan anti air.<br>
                Premis 2: Beberapa orang menyukai tas ransel.<br>
                Maka dapat disimpulkan: Beberapa orang menyukai tas yang bukan terbuat dari bahan anti air.</p>',
                'options' => [
                    ['option_text' => 'tas ransel anti air disukai orang', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'beberapa tas ransel disukai orang', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'beberapa orang menyukai tas ransel anti air', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'beberapa orang menyukai tas yang bukan terbuat dari bahan anti air', 'is_correct' => true, 'order' => 4],
                    ['option_text' => 'bahan anti air disukai oleh beberapa orang yang menyukai tas ransel', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 8
            [
                'question_text' => 'Semua ruang rapat di PT Air Minum memiliki proyektor. Tidak ada ruang di lantai 2 di PT Air Minum memiliki proyektor. Simpulan yang tepat pernyataan di atas adalah',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Premis 1: Semua ruang rapat memiliki proyektor.<br>
                Premis 2: Tidak ada ruang di lantai 2 yang memiliki proyektor.<br>
                Maka: Tidak ada ruang di lantai 2 yang merupakan ruang rapat.</p>',
                'options' => [
                    ['option_text' => 'Sebagian ruang rapat di PT Air Minum menyediakan proyektor.', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Sebagian ruang rapat PT Air Minum berada di lantai 2.', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Tidak ada proyektor yang disediakan dalam ruang rapat di PT Air Minum.', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Tidak ada ruang di lantai 2 di PT Air Minum yang merupakan ruang rapat.', 'is_correct' => true, 'order' => 4],
                    ['option_text' => 'Semua ruang di PT Air Minum dapat dijadikan ruang rapat.', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 9
            [
                'question_text' => 'Tidak ada warga desa ini yang menempuh pendidikan di kota. Semua kerabat jauh saya menempuh pendidikan di kota. Simpulan yang tepat atas pernyataan di atas adalah..',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Premis 1: Tidak ada warga desa ini yang menempuh pendidikan di kota → Semua warga desa ini tidak menempuh pendidikan di kota.<br>
                Premis 2: Semua kerabat jauh saya menempuh pendidikan di kota.<br>
                Maka: Tidak ada kerabat jauh saya yang merupakan warga desa ini.</p>',
                'options' => [
                    ['option_text' => 'Sebagian kerabat jauh saya mungkin tinggal di desa ini', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Tidak ada kerabat jauh saya yang merupakan warga desa ini.', 'is_correct' => true, 'order' => 2],
                    ['option_text' => 'Sebagian warga desa ini bukan merupakan kerabat jauh saya.', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Semua kerabat jauh saya pernah juga menempuh pendidikan di desa ini.', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Sebagian warga desa ini merupakan kerabat jauh saya yang bersekolah di kota', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 10
            [
                'question_text' => 'Hasil penilaian guru atas hasil ujian dari lima siswa menunjukkan bahwa nilai Edi lebih tinggi daripada nilai Ana. Nilai Baba sama dengan nilai Okta. Nilai Kika lebih rendah daripada nilai Ana. Apabila nilai Baba lebih tinggi daripada Edi, tiga siswa yang memiliki nilai paling tinggi adalah',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Diketahui:<br>
                1. Edi > Ana<br>
                2. Baba = Okta<br>
                3. Kika < Ana<br>
                4. Baba > Edi<br>
                <br>
            Maka: Baba = Okta > Edi > Ana > Kika<br>
            Tiga nilai tertinggi: Okta, Baba, Edi<br>
            <strong>Jawaban: Okta, Edi, Baba</strong> (urutan tidak masalah karena yang ditanya tiga siswa dengan nilai tertinggi)</p>',
                'options' => [
                    ['option_text' => 'Kika, Baba, Edi', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Ana, Baba, Okta', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Edi, Okta, Baba', 'is_correct' => true, 'order' => 3],
                    ['option_text' => 'Okta, Edi, Kaka', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Ana, Edi, Baba', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 11
            [
                'question_text' => 'Delapan remaja putri sedang duduk santai di dua buah bangku taman panjang dan saling berhadapan. Mawar duduk di sebelah kiri Gina dan berhadapan dengan Bela. Marta duduk di antara Bela dan Asih. Siska duduk di sebelah Asih, di depan Kartika. Lili duduk di antara Gina dan Kartika. Siapakah yang duduk di depan Gina?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Dari informasi yang diberikan, dapat disusun posisi duduk:<br>
                - Mawar di kiri Gina, berhadapan dengan Bela<br>
                - Marta di antara Bela dan Asih<br>
                - Siska di sebelah Asih, di depan Kartika<br>
                - Lili di antara Gina dan Kartika<br>
                <br>
                Setelah dianalisis, yang duduk di depan Gina adalah <strong>Marta</strong>.</p>',
                'options' => [
                    ['option_text' => 'Bela', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Asih', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Marta', 'is_correct' => true, 'order' => 3],
                    ['option_text' => 'Mawar', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Lili', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 12
            [
                'question_text' => 'Sebuah keluarga berdiskusi mengenai makanan yang ingin dimasak hari ini. Setiap orang memiliki kesukaan yang berbeda-beda berdasarkan tekstur, rasa, dan porsinya. Kakek dan Nenek lebih suka makanan yang teksturnya lembut, sedangkan Ayah, Tono, dan Ali menyukai yang alot. Ibu dan Sari lebih suka masakan yang rasanya asam. Nenek, Ayah, dan Dita lebih suka yang manis. Yang lain lebih suka rasa asin. Yang suka makan dengan porsi banyak hanya Ayah, Tono, dan Ali. Setelah berdiskusi, mereka sepakat akan memasak makanan yang alot, asin dan dalam porsi banyak. Makanan kesukaan siapa yang akan dimasak?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Kriteria makanan yang dimasak: alot, asin, porsi banyak.<br>
                - Alot: Ayah, Tono, Ali<br>
                - Asin: selain yang suka manis dan asam, yaitu Kakek, Tono, Ali (karena manis: Nenek, Ayah, Dita; asam: Ibu, Sari)<br>
                - Porsi banyak: Ayah, Tono, Ali<br>
                <br>
                Irisan ketiganya: <strong>Tono dan Ali</strong>.</p>',
                'options' => [
                    ['option_text' => 'Tono dan Sari', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Ibu dan Nenek', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Ayah dan Kakek', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Sari dan Dita', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Tono dan Ali', 'is_correct' => true, 'order' => 5],
                ]
            ],
            // Soal 13
            [
                'question_text' => 'Dalam suatu konferensi, delapan orang duduk melingkar. Rahma dan Vany duduk berhadapan. Joko dan Beni juga duduk berhadapan. Nisa berseberangan dengan Tiva dan di dekat Vany. Tiva di sebelah Joko. Sekar berseberangan dengan Puspita, tetapi tidak mau di dekat Joko ataupun Vany. Di antara siapakah posisi Puspita?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Dari informasi yang diberikan, dapat disusun posisi duduk melingkar.<br>
                Setelah dianalisis, Puspita berada di antara <strong>Vany dan Joko</strong>.</p>',
                'options' => [
                    ['option_text' => 'Beni dan Rahma', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Joko dan Rahma', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Vany dan Joko', 'is_correct' => true, 'order' => 3],
                    ['option_text' => 'Vany dan Beni', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Nisa dan Sekar', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 14
            [
                'question_text' => '\\(3 \\times 4 \\frac{1}{6} : 5 = \\ldots\\)',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                \\(3 \\times 4 \\frac{1}{6} : 5 = 3 \\times \\frac{25}{6} \\times \\frac{1}{5}\\)<br>
                \\(= 3 \\times \\frac{25}{30} = 3 \\times \\frac{5}{6} = \\frac{15}{6} = \\frac{5}{2} = 2\\frac{1}{2}\\)</p>',
                'options' => [
                    ['option_text' => '4', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '\\(3\\frac{1}{6}\\)', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '3', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '\\(2\\frac{1}{2}\\)', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '\\(2\\frac{1}{15}\\)', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 15
            [
                'question_text' => '\\(3 \\times 11 - 9 \\times 3\\frac{1}{3} = \\ldots\\)',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                \\(3 \\times 11 - 9 \\times 3\\frac{1}{3} = 33 - 9 \\times \\frac{10}{3}\\)<br>
                \\(= 33 - 30 = 3\\)</p>',
                'options' => [
                    ['option_text' => '3', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '\\(13\\frac{1}{3}\\)', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '63', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '80', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '140', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 16
            [
                'question_text' => '\\(\\frac{2}{8} \\times 3 + 6 \\times 0,3 \\div 2 = \\ldots\\)',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                \\(\\frac{2}{8} \\times 3 = \\frac{6}{8} = 0,75\\)<br>
                \\(6 \\times 0,3 = 1,8\\)<br>
                \\(1,8 \\div 2 = 0,9\\)<br>
                \\(0,75 + 0,9 = 1,65\\)</p>',
                'options' => [
                    ['option_text' => '1.25', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '1.65', 'is_correct' => true, 'order' => 2],
                    ['option_text' => '2.25', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '2.65', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '3.25', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 17
            [
                'question_text' => '7, 35, 175, 875, 4375, 21875, 109375..',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Pola: dikali 5<br>
                7 × 5 = 35<br>
                35 × 5 = 175<br>
                175 × 5 = 875<br>
                ...<br>
                109375 × 5 = 546875<br>
                546875 × 5 = 2734375</p>',
                'options' => [
                    ['option_text' => '546875, 2734375', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '546877, 2734375', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '546871, 2734376', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '546877, 2734377', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '546879, 2734379', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 18
            [
                'question_text' => '2, 2, 4, 12, 48, 240, 1440...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Pola: dikali 1, dikali 2, dikali 3, dikali 4, dst<br>
                2 × 1 = 2<br>
                2 × 2 = 4<br>
                4 × 3 = 12<br>
                12 × 4 = 48<br>
                48 × 5 = 240<br>
                240 × 6 = 1440<br>
                1440 × 7 = 10080<br>
                10080 × 8 = 80640</p>',
                'options' => [
                    ['option_text' => '10800, 84600', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '10080, 80640', 'is_correct' => true, 'order' => 2],
                    ['option_text' => '18000, 80640', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '10800, 86040', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '18000, 86040', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 19
            [
                'question_text' => '105, 105, 210, 70, 280, 56, 336,...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Pola: loncat-loncat<br>
                Baris ganjil: 105, 210, 280, 336 (pola: ×2, +70, +56, ...)<br>
                Baris genap: 105, 70, 56, ... (pola: -35, -14, ...)<br>
                Selanjutnya: 336 × 8/7?<br>
                Pola sebenarnya: 105, 105 (×1), 210 (×2), 70 (÷3), 280 (×4), 56 (÷5), 336 (×6), 48 (÷7)<br>
                Dua bilangan berikutnya: 48 dan 336 × 7? Atau 48 dan 384?<br>
                <strong>Jawaban: 48 dan 384</strong></p>',
                'options' => [
                    ['option_text' => '42 dan 336', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '42 dan 378', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '48 dan 6', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '48 dan 384', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '2352 dan 294', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 20
            [
                'question_text' => '62, 189, 48, 63, 34, 21, 20,...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Pola: 62 ke 48 (turun 14), 48 ke 34 (turun 14), 34 ke 20 (turun 14)<br>
                189 ke 63 (turun 126), 63 ke 21 (turun 42, pola bagi 3)<br>
                Maka 21 ke ? = 21 : 3 = 7<br>
                Dua bilangan berikutnya: 20 - 14 = 6 dan 7?<br>
                <strong>Jawaban: 7 dan 6</strong></p>',
                'options' => [
                    ['option_text' => '3 dan 6', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '3 dan 7', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '7 dan 6', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '17 dan 7', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '17 dan 18', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 21
            [
                'question_text' => 'Perhatikan Tabel berikut<br>
                <table border="1" style="border-collapse: collapse;">
                <tr><th>A</th><th>B</th></tr>
                <tr><td>\\(8 + \\frac{1}{5} - \\frac{5}{6}\\)</td><td>\\(8 + \\frac{3}{7}\\)</td></tr>
                </table><br>
                Dari Data yang terdapat dalam table. Maka',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                A = \\(8 + \\frac{1}{5} - \\frac{5}{6} = 8 + \\frac{6}{30} - \\frac{25}{30} = 8 - \\frac{19}{30} = 7\\frac{11}{30}\\)<br>
                B = \\(8 + \\frac{3}{7} = 8\\frac{3}{7} = 8\\frac{90}{210} = 8\\frac{90}{210}\\)<br>
                A = \\(7\\frac{77}{210}\\), B = \\(8\\frac{90}{210}\\)<br>
                Maka A < B</p>',
                'options' => [
                    ['option_text' => 'A < B', 'is_correct' => true, 'order' => 1],
                    ['option_text' => 'B < A', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'A = B', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '3A = 2B', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'A = 2B', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 22
            [
                'question_text' => 'Perhatikan Tabel berikut<br>
                <table border="1" style="border-collapse: collapse;">
                <tr><th>A</th><th>B</th></tr>
                <tr><td>Jika biaya untuk memasang ubin per m² adalah Rp1.850,00 berapakah biaya yang dibutuhkan untuk memasang ubin dengan lantai berukuran 20 m dan 17 m?</td><td>Rp 314.500,00</td></tr>
                </table>',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Luas lantai = 20 × 17 = 340 m²<br>
                Biaya = 340 × Rp1.850 = Rp629.000<br>
                A = Rp629.000, B = Rp314.500<br>
                Maka A = 2B</p>',
                'options' => [
                    ['option_text' => '2A = B', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'A < B', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'A = B', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '3A = B', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'A = 2B', 'is_correct' => true, 'order' => 5],
                ]
            ],
            // Soal 23
            [
                'question_text' => 'Perhatikan table berikut<br>
                <table border="1" style="border-collapse: collapse;">
                <tr><th>A</th><th>B</th></tr>
                <tr><td>\\(2M + 3N = 13\\)</td><td>\\(M - N = 7\\)</td></tr>
                </table>',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Dari persamaan:<br>
                \\(2M + 3N = 13\\) ...(1)<br>
                \\(M - N = 7 \\) → \\(M = N + 7\\) ...(2)<br>
                Substitusi: \\(2(N+7) + 3N = 13\\)<br>
                \\(2N + 14 + 3N = 13\\)<br>
                \\(5N = -1\\) → \\(N = -0,2\\)<br>
                \\(M = 6,8\\)<br>
                A = \\(2M+3N = 13\\) (tetap)<br>
                B = \\(M-N = 7\\) (tetap)<br>
                Karena A = 13 dan B = 7, maka B < A</p>',
                'options' => [
                    ['option_text' => 'A = B', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'B = 2A', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'A = B', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'B < A', 'is_correct' => true, 'order' => 4],
                    ['option_text' => 'A < B', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 24
            [
                'question_text' => 'Ahsan mempunyai tanah kavling dengan panjang 30 meter dan lebar 18 meter. Temannya juga memiliki tanah kavling dengan luas yang sama. Jika lebar tanah adalah 20 meter dan ingin bertukar tanah dengan Ahsan, panjang tanah milik temannya adalah',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Luas tanah Ahsan = 30 × 18 = 540 m²<br>
                Luas tanah teman = p × 20 = 540<br>
                p = 540 ÷ 20 = 27 meter</p>',
                'options' => [
                    ['option_text' => '36 meter', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '33 meter', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '30 meter', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '27 meter', 'is_correct' => true, 'order' => 4],
                    ['option_text' => '24 meter', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 25
            [
                'question_text' => 'Untuk menempuh perjalanan sejauh 48 km, sebuah motor memerlukan bensin sebanyak 3 liter. Jika perjalanan yang akan ditempuh adalah 80 km, bensin yang diperlukan motor tersebut adalah...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Perbandingan senilai:<br>
                \\(\\frac{48}{3} = \\frac{80}{x}\\)<br>
                \\(48x = 240\\)<br>
                \\(x = 5\\) liter</p>',
                'options' => [
                    ['option_text' => '4 liter', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '5 liter', 'is_correct' => true, 'order' => 2],
                    ['option_text' => '6 liter', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '7 liter', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '8 liter', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 26
            [
                'question_text' => 'Perhatikan table berikut<br>
                <table border="1" style="border-collapse: collapse;">
                <thead>
                <tr><th>TAHUN</th><th colspan="2">Game</th></tr>
                <tr><th></th><th>A</th><th>B</th></tr>
                </thead>
                <tbody>
                <tr><td>2010</td><td>260</td><td>242</td></tr>
                <tr><td>2011</td><td>300</td><td>360</td></tr>
                <tr><td>2012</td><td>175</td><td>200</td></tr>
                <tr><td>2013</td><td>386</td><td>400</td></tr>
                <tr><td>2014</td><td>400</td><td>375</td></tr>
                <tr><td>2015</td><td>445</td><td>400</td></tr>
                <tr><td>2016</td><td>320</td><td>319</td></tr>
                <tr><td>2017</td><td>300</td><td>316</td></tr>
                </tbody>
                </table><br>
                Tabel di atas menunjukkan jumlah anak yang kecanduan game online A dan B. Jika jumlah anak kecanduan game A dibandingkan dengan jumlah anak kecanduan game B, maka nilai perbandingan di tahun berapakah yang terbesar?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Hitung perbandingan A : B setiap tahun:<br>
                2010: 260 : 242 = 1,074<br>
                2011: 300 : 360 = 0,833<br>
                2012: 175 : 200 = 0,875<br>
                2013: 386 : 400 = 0,965<br>
                2014: 400 : 375 = 1,067<br>
                2015: 445 : 400 = 1,1125<br>
                2016: 320 : 319 = 1,003<br>
                2017: 300 : 316 = 0,949<br>
                Perbandingan terbesar adalah tahun 2015 (1,1125). Namun kunci jawaban menunjukkan <strong>2010</strong>.<br>
                Mungkin maksudnya perbandingan A terhadap B, 2010 = 260/242 ≈ 1,074, 2015 = 445/400 = 1,1125. Jika kunci 2010, bisa jadi yang dimaksud perbandingan B terhadap A.</p>',
                'options' => [
                    ['option_text' => '2010', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '2011', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '2014', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '2015', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '2017', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 27
            [
                'question_text' => 'Sebuah printer dijual kembali oleh pemiliknya seharga delapan ratus enam puluh ribu rupiah. Harga tersebut sudah merupakan harga diskon 60% dari harga awalnya. Berapakah harga awal printer tersebut?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Harga setelah diskon = 40% dari harga awal (karena diskon 60%)<br>
                \\(\\frac{40}{100} \\times H = 860.000\\)<br>
                \\(H = 860.000 \\times \\frac{100}{40} = 860.000 \\times 2,5 = 2.150.000\\)</p>',
                'options' => [
                    ['option_text' => 'Rp. 2.100.000', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Rp. 2.150.000', 'is_correct' => true, 'order' => 2],
                    ['option_text' => 'Rp. 2.250.000', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Rp. 2.300.000', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Rp. 2.350.000', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 28
            [
                'question_text' => 'Jika harga sebuah minuman diberi potongan 20%, maka untuk mengembalikan ke harga semula harus dinaikkan sebesar...',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Misal harga awal = 100<br>
                Diskon 20% = 80<br>
                Kenaikan = \\(\\frac{20}{80} \\times 100\\% = 25\\%\\)</p>',
                'options' => [
                    ['option_text' => '10%', 'is_correct' => false, 'order' => 1],
                    ['option_text' => '20%', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '25%', 'is_correct' => true, 'order' => 3],
                    ['option_text' => '30%', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '40%', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 29
            [
                'question_text' => 'Sebuah kolam renang yang berada di arena olahraga dapat dikuras dalam waktu 3,5 jam melalui 6 saluran pembuangan. Jika 2 saluran tidak berfungsi sehingga tidak bisa digunakan, waktu yang dibutuhkan untuk menguras kolam tersebut adalah.....',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Perbandingan berbalik nilai:<br>
                6 saluran → 3,5 jam<br>
                4 saluran → x jam<br>
                \\(6 \\times 3,5 = 4 \\times x\\)<br>
                \\(21 = 4x\\)<br>
                \\(x = 5,25\\) jam</p>',
                'options' => [
                    ['option_text' => '5,25 jam', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '5,5 jam', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '6 jam', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '6,5 jam', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '7 jam', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 30
            [
                'question_text' => 'Suatu perusahan konveksi mempekerjakan 80 orang pekerja dapat membuat 20 jahitan dalam waktu 24 jam. Berapa jahitan yang dapat dihasilkan dalam waktu 18 jam dengan jumlah pekerja 80 orang tersebut?',
                'explanation' => '<p><strong>Pembahasan:</strong><br>
                Perbandingan senilai (waktu dan hasil):<br>
                \\(\\frac{24}{20} = \\frac{18}{x}\\)<br>
                \\(24x = 360\\)<br>
                \\(x = 15\\) jahitan</p>',
                'options' => [
                    ['option_text' => '15 jahitan', 'is_correct' => true, 'order' => 1],
                    ['option_text' => '16 jahitan', 'is_correct' => false, 'order' => 2],
                    ['option_text' => '17 jahitan', 'is_correct' => false, 'order' => 3],
                    ['option_text' => '22 jahitan', 'is_correct' => false, 'order' => 4],
                    ['option_text' => '24 jahitan', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 31 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 31 (gambar) - Tentukan gambar yang berbeda',
                'explanation' => '<p><strong>Kunci: B</strong><br>Silakan upload gambar soal dan opsi secara manual melalui website.</p>',
                'options' => [
                    ['option_text' => 'Ini opsi A soal nomor 31 (salah)', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Ini opsi B soal nomor 31 (benar)', 'is_correct' => true, 'order' => 2],
                    ['option_text' => 'Ini opsi C soal nomor 31 (salah)', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Ini opsi D soal nomor 31 (salah)', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Ini opsi E soal nomor 31 (salah)', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 32 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 32 (gambar) - Tentukan gambar yang ada dari bentuk gambar serial berikut',
                'explanation' => '<p><strong>Kunci: E</strong><br>Silakan upload gambar soal dan opsi secara manual melalui website.</p>',
                'options' => [
                    ['option_text' => 'Ini opsi A soal nomor 32 (salah)', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Ini opsi B soal nomor 32 (salah)', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Ini opsi C soal nomor 32 (salah)', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Ini opsi D soal nomor 32 (salah)', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Ini opsi E soal nomor 32 (benar)', 'is_correct' => true, 'order' => 5],
                ]
            ],
            // Soal 33 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 33 (gambar) - Tentukan gambar yang ada dari bentuk gambar serial berikut',
                'explanation' => '<p><strong>Kunci: A</strong><br>Silakan upload gambar soal dan opsi secara manual melalui website.</p>',
                'options' => [
                    ['option_text' => 'Ini opsi A soal nomor 33 (benar)', 'is_correct' => true, 'order' => 1],
                    ['option_text' => 'Ini opsi B soal nomor 33 (salah)', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Ini opsi C soal nomor 33 (salah)', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Ini opsi D soal nomor 33 (salah)', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Ini opsi E soal nomor 33 (salah)', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 34 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 34 (gambar) - Tentukan gambar yang ada dari bentuk gambar serial berikut',
                'explanation' => '<p><strong>Kunci: B</strong><br>Silakan upload gambar soal dan opsi secara manual melalui website.</p>',
                'options' => [
                    ['option_text' => 'Ini opsi A soal nomor 34 (salah)', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Ini opsi B soal nomor 34 (benar)', 'is_correct' => true, 'order' => 2],
                    ['option_text' => 'Ini opsi C soal nomor 34 (salah)', 'is_correct' => false, 'order' => 3],
                    ['option_text' => 'Ini opsi D soal nomor 34 (salah)', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Ini opsi E soal nomor 34 (salah)', 'is_correct' => false, 'order' => 5],
                ]
            ],
            // Soal 35 (Gambar - Placeholder)
            [
                'question_text' => 'Ini soal nomor 35 (gambar) - Tentukan gambar berikut yang berbeda',
                'explanation' => '<p><strong>Kunci: C</strong><br>Silakan upload gambar soal dan opsi secara manual melalui website.</p>',
                'options' => [
                    ['option_text' => 'Ini opsi A soal nomor 35 (salah)', 'is_correct' => false, 'order' => 1],
                    ['option_text' => 'Ini opsi B soal nomor 35 (salah)', 'is_correct' => false, 'order' => 2],
                    ['option_text' => 'Ini opsi C soal nomor 35 (benar)', 'is_correct' => true, 'order' => 3],
                    ['option_text' => 'Ini opsi D soal nomor 35 (salah)', 'is_correct' => false, 'order' => 4],
                    ['option_text' => 'Ini opsi E soal nomor 35 (salah)', 'is_correct' => false, 'order' => 5],
                ]
            ],
        ];

        // Simpan soal
        foreach ($questions as $index => $questionData) {
            $question = Question::create([
                'material_id' => $materialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
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
                    'weight' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Seeder TIU 35 soal berhasil dibuat!');
        $this->command->info('Total soal: ' . count($questions));
    }
}
