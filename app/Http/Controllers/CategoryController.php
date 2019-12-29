<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use App\Category;
use App\Menu;
use DB;
use Entrust;


class CategoryController extends Controller{
    
public function __construct()
{
    $this->middleware('auth');
}


// this function for show add category page
public function addCategory(){
    if (!Entrust::can('add-category')) {
        return redirect('/dashboard');
    } else {

       // Set Arabic Language
       app()->setLocale(SELF::language);

       $languages  = Language::all();
       $categories = Category::all();
       return view('categories.add-category' , compact('categories' , 'languages'));
   }
}

// this function for add category into DB
public function addCategoryDB(Request $request){
    if (!Entrust::can('add-category')) {
        return redirect('/dashboard');
    }       
    $languages  = DB::table('languages')->pluck('id');
    $category = new Category();
    $category->parent = $request->parent;
    $category->save();

    foreach ($languages as $locale) {
     $category->translateOrNew($locale)->name = request('name'.$locale);
     $category->translateOrNew($locale)->description = request('description'.$locale);
    }
    $category->save();

    return back()->withErrors([
        'message' => 'Category Addedd Successfully',
        'class'   => 'alert-success'
    ]); 
}


// this function for show all categories page
public function allCategories(){
    // Set Arabic Language
    app()->setLocale(SELF::language);
    $categories = Category::all();
    return view('categories.all-categories' , compact('categories'));  
}

// this function for delete category
public function deleteCategory(Category $category){
    if (!Entrust::can('delete-category')) {
        return redirect('/dashboard');
    } 

    foreach ($category->children as $subCategory) {
        $this->deleteCategory($subCategory);
    }
    $category->deleteTranslations();
    $category->delete();
    return back()->withErrors([
        'message' => 'Category Deleted Successfully',
        'class'   => 'alert-success'
    ]);     
}

// this function to get All Children 
public $AllChildren = array();  
public function getAllChildren(Category $category)
{
    foreach ($category->children as $subCategory) {
        $this->getAllChildren($subCategory);
    }
    $this->AllChildren[] = $category->id;  
}


// this function to show edit category page
public function editCategory(Category $category){
    if (!Entrust::can('update-category')) {
        return redirect('/dashboard');
    } else {        
         // set English Language
      app()->setLocale(2);

      $this->getAllChildren($category);
      $AllChildren = $this->AllChildren;
      $languages   = Language::all();
      $categories  = Category::whereNotIn('id' , $AllChildren)->get();
      return view('categories.edit-category' , compact('category' , 'languages' , 'categories'));
    }  
}

// this finction to update category into DB
public function updateCategory(Request $request, Category $category){
    if (!Entrust::can('update-category')) {
        return redirect('/dashboard');
    }             
	$languages  = DB::table('languages')->pluck('id');

    $category->parent = $request->parent;
    $category->save();

    foreach ($languages as $locale) {
     $category->translateOrNew($locale)->name = request('name'.$locale);
     $category->translateOrNew($locale)->description = request('description'.$locale);
     $category->save();
    }
    return back()->withErrors([
        'message' => 'Category Updated Successfully',
        'class'   => 'alert-success'
    ]);   
}


}
