<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("index", [
            'food' => Food::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'ingredients' => ['required'],
            'price' => ['required', 'numeric'],
            'rate' => ['required', 'numeric'],
            'types' => ['required'],
            'image' => ['required' ,'image', 'file', 'max:1024']
        ]);

        $validatedData['picture_path'] = $request->file('image')->store('assets/food', 'public');

        Food::create($validatedData);
        return redirect('/')->with('success', 'Food Create Successfully ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         return view('edit', [
            'food' => Food::where('id', $id)->first()
        ]);
    }

    public function editpic($id)
    {
         return view('editpic', [
            'food' => Food::where('id', $id)->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required', 'min:3'],
            'ingredients' => ['required'],
            'price' => ['required', 'numeric'],
            'rate' => ['required', 'numeric'],
            'types' => ['required'],
        ]);

        $food = Food::where('id', $id)->first();
        $food->update($validatedData);

        return redirect('/')->with('success', 'Food Updated Successfully ');
    }

    public function updatepic(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => ['required' ,'image', 'file', 'max:1024']
        ]);

        $food = Food::where('id', $id)->first();

        $validatedData['picture_path'] = $request->file('image')->store('assets/food', 'public');

        $food->update($validatedData);

        return redirect('/')->with('success', 'Food Picture Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Food::where('id', $id)->delete();
        return redirect('/')->with('success', 'Food Deleted Successfully ');
    }
}
