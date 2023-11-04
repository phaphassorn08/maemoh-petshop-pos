<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <br>
            <img class="img-profile rounded-circle center" src="{{ asset('backend/img/profile.jpg') }}" >
            <a class="sidebar-brand d-flex align-items-center justify-content-center" >
                <div class="sidebar-brand-text mx-3"><h5>{{ __('ร้านอาหารสัตว์ แม่เมาะเพ็ทช็อป') }}</h5></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

                <style type="text/css">
                    img.center {
                    display: block;
                    margin-left: auto;
                    margin-right: auto;
                    width: 150px;
                    height: 150px;
                    }
                </style>

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->is('admin/dashboard') || request()->is('admin/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
                    <i class="fas fa-fw fa-chart-line"></i>
                    <span>{{ __('หน้าหลัก') }}</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <span>{{ __('จัดการผู้ใช้') }}</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}"> <i class="fa fa-user mr-2"></i> {{ __('จัดการผู้ใช้') }}</a>
                        <a class="collapse-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}" href="{{ route('admin.roles.index') }}"><i class="fa fa-briefcase mr-2"></i> {{ __('จัดการสถานะ') }}</a>
                    </div>
                </div>
            </li>

            <li class="nav-item {{ request()->is('admin/categories') || request()->is('admin/categories') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.categories.index') }}">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>{{ __('จัดการประเภทสินค้า') }}</span></a>
            </li>

            <li class="nav-item {{ request()->is('admin/products') || request()->is('admin/products') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.products.index') }}">
                    <i class="fas fa-fw fa-box"></i>
                    <span>{{ __('จัดการรายการสินค้า') }}</span></a>
            </li>

            <li class="nav-item {{ request()->is('admin/pos') || request()->is('admin/pos') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.pos.index') }}">
                    <i class="fas fa-fw fa-cash-register"></i>
                    <span>{{ __('ออเดอร์') }}</span></a>
            </li>

            <li class="nav-item {{ request()->is('admin/transactions') || request()->is('admin/transactions') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.transactions.index') }}">
                    <i class="fas fa-fw fa-list"></i>
                    <span>{{ __('จัดการประวัติการขาย') }}</span></a>
            </li>
            
            <li class="nav-item {{ request()->is('admin/reports/revenue') || request()->is('admin/reports/revenue') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.reports.revenue') }}">
                    <i class="fas fa-fw fa fa-table"></i>
                    <span>{{ __('จัดการรายงาน') }}</span></a>
            </li>


        </ul>