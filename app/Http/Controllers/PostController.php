<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Post;

class PostController extends Controller
{
    /*--- 一覧ページ ---*/
    public function index()
    {
        // 投稿順で5件表示
        $posts = Post::where('delete_flg',0)->orderByRaw('postdate desc , created_at desc')->paginate(5);

        return view('posts.index', compact('posts'));
    }

    /*--- 新規投稿ページ ---*/
    Public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'year'  => 'required|string|digits:4',
            'month' => 'required|integer|between:1,12',
            'day'   => 'required|integer|between:1,31',
            'body'  => 'required',
            'image' => 'image|mimes:jpeg|max:2048',
        ]);

        $post           = new Post();
        $post->postdate = $request->input('year') . "-" . $request->input('month') . "-" . $request->input('day');
        $post->body     = $request->input('body');

        if ($request->hasFile('image')) {
            // インサートIDと画像名を同期するためPostsテーブルから最終id+1を取得
            $postid      = Post::max('id') + 1;
            $filename    = $postid .".jpg";
            $imagePath   = $request->file('image')->storeAs('uploads', $filename ,'public');
            $post->image = $imagePath;
        } else {
            $post->image = NULL;
        }

        // 投稿時は表示
        $post->delete_flg = 0; 

        $post->save();

        return redirect()->route('posts.index')->with('success', '投稿しました');
    }

    public function edit(Post $post)
    {
        // Viewに渡す前に日付けを加工
        $postdate    = explode("-",$post->postdate);
        $post->year  = $postdate[0];
        $post->month = $postdate[1];
        $post->day   = $postdate[2];

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'year'  => 'required|string|digits:4',
            'month' => 'required|integer|between:1,12',
            'day'   => 'required|integer|between:1,31',
            'body'  => 'required',
            'image' => 'image|mimes:jpeg|max:2048',
        ]);

        $post->postdate = $request->input('year') . "-" . $request->input('month') . "-" . $request->input('day');
        $post->body     = $request->input('body');

        if ($request->hasFile('image')) {
            // 既存画像削除
            Storage::disk('public')->delete($post->image);

            // IDと画像名を同期するため画像名を変更
            $filename    = $post->id .".jpg";
            $imagePath   = $request->file('image')->storeAs('uploads', $filename ,'public');
            $post->image = $imagePath;
        } else {
            $post->image = NULL;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', '編集しました');
    }

    public function destroy(Post $post)
    {
        // 投稿削除フラグをたてる
        $post->delete_flg = 1;
        $post->save();

        return redirect()->route('posts.index')->with('success', '削除しました');
    }

}
