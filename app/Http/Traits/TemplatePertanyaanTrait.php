<?php

namespace App\Http\Traits;

use App\Models\KuesionerAkademik;
use App\Models\KuesionerFakultas;
use App\Models\KuesionerLP2M;
use App\Models\KuesionerSarpras;
use App\Models\KuesionerVisiMisi;
use Illuminate\Http\Request;

trait TemplatePertanyaanTrait
{
	public function createPertanyaanAkademik(KuesionerAkademik $kuesionerAkademik)
	{
		$pertanyaan_akademik = [
			array(
				'pertanyaan' => 'Kesiapan dosen dalam mempersiapkan materi perkuliahan (video, hand out presentasi, bahan bacaan, atau link materi disematkan pada sistem e-learning).',
				'nomor' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kejelasan penyampaian materi perkuliahan.',
				'nomor' => 2,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kelengkapan materi perkuliahan dosen (RPS online, viseo, hand out presentasi, bahan bacaan, atau link materi disematkan pada sistem e-learning).',
				'nomor' => 3,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kemampuan dosen menggunakan media pembelajaran daring (sistem e-learning).',
				'nomor' => 4,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kemampuan dosen menyampaikan materi perkuliahan dengan metode daring yang bervariasi (ceramah, diskusi, problem-based learning, project-based learning).',
				'nomor' => 5,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Dosen mengembalikan hasil ujian/tugas dengan hasil penilaian yang obyektif.',
				'nomor' => 6,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kecepatan dosen dalam membantu mahasiswa di waktu perkuliahan.',
				'nomor' => 7,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kesesuaian kehadiran dosen sesuai dengan jadwal yang telah ditentukan.',
				'nomor' => 8,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kesesuaian materi kuliah dengan Rencana Perkuliahan.',
				'nomor' => 9,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kesediaan dosen untuk membantu mahasiswa yang mengalami kesulitan di waktu/luar perkuliahan.',
				'nomor' => 10,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kecukupan dan kualitas sarana dan prasarana fisik perkuliahan secara daring/luring.',
				'nomor' => 11,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kemudahan mengakses sistem informasi (sistem e-learning Moodle, sikad, website, dan layanan e-mail).',
				'nomor' => 12,
				'created_at' => now(),
				'updated_at' => now(),
			),
		];

		$kuesionerAkademik->pertanyaan()->createMany($pertanyaan_akademik)->each(function ($item, $key) {
			$jawaban = [
				array(
					'jawaban' => 'Sangat Tidak Puas',
					'nilai' => 1,
					'created_at' => now(),
					'updated_at' => now(),
				),
				array(
					'jawaban' => 'Tidak Puas',
					'nilai' => 2,
					'created_at' => now(),
					'updated_at' => now(),
				),
				array(
					'jawaban' => 'Puas',
					'nilai' => 3,
					'created_at' => now(),
					'updated_at' => now(),
				),
				array(
					'jawaban' => 'Sangat Puas',
					'nilai' => 4,
					'created_at' => now(),
					'updated_at' => now(),
				),
			];
			$item->jawaban()->createMany($jawaban);
		});
	}

