<?php

namespace App\Http\Controllers;

use App\Http\Requests\addProduct;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $sections = Section::all();
        return view('products.products', compact('products', 'sections'));
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
    public function store(addProduct $request)
    {
        Product::create($request->except('_token'));
        session()->flash('add', ' تم اضافة المنتج بنجاح ');
        return redirect('products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $section = Section::where('section_name', '=', $request->section_name)->first();
        if ($section) {
            $section_id = $section->id;
            $product = Product::findOrFail($request->id);
            $product->update([
                'product_name' => $request->product_name,
                'description' => $request->description,
                'section_id' => $section_id
            ]);
            session()->flash('update', 'تم التعديل بنجاح');
            return redirect('products');
        } else {
            session()->flash('error', 'حدث خطأ ما يرجى المحاوله مره اخرى');
            return redirect('products');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
    $deleted = Product::destroy($request->id);
        if ($deleted) {
            session()->flash('delete', 'تم حذف المنتج بنجاح');
            return redirect('products');
        } else {
            session()->flash('error', 'حدث خطأ ما يرجى المحاوله مره اخرى');
            return redirect('products');
        }
    }
}