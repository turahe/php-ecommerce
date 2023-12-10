<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            \Turahe\Master\Seeds\CountriesTableSeeder::class,
            \Turahe\Master\Seeds\ProvincesTableSeeder::class,
            \Turahe\Master\Seeds\CitiesTableSeeder::class,
            \Turahe\Master\Seeds\DistrictsTableSeeder::class,
            //             \Turahe\Master\Seeds\VillagesTableSeeder::class,
            \Turahe\Master\Seeds\BanksTableSeeder::class,
            \Turahe\Master\Seeds\CurrenciesTableSeeder::class,
            \Turahe\Master\Seeds\LanguagesTableSeeder::class,
            RolesAndPermissionsSeeder::class,
            UserTableSeeder::class,
        ]);
    }
}
