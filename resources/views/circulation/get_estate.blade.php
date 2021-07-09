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
                            <label class="fw-bold" style="font-size: large">نام مالک:</label>
                            <label class="w-50">{{$estate->owner_name}}</label>
                        </div>

                        <br>


                        @if ($estate->user_id==auth()->id() ||auth()->user()->is_admin)
                            <div class="card-group justify-content-between">
                                <label class="fw-bold" style="font-size: large">شماره تماس:</label>
                                <label class="w-50">{{$estate->owner_phone}}</label>
                            </div>
                        @endif

                        <hr>
                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style=" font-size: large">نوع ملک:</label>
                            <label class="w-50">{{$estate->estate_type->name}}</label>

                        </div>


                            <div class="card-group justify-content-between">
                            <label class="fw-bold" style=" font-size: large"> :</label>
                            <label class="w-50">{{$estate->estate_location_type->name}}</label>

                        </div>
                        <hr>

                        @if($estate->estate_type_id==2||$estate->estate_type_id==3)
                            @if(!empty($estate->building_type_id))
                                <div class=" card-group justify-content-between">
                                    <label class="fw-bold" style="font-size: large"> :</label>
                                    <label class="w-50">{{$estate->building_type->name}}</label>
                                </div>
                                <hr>
                            @endif
                        @endif

                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">شهر:</label>
                            <label class="w-50">{{$estate->city->name}}</label>

                        </div>
                        <br>
                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">منطقه:</label>
                            <label class="w-50">{{$estate->location->name}}</label>
                        </div>
                        <br>

                        <div class="card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">قیمت:</label>
                            <label class="w-50">{{$estate->price}}</label>
                        </div>
                        <hr>
                        @if($estate->estate_type_id==2||$estate->estate_type_id==3)

                            @if(!empty($estate->area))
                                <div class=" card-group justify-content-between">
                                    <label class="fw-bold" style="font-size: large">متراژ زمین:</label>
                                    <label class="w-50">{{$estate->area}}</label>
                                </div>
                                <hr>
                            @endif
                        @endif

                        @if($estate->estate_type_id==1||$estate->estate_type_id==3)

                            @if(!empty($estate->building_area))
                                <div class=" card-group justify-content-between">
                                    <label class="fw-bold" style="font-size: large">متراژ بنا:</label>
                                    <label class="w-50">{{$estate->building_area}}</label>
                                </div>
                                <hr>
                            @endif
                        @endif

                        @if($estate->estate_type_id==1)
                            @if(!empty($estate->building_date))
                                <div class=" card-group justify-content-between">
                                    <label class="fw-bold" style="font-size: large">سال ساخت:</label>
                                    <label class="w-50">{{$estate->building_date}}</label>
                                </div>
                                    <div class=" card-group justify-content-between">
                                    <label class="fw-bold" style="font-size: large">تعداد طبقات:</label>
                                    <label class="w-50">{{$estate->floors_count}}</label>
                                </div>
                                    <div class=" card-group justify-content-between">
                                    <label class="fw-bold" style="font-size: large">طبقه:</label>
                                    <label class="w-50">{{$estate->floors}}</label>
                                </div>

                                    <div class=" card-group justify-content-between">
                                    <label class="fw-bold" style="font-size: large">واحد:</label>
                                    <label class="w-50">{{$estate->module}}</label>
                                </div>
                                <hr>
                            @endif
                        @endif

                        @if($estate->estate_type_id==2)

                            @if(!empty($estate->length))
                                <div class=" card-group justify-content-between">
                                    <label class="fw-bold" style="font-size: large">طول:</label>
                                    <label class="w-50">{{$estate->length}}</label>
                                </div>
                                <hr>
                            @endif
                            @if(!empty($estate->width))


                                <div class=" card-group justify-content-between">
                                    <label class="fw-bold" style="font-size: large">عرض:</label>
                                    <label class="w-50">{{$estate->width}}</label>
                                </div>
                                <hr>
                            @endif
                        @endif

                            @if($estate->estate_type_id==1||$estate->estate_type_id==3)

                            @if($estate->options!='[]')


                            <div class=" card-group justify-content-between">
                                <label class="fw-bold" style="font-size: large">مشاعات:</label>
                                <label class="w-50">
                                    @foreach($estate->options as $option)
                                        {{$option->name}},
                                    @endforeach
                                </label>
                            </div>
                            <hr>
                        @endif
                        @endif

                            @if($estate->estate_type_id==2)

                            @if($estate->used_type!='[]')
                            <div class=" card-group justify-content-between">
                                <label class="fw-bold" style="font-size: large">نوع کاربری:</label>
                                <label class="w-50">
                                    @foreach($estate->used_type as $used)
                                        {{$used->name}},
                                    @endforeach
                                </label>
                            </div>
                            <hr>
                        @endif
                        @endif


                        @if($estate->conditions_type!='[]')
                            <div class=" card-group justify-content-between">
                                <label class="fw-bold" style="font-size: large">شرایط قیمت:</label>
                                <label class="w-50">
                                    @foreach($estate->conditions_type as $condition)
                                        {{$condition->name}},
                                    @endforeach
                                </label>
                            </div>
                            <hr>
                        @endif


                        @if($estate->documents!='[]')


                            <div class=" card-group justify-content-between">
                                <label class="fw-bold" style="font-size: large">مدارک:</label>
                                <label class="w-50">
                                    @foreach($estate->documents as $document)
                                        {{$document->name}} ,
                                    @endforeach
                                </label>
                            </div>
                            <hr>
                        @endif
                            @if($estate->estate_type_id==3)

                            @if($estate->vila_options!='[]')


                            <div class=" card-group justify-content-between">
                                <label class="fw-bold" style="font-size: large">مشاعات ویلا:</label>
                                <label class="w-50">
                                    @foreach($estate->vila_options as $vila_option)
                                        {{$vila_option->name}} ,
                                    @endforeach
                                </label>
                            </div>
                            <hr>
                        @endif
                        @endif

                            @if ($estate->user_id==auth()->id() ||auth()->user()->is_admin)
                            <div class="card-group justify-content-between">
                                <label class="fw-bold" style="font-size: large">آدرس:</label>
                                <label class="w-50">{{$estate->address}}</label>
                            </div>
                        @endif
                        <hr>
                        <div class=" card-group justify-content-between">
                            <label class="fw-bold" style="font-size: large">توضیحات:</label>
                            <label class="w-50">{{$estate->description}}</label>
                        </div>

                        <hr>

                        <div class="">
                            <label class="fw-bold" style="font-size: large">تصاویر:</label>
                            <br>
                            <div id="parent" class="row row-cols-2">
                                @foreach($estate->images as $image)
                                    <a download="{{$image->file_name}}" href="{{asset('images/'.$image->file_name)}}" title="ImageName">
                                        <img height="200" width="200" alt="ImageName" src="{{asset('images/'.$image->file_name)}}">
                                    </a>

                                @endforeach
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
