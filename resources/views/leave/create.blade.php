@extends('layouts.app')
@section('page-header')
<i class="menu-icon tf-icons bx bx-message-alt-add" style="margin:0;font-size:30px"></i> Leave Application Create
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'list-ul',
'name' => 'Leave Application List',
'route' => route('leave.index')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')

            <div class="card-body">
                <div class="col-6s">

                    <form method="POST" action="{{ route('leave.store') }}">
                        @csrf
                        {{-- <div class="mb-3">
                            <label class="form-label" for="name"> Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Role Name.."
                                required>
                        </div> --}}

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-name" value="Joy Paul"
                                        readonly="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">RML-ID</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-company" form="Form2"
                                        name="emp_id" value="RML-01260" readonly="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Department</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        value="IT &amp; ERP" readonly="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Department</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        value="Junior Executive" readonly="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Location</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="basic-default-company"
                                        value="Head Office" readonly="">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Select Start
                                    Date</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar">
                                            </i>
                                        </div>
                                        <input required="" form="Form2" class="form-control" type="date"
                                            name="leave_start_date" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Select End
                                    Date</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar">
                                            </i>
                                        </div>
                                        <input required="" form="Form2" class="form-control" type="date"
                                            name="leave_end_date" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-company">Select Leave</label>
                                <div class="col-sm-10">
                                    <select required="" form="Form2" name="leave_type" class="form-control">
                                        <option selected="" value="">--</option>

                                        <option value="EL">Annual Leave</option>

                                        <option value="BL">Bereavement Leave</option>

                                        <option value="CL">Casual Leave</option>

                                        <option value="COVID">Covid-19 Leave</option>

                                        <option value="MTL">Meternity Leave</option>

                                        <option value="PTL">Paternity Leave</option>

                                        <option value="PGL">Pilgrimage Leave</option>

                                        <option value="PML">Promoters Leave</option>

                                        <option value="SL">Sick Leave</option>

                                        <option value="STL">Substitute Leave</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-message">Remarks</label>
                                <div class="col-sm-10">
                                    <textarea id="basic-default-message" class="form-control" form="Form2"
                                        name="remarks" placeholder="Hi, Do you have any Remarks?" required=""
                                        aria-describedby="basic-icon-default-message2"></textarea>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-sm-10">
                                    <button form="Form2" type="submit" name="submit_leave"
                                        class="btn btn-primary">Create Leave</button>
                                </div>
                            </div>




                        <div class="b-block text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
