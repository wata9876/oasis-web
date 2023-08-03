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
                'title' => 'Laravelでお問い合わせフォームを作成',
                'url' => 'article.show4',
                'content' => 'お問い合わせフォームを作成し、Gmailと連携が出来るように実装しました。デザインはtailblocksを使用しています。tailblocksはヘッダーや本文のレイアウトやお問い合わせフォームなどのデザインがテンプレートとして用意されており、気軽に利用出来るので便利です。今回はtailblocksのテンプレートを利用してお問い合わせフォームを作成しましたので、その使い方も含めてまとめました。',
            ],
            
        ]);
    }
}
