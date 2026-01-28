<?php

namespace Database\Seeders;

use App\Models\QuestionCategory;
use App\Models\QuestionMaterial;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TKP4Part2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data untuk kategori 1 (Blind Test) - soal 1-10 sudah ada, tambah soal 21-25
        $materialBT = QuestionMaterial::find(18); // ID 18 untuk BT

        if (!$materialBT) {
            $this->command->error('Material BT dengan ID 18 tidak ditemukan!');
            return;
        }

        // Soal 21-25 untuk Blind Test
        $questionsBT2 = [
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Di kantor tempat kamu bekerja, ada program "Hari Tanpa Plastik" yang diterapkan setiap Jumat. Namun, beberapa rekan tetap membawa kantong plastik dengan alasan lupa atau tidak sempat membawa tas kain. Kamu ditunjuk sebagai koordinator kegiatan ini dan mendapat kritik dari mereka karena dianggap terlalu kaku dalam menerapkan aturan. Apa yang kamu lakukan agar program tetap berjalan efektif namun tidak menimbulkan resistensi di antara rekan kerja?',
                'explanation' => 'Kunci: ABCDE',
                'options' => [
                    ['option_text' => 'Mengajak rekan berdiskusi tentang manfaat program dan mencari cara agar lebih mudah dijalankan bersama', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Memberi pengertian dengan pendekatan santai dan memberi waktu adaptasi sebelum menegakkan aturan', 'weight' => 4, 'order' => 2],
                    ['option_text' => 'Tetap menegakkan aturan tanpa kompromi agar kebijakan berjalan konsisten', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Membiarkan pelanggaran kecil karena tujuannya bukan menghukum, tapi mengedukasi', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Menyampaikan laporan ke pimpinan agar ada sanksi bagi yang tidak patuh', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Di lingkungan kerja kamu, muncul isu hoaks di grup WhatsApp kantor mengenai perubahan aturan tunjangan. Sebagian pegawai mulai cemas dan menyebarkan pesan itu ke grup lainnya. Kamu tahu pesan tersebut tidak resmi, namun belum ada klarifikasi dari pimpinan. Apa tindakan yang paling tepat kamu lakukan?',
                'explanation' => 'Kunci: BAEDC',
                'options' => [
                    ['option_text' => 'Menengakkan rekan kerja dan menyarankan menunggu pengumuman resmi dari pihak berwenang', 'weight' => 4, 'order' => 1],
                    ['option_text' => 'Mengirim klarifikasi dengan data dan sumber yang kamu cari sendiri dari situs resmi', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Mengabaikan karena kamu yakin nanti pimpinan akan menjelaskan', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Menegur langsung orang yang menyebarkan pesan agar tidak memperkeruh suasana', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Membuat pesan netral yang mengingatkan semua agar bijak dalam menerima informasi', 'weight' => 3, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Kamu menjadi bagian tim lintas daerah yang terdiri dari pegawai dari berbagai latar budaya. Saat rapat online, salah satu anggota menggunakan bahasa daerah yang tidak semua orang mengerti. Beberapa rekan mulai merasa tidak dilibatkan. Apa yang kamu lakukan agar komunikasi tetap inklusif?',
                'explanation' => 'Kunci: ADBCE',
                'options' => [
                    ['option_text' => 'Mengingatkan dengan sopan agar menggunakan bahasa yang dipahami semua peserta', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Membuat kesepakatan bahasa kerja yang seragam untuk semua pertemuan', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Menyesuaikan diri dan berusaha memahami, tanpa menegur secara langsung', 'weight' => 4, 'order' => 3],
                    ['option_text' => 'Menyampaikan kepada ketua tim agar mengingatkan tanpa menyinggung siapa pun', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Membiarkan saja karena yang penting hasil diskusinya tercapai', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Kamu bekerja di lembaga pemerintah yang tengah gencar menerapkan learning organization agar pegawai aktif belajar dan berinovasi. Namun, beberapa rekan menolak karena merasa metode lama sudah cukup. Sebagai anggota muda, kamu ingin ikut berkontribusi tanpa menyinggung senior. Apa langkah yang kamu ambil?',
                'explanation' => 'Kunci: ACDBE',
                'options' => [
                    ['option_text' => 'Mengajak berdiskusi santai dan menawarkan contoh kecil perubahan yang memberi manfaat nyata', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Mengikuti arahan pimpinan tanpa berdebat, agar suasana tetap harmonis', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Menyusun ide perbaikan sendiri dan menyampaikan lewat laporan resmi', 'weight' => 1, 'order' => 3],
                    ['option_text' => 'Mendukung inovasi dengan cara bekerja lebih cepat dari yang lain agar dilihat hasilnya', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Menunggu waktu yang tepat hingga rekan lain siap menerima perubahan', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialBT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Di daerah tempat kamu tinggal, muncul isu perbedaan pendapat tentang perayaan hari besar keagamaan yang diadakan di ruang publik. Sebagai tokoh muda, kamu diminta memberi pendapat. Apa langkah paling tepat yang kamu lakukan?',
                'explanation' => 'Kunci: EABCD',
                'options' => [
                    ['option_text' => 'Mengusulkan dialog lintas agama agar kegiatan keagamaan dilakukan bergiliran dengan saling menghormati', 'weight' => 2, 'order' => 1],
                    ['option_text' => 'Mendukung sepenuhnya acara tersebut karena menjadi bagian tradisi lokal yang sudah turun-temurun', 'weight' => 5, 'order' => 2],
                    ['option_text' => 'Menyarankan agar semua kegiatan keagamaan dilakukan di tempat ibadah masing-masing', 'weight' => 4, 'order' => 3],
                    ['option_text' => 'Menunggu keputusan pemerintah daerah agar tidak salah langkah', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Mengajak komunitas muda membuat kegiatan kebersamaan lintas iman untuk menumbuhkan saling pengertian', 'weight' => 1, 'order' => 5],
                ]
            ],
        ];

        // Simpan soal 21-25 untuk Blind Test
        foreach ($questionsBT2 as $questionData) {
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

        // Data untuk kategori 2 (Post Test) - soal 11-20 sudah ada, tambah soal 26-30
        $materialPT = QuestionMaterial::find(19); // ID 19 untuk PT

        if (!$materialPT) {
            $this->command->error('Material PT dengan ID 19 tidak ditemukan!');
            return;
        }

        // Soal 26-30 untuk Post Test
        $questionsPT2 = [
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Kamu bertugas memperbarui data pegawai di sistem kepegawaian online. Namun, beberapa data yang kamu terima belum lengkap. Apa yang kamu lakukan?',
                'explanation' => 'Kunci: ADCEB',
                'options' => [
                    ['option_text' => 'Menghubungi pegawai terkait untuk melengkapi datanya sebelum diinput', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menginput data sementara, lalu memperbarui nanti jika sudah lengkap', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Mengembalikan berkas ke atasan untuk diverifikasi terlebih dahulu', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Membuat catatan pegawai mana saja yang datanya belum lengkap dan melaporkannya', 'weight' => 2, 'order' => 4],
                    ['option_text' => 'Menginput data yang lengkap saja agar tidak tertunda', 'weight' => 4, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Kamu ditunjuk sebagai admin aplikasi internal kantor. Salah satu pengguna mengeluh kesulitan login, padahal datanya benar. Apa tindakan terbaikmu?',
                'explanation' => 'Kunci: ABEDC',
                'options' => [
                    ['option_text' => 'Mengecek log sistem untuk memastikan penyebab teknisnya', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Membantu pengguna reset password sementara sambil mencatat laporan gangguan', 'weight' => 4, 'order' => 2],
                    ['option_text' => 'Menyarankan pengguna mencoba login ulang di perangkat berbeda', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Membuat panduan login agar masalah serupa tidak terulang', 'weight' => 1, 'order' => 4],
                    ['option_text' => 'Menghubungi vendor aplikasi untuk memeriksa bug sistem', 'weight' => 3, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Kamu diberi akses ke database publik yang berisi data sensitif masyarakat. Seorang rekan memintamu menyalin sebagian data untuk keperluan laporan internal. Apa yang kamu lakukan?',
                'explanation' => 'Kunci: ADCBE',
                'options' => [
                    ['option_text' => 'Mengecek izin dan kebijakan penggunaan data sebelum membagikannya', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Menyalin data tapi menghapus bagian yang bersifat pribadi', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Mengingatkan rekan tentang pentingnya menjaga privasi data publik', 'weight' => 3, 'order' => 3],
                    ['option_text' => 'Meminta rekan mengajukan permintaan resmi melalui sistem', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Menyerahkan data karena dianggap untuk kepentingan instansi juga', 'weight' => 2, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Sebagai analis proyek di Dinas Pelayanan Publik, kamu diminta mengevaluasi satu tahun sejak peluncuran portal e-Pelayanan. Data menunjukkan tingkat adopsi masyarakat rendah — banyak pengguna berhenti di halaman verifikasi, ada banyak keluhan tentang proses yang berbelit, dan unit layanan lapangan melaporkan peningkatan panggilan telepon. Kamu harus menyusun rekomendasi untuk meningkatkan adopsi dalam 3 bulan ke depan.',
                'explanation' => 'Kunci: ACEBD',
                'options' => [
                    ['option_text' => 'Menyusun analisis lengkap (funnel pengguna, titik drop-off, feedback) dan rekomendasi prioritas perbaikan', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Meluncurkan kampanye sosialisasi intensif dengan materi panduan langkah demi langkah', 'weight' => 3, 'order' => 2],
                    ['option_text' => 'Menyusun tim kecil gabungan (IT, layanan publik, humas) untuk memperbaiki proses verifikasi teknis dalam 1 bulan', 'weight' => 2, 'order' => 3],
                    ['option_text' => 'Membuka layanan bantuan telepon 24/7 sementara sambil memperbaiki portal', 'weight' => 4, 'order' => 4],
                    ['option_text' => 'Mengusulkan pertemuan koordinasi antarunit agar tiap unit memahami peran mereka dalam pengalaman pengguna', 'weight' => 1, 'order' => 5],
                ]
            ],
            [
                'material_id' => $materialPT->id,
                'type' => 'mcq',
                'test_type' => 'tkp',
                'question_text' => 'Kamu koordinator proyek integrasi data di tingkat kabupaten. Ada tekanan politik untuk "cepat mengintegrasikan" seluruh data kependudukan, kesehatan, dan pendidikan ke satu dashboard nasional. Namun, selama audit awal, tim kamu menemukan perbedaan definisi data (mis. apa yang dihitung sebagai "aktif"), masalah kualitas, dan perbedaan struktur database. Pimpinan mendesak hasil cepat. Langkah strategis apa yang kamu prioritaskan?',
                'explanation' => 'Kunci: ADBCE',
                'options' => [
                    ['option_text' => 'Menyusun standar definisi data (data dictionary) dan metadata sebagai langkah pertama', 'weight' => 5, 'order' => 1],
                    ['option_text' => 'Memulai integrasi parsial untuk subset data yang mudah disatukan agar terlihat progres cepat', 'weight' => 1, 'order' => 2],
                    ['option_text' => 'Menunjuk satu vendor untuk melakukan konversi data massal tanpa mengubah definisi lokal', 'weight' => 4, 'order' => 3],
                    ['option_text' => 'Mengadakan workshop lintas OPD untuk menyepakati kebutuhan pengguna akhir dan definisi bersama', 'weight' => 3, 'order' => 4],
                    ['option_text' => 'Menyusun timeline ambisius yang menekankan deliverable cepat agar memenuhi ekspektasi pimpinan', 'weight' => 2, 'order' => 5],
                ]
            ],
        ];

        // Simpan soal 26-30 untuk Post Test
        foreach ($questionsPT2 as $questionData) {
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

        $this->command->info('Seeder TKP soal 21-30 berhasil ditambahkan!');
        $this->command->info('Blind Test tambahan (soal 21-25): ' . count($questionsBT2) . ' soal');
        $this->command->info('Post Test tambahan (soal 26-30): ' . count($questionsPT2) . ' soal');
    }
}
