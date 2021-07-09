@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('پنل ادمین') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="row">
                            <div class="col-12">
                                <div class="card-group">
                                    <div class="row col-12  m-2 justify-content-around p-3">
                                        @foreach(\App\Models\estate_type::all() as $type)
                                            <a href="{{route("search_estate",['estate_type'=>$type->id ,
    "all_estate"=>1,'lock'=>true
])}}" type="button" class="col-3 btn btn-primary position-relative  m-1 ">
                                                نمایش {{$type->name}}
                                                <span
                                                    class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{\App\Models\estate::query()->where('estate_type_id',$type->id)->count()}}</span>
                                            </a>

                                        @endforeach
                                    </div>
                                    <div class="row  m-2 justify-content-around p-3">
                                        <a href="{{route("estates_of_day")}}" type="button"
                                           class="col-5 btn btn-primary position-relative  m-1 ">
                                            امروز
                                            <span
                                                class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{\App\Models\estate::where('created_at','>=',\Carbon\Carbon::today())->count()}}</span>
                                        </a>

                                        <a href="{{route("estates_of_week")}}" type="button"
                                           class="col-5 btn btn-primary position-relative  m-1 ">
                                            این هفته
                                            <span
                                                class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{\App\Models\estate::where('created_at' ,'>=',\Carbon\Carbon::now()->subDay(7))->count()}}</span>
                                        </a>

                                        <a href="{{route("estates_of_month")}}" type="button"
                                           class="col-5 btn btn-primary position-relative  m-1 ">
                                            این ماه
                                            <span
                                                class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{\App\Models\estate::where('created_at' ,'>=',\Carbon\Carbon::now()->subDay(30))->count()}}</span>
                                        </a> <a href="{{route("estates_of_year")}}" type="button"
                                                class="col-5 btn btn-primary position-relative  m-1 ">
                                            این سال
                                            <span
                                                class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{\App\Models\estate::where('created_at' ,'>=',\Carbon\Carbon::now()->subDay(365))->count()}}</span>
                                        </a></div>
                                </div>

                                <div class="list-group" id="list-tab" role="">
                                    <a class="list-group-item list-group-item-action" id="list-settings-list"
                                       href="{{route('register')}}" role="tab">ثبت نام کاربر جدید</a>
                                    <a class="list-group-item list-group-item-action" id="list-settings-list"
                                       href="{{route('users')}}" role="tab">نمایش کاربران</a>
                                    <a class="list-group-item list-group-item-action" id="list-settings-list"
                                       href="{{route('add_estate_page')}}" role="tab">ثبت املاک

                                    </a>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="list-group position-relative" id="list-tab" role="">


                                    <a class="list-group-item " id="list-settings-list"
                                       href="{{route('all_estates')}}" role="tab"> نمایش کل املاک ثبت شده
                                    </a>

                                    <span
                                        class="position-absolute top-50 start-100 translate-middle badge rounded-pill bg-danger">{{\App\Models\estate::all()->count()}}</span>

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="list-group position-relative" id="list-tab" role="">


                                    <a class="list-group-item " id="list-settings-list"
                                       href="{{route('customer_info_form_page')}}" role="tab">ثبت اطلاعات مشتری حضوری
                                    </a>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="list-group position-relative" id="list-tab" role="">


                                    <a class="list-group-item " id="list-settings-list"
                                       href="{{route('customers_info')}}" role="tab">نمایش اطلاعات مشتری حضوری
                                    </a>
                                </div>
                            </div>


                            <div class="list-group position-relative" id="list-tab" role="">


                                <a class="list-group-item " id="list-settings-list"
                                   href="{{route('posters')}}" role="tab">نمایش اطلاعات مشتری(فعالیت روزانه )
                                </a>

                            </div>
                            <div class="list-group position-relative" id="list-tab" role="">


                                <a class="list-group-item " id="list-settings-list"
                                   href="{{route('posters_report')}}" role="tab"> نمایش اطلاعات مشتری(فعالیت روزانه )
                                    آمار
                                </a>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
