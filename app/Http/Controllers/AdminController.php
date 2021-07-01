<?php

namespace App\Http\Controllers;

use App\Models\CustomerInfo;
use App\Models\estate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {

        return view("Admin.admin");
    }

    public function users(Request $request)
    {

        $users = User::all();
        return view('Admin.users', compact('users'));
    }

    public function update_user_page($id)
    {
        $user = User::find($id);
        return view("Admin.update_user", compact('user'));
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
            "is_attract" => ($request->user_type == 1) ? 1 : 0,
            "is_circulation" => ($request->user_type == 2) ? 1 : 0,
        ]);
        return view("Admin.update_user", compact(["user", "updated_user"]));
    }

    public function delete_user($id)
    {
        $user = User::find($id);
        $user->delete();
        "سلام";
        return redirect(route("users"));
    }

    public function search_user(Request $request)
    {
        $query = $request->get("query");
        $users = User::where("phone", "LIKE", '%' . $query . '%')->orWhere('name', "LIKE", '%' . $query . '%')->get();
        return view('Admin.users', compact('users'));
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
        CustomerInfo::create($request->all());

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


}
