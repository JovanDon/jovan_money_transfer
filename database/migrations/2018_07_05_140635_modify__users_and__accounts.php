<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyUsersAndAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->string('bank_name')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_active')->default(true);
        });
 
		DB::table('users')->insert(array(
            'fname' => 'root',
            'lname' => 'root',
            'email' => 'admin@admin.com',
            'phonenumber' => '+256778878965',
            'country' => 'Uganda',
            'password' => Hash::make('admin123'),
            'created_by'=>null,
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('bank_name');
        });
        
    }
}
