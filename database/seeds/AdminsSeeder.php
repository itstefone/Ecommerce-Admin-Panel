<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Admin::create([
            'name' => 'Stefan Aksentijevic',
            'email' => 'stef1rugby@gmail.com',
            'password' => bcrypt('password')
        ]);
    }
}
