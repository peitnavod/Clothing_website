<?php

namespace App\Http\Controllers;

use App\Components\loadMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $loadMenu;
    private $menu;
    public function __construct(loadMenu $loadMenu, Menu $menu)
    {
        $this->loadMenu = $loadMenu;
        $this->menu = $menu;
    }

    public function index(){
        $menus = $this->menu->paginate(5);
       return  view('admin.menus.index',compact('menus'));
    }
    public function create(){
        $optionMenu = $this->loadMenu->load();
        return view('admin.menus.add',compact('optionMenu'));
    }
    public function store(Request $request)
    {
        $this->menu->create([
           'name' =>  $request->name,
        'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('admin.menus.index');
    }
    public function edit($id){
        $menu = $this->menu->find($id);
        $optionMenu = $this->loadMenu->loadMenuEdit($menu->parent_id);
        return view('admin.menus.edit',compact('menu','optionMenu'));
    }
    public  function update($id, Request $request)
    {
        $this->menu->find($id)->update([
            'name' =>  $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('admin.menus.index');
    }
    public function delete($id){
        $this->menu->find($id)->delete();
        return redirect()->route('admin.menus.index');
    }


}
