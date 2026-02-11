<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkdPaket3Seeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $q = function ($material_id, $test_type, $question_text, $options, $explanation = null) use ($now) {
            $qid = DB::table('questions')->insertGetId([
                'material_id'   => $material_id,
                'type'          => 'mcq',
                'test_type'     => $test_type,
                'question_text' => $question_text,
                'explanation'   => $explanation,
                'created_at'    => $now,
                'updated_at'    => $now,
            ]);

            foreach ($options as $i => $o) {
                DB::table('question_options')->insert([
                    'question_id' => $qid,
                    'option_text' => $o['text'],
                    'is_correct'  => $o['is_correct'] ?? 0,
                    'weight'      => $o['weight'] ?? 0,
                    'order'       => $i + 1,
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ]);
            }
        };

        /*
        |--------------------------------------------------------------------------
        | TWK 1–10  (material_id = 40)
        |--------------------------------------------------------------------------
        */

        // 1
        $q(40,'twk',
            'UUD NRI Tahun 1945 pasca-amandemen mengalami perubahan sistem ketatanegaraan termasuk tugas dan wewenang MPR-RI.<br>Tugas dan wewenang yang <strong>tidak mengalami perubahan</strong> adalah …',
            [
                ['text'=>'Sejajar kedudukannya dengan lembaga tinggi negara lainnya','is_correct'=>0],
                ['text'=>'Menetapkan dan mengubah GBHN','is_correct'=>0],
                ['text'=>'Mengangkat Presiden dan Wakil Presiden','is_correct'=>0],
                ['text'=>'Menetapkan dan mengubah UUD','is_correct'=>1],
                ['text'=>'Keanggotaan DPR dan DPD hasil pemilu','is_correct'=>0],
            ],
            'D'
        );

        // 2
        $q(40,'twk',
            'Perilaku <em>cyber bullying</em> menyalahi nilai-nilai Pancasila karena …',
            [
                ['text'=>'Tidak boleh membenarkan perundungan','is_correct'=>0],
                ['text'=>'Menyalahi nilai kemanusiaan yang beradab','is_correct'=>1],
                ['text'=>'Pancasila dapat mengatasi cyber bullying','is_correct'=>0],
                ['text'=>'Manfaat media sosial sudah diatur','is_correct'=>0],
                ['text'=>'Menjauhi perundungan adalah persatuan','is_correct'=>0],
            ],
            'B'
        );

        // 3
        $q(40,'twk',
            'Tokoh agama memimpin doa setelah meminta izin hadirin yang berbeda agama.<br>Hal ini mencerminkan …',
            [
                ['text'=>'Menghormati keberagaman keyakinan','is_correct'=>1],
                ['text'=>'Menerima amanah doa','is_correct'=>0],
                ['text'=>'Bangga memimpin doa','is_correct'=>0],
                ['text'=>'Bertanggung jawab atas isi doa','is_correct'=>0],
                ['text'=>'Setiap doa untuk kebaikan','is_correct'=>0],
            ],
            'A'
        );

        // 4
        $q(40,'twk',
            'Sikap cinta tanah air yang menunjukkan penghargaan terhadap sumber daya dan budaya bangsa adalah …',
            [
                ['text'=>'Menghormati simbol negara','is_correct'=>0],
                ['text'=>'Menjaga keamanan negara','is_correct'=>0],
                ['text'=>'Mendukung produk dalam negeri dan budaya lokal','is_correct'=>1],
                ['text'=>'Menghargai sistem pemerintah','is_correct'=>0],
                ['text'=>'Ikut pengabdian masyarakat','is_correct'=>0],
            ],
            'C'
        );

        // 5
        $q(40,'twk',
            'Dalam masyarakat majemuk, sikap menjaga nasionalisme yang tepat adalah …',
            [
                ['text'=>'Memperkokoh golongan sendiri','is_correct'=>0],
                ['text'=>'Menjadikan satu golongan unggul','is_correct'=>0],
                ['text'=>'Saling menghargai perbedaan','is_correct'=>1],
                ['text'=>'Mencintai golongan tertentu','is_correct'=>0],
                ['text'=>'Persaudaraan terbatas','is_correct'=>0],
            ],
            'C'
        );

        // 6
        $q(40,'twk',
            'Menemukan unggahan isu agama yang kurang tepat di media sosial. Sikap paling bijak adalah …',
            [
                ['text'=>'Mendukung dengan komentar positif','is_correct'=>0],
                ['text'=>'Menilai dari komentar lain','is_correct'=>0],
                ['text'=>'Menahan diri dan melakukan pengecekan','is_correct'=>1],
                ['text'=>'Langsung melaporkan','is_correct'=>0],
                ['text'=>'Mengubah pemahaman sendiri','is_correct'=>0],
            ],
            'C'
        );

        // 7
        $q(40,'twk',
            'Alasan Ki Hadjar Dewantara mendirikan Taman Siswa adalah …',
            [
                ['text'=>'Pengabdian bangsa','is_correct'=>0],
                ['text'=>'Mendidik rakyat berjiwa kebangsaan','is_correct'=>1],
                ['text'=>'Menghargai sejarah','is_correct'=>0],
                ['text'=>'Mengajarkan nasionalisme','is_correct'=>0],
                ['text'=>'Menanggapi diskriminasi','is_correct'=>0],
            ],
            'B'
        );

        // 8
        $q(40,'twk',
            'Mengapa Pancasila penting dalam suksesi kepemimpinan?',
            [
                ['text'=>'Agar jadi jargon kemenangan','is_correct'=>0],
                ['text'=>'Menjaga persatuan di atas kepentingan kelompok','is_correct'=>1],
                ['text'=>'Menjadi diskursus utama','is_correct'=>0],
                ['text'=>'Menguatkan identitas agama','is_correct'=>0],
                ['text'=>'Mewujudkan kebebasan','is_correct'=>0],
            ],
            'B'
        );

        // 9
        $q(40,'twk',
            'Pencantuman Pasal 28 UUD terkait kebebasan berserikat terjadi karena adanya …',
            [
                ['text'=>'Monopoli sidang','is_correct'=>0],
                ['text'=>'Pihak mengalah','is_correct'=>0],
                ['text'=>'Kompromi anggota sidang','is_correct'=>1],
                ['text'=>'Sikap superior','is_correct'=>0],
                ['text'=>'Sikap inferior','is_correct'=>0],
            ],
            'C'
        );

        // 10
        $q(40,'twk',
            'Mahasiswa dari suku terpencil dibantu memahami budaya kampus. Maknanya adalah …',
            [
                ['text'=>'Semua wilayah sama','is_correct'=>0],
                ['text'=>'Perbedaan tetap saling membantu','is_correct'=>1],
                ['text'=>'Semua suku sama','is_correct'=>0],
                ['text'=>'Wajib mempelajari semua budaya','is_correct'=>0],
                ['text'=>'Perguruan tinggi wajib menerima','is_correct'=>0],
            ],
            'B'
        );
        /*
        |--------------------------------------------------------------------------
        | TWK 11–30  (material_id = 40)
        |--------------------------------------------------------------------------
        */

        // 11
        $q(40,'twk',
            'Saifuddin Zuhri menolak memberangkatkan adik iparnya haji menggunakan fasilitas kementerian. Tindakan ini menunjukkan nilai …',
            [
                ['text'=>'Berbuat baik','is_correct'=>0],
                ['text'=>'Amanah','is_correct'=>1],
                ['text'=>'Menerima konsekuensi','is_correct'=>0],
                ['text'=>'Memikirkan orang lain','is_correct'=>0],
                ['text'=>'Berani menanggung risiko','is_correct'=>0],
            ],
            'B'
        );

        // 12
        $q(40,'twk',
            'Kelas terdiri dari berbagai suku dan saling menghormati. Hubungan integritas dan Bhinneka Tunggal Ika adalah …',
            [
                ['text'=>'Semua siswa harus mempelajari semua budaya','is_correct'=>0],
                ['text'=>'Sekolah menyediakan guru lintas suku','is_correct'=>0],
                ['text'=>'Semua suku perlu saling mempelajari','is_correct'=>0],
                ['text'=>'Penghormatan perbedaan menciptakan kebersamaan','is_correct'=>1],
                ['text'=>'Indonesia beragam suku dan agama','is_correct'=>0],
            ],
            'D'
        );

        // 13
        $q(40,'twk',
            'Panitia Perancang UUD BPUPKI diketuai Ir. Soekarno dan …',
            [
                ['text'=>'Abikusno Tjokrosuyoso','is_correct'=>0],
                ['text'=>'Moh. Hatta','is_correct'=>0],
                ['text'=>'Muhammad Yamin','is_correct'=>0],
                ['text'=>'Soepomo','is_correct'=>1],
                ['text'=>'Ahmad Subardjo','is_correct'=>0],
            ],
            'D'
        );

        // 14
        $q(40,'twk',
            'Upaya mewujudkan kemandirian bangsa di bidang ekonomi adalah …',
            [
                ['text'=>'Melarang investasi asing','is_correct'=>0],
                ['text'=>'Menguatkan wirausaha berbasis potensi lokal','is_correct'=>1],
                ['text'=>'Memasarkan produk luar negeri','is_correct'=>0],
                ['text'=>'Mendirikan usaha untuk bantuan','is_correct'=>0],
                ['text'=>'Meniru produk luar','is_correct'=>0],
            ],
            'B'
        );

        // 15
        $q(40,'twk',
            'Menggunakan produk dalam negeri memperkuat NKRI karena …',
            [
                ['text'=>'Mengurangi hutang','is_correct'=>0],
                ['text'=>'Meningkatkan usaha ekonomi rakyat','is_correct'=>1],
                ['text'=>'Membatasi barang luar','is_correct'=>0],
                ['text'=>'Liberalisasi ekonomi','is_correct'=>0],
                ['text'=>'Menambah koperasi','is_correct'=>0],
            ],
            'B'
        );

        // 16
        $q(40,'twk',
            'Penegakan hukum pidana internasional bagian dari bela negara untuk mempertahankan …',
            [
                ['text'=>'Kedaulatan negara','is_correct'=>1],
                ['text'=>'Kehormatan negara','is_correct'=>0],
                ['text'=>'Kebijakan pemerintah','is_correct'=>0],
                ['text'=>'Kedaulatan politik','is_correct'=>0],
                ['text'=>'Kepentingan ekonomi','is_correct'=>0],
            ],
            'A'
        );

        // 17
        $q(40,'twk',
            'Kewenangan MK menguji UU terhadap UUD mencerminkan paham …',
            [
                ['text'=>'Supremasi konstitusi','is_correct'=>1],
                ['text'=>'Supremasi BPUPKI','is_correct'=>0],
                ['text'=>'Kedaulatan rakyat','is_correct'=>0],
                ['text'=>'Kewenangan DPR','is_correct'=>0],
                ['text'=>'Supremasi MPR','is_correct'=>0],
            ],
            'A'
        );

        // 18
        $q(40,'twk',
            'Aktualisasi Sila Persatuan Indonesia mengutamakan …',
            [
                ['text'=>'Pengakuan martabat manusia','is_correct'=>0],
                ['text'=>'Kebebasan ibadah','is_correct'=>0],
                ['text'=>'Masyarakat sejahtera','is_correct'=>0],
                ['text'=>'Kepentingan bangsa dan negara','is_correct'=>1],
                ['text'=>'Kepentingan kelompok','is_correct'=>0],
            ],
            'D'
        );

        // 19
        $q(40,'twk',
            'Bukti bangsa Indonesia menghargai martabat manusia adalah …',
            [
                ['text'=>'Pembagian santri-abangan-priyayi','is_correct'=>0],
                ['text'=>'Budaya siri’ Bugis-Makassar','is_correct'=>1],
                ['text'=>'Pepatah mangan ora mangan','is_correct'=>0],
                ['text'=>'Pepatah Minang','is_correct'=>0],
                ['text'=>'Tradisi bersih desa','is_correct'=>0],
            ],
            'B'
        );

        // 20
        $q(40,'twk',
            'Bantuan negara saat bencana menunjukkan Pancasila sebagai dasar negara karena …',
            [
                ['text'=>'Nilai kemanusiaan jadi dasar kebijakan','is_correct'=>1],
                ['text'=>'Kebijakan khusus bencana','is_correct'=>0],
                ['text'=>'Seleksi penerima bantuan','is_correct'=>0],
                ['text'=>'Kesamaan kepentingan','is_correct'=>0],
                ['text'=>'Formalitas pemerintahan','is_correct'=>0],
            ],
            'A'
        );

        // 21
        $q(40,'twk',
            'RUU otonomi daerah batal demi hukum jika tidak melibatkan …',
            [
                ['text'=>'DPR, Presiden, dan DPD','is_correct'=>1],
                ['text'=>'DPR, Presiden, dan DPRD','is_correct'=>0],
                ['text'=>'DPR, Presiden, dan masyarakat','is_correct'=>0],
                ['text'=>'DPR, Presiden, dan tokoh adat','is_correct'=>0],
                ['text'=>'DPR, Presiden, dan kepala daerah','is_correct'=>0],
            ],
            'A'
        );

        // 22
        $q(40,'twk',
            'Alasan bidang agama diatur dalam UUD adalah …',
            [
                ['text'=>'Mencegah agama baru','is_correct'=>0],
                ['text'=>'Negara tidak memisahkan agama dan negara','is_correct'=>1],
                ['text'=>'Menjamin kekhusyukan ibadah','is_correct'=>0],
                ['text'=>'Negara berdasar agama tertentu','is_correct'=>0],
                ['text'=>'Mencegah konflik horizontal','is_correct'=>0],
            ],
            'B'
        );

        // 23
        $q(40,'twk',
            'Keberagaman mendorong persatuan masyarakat ditunjukkan oleh …',
            [
                ['text'=>'Saling menghargai antarwarga','is_correct'=>1],
                ['text'=>'Pandangan pendidikan','is_correct'=>0],
                ['text'=>'Dialog masyarakat','is_correct'=>0],
                ['text'=>'Saran konstruktif','is_correct'=>0],
                ['text'=>'Kesadaran temporal','is_correct'=>0],
            ],
            'A'
        );

        // 24
        $q(40,'twk',
            'Keberadaan Mahkamah Konstitusi penting karena …',
            [
                ['text'=>'Memutus pembubaran parpol dan sengketa pemilu','is_correct'=>1],
                ['text'=>'Melaksanakan demokrasi pascareformasi','is_correct'=>0],
                ['text'=>'Menyelenggarakan pemilu','is_correct'=>0],
                ['text'=>'Mengatasi tumpang tindih aturan','is_correct'=>0],
                ['text'=>'Menjamin demokrasi Pancasila','is_correct'=>0],
            ],
            'A'
        );

        // 25
        $q(40,'twk',
            'Perbaikan ejaan yang tepat pada kalimat akademik adalah …',
            [
                ['text'=>'Tidak perlu koma','is_correct'=>0],
                ['text'=>'Fakultas farmasi huruf kecil','is_correct'=>0],
                ['text'=>'Kata daring dicetak miring','is_correct'=>0],
                ['text'=>'Atmosfer → atmosfir','is_correct'=>1],
                ['text'=>'Tidak perlu koma setelah adaptif','is_correct'=>0],
            ],
            'D'
        );

        // 26
        $q(40,'twk',
            'Perbaikan kata bentukan yang salah adalah …',
            [
                ['text'=>'Pameran → pertunjukan','is_correct'=>0],
                ['text'=>'Mempertunjukkan → menunjukkan','is_correct'=>1],
                ['text'=>'Terbuat → dibuat','is_correct'=>0],
                ['text'=>'Beraneka → bermacam','is_correct'=>0],
                ['text'=>'Mengalas → mengalasi','is_correct'=>0],
            ],
            'B'
        );

        // 27
        $q(40,'twk',
            'Nilai sosial dalam kutipan cerpen adalah …',
            [
                ['text'=>'Perubahan niscaya','is_correct'=>0],
                ['text'=>'Mengikuti kemajuan','is_correct'=>0],
                ['text'=>'Tidak perlu barter','is_correct'=>0],
                ['text'=>'Pasar untuk si kaya','is_correct'=>0],
                ['text'=>'Orang kaya makin kaya','is_correct'=>1],
            ],
            'E'
        );

        // 28
        $q(40,'twk',
            'Perbaikan kalimat efektif pada paragraf adalah …',
            [
                ['text'=>'Pilihan A','is_correct'=>0],
                ['text'=>'Pilihan B','is_correct'=>0],
                ['text'=>'Pilihan C','is_correct'=>1],
                ['text'=>'Pilihan D','is_correct'=>0],
                ['text'=>'Pilihan E','is_correct'=>0],
            ],
            'C'
        );

        // 29
        $q(40,'twk',
            'Ide pokok paragraf tentang TPA New Delhi adalah …',
            [
                ['text'=>'Limbah virus corona','is_correct'=>0],
                ['text'=>'Sumber sampah','is_correct'=>0],
                ['text'=>'Risiko pemulung terpapar virus','is_correct'=>1],
                ['text'=>'Virus ada di mana-mana','is_correct'=>0],
                ['text'=>'Korban virus','is_correct'=>0],
            ],
            'C'
        );

        // 30
        $q(40,'twk',
            'Simpulan dua paragraf tentang indikator kualitas pendidikan tinggi adalah …',
            [
                ['text'=>'Mahasiswa siap kerja dan wirausaha','is_correct'=>0],
                ['text'=>'Penetapan delapan indikator kualitas','is_correct'=>0],
                ['text'=>'Indikator agar terserap kerja','is_correct'=>0],
                ['text'=>'Kebijakan menguntungkan mahasiswa','is_correct'=>0],
                ['text'=>'Indikator menyiapkan lulusan siap kerja dan mandiri','is_correct'=>1],
            ],
            'E'
        );
        /*
        |--------------------------------------------------------------------------
        | TIU 31–50  (material_id = 39)
        |--------------------------------------------------------------------------
        */

        // 31
        $q(39,'tiu',
            'Musik : Nada :: Planet : …',
            [
                ['text'=>'Galaksi','is_correct'=>0],
                ['text'=>'Matahari','is_correct'=>0],
                ['text'=>'Satelit','is_correct'=>0],
                ['text'=>'Bumi','is_correct'=>0],
                ['text'=>'Bintang','is_correct'=>1],
            ],
            'E'
        );

        // 32
        $q(39,'tiu',
            'Hubungan objek pada kalimat:<br><strong>"Ayah menangkap belalang, mengusir katak dan mengejar ular."</strong><br>Setara dengan …',
            [
                ['text'=>'Kakak memotong rumput lalu memberi makan sapi','is_correct'=>0],
                ['text'=>'Pak Budi menangkap cacing untuk ayam','is_correct'=>1],
                ['text'=>'Ibu menanam bunga','is_correct'=>0],
                ['text'=>'Nelayan membuat umpan','is_correct'=>0],
                ['text'=>'Adik meminum susu','is_correct'=>0],
            ],
            'B'
        );

        // 33
        $q(39,'tiu',
            'Hubungan objek kalimat:<br><strong>"Setiap nasabah prioritas memiliki uang miliaran di bank."</strong><br>Setara dengan …',
            [
                ['text'=>'Pak Rustam menebang kayu','is_correct'=>0],
                ['text'=>'Pak Tani menyimpan padi di lumbung','is_correct'=>1],
                ['text'=>'Ibu membeli baju','is_correct'=>0],
                ['text'=>'Kakak mencuci pakaian','is_correct'=>0],
                ['text'=>'Rahmi memasak nasi','is_correct'=>0],
            ],
            'B'
        );

        // 34
        $q(39,'tiu',
            'Gelas kosong : gelas penuh air : air tumpah<br>Setara dengan …',
            [
                ['text'=>'Perut lapar : kenyang : muntah','is_correct'=>0],
                ['text'=>'Dompet kosong : berisi : uang hilang','is_correct'=>0],
                ['text'=>'Tas kosong : penuh buku : buku berserakan','is_correct'=>1],
                ['text'=>'Pikiran kosong : penuh ide','is_correct'=>0],
                ['text'=>'Mobil kosong : penuh : kecelakaan','is_correct'=>0],
            ],
            'C'
        );

        // 35
        $q(39,'tiu',
            'Ada cita-cita : ada peluang<br>Setara dengan …',
            [
                ['text'=>'Ada masalah : ada solusi','is_correct'=>0],
                ['text'=>'Ada uang : ada barang','is_correct'=>0],
                ['text'=>'Ada waktu : ada kegiatan','is_correct'=>0],
                ['text'=>'Ada niat : ada jalan','is_correct'=>1],
                ['text'=>'Ada kerja : ada hasil','is_correct'=>0],
            ],
            'D'
        );

        // 36
        $q(39,'tiu',
            'Semua mahasiswa berprestasi dapat bertemu Presiden.<br>Semua peserta beasiswa adalah mahasiswa berprestasi.<br>Simpulan yang tepat adalah …',
            [
                ['text'=>'Tidak semua mahasiswa bertemu Presiden','is_correct'=>0],
                ['text'=>'Tidak semua mahasiswa peserta beasiswa','is_correct'=>0],
                ['text'=>'Semua peserta beasiswa dapat bertemu Presiden','is_correct'=>1],
                ['text'=>'Sebagian peserta dapat bertemu Presiden','is_correct'=>0],
                ['text'=>'Semua yang bertemu Presiden peserta beasiswa','is_correct'=>0],
            ],
            'C'
        );

        // 37
        $q(39,'tiu',
            'Data penderita kanker menunjukkan peningkatan harapan hidup dari tahun 1950-an ke 1980-an.<br>Simpulan yang tepat adalah …',
            [
                ['text'=>'Lebih banyak penderita ditangani','is_correct'=>0],
                ['text'=>'Sebagian tidak ditangani','is_correct'=>0],
                ['text'=>'Tidak ada deteksi dini','is_correct'=>0],
                ['text'=>'Penanganan kanker semakin baik','is_correct'=>1],
                ['text'=>'Jumlah penderita meningkat','is_correct'=>0],
            ],
            'D'
        );

        // 38
        $q(39,'tiu',
            'Kulit ketiak banyak bakteri dan bakteri memicu bau badan.<br>Pernyataan paling mungkin benar adalah …',
            [
                ['text'=>'Bau badan berarti banyak bakteri','is_correct'=>0],
                ['text'=>'Bau harum berarti tanpa bakteri','is_correct'=>0],
                ['text'=>'Sering dibersihkan pasti tidak bau','is_correct'=>0],
                ['text'=>'Bagian tubuh lain tidak mengandung bakteri','is_correct'=>0],
                ['text'=>'Banyak bakteri meningkatkan risiko bau badan','is_correct'=>1],
            ],
            'E'
        );

        // 39
        $q(39,'tiu',
            'Tidak ada peserta debat RR memakai kemeja putih.<br>Semua anggota klub BB memakai kemeja putih.<br>Simpulan yang tepat adalah …',
            [
                ['text'=>'Sebagian anggota BB peserta RR','is_correct'=>0],
                ['text'=>'Semua anggota BB peserta RR','is_correct'=>0],
                ['text'=>'Beberapa anggota BB peserta RR','is_correct'=>0],
                ['text'=>'Ada anggota BB peserta RR','is_correct'=>0],
                ['text'=>'Tidak ada anggota BB peserta RR','is_correct'=>1],
            ],
            'E'
        );

        // 40
        $q(39,'tiu',
            'Kecepatan pembalap: A>B, D=F, C=B>E, dan D>A.<br>Kesimpulan yang benar adalah …',
            [
                ['text'=>'A hanya dikalahkan D','is_correct'=>0],
                ['text'=>'C lebih cepat dari F','is_correct'=>0],
                ['text'=>'F lebih cepat dari B','is_correct'=>1],
                ['text'=>'E lebih cepat dari B','is_correct'=>0],
                ['text'=>'D paling cepat','is_correct'=>0],
            ],
            'C'
        );

        // 41
        $q(39,'tiu',
            'Dua baris kursi saling berhadapan dengan posisi tertentu.<br>Siapa yang duduk di depan Rika?',
            [
                ['text'=>'Putri','is_correct'=>0],
                ['text'=>'Dina','is_correct'=>0],
                ['text'=>'Irma','is_correct'=>1],
                ['text'=>'Rika','is_correct'=>0],
                ['text'=>'Siti','is_correct'=>0],
            ],
            'C'
        );

        // 42
        $q(39,'tiu',
            'Enam orang duduk melingkar dengan aturan posisi tertentu.<br>Siapa yang duduk di sebelah kanan Rudi?',
            [
                ['text'=>'Ita','is_correct'=>0],
                ['text'=>'Sofi','is_correct'=>0],
                ['text'=>'Ana','is_correct'=>1],
                ['text'=>'Gino','is_correct'=>0],
                ['text'=>'Tomi','is_correct'=>0],
            ],
            'C'
        );

        // 43
        $q(39,'tiu',
            'Penataan lima tanaman berdasarkan rak dan warna pot.<br>Tanaman di rak tengah dengan pot hijau adalah …',
            [
                ['text'=>'Mawar','is_correct'=>0],
                ['text'=>'Melati','is_correct'=>0],
                ['text'=>'Kenanga','is_correct'=>0],
                ['text'=>'Tulip','is_correct'=>1],
                ['text'=>'Sepatu','is_correct'=>0],
            ],
            'D'
        );

        // 44
        $q(39,'tiu',
            '\\(8{,}5 + 12\\frac{1}{2} - 9 = \\)',
            [
                ['text'=>'6','is_correct'=>0],
                ['text'=>'8','is_correct'=>0],
                ['text'=>'12','is_correct'=>1],
                ['text'=>'16','is_correct'=>0],
                ['text'=>'20','is_correct'=>0],
            ],
            'C'
        );

        // 45
        $q(39,'tiu',
            '\\(1000 - 20 - 57{,}5 + 15{,}25 = \\)',
            [
                ['text'=>'922,5','is_correct'=>0],
                ['text'=>'937,75','is_correct'=>1],
                ['text'=>'973,15','is_correct'=>0],
                ['text'=>'980,25','is_correct'=>0],
                ['text'=>'1001,75','is_correct'=>0],
            ],
            'B'
        );

        // 46
        $q(39,'tiu',
            '\\(3 \\times 2\\frac{1}{3} : \\frac{3}{4} + 2 - \\frac{5}{6} = \\)',
            [
                ['text'=>'2 1/2','is_correct'=>0],
                ['text'=>'4 1/2','is_correct'=>0],
                ['text'=>'6 1/2','is_correct'=>1],
                ['text'=>'8 1/2','is_correct'=>0],
                ['text'=>'10 1/2','is_correct'=>0],
            ],
            'C'
        );

        // 47
        $q(39,'tiu',
            '-21, -18, -15, -12, -9, -6, -3, … , …',
            [
                ['text'=>'0, 3','is_correct'=>1],
                ['text'=>'0, 6','is_correct'=>0],
                ['text'=>'3, 6','is_correct'=>0],
                ['text'=>'3, 9','is_correct'=>0],
                ['text'=>'6, 9','is_correct'=>0],
            ],
            'A'
        );

        // 48
        $q(39,'tiu',
            '1, 3, 9, 27, 81, 243, 729, … , …',
            [
                ['text'=>'972, 1215','is_correct'=>0],
                ['text'=>'1558, 2187','is_correct'=>0],
                ['text'=>'2187, 2816','is_correct'=>0],
                ['text'=>'2816, 6561','is_correct'=>0],
                ['text'=>'2187, 6561','is_correct'=>1],
            ],
            'E'
        );

        // 49
        $q(39,'tiu',
            '81, 162, 54, 108, 36, 72, 24, … , …',
            [
                ['text'=>'48, 16','is_correct'=>1],
                ['text'=>'18, 32','is_correct'=>0],
                ['text'=>'15, 32','is_correct'=>0],
                ['text'=>'15, 18','is_correct'=>0],
                ['text'=>'8, 18','is_correct'=>0],
            ],
            'A'
        );

        // 50
        $q(39,'tiu',
            'Barisan: 1, 2, 2, 6, 4, 18, 8, … , …',
            [
                ['text'=>'18, 4','is_correct'=>0],
                ['text'=>'20, 10','is_correct'=>0],
                ['text'=>'54, 16','is_correct'=>1],
                ['text'=>'36, 24','is_correct'=>0],
                ['text'=>'9, 10','is_correct'=>0],
            ],
            'C'
        );
        /*
        |--------------------------------------------------------------------------
        | TIU 51–65  (material_id = 39)
        |--------------------------------------------------------------------------
        */

        // 51
        $q(39,'tiu',
            'Perhatikan data berikut:<br>
            <li>x &nbsp;&nbsp; y</li>
            <li>76 : \\(\\frac{1}{2}\\)</li>
            <li>152 : \\(\\frac{4}{2}\\)</li>',
            [
                ['text'=>'x = y','is_correct'=>0],
                ['text'=>'3x = y','is_correct'=>0],
                ['text'=>'x = 3y','is_correct'=>0],
                ['text'=>'2x = y','is_correct'=>1],
                ['text'=>'x = 2y','is_correct'=>0],
            ],
            'D'
        );

        // 52
        $q(39,'tiu',
            'Ahmad memiliki 54% saham perusahaan dan membaginya rata kepada tiga anaknya.<br>
            <li>a = \\(\\frac{3}{16}\\)</li>
            <li>b = \\(\\frac{?}{?}\\)</li>
            Bandingkan nilai a dan b.',
            [
                ['text'=>'a = b','is_correct'=>1],
                ['text'=>'a > b','is_correct'=>0],
                ['text'=>'a < b','is_correct'=>0],
                ['text'=>'2a = b','is_correct'=>0],
                ['text'=>'a = 2b','is_correct'=>0],
            ],
            'A'
        );

        // 53
        $q(39,'tiu',
            'Diketahui:<br>
            <li>X = 2p + q</li>
            <li>Y = p + 7q</li>
            Jika p = 7 dan q = 1, maka …',
            [
                ['text'=>'X = Y + 1','is_correct'=>0],
                ['text'=>'X = Y - 1','is_correct'=>0],
                ['text'=>'X = Y','is_correct'=>1],
                ['text'=>'X = 2Y','is_correct'=>0],
                ['text'=>'X > Y','is_correct'=>0],
            ],
            'C'
        );

        // 54
        $q(39,'tiu',
            'Persediaan susu cukup untuk 30 anak selama 20 hari.<br>
            Jika bertambah 10 anak, berapa hari susu akan habis?',
            [
                ['text'=>'16','is_correct'=>0],
                ['text'=>'15','is_correct'=>1],
                ['text'=>'14','is_correct'=>0],
                ['text'=>'13','is_correct'=>0],
                ['text'=>'12','is_correct'=>0],
            ],
            'B'
        );

        // 55
        $q(39,'tiu',
            'Lapangan 45 m × 30 m disisakan 30 m² di tiap sudut sebagai ruang hijau.<br>
            Setiap 5 m² membutuhkan 110 paving block.<br>
            Jumlah paving block yang diperlukan adalah …',
            [
                ['text'=>'27.000','is_correct'=>0],
                ['text'=>'29.700','is_correct'=>1],
                ['text'=>'27.060','is_correct'=>0],
                ['text'=>'29.040','is_correct'=>0],
                ['text'=>'27.900','is_correct'=>0],
            ],
            'B'
        );

        // 56
        $q(39,'tiu',
            'Daftar harga barang AB Fashion:<br>
            <li>Tank Top Rp75.000 diskon 5%</li>
            <li>Celana Jeans Rp215.000 diskon 25%</li>
            <li>Kemeja Rp115.000 diskon 10%</li>
            <li>Cardigan Rp158.000 diskon 9%</li>
            <li>T-shirt Rp137.000 diskon 16%</li>
            <li>Rok Pendek Rp104.000 diskon 8%</li>
            Maria memiliki Rp200.000. Dua barang dengan sisa uang <strong>paling sedikit</strong> adalah …',
            [
                ['text'=>'Rok pendek dan celana jeans','is_correct'=>0],
                ['text'=>'Cardigan dan tank top','is_correct'=>0],
                ['text'=>'Cardigan dan celana jeans','is_correct'=>0],
                ['text'=>'Rok pendek dan kemeja','is_correct'=>1],
                ['text'=>'Kemeja dan tank top','is_correct'=>0],
            ],
            'D'
        );

        /*
        |--------------------------------------------------------------------------
        | TIU GAMBAR 57–65 (TANPA INPUT GAMBAR)
        |--------------------------------------------------------------------------
        */

        // 57
        $q(39,'tiu','Ini soal nomor 57',[
            ['text'=>'Ini opsi A soal nomor 57 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi B soal nomor 57 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi C soal nomor 57 (benar)','is_correct'=>1],
            ['text'=>'Ini opsi D soal nomor 57 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi E soal nomor 57 (salah)','is_correct'=>0],
        ],'C');

        // 58
        $q(39,'tiu','Ini soal nomor 58',[
            ['text'=>'Ini opsi A soal nomor 58 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi B soal nomor 58 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi C soal nomor 58 (benar)','is_correct'=>1],
            ['text'=>'Ini opsi D soal nomor 58 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi E soal nomor 58 (salah)','is_correct'=>0],
        ],'C');

        // 59
        $q(39,'tiu','Ini soal nomor 59',[
            ['text'=>'Ini opsi A soal nomor 59 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi B soal nomor 59 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi C soal nomor 59 (benar)','is_correct'=>1],
            ['text'=>'Ini opsi D soal nomor 59 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi E soal nomor 59 (salah)','is_correct'=>0],
        ],'C');

        // 60
        $q(39,'tiu','Ini soal nomor 60',[
            ['text'=>'Ini opsi A soal nomor 60 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi B soal nomor 60 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi C soal nomor 60 (benar)','is_correct'=>1],
            ['text'=>'Ini opsi D soal nomor 60 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi E soal nomor 60 (salah)','is_correct'=>0],
        ],'C');

        // 61
        $q(39,'tiu','Ini soal nomor 61',[
            ['text'=>'Ini opsi A soal nomor 61 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi B soal nomor 61 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi C soal nomor 61 (benar)','is_correct'=>1],
            ['text'=>'Ini opsi D soal nomor 61 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi E soal nomor 61 (salah)','is_correct'=>0],
        ],'C');

        // 62
        $q(39,'tiu','Ini soal nomor 62',[
            ['text'=>'Ini opsi A soal nomor 62 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi B soal nomor 62 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi C soal nomor 62 (benar)','is_correct'=>1],
            ['text'=>'Ini opsi D soal nomor 62 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi E soal nomor 62 (salah)','is_correct'=>0],
        ],'C');

        // 63
        $q(39,'tiu','Ini soal nomor 63',[
            ['text'=>'Ini opsi A soal nomor 63 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi B soal nomor 63 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi C soal nomor 63 (benar)','is_correct'=>1],
            ['text'=>'Ini opsi D soal nomor 63 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi E soal nomor 63 (salah)','is_correct'=>0],
        ],'C');

        // 64
        $q(39,'tiu','Ini soal nomor 64',[
            ['text'=>'Ini opsi A soal nomor 64 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi B soal nomor 64 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi C soal nomor 64 (benar)','is_correct'=>1],
            ['text'=>'Ini opsi D soal nomor 64 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi E soal nomor 64 (salah)','is_correct'=>0],
        ],'C');

        // 65
        $q(39,'tiu','Ini soal nomor 65',[
            ['text'=>'Ini opsi A soal nomor 65 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi B soal nomor 65 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi C soal nomor 65 (benar)','is_correct'=>1],
            ['text'=>'Ini opsi D soal nomor 65 (salah)','is_correct'=>0],
            ['text'=>'Ini opsi E soal nomor 65 (salah)','is_correct'=>0],
        ],'C');
        /*
        |--------------------------------------------------------------------------
        | TKP 66–85  (material_id = 41, WEIGHT ONLY)
        |--------------------------------------------------------------------------
        */

        // 66
        $q(41,'tkp',
            'Program reward perusahaan kurang diminati pelanggan. Apa yang sebaiknya dilakukan?',
            [
                ['text'=>'Mempromosikan program sesuai kebutuhan pelanggan','weight'=>5],
                ['text'=>'Mencari referensi program reward lain','weight'=>2],
                ['text'=>'Menunggu arahan pimpinan','weight'=>1],
                ['text'=>'Bertanya langsung kepada pelanggan','weight'=>3],
                ['text'=>'Diskusi internal tim','weight'=>4],
            ],
            '52134'
        );

        // 67
        $q(41,'tkp',
            'Rini harus memperbaiki laporan audit sebelum rapat dimulai. Apa yang sebaiknya dilakukan?',
            [
                ['text'=>'Mendiskusikan poin perbaikan','weight'=>3],
                ['text'=>'Menyampaikan laporan akan diperbaiki','weight'=>2],
                ['text'=>'Memastikan laporan diperbaiki sebelum rapat','weight'=>5],
                ['text'=>'Menunjukkan kepanikan','weight'=>1],
                ['text'=>'Memanfaatkan waktu untuk memperbaiki','weight'=>4],
            ],
            '32514'
        );

        // 68
        $q(41,'tkp',
            'Amir ditegur karena kekurangan data laporan audit. Apa yang sebaiknya dilakukan?',
            [
                ['text'=>'Menunjukkan kekesalan','weight'=>1],
                ['text'=>'Memeriksa kembali data laporan','weight'=>5],
                ['text'=>'Mengatakan data sudah lengkap','weight'=>2],
                ['text'=>'Menerima teguran dengan terbuka','weight'=>4],
                ['text'=>'Menjawab akan memeriksa kembali','weight'=>3],
            ],
            '15243'
        );

        // 69
        $q(41,'tkp',
            'Pelanggan marah di loket layanan saat Piko harus menghadiri rapat. Apa yang sebaiknya dilakukan?',
            [
                ['text'=>'Menegur pelanggan','weight'=>1],
                ['text'=>'Membiarkan rekan kerja','weight'=>2],
                ['text'=>'Pergi ke rapat','weight'=>3],
                ['text'=>'Meminta semua pihak tenang','weight'=>4],
                ['text'=>'Mengajak pelanggan bicara personal','weight'=>5],
            ],
            '12345'
        );

        // 70
        $q(41,'tkp',
            'Dinar menghadapi pelanggan marah karena berkas belum selesai. Apa yang dilakukan?',
            [
                ['text'=>'Meminta pelanggan bersabar','weight'=>4],
                ['text'=>'Mengecek berkas','weight'=>3],
                ['text'=>'Meminta bagian berkas segera melayani','weight'=>5],
                ['text'=>'Melayani dengan datar','weight'=>1],
                ['text'=>'Menyelesaikan segera tanpa cek','weight'=>2],
            ],
            '43512'
        );

        // 71
        $q(41,'tkp',
            'Rekan kerja belum memahami penjelasan Tino, sementara Tino juga punya tugas. Apa yang sebaiknya dilakukan?',
            [
                ['text'=>'Mencarikan media bantu','weight'=>4],
                ['text'=>'Membantu mengolah data','weight'=>3],
                ['text'=>'Mengatakan punya tugas lain','weight'=>1],
                ['text'=>'Mencari cara agar lebih mudah dipahami','weight'=>5],
                ['text'=>'Mendengarkan sambil bekerja','weight'=>2],
            ],
            '43152'
        );

        // 72
        $q(41,'tkp',
            'Clarissa menerima keluhan nasabah menjelang istirahat. Apa yang sebaiknya dilakukan?',
            [
                ['text'=>'Mengabaikan karena waktu istirahat','weight'=>1],
                ['text'=>'Mencatat dan meminta datang lagi','weight'=>2],
                ['text'=>'Meluangkan waktu mendengarkan keluhan','weight'=>5],
                ['text'=>'Memasang timer layanan','weight'=>3],
                ['text'=>'Mendahulukan antrean','weight'=>4],
            ],
            '12534'
        );

        // 73
        $q(41,'tkp',
            'Michael ditawari kerja sama part-time oleh lembaga sertifikasi. Sikap yang tepat?',
            [
                ['text'=>'Setuju dengan izin perusahaan','weight'=>5],
                ['text'=>'Menolak sepenuhnya','weight'=>2],
                ['text'=>'Menerima demi pengalaman','weight'=>1],
                ['text'=>'Menerima jika tak ganggu kinerja','weight'=>4],
                ['text'=>'Menerima untuk kepentingan pribadi','weight'=>3],
            ],
            '52143'
        );

        // 74
        $q(41,'tkp',
            'Ratri memiliki jadwal ujian bersamaan dengan penelitian. Apa yang sebaiknya dilakukan?',
            [
                ['text'=>'Mencari rekan pengganti','weight'=>3],
                ['text'=>'Menghubungi teman lain','weight'=>2],
                ['text'=>'Mengikuti ujian tanpa pertimbangan','weight'=>1],
                ['text'=>'Menunggu tawaran bantuan','weight'=>4],
                ['text'=>'Bertukar jadwal dengan asisten lain','weight'=>5],
            ],
            '32145'
        );

        // 75
        $q(41,'tkp',
            'Dinda memilih anggota tim kegiatan. Apa tindakan terbaik?',
            [
                ['text'=>'Menerima siapa saja','weight'=>2],
                ['text'=>'Menawari yang ditemui','weight'=>1],
                ['text'=>'Membuat daftar potensial','weight'=>4],
                ['text'=>'Menghubungi sesuai kompetensi','weight'=>5],
                ['text'=>'Memasukkan teman dekat','weight'=>3],
            ],
            '21453'
        );

        // 76
        $q(41,'tkp',
            'Ani terlambat menyelesaikan desain. Apa yang sebaiknya dilakukan Dita?',
            [
                ['text'=>'Marah pada Ani','weight'=>1],
                ['text'=>'Memberi tenggang waktu','weight'=>3],
                ['text'=>'Berkomunikasi dan bantu sumber daya','weight'=>5],
                ['text'=>'Percaya kontrak','weight'=>2],
                ['text'=>'Percaya kinerja sebelumnya','weight'=>4],
            ],
            '13524'
        );

        // 77
        $q(41,'tkp',
            'Dino terpilih pertukaran mahasiswa namun sungkan bertanya. Apa yang sebaiknya dilakukan?',
            [
                ['text'=>'Mencari info sendiri','weight'=>3],
                ['text'=>'Bertanya dengan mengajak teman','weight'=>4],
                ['text'=>'Menunggu Dita','weight'=>1],
                ['text'=>'Koordinasi bersama','weight'=>5],
                ['text'=>'Bertanya via pesan','weight'=>2],
            ],
            '34152'
        );

        // 78
        $q(41,'tkp',
            'Laporan dikembalikan karena tidak sesuai ketentuan. Apa sikap Andi?',
            [
                ['text'=>'Diam saja','weight'=>1],
                ['text'=>'Meminjamkan catatan','weight'=>3],
                ['text'=>'Menjelaskan detail laporan','weight'=>4],
                ['text'=>'Menjelaskan jika ditanya','weight'=>2],
                ['text'=>'Menjelaskan dan menawarkan bantuan','weight'=>5],
            ],
            '13425'
        );

        // 79
        $q(41,'tkp',
            'Indra senior UKM Jurnalistik ingin meningkatkan kompetensi anggota baru. Apa yang sebaiknya dilakukan?',
            [
                ['text'=>'Tidak terlibat','weight'=>1],
                ['text'=>'Membuat acara berbagi','weight'=>5],
                ['text'=>'Menjelaskan saat diminta','weight'=>3],
                ['text'=>'Berbagi demi pengakuan','weight'=>2],
                ['text'=>'Menunggu instruksi dosen','weight'=>4],
            ],
            '15324'
        );

        // 80
        $q(41,'tkp',
            'Kedasih butuh pelatihan TI yang bentrok ibadah. Apa yang sebaiknya dilakukan atasan?',
            [
                ['text'=>'Menjaring kebutuhan lintas agama','weight'=>3],
                ['text'=>'Diskusi kebutuhan pelatihan','weight'=>4],
                ['text'=>'Rapat perencanaan','weight'=>2],
                ['text'=>'Menyarankan pelatihan luar','weight'=>1],
                ['text'=>'Mencari jadwal yang sesuai','weight'=>5],
            ],
            '34215'
        );

        // 81
        $q(41,'tkp',
            'Ridwan diminta membatalkan izin Made mengikuti upacara keagamaan. Apa yang sebaiknya dilakukan?',
            [
                ['text'=>'Mendukung Toni','weight'=>1],
                ['text'=>'Mendorong pemahaman kewajiban Made','weight'=>4],
                ['text'=>'Menjelaskan keputusan dosen','weight'=>5],
                ['text'=>'Memberi pemahaman kewajiban','weight'=>3],
                ['text'=>'Meminta dosen menjelaskan','weight'=>2],
            ],
            '14352'
        );

        // 82
        $q(41,'tkp',
            'Rekan membuat lelucon merendahkan kebiasaan warga setempat. Apa yang sebaiknya dilakukan?',
            [
                ['text'=>'Mengapresiasi sambil menyesuaikan','weight'=>2],
                ['text'=>'Menyampaikan pendapat berbeda','weight'=>3],
                ['text'=>'Membiarkan saja','weight'=>1],
                ['text'=>'Memberi pengertian','weight'=>5],
                ['text'=>'Menanyakan alasannya','weight'=>4],
            ],
            '23154'
        );

        // 83
        $q(41,'tkp',
            'Teresia tidak bisa ikut lomba karena kondisi fisik. Apa yang sebaiknya dilakukan ketua?',
            [
                ['text'=>'Mencari pengganti dengan izin','weight'=>5],
                ['text'=>'Memberi pengertian tim','weight'=>4],
                ['text'=>'Diskusi dengan anggota','weight'=>3],
                ['text'=>'Memaksa tetap ikut','weight'=>1],
                ['text'=>'Memahami keputusan Teresia','weight'=>2],
            ],
            '54312'
        );

        // 84
        $q(41,'tkp',
            'Hasil jajak pendapat banyak kritik dan masukan. Apa tindakan terbaik?',
            [
                ['text'=>'Menindaklanjuti yang relevan','weight'=>4],
                ['text'=>'Menyusun daftar tindak lanjut','weight'=>5],
                ['text'=>'Mengingatkan penerimaan kritik','weight'=>2],
                ['text'=>'Mempertimbangkan latar belakang','weight'=>3],
                ['text'=>'Menganggap formalitas','weight'=>1],
            ],
            '45231'
        );

        // 85
        $q(41,'tkp',
            'Tria mahasiswa luar Jawa kesulitan memahami candaan. Sikap terbaik?',
            [
                ['text'=>'Berterus terang tidak paham','weight'=>3],
                ['text'=>'Berinisiatif pakai Bahasa Indonesia','weight'=>5],
                ['text'=>'Berkumpul sesama daerah','weight'=>1],
                ['text'=>'Kerja sama jika diwajibkan','weight'=>2],
                ['text'=>'Bergaul sesama luar Jawa','weight'=>4],
            ],
            '35124'
        );
        /*
        |--------------------------------------------------------------------------
        | TKP 86–110  (material_id = 41, WEIGHT ONLY)
        |--------------------------------------------------------------------------
        */

        // 86
        $q(41,'tkp',
            'Atasan meminta laporan segera, namun data belum lengkap. Apa sikap terbaik?',
            [
                ['text'=>'Mengirim laporan apa adanya','weight'=>1],
                ['text'=>'Meminta perpanjangan waktu','weight'=>4],
                ['text'=>'Melengkapi data paling krusial terlebih dahulu','weight'=>5],
                ['text'=>'Menunggu data lengkap tanpa kabar','weight'=>2],
                ['text'=>'Menyerahkan tugas ke rekan','weight'=>3],
            ],
            '14523'
        );

        // 87
        $q(41,'tkp',
            'Rekan kerja sering terlambat sehingga mengganggu tim. Apa yang sebaiknya dilakukan?',
            [
                ['text'=>'Menegur di depan umum','weight'=>1],
                ['text'=>'Melaporkan ke atasan langsung','weight'=>4],
                ['text'=>'Mengingatkan secara pribadi','weight'=>5],
                ['text'=>'Membiarkan saja','weight'=>2],
                ['text'=>'Mengurangi kerja sama','weight'=>3],
            ],
            '14523'
        );

        // 88
        $q(41,'tkp',
            'Anda diminta lembur padahal ada acara keluarga penting. Apa yang dilakukan?',
            [
                ['text'=>'Menolak tanpa alasan','weight'=>1],
                ['text'=>'Menghadiri acara keluarga saja','weight'=>2],
                ['text'=>'Mencari solusi penjadwalan ulang','weight'=>5],
                ['text'=>'Meminta rekan menggantikan','weight'=>4],
                ['text'=>'Datang terlambat','weight'=>3],
            ],
            '12543'
        );

        // 89
        $q(41,'tkp',
            'Terjadi konflik antaranggota tim. Apa langkah terbaik ketua?',
            [
                ['text'=>'Menyalahkan salah satu pihak','weight'=>1],
                ['text'=>'Mendengarkan kedua pihak','weight'=>5],
                ['text'=>'Menunda penyelesaian','weight'=>2],
                ['text'=>'Mengambil keputusan sepihak','weight'=>3],
                ['text'=>'Melibatkan pihak luar','weight'=>4],
            ],
            '15234'
        );

        // 90
        $q(41,'tkp',
            'Anda menemukan kesalahan kecil pada laporan rekan. Apa sikap terbaik?',
            [
                ['text'=>'Mengabaikan karena kecil','weight'=>1],
                ['text'=>'Memperbaiki tanpa memberi tahu','weight'=>2],
                ['text'=>'Memberi tahu dan mendiskusikan perbaikan','weight'=>5],
                ['text'=>'Melaporkan ke atasan','weight'=>4],
                ['text'=>'Menunggu diminta','weight'=>3],
            ],
            '12543'
        );

        // 91
        $q(41,'tkp',
            'Pimpinan memberi tugas di luar jobdesc. Sikap terbaik?',
            [
                ['text'=>'Menolak','weight'=>1],
                ['text'=>'Menerima sambil belajar','weight'=>5],
                ['text'=>'Menyarankan orang lain','weight'=>3],
                ['text'=>'Menunda','weight'=>2],
                ['text'=>'Menerima dengan keluhan','weight'=>4],
            ],
            '15324'
        );

        // 92
        $q(41,'tkp',
            'Anda diminta memilih antara dua rekan yang sama kompeten. Apa langkah terbaik?',
            [
                ['text'=>'Memilih yang dekat','weight'=>1],
                ['text'=>'Memilih secara acak','weight'=>2],
                ['text'=>'Menilai berdasarkan kebutuhan tugas','weight'=>5],
                ['text'=>'Meminta pendapat tim','weight'=>4],
                ['text'=>'Menunda keputusan','weight'=>3],
            ],
            '12543'
        );

        // 93
        $q(41,'tkp',
            'Rekan kerja meminta bantuan saat Anda juga sibuk. Apa yang dilakukan?',
            [
                ['text'=>'Menolak langsung','weight'=>1],
                ['text'=>'Menunda tanpa kepastian','weight'=>2],
                ['text'=>'Membantu setelah menyelesaikan prioritas','weight'=>5],
                ['text'=>'Mencarikan bantuan lain','weight'=>4],
                ['text'=>'Membantu seadanya','weight'=>3],
            ],
            '12543'
        );

        // 94
        $q(41,'tkp',
            'Anda mendapat kritik keras di rapat. Sikap terbaik?',
            [
                ['text'=>'Membela diri berlebihan','weight'=>1],
                ['text'=>'Menerima dan mengevaluasi','weight'=>5],
                ['text'=>'Diam saja','weight'=>2],
                ['text'=>'Menyalahkan pihak lain','weight'=>3],
                ['text'=>'Meninggalkan rapat','weight'=>4],
            ],
            '15234'
        );

        // 95
        $q(41,'tkp',
            'Tim Anda gagal mencapai target. Apa tindakan ketua?',
            [
                ['text'=>'Menyalahkan anggota','weight'=>1],
                ['text'=>'Mengevaluasi bersama','weight'=>5],
                ['text'=>'Mengabaikan hasil','weight'=>2],
                ['text'=>'Mengganti anggota','weight'=>3],
                ['text'=>'Melapor ke atasan','weight'=>4],
            ],
            '15234'
        );

        // 96
        $q(41,'tkp',
            'Rekan menyebarkan gosip di kantor. Apa sikap terbaik?',
            [
                ['text'=>'Ikut menyebarkan','weight'=>1],
                ['text'=>'Menegur secara halus','weight'=>4],
                ['text'=>'Tidak menanggapi dan fokus kerja','weight'=>5],
                ['text'=>'Melaporkan langsung','weight'=>3],
                ['text'=>'Menegur keras','weight'=>2],
            ],
            '14532'
        );

        // 97
        $q(41,'tkp',
            'Anda harus menyampaikan kabar buruk ke klien. Apa pendekatan terbaik?',
            [
                ['text'=>'Menunda penyampaian','weight'=>1],
                ['text'=>'Menyampaikan apa adanya tanpa empati','weight'=>2],
                ['text'=>'Menyampaikan dengan empati dan solusi','weight'=>5],
                ['text'=>'Mengirim pesan singkat saja','weight'=>3],
                ['text'=>'Meminta rekan menyampaikan','weight'=>4],
            ],
            '12543'
        );

        // 98
        $q(41,'tkp',
            'Anda melihat rekan melanggar aturan ringan. Apa yang sebaiknya dilakukan?',
            [
                ['text'=>'Membiarkan','weight'=>1],
                ['text'=>'Menegur secara pribadi','weight'=>5],
                ['text'=>'Melaporkan langsung','weight'=>4],
                ['text'=>'Mengingatkan di depan umum','weight'=>2],
                ['text'=>'Menunggu atasan bertindak','weight'=>3],
            ],
            '15243'
        );

        // 99
        $q(41,'tkp',
            'Anda ditugaskan bekerja dengan tim baru. Langkah awal terbaik?',
            [
                ['text'=>'Bekerja sendiri','weight'=>1],
                ['text'=>'Menunggu arahan','weight'=>2],
                ['text'=>'Mengenal anggota dan peran','weight'=>5],
                ['text'=>'Menetapkan aturan sepihak','weight'=>3],
                ['text'=>'Mengikuti kebiasaan lama','weight'=>4],
            ],
            '12534'
        );

        // 100
        $q(41,'tkp',
            'Rekan kerja mengalami masalah pribadi yang memengaruhi kinerja. Apa sikap Anda?',
            [
                ['text'=>'Mengabaikan','weight'=>1],
                ['text'=>'Menegur keras','weight'=>2],
                ['text'=>'Memberi dukungan dan fleksibilitas','weight'=>5],
                ['text'=>'Mengambil alih tugas','weight'=>4],
                ['text'=>'Melapor ke atasan','weight'=>3],
            ],
            '12543'
        );

        // 101
        $q(41,'tkp',
            'Anda menemukan peluang efisiensi kerja. Apa yang dilakukan?',
            [
                ['text'=>'Menyimpan sendiri','weight'=>1],
                ['text'=>'Menyampaikan ke atasan','weight'=>5],
                ['text'=>'Menerapkan sendiri tanpa izin','weight'=>2],
                ['text'=>'Mendiskusikan dengan tim','weight'=>4],
                ['text'=>'Menunggu momen tepat','weight'=>3],
            ],
            '15243'
        );

        // 102
        $q(41,'tkp',
            'Ada perbedaan pendapat tajam di tim. Apa langkah terbaik?',
            [
                ['text'=>'Memaksakan pendapat','weight'=>1],
                ['text'=>'Menghindari diskusi','weight'=>2],
                ['text'=>'Mencari titik temu','weight'=>5],
                ['text'=>'Menyerahkan ke atasan','weight'=>4],
                ['text'=>'Membiarkan konflik','weight'=>3],
            ],
            '12543'
        );

        // 103
        $q(41,'tkp',
            'Anda mendapat tugas mendesak bersamaan. Apa prioritas?',
            [
                ['text'=>'Mengerjakan yang mudah dulu','weight'=>2],
                ['text'=>'Menentukan skala prioritas','weight'=>5],
                ['text'=>'Mengerjakan acak','weight'=>1],
                ['text'=>'Meminta perpanjangan','weight'=>3],
                ['text'=>'Mendelegasikan','weight'=>4],
            ],
            '21534'
        );

        // 104
        $q(41,'tkp',
            'Rekan meminta akses data sensitif tanpa wewenang. Apa sikap Anda?',
            [
                ['text'=>'Memberikan akses','weight'=>1],
                ['text'=>'Menolak dan jelaskan prosedur','weight'=>5],
                ['text'=>'Memberikan sebagian','weight'=>2],
                ['text'=>'Melapor ke atasan','weight'=>4],
                ['text'=>'Menghindari jawaban','weight'=>3],
            ],
            '15243'
        );

        // 105
        $q(41,'tkp',
            'Anda diminta menilai kinerja rekan dekat. Apa yang dilakukan?',
            [
                ['text'=>'Memberi nilai tinggi','weight'=>2],
                ['text'=>'Menilai objektif','weight'=>4],
                ['text'=>'Menilai rendah','weight'=>1],
                ['text'=>'Menunda penilaian','weight'=>3],
                ['text'=>'Meminta orang lain','weight'=>5],
            ],
            '24135'
        );

        // 106
        $q(41,'tkp',
            'Anda harus bekerja dengan sistem baru. Sikap terbaik?',
            [
                ['text'=>'Menolak perubahan','weight'=>1],
                ['text'=>'Belajar dan beradaptasi','weight'=>5],
                ['text'=>'Menunggu pelatihan','weight'=>3],
                ['text'=>'Mengeluh','weight'=>2],
                ['text'=>'Mencari jalan pintas','weight'=>4],
            ],
            '15324'
        );

        // 107
        $q(41,'tkp',
            'Rekan tidak memenuhi komitmen tugas. Apa langkah Anda?',
            [
                ['text'=>'Mengambil alih tanpa bicara','weight'=>2],
                ['text'=>'Mengingatkan dan klarifikasi','weight'=>5],
                ['text'=>'Melapor','weight'=>4],
                ['text'=>'Membiarkan','weight'=>1],
                ['text'=>'Menunda pekerjaan','weight'=>3],
            ],
            '25413'
        );

        // 108
        $q(41,'tkp',
            'Anda mendapat masukan anonim. Apa sikap terbaik?',
            [
                ['text'=>'Mengabaikan','weight'=>1],
                ['text'=>'Menilai substansi masukan','weight'=>5],
                ['text'=>'Mencari siapa pengirim','weight'=>2],
                ['text'=>'Menyebarkan ke tim','weight'=>3],
                ['text'=>'Menunggu arahan','weight'=>4],
            ],
            '15234'
        );

        // 109
        $q(41,'tkp',
            'Anda harus memutuskan cepat dengan informasi terbatas. Apa langkah terbaik?',
            [
                ['text'=>'Menunda keputusan','weight'=>2],
                ['text'=>'Mengambil keputusan paling aman','weight'=>5],
                ['text'=>'Menunggu instruksi','weight'=>1],
                ['text'=>'Bertanya ke semua pihak','weight'=>3],
                ['text'=>'Mengambil risiko tinggi','weight'=>4],
            ],
            '21534'
        );

        // 110
        $q(41,'tkp',
            'Setelah proyek selesai, apa tindakan terbaik?',
            [
                ['text'=>'Langsung pindah proyek','weight'=>2],
                ['text'=>'Menyusun laporan evaluasi','weight'=>5],
                ['text'=>'Merayakan sederhana','weight'=>4],
                ['text'=>'Menunggu perintah','weight'=>1],
                ['text'=>'Menyimpan dokumentasi','weight'=>3],
            ],
            '25413'
        );
    }
}
