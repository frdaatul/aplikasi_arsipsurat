<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $categories = Category::when($q, fn($x)=>$x->where('name','like',"%{$q}%"))
            ->orderBy('id')->paginate(10)->withQueryString();
        return view('categories.index', compact('categories','q'));
    }

    public function create()
    {
        return view('categories.form', ['category'=>new Category(),'mode'=>'create']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=>['required','max:100','unique:categories,name'],
            'description'=>['nullable','max:500'],
        ]);
        Category::create($data);
        return redirect()->route('categories.index')->with('success','Data kategori tersimpan');
    }

    public function edit(Category $category)
    {
        return view('categories.form', ['category'=>$category,'mode'=>'edit']);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name'=>['required','max:100',"unique:categories,name,{$category->id}"],
            'description'=>['nullable','max:500'],
        ]);
        $category->update($data);
        return redirect()->route('categories.index')->with('success','Data kategori terbarui');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success','Kategori dihapus');
    }
}
