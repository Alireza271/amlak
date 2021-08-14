@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('پنل گردش') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row row-cols-12">

                            <div class="row row-cols-12 m-2">

                                @foreach(\App\Models\estate_type::all() as $item)
                                    <a  href="{{route('search_estate',["estate_type"=>$item->id ,'lock'=>true])}}" type="button" class="col-3 btn btn-primary position-relative m-3 p-4">
                                          نمایش     {{$item->name}}
                                        <span
                                            class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{$item->estate->where("user_id",auth()->id())->count()}}</span>
                                    </a>
                                @endforeach

                            </div>
                            <div class="m-1">
                                <hr>


                                <a href="{{route('estates_of_day')}}" type="button" class="col-3 btn btn-primary position-relative m-2 p2">
                                    امروز
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{Auth::user()->estate->where('created_at', '>=',\Carbon\Carbon::today())->count()}}</span>
                                </a>

                                <a href="{{route('estates_of_week')}}" type="button" class="col-3 btn btn-primary position-relative m-2 p2">
                                    7 روز گذشته
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{Auth::user()->estate->whereBetween('created_at',[\Carbon\Carbon::now()->subDay(7),\Carbon\Carbon::now()])->count()}}</span>
                                </a>

                                <a href="{{route('estates_of_month')}}" type="button" class="col-3 btn btn-primary position-relative m-2 p2">

                                    ماه گذشته
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{Auth::user()->estate->whereBetween('created_at',[\Carbon\Carbon::now()->subDay(30),\Carbon\Carbon::now()])->count()}}</span>
                                </a>
                                <a href="{{route('estates_of_year')}}" type="button" class="col-3 btn btn-primary position-relative m-2 p2">

                                    سال گذشته
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{Auth::user()->estate->whereBetween('created_at',[\Carbon\Carbon::now()->subDay(365),\Carbon\Carbon::now()])->count()}}</span>
                                </a>

                            </div>


                            <div class="list-group" id="list-tab" role="">
                                <a class="list-group-item list-group-item-action" id="list-settings-list"
                                   href="{{route('add_estate_page')}}" role="tab">ثبت املاک

                                </a>
                            </div>
                            <div class="col-12">
                                <div class="list-group position-relative" id="list-tab" role="">


                                    <a class="list-group-item " id="list-settings-list"
                                       href="{{route('my_estates')}}" role="tab"> املاک ثبت شده من</a>

                                    <span
                                        class="position-absolute top-50 start-100 translate-middle badge rounded-pill bg-danger">{{Auth::user()->estate->count()}}</span>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="list-group position-relative" id="list-tab" role="">


                                    <a class="list-group-item " id="list-settings-list"
                                       href="{{route('all_estates')}}" role="tab">نمایش کل املاک ثبت شده
                                    </a>

                                    <span
                                        class="position-absolute top-50 start-100 translate-middle badge rounded-pill bg-danger">{{\App\Models\estate::all()->count()}}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
