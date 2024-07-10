<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kedai;
use Illuminate\Http\Request;

class ManageKedaiController extends Controller
{
    public function index()
    {
        $kedai = Kedai::all();
        return view('pages.admin.kedai.index', compact('kedai'));
    }

    public function edit($id)
    {
        $kedai = Kedai::findOrFail($id);
        return view('pages.admin.kedai.edit', compact('kedai'));
    }

    public function update(Request $request, $id)
    {
        $kedai = Kedai::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image',
        ]);

        $kedai->name = $request->name;
        $kedai->description = $request->description;

        if ($request->hasFile('image')) {
            $kedai->image = $request->file('image')->store('images', 'public');
        }

        $kedai->save();

        return redirect()->route('admin.kedai.index')->with('success', 'Kedai updated successfully.');
    }

    public function destroy($id)
    {
        $kedai = Kedai::findOrFail($id);
        $kedai->delete();
        return redirect()->route('admin.kedai.index')->with('success', 'Kedai deleted successfully.');
    }
}
