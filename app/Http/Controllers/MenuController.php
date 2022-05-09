<?php

namespace App\Http\Controllers;

use App\Plugins\Cms\Content\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(){
        $menus = Menu::where('parent_id', '=', 0)->get();
        $allMenus = Menu::pluck('title','id')->all();
        return view('menu.menuTreeview',compact('menus','allMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $input = $request->all();
        $input['parent_id'] = empty($input['parent_id']) ? 0 : $input['parent_id'];
        Menu::create($input);
        return back()->with('success', 'Menu added successfully.');
    }

    public function show()
    {
        $menus = Menu::where('parent_id', '=', 0)->get();
        return view('menu.dynamicMenu',compact('menus'));
    }
}