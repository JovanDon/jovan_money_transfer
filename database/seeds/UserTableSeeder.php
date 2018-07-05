<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i=0; $i < 200; $i++) {
           $this->generate_afake_user($faker);

           for ($j=0; $j < 5; $j++){//generate 5 receivers for each user
                $this->generate_afake_receiver($faker,$i);
           }
           
        }

    }

    public function generate_afake_user($faker){
        DB::table('users')->insert([
            'fname' => $faker->lastName ,
            'lname' =>  $faker->firstName ,
            'email' =>  $faker->freeEmail ,
            'phonenumber' =>  $faker->phonenumber,
            'country' => $faker->country,
            'password' => bcrypt('secret'),
            'created_by' => null,
        ]);
    }
    public function generate_afake_receiver($faker,$i){
        DB::table('users')->insert([
            'fname' => $faker->lastName ,
            'lname' =>  $faker->firstName ,
            'email' =>  $faker->freeEmail ,
            'phonenumber' =>  $faker->phonenumber,
            'country' => $faker->country,
            'password' => bcrypt('secret'),
            'created_by' => $i,
        ]);
    }
    
    
}
