<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\LibraryClasses\QueryProcessing;
class News extends Model {
    public function mbCutString($str, $length, $postfix='...', $encoding='UTF-8')
    {
        $str = strip_tags($str);
        if (mb_strlen($str, $encoding) <= $length) {
            return $str;
        }             
        $tmp = mb_substr($str, 0, $length, $encoding);
        return mb_substr($tmp, 0, mb_strripos($tmp, ' ', 0, $encoding), $encoding) . $postfix;
    }
    public function getPublishedNews()
    {
        $news = News::latest('published_at')->published()->get();
        return $news;
    }
    public function scopePublished($query){
        $query->where('published_at', '<=', Carbon::now());
    }
    public function getAllNews()
    {
        $news = DB::table('news')->orderBy('id', 'ABS')->select('id','title','slug','images','excerpt', DB::raw('DATE_FORMAT(published_at, "%d.%m.%Y") as published_at'))->paginate(5);
        return $news;
    }
    public function getNewsOnHome()
    {
        $news = DB::table('news')->orderBy('id', 'ABS')->select('id','title','slug','images', DB::raw('DATE_FORMAT(published_at, "%d.%m.%Y") as published_at'))->take(4)->get();
        return $news;
    }
    public function scopeSingleNew($slug)
    {
        $new = DB::table('news')->select('id','title','slug','images','content', DB::raw('DATE_FORMAT(published_at, "%d.%m.%Y") as published_at'))->where('slug', $slug)->get();
        return $new;
    }
    public function createNew($request)
    {
        $queryProcessing = new QueryProcessing;
        $queryProcessing->baseInsert('news', $request);
    }
    public function updateNew($request)
    {
        $queryProcessing = new QueryProcessing;
        $queryProcessing->baseUpdate('news', $request);
    }
    public function deleteNew($request)
    {
        DB::table('news')->where('id', '=', $request->id)->delete();
    }
}
