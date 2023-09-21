<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name'    => 'mona',
            'last_name'     => 'abod',
            'status'        => 'admin',
            'phone'         => '01016052283',
            'email'         => 'monaabdo88@gmail.com',
            'password'      => bcrypt('12122005')
        ]);

    }
}
