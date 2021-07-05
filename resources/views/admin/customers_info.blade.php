@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                    <form method="GET" action="{{route('search_customers_info')}}">

                        <div class=" input-group float-right col-12 ">
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


                                    </div>


                                </div>
                                <div class="row row-cols-sm-2 row-cols-lg-2 mb-2">

                                    <div class="">
                                        <label for=""> حداکثر قیمت:</label>
                                        <input value="{{request("max_price")}}" class="" type="number"
                                               name="max_price">
                                    </div>


                                </div>


                            </div>
                            <div class="form-group row row-cols-sm-2 row-cols-lg-2 ">

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
                        <div class="row">

                            <input  id="search" type="submit" value="جستجو...">

                        </div>
                        <div style="background: #3dd5f3">
                            <label>
                                مجموع کل:
                            </label>
                            <label>
                                {{$customers_info->total()}}                            </label>
                        </div>
                    </form>
                </div>
                </div>


                <div class="card-body">
                    <div class="col-md-12">
                        <h4>Bootstrap Snipp for Datatable</h4>
                        <div class="table-responsive">


                            <table id="mytable" class="table table-bordred table-striped">

                                <thead>

                                <th>نام مشتری</th>
                                <th>ثبت کننده</th>
                                <th>تلفن</th>

                                <th>نوع ملک</th>

                                <th></th>

                                <th></th>
                                </thead>
                                <tbody>
                                @foreach($customers_info as $customer_info)
                                    <tr>
                                        <td>{{$customer_info->name}}</td>
                                        <td>{{$customer_info->user->name}}</td>
                                        <td>{{$customer_info->phone}}</td>
                                        <td>{{$customer_info->estate_type->name}}</td>
                                        <td>
                                            <a href="{{route('get_customer_info',['id'=>$customer_info->id])}}"
                                               id="show"
                                               type="button" class="btn btn-primary">مشاهده</a>
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>

                            </table>


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
@endsection
