@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-12">
                <h4>Bootstrap Snipp for Datatable</h4>
                <div class="table-responsive">


                    <table id="mytable" class="table table-bordred table-striped">

                        <thead>

                        <th>نام و نام خانوادگی</th>
                        <th>تلفن</th>
                        <th>شهر</th>
                        <th>محل آگهی</th>
                        <th>بودجه خرید </th>

                        <th></th>

                        <th></th>
                        </thead>
                        <tbody>
@foreach($posters as $poster)
                        <tr>
                            <td>{{$poster->name}}</td>
                            <td>{{$poster->phone}}</td>
                            <td>{{$poster->city->name}}</td>
                            <td>{{$poster->social->name}}</td>
                            <td>{{$poster->allocate}}</td>
                            <td>
                                <a  href="{{route('get_poster',['id'=>$poster->id])}}" id="show" type="button" class="btn btn-primary" >مشاهده</a>
                                <a href="{{route('update_poster_page',['id'=>$poster->id])}}" id="edit" type="button" class="btn btn-warning" >ویرایش</a>
                            </td>
                        </tr>
@endforeach




                        </tbody>

                    </table>



                </div>

            </div>
        </div>
    </div>@endsection
