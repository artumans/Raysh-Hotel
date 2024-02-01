<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TamuSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i=0; $i < 10; $i++) {
            $data = [
                'nama' => $faker->name(),
                'email'    => $faker->email(),
                'no_telepon' => $faker->phoneNumber(),
                'alamat' => $faker->address(),
                'password' => $faker->password(8,10),
            ];
    
            $this->db->table('tb_tamu')->insert($data);
        }
    }
}