<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ProductAttributes;
use App\Categories;
use Illuminate\Http\Request;

class ProductAttributesController extends Controller {
    public function index(ProductAttributes $productAttributes)
    {
        $attrs = $productAttributes->getAttrs();
        return view('admin.product-attributes.attrs', ['attrs' => $attrs]);
    }
    public function create(Categories $categoriesModel)
    {
        $cats = $categoriesModel->get_categories();
        return view('admin.product-attributes.attr-create', ['cats' => $cats]);
    }
    public  function hcAttr(ProductAttributes $productAttributes, Request $request)
    {
        $productAttributes->create_attr($request);
        return redirect()->route('admin.attr_products');
    }
    public  function edit(ProductAttributes $productAttributes, $slug, Categories $categoriesModel)
    {
        $attr = $productAttributes->get_attr($slug);
        $cats = $categoriesModel->whereNotInCategories('', $attr[0]->cat_ids);
        $attr[0]->cat_ids = $categoriesModel->whereInCategories($attr[0]->cat_ids);
        return view('admin.product-attributes.attr-edit', ['attr' => $attr, 'cats' => $cats]);
    }
    public  function huAttr(ProductAttributes $productAttributes, Request $request)
    {
        $productAttributes->update_attr($request);
        return redirect()->route('admin.attr_products');
    }
    public function ajaxAttrs(ProductAttributes $productAttributes, Request $request)
    { 
        $attrs = $productAttributes->ajaxAttrs($request->attrs);
        return response()->json($attrs);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
