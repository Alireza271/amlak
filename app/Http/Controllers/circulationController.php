<?php

namespace App\Http\Controllers;

use App\Models\estate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class circulationController extends Controller
{
    public function index()
    {
        return view('circulation.circulation');
    }

    public function add_estate_page()
    {
        return view("circulation.add_estate");
    }

    public function add_estate(Request $request)
    {

        $estate = estate::create([
            "estate_type_id" => $request->get('estate_type'),
            "estate_location_type_id" => $request->get('estate_location_type'),
            "building_type_id" => $request->get('building_type'),
            "city_id" => $request->get('city'),
            "location_id" => $request->get('location'),
            "user_id" => Auth::id(),
            "owner_name" => $request->get('owner_name'),
            "owner_phone" => $request->get('owner_phone'),
            "area" => $request->get('area'),
            "building_area" => $request->get('building_area'),
            "building_date" => $request->get('build_date'),
            "price" => $request->get('price'),
            "length" => $request->get('length'),
            "width" => $request->get('width'),
            "description" => $request->get('description'),
            "address" => $request->get('address'),
            "floors_count" => $request->get('floors_count'),
            "floors" => $request->get('floors'),
            "module" => $request->get('module'),
        ]);


        $estate->fresh()->used_type()->attach($request->get('used_type'));
        $estate->fresh()->conditions_type()->attach($request->get('condition'));
        $estate->fresh()->documents()->attach($request->get('document'));
        $estate->fresh()->options()->attach($request->get('option'));
        $estate->fresh()->vila_options()->attach($request->get('vila_option'));
        $i = true;

        if ($request->has("image")) {
            foreach ($request->file('image') as $file) {

                $fileName = time() . '.' . $file->getClientOriginalName();

                if ($i) {
                    $img = Image::make($file->getRealPath())->resize(100, 100);
                    $img->save('/home1/shpourir/public_html/images/thumbnails/' . $fileName, 80);

                    $estate->thumbnail = $fileName;
                    $estate->save();
                    $i = false;
                }
                $file->move('/home1/shpourir/public_html/images/', $fileName);

                $estate->fresh()->images()->create([
                        'file_name' => $fileName,
                    ]
                );
            }

        }

        return redirect(route('add_estate_page', ["status" => 'ok']));

    }


    public function estates()
    {
        $estates = Auth::user()->estate()->Paginate(10);
        $custom_filter = [];

        return view('circulation.estates', compact("estates", "custom_filter"));
    }

    public function update_estate_page($id)
    {
        $referer_url = request()->headers->get('referer');

        if (Auth::user()->is_admin) {
            $estate = estate::find($id);

        } else {
            $estate = Auth::user()->estate->find($id);

        }
        $estate_type = $estate->estate_type->id;
        return view("circulation.update_estate", ['estate' => $estate, 'estate_type' => $estate_type, 'referer_url' => $referer_url]);
    }

    public function update_estate(Request $request)
    {

        if (Auth::user()->is_admin) {
            $estate = estate::find($request->get('estate_id'));

        } else {
            $estate = Auth::user()->estate->find($request->get('estate_id'));

        }
        $estate->update(
            [
                "estate_location_type_id" => $request->get("estate_location_type"),
                "building_type_id" => $request->get('building_type'),
                "city_id" => $request->get('city'),
                "location_id" => $request->get('location'),
                "owner_name" => $request->get('owner_name'),
                "owner_phone" => $request->get('owner_phone'),
                "area" => $request->get('area'),
                "building_area" => $request->get('building_area'),
                "building_date" => $request->get('build_date'),
                "price" => $request->get('price'),
                "length" => $request->get('length'),
                "width" => $request->get('width'),
                "description" => $request->get('description'),
                "address" => $request->get('address'),
                "floors_count" => $request->get('floors_count'),
                "floors" => $request->get('floors'),
                "module" => $request->get('module'),
            ]
        );
        $estate->fresh()->used_type()->detach();
        $estate->fresh()->used_type()->attach($request->get('used_type'));

        $estate->fresh()->conditions_type()->detach();
        $estate->fresh()->conditions_type()->attach($request->get('condition'));

        $estate->fresh()->documents()->detach();
        $estate->fresh()->documents()->attach($request->get('document'));

        $estate->fresh()->options()->detach();
        $estate->fresh()->options()->attach($request->get('option'));

        $estate->fresh()->vila_options()->detach();
        $estate->fresh()->vila_options()->attach($request->get('vila_option'));
        $params = [];

        $url = parse_url($request->get('referer_url'));
        if (isset($url['query'])) {
            parse_str($url['query'], $params);
        }
        $params['edited'] = 'ok';
        return redirect($url['path'] . "?" . http_build_query($params));
    }

    public function get_estate($id)
    {
        $estate = estate::find($id);

        return view("circulation.get_estate", compact("estate"));
    }

    public function search_estate(Request $request)
    {
        $custom_filter = array();
        $query = $request->get("query");
        $city = $request->get("city");
        $location = $request->get("location");
        $estate_type = $request->get("estate_type");
        $from_date = $request->get("from_date");
        $to_date = $request->get("to_date");

        $min_area = $request->get("min_area");
        $max_area = $request->get("max_area");

        $min_building_area = $request->get("min_building_area");
        $max_building_area = $request->get("max_building_area");

        $min_price = $request->get("min_price");


        $max_price = $request->get("max_price");


        $filter = estate::query();

        if (request()->has('all_estate')) {
            $custom_filter ["all_estate"] = $request->get("all_estate");

        } elseif ($request->has("selected_user")) {
            $custom_filter["selected_user"] = $request->get('selected_user');
            $filter = $filter->where('user_id', $request->get('selected_user'));
        } else {
            $filter = $filter->where('user_id', Auth::id());
        }

        if ($request->has("date_range")) {


            //
            $custom_filter ["date_range"] = $request->get("date_range");
            $filter->where('created_at', ">=", $request->get('date_range'));
        }


        if ($query != null) {
//            $get_by_id = $filter->where("id", $query);
            if (false) {
//                $filter = $get_by_id;
            } else {
                if (Auth::user()->is_admin) {
//جستجو بین همه شماره ها در صورت درخواست ادمین-
                    $filter = $filter->Where([["owner_phone", 'LIKE', '%' . $query . '%']])
                        ->orWhere([["owner_name", "LIKE", '%' . $query . '%']])
                        ->orWhere([["id", "LIKE", '%' . $query . '%']])
                        ->orWhere([["description", "LIKE", '%' . $query . '%']]);
                } else {
                    //جستجو با شماره بین املاک ثبت شده هر کاربر برای خودش
                    $filter = $filter->Where([["owner_phone", 'LIKE', '%' . $query . '%'], ['user_id', \auth()->id()]])
                        ->orWhere([["owner_name", "LIKE", '%' . $query . '%'], ['user_id', auth()->id()]])
                        ->orWhere([["id", "LIKE", '%' . $query . '%'], ['user_id', auth()->id()]])
                        ->orWhere([["description", "LIKE", '%' . $query . '%'], ['user_id', auth()->id()]]);
                }

            }

        } else {


            if ($city != null) {
                error_log('city');

                $filter = $filter->where("city_id", $city);
            }

            if (\request("estate_location_type") != null) {
                error_log('estate_location_type');

                $filter = $filter->where("estate_location_type_id", \request("estate_location_type"));
            }

            if (\request("building_type") != null) {
                error_log('building_type');

                $filter = $filter->where("building_type_id", \request("building_type"));
            }
            if (\request("floors_count") != null) {
                error_log('floors_count');

                $filter = $filter->where("floors_count", \request("floors_count"));
            }


            if ($location != null) {
                error_log('location');

                $filter = $filter->where("location_id", $location);

            }

            if ($estate_type != null) {
                error_log('estate_type');

                $filter = $filter->where("estate_type_id", $estate_type);

            }


            //area
            if ($min_area != null) {
                error_log('area.');

                $filter = $filter->where('area', '>=', (int)$min_area);
            }

            if ($max_area != null) {
                error_log('max area');

                $filter = $filter->where('area', '<=', (int)$max_area);
            }
            //end_area


            //  //building_area
            if ($min_building_area != null) {
                error_log('Smin building');

                $filter = $filter->where('building_area', '>=', (int)$min_building_area);
            }

            if ($max_building_area != null) {
                error_log('max building.');

                $filter = $filter->where('building_area', '<=', (int)$max_building_area);
            }
            //end_building_area


            //price
            if ($min_price != null) {

                $filter = $filter->where('price', '>=', (int)$min_price);
            }

            if ($max_price != null) {
                error_log('max price');

                $filter = $filter->where('price', '<=', (int)$max_price);
            }
            //end_price


            ///////// checkBoxs

            if ($request->has('options')) {

                foreach (\request('options') as $item) {

                    $filter = $filter->whereHas('options', function ($query) use ($item) {
                        $query->where('options_id', $item);
                    });
                }


            }

            if ($request->has('documents')) {

                foreach (\request('documents') as $item) {
                    $filter = $filter->whereHas('documents', function ($query) use ($item) {
                        $query->where('document_id', $item);
                    });
                }


            }

            if ($request->has('condition')) {

                foreach (\request('condition') as $item) {
                    $filter = $filter->whereHas('conditions_type', function ($query) use ($item) {
                        $query->where('conditions_type_id', $item);
                    });
                }


            }

            if ($request->has('used_type')) {

                foreach (\request('used_type') as $item) {
                    $filter = $filter->whereHas('used_type', function ($query) use ($item) {
                        $query->where('used_type_id', $item);
                    });
                }


            }
            if ($request->has('vila_option')) {

                foreach (\request('vila_option') as $item) {
                    $filter = $filter->whereHas('vila_options', function ($query) use ($item) {
                        $query->where('vila_options_id', $item);
                    });
                }


            }


            ////////end checkboxs

            if ($from_date != null) {
                $from_date = CalendarUtils::createCarbonFromFormat('Y/m/d', CalendarUtils::convertNumbers($request->get("from_date"), true))->format('Y-m-d'); //2016-05-8
                $to_date = CalendarUtils::createCarbonFromFormat('Y/m/d', CalendarUtils::convertNumbers(($request->get("to_date") == null) ? Jalalian::forge('today')->format('Y/m/d') : $request->get("to_date"), true))->addDays(1)->format('Y-m-d');

                $filter = $filter->where("created_at", ">=", $from_date)->where('created_at', "<=", $to_date);

            }
        }


        $estates = $filter->paginate(10);
        $estates->appends($request->all())->links();
//
//
////        return Auth::user()->estate->whereBetween("created_at",[$from_date,$to_date]);
//        $estates = $estates->get();
        return view('circulation.estates', ['estates' => $estates, "custom_filter" => $custom_filter]);

    }

    public
    function all_estates()
    {
        $estates = estate::orderBy('created_at', "DESC")->Paginate(10);
        $custom_filter = [
            "all_estate" => "1"
        ];

        return view('circulation.estates', ["estates" => $estates, "custom_filter" => $custom_filter]);


    }

    public function estates_of_day($id = null)
    {

        if ($id!=null) {
            $estate = estate::query()->where("user_id", $id)->where("created_at", ">=", Carbon::today())->paginate(10);
            $custom_filter['selected_user'] = $id;
        } elseif (Auth::user()->is_admin) {

            $estate = estate::query()->where("created_at", ">=", Carbon::today())->paginate(10);
            $custom_filter ['all_estate'] = 1;
        } else {
            $estate = Auth::user()->estate()->where("created_at", ">=", Carbon::today())->paginate(10);
        }
        $custom_filter ['date_range'] = Carbon::today();
        return view('circulation.estates', ['estates' => $estate, "custom_filter" => $custom_filter]);
    }

    public function estates_of_week($id = null)
    {
        if ($id!=null) {

            $estate = estate::query()->where("user_id", $id)->where('created_at', '>=', \Carbon\Carbon::now()->subDay(7))->paginate(10);
            $custom_filter['selected_user'] = $id;
        } elseif (Auth::user()->is_admin) {
            $estate = estate::query()->where('created_at', '>=', \Carbon\Carbon::now()->subDay(7))->paginate(10);
            $custom_filter ['all_estate'] = 1;

        } else {
            $estate = Auth::user()->estate()->where("created_at", ">=", Carbon::now()->subDay(7))->paginate(10);

        }
        $custom_filter ['date_range'] = Carbon::now()->subDay(7);
        return view('circulation.estates', ['estates' => $estate, "custom_filter" => $custom_filter]);

    }

    public function estates_of_month($id = null)
    {
        if ($id!=null) {

            $estate = estate::query()->where("user_id", $id)->where('created_at', '>=', \Carbon\Carbon::now()->subDay(30))->paginate(10);
            $custom_filter['selected_user'] = $id;
        } elseif (Auth::user()->is_admin) {
            $estate = estate::query()->where('created_at', '>=', \Carbon\Carbon::now()->subDay(30))->paginate(10);
            $custom_filter ['all_estate'] = 1;

        } else {
            $estate = Auth::user()->estate()->where("created_at", ">=", Carbon::now()->subDay(30))->paginate(10);

        }
        $custom_filter ['date_range'] = Carbon::now()->subDay(30);
        return view('circulation.estates', ['estates' => $estate, "custom_filter" => $custom_filter]);

    }

    public function estates_of_year($id = null)
    {
        if ($id!=null) {

            $estate = estate::query()->where("user_id", $id)->where('created_at', '>=', \Carbon\Carbon::now()->subDay(365))->paginate(10);
            $custom_filter['selected_user'] = $id;
        } elseif (Auth::user()->is_admin) {
            $estate = estate::query()->where('created_at', '>=', \Carbon\Carbon::now()->subDay(365))->paginate(10);
            $custom_filter ['all_estate'] = 1;

        } else {
            $estate = Auth::user()->estate()->where("created_at", ">=", Carbon::now()->subDay(365))->paginate(10);

        }

        $custom_filter ['date_range'] = Carbon::now()->subDay(365);
        return view('circulation.estates', ['estates' => $estate, "custom_filter" => $custom_filter]);

    }


}