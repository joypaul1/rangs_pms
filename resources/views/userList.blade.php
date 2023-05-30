@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info text-center">{{ __('User List') }}</div>
                {{-- @dd($res); --}}
                @php
                    $sl = 0;
                @endphp
                <div class="card-body">
                   <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Employee ID</th>
                            <th>Employee Name</th>
                            <th>Mobile NO.</th>
                            <th>Current Role</th>
                            <th>PASSWord</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (oci_fetch_array($res['ID']) as $key=> $data)
                        <tr>
                            @php
                                $sl +=1;;
                            @endphp

                            <td> {{$sl}} </td>
                            <td>{{ $res['RML_ID'][$key] }}</td>
                            <td>{{ $res['EMP_NAME'][$key] }}</td>
                            <td>{{ $res['DEPT_NAME'][$key] }}</td>
                            <td>{{ $res['MOBILE_NO'][$key] }}</td>
                            <td>{{ $res['PASS_MD5'][$key] }}</td>
                            <td> {{ 'Normal User' }} </td>
                            <td>
                                <button class="btn btn-sm btn-warning">Assign Role </button>
                            </td>
                        </tr>
                        @empty

                        @endforelse


                    </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
