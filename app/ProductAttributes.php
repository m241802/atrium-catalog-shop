<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use App\Categories;
class ProductAttributes extends Model {
    public function insert_attr_product( $slug, $title, $attr_tax, $cat_ids)
    {
        DB::table('product_attributes')->insert(
            array(
                'slug' => $slug,
                'title' => $title,
                'attr_tax' => $attr_tax,
                'cat_ids' => $cat_ids,
                'created_at' => Carbon::now('Europe/Moscow')->toDateTimeString(),
            ));
    }
    public function explodeAttr($arr)
    {
        $i = 0;
        foreach($arr as $val)
        {
            $exp_val = explode(",", $val->cat_ids);
            $val2 = DB::table('categories')->whereIn('id', $exp_val)->get();
            $arr[$i]->cat_ids = $val2;
            $i++;
        }
    }
    public function create_attr($request)
    {
        $slug = str_replace(" ","-",$request->slug);
        $slug2 = DB::table('product_attributes')->where('slug', $slug)->get();
        if(!$slug2){
            DB::table('product_attributes')->insert(
                array(
                    'slug' => $slug,
                    'title' => $request->title,
                    'attr_tax' => $request->attr_tax,                   
                    'created_at' => Carbon::now('Europe/Moscow')->toDateTimeString(),
                ));
        }
    }
    public function update_attr($request)
    {
        $slug = str_replace(" ","-",$request->slug);
        if($request->cat_ids){
            $cat_ids = implode(',',$request->cat_ids);
        }
        DB::table('product_attributes')
            ->where('id', $request->id)
            ->update( array(
                'slug' => $slug,
                'title' => $request->title,
                'attr_tax' => $request->attr_tax,
                'cat_ids' => $cat_ids,
            ));

    }
    public function getAttrs()
    {
        $attrs = DB::table('product_attributes')->get();
        $this -> explodeAttr($attrs);
        return $attrs;
    }
    public function get_attr($slug)
    {
        $attr = DB::table('product_attributes')->where('slug', $slug)->get();
        $i = 0;
        foreach($attr as $val)
        {
            $exp_val = explode(",", $val->cat_ids);
            $attr[$i]->cat_ids = $exp_val;
            $i++;
        }
        /*dd($attr);*/


        return $attr;
    }
    public function preparation_to_import($request)
    {
        if($request->attr_slug){
            $attr['attr_slug'] = explode(',', $request->attr_slug);
        }
        if($request->attr_slug){
            $attr['attr_title'] = explode(',', $request->attr_title);
        }
        if($request->cat_ids){
            $attr['cat_ids'] = explode(',', $request->cat_ids);
        }
        if($request->attr_tax){
            $attr['attr_tax'] = explode(',', $request->attr_tax);
        }
        unset(
            $request['attr_title'],
            $request['attr_slug'],
            $request['cat_ids'],
            $request['attr_tax']
        );
        return $attr;
    }
    public function import_attr_product($request)
    {
        $file_arr = $request->session()->get('file_arr');
        $attr = $this->preparation_to_import($request);
        for ($n = 1; $n < count($file_arr); $n++) {
            for ($i = 0; $i < count($attr['attr_slug']); $i++) {
                /*получение переменных*/
                $attr_slug = $file_arr[$n][$attr['attr_slug'][$i]];
                $attr_tax = $file_arr[$n][$attr['attr_tax'][$i]];
                $attr_title = $file_arr[$n][$attr['attr_title'][$i]];
                /*очистка переменных от пробелов*/
                $attr_slug = str_replace(" ", "_", $attr_slug);
                $attr_tax = str_replace(" ", "_", $attr_tax);
                $slug = $attr_tax.'_'.$attr_slug;
                $attr_arr1 = DB::table('product_attributes')->where('slug', $slug)->get();
                if (!$attr_arr1) {
                    if($request->cat_ids){
                        $cat_ids = $attr['cat_ids'];
                        $cat_ids = implode(",", $cat_ids);
                    }
                    else {
                        $cat_ids = $file_arr[$n]['cat_ids'];
                    }
                    $this->insert_attr_product($slug, $attr_title, $attr_tax, $cat_ids);
                }
                $attr_arr = DB::table('product_attributes')->where('slug', $slug)->get();
                $attr_ids[$i] = $attr_arr[0]->id;
            }
            if($attr_ids){
                $attr_ids = implode(",", $attr_ids);
                $file_arr[$n]['attr_ids'] = $attr_ids;
                unset($attr_ids);
            }

        }
        $request->session()->keep('file_arr');
        $request->session()->put('file_arr', $file_arr);
    }
    public function ajaxAttrs($attrs)
    { 
        if(isset($attrs[0])) {
            $attrs = DB::table('product_attributes')->whereNotIn('id',$attrs)->get();
        }
        else {
            $attrs = DB::table('product_attributes')->get();
        }
        return $attrs;
    }


}
