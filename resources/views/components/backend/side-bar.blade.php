{{-- <li {{ $attributes->merge(["class"=>" "]) }}>
    <a href="{{ route($link)}}" >
        @isset($icon)
        <i class="{{ $icon }}"></i>
        @endisset
    <span>{{$name}}</span></a>
</li> --}}

<li {{ $attributes->class(['menu-item'])->merge(["class"=>" "]) }}>
    <a href="{{ route($link)}}" class="menu-link">
        <div
        @isset($icon)
        data-i18n = "{{ $icon }}"
        @else
        data-i18n="Without menu"
        @endisset

        >{{ucwords($name)}}</div>
    </a>
</li>
{{-- <li class="menu-item active">
    <a href="{{ route('role.index') }}" class="menu-link">
        <div data-i18n="Without menu">Role</div>
    </a>
</li> --}}
