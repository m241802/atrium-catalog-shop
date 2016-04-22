<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Posts;
use App\Files;
use App\Categories;
use Illuminate\Http\Request;

class PostController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Posts $postsModel, Categories $categoriesModel, Files $filesModel)
    {
        $posts = $postsModel->getPublishedPosts();
        $posts = $filesModel->get_files_with_size($posts);
        $cats = $categoriesModel->get_cats_parent('');
        return view('post.posts', ['posts' => $posts, 'cats' => $cats]);
    }
    public function admin_loop(Posts $postsModel)
    {
        $posts = $postsModel->getAllPosts();
        return view('admin.posts.posts', ['posts' => $posts]);
    }


    public function single(Posts $postsModel, $slug, Categories $categoriesModel, Files $filesModel)
    {
        $post = $postsModel->scopeSinglePost($slug);
        $cats = $categoriesModel->get_cats_parent('');        
        $post = $filesModel->get_files_with_size($post);
        return view('post.post', ['post' => $post, 'cats' => $cats]);
    }
    /**
     * Show the form for creating a Post resource.
     *
     * @return Response
     */
    public function create(Files $filesModel)
    {
        $images = $filesModel->getImages();
        return view('admin.posts.post-create', ['images' => $images]);
    }
    public function store(Files $filesModel, Posts $postsModel, Request $request)
    {
        if($request->files->has('images')){
            $request->files = $filesModel->insert_files($request->files->all()['images']);
        }
        $postsModel->createPost($request);
        return redirect()->route('admin.posts');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Posts $postsModel, $slug, Files $filesModel)
    {
        $post = $postsModel->scopeSinglePost($slug);
        $post = $filesModel->get_files_with_size($post);
        return view('admin.posts.post-edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function  update(Files $filesModel, Posts $postsModel, Request $request)
    {
        if($request->files->has('images')){
            $request->files = $filesModel->insert_files($request->files->all()['images']);
        }
        $postsModel->updatePost($request);
        return redirect()->route('admin.posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Posts $postsModel, Request $request)
    {
        $postsModel->deletePost($request);
        return redirect()->route('admin.posts');
    }

}
