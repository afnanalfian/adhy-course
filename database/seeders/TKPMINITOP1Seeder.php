<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Database\Seeder;

class TKP2MINITOP1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari atau buat material dengan id 75
        $material = QuestionMaterial::firstOrCreate(
            ['id' => 75],
            [
                'category_id' => 2,
                'name' => 'TKP - 2 Juni',
                'slug' => 'tkp-2-juni',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Data soal TKP 45 nomor dengan kunci bobot
        // Format kunci: misal "15234" berarti A=1, B=5, C=2, D=3, E=4
        $questionsData = [
            // Soal 1 - 15234
            [
                'text' => 'Ferdian memiliki tetangga yang baru pulang setelah lama bertugas di luar negeri. Warga mengeluh tetangga tersebut tertutup dan kurang berinteraksi. Padahal, sebentar lagi akan ada perayaan di perumahan dan Ferdian ditunjuk menjadi ketua panitia. Apa yang sebaiknya dilakukan Ferdian?',
                'options' => [
                    'Tidak perlu ikut mencampuri urusan warga baru.',
                    'Mengajak tetangga tersebut untuk berkenalan dengan tetangga yang lain.',
                    'Mewajibkan semua warga untuk berkumpul dan berinteraksi.',
                    'Menyapa tetangga tersebut saat bertemu di perumahan.',
                    'Bersilaturahmi ke rumah tetangga tersebut untuk memperkenalkan diri.',
                ],
                'weights' => [1, 5, 2, 3, 4],
            ],
            // Soal 2 - 21354
            [
                'text' => 'Andra buru-buru memasuki sekolah karena akan ujian akhir. Ketika melewati halaman sekolah, ia melihat temannya jatuh dari motor dan terluka. Apa yang dilakukan Andra?',
                'options' => [
                    'Memberikan tisu miliknya untuk membersihkan luka.',
                    'Mengatakan tidak bisa membantu karena akan ujian.',
                    'Mendekati temannya untuk memeriksa kondisinya.',
                    'Mengantarkannya ke UKS untuk diberikan obat luka.',
                    'Membantunya untuk segera bangun dan duduk kembali.',
                ],
                'weights' => [2, 1, 3, 5, 4],
            ],
            // Soal 3 - 13254
            [
                'text' => 'Siddiq dan Fadel memperoleh tugas kelompok membuat alat peraga siklus air. Mereka berselisih pendapat tentang desain dan bahan alat peraga yang akan dibuat. Setelah satu jam berdiskusi, belum tercapai kesepakatan. Siddiq mulai merasa sebal. Apa yang dilakukan Siddiq?',
                'options' => [
                    'Menyampaikan pada guru bahwa ia tidak bisa bekerja sama dengan Fadel',
                    'Menyesuaikan cara berinteraksinya sehingga situasi menjadi lebih positif',
                    'Mengabaikan Fadel dan mengerjakan tugas yang diberikan secara individual',
                    'Mengajak Fadel untuk bersama-sama merumuskan cara baru dengan mengurangi ego masing-masing.',
                    'Menghargai perbedaan pendapat yang ada dan mencoba tetap bersikap positif',
                ],
                'weights' => [1, 3, 2, 5, 4],
            ],
            // Soal 4 - 31245
            [
                'text' => 'Fadiyah mulai cemas karena hari sudah sore dan ia belum menyelesaikan tugas sekolah yang harus dikumpulkan besok pagi. Tiba-tiba kakaknya menghampiri dengan ribut karena novel kesayangannya rusak setelah dipinjam Fadiyah. Apa yang dilakukan Fadiyah?',
                'options' => [
                    'Meredam emosinya dan kakaknya supaya tidak semakin kacau.',
                    'Memandang sinis pada kakaknya yang sedang marah-marah',
                    'Menegur kakaknya dengan ketus supaya tidak terlalu ribut.',
                    'merespons dengan baik supaya kakaknya tidak semakin marah.',
                    'Meminta maaf dan menyampaikan bahwa ia akan menggantinya.',
                ],
                'weights' => [3, 1, 2, 4, 5],
            ],
            // Soal 5 - 12354
            [
                'text' => 'Ola sering mendapat nilai tertinggi dalam melakukan tugas kelompok, padahal ia jarang terlibat dalam pengerjaan tugas. Kali ini Ola ingin terlibat, tetapi ia perlu dijelaskan tugasnya. Fina adalah teman dalam kelompok Ola yang cukup perhatian, tetapi ia juga jengkel kepada Ola. Apa reaksi Fina?',
                'options' => [
                    'Membiarkannya untuk mencoba mencari informasi sendiri.',
                    'Menjawab pertanyaannya dan segera beralih ke tugasnya sendiri.',
                    'Menawarkan diri mendiskusikan tugasnya dan Ola dapat bertanya jika tidak paham.',
                    'Menjelaskan dengan terperinci agar ia mengerjakan bagian tugasnya dengan baik',
                    'Memastikan ia memahami tugasnya dengan mengajaknya untuk mengerjakan bersama.',
                ],
                'weights' => [1, 2, 3, 5, 4],
            ],
            // Soal 6 - 41235
            [
                'text' => 'Dania adalah koordinator siswa untuk kegiatan karyawisata kelas IX ke Yogyakarta. Pihak sekolah memasang biaya cukup mahal untuk kegiatan ini guna menjamin kenyamanan para siswa. Teman-teman Dania mengkritik kenapa dia tidak memprotes biaya karyawisata tersebut. Reaksi Dania adalah...',
                'options' => [
                    'menanggapi pertanyaan tersebut secara serius dan berusaha bertanya kepada guru atau kepala sekolah agar bisa menjawabnya.',
                    'mengabaikan saja pertanyaan tersebut karena Dania tidak ikut terlibat dalam menentukan anggaran biaya yang dibutuhkan',
                    'mendengarkan pertanyaan yang diajukan teman-temannya dan mencoba memahami keberatan mereka terkait biaya kegiatan.',
                    'memikirkan jawaban yang sekiranya paling dapat diterima oleh teman-temannya atas pertanyaan yang mereka sampaikan',
                    'memberikan jawaban sesuai dengan informasi yang ia peroleh dan mencoba mencari informasi lebih lanjut dari kepala sekolah.',
                ],
                'weights' => [4, 1, 2, 3, 5],
            ],
            // Soal 7 - 45321
            [
                'text' => 'Bu Aini sudah puluhan tahun berjualan aneka kue di rumahnya. Kue-kuenya selalu laris dan dipuji pelanggan. Untuk pertama kalinya, seorang pelanggan menyampaikan kritik dan saran mengenai kue buatan Bu Aini. Apa tindakan Bu Aini?',
                'options' => [
                    'Mendengarkan dengan baik kritik dan saran yang disampaikan oleh pelanggan itu.',
                    'Memanfaatkan umpan balik yang diberikan untuk memperbaiki kualitas dagangan',
                    'Menerima dengan terbuka umpan balik yang disampaikan oleh pelanggan tersebut.',
                    'Mencoba mencari solusi yang sesuai untuk menanggapi umpan balik pelanggan.',
                    'Mengabaikan umpan balik tersebut karena selama ini pelanggan selalu tampak puas.',
                ],
                'weights' => [4, 5, 3, 2, 1],
            ],
            // Soal 8 - 14325
            [
                'text' => 'Ada isu sensitif yang menghambat kerja sama di tempat kerja Anda akhir-akhir ini. Semakin isu itu disentuh, semakin besar pertentangan yang muncul di antara rekan sekerja Anda. Apa yang akan Anda lakukan?',
                'options' => [
                    'Membiarkan saja hal itu karena tidak ada yang bisa dilakukan dan bisa memperburuk situasi',
                    'Melakukan pekerjaan Anda sebaik mungkin apa pun situasinya karena yang terpenting adalah kinerja.',
                    'Melakukan langkah-langkah nyata untuk mengupayakan kerja sama meskipun tidak mudah',
                    'Terus mencari cara untuk mewujudkan kerjasama karena pasti ada yang bisa dilakukan.',
                    'Melakukan langkah-langkah taktis untuk mewujudkan kerja sama karena kerja sama yang perlu diwujudkan oleh sebuah tim',
                ],
                'weights' => [1, 4, 3, 2, 5],
            ],
            // Soal 9 - 32541
            [
                'text' => 'Nisa sejak kecil terbiasa melakukan pekerjaan sendiri sehingga menjadi pribadi individualistis. Ia merasa kesulitan ketika mulai berkuliah, banyak tugas yang membutuhkan kerja tim. Bagaimana tindakan Nisa?',
                'options' => [
                    'Diskusi dengan teman yang menawarkan bekerja sama.',
                    'Cenderung bekerja dengan tim yang anggotanya selalu sama',
                    'Mencoba berpartisipasi aktif dalam semua kelompok yang diikuti',
                    'Mencoba terlibat dengan beberapa kelompok yang berbeda',
                    'Tetap mengerjakan tugas sendiri tanpa perlu melibatkan anggota lain.',
                ],
                'weights' => [3, 2, 5, 4, 1],
            ],
            // Soal 10 - 12543
            [
                'text' => 'Alif adalah ketua klub penelitian yang akan mengikuti lomba. Dalam perjalanan waktu, ternyata para anggota klub lebih banyak sibuk berkegiatan lain. Padahal, guru pembimbing telah berpesan bahwa kerja sama adalah modal dasar untuk mencapai kemenangan. Apa yang sebaiknya dilakukan oleh Alif?',
                'options' => [
                    'Menyampaikan keluhan kepada guru pembimbing agar anggota klub penelitian mendapat teguran dan mau membantu kerja Alif.',
                    'Memilih menunggu munculnya kesadaran dari teman-temannya sesama anggota klub untuk bersedia bekerja sama mempersiapkan diri mengikuti lomba karya ilmiah.',
                    'Merencanakan strategi dan langkah-langkah persiapan menghadapi lomba karya ilmiah bersama seluruh anggota klub dan melaksanakannya',
                    'Segera spontan menemui para anggota tersebut dan meminta dengan tegas untuk segera berkontribusi dalam persiapan lomba.',
                    'Mencoba memikirkan alternatif cara agar teman-temannya bersedia diajak bekerja sama mempersiapkan diri dalam menghadapi lomba karya ilmiah',
                ],
                'weights' => [1, 2, 5, 4, 3],
            ],
            // Soal 11 - 23145
            [
                'text' => 'Daffa adalah koordinator bidang A yang diminta bekerja sama dengan bidang B pada OSIS, yang diminta untuk mengurus kegiatan akhir tahun sekolah. Menurut berita yang beredar, ketua bidang B terkenal kurang tanggap terhadap pekerjaan. Bagaimana sikap Daffa?',
                'options' => [
                    'Yakin bahwa ketua bidang B mampu, tetapi tidak ingin meluangkan waktu.',
                    'Yakin ketua bidang B mau diajak menyukseskan acara jika diberi penjelasan.',
                    'Kemungkinan B kurang memiliki keinginan untuk melaksanakan kegiatan dies.',
                    'Percaya pada kemampuan ketua bidang B serta mengabaikan berita yang beredar',
                    'Berusaha meyakinkan orang lain untuk mempercayai kemampuan ketua bidang B.',
                ],
                'weights' => [2, 3, 1, 4, 5],
            ],
            // Soal 12 - 21354
            [
                'text' => 'Nadine orang yang tertutup dan saat ini menjadi anggota sebuah organisasi. Ketua memintanya menjadi panitia beberapa acara yang berdekatan waktu pelaksanaanya. Nadine khawatir nilainya akan turun karena kurang fokus belajar. Apa yang dilakukan Nadine?',
                'options' => [
                    'Setelah berpikir beberapa lama, ia menceritakan situasinya ketika tidak sanggup lagi.',
                    'Berkeluh kesah terkait beban kerja tersebut kepada teman dekat',
                    'Tetap diam dan menyimpan hal tersebut meski merasa terbebani dengan tugas yang banyak',
                    'Menyampaikan kepada anggota mengenai kondisinya serta menjalin kerja sama agar semua berjalan efektif.',
                    'Menyampaikan kepada ketua mengenai kondisi tersebut dan mengatakan untuk mengurangi beban kerjanya.',
                ],
                'weights' => [2, 1, 3, 4, 5],
            ],
            // Soal 13 - 13425
            [
                'text' => 'Calvin mempunyai usaha masker hias dengan kreasi inovatif sehingga karyanya digemari banyak orang. Omzetnya tiap bulan meningkat sehingga banyak permintaan tidak terpenuhi ketika dia sakit. Keterampilan Calvin tidak banyak dimiliki orang walaupun tidak sedikit yang sudah belajar kepadanya. Apa yang sebaiknya dilakukan oleh Calvin?',
                'options' => [
                    'Tetap berusaha mengoptimalkan usaha maskernya sendiri dan tidak membagikan keterampilannya kepada orang lain.',
                    'Bersedia membagikan keterampilannya ketika ada yang meminta dan memerlukan pelatihan darinya.',
                    'Membagikan keterampilan kepada orang lain agar bisa membantu meningkatkan taraf penghasilan orang lain.',
                    'Mau membagikan sebagian keterampilannya kepada orang lain dan tetap menyimpan keterampilan tertentu baginya.',
                    'Berinisiatif membagikan keterampilannya kepada orang lain dan saling mendukung kemajuan usaha masker hias.',
                ],
                'weights' => [1, 3, 4, 2, 5],
            ],
            // Soal 14 - 42531
            [
                'text' => 'Fairuz mendapat tugas melakukan wawancara mengenai kebudayaan bersama teman-teman sekelompoknya. Fairuz merupakan anggota tim jurnalistik sekolah sehingga telah terbiasa melakukan wawancara. Sementara itu, teman-temannya belum memiliki pengalaman melakukan wawancara. Apa yang dilakukan dalam kelompoknya?',
                'options' => [
                    'Menjelaskan dan memberikan contoh kepada teman-teman di dalam kelompok tentang bagaimana menggali data melalui wawancara',
                    'Memberi kesempatan kepada teman-temannya untuk melaksanakan wawancara sehingga mereka menyadari sulitnya melakukan wawancara',
                    'Mengajak teman-temannya untuk rutin berlatih wawancara dan meminta saling mendukung dan mengajarkan satu sama lain sehingga penggalian data bisa berjalan lancar.',
                    'Tidak bersedia untuk berbagi pengetahuan dan pengalaman melakukan wawancara kepada teman-temannya jika diminta oleh guru untuk memberi contoh di depan kelas.',
                    'Bersedia membagikan pengalaman dan keahliannya melakukan wawancara kepada teman-temannya untuk menunjukkan kebolehannya',
                ],
                'weights' => [4, 2, 5, 3, 1],
            ],
            // Soal 15 - 12534
            [
                'text' => 'Malam ini terjadi keributan antara Pradit dan Alim. Pradit menegur Alim karena mendengar suara musik yang cukup keras dari rumah Alim pada saat waktu jam istirahat. Saat ditegur, Alim justru marah. Sebagai tetangga mereka, tindakan apa yang Anda lakukan?',
                'options' => [
                    'Menganggap hal itu adalah permasalahan kecil di antara Pradit dan Alim dan tidak perlu dirubutkan.',
                    'Berdiskusi dengan ketua RT tentang nilai-nilai yang dianut oleh Pradit dan Alim tentang musik.',
                    'Memberikan usul kepada ketua RT untuk membuat aturan bersama demi kerukunan warga.',
                    'Menggali informasi dari Pradit dan Alim untuk mengetahui permasalahan secara mendalam',
                    'Mengajak Pradit dan Alim untuk berdiskusi dengan ketua RT tentang masalah yang ada.',
                ],
                'weights' => [1, 2, 5, 3, 4],
            ],
            // Soal 16 - 43512
            [
                'text' => 'Listi memiliki strata sosial tertinggi di sukunya. Listi hanya mau berteman dengan siswa yang memiliki strata sama. Hal ini membuat teman sekelasnya menolak kerja kelompok dengan Listi. Bagaimana seharusnya sikap Fany sebagai teman sebangku Listi?',
                'options' => [
                    'Mengajak Listi untuk lebih mengenal teman-teman di kelas.',
                    'Meminta ketua kelas untuk memberikan pengertian kepada Listi',
                    'Melibatkan Listi dalam berbagai kegiatan bersama teman sekelas.',
                    'Menyampaikan kepada Listi kalau sikapnya membuat teman sekelas kesal.',
                    'Memandang sikap Listi merupakan sesuatu hal yang wajar.',
                ],
                'weights' => [4, 3, 5, 1, 2],
            ],
            // Soal 17 - 21354
            [
                'text' => 'Anda menjalankan kegiatan tinggal di suatu desa sebagai bagian dari tugas sekolah. Beberapa teman mengeluhkan kebiasaan di desa yang terlalu banyak acara adat dan enggan untuk ikut serta. Apa yang harus Anda lakukan?',
                'options' => [
                    'Akan menghadiri jika memang diundang',
                    'Setuju dengan pendapat teman-teman.',
                    'Mencari tahu tentang kebiasaan tersebut.',
                    'Mengajak teman-teman menghargai desa',
                    'Mengikuti semua kegiatan selama bertugas.',
                ],
                'weights' => [2, 1, 3, 5, 4],
            ],
            // Soal 18 - 45231
            [
                'text' => 'Angga akan mengadakan kegiatan naik gunung bersama teman kelasnya dan akan membuat film dokumentasi budaya. Ternyata warga sekitar tidak mengizinkan dokumentasi apa pun karena bertentangan dengan kepercayaan mereka. Apa yang sebaiknya dilakukan oleh Angga?',
                'options' => [
                    'Menghargai kepercayaan warga dan mengurungkan niat membuat film.',
                    'Mengajak teman-teman agar menghargai putusan warga dan melakukan kegiatan lain.',
                    'Merasa kecewa, tetapi terpaksa mengikuti aturan dan hanya melihat-lihat saja.',
                    'Tetap berusaha melakukan kegiatan meski sudah dilarang.',
                ],
                'weights' => [4, 5, 2, 3, 1],
            ],
            // Soal 19 - 12345
            [
                'text' => 'Joko memutuskan bahwa akhir tahun ini ia dan keluarga akan berwisata ke luar negeri untuk menikmati musim dingin. Namun, anaknya yang paling kecil mengusulkan untuk berwisata di Indonesia saja agar lebih mengenal budaya sendiri. Sebagai kepala keluarga, apa yang sebaiknya dilakukan oleh Joko?',
                'options' => [
                    'Ia tidak terlalu memedulikan pendapat anaknya karena selama ini ia tidak pernah melibatkan anak-anaknya',
                    'Ia menanyakan lagi kepada istrinya karena selama ini ia selalu mengikuti keinginan istrinya.',
                    'Ia tidak mungkin mengubah rencana untuk berlibur ke luar negeri karena sebagian besar keluarga sudah setuju.',
                    'Ia setuju dengan pendapat anaknya yang paling kecil karena penting untuk mengenal budaya sendiri.',
                    'Ia mengajak seluruh anggota keluarganya berdiskusi lagi untuk mengambil keputusan bersama.',
                ],
                'weights' => [1, 2, 3, 4, 5],
            ],
            // Soal 20 - 31254
            [
                'text' => 'Usman dan timnya baru saja datang ke area tanggul yang jebol sehingga menyebabkan banjir di daerah sekitar. Saat sampai disana, banyak warga yang mencemoh mereka karena dianggap terlambat dalam proses evakuasi. Sudah dijelaskan oleh rekan Usman bahwa mereka terlambat karena akses dan peralatan yang kurang memadai jika dipaksa akan membahayakan tim namun tidak digubris. Sikap yang akan Usman lakukan adalah',
                'options' => [
                    'Berusaha menyelesaikan proses evakuasi untuk memastikan keselamatan dan kesejahteraan warga, karena apabila dapat menyelesaikan tugas dengan baik bisa meredakan ketegangan',
                    'Mencoba menjelaskan kembali alasan keterlambatan mereka dan menunjukkan empati terhadap situasi warga yang terkena dampak banjir bisa membantu mengurangi kemarahan dan ketegangan',
                    'Tetap sabar dan menahan diri dari emosi yang mungkin timbul akibat dari cemooh tersebut dengan tetap fokus pada tugas evakuasi banjir',
                    'Tetap tenang dan fokus pada penyelesaian tugas evakuasi sambil menjalin komunikasi dengan warga untuk menjelaskan kembali situasi dan kendala yang dihadapi',
                    'Meminta maaf dan tetap tenang dalam menyelesaikan masalah yang dihadapi agar terlihat teguh dan profesional dalam menghadapi situasi darurat',
                ],
                'weights' => [3, 1, 2, 5, 4],
            ],
            // Soal 21 - 23514
            [
                'text' => 'Firman masuk dalam unit kepanitiaan bakti sosial di kampus. Tim sudah dibentuk oleh pihak kampus, dan tugas Firman adalah mengoordinasi persiapan dan pelaksanaan bakti sosial. Kampus Firman termasuk kampus inklusi sehingga beberapa mahasiswa tunanetra juga dilibatkan. Bagaimana sikap Firman?',
                'options' => [
                    'Melibatkan mahasiswa tunanetra pada saat persiapan saja dan tidak dilibatkan saat pelaksanaan.',
                    'Tetap melibatkan mahasiswa tunanetra yang mampu mengikuti ritme kerjanya.',
                    'Melibatkan semua anggota panitia untuk menyusun program bakti sosial dengan baik.',
                    'Kurang mempercayai kemampuan mahasiswa tunanetra sehingga tidak dilibatkan',
                    'Memotivasi semua anggota panitia untuk saling menghargai kelebihan dan kekurangan anggota',
                ],
                'weights' => [2, 3, 5, 1, 4],
            ],
            // Soal 22 - 51432
            [
                'text' => 'Nina adalah seorang kepala proyek di sebuah perusahaan teknologi. Pada hari peluncuran produk baru, Nina menugaskan salah satu anggota tim yang paling paham merakit perangkat untuk menyiapkan perangkat yang akan digunakan dalam presentasi. Namun, saat hari peluncuran tiba, ia tidak hadir tanpa kabar. Nina telah berusaha menghubunginya, tetapi tidak ada balasan. Tindakan Nina?',
                'options' => [
                    'Meminta rekan tim lainnya untuk cepat menyiapkan perangkat sesuai dengan panduan instruksi yang telah diberikan dan memantau pengerjaannya.',
                    'Terus berusaha menghubungi anggota tim yang tidak hadir sambil berharap untuk mendapatkan balasan, meskipun waktu peluncuran semakin mendekat.',
                    'Meminta rekan tim lainnya untuk cepat menyiapkan perangkat sesuai dengan instruksi, sementara Nina mencoba menghubungi anggota tersebut.',
                    'Segera mempersiapkan penyusunan perangkat secara mandiri, mengingat Nina sudah memahami detail spesifikasi produk dengan baik.',
                    'Menghubungi manajemen untuk meminta penundaan peluncuran produk dengan alasan anggota tim yang bertugas tidak hadir dan sulit dihubungi.',
                ],
                'weights' => [5, 1, 4, 3, 2],
            ],
            // Soal 23 - 52314
            [
                'text' => 'Anda bergabung di tim kreatif untuk menyelenggarakan kegiatan pameran karya mahasiswa secara daring melalui situs berbayar yang dilanggan. Padahal, Anda baru pertama kali mengetahui teknologi tersebut. Apa yang Anda lakukan?',
                'options' => [
                    'Mempelajari cara penggunaan situs tersebut untuk berbagai kegiatan di divisi lain.',
                    'Merasa bahwa cara penggunaan situs tersebut perlu dikuasai oleh rekan di divisi acara.',
                    'Merasa perlu mencari informasi cara penggunaan situs untuk menyelesaikan tugasnya sebagai tim kreatif',
                    'Mempelajari situs tersebut bersama tim secara bertahap.',
                    'Menyerahkan sepenuhnya kepada anggota tim yang sudah menguasai.',
                ],
                'weights' => [5, 2, 3, 1, 4],
            ],
            // Soal 24 - 32514
            [
                'text' => 'Sebagai staf kepegawaian di sebuah instansi, Anda menemui situasi di mana seorang warga mengajukan keluhan terkait pelayanan yang tidak sesuai dengan janji. Namun, saat bersamaan, semua petugas layanan pelanggan sedang sibuk menangani pelanggan lain. Tindakan Anda?',
                'options' => [
                    'Mendengarkan keluhan pelanggan dan mencatat masalah yang dihadapi, agar petugas layanan pelanggan dapat menindaklanjutinya setelah selesai melayani pelanggan lain.',
                    'Menawarkan untuk melayani pelanggan tersebut di ruang Anda dan memberikan solusi atas permasalahan yang dihadapi agar kepuasan pelanggan tetap terjaga.',
                    'Meminta maaf atas kendala yang terjadi dan meminta kesediaan warga untuk menunggu di kursi antrian yang telah disediakan, hingga giliran mereka tiba.',
                    'Menyarankan pelanggan untuk kembali pada waktu yang lebih tepat agar dapat dilayani dengan lebih baik saat petugas layanan pelanggan sudah tersedia.',
                    'Mencoba memahami situasi yang dialami warga dan mengarahkannya menunggu antrian di kursi yang telah disediakan, agar kepuasan warga tetap terjaga.',
                ],
                'weights' => [3, 2, 5, 1, 4],
            ],
            // Soal 25 - 35241
            [
                'text' => 'Arya adalah ketua organisasi penyelamatan satwa langka. Terdapat aplikasi yang bisa digunakan untuk mengetahui klinik hewan terdekat untuk perawatan satwa yang sakit. Namun, aplikasi ini membutuhkan operator untuk mengoperasikannya: mulai pendaftaran, pemeriksaan, hingga pembayaran. Apa yang sebaiknya Arya lakukan?',
                'options' => [
                    'Mempelajari aplikasi tersebut agar bisa mengoperasikannya sendiri tanpa perlu operator tambahan.',
                    'Mempelajari semua fitur dalam aplikasi tersebut dan mencari alternatif aplikasi lain yang bisa digunakan.',
                    'Mencoba mencari fitur dalam aplikasi tersebut untuk bisa mendukungnya menyelesaikan tugas kerja sebagai ketua',
                    'Mempelajari semua fitur dalam aplikasi tersebut untuk menyelesaikan tugas-tugas dalam organisasi',
                    'Tetap menggunakan sistem konvensional untuk menyelesaikan tugas kerja dalam organisasi.',
                ],
                'weights' => [3, 5, 2, 4, 1],
            ],
            // Soal 26 - 13245
            [
                'text' => 'Anda memiliki rekan kerja yang mengaku pernah terlibat dalam organisasi terlarang yang bertentangan dengan Pancasila. Kini, dia menyesali tindakannya dan sudah tidak terlibat lagi. Bagaimana sikap Anda?',
                'options' => [
                    'Melaporkan kepada atasan untuk dilakukan penyelidikan lebih lanjut, tanpa langsung menuduh atau menyebarkan cerita tersebut.',
                    'Mendengarkan cerita rekan tersebut dengan terbuka, sembari memberikan masukan yang membangun agar ia tidak terjerumus kembali.',
                    'Mengawasi rekan tersebut secara hati-hati, namun tidak menceritakan hal ini kepada orang lain karena menganggapnya sebagai aib pribadi.',
                    'Mengajak berdiskusi tentang pengalamannya selama ini dan memberikan dukungan agar ia tetap teguh menjauhi paham radikal.',
                    'Menjalin komunikasi rutin dengannya untuk memastikannya tetap terhindar paham berbahaya, sembari terus mengamati perubahannya.',
                ],
                'weights' => [1, 3, 2, 4, 5],
            ],
            // Soal 27 - 23451
            [
                'text' => 'Baru-baru ini ada informasi bahwa aplikasi yang sangat populer terkena isu perekaman data pengguna. Aplikasi itu mengharuskan konektivitas internet yang selalu menyala untuk mengetahui lokasi pengguna. Apa tindakan Anda?',
                'options' => [
                    'Aplikasi tersebut sudah tertanam di ponsel saya sehingga saya akan menghentikan fitur rekam aktivitas agar privasi saya tetap terjaga.',
                    'Mematikan internet ketika tidak digunakan sehingga menutup kemungkinan terganggunya privasi saya dan orang lain di sekitar saya.',
                    'Mengimbau kepada teman untuk tidak selalu menyalakan koneksi internet dan mematikan fitur rekam aktivitas untuk mencegah potensi yang merugikan.',
                    'Mendorong pemerintah melalui media massa sosial untuk memblokir aplikasi tersebut ketika informasi pencurian data terbukti',
                    'Selama ini tidak pernah ada masalah sehingga hal tersebut tidak mengkhawatirkan saya dan seandainya muncul masalah saya akan melaporkan ke pihak berwenang.',
                ],
                'weights' => [2, 3, 4, 5, 1],
            ],
            // Soal 28 - 34125
            [
                'text' => 'Dalam sebuah komunitas daring pegiat budaya, Bobi diminta menanggapi sebuah program yang telah disusun oleh anggota lain. Ia merasa program itu masih memiliki banyak kekurangan. Di sisi lain, penyusun program tersebut terbilang keras pendirian. Apa yang seharusnya dilakukan oleh Bobi dalam forum?',
                'options' => [
                    'Secara berhati-hati mempelajari program yang dimaksud sebelum memberikan masukan yang membangun.',
                    'Memberikan masukan yang membangun pada bagian-bagian yang perlu disertai upaya penghargaan terhadap program.',
                    'Untuk menghindari rasa tidak nyaman, menahan masukan dan menyampaikan bahwa program telah baik.',
                    'Untuk menghindari konflik, memberikan masukan sedikit saja untuk menghindari kesan menyerang',
                    'Memberikan masukan secara menyeluruh dan apabila perlu menyarankan perombakan program.',
                ],
                'weights' => [3, 4, 1, 2, 5],
            ],
            // Soal 29 - 51432
            [
                'text' => 'Fatur lupa jika ia harus segera mengunggah tugas sekolah daring yang diberikan guru. Waktu yang terbatas membuat Fatur memilih menyalin jawaban dari orang lain melalui internet. Jika Anda adalah teman dekatnya, apa tindakan Anda?',
                'options' => [
                    'Meminta Fatur mengerjakan sendiri tugasnya.',
                    'Tidak ikut membantu Fatur untuk mencari jawaban di internet',
                    'Membantu mengerjakan tugas tanpa menyalin jawaban dari internet.',
                    'Mengingatkan Fatur bahwa guru dapat memeriksa keaslian tugas.',
                    'Membiarkan Fatur menyalin jawaban karena waktu terbatas.',
                ],
                'weights' => [5, 1, 4, 3, 2],
            ],
            // Soal 30 - 52314
            [
                'text' => 'Hindun, seorang pegawai senior di kementerian di Jakarta, ditugaskan mengikuti pelatihan ketatalaksanaan SDM di luar kota. Saat pelatihan, peserta lebih memilih membentuk kelompok dengan rekan kantor mereka atau yang sudah dikenal, tanpa menunjukkan minat untuk berbaur dengan yang lain. Apa langkah terbaik yang sebaiknya diambil Hindun?',
                'options' => [
                    'Mengusulkan kepada panitia untuk mendorong kolaborasi dan suasana inklusif antar peserta.',
                    'Mengamati dinamika dan mencari peluang interaksi dengan peserta lain pada momen yang tepat.',
                    'Mengajak peserta lain berdiskusi untuk memecah kebekuan dan membangun hubungan.',
                    'Berbagi pengalaman dengan rekan yang dikenal dan membahas tantangan pelatihan.',
                    'Membentuk kelompok baru dengan peserta yang belum dikenal dan bekerja sama dalam tugas.',
                ],
                'weights' => [5, 2, 3, 1, 4],
            ],
            // Soal 31 - 42135
            [
                'text' => 'Sebagai ketua kelas, salah satu tugas Indira adalah memastikan teman-temannya hadir saat upacara bendera. Siswa di kelasnya tergolong cukup sering menghindar untuk ikut upacara. Akibatnya Indira beberapa kali ditegur oleh wali kelas. Apa tindakan Indira?',
                'options' => [
                    'Bertanya ke sesama ketua kelas tentang cara mengatasi masalah ini',
                    'Mengusulkan sistem poin untuk siswa yang mengikuti upacara',
                    'Menyerah untuk urusan upacara bendera karena ia juga diabaikan.',
                    'Mengatur agar siswa yang bolos dikenai sanksi piket selama satu minggu.',
                    'Mendiskusikan solusi yang efektif dengan wali kelas.',
                ],
                'weights' => [4, 2, 1, 3, 5],
            ],
            // Soal 32 - 51423
            [
                'text' => 'Muki bersama tim harus bertindak sendiri untuk menyelesaikan penghijauan. Waktu yang ditetapkan adalah lima hari. Di akhir hari ke-3 area yang ditanami baru 45% dan ada pula beberapa kantung bibit mengering. Penghijauan mungkin akan gagal tercapai. Apa tindakan Muki?',
                'options' => [
                    'Membuat serta menanam bibit baru dan melihat hasilnya dalam 2 hari.',
                    'Mempercepat pekerjaan tetapi tidak menetapkan sasaran tertentu.',
                    'Memperlebar jarak tanam dengan harapan semua area dapat tertanami',
                    'Melanjutkan penanaman seperti biasa sampai hari kelima',
                    'Mencari tambahan orang untuk menyelesaikan penanaman.',
                ],
                'weights' => [5, 1, 4, 2, 3],
            ],
            // Soal 33 - 31542
            [
                'text' => 'Akhir bulan ini saya mendapatkan tugas untuk melakukan kunjungan sosial dalam agenda rutin komunitas saya selama 1 minggu. Namun, di sisi lain, saya sedang mempersiapkan diri menghadapi ulangan tengah semester (UTS). Bagaimana langkah saya selanjutnya?',
                'options' => [
                    'Membawa materi UTS selama kunjungan dan sesekali belajar.',
                    'Berencana meminta bantuan teman untuk menggantikan kunjungan acara sosial.',
                    'Membawa materi UTS dan belajar apabila ada waktu sambil melaksanakan tugas sosial.',
                    'Membagi waktu secara ketat antara kunjungan sosial dan belajar',
                    'Melaksanakan kunjungan sosial setelah selesai belajar semampu saya.',
                ],
                'weights' => [3, 1, 5, 4, 2],
            ],
            // Soal 34 - 31425
            [
                'text' => 'Halim adalah panitia lomba debat antarsekolah yang akan diadakan lima hari lagi. Dalam minggu yang sama, ia pun mendapat tugas Biologi berupa eksperimen sederhana dari guru yang harus dikumpulkan pada akhir minggu. Apa yang sebaiknya Halim lakukan?',
                'options' => [
                    'Mengerjakan tanggung jawab kepanitiaan dan eksperimen Biologi sebisanya di minggu itu',
                    'Tugas sekolah terasa rumit sehingga akan dikerjakan saat suasana hati mendukung.',
                    'Menyusun jadwal kegiatan di awal minggu agar seluruh aktivitas terkelola secara efektif.',
                    'Memprioritaskan tugas akademik dari guru agar dapat dikerjakan tepat waktu.',
                    'Membuat strategi kerja bersama panitia agar dapat fokus mengerjakan tugas sekolah.',
                ],
                'weights' => [3, 1, 4, 2, 5],
            ],
            // Soal 35 - 21345
            [
                'text' => 'Robi bekerja di bagian administrasi dan saat ini sedang mendapat banyak tugas dari kepala bagiannya. Pada waktu yang bersamaan, manajer memintanya untuk hadir dalam rapat perusahaan dan harus mencari data yang diperlukan dalam rapat. Apa yang sebaiknya dilakukan Robi?',
                'options' => [
                    'meminta manajer untuk bicara dengan kepala bagian sambil mencari data yang diperlukan dalam rapat',
                    'tidak hadir dalam rapat dengan alasan masih sibuk menyelesaikan tugas kepala bagian',
                    'hadir dalam rapat sekalipun terlambat karena harus menyelesaikan tugas yang diberikan oleh kepala bagian terlebih dahulu',
                    'meminta izin kepala bagian untuk menghadiri rapat dengan menunjukkan rencana penyelesaian tugas yang diberikan.',
                    'meluangkan waktu untuk menghadiri rapat, kemudian menyelesaikan tugas kepala bagian kembali',
                ],
                'weights' => [2, 1, 3, 4, 5],
            ],
            // Soal 36 - 12345
            [
                'text' => 'Setiap musim penghujan biasanya muncul wabah Demam Berdarah Dengue (DBD) di Kampung Sukasoka. Berbagai usaha yang dilakukan oleh perangkat desa, tetapi belum menunjukkan hasil sehingga korban jiwa berjatuhan. Apa yang sebaiknya Putu lakukan sebagai kepala desa?',
                'options' => [
                    'Bertindak seperti sebelumnya dan memastikan tindakan tersebut sudah sesuai dengan prosedur tata laksana DBD.',
                    'Menyusun rencana pencegahan dan penanggulangan DBD yang dapat diterapkan secara efektif dari tahun ke tahun',
                    'Merancang strategi edukasi melalui berbagai media dengan mengacu pada kondisi dan kebiasaan warga desa.',
                    'Melibatkan seluruh elemen warga untuk meningkatkan kesadaran lingkungan sebagai tindakan antisipatif wabah DBD',
                    'Membuat rencana kegiatan seperti kerja bakti dan penyemprotan nyamuk secara rutin, seperti imbauan pemerintah',
                ],
                'weights' => [1, 2, 3, 4, 5],
            ],
            // Soal 37 - 54312
            [
                'text' => 'Aldo, ketua tim redaksi majalah dinding sekolah, mengadakan rapat awal dengan anggota timnya dan mendiskusikan topik utama majalah untuk edisi bulan berikutnya. Ada beberapa opsi topik yang dapat diangkat sebagai topik utama. Dalam rapat itu, apa tindakan yang diambil Aldo?',
                'options' => [
                    'Mendukung seluruh tim untuk aktif dalam curah gagasan dan saling mengapresiasi',
                    'Menyimak diskusi anggota timnya dan merangkum hasil diskusi pada akhir rapat.',
                    'Memberikan tanggapan khusus pada topik yang menarik baginya agar lebih terfokus.',
                    'Memesankan makanan favorit bersama agar semuanya lebih bersemangat mengikuti rapat.',
                    'Memastikan bahwa keputusan rapat sudah final dan dapat segera direalisasikan.',
                ],
                'weights' => [5, 4, 3, 1, 2],
            ],
            // Soal 38 - 35412
            [
                'text' => 'Firman adalah direktur baru dalam suatu perusahaan. Berdasarkan pengalaman direktur sebelumnya yang disampaikan kepada Firman, ada kesulitan dalam mengambil keputusan karena ada konflik dan perbedaan kepentingan antara karyawan senior dan junior. Ketika menghadapi situasi seperti itu, apa yang akan dilakukan oleh Firman?',
                'options' => [
                    'Firman merasa yakin bahwa musyawarah adalah nilai-nilai perdamaian yang harus dilaksanakan.',
                    'Firman akan mendorong semua karyawannya memahami nilai-nilai perdamaian dalam musyawarah untuk mencapai mufakat',
                    'Firman akan tetap mengutamakan musyawarah dalam setiap mengambil keputusan dengan melibatkan semua karyawan.',
                    'Firman akan mendekati para karyawan senior yang dianggap sebagai role model oleh karyawan lainnya untuk membantunya mengatasi masalah tersebut.',
                    'Firman akan mengajak diskusi dengan beberapa karyawan senior dan junior untuk mencari cara-cara yang bisa menyatukan mereka kembali',
                ],
                'weights' => [3, 5, 4, 1, 2],
            ],
            // Soal 39 - 34251
            [
                'text' => 'Terjadi perseteruan antara dua RT yang disebabkan oleh perebutan lapangan basket yang dilakukan oleh para pemuda. Setiap pihak merasa lebih benar dan lebih berhak atas lapangan basket tersebut. Perseteruan pun berujung pada penutupan akses masuk RT oleh salah satu. Apa yang sebaiknya Anda lakukan?',
                'options' => [
                    'Berusaha memahami pendapat RT masing-masing dan menyayangkan penutupan akses masuk.',
                    'Tidak memihak dan mencari lapangan basket yang lain.',
                    'Semua pihak tidak ada yang merasa dirugikan',
                    'Menyusun jadwal pemakaian lapangan basket yang disepakati oleh kedua belah pihak',
                    'Mengerti bahwa penutupan jalan itu merugikan semua pihak',
                ],
                'weights' => [3, 4, 2, 5, 1],
            ],
            // Soal 40 - 12354
            [
                'text' => 'Di kampus, Anda tergabung dalam sebuah kegiatan bakti sosial. Ternyata setengah dari dana yang terkumpul tersebut digunakan untuk acara makan-makan panitia. Anda diundang pada acara tersebut. Apa yang Anda lakukan?',
                'options' => [
                    'Tidak menghadiri acara tersebut karena tidak setuju dengan penggunaan uang yang terlalu banyak untuk acara itu.',
                    'Seharusnya para panitia tersebut tidak menggunakan uang yang sudah dikumpulkan untuk acara makan-makan.',
                    'Seharusnya jika akan diadakan acara makan-makan dapat menggunakan dana pribadi dari tiap anggota panitia',
                    'Menyampaikan pada panitia untuk mengumpulkan dana kolektif dari dana pribadi masing-masing untuk mengadakan acara makan-makan',
                    'Menyampaikan kepada panitia yang lain bahwa sebaiknya seluruh dana diserahkan kepada yang berhak sesuai dengan tujuan awal.',
                ],
                'weights' => [1, 2, 3, 5, 4],
            ],
            // Soal 41 - 12354
            [
                'text' => 'Seorang teman baik yang lama tak bertemu diketahui berpindah keyakinan. Anda terkejut mendengarnya. Sikap apa yang akan Anda tunjukkan kepadanya?',
                'options' => [
                    'Saya merasa keberatan adanya perbedaan keyakinan dengan orang tua dan meminimalkan untuk berinteraksi.',
                    'Saya memberikan toleransi kepadanya hanya untuk hal yang umum, tetapi tetap teguh terhadap prinsip agama.',
                    'Saya tidak mempermasalahkan perpindahan keyakinannya karena bukan tanggung jawab saya',
                    'Saya akan tetap menjaga tali pertemanan tanpa memedulikan perbedaan yang ada.',
                    'Saya bertahan untuk tidak mempertanyakan perpindahan keyakinan dan menjaga perasaannya.',
                ],
                'weights' => [1, 2, 3, 5, 4],
            ],
            // Soal 42 - 12453
            [
                'text' => 'Dea adalah seorang ketua OSIS di sebuah sekolah negeri. Pada saat rapat, sejumlah pengurus OSIS meminta OSIS merekomendasikan pemisahan tangga untuk naik ke lantai dua antara laki-laki dan perempuan kepada pihak sekolah, tetapi beberapa pengurus lainnya menentang usulan tersebut. Apa yang sebaiknya Dea lakukan?',
                'options' => [
                    'Menyetujui pemisahan tangga berdasar jenis kelamin karena akan meminimalkan interaksi yang tidak sepantasnya antara siswa laki-laki dan perempuan.',
                    'Memberikan tanggapan bahwa usulan tersebut kurang bijaksana dan mengedukasi pengurus OSIS tentang pentingnya membuat kebijakan yang inklusif',
                    'Mencoba menggali pendapat siswa guna melihat apakah rekomendasi pemisahan tangga tersebut disetujui oleh berbagai kelompok siswa.',
                    'Menampung usulan tersebut dan mendorong para pengurus OSIS untuk mengusulkan jalan keluar yang lebih akomodatif terhadap semua kepentingan.',
                    'Memahami bahwa usulan ini mungkin tidak sejalan dengan nilai yang dianut oleh semua orang, tetapi juga tidak merugikan dan layak direkomendasikan',
                ],
                'weights' => [1, 2, 4, 5, 3],
            ],
            // Soal 43 - 31254
            [
                'text' => 'Pada pertandingan antarkelas terjadi perselisihan mengenai total skor yang diperoleh antara kelas Via dan kelas lainnya. Via sangat yakin bahwa pertandingan dimenangkan oleh kelasnya, tetapi kelas lain juga meyakini bahwa kelas mereka yang menang. Apa yang dilakukan Via melihat hal tersebut?',
                'options' => [
                    'Memikirkan berbagai kemungkinan untuk mendapatkan cara penyelesaian terbaik',
                    'Meminta juri menetapkan kelasnya sebagai pemenang sesuai dengan perhitungan yang mereka buat',
                    'Menyampaikan kepada juri tentang kemungkinan adanya kecurangan dari kelas lain',
                    'Meminta waktu untuk berdiskusi dengan juri agar perselisihan dapat diselesaikan',
                    'Mencoba berkompromi dengan kelas yang terlibat konflik agar ada Solusi',
                ],
                'weights' => [3, 1, 2, 5, 4],
            ],
            // Soal 44 - 12453
            [
                'text' => 'Kelompok Hana mendapatkan tugas melakukan eksperimen di laboratorium. Namun, mendekati waktu pengumpulan tugas, hasil eksperimen tersebut rusak dan ia mendengar dari salah satu teman bahwa hasil tersebut sengaja dirusak oleh kelompok lain. Bagaimana Hana menyelesaikan hal itu?',
                'options' => [
                    'Kecewa dan merasa sedih akan perbuatan kelompok lain',
                    'Mengajak teman sekelompoknya mendatangi kelompok yang merusak hasil kerja mereka',
                    'Segera ke laboratorium untuk melakukan pengecekan kebenaran',
                    'Menyampaikan kepada teman lain untuk tenang dan mengajak mereka mencari informasi yang benar',
                    'Memikirkan ulang apakah informasi tersebut benar atau tidak',
                ],
                'weights' => [1, 2, 4, 5, 3],
            ],
            // Soal 45 - 12354
            [
                'text' => 'Tetangga Anda mendirikan warung baru. Warung tersebut selalu ramai pada malam hari di akhir minggu. Ternyata warung tersebut menjual minuman keras dan setiap malam minggu banyak pelanggan yang mabuk-mabukan di sana. Apa yang Anda lakukan?',
                'options' => [
                    'Mengajak warga setempat untuk membubarkan para pengunjung warung karena berpotensi mengganggu ketentraman lingkungan',
                    'Memanggil polisi untuk mengusir para pelanggan warung serta menindak pemilik warung yang telah mengganggu ketertiban.',
                    'Menegur pemilik warung dan memintanya untuk membubarkan pelanggan karena berpotensi mengganggu ketertiban.',
                    'Mengajak Pak RT untuk menegur pemilik warung karena kegiatan di warungnya mengganggu ketertiban lingkungan.',
                    'Memberi pemahaman kepada pemilik warung bahwa kegiatan di warungnya mengganggu ketertiban lingkungan dan melanggar hukum.',
                ],
                'weights' => [1, 2, 3, 5, 4],
            ],
        ];

        // Simpan soal
        foreach ($questionsData as $index => $q) {
            $question = Question::create([
                'material_id' => $material->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => $q['text'],
                'explanation' => '<p><strong>Pembahasan:</strong> ' . $this->generateExplanation($q['weights']) . '</p>',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($q['options'] as $optIndex => $optionText) {
                $question->options()->create([
                    'option_text' => $optionText,
                    'is_correct' => false,
                    'order' => $optIndex + 1,
                    'weight' => $q['weights'][$optIndex],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $this->command->info('Seeder TKP 2 Juni (45 soal) berhasil dibuat!');
        $this->command->info('Material ID: ' . $material->id);
        $this->command->info('Total soal: ' . count($questionsData));
    }

    private function generateExplanation($weights)
    {
        $explanation = '<p><strong>Kunci Bobot: ' . implode('', $weights) . '</strong></p>';
        $explanation .= '<p>Bobot masing-masing opsi secara berurutan:</p><ul>';
        $letters = ['A', 'B', 'C', 'D', 'E'];
        foreach ($weights as $i => $w) {
            $explanation .= "<li>Opsi {$letters[$i]} = {$w}</li>";
        }
        $explanation .= '</ul>';
        return $explanation;
    }
}
