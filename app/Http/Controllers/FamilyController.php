<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = Family::where('parent_id', NULL)->get();
        return view('index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Family::all();
        $genders = ['L' => 'Laki-laki', 'P' => 'Perempuan'];

        return view('create', compact('parents', 'genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'gender' => 'required',
        ]);

        Family::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'parent_id' => $request->parent
        ]);

        return redirect()->route('family.index')->with('success', 'Family Tree added successfully.');
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
    public function edit(Family $family)
    {
        $parents = Family::all();
        $genders = ['L' => 'Laki-laki', 'P' => 'Perempuan'];

        return view('edit', compact('family', 'genders', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        $rules = [
            'name' => 'required',
            'gender' => 'required',
        ];

        $family->parent_id ? $rules['parent'] = 'required' : '';
        $request->validate($rules);

        $family->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'parent_id' => $family->parent_id ? $request->parent : NULL
        ]);

        return redirect()->route('family.index')->with('success', 'Family Tree updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        if (!count($family->childs)) {
            $family->delete();
            return redirect()->route('family.index')->with('success', 'Family Tree deleted successfully');
        }

        return redirect()->route('family.edit', $family->id)->with('failed', 'Failed to delete. ' . $family->name . ' has children. You must to delete the children first');
    }
}
