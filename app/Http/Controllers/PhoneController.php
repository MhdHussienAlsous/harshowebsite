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
use App\PhoneLog;
use App\ItemField;
use App\CustomField;
use App\PhoneNumber;
use App\PhoneGallary;
use Illuminate\Http\Request;

class PhoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // this  function to show all phones page
    public function allPhones(){
        if (!Entrust::can('all-phones')) {
            return redirect('/dashboard');
        }
        // Set Arabic Language
        app()->setLocale(SELF::language);
        $phones = PhoneNumber::orderby('name')->get();
    
        return view('phones.all-phones' , compact('phones'));
   }

    public function addPhoneNumber(){
        if (!Entrust::can('add-phone')) {
            return redirect('/dashboard');
        }

        // Set Arabic Language
        app()->setLocale(SELF::language);
        return view('phones.add-phone'); 
    }

    public function storePhone(Request $request){
        // if (!Entrust::can('add-item')) {
        //     return redirect('/dashboard');
        // }

        $phone                  = new PhoneNumber;
        $phone->name            = $request->name;
        $phone->employee_type   = $request->employee_type;
        $phone->company         = $request->company;
        $phone->fax             = $request->fax;
        $phone->email           = $request->email;
        $phone->mobile          = $request->mobile;
        $phone->phone           = $request->phone;
        $phone->notes           = $request->notes;
        $phone->save();

        
      if($request->hasfile('files'))
      {
         foreach($request->file('files') as $file)
         {
            $name = time().'-'.$file->getClientOriginalName();
            $dest = public_path('/phones');
            $file->move($dest, $name);  
            $add_file                   = new PhoneGallary;
            $add_file->name             = $name;  
            $add_file->phone_number_id  = $phone->id;
            $add_file->save();
         }
      }

        return back()->withErrors([
            'message' => 'Phone Numbers Addedd Successfully',
            'class'   => 'alert-success'
        ]); 
    }


    //this function to delete phone from DB
    public function deletePhone(PhoneNumber $phone){
        if (!Entrust::can('all-phones')) {
            return redirect('/dashboard');
        } 
        $phone->delete();
        return back()->withErrors([
            'message' => 'Phone Deleted Successfully',
            'class'   => 'alert-success'
        ]);  
    }


    // this function to show edit phone
    public function editPhone(PhoneNumber $phone){
        if (!Entrust::can('all-phones')) {
            return redirect('/dashboard');
        }  
        // Set Arabic Language
        app()->setLocale(SELF::language);

        $phone      = PhoneNumber::where('id',$phone->id)->first();
        $files      = PhoneGallary::where('phone_number_id',$phone->id)->get();
        return view('phones.edit-phone', compact('phone','files'));
    }


    // this function to show edit phone
    public function showPhone(PhoneNumber $phone){
        if (!Entrust::can('all-phones')) {
            return redirect('/dashboard');
        }
        // Set Arabic Language
        app()->setLocale(SELF::language);

        $phone      = PhoneNumber::with('phoneLog.person')->where('id',$phone->id)->first();
        $files      = PhoneGallary::where('phone_number_id',$phone->id)->get();
        
        return view('phones.phone-details', compact('phone','files'));
    }

    // this function to update phone into DB
    public function updatePhone(Request $request, PhoneNumber $phone){
        if (!Entrust::can('all-phones')) {
            return redirect('/dashboard');
        }
        $languages  = DB::table('languages')->pluck('id');

        $phone->name            = $request->name;
        $phone->employee_type   = $request->employee_type;
        $phone->company         = $request->company;
        $phone->fax             = $request->fax;
        $phone->email           = $request->email;
        $phone->mobile          = $request->mobile;
        $phone->phone           = $request->phone;
        $phone->notes           = $request->notes;
        $phone->save();

        return back()->withErrors([
            'message' => 'Phone Updated Successfully',
            'class'   => 'alert-success'
        ]); 
    }

    
    public function addPhoneNumberNote(PhoneNumber $phone){
        if (!Entrust::can('all-phones')) {
            return redirect('/dashboard');
        }
        $phone = $phone;
        return view('phones.add-phone-notes' , compact('phone'));
    }

    // this function to show edit phone
    public function storePhoneNumberNote(Request $request, PhoneNumber $phone){
        if (!Entrust::can('all-phones')) {
            return redirect('/dashboard');
        }   
        // Set Arabic Language
        app()->setLocale(SELF::language);
        ;

        $p_log                  = new PhoneLog;
        $p_log->title           = $request->title;
        $p_log->note            = $request->note;
        $p_log->phone_number_id = $phone->id;
        $p_log->person_id       = Auth::user()->person->id;
        $p_log->save();

        return back()->withErrors([
            'message' => 'Phone Log Added Successfully',
            'class'   => 'alert-success'
        ]); 
    }



}
