<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Categories\CreateCategoriesRequest;
use App\Http\Requests\Categories\UpdateCategoriesRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('categories.index')->with('categories',$category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoriesRequest $request)
    {

        $category = new Category();


    Category::create([
        'name' => $request->name
    ]);

    return redirect(route('categories.index'))->with('status', 'Category Created Successfully');




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
    public function edit(Category $category)
    {
      //$category= Category::find($id);
      //return view('categories.edit')->with('category',$category);
      return view('categories.create')->with('category',$category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoriesRequest $request, Category $category)
    {
        //$category= Category::find($id);

       // $category->name = $request->name;
        //$category->update();

        $category->update([
            'name' => $request->name

        ]);

        return redirect(route('categories.index'))->with('status', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category  )
    {
        //$category=Category::find($id);
        //$category =Category::where('id',$id)->get()->first();

        if($category->posts->count() > 0)
        {
            return redirect(route('categories.index'))->with('error', 'Category Can not deleted becuse it has in some post');


        }

        $category->delete();

        return redirect(route('categories.index'))->with('status', 'Category Deleted Successfully');

    }
}
