<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        $admins = [
            [
                'name' => 'LESDE',
                'email' => 'empex.lesde@gmail.com',
                'password' => 'empl0ymentExch@nge',
            ],
            [
                'name' => 'MSeGS',
                'email' => 'admin@email.com',
                'password' => 'password',
            ]
        ];
        foreach ($admins as $admin) {
            $ad = new Admin();
            $ad->role_id = 1;
            $ad->name = $admin['name'];
            $ad->email = $admin['email'];
            $ad->is_approved = 1;
            $ad->password = $admin['password'];
            $ad->active = 1;
            $ad->save();
        }
    }
}
