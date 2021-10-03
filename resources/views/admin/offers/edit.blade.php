@extends('layouts.admin')
@section('title',"تعديل العرض")
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الصفحة الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.offers.index')}}"> الاقسام الرئيسية </a>
                            </li>
                            <li class="breadcrumb-item active"> تعديل العرض - {{ $offer->name }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form"> تعديل العرض</h4>
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
                                <div class="card-body">
                                    <form class="form" action="{{route('admin.offers.update',$offer->id)}}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <input name="id" value="{{$offer->id}}" type="hidden">
                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> بيانات العرض</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> العرض </label>
                                                        <input type="text" value="" id="offer" class="form-control" placeholder="  " name="offer">
                                                        @error("offer")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> نبذة عن العرض </label>
                                                        <input type="text" value="" id="desc" class="form-control" placeholder="  " name="desc">
                                                        @error("desc")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> تاريخ بداء العرض </label>
                                                        <input type="date" value="" id="start" class="form-control" placeholder="  " name="start">
                                                        @error("start")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> تاريخ انتهاء العرض </label>
                                                        <input type="date" value="" id="end" class="form-control" placeholder="  " name="end">
                                                        @error("end")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> الحالة </label>
                                                        <select id="status" class="form-control" name="status">
                                                            <option value="0">مفعل</option>
                                                            <option value="1">غير مفعل</option>
                                                        </select>
                                                        @error("status")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> المستخدمين المتاح لهم العرض </label>
                                                        <select id="users" class="form-control" name="users[]" multiple>
                                                            @foreach ($users as $user)
                                                            @foreach($offer->users as $offerUser)@endforeach
                                                            <option {{ $offerUser->id == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error("users[]")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> المنتجات المتاح عليها العرض </label>
                                                        <select id="products" class="form-control" name="products[]" multiple>
                                                            @foreach ($products as $product)
                                                            @foreach($offer->products as $offerProduct)
                                                            <option {{ $offerProduct->id == $product->id ? 'selected' : '' }} value="{{ $product->id }}">{{ $product->name }}</option>
                                                            @endforeach
                                                            @endforeach
                                                        </select>
                                                        @error("products")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> تحديث
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>

@endsection
