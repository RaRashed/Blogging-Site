<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = Tag::all();
        return view('tags.index')->with('tags',$tag);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTagRequest $request)
    {

        $tag = new Tag();


    Tag::create([
        'name' => $request->name
    ]);

    return redirect(route('tags.index'))->with('status', 'Tag Created Successfully');




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
    //public function edit($id)
    public function edit(Tag $tag)
    {
      //$tag= ta$tag::find($id);
      //return view('categories.edit')->with('ta$tag',$tag);
      return view('tags.create')->with('tag',$tag);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        //$tag= ta$tag::find($id);

       // $tag->name = $request->name;
        //$tag->update();

        $tag->update([
            'name' => $request->name

        ]);

        return redirect(route('tags.index'))->with('status', 'Tag Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag  )
    {
        //$tag=ta$tag::find($id);
        //$tag =ta$tag::where('id',$id)->get()->first();


        if($tag->posts->count() > 0)
        {
            return redirect(route('tags.index'))->with('error', 'Tag Can not deleted because it has in some post');


        }

        $tag->delete();

        return redirect(route('tags.index'))->with('status', 'Tag Deleted Successfully');

    }
}
