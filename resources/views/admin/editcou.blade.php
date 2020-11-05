@extends('admin_layout')
@section('title', 'Coupon')
@section('content')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('Admins/css/add-pro.css') }}">
@endsection
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header ">
                        @if(\Session::has('success'))
                            <div class="alert-box success"><span>Success: </span> {{ \Session::get('success') }}</div>
                            
                         @elseif(\Session::has('error'))
                            <div class="alert-box error"><span>Error: </span> {{ \Session::get('error') }}</div>
                        @endif
                    <h4 class="card-title">Edit Coupon</h4>
                    </div>
                    <div class="card-body ">
                        <form action="/admin/coupon/update" id="edit-pro-form" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            @if ($cou != NULL && $cou->Ended_at > $realtime)
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>ID Coupon</label>
                                            <input type="text" name="Id" class="form-control" value="{{$id ?? ""}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <br>

                                            @if ($cou->Type == 'Percent')
                                                <input id="per" type="radio" name="Type" value="Percent" checked >
                                                <label>Percent (0% -> 50%)</label>
                                                <br>
                                                <input id="fix" type="radio" name="Type" value="Fixed">
                                                <label>Fixed (0$ -> 30.000$)</label>
                                            @else
                                                <input id="per" type="radio" name="Type" value="Percent" >
                                                <label>Percent (0% -> 50%)</label>
                                                <br>
                                                <input id="fix" type="radio" name="Type" value="Fixed" checked>
                                                <label>Fixed (0$ -> 30.000$)</label>
                                            @endif

                                            @if($errors->has('Type'))
                                                <div class="alert-box error"><span>error: </span> {{ $errors->first('Type') }}</div>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Value</label>
                                            <input style="opacity: 1; position: static" type="number" class="form-control" name="Value" id="Value" min="0" value="{{$cou->Value ?? ""}}" required>
                                            @if($errors->has('Value'))
                                                <div class="alert-box error"><span>error: </span> {{ $errors->first('Value') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea style="resize: none; border:1px solid #E3E3E3; border-radius: 30px;" rows="8" class="form-control" name="Description" id="Description" required>{{$cou->Description ?? ""}}</textarea>
                                            @if($errors->has('Description'))
                                                <div class="alert-box error"><span>error: </span> {{ $errors->first('Description') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if ($cou->Started_at > $realtime)
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="datetime-local" class="form-control" name="Started_at" id="Started_at" value="{{$start ?? ""}}" required>
                                                @if($errors->has('Started_at'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('Started_at') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input type="datetime-local" class="form-control" name="Ended_at" id="Ended_at" value="{{$end ?? ""}}" required>
                                                @if($errors->has('Ended_at'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('Ended_at') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @elseif ($cou->Ended_at > $realtime)
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="datetime-local" class="form-control" name="Started_at" id="Started_at" value="{{$start ?? ""}}" readonly>
                                                @if($errors->has('Started_at'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('Started_at') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input type="datetime-local" class="form-control" name="Ended_at" id="Ended_at" value="{{$end ?? ""}}" required>
                                                @if($errors->has('Ended_at'))
                                                    <div class="alert-box error"><span>error: </span> {{ $errors->first('Ended_at') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" name="btnSave" class="btn btn-info">Save</button>
                                            <a href="/admin/coupon" name="btnBack" class="btn back">Back</a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div>An unexpected error occurred. Failed to show coupon detail. 
                                    <p>Please checks if this category exists.</p></div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('Admins/js/addcou.js') }}"></script>
@endsection
