<?php

namespace Database\Seeders;

use App\Models\QuestionCategory;
use App\Models\QuestionMaterial;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TKP4Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data untuk kategori 1 (Blind Test) - soal 1-10
        $materialBT = QuestionMaterial::create([
            'category_id' => 1,
            'name' => 'BT - TKP 4',
            'slug' => 'bt-tkp-4',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Soal 1-10 untuk Blind Test
        $questionsBT = [
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda sedang bertugas di meja informasi. Seorang warga datang dalam keadaan panik karena kehilangan dompet berisi dokumen penting di area kantor. Warga tersebut memarahi Anda karena dianggap tidak sigap menjaga keamanan. Sikap Anda adalah …',
                'explanation' => 'Kunci: AECBD',
                'options' => [
                    ['option_text' => 'Menengakkan warga dan membantu menelusuri jejak kehilangan bersama petugas keamanan', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menjelaskan bahwa keamanan bukan tanggung jawab Anda langsung', 'weight' => 2, 'order' => 2],
                    ['option_text' => 'Menyuruh warga membuat laporan tertulis terlebih dahulu sebelum dilakukan pencarian', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Menyalahkan warga karena kurang hati-hati menyimpan barang', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Menghubungi pihak kebersihan untuk mencari kemungkinan dompet tertinggal', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda mendapat laporan bahwa seorang warga lanjut usia tidak mampu mengakses layanan digital yang baru diterapkan. Ia datang langsung ke kantor untuk meminta bantuan. Tindakan Anda adalah …',
                'explanation' => 'Kunci: ACDBE',
                'options' => [
                    ['option_text' => 'Membantunya menggunakan sistem digital sambil menjelaskan langkah-langkahnya', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menyarankan agar meminta bantuan anak atau cucunya di rumah', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Mengisi data warga tersebut sendiri agar prosesnya cepat', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Memberikan selebaran panduan umum tanpa pendampingan', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Mengarahkan warga tersebut ke meja lain agar ditangani petugas lain', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda bekerja di bagian layanan perizinan. Seorang pemohon memohon keringanan waktu karena dokumen yang dibutuhkan belum lengkap akibat faktor eksternal. Apa langkah Anda?',
                'explanation' => 'Kunci: BDCAE',
                'options' => [
                    ['option_text' => 'Menolak permohonan karena dokumen wajib lengkap sesuai aturan', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Memberi penjelasan alternatif agar pemohon bisa melengkapi lebih cepat', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Menerima berkas dulu agar tidak menyulitkan pemohon', 'weight' => 5, 'order' => 3],
                    ['option_text' => 'Meminta izin atasan untuk mempertimbangkan kasus khusus', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Menyarankan pemohon mengajukan ulang di periode berikutnya', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda melihat antrean panjang di loket pembayaran karena sistem lambat. Banyak warga mulai gelisah. Sementara rekan kerja Anda tampak santai bermain ponsel. Apa yang Anda lakukan?',
                'explanation' => 'Kunci: BADCE',
                'options' => [
                    ['option_text' => 'Meminta rekan kerja untuk membantu mempercepat pelayanan', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Mengambil alih sementara agar warga tidak terlalu lama menunggu', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Melaporkan rekan kerja ke atasan karena lalai dalam tugas', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Menengakkan warga sambil menjelaskan kendala yang terjadi', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Diam saja agar tidak menimbulkan ketegangan dengan rekan kerja', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda bertugas di kantor kelurahan. Seorang warga meminta tanda tangan pejabat yang sedang tidak di tempat. Ia memohon agar dokumen ditandatangani oleh Anda saja agar tidak menunggu lama. Bagaimana Anda bersikap?',
                'explanation' => 'Kunci: ADCEB',
                'options' => [
                    ['option_text' => 'Menolak dengan sopan dan menjelaskan bahwa kewenangan tanda tangan ada pada pejabat bersangkutan', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menandatangani dokumen agar warga tidak kecewa', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Menyarankan warga meninggalkan dokumen dan kembali esok hari', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Menghubungi pejabat terkait untuk meminta arahan', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Menyuruh warga ke kantor lain agar tidak menunggu lama', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Sebagai pegawai negeri sipil di sebuah kementerian, pada sesi orientasi pegawai baru kamu mendapati bahwa salah satu materi yang disampaikan oleh pemateri tamu mengandung narasi yang menonjolkan intoleransi terhadap kelompok agama minoritas, meskipun secara langsung tidak menyebut nama. Banyak peserta ragu dan merasa kurang nyaman, tetapi sebagian besar diam saja. Dalam peranmu sebagai fasilitator orientasi, bagaimana kamu menyikapi situasi ini agar nilai kebangsaan tetap ditegakkan dan suasana tetap kondusif?',
                'explanation' => 'Kunci: BAEDC',
                'options' => [
                    ['option_text' => 'Segera mengingatkan pemateri untuk menyesuaikan bahasa dan memperkuat pesan toleransi sebelum materi dilanjutkan', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Menyiapkan sesi diskusi refleksi setelah materi untuk membahas implikasi toleransi dan radikalisme dengan semua peserta', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Mengabaikan kejadian sementara dan fokus pada agenda selanjutnya agar orientasi tidak tertunda', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Mengirimkan laporan tertulis ke atasan dan bagian kepegawaian agar pemateri dievaluasi', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Meminta peserta yang merasa terganggu untuk berdiskusi secara pribadi dan memberikan feedback ke panitia', 'weight' => 3, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Di lingkungan pemerintahan daerah, kamu mendapatkan laporan bahwa sebuah kelompok komunitas dakwah rutin mengadakan pertemuan di kantor wilayah setempat dengan tema "pembentukan generasi unggul berdasarkan ajaran eksklusif". Beberapa pegawai yang ikut merasa tergerak, namun ada juga yang khawatir itu bisa menjadi pintu masuk paham radikal. Apa keputusan strategis yang paling manusiawi dan efektif untuk memastikan kegiatan komunitas tersebut tetap sejalan dengan nilai NKRI dan Pancasila?',
                'explanation' => 'Kunci: ACDBE',
                'options' => [
                    ['option_text' => 'Mengajak pihak komunitas dan pemda untuk dialog terbuka membahas visi mereka dan memastikan program mereka inklusif', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Meminta komunitas menghentikan kegiatan hingga ada izin resmi dan verifikasi program', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Memfasilitasi pelatihan moderasi beragama bagi anggota komunitas agar pendekatannya lebih membangun kebangsaan', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Mendorong unit kepegawaian agar memantau pegawai yang ikut kegiatan tersebut untuk memastikan tidak ada pelibatan ideologi ekstrem', 'weight' => 4, 'order' => 4],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Dalam rapat penelitian pendidikan tinggi, tim kamu menampilkan data bahwa generasi muda (Gen Z) memiliki indeks potensi radikalisme lebih tinggi dibanding generasi sebelumnya. Pimpinan universitas meminta rekomendasi program yang sesuai untuk kampus. Langkah program mana yang paling tepat untuk memasukkan edukasi antiradikalisme ke dalam ekosistem kampus?',
                'explanation' => 'Kunci: ACEDB',
                'options' => [
                    ['option_text' => 'Mengintegrasikan modul wajib "Wawasan Kebangsaan & Deradikalisasi" ke dalam kurikulum umum semua mahasiswa', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Mengadakan seminar tunggal tiap semester dengan topik antiradikalisme terbuka untuk umum', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Membentuk unit kegiatan mahasiswa yang khusus mempromosikan keberagaman dan menolak radikalisme', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Memberikan penghargaan bagi fakultas yang jumlah partisipasi mahasiswa dalam kegiatan moderasi tertinggi', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Mengirim dosen ke pelatihan antiradikalisme dan mereka kemudian menyediakan satu sesi kecil di tiap kelas', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Saat kamu menjadi koordinator program di Biro Sosial Pemprov, ada isu viral bahwa sebuah konten video di media sosial menyebarkan pesan radikalisme terselubung—menggunakan retorika kebencian, namun bungkusnya dakwah religius. Instansi sedang mempertimbangkan opsi untuk pembinaan atau penutupan akun konten tersebut. Dalam menanggapi isu ini, pendekatan mana yang paling tepat untuk menjaga kebebasan beragama sekaligus menolak radikalisme?',
                'explanation' => 'Kunci: ACEDB',
                'options' => [
                    ['option_text' => 'Memanggil pembuat konten dan melakukan dialog mendalam untuk memahami motif, lalu memberikan pembinaan', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Mengajukan pemblokiran akun segera agar konten tidak menyebar lebih luas', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Meluncurkan kampanye publik yang menjelaskan tanda-tanda konten radikalisme dan bagaimana masyarakat bisa melaporkannya', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Mengundang tokoh agama dari berbagai latar belakang untuk memberikan klarifikasi publik tentang konten tersebut', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Menyusun panduan internal bagi seluruh pegawai tentang bagaimana menyikapi dan melaporkan konten serupa secara cepat', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Suatu pagi di Kantor Wilayah, kamu mendengar diskusi antarpagawai tentang tafsir agama yang membawa stereotip tertentu terhadap kelompok etnis lain. Meski tidak berujung ke tindakan radikal, obrolan mulai memunculkan atmosfer "kami vs mereka". Nilai dasar apa yang paling penting untuk kamu angkat agar diskusi internal tersebut tetap sehat dan inklusif?',
                'explanation' => 'Kunci: ACDEB',
                'options' => [
                    ['option_text' => 'Kebhinekaan dan persatuan bangsa sebagai fondasi semua tindakan ASN', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Kebenaran tafsir agama sebagai orientasi utama diskusi, tanpa kompromi', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Kebebasan berpikir dan bertanya sebagai bagian dari demokrasi internal', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Ketangguhan ASN dalam menghadapi pengaruh eksternal ideologi radikal', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Transparansi dalam diskusi agar semua pihak tahu latar belakang pembicaraan', 'weight' => 4, 'order' => 5],
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
                    'is_correct' => false,
                    'weight' => $optionData['weight'],
                    'order' => $optionData['order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Data untuk kategori 2 (Post Test) - soal 11-20
        $materialPT = QuestionMaterial::create([
            'category_id' => 2,
            'name' => 'PT - TKP 4',
            'slug' => 'pt-tkp-4',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Soal 11-20 untuk Post Test
        $questionsPT = [
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda ditunjuk sebagai wakil instansi dalam proyek kolaborasi digital antara pemerintah daerah, universitas, dan sektor swasta. Pada rapat perdana, perwakilan sektor swasta meminta data internal instansi Anda untuk mempercepat proses analisis, namun Anda belum mendapat izin dari pimpinan. Rekan dari universitas sudah menyetujui permintaan tersebut. Sikap Anda yang paling tepat adalah …',
                'explanation' => 'Kunci: ACEDB',
                'options' => [
                    ['option_text' => 'Menyampaikan bahwa Anda tidak berwenang membagikan data tanpa izin pimpinan, sambil menawarkan data umum yang bisa diakses publik', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Memberikan data tersebut demi menjaga hubungan baik dengan mitra agar proyek tidak tertunda', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Menghubungi pimpinan setelah rapat dan menunggu keputusan sebelum memberikan tanggapan resmi', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Menunda respons dan berharap mitra memahami situasi internal instansi Anda', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Mengalihkan pembahasan ke topik lain agar tidak terjadi perdebatan terbuka', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda bekerja di lembaga pusat yang menjalin kerja sama dengan kantor cabang di berbagai provinsi. Salah satu kantor cabang mengeluh bahwa kebijakan baru dari pusat tidak mempertimbangkan kondisi lokal. Dalam forum daring, keluhan ini disampaikan secara terbuka di hadapan mitra eksternal. Tindakan Anda yang paling tepat untuk menjaga hubungan baik adalah …',
                'explanation' => 'Kunci: BCADE',
                'options' => [
                    ['option_text' => 'Menegaskan bahwa kebijakan pusat dibuat dengan pertimbangan nasional dan harus dijalankan secara seragam', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Menghubungi pihak cabang secara pribadi untuk memahami kendala dan mencari solusi yang bisa disampaikan bersama', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Menyampaikan klarifikasi di forum bahwa masukan tersebut akan ditampung untuk pembahasan lanjutan', 'weight' => 5, 'order' => 3],
                    ['option_text' => 'Mengabaikan pernyataan tersebut karena tidak sesuai etika organisasi', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Menyampaikan kritik balik agar pihak cabang tidak menjelekkan institusi di depan mitra lain', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Dalam proyek kerja sama dengan LSM lingkungan, Anda ditugaskan mengoordinasikan kegiatan penanaman pohon. LSM tersebut meminta perubahan lokasi acara mendadak karena alasan aksesibilitas, padahal Anda sudah mengurus izin resmi untuk lokasi awal. Bagaimana tindakan Anda?',
                'explanation' => 'Kunci: ADBEC',
                'options' => [
                    ['option_text' => 'Menjelaskan kendala izin dan mencari alternatif bersama yang masih sesuai ketentuan', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Meminta mereka tetap melaksanakan di lokasi awal agar tidak mengacaukan jadwal', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Menyetujui perubahan karena alasan sosial lebih penting daripada administrasi', 'weight' => 4, 'order' => 3],
                    ['option_text' => 'Mengusulkan agar kegiatan ditunda sampai izin lokasi baru selesai diurus', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Menyerahkan keputusan pada pimpinan tanpa berinisiatif memberikan solusi', 'weight' => 3, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Anda bekerja sebagai staf di instansi yang bermitra dengan lembaga internasional. Salah satu rekan dari lembaga asing sering mengirimkan permintaan informasi di luar jam kerja, bahkan pada hari libur. Jika Anda membalas terlalu lama, pekerjaan terhambat, tetapi jika terlalu cepat, ritme kerja Anda terganggu. Tindakan paling bijak adalah ...',
                'explanation' => 'Kunci: AEDB',
                'options' => [
                    ['option_text' => 'Menjelaskan batas waktu kerja instansi Anda secara sopan agar komunikasi lebih efisien', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Tetap merespons cepat agar hubungan internasional tetap baik', 'weight' => 2, 'order' => 2],
                    ['option_text' => 'Mengabaikan pesan di luar jam kerja untuk menjaga keseimbangan pribadi', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Meminta pimpinan membuat kebijakan khusus untuk komunikasi lintas zona waktu', 'weight' => 4, 'order' => 4],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Dalam forum koordinasi antarinstansi, Anda melihat dua instansi saling bersaing klaim keberhasilan program. Padahal proyek tersebut merupakan hasil kolaborasi bersama. Sikap Anda sebagai peserta forum adalah ...',
                'explanation' => 'Kunci: DACEB',
                'options' => [
                    ['option_text' => 'Menegaskan bahwa keberhasilan proyek adalah hasil kerja sama semua pihak', 'weight' => 1, 'order' => 1],
                    ['option_text' => 'Menghindari komentar agar tidak terlibat dalam perdebatan', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Memberi pujian kepada kedua instansi agar situasi kembali kondusif', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Mengusulkan agar laporan kinerja proyek dibuat bersama secara kolektif', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Melaporkan situasi tersebut ke pimpinan agar diselesaikan di level atas', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Kamu sedang menangani proyek bersama tim lintas divisi. Salah satu anggota dari divisi lain sering menunda pekerjaan dengan alasan masih banyak beban di bagiannya. Hal ini membuat progres proyek melambat, sementara tenggat waktu semakin dekat. Apa langkah terbaik yang kamu lakukan untuk menjaga profesionalisme kerja tim?',
                'explanation' => 'Kunci: AEDBC',
                'options' => [
                    ['option_text' => 'Menghubungi rekan tersebut secara pribadi untuk mencari solusi bersama', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Melapor kepada atasan agar diberikan instruksi langsung', 'weight' => 2, 'order' => 2],
                    ['option_text' => 'Membiarkan saja karena tidak ingin terlihat mencampuri urusan divisi lain', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Mengambil alih sebagian tugasnya agar proyek tidak tertunda', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Mengingatkan secara sopan di forum rapat agar lebih bertanggung jawab', 'weight' => 3, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Seorang rekan kerja memintamu untuk mengganti tanda tangan kehadiran karena ia terlambat datang. Ia beralasan hanya terlambat sedikit dan sudah sering membantu pekerjaanmu sebelumnya. Bagaimana tindakanmu yang paling profesional?',
                'explanation' => 'Kunci: ACEBD',
                'options' => [
                    ['option_text' => 'Menolak dengan sopan dan mengingatkan pentingnya kejujuran dalam administrasi kantor', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menggantinya kali ini saja karena ingin menjaga hubungan baik', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Menyarankan agar ia meminta izin langsung kepada atasan', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Mengabaikan permintaan itu tanpa memberikan alasan', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Mengingatkan bahwa tindakan seperti itu bisa berisiko bagi keduanya', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Kamu bekerja di lingkungan yang sangat beragam, baik dari segi usia, budaya, maupun latar belakang pendidikan. Dalam sebuah rapat, ide dari pegawai muda tidak dianggap serius oleh pegawai senior. Apa yang sebaiknya kamu lakukan untuk menjaga profesionalisme dan inklusivitas kerja?',
                'explanation' => 'Kunci: BAEDC',
                'options' => [
                    ['option_text' => 'Memberikan dukungan pada ide pegawai muda dan membantu menyampaikannya dengan lebih jelas', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Menyarankan agar semua ide dikaji bersama tanpa memandang usia', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Diam saja agar tidak menimbulkan perdebatan', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Mengusulkan agar ide pegawai muda ditunda untuk dibahas lain waktu', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Menyampaikan kritik pada sikap senior setelah rapat selesai', 'weight' => 3, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Kamu mendapati laporan keuangan proyek mengalami selisih kecil, dan rekanmu berkata itu hal sepele karena jumlahnya tidak besar. Namun kamu tahu bahwa akurasi laporan harus tetap dijaga. Apa langkah yang sebaiknya kamu lakukan?',
                'explanation' => 'Kunci: ADCEB',
                'options' => [
                    ['option_text' => 'Memeriksa kembali laporan secara detail dan memperbaikinya sebelum diserahkan', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Membiarkan karena nominalnya kecil dan tidak berdampak besar', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Mengingatkan rekanmu untuk lebih teliti tanpa mempermasalahkan lebih jauh', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Melaporkan selisih itu kepada atasan agar tidak menjadi temuan di kemudian hari', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Menyimpan catatan pribadi tentang selisih tersebut untuk berjaga-jaga', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Kamu baru dipromosikan menjadi koordinator tim. Dalam rapat pertama, kamu menemukan bahwa gaya kepemimpinanmu berbeda dengan pemimpin sebelumnya yang lebih otoriter, sementara tim tampak masih terbiasa menunggu instruksi. Bagaimana kamu membangun profesionalisme dalam kepemimpinanmu?',
                'explanation' => 'Kunci: ACBDE',
                'options' => [
                    ['option_text' => 'Menjelaskan visi dan ekspektasi dengan jelas namun tetap terbuka terhadap masukan', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Meminta tim untuk memberikan ide dan inisiatif secara aktif', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Memberikan instruksi detail seperti sebelumnya agar tim nyaman', 'weight' => 4, 'order' => 3],
                    ['option_text' => 'Mengadakan sesi brainstorming untuk melibatkan semua anggota', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Menunggu tim beradaptasi secara alami dengan gaya barumu', 'weight' => 2, 'order' => 5],
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
                    'is_correct' => false,
                    'weight' => $optionData['weight'],
                    'order' => $optionData['order'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Seeder TKP berhasil dibuat!');
        $this->command->info('Blind Test (soal 1-10): ' . count($questionsBT) . ' soal');
        $this->command->info('Post Test (soal 11-20): ' . count($questionsPT) . ' soal');
    }
}
