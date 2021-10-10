@extends('layouts.admin')
@section('title',"تعديل منتجات المتجر")
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
                            <li class="breadcrumb-item"><a href="{{route('admin.products')}}"> المنتجات </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل منتجات المتجر - {{ $product-> name }}
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل منتجات المتجر</h4>
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
                                    @foreach (explode("[,]",$product->photos) as $ph)
                                    <span class="mr-5">
                                    <img style="width: 120px; height: 120px;" src="@if(!empty($ph)){{asset($ph)}} @else {{asset('logo.png')}} @endif">
                                    </span>
                                    @endforeach
                                    <div class="card-body">
                                        <form class="form"
                                            action="{{route('admin.products.update',$product -> id)}}"
                                            method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input name="id" value="{{$product -> id}}" type="hidden">

                                            <div class="form-group">
                                                <label> صوره المنتج اختر صورة او اكثر  </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="photos[]" multiple/>
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('photos')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات تعديل منتجات المتجر</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختر النوع </label>
                                                            <select name="type" class="form-control" id="">
                                                                <option @if($product->type == 'حسب الغرض من الاستخدام')
                                                                    selected
                                                                    @endif value="حسب الغرض من الاستخدام">حسب الغرض من الاستخدام</option>
                                                                <option @if($product->type == 'حسب نوع الحيوان')
                                                                    selected
                                                                    @endif value="حسب نوع الحيوان">حسب نوع الحيوان</option>
                                                            </select>
                                                            @error("type")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاسم</label>
                                                            <input type="text" id="name_ar"
                                                                class="form-control"
                                                                placeholder="  "
                                                                value="{{$product->getTranslation('name', 'ar')}}"
                                                                name="name_ar">
                                                            @error("name_ar")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاسم بالانجليزية</label>
                                                            <input type="text" id="name_en"
                                                                class="form-control"
                                                                placeholder="  "
                                                                value="{{$product->getTranslation('name', 'en')}}"
                                                                name="name_en">
                                                            @error("name_en")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختر القسم الرئيسي </label>
                                                            <select name="cat_id" class="form-control maincat" id="">
                                                                @foreach ($cats as $cat)
                                                                    <option @if ($cat->id == $product->cat_id)
                                                                        selected
                                                                    @endif value="{{$cat->id}}">{{$cat->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error("cat_id")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اختر القسم الفرعي </label>
                                                            <select name="subcat_id" class="form-control subcat" id="subcat">
                                                                    <option value="{{$subcat->id}}">{{$subcat->name}}</option>
                                                            </select>
                                                            @error("subcat_id")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الكمية </label>
                                                            <input type="number" value="{{$product->amount}}" id="amount"
                                                                class="form-control"
                                                                placeholder="  "
                                                                name="amount">
                                                            @error("amount")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> السعر بالريال السعودي </label>
                                                            <input type="number" value="{{$product->price}}" id="price"
                                                                class="form-control"
                                                                placeholder="  "
                                                                name="price">
                                                            @error("price")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> نسبة الخصم </label>
                                                            <input type="number" value="{{$product->offer}}" id="offer"
                                                                class="form-control"
                                                                placeholder="  "
                                                                name="offer">
                                                            @error("offer")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  وصف قصير </label>
                                                            <input type="text" value="{{$product->getTranslation('short_desc', 'ar')}}" id="short_desc"
                                                                class="form-control"
                                                                placeholder="  "
                                                                name="short_desc_ar">
                                                            @error("short_desc_ar")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  وصف قصير بالانجليزية </label>
                                                            <input type="text" value="{{$product->getTranslation('short_desc', 'en')}}" id="short_desc"
                                                                class="form-control"
                                                                placeholder="  "
                                                                name="short_desc_en">
                                                            @error("short_desc_en")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  السعر عند الشراء بة ياخد توصيل مجاني </label>
                                                            <input type="number" value="{{$product->price_delevery_free}}" id="price_delevery_free"
                                                                class="form-control"
                                                                placeholder="  "
                                                                name="price_delevery_free">
                                                            @error("price_delevery_free")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  تاريخ الانتهاء </label>
                                                            <input type="date" value="{{$product->end_date}}" id="end_date"
                                                                class="form-control"
                                                                placeholder="  "
                                                                name="end_date">
                                                            @error("end_date")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  شرح وصف المنتج </label>
                                                                <textarea name="long_desc_ar" class="form-control" rows="15" cols="20">{{$product->getTranslation('long_desc', 'en')}}</textarea>
                                                            @error("long_desc_ar")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  شرح وصف المنتج بالانجليزية </label>
                                                                <textarea name="long_desc_en" class="form-control" rows="15" cols="20">{{$product->getTranslation('long_desc', 'en')}}</textarea>
                                                            @error("long_desc_en")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  شرح كيفية الاستخدام </label>
                                                                <textarea name="how_used_ar" class="form-control" rows="15" cols="20">{{$product->getTranslation('how_used', 'ar')}}</textarea>
                                                            @error("how_used_ar")
                                                        <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  شرح كيفية الاستخدام بالانجليزية</label>
                                                                <textarea name="how_used_en" class="form-control" rows="15" cols="20">{{$product->getTranslation('how_used', 'en')}}</textarea>
                                                            @error("how_used_en")
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
@section('script')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on( 'click','.form-control.maincat', function(e) {
        e.preventDefault();
        var cat = $('.form-control.maincat').val();
    /**Ajax code**/
    $.ajax({
        type: "POST",
        url:"{{route('admin.cats.getsubcat')}}",
        data:{cat:cat},

        success: function (data) {
            $('#subcat').empty();
            $('#subcat').append(data.data);
        },
        error:function(){
            toastr.error('برجاء اختيار قسم');
        }
    });
        /**Ajax code ends**/
    });
});
    </script>
    @endsection