	public function createPertanyaanSarpras(KuesionerSarpras $kuesionerSarpras)
	{
		$pertanyaan_sarpras = array(
			array(
				'pertanyaan' => 'Prosedur pelayanan keuangan yang mudah dipahami.',
				'nomor' => 1,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kecepatan proses pemberian layanan keuangan.',
				'nomor' => 2,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Ketersediaan layanan keuangan sesuai kebutuhan.',
				'nomor' => 3,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Tanggapan petugas keuangan cepat dan tepat terhadap keluhan pengguna layanan.',
				'nomor' => 4,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Petugas keuangan memberikan informasi secara jelas dan mudah dimengerti.',
				'nomor' => 5,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Alat dan Bahan Praktikum (tersedia, berfungsi dan jumlah alat/bahan cukup, dan tersedia SOP).',
				'nomor' => 6,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Ruang Laboratorium (kebersihan, kecukupan luas ruangan, dan arah evakuai saat bahaya).',
				'nomor' => 7,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Ruang laboratorium selalu siap digunakan dan jadwal terstruktur.',
				'nomor' => 8,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Laboratorium mendukung kegiatan pembelajaran.',
				'nomor' => 9,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Petunjuk pelayanan (ketersedian dan akses) peminjaman ruang laboratorium, alat, dan bahan praktikum.',
				'nomor' => 10,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Petunjuk peminjaman alat dan bahan.',
				'nomor' => 11,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Tersedianya jadwal praktikum yang terstruktur.',
				'nomor' => 12,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Laboran menyiapkan peralatan dan bahan yang dibutuhkan pada setiap kegiatan pembelajaran di laboratorium.',
				'nomor' => 13,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Ketepatan waktu laboran dalam menyiapkan peminjaman alat dan bahan praktikum.',
				'nomor' => 14,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Laboran mengecek peralatan (kelengkapan, kerusakan) setiap selesai digunakan.',
				'nomor' => 15,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Laboran bersikap ramah, sopan, dan bertanggungjawab.',
				'nomor' => 16,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Laboran menguasai informasi terkait laboratorium.',
				'nomor' => 17,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Laboran melayani sesuai dengan nilai-nilai institusi (emphaty, humble, genuine, helpful, loyalty, forgiving).',
				'nomor' => 18,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Pustakawan membantu saat membutuhkan informasi di menemukan informasi di Perpustakaan.',
				'nomor' => 19,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Pustakawan bersikap ramah, sopan dan bertanggungjawab saat memberikan pelayanan.',
				'nomor' => 20,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Perpustakaan menyediakan koleksi (buku dan jurnal) untuk menunjang kegiatan belajar.',
				'nomor' => 21,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Perpustakaan menyediakan koleksi (buku dan jurnal) elektronik untuk memenuhi informasi mahasiswa.',
				'nomor' => 22,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Perpustakaan menyediakan (buku dan Jurnal) tercetak versi mutakhir (terkini).',
				'nomor' => 23,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Koleksi buku mudah diakses baik versi cetak dan elektronik.',
				'nomor' => 24,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Itenas memiliki sistem informasi untuk layanan proses pembelajaran dan program kreativitas mahasiswa.',
				'nomor' => 25,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Website Itenas mudah diakses.',
				'nomor' => 26,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Website Itenas memberikan informasi terbaru mengenai kegiatan dan prestasi yang diperoleh.',
				'nomor' => 27,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Itenas memiliki fasilitas Sistem Informasi akademik (SIKAD).',
				'nomor' => 28,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Sistem Informasi akademik (SIKAD) Itenas mudah diakses oleh seluruh sivitas akademik.',
				'nomor' => 29,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Itenas memiliki sistem informasi administrasi, akademik, keuangan, SDM, dan sarana prasarana yang efektif.',
				'nomor' => 30,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Staf UPT TIK merawat hardware komputer dan pembaharuan software computer.',
				'nomor' => 31,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Staf UPT TIK melakukan perawatan terhadap jaringan koneksi internet dan jaringan area network internal.',
				'nomor' => 32,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Staf UPT TIK memberikan layanan dengan baik.',
				'nomor' => 33,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Staf UPT TIK memberikan pengarahan dan pemahaman untuk penggunaan perangkat teknologi/komputer dan jaringan di area kampus.',
				'nomor' => 34,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Staf UPT TIK memberikan pelatihan sistem informasi kepada sivitas akademik.',
				'nomor' => 35,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Ruang kuliah tertata dengan bersih dan rapi.',
				'nomor' => 36,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Ruang kuliah sejuk dan nyaman.',
				'nomor' => 37,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Sarana pembelajaran tersedia di ruang kuliah.',
				'nomor' => 38,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Sarana pembelajaran berfungsi dengan baik.',
				'nomor' => 39,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Ketersediaan fasilitas kamar kecil/toilet yang cukup dan bersih.',
				'nomor' => 40,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Ketersediaan fasilitas tempat ibadah.',
				'nomor' => 41,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Ketersediaan fasilitas berkegiatan dan bekerja untuk mahasiswa.',
				'nomor' => 42,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
		);

		$kuesionerSarpras->pertanyaan()->createMany($pertanyaan_sarpras)->each(function ($item, $key) {
			$jawaban = [
				array(
					'jawaban' => 'Sangat Tidak Puas',
					'nilai' => 1,
					'created_at' => now(),
					'updated_at' => now(),
				),
				array(
					'jawaban' => 'Tidak Puas',
					'nilai' => 2,
					'created_at' => now(),
					'updated_at' => now(),
				),
				array(
					'jawaban' => 'Puas',
					'nilai' => 3,
					'created_at' => now(),
					'updated_at' => now(),
				),
				array(
					'jawaban' => 'Sangat Puas',
					'nilai' => 4,
					'created_at' => now(),
					'updated_at' => now(),
				),
			];
			$item->jawaban()->createMany($jawaban);
		});
	}

	public function createPertanyaanFakultas(KuesionerFakultas $kuesionerFakultas)
	{
		$pertanyaan_fakultas = array(
			array(
				'pertanyaan' => 'Kesesuaian penyusunan SK mengajar dengan kesediaan dosen',
				'nomor' => 1,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyusun dan menginformasikan jadwal penetapan dosen pengampu mata kuliah setiap semester',
				'nomor' => 2,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyusun dan menginformasikan jadwal penyerahan distribusi mengajar dari prodi',
				'nomor' => 3,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyusun dan menginformasikan proporsi jumlah kelas untuk pembagian kelas setiap mata kuliah setiap semester',
				'nomor' => 4,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyusun dan menginformasikan jadwal penyerahan hasil evaluasi pembagian kelas dari prodi ',
				'nomor' => 5,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyusun dan menginformasikan jadwal penyusunan Rencana Kerja Dosen (RKD) dan Jadwal Kerja Dosen (JKD) setiap semester',
				'nomor' => 6,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan Daftar Hadir Kelas untuk kegiatan kuliah',
				'nomor' => 7,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan Daftar Hadir Kelas untuk kegiatan responsi (jika ada)',
				'nomor' => 8,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyusun dan menginformasikan jadwal penyusunan Rencana Pembelajaran Semester (RPS) dan Laporan Pengampu (awal, tengah, dan akhir)',
				'nomor' => 9,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan template format Rencana Pembelajaran Semester (RPS)',
				'nomor' => 10,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan template format Laporan Pengampu (awal, tengah, dan akhir)',
				'nomor' => 11,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyusun dan menginformasikan pelaksanaan jadwal UTS dan UAS setiap mata kuliah setiap semester',
				'nomor' => 12,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Memberikan informasi waktu pengumpulan soal dan solusi ujian, dan batas waktu posting nilai akhir kuliah',
				'nomor' => 13,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kesesuaian rekapitulasi data dengan data aktual terkait waktu pengumpulan soal dan solusi ujian, dan batas waktu posting nilai akhir kuliah',
				'nomor' => 14,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menginformasikan hasil evaluasi proses pembelajaran setiap semester',
				'nomor' => 15,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan data secara tepat dan akurat untuk penilaian kinerja dosen setiap semester',
				'nomor' => 16,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan dan mendistribusikan SK pembimbing Tugas Akhir (TA)',
				'nomor' => 17,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan dan mendistribusikan SK penguji Tugas Akhir (TA)',
				'nomor' => 18,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan dan mendistribusikan SK pembimbing Praktik Kerja (KP)',
				'nomor' => 19,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan dan mendistribusikan SK penguji Praktik Kerja (KP)',
				'nomor' => 20,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan kelengkapan kebutuhan dalam pelaksanaan kuliah daring (pembuatan courses, kelas dan daftar hadir mahasiswa di Moodle)',
				'nomor' => 21,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kemudahan pengurusan surat dan permohonan tandatangan kepada Dekan untuk kegiatan Penelitian',
				'nomor' => 22,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kemudahan pengurusan surat dan permohonan tandatangan kepada Dekan dan Wakil Dekan untuk kegiatan PKM',
				'nomor' => 23,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kemudahan pengurusan surat dan permohonan tandatangan kepada Dekan dan Wakil Dekan untuk kegiatan lain',
				'nomor' => 24,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Mengoordinasikan penyelanggaraan seminar / workshop tingkat nasional',
				'nomor' => 25,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Mengoordinasikan penyelanggaraan seminar / workshop tingkat internasional',
				'nomor' => 26,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan informasi kegiatan dengan pihak internal maupun eksternal, seperti: seminar, workshop, pelatihan, dll',
				'nomor' => 27,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan informasi yang jelas dan update berkaitan dengan studi lanjut bagi dosen',
				'nomor' => 28,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan informasi yang jelas dan update berkaitan dengan kegiatan kepakaran bagi dosen',
				'nomor' => 29,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menyediakan informasi kerjasama baik dengan pihak internal maupun eksternal kampus',
				'nomor' => 30,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
		);

		$kuesionerFakultas->pertanyaan()->createMany($pertanyaan_fakultas)->each(function ($item, $key) {
			$jawaban = [
				array(
					'jawaban' => 'Sangat Tidak Puas',
					'nilai' => 1,
					'created_at' => now(),
					'updated_at' => now(),
				),
				array(
					'jawaban' => 'Tidak Puas',
					'nilai' => 2,
					'created_at' => now(),
					'updated_at' => now(),
				),
				array(
					'jawaban' => 'Puas',
					'nilai' => 3,
					'created_at' => now(),
					'updated_at' => now(),
				),
				array(
					'jawaban' => 'Sangat Puas',
					'nilai' => 4,
					'created_at' => now(),
					'updated_at' => now(),
				),
			];
			$item->jawaban()->createMany($jawaban);
		});
	}

	public function createPertanyaanLP2M(KuesionerLP2M $kuesionerLP2M)
	{
		$pertanyaan_lp2m = array(
			array(
				'pertanyaan' => 'Sosialisasi peluang publikasi ilmiah eksternal dari LP2M',
				'nomor' => 1,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Sosialisasi peluang publikasi ilmiah eksternal dari LP2M',
				'nomor' => 2,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Peran website LP2M dalam merepresentasikan Institut (memuat informasi mengenai profil dan keahlian dosen, serta kelengkapan sarana prasarana kampus)',
				'nomor' => 3,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Intensifikasi pembinaan dosen oleh LP2M dalam kegiatan penelitian',
				'nomor' => 4,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Intensifikasi pembinaan dosen oleh LP2M dalam kegiatan pengabdian kepada masyarakat',
				'nomor' => 5,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Keterlibatan civitas akademika dalam proses monitoring dan evaluasi LP2M ',
				'nomor' => 6,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Transparansi pendanaan kegiatan penelitian oleh LP2M',
				'nomor' => 7,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Transparansi pendanaan kegiatan pengabdian kepada masyarakat oleh LP2M',
				'nomor' => 8,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Peran roadmap penelitian LP2M dalam memayungi roadmap Prodi dan Dosen',
				'nomor' => 9,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Upaya LPPM dalam mendorong dan memfasilitasi proses perolehan hak kekayaan intelektual (HKI)',
				'nomor' => 10,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kinerja SIMPENMAS',
				'nomor' => 11,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kinerja/pelayanan pegawai LP2M dalam memfasilitasi kegiatan penelitian',
				'nomor' => 12,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kinerja/pelayanan pegawai LP2M dalam memfasilitasi kegiatan pengabdian kepada masyarakat',
				'nomor' => 13,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kinerja/pelayanan LP2M dalam diseminasi dan publikasi hasil penelitian dan pengabdian oleh civitas akademika',
				'nomor' => 14,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Kinerja/pelayanan LP2M dalam memfasilitasi Kerjasama Prodi dengan Instansi lain',
				'nomor' => 15,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
		);

		$kuesionerLP2M->pertanyaan()->createMany($pertanyaan_lp2m)->each(function ($item, $key) {
			$jawaban = [
				array(
					'jawaban' => 'Sangat Tidak Puas',
					'nilai' => 1,
					'created_at' => now(),
					'updated_at' => now(),
				),
				array(
					'jawaban' => 'Tidak Puas',
					'nilai' => 2,
					'created_at' => now(),
					'updated_at' => now(),
				),
				array(
					'jawaban' => 'Puas',
					'nilai' => 3,
					'created_at' => now(),
					'updated_at' => now(),
				),
				array(
					'jawaban' => 'Sangat Puas',
					'nilai' => 4,
					'created_at' => now(),
					'updated_at' => now(),
				),
			];
			$item->jawaban()->createMany($jawaban);
		});
	}

	public function createPertanyaanVisiMisi(KuesionerVisiMisi $kuesionerVisiMisi)
	{
		$pertanyaan_visi_misi = array(
			array(
				'pertanyaan' => 'Berapa lama Bpk/Ibu/Sdr/i sudah bergabung dengan Itenas?',
				'nomor' => 1,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Apakah Anda pernah membaca Visi, Misi dan Tujuan Itenas?',
				'nomor' => 2,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Jika jawaban No. 2 adalah Pernah, pilih semua media sumber Bpk/Ibu/Sdr/imendapatkan informasi tentang Visi, Misi dan Tujuan Itenas?',
				'nomor' => 3,
				'tipe' => 2,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Menurut Anda, Visi, Misi dan Tujuan telah tercermin pada',
				'nomor' => 4,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Visi Itenas',
				'nomor' => 5,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Misi Itenas',
				'nomor' => 6,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
			array(
				'pertanyaan' => 'Tujuan Itenas',
				'nomor' => 7,
				'tipe' => 1,
				'created_at' => now(),
				'updated_at' => now(),
			),
		);


		$kuesionerVisiMisi->pertanyaan()->createMany($pertanyaan_visi_misi)->each(function ($item, $key) {
			switch ($item->nomor) {
				case 1:
					$jawaban = [
						array(
							'jawaban' => '< 1 Tahun',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => '1-5 Tahun',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => '5-10 Tahun',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => '< 10 Tahun',
							'created_at' => now(),
							'updated_at' => now(),
						),
					];
					break;

				case 2:
					$jawaban = [
						array(
							'jawaban' => 'Pernah',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => 'Tidak Pernah',
							'created_at' => now(),
							'updated_at' => now(),
						),
					];
					break;

				case 3:
					$jawaban = [
						array(
							'jawaban' => 'URL https://itenas.ac.id',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => 'Buku panduan/pedoman',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => 'Poster/banner/youtube',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => 'Rapat-rapat rutin',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => 'Media Sosial',
							'created_at' => now(),
							'updated_at' => now(),
						),
					];
					break;
				case 4:
					$jawaban = [
						array(
							'jawaban' => 'Kurikulum',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => 'Proses pembelajaran',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => 'Penelitian dosen/mahasiswa',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => 'Pengabdian kepada masyarakat dosen/mahasiswa',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => 'Kompetensi dosen/tendik/mahasiswa',
							'created_at' => now(),
							'updated_at' => now(),
						),
					];
					break;
				default:
					$jawaban = [
						array(
							'jawaban' => 'Kurang Paham',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => 'Paham',
							'created_at' => now(),
							'updated_at' => now(),
						),
						array(
							'jawaban' => 'Sangat Paham',
							'created_at' => now(),
							'updated_at' => now(),
						),
					];
					break;
			}
			$item->jawaban()->createMany($jawaban);
		});
	}
}
