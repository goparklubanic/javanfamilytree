<?php

namespace Database\Seeders;

use App\Models\Keluarga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class keluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $keluarga=[
            ['id'=>1,'parentId'=>0,'generasiKe'=>0,'urutKe'=>0,'nama'=>'Budi','jnKelamin'=>'Laki-laki'],
            ['id'=>2,'parentId'=>1,'generasiKe'=>1,'urutKe'=>1,'nama'=>'Dedi','jnKelamin'=>'Laki-laki'],
            ['id'=>3,'parentId'=>1,'generasiKe'=>1,'urutKe'=>2,'nama'=>'Dodi','jnKelamin'=>'Laki-laki'],
            ['id'=>4,'parentId'=>1,'generasiKe'=>1,'urutKe'=>3,'nama'=>'Dede','jnKelamin'=>'Laki-laki'],
            ['id'=>5,'parentId'=>1,'generasiKe'=>1,'urutKe'=>4,'nama'=>'Dewi','jnKelamin'=>'Perempuan'],
            ['id'=>6,'parentId'=>2,'generasiKe'=>2,'urutKe'=>1,'nama'=>'Feri','jnKelamin'=>'Laki-laki'],
            ['id'=>7,'parentId'=>2,'generasiKe'=>2,'urutKe'=>2,'nama'=>'Farah','jnKelamin'=>'Perempuan'],
            ['id'=>8,'parentId'=>3,'generasiKe'=>2,'urutKe'=>1,'nama'=>'Gugus','jnKelamin'=>'Laki-laki'],
            ['id'=>9,'parentId'=>3,'generasiKe'=>2,'urutKe'=>2,'nama'=>'Gandi','jnKelamin'=>'Laki-laki'],
            ['id'=>10,'parentId'=>4,'generasiKe'=>2,'urutKe'=>1,'nama'=>'Hani','jnKelamin'=>'Perempuan'],
            ['id'=>11,'parentId'=>4,'generasiKe'=>2,'urutKe'=>2,'nama'=>'Hana','jnKelamin'=>'Perempuan']
        ];

        keluarga::insert($keluarga);

    }
}
