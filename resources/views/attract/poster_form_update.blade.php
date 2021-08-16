<style>
    html,
    body,
    .intro {
        height: 100%;
    }

    .bg-image-vertical {
        position: relative;
        overflow: hidden;
        background-repeat: no-repeat;
        background-position: right center;
        background-size: auto 100%;
    }
</style>

@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('پنل جذب') }}</div>

                    <div class="card-body">

                        <section class="intro">
                            <div class="bg-image-vertical h-100" style="background-color: #EFD3E4;
        ">
                                <div class="mask d-flex align-items-center h-100">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-lg-10">
                                                <div class="card" style="border-radius: 1rem;">
                                                    <div class="card-body p-5">

                                                        <h1 class="mb-5 text-center">Checkout Form</h1>

                                                        <form method="POST" action="{{route('update_poster')}}">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="id" value="{{$poster->id}}">
                                                            <!-- 2 column grid layout with text inputs for the first and last names -->
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="form6Example3">نام و نام
                                                                    خانوادگی </label>
                                                                <input name="name" type="text" id="form6Example3"
                                                                       value="{{$poster->name}}"
                                                                       class="form-control"/>

                                                            </div>

                                                            <!-- Text input -->
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="form6Example3">تلفن
                                                                    همراه</label>
                                                                <input name="phone" type="number" id="form6Example3"
                                                                       value="{{$poster->phone}}"

                                                                       class="form-control"/>

                                                            </div>

                                                            <!-- Text input -->
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example4">شهر</label>
                                                                <select id="city_dropdown" name="city_id"
                                                                        class="form-select col-4" required>
                                                                    @foreach(\App\Models\AllCities::all() as $city)
                                                                        <option
                                                                            @if($poster->city_id==$city->id)
                                                                            SELECTED
                                                                            @endif

                                                                            value="{{$city->id}}">{{$city->name}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>

                                                            <!-- Email input -->
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example5">محل آگهی</label>
                                                                <select id="city_dropdown" name="social_id"
                                                                        class="form-select col-4" required>
                                                                    @foreach(\App\Models\Social::all() as $social)
                                                                        <option
                                                                            @if($poster->social_id==$social->id)
                                                                            selected
                                                                            @endif
                                                                            value="{{$social->id}}">{{$social->name}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>

                                                            <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example5">نوع ملک</label>
                                                                <select id="city_dropdown" name="estate_type_id"
                                                                        class="form-select col-4" required>
                                                                    @foreach(\App\Models\estate_type::all() as $item)
                                                                        <option
                                                                            @if($poster->estate_type_id==$item->id)
                                                                            selected
                                                                            @endif
                                                                            value="{{$item->id}}">{{$item->name}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>

                                                            <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example5">:::</label>
                                                                <select id="city_dropdown"
                                                                        name="Estate_Location_type_id"
                                                                        class="form-select col-4" required>
                                                                    @foreach(\App\Models\Estate_Location_type::all() as $item)
                                                                        <option
                                                                            @if($poster->Estate_Location_type_id==$item->id)
                                                                            selected
                                                                            @endif
                                                                            value="{{$item->id}}">{{$item->name}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>

                                                            <!-- Number input -->
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example6">بودجه خرید</label>
                                                                <input name="allocate" type="number" id="form6Example6"
                                                                       value="{{$poster->allocate}}"

                                                                       class="form-control"/>

                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example6">ایدی فایل</label>
                                                                <input name="estate_id" type="number" id="form6Example6"
                                                                       value="{{$poster->estate_id}}"

                                                                       class="form-control"/>

                                                            </div>

                                                            <!-- Message input -->
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example7">توضیحات</label>
                                                                <textarea name="description" class="form-control"
                                                                          id="form6Example7"
                                                                          rows="4">
                                                                    {{$poster->description}}
                                                                </textarea>

                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="form6Example7">نتیجه
                                                                    خرید</label>
                                                                <textarea name="result" class="form-control"
                                                                          id="form6Example7"


                                                                          rows="4">{{$poster->result}}</textarea>

                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="form6Example7">تاریخ
                                                                    نتیجه</label>
                                                                <input name="result_date"  id="form6Example6"
                                                                       value="{{$poster->result_date}}"

                                                                       class="observer-example-alt"/>

                                                            </div>

                                                            <!-- Checkbox -->

                                                            <!-- Submit button -->
                                                            <button type="submit"
                                                                    class="btn btn-secondary btn-rounded btn-block">
                                                                ثبت اطلاعات
                                                            </button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


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
