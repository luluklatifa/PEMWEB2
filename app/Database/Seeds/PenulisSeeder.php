<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class PenulisSeeder extends Seeder
{
    public function run()
    {
        // $data = [
        //     [
        //         'name' => 'Yanti',
        //         'address' => 'Surabaya',
        //         'created_at' => Time::now(),
        //         'update_at' => Time::now()
        //     ],
        //     [
        //         'name' => 'Yanto',
        //         'address' => 'Jakarta',
        //         'created_at' => Time::now(),
        //         'update_at' => Time::now()
        //     ],
        //     [
        //         'name' => 'Yati',
        //         'address' => 'Jombang',
        //         'created_at' => Time::now(),
        //         'update_at' => Time::now()
        //     ]
        // ];
        //Simple Queries
        // $this->db->query('INSERT INTO penulis (name, address, created_at, update_at) VALUES (:name:, :address:, :created_at:, :update_at:)', $data);

        //Using Query Builder
        // $this->db->table('penulis')->insert($data);

        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 100; $i++) {

            $data = [
                'name' => $faker->name,
                'address' => $faker->address,
                'created_at' => Time::createFromTimestamp($faker->unixTime()),
                'update_at' => Time::now()
            ];
            $this->db->table('penulis')->insert($data);
        }
    }
}
