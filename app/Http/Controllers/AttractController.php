<?php

namespace App\Http\Controllers;

use App\Models\CustomerInfo;
use App\Models\estate;
use App\Models\Estate_Images;
use App\Models\Options;
use App\Models\Poster;
use App\Models\Poster_Daily_Report;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;
use Symfony\Component\VarDumper\Cloner\Data;
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
        return view('attract.poster_daily_report_form.blade.php');

    }

    public function poster_form(Request $request)
    {

        $poster = Poster::create($request->all());
        $poster->user_id = \auth()->id();
        $poster->save();

        return redirect(route('posters', ['status' => 'ok']));
    }

    public function form_2()
    {
        return view('attract.poster_daily_report_form.blade.php');

    }

    public function posters($user_id = null)
    {
        if (Auth::user()->is_admin) {
            if ($user_id == null) {

                $posters = Poster::query();
            } else {
                $posters = Poster::query()->where('user_id', $user_id);
            }

        } else {
            $posters = Auth::user()->posters();
        }
        return $this->show_posters($posters);

    }

    public function get_poster($id)
    {
        if (Auth::user()->is_admin) {
            $poster = Poster::find($id);
        } else {
            $poster = Auth::user()->posters->find($id);

        }
        return view('attract.get_poster', compact('poster'));

    }

    public function update_poster_page($id)
    {

        if (Auth::user()->is_admin) {
            $poster = Poster::find($id);
        } else {
            $poster = Auth::user()->posters->find($id);

        }

        return view('attract.poster_form_update', compact('poster'));

    }

    public function update_poster(Request $request)
    {
        if (Auth::user()->is_admin) {
            Poster::find($request->get('id'))->update($request->all());
            $poster = Poster::find($request->get('id'));

        } else {
            Auth::user()->posters->find($request->get('id'))->update($request->all());
            $poster = Auth::user()->posters->find($request->get('id'));

        }
        return view('attract.poster_form_update', compact('poster'));

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

        if (Auth::user()->is_admin) {
            $filter = Poster::query();
        } else {
            $filter = Poster::query()->where('user_id', Auth::id());
        }

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

            $filter = $filter->where('social_id', $social);
        }
        if ($attract != null) {
            error_log('attract');

            $filter = $filter->where('user_id', $attract);
        }
        if ($estate_location_type_id != null) {
            error_log('estate_location_type_id');

            $filter = $filter->where('estate_location_type_id', $estate_location_type_id);
        }

        if ($from_date != null) {
            $from_date = CalendarUtils::createCarbonFromFormat('Y/m/d', CalendarUtils::convertNumbers($request->get("from_date"), true))->format('Y-m-d'); //2016-05-8
            $to_date = CalendarUtils::createCarbonFromFormat('Y/m/d', CalendarUtils::convertNumbers(($request->get("to_date") == null) ? Jalalian::forge('today')->format('Y/m/d') : $request->get("to_date"), true))->addDays(1)->format('Y-m-d');
            $filter = $filter->whereBetween("created_at", [$from_date, $to_date]);
        }


        return $this->show_posters($filter);


    }

    public function show_posters($posters)
    {


            if (Auth::user()->is_admin) {
                $excel_array = [];
                foreach ($posters->with(['city', 'estate_type'])->get() as $item) {
                $city = $item->city->name;
                $estate_type = $item->estate_type->name;


                unset($item->city);
                unset($item->estate_type);

                $item->city = $city;
                $item->estate_type = $estate_type;
                $item->created_at = CalendarUtils::strftime('Y-m-d', strtotime($item->created_at)); // 1395-02-19


                array_push($excel_array, $item);
            }
            $keys = [
                'name',
                'phone',
                'estate_type',
                'city',
                'created_at'

            ];


            Session::put('Excel_keys' . Auth::id(), $keys);

            Session::put('Excel' . Auth::id(), $excel_array);
        }

        $final_posters = $posters->paginate(10);
        $final_posters->appends(Request()->all())->links();
        return view('attract.posters', ['posters' => $final_posters]);

    }

    public function delete_poster($id)
    {
        $poster = Poster::find($id);
        $poster->delete();
        return \redirect(request()->headers->get('referer'));
    }

    public function poster_daily_report_form(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('attract.poster_daily_report_form');
        }
        $dateString = CalendarUtils::convertNumbers($request->get('date'), true);
        $created_at = CalendarUtils::createCarbonFromFormat('Y/m/d', $dateString)->format('Y-m-d H:m:s');
        Auth::user()->Poster_daily_report()->create($request->all())->update(['created_at' => $created_at]);
        return view('attract.poster_daily_report_form', ['status' => "ok"]);

    }

    public function poster_daily_report_page(Request $request)
    {
        if ($request->isMethod('GET')) {
            if (Auth::user()->is_admin) {
                $poster_daily_reports = Poster_Daily_Report::query();
            } else {
                $poster_daily_reports = Auth::user()->Poster_daily_report();

            }
            if ($request->get('action') == 'جستجو') {
                $from_date = $request->get("from_date");
                $to_date = $request->get("to_date");
                if ($request->get('attract_id') != null) {

                    $poster_daily_reports = $poster_daily_reports->where("user_id", $request->get('attract_id'));
                }

                if ($from_date != null || $to_date != null) {
                    $from_date = CalendarUtils::createCarbonFromFormat('Y/m/d', CalendarUtils::convertNumbers(($request->get("from_date") == null) ? Jalalian::forge("2020-01-01")->format('Y/m/d') : $request->get("from_date"), true))->format('Y-m-d'); //2016-05-8
                    $to_date = CalendarUtils::createCarbonFromFormat('Y/m/d', CalendarUtils::convertNumbers(($request->get("to_date") == null) ? Jalalian::forge('today')->format('Y/m/d') : $request->get("to_date"), true))->addDays(1)->format('Y-m-d');
                    $poster_daily_reports = $poster_daily_reports->whereBetween("created_at", [$from_date, $to_date]);
                }

            }
            $poster_daily_reports = $poster_daily_reports->paginate(10);
            $poster_daily_reports->appends($request->all())->links();

            return view('attract.posters_daily_report', compact('poster_daily_reports'));

        }
        if ($request->get('action') == 'ویرایش') {
            $dateString = CalendarUtils::convertNumbers($request->get('date'), true);
            $created_at = CalendarUtils::createCarbonFromFormat('Y/m/d', $dateString)->format('Y-m-d H:m:s');
            $poster = Poster_Daily_Report::find($request->get('id'));
            $poster->update($request->all());
            $poster->save();

            $poster->update(['created_at' => $created_at]);
            $poster->save();
        } else {
            $poster = Poster_Daily_Report::find($request->get('id'));
            $poster->delete();
        }


        return redirect($request->headers->get('referer'));

    }

}
