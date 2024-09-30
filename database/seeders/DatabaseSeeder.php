<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Picture;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
        ]);
        
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);

        Picture::factory(3)->create();

    }
}