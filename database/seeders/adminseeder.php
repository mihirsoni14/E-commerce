<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'Mihir Soni',
            'email' => 'mihirsoni020@gmail.com',
            'role' => 2,
            'password' => '$2y$12$dY3M18KqR03DUNMNOs2sSeZugC1.2bAOhxUCK0zLr38qZA1JkF932',
        ]);
    }
}
