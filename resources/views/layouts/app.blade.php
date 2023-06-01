<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard | PMS </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets') }}/img/favicon/favicon.ico" />
    @include('_partials.headerCss')
    @stack('css')
    {{-- @livewireStyles() --}}

</head>


<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('_partials._sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('_partials.topNab')
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')


                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div
                            class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                , made with ❤️ by
                                <a href="#" target="_blank" class="footer-link fw-bolder">Rangs Group! 👋</a>
                            </div>

                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    @include('_partials.footerJs')
    {{-- @livewireScripts() --}}

    <script type="text/javascript">
        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    {{-- toast-sms --}}
    @if (Session::get('success'))
    <script>
        let $message = "{{Session::get('success') }}";
                let $context = 'success';
                let $positionClass= 'toast-top-right';
                toastr.remove();
                toastr[$context]($message, '', {
                    positionClass: $positionClass
                });
    </script>
    @elseif(Session::get('error'))
    <script>
        let $message = "{{Session::get('error') }}";
            let $context = 'error';
            let $positionClass= 'toast-top-right';
            toastr.remove();
            toastr[$context]($message, '', {
                positionClass: $positionClass
            });
    </script>
    @endif
</body>

</html>
