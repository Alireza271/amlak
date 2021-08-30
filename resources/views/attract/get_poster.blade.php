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
                            <label class="w-50">{{$poster->name}}</label>
                        </div>

                        <br>


                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">شماره تماس:</label>
                            <label class="w-50">{{$poster->phone}}</label>
                        </div>

                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">تاریخ ثبت:</label>
                            <label
                                class="w-50">{{\Morilog\Jalali\CalendarUtils::strftime('%Y-%m-%d', strtotime($poster->created_at))}}</label>
                        </div>

                        <hr>

                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">شهر:</label>
                            <label class="w-50">{{$poster->city->name}}</label>

                        </div>
                            <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">نوع ملک:</label>
                            <label class="w-50">{{$poster->estate_type->name}}</label>

                        </div>
                            <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">:::</label>
                            <label class="w-50">{{$poster->estate_location_type->name}}</label>

                        </div>
                    </div>
                            <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">ایدی فایل</label>
                            <label class="w-50">{{$poster->estate_id}}</label>

                        </div>
                        <br>
                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">محل آگهی:</label>
                            <label class="w-50">{{$poster->social->name}}</label>
                        </div>
                        <br>

                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">بودجه خرید:</label>
                            <label class="w-50">{{$poster->allocate}}</label>
                        </div>
                        <hr>


                        <div class=" card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">توضیحات:</label>
                            <label class="w-50">{{$poster->description}}</label>
                        </div>


                        <div class=" card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">نتیجه پیگیری:</label>
                            <label class="w-50">{{$poster->result}}</label>
                        </div>

{{--                            <div class=" card-group justify-content-between">--}}
{{--                            <label class="fw-bold" style="font-size: large">تاریخ پیگیری:</label>--}}
{{--                            <label class="w-50">{{$poster->result_date}}</label>--}}
{{--                        </div>--}}

                        <hr>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
