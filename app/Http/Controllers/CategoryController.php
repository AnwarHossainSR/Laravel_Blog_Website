<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function manage()
    {
        $categories = Category::latest()->get();
        return view('admin.category.manage',compact('categories',$categories));
    }
    public function show()
    {
        return view('admin.category.add_form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = strtolower(str_replace('','_',$request->name));
        $category->save();
        return redirect()->route('category.manage')->with('success','Category created successfully');
    }
    public function destroy($id)
    {
       Category::destroy($id);
       return back()->with('success','Category deleted successfully');
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit_form',compact('category',$category));
    }

    public function updateCategory(Request $req)
    {
        $req->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
        $category = Category::find($req->id);
        $category->name = $req->name;
        $category->update();
        return redirect()->route('category.manage')->with('success','Category updated successfully');
    }

    public function hide($id)
    {
        $category = Category::find($id);
        $category->status = 0;
        $category->save();
        return back()->with('success','Category hide successfully');
    }
    public function publish($id)
    {
        $category = Category::find($id);
        $category->status = 1;
        $category->save();
        return back()->with('success','Category publish successfully');
    }
}
