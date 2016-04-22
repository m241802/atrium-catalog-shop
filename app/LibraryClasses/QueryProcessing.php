<?php namespace App\LibraryClasses;
use DB;
use Carbon\Carbon;
use App\LibraryClasses\VariableProcessing;
class QueryProcessing {
    public function baseInsert($name, $request)
    {
        $variableProcessing = new VariableProcessing;
        $request = $variableProcessing->requestProcessing($request);
        DB::table($name)->insert(
            array(
                'slug' => $request->slug,
                'title' => $request->title,
                'excerpt' => $request->excerpt,
                'content' => $request->content,
                'published_at' => $request->published_at,
                'images' => $request->images,
                'created_at' => Carbon::now('Europe/Moscow')->toDateTimeString()
            ));
    }
    public function baseUpdate($name, $request)
    {
        $variableProcessing = new VariableProcessing;
        $request = $variableProcessing->requestProcessing($request);
        DB::table($name)
            ->where('id', $request->id)
            ->update(array(
                'slug' => $request->slug,
                'title' => $request->title,
                'excerpt' => $request->excerpt,
                'content' => $request->content,
                'published_at' => $request->published_at,
                'published' => $request->published,
                'images' => $request->images,
                'updated_at' => Carbon::now('Europe/Moscow')->toDateTimeString()
            ));
    }

}