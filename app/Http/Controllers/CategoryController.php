<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:100',
            ],
            [
                'name.required' => 'Nama kategori wajib diisi',
                'name.max' => 'Nama kategori maksimal 100 karakter',
            ]
        );

        Category::create([
            'name' => trim($request->name),
        ]);

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('kategori.index')
            ->with('success', 'Kategori berhasil dihapus');
    }

    public function create()
{
    return view('categories.create');
}

public function edit($id)
{
    $category = Category::findOrFail($id);
    return view('categories.edit', compact('category'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255'
    ]);

    $category = Category::findOrFail($id);
    $category->update([
        'name' => $request->name
    ]);

    return redirect()->route('kategori.index')
                     ->with('success', 'Kategori berhasil diupdate');
}


}
