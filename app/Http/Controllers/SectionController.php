<?php

namespace App\Http\Controllers;

use App\Http\Requests\addSection;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        return view('sections.sections', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(addSection $request)
    {
        Section::create([
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => Auth::user()->name
        ]);
        session()->flash('add', 'تم الاضافة بنجاح');
        return redirect('/sections');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $sections)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $section = Section::findOrfail($request->id);
        /*This is my solution for the unique name problem (Validation)*/
        $same_name = $request->section_name == $section->section_name ? true : false;
        if ($same_name) {
            $section->update([
                'description' => $request->description
            ]);
            session()->flash('update', 'تم التعديل على القسم بنجاح');
            return redirect('sections');
        } else {
            $request->validate([
                'section_name' => 'required|unique:sections,section_name',
                'description' => 'required'
            ], [
                'section_name.required' => 'يرجى ادخال اسم القسم',
                'section_name.unique' => 'اسم الفسم مسحل مسبقا',
                'description.required' => 'يرجى ادخال وصف القسم'
            ]);
            $section->update([
                'section_name' => $request->section_name,
                'description' => $request->description
            ]);
            session()->flash('update', 'تم التعديل على القسم بنجاح');
            return redirect('sections');
        }
        /*Another Solution for validation*/
        /*$this->validate($request, [
            'section_name' => 'required|unique:sections,section_name' . $request->id,
            'description' => 'required'
        ], [
            'section_name.required' => 'يرجى ادخال اسم القسم',
            'section_name.unique' => 'اسم الفسم مسحل مسبقا',
            'description.required' => 'يرجى ادخال وصف القسم'
        ]);*/
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $deleted = Section::destroy($request->id);
        if ($deleted) {
            session()->flash('delete', 'تم حذف القسم بنجاح');
            return redirect('/sections');
        }
    }
}
