<!-- Navbar -->
<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" width="25" height="25" class="img-circle elevation-2"
                     alt="User Image">
                {{Auth::guard('admin')->user()->first_name}}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{url('/')}}" class="dropdown-item">Visit site</a>
                <div class="dropdown-divider"></div>
                <form method="post" id="logout" action="{{route('logout')}}">
                    {{csrf_field()}}
                    <a href="javascript:void(0)" onclick="document.getElementById('logout').submit();" class="dropdown-item">Logout</a>
                </form>
            </div>
        </li>
    </ul>
    <!-- Right navbar links -->
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Next Shopping</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link @if(Request::is('backend')) active @endif">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.product.index') }}"
                       class="nav-link @if(Request::is('backend/product') ||Request::is('backend/product/*')) active @endif">
                        <i class="nav-icon fa fa-product-hunt"></i>
                        <p>
                            Product
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(Request::is('backend/product') ||Request::is('backend/product/*')) style="display: block;" @endif>
                        <li class="nav-item">
                            <a href="{{ route('admin.product.create') }}" class="nav-link @if(Request::is('backend/product/create')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.product.index') }}" class="nav-link @if(Request::is('backend/product')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>List All</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.order.index') }}"
                       class="nav-link @if(Request::is('backend/order') || Request::is('backend/order/*')) active @endif">
                        <i class="nav-icon fa fa-briefcase"></i>
                        <p>
                            Order
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.category.index') }}"
                       class="nav-link @if(Request::is('backend/category') ||Request::is('backend/category/*')) active @endif">
                        <i class="nav-icon fa fa-cc"></i>
                        <p>
                            Category
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(Request::is('backend/category') ||Request::is('backend/category/*')) style="display: block;" @endif>
                        <li class="nav-item">
                            <a href="{{ route('admin.category.create') }}" class="nav-link @if(Request::is('backend/category/create')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.category.index') }}" class="nav-link @if(Request::is('backend/category')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>List All</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.brand.index') }}"
                       class="nav-link @if(Request::is('backend/brand') ||Request::is('backend/brand/*')) active @endif">
                        <i class="nav-icon fa fa-houzz"></i>
                        <p>
                            Brand
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(Request::is('backend/brand') ||Request::is('backend/brand/*')) style="display: block;" @endif>
                        <li class="nav-item">
                            <a href="{{ route('admin.brand.create') }}" class="nav-link @if(Request::is('backend/brand/create')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.brand.index') }}" class="nav-link @if(Request::is('backend/brand')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>List All</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.banner.index') }}"
                       class="nav-link @if(Request::is('backend/banner') ||Request::is('backend/banner/*')) active @endif">
                        <i class="nav-icon fa fa-object-ungroup"></i>
                        <p>
                            Banner
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(Request::is('backend/banner') ||Request::is('backend/banner/*')) style="display: block;" @endif>
                        <li class="nav-item">
                            <a href="{{ route('admin.banner.create') }}" class="nav-link @if(Request::is('backend/banner/create')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.banner.index') }}" class="nav-link @if(Request::is('backend/banner')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>List All</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.faq.index') }}"
                       class="nav-link @if(Request::is('backend/faq') ||Request::is('backend/faq/*')) active @endif">
                        <i class="nav-icon fa fa-envelope"></i>
                        <p>
                            Faq
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(Request::is('backend/faq') ||Request::is('backend/faq/*')) style="display: block;" @endif>
                        <li class="nav-item">
                            <a href="{{ route('admin.faq.create') }}" class="nav-link @if(Request::is('backend/faq/create')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.faq.index') }}" class="nav-link @if(Request::is('backend/faq')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>List All</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}"
                       class="nav-link @if(Request::is('backend/users') ||Request::is('backend/users/*')) active @endif">
                        <i class="nav-icon fa fa-address-card"></i>
                        <p>
                            Users
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(Request::is('backend/users') ||Request::is('backend/users/*')) style="display: block;" @endif>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.create') }}" class="nav-link @if(Request::is('backend/users/create')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link @if(Request::is('backend/users')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>List All</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.coupon.index') }}"
                       class="nav-link @if(Request::is('backend/coupon') ||Request::is('backend/coupon/*')) active @endif">
                        <i class="nav-icon fa fa-gift"></i>
                        <p>
                            Coupon
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(Request::is('backend/coupon') ||Request::is('backend/coupon/*')) style="display: block;" @endif>
                        <li class="nav-item">
                            <a href="{{ route('admin.coupon.create') }}" class="nav-link @if(Request::is('backend/coupon/create')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.coupon.index') }}" class="nav-link @if(Request::is('backend/coupon')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>List All</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.page.index') }}"
                       class="nav-link @if(Request::is('backend/page') ||Request::is('backend/page/*')) active @endif">
                        <i class="nav-icon fa fa-bars"></i>
                        <p>
                            Page
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(Request::is('backend/page') ||Request::is('backend/page/*')) style="display: block;" @endif>
                        <li class="nav-item">
                            <a href="{{ route('admin.page.create') }}" class="nav-link @if(Request::is('backend/page/create')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.page.index') }}" class="nav-link @if(Request::is('backend/page')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>List All</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.emi.index') }}"
                       class="nav-link @if(Request::is('backend/emi') ||Request::is('backend/emi/*')) active @endif">
                        <i class="nav-icon fa fa-percent"></i>
                        <p>
                            EMI Rates
                        </p>
                    </a>
                    <ul class="nav nav-treeview" @if(Request::is('backend/emi') ||Request::is('backend/emi/*')) style="display: block;" @endif>
                        <li class="nav-item">
                            <a href="{{ route('admin.emi.create') }}" class="nav-link @if(Request::is('backend/emi/create')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.emi.index') }}" class="nav-link @if(Request::is('backend/emi')) active @endif">
                                <i class="fa fa-circle-o nav-icon"></i>
                                <p>List All</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.setting') }}"
                       class="nav-link @if(Request::is('setting')) active @endif">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Setting
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@yield('title')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @yield('breadcrumb')
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
