<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Society;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $arr = [
            [
                'name' => 'Zidan Fikri Aditya',
                'id_card_number' => '00000001',
                'password' => md5('password')
            ],
            [
                'name' => 'Anang Damario',
                'id_card_number' => '00000002',
                'password' => md5('password')
            ],
            [
                'name' => 'LocalHost',
                'id_card_number' => '00000003',
                'password' => md5('password')
            ],
        ];

        foreach ($arr as $k => $val){
            $user = new Society();
            $user->id_card_number = $val['id_card_number'];
            $user->password = $val['password'];
            $user->name = $val['name'];
            $user->save();
        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
