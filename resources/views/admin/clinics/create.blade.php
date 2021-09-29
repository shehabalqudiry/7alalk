@extends('layouts.admin')
@section('title',"اضافة عيادة")
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
                            <li class="breadcrumb-item"><a href="{{route('admin.clinics.index')}}"> الدول </a>
                            </li>
                            <li class="breadcrumb-item active">اضافة عيادة
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
                                <h4 class="card-title" id="basic-layout-form">اضافة عيادة</h4>
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
                                    <form class="form" action="{{route('admin.clinics.store')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group text-center">
                                            <label> صور العيادة</label>

                                            <span class="text-danger ml-1">يمكنك اختيار اكثر من صورة</span>
                                            <br>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="file" name="images[]" multiple />
                                                <span class="file-custom"></span>
                                            </label>
                                            <div id="myImg">
                                            </div>
                                            @error('images')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> بيانات العيادة </h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="name"> الاسم </label>
                                                        <input type="text" value="" id="name" class="form-control"
                                                            placeholder="  " name="name">
                                                        @error("name")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="location"> العنوان </label>
                                                        <input type="text" value="" id="location" class="form-control" placeholder="  " name="location">
                                                        @error("location")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="map_address"> العنوان علي الخريطة </label>
                                                        <span class="text-danger ml-1">قم بنسخ رابط الموقع علي الخريطة ثم قم بلصقه هنا</span>
                                                        <br>
                                                        <input type="text" value="" id="map_address" class="form-control"
                                                            placeholder="  " name="map_address">
                                                        @error("map_address")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> التخصص </label>
                                                        <select id="clinic_cat_id" class="form-control" name="clinic_cat_id">
                                                            <option value="">اختار التخصص التابعه له</option>
                                                            @foreach ($clinic_cats as $cat)
                                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error("clinic_cat_id")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="region_id"> المنطقة التابعة لها العيادة </label>
                                                        <select id="region_id" class="form-control" name="region_id">
                                                            <option value="">اختار المنطقة التابعه لها العيادة</option>
                                                            @foreach ($regions as $region)
                                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error("currency")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="short_desc"> الوصف المختصر </label>
                                                        <input type="text" value="" id="short_desc" class="form-control" placeholder="  " name="short_desc">
                                                        @error("short_desc")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="long_desc"> الوصف كاملا </label>
                                                        <textarea type="text" value="" id="long_desc" class="form-control" placeholder="  " name="long_desc"></textarea>
                                                        @error("long_desc")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="services"> الخدمات </label>
                                                        <textarea type="text" value="" id="services" class="form-control" placeholder="  " name="services"></textarea>
                                                        @error("services")
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
                                                <i class="la la-check-square-o"></i> حفظ
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
<script type="text/javascript">
    $(function() {
        $("#file").change(function() {
            if (this.files && this.files[0]) {
                for (var i = 0; i < this.files.length; i++) { var reader=new FileReader(); reader.onload=imageIsLoaded;
                    reader.readAsDataURL(this.files[i]);
                }
            }
            function imageIsLoaded(e) {
                $('#myImg').append('<img src=' + e.target.result + '>');
            };
        });
    });


</script>
@endsection
