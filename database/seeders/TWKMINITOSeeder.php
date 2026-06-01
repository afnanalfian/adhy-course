<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Database\Seeder;

class TWKMINITOSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari atau buat material dengan id 74
        $material = QuestionMaterial::firstOrCreate(
            ['id' => 74]
        );

        $questions = [
            // Soal 1
            [
                'question_text' => 'Pancasila sebagai dasar negara memiliki lima sila yang masing-masing memiliki kedudukan yang sangat penting dalam kehidupan berbangsa dan bernegara. Salah satu sila yang menekankan pada pengakuan terhadap keadilan sosial bagi seluruh rakyat Indonesia yaitu sila kedua. Dalam pelaksanaannya, prinsip keadilan sosial tersebut diwujudkan dalam kebijakan yang ....',
                'explanation' => '<p><strong>Pembahasan:</strong> Pancasila sila kelima (bukan kedua) menekankan pentingnya keadilan sosial. Kebijakan yang sesuai dengan nilai keadilan sosial adalah yang mendukung pemerataan pembangunan di berbagai wilayah Indonesia.</p>
                <p><strong>Kunci Jawaban: A. Menjamin pemerataan pembangunan di seluruh wilayah Indonesia</strong></p>',
                'options' => [
                    ['text' => 'Menjamin pemerataan pembangunan di seluruh wilayah Indonesia', 'correct' => true],
                    ['text' => 'Mempertahankan kedaulatan negara dengan segala cara', 'correct' => false],
                    ['text' => 'Menegakkan hak asasi manusia secara mutlak', 'correct' => false],
                    ['text' => 'Menjaga hubungan internasional yang harmonis dengan negara lain', 'correct' => false],
                    ['text' => 'Menciptakan sistem ekonomi yang berfokus pada kekayaan alam semata', 'correct' => false],
                ]
            ],
            // Soal 2
            [
                'question_text' => 'Anita merupakan karyawan baru di suatu perusahaan yang bertugas menjaga benang agar tidak kusut. Pada hari pertamanya, dia telah melakukan kesalahan karena benang pada bagian mesin yang dijaganya malah putus. Sementara, Desi merupakan karyawan lama yang sudah mahir dalam menjaga mesin benang. Dari cerita di atas, perilaku yang harus dilakukan Desi terhadap Anita adalah .....',
                'explanation' => '<p><strong>Pembahasan:</strong> Sebagai karyawan yang sudah berpengalaman, Desi sebaiknya membantu Anita yang masih baru, terutama jika Anita melakukan kesalahan yang berhubungan dengan pekerjaannya. Membantu Anita memahami prosedur kerja mesin benang yang benar akan mencegah kesalahan serupa terjadi di masa depan dan juga menciptakan lingkungan kerja yang saling mendukung dan produktif.</p>
                <p><strong>Kunci Jawaban: E. membantunya untuk memahami prosedur kerja mesin</strong></p>',
                'options' => [
                    ['text' => 'membiarkannya karena bukan menjadi urusan Desi', 'correct' => false],
                    ['text' => 'memberi tahu kepada Anita agar disiplin saat bekerja', 'correct' => false],
                    ['text' => 'melaporkan kepada atasan karena melakukan kesalahan', 'correct' => false],
                    ['text' => 'menegurnya agar tidak melakukan kesalahan yang sama', 'correct' => false],
                    ['text' => 'membantunya untuk memahami prosedur kerja mesin', 'correct' => true],
                ]
            ],
            // Soal 3
            [
                'question_text' => 'Keragaman agama di Indonesia sering mudah diprovokasi sehingga mempunyai potensi konflik antarpemeluk agama. Upaya yang paling tepat yang dapat dilakukan untuk menjaga keragaman agama dalam ikatan persatuan dan kesatuan bangsa adalah',
                'explanation' => '<p><strong>Pembahasan:</strong> Kegiatan bersama antara umat dari berbagai agama dapat memperkuat rasa persatuan dan saling pengertian, serta mengurangi potensi konflik. Dengan berkumpul bersama dalam aktivitas positif, umat dari berbagai agama dapat melihat bahwa mereka memiliki tujuan bersama untuk membangun masyarakat yang lebih baik.</p>
                <p><strong>Kunci Jawaban: C. mengadakan kegiatan bersama antara umat berbeda agama</strong></p>',
                'options' => [
                    ['text' => 'memberikan pemahaman kepada orang-orang yang diskriminatif', 'correct' => false],
                    ['text' => 'sesering mungkin mengadakan peribadatan bersama antaragama', 'correct' => false],
                    ['text' => 'mengadakan kegiatan bersama antara umat berbeda agama', 'correct' => true],
                    ['text' => 'selektif dalam memilih teman yang tidak seagama', 'correct' => false],
                    ['text' => 'mengadakan kajian bersama tentang ajaran agama sehingga bisa saling memahami ajarannya', 'correct' => false],
                ]
            ],
            // Soal 4
            [
                'question_text' => 'Masalah Israel-Palestina sampai sekarang masih menjadi persoalan yang mewarnai hubungan antarnegera di dunia. Untuk menyikapi persoalan tersebut, bagaimanakah sebaiknya peran Indonesia?',
                'explanation' => '<p><strong>Pembahasan:</strong> Indonesia sejak lama mendukung perjuangan Palestina dan menyuarakan solusi dua negara sebagai cara untuk menyelesaikan konflik antara Israel dan Palestina. Indonesia mempromosikan perdamaian dan dialog sebagai jalan untuk mengakhiri ketegangan yang telah berlangsung lama.</p>
                <p><strong>Kunci Jawaban: B. Mendukung upaya damai untuk penyelesaian kedua negara tersebut</strong></p>',
                'options' => [
                    ['text' => 'Menyerahkan kepada kedua belah pihak untuk mencari penyelesaiannya sendiri', 'correct' => false],
                    ['text' => 'Mendukung upaya damai untuk penyelesaian kedua negara tersebut', 'correct' => true],
                    ['text' => 'Menyerahkan persoalan kedua negara pada keputusan diplomasi negara besar', 'correct' => false],
                    ['text' => 'Mendorong negara-negara di dunia untuk melibatkan diri dalam konflik tersebut', 'correct' => false],
                    ['text' => 'Mendorong PBB menerapkan sanksi ekonomi kepada kedua negara', 'correct' => false],
                ]
            ],
            // Soal 5
            [
                'question_text' => 'Ketika suatu bencana alam menimpa sebuah perkampungan, para warga sekitar segera turut membantu melakukan evakuasi korban. Di antara korban bencana alam ada yang terluka dan butuh donor darah. Anda terpanggil untuk mendonorkan darah saat itu juga karena sangat dibutuhkan. Nilai nasionalisme yang tercermin dari tindakan Anda tersebut tampak dalam hal.....',
                'explanation' => '<p><strong>Pembahasan:</strong> Tindakan mendonorkan darah dalam situasi bencana menunjukkan rasa kepedulian dan solidaritas terhadap sesama manusia, yang merupakan salah satu nilai kemanusiaan. Ini mencerminkan nasionalisme dalam bentuk aksi nyata untuk membantu sesama tanpa memandang latar belakang agama, suku, atau bangsa.</p>
                <p><strong>Kunci Jawaban: D. menjunjung tinggi nilai-nilai kemanusiaan</strong></p>',
                'options' => [
                    ['text' => 'mengembangkan sikap tenggang rasa', 'correct' => false],
                    ['text' => 'tidak semena-mena terhadap orang lain', 'correct' => false],
                    ['text' => 'gemar melakukan kegiatan kemanusiaan', 'correct' => false],
                    ['text' => 'menjunjung tinggi nilai-nilai kemanusiaan', 'correct' => true],
                    ['text' => 'berani membela kebenaran dan keadilan', 'correct' => false],
                ]
            ],
            // Soal 6
            [
                'question_text' => 'Sumpah pemuda merupakan salah satu tonggak sejarah dari pergerakan kemerdekaan Indonesia dalam menghadapi perang sebelum kemerdekaan. Adapun nilai-nilai yang terkandung dalam peristiwa tersebut adalah sebagai berikut, kecuali',
                'explanation' => '<p><strong>Pembahasan:</strong> Sumpah Pemuda mengandung nilai-nilai seperti cinta tanah air, menghargai perbedaan, dan mengutamakan kepentingan bangsa, namun tidak bertujuan untuk menyamakan semua perbedaan, melainkan untuk menghormati keberagaman yang ada.</p>
                <p><strong>Kunci Jawaban: E. menyamakan semua perbedaan</strong></p>',
                'options' => [
                    ['text' => 'cinta akan bangsa dan tanah air', 'correct' => false],
                    ['text' => 'menerima dan menghargai perbedaan', 'correct' => false],
                    ['text' => 'mengutamakan kepentingan bangsa', 'correct' => false],
                    ['text' => 'semangat gotong royong dan kerja sama', 'correct' => false],
                    ['text' => 'menyamakan semua perbedaan', 'correct' => true],
                ]
            ],
            // Soal 7
            [
                'question_text' => 'Pandemi Covid-19 berdampak kepada semua orang tanpa terkecuali. Berikut ini perilaku yang merupakan perwujudan nilai integritas dalam penerapan Pancasila, yaitu.....',
                'explanation' => '<p><strong>Pembahasan:</strong> Membagikan masker kepada semua orang tanpa membedakan suku adalah tindakan yang mencerminkan nilai integritas dan semangat persatuan sesuai dengan Pancasila.</p>
                <p><strong>Kunci Jawaban: C. membagikan masker kepada semua orang tanpa membedakan suku</strong></p>',
                'options' => [
                    ['text' => 'menyediakan makanan tetangga yang sakit Covid karena seagama', 'correct' => false],
                    ['text' => 'mematuhi protokol kesehatan yang ditetapkan dengan terpaksa', 'correct' => false],
                    ['text' => 'membagikan masker kepada semua orang tanpa membedakan suku', 'correct' => true],
                    ['text' => 'mengadakan hajatan besar-besaran meskipun dilarang', 'correct' => false],
                    ['text' => 'membagikan sembako kepada tetangga yang sesuai saja', 'correct' => false],
                ]
            ],
            // Soal 8
            [
                'question_text' => 'Toleransi antarumat beragama merupakan salah satu sikap yang sejalan dengan pengamalan nilai-nilai Pancasila yang dapat memperkuat persatuan masyarakat dan bangsa. Berikut ini pentingnya menjaga persatuan dalam kehidupan bermasyarakat adalah .....',
                'explanation' => '<p><strong>Pembahasan:</strong> Menjaga persatuan sangat penting untuk mencegah perpecahan dan memastikan kehidupan yang harmonis dalam masyarakat yang beragam.</p>
                <p><strong>Kunci Jawaban: D. tidak terpecahnya dan dapat hidup dengan harmonis</strong></p>',
                'options' => [
                    ['text' => 'terwujudnya keseragaman dalam kehidupan masyarakat', 'correct' => false],
                    ['text' => 'dapat terhindar dari konflik kepentingan antarvarga', 'correct' => false],
                    ['text' => 'terciptanya kehidupan masyarakat yang saling membutuhkan', 'correct' => false],
                    ['text' => 'tidak terpecahnya dan dapat hidup dengan harmonis', 'correct' => true],
                    ['text' => 'terciptanya pluralitas dalam masyarakat', 'correct' => false],
                ]
            ],
            // Soal 9
            [
                'question_text' => 'Pembangunan ekonomi yang berkelanjutan mengutamakan keseimbangan antara pencapaian kesejahteraan ekonomi dan kelestarian lingkungan hidup. Salah satu cara untuk mencapai pembangunan yang berkelanjutan adalah dengan memperhatikan aspek ekologi dalam setiap kebijakan pembangunan. Oleh karena itu, pentingnya penerapan prinsip pembangunan berkelanjutan adalah ....',
                'explanation' => '<p><strong>Pembahasan:</strong> Pembangunan berkelanjutan adalah pembangunan yang memperhatikan keseimbangan antara pemenuhan kebutuhan generasi sekarang dengan pelestarian sumber daya alam untuk generasi yang akan datang, sehingga tidak merusak lingkungan untuk kepentingan jangka panjang.</p>
                <p><strong>Kunci Jawaban: A. Menjaga kelestarian alam agar dapat dimanfaatkan secara maksimal oleh generasi mendatang</strong></p>',
                'options' => [
                    ['text' => 'Menjaga kelestarian alam agar dapat dimanfaatkan secara maksimal oleh generasi mendatang', 'correct' => true],
                    ['text' => 'Meningkatkan produksi dan konsumsi sumber daya alam untuk memenuhi kebutuhan sekarang', 'correct' => false],
                    ['text' => 'Mencapai pertumbuhan ekonomi yang cepat meskipun mengabaikan dampak lingkungan', 'correct' => false],
                    ['text' => 'Menjamin kemajuan industri tanpa memikirkan dampaknya terhadap masyarakat', 'correct' => false],
                    ['text' => 'Mengurangi ketergantungan pada sektor pertanian dalam perekonomian nasional', 'correct' => false],
                ]
            ],
            // Soal 10
            [
                'question_text' => 'Biasanya perantau sangat senang jika bertemu dengan orang yang berasal dari daerah yang sama dengannya. Jika kamu adalah seorang perantau, saat sedang bepergian dengan teman dan bertemu dengan orang yang berasal dari daerah yang sama denganmu, bahasa yang seharusnya digunakan adalah ...',
                'explanation' => '<p><strong>Pembahasan:</strong> Menggunakan bahasa daerah untuk mempererat hubungan dengan sesama perantau, namun tetap menjelaskan kepada teman yang tidak paham agar komunikasi tetap berjalan dengan baik.</p>
                <p><strong>Kunci Jawaban: C. sesekali menggunakan bahasa daerah dan menerjemahkannya kepada teman</strong></p>',
                'options' => [
                    ['text' => 'bahasa daerah asal tanpa menghiraukan teman yang tidak paham', 'correct' => false],
                    ['text' => 'bahasa Indonesia agar tidak malu menggunakan bahasa daerah', 'correct' => false],
                    ['text' => 'sesekali menggunakan bahasa daerah dan menerjemahkannya kepada teman', 'correct' => true],
                    ['text' => 'bahasa Indonesia karena menggunakan bahasa daerah kurang keren', 'correct' => false],
                    ['text' => 'bahasa daerah tempat tinggal sebagai usaha ikut melestarikan bahasa daerah', 'correct' => false],
                ]
            ],
            // Soal 11
            [
                'question_text' => 'Adanya perkembangan teknologi membuat akses informasi semakin mudah. Hal ini dapat berdampak buruk dimana mudahnya ideologi asing masuk ke Indonesia dan menghambat kemajuan bangsa dan negara. Mengapa pengaruh ideologi asing dapat menjadi hambatan terhadap ideologi Pancasila?',
                'explanation' => '<p><strong>Pembahasan:</strong> Pengaruh ideologi asing dapat mempengaruhi cara pandang masyarakat, yang kemudian dapat menggeser nilai-nilai Pancasila dalam kehidupan sehari-hari.</p>
                <p><strong>Kunci Jawaban: C. Karena mempengaruhi cara pandang masyarakat</strong></p>',
                'options' => [
                    ['text' => 'Karena memperkuat nilai-nilai Pancasila', 'correct' => false],
                    ['text' => 'Karena meningkatkan ketidakharmonisan dalam masyarakat', 'correct' => false],
                    ['text' => 'Karena mempengaruhi cara pandang masyarakat', 'correct' => true],
                    ['text' => 'Karena memicu ketegangan dan konflik sosial', 'correct' => false],
                    ['text' => 'Karena membuat Pancasila tidak relevan', 'correct' => false],
                ]
            ],
            // Soal 12
            [
                'question_text' => '(1) Tidak menganggap peribadatan orang lain<br>
(2) Mempelajari lagu dan tarian daerah lain<br>
(3) Menghormati berbagai pendapat orang lain<br>
(4) Berpartisipasi dalam pentas seni daerah lain<br><br>
Perilaku yang sesuai terhadap keberagaman budaya di Indonesia ditunjukkan pada pernyataan nomor ....',
                'explanation' => '<p><strong>Pembahasan:</strong> Pernyataan (1) dan (3) mencerminkan sikap toleransi dan penghargaan terhadap keberagaman agama dan pendapat orang lain, yang sangat penting dalam menjaga kerukunan dalam masyarakat yang multikultural seperti Indonesia.</p>
                <p><strong>Kunci Jawaban: B. (1) dan (3)</strong></p>',
                'options' => [
                    ['text' => '(1) dan (2)', 'correct' => false],
                    ['text' => '(1) dan (3)', 'correct' => true],
                    ['text' => '(2) dan (4)', 'correct' => false],
                    ['text' => '(2) dan (3)', 'correct' => false],
                    ['text' => '(3) dan (4)', 'correct' => false],
                ]
            ],
            // Soal 13
            [
                'question_text' => 'Ancaman terhadap keutuhan NKRI tidak hanya bersifat militer, tetapi juga mencakup aspek nonmiliter seperti perubahan iklim. Bagaimana peran pemerintah dalam menghadapi tantangan perubahan iklim sebagai ancaman terhadap keutuhan negara?',
                'explanation' => '<p><strong>Pembahasan:</strong> Pemerintah perlu meningkatkan kerjasama internasional dalam mengurangi emisi karbon karena perubahan iklim adalah masalah global yang memerlukan solusi kolektif antarnegara.</p>
                <p><strong>Kunci Jawaban: C. Dengan meningkatkan kerjasama internasional dalam mengurangi emisi karbon</strong></p>',
                'options' => [
                    ['text' => 'Dengan meningkatkan investasi dalam industri pertahanan', 'correct' => false],
                    ['text' => 'Dengan membuat kebijakan industri ramah lingkungan', 'correct' => false],
                    ['text' => 'Dengan meningkatkan kerjasama internasional dalam mengurangi emisi karbon', 'correct' => true],
                    ['text' => 'Dengan memperketat regulasi terhadap penggunaan lahan', 'correct' => false],
                    ['text' => 'Dengan menggalakkan kampanye penghijauan nasional', 'correct' => false],
                ]
            ],
            // Soal 14
            [
                'question_text' => 'Salah satu hambatan dan tantangan yang dihadapi Indonesia adalah ketidaksetaraan distribusi kekayaan alam di setiap daerah. Hal tersebut dapat berdampak buruk terhadap keutuhan NKRI. Bagaimana dampak dari ketidaksetaraan ini terhadap stabilitas negara?',
                'explanation' => '<p><strong>Pembahasan:</strong> Ketidaksetaraan distribusi kekayaan alam dapat memperburuk ketidakpuasan politik dan ekonomi di daerah-daerah yang merasa kurang mendapatkan manfaat dari kekayaan alam mereka.</p>
                <p><strong>Kunci Jawaban: D. Memperburuk ketidakpuasan politik dan ekonomi</strong></p>',
                'options' => [
                    ['text' => 'Meningkatkan tingkat kebahagiaan masyarakat', 'correct' => false],
                    ['text' => 'Lunturnya nilai-nilai luhur di tengah masyarakat', 'correct' => false],
                    ['text' => 'Mengurangi ketegangan sosial', 'correct' => false],
                    ['text' => 'Memperburuk ketidakpuasan politik dan ekonomi', 'correct' => true],
                    ['text' => 'Memperburuk kerusakan lingkungan dan alam di Indonesia', 'correct' => false],
                ]
            ],
            // Soal 15
            [
                'question_text' => 'Usaha mewujudkan visi pembangunan berkelanjutan harus dibarengi dengan menjaga keseimbangan lingkungan. Selama ini, praktik pembangunan yang lebih mengedepankan dimensi pertumbuhan membawa dampak penurunan daya dukung lingkungan. Komitmen mewujudkan pembangunan berwawasan lingkungan sebagai tanggung jawab bersama dalam mempertahankan NKRI adalah hal yang penting. Tantangan utama dalam mewujudkan pembangunan berwawasan lingkungan adalah terletak pada',
                'explanation' => '<p><strong>Pembahasan:</strong> Tantangan utama dalam pembangunan berwawasan lingkungan adalah kesadaran masyarakat yang masih rendah dalam memelihara dan menjaga lingkungan hidup, meskipun sudah ada kebijakan dan regulasi yang mendukung.</p>
                <p><strong>Kunci Jawaban: A. rendahnya kesadaran pemeliharaan lingkungan</strong></p>',
                'options' => [
                    ['text' => 'rendahnya kesadaran pemeliharaan lingkungan', 'correct' => true],
                    ['text' => 'lemahnya kinerja petugas pengelola lingkungan', 'correct' => false],
                    ['text' => 'minimnya edukasi lingkungan di masyarakat', 'correct' => false],
                    ['text' => 'kurangnya penegakan hukum lingkungan', 'correct' => false],
                    ['text' => 'sikap perusahaan-perusahaan yang tidak peduli lingkungan', 'correct' => false],
                ]
            ],
            // Soal 16
            [
                'question_text' => 'Demokrasi Pancasila yang bersendikan nilai-nilai Pancasila merupakan demokrasi yang mendukung terciptanya kehidupan bersama yang aman dan nyaman serta terciptanya kondisi dinamis dalam perikehidupan berbangsa dan bernegara. Dimana setiap permasalahan yang dihadapi dimusyawarahkan dan keputusan penting diambil melalui pembicaraan bersama sehingga dapat menekan kemungkinan terjadinya konflik dalam masyarakat. Berdasarkan ilustrasi tersebut pentingnya penerapan demokrasi yang berkeadilan sosial adalah dalam rangka ....',
                'explanation' => '<p><strong>Pembahasan:</strong> Penerapan demokrasi yang berkeadilan sosial bertujuan untuk meningkatkan partisipasi masyarakat dalam rangka pencapaian tujuan pembangunan yang adil dan merata bagi seluruh rakyat.</p>
                <p><strong>Kunci Jawaban: C. meningkatkan partisipasi masyarakat dalam rangka pencapaian tujuan pembangunan yang adil dan merata</strong></p>',
                'options' => [
                    ['text' => 'meningkatkan partisipasi masyarakat dalam menyusun kebijakan pemerintah', 'correct' => false],
                    ['text' => 'meningkatkan partisipasi rakyat dalam proses pemilihan umum yang jujur dan adil', 'correct' => false],
                    ['text' => 'meningkatkan partisipasi masyarakat dalam rangka pencapaian tujuan pembangunan yang adil dan merata', 'correct' => true],
                    ['text' => 'Meningkatkan partisipasi rakyat untuk mengedepankan dialog dalam memecahkan masalah bangsa', 'correct' => false],
                    ['text' => 'jaminan pemerintah terhadap kebebasan berserikat, berpendapat dan berkumpul dalam rangka memajukan bangsa', 'correct' => false],
                ]
            ],
            // Soal 17
            [
                'question_text' => 'Perbedaan antara prinsip konstitusionalisme pada masa UUD 45 sebelum dilakukan perubahan dengan sesudah perubahan adalah pada letaknya. Pentingnya prinsip konstitusionalisme sebelum dan sesudah perubahan adalah',
                'explanation' => '<p><strong>Pembahasan:</strong> Sebelum amandemen, UUD 1945 menganggap konstitusi sebagai undang-undang dasar yang lebih tinggi daripada peraturan perundang-undangan lainnya, meskipun setelah amandemen, penekanan pada konstitusi menjadi lebih jelas dalam sistem hukum Indonesia. Kedudukan tertinggi konstitusi tetap menjadi prinsip utama.</p>
                <p><strong>Kunci Jawaban: C. kedudukan tertinggi konstitusi dalam sistem perundang-undangan</strong></p>',
                'options' => [
                    ['text' => 'pembagian kekuasaan eksekutif dan parlemen', 'correct' => false],
                    ['text' => 'pembagian konstitusi menjadi pembukaan dan pasal', 'correct' => false],
                    ['text' => 'kedudukan tertinggi konstitusi dalam sistem perundang-undangan', 'correct' => true],
                    ['text' => 'pembatasan kekuasaan yang lima tahunan dan sesudahnya dapat dipilih kembali', 'correct' => false],
                    ['text' => 'kedudukan penjelasan diganti dengan putusan Mahkamah Konstitusi', 'correct' => false],
                ]
            ],
            // Soal 18
            [
                'question_text' => 'Pelarangan terhadap prostitusi, aborsi, dan minuman keras merupakan implementasi Pancasila sila....',
                'explanation' => '<p><strong>Pembahasan:</strong> Pancasila sila keempat adalah "Kerakyatan yang dipimpin oleh hikmat kebijaksanaan dalam permusyawaratan/perwakilan", yang berkaitan dengan penegakan hukum dan kebijakan yang berorientasi pada kesejahteraan umum, termasuk pelarangan perilaku yang bertentangan dengan moralitas sosial.</p>
                <p><strong>Kunci Jawaban: D. Keempat</strong></p>',
                'options' => [
                    ['text' => 'Pertama', 'correct' => false],
                    ['text' => 'Kedua', 'correct' => false],
                    ['text' => 'Ketiga', 'correct' => false],
                    ['text' => 'Keempat', 'correct' => true],
                    ['text' => 'Kelima', 'correct' => false],
                ]
            ],
            // Soal 19
            [
                'question_text' => 'Kesenjangan pembangunan yang ada di wilayah Negara Kesatuan Republik Indonesia dapat memicu terjadinya gerakan separatisme yang ada di daerah. Berikut ini yang merupakan salah satu usaha untuk menyelesaikan masalah gerakan separatisme yang terjadi di Indonesia sesuai dengan Pancasila khususnya nilai keadilan sosial adalah ....',
                'explanation' => '<p><strong>Pembahasan:</strong> Pemerataan pembangunan dan hasil-hasilnya di seluruh wilayah Indonesia merupakan upaya konkret untuk mewujudkan keadilan sosial dan mencegah timbulnya gerakan separatisme.</p>
                <p><strong>Kunci Jawaban: C. melaksanakan pemerataan pembangunan dan hasil-hasilnya di seluruh wilayah Indonesia</strong></p>',
                'options' => [
                    ['text' => 'menjalankan kekuasaan secara sentralisasi agar tercipta keadilan sosial bagi seluruh rakyat Indonesia', 'correct' => false],
                    ['text' => 'menanamkan cinta tanah air terutama di daerah-daerah rawan gerakan separatisme', 'correct' => false],
                    ['text' => 'melaksanakan pemerataan pembangunan dan hasil-hasilnya di seluruh wilayah Indonesia', 'correct' => true],
                    ['text' => 'mengedepankan dialog dengan kelompok separatis agar memahami bahwa mereka bagian dari NKRI', 'correct' => false],
                    ['text' => 'menumpas segala bentuk gerakan yang ingin melepaskan diri dari Indonesia', 'correct' => false],
                ]
            ],
            // Soal 20
            [
                'question_text' => 'Pemilu sebagai proses pemilihan Presiden dan wakilnya, Anggota DPR dan DPD, menjadi kegiatan yang tak terelakkan di Indonesia beberapa saat yang lalu. Dalam hal ini, mengapa warga negara harus ikut pemilu berdasarkan Pancasila?',
                'explanation' => '<p><strong>Pembahasan:</strong> Partisipasi dalam pemilu adalah perwujudan nilai-nilai demokrasi dan kedaulatan rakyat, yang merupakan inti dari sila keempat Pancasila.</p>
                <p><strong>Kunci Jawaban: E. Untuk mewujudkan nilai-nilai demokrasi dan kedaulatan rakyat</strong></p>',
                'options' => [
                    ['text' => 'Untuk meningkatkan partisipasi politik di masyarakat', 'correct' => false],
                    ['text' => 'Untuk menghindari ketidakpuasan terhadap hasil pemilu', 'correct' => false],
                    ['text' => 'Untuk memenuhi kewajiban konstitusional sebagai warga negara', 'correct' => false],
                    ['text' => 'Untuk mewujudkan nilai-nilai demokrasi dan kedaulatan rakyat', 'correct' => true],
                ]
            ],
            // Soal 21
            [
                'question_text' => 'Undang-Undang Dasar Negara Republik Indonesia (UUD NRI) Tahun 1945 dalam sistem hukum Indonesia merupakan peraturan hukum positif yang tertinggi yang mengandung konsekuensi bahwa....',
                'explanation' => '<p><strong>Pembahasan:</strong> UUD 1945 merupakan hukum dasar tertinggi dalam sistem hukum Indonesia, yang berarti seluruh peraturan perundang-undangan yang lebih rendah harus sesuai dengan prinsip-prinsip yang terkandung dalam UUD 1945.</p>
                <p><strong>Kunci Jawaban: A. peraturan perundang-undangan di bawahnya tidak boleh bertentangan dengan UUD NRI Tahun 1945</strong></p>',
                'options' => [
                    ['text' => 'peraturan perundang-undangan di bawahnya tidak boleh bertentangan dengan UUD NRI Tahun 1945', 'correct' => true],
                    ['text' => 'peraturan perundang-undangan lainnya harus diuji kesesuaiannya dengan Undang-Undang', 'correct' => false],
                    ['text' => 'UUD NRI Tahun 1945 merupakan alat kontrol terhadap norma-norma hukum positif lainnya yang lebih rendah', 'correct' => false],
                    ['text' => 'mencerminkan aspirasi keinginan dari warga negara yang menjadi salah satu isi yang diatur dalam UUD NRI Tahun 1945', 'correct' => false],
                    ['text' => 'memiliki legitimasi pemberlakuan UUD NRI Tahun 1945 yakni pokok kaidah negara yang fundamental', 'correct' => false],
                ]
            ],
            // Soal 22
            [
                'question_text' => 'Dalam kedudukannya sebagai pokok kaidah negara yang fundamental, hubungan Pembukaan UUD NRI Tahun 1945 dengan pasal-pasal dalam batang tubuh UUD NRI Tahun 1945 adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong> Pembukaan UUD 1945 berisi pokok-pokok pikiran yang menjadi dasar dan penjabaran bagi pasal-pasal dalam batang tubuh UUD NRI Tahun 1945.</p>
                <p><strong>Kunci Jawaban: A. pasal-pasal merupakan penjabaran dari pokok pikiran pembukaan</strong></p>',
                'options' => [
                    ['text' => 'pasal-pasal merupakan penjabaran dari pokok pikiran pembukaan', 'correct' => true],
                    ['text' => 'batang tubuh adalah pelaksanaan dari pembukaan', 'correct' => false],
                    ['text' => 'pasal-pasal bersifat lebih luwes daripada pembukaan', 'correct' => false],
                    ['text' => 'pokok-pokok pikiran dijabarkan dalam pembukaan', 'correct' => false],
                    ['text' => 'dalam pasal-pasal terdapat asas kehidupan berbangsa dan bernegara', 'correct' => false],
                ]
            ],
            // Soal 23
            [
                'question_text' => 'Keberadaan Lembaga kepresidenan dalam sistem pemerintah di Indonesia diatur dengan jelas dalam UUD NKRI 1945. Mengapa keberadaan Lembaga itu sangat penting sehingga perlu diatur dalam konstitusi?',
                'explanation' => '<p><strong>Pembahasan:</strong> Dalam sistem trias politica, diperlukan lembaga yang melaksanakan kekuasaan eksekutif, yaitu Presiden. Keberadaan lembaga kepresidenan diatur dalam konstitusi untuk menjalankan roda pemerintahan.</p>
                <p><strong>Kunci Jawaban: E. Dalam sistem trias politica perlu ada lembaga yang melaksanakan kekuatan eksekutif</strong></p>',
                'options' => [
                    ['text' => 'Pemerintah di Indonesia tidak akan berjalan dengan efektif jika tidak ada presiden', 'correct' => false],
                    ['text' => 'Untuk menyesuaikan dengan demokrasi Pancasila yang dianut oleh Indonesia', 'correct' => false],
                    ['text' => 'Untuk melaksanakan kebijakan perlu ada eksekutor dalam suatu sistem pemerintahan', 'correct' => false],
                    ['text' => 'Indonesia menganut sistem presidensial murni sehingga lembaga kepresidenan harus ada', 'correct' => false],
                    ['text' => 'Dalam sistem trias politica perlu ada lembaga yang melaksanakan kekuatan eksekutif', 'correct' => true],
                ]
            ],
            // Soal 24
            [
                'question_text' => 'Hubungan antarlembaga negara dalam sistem ketatanegaraan Indonesia terkait kekuasaan kehakiman dapat dilihat dari pernyataan',
                'explanation' => '<p><strong>Pembahasan:</strong> Dalam sistem hukum Indonesia, Komisi Yudisial berperan mengusulkan calon Hakim Agung kepada DPR, yang kemudian disetujui oleh DPR dan ditetapkan oleh Presiden.</p>
                <p><strong>Kunci Jawaban: A. calon Hakim Agung diusulkan Komisi Yudisial kepada DPR untuk mendapatkan persetujuan dan selanjutnya ditetapkan oleh Presiden</strong></p>',
                'options' => [
                    ['text' => 'calon Hakim Agung diusulkan Komisi Yudisial kepada DPR untuk mendapatkan persetujuan dan selanjutnya ditetapkan oleh Presiden', 'correct' => true],
                    ['text' => 'calon Hakim Agung diusulkan oleh Presiden kepada DPR untuk diuji kepatutan dan kelayakan melalui uji kompetensi hakim', 'correct' => false],
                    ['text' => 'Presiden dapat menolak usulan calon Hakim Agung yang sudah disetujui oleh DPR melalui uji kepatutan dan kelayakan', 'correct' => false],
                    ['text' => 'calon Hakim Agung diusulkan Komisi Yudisial kepada Presiden untuk mendapatkan persetujuan dan selanjutnya diuji kelayakan oleh DPR', 'correct' => false],
                    ['text' => 'DPR dapat menolak calon Hakim Agung yang diusulkan Presiden dan meminta untuk diganti dengan calon yang lain', 'correct' => false],
                ]
            ],
            // Soal 25
            [
                'question_text' => 'Cermati kalimat berikut!<br>"16 Maret 2020 Fakultas Farmasi UGM juga memberlakukan kuliah dalam jaringan (online) untuk mengantisipasi penyebaran virus."<br><br>Ejaan yang salah dalam kalimat tersebut adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong> Kata "online" dalam kalimat tersebut seharusnya ditulis dengan huruf yang dicetak miring (italic) karena merupakan kata asing yang belum sepenuhnya diserap ke dalam Bahasa Indonesia, sesuai dengan ejaan yang berlaku.</p>
                <p><strong>Kunci Jawaban: D. Online</strong></p>',
                'options' => [
                    ['text' => '16 Maret 2020', 'correct' => false],
                    ['text' => 'Fakultas', 'correct' => false],
                    ['text' => 'Farmasi', 'correct' => false],
                    ['text' => 'Online', 'correct' => true],
                    ['text' => 'virus', 'correct' => false],
                ]
            ],
            // Soal 26
            [
                'question_text' => 'Cermati kalimat berikut!<br>"Kebebasan yang diprogramkan kampus merdeka diharapkan menjadi kenyataan dalam melaksanakan proses pendidikan yang berwawasan dan beretika sehingga kampus bisa melahirkan berbagai karya inovatif yang dapat menyumbang peningkatan dan pengembangan ilmu pengetahuan ke depan."<br><br>Kata bentukan yang salah dalam kalimat tersebut adalah.....',
                'explanation' => '<p><strong>Pembahasan:</strong> "Diprogramkan" adalah bentuk yang tidak tepat karena kata "program" adalah jenis kata benda (nomina) yang tidak dapat diubah ke kata kerja pasif, karena dalam PUEBI/EYD yang dapat diubah menjadi pasif adalah kata kerja aktif.</p>
                <p><strong>Kunci Jawaban: A. Diprogramkan</strong></p>',
                'options' => [
                    ['text' => 'Diprogramkan', 'correct' => true],
                    ['text' => 'Diharapkan', 'correct' => false],
                    ['text' => 'Menjadi', 'correct' => false],
                    ['text' => 'Kenyataan', 'correct' => false],
                    ['text' => 'Menyumbang', 'correct' => false],
                ]
            ],
            // Soal 27
            [
                'question_text' => 'Cermati kutipan cerpen berikut!<br>"Aku mengaku lelah Ayah, aku lelah menjalani apa yang seharusnya menjadi kewajibanmu. Ya.... Menafkahi keluargaku. Kau tahu Ayah, putrimu masih menjadi tanggung jawab kedua orang tuanya sebelum ia menikah. Jika aku tak memiliki hati nurani, mungkin aku akan berontak keras saat hasil kerja kerasku dirampas adikku dan juga istrimu. Karena aku masih memiliki hak untuk dibiayai Ayah. Beruntung Tuhan menguatkan, hingga aku memiliki hati yang luas untuk tetap ikhlas."<br><br>Nilai moral dalam kutipan cerpen tersebut adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong> Nilai moral adalah ajaran tentang baik buruk. Dalam kutipan tersebut, meskipun ada rasa lelah dan beban berat, tokoh utama mengatasi perasaan tersebut dengan ikhlas dan hati yang luas.</p>
                <p><strong>Kunci Jawaban: C. beban berat terasa ringan karena ikhlas</strong></p>',
                'options' => [
                    ['text' => 'keluhan seorang anak yang terbebani hidup', 'correct' => false],
                    ['text' => 'kesedihan yang membawa malapetaka hidup', 'correct' => false],
                    ['text' => 'beban berat terasa ringan karena ikhlas', 'correct' => true],
                    ['text' => 'kematian seorang ayah yang menyedihkan', 'correct' => false],
                    ['text' => 'tanggung jawab beban keluarga anak tertua', 'correct' => false],
                ]
            ],
            // Soal 28
            [
                'question_text' => 'Cermati paragraf berikut!<br>(1) Komisi Pemberantasan Korupsi (KPK) dan Badan Penyelenggara Jaminan Sosial (BPJS) Ketenagakerjaan sepakat untuk mengkaji implementasi sistem jaminan sosial di Indonesia.<br>(2) Kesepakatan tersebut ditandai dengan ditandatanganiya nota kesepahaman antara KPK dan BPJS Ketenagakerjaan.<br>(3) KPK dan BPJS Ketenagakerjaan akan melakukan kajian implementasi jaminan sosial di Indonesia dalam rangka untuk mendukung dan mencapai kesejahteraan masyarakat Indonesia.<br>(4) Selain soal kajian, dalam nota kesepahaman ini, kedua lembaga juga sepakat melakukan pertukaran informasi, sosialisasi, dan edukasi antikorupsi.<br>(5) Menurut Dirut BPJS Ketenagakerjaan, nota kesepahaman ini penting bagi BPJS untuk menguatkan integritas lembaga.<br>(6) Hal ini terjadi karena terdapat dana besar yang dikelola BPJS Ketenagakerjaan.<br>(7) Mencapai Rp370 triliun pada tahun lalu dan tahun ini dana kelolaan ditargetkan Rp443 Triliun.<br><br>Kalimat tidak efektif dalam paragraf tersebut adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong> Kalimat (7) tidak efektif karena diawali dengan penggunaan kata kerja "Mencapai" setelah tanda titik, seharusnya kalimat penjelasan dalam paragraf diawali dengan penggunaan kata hubung atau subjek yang jelas.</p>
                <p><strong>Kunci Jawaban: E. (7)</strong></p>',
                'options' => [
                    ['text' => '(2)', 'correct' => false],
                    ['text' => '(4)', 'correct' => false],
                    ['text' => '(5)', 'correct' => false],
                    ['text' => '(6)', 'correct' => false],
                    ['text' => '(7)', 'correct' => true],
                ]
            ],
            // Soal 29
            [
                'question_text' => 'Cermati paragraf berikut!<br>(1) Penggunaan B20 di Indonesia ini sangat berdampak pada ekonomi dan lingkungan di Indonesia, khususnya pada impor solar.<br>(2) Impor solar Indonesia dapat ditekan sehingga dapat menghemat devisa negara sebesar USD 21 juta per hari atau mencapai USD 5,5 miliar per tahun.<br>(3) Selain itu, penggunaan B20 juga menambah lapangan kerja sebesar 321.446 pekerja on farm dan 2.426 off farm.<br>(4) Penggunaan B20 ini juga mampu mengurangi emisi gas rumah kaca dan peningkatan kualitas lingkungan sebesar 3,84 juta ton Co2e.<br>(5) Akibat penggunaan 20% biodiesel dari minyak kelapa sawit juga meningkatkan permintaan kebutuhan kelapa sawit di dalam negeri sehingga membuat perusahaan meningkatkan produksinya.<br>(6) Akibatnya, ekspor minyak kelapa sawit dapat dialihkan ke dalam negeri untuk diolah.<br><br>Kalimat utama paragraf tersebut terdapat dalam kalimat.....',
                'explanation' => '<p><strong>Pembahasan:</strong> Kalimat utama dalam paragraf ini adalah kalimat pertama, yang menyatakan bahwa penggunaan B20 berdampak pada ekonomi dan lingkungan di Indonesia.</p>
                <p><strong>Kunci Jawaban: A. (1)</strong></p>',
                'options' => [
                    ['text' => '(1)', 'correct' => true],
                    ['text' => '(2)', 'correct' => false],
                    ['text' => '(3)', 'correct' => false],
                    ['text' => '(4)', 'correct' => false],
                    ['text' => '(5)', 'correct' => false],
                ]
            ],
            // Soal 30
            [
                'question_text' => 'Cermati paragraf berikut!<br>(1) Kebudayaan adalah situs perjuangan (situs kontestasi).<br>(2) Dalam konteks itu, kebudayaan berjalan dalam satu konstruksi dominasi dan hegemoni tertentu.<br>(3) Namun, tidak ada dominasi atau hegemoni yang sempurna.<br>(4) Selalu terdapat resistansi (perlawanan) dalam perjalanan budaya tersebut karena mereka yang terdominasi (dan terhegemoni) akan selalu memberikan perlawanan.<br>(5) Persaingan dimungkinkan karena terjadi perbedaan pengalaman hidup dan perbedaan ideologi.<br><br>Simpulan paragraf tersebut adalah....',
                'explanation' => '<p><strong>Pembahasan:</strong> Paragraf tersebut menyatakan bahwa kebudayaan adalah situs perjuangan atau kontestasi, dan selalu ada perlawanan terhadap dominasi atau hegemoni dalam budaya, sehingga simpulan yang paling tepat adalah kebudayaan bersifat kontestasi.</p>
                <p><strong>Kunci Jawaban: A. kebudayaan bersifat kontestasi</strong></p>',
                'options' => [
                    ['text' => 'kebudayaan bersifat kontestasi', 'correct' => true],
                    ['text' => 'kebudayaan selalu resistans', 'correct' => false],
                    ['text' => 'kebudayaan selalu terdominasi', 'correct' => false],
                    ['text' => 'tidak ada dominasi kebudayaan', 'correct' => false],
                    ['text' => 'dimungkinkan ada persaingan kebudayaan', 'correct' => false],
                ]
            ],
        ];

        // Simpan soal
        foreach ($questions as $index => $questionData) {
            $question = Question::create([
                'material_id' => $material->id,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => $questionData['question_text'],
                'explanation' => $questionData['explanation'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $order = 1;
            foreach ($questionData['options'] as $optionData) {
                $question->options()->create([
                    'option_text' => $optionData['text'],
                    'is_correct' => $optionData['correct'],
                    'order' => $order,
                    'weight' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $order++;
            }
        }

        $this->command->info('Seeder TWK 2 Juni berhasil dibuat!');
        $this->command->info('Material ID: ' . $material->id);
        $this->command->info('Total soal: ' . count($questions));
    }
}
