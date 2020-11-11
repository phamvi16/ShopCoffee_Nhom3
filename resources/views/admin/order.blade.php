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

                    <div class="d-flex align-items-center">
                        <div style="flex-grow: 1">
                            <span class="ml-3 mt-1">Lọc theo ngày tháng:</span>
                            <input type="date" id='birthday' name='birthday' class=" ml-3 mr-3" placeholder="" value="">
                            <input type="date" id='birthday' name='birthday' class="ml-3" placeholder="" value="">
                        </div>

                        <div class=" btn-group ml-5  " >
                            <div class="option browse-tags ">
                                <label class="lb-filter hide" for="sort-by">Sắp xếp theo:</label>
                                <span>
                                    <select class="sort-by custom-dropdown__select btn btn-danger dropdown-toggle mr-5" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false" >
                                        <option value="manual">Đang xử lý</option>
                                        <option value="price-ascending" data-filter="">Đang giao</option>
                                        <option value="price-descending" data-filter="">Đã giao</option>
                                    </select>
                                </span>
                            </div>
                        </div>

                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Số điện thoại
                                    </th>
                                    <th>
                                        Thời gian đặt
                                    </th>
                                    <th>
                                        Phương thức giao hàng
                                    </th>
                                    <th>
                                        Tổng tiền
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
                                        <td>
                                            asjqk
                                        </td>
                                        <td class="i-eye">
                                            <a href="/admin/detail-order"><i class="fas fa-eye"></i></a>
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
