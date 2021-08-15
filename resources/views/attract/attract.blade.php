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
                                <div class="list-group position-relative" id="list-tab" role="">


                                    <a class="list-group-item " id="list-settings-list"
                                       href="{{route('poster_daily_report_form')}}" role="tab">ثبت گزارش روزانه آگهی
                                    </a>

                                </div>

                                <div class="list-group position-relative" id="list-tab" role="">

                                    <br>
                                    <a class="list-group-item " id="list-settings-list"
                                       href="{{route('all_estates')}}" role="tab">
                                        <i class="fas fa-archive"></i>

                                        <span>نمایش کل املاک ثبت شده</span>
                                    </a>

                                    <span
                                        class="position-absolute top-50 start-100 translate-middle badge rounded-pill bg-danger">{{\App\Models\estate::all()->count()}}</span>

                                </div>

                                <div class="list-group position-relative" id="list-tab" role="">


                                    <a class="list-group-item " id="list-settings-list"
                                       href="{{route('poster_daily_report_page')}}" role="tab">لیست گزارش روزانه آگهی
                                    </a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
