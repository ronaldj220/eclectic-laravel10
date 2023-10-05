<!-- Sidebar -->
<ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #900C3F">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('direksi.beranda') }}">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('ECLECTIC GSM CROP1.png') }}" alt="" width="90%">
        </div>
        <div class="sidebar-brand-text">
            <img src="{{ asset('ECLECTIC GSM CROP2.png') }}" alt="" width="100%">
        </div>

    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item ">
        <a class="nav-link" href="{{ route('direksi.beranda') }}">
            <i class="fa-solid fa-home"></i>
            <span>Beranda</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('direksi.reimbursement') }}">
            <i class="fa-solid fa-hand-holding-heart"></i>
            <span>Reimbursement</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('direksi.cash_advance') }}">
            <i class="fa-solid fa-sack-dollar"></i>
            <span>Cash Advance</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('direksi.cash_advance_report') }}">
            <i class="fa-solid fa-file-invoice-dollar"></i>
            <span>Cash Advance Report</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('direksi.purchase_request') }}">
            <i class="fa-solid fa-chart-bar"></i>
            <span>Purchase Request</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('direksi.purchase_order') }}">
            <i class="fa-solid fa-cart-arrow-down"></i>
            <span>Purchase Order</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog "></i>
            <span>Setting</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="{{ route('admin.supplier') }}">
                    <i class="fa-solid fa-truck-field-un fa-beat"></i>&nbsp;Supplier</a>

            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="https://drive.google.com/file/d/1BygET-_qrafRbWvjUho_qb8m3GOdQzqF/view?usp=sharing">
            <i class="fa-regular fa-circle-question"></i>
            <span>Help</span></a>
    </li>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->
