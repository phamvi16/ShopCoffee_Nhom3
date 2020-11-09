@extends('admin_layout')
@section('title', 'Đơn hàng')
@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                    <h4 class="card-title">Danh sách đơn hàng</h4>
                    </div>

                   <div  class="d-flex"  >
                        <span class="ml-3 mt-1">Lọc theo ngày tháng:</span>
                        <input type="date" id='birthday' name='birthday' class=" ml-3 mr-3" placeholder="" value="">
                        <input type="date" id='birthday' name='birthday' class="ml-3" placeholder="" value="">
                        <div class="btn-group ml-5 " >
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Lọc theo Status
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="#">Status1</a>
                              <a class="dropdown-item" href="#">Status1</a>
                              <a class="dropdown-item" href="#">Status1</a>
                            </div>
                          </div>
                   </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        STT
                                    </th>
                                    <th>
                                        Tên
                                    </th>
                                    <th>
                                        Hình ảnh
                                    </th>
                                    <th>
                                        Tác vụ
                                    </th>


                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            Dakota Rice
                                        </td>
                                        <td>
                                            Niger
                                        </td>
                                        <td>
                                            asjqk
                                        </td>
                                    </tr>
                                </tbody>
                             </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
