<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use App\Category;
use App\Menu;
use DB;
use Entrust;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    // this function for show add menu page
    public function addMenu(){
        if (!Entrust::can('add-menu')) {
            return redirect('/dashboard');
        }          
        // set Arabic Language
        app()->setLocale(SELF::language);
 
        $menus = Menu::all();
        $categories = Category::all();
        $languages  = Language::all();
        return view('menus.add-menu' , compact('menus' , 'categories' , 'languages'));  
   }


    // this function to add menu into DB
    public function addmenuDB(Request $request){
        if (!Entrust::can('add-menu')) {
            return redirect('/dashboard');
        }      
        $languages  = DB::table('languages')->pluck('id');
        $menu =new Menu;
        $menu->parent=$request->parent;
        $menu->category_id=$request->category_id;
        $menu->save();

        foreach ($languages as $locale) {
            $menu->translateOrNew($locale)->name = request('name'.$locale);
        }
        $menu->save();
        return back()->withErrors([
            'message' => 'Menu Addedd Successfully',
            'class'   => 'alert-success'
        ]); 
    }


    // this function t show all menus page
    public function allMenus(){
        // set Arabic Language
        app()->setLocale(SELF::language);

        $menuss = Menu::all();
        return view('menus.all-menus' , compact('menuss'));
    }

    // this function for delete menu from DB
    public function deleteMenu(Menu $menu){
        if (!Entrust::can('delete-menu')) {
            return redirect('/dashboard');
        }
        foreach ($menu->children as $subMenu) {
            $this->deleteMenu($subMenu);
        }
        $menu->deleteTranslations();
        $menu->delete();
        return back()->withErrors([
            'message' => 'Menu Deleted Successfully',
            'class'   => 'alert-success'
        ]); 
    }



    // this function to get All Children 
    public $AllChildren = array();  
    public function getAllChildren(Menu $menu){
        foreach ($menu->children as $subMenu) {
            $this->getAllChildren($subMenu);
        }
        $this->AllChildren[] = $menu->id;  
    }

    // this function to show edit menu page
    public function editMenu(Menu $menu){
        if (!Entrust::can('update-menu')) {
            return redirect('/dashboard');
        }

       // set Arabic Language
       app()->setLocale(SELF::language);

       $this->getAllChildren($menu);
       $AllChildren = $this->AllChildren;
       $languages   = Language::all();
       $menus       = Menu::whereNotIn('id' , $AllChildren)->get();
       $categories  = Category::all();  
       return view('menus.edit-menu' , compact('menu' , 'languages' , 'menus' , 'categories'));
    }

    // this is funtion to update menu into DB
    public function updateMenu(Request $request , Menu $menu){
        if (!Entrust::can('update-menu')) {
            return redirect('/dashboard');
        }
        $languages  = DB::table('languages')->pluck('id');

        $menu->parent      = $request->parent;
        $menu->category_id = $request->category_id;
        $menu->save();

        foreach ($languages as $locale) {
            $menu->translateOrNew($locale)->name = request('name'.$locale);
            $menu->save();
        }
        return back()->withErrors([
            'message' => 'Menu Updated Successfully',
            'class'   => 'alert-success'
        ]); 
    }
}
