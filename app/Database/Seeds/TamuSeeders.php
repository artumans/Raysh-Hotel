<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;


class TamuSeeders extends Seeder
{

    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 0; $i < 5; $i++) {
            $data =  
                [
                    'nama'             =>    $faker->name,
                    'email'            =>    $faker->email,
                    'password'         =>    $faker->password(8, 10),
                    'no_telepon'       =>    $faker->phoneNumber,
                ];
            $this->db->table('tb_admin')->insert($data);
        }
    }
}
