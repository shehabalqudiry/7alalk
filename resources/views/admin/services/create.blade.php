@extends('layouts.admin')
@section('title',"اضافة خدمة")
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.services.index')}}"> الخدمات </a>
                            </li>
                            <li class="breadcrumb-item active">اضافة خدمة
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
                                    <h4 class="card-title" id="basic-layout-form">  اضافة خدمة </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
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
                                        <form class="form" action="{{route('admin.services.store')}}"
                                            method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label> صورة الخدمة </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photo" />
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات اضافة خدمة </h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> القسم الرئيسي التابعه له الخدمة </label>
                                                                    <select name="cat_id" class="form-control maincat" id="">
                                                                        @foreach ($cats as $cat)
                                                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error("cat_id")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> القسم الفرعي التابعة له الخدمة </label>
                                                                    <select name="subcat_id" class="form-control" id="subcat">
                                                                    </select>
                                                                    @error("cat_id")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> الاسم </label>
                                                                    <input type="text" value="" id="name_ar"
                                                                        class="form-control"
                                                                        placeholder="  "
                                                                        name="name_ar">
                                                                    @error("name_ar")
                                                                <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> الاسم بالانجليزية </label>
                                                                    <input type="text" value="" id="name_en"
                                                                        class="form-control"
                                                                        placeholder="  "
                                                                        name="name_en">
                                                                    @error("name_en")
                                                                <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> شرح الخدمة </label>
                                                                    <textarea name="desc_ar" class="form-control" rows="3"
                                                                        cols="5"></textarea>
                                                                    @error("desc_ar")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  شرح الخدمة بالانجليزية  </label>
                                                                    <textarea name="desc_en" class="form-control" rows="3"
                                                                        cols="5"></textarea>
                                                                    @error("desc_en")
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

@endsection
@section('script')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click','.form-control.maincat', function(e) {
        e.preventDefault();
        var cat = $('.form-control.maincat').val();
    /**Ajax code**/
    $.ajax({
        type: "POST",
        url:"{{route('admin.cats.getsubcat')}}",
        data:{cat:cat},

        success: function (data) {
            $('#subcat').empty();
            $('#subcat').append("<option  value=''>غير تابعة لقسم فرعي</option>");
            $('#subcat').append(data.data);
        },
    });
        /**Ajax code ends**/
    });
});
</script>
@endsection