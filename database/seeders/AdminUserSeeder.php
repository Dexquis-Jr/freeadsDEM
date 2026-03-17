<?php

namespace Database\Seeders;



use App\Models\User;
use App\Mail\AdminCreatedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

    $password = 'admin';
        if (! User::where('role', 'admin')->exists()) {
          $admin =  User::create([
                'name' => 'Admin',
                'email' => 'ouffouetjunior95@gmail.com',
                'telephone' => '0506651167',
                'password' => Hash::make('$password'),
                'role' => 'admin',
            ]);

            Mail::to($admin->email)->send(new AdminCreatedMail($admin->name, $password));
        }
    }
}
