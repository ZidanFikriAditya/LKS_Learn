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

        $regional = new Regional();
        $regional->province = 'Jawa Timur';
        $regional->district = 'Ponorogo';
        $regional->save();


        $arr = [[
            'name' => 'Fillip',
            'card_num' => '97239218'
        ],
            [
                'name' => 'Audrey',
                'card_num' => '98234732'
            ],
            [
                'name'=>  'Marshel',
                'card_num'=>'96321263'
            ]];
        foreach ($arr as $key => $value)
        {
            $society = new Society();
            $society->name = $value['name'];
            $society->id_card_number = $value['card_num'];
            $society->password = md5('password');
            $society->born_date = date('Y-m-d');
            $society->gender = 'male';
            $society->regional_id = 1;
            $society->save();
        }
    }
}
