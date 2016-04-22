<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

get('/', ['as' => 'products', 'uses' => 'HomeController@index']);
get('shop', ['as' => 'products', 'uses' => 'ProductsController@index']);
Route::get('home', 'HomeController@index');

Route::get('parser', 'HomeController@parser');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
get('admin', ['as' => 'admin', 'uses' => 'ProductsController@admin_loop', 'middleware' => 'auth']);


/*
*Новости*/
/*создание новости*/
get('admin/news/create', ['as' => 'admin.news.create', 'uses' => 'NewsController@create', 'middleware' => 'auth']);
/*обработчик (создание новости)*/
Route::post('new', ['as' => 'new.store', 'uses' => 'NewsController@store', 'middleware' => 'auth']);
/*удаление новости*/
get('admin/news/destroy', ['as' => 'admin.news.destroy', 'uses' => 'NewsController@destroy', 'middleware' => 'auth']);
/*изменение новости*/
get('admin/news/{slug}', ['as' => 'admin.new.{slug}', 'uses' => 'NewsController@edit', 'middleware' => 'auth']);
/*обработчик (изменение новости)*/
Route::post('news/update', ['as' => 'new.update', 'uses' => 'NewsController@update', 'middleware' => 'auth']);
/*административная страница новости*/
get('admin/news', ['as' => 'admin.news', 'uses' => 'NewsController@admin_loop', 'middleware' => 'auth']);
/*публичная страница новость*/
get('news/{slug}', ['as' => 'new.{slug}', 'uses' => 'NewsController@single']);
/*публичная страница новости*/
get('news', ['as' => 'news', 'uses' => 'NewsController@index']);

/*
* Cтатьи */
/*создание статьи*/
get('admin/posts/create', ['as' => 'admin.posts.create', 'uses' => 'PostController@create', 'middleware' => 'auth']);
/*обработчик (создание статьи)*/
Route::post('post', ['as' => 'post.store', 'uses' => 'PostController@store', 'middleware' => 'auth']);
/*удаление статьи*/
get('admin/posts/destroy', ['as' => 'admin.posts.destroy', 'uses' => 'PostController@destroy', 'middleware' => 'auth']);
/*изменение статьи*/
get('admin/posts/{slug}', ['as' => 'admin.post.{slug}', 'uses' => 'PostController@edit', 'middleware' => 'auth']);
/*обработчик (изменение статьи)*/
Route::post('posts/update', ['as' => 'post.update', 'uses' => 'PostController@update', 'middleware' => 'auth']);
/*административная страница статьи*/
get('admin/posts', ['as' => 'admin.posts', 'uses' => 'PostController@admin_loop', 'middleware' => 'auth']);
/*публичная страница статьи*/
get('posts/{slug}', ['as' => 'post.{slug}', 'uses' => 'PostController@single']);



/*
* Faqs */
/*создание Faq*/
get('admin/faqs/create', ['as' => 'admin.faqs.create', 'uses' => 'FaqsController@create', 'middleware' => 'auth']);
/*обработчик (создание faqs)*/
Route::post('faq', ['as' => 'faq.store', 'uses' => 'FaqsController@store', 'middleware' => 'auth']);
/*удаление faqs*/
get('admin/faqs/destroy', ['as' => 'admin.faqs.destroy', 'uses' => 'FaqsController@destroy', 'middleware' => 'auth']);
/*изменение faqs*/
get('admin/faqs/{slug}', ['as' => 'admin.faq.{slug}', 'uses' => 'FaqsController@edit', 'middleware' => 'auth']);
/*обработчик (изменение faqs)*/
Route::post('faqs/update', ['as' => 'faq.update', 'uses' => 'FaqsController@update', 'middleware' => 'auth']);
/*административная страница faqs*/
get('admin/faqs', ['as' => 'admin.faqs', 'uses' => 'FaqsController@admin_loop', 'middleware' => 'auth']);
/*публичная страница faqs*/
get('faqs/{slug}', ['as' => 'faq.{slug}', 'uses' => 'FaqsController@single']);
/*публичная страница faqs*/
get('faqs', ['as' => 'faqs', 'uses' => 'FaqsController@index']);




/*
*Товар*/
/*создание продукта*/
get('admin/shop/create', ['as' => 'admin.shop.create', 'uses' => 'ProductsController@create', 'middleware' => 'auth']);
/*обработчик (создание продукта)*/
Route::post('product', ['as' => 'shop.store', 'uses' => 'ProductsController@store']);
/*удаление продукта*/
get('admin/shop/destroy', ['as' => 'admin.shop.destroy', 'uses' => 'ProductsController@destroy', 'middleware' => 'auth']);
/*изменение продукта*/
get('admin/shop/{slug}', ['as' => 'admin.shop.{slug}', 'uses' => 'ProductsController@edit', 'middleware' => 'auth']);
/*обработчик (изменение продукта)*/
Route::post('shop/update', ['as' => 'shop.update', 'uses' => 'ProductsController@update', 'middleware' => 'auth']);
/*административная страница продукта*/
get('admin/shop', ['as' => 'admin.shop', 'uses' => 'ProductsController@admin_loop', 'middleware' => 'auth']);
/*публичная страница продукта*/
get('shop/{slug}', ['as' => 'shop.{slug}', 'uses' => 'ProductsController@single']);
/*публичная страница продукта*/
get('shop', ['as' => 'shop', 'uses' => 'ProductsController@index']);


