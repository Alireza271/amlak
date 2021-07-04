@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('پنل جذب') }}</div>

                    <div class="card-body">


                        <div class="row row-cols-12">

                            <div class="row row-cols-12 m-2">

                                <a href="" type="button" class="col-3 btn btn-primary position-relative m-3 p-4">
                                     گزارشات من
                                    <span
                                        class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{\Illuminate\Support\Facades\Auth::user()->posters->count()}}</span>
                                </a>

                               <a href="" type="button" class="col-3 btn btn-primary position-relative m-3 p-4">
                                     گزارشات امروز
                                    <span
                                        class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger">{{\Illuminate\Support\Facades\Auth::user()->posters()->where('created_at','>=',\Carbon\Carbon::today())->count()}}</span>
                                </a>

                            </div>


                            <div class="col-12">
                                <div class="list-group position-relative" id="list-tab" role="">


                                    <a class="list-group-item " id="list-settings-list"
                                       href="{{route('poster_form')}}" role="tab"> ثبت اطلاعات مشتری(فعالیت روزانه )
                                    </a>

                                </div>
                            </div>
                            <div class="col-12">
{{--                                <div class="list-group position-relative" id="list-tab" role="">--}}


{{--                                    <a class="list-group-item " id="list-settings-list"--}}
{{--                                       href="{{route('form_2_page')}}" role="tab"> ثبت فرم شمار 2</a>--}}

{{--                                </div>--}}
                                <div class="list-group position-relative" id="list-tab" role="">


                                    <a class="list-group-item " id="list-settings-list"
                                       href="{{route('posters')}}" role="tab">نمایش اطلاعات مشتری(فعالیت روزانه )
                                    </a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
