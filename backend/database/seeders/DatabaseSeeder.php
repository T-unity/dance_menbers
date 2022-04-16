<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // \App\Models\User::factory(10)->create();
      // DB::table('users')->insert([
      //   'name' => Str::random(10),
      //   'email' => Str::random(10).'@example.com',
      //   'password' => Hash::make('password'),
      // ]);

      // 1,000件
      // User::factory()->count(1000)->create();
      // 10,000件
      // User::factory()->count(10000)->create();
      // 100,000件
      // User::factory()->count(100000)->create();
      // 1,000,000件
      // User::factory()->count(1000000)->create();
      // 10,000,000件
      // User::factory()->count(10000000)->create();
      // 100,000,000件
      // User::factory()->count(100000000)->create();
      // 1,000,000,000件
      // User::factory()->count(1000000000)->create();
    }
}