/*
*Картинки*/
get('admin/upload-file', ['as' => 'upload.file', 'uses' => 'FilesController@upload', 'middleware' => 'auth']);
/*обработчик (создание продукта)*/
Route::post('hendler-file', ['as' => 'hendler.file', 'uses' => 'FilesController@submit', 'middleware' => 'auth']);
/*административная страница Картинки*/
get('admin/images', ['as' => 'admin.images', 'uses' => 'FilesController@showImages', 'middleware' => 'auth']);
/*изменение картинки*/
get('admin/images/{slug}', ['as' => 'admin.img.{slug}', 'uses' => 'FilesController@imgEdit', 'middleware' => 'auth']);
/*обработчик (изменение картинки)*/
Route::post('images/update', ['as' => 'images.update', 'uses' => 'FilesController@imgUpdate', 'middleware' => 'auth']);

/*
*Слайдер*/
get('admin/slider', ['as' => 'admin.slider', 'uses' => 'SliderController@dashSlides', 'middleware' => 'auth']);
get('admin/slider/{slug}', ['as' => 'admin.slider.{slug}', 'uses' => 'SliderController@editSlide', 'middleware' => 'auth']);
Route::post('slider/update', ['as' => 'slide.update', 'uses' => 'SliderController@updateSlide', 'middleware' => 'auth']);
get('admin/slide-create', ['as' => 'slide.create', 'uses' => 'SliderController@createSlide', 'middleware' => 'auth']);
Route::post('slide/handler-create', ['as' => 'handler.slide.create', 'uses' => 'SliderController@handlerCreateSlide', 'middleware' => 'auth']);

/*
*Export/Import*/
get('admin/export-import', ['as' => 'admin.exportImport', 'uses' => 'ExportImportController@index', 'middleware' => 'auth']);
/*Import product form*/
Route::post('admin/import-product', ['as' => 'importProduct', 'uses' => 'ExportImportController@importProduct', 'middleware' => 'auth']);
/*Handler Import*/
Route::post('admin/handler-import', ['as' => 'handlerImport', 'uses' => 'ExportImportController@handlerImport', 'middleware' => 'auth']);

/*
*Category*/
get('admin/category-create', ['as' => 'admin.categoryCreate', 'uses' => 'CategoriesController@create', 'middleware' => 'auth']);
/*Handler Create Category*/
Route::post('admin/hc-category', ['as' => 'hc.category', 'uses' => 'CategoriesController@hc_category', 'middleware' => 'auth']);
/*удаление статьи*/
get('admin/category/destroy', ['as' => 'admin.category.destroy', 'uses' => 'CategoriesController@destroy', 'middleware' => 'auth']);

get('admin/categories', ['as' => 'admin.categories', 'uses' => 'CategoriesController@get_categories', 'middleware' => 'auth']);
get('admin/category/{slug}', ['as' => 'edit.category', 'uses' => 'CategoriesController@get_category', 'middleware' => 'auth']);
Route::post('admin/hu-category', ['as' => 'hu.category', 'uses' => 'CategoriesController@hu_category', 'middleware' => 'auth']);
get('shop/category/{slug}', ['as' => 'shop.category.{slug}', 'uses' => 'CategoriesController@get_products_category']);



/*
 * Attribute product*/
/*get all in admin panel attributes product */
get('admin/attr-products', ['as' => 'admin.attr_products', 'uses' => 'ProductAttributesController@index', 'middleware' => 'auth']);
/*get edit page attribute product */
get('admin/create-attr', ['as' => 'create.attr', 'uses' => 'ProductAttributesController@create', 'middleware' => 'auth']);
/*handler create attribute products*/
Route::post('admin/hc-attr', ['as' => 'hc.attr', 'uses' => 'ProductAttributesController@hcAttr', 'middleware' => 'auth']);
/*get update page attribute product */
get('admin/attr/{slug}', ['as' => 'edit.attr', 'uses' => 'ProductAttributesController@edit', 'middleware' => 'auth']);
/*handler update attribute products*/
Route::post('admin/hu-attr', ['as' => 'hu.attr', 'uses' => 'ProductAttributesController@huAttr', 'middleware' => 'auth']);

//search
Route::post('/search', ['as' => 'search', 'uses' => 'HomeController@searchResult',]);

Route::post( '/cats-not-in', array(
    'as' => 'cats.not.in',
    'uses' => 'CategoriesController@ajaxNotInCats'
));
Route::post( '/attrs-not-in', array(
    'as' => 'attrs.not.in',
    'uses' => 'ProductAttributesController@ajaxAttrs'
));

Route::post( '/images-not-in', array(
    'as' => 'images.not.in',
    'uses' => 'FilesController@ajaxNotInImages'
));



Blade::setContentTags('<%', '%>');        // for variables and all things Blade
Blade::setEscapedContentTags('<%%', '%%>');   // for escaped data