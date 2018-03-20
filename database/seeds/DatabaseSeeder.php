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
     $user = App\User::create([

            'email'=>'admin@blog.com',
            'password'=> bcrypt('admin'),
            'name'=>'Qasim',
            'admin'=> 1

        ]);
     App\Profile::create([

         'user_id'=>$user->id,
         'avatar'=>'1.png',
         'bio'=>'I am student of Laravel',
         'facebook'=>'http:\\\\www.facebook.com\QasimMughal'

     ]);
    }
}

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([
            'site_name'=>'Blog',
            'address'=>'Gujranwala, Pakistan',
            'contact_no'=>'0348-4304716',
            'email'=>'Blog@example.com'
        ]);
    }
}


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
