<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('admin') }}" class="nav-link {{ setActiveRoute('admin') }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Inicio
                </p>
            </a>
        </li>
        {{-- * Navegación de Posts --}}
        <li class="nav-item {{ request()->is('admin/posts*') ? 'menu-open' : '' }}">
            <a href=""
                class="nav-link {{ setActiveRoute(['admin.posts.index', 'admin.posts.create', 'admin.posts.*']) }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Posts
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('admin.posts.index') }}"
                        class="nav-link {{ setActiveRoute('admin.posts.index') }}">
                        <i class="far fa-eye"></i>
                        <p>Todos los Posts</p>
                    </a>
                </li>
                @can('create', new App\Post())
                    <li class="nav-item">
                        @if (request()->is('admin/posts/*'))
                            <a href="{{ route('admin.posts.index', '#create') }}" class="nav-link">
                            @else
                                <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-xl">
                        @endif
                        <i class="fas fa-pencil-alt"></i>
                        <p>Crear Post</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </li>
        @can('view', new App\User())
            {{-- * Navegación de Usuarios --}}
            <li class="nav-item {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                <a href=""
                    class="nav-link {{ setActiveRoute(['admin.users.index', 'admin.users.create', 'admin.users.*']) }}">
                    <i class="nav-icon fas fa-users "></i>
                    <p>
                        Usuarios
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}"
                            class="nav-link {{ setActiveRoute('admin.users.index') }}">
                            <i class="far fa-eye"></i>
                            <p>Todos los Usuarios</p>
                        </a>
                    </li>
                    @can('create', new App\User())
                        <li class="nav-item">
                            <a href="{{ route('admin.users.create') }}"
                                class="nav-link {{ setActiveRoute('admin.users.create') }}">
                                <i class="fas fa-pencil-alt"></i>
                                <p>Crear Usuario</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @else
            <li class="nav-item {{ request()->is('admin/users*') ? 'menu-open' : '' }}">
                <a href="{{ route('admin.users.show', auth()->user()) }}"
                    class="nav-link {{ setActiveRoute(['admin.users.edit']) }}">
                    <i class="far fas fa-users"></i>
                    <p>Usuario</p>
                </a>
            </li>
        @endcan
        {{-- * Navegación de Roles --}}
        @can('view', new \Spatie\Permission\Models\Role())
            <li class="nav-item {{ request()->is('admin/roles*') ? 'menu-open' : '' }}">
                <a href="" class="nav-link {{ setActiveRoute(['admin.roles.index', 'admin.roles.create']) }}">
                    <i class="nav-icon fa fa-unlock-alt"></i>
                    <p>
                        Roles
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.roles.index') }}"
                            class="nav-link {{ setActiveRoute('admin.roles.index') }}">
                            <i class="far fa-eye"></i>
                            <p>Todos los Roles</p>
                        </a>
                    </li>
                    @can('create', new \Spatie\Permission\Models\Role())
                        <li class="nav-item">
                            <a href="{{ route('admin.roles.create') }}"
                                class="nav-link {{ setActiveRoute('admin.roles.create') }}">
                                <i class="fas fa-pencil-alt"></i>
                                <p>Crear Rol</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        {{-- * Navegación de Permisos --}}
        @can('view', new \Spatie\Permission\Models\Permission())
            <li class="nav-item {{ request()->is('admin/permissions*') ? 'menu-open' : '' }}">
                <a href=""
                    class="nav-link {{ setActiveRoute(['admin.permissions.index', 'admin.permissions.create']) }}">
                    <i class="nav-icon fas fa-key"></i>
                    <p>
                        Permisos
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.permissions.index') }}"
                            class="nav-link {{ setActiveRoute('admin.permissions.index') }}">
                            <i class="far fa-eye"></i>
                            <p>Todos los Permisos</p>
                        </a>
                    </li>
                    @can('create', new \Spatie\Permission\Models\Permission())
                        <li class="nav-item">
                            <a href="{{ route('admin.permissions.create') }}"
                                class="nav-link {{ setActiveRoute('admin.permissions.create') }}">
                                <i class="fas fa-pencil-alt"></i>
                                <p>Crear Usuario</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
    </ul>
</nav>
