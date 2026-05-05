<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Database\Seeder;

class TKPSKDIntensif2Part2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari material dengan id 60
        $material = QuestionMaterial::firstOrCreate(
            ['id' => 60]
        );

        $questions = [
            // Soal 21 - DBCEA (D=5, B=4, C=3, E=2, A=1)
            [
                'question_text' => 'Anda adalah seorang manajer keamanan siber di sebuah perusahaan yang bertugas melatih tim keamanan siber untuk menghadapi ancaman dan serangan yang berpotensi memicu tindakan radikal. Tindakan yang akan Anda lakukan adalah ... (Anti Radikalisme)',
                'explanation' => '<p><strong>Pembahasan:</strong> Latihan simulasi dengan skenario nyata adalah cara terbaik untuk mempersiapkan tim menghadapi ancaman siber yang memicu radikalisme.</p>
                <p><strong>Kunci Bobot: D=5, B=4, C=3, E=2, A=1</strong></p>
                <p>5 = Mengadakan latihan simulasi yang menghadirkan skenario serangan siber nyata yang berpotensi memicu tindakan radikal dan mendorong tim untuk merespons dengan bijak dan proporsional. (D)<br>
                4 = Menggelar sesi diskusi terbuka dengan tim keamanan siber untuk mendengarkan pengalaman dan pandangan mereka terkait ancaman yang berpotensi memicu tindakan radikal. (B)<br>
                3 = Memberikan tugas individu kepada anggota tim untuk melakukan riset tentang radikalisme siber dan menyusun strategi penanganan yang tepat. (C)<br>
                2 = Mengurangi frekuensi latihan simulasi dan lebih fokus pada pengawasan rutin terhadap potensi serangan siber yang radikal. (E)<br>
                1 = Mengesampingkan latihan simulasi dan mengandalkan kebijakan umum yang berlaku dalam penanganan ancaman siber. (A)</p>',
                'options' => [
                    ['text' => 'Mengesampingkan latihan simulasi dan mengandalkan kebijakan umum yang berlaku dalam penanganan ancaman siber.', 'weight' => 1],
                    ['text' => 'Menggelar sesi diskusi terbuka dengan tim keamanan siber untuk mendengarkan pengalaman dan pandangan mereka terkait ancaman yang berpotensi memicu tindakan radikal.', 'weight' => 4],
                    ['text' => 'Memberikan tugas individu kepada anggota tim untuk melakukan riset tentang radikalisme siber dan menyusun strategi penanganan yang tepat.', 'weight' => 3],
                    ['text' => 'Mengadakan latihan simulasi yang menghadirkan skenario serangan siber nyata yang berpotensi memicu tindakan radikal dan mendorong tim untuk merespons dengan bijak dan proporsional.', 'weight' => 5],
                    ['text' => 'Mengurangi frekuensi latihan simulasi dan lebih fokus pada pengawasan rutin terhadap potensi serangan siber yang radikal.', 'weight' => 2],
                ]
            ],
            // Soal 22 - CBDAE (C=5, B=4, D=3, A=2, E=1)
            [
                'question_text' => 'Dian, seorang guru di sekolah menengah, menyadari bahwa kurikulum saat ini belum memadai dalam mengajarkan isu radikalisme, dan beberapa pengajar kurang memahami masalah ini. Dian ingin berinovasi untuk memperbaiki kurikulum dan meningkatkan pemahaman pengajar tentang radikalisme. Langkah apa yang paling tepat? ... (Anti Radikalisme)',
                'explanation' => '<p><strong>Pembahasan:</strong> Membentuk tim interdisipliner untuk mengembangkan kurikulum baru yang komprehensif adalah langkah inovatif yang paling tepat.</p>
                <p><strong>Kunci Bobot: C=5, B=4, D=3, A=2, E=1</strong></p>
                <p>5 = Membentuk tim interdisipliner yang terdiri dari guru, konselor, dan ahli radikalisme untuk mengembangkan kurikulum baru yang terintegrasi dengan pendekatan yang komprehensif. (C)<br>
                4 = Mengadakan pelatihan khusus bagi pengajar untuk meningkatkan pemahaman mereka tentang isu radikalisme dan cara menghadapinya di dalam kelas. (B)<br>
                3 = Menyelenggarakan diskusi terbuka dengan siswa tentang isu radikalisme dan mengundang narasumber dari luar yang ahli di bidang tersebut. (D)<br>
                2 = Menambahkan materi radikalisme secara terpisah dalam kurikulum yang sudah ada tanpa mengubah struktur dan fokus utama. (A)<br>
                1 = Menghindari topik radikalisme dalam pengajaran dan fokus pada materi yang sudah ada agar tidak memunculkan kontroversi atau kekhawatiran di antara siswa. (E)</p>',
                'options' => [
                    ['text' => 'Menambahkan materi radikalisme secara terpisah dalam kurikulum yang sudah ada tanpa mengubah struktur dan fokus utama.', 'weight' => 2],
                    ['text' => 'Mengadakan pelatihan khusus bagi pengajar untuk meningkatkan pemahaman mereka tentang isu radikalisme dan cara menghadapinya di dalam kelas.', 'weight' => 4],
                    ['text' => 'Membentuk tim interdisipliner yang terdiri dari guru, konselor, dan ahli radikalisme untuk mengembangkan kurikulum baru yang terintegrasi dengan pendekatan yang komprehensif.', 'weight' => 5],
                    ['text' => 'Menyelenggarakan diskusi terbuka dengan siswa tentang isu radikalisme dan mengundang narasumber dari luar yang ahli di bidang tersebut.', 'weight' => 3],
                    ['text' => 'Menghindari topik radikalisme dalam pengajaran dan fokus pada materi yang sudah ada agar tidak memunculkan kontroversi atau kekhawatiran di antara siswa.', 'weight' => 1],
                ]
            ],
            // Soal 23 - BEDCA (B=5, E=4, D=3, C=2, A=1)
            [
                'question_text' => 'Ahmad adalah seorang anggota komunitas yang terdiri dari individu dengan latar belakang agama yang beragam. Dia menyadari bahwa dalam komunitas tersebut terdapat pemahaman yang berbeda-beda tentang isu-isu agama. Selain itu, ada kecenderungan beberapa anggota komunitas yang kurang menghargai perbedaan pendapat dan sering terlibat dalam konflik yang tidak produktif. Ahmad ingin menciptakan lingkungan yang inklusif dan harmonis dalam komunitasnya, di mana perbedaan pendapat dapat dihargai dan dijaga dengan baik. Namun, Ahmad dihadapkan pada dilema tentang bagaimana menghadapi perbedaan pemahaman tentang isu agama dan mengatasi kecenderungan anggota komunitas yang kurang menghargai perbedaan pendapat. Sikap yang menurutmu paling tepat dalam situasi ini adalah ... (Anti Radikalisme)',
                'explanation' => '<p><strong>Pembahasan:</strong> Dialog interagama secara teratur adalah cara paling efektif untuk memperluas pemahaman dan mempromosikan penghormatan terhadap perbedaan.</p>
                <p><strong>Kunci Bobot: B=5, E=4, D=3, C=2, A=1</strong></p>
                <p>5 = Mengadakan sesi dialog dan dialog interagama secara teratur untuk memperluas pemahaman tentang isu-isu agama dan mempromosikan penghormatan terhadap perbedaan pendapat. (B)<br>
                4 = Menggunakan media sosial dan platform online untuk memperluas wawasan komunitas tentang berbagai perspektif agama dan mempromosikan penghormatan terhadap perbedaan. (E)<br>
                3 = Mengadopsi pendekatan "setuju untuk tidak setuju" di mana setiap anggota komunitas diberi ruang untuk mengemukakan pendapat mereka tanpa perlu mencapai kesepakatan. (D)<br>
                2 = Menghapus anggota komunitas yang seringkali kurang menghargai perbedaan pendapat dan menciptakan kebijakan nol toleransi terhadap perilaku tersebut. (C)<br>
                1 = Menghindari topik-topik yang sensitif terkait agama dalam diskusi komunitas untuk menghindari konflik. (A)</p>',
                'options' => [
                    ['text' => 'Menghindari topik-topik yang sensitif terkait agama dalam diskusi komunitas untuk menghindari konflik.', 'weight' => 1],
                    ['text' => 'Mengadakan sesi dialog dan dialog interagama secara teratur untuk memperluas pemahaman tentang isu-isu agama dan mempromosikan penghormatan terhadap perbedaan pendapat.', 'weight' => 5],
                    ['text' => 'Menghapus anggota komunitas yang seringkali kurang menghargai perbedaan pendapat dan menciptakan kebijakan nol toleransi terhadap perilaku tersebut.', 'weight' => 2],
                    ['text' => 'Mengadopsi pendekatan "setuju untuk tidak setuju" di mana setiap anggota komunitas diberi ruang untuk mengemukakan pendapat mereka tanpa perlu mencapai kesepakatan.', 'weight' => 3],
                    ['text' => 'Menggunakan media sosial dan platform online untuk memperluas wawasan komunitas tentang berbagai perspektif agama dan mempromosikan penghormatan terhadap perbedaan.', 'weight' => 4],
                ]
            ],
            // Soal 24 - DEBCA (D=5, E=4, B=3, C=2, A=1)
            [
                'question_text' => 'Rina adalah seorang aktivis yang prihatin dengan kurangnya pengawasan terhadap konten yang berpotensi meradikalisasi di media sosial. Dia juga melihat adanya kecenderungan masyarakat untuk mengambil informasi dari sumber yang tidak terpercaya, yang dapat memperburuk situasi dan memperluas persebaran pandangan ekstrem. Rina ingin berinovasi dalam mengatasi masalah ini dan memastikan bahwa masyarakat memiliki akses terhadap informasi yang akurat dan terpercaya di media sosial. Namun, Rina dihadapkan pada tantangan dalam memilih tindakan yang tepat untuk mengurangi pengaruh konten berpotensi meradikalisasi dan memperbaiki kebiasaan masyarakat dalam mencari informasi. Sikap yang menurutmu paling tepat dalam situasi ini adalah ... (Anti Radikalisme)',
                'explanation' => '<p><strong>Pembahasan:</strong> Menyusun kurikulum literasi media dan digital adalah investasi jangka panjang untuk mengatasi masalah radikalisasi di media sosial.</p>
                <p><strong>Kunci Bobot: D=5, E=4, B=3, C=2, A=1</strong></p>
                <p>5 = Menyusun kurikulum pendidikan yang memasukkan literasi media dan literasi digital untuk mengajarkan masyarakat tentang cara kritis mengevaluasi dan memahami informasi yang mereka temui di media sosial. (D)<br>
                4 = Membentuk kemitraan dengan platform media sosial dan organisasi masyarakat sipil untuk mengadopsi kebijakan dan inisiatif yang mempromosikan akuntabilitas dan transparansi dalam penyediaan konten di media sosial. (E)<br>
                3 = Mengadakan kampanye penyadaran publik tentang bahaya informasi yang tidak terpercaya dan memberikan panduan bagi masyarakat dalam memilih sumber informasi yang terpercaya. (B)<br>
                2 = Mengembangkan algoritma canggih untuk mengidentifikasi konten yang berpotensi meradikalisasi dan memberikan peringatan kepada pengguna tentang konten yang mereka akses. (C)<br>
                1 = Memperketat pengawasan pemerintah terhadap konten di media sosial dan memberlakukan sanksi hukum terhadap pengguna yang menyebarkan informasi yang meradikalisasi. (A)</p>',
                'options' => [
                    ['text' => 'Memperketat pengawasan pemerintah terhadap konten di media sosial dan memberlakukan sanksi hukum terhadap pengguna yang menyebarkan informasi yang meradikalisasi.', 'weight' => 1],
                    ['text' => 'Mengadakan kampanye penyadaran publik tentang bahaya informasi yang tidak terpercaya dan memberikan panduan bagi masyarakat dalam memilih sumber informasi yang terpercaya.', 'weight' => 3],
                    ['text' => 'Mengembangkan algoritma canggih untuk mengidentifikasi konten yang berpotensi meradikalisasi dan memberikan peringatan kepada pengguna tentang konten yang mereka akses.', 'weight' => 2],
                    ['text' => 'Menyusun kurikulum pendidikan yang memasukkan literasi media dan literasi digital untuk mengajarkan masyarakat tentang cara kritis mengevaluasi dan memahami informasi yang mereka temui di media sosial.', 'weight' => 5],
                    ['text' => 'Membentuk kemitraan dengan platform media sosial dan organisasi masyarakat sipil untuk mengadopsi kebijakan dan inisiatif yang mempromosikan akuntabilitas dan transparansi dalam penyediaan konten di media sosial.', 'weight' => 4],
                ]
            ],
            // Soal 25 - CABDE (C=5, A=4, B=3, D=2, E=1)
            [
                'question_text' => 'Anda adalah seorang kepala departemen IT dalam sebuah perusahaan yang akan melakukan evaluasi teknologi informasi dan komunikasi yang digunakan. Tujuan Anda adalah untuk meningkatkan keamanan data dan sistem serta mengoptimalkan sumber daya. Tindakan terbaik yang dapat Anda ambil dalam evaluasi ini adalah ... (TIK)',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengidentifikasi celah keamanan dan mengambil langkah proaktif adalah prioritas utama dalam evaluasi TIK.</p>
                <p><strong>Kunci Bobot: C=5, A=4, B=3, D=2, E=1</strong></p>
                <p>5 = Mengidentifikasi celah keamanan yang ada dan mengambil langkah-langkah proaktif untuk mengatasi risiko yang terkait. (C)<br>
                4 = Mengganti semua sistem yang ada dengan teknologi terbaru untuk memastikan keamanan yang lebih baik. (A)<br>
                3 = Menerapkan kebijakan yang melarang penggunaan teknologi informasi dan komunikasi pribadi di tempat kerja. (B)<br>
                2 = Mengandalkan laporan permasalahan dan keluhan pengguna sebagai satu-satunya sumber informasi untuk evaluasi. (D)<br>
                1 = Mengandalkan keputusan individu tanpa melibatkan pemangku kepentingan lain dalam organisasi. (E)</p>',
                'options' => [
                    ['text' => 'Mengganti semua sistem yang ada dengan teknologi terbaru untuk memastikan keamanan yang lebih baik.', 'weight' => 4],
                    ['text' => 'Menerapkan kebijakan yang melarang penggunaan teknologi informasi dan komunikasi pribadi di tempat kerja.', 'weight' => 3],
                    ['text' => 'Mengidentifikasi celah keamanan yang ada dan mengambil langkah-langkah proaktif untuk mengatasi risiko yang terkait.', 'weight' => 5],
                    ['text' => 'Mengandalkan laporan permasalahan dan keluhan pengguna sebagai satu-satunya sumber informasi untuk evaluasi.', 'weight' => 2],
                    ['text' => 'Mengandalkan keputusan individu tanpa melibatkan pemangku kepentingan lain dalam organisasi.', 'weight' => 1],
                ]
            ],
            // Soal 26 - CEADB (C=5, E=4, A=3, D=2, B=1)
            [
                'question_text' => 'Anda bekerja sebagai konsultan teknologi di sebuah perusahaan. Sebuah solusi teknologi baru telah diajukan untuk memperbaiki proses bisnis perusahaan tersebut. Namun, beberapa departemen merasa bahwa solusi tersebut tidak sesuai dengan kebutuhan dan proses kerja mereka. Tindakan terbaik yang dapat Anda ambil adalah ... (TIK)',
                'explanation' => '<p><strong>Pembahasan:</strong> Melakukan evaluasi mendalam dan berdiskusi dengan departemen terkait adalah langkah profesional untuk memastikan solusi tepat.</p>
                <p><strong>Kunci Bobot: C=5, E=4, A=3, D=2, B=1</strong></p>
                <p>5 = Melakukan evaluasi mendalam dan berdiskusi dengan departemen terkait untuk memahami kebutuhan mereka sebelum mengimplementasikan solusi teknologi baru. (C)<br>
                4 = Menekankan manfaat solusi teknologi baru tanpa memperhatikan kekhawatiran dan kebutuhan individu departemen. (E)<br>
                3 = Membatalkan solusi teknologi baru dan tetap menggunakan sistem yang sudah ada agar tidak mengganggu departemen yang merasa tidak cocok. (A)<br>
                2 = Menghindari konflik dengan mengabaikan kekhawatiran departemen dan melanjutkan implementasi tanpa mempertimbangkan pandangan mereka. (D)<br>
                1 = Mengabaikan kekhawatiran departemen dan menerapkan solusi teknologi baru tanpa melibatkan mereka. (B)</p>',
                'options' => [
                    ['text' => 'Membatalkan solusi teknologi baru dan tetap menggunakan sistem yang sudah ada agar tidak mengganggu departemen yang merasa tidak cocok.', 'weight' => 3],
                    ['text' => 'Mengabaikan kekhawatiran departemen dan menerapkan solusi teknologi baru tanpa melibatkan mereka.', 'weight' => 1],
                    ['text' => 'Melakukan evaluasi mendalam dan berdiskusi dengan departemen terkait untuk memahami kebutuhan mereka sebelum mengimplementasikan solusi teknologi baru.', 'weight' => 5],
                    ['text' => 'Menghindari konflik dengan mengabaikan kekhawatiran departemen dan melanjutkan implementasi tanpa mempertimbangkan pandangan mereka.', 'weight' => 2],
                    ['text' => 'Menekankan manfaat solusi teknologi baru tanpa memperhatikan kekhawatiran dan kebutuhan individu departemen.', 'weight' => 4],
                ]
            ],
            // Soal 27 - BECAD (B=5, E=4, C=3, A=2, D=1)
            [
                'question_text' => 'Anda adalah seorang pengusaha yang ingin mengadopsi teknologi baru dalam proses produksi perusahaan. Untuk memastikan teknologi tersebut dapat diterima oleh karyawan dan pengguna lainnya, tindakan terbaik yang dapat Anda ambil adalah ... (TIK)',
                'explanation' => '<p><strong>Pembahasan:</strong> Memberikan pelatihan intensif kepada karyawan adalah kunci keberhasilan adopsi teknologi baru.</p>
                <p><strong>Kunci Bobot: B=5, E=4, C=3, A=2, D=1</strong></p>
                <p>5 = Memberikan pelatihan intensif kepada karyawan untuk memahami dan menggunakan teknologi baru. (B)<br>
                4 = Menjelaskan manfaat teknologi baru tanpa memperhatikan kekhawatiran dan pandangan individu karyawan. (E)<br>
                3 = Mengabaikan resistensi karyawan terhadap teknologi baru dan memaksa penggunaannya. (C)<br>
                2 = Menghentikan implementasi teknologi baru karena adanya keberatan dari sebagian karyawan. (A)<br>
                1 = Mengadopsi teknologi baru tanpa mempertimbangkan persiapan dan kesiapan karyawan. (D)</p>',
                'options' => [
                    ['text' => 'Mengabaikan resistensi karyawan terhadap teknologi baru dan memaksa penggunaannya.', 'weight' => 3],
                    ['text' => 'Memberikan pelatihan intensif kepada karyawan untuk memahami dan menggunakan teknologi baru.', 'weight' => 5],
                    ['text' => 'Menghentikan implementasi teknologi baru karena adanya keberatan dari sebagian karyawan.', 'weight' => 2],
                    ['text' => 'Mengadopsi teknologi baru tanpa mempertimbangkan persiapan dan kesiapan karyawan.', 'weight' => 1],
                    ['text' => 'Menjelaskan manfaat teknologi baru tanpa memperhatikan kekhawatiran dan pandangan individu karyawan.', 'weight' => 4],
                ]
            ],
            // Soal 28 - CEBDA (C=5, E=4, B=3, D=2, A=1)
            [
                'question_text' => 'Anda adalah seorang peserta workshop tentang teknologi informasi dan komunikasi yang dihadiri oleh berbagai profesional dari industri yang berbeda-beda. Anda ingin memperluas pengetahuan Anda dalam bidang ini untuk menghadapi tantangan dan perubahan di tempat kerja Anda. Sikap terbaik yang dapat Anda ambil dalam workshop ini adalah ... (TIK)',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengajukan pertanyaan spesifik dan relevan kepada pembicara adalah cara terbaik untuk memperdalam pemahaman.</p>
                <p><strong>Kunci Bobot: C=5, E=4, B=3, D=2, A=1</strong></p>
                <p>5 = Mengajukan pertanyaan yang spesifik dan relevan kepada pembicara untuk memperoleh pemahaman yang lebih mendalam tentang topik yang diminati. (C)<br>
                4 = Menghadiri semua sesi workshop tanpa memilih topik tertentu yang ingin Anda pelajari lebih mendalam. (E)<br>
                3 = Mencatat semua materi presentasi tanpa berinteraksi dengan peserta lain untuk menghindari gangguan. (B)<br>
                2 = Mengabaikan kesempatan untuk berkolaborasi dengan peserta lain dan mengambil manfaat dari pengalaman dan perspektif mereka. (D)<br>
                1 = Memprioritaskan topik-topik yang sudah dikuasai sebelumnya dan mengabaikan topik baru yang mungkin lebih relevan untuk perkembangan masa depan. (A)</p>',
                'options' => [
                    ['text' => 'Memprioritaskan topik-topik yang sudah dikuasai sebelumnya dan mengabaikan topik baru yang mungkin lebih relevan untuk perkembangan masa depan.', 'weight' => 1],
                    ['text' => 'Mencatat semua materi presentasi tanpa berinteraksi dengan peserta lain untuk menghindari gangguan.', 'weight' => 3],
                    ['text' => 'Mengajukan pertanyaan yang spesifik dan relevan kepada pembicara untuk memperoleh pemahaman yang lebih mendalam tentang topik yang diminati.', 'weight' => 5],
                    ['text' => 'Mengabaikan kesempatan untuk berkolaborasi dengan peserta lain dan mengambil manfaat dari pengalaman dan perspektif mereka.', 'weight' => 2],
                    ['text' => 'Menghadiri semua sesi workshop tanpa memilih topik tertentu yang ingin Anda pelajari lebih mendalam.', 'weight' => 4],
                ]
            ],
            // Soal 29 - CEADB (C=5, E=4, A=3, D=2, B=1)
            [
                'question_text' => 'Anda adalah seorang pengusaha yang ingin mengadopsi teknologi baru untuk meningkatkan daya saing perusahaan. Namun, sebagian karyawan merasa tidak nyaman dengan perubahan tersebut dan merasa tidak siap untuk menggunakan teknologi baru tersebut. Tindakan terbaik yang dapat Anda ambil adalah ... (TIK)',
                'explanation' => '<p><strong>Pembahasan:</strong> Membuka ruang diskusi dan memberikan pelatihan serta dukungan adalah pendekatan yang paling bijaksana.</p>
                <p><strong>Kunci Bobot: C=5, E=4, A=3, D=2, B=1</strong></p>
                <p>5 = Membuka ruang untuk diskusi dan memberikan pelatihan serta dukungan yang memadai bagi karyawan untuk memahami dan menggunakan teknologi baru. (C)<br>
                4 = Menekankan manfaat teknologi baru tanpa memperhatikan ketidaknyamanan dan kebutuhan individu karyawan. (E)<br>
                3 = Mengabaikan kekhawatiran karyawan dan memaksakan penggunaan teknologi baru tanpa memberikan pelatihan atau dukungan yang memadai. (A)<br>
                2 = Menghindari konflik dengan mengabaikan kekhawatiran karyawan dan melanjutkan implementasi tanpa memperhatikan pandangan mereka. (D)<br>
                1 = Memecat karyawan yang menolak untuk menggunakan teknologi baru sebagai upaya untuk mendorong adopsi. (B)</p>',
                'options' => [
                    ['text' => 'Mengabaikan kekhawatiran karyawan dan memaksakan penggunaan teknologi baru tanpa memberikan pelatihan atau dukungan yang memadai.', 'weight' => 3],
                    ['text' => 'Memecat karyawan yang menolak untuk menggunakan teknologi baru sebagai upaya untuk mendorong adopsi.', 'weight' => 1],
                    ['text' => 'Membuka ruang untuk diskusi dan memberikan pelatihan serta dukungan yang memadai bagi karyawan untuk memahami dan menggunakan teknologi baru.', 'weight' => 5],
                    ['text' => 'Menghindari konflik dengan mengabaikan kekhawatiran karyawan dan melanjutkan implementasi tanpa memperhatikan pandangan mereka.', 'weight' => 2],
                    ['text' => 'Menekankan manfaat teknologi baru tanpa memperhatikan ketidaknyamanan dan kebutuhan individu karyawan.', 'weight' => 4],
                ]
            ],
            // Soal 30 - CEDAB (C=5, E=4, D=3, A=2, B=1)
            [
                'question_text' => 'Anda bekerja sebagai manajer proyek dalam sebuah perusahaan IT yang ingin mengimplementasikan sistem manajemen proyek yang baru. Agar sistem tersebut dapat diterima oleh karyawan dan pengguna lainnya, tindakan terbaik yang dapat Anda lakukan adalah ... (TIK)',
                'explanation' => '<p><strong>Pembahasan:</strong> Melibatkan karyawan dalam proses perencanaan dan implementasi adalah kunci keberhasilan adopsi sistem baru.</p>
                <p><strong>Kunci Bobot: C=5, E=4, D=3, A=2, B=1</strong></p>
                <p>5 = Melibatkan karyawan dalam proses perencanaan dan implementasi sistem manajemen proyek baru. (C)<br>
                4 = Menjelaskan keuntungan dan manfaat sistem manajemen proyek baru dengan memperhatikan kekhawatiran individu karyawan. (E)<br>
                3 = Mengimplementasikan sistem manajemen proyek baru dengan memperhatikan kebutuhan dan keinginan karyawan. (D)<br>
                2 = Meminta karyawan untuk menggunakan sistem manajemen proyek baru dan meminta mereka belajar secara mandiri. (A)<br>
                1 = Menghentikan implementasi sistem manajemen proyek baru karena adanya penolakan dari beberapa anggota tim. (B)</p>',
                'options' => [
                    ['text' => 'Meminta karyawan untuk menggunakan sistem manajemen proyek baru dan meminta mereka belajar secara mandiri.', 'weight' => 2],
                    ['text' => 'Menghentikan implementasi sistem manajemen proyek baru karena adanya penolakan dari beberapa anggota tim.', 'weight' => 1],
                    ['text' => 'Melibatkan karyawan dalam proses perencanaan dan implementasi sistem manajemen proyek baru.', 'weight' => 5],
                    ['text' => 'Mengimplementasikan sistem manajemen proyek baru dengan memperhatikan kebutuhan dan keinginan karyawan.', 'weight' => 3],
                    ['text' => 'Menjelaskan keuntungan dan manfaat sistem manajemen proyek baru dengan memperhatikan kekhawatiran individu karyawan.', 'weight' => 4],
                ]
            ],
            // Soal 31 - BECAD (B=5, E=4, C=3, A=2, D=1)
            [
                'question_text' => 'Anda adalah seorang anggota tim pengembangan aplikasi dalam sebuah organisasi yang akan melakukan evaluasi teknologi informasi dan komunikasi yang digunakan. Tim Anda ingin memastikan bahwa teknologi yang digunakan dapat memenuhi kebutuhan pengguna dan mendukung pertumbuhan bisnis. Sikap terbaik yang dapat Anda ambil dalam evaluasi ini adalah ... (TIK)',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengadakan sesi pengujian internal yang melibatkan pengguna aktif adalah cara terbaik untuk mengidentifikasi kelebihan dan kekurangan teknologi.</p>
                <p><strong>Kunci Bobot: B=5, E=4, C=3, A=2, D=1</strong></p>
                <p>5 = Mengadakan sesi pengujian internal yang melibatkan pengguna aktif untuk mengidentifikasi kelebihan dan kekurangan teknologi yang ada. (B)<br>
                4 = Melakukan evaluasi berdasarkan penilaian individu dengan melibatkan tim atau pemangku kepentingan lain dalam organisasi. (E)<br>
                3 = Memilih teknologi baru tanpa melibatkan pengguna dan berharap mereka akan beradaptasi dengan baik. (C)<br>
                2 = Fokus memprioritaskan fitur dan fungsionalitas yang menarik secara visual. (A)<br>
                1 = Membatasi evaluasi pada aspek teknis yang dapat membantu perkembangan aplikasi. (D)</p>',
                'options' => [
                    ['text' => 'Fokus memprioritaskan fitur dan fungsionalitas yang menarik secara visual.', 'weight' => 2],
                    ['text' => 'Mengadakan sesi pengujian internal yang melibatkan pengguna aktif untuk mengidentifikasi kelebihan dan kekurangan teknologi yang ada.', 'weight' => 5],
                    ['text' => 'Memilih teknologi baru tanpa melibatkan pengguna dan berharap mereka akan beradaptasi dengan baik.', 'weight' => 3],
                    ['text' => 'Membatasi evaluasi pada aspek teknis yang dapat membantu perkembangan aplikasi.', 'weight' => 1],
                    ['text' => 'Melakukan evaluasi berdasarkan penilaian individu dengan melibatkan tim atau pemangku kepentingan lain dalam organisasi.', 'weight' => 4],
                ]
            ],
            // Soal 32 - DBCAE (D=5, B=4, C=3, A=2, E=1)
            [
                'question_text' => 'Tina, pemilik bisnis kecil, ingin meningkatkan keterlibatan pelanggan melalui media sosial. Dia tahu bahwa media sosial bisa menjadi alat yang kuat, tapi juga menyadari risiko yang terkait. Sikap apa yang sebaiknya Tina ambil? (TIK)',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengembangkan strategi konten beragam untuk menjaga keterlibatan yang tinggi adalah pendekatan yang tepat.</p>
                <p><strong>Kunci Bobot: D=5, B=4, C=3, A=2, E=1</strong></p>
                <p>5 = Mengembangkan strategi konten beragam untuk menjaga keterlibatan yang tinggi. (D)<br>
                4 = Melakukan riset pasar untuk memilih platform yang paling relevan dengan audiensnya. (B)<br>
                3 = Membuat konten yang hanya mempromosikan produk dan layanan bisnis. (C)<br>
                2 = Membuat akun di semua platform populer tanpa mempertimbangkan audiens dan sumber daya. (A)<br>
                1 = Menghindari media sosial karena risiko penyalahgunaan informasi dan komentar negatif. (E)</p>',
                'options' => [
                    ['text' => 'Membuat akun di semua platform populer tanpa mempertimbangkan audiens dan sumber daya.', 'weight' => 2],
                    ['text' => 'Melakukan riset pasar untuk memilih platform yang paling relevan dengan audiensnya.', 'weight' => 4],
                    ['text' => 'Membuat konten yang hanya mempromosikan produk dan layanan bisnis.', 'weight' => 3],
                    ['text' => 'Mengembangkan strategi konten beragam untuk menjaga keterlibatan yang tinggi.', 'weight' => 5],
                    ['text' => 'Menghindari media sosial karena risiko penyalahgunaan informasi dan komentar negatif.', 'weight' => 1],
                ]
            ],
            // Soal 33 - DBCAE (D=5, B=4, C=3, A=2, E=1)
            [
                'question_text' => 'Rudy adalah seorang pengusaha di bidang teknologi yang ingin meningkatkan keterlibatan pengguna dengan produk barunya menggunakan media sosial. Rudy ingin memanfaatkan media sosial untuk memperkenalkan produknya kepada pengguna potensial. Berikut adalah sikap-sikap yang bisa diambil oleh Rudy. Pilihlah sikap yang menurutmu paling tepat dalam situasi ini ... (TIK)',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengidentifikasi audiens target yang spesifik dan menyusun konten yang relevan adalah strategi paling efektif.</p>
                <p><strong>Kunci Bobot: D=5, B=4, C=3, A=2, E=1</strong></p>
                <p>5 = Mengidentifikasi audiens target yang spesifik dan menyusun konten yang relevan dan menarik untuk mereka. (D)<br>
                4 = Menyewa tim media sosial untuk mengelola platform-platform media sosial agar dapat fokus pada pengembangan produk. (B)<br>
                3 = Mengabaikan tanggapan atau komentar pengguna dalam media sosial untuk menghindari potensi kritik atau masalah yang dapat muncul. (C)<br>
                2 = Membagikan konten promosi secara berlebihan tanpa memperhatikan kebutuhan dan minat pengguna. (A)<br>
                1 = Menghapus akun media sosial bisnis dan beralih sepenuhnya ke strategi pemasaran yang lebih tradisional. (E)</p>',
                'options' => [
                    ['text' => 'Membagikan konten promosi secara berlebihan tanpa memperhatikan kebutuhan dan minat pengguna.', 'weight' => 2],
                    ['text' => 'Menyewa tim media sosial untuk mengelola platform-platform media sosial agar dapat fokus pada pengembangan produk.', 'weight' => 4],
                    ['text' => 'Mengabaikan tanggapan atau komentar pengguna dalam media sosial untuk menghindari potensi kritik atau masalah yang dapat muncul.', 'weight' => 3],
                    ['text' => 'Mengidentifikasi audiens target yang spesifik dan menyusun konten yang relevan dan menarik untuk mereka.', 'weight' => 5],
                    ['text' => 'Menghapus akun media sosial bisnis dan beralih sepenuhnya ke strategi pemasaran yang lebih tradisional.', 'weight' => 1],
                ]
            ],
            // Soal 34 - BEDAC (B=5, E=4, D=3, A=2, C=1)
            [
                'question_text' => 'Chandra seorang honorer yang ingin mendaftar di Seleksi CPNS Tahun 2024, ia dituntut harus cermat dalam bermedia sosial. Di era sekarang ini sangat banyak berita dan informasi hoax yang beredar di sosial media, salah satunya terkait Seleksi CPNS Tahun 2024. Informasi ini disebar oleh pihak yang belum mengetahui infonya secara pasti sehingga membuat banyak honorer yang terprovokasi. Sikap Chandra menanggapi hal tersebut ... (TIK)',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengenali sumber berita dan menunggu pengumuman resmi adalah sikap cerdas dalam menghadapi hoax.</p>
                <p><strong>Kunci Bobot: B=5, E=4, D=3, A=2, C=1</strong></p>
                <p>5 = Mengenali sumber berita akurat atau tidaknya dan menunggu pengumuman resmi dari BKN. (B)<br>
                4 = Membaca keseluruhan informasi secara lengkap. (E)<br>
                3 = Membacanya saja kemudian tidak mengambil pusing informasi tersebut. (D)<br>
                2 = Membatasi penggunaan media sosial dan menggunakan untuk hal yang penting saja. (A)<br>
                1 = Mengenali judul berita terkadang terkesan provokatif. (C)</p>',
                'options' => [
                    ['text' => 'Membatasi penggunaan media sosial dan menggunakan untuk hal yang penting saja', 'weight' => 2],
                    ['text' => 'Mengenali sumber berita akurat atau tidaknya dan menunggu pengumuman resmi dari BKN', 'weight' => 5],
                    ['text' => 'Mengenali judul berita terkadang terkesan provokatif', 'weight' => 1],
                    ['text' => 'Membacanya saja kemudian tidak mengambil pusing informasi tersebut', 'weight' => 3],
                    ['text' => 'Membaca keseluruhan informasi secara lengkap', 'weight' => 4],
                ]
            ],
            // Soal 35 - AEDCB (A=5, E=4, D=3, C=2, B=1)
            [
                'question_text' => 'Anak-anak pada zaman saat ini dihadapkan dengan arus globalisasi yang sangat deras. Selain dampak positif yang dihasilkan, tentu juga ada dampak negatifnya. Seperti kejadian yang viral beberapa minggu ini, di mana ada seorang Bapak yang tega mengurung anaknya di dalam kandang ayam karena sudah terlalu kecanduan game online. Kemudahan akses informasi via internet saat ini, menurut saya ... (TIK)',
                'explanation' => '<p><strong>Pembahasan:</strong> Dampak internet tergantung pada bagaimana seseorang menggunakannya.</p>
                <p><strong>Kunci Bobot: A=5, E=4, D=3, C=2, B=1</strong></p>
                <p>5 = Tergantung pada bagaimana seseorang dan pemakaiannya. (A)<br>
                4 = Mempermudah belajar secara mandiri dan kelompok. (E)<br>
                3 = Memperluas pertemanan yang berpengaruh positif dan meningkatkan keilmuan. (D)<br>
                2 = Menganggap hubungan inter-personal mendekatkan yang jauh, menjauhkan yang dekat. (C)<br>
                1 = Menganggap kinerja secara umum dan menganggap kebersamaan keluarga. (B)</p>',
                'options' => [
                    ['text' => 'Tergantung pada bagaimana seseorang dan pemakaiannya', 'weight' => 5],
                    ['text' => 'Menganggap kinerja secara umum dan menganggap kebersamaan keluarga', 'weight' => 1],
                    ['text' => 'Menganggap hubungan inter-personal mendekatkan yang jauh, menjauhkan yang dekat', 'weight' => 2],
                    ['text' => 'Memperluas pertemanan yang berpengaruh positif dan meningkatkan keilmuan', 'weight' => 3],
                    ['text' => 'Mempermudah belajar secara mandiri dan kelompok', 'weight' => 4],
                ]
            ],
            // Soal 36 - ACBDE (A=5, C=4, B=3, D=2, E=1)
            [
                'question_text' => 'Ketika instansi tempat Anda bekerja membuat kebijakan baru yang memanfaatkan teknologi, padahal Anda sendiri kurang paham teknologi. Sikap Anda ... (TIK)',
                'explanation' => '<p><strong>Pembahasan:</strong> Ikut serta belajar dan meminta bantuan ahli IT adalah sikap proaktif yang terbaik.</p>
                <p><strong>Kunci Bobot: A=5, C=4, B=3, D=2, E=1</strong></p>
                <p>5 = Ikut serta mengembangkan teknologi tersebut dan meminta ahli IT untuk mengajari Anda. (A)<br>
                4 = Menerima kebijakan baru tersebut dan mengusulkan ide untuk kemajuan. (C)<br>
                3 = Menerima kebijakan baru tersebut dengan menyerahkan semua pengembangannya kepada ahli IT. (B)<br>
                2 = Menyemangati rekan lain agar ikut mengembangkan teknologi terkait kebijakan tersebut. (D)<br>
                1 = Merasa bahwa cara yang lama sudah cukup mendukung. (E)</p>',
                'options' => [
                    ['text' => 'Ikut serta mengembangkan teknologi tersebut dan meminta ahli IT untuk mengajari Anda', 'weight' => 5],
                    ['text' => 'Menerima kebijakan baru tersebut dengan menyerahkan semua pengembangannya kepada ahli IT', 'weight' => 3],
                    ['text' => 'Menerima kebijakan baru tersebut dan mengusulkan ide untuk kemajuan', 'weight' => 4],
                    ['text' => 'Menyemangati rekan lain agar ikut mengembangkan teknologi terkait kebijakan tersebut', 'weight' => 2],
                    ['text' => 'Merasa bahwa cara yang lama sudah cukup mendukung', 'weight' => 1],
                ]
            ],
            // Soal 37 - BDCAE (B=5, D=4, C=3, A=2, E=1)
            [
                'question_text' => 'Anda adalah seorang koordinator program komunitas yang bertujuan untuk memperkuat hubungan antar warga dengan latar belakang agama dan kepercayaan yang berbeda. Tindakan terbaik yang dapat Anda lakukan adalah ... (Sosial Budaya)',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengadakan forum diskusi dengan perwakilan berbagai agama untuk saling berbagi pemahaman adalah langkah terbaik.</p>
                <p><strong>Kunci Bobot: B=5, D=4, C=3, A=2, E=1</strong></p>
                <p>5 = Mengadakan forum diskusi yang melibatkan perwakilan dari berbagai agama dan kepercayaan untuk saling berbagi pengalaman dan pemahaman. (B)<br>
                4 = Membentuk kelompok kerja yang terdiri dari warga dengan agama atau kepercayaan yang berbeda untuk mengatasi isu-isu sosial bersama-sama. (D)<br>
                3 = Mengabaikan perbedaan agama dan kepercayaan dalam program komunitas dan fokus pada kegiatan praktis. (C)<br>
                2 = Menghindari topik agama dan kepercayaan dalam kegiatan komunitas agar tidak menimbulkan konflik. (A)<br>
                1 = Melarang kegiatan keagamaan atau kepercayaan di ruang publik untuk menghindari konflik dan ketidaknyamanan. (E)</p>',
                'options' => [
                    ['text' => 'Menghindari topik agama dan kepercayaan dalam kegiatan komunitas agar tidak menimbulkan konflik.', 'weight' => 2],
                    ['text' => 'Mengadakan forum diskusi yang melibatkan perwakilan dari berbagai agama dan kepercayaan untuk saling berbagi pengalaman dan pemahaman.', 'weight' => 5],
                    ['text' => 'Mengabaikan perbedaan agama dan kepercayaan dalam program komunitas dan fokus pada kegiatan praktis.', 'weight' => 3],
                    ['text' => 'Membentuk kelompok kerja yang terdiri dari warga dengan agama atau kepercayaan yang berbeda untuk mengatasi isu-isu sosial bersama-sama.', 'weight' => 4],
                    ['text' => 'Melarang kegiatan keagamaan atau kepercayaan di ruang publik untuk menghindari konflik dan ketidaknyamanan.', 'weight' => 1],
                ]
            ],
            // Soal 38 - DCEAB (D=5, C=4, E=3, A=2, B=1)
            [
                'question_text' => 'Anda adalah seorang pemimpin organisasi non-profit yang memiliki anggota dengan latar belakang agama dan kepercayaan yang beragam. Untuk menciptakan kerja sama yang lebih baik di antara mereka, tindakan terbaik yang dapat Anda lakukan adalah ... (Sosial Budaya)',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengadakan kegiatan yang merayakan keragaman agama dan kepercayaan anggota adalah cara terbaik membangun kerja sama.</p>
                <p><strong>Kunci Bobot: D=5, C=4, E=3, A=2, B=1</strong></p>
                <p>5 = Mengadakan kegiatan atau acara yang merayakan keragaman agama dan kepercayaan anggota. (D)<br>
                4 = Mengesampingkan perbedaan agama dan kepercayaan dalam organisasi dan fokus pada tujuan bersama. (C)<br>
                3 = Mengatur pembagian tugas berdasarkan agama atau kepercayaan anggota untuk mencegah konflik. (E)<br>
                2 = Mengadakan pertemuan khusus untuk anggota dengan agama atau kepercayaan yang sama untuk memperkuat ikatan mereka. (A)<br>
                1 = Menerapkan aturan organisasi yang membatasi ekspresi agama atau kepercayaan anggota. (B)</p>',
                'options' => [
                    ['text' => 'Mengadakan pertemuan khusus untuk anggota dengan agama atau kepercayaan yang sama untuk memperkuat ikatan mereka.', 'weight' => 2],
                    ['text' => 'Menerapkan aturan organisasi yang membatasi ekspresi agama atau kepercayaan anggota.', 'weight' => 1],
                    ['text' => 'Mengesampingkan perbedaan agama dan kepercayaan dalam organisasi dan fokus pada tujuan bersama.', 'weight' => 4],
                    ['text' => 'Mengadakan kegiatan atau acara yang merayakan keragaman agama dan kepercayaan anggota.', 'weight' => 5],
                    ['text' => 'Mengatur pembagian tugas berdasarkan agama atau kepercayaan anggota untuk mencegah konflik.', 'weight' => 3],
                ]
            ],
            // Soal 39 - BCDAE (B=5, C=4, D=3, A=2, E=1)
            [
                'question_text' => 'Konflik yang terjadi di suatu wilayah perkotaan selalu dipicu oleh kecemburuan sosial antara penduduk asli dengan para pendatang. Jika saya seorang pendatang, saya akan melakukan beberapa hal diantaranya ... (Sosial Budaya)',
                'explanation' => '<p><strong>Pembahasan:</strong> Sebagai pendatang, menghidupkan perekonomian warga, pendekatan keagamaan, dan mengikuti adat setempat adalah langkah bijak.</p>
                <p><strong>Kunci Bobot: B=5, C=4, D=3, A=2, E=1</strong></p>
                <p>5 = Menghidupkan perekonomian warga setempat, melakukan pendekatan keagamaan dan mengikuti aturan adat setempat sepanjang masih ada dijalur yang benar. (B)<br>
                4 = Menghimbau para usahawan pendatang yang sukses agar memperkerjakan warga asli yang masih pengangguran. (C)<br>
                3 = Mengawasi/memonitor warga asli/pendatang yang dikhawatirkan sebagai provokator yang akan memperkeruh suasana di lingkungan setempat. (D)<br>
                2 = Membentuk organisasi kemasyarakatan dimana pengurusnya adalah pendatang dan warga asli. (A)<br>
                1 = Memberitahukan untuk mencurigai warga yang tidak berpartisipasi sosialisasi. (E)</p>',
                'options' => [
                    ['text' => 'Membentuk organisasi kemasyarakatan dimana pengurusnya adalah pendatang dan warga asli', 'weight' => 2],
                    ['text' => 'Menghidupkan perekonomian warga setempat, melakukan pendekatan keagamaan dan mengikuti aturan adat setempat sepanjang masih ada dijalur yang benar', 'weight' => 5],
                    ['text' => 'Menghimbau para usahawan pendatang yang sukses agar memperkerjakan warga asli yang masih pengangguran', 'weight' => 4],
                    ['text' => 'Mengawasi/memonitor warga asli/pendatang yang dikhawatirkan sebagai provokator yang akan memperkeruh suasana di lingkungan setempat', 'weight' => 3],
                    ['text' => 'Memberitahukan untuk mencurigai warga yang tidak berpartisipasi sosialisasi', 'weight' => 1],
                ]
            ],
            // Soal 40 - BCEAD (B=5, C=4, E=3, A=2, D=1)
            [
                'question_text' => 'Setelah hujan deras, beberapa titik lampu di sekitar rumah saya padam karena tersambar petir. Hal ini cukup mengganggu aktivitas warga sekitar di malam hari. Sebagai seorang yang tidak terlalu memahami tentang kelistrikan, yang saya lakukan adalah.... (Sosial Budaya)',
                'explanation' => '<p><strong>Pembahasan:</strong> Melapor kepada ketua RT dan meminta pertimbangan solusi adalah tindakan paling bijak.</p>
                <p><strong>Kunci Bobot: B=5, C=4, E=3, A=2, D=1</strong></p>
                <p>5 = Melapor kepada ketua RT dan meminta pertimbangan solusi. (B)<br>
                4 = Memanggil tukang listrik untuk memperbaiki kerusakan. (C)<br>
                3 = Mengajak warga sekitar rumah saya untuk bersama-sama memperbaikinya. (E)<br>
                2 = Berusaha memperbaiki sendiri semaksimal yang saya bisa. (A)<br>
                1 = Membiarkan saja sampai masalah tersebut teratasi dengan sendirinya. (D)</p>',
                'options' => [
                    ['text' => 'Berusaha memperbaiki sendiri semaksimal yang saya bisa', 'weight' => 2],
                    ['text' => 'Memanggil tukang listrik untuk memperbaiki kerusakan', 'weight' => 4],
                    ['text' => 'Melapor kepada ketua RT dan meminta pertimbangan solusi', 'weight' => 5],
                    ['text' => 'Membiarkan saja sampai masalah tersebut teratasi dengan sendirinya', 'weight' => 1],
                    ['text' => 'Mengajak warga sekitar rumah saya untuk bersama-sama memperbaikinya', 'weight' => 3],
                ]
            ],
            // Soal 41 - CDABE (C=5, D=4, A=3, B=2, E=1)
            [
                'question_text' => 'Anda adalah seorang pegawai di sebuah perusahaan yang memiliki banyak departemen. Untuk menjalin komunikasi yang baik dengan rekan kerja dari departemen lain, tindakan terbaik yang dapat Anda lakukan adalah ... (Jejaring Kerja)',
                'explanation' => '<p><strong>Pembahasan:</strong> Mengadakan pertemuan atau diskusi antar departemen secara rutin adalah cara terbaik membangun jejaring kerja.</p>
                <p><strong>Kunci Bobot: C=5, D=4, A=3, B=2, E=1</strong></p>
                <p>5 = Mengadakan pertemuan atau diskusi antar departemen secara rutin untuk berbagi informasi dan pemahaman. (C)<br>
                4 = Mengabaikan konflik atau perbedaan pendapat yang muncul dengan rekan kerja dari departemen lain. (D)<br>
                3 = Membatasi komunikasi hanya pada lingkup tugas dan tanggung jawab Anda sendiri. (A)<br>
                2 = Menghindari kolaborasi dan kerja sama dengan rekan kerja dari departemen lain. (B)<br>
                1 = Menganggap departemen lain sebagai pesaing dan tidak berbagi sumber daya atau pengetahuan. (E)</p>',
                'options' => [
                    ['text' => 'Membatasi komunikasi hanya pada lingkup tugas dan tanggung jawab Anda sendiri.', 'weight' => 3],
                    ['text' => 'Menghindari kolaborasi dan kerja sama dengan rekan kerja dari departemen lain.', 'weight' => 2],
                    ['text' => 'Mengadakan pertemuan atau diskusi antar departemen secara rutin untuk berbagi informasi dan pemahaman.', 'weight' => 5],
                    ['text' => 'Mengabaikan konflik atau perbedaan pendapat yang muncul dengan rekan kerja dari departemen lain.', 'weight' => 4],
                    ['text' => 'Menganggap departemen lain sebagai pesaing dan tidak berbagi sumber daya atau pengetahuan.', 'weight' => 1],
                ]
            ],
            // Soal 42 - CBDAE (C=5, B=4, D=3, A=2, E=1)
            [
                'question_text' => 'Anda adalah seorang profesional yang sedang mencari peluang karier baru. Untuk membangun jejaring kerja yang kuat menggunakan platform online, tindakan terbaik yang dapat Anda lakukan adalah ... (Jejaring Kerja)',
                'explanation' => '<p><strong>Pembahasan:</strong> Menggunakan platform online untuk berbagi pemikiran dan pengalaman adalah cara efektif membangun jejaring.</p>
                <p><strong>Kunci Bobot: C=5, B=4, D=3, A=2, E=1</strong></p>
                <p>5 = Menggunakan platform online untuk berbagi pemikiran dan pengalaman Anda dalam bidang yang Anda minati. (C)<br>
                4 = Menghindari memberikan rekomendasi atau testimonial kepada rekan kerja atau kolega online. (B)<br>
                3 = Menyimpan kontak atau kesempatan kerja yang berharga hanya untuk diri sendiri dan tidak berbagi dengan orang lain. (D)<br>
                2 = Menghindari berpartisipasi dalam diskusi atau forum online yang berkaitan dengan bidang minat Anda. (A)<br>
                1 = Mengabaikan permintaan pertemanan atau koneksi dari orang-orang yang tidak Anda kenal secara pribadi. (E)</p>',
                'options' => [
                    ['text' => 'Menghindari berpartisipasi dalam diskusi atau forum online yang berkaitan dengan bidang minat Anda.', 'weight' => 2],
                    ['text' => 'Mengabaikan permintaan pertemanan atau koneksi dari orang-orang yang tidak Anda kenal secara pribadi.', 'weight' => 1],
                    ['text' => 'Menggunakan platform online untuk berbagi pemikiran dan pengalaman Anda dalam bidang yang Anda minati.', 'weight' => 5],
                    ['text' => 'Menghindari memberikan rekomendasi atau testimonial kepada rekan kerja atau kolega online.', 'weight' => 4],
                    ['text' => 'Menyimpan kontak atau kesempatan kerja yang berharga hanya untuk diri sendiri dan tidak berbagi dengan orang lain.', 'weight' => 3],
                ]
            ],
            // Soal 43 - CBDEA (C=5, B=4, D=3, E=2, A=1)
            [
                'question_text' => 'Anda adalah seorang freelancer yang ingin memperluas jaringan profesional menggunakan media sosial. Untuk membangun jejaring kerja yang kuat, tindakan terbaik yang dapat Anda lakukan adalah ... (Jejaring Kerja)',
                'explanation' => '<p><strong>Pembahasan:</strong> Membagikan portofolio dan proyek yang telah diselesaikan adalah cara terbaik menunjukkan kemampuan.</p>
                <p><strong>Kunci Bobot: C=5, B=4, D=3, E=2, A=1</strong></p>
                <p>5 = Membagikan portofolio dan proyek-proyek yang telah Anda selesaikan untuk menunjukkan kemampuan Anda. (C)<br>
                4 = Menjaga informasi kontak dan detail pekerjaan hanya untuk diri sendiri dan tidak berbagi dengan orang lain. (B)<br>
                3 = Menghindari memberikan apresiasi atau dukungan kepada rekan kerja atau klien di media sosial. (D)<br>
                2 = Mengabaikan kesempatan untuk berkolaborasi dengan profesional di luar bidang keahlian Anda. (E)<br>
                1 = Membatasi interaksi hanya pada teman-teman dekat dan keluarga Anda. (A)</p>',
                'options' => [
                    ['text' => 'Membatasi interaksi hanya pada teman-teman dekat dan keluarga Anda.', 'weight' => 1],
                    ['text' => 'Mengabaikan kesempatan untuk berkolaborasi dengan profesional di luar bidang keahlian Anda.', 'weight' => 2],
                    ['text' => 'Membagikan portofolio dan proyek-proyek yang telah Anda selesaikan untuk menunjukkan kemampuan Anda', 'weight' => 5],
                    ['text' => 'Menghindari memberikan apresiasi atau dukungan kepada rekan kerja atau klien di media sosial.', 'weight' => 3],
                    ['text' => 'Menjaga informasi kontak dan detail pekerjaan hanya untuk diri sendiri dan tidak berbagi dengan orang lain.', 'weight' => 4],
                ]
            ],
            // Soal 44 - CEABD (C=5, E=4, A=3, B=2, D=1)
            [
                'question_text' => 'Kantor merupakan tempat yang penuh dengan tekanan, namun bukan menjadi penghalang untuk bekerja dengan maksimal. Dalam keseharian ketika di kantor, maka saya adalah pegawai yang ... (Jejaring Kerja)',
                'explanation' => '<p><strong>Pembahasan:</strong> Mampu bekerja sama dengan rekan lain baik untuk urusan pekerjaan maupun non-pekerjaan adalah sikap ideal.</p>
                <p><strong>Kunci Bobot: C=5, E=4, A=3, B=2, D=1</strong></p>
                <p>5 = Mampu bekerja sama dengan rekan kerja lain, baik untuk urusan terkait pekerjaan maupun bukan. (C)<br>
                4 = Bisa bekerja sama dengan rekan kerja lain, baik senior maupun junior untuk masalah pekerjaan. (E)<br>
                3 = Memiliki hubungan baik dengan rekan kerja sesama departemen. (A)<br>
                2 = Kurang suka bergaul dengan rekan kerja lain dan hanya fokus dalam pekerjaan sendiri. (B)<br>
                1 = Tidak bisa bekerja sama dengan rekan kerja yang dirasa tidak satu visi misi. (D)</p>',
                'options' => [
                    ['text' => 'Memiliki hubungan baik dengan rekan kerja sesama departemen', 'weight' => 3],
                    ['text' => 'Kurang suka bergaul dengan rekan kerja lain dan hanya fokus dalam pekerjaan sendiri', 'weight' => 2],
                    ['text' => 'Bisa bekerja sama dengan rekan kerja lain, baik senior maupun junior untuk masalah pekerjaan', 'weight' => 4],
                    ['text' => 'Tidak bisa bekerja sama dengan rekan kerja yang dirasa tidak satu visi misi', 'weight' => 1],
                    ['text' => 'Mampu bekerja sama dengan rekan kerja lain, baik untuk urusan terkait pekerjaan maupun bukan', 'weight' => 5],
                ]
            ],
            // Soal 45 - ABDCE (A=5, B=4, D=3, C=2, E=1)
            [
                'question_text' => 'Ketika Anda menjabat sebagai kepala keuangan terembus kabar bahwa Anda melakukan tindak korupsi. Banyak yang membicarakan Anda. Padahal belum ada bukti apapun yang membenarkan bahwa Anda korupsi. Menyikapi pemberitaan yang kurang baik di kantor tentang diri Anda, maka ... (Jejaring Kerja)',
                'explanation' => '<p><strong>Pembahasan:</strong> Mencari bukti penguat dan klarifikasi adalah langkah paling profesional untuk membersihkan nama baik.</p>
                <p><strong>Kunci Bobot: A=5, B=4, D=3, C=2, E=1</strong></p>
                <p>5 = Mencari bukti penguat dan akan klarifikasi untuk membuktikan kebenarannya. (A)<br>
                4 = Memberi tahu rekan Anda agar tidak sembarang berspekulasi sebelum ada bukti. (B)<br>
                3 = Mencoba klarifikasi agar mereka tidak terus-terusan membicarakan Anda. (D)<br>
                2 = Memilih untuk diam dan tidak menanggapi karena diluar kapasitas Anda. (C)<br>
                1 = Mendiamkannya dan mengambil jarak dari mereka agar tidak terbebani. (E)</p>',
                'options' => [
                    ['text' => 'Mencari bukti penguat dan akan klarifikasi untuk membuktikan kebenarannya', 'weight' => 5],
                    ['text' => 'Memberi tahu rekan Anda agar tidak sembarang berspekulasi sebelum ada bukti', 'weight' => 4],
                    ['text' => 'Memilih untuk diam dan tidak menanggapi karena diluar kapasitas Anda', 'weight' => 2],
                    ['text' => 'Mencoba klarifikasi agar mereka tidak terus-terusan membicarakan Anda', 'weight' => 3],
                    ['text' => 'Mendiamkannya dan mengambil jarak dari mereka agar tidak terbebani', 'weight' => 1],
                ]
            ],
        ];

        // Simpan soal
        foreach ($questions as $index => $questionData) {
            $question = Question::create([
                'material_id' => $material->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $order = 1;
            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['text'],
                    'is_correct' => false,
                    'order' => $order,
                    'weight' => $optionData['weight'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $order++;
            }
        }

        $this->command->info('Seeder TKP SKD Intensif 2 Part 2 (soal 21-45) berhasil dibuat!');
        $this->command->info('Material ID: ' . $material->id);
        $this->command->info('Total soal part 2: ' . count($questions));
    }
}
