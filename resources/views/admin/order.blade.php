@extends('admin_layout')
@section('title', 'Order')
@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                    <h4 class="card-title"> All Order</h4>
                    </div>

                   <div style="width:20%" class="d-flex">

                    <input type="date" id='birthday' name='birthday' class=" ml-5 mr-3" placeholder="" value="">
                    <input type="date" id='birthday' name='birthday' class="ml-3 " placeholder="" value="">
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
                                       Trạng thái
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
