<?php

namespace App\Http\Controllers;

use App\Models\CustomerInfo;
use App\Models\estate;
use App\Models\Poster;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Morilog\Jalali\CalendarUtils;
use Morilog\Jalali\Jalalian;
use PhpParser\Node\Stmt\Return_;

class AdminController extends Controller
{
    public function index()
    {

        return view("admin.admin");
    }

    public function users(Request $request)
    {

        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function update_user_page($id)
    {
        $user = User::find($id);
        return view("admin.update_user", compact('user'));
    }

    public function update_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'numeric'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $validator->validate();
        $user = User::find($request->id);
        $updated_user = $user->update([
            "name" => $request->name,
            "phone" => $request->phone,
            "password" => Hash::make($request->password),
            "is_admin" => ($request->user_type == 0) ? 1 : 0,
            "is_circulation" => ($request->user_type == 1) ? 1 : 0,
            "is_attract" => ($request->user_type == 2) ? 1 : 0,
        ]);
        return view("admin.update_user", compact(["user", "updated_user"]));
    }

    public function delete_user($id)
    {
        $user = User::find($id);
        if ($user->is_admin || $user->is_circulation){
            $estates_ids=$user->estate->pluck('id');
            foreach ($estates_ids as $estate_id){
                $this->delete_estate($estate_id);
            }
            $customer_info_ids=$user->customersinfo->pluck('id');
            foreach ($customer_info_ids as $id){
                $this->delete_customer_info($id);
            }

        }else{
            $posters_ids=$user->Posters->pluck('id');
            foreach ($posters_ids as $id){
                $this->delete_poster($id);
            }

        }

        $user->delete();
        return \redirect(request()->headers->get('referer'));
    }

    public function search_user(Request $request)
    {
        $query = $request->get("query");
        $users = User::where("phone", "LIKE", '%' . $query . '%')->orWhere('name', "LIKE", '%' . $query . '%')->get();
        return view('admin.users', compact('users'));
    }

    public function get_user($id)
    {

        $user = User::find($id);
        return view('admin.user_profile', ["user" => $user]);

    }


    public function all_estate_for_user($id)
    {
        $estate = estate::query()->where("user_id", $id)->paginate(10);
        $custom_filter = [
            "selected_user" => $id

        ];
        return view('circulation.estates', ['estates' => $estate, "custom_filter" => $custom_filter]);
    }


    public function customer_info_form_page()
    {
        return view('admin.customer_info_form');
    }

    public function customer_info_form(Request $request)

    {
       Auth::user()->customersinfo()->create($request->all());

        return Redirect:: route('admin');
    }

    public function customers_info()
    {
        $Customers_Info = CustomerInfo::query()->paginate(10);
        return view('admin.customers_info', ['customers_info' => $Customers_Info]);
    }

    public function get_customer_info($id)
    {
        $customer_info = CustomerInfo::find($id);
        return view('admin.get_customer_info', ['customer_info' => $customer_info]);

    }

    public function search_customers_info(Request $request)
    {
        $estate_type = $request->get("estate_type");
        $from_date = $request->get("from_date");
        $to_date = $request->get("to_date");


        $max_price = $request->get("max_price");
        $filter = CustomerInfo::query();

        if ($estate_type != null) {
            error_log('estate_type');

            $filter = $filter->where("estate_type_id", $estate_type);

        }
        if ($max_price != null) {
            error_log('max price');

            $filter = $filter->where('Purchasing_power', '<=', (int)$max_price);
        }

        if ($from_date != null) {
            $from_date = CalendarUtils::createCarbonFromFormat('Y/m/d', CalendarUtils::convertNumbers($request->get("from_date"), true))->format('Y-m-d'); //2016-05-8
            $to_date = CalendarUtils::createCarbonFromFormat('Y/m/d', CalendarUtils::convertNumbers(($request->get("to_date") == null) ? Jalalian::forge('today')->format('Y/m/d') : $request->get("to_date"), true))->addDays(1)->format('Y-m-d');
            $filter = $filter->where("created_at",">=",$from_date)->where('created_at',"<=" ,$to_date);
        }


        $customers = $filter->paginate(10);
        $customers->appends($request->all())->links();


        return view('admin.customers_info', ['customers_info' => $customers]);

    }

    public function posters_report()
    {
        $users = User::query()->where('is_attract', 1)->paginate(10);
        $posters=Poster::all();
        return view('admin.posters_report', ['users' => $users,"posters"=>$posters]);
    }

    public function search_posters_report(Request $request)
    {
        $users = User::query()->where('is_attract', 1)->paginate(10);
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
            $filter = $filter->where("created_at",">=",$from_date)->where('created_at',"<=" ,$to_date);
        }

        $users = array_unique($filter->pluck('user_id')->toArray());

        try {        $users= User::query()->findMany($users)->toQuery()->paginate(10);

        }catch (\Exception $e){
            $users=[];
        }
        $posters = $filter->paginate(10);

        $posters->appends($request->all())->links();

        return view('admin.posters_report', ['posters' => $posters,'users'=>$users]);
    }
    public function delete_estate($id)
    {
        if (auth()->user()->is_admin) {

            $estate = estate::find($id);
            try {
                $estate->conditions_type()->detach();
            } catch (\Error $exception) {
            }
            try {
                $estate->documents()->detach();
            } catch (\Error $exception) {
            }
            try {
                $estate->options()->detach();

            } catch (\Error $exception) {

            }
            try {
                $estate->vila_options()->detach();

            } catch (\Error $exception) {

            }
            try {
                $estate->images()->delete();

            } catch (\Error $exception) {

            }
            try {
                $estate->used_type()->detach();

            } catch (\Error $exception) {

            }
            $estate->delete();
            return \redirect(request()->headers->get('referer'));


        }
    }

    public function delete_customer_info($id){
        $Costomer_info=CustomerInfo::find($id);
        $Costomer_info->delete();
        return \redirect(request()->headers->get('referer'));

    }

    public function delete_poster($id)
    {
        $poster=Poster::find($id);
        $poster->delete();
        return \redirect(request()->headers->get('referer'));

    }

}
