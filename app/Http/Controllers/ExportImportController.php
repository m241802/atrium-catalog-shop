<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\ExportImport;
use App\Categories;
use App\ProductAttributes;
use App\Products;
use App\Files;
use Illuminate\Http\Request;
class ExportImportController extends Controller {
    public function index()
    {
        return view('admin.export-import.import');
    }
    public function importProduct(ExportImport $exportImportModel, Request $request)
    {
        $file_arr = $exportImportModel->getDataFile($request);
        return view('admin.export-import.import-form', ['file_arr' => $file_arr]);
    }
    public function handlerImport(ExportImport $exportImportModel, Request $request, Categories $categoriesModel, ProductAttributes $productAttributesModel, Products $productsModel, Files $filesModel)
    {
       /* if($request->images){
            $filesModel->import_files($request);
        }
        $categoriesModel->import_category($request);
        $productAttributesModel->import_attr_product($request);*/
        $productsModel->import_product($request);
    }




}
