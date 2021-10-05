@extends('layouts.admin')
@section('title',"التقيمات")
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> التقيمات </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> التقيمات
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">التقيمات</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')

                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <table class="table display nowrap table-striped table-bordered">
                                        {{--scroll-horizontal--}}
                                        <thead class="">
                                            <tr>
                                                <th>المنتج </th>
                                                <th>عنوان التقيم </th>
                                                <th>الناشر </th>
                                                <th>التقيم </th>
                                                <th>عدد المعجبين </th>
                                                <th>عدد الغير معجبين</th>
                                                <th>التعليق </th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($reviews )
                                            @foreach($reviews as $review )
                                            <tr>
                                                <td>{{\App\Models\Product::where('id', $review->product_id)->first()->name ?? ''}}</td>
                                                <td>{{$review->title}}</td>
                                                <td>{{\App\User::where('id', $review->user_id)->first()->name ?? ''}}</td>
                                                <td>{{$review->star_num}} <i class="ft-star" style="color: #f39c12"></i></td>
                                                <td>{{$review->like_num }} <i class="ft-thumbs-up" style="color: #2980b9"></i></td>
                                                <td>{{$review->dislike_num}} <i class="ft-thumbs-down" style="color: #2980b9"></i></td>
                                                <td>{{$review->desc}}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{route('admin.products.deleteReview', $review->id)}}"
                                                        class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1
                                                        mb-1">حذف</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">
                                        {{  $reviews -> links() }}
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
@endsection
