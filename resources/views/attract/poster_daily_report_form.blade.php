@extends('layouts.app')

@section('content')
    <div class="container">
        @if(isset($status))
            <div class="alert alert-success" role="alert">
                ثبت  با موفقیت انجام شد!
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('پنل جذب') }}</div>

                    <div class="card-body">


                        <form class="form-horizontal" method="POST" action="{{route('poster_daily_report_form')}}">
                            {{csrf_field()}}
                            <fieldset>

                                <!-- Form Name -->

                                <!-- Text input-->
                                <div class="form-group row">
                                    <label class="col-md-4 control-label" for="poster_count">تعداد آگهی  های ثبت شده</label>
                                    <div class="col-md-2">
                                        <input id="poster_count" name="poster_count" type="text" placeholder="" class="form-control input-md" required="">

                                    </div>
                                </div>
<br>
                                <!-- Textarea -->
                                <div class="form-group row">
                                    <label class="col-md-4 control-label" for="description1">در چه جایی ثبت شده</label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" id="description1" name="description1"></textarea>
                                    </div>
                                </div>
                                <br>

                                <!-- Textarea -->
                                <div class="form-group row">
                                    <label class="col-md-4 control-label" for="description2">توضیحات</label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" id="description2" name="description2"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label class="col-md-4 control-label" for="description2">تاریخ</label>
                                    <div class="col-md-4">
                                        <div class="">
                                            <input autocomplete="off" name="date" id="from_date"
                                                   class="observer-example-alt"/>
                                        </div>                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="singlebutton"></label>
                                    <div class="col-md-4">
                                        <input id="singlebutton" value="ثبت" type="submit" name="singlebutton" class="btn btn-primary"></input>
                                    </div>
                                </div>

                            </fieldset>
                        </form>


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
    </script>
@endsection
