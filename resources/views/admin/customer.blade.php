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
                                            Phone
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            Level
                                        </th>
                                        <th>
                                            Action
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
                                            <td>
                                                {{$acc['Level']}}
                                            </td>
                                            <td>
                                                <a href="{{URL::to('/admin/customer/' . $phone)}}" class="active styling-edit">
                                                    <i class="fas fa-edit icon"></i></a>
                                                <a href="{{URL::to('/admin/customer/shipping/' . $phone)}}" class="active styling-edit">
                                                    <i class="fas fa-edit icon"></i></a>
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
