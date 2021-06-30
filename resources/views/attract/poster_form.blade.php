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

                                                        <form method="POST" action="{{route('poster_form')}}">
                                                            {{csrf_field()}}
                                                            <!-- 2 column grid layout with text inputs for the first and last names -->
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="form6Example3">نام و نام
                                                                    خانوادگی </label>
                                                                <input name="name" type="text" id="form6Example3"
                                                                       class="form-control"/>

                                                            </div>

                                                            <!-- Text input -->
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="form6Example3">تلفن
                                                                    همراه</label>
                                                                <input name="phone" type="number" id="form6Example3"
                                                                       class="form-control"/>

                                                            </div>

                                                            <!-- Text input -->
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example4">شهر</label>
                                                                <select id="city_dropdown" name="city_id" class="form-select col-4" required>
                                                                    @foreach(\App\Models\City::all() as $city)
                                                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>

                                                                <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example4">نوع ملک</label>
                                                                <select id="estate_type" name="estate_type_id" class="form-select col-4" required>
                                                                    @foreach(\App\Models\estate_type::all() as $item)
                                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                                <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example4">:::::</label>
                                                                <select id="estate_type_location_id" name="estate_location_type_id" class="form-select col-4" required>
                                                                    @foreach(\App\Models\Estate_Location_type::all() as $item)
                                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>

                                                            <!-- Email input -->
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example5">محل آگهی</label>
                                                                <select id="city_dropdown" name="social_id" class="form-select col-4" required>
                                                                    @foreach(\App\Models\Social::all() as $city)
                                                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                                                    @endforeach
                                                                </select>

                                                            </div>

                                                            <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example6">بودجه خرید</label>
                                                                <input name="allocate" type="number" id="form6Example6"
                                                                       class="form-control"/>

                                                            </div>
                                                                <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example6">ایدی فایل</label>
                                                                <input name="estate_id" type="text" id="form6Example6"
                                                                       class="form-control"/>

                                                            </div>

                                                            <div class="form-outline mb-4">
                                                                <label class="form-label"
                                                                       for="form6Example7">توضیحات</label>
                                                                <textarea name="description" class="form-control" id="form6Example7"
                                                                          rows="4"></textarea>

                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="form6Example7">نتیجه
                                                                    خرید</label>
                                                                <textarea name="result" class="form-control" id="form6Example7"
                                                                          rows="4"></textarea>

                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="form6Example7">تاریخ
                                                                    نتیجه</label>
                                                                <input name="result_date" type="date" id="form6Example6"
                                                                       class="form-control"/>

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
@endsection
