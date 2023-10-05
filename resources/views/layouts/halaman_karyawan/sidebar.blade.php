<!-- Sidebar -->
<ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #900C3F">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('karyawan.beranda') }}">
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
    <li class="nav-item">
        <a class="nav-link" href="{{ route('karyawan.beranda') }}">
            <i class="fa-solid fa-home"></i>
            <span>Beranda</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('karyawan.reimbursement') }}">
            <i class="fa-solid fa-hand-holding-heart"></i>
            <span>Reimbursement</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('karyawan.cash_advance') }}">
            <i class="fa-solid fa-sack-dollar"></i>
            <span>Cash Advance</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('karyawan.cash_advance_report') }}">
            <i class="fa-solid fa-file-invoice-dollar"></i>
            <span>Cash Advance Report</span></a>
    </li>

    @if (Auth::user()->jabatan == 'Staff')
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('karyawan.purchase_request') }}">
                <i class="fa-solid fa-chart-bar"></i>
                <span>Purchase Request</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('karyawan.purchase_order') }}">
                <i class="fa-solid fa-cart-arrow-down"></i>
                <span>Purchase Order</span></a>
        </li>
    @elseif (Auth::user()->jabatan == 'Accounting')
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('karyawan.purchase_request') }}">
                <i class="fa-solid fa-chart-bar"></i>
                <span>Purchase Request</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('karyawan.purchase_order') }}">
                <i class="fa-solid fa-cart-arrow-down"></i>
                <span>Purchase Order</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    @if (Auth::user()->jabatan == 'Konsultan')
        <li class="nav-item">
            <a class="nav-link"
                href="https://drive.google.com/file/d/1FYmGvS7aYSU4HFpk7zngHP5TPRfcQSVf/view?usp=sharing">
                <i class="fa-regular fa-circle-question"></i>
                <span>Help</span></a>
        </li>
    @elseif (Auth::user()->jabatan == 'Project Manager')
        <li class="nav-item">
            <a class="nav-link"
                href="https://drive.google.com/file/d/1AFEoQgVbNCqmZuyB98W3pvWQflVISr-5/view?usp=sharing">
                <i class="fa-regular fa-circle-question"></i>
                <span>Help</span></a>
        </li>
    @elseif (Auth::user()->jabatan == 'Support Manager')
        <li class="nav-item">
            <a class="nav-link"
                href="https://drive.google.com/file/d/1AFEoQgVbNCqmZuyB98W3pvWQflVISr-5/view?usp=sharing">
                <i class="fa-regular fa-circle-question"></i>
                <span>Help</span></a>
        </li>
    @elseif (Auth::user()->jabatan == 'Staff')
        <li class="nav-item">
            <a class="nav-link"
                href="https://drive.google.com/file/d/1AFEoQgVbNCqmZuyB98W3pvWQflVISr-5/view?usp=sharing">
                <i class="fa-regular fa-circle-question"></i>
                <span>Help</span></a>
        </li>
    @elseif (Auth::user()->jabatan == 'Accounting')
        <li class="nav-item">
            <a class="nav-link"
                href="https://drive.google.com/file/d/1AFEoQgVbNCqmZuyB98W3pvWQflVISr-5/view?usp=sharing">
                <i class="fa-regular fa-circle-question"></i>
                <span>Help</span></a>
        </li>
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
