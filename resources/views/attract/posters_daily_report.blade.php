@extends('layouts.app')

@section('content')
    <style>
        .textarea{
            font-size: 17px;
        }
    </style>
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
                    <div class="row input-group float-right col-12">
                        <div class=" card-group">
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

                                @if(Auth::user()->is_admin)    <br>
                                <div class="form-group row row-cols-sm-2 row-cols-lg-2 mb-2 align-content-center">

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
                                @endif


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
                                @if(Auth::user()->is_admin)
                                    <th>
                                       ثبت کننده
                                    </th>
                                @endif
                                <th>

                                </th>
                                </thead>
                                <tbody>
                                @foreach($poster_daily_reports as $poster_daily_report)
                                    <tr>
                                        <form method="post" action="{{route('poster_daily_report_page')}}">
                                            {{csrf_field()}}
                                            <input type="hidden" name="id" value="{{$poster_daily_report->id}}">
                                            <td><textarea class="textarea"
                                                    @if(!Auth::user()->is_admin) disabled="disabled" @endif

                                                    name="poster_count">{{$poster_daily_report->poster_count}}</textarea>
                                            </td>
                                            <td><textarea

                                                    class="textarea"
                                                    @if(!Auth::user()->is_admin) disabled="disabled" @endif

                                                    name="description1">{{$poster_daily_report->description1}}</textarea>
                                            </td>
                                            <td><textarea class="textarea"
                                                          style="width: 400px;
                                                        height: 150px;

"

                                                          @if(!Auth::user()->is_admin) disabled="disabled" @endif

                                                    name="description2">{{$poster_daily_report->description2}}</textarea>
                                            </td>
                                            <td>

                                                <input autocomplete="off" name="date"
                                                       @if(!Auth::user()->is_admin) disabled="disabled" @endif
                                                       id="date_{{$poster_daily_report->id}}"
                                                       class="observer-example-alt"/>
                                            </td>

                                            @if(Auth::user()->is_admin)
                                                <td>
                                                    {{$poster_daily_report->user->name}}
                                                </td>
                                            @endif
                                            <td>
                                                <input @if(!Auth::user()->is_admin) hidden="hidden" @endif name="action"
                                                       type="submit" class="btn btn-primary " value="ویرایش"/>
                                                <input @if(!Auth::user()->is_admin) hidden="hidden"
                                                       @endif  name="action" id="delete" type="submit"
                                                       class="btn btn-danger " value="حذف"/>
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
