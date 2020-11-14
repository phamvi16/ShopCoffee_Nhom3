@extends('admin_layout')
@section('title', 'Phiếu giảm giá')
@section('content')
<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header d-flex">
                    <h4 class="card-title">Danh sách mã giảm giá</h4>
                    <a href="coupon/add" class="btn btn-primary btn--icon add-btn"></a>
                </div>
                <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>STT</th>
                                <th>ID Coupon</th>
                                <th>Loại</th>
                                <th>Giá trị</th>
                                <th>Mô tả</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Tác vụ</th>
                            </thead>
                            <tbody>

                            @php
                                $i=0;
                            @endphp

                            @foreach($all_coupon as $cou)

                                @php
                                    $i++;
                                @endphp

                                    <tr>
                                        <td>
                                            {{$i}}
                                        </td>
                                        <td>
                                            {{$cou->Id}}
                                        </td>
                                        <td>
                                            {{$cou->Type}}
                                        </td>

                                        @if ($cou->Type == 'Percent')
                                            <td>
                                                {{$cou->Value}}%
                                            </td>
                                        @elseif ($cou->Type == 'Fixed')
                                            <td>
                                                {{$cou->Value}} VNĐ
                                            </td>
                                        @else
                                            <td>
                                                {{$cou->Value}} product
                                            </td>
                                        @endif

                                        <td>
                                            {{$cou->Description}}
                                        </td>
                                        <td>
                                            {{$cou->Started_at}}
                                        </td>
                                        <td>
                                            {{$cou->Ended_at}}
                                        </td>

                                        @if ($cou->Ended_at >= $realtime)
                                            <td>
                                                <a href="{{URL::to('/admin/coupon/edit/' . $cou->Id)}}" class="active styling-edit">
                                                    <i class="fas fa-edit icon"></i></a>
                                                <a onclick="return confirm('Are you sure to delete this category?')" href="{{URL::to('/admin/coupon/delete/' . $cou->Id)}}" class="active styling-edit">
                                                    <i class="fa fa-times icon text-danger text"></i></a>
                                            </td>
                                        @Endif

                                    </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
