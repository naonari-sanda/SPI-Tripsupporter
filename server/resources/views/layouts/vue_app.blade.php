<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>@yield('title')</title>
    @include('includes.common.head')
</head>

<body>
    <div id="app">
        <main class="">
            <main-component :errors="{{ $errors }}" :auth="{{ Auth::user() ?? '[]' }}" :icon="{{ json_encode(Auth::user()->acount->icon) ?? '[]' }}" />
        </main>
        @include('includes.common.modal')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
    <script src="{{ mix('/js/app.js') }}"></script>
    <script>
        lightbox.option({
            'resizeDuration': 400,
            'wrapAround': true
        })
    </script>
    <!-- フラッシュメッセージ -->
    @include('includes.common.flash')
</body>

</html>