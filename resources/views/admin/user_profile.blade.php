@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{$user->name }}</div>

            <div class="card-body">


                @if($user->is_circulation || $user->is_admin )
                    <div class="">
                        <label> املاک </label>
                        <div class="row  m-2 justify-content-around p-3">

                            <a href="{{route("all_estate_for_user",["id"=>$user->id])}}" type="button"
                               class="col-5 btn btn-primary position-relative m-1">
                                املاک ثبت شده
                                <span
                                    class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{$user->estate->count()}}</span>
                            </a>

                            <a href="{{route("estates_of_day",["id"=>$user->id])}}" type="button"
                               class="col-5 btn btn-primary position-relative  m-1 ">
                                امروز
                                <span
                                    class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{$user->estate->where('created_at','>=',\Carbon\Carbon::today())->count()}}</span>
                            </a>

                            <a href="{{route("estates_of_week",["id"=>$user->id])}}" type="button"
                               class="col-5 btn btn-primary position-relative  m-1 ">
                                این هفته
                                <span
                                    class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{$user->estate->where('created_at' ,'>=',\Carbon\Carbon::now()->subDay(7))->count()}}</span>
                            </a>

                            <a href="{{route("estates_of_month",["id"=>$user->id])}}" type="button"
                               class="col-5 btn btn-primary position-relative  m-1 ">
                                این ماه
                                <span
                                    class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{$user->estate->where('created_at' ,'>=',\Carbon\Carbon::now()->subDay(30))->count()}}</span>
                            </a> <a href="{{route("estates_of_year",["id"=>$user->id])}}" type="button"
                                    class="col-5 btn btn-primary position-relative  m-1 ">
                                این سال
                                <span
                                    class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{$user->estate->where('created_at' ,'>=',\Carbon\Carbon::now()->subDay(365))->count()}}</span>
                            </a>

                        </div>

                        <div class="row  m-2 justify-content-around p-3">
                            @foreach(\App\Models\estate_type::all() as $type)
                                <a href="{{route("search_estate",['estate_type'=>$type->id ,
    "selected_user"=>$user->id,
])}}" type="button" class="col-3 btn btn-primary position-relative  m-1 ">
                                    {{$type->name}}
                                    <span
                                        class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{\App\Models\estate::query()->where('estate_type_id',$type->id)->where('user_id',$user->id)->count()}}</span>
                                </a>

                            @endforeach
                        </div>
                    </div>
                @elseif($user->is_attract)
                    <div class="row row-cols-12">

                        <div class="row row-cols-12 m-2">



                            <a href="" type="button" class="col-3 btn btn-primary position-relative m-3 p-4">
                                گزارشات امروز
                                <span
                                    class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{\App\Models\Poster::query()->where([['created_at','>=',\Carbon\Carbon::today()],['user_id',$user->id]])->count()}}</span>
                            </a>  <a href="" type="button" class="col-3 btn btn-primary position-relative m-3 p-4">
                                کل تعداد ثبت شده
                                <span
                                    class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{\App\Models\Poster::query()->where([['user_id',$user->id]])->count()}}</span>
                            </a>

                        </div>


                            {{--                                <div class="list-group position-relative" id="list-tab" role="">--}}


                            {{--                                    <a class="list-group-item " id="list-settings-list"--}}
                            {{--                                       href="{{route('form_2_page')}}" role="tab"> ثبت فرم شمار 2</a>--}}

                            {{--                                </div>--}}
                            <div class="list-group position-relative" id="list-tab" role="">


                                <a class="list-group-item " id="list-settings-list"
                                   href="{{route('posters',['user_id'=>$user->id])}}" role="tab">نمایش اطلاعات مشتری(فعالیت روزانه )
                                </a>

                            </div>


                        <div class="list-group position-relative" id="list-tab" role="">


                            <a class="list-group-item " id="list-settings-list"
                               href="{{route('poster_daily_report_page',['action'=>'جستجو' ,'attract_id'=>$user->id])}}" role="tab">لیست گزارش روزانه آگهی
                            </a>

                        </div>

                        </div>
                    </div>

                @endif

                {{--                <div class="">--}}
                {{--                    <label> گزارشات </label>--}}

                {{--                </div>--}}

                {{--                <div class="col-12">--}}
                {{--                    <div class="list-group position-relative" id="list-tab" role="">--}}


                {{--                        <a class="list-group-item " id="list-settings-list"--}}
                {{--                           href="{{route('poster_form')}}" role="tab"> ثبت فرم شمار 1</a>--}}

                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="col-12">--}}
                {{--                    <div class="list-group position-relative" id="list-tab" role="">--}}


                {{--                        <a class="list-group-item " id="list-settings-list"--}}
                {{--                           href="{{route('form_2_page')}}" role="tab"> ثبت فرم شمار 2</a>--}}

                {{--                    </div>--}}
                {{--                    <div class="list-group position-relative" id="list-tab" role="">--}}


                {{--                        <a class="list-group-item " id="list-settings-list"--}}
                {{--                           href="{{route('posters')}}" role="tab">فرم های ثبت شده 1</a>--}}

                {{--                    </div>--}}

            </div>
        </div>
    </div>


    </div>
@endsection
