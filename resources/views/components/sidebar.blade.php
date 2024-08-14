<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">ANGKRINGAN KONG JW</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">AKJ</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li>
                <!-- Ganti ikon Dashboard dengan ikon yang lebih sesuai -->
                <a href="{{route('home')}}"
                    class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Management</li>
            <li class="nav-item dropdown">
                <!-- Ganti ikon Users dengan ikon yang lebih sesuai -->
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-users"></i><span>Users</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link"
                            href="{{ route('user.index')}}">All Users</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <!-- Ganti ikon Products dengan ikon yang lebih sesuai -->
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-box-open"></i><span>Products</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link"
                            href="{{ route('product.index')}}">All Products</a>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</div>
