<?php

namespace App\Http\Controllers;

use App\Models\Sub1category;
use Illuminate\Http\Request;

class Sub1categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub1category = Sub1category::all();
        return $sub1category;
        //return response()->json($sub1category);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sub1category = new Sub1category; 

        $request->validate([
            'maincategory' => 'required',
            'name' => 'required',           
        ]);

        $SaveResponse = $sub1category->create($request->all());
        return response()->json([
            'message' => 'category created!',
            'category' => $SaveResponse
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sub1category  $sub1category
     * @return \Illuminate\Http\Response
     */
    public function show(Sub1category $sub1category)
    {
        return $sub1category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sub1category  $sub1category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sub1category $sub1category)
    {
        $request->validate([            
            'name' => 'required',           
        ]);

        $sub1category->update($request->all());
        return response()->json([
            'message' => 'category updated!',
            'category' => $sub1category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sub1category  $sub1category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sub1category $sub1category)
    {
        $sub1category->delete();
        return response()->json([
            'message' => 'category deleted!'
        ]);
    }
}
