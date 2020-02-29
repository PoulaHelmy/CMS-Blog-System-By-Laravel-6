<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Category;
class CategoriesController extends Controller
{

    public function index()
    {
       return view('categories.index')->with('categories',Category::all());
    }


    public function create()
    {
        return view('categories.create');
    }


    public function store(CategoryRequest $request)
    {

        Category::create($request->all());
        session()->flash('success','Category Created Successfully');
        return redirect( route('categories.index'));

    }


    public function show($id)
    {
        //
    }


    public function edit(Category $category)
    {
        return view('categories.create')->with('category',$category);
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $category->update([
            'name'=>$request->name
        ]);
        session()->flash('success','Category Updated Successfully');
        return redirect(route('categories.index'));
    }


    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success','Category Deleted Successfully');
        return redirect(route('categories.index'));
    }
}
