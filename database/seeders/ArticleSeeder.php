<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('articles')->insert([
            [
                'title' => 'seederを使って初期データを登録する',
                'url' => 'article.show3',
                'content' => 'seederを使ってDBにデータを登録する手順をまとめました。',
            ],
            
        ]);
    }
}
