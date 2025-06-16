<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Dailymenu;

class DailyMenuController extends Controller
{
    private function GetIsAdmin()
    {
        return Auth::id() && Auth::user()->usertype == "1" ? true : false;
    }

    public function index()
    {
        $data = Dailymenu::all();
        $user = Auth::id() ? Auth::user() : null;
        $isAdmin = $this->GetIsAdmin();
        return view("admin.pages.dailymenu.dailymenu", compact("data", "isAdmin", "user"));
    }

    public function create()
    {
        $user = Auth::id() ? Auth::user() : null;
        $isAdmin = $this->GetIsAdmin();
        return view("admin.pages.dailymenu.createdailymenu", compact("user", "isAdmin"));
    }

    public function store(Request $request)
    {
        $isAdmin = $this->GetIsAdmin();
        if($isAdmin === true){
            $data = new Dailymenu;

            $image = $request->productimage;
            $imagename = time().".".$image->getClientOriginalExtension();
            $imagepath = 'assets/images/dailymenu';
            $request->productimage->move($imagepath , $imagename);
            $data->img = $imagepath."/".$imagename;

            $data->name = $request->productname;
            $data->price = $request->productprice;
            $data->desc = $request->productdescription;

            $data->save();
            return redirect()->route('dailymenu.index')->with('msg', 'New Daily menu entry created');
        }
        return redirect()->route('dailymenu.index')->with('msg', "Can't create daily menu entry" );
    }

    public function edit($dailymenu)
    {
        $data = Dailymenu::findOrFail($dailymenu);
        $user = Auth::id() ? Auth::user() : null;
        $isAdmin = $this->GetIsAdmin();
        return view("admin.pages.dailymenu.editdailymenu", compact("data", "user", "isAdmin"));
    }

    public function update($dailymenu, Request $request)
    {
        $isAdmin = $this->GetIsAdmin();
        if($isAdmin === true){
            $data = Dailymenu::findOrFail($dailymenu);

            $image = $request->productimage;
            if($image){
                $imagename = time().".".$image->getClientOriginalExtension();
                $imagepath = 'assets/images/dailymenu';
                $request->productimage->move($imagepath , $imagename);
                $data->img = $imagepath."/".$imagename;
            }
            $data->name = $request->productname;
            $data->price = $request->productprice;
            $data->desc = $request->productdescription;

            $data->save();
            return redirect()->route('dailymenu.index')->with('msg', 'Daily menu entry edited');
        }
        return redirect()->route('dailymenu.index')->with('msg', "Can't edit daily menu entry" );
    }

    public function destroy($dailymenu)
    {
        $isAdmin = $this->GetIsAdmin();
        if($isAdmin === true){
            $data = Dailymenu::findOrFail($dailymenu);
            $data->delete();
            return redirect()->back()->with('msg', 'Daily menu entry deleted successfully');
        }
        return redirect()->route('dailymenu.index')->with('msg', "Can't delete daily menu entry" );
    }
}
