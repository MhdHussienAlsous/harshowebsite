<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Category;
use App\Item;
use App\Offer;
use App\Language;
use App\Template;
use DB;
use Session;

class HomeController extends Controller
{
    const local     = '85';
    const politcal  = '86';
    const economy   = '87';
    const speial    = '88';
    const artnews   = '89';
    const general   = '90';
    const sport     = '91';
    const lastwrite = '92';
    const video     = '93';

    public function setLanguage(Request $request)
    {
        $language = $request->lang;
        Session::put('lang', $language);  
        return back();
    }

    // this function to show home page
    public function homePage(){
         app()->setLocale(SELF::language);
         \Carbon\Carbon::setLocale('ar');

         // get last 11 items 
         $lastItems  = Item::with('category')->where('item_type_id' , '1')->orderBy('id', 'desc')->limit(10)->get();
         
         $sliderItem  = Item::with('category')->where('item_type_id' , '1')->orderBy('id', 'desc')->first();
         // get local news 
         $localItems = Item::with('category')->where('category_id' , SELF::local)->orderBy('id', 'desc')->limit(5)->get();
     
         // get politcal news 
         $politcal_items = Item::with('category')->where('category_id' , SELF::politcal)->orderBy('id', 'desc')->limit(3)->get();

         // get economy items
         $economy_items = Item::with('category')->where('category_id' , SELF::economy)->orderBy('id', 'desc')->limit(10)->get();

         // get speial 
         $speial_items = Item::with('category')->where('category_id' , SELF::speial)->orderBy('id', 'desc')->limit(3)->get();

         // get artnews
         $artnews_items = Item::with('category')->where('category_id' , SELF::artnews)->orderBy('id', 'desc')->limit(3)->get();

         // get general items
         $general_items = Item::with('category')->where('category_id' , SELF::general)->orderBy('id', 'desc')->limit(4)->get();
         
         // get sport items
         $sport_items = Item::with('category')->where('category_id' , SELF::sport)->orderBy('id', 'desc')->limit(4)->get();

         // get medicine items  
         $lastwrite_items = Item::with('category')->where('category_id' , SELF::lastwrite)->orderBy('id', 'desc')->limit(4)->get();

        // get video items 
         $videoItems = Item::with('category')->where('category_id' , SELF::video)->orderBy('id', 'desc')->limit(3)->get();

         $menus = Menu::where('parent',0)->orderBy('menus.id', 'asc')->with('children')->get();

         return view('home.template1.index' 
         , compact('menus' , 'lastItems' , 'localItems' , 'sliderItem',
                    'politcal_items'  ,'economy_items','speial_items',
                    'artnews_items','general_items','lastwrite_items','sport_items',
                    'videoItems'));
        
    }

    // this function to show section page
    public function menuPage($id){ 
      // set  Language
         app()->setLocale(SELF::language);
         \Carbon\Carbon::setLocale('ar');
		  $menu = Menu::with('category')->whereId($id)->first();

		  if($menu->category->children->count() > 1){
            return view('home.template1.sections' , compact('menu'));
		  } else {
        // he has one category without children
        $articles = Item::where('category_id' , $menu->category->id)
        ->orderBy('id','DESC')->paginate(21);
  	    return view('home.template1.section' , compact('menu' , 'articles'));
      }  
    }

    // this function to show category page
    public function catPage($id){
        // set  Language
        app()->setLocale(SELF::language);
        \Carbon\Carbon::setLocale('ar');
        $category = Category::with('children')->where('id' , $id)->first();

        if($category->children->count() > 1){
            return view('home.template1.categories' , compact('category'));
        } else {
            $articles = Item::all()->where('category_id' , $category->id);
            return view('home.template1.category' , compact('category' , 'articles'));
        }
    }

    // this function to show article page
    public function itemPage(Item $item){
        // set  Language
        app()->setLocale(SELF::language);
        \Carbon\Carbon::setLocale('ar');
        $item->views = $item->views + 1;
        $item->save();
        $cat         =  $item->category_id;
        $section_id  = Menu::where('category_id',$cat)->first();
        $section_id = $section_id->id;
  
        if($item->related_post_type == 3)
            $items = Item::with('category')
                            ->where('category_id' , $item->category_id)
                            ->where('id' , '!=' , $item->id)
                            ->where('person_id',$item->person_id)
                            ->orderBy('id', 'desc')
                            ->limit(3)
                            ->get();
        else 
        $items = Item::with('category')
                            ->where('category_id' , $item->category_id)
                            ->where('id' , '!=' , $item->id)
                            ->orderBy('id', 'desc')
                            ->limit(3)
                            ->get();
                            
                            
        // get most views items 
        $mostViewes = Item::with('category')->orderBy('views', 'desc')->limit(3)->get();

        $v_offer = Offer::where('state',1)
                        ->where('type','v')
                        ->inRandomOrder()
                        ->first();

        $h_offer = Offer::where('state',1)
                        ->where('type','h')
                        ->inRandomOrder()
                        ->first();

        return view('home.template1.item' , compact('item' , 'items','v_offer', 'mostViewes',
                                                    'h_offer','section_id'));  
    }
}
