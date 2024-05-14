<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $phones = Phone::all();
        return view('phones.index', compact('phones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('phones.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validated();
        if ($request->hasFile('cover_image')) {
            $filePath = Storage::disk('public')->put('images/cover_image', request()->file('cover_image'));
            $validated['cover_image'] = $filePath;
        }

        Phone::create($validated);
        return redirect()->route('phone.index')->with('success', 'Phone created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Phone $phone)
    {
        //
        return view('phones.show', compact('phone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Phone $phone)
    {
        //
        $categories = Category::all();
        return view('phones.edit', compact('phone', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Phone $phone)
    {
        //
        $validated = $request->validated();

        if ($request->hasFile('cover_image')) {
            Storage::disk('public')->delete($phone->cover_image);

            $filePath = Storage::disk('public')->put('images/cover_image', request()->file('cover_image'), 'public');
            $validated['cover_image'] = $filePath;
        }

        $phone->update($validated);
        return redirect()->route('phones.index')->with('success', 'Phone updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Phone $phone)
    {
        //
        Storage::disk('public')->delete($phone->cover_image);

        $phone->delete();
        return redirect()->route('phones.index')->with('success', 'Phone deleted successfully.');
    }
}
