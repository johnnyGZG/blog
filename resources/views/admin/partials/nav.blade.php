<ul class="sidebar-menu" data-widget="tree">
  <li class="header">Navegación</li>
  <!-- Optionally, you can add icons to the links -->
<li class="{{ request()->is('admin') ? 'active' : '' }}">
  <a href="{{ route('dashboard') }}">
      <i class="fa fa-link"></i> 
      <span>Inicio</span>
    </a>
  </li>
<li class="treeview {{ request()->is('admin/posts*') ? 'active' : '' }}">
    <a href="#">
      <i class="fa fa-link"></i> 
      <span>Blog</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
      <li class="{{ request()->is('admin/posts') ? 'active' : '' }}">
        <a href="{{ route('admin.posts.index') }}">
          Ver todos los posts
        </a>
      </li>
      <li>
        <a href="#" data-toggle="modal" data-target="#exampleModal">
          Crear un posts
        </a>
      </li>
    </ul>
  </li>
</ul>