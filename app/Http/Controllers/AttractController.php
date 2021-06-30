<?php

namespace App\Http\Controllers;

use App\Models\estate;
use App\Models\Estate_Images;
use App\Models\Options;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;
use function PHPUnit\Framework\isNull;

class AttractController extends Controller
{


    public function index()
    {
        return view("attract.attract");
    }

    public function poster_form_page()
    {
        return view('attract.poster_form');
    }

    public function form_2_page()
    {
        return view('attract.form_2');

    }

    public function poster_form(Request $request)
    {

        $poster = Poster::create($request->all());
        $poster->user_id = \auth()->id();
        $poster->save();
        return view('attract.poster_form');
    }

    public function form_2()
    {
        return view('attract.form_2');

    }

    public function posters()
    {
        $posters=Auth::user()->posters;
        return view('attract.posters',compact('posters'));
    }
    public function get_poster($id){

        $poster=Auth::user()->posters->find($id);
        return view('attract.get_poster' ,compact('poster'));

    }

    public function update_poster_page($id){

        $poster=Auth::user()->posters->find($id);

        return view('attract.poster_form_update',compact('poster'));

    }

    public function update_poster(Request $request)
    {
        Auth::user()->posters->find($request->get('id'))->update($request->all());
        $poster=Auth::user()->posters->find($request->get('id'));
        return view('attract.poster_form_update',compact('poster'));

    }

}
