<div class="main-menu menu-fixed menu-light menu-accordion  menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item"><a href="{{route('admin.dashboard')}}"><i class="la la-home"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الصفحة الرئيسية </span></a>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المشرفين </span>
                    <span
                        class="badge badge badge-dark  badge-pill float-right mr-2">{{App\Models\Admin::where('id','!=',1)->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.helpers')}}" data-i18n="nav.dash.ecommerce"> عرض الكل
                        </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.helpers.create')}}"
                            data-i18n="nav.dash.ecommerce">اضافة مشرف</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المستخدمين </span>
                    <span
                        class="badge badge badge-dark  badge-pill float-right mr-2">{{App\User::where('type','user')->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.users','user')}}" data-i18n="nav.dash.ecommerce"> عرض
                            الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.users.create','user')}}"
                            data-i18n="nav.dash.ecommerce">اضافة مستحدم</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاطباء </span>
                    <span
                        class="badge badge badge-dark  badge-pill float-right mr-2">{{App\User::where('type','doctor')->count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.users','doctor')}}" data-i18n="nav.dash.ecommerce">
                            عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.users.create','doctor')}}"
                            data-i18n="nav.dash.ecommerce">اضافة طبيب</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">تخصصات العيادات </span>
                    <span
                        class="badge badge badge-dark  badge-pill float-right mr-2">{{App\Models\ClinicCat::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.clinic_cats.index')}}" data-i18n="nav.dash.ecommerce">
                            عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.clinic_cats.create')}}"
                            data-i18n="nav.dash.ecommerce">اضافة تخصص جديد</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">انواع الحالات والتحاليل </span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.cases.index',1)}}" data-i18n="nav.dash.ecommerce"> عرض
                            الحالات </a><span
                        class="badge badge badge-dark  badge-pill float-right mr-2"></span>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.cases.create')}}"
                            data-i18n="nav.dash.ecommerce">اضافة حالة</a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.cases.index',2)}}" data-i18n="nav.dash.ecommerce"> عرض
                            التحاليل </a><span
                        class="badge badge badge-dark  badge-pill float-right mr-2"></span>
                    </li>
                    <li>
                    <a class="menu-item" href="{{route('admin.cases.create')}}" data-i18n="nav.dash.ecommerce">اضافة تحليل</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href=""><i class="la la-male"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> العيادات </span>
                    <span
                        class="badge badge badge-dark  badge-pill float-right mr-2">{{App\Models\Clinic::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.clinics.index')}}" data-i18n="nav.dash.ecommerce"> عرض
                            الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.clinics.create')}}"
                            data-i18n="nav.dash.ecommerce">اضافة عيادة جديد</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-life-bouy"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المناطق </span>
                    <span
                        class="badge badge badge-primary  badge-pill float-right mr-2">{{App\Models\Region::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.regions') }}" data-i18n="nav.dash.ecommerce">عرض الكل
                        </a>
                    </li>
                    <li><a class="menu-item" href="{{ route('admin.regions.create') }}" data-i18n="nav.dash.ecommerce">
                            اضافة منطقة</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-life-bouy"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الدول </span>
                    <span
                        class="badge badge badge-primary  badge-pill float-right mr-2">{{App\Models\Countery::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.countries') }}" data-i18n="nav.dash.ecommerce">عرض
                            الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{ route('admin.countries.create') }}"
                            data-i18n="nav.dash.ecommerce"> اضافة دولة</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-life-bouy"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام الرئيسية </span>
                    <span
                        class="badge badge badge-primary  badge-pill float-right mr-2">{{App\Models\Cat::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.cats') }}" data-i18n="nav.dash.ecommerce">عرض الكل
                        </a>
                    </li>
                    <li><a class="menu-item" href="{{ route('admin.cats.create') }}" data-i18n="nav.dash.ecommerce">
                            اضافة قسم</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-life-bouy"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاقسام الفرعية </span>
                    <span
                        class="badge badge badge-primary  badge-pill float-right mr-2">{{App\Models\Subcat::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.subcats') }}" data-i18n="nav.dash.ecommerce">عرض الكل
                        </a>
                    </li>
                    <li><a class="menu-item" href="{{ route('admin.subcats.create') }}" data-i18n="nav.dash.ecommerce">
                            اضافة قسم</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href=""><i class="la la-life-bouy"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">انواع الحيوانات </span>
                    <span
                        class="badge badge badge-primary  badge-pill float-right mr-2">{{App\Models\Animal::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.animals') }}" data-i18n="nav.dash.ecommerce">عرض الكل
                        </a>
                    </li>
                    <li><a class="menu-item" href="{{ route('admin.animals.create') }}" data-i18n="nav.dash.ecommerce">
                            اضافة حيوان</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-life-bouy"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الاسئلة الشائعة </span>
                    <span
                        class="badge badge badge-primary  badge-pill float-right mr-2">{{App\Models\Faq::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.faqs') }}" data-i18n="nav.dash.ecommerce">عرض الكل
                        </a>
                    </li>
                    <li><a class="menu-item" href="{{ route('admin.faqs.create') }}" data-i18n="nav.dash.ecommerce">
                            اضافة سؤال</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-life-bouy"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> منتجات المتجر </span>
                    <span
                        class="badge badge badge-primary  badge-pill float-right mr-2">{{App\Models\Product::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.products') }}" data-i18n="nav.dash.ecommerce">عرض
                            الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{ route('admin.products.create') }}" data-i18n="nav.dash.ecommerce">
                            اضافة منتج</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-life-bouy"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> العروض </span>
                    <span
                        class="badge badge badge-primary  badge-pill float-right mr-2">{{ App\Models\Offer::count() }}</span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('admin.offers.index') }}" data-i18n="nav.dash.ecommerce">عرض
                            الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{ route('admin.offers.create') }}"
                            data-i18n="nav.dash.ecommerce"> اضافة عرض</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
