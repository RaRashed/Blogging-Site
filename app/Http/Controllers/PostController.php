<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create','store']);


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::all();
        return view('posts.index')->with('posts',$post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $tag = Tag::all();
        return view('posts.create')->with('categories',$category)->with('tags',$tag);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {

        $image = $request->image->store('posts');

       $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'category_id' => $request->category,
            'published_at' => $request->published_at,
            'user_id' =>auth()->user()->id


        ]);

        if($request->tags)
        {
            $post->tags()->attach($request->tags);
        }


        return redirect(route('posts.index'))->with('status', 'Post Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request,Post $post)
    {
        $data = $request->only(['title','description','content','category_id','published_at']);
        //Check if new image
        if($request->hasFile('image')){
             //upload it
             $image= $request->image->store('posts');
             //delete old image
             $post->deleteImage();
             $data['image'] = $image;


        }

        if($request->tags){
            $post->tags()->sync($request->tags);

        }
        $post->update($data);

        return redirect(route('posts.index'))->with('status', 'Post Updated Successfully');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post =Post::withTrashed()->where('id',$id)->first();

        if($post->trashed())
        {
            $post->deleteImage();
            $post->forceDelete();
        }
        else{
            $post->delete();
        }
        return redirect(route('posts.index'))->with('status', 'Post Deleted Successfully');


    }

    public function trashed()
    {
        //display all trash posts
        $trashed =Post::onlyTrashed()->get();
        return view('posts.index')->with('posts',$trashed);


    }
    public function restore($id)
    {
        $post =Post::withTrashed()->where('id',$id)->firstOrFail();

        $post->restore();
        session()->flash('status', 'Post Restore Successfully');
        return redirect()->back();

    }
}
