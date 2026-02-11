<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BTI3Seeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // --- 1. CEK ATAU BUAT MATERIAL UNTUK BT - BTI 3 (category_id = 6) ---
        $btMaterial = DB::table('question_materials')
            ->where('name', 'BT - BTI 3')
            ->where('category_id', 6)
            ->first();

        if (!$btMaterial) {
            $btMaterialId = DB::table('question_materials')->insertGetId([
                'category_id' => 6,
                'name' => 'BT - BTI 3',
                'slug' => 'bt-bti-3-' . uniqid(),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        } else {
            $btMaterialId = $btMaterial->id;
        }

        // --- 2. CEK ATAU BUAT MATERIAL UNTUK PT - BTI 3 (category_id = 7) ---
        $ptMaterial = DB::table('question_materials')
            ->where('name', 'PT - BTI 3')
            ->where('category_id', 7)
            ->first();

        if (!$ptMaterial) {
            $ptMaterialId = DB::table('question_materials')->insertGetId([
                'category_id' => 7,
                'name' => 'PT - BTI 3',
                'slug' => 'pt-bti-3-' . uniqid(),
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        } else {
            $ptMaterialId = $ptMaterial->id;
        }

        // --- SOAL NOMOR 1-10 (BT - BTI 3) ---
        $btQuestions = [
            // Soal 1
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Indonesia memiliki bahasa daerah yang sangat beragam. Namun demikian, Indonesia dapat dipersatukan dalam Bahasa persatuan yaitu...',
                'explanation' => 'Indonesia memiliki bahasa daerah yang sangat beragam. Oleh karena itu, bahasa pemersatu di Indonesia adalah Bahasa Indonesia.',
                'options' => [
                    ['Bahasa Jawa', 0],
                    ['Bahasa Sunda', 0],
                    ['Bahasa Melayu', 0],
                    ['Bahasa Belanda', 0],
                    ['Bahasa Indonesia', 1],
                ],
            ],
            // Soal 2
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Arti penting sumpah pemuda bagi bangsa Indonesia di antaranya adalah sebagai berikut, kecuali….',
                'explanation' => 'Bergabung dengan penjajah bukanlah arti penting Sumpah Pemuda, melainkan pengkhianatan terhadap bangsa.',
                'options' => [
                    ['Menjadi alat pemersatu para pemuda', 0],
                    ['Bergabung dengan penjajah', 1],
                    ['Menambah semangat untuk mengusir penjajah', 0],
                    ['Menyatakan seluruh pemuda menjadi satu bangsa', 0],
                    ['Meningkatkan semangat juang para pemuda', 0],
                ],
            ],
            // Soal 3
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Banyaknya suku bangsa di Indonesia bukan merupakan sumber perpecahan, melainkan sebagai sumber dari….',
                'explanation' => 'Keberagaman suku bangsa di Indonesia merupakan kekayaan budaya yang menjadi kebanggaan dan identitas bangsa.',
                'options' => [
                    ['Ketekunan bangsa', 0],
                    ['Kekayaan budaya', 1],
                    ['Kelemahan bangsa', 0],
                    ['Kekayaan alam', 0],
                    ['Kebanggaan bangsa', 0],
                ],
            ],
            // Soal 4
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Sumpah pemuda merupakan salah satu pencetus atau tonggak yang membakar persatuan serta semangat golongan-golongan muda dalam mewujudkan kemerdekaan Republik Indonesia. Sumpah pemuda terjadi pada tanggal….',
                'explanation' => 'Sumpah pemuda ditetapkan pada tanggal 28 Oktober 1928. Maka hari sumpah pemuda diperingati setiap tanggal 28 Oktober.',
                'options' => [
                    ['12 Agustus', 0],
                    ['21 April', 0],
                    ['28 Oktober', 1],
                    ['10 November', 0],
                    ['1 Oktober', 0],
                ],
            ],
            // Soal 5
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Setahun belakangan, tidak bisa dipungkiri bahwa kondisi perekonomian nasional dan dunia mengalami kelesuan akibat pandemi Covid 19. Diharapkan perekonomian akan berangsur-angsur membaik seiring dengan terkendalinya penyebaran Virus SarsCov-2 penyebab Covid 19 di masa-masa mendatang. Salah satu upaya kementerian perhubungan dalam meningkatkan perekonomian adalah menyiapkan infrastruktur transportasi laut. Salah satunya yang digenjot adalah Pelabuhan Matul Jailolo, Halmahera Barat, Maluku, yang sejak jauh hari telah disiapkan menjadi salah satu pelabuhan dengan muatan balik tol laut yang tidak pernah sepi muatan. Pembangunan tol laut ini sesuai dengan salah satu karakteristik Negara Indonesia berdasarkan konsep wawasan nusantara, yaitu…..',
                'explanation' => 'Gagasan tentang tol laut dimaksudkan untuk mewujudkan pembangunan nasional. Tol laut bertujuan mengembangkan ekonomi maritim yaitu menjadikan laut sebagai basis konektivitas produksi dan pemasaran antar daerah atau pulau di Indonesia. Salah satu karakteristik negara Indonesia berdasarkan konsep wawasan nusantara adalah laut merupakan penghubung antar pulau.',
                'options' => [
                    ['Laut merupakan wilayah pelengkap', 0],
                    ['Bersatunya wilayah laut dan darat', 0],
                    ['Laut merupakan pemisah antara daratan dan pulau', 0],
                    ['Laut merupakan penghubung antar pulau', 1],
                    ['Negara kepulauan yang merupakan suatu wilayah daratan luas', 0],
                ],
            ],
            // Soal 6
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Integrasi nasional pada hakikatnya adalah sebagai proses penyatuan suatu bangsa yang mencakup semua aspek kehidupannya, yaitu aspek sosial, politik, ekonomi, dan budaya. Berdasarkan hal tersebut integrasi nasional mengandung makna….',
                'explanation' => 'Integrasi nasional bangsa Indonesia berarti hasrat dan kesadaran untuk bersatu sebagai suatu bangsa menjadi satu kesatuan bangsa secara resmi dan direalisasikan dalam satu kesepakatan atau konsensus nasional melalui Sumpah Pemuda pada tanggal 28 Oktober 1928.',
                'options' => [
                    ['Upaya menyatukan suku bangsa, adat dan golongan', 0],
                    ['Penggabungan dua unsur kebudayaan atau lebih', 0],
                    ['Keinginan bersatu sebagai hasrat bangsa yang merdeka', 0],
                    ['Proses mempersatukan keberagaman bangsa Indonesia', 1],
                    ['Adanya kekuatan bangsa berdasarkan perbedaan SARA', 0],
                ],
            ],
            // Soal 7
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Integrasi nasional adalah usaha dan proses mempersatukan perbedaan yang ada pada bangsa Indonesia yang menganut semboyan "Bhinneka Tunggal Ika" yang artinya berbeda-beda tetapi tetap satu jua, sehingga terciptanya keserasian dan keselarasan secara nasional. Agar kebhinekaan itu tidak menimbulkan disintegrasi bangsa maka diperlukan sikap dan perilaku yaitu…',
                'explanation' => 'Menghargai perbedaan sebagai suatu rahmat dari Tuhan YME adalah sikap yang tepat untuk menjaga kebhinekaan agar tidak menimbulkan disintegrasi bangsa.',
                'options' => [
                    ['Membanggakan kebudayaan bangsa Indonesia yang berbeda', 0],
                    ['Menghargai perbedaan sebagai suatu rahmat dari Tuhan YME', 1],
                    ['Mengagungkan bangsa dan negara dan merendahkan bangsa lain', 0],
                    ['Membanggakan suku bangsa yang memiliki keanekaragaman budaya', 0],
                    ['Menghargai kekayaan bangsa Indonesia yang tidak dimiliki bangsa lain', 0],
                ],
            ],
            // Soal 8 (digabung dari dua bagian)
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Dibawah ini merupakan pernyataan yang menunjukkan hubungan antara integrasi nasional dengan pelanggaran hak dan kewajiban…',
                'explanation' => 'Hubungan integrasi dengan pelanggaran hak dan kewajiban yakni pelanggaran hak orang akan menyebabkan terjadinya disintegrasi sehingga orang yang haknya dilanggar berarti tidak akan menjalankan kewajibannya.',
                'options' => [
                    ['Pelanggaran hak akan menyebabkan terjadinya disintegrasi sehingga orang yang haknya dilanggar kemungkinan tidak akan menjalankan haknya', 0],
                    ['Pelanggaran hak menyebabkan terjadinya disintegrasi sehingga orang yang haknya dilanggar kemungkinan tidak akan menjalankan kewajibannya', 0],
                    ['Pelanggaran hak orang akan menyebabkan terjadinya disintegrasi karena orang yang haknya dilanggar berarti tidak akan menjalankan kewajibannya', 1],
                    ['Pelanggaran kewajiban orang akan menyebabkan terjadinya disintegrasi sehingga orang yang kewajibannya dilanggar kemungkinan tidak akan menjalankan haknya', 0],
                    ['Pelanggaran kewajiban orang akan menyebabkan terjadinya disintegrasi sehingga orang yang kewajibannya dilanggar kemungkinan tidak akan menjalankan kewajibannya', 0],
                ],
            ],
            // Soal 9
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Upaya yang dapat dilakukan untuk mencapai integrasi nasional dapat dilakukan dengan cara....',
                'explanation' => 'Upaya untuk mendukung integrasi nasional yaitu dengan saling menghargai, patuh terhadap hukum, toleransi beragama, akulturasi budaya, dll. Menjaga keselarasan antar budaya merupakan salah satu upaya integrasi nasional.',
                'options' => [
                    ['Menjaga keselarasan antar budaya', 1],
                    ['Menjaga keselarasan antar kelompok masyarakat tertentu', 0],
                    ['Menjaga keserasian antara masyarakat dan pemerintah yang berkuasa', 0],
                    ['Menjaga keserasian antar internal budaya dalam kelompok masyarakat tertentu', 0],
                    ['Menjaga keserasian dan keselarasan antar penganut agama dalam kelompok', 0],
                ],
            ],
            // Soal 10
            [
                'material_id' => $btMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Di Indonesia dikenal adanya sistem kekerabatan patrilineal dan matrilineal. Suku yang menganut sistem kekerabatan matrilineal adalah...',
                'explanation' => 'Suku Batak, Rejang, Gayo, dan Bali menganut sistem patrilineal, sedangkan suku Minangkabau menganut sistem matrilineal.',
                'options' => [
                    ['Batak', 0],
                    ['Rejang', 0],
                    ['Gayo', 0],
                    ['Bali', 0],
                    ['Minangkabau', 1],
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

        // --- SOAL NOMOR 11-25 (PT - BTI 3) ---
        $ptQuestions = [
            // Soal 11
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Sikap saling menghargai, toleransi terhadap perbedaan masyarakat dan tidak mengunggulkan kebudayaan masyarakat tertentu memiliki dampak positif bagi kehidupan suatu bangsa yaitu....',
                'explanation' => 'Sikap saling menghargai, toleransi, dan tidak mengunggulkan kebudayaan masyarakat tertentu merupakan faktor pendorong terjadinya integrasi dalam masyarakat. Sikap tersebut dapat mempererat hubungan antarwarga masyarakat sehingga dapat tercipta hubungan yang harmonis dan serasi.',
                'options' => [
                    ['Mendorong terbentuknya pertentangan dalam masyarakat', 0],
                    ['Wibawa pemerintah akan tetap terjaga di mata masyarakat nasional maupun internasional', 0],
                    ['Integrasi bangsa akan tetap terjaga', 1],
                    ['Menghambat proses asimilasi ataupun akulturasi dalam masyarakat', 0],
                    ['Menghapus kesenjangan budaya dalam masyarakat', 0],
                ],
            ],
            // Soal 12
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Kerukunan hidup penting dan harus diupayakan. Salah satu caranya adalah dengan....',
                'explanation' => 'Mengembangkan sikap saling hormat-menghormati dan bekerjasama antar pemeluk agama dan kepercayaan yang berbeda merupakan wujud toleransi antar umat beragama (Bhinneka Tunggal Ika).',
                'options' => [
                    ['Bertukar pikiran dalam membahas ajaran agama tertentu', 0],
                    ['Mempelajari cara beribadah agama lain yang terdapat di sekitarnya', 0],
                    ['Menghormati sesama yang sedang melaksanakan ibadah agamanya', 1],
                    ['Memperhatikan sungguh-sungguh cara beribadah teman beda agama', 0],
                    ['Mensyukuri segala anugerah yang telah diberikan olehNya', 0],
                ],
            ],
            // Soal 13
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Sebelum merdeka, bangsa Indonesia telah melewati masa perjuangan yang begitu panjang. Banyak hal yang dikorbankan untuk meraih kemerdekaan. Bangsa Indonesia memproklamasikan kemerdekaan pada 17 Agustus 1945. Sejak saat itulah Indonesia telah mencapai kemajuan dan mampu berdiri tegak di hadapan bangsa-bangsa lain di dunia. Pengikat suatu negara untuk dapat berdiri tegak di hadapan bangsa-bangsa lain di dunia seperti informasi di atas adalah....',
                'explanation' => 'Pengikat suatu bangsa untuk dapat berdiri tegak setelah merdeka utamanya adalah semangat persatuan dan kesatuan. Tanpa adanya semangat persatuan, suatu negara justru hanya akan terpecah belah dan mementingkan wilayahnya sendiri.',
                'options' => [
                    ['Semangat persatuan dan kesatuan', 1],
                    ['Keanekaragaman suku dan budaya di Indonesia', 0],
                    ['Memegang teguh prinsip nasionalisme dan primordialisme', 0],
                    ['Dorongan suasana nyaman dan damai dalam kehidupan berbangsa dan bernegara', 0],
                    ['Meneruskan perjuangan para pahlawan dan pendiri bangsa', 0],
                ],
            ],
            // Soal 14
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Indonesia belum sepenuhnya terbebas dari berbagai ancaman yang dapat meruntuhkan integrasi nasional. Ancaman tersebut ada di berbagai dimensi kehidupan masyarakat Indonesia. Ancaman-ancaman tersebut diantaranya:<br><br>1) Munculnya gejala westernisasi, yaitu gaya hidup yang selalu berorientasi kepada budaya barat tanpa diseleksi terlebih dahulu;<br>2) Munculnya berbagai paham radikal dalam bentuk aksi teror kepada pemerintah maupun masyarakat;<br>3) Timbulnya kesenjangan sosial yang tajam sebagai akibat dari adanya persaingan bebas;<br>4) Gaya hidup individualistis yang semakin melunturkan budaya gotong royong pada masyarakat Indonesia;<br>5) Munculnya gaya hidup konsumtif dan selalu mengkonsumsi barang-barang dari luar negeri;<br>6) Indonesia akan dibanjiri oleh barang-barang dari luar seiring dengan adanya perdagangan bebas.<br><br>Berdasarkan data di atas, manakah yang merupakan ancaman terhadap integrasi nasional di bidang sosial budaya...',
                'explanation' => 'Ancaman integrasi sosial budaya: (1) westernisasi, (4) individualisme, (5) konsumtif. (2) ideologi, (3) ekonomi, (6) ekonomi.',
                'options' => [
                    ['1, 3, dan 4', 0],
                    ['3, 4, dan 5', 0],
                    ['3, 5, dan 6', 0],
                    ['1, 4, dan 5', 1],
                    ['1, 2, dan 4', 0],
                ],
            ],
            // Soal 15
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Sumpah Pemuda merupakan salah satu peristiwa penting dalam perjuangan para pemuda untuk meraih kemerdekaan Indonesia. Sumpah Pemuda dihasilkan dari Kongres Pemuda II yang diselenggarakan pada 28 Oktober 1928. Pada rapat terakhir Kongres Pemuda II, Mohammad Yamin menuliskan sebuah rumusan yang kemudian dinamai Sumpah Pemuda. Kemudian, Sumpah Pemuda dibacakan di akhir rapat sebagai hasil keputusan Kongres Pemuda II, dengan lahirnya Sumpah pemuda, rasa nasionalisme pemuda Indonesia saat itu mulai muncul secara nyata. Bentuk nyata rasa nasionalisme tersebut terimplementasi pada isi Sumpah Pemuda. Bentuk nyata yang dimaksud adalah....',
                'explanation' => 'Isi Sumpah Pemuda: 1) Bertumpah darah satu, tanah air Indonesia; 2) Berbangsa satu, bangsa Indonesia; 3) Menjunjung bahasa persatuan, bahasa Indonesia. Bentuk nyata rasa nasionalisme dari lahirnya sumpah pemuda adalah para pemuda dari berbagai latar belakang daerah, suku, dan agama menyatukan keyakinan mereka akan tumpah darah, bangsa, dan bahasa persatuan Indonesia.',
                'options' => [
                    ['Menetapkan semboyan Bhinneka Tunggal Ika sebagai tanda persatuan Pemuda Indonesia', 0],
                    ['Komitmen untuk membantu perjuangan pergerakan kemerdekaan Indonesia di daerah', 0],
                    ['Meyakini kemerdekaan ialah hak segala bangsa', 0],
                    ['Mengakui Bahasa Indonesia sebagai bahasa persatuan', 1],
                    ['Mengakui NKRI sebagai negara kepulauan dan beragam suku budaya', 0],
                ],
            ],
            // Soal 16
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Indonesia merupakan negara yang dianugerahi dengan keberagaman suku, ras, dan tradisi. Setiap daerah mempunyai karakter dan keunikannya masing-masing. Kenyataannya beberapa kali terjadi konflik di daerah dengan dasar perbedaan suku, padahal pada dasarnya keberagaman tersebut menjadi modal bagi pembangunan bangsa. Untuk menunjang hal tersebut maka sikap dan perilaku yang harus kita kembangkan adalah....',
                'explanation' => 'Konflik akibat perbedaan suku, ras, dan tradisi dapat diantisipasi dengan memperkecil segala hal yang berpotensi menimbulkan konflik dalam masyarakat.',
                'options' => [
                    ['Memperkuat posisi pemerintah pusat sebagai pemegang kedaulatan rakyat', 0],
                    ['Menegaskan kedudukan bahasa daerah sebagai simbol ragam pemersatu bangsa', 0],
                    ['Menghindari segala hal yang berpotensi menimbulkan konflik dalam masyarakat', 1],
                    ['Menghilangkan perbedaan antara suku bangsa di Indonesia dalam kehidupan berbangsa dan bernegara', 0],
                    ['Memperkuat posisi kebudayaan daerah diatas kebudayaan nasional', 0],
                ],
            ],
            // Soal 17
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Bangsa Indonesia memang sangat beragam dengan berbagai latar belakang. Persatuan dan kesatuan menjadi aspek penting yang mewadahi keberagaman tersebut. Komitmen terhadap persatuan dan kesatuan bangsa Indonesia merupakan proses dinamis yang muncul dari unsur-unsur sosial budaya bangsa Indonesia yang beragam dan mencerminkan kebhinnekaan bangsa Indonesia. Contoh perilaku yang menunjukkan komitmen tersebut adalah...',
                'explanation' => 'Contoh perilaku yang menunjukkan komitmen terhadap persatuan dan kesatuan bangsa Indonesia adalah bergaul secara santun dan akrab dengan mengesampingkan perbedaan suku bangsa.',
                'options' => [
                    ['Bersikap mengutamakan kebersihan lingkungan di sekitar tempat tinggal', 0],
                    ['Berpartisipasi dan menggalang dana untuk ikut membantu korban bencana alam', 0],
                    ['Meningkatkan solidaritas dalam kegiatan yang berorientasi semangat kedaerahan', 0],
                    ['Bergaul secara santun dan akrab dengan mengesampingkan perbedaan suku bangsa', 1],
                    ['Bekerja sama dalam segala bidang kehidupan dengan sesama suku, agama, dan daerah', 0],
                ],
            ],
            // Soal 18
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Konflik horizontal yang terjadi di Indonesia membesar karena dipicu oleh perbedaan. Konflik Sampit dan Sambas membesar karena ada perbedaan suku. Konflik Ambon membesar karena perbedaan agama. Konflik Sampang membesar karena adanya perbedaan aliran atau mazhab. Jika dipelajari, pemicu dari konflik-konflik tersebut adalah hal-hal kecil, yang dapat dikategorikan kasus kriminal biasa. Namun, karena sentimen SARA maka perkara kecil dibesar-besarkan dan perbedaan SARA menjadi katalisator. Untuk mencegah konflik/kerusuhan horizontal yang disebabkan faktor SARA, maka harus ada daya pemersatu di masyarakat, Negara harus menciptakan daya pemersatu yang kuat dan tidak mudah ditembus oleh sentimen SARA. Daya pemersatu yang harus ditumbuh-kembangkan adalah sebagai bentuk pelaksanaan nilai-nilai pancasila....',
                'explanation' => 'Titik tolaknya ada pada masalah kecil yang diperkeruh karena sentimen SARA. Untuk mencegah konflik tersebut, perlu dikuatkannya rasa Persatuan Indonesia dengan saling menghormati keberagaman masyarakat dengan menempatkan persatuan, kesatuan serta kepentingan bangsa dan negara sebagai kepentingan bersama di atas kepentingan pribadi atau golongan.',
                'options' => [
                    ['Mengembangkan sikap saling hormat-menghormati dan bekerja sama dengan bangsa lain', 0],
                    ['Membina kerukunan hidup antar sesama umat agama dan berkepercayaan terhadap Tuhan Yang Maha Esa', 0],
                    ['Nasionalisme yang melemah di Indonesia menyebabkan perbedaan menjadi penting dan dianggap sebagai hal yang kurang bisa diterima', 0],
                    ['Sebagai warga negara dan warga masyarakat, setiap manusia Indonesia mempunyai kedudukan, hak, dan kewajiban yang sama', 0],
                    ['Menempatkan persatuan, kesatuan serta kepentingan bangsa dan negara sebagai kepentingan bersama di atas kepentingan pribadi dan golongan', 1],
                ],
            ],
            // Soal 19
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Grebeg Maulid merupakan acara tradisi peninggalan Kerajaan Demak untuk memperingati kelahiran Nabi Muhammad SAW. Tradisi ini memiliki beberapa agenda yang ditutup dengan pengarakan "gunungan" dari Keraton Yogyakarta ke halaman Masjid Agung, untuk dibagikan kepada pengunjung yang sudah menunggu sejak semalaman. Hampir semua orang Jogja tentu sudah tidak asing dengan istilah grebeg. Kata grebeg sendiri berasal dari Bahasa Jawa "Gembrebeg" yakni suara keras yang timbul ketika Sultan keluar dari keraton untuk memberikan "gunungan" kepada masyarakatnya. Gunungan yang berupa tumpukan hasil bumi seperti sayuran, buah-buahan, dan makanan tradisional, dikawal oleh pasukan keraton dengan bunyi teriakan yang bersahut-sahutan serta diiringi suara tembakan. Seiring perjalanan waktu, nama gembrebeg berubah menjadi grebeg, acara semakin meriah dan antusiasme dari masyarakat juga semakin meningkat. Tradisi ini terus dilangsungkan oleh Keraton hingga sekarang. Meskipun mengalami pergeseran dari segi fungsi dan tujuan utama, tradisi ini dianggap sebagai salah satu warisan kebudayaan yang terus dilestarikan oleh pihak keraton dan Pemprov DIY. Berdasarkan ilustrasi di atas nilai-nilai yang bisa diambil adalah....',
                'explanation' => 'Grebeg Maulid merupakan warisan budaya yang bersinggungan dengan upacara peninggalan Kerajaan Demak yang berkaitan dengan agama Islam, sehingga menunjukkan hubungan yang harmonis antara budaya Islam dan budaya asli Yogyakarta.',
                'options' => [
                    ['Hubungan yang harmonis antara budaya Islam dan budaya asli Yogyakarta', 1],
                    ['Sebagai wujud syukur masyarakat terhadap hasil panen', 0],
                    ['Sebagai media komunikasi masyarakat', 0],
                    ['Sebagai media komunikasi antara masyarakat dengan raja', 0],
                    ['Sebagai media untuk melestarikan budaya asli masyarakat Yogyakarta', 0],
                ],
            ],
            // Soal 20
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Indonesia terdiri dari banyak provinsi yang sampai sekarang sudah menjadi 34 provinsi. Pada awal kemerdekaannya, bangsa Indonesia hanya memiliki.....provinsi',
                'explanation' => '8 Provinsi pertama Indonesia hasil sidang PPKI: Sumatera, Jawa Barat, Jawa Tengah, Jawa Timur, Sunda Kecil, Maluku, Sulawesi, Borneo.',
                'options' => [
                    ['5', 0],
                    ['6', 0],
                    ['7', 0],
                    ['8', 1],
                    ['9', 0],
                ],
            ],
            // Soal 21
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Maksud dari makna "Bhinneka Tunggal Ika" secara inklusif adalah...',
                'explanation' => 'Bhinneka Tunggal Ika bersifat inklusif dengan kata lain segala kelompok yang ada haruslah saling memupuk rasa persaudaraan, kelompok mayoritas tidak memperlakukan kelompok minoritas ke dalam posisi terbawah tetapi haruslah hidup berdampingan satu sama lain. Kelompok mayoritas juga tidak harus memaksakan kehendaknya kepada kelompok lain.',
                'options' => [
                    ['Mayoritas tidak menginjak minoritas', 1],
                    ['Perbedaan bersifat mutlak', 0],
                    ['Adanya persatuan dalam perbedaan', 0],
                    ['Perbedaan adalah ciri khas bangsa Indonesia', 0],
                    ['Keragaman dari segala sisi', 0],
                ],
            ],
            // Soal 22
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Semua rakyat Indonesia dalam kehidupan berbangsa dan bernegara tidak dibenarkan menganggap bahwa dirinya atau kelompoknya adalah yang paling benar, paling hebat, paling diakui oleh yang lain yang merupakan implementasi dari prinsip Bhinneka Tunggal Ika yaitu...',
                'explanation' => 'Pada dasarnya, Bhinneka Tunggal Ika memiliki prinsip-prinsip yang melatarbelakanginya, salah satunya adalah prinsip tidak bersifat sektarian dan eksklusif. Prinsip ini dapat diartikan sebagai semua rakyat Indonesia dalam kehidupan berbangsa dan bernegara tidak dibenarkan menganggap bahwa dirinya atau kelompoknya adalah yang paling benar, paling hebat, paling diakui oleh orang lain.',
                'options' => [
                    ['Common Denominator', 0],
                    ['Memiliki sifat konvergen', 0],
                    ['Tidak memiliki sifat formalitas', 0],
                    ['Mempersatukan bangsa Indonesia', 0],
                    ['Tidak bersifat sektarian dan eksklusif', 1],
                ],
            ],
            // Soal 23
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Makna toleransi dalam ragam kebhinekaan adalah...',
                'explanation' => 'Toleransi berarti keringanan, kelembutan hati, kesabaran dan kelonggaran. Makna toleransi dalam kebhinnekaan adalah hidup berdampingan secara damai dan saling menghargai di antara keragaman bahasa, agama, suku bangsa, dan adat istiadat.',
                'options' => [
                    ['Hidup berdampingan secara damai dan saling menghargai di antara keragaman bahasa, agama, suku bangsa, dan adat istiadat', 1],
                    ['Pemersatu, perekat berbagai budaya dari suku bangsa', 0],
                    ['Sesuatu yang alami yang harus dipandang sebagai suatu identitas bangsa', 0],
                    ['Tindakan untuk mampu memberikan rasa ketentraman dan kedamaian antar suku bangsa', 0],
                    ['Upaya untuk menjaga persatuan dan kesatuan dalam mewujudkan cita-cita bangsa Indonesia', 0],
                ],
            ],
            // Soal 24
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Untuk pertama kalinya lambang Bhinneka Tunggal Ika diatur penggunaannya secara resmi dalam....',
                'explanation' => 'Lambang negara Indonesia adalah Garuda Pancasila dengan semboyan Bhinneka Tunggal Ika. Lambang negara Garuda Pancasila dengan semboyan Bhinneka Tunggal Ika diatur penggunaannya dalam Peraturan Pemerintah No. 43/1958.',
                'options' => [
                    ['UU No. 10/1948', 0],
                    ['UU No. 19/1948', 0],
                    ['PP No. 39/1950', 0],
                    ['PP No. 20/1955', 0],
                    ['PP No. 43/1958', 1],
                ],
            ],
            // Soal 25
            [
                'material_id' => $ptMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
                'question_text' => 'Semboyan Bhinneka Tunggal Ika dipergunakan dalam keberagaman sebagai upaya untuk....',
                'explanation' => 'Semboyan Bhinneka Tunggal Ika digunakan untuk mempertahankan persatuan dan kesatuan bangsa Indonesia di tengah keberagaman.',
                'options' => [
                    ['Memberikan manfaat bagi perkembangan dan kemajuan', 0],
                    ['Saling menghormati dan menghargai perbedaan yang ada', 0],
                    ['Mempertahankan persatuan dan kesatuan bangsa Indonesia', 1],
                    ['Membangun bangsa dan negara Indonesia yang maju dan sejahtera', 0],
                    ['Mewujudkan rasa kebersamaan dan saling melengkapi satu sama lain', 0],
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

        $this->command->info('Seeder untuk BTI 3 (BT: 1-10, PT: 11-25) berhasil ditambahkan.');
    }
}
