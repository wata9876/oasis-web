<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
    ];

    /**
     * タイトル取得
     *
     * @var array<string, string>
     */
    public static function getTitle($id)
    {
        $title = Article::find($id, ['title', 'content']);
        return $title;
    }

}
