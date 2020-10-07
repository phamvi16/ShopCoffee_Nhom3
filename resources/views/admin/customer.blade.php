@extends('admin_layout')
@section('title', 'Customer')
@section('content')
    <div class="panel-header panel-header-sm"></div>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header ">
                        <h4 class="card-title">All Customer</h4>
                        </div>
                        <div class="card-body ">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th>
                                            STT
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Birthday
                                        </th>
                                        <th>
                                            Phone
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Address
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
                                                01/01/2020
                                            </td>
                                            <td>
                                                0123456789
                                            </td>
                                            <td>
                                                abc@gmail.com
                                            </td>
                                            <td>
                                                TPHCM
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
