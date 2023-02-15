<nav class="custom-wrapper" id="menu">
    <div class="pure-menu"></div>
    <ul class="container-flex list-unstyled">
        <li class="pure-menu-item">
            <a href="{{ route('home') }}" class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRout('home') ? 'active' : '' }}">Inicio</a>
        </li>
        <li class="pure-menu-item">
            <a href="{{ route('about') }}" class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRout('about') ? 'active' : '' }}">Nosotros</a>
        </li>
        <li class="pure-menu-item">
            <a href="{{ route('archive') }}" class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRout('archive') ? 'active' : '' }}">Archivo</a>
        </li>
        <li class="pure-menu-item">
            <a href="{{ route('contact') }}" class="pure-menu-link c-gris-2 text-uppercase {{ setActiveRout('contact') ? 'active' : '' }}">Contacto</a>
        </li>
    </ul>
</nav>
