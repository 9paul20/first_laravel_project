<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('admin') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Inicio
                </p>
            </a>
        </li>
      <li class="nav-item menu-open">
        <a href="" class="nav-link {{ request()->is('admin/posts*') ? 'active' : '' }}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Blog
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->is('admin/posts') ? 'active' : '' }}">
                <i class="far fa-eye"></i>
              <p>Todos los Posts</p>
            </a>
          </li>
          <li class="nav-item">
              @if(request()->is('admin/posts/*'))
                  <a href="{{ route('admin.posts.index', '#create') }}" class="nav-link">
                      <i class="fas fa-pencil-alt"></i>
                      <p>Crear Post</p>
                  </a>
              @else
                  <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-xl">
                      <i class="fas fa-pencil-alt"></i>
                      <p>Crear Post</p>
                  </a>
              @endif
          </li>
        </ul>
      </li>
    </ul>
</nav>
