<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\Menu;
use App\Item;
use App\Language;
use App\Person;
use DB;
use Auth;
use Carbon\Carbon;
use App\Role;
use App\Permission;
use App\Template;
use Entrust;


// import the Intervention Image Manager Class
use Intervention\Image\ImageManagerStatic as Image;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard(){
		return view('content.dashboard');
    }
}
