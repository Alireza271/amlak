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

                                                    <form  onsubmit=" DoSubmit();" method="POST" action="{{route('customer_info_form')}}">
                                                    {{csrf_field()}}
                                                    <!-- 2 column grid layout with text inputs for the first and last names -->
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label" for="form6Example3">نام
                                                                مشتری</label>
                                                            <input name="name" type="text" id="form6Example3"
                                                                   class="form-control"/>

                                                        </div>


                                                        <div class="form-outline mb-4">
                                                            <label class="form-label"
                                                                   for="form6Example6">تعداد</label>
                                                            <input name="count" type="number" id="form6Example6"
                                                                   class="form-control"/>

                                                        </div>
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label"
                                                                   for="form6Example6">همراه خانواده</label>
                                                            <input type="checkbox" name="with_family" value="1">

                                                        </div>


                                                        <div class="form-outline mb-4">
                                                            <label class="form-label"
                                                                   for="form6Example7">شغل</label>
                                                            <textarea name="job" class="form-control"
                                                                      id="form6Example7"
                                                                      rows="4"></textarea>

                                                        </div>

                                                        <div class="form-outline mb-4">
                                                            <label class="form-label" for="form6Example7">مدل
                                                                ماشین</label>
                                                            <input name="car_model" type="text"
                                                                   id="form6Example6"
                                                                   class="form-control"/>

                                                        </div>
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label"
                                                                   for="form6Example7">سن</label>
                                                            <input name="age" type="number"
                                                                   id="form6Example6"
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
                                                                   for="form6Example4">نوع ملک</label>
                                                            <select id="estate_type" name="estate_type_id"
                                                                    class="form-select col-4" required>
                                                                @foreach(\App\Models\estate_type::all() as $item)
                                                                    <option
                                                                        value="{{$item->id}}">{{$item->name}}</option>
                                                                @endforeach
                                                            </select>

                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="form6Example7">شرایط
                                                                    خرید</label>
                                                                <input name="Terms_of_purchase" type="text"
                                                                       id="form6Example6"
                                                                       class="form-control"/>

                                                            </div>


                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="form6Example7">قدرت
                                                                    خرید</label>
                                                                <input onkeyup="javascript:this.value=separate(this.value);" name="Purchasing_power" type="text"
                                                                       id="Purchasing_power"
                                                                       class="form-control"/>

                                                            </div>
                                                        </div>
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label" for="form6Example7">فایل های
                                                                بازدید شده</label>
                                                            <input name="visited_estate_count" type="number"
                                                                   id="form6Example6"
                                                                   class="form-control"/>

                                                        </div>

                                                        <div class="form-outline mb-4">
                                                            <label class="form-label" for="form6Example7">نظریه
                                                                مدیریت</label>
                                                            <input name="admin_comment" type="text"
                                                                   id="form6Example6"
                                                                   class="form-control"/>

                                                        </div>

                                                        <div class="form-outline mb-4">
                                                            <label class="form-label" for="form6Example7">نظریه گروه
                                                                گردش</label>
                                                            <input name="circulation_comment" type="text"
                                                                   id="form6Example6"
                                                                   class="form-control"/>

                                                        </div>
                                                        <div class="form-outline mb-4">
                                                            <label class="form-label" for="form6Example7">نظریه گروه
                                                                جذب</label>
                                                            <input name="attract_comment" type="text"
                                                                   id="form6Example6"
                                                                   class="form-control"/>

                                                        </div>

                                                        <div class="form-outline mb-4">
                                                            <label class="form-label"
                                                                   for="form6Example7">توضیحات</label>
                                                            <textarea name="description" class="form-control"
                                                                      id="form6Example7"
                                                                      rows="4"></textarea>

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
    <script>
        function separate(Number)
        {
            var ss = parseInt(Number.replaceAll(',', ''));
            if (isNaN(ss)) {
                return '';
            }
            console.log(ss);

            return ss.toLocaleString();
        }

        function DoSubmit(){
            var price=$("#Purchasing_power").val();
            $("#Purchasing_power").val(price.replaceAll(',',''));

        }
    </script>
@endsection
