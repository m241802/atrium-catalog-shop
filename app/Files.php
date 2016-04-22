<?php namespace App;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use Request;
use Session;
use App\LibraryClasses\VariableProcessing;
class Files extends Model {
    public function insert_files($files)
    {       
        ini_set('max_execution_time', 30000);
        ini_set("gd.jpeg_ignore_warning", 1);
        ini_set("extension", "php_gd2.dll");
        $ya = 0; 
        $images_id = array();    
        foreach($files as $image)
        {
            $ya++;
            /*Определение начального размера*/
            if (!@getimagesize($image))
            {
                continue;
            }
            $exif_image_type = exif_imagetype($image);
            $start_size = getimagesize($image);
            $quotient_size1 = $start_size[0]/$start_size[1];
            $quotient_size2 = $start_size[1]/$start_size[0];

            /*Объявление дополнительных размеров изображения*/
             if($start_size[0]>$start_size[1]) {
                $size[0]['width'] = 80;
                $size[0]['height'] = $size[0]['width']*$quotient_size2;
                $size[1]['width'] = 181;
                $size[1]['height'] = $size[1]['width']*$quotient_size2;
            }
            elseif($start_size[0]<$start_size[1]) {
                $size[0]['height'] = 80;
                $size[0]['width'] = $size[0]['height']*$quotient_size1;
                $size[1]['height'] = 181;
                $size[1]['width'] = $size[1]['height']*$quotient_size1;
            }
            else {
                $size[0]['width'] = 80;
                $size[0]['height'] = 80;
                $size[1]['width'] = 181;
                $size[1]['height'] = 181;
            }

            /*Определение типа файла*/
            if($image->getMimeType()) {
                $type = "image";
                $type2 = $image->getMimeType();
                $type2 = substr($type2, 0, strpos($type2, "/"));
            }
            /*Сохранение картинки в каталог*/
            if ($image->isValid()&&$type2==$type) {
                $destinationPath = 'uploads/img/'.date("Y-m").'/'; // upload path
                if($image->getClientOriginalName()) {
                    $fileName = $image->getClientOriginalName(); // renameing image
                }
                else {
                    $fileName = $image->getClientOriginalName();
                }
                /*Создание и сохранение дополнительных размеров*/
                $variableProcessing = new VariableProcessing;
                $new_name = $variableProcessing->transliterate($fileName);
                if($exif_image_type == 1){
                    $img = imagecreatefromgif($image);
                    $img_ending = 'gif';
                }
                elseif($exif_image_type == 2){                    
                    $img = imagecreatefromjpeg($image);
                    $img_ending = 'jpeg';
                }
                elseif($exif_image_type == 3){
                    $img = imagecreatefrompng($image);
                    $img_ending = 'png';
                }
                elseif($exif_image_type == 4){
                    dd('IMAGETYPE-'.IMAGETYPE_SWF);
                }
                elseif($exif_image_type == 5){
                    dd('IMAGETYPE-'.IMAGETYPE_PSD);
                }
                elseif($exif_image_type == 6){
                    dd('IMAGETYPE-'.IMAGETYPE_BMP);
                }
                else {
                    dd($exif_image_type, $fileName);
                    continue;

                }
                $new_name = str_replace('.'.$img_ending, '', $new_name);                
                foreach ($size as $value) {
                    $new_image = imagecreatetruecolor($value['width'], $value['height']);
                    /*при ошибке в imagecreatefromjpeg() перейти к следующему циклу*/
                    
                    imagecopyresampled($new_image, $img, 0, 0, 0, 0, round($value['width']), round($value['height']), $start_size[0], $start_size[1]);
                    imagejpeg($new_image, $destinationPath.$new_name.'-'.round($value['width']).'x'.round($value['height']).'.'.$img_ending );
                }

                /*Сохранение основного файла*/
                $image->move($destinationPath,  $new_name.'.'.$img_ending); // uploading file to given path

                /*Сохранение картинки в базу данных*/
                $slug_name = $new_name;
                $size_image = round($size[0]['width']).'x'.round($size[0]['height']).','.round($size[1]['width']).'x'.round($size[1]['height']);
                if(!DB::table('files')->where('slug', $slug_name)->exists()){
                    DB::table('files')->insert(
                        array('slug' => $slug_name,
                            'title' => $slug_name,
                            'size' => $size_image,
                            'type' => $img_ending,
                            'destinationPath' => date("Y-m"),
                            /* 'excerpt' => $files->excerpt,*/
                            'created_at' => Carbon::now('Europe/Moscow')->toDateTimeString(),
                        ));
                }                
                $images_id[] .= DB::table('files')->select('id')->where('slug', $slug_name)->get()[0]->id;
                // sending back with message
                Session::flash('success', 'Upload successfully');
            }
            else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
            }
        }        
        if(isset($images_id)){
            return $images_id;
        }
        unset($images_id);

    }

    public function ajaxUpload($request)
    {
        $this ->insert_files($request->file('image'));
        return Redirect::to('upload');
    }
    public function import_files($request)
    {
        $images = explode(',', $request->images);
        ini_set('max_execution_time', 30000);
        ini_set ("memory_limit", "1000M");
        ini_set("gd.jpeg_ignore_warning", 1);
        ini_set("extension", "php_gd2.dll");
        $destinationPath = 'uploads/img/'.date("Y-m").'/'; // upload path
        $file_arr = $request->session()->get('file_arr');
        for ($n = 1; $n < count($file_arr); $n++) {
            $images_ids ='';
            for ($i = 0; $i < count($images); $i++) {
                if (!$file_arr[$n][$images[$i]])
                {
                    continue;
                }
                $url = trim($file_arr[$n][$images[$i]], ' ');
                print_r('<br>');
                print_r($n.' - - '.$i);
                print_r('<br>');
                print_r($url);
                print_r('<br>');
                $image_info = pathinfo($file_arr[$n][$images[$i]]);
                $imgs[$i]['file'] = file_get_contents($url);
                $imgs[$i]['basename'] = $image_info['basename'];
                $imgs[$i]['type'] = $image_info['extension'];
                $imgs[$i]['filename'] = $image_info['filename'];
                $imgs[$i]['filename'] = $image_info['filename'];
                /*Объявление дополнительных размеров изображения*/
                $start_size = getimagesize($url);
                $quotient_size1 = $start_size[0]/$start_size[1];
                $quotient_size2 = $start_size[1]/$start_size[0];
                 if($start_size[0]>$start_size[1]) {
                $size[0]['width'] = 80;
                $size[0]['height'] = $size[0]['width']*$quotient_size2;
                $size[1]['width'] = 181;
                $size[1]['height'] = $size[1]['width']*$quotient_size2;
            }
            elseif($start_size[0]<$start_size[1]) {
                $size[0]['height'] = 80;
                $size[0]['width'] = $size[0]['height']*$quotient_size1;
                $size[1]['height'] = 181;
                $size[1]['width'] = $size[1]['height']*$quotient_size1;
            }
            else {
                $size[0]['width'] = 80;
                $size[0]['height'] = 80;
                $size[1]['width'] = 181;
                $size[1]['height'] = 181;
            }
                $size[4]['width'] = $start_size[0];
                $size[4]['height'] = $start_size[0];
                $t=0;
                foreach ($size as $value) {
                    $new_image = imagecreatetruecolor($value['width'], $value['height']);
                    /*при ошибке в imagecreatefromjpeg() перейти к следующему циклу*/
                    if (!@imagecreatefromjpeg($url))
                    {
                        continue;
                    }
                    $img = imagecreatefromjpeg($url);
                    imagecopyresampled($new_image, $img, 0, 0, 0, 0, $value['width'], $value['height'], $start_size[0], $start_size[1]);
                    if($t==4){
                        imagejpeg($new_image, $destinationPath.$imgs[$i]['filename'].'.jpg', 100 );
                    }
                    else {
                        imagejpeg($new_image, $destinationPath.$imgs[$i]['filename'].'-'.$value['width'].'x'.$value['height'].'.jpg', 100 );
                    }
                    $t++;
                }
                $size_image = $size[0]['width'].'x'.$size[0]['height'].','.$size[1]['width'].'x'.$size[1]['height'].','.$size[2]['width'].'x'.$size[2]['height'].','.$size[3]['width'].'x'.$size[3]['height'];
                /*Сохранение картинки в базу данных*/
                $slug_name = $imgs[$i]['filename'];
                $slug = DB::table('files')->where('slug', $slug_name)->get();
                if(!$slug){
                    DB::table('files')->insert(
                        array('slug' => $slug_name,
                            'title' => $slug_name,
                            'size' => $size_image,
                            'destinationPath' => date("Y-m"),
                            /* 'excerpt' => $files->excerpt,*/
                            'created_at' => Carbon::now('Europe/Moscow')->toDateTimeString(),
                        ));
                }
                $image_arr = DB::table('files')->where('slug', $slug_name)->get();
                $images_ids[$i] = $image_arr[0]->id;
            }
            if($images_ids!="") {
                $images_ids = implode(',', $images_ids);
                $file_arr[$n]['images'] = $images_ids;
                unset($images_ids);
            }
        }
        $request->session()->keep('file_arr');
        $request->session()->put('file_arr', $file_arr);
    }
    /*
    *
   ** getting all images (admin panel) */
    public function getImages()
    {
        $images = Files::latest('created_at')->get();
        $i=0;
        foreach($images as $image){
            $size= explode(',', $image->size);
            $image->size = $size;
            $images[$i] = $image;
            $i++;
        }
        return $images;
    }
    public function getMFilesBy($images)
    {
        $i = 0;
        foreach($images as $image){
            if(!isset($image->images)) {
                continue;
            }
            $imgs = explode(",", $image->images);
            $files = DB::table('files')->whereIn('id', $imgs)->get();
            $images[$i]->files = $files;
            $i++;
        }
        return $images;
    }
    /*
     *
    ** getting page edit image (admin panel) */
    public function imgEdit($slug)
    {
        $image = DB::table('files')->where('slug', $slug)->get();
        return $image;
    }
    /*
     *
    ** handler update query image */
    public function updateImage($request)
    {
        DB::table('files')
            ->where('id', $request->id)
            ->update(array(
                'title' => $request->title,
                'excerpt' => $request->excerpt,
                'updated_at' => Carbon::now('Europe/Moscow')->toDateTimeString()
            ));
    }

    /*
     *
    ** handler insert query new slide */
    public function hcSlide($request)
    {
        foreach ($request->all() as $key => $value) {
            if(stristr($key, 'img') == TRUE) {
                $images[$key] = $value;
            }
        }
        $images = implode(",", $images);
        DB::table('slider')->insert(
            array(
                'title' => $request->title,
                'attr' => $request->attr,
                'images' => $images,
                'created_at' => Carbon::now('Europe/Moscow')->toDateTimeString(),
            ));
    }
    /*
     *
    ** get all slide use in admin/slider */
    public function getSlides()
    {
        $slides =  DB::table('slider')->get();
        return $slides;
    }
    public function get_files_with_size($posts){
        foreach($posts as $key=>$post)
        {
            if($post->images!=""){
                $images = explode(',', $post->images);
                if(count($posts)==1){
                    $rest_images = DB::table('files')
                        ->whereNotIn('id', $images)->get();
                    $posts[0]->rest_images = $this->get_size_files($rest_images);
                }
                $post->images = DB::table('files')->whereIn('id', $images)->orderByRaw(DB::raw("FIELD(id, $post->images)"))->get();
                $post->images = $this->get_size_files($post->images);
            }

        }
        unset($images);
        return $posts;
    }
    /*
    *
   ** explode the resulting width DB field images*/
    public function get_size_files($images){
        $i=0;
        foreach($images as $image){
            $image->size= explode(',', $image->size);
            $rest_images[$i] = $image;
            $i++;
        }
        return $images;
    }
    public function ajaxNotInImages($imgs)
    {
        if(isset($imgs[0])) {
            $imgs = DB::table('files')->whereNotIn('id',$imgs)->get();
        }
        else {
            $imgs = DB::table('files')->get();
        }
        $imgs = $this->get_size_files($imgs); 
        return $imgs;
    }    
}

