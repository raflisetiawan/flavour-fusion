<?php

namespace App\Http\Controllers\kedai;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Kedai;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageMenuController extends Controller
{
    public function index()
    {
        $kedai = Kedai::where('user_id', Auth::id())->firstOrFail();
        $menus = $kedai->menus;

        return view('pages.kedai.menu.index', compact('menus'));
    }

    public function create()
    {
        return view('pages.kedai.menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $kedai = Kedai::where('user_id', Auth::id())->firstOrFail();

        $menu = new Menu([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->hasFile('image') ? $request->file('image')->store('images', 'public') : null,
        ]);

        $kedai->menus()->save($menu);

        return redirect()->route('pemilikKedai.menu.index')->with('success', 'Menu created successfully.');
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('pages.kedai.menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $menu->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $request->hasFile('image') ? $request->file('image')->store('images', 'public') : $menu->image,
        ]);

        return redirect()->route('pemilikKedai.menu.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('pemilikKedai.menu.index')->with('success', 'Menu deleted successfully.');
    }

    public function showOrderDetails($menuId)
    {
        $menu = Menu::findOrFail($menuId);
        $orders = OrderDetail::where('menu_id', $menuId)->get();

        return view('pages.kedai.menu.orders', compact('menu', 'orders'));
    }
}
