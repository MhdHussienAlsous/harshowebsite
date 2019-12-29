<?php

namespace App\Http\Controllers;

use App\Divan;
use App\Language;
use App\DivanFile;
use App\DivanType;
use Entrust;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DivanController extends Controller
{
    public function addDivan()
    {
        if (!Entrust::can('add-divan')) {
            return redirect('/dashboard');
        }
        // Set Arabic Language
        app()->setLocale(SELF::language);
        $languages  = Language::all();
        $types      = DivanType::all();
        return view('divan.add-divan' , compact('types','languages')); 
    }

    public function storeDivan(Request $request)
    {
        $code_number ="1500";

        $last_divan = Divan::orderby('id','desc')->first();
        if($last_divan != null){
            $code_number = substr( $last_divan->code,0, -2);
            $code_number = $code_number + 1 ;
        }

        if($request->divan_type_id == 1){
            $description = $request->body;
            $code_number = $code_number . "-A";
        }
        else {
            $description = $request->description;
            $code_number = $code_number . "-B";
        }

        $divan = new Divan;
        $divan->title           = $request->title;  
        $divan->divan_type_id   = $request->divan_type_id ;  
        $divan->code            = $code_number;  
        $divan->description     = $description;  
        $divan->person_id       = Auth::user()->person->id;  
        $divan->save();  

        if($request->hasfile('files'))
        {
            foreach($request->file('files') as $file)
            {
            $name = time().'-'.$file->getClientOriginalName();
            $dest = public_path('/divan');
            $file->move($dest, $name);  

            $add_file           = new DivanFile;
            $add_file->name     = $name;  
            $add_file->divan_id = $divan->id;
            $add_file->save();
            }
        }
    
          return back()->withErrors([
            'message' => 'Divan Addedd Successfully',
            'class'   => 'alert-success'
          ]); 
    }

    public function allDivans()
    {
        if (!Entrust::can('all-divan')) {
            return redirect('/dashboard');
        }

        // Set Arabic Language
        app()->setLocale(SELF::language);
        $divans = Divan::with('type')
                        ->with('person')
                        ->with('divanFile')
                        ->orderby('title')->get();
        return view('divan.all-divans' , compact('divans'));
    }

    // this function to show edit divan
    public function showDivan(Divan $divan){
         if (!Entrust::can('all-divan')) {
            return redirect('/dashboard');
        }
        // Set Arabic Language
        app()->setLocale(SELF::language);

        $divan = Divan::with('type')
                        ->with('person')
                        ->with('divanFile')
                        ->where('id',$divan->id)
                        ->first();
        return view('divan.show-divan', compact('divan'));
    }

    //this function to delete divan from DB
    public function deleteDivan(Divan $divan){
        if (!Entrust::can('all-divan')) {
            return redirect('/dashboard');
        }      
        $divan->delete();
        return back()->withErrors([
            'message' => 'Divan Deleted Successfully',
            'class'   => 'alert-success'
        ]);  
    }


}   
