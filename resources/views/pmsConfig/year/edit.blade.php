@extends('layouts.app')
@section('page-header')
<i class="menu-icon tf-icons bx bx-message-alt-add" style="margin:0;font-size:30px"></i>  Pms-Year Edit
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'list-ul',
'name' => ' Pms-Year List',
'route' => route('pmsConfig.year.index')
])
@stop
@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="card border-top">
            @yield('table_header')

            <div class="card-body">
                <div class="col-6">

                    <form method="post" action="{{ route('pmsConfig.year.update',$year['ID']) }}">
                        @csrf
                        @method("PUT")
                        <div class="mb-3">
                            <label class="form-label" for="name"> Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="2023 - 2024"
                            value="{{ $year['PMS_NAME'] }}"
                            required>
                        </div>
                        <div class="mb-3">
                                <div class="form-check mt-3">
                                    <input name="status" class="form-check-input" type="radio" value="1"
                                        @if ($year['IS_ACTIVE'])
                                        checked
                                        @endif
                                     id="active">
                                    <label class="form-check-label" for="active"> Active </label>

                                  </div>
                                <div class="form-check mt-3">
                                    <input name="status" class="form-check-input" type="radio" value="0"
                                    @if (!$year['IS_ACTIVE'])
                                    checked
                                    @endif
                                    id="Inactive">
                                    <label class="form-check-label" for="Inactive"> Inactive </label>
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
