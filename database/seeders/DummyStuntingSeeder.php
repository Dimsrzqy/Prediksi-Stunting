<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ProfilIbu;
use App\Models\Anak;
use App\Models\Prediksi;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DummyStuntingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Hapus data lama (opsional, tapi disarankan agar rapi)
        // User::where('role', 'user')->delete();
        // ProfilIbu::truncate();
        // Anak::truncate();
        // Prediksi::truncate();

        echo "Membuat 20 User Ibu...\n";

        for ($i = 0; $i < 20; $i++) {
            // 1. Buat Akun User
            $namaIbu = $faker->firstNameFemale . ' ' . $faker->lastName;
            $user = User::create([
                'name' => $namaIbu,
                'no_hp' => '08' . $faker->randomNumber(9, true),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'role' => 'user'
            ]);

            // 2. Buat Profil Ibu
            $profilIbu = ProfilIbu::create([
                'user_id' => $user->id,
                'nama_ibu' => $namaIbu,
                'usia_ibu' => $faker->numberBetween(20, 40),
                'tinggi_ibu' => $faker->numberBetween(145, 170),
                'pendidikan_ibu' => $faker->randomElement(['SMA', 'D3', 'S1', 'SMP']),
                'pekerjaan_ibu' => $faker->randomElement(['Ibu Rumah Tangga', 'Karyawan Swasta', 'PNS', 'Wiraswasta'])
            ]);

            // 3. Buat 1 atau 2 Anak per Ibu
            $jumlahAnak = $faker->numberBetween(1, 2);
            for ($j = 0; $j < $jumlahAnak; $j++) {
                $jk = $faker->randomElement(['L', 'P']);
                $tglLahirAnak = $faker->dateTimeBetween('-4 years', '-6 months');
                $umurBulan = Carbon::parse($tglLahirAnak)->diffInMonths(now());

                $tbLahir = $faker->randomFloat(1, 45, 52);
                // Simulasi pertumbuhan tinggi berdasarkan umur (kasar)
                $tbSekarang = $tbLahir + ($umurBulan * $faker->randomFloat(1, 0.5, 1.2));

                $anak = Anak::create([
                    'user_id' => $user->id,
                    'id_ibu' => $profilIbu->_id ?? $profilIbu->id,
                    'nik' => '35' . $faker->randomNumber(8, true) . $faker->randomNumber(4, true),
                    'nama_anak' => $faker->firstName($jk === 'L' ? 'male' : 'female') . ' ' . $faker->lastName,
                    'tgl_lahir' => $tglLahirAnak->format('Y-m-d'),
                    'jenis_kelamin' => $jk,
                    'tb_lahir' => $tbLahir,
                    'tinggi_badan' => round($tbSekarang, 1),
                    'tgl_pemeriksaan' => $faker->dateTimeBetween('-1 months', 'now')->format('Y-m-d')
                ]);

                // 4. Buat Riwayat Prediksi (1-3 prediksi per anak)
                $jumlahPrediksi = $faker->numberBetween(1, 3);
                for ($k = 0; $k < $jumlahPrediksi; $k++) {
                    $statusArr = ['Normal', 'Normal', 'Normal', 'Stunting', 'Sangat Stunting', 'Tinggi', 'Berisiko'];
                    $status = $faker->randomElement($statusArr);
                    
                    Prediksi::create([
                        'id_anak' => $anak->_id ?? $anak->id,
                        'hasil_prediksi' => $status,
                        'label_sistem' => $status,
                        'probabilitas' => $faker->randomFloat(2, 0.75, 0.99),
                        'tanggal_prediksi' => Carbon::parse($tglLahirAnak)->addMonths($k * 2)->format('Y-m-d'),
                        'rekomendasi_ai' => "Berikan asupan bergizi seimbang yang mengandung protein hewani seperti telur, ikan, atau ayam. Pastikan juga asupan vitamin dari sayur dan buah.",
                        'rekomendasi_data' => [
                            [
                                "judul" => "Bubur " . $faker->randomElement(['Ayam', 'Ikan Gabus', 'Hati Ayam']),
                                "waktu" => "30 menit",
                                "kalori" => $faker->numberBetween(100, 300) . " kkal"
                            ],
                            [
                                "judul" => "Puree " . $faker->randomElement(['Pisang', 'Alpukat', 'Brokoli']),
                                "waktu" => "15 menit",
                                "kalori" => $faker->numberBetween(80, 150) . " kkal"
                            ]
                        ]
                    ]);
                }
            }
        }

        echo "Selesai! Dummy data Ibu, Anak, dan Prediksi telah ditambahkan.\n";
    }
}
