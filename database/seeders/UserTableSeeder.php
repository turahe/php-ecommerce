<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@example.com'
        ])->assignRole('super-admin');
        User::factory(10)->create()->each(function (User $user) {
            $team = Team::factory()->create(['user_id' => $user->id]);
//            setPermissionsTeamId($team->id); // needs team_id for session instance of user
            $user->assignRole('user');
        });
    }
}
