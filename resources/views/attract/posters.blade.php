@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            @if(isset($_GET['status']))
                <div class="alert alert-success" role="alert">
                    ثبت ملک با موفقیت انجام شد!
                </div>
            @endif
            <div class="card-header">
                <form onsubmit=" DoSubmit();" method="GET" action="{{route('search_posters')}}">

                    <div class="input-group float-right col-12 ">
                        <div class="card-group">
                            <div class="container">
                                <div class="row row-cols-xl-3-1  row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
                                    <div id="estate_type">
                                        <select id="estate_type_dropdown" name="estate_type"
                                                class="form-select col-4">
                                            <option value="">نوع ملک</option>

                                            @foreach(\App\Models\estate_type::all() as $estate)
                                                <option @if(request("estate_type")==$estate->id) selected
                                                        @endif value="{{$estate->id}}">{{$estate->name}}</option>                                            @endforeach
                                        </select>
                                    </div>

                                    <div>
                                        <select id="city_dropdown" name="city" class="form-select">
                                            <option value="">یکی از شهر ها را انتخاب کنید</option>

                                            @foreach(\App\Models\AllCities::all() as $city)
                                                <option @if(request("city")==$city->id) selected
                                                        @endif value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="social">
                                        <select id="social_dropdown" name="estate_location_type_id"
                                                class="form-select col-4">
                                            <option value="">....</option>

                                            @foreach(\App\Models\Estate_Location_type::all() as $Estate_Location_type)
                                                <option
                                                    @if(request("estate_location_type_id")==$Estate_Location_type->id) selected
                                                    @endif value="{{$Estate_Location_type->id}}">{{$Estate_Location_type->name}}</option>                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="social">
                                        <select id="social_dropdown" name="social_id"
                                                class="form-select col-4">
                                            <option value="">محل آگهی</option>

                                            @foreach(\App\Models\Social::all() as $Social)
                                                <option @if(request("social_id")==$Social->id) selected
                                                        @endif value="{{$Social->id}}">{{$Social->name}}</option>                                            @endforeach
                                        </select>
                                    </div>

                                    @if(Auth::user()->is_admin)
                                    <div id="user_id">
                                        <select id="social_dropdown" name="attract_id"
                                                class="form-select col-4">
                                            <option value="">انتخاب کاربر</option>

                                            @foreach(\App\Models\User::where('is_attract',1)->get() as $attract)
                                                <option @if(request("attract_id")==$attract->id) selected
                                                        @endif value="{{$attract->id}}">{{$attract->name}}</option>                                            @endforeach
                                        </select>
                                    </div>
                                    @endif

                                </div>
                                <div class="form-group row row-cols-sm-2 row-cols-lg-2 mb-2">

                                    <div class="">
                                        <label for=""> حداکثر قیمت:</label>
                                        <input onkeyup="javascript:this.value=separate(this.value);" id="max_price"
                                               value="{{request("allocate")}}" class="" type="text"
                                               name="allocate">
                                    </div>


                                </div>

                            </div>


                            <div class="form-group row row-cols-sm-2 row-cols-lg-2 mb-2 align-content-center">

                                <div class="">
                                    <label for=""> از تاریخ:</label>
                                    <input autocomplete="off" name="from_date" id="from_date"
                                           class="observer-example-alt"/>
                                </div>
                                <div class="">
                                    <label for=""> تا تاریخ :</label>
                                    <input autocomplete="off" name="to_date" id="to_date"
                                           class="observer-example-alt"/>
                                </div>

                            </div>
                        </div>

                        <br>
                        <div class="row">

                            <input id="search" type="submit" value="جستجو...">

                        </div>

                    </div>

                    <div style="background: #3dd5f3">
                        <label>
                            مجموع کل:
                        </label>
                        <label>
                            {{$posters->total()}}
                        </label>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="row">


                    <div class="col-md-12">
                        <h4>آگهی ها</h4>
                        <div class="table-responsive">


                            <table id="mytable" class="table table-bordred table-striped">

                                <thead>

                                <th>نام و نام خانوادگی</th>
                                <th>ثبت کننده</th>
                                <th>تاریخ</th>
                                <th>شهر</th>
                                <th>محل آگهی</th>
                                <th>نوع ملک</th>
                                <th>...</th>
                                <th>بودجه خرید</th>

                                <th></th>

                                <th></th>
                                </thead>
                                <tbody>
                                @foreach($posters as $poster)
                                    <tr>
                                        <td>{{$poster->name}}</td>
                                        <td>{{$poster->user->name}}</td>
                                        <td>{{\Morilog\Jalali\CalendarUtils::strftime('%Y-%m-%d', strtotime($poster->created_at))}}</td>
                                        <td>{{$poster->city->name}}</td>
                                        <td>{{$poster->social->name}}</td>
                                        <td>{{$poster->estate_type->name}}</td>
                                        <td>{{$poster->estate_location_type->name}}</td>
                                        <td>{{$poster->allocate}}</td>
                                        <td>
                                            <a href="{{route('get_poster',['id'=>$poster->id])}}" id="show"
                                               type="button"
                                               class="btn btn-primary">مشاهده</a>
                                            <a href="{{route('update_poster_page',['id'=>$poster->id])}}" id="edit"
                                               type="button" class="btn btn-warning">ویرایش</a>
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>

                            </table>


                        </div>
                        {{$posters->links()}}
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
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
            var price = $("#max_price").val();
            $("#max_price").val(price.replaceAll(',', ''));

        }
    </script>

@endsection
