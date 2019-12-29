<?php

namespace App\Http\Controllers;

use Entrust;
use App\Offer;
use App\Language;
use App\DivanType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addOffer()
    {
        if (!Entrust::can('add-offer')) {
            return redirect('/dashboard');
        }
        // Set Arabic Language
        app()->setLocale(SELF::language);
        $languages  = Language::all();
        $types      = DivanType::all();
        return view('offers.add-offer' , compact('types','languages'));
    }

    public function storeOffer(Request $request)
    {
        // if (!Entrust::can('add-menu')) {
        //     return redirect('/dashboard');
        // } 


        $offer          = new Offer;
        $offer->type    = $request->type;
        $offer->website = $request->website;
        $offer->state   = 1;
        $offer->person_id   = Auth::user()->id;
        
        // strat upload image into server
        if (isset($request->file)) {
            $name = time().'-'.$request->file->getClientOriginalName();
            $dest = public_path('/offers');
            $request->file->move($dest, $name);  
            $offer->name   = $name;
        }
        $offer->save();

        return back()->withErrors([
            'message' => 'offer Addedd Successfully',
            'class'   => 'alert-success'
        ]); 
    }

    public function allOffers()
    {
        if (!Entrust::can('all-offers')) {
            return redirect('/dashboard');
        }

        $offers = Offer::all();
        app()->setLocale(SELF::language);
        $languages  = Language::all();
        $types      = DivanType::all();
        return view('offers.all-offers' , compact('types','languages','offers'));
    }

    public function deleteOffer($id)
    {
        if (!Entrust::can('all-offers')) {
            return redirect('/dashboard');
        }

        $offer = Offer::where('id',$id)->first();
        $offer->delete();

        return back()->withErrors([
            'message' => 'offer Deleted Successfully',
            'class'   => 'alert-success'
        ]); 
    }

    public function changeState($id)
    {
        // if (!Entrust::can('add-menu')) {
        //     return redirect('/dashboard');
        // }  

        $offer = Offer::where('id',$id)->first();
        $state = $offer->state;
        if($state == 0)
            $state = 1;
        else 
            $state = 0;
        $offer->state = $state;
        $offer->save();
        return back()->withErrors([
            'message' => 'offer state change Successfully',
            'class'   => 'alert-success'
        ]); 
    }

}
