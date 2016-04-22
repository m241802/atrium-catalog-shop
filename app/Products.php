<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\Files;
use App\LibraryClasses\VariableProcessing;
use App\LibraryClasses\PriceProcessing;
class Products extends Model {
    public function getSearchResult($search, Files $filesModel)
    {
        if(DB::table('products')->where('title', 'LIKE', '%'.$search.'%')->exists()) {
           $products = Products::latest('published_at')->where('title', 'LIKE', '%'.$search.'%')->paginate(61);
           $search_result = $filesModel->get_files_with_size($products);
           return $search_result;
        }
        else {
            $search_result['message'] = 'К сожелению по Вашему запросу ничего не найдено';
            return $search_result;
        }       
    } 
    public function filterProducts($items)
    {
        $products = Products::latest('published_at')->orderBy('images', 'ABC')->paginate($items);
        return $products;
    }

    public function scopePublished($query){
        $query->where('published_at', '<=', Carbon::now());
    }
    public function getAllProducts($items)
    {
        $products = Products::latest('published_at')->orderBy('images', 'ABC')->paginate($items);
        $priceProcessing = new PriceProcessing;
        $products = $priceProcessing->currency_rate($products);
        return $products;
    }
    public function scopeProduct($slug)
    {
        $product = DB::table('products')->where('slug', $slug)->get();       
        $attr = explode(',', $product[0]->attr);
        $cats = explode(',', $product[0]->cats);
        $product[0]->attr = DB::table('product_attributes')
            ->whereIn('id', $attr)->get();
        $product[0]->cats = DB::table('categories')
            ->whereIn('id', $cats)->get();
        if($product[0]->price_currency=="y.e.") {
            $priceProcessing = new PriceProcessing;
            $product = $priceProcessing->currency_rate($product);
        }
        return $product;
    }
    public function createProduct($request)
    {
        $variableProcessing = new VariableProcessing;
        $request = $variableProcessing->requestProcessing($request);
        DB::table('products')->insert(
            array(
                'slug' => $request->slug,
                'title' => $request->title,
                'price' => $request->price,
                'unit_of_measure' => $request->unit_of_measure,
                'content' => $request->content,
                'published_at' => $request->published_at,
                'sku' => $request->sku,
                'cats' => $request->cats,
                'attr' => $request->attrs,
                'images' => $request->images,
                'created_at' => Carbon::now('Europe/Moscow')->toDateTimeString(),
            ));
    }
    public function updateProduct($request)
    {
        $variableProcessing = new VariableProcessing;
        $request = $variableProcessing->requestProcessing($request);
        DB::table('products')
            ->where('id', $request->id)
            ->update(array( 
                'slug' => $request->slug,
                'title' => $request->title,
                'price' => $request->price,
                'unit_of_measure' => $request->unit_of_measure,
                'content' => $request->content,
                'published_at' => $request->published_at,
                'cats' => $request->cats,
                'attr' => $request->attrs,
                'images' => $request->images,
                'updated_at' => Carbon::now('Europe/Moscow')->toDateTimeString()
            ));
    }
    public function deleteProduct($request)
    {
        DB::table('products')->where('id', '=', $request->id)->delete();
    }

    public function import_product($request)
    {
        $file_arr = $request->session()->get('file_arr');
        for ($n = 1; $n < count($file_arr); $n++) {
                $slug = $file_arr[$n][$request->slug];
                $title = $file_arr[$n][$request->title];
                if($request->content){
                    $content = $file_arr[$n][$request->content];
                }
                else {
                    $content = '';
                }
            $variableProcessing = new VariableProcessing;
            $slug = $variableProcessing->transliterate( $request->slug);
            if(isset($file_arr[$n]->images)){
               $images_ids = $file_arr[$n]['images'];
           }
            else {
                $images_ids = '';
            }
            if (!DB::table('products')->where('slug', $slug)->exists()) {
                DB::table('products')->insert(
                    array(
                        'slug' => trim($slug, ' '),
                        'title' => trim($title, ' '),
                        'content' => $content,
                        'sku' => 'sku-'.md5(uniqid("")),
                        'attr' => $file_arr[$n]['attr_ids'],
                        'cats' => $file_arr[$n]['cat_ids'],
                        'images' => $images_ids,
                        'price' => $file_arr[$n][$request->price],
                        'unit_of_measure' => $file_arr[$n][$request->unit_of_measure],
                        'price_currency' => 'y.e.',
                        'published' => 1,
                        'created_at' => Carbon::now('Europe/Moscow')->toDateTimeString(),
                    ));
                print_r($n);
            }

        }
    }
  /*  public function import_product($request)
    {

        $file_arr = $request->session()->get('file_arr');        
        for ($n = 1; $n < count($file_arr); $n++) {
            $title = trim($file_arr[$n][$request->title], " ");
            $price = str_replace(" руб.", "", $file_arr[$n][$request->price]);
            $unit_of_measure = $file_arr[$n][$request->unit_of_measure] . ".";                    
            if(DB::table('products')->where('title', $title)->exists()) {
            	DB::table('products')
                ->where('title', $title)
                ->update(array(
                	'price' => $price,
                	'unit_of_measure' => $unit_of_measure
                	));

            }
        }

    }*/
}

