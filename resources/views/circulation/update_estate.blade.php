@extends('layouts.app')

@section('content')


    <div class="container" style="direction: rtl ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(isset($_GET['status']))
                    <div class="alert alert-success" role="alert">
                        ویرایش با موفقیت انجام شد!
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __(' ویرایش  ملک') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form onsubmit=" DoSubmit();" id="amlak" action="{{route('update_estate')}}" class="form-group " method="post">
                            {{csrf_field()}}
                            <input hidden name="estate_id" value="{{$estate->id}}">
                            <div>
                                <div class=" ">
                                    @foreach(\App\Models\Estate_Location_type::all() as $type)

                                        <div class="form-check-inline">
                                            <input
                                                @if($estate->estate_location_type_id==$type->id)
                                                checked
                                                @endif

                                                class="form-check-input" type="radio" required
                                                name="estate_location_type"
                                                value="{{$type->id}}">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                {{$type->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <br>
                                <div class=" row ">

                                    <label class="form-check-label ">
                                        شهر:
                                    </label>
                                    <select id="city_dropdown" name="city" class="form-select col-4">

                                        @foreach(\App\Models\City::all() as $city)
                                            <option
                                                @if($estate->city_id==$city->id)
                                                selected
                                                @endif
                                                value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select> <label class="form-check-label ">
                                        منطقه:
                                    </label>

                                    <select id="location_dropdown" name="location" class="form-select col-4"
                                            aria-label="Default select example">

                                        @foreach(\App\Models\Location::query()->where('city_id',$estate->city_id)->get() as $location)

                                            <option
                                                @if($estate->location_id==$location->id)
                                                selected
                                                @endif
                                                value="{{$location->id}}">
                                                {{$location->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <br>
                                <div class=" row ">

                                    <label class="form-check-label ">
                                        نام مالک:
                                    </label>
                                    <div class="col-8">
                                        <input type="text" name="owner_name" value="{{$estate->owner_name}}"
                                               class="form-control">
                                    </div>
                                </div>
                                <br>
                                <div class=" row ">

                                    <label class="form-check-label ">
                                        شماره مالک:
                                    </label>
                                    <div class="col-8">
                                        <input type="number" value="{{$estate->owner_phone}}" name="owner_phone"
                                               class="form-control">
                                    </div>
                                </div>
                                <br>
                                <hr>

                                @if($estate_type==2||$estate_type==3)
                                    <div class=" row " id="area">

                                        <label class="form-check-label ">
                                            متراژ زمین:
                                        </label>
                                        <div class="col-8">
                                            <input type="number" value="{{$estate->area}}" name="area"
                                                   class="form-control">
                                        </div>
                                    </div>
                                @endif
                                <br>
                                @if($estate_type==1||$estate_type==3)
                                    <div class=" row " id="building_area">

                                        <label class="form-check-label ">
                                            متراژ بنا:
                                        </label>
                                        <div class="col-8">
                                            <input type="number" value="{{$estate->building_area}}" name="building_area"
                                                   class="form-control"
                                                   id="building_area">
                                        </div>
                                    </div>
                                @endif
                                <br>
                                @if($estate_type==2||$estate_type==3)

                                    <div class=" ">
                                        @foreach(\App\Models\building_type::all() as $type)

                                            <div class="form-check-inline">
                                                <input
                                                    @if($estate->building_type->id==$type->id)
                                                    checked
                                                    @endif

                                                    class="form-check-input" type="radio" required
                                                    name="building_type"
                                                    value="{{$type->id}}">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    {{$type->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @if($estate_type==2)

                                    <div id="used_type">
                                        <hr>
                                        <label>
                                            نوع کاربری:
                                        </label>
                                        @foreach(\App\Models\Used_type::all() as $Used_type)
                                            <div class="form-check ">
                                                <input
                                                    @if(in_array($Used_type->id, $estate->used_type->pluck('id')->all()))
                                                    checked
                                                    @endif                                                    class="form-check-input"
                                                    name="used_type[]" type="checkbox"
                                                    value="{{$Used_type->id}}">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{$Used_type->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                @if($estate_type==3)

                                    <div id="vila_option" class=" justify-content-around">

                                        <hr>
                                        <label>
                                            نوع ویلا:
                                        </label>
                                        @foreach(\App\Models\vila_options::all() as $option)
                                            <div class="form-check ">
                                                <input
                                                    @if(in_array($option->id, $estate->vila_options->pluck('id')->all()))
                                                    checked
                                                    @endif
                                                    class="form-check-input" name="vila_option[]" type="checkbox"
                                                    value="{{$option->id}}">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{$option->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>

                                @endif
                                @if($estate_type==1)

                                    <div class="" id="floors_count">
                                        <hr>
                                        <label class="form-check-label ">
                                            تعداد طبقات:
                                        </label>
                                        <div class="col-8">
                                            <input type="number" value="{{$estate->floors_count}}" name="floors_count"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="" id="module">

                                        <label class="form-check-label ">
                                            واحد:
                                        </label>
                                        <div class="col-8">
                                            <input type="number" value="{{$estate->module}}" name="module"
                                                   class="form-control">
                                        </div>
                                    </div>


                                    <div class="" id="floors">

                                        <label class="form-check-label ">
                                            طبقه چندم:
                                        </label>
                                        <div class="col-8">
                                            <input type="number" value="{{$estate->floors}}" name="floors"
                                                   class="form-control">
                                        </div>
                                    </div>
                                @endif
                                <br>
                                <hr>

                                @if($estate_type==2)

                                    <div id="space" class="row justify-content-around">


                                        <div class="row"><label class=" ">
                                                طول:
                                            </label>
                                            <input type="number" value="{{$estate->length}}" name="length"
                                                   class="form-control">
                                        </div>
                                        <div class="row"><label class="form-check-label ">
                                                عرض:
                                            </label>
                                            <input type="number" value="{{$estate->width}}" name="width"
                                                   class="form-control" id="width">
                                        </div>
                                    </div>
                                    <hr>
                                @endif

                                @if($estate_type==1||$estate_type==3)

                                    <div class="row justify-content-around">
                                        <div id="options"><label>
                                                مشاعات:
                                            </label>
                                            @foreach(\App\Models\Options::all() as $option)
                                                <div class="form-check ">
                                                    <input
                                                        @if(in_array($option->id, $estate->options->pluck('id')->all()))
                                                        checked
                                                        @endif

                                                        class="form-check-input" name="option[]" type="checkbox"
                                                        value="{{$option->id}}">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{$option->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @endif

                                        <div><label>
                                                شرایط قیمت:
                                            </label>
                                            @foreach(\App\Models\Conditions_type::all() as $Condition)
                                                <div class="form-check ">
                                                    <input

                                                        @if(in_array($Condition->id, $estate->conditions_type->pluck('id')->all()))
                                                        checked
                                                        @endif

                                                        class="form-check-input" name="condition[]" type="checkbox"
                                                        value="{{$Condition->id}}" id="condition">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{$Condition->name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>


                                    <hr>
                                    <div class=" row ">

                                        <label class="form-check-label ">
                                            قیمت:
                                        </label>
                                        <div class="col-8 ">
                                            <div class="input-group mb-3">
                                                <input id="price_input"
                                                    onkeyup="javascript:this.value=separate(this.value);"
                                                       name="price" value="{{$estate->price}}" type="text"
                                                       class="form-control"
                                                       aria-label="Recipient's username"
                                                       aria-describedby="basic-addon2">
                                                <span class="input-group-text" id="basic-addon2">تومان</span>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div><label>
                                            مدارک:
                                        </label>
                                        @foreach(\App\Models\document::all() as $document)

                                            <div class="form-check ">
                                                <input @switch($estate_type)
                                                       @case(1)
                                                       @if($document->id==3||$document->id==4)
                                                       disabled
                                                       @endif
                                                       @break
                                                       @case(2)
                                                       @if($document->id==2)
                                                       disabled
                                                       @endif
                                                       @break
                                                       @endswitch


                                                       @if(in_array($document->id, $estate->documents->pluck('id')->all()))
                                                       checked
                                                       @endif
                                                       class="form-check-input" name="document[]" type="checkbox"
                                                       value="{{$document->id}}" id="document">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    {{$document->name}}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <br>
                                    <div class=" row " id="build_date">

                                        <label class="form-check-label ">
                                            سال ساخت:
                                        </label>
                                        <div class="col-8 ">
                                            <div class="input-group mb-3">
                                                <input type="number" value="{{$estate->building_date}}"
                                                       name="build_date"
                                                       class="form-control" max="1400"
                                                       min="1200"
                                                       aria-label="Recipient's username"
                                                       aria-describedby="basic-addon2">
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" row ">

                                        <label class="form-check-label ">
                                            توضیحات:
                                        </label>
                                        <div class="col-8 ">
                                            <div class="input-group mb-3">
                                            <textarea type="" name="description"
                                                      class="form-control ">{{$estate->description}}  </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class=" row " id="address" disabled>

                                        <label class="form-check-label ">
                                            آدرس و کروکی:
                                        </label>
                                        <div class="col-8 ">
                                            <div class="input-group mb-3">
                                            <textarea name="address"
                                                      class="form-control "> {{$estate->address}} </textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <input class="btn-success btn w-25" type="submit" value="ثبت">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">


                     $(document).ready(function () {
                $('#city_dropdown').on('change', function () {
                    $('#location_dropdown')
                        .find('option')
                        .remove()
                    var value = $('#city_dropdown :selected').val();

                    set_locations(value);
                });
            });

            function set_locations(value) {

                $.ajax({
                    async: false,
                    type: "GET",
                    url: "../../api/get_locations?city_id=" + value,
                    success: function (response) {
                        response.forEach(function (location) {
                            $("#location_dropdown").append(new Option(location.name, location.id));
                        })

                    }
                });
            }


            $('input[name="estate_type"]').filter("[value={{$estate->estate_type_id}}]").attr('checked', true);
            $('input[name="building_type"]').filter("[value={{empty($estate->building_type_id)?0:$estate->building_type_id}}]").attr('checked', true);


            var estate_types = JSON.parse("{{$estate->used_type}}".replace(/&quot;/g, '"'));
            estate_types.forEach(function (s) {
                $('input[name= "used_type[]"]').filter("[value=" + s.id + "]").attr('checked', true);

            });
            var vila_options = JSON.parse("{{$estate->vila_options}}".replace(/&quot;/g, '"'));
            vila_options.forEach(function (s) {
                $('input[name= "vila_option[]"]').filter("[value=" + s.id + "]").attr('checked', true);

            });
            var options = JSON.parse("{{$estate->options}}".replace(/&quot;/g, '"'));
            options.forEach(function (s) {
                $('input[name= "option[]"]').filter("[value=" + s.id + "]").attr('checked', true);

            });
            var condition = JSON.parse("{{$estate->conditions_type}}".replace(/&quot;/g, '"'));
            condition.forEach(function (s) {
                $('input[name= "condition[]"]').filter("[value=" + s.id + "]").attr('checked', true);

            });
            var documents = JSON.parse("{{$estate->documents}}".replace(/&quot;/g, '"'));
            documents.forEach(function (s) {
                $('input[name= "document[]"]').filter("[value=" + s.id + "]").attr('checked', true);

            });

            function set_estate_instartup() {
                var id = {{$estate->estate_type_id}};
                if (id == 1) {
                    aparteman();
                }
                if (id == 2) {
                    zamin();
                }
                if (id == 3) {
                    vila();
                }
            }


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
                         var price=$("#price_input").val();
                         $("#price_input").val(price.replaceAll(',',''));

                     }

        </script>
@endsection

