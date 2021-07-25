@extends('layouts.app')
<style>
    .pagination {
        display: flex;
        justify-content: center;
    }

    .pagination li {
        display: block;
    }
</style>

@section('content')

    <div class="container justify-content-center">
        <a class="btn btn-success"
           href="@if(\Illuminate\Support\Facades\Auth::user()->is_circulation){{  route("circulation") }} @elseif(isset($id)) {{route("get_user",["id"=>$custom_filter['selected_user']])}}

           @else
           {{route('admin')}}
           @endif">بازگشت</a>

            @if(isset($_GET['edited']))
                <div class="alert alert-success" role="alert">
                    ویرایش ملک با موفقیت انجام شد!
                </div>
            @endif
            <div class="card-header">
@if(isset($_GET['estate_type']))
    <h2>{{\App\Models\estate_type::find(request('estate_type'))->name}}</h2>
                @endif
                <div class="card-header ">{{ __('املاک ثبت شده') }}

                </div>

                <form onsubmit=" DoSubmit();" method="GET" action="{{route('search_estate')}}">

                    <div class="input-group float-right col-12 ">
                        <div class="card-group">
                            <div class="container">
                                <div class="row row-cols-xl-3-1  row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
                                    <div>

                                        @if(request('lock'))
                                            <input type="hidden" value="1" name="lock">
                                        @endif
                                        @foreach($custom_filter as $kay=> $value)
                                            <input type="hidden" value="{{$value}}" name="{{$kay}}">

                                        @endforeach

                                        <input value="{{request('query')}}" name="query" type="text"
                                               class="form-control"
                                               placeholder="جستجو...">
                                    </div>

                                    <div id="estate_type">
                                        <select id="estate_type_dropdown" name="estate_type"
                                                class="form-select col-4">
                                            <option value="">نوع ملک</option>

                                            @foreach(\App\Models\estate_type::all() as $estate)
                                                <option @if(request("estate_type")==$estate->id) selected
                                                        @endif value="{{$estate->id}}">{{$estate->name}}</option>                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="building_type">
                                        <select name="building_type"
                                                class="form-select">
                                            <option value="">یکی از گزینه هارا انتخاب کنید</option>

                                            @foreach(\App\Models\building_type::all() as $type)
                                                <option @if(request("building_type")==$type->id) selected
                                                        @endif value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <select id="estate_location_type" name="estate_location_type"
                                                class="form-select">
                                            <option value="">یکی از گزینه هارا انتخاب کنید</option>

                                            @foreach(\App\Models\Estate_Location_type::all() as $type)
                                                <option @if(request("estate_location_type")==$type->id) selected
                                                        @endif value="{{$type->id}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div>
                                        <select id="city_dropdown" name="city" class="form-select">
                                            <option value="">یکی از شهر ها را انتخاب کنید</option>

                                            @foreach(\App\Models\City::all() as $city)
                                                <option @if(request("city")==$city->id) selected
                                                        @endif value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <select id="location_dropdown" name="location" class="form-select">
                                            <option value=''></option>
                                        </select>

                                    </div>
                                    <div id="floors_count"><input class="col-4" value="{{request('floors_count')}}"
                                                                  name="floors_count"
                                                                  type="number" placeholder="تعداد طبقه">
                                    </div>


                                    <div id="area" class="form-group row row-cols-sm-2 row-cols-lg-2 mb-2">

                                        <div class="">
                                            <label for=""> حداقل متراژ زمین:</label>
                                            <input  value="{{request("min_area")}}" class="form-control" type="number"
                                                   name="min_area">
                                        </div>
                                        <div class="">
                                            <label for=""> حداکثر متراژ زمین:</label>
                                            <input value="{{request("max_area")}}" class="" type="number"
                                                   name="max_area">
                                        </div>


                                    </div>
                                    <div class="form-group row row-cols-sm-2 row-cols-lg-2 mb-2">

                                        <div class="">
                                            <label for=""> حداقل قیمت:</label>
                                            <input id="min_price" onkeyup="javascript:this.value=separate(this.value);"
                                                   value="{{request('min_price')}}" class="form-control" type="text"
                                                   name="min_price">
                                        </div>
                                        <div class="">
                                            <label for=""> حداکثر قیمت:</label>
                                            <input id="max_price" onkeyup="javascript:this.value=separate(this.value);"
                                                   value="{{request("max_price")}}" class="form-control" type="text"
                                                   name="max_price">
                                        </div>


                                    </div>


                                    <div id="building_area" class="form-group row row-cols-sm-2 row-cols-lg-2 mb-2  ">

                                        <div class="">
                                            <label for=""> حداقل متراژ بنا:</label>
                                            <input value="{{request("min_building_area")}}" class="" type="number"
                                                   name="min_building_area">
                                        </div>
                                        <div class="">
                                            <label for=""> حداکثر متراژ بنا:</label>
                                            <input value="{{request("max_building_area")}}" class="" type="number"
                                                   name="max_building_area">
                                        </div>


                                    </div>


                                    <div class="form-group row row-cols-sm-2 row-cols-lg-2 mb-2 align-content-center">

                                        <div class="">
                                            <label for=""> از تاریخ:</label>
                                            <input autocomplete="off" name="from_date" id="from_date"
                                                   class="observer-example-alt form-control"/>
                                        </div>
                                        <div class="">
                                            <label for=""> تا تاریخ :</label>
                                            <input autocomplete="off" name="to_date" id="to_date"
                                                   class="observer-example-alt form-control"/>
                                        </div>


                                    </div>


                                    <div id="options" class="text-center align-self-center">
                                        <br>
                                        @foreach(\App\Models\Options::all() as $option)
                                            <div class="form-check form-check-inline align-items-center ">


                                                <input
                                                    @if(request()->has('options')&&in_array($option->id, request('options')))
                                                    checked
                                                    @endif

                                                    class="form-check-input" type="checkbox" value="{{$option->id}}"
                                                    name="options[]"
                                                    id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {{$option->name}}                                                </label>
                                            </div>

                                        @endforeach


                                    </div>


                                    <div id="documents" class="text-center align-self-center">
                                        <br>
                                        @foreach(\App\Models\document::all() as $document)
                                            <div class="form-check form-check-inline align-items-center ">

                                                <input
                                                    @if(request()->has('documents')&&in_array($document->id, request('documents')))
                                                    checked
                                                    @endif
                                                    class="form-check-input" type="checkbox"
                                                    name="documents[]"
                                                    value="{{$document->id}}"
                                                >
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {{$document->name}}                                                </label>
                                            </div>

                                        @endforeach


                                    </div>
                                    <div id="condition" class="text-center align-self-center">
                                        <br>
                                        @foreach(\App\Models\Conditions_type::all() as $condition)
                                            <div class="form-check form-check-inline align-items-center ">
                                                <input class="form-check-input" type="checkbox"
                                                       @if(request()->has('condition')&&in_array($condition->id, request('condition')))
                                                       checked
                                                       @endif
                                                       name="condition[]"
                                                       value="{{$condition->id}}"
                                                       id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {{$condition->name}}                                                </label>
                                            </div>

                                        @endforeach


                                    </div>
                                    <div id="used_type" class="text-center align-self-center">
                                        <br>
                                        @foreach(\App\Models\Used_type::all() as $used)
                                            <div class="form-check form-check-inline align-items-center ">
                                                <input class="form-check-input" type="checkbox"
                                                       @if(request()->has('used_type')&&in_array($used->id, request('used_type')))
                                                       checked
                                                       @endif
                                                       name="used_type[]"
                                                       value="{{$used->id}}"
                                                       id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {{$used->name}}                                                </label>
                                            </div>

                                        @endforeach


                                    </div>


                                    <div id="vila_option" class="text-center align-self-center">
                                        <br>
                                        @foreach(\App\Models\vila_options::all() as $options)
                                            <div class="form-check form-check-inline align-items-center ">
                                                <input class="form-check-input" type="checkbox"
                                                       @if(request()->has('vila_option')&&in_array($options->id, request('vila_option')))
                                                       checked
                                                       @endif
                                                       name="vila_option[]"
                                                       value="{{$options->id}}"
                                                       id="defaultCheck1">
                                                <label class="form-check-label" for="defaultCheck1">
                                                    {{$options->name}}                                                </label>
                                            </div>

                                        @endforeach


                                    </div>

                                </div>

                                <br>
                                <div class="row">

                                    <input id="search" type="submit" value="جستجو...">

                                </div>

                            </div>


                        </div>
                    </div>
                    <div style="background: #3dd5f3">
                        <label>
                            مجموع کل:
                        </label>
                        <label>
                            {{$estates->total()}}                            </label>
                    </div>

                </form>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                    <div class="table-responsive">
                <table class="table " style="direction: rtl">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">شماره ملک</th>
                        <th scope="col"> نام مالک</th>
                        <th scope="col">ثبت کننده</th>
                        <th scope="col">تاریخ ثبت</th>
                        @if(request('estate_type')==1&&request('lock'))
                            <th scope="col">متراژ بنا</th>
                            <th scope="col">تعداد طیقات</th>
                            <th scope="col">واحد</th>
                            <th scope="col">طبقه چندم</th>
                        @elseif(request('estate_type')==2&&request('lock'))
                            <th scope="col">متراژ زمین</th>
                            <th scope="col">شهر</th>
                            <th scope="col">شهرکی یا مستقل</th>

                        @elseif(request('estate_type')==3&&request('lock'))
                            <th scope="col">متراژ زمین</th>
                            <th scope="col">متراژ بنا</th>
                            <th scope="col">شهرکی یا مستقل</th>

                        @else
                            <th scope="col">نوع ملک</th>
                        @endif

                        <th scope="col">جنگلی یا ساحلی</th>
                        <th scope="col">مدارک</th>
                        <th scope="col">قیمت</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($estates as $estate)

                        <tr>

                            <th><img @if($estate->thumbnail!=null) src="
                                       {{ asset('images/thumbnails/'.$estate->thumbnail)}} " @endif width="50"
                                     height="50"></th>
                            <th>{{$estate->id}} <br></th>
                            <td>{{$estate->owner_name}}</td>
                            <td>{{$estate->user->name}}</td>
                            <td>{{\Morilog\Jalali\CalendarUtils::strftime('%Y-%m-%d', strtotime($estate->created_at))}}</td>

                            @if(request('estate_type')==1&&request('lock'))
                                <td >{{$estate->building_area}}</td>
                                <td >{{$estate->floors_count}}</td>
                                <td >{{$estate->module}}</td>
                                <td >{{$estate->floors}}</td>
                            @elseif(request('estate_type')==2&&request('lock'))
                                <td >{{$estate->area}}</td>
                                <td >{{$estate->city->name}}</td>
                                <td >{{$estate->building_type->name}}</td>

                            @elseif(request('estate_type')==3&&request('lock'))
                                <td >{{$estate->area}}</td>
                                <td >{{$estate->building_area}}</td>
                                <td >{{$estate->building_type->name}}</td>

                            @else
                                <td>{{$estate->estate_type->name}}</td>
                            @endif

                            <td >{{$estate->estate_location_type->name}}</td>
                            <td >@foreach($estate->documents as $document)
                            {{$document->name. " - "}}
                                @endforeach
                            </td>
                            <td>{{number_format($estate->price)}}</td>
                            <td>
                                <div class=""><a href="{{route("get_estate",["id"=>$estate->id])}}"
                                                 type="button" class=" btn btn-outline-primary btn-sm">
                                        مشاهده</a>

                                    @if($estate->user_id==auth()->id()||auth()->user()->is_admin)
                                        <a href={{route('update_estate_page',['id'=>$estate->id])}} type="button"
                                           class="btn btn-outline-success btn-sm"> ویرایش</a>
                                    @endif
                                </div>

                            </td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    </div>

            </div>
            {{$estates->links()}}
            <div class="card-footer justify-content-evenly ">


            </div>
        </div>


    </div>




    <script>


        $(document).ready(function () {
            $('#city_dropdown').on('change', function () {
                $('#location_dropdown')
                    .find('option')
                    .remove()
                var value = $('#city_dropdown :selected').val();
                update_location(value);

            });
        });

        update_location({{request('city')}});
        $("#location_dropdown").val({{request('location')}});


        function update_location(value) {

            $.ajax({
                async: false,
                type: "GET",
                url: "../api/get_locations?city_id=" + value,
                success: function (response) {
                    $("#location_dropdown").append(new Option("یکی از منطقه هارا انتخاب کنید", ""));
                    response.forEach(function (location) {
                        $("#location_dropdown").append(new Option(location.name, location.id));
                    })

                }
            });
        }


        //lock estate_type
        @if(\request('lock'))

        @switch(request("estate_type"))

        @case(1)
        aparteman()
        @break
        @case(2)
        zamin()
        @break
        @case(3)
        vila()
        @break

        @endswitch


        function aparteman() {
            $("#area").attr('hidden', true);
            $("#building_type").attr('hidden', true);
            $("#used_type").attr('hidden', true);
            $("#vila_option").attr('hidden', true);
            $("#options").attr('hidden', true);
            var hh = $('input[name="documents[]"]');


            hh.each(function (i, ob) {
                if ($(ob).val() == 3) {
                    $(ob).attr('disabled', true)
                }
                if ($(ob).val() == 4) {
                    $(ob).attr('disabled', true)
                }
            })
        }


        function zamin() {
            $("#building_area").attr('hidden', true);
            $("#options").attr('hidden', true);
            $("#vila_option").attr('hidden', true);
            $("#floors_count").attr('hidden', true);
            $("#options").attr('hidden', true);

            var hh = $('input[name="documents[]"]');
            hh.each(function (i, ob) {
                if ($(ob).val() == 2) {
                    $(ob).attr('disabled', true)
                }

            })

        }


        function vila() {
            $("#building_type").attr('hidden', true);
            $("#used_type").attr('hidden', true);
            $("#options").attr('hidden', true);
            $("#floors_count").attr('hidden', true);

        }


        $("#estate_type").attr('hidden', true);


        @else

        global_search();

        function global_search() {
            $("#floors_count").attr('hidden', true);
            $("#area").attr('hidden', true);
            $("#building_area").attr('hidden', true);
            $("#building_type").attr('hidden', true);
            $("#used_type").attr('hidden', true);
            $("#vila_option").attr('hidden', true);
            $("#options").attr('hidden', true);
            $("#condition").attr('hidden', true);
            $("#documents").attr('hidden', true);
        }

        @endif


        $('.observer-example-alt').persianDatepicker({
            observer: false,
            format: 'YYYY/MM/DD',
            altField: '.observer-example'
        });
        $("#from_date").val("{{request('from_date')}}");
        $("#to_date").val("{{request('to_date')}}");


        function separate(Number) {
            var ss = parseInt(Number.replaceAll(',', ''));
            if (isNaN(ss)) {
                return '';
            }
            console.log(ss);

            return ss.toLocaleString();
        }

        function DoSubmit() {
            var min_price = $("#min_price").val();
            $("#min_price").val(min_price.replaceAll(',', ''));

            var max_price = $("#max_price").val();
            $("#max_price").val(max_price.replaceAll(',', ''));
            return true;
        }
    </script>
@endsection
