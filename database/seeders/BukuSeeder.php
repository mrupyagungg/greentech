<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku; // Pastikan model Buku diimpor dengan benar

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 10; $i++) {
            Buku::create([
                'judul' => $faker->sentence, // Menggunakan $faker->sentence untuk judul
                'pengarang' => $faker->name, // Menggunakan $faker->name untuk pengarang
                'tanggal_publikasi' => $faker->date // Menggunakan $faker->date untuk tanggal terbit
            ]);
        }
    }
}
