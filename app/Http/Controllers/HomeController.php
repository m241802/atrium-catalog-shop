<?php namespace App\Http\Controllers;
use App\Files;
use App\Categories;
use App\Products;
use App\Slider;
use App\News;
use Illuminate\Http\Request;
class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
/*	public function __construct()
	{
		$this->middleware('auth');
	}*/

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index(Categories $categoriesModel, Files $filesModel, Products $productsModel, Slider $sliderModel, News $newsModel)
	{
		$cats = $categoriesModel->get_cats_parent('');
        $products = $categoriesModel->getOnlyParents();
        $products = $filesModel->get_files_with_size($products);
        $news = $newsModel->getNewsOnHome();
        $news = $filesModel->get_files_with_size($news);
        $slides = $sliderModel->getSlides();
        $slides = $filesModel->get_files_with_size($slides);      
		return view('home', ['products' => $products, 'cats' => $cats, 'slides' => $slides, 'news' => $news]);
	}
	public function searchResult(Categories $categoriesModel, Files $filesModel, Products $productsModel, Request $request)
    {
		$cats = $categoriesModel->get_cats_parent('');		
        $products = $productsModel->getSearchResult($request->search, $filesModel);               
        return view('post.shop', ['products' => $products, 'cats' => $cats, 'on_page' => 'shop']);
	}
    public function parser()
    {
        return view('post.parser');
    }
    public function handlerParser()
    {

    }


}
