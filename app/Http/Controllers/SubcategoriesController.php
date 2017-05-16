<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Outcome;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::all();

        return view('subcategories.index', ['subcategories' => $subcategories]);
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


        $id = DB::table('subcategories')->insertGetId(array(
            'title' => $request->subcategory_title,
            'pic' => $request->subcategory_pic,
            'category_id' => $request->category_id
        ));

        $subcategory = Subcategory::find($id);


        return $subcategory;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::where('type', '=', 'outcome')->get();
        return view('subcategories.edit', ['subcategory' => $subcategory, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $subcategory->title = $request->title;
        $subcategory->pic = $request->pic;
        $subcategory->category_id = $request->category_id;
        $subcategory->save();

        return redirect('subcategories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {

        $outcomes = Outcome::where('subcategory_id', '=', $subcategory->id)->get();
        foreach ($outcomes as $outcome){
            $outcome->subcategory_id = null;
            $outcome->save();
        }

        $subcategory->delete();

        return back();
    }

    public function getSubcategories(Request $request) {
        $subcategories = Subcategory::where('category_id', '=', $request->category_id)->get();

        return $subcategories;
    }
}
