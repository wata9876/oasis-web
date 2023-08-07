<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

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
                'title' => 'Laravelでお問い合わせフォームを作成②',
                'url' => 'article.show5',
                'content' => '前回はtailblocksを使用してお問い合わせフォームのページ作成とバリデーションを実装しました。今回はサクラサーバーのメールアカウントを作成し、送信後にメールが送られる所までを記載しました。',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            
        ]);
    }
}
