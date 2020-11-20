@extends('admin_layout')
@section('title', 'Đơn hàng')
@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Danh sách Đơn hàng</h4>
                    </div>

                    <div class="d-flex align-items-center filter-option">
                        <div style="flex-grow: 1">
                            <span class="ml-3 mt-1">Lọc theo ngày tháng:</span>
                            <input type="date" id='FromDate' name='FromDate' class=" ml-3 mr-3" placeholder="" value="">
                            <input type="date" id='ToDate' name='ToDate' max="{{ $today ?? "" }}" class="ml-3" placeholder="" value="">
                            <button id="btnHuyFilterDate">Hủy lọc theo ngày</button>
                        </div>

                        <div class=" btn-group ml-5  " >
                            <div class="option browse-tags ">
                                <label class="lb-filter hide" for="sort-by">Sắp xếp theo:</label>
                                <span>
                                    <select name="status" class="sort-by custom-dropdown__select btn btn-danger dropdown-toggle mr-5" aria-haspopup="true" aria-expanded="false" id="filter-status">
                                        <option value="all">Tất cả</option>
                                        <option value="Chờ Xử Lý">Chờ Xử Lý</option>
                                        <option value="Đang Xử Lý">Đang Xử Lý</option>
                                        <option value="Đang Giao Hàng">Đang Giao Hàng</option>
                                        <option value="Hoàn Thành">Hoàn Thành</option>
                                        <option value="Hủy">Hủy</option>
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
                                <tbody id="order-table-body">
                                    @include('partials/order-list-view', ['all_order' => $all_order])
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('Admins/js/order.js') }}"></script>
@endsection