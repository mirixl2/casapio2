<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\Specialdishes;
use App\Models\Testimonial;


class HomeController extends Controller
{
    /**
     * Variable containing navigation data.
     *
     */
    private $navdata = [
        ["text" => "inicio", "href" => "#home"],
        ["text" => "sobre", "href" => "#about"],
        ["text" => "menú", "href" => "#menu"],
        ["text" => "opiniones", "href" => "#testimonial"],
        ["text" => "reservar", "href" => "#book"],
        ["text" => "contacto", "href" => "#contact"],
    ];

    /**
     * Display a home page of foodfun with all info.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $navdata = $this->navdata;
        $fooddata = food::all();
        $dishesdata = specialdishes::all();
        $testimonialdata = testimonial::all();
        return view("home.index", compact('navdata', 'fooddata', 'dishesdata', 'testimonialdata'));
    }
}
