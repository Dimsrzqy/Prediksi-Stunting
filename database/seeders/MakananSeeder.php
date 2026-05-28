<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Makanan;
use App\Models\Nutrisi;

class MakananSeeder extends Seeder
{
    public function run()
    {
        // 1. Bersihkan tabel agar tidak terjadi penumpukan saat seeding ulang
        Makanan::truncate();

        // 2. Ambil master data nutrisi dari database untuk pencocokan ID
        $masterNutrisi = Nutrisi::all()->pluck('_id', 'nama_nutrisi')->toArray();

        // 3. Daftar 70 Makanan Unik (Tanpa Duplikat) beserta 1 Nutrisi Dominan Utama (Garis Besar)
        $dataset = [
            ["nama" => "Nasi Putih", "nutrisi" => "Karbohidrat"],
            ["nama" => "Nasi Merah", "nutrisi" => "Karbohidrat"],
            ["nama" => "Kentang Rebus", "nutrisi" => "Karbohidrat"],
            ["nama" => "Ubi Jalar", "nutrisi" => "Karbohidrat"],
            ["nama" => "Singkong Rebus", "nutrisi" => "Karbohidrat"],
            ["nama" => "Jagung Rebus", "nutrisi" => "Karbohidrat"],
            ["nama" => "Oatmeal", "nutrisi" => "Karbohidrat"],
            ["nama" => "Roti Gandum", "nutrisi" => "Karbohidrat"],
            ["nama" => "Bubur Beras", "nutrisi" => "Karbohidrat"],
            ["nama" => "Mie Telur Rebus", "nutrisi" => "Karbohidrat"],

            ["nama" => "Telur Ayam Rebus", "nutrisi" => "Protein Hewani"],
            ["nama" => "Dada Ayam Rebus", "nutrisi" => "Protein Hewani"],
            ["nama" => "Hati Ayam", "nutrisi" => "Protein Hewani"],
            ["nama" => "Ikan Lele", "nutrisi" => "Protein Hewani"],
            ["nama" => "Ikan Nila", "nutrisi" => "Protein Hewani"],
            ["nama" => "Ikan Salmon", "nutrisi" => "Protein Hewani"],
            ["nama" => "Daging Sapi Tanpa Lemak", "nutrisi" => "Protein Hewani"],
            ["nama" => "Udang Rebus", "nutrisi" => "Protein Hewani"],
            ["nama" => "Ikan Tuna", "nutrisi" => "Protein Hewani"],
            ["nama" => "Ikan Kembung", "nutrisi" => "Protein Hewani"],

            ["nama" => "Tempe Kukus", "nutrisi" => "Protein Nabati"],
            ["nama" => "Tahu Putih", "nutrisi" => "Protein Nabati"],
            ["nama" => "Kacang Merah", "nutrisi" => "Protein Nabati"],
            ["nama" => "Kacang Hijau", "nutrisi" => "Protein Nabati"],
            ["nama" => "Edamame", "nutrisi" => "Protein Nabati"],
            ["nama" => "Kacang Tanah Rebus", "nutrisi" => "Protein Nabati"],
            ["nama" => "Susu Kedelai", "nutrisi" => "Protein Nabati"],
            ["nama" => "Oncom", "nutrisi" => "Protein Nabati"],
            ["nama" => "Kacang Polong", "nutrisi" => "Protein Nabati"],
            ["nama" => "Lentil", "nutrisi" => "Protein Nabati"],

            ["nama" => "Bayam", "nutrisi" => "Sayuran"],
            ["nama" => "Wortel", "nutrisi" => "Sayuran"],
            ["nama" => "Brokoli", "nutrisi" => "Sayuran"],
            ["nama" => "Labu Kuning", "nutrisi" => "Sayuran"],
            ["nama" => "Buncis", "nutrisi" => "Sayuran"],
            ["nama" => "Kembang Kol", "nutrisi" => "Sayuran"],
            ["nama" => "Tomat", "nutrisi" => "Sayuran"],
            ["nama" => "Sawi Hijau", "nutrisi" => "Sayuran"],
            ["nama" => "Daun Katuk", "nutrisi" => "Sayuran"],
            ["nama" => "Timun", "nutrisi" => "Sayuran"],

            ["nama" => "Pisang", "nutrisi" => "Buah"],
            ["nama" => "Pepaya", "nutrisi" => "Buah"],
            ["nama" => "Apel", "nutrisi" => "Buah"],
            ["nama" => "Jeruk", "nutrisi" => "Buah"],
            ["nama" => "Mangga", "nutrisi" => "Buah"],
            ["nama" => "Alpukat", "nutrisi" => "Buah"],
            ["nama" => "Semangka", "nutrisi" => "Buah"],
            ["nama" => "Pir", "nutrisi" => "Buah"],
            ["nama" => "Melon", "nutrisi" => "Buah"],
            ["nama" => "Jambu Biji", "nutrisi" => "Buah"],

            ["nama" => "Susu UHT Full Cream", "nutrisi" => "Susu & Olahan"],
            ["nama" => "Yogurt Plain", "nutrisi" => "Susu & Olahan"],
            ["nama" => "Keju Cheddar", "nutrisi" => "Susu & Olahan"],
            ["nama" => "Susu Formula", "nutrisi" => "Susu & Olahan"],
            ["nama" => "Greek Yogurt", "nutrisi" => "Susu & Olahan"],
            ["nama" => "Keju Mozzarella", "nutrisi" => "Susu & Olahan"],
            ["nama" => "Susu Kambing", "nutrisi" => "Susu & Olahan"],
            ["nama" => "Susu Oat", "nutrisi" => "Susu & Olahan"],
            ["nama" => "Kefir", "nutrisi" => "Susu & Olahan"],
            ["nama" => "Keju Cottage", "nutrisi" => "Susu & Olahan"],

            ["nama" => "Alpukat Halus", "nutrisi" => "Lemak Sehat"],
            ["nama" => "Minyak Zaitun", "nutrisi" => "Lemak Sehat"],
            ["nama" => "Selai Kacang", "nutrisi" => "Lemak Sehat"],
            ["nama" => "Chia Seed", "nutrisi" => "Lemak Sehat"],
            ["nama" => "Biji Wijen", "nutrisi" => "Lemak Sehat"],
            ["nama" => "Kelapa Parut", "nutrisi" => "Lemak Sehat"],
            ["nama" => "Santan Encer", "nutrisi" => "Lemak Sehat"],
            ["nama" => "Biji Labu", "nutrisi" => "Lemak Sehat"],
            ["nama" => "Biji Bunga Matahari", "nutrisi" => "Lemak Sehat"],
            ["nama" => "Mentega Unsalted", "nutrisi" => "Lemak Sehat"]
        ];

        // 4. Masukkan data ke MongoDB 
        foreach ($dataset as $item) {
            $namaNutrisi = $item['nutrisi'];

            // Cocokkan dengan ID MongoDB
            $nutrisiId = isset($masterNutrisi[$namaNutrisi]) ? $masterNutrisi[$namaNutrisi] : null;

            if ($nutrisiId) {
                Makanan::create([
                    'nama_makanan' => $item['nama'],
                    'id_nutrisi'   => (string) $nutrisiId,
                    'deskripsi'    => 'Menu sumber ' . $namaNutrisi . ' sebagai asupan gizi utama.'
                ]);
            }
        }
    }
}
