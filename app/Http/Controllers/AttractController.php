<?php

namespace App\Http\Controllers;

use App\Models\CustomerInfo;
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
use function PHPUnit\Framework\isEmpty;
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

        return redirect(route('posters',['status'=>'ok']));
    }

    public function form_2()
    {
        return view('attract.form_2');

    }

    public function posters($user_id=null)
    {
        if (Auth::user()->is_admin){
            if ($user_id==null)
            {

                $posters=Poster::query()->paginate(10);
            }else{
                $posters=Poster::query()->where('user_id',$user_id)->paginate(10);
            }

        }else{
            $posters=Auth::user()->posters()->paginate(10);
        }
        return view('attract.posters',compact('posters'));

    }
    public function get_poster($id){
        if (Auth::user()->is_admin){
            $poster=Poster::find($id);
        }
        else{
            $poster=Auth::user()->posters->find($id);

        }
        return view('attract.get_poster' ,compact('poster'));

    }

    public function update_poster_page($id){

        if (Auth::user()->is_admin){
            $poster=Poster::find($id);
        }
        else{
            $poster=Auth::user()->posters->find($id);

        }

        return view('attract.poster_form_update',compact('poster'));

    }

    public function update_poster(Request $request)
    {
        if (Auth::user()->is_admin){
            Poster::find($request->get('id'))->update($request->all());
            $poster=Poster::find($request->get('id'));

        }
        else{
            Auth::user()->posters->find($request->get('id'))->update($request->all());
            $poster=Auth::user()->posters->find($request->get('id'));

        }
        return view('attract.poster_form_update',compact('poster'));

    }

    public function search_posters(Request $request)
    {
        $estate_type = $request->get("estate_type");
        $from_date = $request->get("from_date");
        $city = $request->get("city");

        $to_date = $request->get("to_date");
        $social = $request->get("social_id");
        $max_price = $request->get("allocate");
        $attract = $request->get("attract_id");
        $estate_location_type_id = $request->get("estate_location_type_id");


        $filter = Poster::query();

        if ($estate_type != null) {
            error_log('estate_type');

            $filter = $filter->where("estate_type_id", $estate_type);

        }
        if ($max_price != null) {
            error_log('max price');
            $filter = $filter->where('allocate', '<=', (int)$max_price);
        }

        if ($city != null) {
            error_log('city');

            $filter = $filter->where("city_id", $city);
        }

        if ($social != null) {
            error_log('social_id');

            $filter = $filter->where('social_id',$social);
        }
        if ($attract != null) {
            error_log('attract');

            $filter = $filter->where('user_id',$attract);
        }
        if ($estate_location_type_id != null) {
            error_log('estate_location_type_id');

            $filter = $filter->where('estate_location_type_id',$estate_location_type_id);
        }

        if ($from_date != null) {
            $from_date = CalendarUtils::createCarbonFromFormat('Y/m/d', CalendarUtils::convertNumbers($request->get("from_date"), true))->format('Y-m-d'); //2016-05-8
            $to_date = CalendarUtils::createCarbonFromFormat('Y/m/d', CalendarUtils::convertNumbers(($request->get("to_date") == null) ? Jalalian::forge('today')->format('Y/m/d') : $request->get("to_date"), true))->addDays(1)->format('Y-m-d');
            $filter = $filter->whereBetween("created_at", [$from_date, $to_date]);
        }

        $posters= $filter->paginate(10);
        $posters->appends($request->all())->links();


        return view('attract.posters', ['posters' => $posters]);

    }

}
