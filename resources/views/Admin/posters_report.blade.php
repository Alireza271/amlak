@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                <form method="GET" action="{{route('search_posters_report')}}">

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

                                            @foreach(\App\Models\City::all() as $city)
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

                                    <div id="user_id">
                                        <select id="social_dropdown" name="attract_id"
                                                class="form-select col-4">
                                            <option value="">انتخاب کاربر</option>

                                            @foreach(\App\Models\User::where('is_attract',1)->get() as $attract)
                                                <option @if(request("attract_id")==$attract->id) selected
                                                        @endif value="{{$attract->id}}">{{$attract->name}}</option>                                            @endforeach
                                        </select>
                                    </div>


                                </div>
                                <div class="form-group row row-cols-sm-2 row-cols-lg-2 mb-2">

                                    <div class="">
                                        <label for=""> حداکثر قیمت:</label>
                                        <input value="{{request("allocate")}}" class="" type="number"
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

                        </label>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="row">


                    <div class="col-md-12">
                        <h4>Bootstrap Snipp for Datatable</h4>
                        <div class="table-responsive">


                            <table id="mytable" class="table table-bordred table-striped">

                                <thead>

                                <th>نام</th>
                                @foreach(\App\Models\estate_type::all() as $item)
                                    <th>{{$item->name}} </th>

                                @endforeach
                                @foreach(\App\Models\Social::all() as $item)
                                    <th>{{$item->name}} </th>

                                @endforeach

                                @foreach(\App\Models\Estate_Location_type::all() as $item)
                                    <th>{{$item->name}} </th>

                                @endforeach

                                <th>مجموع</th>

                                @foreach($users as $user)
                                </thead>

                                <td>{{$user->name}}</td>
                                @foreach(\App\Models\estate_type::all() as $item)
                                    <td>{{$posters->where('user_id',$user->id)->where('estate_type_id',$item->id)->count()}}</td>

                                @endforeach
                                @foreach(\App\Models\Social::all() as $item)
                                    <td>{{$posters->where('user_id',$user->id)->where('social_id',$item->id)->count()}}</td>

                                @endforeach
                                @foreach(\App\Models\Estate_Location_type::all() as $item)
                                    <td>{{$posters->where('user_id',$user->id)->where('estate_location_type_id',$item->id)->count()}}</td>

                                @endforeach

                                <td>{{$posters->where('user_id',$user->id)->count()}}</td>


                                <tbody>


                                </tbody>
                                @endforeach

                            </table>


                        </div>
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
    </script>
    </script>

@endsection
