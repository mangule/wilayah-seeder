<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);
        // $this->call(ProvinsiTableSeeder::class);
        // $this->call(KabupatenTableSeeder::class);
        // $this->call(KecamatanTableSeeder::class);
        // $this->call(DesaTableSeeder::class);

        $this->call(RefWilDesaTableSeeder::class);
        $this->call(RefWilKecamatanTableSeeder::class);
        $this->call(RefWilKabupatenTableSeeder::class);
        $this->call(RefWilProvinsiTableSeeder::class);
    }
}
