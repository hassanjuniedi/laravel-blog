<?php

namespace App\Http\Controllers;

use App\Tag;
use Session;
use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.post.index')->with(['posts' => Post::all() ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create')->with([
            'categories' => Category::all() ,
            'tags' => Tag::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
          'title' => 'required',
          'featured' => 'required|image',
          'content' => 'required',
           'category_id' => 'required',
           'tags' => 'required'
       ]);

       $features_new_image = time().$request->featured->getClientOriginalName();

       $request->featured->move('uploads/posts', $features_new_image);

       $post = Post::create([
           'title' => $request->title,
           'content' => $request->content,
           'featured' => 'uploads/posts/'.$features_new_image,
           'slug' => str_slug($request->title),
           'category_id' => $request->category_id
       ]);
       $post->tags()->attach($request->tags);

       Session::flash('success', 'Post created successfully');

       return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('admin.post.edit')->with([
            'post' => $post,
            'categories' => $categories,
            'tags' => Tag::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required'
        ]);

        $post = Post::findOrFail($id);

        if (null !== $request->featured) {
            $features_new_image = time().$request->featured->getClientOriginalName();
            $request->featured->move('uploads/posts', $features_new_image);
            $post->featured = 'uploads/posts/'.$features_new_image;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->save();

        $post->tags()->sync($request->tags);
        Session::flash('success', 'Post created successfully');

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);


        Session::flash('success', 'Post deleted successfully');

        return redirect()->route('post.index');
    }

    public function trashed() {
        $posts = Post::onlyTrashed()->get();

        return view('admin.post.trashed')->with('posts',$posts);
    }

    public function kill($id) {
        $post =  Post::withTrashed()->where('id',$id)->first();

        $post->forceDelete();

        Session::flash('success', 'Post deleted permanently');

        return redirect()->back();
    }

    public function restore($id) {
        $post =  Post::withTrashed()->where('id',$id)->first();

        $post->restore();

        Session::flash('success', 'Post restored successfully');

        return redirect()->back();
    }
}
