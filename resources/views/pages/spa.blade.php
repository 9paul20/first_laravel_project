<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="@yield('meta-description', 'Estás en el blog')">
    <title>@yield('meta-title', config('app.name')) | Blog</title>
    <link rel="stylesheet" href="{{ url('/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ url('/css/framework.css') }}">
    <link rel="stylesheet" href="{{ url('/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('/css/responsive.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    @stack('styles')
</head>

<body>

    <div id="app">
        <div class="preload"></div>
        <header class="space-inter">
            <div class="container container-flex space-between">
                <figure class="logo"><img src="{{ url('/img/logo.png') }}" alt=""></figure>
                <navigation></navigation>

            </div>
        </header>

        <div class="container">
            <div style="min-height: 100vh">
                <transition name="slide-fade" mode="out-in">
                    <router-view :key="$route.fullPath"></router-view>
                </transition>
            </div>
        </div>

        {{-- {{ $posts->appends(request()->all())->links() }} --}}

        <section class="footer">
            <footer>
                <div class="container">
                    <figure class="logo"><img src="{{ url('/img/logo.png') }}" alt=""></figure>
                    <nav>
                        <ul class="container-flex space-center list-unstyled">
                            {{-- <li><a href="{{ route('home') }}" class="text-uppercase c-white">Inicio</a></li> --}}
                            {{-- <li><a href="{{ route('About') }}" class="text-uppercase c-white">Nosotros</a></li>
                            <li><a href="{{ route('Archive') }}" class="text-uppercase c-white">Archivo</a></li>
                            <li><a href="{{ route('Contact') }}" class="text-uppercase c-white">Contacto</a></li> --}}
                        </ul>
                    </nav>
                    <div class="divider-2"></div>
                    <p>Nunc placerat dolor at lectus hendrerit dignissim. Ut tortor sem, consectetur nec hendrerit ut,
                        ullamcorper ac odio. Donec viverra ligula at quam tincidunt imperdiet. Nulla mattis tincidunt
                        auctor.</p>
                    <div class="divider-2" style="width: 80%;"></div>
                    <p>© 2017 - Zendero. All Rights Reserved. Designed & Developed by <span class="c-white">Agencia De
                            La Web</span></p>
                    <ul class="social-media-footer list-unstyled">
                        <li><a href="#" class="fb"></a></li>
                        <li><a href="#" class="tw"></a></li>
                        <li><a href="#" class="in"></a></li>
                        <li><a href="#" class="pn"></a></li>
                    </ul>
                </div>
            </footer>
        </section>

    </div>

    <script src="{{ mix('js/app.js') }}"></script>

    @stack('scripts')

</body>

</html>