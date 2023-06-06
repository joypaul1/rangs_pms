@extends('layouts.app')
@section('page-header')
<i class="menu-icon tf-icons bx bx-message-alt-add" style="margin:0;font-size:30px"></i> Pms-KRA Create
@stop
@section('table_header')
@include('_partials.page_header', [
'fa' => 'list-ul',
'name' => ' Pms-KRA List',
'route' => route('pmsConfig.kra.index')
])
@stop
@section('content')

<div class="row">
    <div class=" col-lg-12">

        <form method="POST" action="{{ route('pmsConfig.kra.store') }}">
            @csrf
            <div class="card border-top">
                @yield('table_header')

                <div class="card-body row">
                    <input type="hidden" name="pms_year_id" value="{{$year->id}}">
                    <small class="text-danger">{{ $errors->first('pms_year_id') }}</small>
                    <div class="mb-3">
                        <label class="form-label" for="name"> kRA Name <strong class="text-danger">*</strong></label>
                        <input type="text" name="name[]" class="form-control" id="name" placeholder="Enter kra Name..." required>
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                    </div>
                    <div id="kra_dynamic" style="width:100%"></div>

                    <div class=" text-right">
                        <button type="button" class="btn btn-sm btn-info kra_add">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger kra_remove">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="b-block text-center mb-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection
@push('js')
<script>
    $(document).on('click', '.kra_add', function() {
        let html = `<div class="mb-3">
                        <label class="form-label" for="name"> kRA Name <strong class="text-danger">*</strong></label>
                        <input type="text" name="name[]" class="form-control" id="name" placeholder="Enter kra Name..."
                            required>
                        <small class="text-danger">{{ $errors->first('name') }}</small>
                    </div>`;
        $('#kra_dynamic').append(html)
    });
    $(document).on('click', '.kra_remove', function() {
        let inputName = $(this).closest('.row').find('#kra_dynamic').find('.mb-3').length;
        if (inputName > 0) {
            $(this).closest('.row').find('#kra_dynamic').find('.mb-3').last().remove();
        } else {
            let $message = "Can't Delete First One!";
            let $context = 'error';
            let $positionClass = 'toast-top-right';
            toastr.remove();
            toastr[$context]($message, '', {
                positionClass: $positionClass
            });
        }

    });

</script>
@endpush
