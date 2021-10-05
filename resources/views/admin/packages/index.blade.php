@extends('layouts.admin')
@section('title',"الباقات")
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title"> الباقات </h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الصفحة الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active"> الباقات
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
                                <h4 class="card-title">الباقات</h4>
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
                                                <th>الباقة </th>
                                                <th>وصف </th>
                                                <th>التكلفة </th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @isset($packages )
                                            @foreach($packages as $package )
                                            <tr>
                                                <td>{{$package->name}}</td>
                                                <td>{{$package->desc}}</td>
                                                <td>{{number_format($package->price, 2) }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{route('admin.packages.edit',$package->id)}}"
                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>

                                                        <a href="{{route('admin.packages.destroy',$package -> id)}}" class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1
                                                                                                                                                                        mb-1"
                                                            onclick="event.preventDefault();document.getElementById('delete-package-{{ $package->id }}').submit();">حذف</a>
                                                        <form action="{{ route('admin.packages.destroy', $package->id) }}" method="post" class="d-none"
                                                            id="delete-package-{{ $package->id }}">
                                                            @csrf
                                                            @method('delete')
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                    <div class="justify-content-center d-flex">
                                        {{  $packages -> links() }}
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
