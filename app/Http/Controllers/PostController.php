<?php

namespace App\Http\Controllers;

use App\PostType;
use App\Tag;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\UploadedFile;
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
        $user = Auth::user();
        $credentials = [];
        if (!$user->hasRole('مدير')) {
            $credentials['user_id'] = Auth::id();
        }
        $posts = Post::where($credentials)->get();
        return view('admin.post.index')->with(['posts' => $posts ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create')->with([
            'types' => PostType::all(),
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
           'document' => 'required',
           'summary' => 'required',
           'category_id' => 'required',
           'type_id' => 'required',
           'tags' => 'required',
           'published_at' => 'required'
       ]);
        /**
         * @var $document UploadedFile
         */
        $document = $request->document;
       $documentName = time().'-'.$document->getClientOriginalName();
       $document->move('uploads/posts/attachments', $documentName);

       $features_new_image = time().'-'.$request->featured->getClientOriginalName();

       $request->featured->move('uploads/posts', $features_new_image);

       $post = Post::create([
           'title' => $request->title,
           'content' => $request->content,
           'summary' => $request->summary,
           'featured' => 'uploads/posts/'.$features_new_image,
           'download_url' => 'uploads/posts/attachments/'. $documentName,
           'published_at' => $request->published_at,
           'slug' => str_slug($request->title),
           'category_id' => $request->category_id,
           'user_id' => Auth::id(),
           'type_id' => $request->type_id
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
        $post = Post::findOrFail($id);

        return view('public.post.show')->with('post', $post);
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
            'types' => PostType::all(),
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
            'summary' => 'required',
            'category_id' => 'required',
            'type_id' => 'required',
            'tags' => 'required',
            'published_at' => 'required'
        ]);

        $post = Post::findOrFail($id);

        if (null !== $request->featured) {
            $features_new_image = time().$request->featured->getClientOriginalName();
            $request->featured->move('uploads/posts', $features_new_image);
            $post->featured = 'uploads/posts/'.$features_new_image;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->summary =  $request->summary;
        $post->category_id = $request->category_id;
        $post->type_id = $request->type_id;
        $post->tags()->sync($request->tags);
        $post->published_at = $request->published_at;
        $post->save();

        Session::flash('success', 'تم تحديث المنشور بنجاح');

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        try {
            $post->delete();
        } catch (\Exception $e) {
            Session::flash('error', 'Post delete failed');
            return redirect()->route('post.index');
        }

        Session::flash('success', 'تم نقل المنشور الى سلة المهملات');

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

        Session::flash('success', 'تم استعادة المنشور بنجاح');

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function browse(Request $request) {
        $query = [
            'category' => $request->query->get('category'),
            'year' => $request->query->get('year'),
            'type' => $request->query->get('type'),
            'tags' => $request->query->get('tag'),
        ];
        $criteria = [];
        !isset($query['category']) ?: $criteria['category_id'] = $query['category'];
        !isset($query['type']) ?: $criteria['type_id'] = $query['type'];
//        !isset($query['year']) ?: $criteria[DB::raw('YEAR(published_at)')->getValue()] = $query['year'];
        $posts = Post::where($criteria)
            ->when(isset($query['year']), function($q) use ($query) {
                    return $q->whereYear('published_at', $query['year']);
            })
            ->when(isset($query['tags']), function($q) use ($query) {
                return $q->whereIn('id', $query['tags']);
            })
            ->get();

        $years = Post::all()->pluck('published_at')->map(function ($item) {
            if (null === $item) {
                return null;
            }
            return Carbon::parse($item)->year;
        })->unique();

        return view('public.post.browse')->with(
            [
                'posts' => $posts,
                'categories' => Category::all(),
                'tags' => Tag::all(),
                'types' => PostType::all(),
                'years' => $years,
                'query' => $query
            ]);
    }
}
