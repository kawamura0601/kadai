<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'age',
        'gender',
    ];

    // ↓↓↓↓↓↓↓↓↓↓↓↓ ここからstore使用メソッド ↓↓↓↓↓↓↓↓↓↓↓↓
    public static function storeValidate($request)
    {
        // 【注意】バリデーションでuniqueを使う時は、テーブル名も記載する必要がある。
        $inputs = $request->validate([
            'name' => 'required|unique:posts',
            'email' => 'required|email',
            'age' => 'required|regex:/^[1-9][0-9]+/|not_in:0',
            'gender' => 'required'
        ]);
    }

    public static function storePost($request, $post)
    {
        $post->name = $request->name;
        $post->email = $request->email;
        $post->age = $request->age;
        $post->gender = $request->gender;
        $post->save();
    }

    // ↑↑↑↑↑↑↑↑↑↑↑↑ ここまでstore使用メソッド ↑↑↑↑↑↑↑↑↑↑↑↑



    // ↓↓↓↓↓↓↓↓↓↓↓↓ ここからupdate使用メソッド ↓↓↓↓↓↓↓↓↓↓↓↓
    public static function updateValidate($request, $post)
    {
        // 名前の変更無し→重複チェックしない。　名前の変更有り→再度重複をチェックする。
        if($post->name === $request->name) {
            $inputs = $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'age' => 'required|regex:/^[1-9][0-9]+/|not_in:0',
                'gender' => 'required'
            ]);
        } else {
            $inputs = $request->validate([
                'name' => 'required|unique:posts',
                'email' => 'required|email',
                'age' => 'required|regex:/^[1-9][0-9]+/|not_in:0',
                'gender' => 'required'
            ]);
        }
    }

    public static function updatePost($request, $post)
    {
        $post->name = $request->name;
        $post->email = $request->email;
        $post->age = $request->age;
        $post->gender = $request->gender;

        // ↓updateの時はtokenをリセットする必要がある
        unset($post['_token']);

        $post->update();
    }

    // ↑↑↑↑↑↑↑↑↑↑↑↑ ここまでupdate使用メソッド ↑↑↑↑↑↑↑↑↑↑↑↑

}
