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
                <form onsubmit=" DoSubmit();" method="GET" action="">
{{csrf_field()}}
                    <div class="input-group float-right col-12 ">
                        <div class="card-group">
                            <div class="container">


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

                                <input name="action" id="search" type="submit" value="جستجو">

                            </div>

                        </div>

                        <div style="background: #3dd5f3">
                            <label>
                                مجموع کل:
                            </label>
                            <label>
                                {{$poster_daily_reports->total()}}
                            </label>
                        </div>
                    </div>

                </form>
            </div>
            <div class="card-body">
                <div class="row">


                    <div class="col-md-12">
                        <h4>لیست گزارش آگهی های روزانه</h4>
                        <div class="table-responsive">


                            <table id="mytable" class="table table-bordred table-striped">

                                <thead>


                                <th>تعداد</th>
                                <th>در چه جایی ثبت شده</th>

                                <th>توضیحات</th>
                                <th>تاریخ</th>

                                </thead>
                                <tbody>
                                @foreach($poster_daily_reports as $poster_daily_report)
                                    <tr>
                                        <form method="post" action="{{route('poster_daily_report_page')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="id" value="{{$poster_daily_report->id}}">
                                            <td><textarea
                                                    @if(!Auth::user()->is_admin) disabled="disabled" @endif
                                                    style="font-size: 10px"
                                                    name="poster_count">{{$poster_daily_report->poster_count}}</textarea>
                                            </td>
                                            <td><textarea
                                                    @if(!Auth::user()->is_admin) disabled="disabled" @endif
                                                    style="font-size: 10px"
                                                    name="description1">{{$poster_daily_report->description1}}</textarea>
                                            </td>
                                            <td><textarea
                                                    @if(!Auth::user()->is_admin) disabled="disabled" @endif
                                                    style="font-size: 10px "
                                                    name="description2">{{$poster_daily_report->description2}}</textarea>
                                            </td>
                                            <td>

                                                <input autocomplete="off" name="date"
                                                       @if(!Auth::user()->is_admin) disabled="disabled" @endif
                                                       id="date_{{$poster_daily_report->id}}"
                                                       class="observer-example-alt"/>
                                            </td>

                                            <td>
                                                <input @if(!Auth::user()->is_admin) hidden="hidden" @endif name="action" type="submit" class="btn btn-primary " value="ویرایش"/>
                                                <input @if(!Auth::user()->is_admin) hidden="hidden" @endif  name="action" id="delete"  type="submit" class="btn btn-danger " value="حذف"/>
                                            </td>

                                            {{--                                        <td>--}}
                                            {{--                                            <a href="{{route('get_poster',['id'=>$poster_daily_reports->id])}}" id="show"--}}
                                            {{--                                               type="button"--}}
                                            {{--                                               class="btn btn-primary">مشاهده</a>--}}
                                            {{--                                            <a href="{{route('update_poster_page',['id'=>$poster_daily_reports->id])}}" id="edit"--}}
                                            {{--                                               type="button" class="btn btn-warning">ویرایش</a>--}}

                                            {{--                                            @if(auth()->user()->is_admin)--}}
                                            {{--                                                <a href="{{route('delete_poster',['id'=>$poster_daily_reports->id])}}"--}}
                                            {{--                                                   id="delete_poster"--}}
                                            {{--                                                   type="button" class="btn btn-danger">حذف</a>--}}
                                            {{--                                            @endif--}}
                                            {{--                                        </td>--}}
                                        </form>

                                    </tr>

                                @endforeach


                                </tbody>

                            </table>


                        </div>
                        {{$poster_daily_reports->links()}}
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

        $("#delete_poster").on('click', function () {
            return confirm("آیا مطمعن هستید؟")
        });

        @foreach($poster_daily_reports as $poster_daily_report)
        $("#date_{{$poster_daily_report->id}}").val("{{\Morilog\Jalali\CalendarUtils::convertNumbers( \Morilog\Jalali\CalendarUtils::strftime('%Y/%m/%d', strtotime($poster_daily_report->created_at)))}}");

        @endforeach



        $("#delete").on('click', function () {
            return confirm("آیا مطمعن هستید؟")
        });


    </script>

@endsection
