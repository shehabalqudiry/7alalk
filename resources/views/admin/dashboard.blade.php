@extends('layouts.admin')
@section('title','لوحة التحكم')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div id="crypto-stats-3" class="row">
                <div class="col-12 col-md-12 col-xl-12 col-lg-12 text-center mb-2">
                    <a href="#" class="btn btn-info btn-block" data-toggle="modal" data-target="#exampleModal"><i class="la la-send"></i> ارسال اشعارات</a>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اشعارات</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{route('admin.send.messages')}}">
                            @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">اختر لمن تريد الارسال</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="type" required>
                                <option value="all"> الكل</option>
                                <option value="users"> المستخدمين</option>
                            </select>
                        </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">عنوان الرسالة</label>
                                <input type="text" class="form-control" id="exampleInputPassword1" name="title" placeholder="عنوان الرسالة" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">محتوي الرسالة</label>
                                <textarea name="content" class="form-control" placeholder="محتوي الرسالة" col="50" row="20" required> </textarea>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary"> ارسال</button>
                    </div>
                    </form>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card pull-up">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="info">0</h3>
                              <h6>الطلبات</h6>
                            </div>
                            <div>
                              <i class="icon-basket-loaded info font-large-2 float-right"></i>
                            </div>
                          </div>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 0%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card pull-up">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="success">0</h3>
                              <h6>الطلبات المكتملة</h6>
                            </div>
                            <div>
                              <i class="icon-check success font-large-2 float-right"></i>
                            </div>
                          </div>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 0%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card pull-up">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="success">0</h3>
                              <h6>الحسابات التجارية</h6>
                            </div>
                            <div>
                              <i class="icon-user-follow success font-large-2 float-right"></i>
                            </div>
                          </div>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 0%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-lg-6 col-12">
                    <div class="card pull-up">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex">
                            <div class="media-body text-left">
                              <h3 class="warning">0</h3>
                              <h6>المناسبات اليومية</h6>
                            </div>
                            <div>
                              <i class="icon-clock  warning font-large-2 float-right"></i>
                            </div>
                          </div>
                          <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 0%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
            <!-- Candlestick Multi Level Control Chart -->

            <div class="row match-height">

              <div class="col-xl-12 col-lg-12">
                <div class="card" style="height: 418px;">
                  <div class="card-header">
                    <h4 class="card-title">اخر طلبات من المتجر تم اضافتها</h4>
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
                                <th>صاحب المتجر </th>
                                <th>اسم المنتج</th>
                                <th>صورة المنتج</th>
                                <th>السعر</th>
                                <th>الموصل</th>
                                <th>العنوان</th>
                                <th>تاريح الارسال</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                    
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

