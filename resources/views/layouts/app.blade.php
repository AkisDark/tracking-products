<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        مراقبة اسعار المنتجات | @yield('title')
    </title>
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <script src="https://kit.fontawesome.com/42d5adcbca.js') }}" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />

    <style>
        /* ===== Scrollbar CSS ===== */
        /* Firefox */
        * {
            scrollbar-width: thin;
            scrollbar-color: #1a181b #e8e3e3;
        }

        /* Chrome, Edge, and Safari */
        *::-webkit-scrollbar {
            width: 20px;
        }

        *::-webkit-scrollbar-track {
            background: #e8e3e3;
        }

        *::-webkit-scrollbar-thumb {
            background-color: #1a181b;
            border-radius: 50px;
            border: 5px dotted #762323;
        }

        ::-webkit-file-upload-button {
            display: none;
        }
    </style>
</head>

<body class="g-sidenav-show rtl bg-gray-200">
    @include('includes.sidebar')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
        @include('includes.navbar')
        <div class="container-fluid py-4">
            <div class="row">
                @yield('content')
            </div>
        </div>
    </main>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>
    @stack('scripts')
    <script>
        function deleteData() {
            return confirm('هل تريد حذف هذا');
        }
    </script>
</body>

</html>
