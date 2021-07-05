@extends('layouts.app')


@section('content')
    <div class="container">

                    <div class="card-header ">{{ __('لیست کاربران') }}
                        <form method="GET" action={{route("search_user")}}>
                            <div class="input-group float-right col-md-6 row">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon1">جستجو
                                </button>
                                <input name="query" type="text" class="form-control" placeholder=""
                                       aria-label="Example text with button addon" aria-describedby="button-addon1">
                            </div>

                        </form>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table " style="direction: rtl">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">نام</th>
                                <th scope="col">تلفن</th>
                                <th scope="col">تاریخ عضویت</th>
                                <th scope="col">سمت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=1)
                            @foreach($users as $user)

                                <tr>
                                    <th scope="row">{{
    $i++}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{\Morilog\Jalali\CalendarUtils::strftime('%A, %d %B %y', strtotime($user->created_at))}}</td>
                                    @if($user->is_admin)
                                        <td>
                                            <button type="button" class="btn btn-primary">مدیر</button>
                                            @endif
                                        </td>
                                        @if($user->is_attract)
                                            <td>
                                                <button type="button" class="btn btn-success">جذب</button>

                                            </td>
                                        @endif
                                        @if($user->is_circulation)
                                            <td>
                                                <button type="button" class="btn btn-warning">گردش</button>

                                            </td>

                                        @endif


                                        <td>
                                            <a type="button" class="btn btn-danger" onclick="function ff(id){

                                                if(confirm('آیا میخواهید ادامه دهید؟')) {
                                                window.location.href ='/admin/users/delete/'+id

                                                }
                                                }


                                                ff({{$user->id}});
                                                "
                                            >حذف</a>
                                            <a type="button" class="btn btn-info"
                                               href="{{route("update_user_page",["id"=>$user->id])}}">ویرایش</a>

                                            <a type="button" class="btn btn-secondary"
                                               href="{{route("get_user",["id"=>$user->id])}}">مشاهده</a>

                                        </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>

@endsection
