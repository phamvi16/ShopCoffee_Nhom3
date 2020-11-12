@extends('admin_layout')
@section('title', 'Khách hàng')
@section('content')
    <div class="panel-header panel-header-sm"></div>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header ">
                        <h4 class="card-title">Danh sách khách hàng</h4>
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
                                            Số Điện Thoại
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Hạng Mức
                                        </th>
                                        <th>
                                            Tác Vụ
                                        </th>
                                    </thead>

                                    <tbody>
                                    @php
                                        $i=0;
                                    @endphp

                                    @foreach($account as $acc)

                                        @php
                                            $i++;
                                            $phone = $acc['Phone'];
                                        @endphp

                                        <tr>
                                            <td>
                                                {{$i}}
                                            </td>
                                            <td>
                                                {{$acc['Name']}}
                                            </td>
                                            <td>
                                                {{$phone}}
                                            </td>
                                            <td>
                                                {{$acc['Email']}}
                                            </td>
                                            <td class="px-4">
                                                {{$acc['Level']}}
                                            </td>
                                            <td>
                                                <a href="{{URL::to('/admin/customer/' . $phone)}}" class="active styling-edit">
                                                    <i class="fas fa-list icon"></i>
                                                </a>
                                            </td>
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
