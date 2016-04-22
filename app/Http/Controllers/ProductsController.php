<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Products;
use App\Files;
use App\Categories;
use Illuminate\Http\Request;

class ProductsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Products $productsModel, Categories $categoriesModel, Files $filesModel)
    {
        $cats = $categoriesModel->get_cats_parent('');
        $products = $productsModel->getAllProducts(60);
        $products = $filesModel->get_files_with_size($products);
        $on_page = 'shop';
        return view('post.shop', ['products' => $products, 'cats' => $cats, 'on_page' => $on_page]);
    }
    public function admin_loop(Products $productsModel, Files $filesModel)
    {
        $this->middleware('auth');
        $products = $productsModel->getAllProducts(61);
        $products = $filesModel->get_files_with_size($products);
        return view('admin.products.products', ['products' => $products]);
    }
    public function single(Products $productsModel, $slug, Categories $categoriesModel, Files $filesModel)
    {
        $cats = $categoriesModel->get_cats_parent('');
        $post = $productsModel->scopeProduct($slug);        
        $post = $filesModel->get_files_with_size($post);     
        return view('post.product', ['post' => $post, 'cats' => $cats]);
    }
    /**
     * Show the form for creating a product resource.
     *
     * @return Response
     */
    public function create(Files $filesModel)
    {
        $images = $filesModel->getImages();
        return view('admin.products.product-create', ['images' => $images]);
    }
    public function store(Products $productsModel, Request $request, Files $filesModel)
    {
        if($request->files->has('images')){
            $request->files = $filesModel->insert_files($request->files->all()['images']);
        }
        $productsModel->createProduct($request);
        return redirect()->route('admin.shop');
    }
    public function filterProducts(Products $productsModel, Request $request)
    { 
        $products = $productsModel->filterProducts($request->attrs, 61);
        return response()->json($products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Products $productsModel, $slug, Files $filesModel)
    {
        $post = $productsModel->scopeProduct($slug);           
        $post = $filesModel->get_files_with_size($post);       
        return view('admin.products.product-edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function  update(Products $productsModel, Request $request, Files $filesModel)
    {        
        if($request->files->has('images')){
            $request->files = $filesModel->insert_files($request->files->all()['images']);
        }
        $productsModel->updateProduct($request);
        return redirect()->route('admin.shop');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Products $productsModel, Request $request)
    {
        $productsModel->deleteProduct($request);
        return redirect()->route('admin.products.shop');
    }

}
