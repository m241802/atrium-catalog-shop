<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\LibraryClasses\QueryProcessing;
class Faqs extends Model {
    public function getPublishedFaqs()
    {
        $faqs = Faqs::latest('published_at')->published()->get();
        return $faqs;
    }
    public function scopePublished($query){
        $query->where('published_at', '<=', Carbon::now());
    }
    public function getAllFaqs()
    {
        $faqs = Faqs::latest('published_at')->get();
        return $faqs;
    }
    public function scopeSingleFaq($slug)
    {
        $faq = DB::table('faqs')->where('slug', $slug)->get();
        return $faq;
    }
    public function createFaq($request)
    {
        $queryProcessing = new QueryProcessing;
        $queryProcessing->baseInsert('faqs', $request);
    }
    public function updateFaq($request)
    {
        $queryProcessing = new QueryProcessing;
        $queryProcessing->baseUpdate('faqs', $request);
    }
    public function deleteFaq($request)
    {
        DB::table('faqs')->where('id', '=', $request->id)->delete();
    }
}
