<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Accounts; 
use App\User;

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


      /*  for ($i=0; $i < 200; $i++) {
            $this->generateUser_and_5Receivers($faker);                      
        }*/

        for ($j=0; $j < 500; $j++){
            $this->generate_afake_transaction($faker);   
       }
        
    }
    public function generateUser_and_5Receivers($faker){
        $startDate = '-30 years';
        $endDate = 'now';
        $timezone = null;
        $DataToConsider=$faker->dateTimeBetween($startDate, $endDate, $timezone);

        $this->generate_afake_user($faker,$DataToConsider);
  
        for ($j=0; $j < 5; $j++){//generate 5 receivers  for existing random Users    
        
                $Existing_randomUser=$this->get_a_random_existingUser_id($faker);
                $this->generate_afake_receiver($faker,$Existing_randomUser,$DataToConsider);
        
                $this->generate_an_mm_and_a_bankAcct($faker,$Existing_randomUser,$DataToConsider);
        }
    }



    public function get_a_random_existingUser_id($faker){
        $existing_users_ids = User::all()->pluck('id')->toArray();
        $Existing_randomUser=$faker->randomElement($existing_users_ids);
        return $Existing_randomUser;
    }
    
    public function get_a_random_existingAccount_id($faker){
        $existing_ids = Accounts::all()->pluck('id')->toArray();
        $Existing_randomAccount=$faker->randomElement($existing_ids);
        return $Existing_randomAccount;
    }
    public function generate_an_mm_and_a_bankAcct($faker,$Existing_randomUser,$DataToConsider){
        for ($k=0; $k < 5; $k++){
            $this->generate_afake_Bankaccount($faker,$Existing_randomUser,$DataToConsider);
            $this->generate_afake_mmAccount($faker,$Existing_randomUser,$DataToConsider);
        }

    }
    
    public function generate_afake_user($faker,$DataToConsider){
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
    public function generate_afake_receiver($faker,$created_by,$DataToConsider){
        DB::table('users')->insert([
            'fname' => $faker->lastName ,
            'lname' =>  $faker->firstName ,
            'email' =>  $faker->freeEmail ,
            'phonenumber' =>  $faker->phonenumber,
            'country' => $faker->country,
            'password' => bcrypt('secret'),
            'created_by' => $created_by,
        ]);
    }

    public function generate_afake_Bankaccount($faker,$owner_id,$DataToConsider){
        $Banks = ["DFCU","Posta","Centenery","stanbic","Nile","Equity"];

        DB::table('accounts')->insert([
            'account_name' => $faker->name ,
            'account_type' =>  'bank_account' ,
            'account_number' =>  $faker->bankAccountNumber ,
            'user_id' => $owner_id,
            'created_at' => $DataToConsider ,
            'updated_at' => $DataToConsider ,
            'bank_name' => $faker->randomElement($Banks) ,
        ]);
    }

    public function generate_afake_mmAccount($faker,$owner_id,$DataToConsider){
        DB::table('accounts')->insert([
            'account_name' => $faker->name ,
            'account_type' =>  'mobile_money' ,
            'account_number' =>  $faker->phonenumber ,
            'user_id' => $owner_id,
            'created_at' => $DataToConsider ,
            'updated_at' => $DataToConsider ,
            'bank_name' => null ,
        ]);
    }

    public function generate_afake_transaction($faker){
        $startDate = '-30 years';
        $endDate = 'now';
        $timezone = null;

        $DataToConsider=$faker->dateTimeBetween($startDate, $endDate, $timezone);
        $senderAcct_id=$this->get_a_random_existingAccount_id($faker);
        $ReceiverAcct_id=$this->get_a_random_existingAccount_id($faker);
        $amount=$faker->numberBetween(1000, 900000);

        $this->insertTransaction($amount,$DataToConsider,$senderAcct_id,$ReceiverAcct_id);
    }

    public function insertTransaction($amount,$DataToConsider,$senderAcct_id,$ReceiverAcct_id){
        DB::table('transactions')->insert([            
            'amount' =>  $amount ,
            'sender_account' => $senderAcct_id,
            'reciever_account' => $ReceiverAcct_id ,
            'created_at' => $DataToConsider ,
        ]);
    }
    
}
