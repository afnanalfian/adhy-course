<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\QuestionMaterial;
use Illuminate\Database\Seeder;

class TWKIntensif2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cari atau buat material dengan id 58
        $material = QuestionMaterial::firstOrCreate(
            ['id' => 58]
        );

        $questions = [
            // Soal 1
            [
                'question_text' => 'Nasionalisme memiliki peran penting dalam mempersatukan berbagai kelompok masyarakat. Pernyataan berikut ini yang menggambarkan bentuk nasionalisme yang paling mendukung kerukunan sosial adalah ...',
                'explanation' => '<p><strong>Pembahasan:</strong> Nasionalisme yang inklusif memastikan bahwa semua kelompok dalam masyarakat merasa dihargai dan diterima, sehingga meminimalkan potensi konflik dan memperkuat kerukunan sosial. Praktik nasionalisme yang inklusif cenderung mengurangi kemungkinan perpecahan.</p>
                <p><strong>Kunci Jawaban: C</strong></p>',
                'options' => [
                    ['text' => 'Mendorong rasa persatuan dengan mengedepankan kesamaan di antara warga negara.', 'correct' => false],
                    ['text' => 'Menggunakan semangat nasionalisme untuk melindungi kepentingan nasional secara tegas.', 'correct' => false],
                    ['text' => 'Praktik nasionalisme yang inklusif, yang cenderung mengurangi kemungkinan perpecahan.', 'correct' => true],
                    ['text' => 'Meningkatkan kesadaran akan pentingnya identitas nasional di atas identitas lain.', 'correct' => false],
                    ['text' => 'Menjunjung tinggi nilai-nilai nasionalisme dengan menekankan pentingnya loyalitas pada negara.', 'correct' => false],
                ]
            ],
            // Soal 2
            [
                'question_text' => 'Pengamalan nilai-nilai Pancasila dalam kehidupan sehari-hari bertujuan untuk menciptakan kerukunan, menumbuhkan kedisiplinan, serta mengembangkan sikap toleransi dan egaliter di masyarakat Indonesia. Yang mana di bawah ini bukan merupakan dorongan lain untuk menghayati dan mengamalkan Pancasila?',
                'explanation' => '<p><strong>Pembahasan:</strong> Pelaksanaan program-program keagamaan yang mengedepankan nilai-nilai spiritual sebagai panduan hidup bagi masyarakat beragama bukan merupakan dorongan langsung untuk penghayatan dan pengamalan Pancasila. Meskipun program-program keagamaan sangat penting dalam membentuk karakter moral yang baik, fokus utamanya adalah pada ajaran dan nilai-nilai keagamaan spesifik, bukan secara langsung pada nilai-nilai Pancasila.</p>
                <p><strong>Kunci Jawaban: D</strong></p>',
                'options' => [
                    ['text' => 'Integrasi pendidikan Pancasila dalam kurikulum sekolah untuk membentuk karakter siswa yang nasionalis dan cinta tanah air.', 'correct' => false],
                    ['text' => 'Penerbitan literatur dan media tentang Pancasila untuk memperdalam pemahaman masyarakat mengenai nilai-nilai yang terkandung di dalamnya.', 'correct' => false],
                    ['text' => 'Penggunaan platform digital untuk mempromosikan diskusi dan kesadaran akan pentingnya penerapan nilai-nilai Pancasila dalam kehidupan bermasyarakat.', 'correct' => false],
                    ['text' => 'Pelaksanaan program-program keagamaan yang mengedepankan nilai-nilai spiritual sebagai panduan hidup bagi masyarakat beragama.', 'correct' => true],
                    ['text' => 'Penyelenggaraan kegiatan sosial yang mendorong partisipasi aktif warga dalam menegakkan nilai-nilai kebersamaan dan gotong royong.', 'correct' => false],
                ]
            ],
            // Soal 3
            [
                'question_text' => 'Pemahaman yang mendalam tentang hak dan kewajiban sebagai warga negara adalah kunci untuk menjaga keharmonisan dalam masyarakat yang beragam. Pernyataan mana yang paling tepat menggambarkan bagaimana pemahaman ini dapat berkontribusi pada kestabilan nasional?',
                'explanation' => '<p><strong>Pembahasan:</strong> Pemahaman yang mendalam tentang hak dan kewajiban sebagai warga negara seharusnya mencakup penghormatan terhadap keragaman dan kontribusi aktif dalam menjaga ketertiban sosial, yang merupakan dasar kestabilan nasional. Setiap warga negara harus menghormati perbedaan dan berperan aktif dalam menjaga ketertiban.</p>
                <p><strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['text' => 'Memastikan bahwa setiap warga negara menghormati perbedaan dan berperan aktif dalam menjaga ketertiban.', 'correct' => true],
                    ['text' => 'Mendorong setiap individu untuk memprioritaskan kepentingan komunitas lokal sebagai bentuk penghargaan terhadap keberagaman.', 'correct' => false],
                    ['text' => 'Menginspirasi masyarakat untuk lebih menghargai nilai-nilai tradisional sebagai dasar dari kesatuan nasional.', 'correct' => false],
                    ['text' => 'Memperkuat rasa tanggung jawab sosial dengan menekankan pentingnya dukungan terhadap keputusan mayoritas.', 'correct' => false],
                    ['text' => 'Meningkatkan partisipasi warga negara dalam kegiatan sosial yang selaras dengan norma-norma budaya lokal.', 'correct' => false],
                ]
            ],
            // Soal 4
            [
                'question_text' => 'Pancasila sebagai dasar negara menjadi pedoman utama dalam kehidupan berbangsa dan bernegara. Salah satu cara Pancasila mempengaruhi perilaku masyarakat dalam menjaga persatuan adalah ...',
                'explanation' => '<p><strong>Pembahasan:</strong> Pancasila mendorong masyarakat untuk bersikap toleran terhadap perbedaan, karena toleransi merupakan inti dalam menjaga persatuan di masyarakat yang beragam seperti Indonesia. Toleransi memungkinkan individu untuk menerima dan menghormati perbedaan yang ada, sehingga mencegah terjadinya konflik dan memelihara harmoni.</p>
                <p><strong>Kunci Jawaban: B</strong></p>',
                'options' => [
                    ['text' => 'Mendorong masyarakat untuk menjunjung tinggi hak asasi manusia.', 'correct' => false],
                    ['text' => 'Mendorong masyarakat untuk bersikap toleran terhadap perbedaan.', 'correct' => true],
                    ['text' => 'Menjaga keadilan sosial bagi seluruh rakyat Indonesia.', 'correct' => false],
                    ['text' => 'Menginspirasi semangat gotong royong dalam kehidupan sehari-hari.', 'correct' => false],
                    ['text' => 'Mendorong rasa bangga terhadap identitas nasional.', 'correct' => false],
                ]
            ],
            // Soal 5
            [
                'question_text' => 'Dalam peringatan Hari Kemerdekaan 17 Agustus di Ibu Kota Nusantara, seluruh kegiatan diharapkan mencerminkan nilai-nilai Pancasila. Salah satu cara yang paling tepat dalam mengimplementasi Sila Ketiga pada peringatan tersebut adalah ...',
                'explanation' => '<p><strong>Pembahasan:</strong> Sila Ketiga Pancasila, "Persatuan Indonesia," menekankan pentingnya menjaga persatuan di tengah keberagaman yang ada di Indonesia. Dalam konteks peringatan Hari Kemerdekaan, penerapan Sila Ketiga dapat diwujudkan dengan mengutamakan semangat persatuan di tengah keberagaman peserta yang hadir.</p>
                <p><strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['text' => 'Mengutamakan semangat persatuan di tengah keberagaman peserta yang hadir.', 'correct' => true],
                    ['text' => 'Memastikan seluruh kegiatan mencerminkan kebersamaan dan keadilan bagi semua peserta.', 'correct' => false],
                    ['text' => 'Menonjolkan budaya lokal melalui simbol-simbol yang digunakan selama upacara.', 'correct' => false],
                    ['text' => 'Mendorong kerja sama dan gotong royong dalam persiapan serta pelaksanaan acara.', 'correct' => false],
                    ['text' => 'Memperkuat rasa bangga terhadap keindahan budaya lokal yang ditampilkan dalam setiap acara.', 'correct' => false],
                ]
            ],
            // Soal 6
            [
                'question_text' => 'Setelah mempelajari nilai-nilai Pancasila, UUD 1945, NKRI, dan Bhinneka Tunggal Ika, seorang siswa merasa bangga menjadi bagian dari bangsa Indonesia. Apa pengaruh utama dari pengajaran nilai-nilai tersebut terhadap siswa?',
                'explanation' => '<p><strong>Pembahasan:</strong> Pengajaran nilai-nilai Pancasila, UUD 1945, NKRI, dan Bhinneka Tunggal Ika bertujuan untuk membentuk identitas nasional yang kuat dan menanamkan rasa bangga sebagai bagian dari bangsa Indonesia. Pengaruh utamanya adalah mengokohkan rasa bangga dan cinta siswa terhadap identitas nasional Indonesia.</p>
                <p><strong>Kunci Jawaban: C</strong></p>',
                'options' => [
                    ['text' => 'Meningkatkan pengetahuan siswa tentang pentingnya hidup rukun di masyarakat.', 'correct' => false],
                    ['text' => 'Menumbuhkan rasa tanggung jawab siswa untuk berkontribusi dalam pembangunan nasional.', 'correct' => false],
                    ['text' => 'Mengokohkan rasa bangga dan cinta siswa terhadap identitas nasional Indonesia.', 'correct' => true],
                    ['text' => 'Meningkatkan partisipasi siswa dalam kegiatan sosial dan kebangsaan.', 'correct' => false],
                    ['text' => 'Memperkuat penghormatan siswa terhadap simbol-simbol negara.', 'correct' => false],
                ]
            ],
            // Soal 7
            [
                'question_text' => 'Gotong royong adalah nilai budaya Indonesia yang menekankan pentingnya saling membantu dan bekerja sama dalam kehidupan sehari-hari. Mengapa penting bagi masyarakat Indonesia untuk memahami dan menerapkan nilai gotong royong dalam kehidupan sehari-hari?',
                'explanation' => '<p><strong>Pembahasan:</strong> Memahami dan menerapkan nilai gotong royong sangat penting karena membantu mewujudkan keadilan sosial yang inklusif dan merata bagi seluruh rakyat. Gotong royong mencerminkan semangat kebersamaan dan saling membantu, yang esensial dalam menciptakan lingkungan di mana semua orang mendapatkan kesempatan yang sama dan diperlakukan dengan adil.</p>
                <p><strong>Kunci Jawaban: E</strong></p>',
                'options' => [
                    ['text' => 'Untuk menjaga integritas dan kesatuan wilayah Indonesia.', 'correct' => false],
                    ['text' => 'Untuk mencapai kesejahteraan ekonomi yang berkelanjutan.', 'correct' => false],
                    ['text' => 'Untuk mempertahankan stabilitas dan kedaulatan negara.', 'correct' => false],
                    ['text' => 'Untuk memperkuat ikatan sosial dan harmoni antar kelompok etnis dan agama.', 'correct' => false],
                    ['text' => 'Untuk mewujudkan keadilan sosial yang inklusif dan merata bagi seluruh rakyat.', 'correct' => true],
                ]
            ],
            // Soal 8
            [
                'question_text' => 'Indonesia adalah negara kesatuan yang berdaulat dengan wilayah yang membentang dari Sabang hingga Merauke, diproklamasikan pada 17 Agustus 1945. Sebagai negara besar dengan keberagaman suku, ras, sosial, dan budaya, Indonesia harus menjaga persatuan dan kesatuan nasional. Pancasila adalah ideologi dan sarana pemersatu bangsa karena ...',
                'explanation' => '<p><strong>Pembahasan:</strong> Pancasila berfungsi sebagai pemersatu karena menjadi simbol konsensus nasional yang mengakomodasi keragaman dan menyatukan visi kebangsaan. Pancasila mampu menyatukan berbagai elemen masyarakat di Indonesia dengan keragaman yang ada.</p>
                <p><strong>Kunci Jawaban: E</strong></p>',
                'options' => [
                    ['text' => 'Ditetapkan oleh para pendiri bangsa yang mengutamakan kepentingan kolektif di atas kepentingan pribadi dan golongan.', 'correct' => false],
                    ['text' => 'Mampu beradaptasi dengan perubahan zaman dan dinamika sosial di era modern.', 'correct' => false],
                    ['text' => 'Disepakati sebagai dasar negara melalui proses deliberatif yang melibatkan berbagai kelompok masyarakat.', 'correct' => false],
                    ['text' => 'Digali oleh Bung Karno berdasarkan refleksi mendalam terhadap sejarah dan budaya bangsa Indonesia.', 'correct' => false],
                    ['text' => 'Menjadi simbol konsensus nasional yang mengakomodasi keragaman dan menyatukan visi kebangsaan.', 'correct' => true],
                ]
            ],
            // Soal 9
            [
                'question_text' => 'Pasal 27 ayat 3 UUD 1945 menyatakan bahwa setiap warga negara Indonesia wajib ikut serta dalam pembelaan negara. Dalam konteks sosial dan budaya, strategi apa yang paling efektif untuk memperkuat identitas nasional?',
                'explanation' => '<p><strong>Pembahasan:</strong> Pendidikan adalah cara paling efektif untuk membentuk identitas nasional yang kuat secara berkelanjutan. Menerapkan pendidikan nasional yang menggabungkan nilai budaya lokal dan nasional akan membentuk identitas nasional yang kokoh dan berkelanjutan.</p>
                <p><strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['text' => 'Menerapkan pendidikan nasional yang menggabungkan nilai budaya lokal dan nasional.', 'correct' => true],
                    ['text' => 'Menyelenggarakan festival kebudayaan yang memperkuat persatuan di tengah keragaman.', 'correct' => false],
                    ['text' => 'Mendorong pemuda untuk terlibat dalam proyek sosial yang relevan dengan isu nasional.', 'correct' => false],
                    ['text' => 'Melaksanakan konservasi budaya lokal dengan dukungan pemerintah.', 'correct' => false],
                    ['text' => 'Membangun program pertukaran pelajar yang mempromosikan kolaborasi lintas daerah.', 'correct' => false],
                ]
            ],
            // Soal 10
            [
                'question_text' => 'Indonesia, sebagai negara yang terdiri dari berbagai macam agama, mengakui pentingnya peranan agama dalam kehidupan berbangsa. Berdasarkan Pasal 29 ayat (1) Undang-Undang Dasar, bagaimana seharusnya negara mengelola keragaman keagamaan ini untuk memastikan bahwa setiap agama dapat memberikan kontribusi positif bagi masyarakat?',
                'explanation' => '<p><strong>Pembahasan:</strong> Berdasarkan Pasal 29 ayat (1) UUD 1945 yang menyatakan bahwa negara berdasar atas Ketuhanan Yang Maha Esa, negara harus mengelola keragaman keagamaan dengan mengintegrasikan prinsip Ketuhanan Yang Maha Esa dalam setiap kebijakan negara, memastikan bahwa kebijakan tersebut mencerminkan nilai-nilai moral dan etika yang dipegang oleh berbagai agama.</p>
                <p><strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['text' => 'Mengintegrasikan prinsip Ketuhanan Yang Maha Esa dalam setiap kebijakan negara, memastikan bahwa kebijakan tersebut mencerminkan nilai-nilai moral dan etika yang dipegang oleh berbagai agama.', 'correct' => true],
                    ['text' => 'Menyediakan platform nasional untuk dialog lintas agama, memfasilitasi kerjasama antar pemeluk agama dalam membangun toleransi dan saling pengertian.', 'correct' => false],
                    ['text' => 'Menjamin perlindungan hukum yang setara bagi semua penganut agama untuk beribadah sesuai keyakinan mereka.', 'correct' => false],
                    ['text' => 'Memfasilitasi pendidikan agama yang inklusif dan merata di seluruh lapisan masyarakat.', 'correct' => false],
                    ['text' => 'Mengimplementasikan program-program pembangunan masyarakat yang melibatkan berbagai komunitas agama.', 'correct' => false],
                ]
            ],
            // Soal 11
            [
                'question_text' => 'Dalam konteks keberagaman agama di Indonesia, Pasal 29 ayat (2) UUD 1945 menjamin kebebasan beragama untuk semua warga negara. Implementasi dari pasal ini memiliki potensi besar untuk mempengaruhi keharmonisan sosial di Indonesia. Apa tantangan utama yang mungkin dihadapi dalam penerapan pasal ini?',
                'explanation' => '<p><strong>Pembahasan:</strong> Perbedaan mendasar dalam interpretasi praktik keagamaan yang sah sering kali menjadi hambatan utama, yang bisa menimbulkan ketegangan antar kelompok agama dan memerlukan mediasi yang sensitif untuk menyelesaikannya.</p>
                <p><strong>Kunci Jawaban: C</strong></p>',
                'options' => [
                    ['text' => 'Meskipun jaminan kebebasan beragama mendukung toleransi, pengawasan yang longgar dapat menyebabkan penyalahgunaan kebebasan.', 'correct' => false],
                    ['text' => 'Pluralisme yang didorong bisa menjadi masalah jika kebebasan beragama digunakan untuk menghindari tanggung jawab sosial.', 'correct' => false],
                    ['text' => 'Perbedaan mendasar dalam interpretasi praktik keagamaan yang sah sering menjadi hambatan utama.', 'correct' => true],
                    ['text' => 'Kebebasan beragama memungkinkan ekspresi identitas yang beragam, namun tanpa dialog antaragama bisa memperkuat stereotip negatif.', 'correct' => false],
                    ['text' => 'Implementasi bisa terhambat oleh persepsi dan resistensi dari kelompok mayoritas.', 'correct' => false],
                ]
            ],
            // Soal 12
            [
                'question_text' => 'Identitas nasional yang terlalu kuat dapat memicu nasionalisme berlebihan dan diskriminasi terhadap kelompok minoritas. Identitas yang berlebihan juga bisa menghambat pengakuan identitas lokal atau regional. Pemerintah harus memastikan identitas nasional dibentuk dengan seimbang dan inklusif. Apa yang dapat dilakukan pemerintah melalui pendidikan?',
                'explanation' => '<p><strong>Pembahasan:</strong> Dengan mengajarkan sejarah nasional dari berbagai sudut pandang, pendidikan dapat memastikan bahwa semua kelompok merasa diakui dan dihargai, sehingga mengurangi potensi nasionalisme berlebihan dan diskriminasi.</p>
                <p><strong>Kunci Jawaban: C</strong></p>',
                'options' => [
                    ['text' => 'Mengakui dan menghargai identitas lokal atau regional secara resmi dalam kurikulum.', 'correct' => false],
                    ['text' => 'Memperkuat budaya lokal dengan memasukkan warisan budaya lokal dalam materi pendidikan.', 'correct' => false],
                    ['text' => 'Mengajarkan sejarah nasional dari berbagai sudut pandang untuk memastikan inklusivitas.', 'correct' => true],
                    ['text' => 'Menciptakan lingkungan pendidikan yang mendukung dialog antar kelompok budaya.', 'correct' => false],
                    ['text' => 'Mendorong partisipasi aktif masyarakat dalam program pendidikan nasional yang inklusif.', 'correct' => false],
                ]
            ],
            // Soal 13
            [
                'question_text' => 'Teknologi digital semakin berkembang pesat dan mempengaruhi hampir setiap aspek kehidupan. Namun, penggunaan teknologi yang tidak bijaksana dapat menimbulkan masalah keamanan dan privasi. Apa yang dapat dilakukan pemerintah untuk memastikan teknologi digunakan dengan bijaksana melalui pendidikan?',
                'explanation' => '<p><strong>Pembahasan:</strong> Dengan memasukkan etika digital secara langsung ke dalam kurikulum, siswa akan mendapatkan pemahaman yang mendalam dan menyeluruh tentang bagaimana menggunakan teknologi dengan bijaksana dan bertanggung jawab.</p>
                <p><strong>Kunci Jawaban: B</strong></p>',
                'options' => [
                    ['text' => 'Mengajarkan pentingnya menjaga privasi data pribadi dalam pelajaran teknologi.', 'correct' => false],
                    ['text' => 'Mengintegrasikan pembelajaran etika digital ke dalam kurikulum pendidikan nasional.', 'correct' => true],
                    ['text' => 'Mendorong diskusi tentang dampak sosial teknologi dalam kelas-kelas sekolah.', 'correct' => false],
                    ['text' => 'Menyediakan program literasi digital yang menekankan penggunaan teknologi secara bijaksana.', 'correct' => false],
                    ['text' => 'Membangun kesadaran akan risiko teknologi melalui kampanye edukasi nasional.', 'correct' => false],
                ]
            ],
            // Soal 14
            [
                'question_text' => 'Kasus intoleransi terhadap kelompok minoritas meningkat di era digital. Baru-baru ini, seorang pengguna media sosial anonim menyebarkan hoax yang merendahkan kelompok minoritas di Indonesia, memicu konflik dan merusak persatuan. Bagaimana cara memilah informasi yang benar dan meningkatkan kesadaran nasionalisme di era digital, kecuali …',
                'explanation' => '<p><strong>Pembahasan:</strong> Menyebarkan berita yang menarik perhatian meskipun belum terverifikasi demi meningkatkan kesadaran publik bukanlah tindakan yang tepat. Hal ini justru dapat menyebarkan hoax yang memicu konflik dan merusak persatuan.</p>
                <p><strong>Kunci Jawaban: C</strong></p>',
                'options' => [
                    ['text' => 'Memastikan sumber informasi sebelum membagikannya di media sosial untuk menghindari penyebaran berita palsu.', 'correct' => false],
                    ['text' => 'Mengkritisi informasi yang diterima dan mencari referensi tambahan untuk memastikan kebenarannya.', 'correct' => false],
                    ['text' => 'Menyebarkan berita yang menarik perhatian meskipun belum terverifikasi demi meningkatkan kesadaran publik.', 'correct' => true],
                    ['text' => 'Mengedukasi diri dan orang lain tentang pentingnya memilah informasi dan dampak negatif hoax.', 'correct' => false],
                    ['text' => 'Meningkatkan kesadaran nasionalisme dengan mempromosikan nilai-nilai kebangsaan dan menghargai keanekaragaman.', 'correct' => false],
                ]
            ],
            // Soal 15
            [
                'question_text' => 'Negara ini memiliki masyarakat yang beragam dalam latar belakang, agama, dan budaya. Bagaimana bentuk nasionalisme yang paling tepat dalam situasi ini?',
                'explanation' => '<p><strong>Pembahasan:</strong> Dalam masyarakat yang beragam, nasionalisme tidak harus seragam; setiap kelompok dapat mengembangkan bentuk nasionalisme yang sesuai dengan identitas dan budaya mereka. Nasionalisme dapat muncul dalam beragam bentuk dan memiliki implikasi yang berbeda-beda pada masing-masing kelompok masyarakat.</p>
                <p><strong>Kunci Jawaban: D</strong></p>',
                'options' => [
                    ['text' => 'Nasionalisme hanya dapat muncul dalam kelompok masyarakat yang homogen dan memiliki latar belakang budaya yang sama.', 'correct' => false],
                    ['text' => 'Nasionalisme dapat tumbuh kuat jika semua kelompok masyarakat mengadopsi nilai-nilai mayoritas.', 'correct' => false],
                    ['text' => 'Nasionalisme bisa menjadi alat pemersatu jika semua kelompok menyamakan tradisi mereka dengan budaya nasional.', 'correct' => false],
                    ['text' => 'Nasionalisme dapat muncul dalam beragam bentuk dan memiliki implikasi yang berbeda-beda pada masing-masing kelompok masyarakat.', 'correct' => true],
                    ['text' => 'Nasionalisme dapat muncul dalam beragam bentuk dan memiliki implikasi yang sama pada semua kelompok masyarakat.', 'correct' => false],
                ]
            ],
            // Soal 16
            [
                'question_text' => 'Dengan berkembangnya teknologi, keamanan siber menjadi semakin penting untuk menjaga keamanan nasional. Ancaman keamanan siber bisa menyerang sistem informasi pemerintah, industri kritis, dan infrastruktur penting lainnya. Bagaimana cara kerja sistem deteksi intrusi dalam sistem pertahanan keamanan siber?',
                'explanation' => '<p><strong>Pembahasan:</strong> Sistem deteksi intrusi (Intrusion Detection System/IDS) bekerja dengan cara memantau lalu lintas jaringan untuk mendeteksi tanda-tanda adanya serangan. Sistem ini mengidentifikasi aktivitas yang mencurigakan atau tidak biasa yang dapat menunjukkan adanya upaya peretasan atau serangan lainnya.</p>
                <p><strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['text' => 'Memantau lalu lintas jaringan untuk mendeteksi adanya serangan', 'correct' => true],
                    ['text' => 'Menyaring semua data yang masuk dan keluar dari jaringan', 'correct' => false],
                    ['text' => 'Melakukan enkripsi pada semua data yang terkirim melalui jaringan', 'correct' => false],
                    ['text' => 'Menjaga keamanan fisik server dan perangkat jaringan', 'correct' => false],
                    ['text' => 'Menghapus semua log aktivitas jaringan secara berkala', 'correct' => false],
                ]
            ],
            // Soal 17
            [
                'question_text' => 'Untuk menjaga keutuhan bangsa, meningkatkan kesadaran masyarakat terhadap bahaya radikalisme, intoleransi, dan ekstremisme perlu dilakukan. Salah satu bentuk tindakan yang tepat adalah dengan melakukan aksi nyata dalam aspek sosial. Bentuk aksi yang tepat dalam lingkup sosial adalah …',
                'explanation' => '<p><strong>Pembahasan:</strong> Memfasilitasi dialog konstruktif antarumat beragama membantu membahas isu-isu sosial yang sensitif, memperkuat toleransi, dan membangun kohesi sosial, yang merupakan dasar untuk menjaga keutuhan bangsa.</p>
                <p><strong>Kunci Jawaban: D</strong></p>',
                'options' => [
                    ['text' => 'Melaksanakan program pelatihan intensif terkait kewaspadaan dan keamanan komunitas.', 'correct' => false],
                    ['text' => 'Merancang program pemberdayaan ekonomi berbasis komunitas untuk mengurangi kesenjangan sosial.', 'correct' => false],
                    ['text' => 'Menggunakan media kampanye visual seperti poster untuk menyampaikan pesan tentang kerukunan.', 'correct' => false],
                    ['text' => 'Memfasilitasi dialog konstruktif antarumat beragama untuk membahas isu-isu sosial yang sensitif.', 'correct' => true],
                    ['text' => 'Membangun kolaborasi strategis antara masyarakat dan aparat keamanan.', 'correct' => false],
                ]
            ],
            // Soal 18
            [
                'question_text' => 'Seorang guru di daerah terpencil, meskipun dengan fasilitas yang terbatas, tetap berusaha memberikan pendidikan yang terbaik kepada murid-muridnya. Tindakan ini menunjukkan bahwa kesejahteraan pada bidang pendidikan dapat ditingkatkan dengan …',
                'explanation' => '<p><strong>Pembahasan:</strong> Tindakan guru di daerah terpencil yang tetap berusaha memberikan pendidikan terbaik meskipun dengan fasilitas yang terbatas adalah bukti nyata dari dedikasi dan pengabdiannya. Dedikasi ini menunjukkan bahwa kesejahteraan pendidikan tidak hanya bergantung pada fasilitas, tetapi juga pada komitmen guru untuk mendidik dengan sepenuh hati.</p>
                <p><strong>Kunci Jawaban: B</strong></p>',
                'options' => [
                    ['text' => 'Menginspirasi siswa untuk tetap semangat belajar meskipun dalam kondisi yang serba terbatas.', 'correct' => false],
                    ['text' => 'Dedikasi dan pengabdian guru sebagai wujud cinta terhadap bangsa.', 'correct' => true],
                    ['text' => 'Membangkitkan rasa tanggung jawab siswa untuk menghargai pendidikan yang mereka terima.', 'correct' => false],
                    ['text' => 'Mendorong siswa untuk saling membantu dan bekerja sama dalam menghadapi tantangan pendidikan.', 'correct' => false],
                    ['text' => 'Menanamkan nilai-nilai kegigihan dan dedikasi melalui teladan yang diberikan oleh guru.', 'correct' => false],
                ]
            ],
            // Soal 19
            [
                'question_text' => 'Seorang pengusaha sukses memutuskan untuk membuka peluang kerja di kampung halamannya, memberikan kesempatan bagi para pemuda setempat untuk mengembangkan karir di perusahaannya. Tindakan ini dapat mendorong rasa patriotism dan cinta tanah air karena …',
                'explanation' => '<p><strong>Pembahasan:</strong> Tindakan pengusaha yang membuka peluang kerja di kampung halamannya secara langsung memacu pertumbuhan ekonomi lokal, membantu mengurangi kebutuhan pemuda setempat untuk bermigrasi ke kota-kota besar, dan meningkatkan kesejahteraan ekonomi di daerah asal.</p>
                <p><strong>Kunci Jawaban: D</strong></p>',
                'options' => [
                    ['text' => 'Memajukan sektor industri di daerah yang kekurangan sumber daya.', 'correct' => false],
                    ['text' => 'Meningkatkan keterampilan dan kapasitas profesional pemuda setempat.', 'correct' => false],
                    ['text' => 'Menjadi contoh bagi pengusaha lain untuk berinvestasi di daerah asal mereka.', 'correct' => false],
                    ['text' => 'Mendorong pertumbuhan ekonomi lokal dan mengurangi arus urbanisasi ke kota besar.', 'correct' => true],
                    ['text' => 'Meningkatkan partisipasi warga lokal dalam pembangunan dan pengambilan keputusan komunitas.', 'correct' => false],
                ]
            ],
            // Soal 20
            [
                'question_text' => 'Konflik antara Ukraina dan Rusia yang dimulai pada tahun 2014 dan kembali memanas pada tahun 2022 telah menimbulkan banyak dampak, baik di kawasan tersebut maupun secara global. Dalam konteks wawasan kebangsaan, bagaimana konflik ini dapat mempengaruhi stabilitas politik, ekonomi, dan sosial di kawasan Eropa Timur, dan apa implikasinya bagi Indonesia dalam menjalankan politik luar negeri yang bebas aktif?',
                'explanation' => '<p><strong>Pembahasan:</strong> Konflik ini dapat mengganggu stabilitas politik di Eropa Timur yang bisa memicu ketidakstabilan regional. Bagi Indonesia, hal ini menuntut peningkatan diplomasi untuk menjaga hubungan baik dengan kedua belah pihak tanpa memihak, mencerminkan prinsip politik luar negeri bebas aktif.</p>
                <p><strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['text' => 'Konflik ini dapat mengganggu stabilitas politik di Eropa Timur, yang bisa memicu ketidakstabilan regional dan memperburuk hubungan diplomatik internasional. Bagi Indonesia, hal ini menuntut peningkatan diplomasi untuk menjaga hubungan baik dengan kedua belah pihak tanpa memihak.', 'correct' => true],
                    ['text' => 'Ketegangan ini dapat menyebabkan fluktuasi harga energi global. Indonesia harus mempertimbangkan diversifikasi sumber energi.', 'correct' => false],
                    ['text' => 'Konflik ini berpotensi meningkatkan pengungsian massal. Indonesia perlu memperkuat kerjasama internasional dalam menghadapi isu pengungsi.', 'correct' => false],
                    ['text' => 'Perang ini bisa mendorong peningkatan anggaran militer di Eropa Timur. Bagi Indonesia, ini adalah momen untuk mengevaluasi postur pertahanan nasional.', 'correct' => false],
                    ['text' => 'Konflik ini memunculkan tantangan terhadap kedaulatan nasional, yang merupakan pelajaran penting bagi Indonesia.', 'correct' => false],
                ]
            ],
            // Soal 21
            [
                'question_text' => 'Seorang karyawan bernama Budi memiliki etos kerja yang tinggi. Ia selalu bekerja dengan giat dan tekun, bahkan di luar jam kerja. Budi juga selalu berusaha untuk meningkatkan keterampilan dan kemampuannya. Selain itu, Budi selalu jujur dan bertanggung jawab dalam setiap tugas yang diberikan kepadanya. Berdasarkan narasi tersebut, sikap Budi menunjukkan bahwa ia memiliki kualitas apa yang paling mendasar dan berpengaruh dalam menciptakan integritas tinggi di tempat kerja?',
                'explanation' => '<p><strong>Pembahasan:</strong> Kemampuan untuk bekerja keras dengan tetap menjaga integritas, menunjukkan bahwa dedikasi dan kejujuran dapat berjalan beriringan. Ini adalah kualitas paling mendasar dalam menciptakan integritas tinggi di tempat kerja.</p>
                <p><strong>Kunci Jawaban: E</strong></p>',
                'options' => [
                    ['text' => 'Disiplin dalam mengatur waktu dan tugas sehingga mampu mengoptimalkan kinerjanya secara konsisten dan efektif.', 'correct' => false],
                    ['text' => 'Keuletan dalam menghadapi tantangan dan masalah di tempat kerja.', 'correct' => false],
                    ['text' => 'Ketangguhan dalam menanggung beban kerja dan tanggung jawab.', 'correct' => false],
                    ['text' => 'Kerja keras yang berkelanjutan dan berfokus, menunjukkan dedikasi tinggi terhadap pekerjaannya.', 'correct' => false],
                    ['text' => 'Kemampuan untuk bekerja keras dengan tetap menjaga integritas, menunjukkan bahwa dedikasi dan kejujuran dapat berjalan beriringan.', 'correct' => true],
                ]
            ],
            // Soal 22
            [
                'question_text' => 'Pangeran Diponegoro adalah pahlawan nasional yang dikenal karena keberaniannya melawan penjajahan Belanda. Bagaimana semangat bela negara yang ditunjukkan oleh Pangeran Diponegoro dapat diadaptasi dalam menghadapi tantangan modern terhadap kedaulatan dan keadilan di Indonesia?',
                'explanation' => '<p><strong>Pembahasan:</strong> Semangat Pangeran Diponegoro dalam melawan penjajahan dapat diadaptasi di era modern melalui upaya untuk memberantas korupsi, yang merupakan ancaman serius terhadap kedaulatan dan keadilan di Indonesia. Dengan menggalang dukungan rakyat untuk melawan korupsi, kita dapat memperkuat fondasi negara.</p>
                <p><strong>Kunci Jawaban: B</strong></p>',
                'options' => [
                    ['text' => 'Memanfaatkan teknologi digital untuk memperkuat kesadaran nasional dan memperjuangkan keadilan di ranah publik.', 'correct' => false],
                    ['text' => 'Menggalang dukungan rakyat untuk memberantas praktik korupsi yang merusak fondasi negara.', 'correct' => true],
                    ['text' => 'Menginisiasi diplomasi aktif untuk memperkuat pengaruh Indonesia di tingkat internasional.', 'correct' => false],
                    ['text' => 'Mendorong revitalisasi ekonomi dengan fokus pada kemandirian dan keberlanjutan sumber daya lokal.', 'correct' => false],
                    ['text' => 'Menginspirasi generasi muda untuk terlibat aktif dalam proses demokrasi guna memastikan tegaknya kedaulatan rakyat.', 'correct' => false],
                ]
            ],
            // Soal 23
            [
                'question_text' => 'Seorang karyawan yang biasanya menyelesaikan pekerjaannya tepat waktu dengan kualitas tinggi mengalami masalah pribadi yang mengganggu fokus dan kinerjanya. Apa yang seharusnya dilakukan karyawan tersebut untuk mempertahankan komitmen dan integritasnya di tempat kerja?',
                'explanation' => '<p><strong>Pembahasan:</strong> Dengan mengajukan cuti atau izin, karyawan tersebut dapat menyelesaikan masalah pribadinya terlebih dahulu tanpa mengorbankan kualitas pekerjaannya. Langkah ini menunjukkan tanggung jawab dan komitmen karyawan terhadap pekerjaan dan timnya.</p>
                <p><strong>Kunci Jawaban: D</strong></p>',
                'options' => [
                    ['text' => 'Menyelesaikan pekerjaannya setelah menyelesaikan masalah pribadinya, tanpa memberi tahu rekan kerja tentang situasinya.', 'correct' => false],
                    ['text' => 'Menunda pekerjaannya dan membiarkan rekan kerja menangani tugasnya hingga dia bisa kembali fokus.', 'correct' => false],
                    ['text' => 'Menyelesaikan pekerjaannya meskipun dengan kualitas rendah karena kurang fokus.', 'correct' => false],
                    ['text' => 'Mengajukan cuti atau izin untuk menangani masalah pribadinya sehingga bisa kembali bekerja dengan fokus penuh.', 'correct' => true],
                    ['text' => 'Meminta bantuan rekan kerja untuk memastikan pekerjaannya memenuhi standar kualitas yang diharapkan.', 'correct' => false],
                ]
            ],
            // Soal 24
            [
                'question_text' => 'Pada tahun 1911, Haji Samanhudi mendirikan Sarekat Dagang Islam di Solo sebagai salah satu pergerakan untuk mencapai kemerdekaan Indonesia. Gerakan ini berusaha memperkuat dan mempersatukan bangsa dengan fokus pada penguatan dalam bidang tertentu. Bidang apa yang menjadi fokus utama Sarekat Dagang Islam dalam usahanya membangun kekuatan dan persatuan bangsa?',
                'explanation' => '<p><strong>Pembahasan:</strong> Sarekat Dagang Islam didirikan oleh Haji Samanhudi pada tahun 1911 di Solo sebagai upaya untuk memperkuat dan mempersatukan bangsa Indonesia. Gerakan ini berfokus pada bidang ekonomi dengan tujuan mendukung pengusaha lokal agar mereka dapat bersaing dengan pengusaha non-lokal.</p>
                <p><strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['text' => 'Ekonomi dengan mendukung pengusaha lokal agar mampu bersaing dengan pengusaha non-lokal dan memperkuat ketahanan ekonomi nasional.', 'correct' => true],
                    ['text' => 'Kebudayaan dengan mempromosikan kesenian daerah untuk memperkuat identitas nasional.', 'correct' => false],
                    ['text' => 'Pendidikan dengan menyebarkan ilmu pengetahuan untuk membentuk kesadaran nasional.', 'correct' => false],
                    ['text' => 'Keagamaan dengan menggerakkan masyarakat berdasarkan nilai-nilai spiritual untuk memperkuat moralitas.', 'correct' => false],
                    ['text' => 'Politik dengan mengadvokasi kebijakan yang melindungi kepentingan masyarakat lokal dari dominasi pihak asing.', 'correct' => false],
                ]
            ],
            // Soal 25
            [
                'question_text' => 'Kesadaran berbangsa dan bernegara adalah nilai dasar dari bela negara. Mana di antara pilihan berikut ini yang paling tepat mencerminkan sikap sadar berbangsa dan bernegara dalam konteks aktif mengabdi dan mempertahankan integritas bangsa dan negara?',
                'explanation' => '<p><strong>Pembahasan:</strong> Aktif berpartisipasi dalam program pemerintah dan inisiatif lokal yang bertujuan untuk menguatkan pertahanan dan keamanan nasional secara langsung menekankan pada kesadaran berbangsa dan bernegara dengan cara yang operasional dan praktis.</p>
                <p><strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['text' => 'Aktif berpartisipasi dalam program pemerintah dan inisiatif lokal yang bertujuan untuk menguatkan pertahanan dan keamanan nasional.', 'correct' => true],
                    ['text' => 'Menjaga kesehatan fisik dan mental sebagai persiapan diri untuk dapat berkontribusi pada kebutuhan pertahanan negara.', 'correct' => false],
                    ['text' => 'Menyuarakan dan memperjuangkan kebijakan yang mendukung kestabilan politik dan keamanan di wilayah Indonesia.', 'correct' => false],
                    ['text' => 'Memperdalam pemahaman dan menghargai sejarah serta kontribusi pahlawan nasional.', 'correct' => false],
                    ['text' => 'Menanamkan nilai-nilai patriotisme dan nasionalisme kepada generasi muda melalui pendidikan dan kegiatan sosial.', 'correct' => false],
                ]
            ],
            // Soal 26
            [
                'question_text' => 'Sebuah sekolah menengah atas telah mengintegrasikan konsep-konsep bela negara ke dalam kurikulumnya untuk meningkatkan kesadaran bela negara di kalangan pelajar. Program ini menggabungkan pembelajaran teori tentang sejarah dan kebudayaan Indonesia, kegiatan ekstrakurikuler yang fokus pada keterampilan kepemimpinan dan ketahanan fisik, serta diskusi terbuka tentang isu-isu nasional terkini. Bagaimana sekolah tersebut dapat mengukur efektivitas implementasi program bela negara secara komprehensif dan akurat?',
                'explanation' => '<p><strong>Pembahasan:</strong> Menelusuri dampak jangka panjang program dengan mengamati kontribusi alumni dalam masyarakat dan keterlibatan mereka dalam kegiatan yang mendukung nilai-nilai kebangsaan dan bela negara memberikan gambaran holistik tentang keberhasilan program.</p>
                <p><strong>Kunci Jawaban: E</strong></p>',
                'options' => [
                    ['text' => 'Melakukan survei mendalam kepada siswa dan orang tua untuk mengevaluasi persepsi mereka terhadap manfaat program bela negara.', 'correct' => false],
                    ['text' => 'Mengamati peningkatan partisipasi siswa dalam kegiatan sosial dan organisasi komunitas.', 'correct' => false],
                    ['text' => 'Mengukur peningkatan nilai akademik siswa dalam mata pelajaran terkait sejarah dan kebudayaan Indonesia.', 'correct' => false],
                    ['text' => 'Menganalisis perubahan perilaku siswa melalui data pelanggaran disiplin sebelum dan sesudah penerapan program.', 'correct' => false],
                    ['text' => 'Menelusuri dampak jangka panjang program dengan mengamati kontribusi alumni dalam masyarakat dan keterlibatan mereka dalam kegiatan yang mendukung nilai-nilai kebangsaan dan bela negara.', 'correct' => true],
                ]
            ],
            // Soal 27
            [
                'question_text' => 'Kemampuan awal dalam bela negara sangat penting bagi setiap warga negara agar dapat melaksanakan hak dan kewajibannya. Kemampuan ini harus dikembangkan terus-menerus mulai dari rasa cinta tanah air, kesadaran berbangsa dan bernegara, hingga sikap rela berkorban dan setia pada Pancasila. Kemampuan ini terutama penting untuk ...',
                'explanation' => '<p><strong>Pembahasan:</strong> Kemampuan awal bela negara penting untuk meningkatkan kesiapsiagaan melalui pendidikan dan latihan yang sistematis, yang mencakup aspek fisik, mental, dan strategis untuk menghadapi berbagai ancaman terhadap kedaulatan, keutuhan, dan keberlanjutan hidup bangsa.</p>
                <p><strong>Kunci Jawaban: D</strong></p>',
                'options' => [
                    ['text' => 'Menjaga seluruh bangsa Indonesia dan wilayahnya dari berbagai ancaman, serta memastikan stabilitas nasional.', 'correct' => false],
                    ['text' => 'Memperkuat ketahanan nasional dalam menghadapi berbagai ancaman dengan meningkatkan kesadaran kolektif.', 'correct' => false],
                    ['text' => 'Menumbuhkan komitmen berupa rasa hormat, tanggung jawab, dan kepedulian untuk menjaga kedaulatan wilayah.', 'correct' => false],
                    ['text' => 'Meningkatkan kesiapsiagaan melalui pendidikan dan latihan yang sistematis, mencakup aspek fisik, mental, dan strategis.', 'correct' => true],
                ]
            ],
            // Soal 28
            [
                'question_text' => 'Guru yang berkompeten dan fasilitas yang memadai sangat penting untuk menciptakan lingkungan belajar yang kondusif, sehingga siswa dapat mencapai potensi maksimal mereka dan siap menghadapi tantangan masa depan. Kalimat tersebut akan menjadi lebih baik bila diperbaiki dengan cara …',
                'explanation' => '<p><strong>Pembahasan:</strong> Penulisan konjungsi "sehingga" tidak menggunakan tanda koma dalam aturan penulisan Bahasa Indonesia. Sehingga kalimat akan jadi lebih benar dengan menghilangkan tanda koma sebelum kata "sehingga".</p>
                <p><strong>Kunci Jawaban: A</strong></p>',
                'options' => [
                    ['text' => 'Menghilangkan tanda koma (,) sebelum kata sehingga', 'correct' => true],
                    ['text' => 'Mengganti kata sangat dengan amat', 'correct' => false],
                    ['text' => 'Menambahkan kata adalah sebelum kata penting', 'correct' => false],
                    ['text' => 'Menghilangkan kata kondusif', 'correct' => false],
                    ['text' => 'Mengganti kata mencapai dengan meraih', 'correct' => false],
                ]
            ],
            // Soal 29
            [
                'question_text' => 'Pemerintah terus berupaya meningkatkan pertumbuhan ekonomi dengan berbagai kebijakan strategis. Salah satu langkah utamanya adalah memberikan insentif pajak kepada sektor industri kreatif. Kebijakan ini diharapkan dapat meningkatkan investasi dan menciptakan lapangan kerja baru. Selain itu, pemerintah juga fokus pada pengembangan infrastruktur untuk mendukung kelancaran distribusi barang dan jasa. Dengan langkah-langkah tersebut, pemerintah optimis bahwa ekonomi nasional akan lebih stabil dan berkelanjutan. Simpulan teks tersebut yang paling tepat adalah …',
                'explanation' => '<p><strong>Pembahasan:</strong> Paragraf di atas secara keseluruhan menjelaskan bagaimana berbagai kebijakan pemerintah, termasuk insentif pajak dan pengembangan infrastruktur, diarahkan untuk meningkatkan pertumbuhan ekonomi.</p>
                <p><strong>Kunci Jawaban: C</strong></p>',
                'options' => [
                    ['text' => 'Pemerintah memberikan insentif pajak untuk semua sektor industri.', 'correct' => false],
                    ['text' => 'Infrastruktur yang baik dapat mendukung kelancaran distribusi barang.', 'correct' => false],
                    ['text' => 'Kebijakan pemerintah diarahkan untuk meningkatkan pertumbuhan ekonomi.', 'correct' => true],
                    ['text' => 'Peningkatan investasi dapat menciptakan lapangan kerja baru di sektor industri kreatif.', 'correct' => false],
                    ['text' => 'Stabilitas ekonomi nasional dapat dicapai melalui pengembangan infrastruktur.', 'correct' => false],
                ]
            ],
            // Soal 30
            [
                'question_text' => 'Kelangkaan minyak tanah di berbagai daerah telah menjadi isu utama yang mempengaruhi banyak aspek kehidupan masyarakat. Beberapa penyebab kelangkaan ini adalah distribusi yang tidak merata dan peningkatan permintaan di musim tertentu. Namun, yang paling memprihatinkan adalah adanya praktik penimbunan oleh oknum-oknum yang tidak bertanggung jawab. Akibatnya, harga minyak tanah melonjak dan menyulitkan masyarakat, terutama yang berpenghasilan rendah. Pemerintah telah mengeluarkan kebijakan untuk menindak tegas para penimbun dan memperbaiki sistem distribusi agar masalah ini bisa segera diatasi. Ide pokok paragraf tersebut adalah …',
                'explanation' => '<p><strong>Pembahasan:</strong> Paragraf tersebut menekankan bahwa masalah penimbunan minyak tanah oleh oknum tidak bertanggung jawab adalah masalah yang paling memprihatinkan di antara penyebab kelangkaan lainnya. Gagasan utama ini dinyatakan dengan jelas di tengah paragraf.</p>
                <p><strong>Kunci Jawaban: D</strong></p>',
                'options' => [
                    ['text' => 'Kelangkaan minyak tanah terjadi karena distribusi yang tidak merata dan peningkatan permintaan.', 'correct' => false],
                    ['text' => 'Pemerintah mengeluarkan kebijakan untuk menindak tegas para penimbun minyak tanah.', 'correct' => false],
                    ['text' => 'Harga minyak tanah melonjak dan menyulitkan masyarakat berpenghasilan rendah.', 'correct' => false],
                    ['text' => 'Adanya praktik penimbunan minyak tanah oleh oknum yang tidak bertanggung jawab merupakan masalah yang paling memprihatinkan.', 'correct' => true],
                    ['text' => 'Pemerintah berupaya memperbaiki sistem distribusi minyak tanah.', 'correct' => false],
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

        $this->command->info('Seeder TWK SKD Intensif 2 berhasil dibuat!');
        $this->command->info('Material ID: ' . $material->id);
        $this->command->info('Total soal: ' . count($questions));
    }
}
