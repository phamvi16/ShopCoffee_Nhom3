@extends('admin_layout')
@section('title', 'Topping')
@section('content')
    <div class="panel-header panel-header-sm"></div>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header d-flex">
                        <h4 class="card-title">All Topping</h4>
                        <a href="topping/add" class="btn btn-primary btn--icon add-btn"></a>
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
                                            Price
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Action
                                        </th>


                                    </thead>
                                    <tbody>

                                    @php
                                        $i=0;
                                    @endphp
                                            
                                    @foreach($all_topping as $top)
    
                                        @php
                                            $i++;
                                        @endphp

                                        <tr>
                                            <td>
                                                {{$i}}
                                            </td>
                                            <td>
                                                {{$top->Name}}
                                            </td>
                                            <td>
                                                {{$top->Price}}
                                            </td>
                                            <td>
                                                {{$top->Status}}
                                            </td>
                                            <td>
                                                <a href="{{URL::to('/admin/topping/edit/' . $top->Id)}}" class="active styling-edit">
                                                    <i class="fas fa-edit icon"></i></a>
                                                <a onclick="return confirm('Are you sure to delete this topping?')" href="{{URL::to('/admin/topping/delete/' . $top->Id)}}" class="active styling-edit">
                                                    <i class="fa fa-times icon text-danger text"></i>
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
