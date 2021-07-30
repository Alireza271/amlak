@extends('layouts.app')


<!-- default icons used in the plugin are from Bootstrap 5.x icon library (which can be enabled by loading CSS below) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
      crossorigin="anonymous">

<!-- alternatively you can use the font awesome icon library if using with `fas` theme (or Bootstrap 4.x) by uncommenting below. -->
<!-- link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" crossorigin="anonymous" -->

<!-- the fileinput plugin styling CSS file -->
<link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput.min.css" media="all"
      rel="stylesheet" type="text/css"/>

<!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
<!-- link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->

<!-- the jQuery Library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
<script src="https://shpour.ir/js/ImageTools.es6" type="text/javascript"></script>

<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/piexif.min.js"
        type="text/javascript"></script>

<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
    This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/plugins/sortable.min.js"
        type="text/javascript"></script>

<!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>

<!-- the main fileinput plugin script JS file -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/fileinput.min.js"></script>

<!-- following theme script is needed to use the Font Awesome 5.x theme (`fas`). Uncomment if needed. -->
<!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/themes/fas/theme.min.js"></script -->

<!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.2.2/js/locales/LANG.js"></script>
@section('content')


    <div class="container" style="direction: rtl ">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(isset($_GET['status']))
                    <div class="alert alert-success" role="alert">
                        ثبت ملک با موفقیت انجام شد!
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('افزودن ملک') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form onsubmit=" DoSubmit();" id="amlak" action="{{route('add_estate')}}" class="form-group "
                              method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class=" ">
                                <span style="color: red">*</span>


                                @foreach(\App\Models\estate_type::all() as $type)

                                    <div class="form-check-inline">
                                        <input class="form-check-input" type="radio" required name="estate_type"
                                               value="{{$type->id}}">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            {{$type->name}}
                                        </label>
                                    </div>
                                @endforeach


                                <div id="building_type" class=" ">

                                    <br>
                                    <span style="color: red">*</span>

                                    @foreach(\App\Models\building_type::all() as $type)

                                        <div class="form-check-inline">
                                            <input class="form-check-input" required type="radio" name="building_type"
                                                   value="{{$type->id}}">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                {{$type->name}}
                                            </label>
                                        </div>
                                    @endforeach

                                </div>

                                <div id="estate_location_type">
                                    <br>
                                    <span style="color: red">*</span>

                                    @foreach(\App\Models\Estate_Location_type::all() as $type)

                                        <div class="form-check-inline">
                                            <input id="estate_location_type" required class="form-check-input"
                                                   type="radio"
                                                   name="estate_location_type"
                                                   value="{{$type->id}}">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                {{$type->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>


                                <br>
                                <div id="city" class=" row ">

                                    <label class="form-check-label ">
                                        <span style="color: red">*</span>

                                        شهر:
                                    </label>
                                    <select id="city_dropdown" name="city" class="form-select col-4" required>
                                        <option value="">یکی از گزینه هارا انتخاب کنید</option>

                                        @foreach(\App\Models\City::all() as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select> <label class="form-check-label ">
                                        <span style="color: red">*</span>

                                        منطقه:
                                    </label>
                                    <select id="location_dropdown" name="location" class="form-select col-4" required
                                            aria-label="Default select example">
                                    </select>

                                </div>
                                <br>

                            </div>
                            <br>
                            <div id="owner_name" class=" row ">

                                <label class="form-check-label ">
                                    <span style="color: red">*</span>

                                    نام مالک:
                                </label>
                                <div class="col-8">
                                    <input type="text" required name="owner_name" class="form-control">
                                </div>
                            </div>

                            <div id="owner_phone" class=" row ">

                                <label class="form-check-label ">
                                    <span style="color: red">*</span>

                                    شماره مالک:
                                </label>
                                <div class="col-8">
                                    <input type="number" required name="owner_phone" class="form-control">
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div class=" row " id="area">

                                <label class="form-check-label ">
                                    <span style="color: red">*</span>

                                    متراژ زمین:
                                </label>
                                <div class="col-8">
                                    <input type="number" name="area" class="form-control " required>
                                </div>
                            </div>
                            <br>
                            <div class=" row " id="building_area">

                                <label class="form-check-label ">
                                    <span style="color: red">*</span>

                                    متراژ بنا:
                                </label>
                                <div class="col-8">
                                    <input required type="number" name="building_area" class="form-control"
                                           id="building_area">
                                </div>
                            </div>
                            <br>

                            <div id="used_type" class="checkbox-group required">
                                <hr>
                                <label>
                                    نوع کاربری:
                                </label>
                                @foreach(\App\Models\Used_type::all() as $Used_type)
                                    <div class="form-check ">
                                        <input class="form-check-input" name="used_type[]" type="checkbox"
                                               value="{{$Used_type->id}}">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{$Used_type->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div id="vila_option" class=" justify-content-around checkbox-group required">

                                <hr>
                                <label>
                                    نوع ویلا:
                                </label>
                                @foreach(\App\Models\vila_options::all() as $option)
                                    <div class="form-check checkbox-group required ">
                                        <input class="form-check-input" name="vila_option[]" type="checkbox"
                                               value="{{$option->id}}">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{$option->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="" id="floors_count">
                                <hr>
                                <label class="form-check-label ">
                                    <span style="color: red">*</span>

                                    تعداد طبقات:
                                </label>
                                <div class="col-8">
                                    <input required type="number" name="floors_count" class="form-control">
                                </div>
                            </div>

                            <div class="" id="module">

                                <label class="form-check-label ">
                                    <span style="color: red">*</span>

                                    واحد:
                                </label>
                                <div class="col-8">
                                    <input required type="number" name="module" class="form-control">
                                </div>
                            </div>


                            <div class="" id="floors">

                                <label class="form-check-label ">
                                    <span style="color: red">*</span>

                                    طبقه چندم:
                                </label>
                                <div class="col-8">
                                    <input required type="number" name="floors" class="form-control">
                                </div>
                            </div>
                            <br>
                            <hr>
                            <div id="space" class="row justify-content-around">


                                <div class="row"><label class=" ">
                                        <span style="color: red">*</span>

                                        طول:
                                    </label>
                                    <input required type="number" name="length" class="form-control">
                                </div>
                                <div class="row"><label class="form-check-label ">
                                        <span style="color: red">*</span>

                                        عرض:
                                    </label>
                                    <input required type="number" name="width" class="form-control" id="width">
                                </div>
                            </div>


                            <hr>

                            <div id="options"><label>
                                    مشاعات:
                                </label>
                                @foreach(\App\Models\Options::all() as $option)
                                    <div class="form-check">
                                        <input class="form-check-input" name="option[]" type="checkbox"
                                               value="{{$option->id}}">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{$option->name}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>


                            <hr>
                            <div id="price" class="row">

                                <label class="form-check-label ">
                                    <span style="color: red">*</span>

                                    قیمت:
                                </label>
                                <div class="col-8 ">
                                    <div class="input-group mb-3">
                                        <input required id="price_input" name="price" type="text" class="form-control"
                                               aria-label="Recipient's username" aria-describedby="basic-addon2"
                                               onkeyup="javascript:this.value=separate(this.value);">
                                        <span class="input-group-text" id="basic-addon2">تومان</span>
                                    </div>
                                </div>
                                <div id="condition" class="checkbox-group required">
                                    <label>
                                        شرایط قیمت:
                                        <span style="color: red">*</span>

                                    </label>
                                    @foreach(\App\Models\Conditions_type::all() as $Condition)
                                        <div class="form-check">
                                            <input class="form-check-input" name="condition[]" type="checkbox"
                                                   value="{{$Condition->id}}">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{$Condition->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                    <hr>
                                </div>

                            </div>
                            <br>
                            <div id="documents" class="checkbox-group required">
                                <label>
                                    <span style="color: red">*</span>

                                    مدارک:
                                </label>
                                @foreach(\App\Models\document::all() as $document)
                                    <div class="form-check ">
                                        <input class="form-check-input" name="document[]" type="checkbox"
                                               value="{{$document->id}}">
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
                                        <input type="number" name="build_date" class="form-control" max="1400"
                                               min="1200"
                                               aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    </div>
                                </div>
                            </div>

                            <div id="description" class=" row ">

                                <label class="form-check-label ">
                                    توضیحات:
                                </label>
                                <div class="col-8 ">
                                    <div class="input-group mb-3">
                                        <textarea required type="" name="description" class="form-control "> </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class=" row " id="address" disabled>

                                <label class="form-check-label ">
                                    آدرس و کروکی:
                                </label>
                                <div class="col-8 ">
                                    <div class="input-group mb-3">
                                        <textarea required name="address" class="form-control "> </textarea>
                                    </div>
                                </div>
                            </div>

                            <img id="preview" class=" "/>

                            <div id="images" class=" ">

                                <label class="form-check-label ">
                                    بارگذاری تصویر:
                                </label>
                                <div class="col-8 ">
                                    <div class="input-group mb-3 ">
                                        <input id="input-b3" name="image[]" type="file" class="file" multiple
                                               accept="image/jpeg"
                                               data-show-upload="false" data-show-caption="true"
                                               data-msg-placeholder="Select {files} for upload...">
                                    </div>
                                </div>
                                <div id="divImageMediaPreview"></div>
                            </div>
                            <input class="btn-success btn w-25" type="submit" value="ثبت">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">


            $(document).ready(function () {

                $('#amlak').on('change', function () {
                    var estate_type = $('input[name=estate_type]:checked', '#amlak').val();
                    console.log(estate_type);
                    refresh();


                    if (estate_type == 1) {
                        aparteman();
                    }
                    if (estate_type == 2) {
                        zamin();
                    }
                    if (estate_type == 3) {
                        vila();
                    }

                });
            });
            $(document).ready(function () {
                $('#city_dropdown').on('change', function () {
                    $('#location_dropdown')
                        .find('option')
                        .remove()
                    var value = $('#city_dropdown :selected').val();

                    $.ajax({
                        type: "GET",
                        url: "../api/get_locations?city_id=" + value,
                        success: function (response) {
                            response.forEach(function (location) {
                                $("#location_dropdown").append(new Option(location.name, location.id));
                            })

                        }
                    });
                });
            });


            function zamin() {
                $("#building_area :input").attr("disabled", true);
                $("#building_area").attr("hidden", true);

                $("#floors_count :input").attr("disabled", true);
                $("#floors_count").attr("hidden", true);

                $("#floors :input").attr("disabled", true);
                $("#floors").attr("hidden", true);

                $("#module :input").attr("disabled", true);
                $("#module").attr("hidden", true);

                $("#options :input").attr("disabled", true);
                $("#options").attr("hidden", true);

                $("#vila_option :input").attr("disabled", true);
                $("#vila_option").attr("hidden", true);

                $("#build_date :input").attr("disabled", true);
                $("#build_date").attr("hidden", true);
                var hh = $('input[name="document[]"]');


                hh.each(function (i, ob) {
                    if ($(ob).val() == 2) {
                        $(ob).attr('disabled', true)
                    }

                })

            }

            function aparteman() {

                $("#area :input").attr("disabled", true);
                $("#area").attr("hidden", true);

                $("#vila_option :input").attr("disabled", true);
                $("#vila_option").attr("hidden", true);

                $("#building_type :input").attr("disabled", true);
                $("#building_type").attr("hidden", true);

                $("#used_type :input").attr("disabled", true);
                $("#used_type").attr("hidden", true);

                $("#space :input").attr("disabled", true);
                $("#space").attr("hidden", true);


                var hh = $('input[name="document[]"]');


                hh.each(function (i, ob) {
                    if ($(ob).val() == 3) {
                        $(ob).attr('disabled', true)
                    }
                    if ($(ob).val() == 4) {
                        $(ob).attr('disabled', true)
                    }
                })

            }

            function vila() {

                $("#floors_count").attr("hidden", true);
                $("#floors_count :input").attr("disabled", true);

                $("#floors :input").attr("disabled", true);
                $("#floors").attr("hidden", true);

                $("#module :input").attr("disabled", true);
                $("#module").attr("hidden", true);

                $("#space :input").attr("disabled", true);
                $("#space").attr("hidden", true);

                $("#used_type :input").attr("disabled", true);
                $("#used_type").attr("hidden", true);

                $("#build_date :input").attr("disabled", true);
                $("#build_date").attr("hidden", true);
            }


            function refresh() {
                $("#estate_location_type :input").attr("disabled", false);
                $("#estate_location_type").attr("hidden", false);

                $("#building_area :input").attr("disabled", false);
                $("#building_area").attr("hidden", false);

                $("#floors_count :input").attr("disabled", false);
                $("#floors_count").attr("hidden", false);

                $("#floors :input").attr("disabled", false);
                $("#floors").attr("hidden", false);

                $("#module :input").attr("disabled", false);
                $("#module").attr("hidden", false);

                $("#options :input").attr("disabled", false);
                $("#options").attr("hidden", false);


                $("#build_date :input").attr("disabled", false);
                $("#build_date").attr("hidden", false);

                $("#area :input").attr("disabled", false);
                $("#area").attr("hidden", false);


                $("#building_type :input").attr("disabled", false);
                $("#building_type").attr("hidden", false);

                $("#used_type :input").attr("disabled", false);
                $("#used_type").attr("hidden", false);

                $("#space :input").attr("disabled", false);
                $("#space").attr("hidden", false);

                $("#vila_option :input").attr("disabled", false);
                $("#vila_option").attr("hidden", false);
                var hh = $('input[name="document[]"]');


                hh.each(function (i, ob) {

                    $(ob).attr('disabled', false)

                })
            }

            // $("#image_upload").change(function () {
            //     if (typeof (FileReader) != "undefined") {
            //         var dvPreview = $("#divImageMediaPreview");
            //         dvPreview.html("");
            //         var i = 0;
            //         $($(this)[0].files).each(function () {
            //             i++;
            //             var idd = "img" + i.toString();
            //             var file = $(this);
            //             var reader = new FileReader();
            //             reader.onload = function (e) {
            //                 var img = $("<img id='" + idd + "' onclick='closee(" + idd + ");' />");
            //                 img.attr("style", "width: 150px; height:100px; padding: 10px");
            //                 img.attr("src", e.target.result);
            //                 dvPreview.append(img);
            //
            //             }
            //             reader.readAsDataURL(file[0]);
            //         });
            //     } else {
            //         alert("This browser does not support HTML5 FileReader.");
            //     }
            // });

            // function closee(id) {
            //     $("#" + id.id).attr("hidden", true);
            //     console.log($("#image_upload").val());
            // }


            function separate(Number) {
                var ss = parseInt(Number.replaceAll(',', ''));
                if (isNaN(ss)) {
                    return '';
                }
                console.log(ss);

                return ss.toLocaleString();
            }

            function DoSubmit() {
                var price = $("#price_input").val();
                $("#price_input").val(price.replaceAll(',', ''));
                $('#input-b3').val('');
            }

            $("#amlak").on('submit', function (e) {
                var documents = $('#documents :checkbox:checked').length > 0;
                var condition = $('#condition :checkbox:checked').length > 0;
                var vila_option = $('#vila_option :checkbox:checked').length > 0;
                var used_type = $('#used_type :checkbox:checked').length > 0;
                var estate_type = $('input[name=estate_type]:checked').val();
                console.log(estate_type);

                if (!documents) {
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#documents").offset().top,

                    }, 100);
                    alert("حداقل یکی از موارد مدارک را انتخاب کنید");
                    return false;
                }
                if (!condition) {
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $("#condition").offset().top
                    }, 100);
                    alert("حداقل یکی از موارد  شرایط فروش را انتخاب کنید");

                    return false;

                }
                if (estate_type == 2) {
                    if (!used_type) {
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#used_type").offset().top
                        }, 100);
                        alert("حداقل یکی از موارد نوع کاربری را انتخاب کنید");

                        return false;

                    }
                }
                if (estate_type == 3) {
                    if (!vila_option) {
                        $([document.documentElement, document.body]).animate({
                            scrollTop: $("#vila_option").offset().top
                        }, 100);
                        alert("حداقل یکی از موارد ویلا را انتخاب کنید");

                        return false;

                    }
                }

                return true
            });
            var jj;
            document.getElementById('input-b3').onchange = function (evt) {
                var files = $("#input-b3").prop('files');
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    const img = new Image();
                    img.src = URL.createObjectURL(file);


                    // img.onload = function (dd) {
                    //     var resulution;
                    //     if (img.width > img.height) {
                    //         resulution = {
                    //             width: 1920, // maximum width
                    //             height: 1080 // maximum height
                    //         };
                    //     } else {
                    //         resulution = {
                    //             width: 1080, // maximum width
                    //             height: 1920 // maximum height
                    //         };
                    //     }
                        ImageTools.resize(file,  {
                            width: 1920, // maximum width
                            height: 1080 // maximum height
                        }, function (blob, didItResize) {
                            var reader = new FileReader();
                            reader.readAsDataURL(blob);

                            reader.onloadend = function () {
                                var base64data = reader.result;
                                $('#amlak').append("<input class='hidden-image' type='hidden' name='images[]' value='" + base64data + "'>");

                            }
                            // $('#amlak').append("<img src='"+window.URL.createObjectURL(blob)+"'>");
                            // didItResize will be true if it managed to resize it, otherwise false (and will return the original file as 'blob')
                            // $("#input-b3").prop('files',reader.result);

                            // you can also now upload this blob using an XHR.
                        });
                    }


                }
                // $("#input-b3").prop('files').each(function (file){
                //     console.log(file.name);
                //
                // });
                // $("#input-b3").prop('files').forEach( (file)=>{
                //     console.log(file.name)
                // });

                //
                //     ImageTools.resize(file, {
                //         width: 320, // maximum width
                //         height: 240 // maximum height
                //     }, function (blob, didItResize) {
                //         // didItResize will be true if it managed to resize it, otherwise false (and will return the original file as 'blob')
                //         document.getElementById('preview').src = window.URL.createObjectURL(blob);
                //         // you can also now upload this blob using an XHR.
                //     });


            $(document).on('click', '.btn-close', function(){
                $('.hidden-image').remove();
            });

        </script>
@endsection

