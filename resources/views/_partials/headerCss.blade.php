<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />

<!-- Icons. Uncomment required icon fonts -->
<link rel="stylesheet" href="{{ asset('assets') }}/vendor/fonts/boxicons.css" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/theme-default.css"
    class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('assets') }}/css/demo.css" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

<!-- Page CSS -->
<!-- Page -->
<link rel="stylesheet" href="{{ asset('assets') }}/vendor/css/pages/page-auth.css" />
{{-- toastr --}}
<link rel="stylesheet" href="{{ asset('assets') }}/vendor/toastr/toastr.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/solid.min.css" integrity="sha512-yDUXOUWwbHH4ggxueDnC5vJv4tmfySpVdIcN1LksGZi8W8EVZv4uKGrQc0pVf66zS7LDhFJM7Zdeow1sw1/8Jw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- for ajax csrf token --}}
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Helpers -->
<script src="{{ asset('assets') }}/vendor/js/helpers.js"></script>
<script src="{{ asset('assets') }}/js/config.js"></script>
