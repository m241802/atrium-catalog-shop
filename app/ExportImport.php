<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Validator;
use Redirect;
use Request;
use Input;
use Session;
use App\Categories;
class ExportImport extends Model {

    public function getDataFile($request)
    {
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $l_file  = fopen($file, "r");
        while (($line = fgetcsv($l_file)) !== FALSE) {
            $csv[] = $line;
        }
        $request->session()->put('file_arr', $csv);      
        return $csv;
        unset($csv);
        fclose($file);


    }


}
