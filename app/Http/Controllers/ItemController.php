<?php
namespace App\Http\Controllers;
use DB;
use Auth;
use App\Tag;
use Entrust;
use App\Item;
use App\Menu;
use App\Role;
use App\User;
use App\Category;
use App\ItemFile;
use App\ItemType;
use App\Language;
use App\Imagepath;
use App\ItemField;

// import the Intervention Image Manager Class
use Carbon\Carbon;
use App\CustomField;
use App\CategoryTranslation;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;


class ItemController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  // this  function to show all items page
  public function allItems(){
   // Set Arabic Language
   app()->setLocale(SELF::language);
   $items = Item::with('category')->with('person')->paginate(20);
   return view('item.all-items' , compact('items'));
  }

  // this function ao show add item page
  public function addItem(){
    if (!Entrust::can('add-item')) {
      return redirect('/dashboard');
    }
    // Set Arabic Language
    app()->setLocale(SELF::language);

    $categories = Category::all();
    $languages  = Language::all();
    $types      = ItemType::all();
    $tags       = Tag::all();
    
    return view('item.add-item' , compact('categories' , 'languages' , 'types' , 'tags')); 
  }

  // this function to add item into DB
  public function storeItem(Request $request){
    if (!Entrust::can('add-item')) {
      return redirect('/dashboard');
    }
    if($request->tags != null && $request->related == "on")
      $related_post_type = "1";
    else if($request->tags == null && $request->related == "on")
      $related_post_type = "2";
    else if($request->tags == null && $request->related != "on")
      $related_post_type = "3";
    

      $languages                = DB::table('languages')->pluck('id');
      $item                     = new Item;
      $item->category_id        = $request->category_id;
      $item->person_id          = $request->person_id;
      $item->views              = '0';
      $item->url                = $request->url;
      $item->item_type_id       = $request->type_id;
      $item->image_title        = $request->image_title;
      $item->related_post_type  = $related_post_type;
      $item->save();  



      foreach ($languages as $locale) {
        $item->translateOrNew($locale)->title          = request('title'.$locale);
        $item->translateOrNew($locale)->body           = htmlentities(request('body'.$locale));
        $item->translateOrNew($locale)->private_notes  = request('private_notes'.$locale);
        $item->translateOrNew($locale)->introduction   = request('introduction'.$locale);
      }
        $item->image = "default.png";
      // strat upload image into server
      if (isset($request->image)) {
          $image_name  = rand().time().rand().'.'.$request->image->getClientOriginalExtension();
          $image_path = 'uploads/'.$image_name;
          Image::make($request->image)->resize(640, 426)->save($image_path);
          $item->image = $image_name;
      }
      // end upload image into server
      $item->save();

      
      if($request->hasfile('files'))
      {
         foreach($request->file('files') as $file)
         {
            $name = time().'-'.$file->getClientOriginalName();
            $dest = public_path('/files');
            $file->move($dest, $name);  

            $add_file           = new ItemFile;
            $add_file->name     = $name;  
            $add_file->item_id  = $item->id;
            $add_file->save();
         }
      }


      // link item with tags
      $item->tags()->attach($request->tags);

      // get category item
      $category = Category::where('id' , $request->category_id)->first();

      // store custom fields category 
      if(!empty($category->fields)){
        foreach ($category->fields as $field) {
          $CustomField           = new CustomField;
          $CustomField->value    = request($field->name);
          $CustomField->field_id = $field->id;
          $CustomField->item_id  = $item->id;
          $CustomField->save();
        }
      }

      // get fields without category
      $fields = ItemField::where('category_id' , 0)->get();
      if (!empty($fields)) {
        foreach ($fields as $field) {
          $CustomField           = new CustomField;
          $CustomField->value    = request($field->name);
          $CustomField->field_id = $field->id;
          $CustomField->item_id  = $item->id;
          $CustomField->save();
        }
      }

      return back()->withErrors([
        'message' => 'Item Addedd Successfully',
        'class'   => 'alert-success'
      ]); 
  }

  //this function to delete item from DB
  public function deleteItem(Item $item){
    if (!Entrust::can('delete-item')) {
      return redirect('/dashboard');
    }        
      $item->deleteTranslations();

          // delete fields on pivot value 
      $item->fields()->detach();

      $item->delete();
      return back()->withErrors([
        'message' => 'Item Deleted Successfully',
        'class'   => 'alert-success'
      ]);  
  }

  // this function to show edit item
  public function editItem(Item $item){
    if (!Entrust::can('update-item')) {
      return redirect('/dashboard');
    }     
    // Set Arabic Language
    app()->setLocale(SELF::language);
    $languages  = Language::all();
    $categories = Category::all();
    $tags       = Tag::all();
    $files      = ItemFile::where('item_id',$item->id)->get();
    return view('item.edit-item', compact('item' , 'languages' , 'categories' , 'tags','files'));
  }

  // this function to update item into DB
  public function updateItem(Request $request, Item $item){
    if (!Entrust::can('update-item')) {
      return redirect('/dashboard');
    }  
      $languages  = DB::table('languages')->pluck('id');

      $item->category_id = $request->category_id;
      $item->save();

      foreach ($languages as $locale) {
        $item->translateOrNew($locale)->title = request('title'.$locale);
        $item->translateOrNew($locale)->private_notes  = request('private_notes'.$locale);
        $item->translateOrNew($locale)->body = htmlentities(request('body'.$locale));
        $item->save();
      }

      
      // link item with tags
      $item->tags()->sync($request->tags);

      if (count($item->fields) != 0) {
        foreach ($item->fields as $field) {
          $CustomField = CustomField::where('item_id' , $item->id)->where('field_id' , $field->id)->first();
          $CustomField->value = request($field->name);
          $CustomField->save();
        }
      }

      return back()->withErrors([
        'message' => 'Item Updated Successfully',
        'class'   => 'alert-success'
      ]); 
  }


  // public function uploadData(Request $request)
  // {

  //   $file_name = 'pieces'.time().'.'. $request->file->getClientOriginalExtension();
  //   $request->file->move(public_path('upload'), $file_name);

  //   $handle = fopen('upload/'. $file_name , "r");
  //   $i=0;
  //   while ($csvLine = fgetcsv($handle, ",")) {

	// 		$id       = $csvLine[0];
	// 		$title    = $csvLine[1];
	// 		$content  = $csvLine[2];
	// 		$category = $csvLine[3];
  //     $user_id 	= $csvLine[4];
      

  //     if (strpos($category, '>') !== false) {
  //         $category = "83";
  //     }

  //     $category = CategoryTranslation::where('name' , $category)->first();
  //     if(empty($category)){
  //       $category = "83";
  //     } else {
  //       $category = $category->category_id;
  //     }

  //     if($i<20){
  //       $languages                = DB::table('languages')->pluck('id');
  //       $item                     = new Item;
  //       $item->category_id        = $category;
  //       $item->person_id          = 4;
  //       $item->views              = '0';
  //       $item->url                = "";
  //       $item->item_type_id       = '1';
  //       $item->image_title        = "";
  //       $item->related_post_type  = '1';
  //       $item->old_item_id        = $id;
  //       $item->save();  

  //       foreach ($languages as $locale) {
  //         $item->translateOrNew($locale)->title          = $title;
  //         $item->translateOrNew($locale)->body           = htmlentities($content);
  //         $item->translateOrNew($locale)->private_notes  = request('private_notes'.$locale);
  //       }
  //       $item->save();
  //     }

  //     $i++;

	// 	}
  // }

  public function uploadData(Request $request)
  {

    // $file_name = 'pieces'.time().'.'. $request->file->getClientOriginalExtension();
    // $request->file->move(public_path('upload'), $file_name);

    // $handle = fopen('upload/'. $file_name , "r");

    // while ($csvLine = fgetcsv($handle, ",")) {

		// 	$post_id        = $csvLine[0];
		// 	$post_date      = $csvLine[1];
    //   $post_title     = $csvLine[2];
    //   $post_content   = $csvLine[3];
    //   $post_name      = $csvLine[4];
    //   $category_name  = $csvLine[5];

    //   $post_image     = Imagepath::where('post_id',$post_id)->first();

    //   if($post_image){
    //     $post_image->post_title   = $post_title;
    //     $post_image->post_cotent  = $post_content;
    //     $post_image->category     = $category_name;
    //     $post_image->post_date    = $post_date;
    //     $post_image->save();
    //   } else {

    //   }

    // }

    $count = $request->num;
    $main_posts = Imagepath::offset($count)->take(2000)->get();

    foreach($main_posts as $p){
      $cate = CategoryTranslation::where('name',$p->category)->first();
      if(!$cate) $category_id = 90;
      else $category_id = $cate->category_id;
      $languages                = DB::table('languages')->pluck('id');
      $item                     = new Item;
      $item->category_id        = $category_id;
      $item->person_id          = 5;
      $item->views              = '0';
      $item->item_type_id       = 1;
      $item->related_post_type  = 2;
      $item->save();  

      $p_date = new Carbon($p->post_date);
      $p_date->format('Y-m-d H:i:s');

      foreach ($languages as $locale) {
        $item->translateOrNew($locale)->title          = $p->post_title;
        $item->translateOrNew($locale)->body           = htmlentities($p->post_cotent);
        $item->translateOrNew($locale)->created_at     = $p_date;
        $item->translateOrNew($locale)->updated_at     = $p_date;
      }

      $item->image = $p->image;

      $item->save();

    }
    return "ok";
    

  }


}
