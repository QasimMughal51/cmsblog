<?php

use Illuminate\Database\Seeder;

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
            'site_name'=>'IT Information Edge',
            'address'=>'Gujranwala, Pakistan',
            'contact_no'=>'0348-4304716',
            'email'=>'Qasim@Blog.com'
        ]);
    }
}
