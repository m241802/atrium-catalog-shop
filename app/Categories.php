<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\LibraryClasses\VariableProcessing;
use App\LibraryClasses\PriceProcessing;
class Categories extends Model {
    public function insert_category( $slug, $title, $content, $images)
    {
        DB::table('categories')->insert(
            array(
                'slug' => $slug,
                'title' => $title,
                'content' => $content,
                'images' => $images,
                'created_at' => Carbon::now('Europe/Moscow')->toDateTimeString(),
            ));
    }
    public function hc_category($request)
    {
        $variableProcessing = new VariableProcessing;
        $request = $variableProcessing->requestProcessing($request);
        if(!DB::table('categories')->where('slug', $request->slug)->exists()){
            $this->insert_category($request->slug, $request->title, $request->content, $request->images);
        }
    }
    public function hu_category($request)
    {
        $variableProcessing = new VariableProcessing;
        $request = $variableProcessing->requestProcessing($request);
        DB::table('categories')
            ->where('id', $request->id)
            ->update( array(
                'slug' => $request->slug,
                'title' => $request->title,
                'content' => $request->content,
                'parent_cat' => $request->cats,
                'images' => $request->images
            ));
    }
    public function get_categories()
    {
        $cats = DB::table('categories')->orderBy('title', 'ASC')->get();
        return $cats;
    }
    public function get_cats_parent($slug)
    {
        $cats= array();
        $cats_arr = $this->get_categories();
        foreach($cats_arr as $cat){

            if($cat->parent_cat == null||$cat->parent_cat == ""){
                $cats[$cat->id] = $cat;
                $children=array();
                foreach($cats_arr as $level2_cat){
                    if($level2_cat->parent_cat != "") {
                        if(gettype($level2_cat->parent_cat)=="string"){
                            $level2_cat->parent_cat = explode(',', $level2_cat->parent_cat);
                        }
                        foreach($level2_cat->parent_cat as $val) {
                            if ($val == $cat->id) {
                                $children[$level2_cat->id] = $level2_cat;
                                $children3="";
                                foreach($cats_arr as $level3_cat){
                                    if($level3_cat->parent_cat != null||$level3_cat->parent_cat != "") {
                                        if(gettype($level3_cat->parent_cat)=="string"){
                                            $level3_cat->parent_cat = explode(',', $level3_cat->parent_cat);
                                        }
                                        foreach ($level3_cat->parent_cat as $val3) {
                                            if ($val3 == $level2_cat->id) {
                                                $children3[$level3_cat->id] = $level3_cat;
                                                $children4="";
                                                foreach($cats_arr as $level4_cat){                                                	
					                                if($level4_cat->parent_cat != null||$level4_cat->parent_cat != "") {					                                	
					                                	
					                                    if(gettype($level4_cat->parent_cat)=="string"){
					                                        $level4_cat->parent_cat = explode(',', $level4_cat->parent_cat);
					                                    }					                                    
					                                    foreach ($level4_cat->parent_cat as $val4) {
					                                        if ($val4 == $level3_cat->id) {
					                                            $children4[$level4_cat->id] = $level4_cat;
					                                        }
					                                    }				                                    
					                                }
					                            }					                            
					                            if($children4!="") {
					                                $children3[$level3_cat->id]->children = $children4;
					                            }
                                            }
                                        }
                                    }
                                }
                                if($children3!="") {
                                    $children[$level2_cat->id]->children = $children3;
                                }
                            }
                        }
                    }
                }
                if(isset($children)) {
                    $cats[$cat->id]->children = $children;
                }
            }
        }
        return $cats;
    }
    public function get_category($slug)
    {
        $cat = DB::table('categories')->where('slug', $slug)->get();
        $id_cats = explode(',', $cat[0]->parent_cat);
        $cat['id_cats'] = $id_cats;
        $cat[0]->parent_cat = DB::table('categories')->whereIn('id', $id_cats)->get();        
        return $cat;
        unset($cat['id_cats']);
    }
    public function whereInCategories($ids)
    {
        $cats = DB::table('categories')->whereIn('id', $ids)->get();
        return $cats;
    }
    public function whereNotInCategories($id, $parent_id)
    {
        $cat_ids = $parent_id;
        $cat_ids[count($cat_ids)] = $id;
        $cats = DB::table('categories')->whereNotIn('id', $cat_ids)->get();
        return $cats;
    }
    public function ajaxNotInCats($cats)
    { 
    	if(isset($cats[0])) {
    		$cats = DB::table('categories')->select('title', 'id')->whereNotIn('id',$cats)->get();
        }
        else {
        	$cats = DB::table('categories')->select('title', 'id')->get();
        }
        return $cats;
    }
    /*гк конечно но уже вечер и мне пох )))*/
    public function get_products_category($slug)
    {
        $cat = DB::table('categories')->where('slug', $slug)->get();
        $cat[0]->images = DB::table('files')->whereIn('id', explode(',', $cat[0]->images))->get();
        $products = DB::table('categories')->where('parent_cat', 'LIKE', '%,'.$cat[0]->id.',%')
                                         ->orWhere('parent_cat', 'LIKE', $cat[0]->id.',%')
                                         ->orWhere('parent_cat', 'LIKE', '%,'.$cat[0]->id)
                                         ->orWhere('parent_cat', 'LIKE', $cat[0]->id)->paginate(60);  
        $products['on_page'] = 'shop/category';                                                                            
        if(!$products[0]) {
            $products = DB::table('products')->where('cats', 'LIKE', '%,'.$cat[0]->id.',%')
                                             ->orWhere('cats', 'LIKE', $cat[0]->id.',%')
                                             ->orWhere('cats', 'LIKE', '%,'.$cat[0]->id)
                                             ->orWhere('cats', 'LIKE', $cat[0]->id)->paginate(60);
            $products_attrs = DB::table('products')->select('attr')->where('cats', 'LIKE', '%,'.$cat[0]->id.',%')
                                                       ->orWhere('cats', 'LIKE', $cat[0]->id.',%')
                                                       ->orWhere('cats', 'LIKE', '%,'.$cat[0]->id)
                                                       ->orWhere('cats', 'LIKE', $cat[0]->id)->get();         
            if(isset($products_attrs[0])) {
	            $attrs_arr = array();
	            foreach ($products_attrs as $key => $value) {
	               $attrs[$key] = explode(',', $value->attr);               
	            } 
	            $attrs_arr = array_flatten($attrs);           
	            $attrs_arr = array_unique($attrs_arr);
	            $attrs_arr = DB::table('product_attributes')->orderBy('title', 'ASC')->whereIn('id', $attrs_arr)->get();           
	            foreach ($attrs_arr as $key => $value) {
	                $attrs_arr2[$value->attr_tax][$value->title] = $value;                
	            }           
	            $products['attrs'] = $attrs_arr2;
	            $products['on_page'] = 'shop';
                $priceProcessing = new PriceProcessing;
                $products = $priceProcessing->currency_rate($products);
            }            
        }
        return $products;
    }
    public function getOnlyParents() {
        $cats = DB::table('categories')->where('parent_cat', '')->orWhere('parent_cat', null)->get();       
        return $cats;        
    }
    public function selectCats()
    {
        $cats = $this -> get_categories();
        foreach($cats as $cat){
            $selectCats[$cat->id] = $cat->title;
        }
        return $selectCats;
    }
    public function preparation_to_import($request)
    {
        if($request->cat_title){
            $cat['title'] = explode(',', $request->cat_title);
        }
        if($request->cat_slug){
            $cat['slug'] = explode(',', $request->cat_slug);
        }
        if($request->cat_content){
            $cat['content'] = explode(',', $request->cat_content);
        }
        if($request->cat_image){
            $cat['image'] = explode(',', $request->cat_image);
        }

        unset(
            $request['cat_title'],
            $request['cat_slug'],
            $request['cat_content'],
            $request['cat_image']
        );
        return $cat;
    }
    public function import_category($request)
    {
        $file_arr = $request->session()->get('file_arr');
        $cat = $this->preparation_to_import($request);
        for ($n = 1; $n < count($file_arr); $n++) {
            for ($i = 0; $i < count($cat['slug']); $i++) {                
                $slug = $this->transliterate($file_arr[$n][$cat['slug'][$i]]);
                $slug2 = DB::table('categories')->where('slug', $slug)->get();
                if (!$slug2) {
                    $this->insert_category($slug, $file_arr[$n][$cat['title'][$i]], '', '');
                }
                $cat_id = DB::table('categories')->where('slug', $slug)->get();
                $cat_ids[$i] = $cat_id[0]->id;
            }

            if($cat_ids){
                $cat_ids = implode(",", $cat_ids);
                $file_arr[$n]['cat_ids'] = $cat_ids;
                unset($cat_ids);
            }
        }
        $request->session()->keep('file_arr');
        $request->session()->put('file_arr', $file_arr);
    }
    public function deleteCat($request)
    {
        DB::table('categories')->where('id', '=', $request->id)->delete();
    }
}
