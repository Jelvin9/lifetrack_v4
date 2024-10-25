<!DOCTYPE html>
<html lang="en">
<head>
    @include('incl.assets') {{-- Include your assets (CSS, JS) --}}
</head>
<body>
    <div class="header-wrapper">
    @yield('header')
    </div>
    
    <div class="content-wrapper">
        {{-- This is where the child view's content will be injected --}}
        @yield('content')
    </div>

    <x-footer />
</body>
</html>
