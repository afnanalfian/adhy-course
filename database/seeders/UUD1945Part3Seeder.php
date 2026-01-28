<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UUD1945Part3Seeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Data untuk kategori Blind Test (id = 1)
        $blindMaterialId = DB::table('question_materials')->insertGetId([
            'category_id' => 1,
            'name' => 'BT - UUD 1945 - 3',
            'slug' => 'bt-uud-1945-3',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Data untuk kategori Post Test (id = 2)
        $postMaterialId = DB::table('question_materials')->insertGetId([
            'category_id' => 2,
            'name' => 'PT - UUD 1945 - 3',
            'slug' => 'pt-uud-1945-3',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Soal 1-10 untuk Blind Test
        $blindQuestions = [
            [
                'question_text' => 'Usul perubahan Pasal Undang-Undang Dasar dapat diagendakan dalam sidang Majelis Permusyawaratan Rakyat apabila diajukan oleh....',
                'options' => [
                    ['text' => 'Sekurang-kurangnya 1/3 dari jumlah anggota Dewan Perwakilan Rakyat', 'is_correct' => false],
                    ['text' => 'Sekurang-kurangnya 2/3 dari jumlah anggota Dewan Perwakilan Rakyat', 'is_correct' => false],
                    ['text' => 'Sekurang-kurangnya 2/3 dari jumlah anggota Majelis Permusyawaratan Rakyat', 'is_correct' => false],
                    ['text' => 'Sekurang-kurangnya 2/3 dari jumlah anggota Majelis Permusyawaratan Rakyat dan Dewan Perwakilan Rakyat', 'is_correct' => false],
                    ['text' => 'Sekurang-kurangnya 1/3 dari jumlah anggota Majelis Permusyawaratan Rakyat', 'is_correct' => true],
                ],
                'explanation' => 'Pasal 37 ayat (1) UUD 1945: "Usul perubahan pasal Undang-Undang Dasar dapat diagendakan dalam sidang Majelis Permusyawaratan Rakyat apabila diajukan oleh sekurang-kurangnya 1/3 dari jumlah anggota Majelis Permusyawaratan Rakyat".',
            ],
            [
                'question_text' => 'Bunyi alinea ketiga Pembukaan Undang-Undang Dasar 1945 secara lengkap adalah “Atas berkat rahmat Allah yang Maha Kuasa dan dengan didorongkan oleh keinginan luhur, supaya berkehidupan kebangsaan yang bebas, maka rakyat Indonesia menyatakan dengan ini....',
                'options' => [
                    ['text' => 'Kebebasannya', 'is_correct' => false],
                    ['text' => 'Kedaulatannya', 'is_correct' => false],
                    ['text' => 'Kemerdekaannya', 'is_correct' => true],
                    ['text' => 'Kebangsaannya', 'is_correct' => false],
                    ['text' => 'Kenegaraannya', 'is_correct' => false],
                ],
                'explanation' => 'Bunyi lengkap Pembukaan UUD 1945 alinea 3: "Atas berkat rahmat Allah Yang Maha Kuasa dan dengan didorongkan oleh keinginan luhur, supaya berkehidupan kebangsaan yang bebas, maka rakyat Indonesia menyatakan dengan ini kemerdekaannya."',
            ],
            [
                'question_text' => 'Undang-Undang Dasar 1945 yang mengatur bahwa setiap orang berhak atas kebebasan berserikat, berkumpul, dan mengeluarkan pendapat ditegaskan dalam pasal...',
                'options' => [
                    ['text' => 'Pasal 28A', 'is_correct' => false],
                    ['text' => 'Pasal 28B', 'is_correct' => false],
                    ['text' => 'Pasal 28C', 'is_correct' => false],
                    ['text' => 'Pasal 28E ayat (1)', 'is_correct' => false],
                    ['text' => 'Pasal 28E ayat (3)', 'is_correct' => true],
                ],
                'explanation' => 'Pasal 28E ayat (3) UUD 1945: "Setiap orang berhak atas kebebasan berserikat, berkumpul, dan mengeluarkan pendapat."',
            ],
            [
                'question_text' => 'Menurut Pasal 13 Undang-Undang Dasar 1945, Presiden memiliki hak sebagai berikut....',
                'options' => [
                    ['text' => 'Mengangkat duta dan konsul dengan memperhatikan pertimbangan Dewan Perwakilan Rakyat (DPR)', 'is_correct' => true],
                    ['text' => 'Memberi grasi dan rehabilitasi dengan mempertimbangkan Mahkamah Agung', 'is_correct' => false],
                    ['text' => 'Memberi amnesti dan abolisi dengan memperhatikan pertimbangan Dewan Perwakilan Rakyat', 'is_correct' => false],
                    ['text' => 'Menyatakan perang, membuat perdamaian dan perjanjian dengan negara lain', 'is_correct' => false],
                    ['text' => 'Memegang kekuasaan yang tertinggi atas Angkatan Darat, Angkatan Laut, dan Angkatan Udara', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 13 ayat (1) dan (2) UUD 1945:<br>(1) "Presiden mengangkat duta dan konsul"<br>(2) "Dalam mengangkat duta, Presiden memperhatikan pertimbangan Dewan Perwakilan Rakyat".',
            ],
            [
                'question_text' => 'Menurut Pasal 7A UUD 1945, Presiden dan/atau Wakil Presiden dapat diberhentikan dalam masa jabatannya oleh Majelis Permusyawaratan Rakyat atas usul....',
                'options' => [
                    ['text' => 'Dewan Perwakilan Rakyat (DPR)', 'is_correct' => true],
                    ['text' => 'Mahkamah Agung (MA)', 'is_correct' => false],
                    ['text' => 'Mahkamah Konstitusi (MK)', 'is_correct' => false],
                    ['text' => 'Dewan Pertimbangan Agung (DPA)', 'is_correct' => false],
                    ['text' => 'Mayoritas suara anggota Majelis Permusyawaratan Rakyat (MPR)', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 7A UUD 1945: "Presiden dan/atau Wakil Presiden dapat diberhentikan dalam masa jabatannya oleh Majelis Permusyawaratan Rakyat atas usul Dewan Perwakilan Rakyat".',
            ],
            [
                'question_text' => 'Mengenai usulan untuk memberhentikan Presiden dan/atau Wakil presiden, diajukan setelah terlebih dahulu mengajukan permintaan kepada....',
                'options' => [
                    ['text' => 'Dewan Perwakilan Rakyat (DPR)', 'is_correct' => false],
                    ['text' => 'Mahkamah Agung (MA)', 'is_correct' => false],
                    ['text' => 'Mahkamah Konstitusi (MK)', 'is_correct' => true],
                    ['text' => 'Dewan Pertimbangan Agung (DPA)', 'is_correct' => false],
                    ['text' => 'Mayoritas suara anggota Majelis Permusyawaratan Rakyat (MPR)', 'is_correct' => false],
                ],
                'explanation' => 'Usul pemberhentian Presiden dan/atau Wakil Presiden dapat diajukan oleh DPR hanya dengan terlebih dahulu mengajukan permintaan kepada Mahkamah Konstitusi untuk memeriksa, mengadili, dan memutus pendapat DPR.',
            ],
            [
                'question_text' => 'Menurut Pasal 23 ayat (3) Undang-Undang Dasar 1945, apabila Dewan Perwakilan Rakyat tidak menyetujui rancangan anggaran pendapatan dan belanja negara yang diusulkan oleh Presiden, maka langkah yang dilakukan pemerintah adalah....',
                'options' => [
                    ['text' => 'Mengajukan kembali rancangan APBN setelah melakukan perbaikan pada hal-hal yang dianggap perlu', 'is_correct' => false],
                    ['text' => 'Tetap menjalankan APBN sesuai rencana yang diajukan meski tidak disetujui DPR', 'is_correct' => false],
                    ['text' => 'Menunggu keputusan DPR selama 30 hari dan menjalankan APBN sesuai rencana yang diajukan meski tetap tidak disetujui DPR', 'is_correct' => false],
                    ['text' => 'Menjalankan anggaran pendapatan dan belanja negara tahun yang lalu', 'is_correct' => true],
                    ['text' => 'Merancang APBN yang baru untuk kemudian kembali diajukan kepada DPR', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 23 ayat (3) UUD 1945: "Apabila Dewan Perwakilan Rakyat tidak menyetujui anggaran yang diusulkan pemerintah, maka pemerintah menjalankan anggaran tahun yang lalu."',
            ],
            [
                'question_text' => 'Pasal 18 ayat (2) Undang-Undang Dasar 1945 yang telah diamandemen selengkapnya menjadi....',
                'options' => [
                    ['text' => 'Pemerintah daerah provinsi, daerah kabupaten, dan kota mengatur dan mengurus sendiri urusan pemerintahan menurut asas otonomi dan tugas pembantuan', 'is_correct' => true],
                    ['text' => 'Pemerintah daerah provinsi, daerah kabupaten, dan kota memiliki Dewan Perwakilan Rakyat Daerah yang anggota-anggotanya dipilih melalui pemilihan umum', 'is_correct' => false],
                    ['text' => 'Gubernur, Bupati, dan Walikota masing-masing sebagai kepala pemerintahan daerah provinsi, kabupaten, dan kota dipilih secara demokratis', 'is_correct' => false],
                    ['text' => 'Pemerintahan daerah menjalankan otonomi seluas-luasnya, kecuali urusan pemerintahan yang oleh undang-undang ditentukan sebagai urusan Pemerintah Pusat', 'is_correct' => false],
                    ['text' => 'Pemerintahan daerah berhak menetapkan peraturan daerah dan peraturan-peraturan lain untuk melaksanakan otonomi dan tugas pembantuan', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 18 ayat (2) UUD 1945: "Pemerintah daerah provinsi, daerah kabupaten, dan kota mengatur dan mengurus sendiri urusan pemerintahan menurut asas otonomi dan tugas pembantuan".',
            ],
            [
                'question_text' => 'Usaha pertahanan dan keamanan negara dilaksanakan melalui sistem pertahanan dan keamanan rakyat semesta, dimana kekuatan utama untuk itu menjadi tugas dan tanggung jawab....',
                'options' => [
                    ['text' => 'Tentara Nasional Indonesia dan Kepolisian Negara Republik Indonesia', 'is_correct' => true],
                    ['text' => 'Tentara Nasional Indonesia, Kepolisian Negara Republik Indonesia, dan rakyat', 'is_correct' => false],
                    ['text' => 'Tentara Nasional Indonesia', 'is_correct' => false],
                    ['text' => 'Kepolisian Negara Republik Indonesia', 'is_correct' => false],
                    ['text' => 'Segenap rakyat Indonesia', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 30 ayat (2) UUD 1945: "Usaha pertahanan dan keamanan negara dilaksanakan melalui sistem pertahanan dan keamanan rakyat semesta oleh Tentara Nasional Indonesia dan Kepolisian Negara Republik Indonesia sebagai kekuatan utama, dan rakyat sebagai kekuatan pendukung."',
            ],
            [
                'question_text' => 'Sekurang-kurangnya berapa persen (%) dari anggaran pendapatan dan belanja negara yang diprioritaskan negara untuk memenuhi kebutuhan penyelenggaraan pendidikan nasional...',
                'options' => [
                    ['text' => '10%', 'is_correct' => false],
                    ['text' => '20%', 'is_correct' => true],
                    ['text' => '30%', 'is_correct' => false],
                    ['text' => '40%', 'is_correct' => false],
                    ['text' => '50%', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 31 ayat (4) UUD 1945: "Negara memprioritaskan anggaran pendidikan sekurang-kurangnya 20% dari anggaran pendapatan dan belanja negara serta dari anggaran pendapatan dan belanja daerah untuk memenuhi kebutuhan penyelenggaraan pendidikan nasional."',
            ],
        ];

        // Soal 11-25 untuk Post Test
        $postQuestions = [
            [
                'question_text' => 'Fakir miskin dan anak-anak yang terlantar dipelihara oleh....',
                'options' => [
                    ['text' => 'Masyarakat', 'is_correct' => false],
                    ['text' => 'Keluarga terdekat', 'is_correct' => false],
                    ['text' => 'Yayasan kemanusiaan yang dibentuk negara', 'is_correct' => false],
                    ['text' => 'Yayasan kesejahteraan sosial yang dibentuk negara', 'is_correct' => false],
                    ['text' => 'Negara', 'is_correct' => true],
                ],
                'explanation' => 'Pasal 34 ayat (1) UUD 1945: "Fakir miskin dan anak-anak terlantar dipelihara oleh negara".',
            ],
            [
                'question_text' => 'Putusan untuk mengubah pasal-pasal Undang-Undang Dasar dilakukan dengan persetujuan sekurang-kurangnya.... dari seluruh anggota Majelis Permusyawaratan Rakyat.',
                'options' => [
                    ['text' => '2/3 ditambah 1', 'is_correct' => false],
                    ['text' => '1/3 ditambah 1', 'is_correct' => false],
                    ['text' => '40% ditambah 1', 'is_correct' => false],
                    ['text' => '50% ditambah 1', 'is_correct' => true],
                    ['text' => '60% ditambah 1', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 37 ayat (4) UUD 1945: "Putusan untuk mengubah pasal-pasal Undang-Undang Dasar dilakukan dengan persetujuan sekurang-kurangnya lima puluh persen ditambah satu dari seluruh anggota Majelis Permusyawaratan Rakyat."',
            ],
            [
                'question_text' => 'Sebelum memangku jabatannya, Presiden dan Wakil Presiden bersumpah menurut agama, atau berjanji dengan sungguh-sungguh di hadapan Majelis Permusyawaratan Rakyat atau Dewan Perwakilan Rakyat. Jika Majelis Permusyawaratan Rakyat atau Dewan Perwakilan Rakyat tidak dapat mengadakan sidang, Presiden dan Wakil Presiden bersumpah menurut agama, atau berjanji dengan sungguh-sungguh di hadapan.....dengan disaksikan oleh...',
                'options' => [
                    ['text' => 'Pimpinan MPR dengan disaksikan oleh pimpinan DPR', 'is_correct' => false],
                    ['text' => 'Pimpinan MA dengan disaksikan oleh pimpinan MPR', 'is_correct' => false],
                    ['text' => 'Pimpinan DPR dengan disaksikan oleh pimpinan MPR', 'is_correct' => false],
                    ['text' => 'Pimpinan DPR dengan disaksikan oleh pimpinan MA', 'is_correct' => false],
                    ['text' => 'Pimpinan MPR dengan disaksikan oleh pimpinan MA', 'is_correct' => true],
                ],
                'explanation' => 'Pasal 9 ayat (2) UUD 1945: "Jika Majelis Permusyawaratan Rakyat atau Dewan Perwakilan Rakyat tidak dapat mengadakan sidang, Presiden dan Wakil Presiden bersumpah menurut agama, atau berjanji dengan sungguh-sungguh di hadapan pimpinan Majelis Permusyawaratan Rakyat dengan disaksikan oleh pimpinan Mahkamah Agung."',
            ],
            [
                'question_text' => 'Dalam hal ikhwal kegentingan yang memaksa, sebagai pengganti undang-undang, Presiden berhak menetapkan...',
                'options' => [
                    ['text' => 'Keputusan Presiden', 'is_correct' => false],
                    ['text' => 'Ketetapan pemerintah', 'is_correct' => false],
                    ['text' => 'Dekrit Presiden', 'is_correct' => false],
                    ['text' => 'Peraturan Pemerintah Pengganti Undang-Undang', 'is_correct' => true],
                    ['text' => 'Undang-Undang sementara', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 22 ayat (1) UUD 1945: "Dalam hal ikhwal kegentingan yang memaksa, Presiden berhak menetapkan peraturan pemerintah pengganti undang-undang."',
            ],
            [
                'question_text' => 'Pemilihan umum diselenggarakan untuk memilih...',
                'options' => [
                    ['text' => 'Anggota DPR, DPD, dan DPRD', 'is_correct' => false],
                    ['text' => 'Presiden dan Wakil Presiden', 'is_correct' => false],
                    ['text' => 'Anggota DPR, DPD, Presiden dan Wakil Presiden dan DPRD', 'is_correct' => true],
                    ['text' => 'Anggota MPR, DPR, DPD, Presiden dan Wakil Presiden serta DPRD', 'is_correct' => false],
                    ['text' => 'Anggota MPR, DPR, DPD, dan DPRD', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 22E ayat (2) UUD 1945: "Pemilihan umum diselenggarakan untuk memilih anggota Dewan Perwakilan Rakyat, Dewan Perwakilan Daerah, Presiden dan Wakil Presiden, dan Dewan Perwakilan Rakyat Daerah."',
            ],
            [
                'question_text' => 'Bupati Maros meresmikan Desa Pancasila sebagai desa wisata religi karena dinilai memiliki potensi besar sebagai contoh terlaksananya toleransi dan wujud dari Bhinneka Tunggal Ika. Hal ini tercermin dalam UUD 1945 yang menjamin hak asasi manusia sesuai wacana yaitu dalam...',
                'options' => [
                    ['text' => 'Pasal 29', 'is_correct' => true],
                    ['text' => 'Pasal 27', 'is_correct' => false],
                    ['text' => 'Pasal 30', 'is_correct' => false],
                    ['text' => 'Pasal 28', 'is_correct' => false],
                    ['text' => 'Pasal 31', 'is_correct' => false],
                ],
                'explanation' => 'Wisata religi yang menggambarkan sikap toleransi dan Bhinneka Tunggal Ika dalam kehidupan beragama merupakan cerminan dari Pasal 29 UUD 1945 tentang kebebasan beragama.',
            ],
            [
                'question_text' => 'Berdasarkan ketentuan dalam UUD 1945 bahwa Indonesia menganut sistem pembagian kekuasaan bukan pemisahan kekuasaan. Hal itu dapat dibuktikan dengan tidak adanya campur tangan suatu lembaga tinggi negara dalam kekuasaan lembaga negara lainnya. Contoh-contohnya sebagai berikut, kecuali...',
                'options' => [
                    ['text' => 'DPR ikut menetapkan APBN', 'is_correct' => false],
                    ['text' => 'Presiden memberi grasi', 'is_correct' => false],
                    ['text' => 'Presiden mengesahkan UU', 'is_correct' => true],
                    ['text' => 'Presiden mengangkat duta', 'is_correct' => false],
                    ['text' => 'Presiden mengangkat konsul', 'is_correct' => false],
                ],
                'explanation' => 'Dalam hal mengesahkan/menetapkan UU adalah fungsi bersama dari DPR dan Presiden (checks and balances), sehingga dari hal tersebut tidak tercipta pembagian kekuasaan yang absolut.',
            ],
            [
                'question_text' => 'Rumusan rancangan undang-undang dasar merupakan salah satu hal yang dibahas dan disetujui dalam sidang yang diadakan oleh.....',
                'options' => [
                    ['text' => 'MPRS', 'is_correct' => false],
                    ['text' => 'BPUPKI', 'is_correct' => true],
                    ['text' => 'PPKI', 'is_correct' => false],
                    ['text' => 'KPNI', 'is_correct' => false],
                    ['text' => 'MPR', 'is_correct' => false],
                ],
                'explanation' => 'Rumusan Undang-Undang Dasar dibahas dalam sidang kedua BPUPKI (Badan Penyelidik Usaha-usaha Persiapan Kemerdekaan Indonesia).',
            ],
            [
                'question_text' => 'Berikut yang menjadi dasar hukum bela negara menurut UUD 1945 pasal 30 ayat (1) adalah..',
                'options' => [
                    ['text' => 'Setiap warga negara berhak dan wajib ikut serta dalam upaya pembelaan Negara', 'is_correct' => false],
                    ['text' => 'Mengatur tata cara penyelenggaraan pertahanan negara yang dilakukan oleh TNI ataupun oleh seluruh komponen bangsa', 'is_correct' => false],
                    ['text' => 'Tiap-tiap warga negara berhak dan wajib ikut serta dalam usaha pertahanan dan keamanan Negara', 'is_correct' => true],
                    ['text' => 'Setiap warga negara wajib ikut dalam upaya pembelaan negara sesuai dengan ketentuan Peraturan Perundang-undangan', 'is_correct' => false],
                    ['text' => 'Semua warga negara berhak dan wajib ikut serta dalam usaha pertahanan dan pembelaan Negara', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 30 ayat (1) UUD 1945: "Tiap-tiap warga negara berhak dan wajib ikut serta dalam usaha pertahanan dan keamanan negara."',
            ],
            [
                'question_text' => 'Presiden dan/atau wakil presiden dapat diberhentikan dalam masa jabatannya oleh MPR atas usul DPR, apabila terbukti melakukan hal berikut ini, kecuali ....',
                'options' => [
                    ['text' => 'Pengkhianatan terhadap Negara', 'is_correct' => false],
                    ['text' => 'Jabatan rangkap di partai politik', 'is_correct' => true],
                    ['text' => 'Korupsi', 'is_correct' => false],
                    ['text' => 'Penyuapan', 'is_correct' => false],
                    ['text' => 'Perbuatan tercela', 'is_correct' => false],
                ],
                'explanation' => 'Berdasar Pasal 7B ayat 1 UUD 1945, alasan pemberhentian adalah: pengkhianatan terhadap negara, korupsi, penyuapan, tindak pidana berat lainnya, atau perbuatan tercela, dan/atau tidak lagi memenuhi syarat sebagai Presiden/Wakil Presiden. Jabatan rangkap di parpol bukan alasan pemberhentian.',
            ],
            [
                'question_text' => 'Pak Roni (anggota BPK), Pak Andi (pengusaha), Bu Silvi (anggota DPR RI), Pak Robi (anggota DPRD), Pak Anggit (anggota DPD) dan Bu Nina (istri TNI) sedang reuni di suatu kafe, tiba-tiba ada rapat MPR, siapakah dari mereka yang mengikuti rapat..',
                'options' => [
                    ['text' => 'Roni dan Andi', 'is_correct' => false],
                    ['text' => 'Silvi dan Anggit', 'is_correct' => true],
                    ['text' => 'Robi dan Andi', 'is_correct' => false],
                    ['text' => 'Nina dan Silvi', 'is_correct' => false],
                    ['text' => 'Tidak ada salah satu', 'is_correct' => false],
                ],
                'explanation' => 'Anggota MPR terdiri dari anggota DPR (Bu Silvi) dan anggota DPD (Pak Anggit). BPK, pengusaha, DPRD, dan istri TNI bukan anggota MPR.',
            ],
            [
                'question_text' => 'Presiden dalam mengangkat duta dan konsul membutuhkan pertimbangan dari...',
                'options' => [
                    ['text' => 'MPR', 'is_correct' => false],
                    ['text' => 'DPR', 'is_correct' => true],
                    ['text' => 'Menteri', 'is_correct' => false],
                    ['text' => 'DPD', 'is_correct' => false],
                    ['text' => 'KPK', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 13 ayat (2) UUD 1945: "Dalam mengangkat duta, Presiden memperhatikan pertimbangan Dewan Perwakilan Rakyat."',
            ],
            [
                'question_text' => 'Salah satu stand up komedi Indonesia secara terang-terangan mengakui dirinya adalah seorang atheis. Pengakuan ini sangat bertentangan dengan UUD pasal?',
                'options' => [
                    ['text' => 'Pasal 30', 'is_correct' => false],
                    ['text' => 'Pasal 29', 'is_correct' => true],
                    ['text' => 'Pasal 28', 'is_correct' => false],
                    ['text' => 'Pasal 27', 'is_correct' => false],
                    ['text' => 'Pasal 26', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 29 ayat (1) UUD 1945: "Negara berdasar atas Ketuhanan Yang Maha Esa." Atheisme bertentangan dengan dasar negara tersebut.',
            ],
            [
                'question_text' => 'Salah satu simpatisan Presiden tidak terima karena wajah presiden dibuat karikatur, menurutnya presiden merupakan lambang negara Indonesia, tetapi politikus menyebutkan bahwa presiden bukan lambang negara kita, karena lambang negara kita adalah..',
                'options' => [
                    ['text' => 'Bhinneka Tunggal Ika', 'is_correct' => false],
                    ['text' => 'Monas', 'is_correct' => false],
                    ['text' => 'Garuda Pancasila', 'is_correct' => true],
                    ['text' => 'Bendera Merah Putih', 'is_correct' => false],
                    ['text' => 'Lagu Indonesia Raya', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 36A UUD 1945: "Lambang Negara ialah Garuda Pancasila dengan semboyan Bhinneka Tunggal Ika."',
            ],
            [
                'question_text' => 'Lagu Indonesia Raya pernah dipelesetkan dengan tidak pantas oleh Negara Malaysia sehingga membuat warga negara Indonesia protes, karena lagu Indonesia merupakan lagu kebangsaan yang dijelaskan di pasal..',
                'options' => [
                    ['text' => '35', 'is_correct' => false],
                    ['text' => '36', 'is_correct' => false],
                    ['text' => '36B', 'is_correct' => true],
                    ['text' => '36C', 'is_correct' => false],
                    ['text' => '37', 'is_correct' => false],
                ],
                'explanation' => 'Pasal 36B UUD 1945: "Lagu Kebangsaan ialah Indonesia Raya."',
            ],
        ];

        // Insert soal untuk Blind Test (1-10)
        foreach ($blindQuestions as $index => $question) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $blindMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
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
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        // Insert soal untuk Post Test (11-25)
        foreach ($postQuestions as $index => $question) {
            $questionId = DB::table('questions')->insertGetId([
                'material_id' => $postMaterialId,
                'type' => 'mcq',
                'test_type' => 'twk',
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
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);
            }
        }

        $this->command->info('Seeder UUD 1945 Part 3 berhasil dijalankan!');
        $this->command->info('Blind Test (1-10) => Material ID: ' . $blindMaterialId);
        $this->command->info('Post Test (11-25) => Material ID: ' . $postMaterialId);
    }
}
