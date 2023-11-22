<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ $company->logo }}" alt="{{ $company->name }}" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ $company->name }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-legacy" data-widget="treeview"
                role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link  {{ $title == 'Dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Dashboard
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>

                <li
                    class="nav-item {{ $title == 'Category' || $title == 'Product' || $title == 'User' || $title == 'Supplier' || $title == 'Customer' ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ $title == 'Category' || $title == 'Product' || $title == 'User' || $title == 'Supplier' || $title == 'Customer' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Master Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('supplier.index') }}"
                                class="nav-link {{ $title == 'Supplier' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Supplier</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('customer.index') }}"
                                class="nav-link {{ $title == 'Customer' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category.index') }}"
                                class="nav-link {{ $title == 'Category' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('product.index') }}"
                                class="nav-link {{ $title == 'Product' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}"
                                class="nav-link {{ $title == 'User' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ $title == 'Sale' || $title == 'Adjustment' ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ $title == 'Sale' || $title == 'Adjustment' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Transaction
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sale.index') }}"
                                class="nav-link {{ $title == 'Sale' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sale</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('adjustment.index') }}"
                                class="nav-link {{ $title == 'Adjustment' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Adjustment</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category.create') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Simple Link
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li
                    class="nav-item {{ $title == 'Profile' || $title == 'Company' || $title == 'Password' ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ $title == 'Profile' || $title == 'Company' || $title == 'Password' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('setting.profile') }}"
                                class="nav-link {{ $title == 'Profile' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.password') }}"
                                class="nav-link {{ $title == 'Password' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Password</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.company') }}"
                                class="nav-link {{ $title == 'Company' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Company</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
