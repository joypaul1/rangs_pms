
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between" style="padding: 1.5% 1.5rem">
        <div href="#" style="font-size: 20px;font-weight:700">
            @yield('page-header')
        </div>
        @isset($name)
        <div>
            <a href="@isset($route){{ $route }}@else # @endisset" @isset($target) target="_blank" @endisset
                class="btn btn-info btn-md">
                <i class="menu-icon tf-icons bx bx-@isset($fa){{ $fa }} @endisset" style="margin:0;"></i>
                {{ $name }}
            </a>
        </div>
        @endisset


    </div>
</div>

