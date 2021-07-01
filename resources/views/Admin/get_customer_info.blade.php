@extends('layouts.app')
<style>


</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">نام :</label>
                            <label class="w-50">{{$customer_info->name}}</label>
                        </div>

                        <br>


                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">شماره تماس:</label>
                            <label class="w-50">{{$customer_info->phone}}</label>
                        </div>

                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">تاریخ ثبت:</label>
                            <label
                                class="w-50">{{\Morilog\Jalali\CalendarUtils::strftime('%Y-%m-%d', strtotime($customer_info->created_at))}}</label>
                        </div>

                        <hr>

                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">تعداد:</label>
                            <label class="w-50">{{$customer_info->count}}</label>

                        </div>
                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">نوع ملک:</label>
                            <label class="w-50">{{$customer_info->estate_type->name}}</label>

                        </div>
                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">همراه خانواده</label>
                            <label class="w-50">@if($customer_info->with_family==1)
                                    بله
                                @else
                                    خیر
                                @endif
                            </label>

                        </div>
                    </div>
                    <div class="card-group justify-content-between">
                        <label class="fw-bold" style="font-size: large">سن</label>
                        <label class="w-50">{{$customer_info->age}}</label>

                    </div>  <div class="card-group justify-content-between">
                        <label class="fw-bold" style="font-size: large">مدل ماشین</label>
                        <label class="w-50">{{$customer_info->car_model}}</label>

                    </div>
                    <br>
                    <div class="card-group justify-content-between">
                        <label class="fw-bold" style="font-size: large">شرایط قیمت:</label>
                        <label class="w-50">{{$customer_info->Terms_of_purchase}}</label>
                    </div>
                    <br>

                    <div class="card-group justify-content-between">
                        <label class="fw-bold" style="font-size: large">قدرت خرید:</label>
                        <label class="w-50">{{$customer_info->Purchasing_power    }}</label>
                    </div>
                    <hr>


                    <div class=" card-group justify-content-between">
                        <label class="fw-bold" style="font-size: large">توضیحات:</label>
                        <label class="w-50">{{$customer_info->description}}</label>
                    </div>
                    <div class=" card-group justify-content-between">
                        <label class="fw-bold" style="font-size: large">تعداد بازدید:</label>
                        <label class="w-50">{{$customer_info->visited_estate_count}}</label>
                    </div>

                    <div class=" card-group justify-content-between">
                        <label class="fw-bold" style="font-size: large">نظر مدیریت:</label>
                        <label class="w-50">{{$customer_info->admin_comment}}</label>
                    </div>  <div class=" card-group justify-content-between">
                        <label class="fw-bold" style="font-size: large">نظر گروه گردش:</label>
                        <label class="w-50">{{$customer_info->circulation_comment}}</label>
                    </div>  <div class=" card-group justify-content-between">
                        <label class="fw-bold" style="font-size: large">نظر گروه جذب:</label>
                        <label class="w-50">{{$customer_info->attract_comment}}</label>
                    </div>



                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
