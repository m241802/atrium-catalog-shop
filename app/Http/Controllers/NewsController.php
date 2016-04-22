<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\News;
use App\Files;
use App\Categories;
use Illuminate\Http\Request;

class NewsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(News $newsModel, Categories $categoriesModel, Files $filesModel)
    {
        $news = $newsModel->getAllNews();
        $news = $filesModel->get_files_with_size($news);
        $cats = $categoriesModel->get_cats_parent('');
        return view('post.news', ['news' => $news, 'cats' => $cats]);
    }
    public function admin_loop(News $newsModel)
    {
        $news = $newsModel->getAllNews();
        return view('admin.news.news', ['news' => $news]);
    }


    public function single(News $newsModel, $slug, Categories $categoriesModel, Files $filesModel)
    {
        $post = $newsModel->scopeSingleNew($slug);
        $cats = $categoriesModel->get_cats_parent('');
        $post = $filesModel->get_files_with_size($post);
        return view('post.new', ['new' => $post, 'cats' => $cats]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Files $filesModel)
    {
        $images = $filesModel->getImages();
        return view('admin.news.new-create', ['images' => $images]);
    }
    public function store(Files $filesModel, News $newsModel, Request $request)
    {
        if($request->files->has('images')){
            $request->files = $filesModel->insert_files($request->files->all()['images']);
        }
        $newsModel->createNew($request);
        return redirect()->route('admin.news');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(News $newsModel, $slug, Files $filesModel)
    {
        $post = $newsModel->scopeSingleNew($slug);
        $post = $filesModel->get_files_with_size($post);
        return view('admin.news.new-edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function  update(Files $filesModel, News $newsModel, Request $request)
    {        
        if($request->files->has('images')){
            $request->files = $filesModel->insert_files($request->files->all()['images']);
        }
        $newsModel->updateNew($request);
        return redirect()->route('admin.news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(News $newsModel, Request $request)
    {
        $newsModel->deleteNew($request);
        return redirect()->route('admin.news');
    }

}
