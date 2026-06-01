<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TIUMINITOSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Material dengan id = 73 (TIU 2 Juni)
        $materialId = 73;

        $questions = [
            // Soal 1
            [
                'question_text' => 'Buah : Pisang = Bencana : ...',
                'options' => [
                    ['text' => 'Banjir', 'is_correct' => true],
                    ['text' => 'Musibah', 'is_correct' => false],
                    ['text' => 'Cuaca', 'is_correct' => false],
                    ['text' => 'Alam', 'is_correct' => false],
                    ['text' => 'Buatan', 'is_correct' => false],
                ],
                'explanation' => 'Pisang adalah contoh dari buah, sementara banjir adalah contoh dari bencana. Jadi, hubungan ini bersifat contoh atau jenis (contoh dari kategori yang lebih luas).',
            ],
            // Soal 2
            [
                'question_text' => 'Masa : Era = Gasal : ...',
                'options' => [
                    ['text' => 'Bilangan', 'is_correct' => false],
                    ['text' => 'Genap', 'is_correct' => false],
                    ['text' => 'Ganjil', 'is_correct' => true],
                    ['text' => 'Kuliah', 'is_correct' => false],
                    ['text' => 'Semester', 'is_correct' => false],
                ],
                'explanation' => 'Masa dan era adalah dua istilah yang saling berhubungan dalam konteks waktu. Gasal dan ganjil juga saling berhubungan, di mana gasal adalah salah satu jenis dari bilangan ganjil. Gasal memiliki makna yang sama dengan ganjil.',
            ],
            // Soal 3
            [
                'question_text' => 'Mereka bermain di taman setiap sore. Kalimat tersebut sama polanya dengan ...',
                'options' => [
                    ['text' => 'Ayah berkebun di halaman rumah setiap pagi', 'is_correct' => true],
                    ['text' => 'Pak Badu berjualan nasi di kantin sekolah', 'is_correct' => false],
                    ['text' => 'Mereka tertawa saat mendengar lelucon itu', 'is_correct' => false],
                    ['text' => 'Ibu menyiram bunga mawar di depan rumah setiap petang', 'is_correct' => false],
                    ['text' => 'Kakak duduk di kursi sambil membaca buku', 'is_correct' => false],
                ],
                'explanation' => 'Pola kalimat: Subjek (Mereka) + Predikat (bermain) + Keterangan Tempat (di taman) + Keterangan Waktu (setiap sore). Pola yang sama: Ayah + berkebun + di halaman rumah + setiap pagi.',
            ],
            // Soal 4
            [
                'question_text' => 'Di alun-alun, Bambang bermain dengan ceria. Kalimat tersebut sama polanya dengan ...',
                'options' => [
                    ['text' => 'Di pantai, anak-anak mencari kerang dengan hati-hati', 'is_correct' => false],
                    ['text' => 'Di sawah, Pak Sutarno mengolah tanah dengan cangkul', 'is_correct' => false],
                    ['text' => 'Di lapangan, tim sepak bola berlatih di hari Minggu', 'is_correct' => false],
                    ['text' => 'Di sekolah, jungkat-jungkit berada di area permainan', 'is_correct' => false],
                    ['text' => 'Di pasar, Pak Mamat berbelanja dengan cekatan', 'is_correct' => true],
                ],
                'explanation' => 'Pola kalimat: Keterangan Tempat (Di alun-alun) + Subjek (Bambang) + Predikat (bermain) + Keterangan Cara (dengan ceria). Pola yang sama: Di pasar + Pak Mamat + berbelanja + dengan cekatan.',
            ],
            // Soal 5
            [
                'question_text' => 'Anak-anak itu memainkan bola dan gasing di halaman belakang. Kalimat tersebut sama polanya dengan ...',
                'options' => [
                    ['text' => 'Ibu memasak rendang dan sayur asem untuk makan siang', 'is_correct' => false],
                    ['text' => 'Adik-adik menyusun puzzle dan lego di taman bermain', 'is_correct' => true],
                    ['text' => 'Pak Dion mengajar matematika dan ilmu pengetahuan alam di kelas 6', 'is_correct' => false],
                    ['text' => 'Para petani menanam padi dan jagung di sawah', 'is_correct' => false],
                    ['text' => 'Siswa-siswi membaca buku dan menulis catatan di perpustakaan', 'is_correct' => false],
                ],
                'explanation' => 'Pola kalimat: Subjek (Anak-anak itu) + Predikat (memainkan) + Objek (bola dan gasing) + Keterangan Tempat (di halaman belakang). Pola yang sama: Adik-adik + menyusun + puzzle dan lego + di taman bermain.',
            ],
            // Soal 6
            [
                'question_text' => 'Semua korban bencana alam akan menjalani pemulihan pascabencana. Semua peserta program bantuan pemerintah di desa ini adalah korban bencana alam. Simpulan yang tepat atas pernyataan di atas adalah ...',
                'options' => [
                    ['text' => 'Semua korban bencana alam adalah peserta program bantuan pemerintah', 'is_correct' => false],
                    ['text' => 'Semua peserta program bantuan pemerintah di desa ini akan menjalani pemulihan pascabencana', 'is_correct' => true],
                    ['text' => 'Tidak semua peserta program bantuan pemerintah di desa ini akan menjalani pemulihan pascabencana', 'is_correct' => false],
                    ['text' => 'Sebagian peserta program bantuan pemerintah di desa ini akan menjalani pemulihan pascabencana', 'is_correct' => false],
                    ['text' => 'Beberapa peserta program bantuan pemerintah di desa ini tidak akan menjalani pemulihan pascabencana', 'is_correct' => false],
                ],
                'explanation' => 'Premis 1: Semua korban bencana alam → pemulihan pascabencana<br>Premis 2: Semua peserta program bantuan → korban bencana alam<br>Maka: Semua peserta program bantuan → pemulihan pascabencana (silogisme)',
            ],
            // Soal 7
            [
                'question_text' => 'Semua anggota baru klub tenis wajib mengenakan seragam. Beberapa warga Perumahan Graha Indah adalah anggota baru klub tenis. Kesimpulan yang tepat adalah ...',
                'options' => [
                    ['text' => 'Semua warga Perumahan Graha Indah wajib mengenakan seragam', 'is_correct' => false],
                    ['text' => 'Beberapa anggota baru klub tenis bukan warga Perumahan Graha Indah', 'is_correct' => false],
                    ['text' => 'Semua warga Perumahan Graha Indah menjadi anggota baru klub tenis', 'is_correct' => false],
                    ['text' => 'Sebagian yang mengenakan seragam adalah anggota baru klub tenis', 'is_correct' => false],
                    ['text' => 'Beberapa warga Perumahan Graha Indah wajib mengenakan seragam', 'is_correct' => true],
                ],
                'explanation' => 'Dikatakan bahwa beberapa warga Perumahan Graha Indah adalah anggota baru klub tenis, dan semua anggota baru klub tenis wajib mengenakan seragam. Oleh karena itu, beberapa warga Perumahan Graha Indah yang menjadi anggota baru klub tenis wajib mengenakan seragam.',
            ],
            // Soal 8
            [
                'question_text' => 'Semua warga yang tinggal di Kompleks Vinus mempunyai taman bunga. Tidak ada anggota Komunitas X yang mempunyai taman bunga. Simpulan yang tepat dari pernyataan di atas adalah ...',
                'options' => [
                    ['text' => 'Tidak ada anggota Komunitas X yang tinggal di Kompleks Vinus', 'is_correct' => true],
                    ['text' => 'Beberapa anggota Komunitas X tidak tinggal di Kompleks Vinus', 'is_correct' => false],
                    ['text' => 'Beberapa anggota Komunitas X tidak mempunyai taman bunga', 'is_correct' => false],
                    ['text' => 'Semua warga di Kompleks Vinus tidak boleh menjadi anggota Komunitas X', 'is_correct' => false],
                    ['text' => 'Semua anggota Komunitas X tidak mempunyai taman bunga', 'is_correct' => false],
                ],
                'explanation' => 'Premis 1: Warga Kompleks Vinus → punya taman bunga<br>Premis 2: Anggota Komunitas X → tidak punya taman bunga (kontraposisi: punya taman bunga → bukan anggota Komunitas X)<br>Maka: Tidak ada anggota Komunitas X yang tinggal di Kompleks Vinus.',
            ],
            // Soal 9
            [
                'question_text' => 'Tidak ada peserta arisan yang datang terlambat. Semua anggota PKK datang terlambat. Simpulan yang tepat atas pernyataan di atas adalah ...',
                'options' => [
                    ['text' => 'Semua yang datang terlambat merupakan anggota PKK sekaligus peserta arisan', 'is_correct' => false],
                    ['text' => 'Tidak ada anggota PKK yang tidak datang terlambat', 'is_correct' => false],
                    ['text' => 'Tidak ada anggota PKK yang menjadi peserta arisan', 'is_correct' => true],
                    ['text' => 'Sebagian peserta arisan adalah anggota PKK', 'is_correct' => false],
                    ['text' => 'Sebagian yang datang terlambat bukan anggota PKK', 'is_correct' => false],
                ],
                'explanation' => 'Dikatakan bahwa tidak ada peserta arisan yang datang terlambat, sementara semua anggota PKK datang terlambat. Oleh karena itu, dapat disimpulkan bahwa tidak ada anggota PKK yang menjadi peserta arisan.',
            ],
            // Soal 10
            [
                'question_text' => 'Seorang pelayan restoran sedang menyusun urutan makanan khas Nusantara di meja hidangan berdasarkan urutan makanan yang paling disukai oleh pelanggan restoran tersebut. Sop buntut lebih disukai daripada nasi goreng. Rendang dan tempe sama-sama disukai, tetapi sop buntut lebih disukai daripada rendang dan tempe. Gado-gado lebih disukai daripada sop buntut, sedangkan rendang lebih disukai daripada nasi goreng. Urutan makanan yang harus disusun pelayan restoran berdasarkan makanan dari yang paling tidak disukai hingga yang paling disukai adalah ...',
                'options' => [
                    ['text' => 'nasi goreng, rendang/tempe, gado-gado, sop buntut', 'is_correct' => false],
                    ['text' => 'sop buntut, gado-gado, nasi goreng, rendang/tempe', 'is_correct' => false],
                    ['text' => 'nasi goreng, rendang/tempe, sop buntut, gado-gado', 'is_correct' => true],
                    ['text' => 'gado-gado, nasi goreng, rendang/tempe, sop buntut', 'is_correct' => false],
                    ['text' => 'gado-gado, sop buntut, rendang/tempe, nasi goreng', 'is_correct' => false],
                ],
                'explanation' => 'Urutan dari yang paling tidak disukai hingga yang paling disukai:<br>• Nasi goreng (paling rendah, karena sop buntut lebih disukai)<br>• Rendang/Tempe (disukai sama, lebih rendah dari sop buntut)<br>• Sop buntut (lebih disukai dari nasi goreng dan rendang/tempe)<br>• Gado-gado (paling disukai, lebih disukai dari sop buntut)',
            ],
            // Soal 11
            [
                'question_text' => 'Enam rangkaian buah diletakkan berhadapan. Buah mangga diletakkan di depan buah jambu. Buah naga diletakkan di sebelah kiri buah pepaya. Buah melon diletakkan di sebelah buah semangka dan di depan pepaya. Buah jambu ada di sebelah buah naga. Buah apa yang ada di depan buah semangka?',
                'options' => [
                    ['text' => 'Buah naga', 'is_correct' => false],
                    ['text' => 'Buah jambu', 'is_correct' => false],
                    ['text' => 'Buah mangga', 'is_correct' => false],
                    ['text' => 'Buah pepaya', 'is_correct' => false],
                    ['text' => 'Buah melon', 'is_correct' => true],
                ],
                'explanation' => 'Berdasarkan informasi posisi buah-buahan:<br>• Mangga di depan Jambu<br>• Melon di depan Pepaya dan di sebelah Semangka<br>• Jambu di sebelah Naga<br>• Naga di sebelah kiri Pepaya<br>Maka buah yang ada di depan Semangka adalah Melon.',
            ],
            // Soal 12
            [
                'question_text' => 'Setiap Jumat malam, beberapa warga menjaga kampung secara bergantian. Malam itu, 6 orang warga berjaga dan mereka duduk berkumpul di poskamling membentuk lingkaran. Pak Johan bersebelahan dengan Pak Riski dan Pak Nazar. Pak Subhan berseberangan dengan Pak Johan dan bersebelahan dengan Pak Tono dan Pak Rafa. Pak Tono duduk berdekatan dengan Pak Nazar. Siapakah yang duduknya berseberangan dengan Pak Rafa?',
                'options' => [
                    ['text' => 'Riski', 'is_correct' => false],
                    ['text' => 'Nazar', 'is_correct' => true],
                    ['text' => 'Tono', 'is_correct' => false],
                    ['text' => 'Subhan', 'is_correct' => false],
                    ['text' => 'Johan', 'is_correct' => false],
                ],
                'explanation' => 'Berdasarkan informasi posisi duduk dalam lingkaran:<br>• Pak Johan bersebelahan dengan Riski dan Nazar<br>• Pak Subhan berseberangan dengan Johan, bersebelahan dengan Tono dan Rafa<br>• Pak Tono berdekatan dengan Nazar<br>Setelah dianalisis, yang berseberangan dengan Pak Rafa adalah Pak Nazar.',
            ],
            // Soal 13
            [
                'question_text' => 'Toko merah memiliki tiga cabang A, B, dan C. Ada 6 karyawan yang dibagi tiga pasang. Mereka bertugas setiap Senin, Rabu, dan Jumat di dua toko dari cabang yang ada. Pada hari Senin, Mila dan Dita berjaga di toko A. Yeni dan Rita berjaga di toko B pada hari Rabu. Leni dan Hani berjaga di toko B pada hari Jumat. Pada hari Senin dan Jumat, pasangan yang sama akan berjaga di toko yang sama, tetapi di hari Rabu setiap pasangan bertugas di toko yang berbeda dari dua hari yang lain. Pasangan siapakah yang bertugas di toko C pada hari Rabu?',
                'options' => [
                    ['text' => 'Yeni dan Rita', 'is_correct' => false],
                    ['text' => 'Leni dan Hani', 'is_correct' => false],
                    ['text' => 'Leni dan Mita', 'is_correct' => false],
                    ['text' => 'Mita dan Dita', 'is_correct' => true],
                    ['text' => 'Mita dan Hani', 'is_correct' => false],
                ],
                'explanation' => 'Informasi:<br>• Senin: Mila dan Dita di toko A<br>• Rabu: Yeni dan Rita di toko B<br>• Jumat: Leni dan Hani di toko B<br>Pada Rabu, pasangan yang bertugas di toko yang berbeda dari Senin dan Jumat. Pasangan yang tidak disebutkan pada hari Rabu adalah Mita dan Dita, berarti mereka bertugas di toko C pada hari Rabu.',
            ],
            // Soal 14
            [
                'question_text' => '\\(7 + 1\\frac{3}{4} - 0,75 = ...\\)',
                'options' => [
                    ['text' => '4,5', 'is_correct' => false],
                    ['text' => '6', 'is_correct' => false],
                    ['text' => '8', 'is_correct' => true],
                    ['text' => '9,5', 'is_correct' => false],
                    ['text' => '12', 'is_correct' => false],
                ],
                'explanation' => '\\(7 + 1\\frac{3}{4} = 8\\frac{3}{4} = 8,75\\)<br>\\(8,75 - 0,75 = 8\\)',
            ],
            // Soal 15
            [
                'question_text' => '\\(4 - 8 + 2 - 2 + 0,5 \\times 12 = ...\\)',
                'options' => [
                    ['text' => '8', 'is_correct' => false],
                    ['text' => '-8', 'is_correct' => false],
                    ['text' => '-4', 'is_correct' => false],
                    ['text' => '2', 'is_correct' => false],
                    ['text' => '4', 'is_correct' => false],
                ],
                'explanation' => '\\(4 - 8 = -4\\)<br>\\(-4 + 2 = -2\\)<br>\\(-2 - 2 = -4\\)<br>\\(0,5 \\times 12 = 6\\)<br>\\(-4 + 6 = 2\\)',
            ],
            // Soal 16
            [
                'question_text' => '\\(7\\frac{10}{11} + 3\\frac{4}{5} - (10\\frac{2}{11} - 4\\frac{3}{13}) \\times 12 = ...\\)',
                'options' => [
                    ['text' => '-71\\frac{295}{715}', 'is_correct' => false],
                    ['text' => '71\\frac{295}{715}', 'is_correct' => false],
                    ['text' => '-59\\frac{503}{715}', 'is_correct' => true],
                    ['text' => '59\\frac{503}{715}', 'is_correct' => false],
                    ['text' => '60.703', 'is_correct' => false],
                ],
                'explanation' => 'Hitung operasi dalam kurung terlebih dahulu, lalu perkalian, baru penjumlahan dan pengurangan. Hasilnya adalah \\(-59\\frac{503}{715}\\).',
            ],
            // Soal 17
            [
                'question_text' => '14, 11, 8, 5, 2, -1, -4, ..., ...',
                'options' => [
                    ['text' => '-5, -6', 'is_correct' => false],
                    ['text' => '-5, -7', 'is_correct' => false],
                    ['text' => '-6, -9', 'is_correct' => false],
                    ['text' => '-7, -9', 'is_correct' => false],
                    ['text' => '-7, -10', 'is_correct' => true],
                ],
                'explanation' => 'Pola: dikurangi 3 setiap suku.<br>14 - 3 = 11<br>11 - 3 = 8<br>8 - 3 = 5<br>5 - 3 = 2<br>2 - 3 = -1<br>-1 - 3 = -4<br>-4 - 3 = -7<br>-7 - 3 = -10',
            ],
            // Soal 18
            [
                'question_text' => '4, -12, 36, -108, 324, -972, 2916, ......',
                'options' => [
                    ['text' => '-8.748, 26.244', 'is_correct' => true],
                    ['text' => '-8.748, 17.496', 'is_correct' => false],
                    ['text' => '-5.832, 17.496', 'is_correct' => false],
                    ['text' => '5.832, -17.496', 'is_correct' => false],
                    ['text' => '8.748, -26.244', 'is_correct' => false],
                ],
                'explanation' => 'Pola: dikali -3 setiap suku.<br>4 × (-3) = -12<br>-12 × (-3) = 36<br>36 × (-3) = -108<br>...<br>2916 × (-3) = -8.748<br>-8.748 × (-3) = 26.244',
            ],
            // Soal 19
            [
                'question_text' => '81, 162, 54, 108, 36, 72, 24, ..., ...',
                'options' => [
                    ['text' => '48, 16', 'is_correct' => true],
                    ['text' => '18, 32', 'is_correct' => false],
                    ['text' => '15, 32', 'is_correct' => false],
                    ['text' => '15, 18', 'is_correct' => false],
                    ['text' => '8, 18', 'is_correct' => false],
                ],
                'explanation' => 'Pola: suku ganjil: 81, 54, 36, 24 (dibagi 1,5? sebenarnya 81×2=162, 162÷3=54, 54×2=108, 108÷3=36, 36×2=72, 72÷3=24, 24×2=48, 48÷3=16)',
            ],
            // Soal 20
            [
                'question_text' => '12, 14, 18, 17, 19, 23, 22, ..., ...',
                'options' => [
                    ['text' => '22, 24', 'is_correct' => false],
                    ['text' => '22, 28', 'is_correct' => false],
                    ['text' => '24, 23', 'is_correct' => false],
                    ['text' => '24, 27', 'is_correct' => false],
                    ['text' => '24, 28', 'is_correct' => true],
                ],
                'explanation' => 'Pola: +2, +4, -1, +2, +4, -1, +2, +4<br>12 + 2 = 14<br>14 + 4 = 18<br>18 - 1 = 17<br>17 + 2 = 19<br>19 + 4 = 23<br>23 - 1 = 22<br>22 + 2 = 24<br>24 + 4 = 28',
            ],
            // Soal 21
            [
                'question_text' => 'Perhatikan tabel di bawah ini!<br><br>
<table style="border-collapse:collapse; border:1px solid #000; width:50%; margin:auto;">
    <tr style="background:#f2f2f2;">
        <th style="border:1px solid #000; padding:8px;">X</th>
        <th style="border:1px solid #000; padding:8px;">Y</th>
    </tr>
    <tr>
        <td style="border:1px solid #000; padding:8px; text-align:center;">363 : 3</td>
        <td style="border:1px solid #000; padding:8px; text-align:center;">12 × 12</td>
    </tr>
</table><br>
Operasi bilangan yang benar adalah ...',
                'options' => [
                    ['text' => 'X > Y', 'is_correct' => false],
                    ['text' => 'X = Y', 'is_correct' => false],
                    ['text' => 'X² = Y', 'is_correct' => false],
                    ['text' => 'X < Y', 'is_correct' => true],
                    ['text' => 'X = 2Y', 'is_correct' => false],
                ],
                'explanation' => 'X = 363 ÷ 3 = 121<br>Y = 12 × 12 = 144<br>Maka X < Y',
            ],
            // Soal 22
            [
                'question_text' => 'Perhatikan tabel di bawah ini!<br><br>
<table style="border-collapse:collapse; border:1px solid #000; width:70%; margin:auto;">
    <tr style="background:#f2f2f2;">
        <th style="border:1px solid #000; padding:8px;">A</th>
        <th style="border:1px solid #000; padding:8px;">B</th>
    </tr>
    <tr>
        <td style="border:1px solid #000; padding:8px;">Pak Budi membeli baju seharga Rp35.000,00 dan ingin menjualnya kembali dengan keuntungan 30%. Maka, Pak Budi akan mendapat keuntungan .... rupiah.</td>
        <td style="border:1px solid #000; padding:8px;">Rp15.000,00</td>
     </tr>
</table><br>
Hubungan A dan B yang tepat adalah ...',
                'options' => [
                    ['text' => 'A > B', 'is_correct' => false],
                    ['text' => 'A = B', 'is_correct' => false],
                    ['text' => '2A = B', 'is_correct' => false],
                    ['text' => 'A < B', 'is_correct' => false],
                    ['text' => '3A = 2B', 'is_correct' => false],
                ],
                'explanation' => 'Keuntungan = 30% × 35.000 = 0,3 × 35.000 = 10.500<br>A = 10.500, B = 15.000<br>Maka A < B',
            ],
            // Soal 23
            [
                'question_text' => 'Perhatikan tabel di bawah ini!<br><br>
<table style="border-collapse:collapse; border:1px solid #000; width:50%; margin:auto;">
    <tr style="background:#f2f2f2;">
        <th style="border:1px solid #000; padding:8px;">P</th>
        <th style="border:1px solid #000; padding:8px;">Q</th>
     </tr>
    <tr>
        <td style="border:1px solid #000; padding:8px; text-align:center;">18x - 27y</td>
        <td style="border:1px solid #000; padding:8px; text-align:center;">9x - 40y</td>
     </tr>
</table><br>
Jika x = 3 dan y = 2, pernyataan berikut yang benar adalah ...',
                'options' => [
                    ['text' => 'P < Q', 'is_correct' => false],
                    ['text' => 'P = 2Q', 'is_correct' => false],
                    ['text' => 'P > Q', 'is_correct' => true],
                    ['text' => 'P = ½ Q', 'is_correct' => false],
                    ['text' => 'P = ⅓ Q', 'is_correct' => false],
                ],
                'explanation' => 'P = 18(3) - 27(2) = 54 - 54 = 0<br>Q = 9(3) - 40(2) = 27 - 80 = -53<br>Maka P > Q',
            ],
            // Soal 24
            [
                'question_text' => 'Suatu pekerjaan akan selesai dikerjakan oleh 24 orang selama 20 hari. Agar pekerjaan tersebut dapat diselesaikan selama 15 hari, banyak tambahan pekerja yang diperlukan adalah ...',
                'options' => [
                    ['text' => '6 orang', 'is_correct' => false],
                    ['text' => '8 orang', 'is_correct' => true],
                    ['text' => '18 orang', 'is_correct' => false],
                    ['text' => '32 orang', 'is_correct' => false],
                    ['text' => '24 orang', 'is_correct' => false],
                ],
                'explanation' => 'Perbandingan berbalik nilai: 24 orang × 20 hari = n orang × 15 hari<br>n = (24 × 20) ÷ 15 = 480 ÷ 15 = 32 orang<br>Tambahan pekerja = 32 - 24 = 8 orang',
            ],
            // Soal 25
            [
                'question_text' => 'Jika seekor macan bisa menempuh jarak 100 km dalam waktu 2 jam, berapa jauh jarak yang dapat ditempuh macan itu apabila berlari selama 6 jam?',
                'options' => [
                    ['text' => '180 km', 'is_correct' => false],
                    ['text' => '200 km', 'is_correct' => false],
                    ['text' => '220 km', 'is_correct' => false],
                    ['text' => '300 km', 'is_correct' => true],
                    ['text' => '250 km', 'is_correct' => false],
                ],
                'explanation' => 'Kecepatan = 100 km / 2 jam = 50 km/jam<br>Jarak selama 6 jam = 50 × 6 = 300 km',
            ],
            // Soal 26
            [
                'question_text' => 'Berikut adalah data mahasiswa dengan rata-rata IPKnya di Universitas P dan Universitas Q pada lima tahun terakhir.<br><br>
<table style="border-collapse:collapse; border:1px solid #000; width:70%; margin:auto;">
    <tr style="background:#f2f2f2;">
        <th style="border:1px solid #000; padding:8px;">Tahun</th>
        <th style="border:1px solid #000; padding:8px;">Universitas P</th>
        <th style="border:1px solid #000; padding:8px;">Universitas Q</th>
     </tr>
    <tr><td style="border:1px solid #000; padding:8px;">2016</td><td style="border:1px solid #000; padding:8px;">3,21</td><td style="border:1px solid #000; padding:8px;">3,04</td></tr>
    <tr><td style="border:1px solid #000; padding:8px;">2017</td><td style="border:1px solid #000; padding:8px;">3,15</td><td style="border:1px solid #000; padding:8px;">3,15</td></tr>
    <tr><td style="border:1px solid #000; padding:8px;">2018</td><td style="border:1px solid #000; padding:8px;">3,17</td><td style="border:1px solid #000; padding:8px;">3,19</td></tr>
    <tr><td style="border:1px solid #000; padding:8px;">2019</td><td style="border:1px solid #000; padding:8px;">3,25</td><td style="border:1px solid #000; padding:8px;">3,25</td></tr>
    <tr><td style="border:1px solid #000; padding:8px;">2020</td><td style="border:1px solid #000; padding:8px;">3,20</td><td style="border:1px solid #000; padding:8px;">3,30</td></tr>
</table><br>
Simpulan paling tepat yang dapat diambil dari data di atas adalah ...',
                'options' => [
                    ['text' => 'Universitas Q menunjukkan peningkatan IPK yang tidak konsisten dibandingkan Universitas P', 'is_correct' => false],
                    ['text' => 'Universitas P menunjukkan IPK yang rata-rata lebih rendah dibandingkan Universitas Q', 'is_correct' => false],
                    ['text' => 'Universitas P menunjukkan peningkatan IPK yang konsisten dibandingkan Universitas Q', 'is_correct' => false],
                    ['text' => 'Universitas Q memiliki rata-rata IPK yang lebih rendah dibandingkan Universitas P', 'is_correct' => true],
                    ['text' => 'Universitas Q awalnya lebih unggul dibandingkan Universitas P dilihat dari rata-rata IPKnya', 'is_correct' => false],
                ],
                'explanation' => 'Berdasarkan data, IPK Universitas P cenderung konsisten, sedangkan Universitas Q awalnya lebih rendah dari P (3,04 < 3,21) namun kemudian meningkat. Secara keseluruhan, rata-rata IPK Universitas P lebih tinggi dari Universitas Q.',
            ],
            // Soal 27
            [
                'question_text' => 'Dalam sebuah pertandingan sepakbola, Kevin harus mengoper bola ke beberapa pemain agar dapat menayangkan bola ke gawang lawan. Di dekat gawang ada Zidan, Kevin bisa mengoper ke Brian, Deni, dan Ferdi. Brian bisa mengoper ke Gilang, Gilang bisa mengoper ke Zidan. Sementara itu, Deni bisa mengoper ke Hadi dan Ferdi. Namun, Ferdi tidak bisa mengoper ke Hadi. Sedangkan Hadi bisa mengoper ke Zidan. Ada berapa alternatif jalur yang bisa ditempuh agar bola dapat sampai dari Kevin ke Zidan?',
                'options' => [
                    ['text' => '1 cara', 'is_correct' => false],
                    ['text' => '2 cara', 'is_correct' => false],
                    ['text' => '3 cara', 'is_correct' => false],
                    ['text' => '4 cara', 'is_correct' => false],
                    ['text' => '5 cara', 'is_correct' => false],
                ],
                'explanation' => 'Jalur yang mungkin:<br>1. Kevin → Brian → Gilang → Zidan<br>2. Kevin → Deni → Hadi → Zidan<br>3. Kevin → Deni → Ferdi → ... (Ferdi tidak bisa ke Hadi, jadi tidak sampai ke Zidan)<br>Jadi total 2 cara? Tapi dari Kevin langsung tidak bisa, karena harus melalui pemain lain. Jawaban sebenarnya adalah 2 cara.',
            ],
            // Soal 28
            [
                'question_text' => 'Dalam sebuah permainan bola tangan, Lutfia harus mengoper bola ke beberapa pemain agar dapat menayangkan bola ke gawang lawan. Di dekat gawang ada Kiki, Lutfia bisa mengoper bola ke Evi, Gita, dan Sasma. Evi dan Gita bisa mengoper bola ke Zahara, tetapi tidak bisa ke Nay. Sasma bisa mengoper bola ke arah Ais. Nay tidak bisa mengoper bola ke Kiki, sedangkan Zahara dan Ais bisa mengoper bola ke Kiki sehingga Kiki bisa melakukan shot ke arah gawang lawan. Ada berapa alternatif jalur yang bisa ditempuh agar bola dapat sampai dari Lutfia ke Kiki?',
                'options' => [
                    ['text' => '5 cara', 'is_correct' => false],
                    ['text' => '4 cara', 'is_correct' => false],
                    ['text' => '3 cara', 'is_correct' => false],
                    ['text' => '2 cara', 'is_correct' => false],
                    ['text' => '1 cara', 'is_correct' => false],
                ],
                'explanation' => 'Jalur yang mungkin: Lutfia → Evi → Zahara → Kiki<br>Lutfia → Gita → Zahara → Kiki<br>Lutfia → Sasma → Ais → Kiki<br>Total 3 cara.',
            ],
            // Soal 29 (soal gambar)
            [
                'question_text' => 'Ini soal nomor 29 (soal gambar). Carilah gambar yang bisa melengkapi kotak di bawah.',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 29', 'is_correct' => false],
                    ['text' => 'Ini opsi B soal nomor 29', 'is_correct' => false],
                    ['text' => 'Ini opsi C soal nomor 29', 'is_correct' => false],
                    ['text' => 'Ini opsi D soal nomor 29', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 29', 'is_correct' => true],
                ],
                'explanation' => 'Gambar yang tepat untuk melengkapi adalah E.',
            ],
            // Soal 30 (soal gambar)
            [
                'question_text' => 'Ini soal nomor 30 (soal gambar). Carilah gambar yang cocok untuk melengkapi tabel berikut.',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 30', 'is_correct' => true],
                    ['text' => 'Ini opsi B soal nomor 30', 'is_correct' => false],
                    ['text' => 'Ini opsi C soal nomor 30', 'is_correct' => false],
                    ['text' => 'Ini opsi D soal nomor 30', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 30', 'is_correct' => false],
                ],
                'explanation' => 'Gambar yang cocok untuk melengkapi adalah A.',
            ],
            // Soal 31 (soal gambar)
            [
                'question_text' => 'Ini soal nomor 31 (soal gambar). Carilah gambar yang cocok untuk melengkapi tabel berikut.',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 31', 'is_correct' => false],
                    ['text' => 'Ini opsi B soal nomor 31', 'is_correct' => true],
                    ['text' => 'Ini opsi C soal nomor 31', 'is_correct' => false],
                    ['text' => 'Ini opsi D soal nomor 31', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 31', 'is_correct' => false],
                ],
                'explanation' => 'Gambar yang cocok untuk melengkapi adalah B.',
            ],
            // Soal 32 (soal gambar)
            [
                'question_text' => 'Ini soal nomor 32 (soal gambar). Pilihlah gambar yang cocok untuk melengkapi gambar yang kosong.',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 32', 'is_correct' => false],
                    ['text' => 'Ini opsi B soal nomor 32', 'is_correct' => false],
                    ['text' => 'Ini opsi C soal nomor 32', 'is_correct' => true],
                    ['text' => 'Ini opsi D soal nomor 32', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 32', 'is_correct' => false],
                ],
                'explanation' => 'Gambar yang cocok untuk melengkapi adalah C.',
            ],
            // Soal 33 (soal gambar)
            [
                'question_text' => 'Ini soal nomor 33 (soal gambar). Disajikan dua pasangan gambar. Carilah dari pilihan jawaban di bawah ini yang merupakan pengganti tanda tanya yang memiliki logika yang sama dengan pasangan gambar yang lengkap.',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 33', 'is_correct' => false],
                    ['text' => 'Ini opsi B soal nomor 33', 'is_correct' => true],
                    ['text' => 'Ini opsi C soal nomor 33', 'is_correct' => false],
                    ['text' => 'Ini opsi D soal nomor 33', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 33', 'is_correct' => false],
                ],
                'explanation' => 'Gambar yang tepat adalah B.',
            ],
            // Soal 34 (soal gambar)
            [
                'question_text' => 'Ini soal nomor 34 (soal gambar). Diantara lima pilihan gambar yang disajikan, carilah satu gambar yang tidak memiliki kesamaan pola dengan empat gambar yang lain.',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 34', 'is_correct' => false],
                    ['text' => 'Ini opsi B soal nomor 34', 'is_correct' => true],
                    ['text' => 'Ini opsi C soal nomor 34', 'is_correct' => false],
                    ['text' => 'Ini opsi D soal nomor 34', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 34', 'is_correct' => false],
                ],
                'explanation' => 'Gambar yang tidak memiliki kesamaan pola adalah B.',
            ],
            // Soal 35 (soal gambar)
            [
                'question_text' => 'Ini soal nomor 35 (soal gambar). Carilah dari lima pilihan jawaban yang dapat melengkapi seri gambar berikut ini.',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 35', 'is_correct' => true],
                    ['text' => 'Ini opsi B soal nomor 35', 'is_correct' => false],
                    ['text' => 'Ini opsi C soal nomor 35', 'is_correct' => false],
                    ['text' => 'Ini opsi D soal nomor 35', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 35', 'is_correct' => false],
                ],
                'explanation' => 'Gambar yang dapat melengkapi seri adalah A.',
            ],
        ];

        // Insert all questions
        foreach ($questions as $index => $question) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $materialId,
                'type' => 'mcq',
                'test_type' => 'tiu',
                'question_text' => $question['question_text'],
                'explanation' => $question['explanation'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            foreach ($question['options'] as $order => $option) {
                DB::table('question_options')->insert([
                    'question_id' => $questionId,
                    'option_text' => $option['text'],
                    'is_correct' => $option['is_correct'],
                    'order' => $order + 1,
                    'weight' => 0,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('Seeder TIU 2 Juni (35 soal) berhasil dijalankan!');
        $this->command->info('Material ID: ' . $materialId);
        $this->command->info('Total soal: ' . count($questions));
    }
}
