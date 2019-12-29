<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use DB;
use Entrust;

class TagController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function addTag(){
        if (!Entrust::can('add-tag')) {
            return redirect('/dashboard');
        }          
        return view('tags.add');  
    }

    public function addTagDB(Request $request){
        if (!Entrust::can('add-tag')) {
            return redirect('/dashboard');
        }      

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();

        return back()->withErrors([
            'message' => 'Tag Addedd Successfully',
            'class'   => 'alert-success'
        ]); 
    }

    public function allTags(){
        $tags = Tag::all();
        return view('tags.all' , compact('tags'));
    }

    public function deleteTag(Tag $tag){
        if (!Entrust::can('delete-tag')) {
            return redirect('/dashboard');
        }
        $tag->delete();
        return back()->withErrors([
            'message' => 'Tag Deleted Successfully',
            'class'   => 'alert-success'
        ]); 
    }

    public function editTag(Tag $tag){
        if (!Entrust::can('update-tag')) {
            return redirect('/dashboard');
        }
       return view('tags.edit' , compact('tag'));
    }

    public function updateTag(Request $request , Tag $tag){
        if (!Entrust::can('update-tag')) {
            return redirect('/dashboard');
        }
        $tag->name = $request->name;
        $tag->save();

        return back()->withErrors([
            'message' => 'Tag Updated Successfully',
            'class'   => 'alert-success'
        ]); 
    }

}
