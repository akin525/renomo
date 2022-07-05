<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <link href="{{asset('asset/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
        <link href="{{asset('asset/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
        <link href="{{asset('asset/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
        <!-- site css -->
        <link rel="stylesheet" href="{{asset('style1.css')}}" />
        <!-- responsive css -->
        <link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
        <!-- color css -->
        <link rel="stylesheet" href="{{asset('css/colors.css')}}" />
        <!-- select bootstrap -->
        <link rel="stylesheet" href="{{asset('css/bootstrap-select.css')}}" />
        <!-- scrollbar css -->
        <link rel="stylesheet" href="{{asset('css/perfect-scrollbar.css')}}" />
        <!-- custom css -->
        <link rel="stylesheet" href="{{asset('css/custom.css')}}" />

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>



            <!-- Page Heading -->
<br>
    <br>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>


        @stack('modals')

        @livewireScripts
    </body>
</html>
