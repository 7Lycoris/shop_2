<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i <50 ; $i++) { 
      		DB::table('user')->insert([
      			'username'=> str_random(7),
      			'password'=> Hash::make(123456),
      			'email'=> str_random(6).'@163.com',
      			'phone'=> '13'.rand(111111111,999999999),
      			'profile'=> '/upload/admin/L3O4iTdzKg.jpg',
      			'status'=> 0
      		]);
        }
    }


}
