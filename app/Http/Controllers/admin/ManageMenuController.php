<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kedai;

class ManageMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::with('kedai')->get();
        return view('pages.admin.menus.index', compact('menus'));
    }

    public function create()
    {
        $kedais = Kedai::all();
        return view('pages.admin.menus.create', compact('kedais'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kedai_id' => 'required|exists:kedais,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::create($validatedData);

        return redirect()->route('admin.manage-menus.index')->with('success', 'Menu created successfully.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $kedais = Kedai::all();
        return view('pages.admin.menus.edit', compact('menu', 'kedais'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validatedData = $request->validate([
            'kedai_id' => 'required|exists:kedais,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($validatedData);

        return redirect()->route('admin.manage-menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return redirect()->route('admin.manage-menus.index')->with('success', 'Menu deleted successfully.');
    }
}
