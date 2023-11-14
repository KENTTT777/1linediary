<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $param = [
            'name' => 'サンプル',
            'body' => 'テストテスト',
            'image' => '/storage/app/public/1/150x150.png',
        ];
        DB::table('posts')->insert($param);
    }
}
