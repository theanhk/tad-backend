<!DOCTYPE html>
<html lang="en" data-kit-theme="default">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="turbolinks-cache-control" content="no-cache">
    <link rel="icon" type="image/png" href="{{ asset('tadcms/assets/images/icon.png') }}" />
    <title>{{ $title }}</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:400,700,800&display=swap">
    <link rel="stylesheet" href="{{ asset('tadcms/assets/css/vendor.css') }}">

    <!-- Tadcms Vendor -->
    <script type="text/javascript">
        var tadcms = {
            'adminPrefix': "{{ config('tadcms.admin-prefix') }}",
            'adminUrl': '{{ url(config('tadcms.admin-prefix')) }}',
            'lang': @json(trans('tadcms::app'))
        };
    </script>

    <script src="{{ asset('tadcms/assets/js/app.min.js') }}"></script>
    <script src="{{ asset('tadcms/assets/js/vendor.js') }}" type="text/javascript"></script>
    <script src="{{ asset('tadcms/assets/ckeditor/ckeditor.js') }}"></script>

    @yield('header')

    {{--<script src="https://www.gstatic.com/charts/loader.js"></script>--}}

    @livewireStyles

    @admin_header
</head>

<body class="cui__menuLeft--dark cui__topbar--fixed cui__menuLeft--unfixed">
<div class="cui__layout cui__layout--hasSider">

    <div class="cui__menuLeft">
        <div class="cui__menuLeft__mobileTrigger"><span></span></div>
        {{--<div class="cui__menuLeft__trigger"></div>--}}
        <div class="cui__menuLeft__outer">
            <div class="cui__menuLeft__logo__container">
                <div class="cui__menuLeft__logo">
                    <img src="{{ asset('tadcms/assets/images/logo.png') }}" class="mr-2" alt="TAD Logo" />
                </div>
            </div>

            <div class="cui__menuLeft__scroll kit__customScroll">
                @include('tadcms::layouts.menu_left')
            </div>
        </div>
    </div>
    <div class="cui__menuLeft__backdrop"></div>

    <div class="cui__layout">
        <div class="cui__layout__header">
            @include('tadcms::layouts.menu_top')
        </div>

        <div class="cui__layout__content">

            {{ breadcrumb('admin', [
                    [
                        'title' => $title
                    ]
                ]) }}

            <h4 class="font-weight-bold ml-3">{{ $title }}</h4>

            <div class="cui__utils__content">
                @yield('content')
            </div>
        </div>
        <div class="cui__layout__footer">
            <div class="cui__footer">
                <div class="cui__footer__inner">
                    <a href="https://github.com/tadcms/tadcms" target="_blank" rel="noopener noreferrer" class="cui__footer__logo">
                        Provided by TAD CMS
                        <span></span>
                    </a>
                    <br />
                    <p class="mb-0">
                        Copyright © {{ date('Y') }} {{ get_config('sitename') }}
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>

@livewireScripts

@admin_footer

@yield('script')

@yield('footer')

{{--<script type="text/javascript">
    $.extend( $.validator.messages, {
        required: "{{ trans('app.this_field_is_required') }}",
    });

    $(".form-ajax").validate();
</script>--}}
</body>
</html>