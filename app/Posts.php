<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\LibraryClasses\QueryProcessing;
class Posts extends Model {
    public function getPublishedPosts()
    {
        $posts = Posts::latest('published_at')->published()->get();
        return $posts;
    }
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now())/*->where('published', '=', 1)*/;
    }
    public function getAllPosts()
    {
        $posts = Posts::latest('published_at')->get();
        return $posts;
    }
    public function scopeSinglePost($slug)
    {
        $post = DB::table('posts')->where('slug', $slug)->get();
        return $post;
    }
    public function createPost($request)
    {
        $queryProcessing = new QueryProcessing;
        $queryProcessing->baseInsert('posts', $request);
    }
    public function updatePost($request)
    {
        $queryProcessing = new QueryProcessing;
        $queryProcessing->baseUpdate('posts', $request);
    }
    public function deletePost($request)
    {
        DB::table('posts')->where('id', '=', $request->id)->delete();
    }
}
