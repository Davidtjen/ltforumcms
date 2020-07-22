<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Categories\CreateCategoriesRequest;
use App\Http\Requests\Categories\UpdateCategoriesRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('auth', ['except' => ['index']]);
    }

    public function index()
    {
        $categories = Category::all();

        return view('categories.index')->with('categories', $categories);
    }

    public function edit(Category $category)
    {

        return view('categories.edit')->with('category', $category);
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CreateCategoriesRequest $request)
    {
        Category::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Category created successfully.');

        return redirect(route('categories.index'));

    }

    public function show($id)
    {
        //
    }

    public function update(UpdateCategoriesRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name
        ]);

        session()->flash('success', 'Category updated successfully.');

        return redirect(route('categories.index'));
    }

    public function destroy(Category $category)
    {
        if ($category->posts->count()>0){
            session()->flash('error', 'Category cannot be deleted. It is associated with (a) post(s).');
            return redirect()->back();
        }

        $category->delete();

        session()->flash('success', 'Category deleted successfully.');

        return redirect(route('categories.index'));
    }
}
