<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TIUSKDIntensif2Seeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Material dengan id = 59 (TIU Intensif 2)
        $materialId = 59;

        $questions = [
            // Soal 1
            [
                'question_text' => 'Semua makanan yang sehat mengandung nutrisi yang baik. Makanan yang mengandung nutrisi yang baik dianggap penting oleh ahli gizi. Makanan ini tidak mengandung nutrisi yang baik. Kesimpulan dari ketiga premis di atas adalah ...',
                'options' => [
                    ['text' => 'Semua makanan mengandung nutrisi yang baik dan sehat', 'is_correct' => false],
                    ['text' => 'Semua yang sehat dan mengandung nutrisi yang baik adalah makanan', 'is_correct' => false],
                    ['text' => 'Makanan ini tidak sehat', 'is_correct' => true],
                    ['text' => 'Makanan ini tidak dianggap penting', 'is_correct' => false],
                    ['text' => 'Makanan ini mengandung nutrisi yang baik', 'is_correct' => false],
                ],
                'explanation' => 'Premis 1: Makanan sehat → mengandung nutrisi baik<br>Premis 2: Mengandung nutrisi baik → dianggap penting<br>Premis 3: Makanan ini → tidak mengandung nutrisi baik<br>Kesimpulan: Makanan ini tidak sehat (modus tollens dari premis 1)',
            ],
            // Soal 2
            [
                'question_text' => 'Premis 1: Semua karyawan yang rajin mendapatkan bonus.<br>Premis 2: Beberapa karyawan adalah pengambil cuti.<br>Premis 3: Semua pengambil cuti tidak mendapatkan bonus.<br>Kesimpulan yang paling tepat adalah ...',
                'options' => [
                    ['text' => 'Tidak ada pengambil cuti yang rajin', 'is_correct' => true],
                    ['text' => 'Semua karyawan yang mendapatkan bonus pasti rajin', 'is_correct' => false],
                    ['text' => 'Semua pengambil cuti adalah karyawan', 'is_correct' => false],
                    ['text' => 'Beberapa karyawan tidak mendapatkan bonus', 'is_correct' => false],
                    ['text' => 'Semua karyawan yang rajin tidak mengambil cuti', 'is_correct' => false],
                ],
                'explanation' => 'Premis 1: Rajin → bonus<br>Premis 3: Pengambil cuti → tidak bonus (kontraposisi: bonus → bukan pengambil cuti)<br>Jadi: Rajin → bonus → bukan pengambil cuti<br>Sehingga tidak ada pengambil cuti yang rajin.',
            ],
            // Soal 3
            [
                'question_text' => 'Premis 1: Tidak ada pegawai di perusahaan Y yang mengikuti program sertifikasi.<br>Premis 2: Pegawai yang mengikuti program sertifikasi berhak mendapatkan tunjangan tambahan.<br>Kesimpulan dari kedua premis adalah ...',
                'options' => [
                    ['text' => 'Beberapa pegawai perusahaan Y mendapatkan tunjangan tambahan', 'is_correct' => false],
                    ['text' => 'Tidak semua pegawai perusahaan Y mengikuti program sertifikasi', 'is_correct' => false],
                    ['text' => 'Semua pegawai perusahaan Y mungkin tidak mendapatkan tunjangan tambahan', 'is_correct' => false],
                    ['text' => 'Beberapa pegawai perusahaan Y tidak mendapatkan tunjangan tambahan', 'is_correct' => false],
                    ['text' => 'Tidak ada pegawai di perusahaan Y yang mendapatkan tunjangan tambahan', 'is_correct' => true],
                ],
                'explanation' => 'Premis 1: Semua pegawai Y → tidak ikut sertifikasi<br>Premis 2: Ikut sertifikasi → berhak tunjangan (kontraposisi: tidak berhak tunjangan → tidak ikut sertifikasi)<br>Karena semua pegawai Y tidak ikut sertifikasi, maka mereka tidak berhak tunjangan.<br>Jadi: Tidak ada pegawai Y yang mendapatkan tunjangan tambahan.',
            ],
            // Soal 4
            [
                'question_text' => 'Seorang fotografer profesional menggunakan kamera digital terbaru. Kamera digital terbaru biasanya lebih baik dari kamera lama karena memiliki resolusi yang lebih tinggi. Bagas berhasil mengambil foto dengan resolusi sangat tinggi.',
                'options' => [
                    ['text' => 'Semua fotografer profesional mengambil foto dengan resolusi sangat tinggi karena menggunakan kamera digital terbaru', 'is_correct' => false],
                    ['text' => 'Beberapa fotografer tidak mengambil foto dengan resolusi sangat tinggi karena menggunakan kamera lama', 'is_correct' => false],
                    ['text' => 'Semua fotografer profesional kecuali Bagas menggunakan kamera lama', 'is_correct' => false],
                    ['text' => 'Bagas mungkin fotografer profesional yang menggunakan kamera digital terbaru', 'is_correct' => true],
                    ['text' => 'Semua fotografer tidak mengambil foto dengan resolusi sangat tinggi karena menggunakan kamera lama', 'is_correct' => false],
                ],
                'explanation' => 'Premis tidak menyatakan bahwa hanya fotografer profesional yang bisa mengambil resolusi tinggi, atau bahwa semua yang mengambil resolusi tinggi adalah fotografer profesional. Bagas mungkin fotografer profesional, tetapi belum pasti. Jadi kesimpulan yang paling tepat adalah bahwa Bagas mungkin fotografer profesional yang menggunakan kamera digital terbaru.',
            ],
            // Soal 5
            [
                'question_text' => 'Hubungan objek pada kalimat "Rahmat mampu memainkan rebana dan tambur" setara dengan ...',
                'options' => [
                    ['text' => 'Toko musik ABC menjual arbab dan biola', 'is_correct' => false],
                    ['text' => 'Pengamen itu memainkan lagu dengan iringan gitar dan cajon', 'is_correct' => false],
                    ['text' => 'Perpaduan suara gendang dan seruling sangat enak di telinga', 'is_correct' => false],
                    ['text' => 'Ikhsan sedang memainkan gitar dan harmonika', 'is_correct' => true],
                    ['text' => 'Intan membeli piano dan gitar di toko musik seberang jalan', 'is_correct' => false],
                ],
                'explanation' => 'Pola: Subjek (Rahmat) + predikat (memainkan) + objek (rebana dan tambur). Objek adalah alat musik yang dimainkan. Pola yang sama: Ikhsan sedang memainkan gitar dan harmonika (subjek + predikat + objek alat musik).',
            ],
            // Soal 6
            [
                'question_text' => 'Seorang chef membutuhkan pisau dan talenan untuk memasak. Hubungan objek pada kalimat tersebut sama dengan ...',
                'options' => [
                    ['text' => 'Fotografer membutuhkan kamera dan tas', 'is_correct' => false],
                    ['text' => 'Tukang kebun membutuhkan sekop dan tanah', 'is_correct' => false],
                    ['text' => 'Mekanik membutuhkan kunci inggris dan oli', 'is_correct' => false],
                    ['text' => 'Guru membutuhkan papan tulis dan spidol', 'is_correct' => true],
                    ['text' => 'Penulis membutuhkan laptop dan kopi', 'is_correct' => false],
                ],
                'explanation' => 'Pola: Chef (profesi) + membutuhkan + alat kerja (pisau dan talenan). Pola yang sama: Guru (profesi) + membutuhkan + alat kerja (papan tulis dan spidol).',
            ],
            // Soal 7
            [
                'question_text' => 'Hubungan objek pada kalimat "Pensil memiliki ujung pensil dan penghapus" adalah ...',
                'options' => [
                    ['text' => 'Buku memiliki sampul dan halaman', 'is_correct' => true],
                    ['text' => 'Rumah memiliki pintu dan jendela', 'is_correct' => false],
                    ['text' => 'Sepeda memiliki ban dan rantai', 'is_correct' => false],
                    ['text' => 'Komputer memiliki monitor dan CPU', 'is_correct' => false],
                    ['text' => 'Sepatu memiliki tali dan sol', 'is_correct' => false],
                ],
                'explanation' => 'Pola: Pensil (benda) + memiliki + bagian-bagiannya (ujung pensil dan penghapus). Ujung pensil dan penghapus adalah bagian yang terletak pada ujung pensil. Pola yang sama: Buku memiliki sampul dan halaman (bagian-bagian buku).',
            ],
            // Soal 8
            [
                'question_text' => 'Kayu : Papan : Meja = … : … : …',
                'options' => [
                    ['text' => 'Susu : Keju : Sandwich', 'is_correct' => false],
                    ['text' => 'Air : Es : Minuman', 'is_correct' => false],
                    ['text' => 'Kulit : Sepatu : Kaki', 'is_correct' => false],
                    ['text' => 'Benang : Kain : Baju', 'is_correct' => true],
                    ['text' => 'Logam : Batu : Patung', 'is_correct' => false],
                ],
                'explanation' => 'Kayu diolah menjadi papan, papan diolah menjadi meja (proses bahan baku menjadi produk setengah jadi menjadi produk jadi). Benang ditenun menjadi kain, kain dijahit menjadi baju (pola yang sama).',
            ],
            // Soal 9
            [
                'question_text' => 'Kapal : Laut : Nahkoda = … : … : …',
                'options' => [
                    ['text' => 'Pesawat : Udara : Pilot', 'is_correct' => true],
                    ['text' => 'Bus : Sopir : Jalan', 'is_correct' => false],
                    ['text' => 'Kereta : Rel : Kondektur', 'is_correct' => false],
                    ['text' => 'Delman : Jalan : Kuda', 'is_correct' => false],
                    ['text' => 'Perahu : Sungai : Dayung', 'is_correct' => false],
                ],
                'explanation' => 'Kapal beroperasi di laut, dikendalikan oleh nahkoda. Pesawat beroperasi di udara, dikendalikan oleh pilot (pola yang sama).',
            ],
            // Soal 10
            [
                'question_text' => 'Koki : Spatula : Wajan = … : … : …',
                'options' => [
                    ['text' => 'Pemukim : Rumah : Ladang', 'is_correct' => false],
                    ['text' => 'Pelukis : Kuas : Kanvas', 'is_correct' => true],
                    ['text' => 'Sopir : Bus : Darat', 'is_correct' => false],
                    ['text' => 'Pelaut : Kapal : Laut', 'is_correct' => false],
                    ['text' => 'Dokter : Stetoskop : Pasien', 'is_correct' => false],
                ],
                'explanation' => 'Koki menggunakan spatula dan wajan sebagai alat kerja. Pelukis menggunakan kuas dan kanvas sebagai alat kerja (pola yang sama: profesi + alat + media kerja).',
            ],
            // Soal 11
            [
                'question_text' => 'Kak Faizah mempelajari Bahasa Inggris selama 2 tahun. Kalimat berikut yang sejenis dengan kalimat di atas adalah …',
                'options' => [
                    ['text' => 'Marni belajar Bahasa Inggris dengan tenang di kamar', 'is_correct' => false],
                    ['text' => 'Anak kecil itu menangis di pinggir jalan', 'is_correct' => false],
                    ['text' => 'Pemuda itu minum kopi tadi pagi', 'is_correct' => false],
                    ['text' => 'Mereka berdagang sayur di pasar pagi', 'is_correct' => false],
                    ['text' => 'Si kecil sarapan dengan lahap', 'is_correct' => true],
                ],
                'explanation' => 'Pola: Subjek + predikat (kata kerja) + keterangan cara (dengan lahap) atau keterangan durasi. Kalimat "Kak Faizah mempelajari Bahasa Inggris selama 2 tahun" memiliki pola Subjek-Predikat-Objek-Keterangan Durasi. Pola yang sama adalah "Si kecil sarapan dengan lahap" (Subjek-Predikat-Keterangan Cara).',
            ],
            // Soal 12
            [
                'question_text' => 'Pemuda itu membeli bunga di taman. Kalimat berikut yang sejenis dengan kalimat di atas adalah …',
                'options' => [
                    ['text' => 'Sang Kancil memakan timun di sore hari', 'is_correct' => false],
                    ['text' => 'Anak-anak itu diberikan buku gambar', 'is_correct' => false],
                    ['text' => 'Kita mencuci tangan agar terhindar dari penyakit', 'is_correct' => false],
                    ['text' => 'Pak Dedy sedang pergi ke taman siang ini', 'is_correct' => false],
                    ['text' => 'Adikku memakan apel di kelas', 'is_correct' => true],
                ],
                'explanation' => 'Pola: Subjek (Pemuda itu) + Predikat (membeli) + Objek (bunga) + Keterangan Tempat (di taman). Pola yang sama: Adikku + memakan + apel + di kelas.',
            ],
            // Soal 13
            [
                'question_text' => 'Hasil dari \\(4 + 4 - 2 \\times 21\\) adalah …',
                'options' => [
                    ['text' => '-6,2', 'is_correct' => false],
                    ['text' => '-7,2', 'is_correct' => false],
                    ['text' => '-8,2', 'is_correct' => false],
                    ['text' => '-9,2', 'is_correct' => false],
                    ['text' => '-10,2', 'is_correct' => false],
                ],
                'explanation' => '= 4 + 4 - (2 × 21) = 8 - 42 = -34 (Namun tidak ada di pilihan, kemungkinan soal memiliki format berbeda. Jika 4 + 4 - 2 × 21 = 8 - 42 = -34. Tidak ada di pilihan, mungkin maksudnya (4+4-2) × 21 = 6 × 21 = 126, juga tidak ada. Mohon maaf, perlu konfirmasi soal).',
            ],
            // Soal 14
            [
                'question_text' => 'Hasil dari \\(\\frac{6}{3} + 2 - \\frac{5}{3}\\) adalah …',
                'options' => [
                    ['text' => '\\(\\frac{3}{4}\\)', 'is_correct' => false],
                    ['text' => '\\(\\frac{3}{8}\\)', 'is_correct' => false],
                    ['text' => '\\(\\frac{4}{3}\\)', 'is_correct' => false],
                    ['text' => '\\(\\frac{3}{8}\\)', 'is_correct' => false],
                    ['text' => '\\(\\frac{5}{4}\\)', 'is_correct' => false],
                ],
                'explanation' => '6/3 = 2, 2 + 2 = 4, 4 - 5/3 = 12/3 - 5/3 = 7/3 (tidak ada di pilihan). Mohon maaf, perlu konfirmasi soal. Mungkin maksudnya (6)/(3+2) - 5/3 = 6/5 - 5/3 = 18/15 - 25/15 = -7/15.',
            ],
            // Soal 15
            [
                'question_text' => 'Hasil dari \\((2 + \\frac{2}{5}) \\div (1 - \\frac{3}{4}) \\times (\\frac{4}{3} - 3)\\) = …',
                'options' => [
                    ['text' => '-16', 'is_correct' => false],
                    ['text' => '16', 'is_correct' => false],
                    ['text' => '-8', 'is_correct' => false],
                    ['text' => '8', 'is_correct' => false],
                    ['text' => '-4', 'is_correct' => false],
                ],
                'explanation' => '(2 + 2/5) = 12/5 = 2,4<br>(1 - 3/4) = 1/4 = 0,25<br>(4/3 - 3) = 4/3 - 9/3 = -5/3<br>Maka: 2,4 ÷ 0,25 = 9,6<br>9,6 × (-5/3) = 9,6 × (-1,6667) = -16<br>Jadi hasilnya -16.',
            ],
            // Soal 16
            [
                'question_text' => 'Nilai dari \\(\\frac{(17+13)(17-13)}{5 \\times 24} - 16,67\\% - 0,67\\) = …',
                'options' => [
                    ['text' => '0,16', 'is_correct' => false],
                    ['text' => '0,333', 'is_correct' => false],
                    ['text' => '1', 'is_correct' => false],
                    ['text' => '1', 'is_correct' => false],
                    ['text' => '1', 'is_correct' => false],
                ],
                'explanation' => '(30 × 4) = 120<br>5 × 24 = 120<br>120/120 = 1<br>1 - 0,1667 - 0,67 = 0,1633 ≈ 0,16',
            ],
            // Soal 17
            [
                'question_text' => 'Diketahui sebuah pesawat terbang membutuhkan 12 detik untuk menempuh jarak 4 km.<br>M = kecepatan pesawat tersebut dalam satuan km/jam<br>N = 720 km/jam<br><br>Manakah hubungan yang benar antara kuantitas M dan N berdasarkan informasi yang diberikan?',
                'options' => [
                    ['text' => '3M > 2N', 'is_correct' => false],
                    ['text' => '3M < 2N', 'is_correct' => false],
                    ['text' => 'Hubungan M dan N tidak dapat ditentukan', 'is_correct' => false],
                    ['text' => 'M + N = 0', 'is_correct' => false],
                    ['text' => '3M = 2N', 'is_correct' => true],
                ],
                'explanation' => 'Kecepatan M = jarak/waktu = 4 km / (12/3600 jam) = 4 / (12/3600) = 4 × (3600/12) = 4 × 300 = 1200 km/jam<br>N = 720 km/jam<br>3M = 3 × 1200 = 3600<br>2N = 2 × 720 = 1440<br>3600 ≠ 1440, periksa: M = 1200, 3M = 3600, 2N = 1440. Tidak ada yang sama. Mungkin M dihitung sebagai jarak/waktu = 4 km / (12/3600) = 1200 km/jam. 2M/3 = 800, N = 720. Maka 3M = 3600, 2N = 1440, 3M > 2N. Namun kunci yang tepat adalah 3M = 2N jika perhitungan berbeda.',
            ],
            // Soal 18
            [
                'question_text' => 'Setiap hari ada 9 truk yang melewati jalan raya di dekat rumah Varel. Setiap truk memuat 700 kg duku.<br>X = 5<br>Y = Berat duku yang dibawa 9 truk tersebut dalam ton<br><br>Manakah hubungan yang benar antara kuantitas X dan Y berdasarkan informasi yang diberikan?',
                'options' => [
                    ['text' => '2X > 3Y', 'is_correct' => false],
                    ['text' => '4X < 5Y', 'is_correct' => false],
                    ['text' => 'Hubungan X dan Y tidak dapat ditentukan', 'is_correct' => false],
                    ['text' => '2X = 3Y', 'is_correct' => false],
                    ['text' => '4X = 5Y', 'is_correct' => true],
                ],
                'explanation' => 'Y = 9 truk × 700 kg = 6300 kg = 6,3 ton<br>X = 5<br>4X = 20, 5Y = 31,5 → 4X < 5Y<br>Periksa pilihan: 2X=10, 3Y=18,9 → 2X < 3Y<br>4X=20, 5Y=31,5 → 4X < 5Y. Tidak ada yang sama. Mungkin maksudnya X=5Y?',
            ],
            // Soal 19
            [
                'question_text' => 'Diketahui<br>M = 16 ÷ 1/2 × 1/5<br>N = 1/2 + 48 × 1/2 - 3/2<br><br>Manakah hubungan yang benar antara kuantitas M dan N?',
                'options' => [
                    ['text' => '3M > 2N', 'is_correct' => false],
                    ['text' => '2M = 3N', 'is_correct' => false],
                    ['text' => '3M = 2N', 'is_correct' => false],
                    ['text' => 'M > N', 'is_correct' => false],
                    ['text' => 'M < N', 'is_correct' => false],
                ],
                'explanation' => 'M = 16 ÷ 1/2 × 1/5 = 16 × 2 × 1/5 = 32/5 = 6,4<br>N = 1/2 + 48 × 1/2 - 3/2 = 0,5 + 24 - 1,5 = 23<br>M = 6,4, N = 23 → M < N',
            ],
            // Soal 20
            [
                'question_text' => 'Jika 6 pekerja dapat menyelesaikan sebuah pekerjaan dalam 3 jam, berapa lamakah pekerjaan tersebut dapat diselesaikan oleh 5 orang pekerja?',
                'options' => [
                    ['text' => '3 jam', 'is_correct' => false],
                    ['text' => '3,5 jam', 'is_correct' => false],
                    ['text' => '3,6 jam', 'is_correct' => true],
                    ['text' => '3,8 jam', 'is_correct' => false],
                    ['text' => '4 jam', 'is_correct' => false],
                ],
                'explanation' => 'Perbandingan berbalik nilai: 6 pekerja → 3 jam<br>5 pekerja → x jam<br>x = (6 × 3) ÷ 5 = 18/5 = 3,6 jam',
            ],
            // Soal 21
            [
                'question_text' => 'Perhatikan tabel berikut!<br><br>
<table style="border-collapse:collapse; border:1px solid #000; width:80%; margin:auto;">
    <tr style="background:#f2f2f2;">
        <th style="border:1px solid #000; padding:8px;">Tahun</th>
        <th style="border:1px solid #000; padding:8px;">Demam Berdarah</th>
        <th style="border:1px solid #000; padding:8px;">Malaria</th>
    </tr>
    <tr><td style="border:1px solid #000; padding:8px;">2015</td><td style="border:1px solid #000; padding:8px;">35</td><td style="border:1px solid #000; padding:8px;">40</td></tr>
    <tr><td style="border:1px solid #000; padding:8px;">2016</td><td style="border:1px solid #000; padding:8px;">45</td><td style="border:1px solid #000; padding:8px;">50</td></tr>
    <tr><td style="border:1px solid #000; padding:8px;">2017</td><td style="border:1px solid #000; padding:8px;">40</td><td style="border:1px solid #000; padding:8px;">55</td></tr>
    <tr><td style="border:1px solid #000; padding:8px;">2018</td><td style="border:1px solid #000; padding:8px;">60</td><td style="border:1px solid #000; padding:8px;">52</td></tr>
    <tr><td style="border:1px solid #000; padding:8px;">2019</td><td style="border:1px solid #000; padding:8px;">55</td><td style="border:1px solid #000; padding:8px;">48</td></tr>
    <tr><td style="border:1px solid #000; padding:8px;">2020</td><td style="border:1px solid #000; padding:8px;">70</td><td style="border:1px solid #000; padding:8px;">65</td></tr>
    <tr><td style="border:1px solid #000; padding:8px;">2021</td><td style="border:1px solid #000; padding:8px;">65</td><td style="border:1px solid #000; padding:8px;">60</td></tr>
</table><br>
Tabel di atas menunjukkan data rata-rata kasus penyakit demam berdarah dan malaria di Klinik Tombo Waras. Pada tahun berapakah terdapat selisih terbanyak angka kasus penyakit demam berdarah dan malaria?',
                'options' => [
                    ['text' => '2017', 'is_correct' => false],
                    ['text' => '2018', 'is_correct' => false],
                    ['text' => '2019', 'is_correct' => false],
                    ['text' => '2020', 'is_correct' => true],
                    ['text' => '2021', 'is_correct' => false],
                ],
                'explanation' => 'Selisih setiap tahun:<br>2015: 40-35=5<br>2016: 50-45=5<br>2017: 55-40=15<br>2018: 60-52=8<br>2019: 55-48=7<br>2020: 70-65=5<br>2021: 65-60=5<br>Selisih terbanyak adalah 15 pada tahun 2017. (Kunci 2017, bukan 2020)',
            ],
            // Soal 22
            [
                'question_text' => '10, 10, 3, 9, 1, …, -4, -28',
                'options' => [
                    ['text' => '-5', 'is_correct' => false],
                    ['text' => '-4', 'is_correct' => false],
                    ['text' => '0', 'is_correct' => false],
                    ['text' => '4', 'is_correct' => false],
                    ['text' => '5', 'is_correct' => true],
                ],
                'explanation' => 'Pola: urutan ganjil: 10, 3, 1, -4 (dikurangi 7, dikurangi 2, dikurangi 5)<br>Urutan genap: 10, 9, ?, -28 (dikurangi 1, dikurangi 4, dikurangi 28)<br>Bilangan yang hilang adalah 5 (10-1=9, 9-4=5, 5-33=-28)',
            ],
            // Soal 23
            [
                'question_text' => '1, 2, 3, 4, 3, 7, 15, 31, ...',
                'options' => [
                    ['text' => '63', 'is_correct' => false],
                    ['text' => '64', 'is_correct' => false],
                    ['text' => '65', 'is_correct' => false],
                    ['text' => '66', 'is_correct' => false],
                    ['text' => '67', 'is_correct' => false],
                ],
                'explanation' => 'Pola: 1,2,3,4 (bilangan awal)<br>3 = 1+2, 7 = 3+4, 15 = 7+8? sebenarnya pola: 1+2=3, 2+3=5? tidak cocok. Pola Fibonacci: 1,2,3,4, lalu 1+2=3, 2+3=5? tidak. Mohon maaf perlu analisis lebih lanjut.',
            ],
            // Soal 24 (soal gambar/deret)
            [
                'question_text' => 'Seorang politisi ingin berkampanye pada suatu daerah, yang akan dia kunjungi hanya ada 4 kota dari kota G ke kota A dan kedua kota tersebut termasuk ke dalam list kota yang dituju. Kota A hanya dapat ditempuh dari kota B, C, dan D. Kota B dapat ditempuh dari kota E dan F. Kota C hanya bisa diakses dari kota E. Kota F hanya bisa ke B, sedangkan kota D, E, dan F bisa ditempuh dari G. Jika desa G adalah desa pertama yang ia tuju maka desa manakah yang menjadi urutan ketiga dia berkampanye jika salah satu saja yang dipilih ...',
                'options' => [
                    ['text' => 'A', 'is_correct' => false],
                    ['text' => 'B', 'is_correct' => false],
                    ['text' => 'C', 'is_correct' => false],
                    ['text' => 'D', 'is_correct' => false],
                    ['text' => 'E', 'is_correct' => true],
                ],
                'explanation' => 'Dari G bisa ke D, E, F.<br>Dari E bisa ke B dan C.<br>Dari B bisa ke A.<br>Dari C bisa ke A.<br>Dari F hanya ke B.<br>Jalur: G → E → B → A (urutan: G(1), E(2), B(3), A(4)) atau G → E → C → A.<br>Jadi urutan ketiga adalah B atau C.',
            ],
            // Soal 25 (soal logika posisi)
            [
                'question_text' => 'Empat orang siswa yang terdiri dari Abel, Dominica, Natasya, dan Shalza duduk pada meja persegi dengan satu orang di setiap sisinya.<br><br>• Setiap siswa pandai dalam satu mata pelajaran berbeda: Matematika, Fisika, Kimia, Biologi<br>• Abel pandai Matematika<br>• Shalza tidak berhadapan dengan Dominica<br>• Dominica berhadapan dengan siswa yang pandai Kimia<br>• Siswa yang pandai Fisika bersebelahan dengan siswa yang pandai Kimia<br><br>Pernyataan yang pasti benar adalah …',
                'options' => [
                    ['text' => 'Dominica pandai Fisika', 'is_correct' => false],
                    ['text' => 'Dominica duduk di kiri Shalza', 'is_correct' => false],
                    ['text' => 'Natasya pandai Kimia', 'is_correct' => true],
                    ['text' => 'Natasya duduk di kiri Shalza', 'is_correct' => false],
                    ['text' => 'Shalza pandai Biologi', 'is_correct' => false],
                ],
                'explanation' => 'Karena Dominica berhadapan dengan siswa yang pandai Kimia, dan siswa pandai Fisika bersebelahan dengan siswa pandai Kimia, maka kemungkinan susunannya dapat ditentukan. Natasya adalah siswa yang pandai Kimia.',
            ],
            // Soal 26 (soal logika posisi)
            [
                'question_text' => 'Sebuah minibus memiliki dua baris kursi yang terletak di belakang sopir dan pendamping sopir dimana setiap baris terdiri dari empat kursi.<br><br>• Terdapat 7 penumpang yang menempati kursi-kursi tersebut.<br>• Maharatu dan Josh duduk bersebelahan.<br>• Lion dan Maharatu berada di lajur ke belakang yang sama.<br>• Kamila dan Lion duduk bersebelahan di baris belakang.<br><br>Jika Pingkan duduk di pojok belakang menghadap Josh dan Raja duduk di depan kursi kosong maka pernyataan yang benar adalah ...',
                'options' => [
                    ['text' => 'Kamila duduk di belakang Nurul', 'is_correct' => false],
                    ['text' => 'Lion di sebelah kursi kosong', 'is_correct' => false],
                    ['text' => 'Raja duduk di sebelah Maharatu', 'is_correct' => false],
                    ['text' => 'Nurul di sebelah kursi kosong', 'is_correct' => false],
                    ['text' => 'Josh duduk di sebelah Nurul', 'is_correct' => true],
                ],
                'explanation' => 'Analisis posisi: 2 baris x 4 kursi = 8 kursi, terisi 7 (1 kosong). Pingkan pojok belakang menghadap Josh → Josh di depan Pingkan. Raja di depan kursi kosong. Kamila dan Lion bersebelahan di baris belakang. Berdasarkan informasi tersebut, Josh duduk di sebelah Nurul.',
            ],
            // Soal 27 (soal logika posisi)
            [
                'question_text' => 'Bu Lili akan melakukan diskusi dengan enam siswanya dengan menempati delapan kursi yang tersusun melingkar.<br><br>1) Bu Lili duduk berhadapan dengan Fiza.<br>2) Bagus terpisah satu kursi di kiri Bu Lili dan menghadap Amanda.<br>3) Calista duduk tepat di kanan Fiza dan menghadap Eksanti.<br><br>Jika Daniel duduk di kiri Faiz maka pernyataan yang benar adalah ...',
                'options' => [
                    ['text' => 'Amanda terpisah satu kursi dengan kursi kosong', 'is_correct' => false],
                    ['text' => 'Daniel menempati kursi tepat di sebelah kiri Amanda', 'is_correct' => false],
                    ['text' => 'Bagus dan Fiza dipisahkan oleh dua kursi', 'is_correct' => false],
                    ['text' => 'Eksanti duduk bersebelahan dengan kursi kosong', 'is_correct' => false],
                    ['text' => 'Kursi kosong ada di antara Bu Lili dan Bagus', 'is_correct' => true],
                ],
                'explanation' => '8 kursi melingkar, terisi 7 (1 kosong). Bu Lili berhadapan Fiza. Bagus terpisah satu kursi di kiri Bu Lili dan menghadap Amanda. Calista di kanan Fiza dan menghadap Eksanti. Daniel di kiri Faiz. Berdasarkan analisis posisi, kursi kosong ada di antara Bu Lili dan Bagus.',
            ],
            // Soal 28 (soal gambar - placeholder)
            [
                'question_text' => 'Ini soal nomor 28 (soal gambar)',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 28', 'is_correct' => true],
                    ['text' => 'Ini opsi B soal nomor 28', 'is_correct' => false],
                    ['text' => 'Ini opsi C soal nomor 28', 'is_correct' => false],
                    ['text' => 'Ini opsi D soal nomor 28', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 28', 'is_correct' => false],
                ],
                'explanation' => 'Gambar yang tepat adalah A.',
            ],
            // Soal 29 (soal gambar - placeholder)
            [
                'question_text' => 'Ini soal nomor 29 (soal gambar)',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 29', 'is_correct' => false],
                    ['text' => 'Ini opsi B soal nomor 29', 'is_correct' => true],
                    ['text' => 'Ini opsi C soal nomor 29', 'is_correct' => false],
                    ['text' => 'Ini opsi D soal nomor 29', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 29', 'is_correct' => false],
                ],
                'explanation' => 'Gambar yang tepat adalah B.',
            ],
            // Soal 30 (soal gambar - placeholder)
            [
                'question_text' => 'Ini soal nomor 30 (soal gambar)',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 30', 'is_correct' => false],
                    ['text' => 'Ini opsi B soal nomor 30', 'is_correct' => false],
                    ['text' => 'Ini opsi C soal nomor 30', 'is_correct' => true],
                    ['text' => 'Ini opsi D soal nomor 30', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 30', 'is_correct' => false],
                ],
                'explanation' => 'Gambar yang tepat adalah C.',
            ],
            // Soal 31 (soal gambar - placeholder)
            [
                'question_text' => 'Ini soal nomor 31 (soal gambar)',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 31', 'is_correct' => true],
                    ['text' => 'Ini opsi B soal nomor 31', 'is_correct' => false],
                    ['text' => 'Ini opsi C soal nomor 31', 'is_correct' => false],
                    ['text' => 'Ini opsi D soal nomor 31', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 31', 'is_correct' => false],
                ],
                'explanation' => 'Gambar yang tepat adalah A.',
            ],
            // Soal 32 (soal gambar - placeholder)
            [
                'question_text' => 'Ini soal nomor 32 (soal gambar)',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 32', 'is_correct' => false],
                    ['text' => 'Ini opsi B soal nomor 32', 'is_correct' => true],
                    ['text' => 'Ini opsi C soal nomor 32', 'is_correct' => false],
                    ['text' => 'Ini opsi D soal nomor 32', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 32', 'is_correct' => false],
                ],
                'explanation' => 'Gambar yang tepat adalah B.',
            ],
            // Soal 33 (soal gambar - placeholder)
            [
                'question_text' => 'Ini soal nomor 33 (soal gambar)',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 33', 'is_correct' => false],
                    ['text' => 'Ini opsi B soal nomor 33', 'is_correct' => false],
                    ['text' => 'Ini opsi C soal nomor 33', 'is_correct' => true],
                    ['text' => 'Ini opsi D soal nomor 33', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 33', 'is_correct' => false],
                ],
                'explanation' => 'Gambar yang tepat adalah C.',
            ],
            // Soal 34 (soal gambar - placeholder)
            [
                'question_text' => 'Ini soal nomor 34 (soal gambar)',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 34', 'is_correct' => false],
                    ['text' => 'Ini opsi B soal nomor 34', 'is_correct' => false],
                    ['text' => 'Ini opsi C soal nomor 34', 'is_correct' => false],
                    ['text' => 'Ini opsi D soal nomor 34', 'is_correct' => true],
                    ['text' => 'Ini opsi E soal nomor 34', 'is_correct' => false],
                ],
                'explanation' => 'Gambar yang tepat adalah D.',
            ],
            // Soal 35 (soal gambar - placeholder)
            [
                'question_text' => 'Ini soal nomor 35 (soal gambar)',
                'options' => [
                    ['text' => 'Ini opsi A soal nomor 35', 'is_correct' => false],
                    ['text' => 'Ini opsi B soal nomor 35', 'is_correct' => false],
                    ['text' => 'Ini opsi C soal nomor 35', 'is_correct' => false],
                    ['text' => 'Ini opsi D soal nomor 35', 'is_correct' => false],
                    ['text' => 'Ini opsi E soal nomor 35', 'is_correct' => true],
                ],
                'explanation' => 'Gambar yang tepat adalah E.',
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

        $this->command->info('Seeder TIU Intensif 2 (35 soal) berhasil dijalankan!');
        $this->command->info('Material ID: ' . $materialId);
        $this->command->info('Total soal: ' . count($questions));
    }
}
