<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Files;
use App\Categories;
use Illuminate\Http\Request;
use App\Products;

class CategoriesController extends Controller {

    /**
     * Handler Create Category
     *
     * @return Response
     */
    public function create(Files $filesModel)
    {
        $images = $filesModel->getImages();
        return view('admin.products-categories.category-create', ['images' => $images]);
    }
    public function hc_category(Files $filesModel, Categories $categoriesModel, Request $request)
    { 
        if($request->files->has('images')){
            $request->files = $filesModel->insert_files($request->files->all()['images']);
        }
        $categoriesModel->hc_category($request);
        $cats = $categoriesModel->get_categories();
        $cats = $filesModel->getMFilesBy($cats);
        return view('admin.products-categories.categories', ['cats' => $cats ]);
    }
    public function hu_category(Files $filesModel, Categories $categoriesModel, Request $request)
    {       
        if($request->files->has('images')){
            $request->files = $filesModel->insert_files($request->files->all()['images']);
        }        
        $categoriesModel->hu_category($request);
        return redirect()->route('admin.categories');
    }
    public function get_categories(Categories $categoriesModel)
    {
        $cats = $categoriesModel->get_cats_parent('');
        return view('admin.products-categories.categories', ['cats' => $cats ]);
    }
    public function get_category(Files $filesModel, Categories $categoriesModel, $slug)
    {        
        $cat = $categoriesModel->get_category($slug); 
        $cats = $categoriesModel->whereNotInCategories($cat[0]->id, $cat['id_cats']);       
        $rest_cats = json_encode($cat['id_cats']);
        unset($cat['id_cats']);
        if($cat[0]->images){
            $cat = $filesModel->get_files_with_size($cat);
        }
        else {
            $cat[0]->rest_images = $filesModel->wereNoInFiles($cat);
        }
        return view('admin.products-categories.category-edit', ['cat' => $cat, 'cats' => $cats, 'rest_cats' => $rest_cats]);
    }
    public function ajaxNotInCats(Categories $categoriesModel, Request $request)
    { 
        $cats = $categoriesModel->ajaxNotInCats($request->cats);
        return response()->json($cats);
    }

    public function get_products_category(Products $productsModel, Categories $categoriesModel, $slug, Files $filesModel)
    {
        $products = $categoriesModel->get_products_category($slug);         
        $attr_taxs = $products['attrs'];
        $on_page = $products['on_page'];
        $cur_cat = $products['cat'];
        unset($products['cat']);
        unset($products['on_page']);
        unset($products['attrs']);
        $products->all = $filesModel->get_files_with_size($products->all());
        $cats = $categoriesModel->get_cats_parent($slug);        
        return view('post.shop', ['products' => $products, 'cats' => $cats, 'attr_taxs' => $attr_taxs, 'on_page'=> $on_page, 'cur_cat' => $cur_cat]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Categories $categoriesModel, Request $request)
    {        
        $categoriesModel->deleteCat($request);
        return redirect()->route('admin.categories');
    }

}
