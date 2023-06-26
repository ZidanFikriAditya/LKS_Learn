<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Regional;
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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $regionals = [
            [
                'province' => 'Jawa Timur',
                'district' => 'Indonesia'
            ],
            [
                'province' => 'Jawa Tengah',
                'district' => 'Indonesia'
            ],
        ];

        foreach ($regionals as $key => $val){
            $regional = new Regional();
            $regional->province = $val['province'];
            $regional->district = $val['district'];
            $regional->save();
        }

        $arr = [
            [
                'card_num' => '00000001',
                'name' => 'Admin'
            ],
            [
                'card_num' => '3827379',
                'name' => 'Wahyu'
            ],
        ];

        foreach ($arr as $key => $val){
            $society = new Society();
            $society->id_card_number = $val['card_num'];
            $society->name = $val['name'];
            $society->password = md5('password');
            $society->born_date = date('Y-m-d');
            $society->regional_id = 1;
            $society->gender = 'male';
            $society->save();
        }
    }
}
