<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Income;
use App\Models\Outcome;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::all();

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = DB::table('categories')->insertGetId(array(
            'title' => $request->category_title,
            'pic' => $request->category_pic,
            'type' => $request->type,

        ));

        $category = Category::find($id);


        return $category;


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {


        $category->title = $request->category_title;
        $category->pic = $request->pic;
        $category->type = $request->type;


        $category->save();

        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $subCategories = Subcategory::where('category_id', '=', $category->id)->get();
        foreach ($subCategories as $subCategory) {
            $subCategory->delete();
        }

        $incomes = Income::where('category_id', '=', $category->id)->get();

        foreach ($incomes as $income) {
            $income->category_id = null;
            $income->save();
        }

        $outcomes = Outcome::where('category_id', '=', $category->id)->get();

        foreach ($outcomes as $outcome) {
            $outcome->category_id = null;
            $outcome->subcategory_id = null;
            $outcome->save();
        }

        $category->delete();

        return back();
    }
}
