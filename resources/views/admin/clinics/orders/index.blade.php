@extends('layouts.admin')
@section('title','الطلبات')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            
            <div class="row match-height">

              <div class="col-xl-12 col-lg-12">
                <div class="card" style="height: 418px;">
                  <div class="card-header">
                    <h4 class="card-title">طلبات العيادات</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                      <ul class="list-inline mb-0">
                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-content">
                    <div id="new-orders" class="media-list position-relative ps-container ps-theme-default" data-ps-id="b4845f3f-12b5-7f66-3431-55d7e87fb0d3">
                      <div class="table-responsive">
                        <table id="new-orders-table" class="table table-hover table-xl mb-0">
                        <thead>
                            <tr>
                                <th>اسم العميل </th>
                                <th>العيادة </th>
                                <th>اسم الخدمة</th>
                                <th>صورة المنتج</th>
                                <th>السعر</th>
                                <th>الموصل</th>
                                <th>العنوان</th>
                                <th>تاريح الارسال</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->clinic->name }}</td>
                                    <td>{{ $order->service->name }}</td>
                                    <td>{{  }}</td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->user->name }}</td>
                                </tr>
                        @endforeach
                          </tbody>
                        </table>
                      </div>
                    <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 402px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                  </div>
                </div>
              </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

