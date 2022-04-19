<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
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

      $start = hrtime(true); // 計測開始時間

      // 100件
      User::factory()->count(100)->create();
      Post::factory()->count(500)->create();

      // 1,000件
      // User::factory()->count(1000)->create();
      // 10,000件
      // User::factory()->count(10000)->create();
      // 100,000件
      // User::factory()->count(100000)->create();

      $end = hrtime(true);
      $sec = ($end - $start) / 1000000000;
      echo '処理時間:'. $sec .'秒' . PHP_EOL;

      exit;

    }
}
