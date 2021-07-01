@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-12">
                <h4>Bootstrap Snipp for Datatable</h4>
                <div class="table-responsive">


                    <table id="mytable" class="table table-bordred table-striped">

                        <thead>

                        <th>نام مشتری</th>
                        <th>تلفن</th>

                        <th>نوع ملک </th>

                        <th></th>

                        <th></th>
                        </thead>
                        <tbody>
@foreach($customers_info as $customer_info)
                        <tr>
                            <td>{{$customer_info->name}}</td>
                            <td>{{$customer_info->phone}}</td>
                            <td>{{$customer_info->estate_type->name}}</td>
                            <td>
                                <a  href="{{route('get_customer_info',['id'=>$customer_info->id])}}" id="show" type="button" class="btn btn-primary" >مشاهده</a>
                            </td>
                        </tr>
@endforeach




                        </tbody>

                    </table>



                </div>

            </div>
        </div>
    </div>@endsection
