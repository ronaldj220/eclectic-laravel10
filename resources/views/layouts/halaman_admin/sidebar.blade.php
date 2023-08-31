<!-- Sidebar -->
<ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #900C3F">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.beranda') }}">
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
        <a class="nav-link" href="{{ route('admin.beranda') }}">
            <i class="fa-solid fa-home "></i>
            <span>Beranda</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.reimbursement') }}">
            <i class="fa-solid fa-hand-holding-heart"></i>
            <span>Reimbursement</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.cash_advance') }}">
            <i class="fa-solid fa-sack-dollar"></i>
            <span>Cash Advance</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.cash_advance_report') }}">
            <i class="fa-solid fa-file-invoice-dollar"></i>
            <span>Cash Advance Report</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.purchase_request') }}">
            <i class="fa-solid fa-chart-bar"></i>
            <span>Purchase Request</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.purchase_order') }}">
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
                <a class="collapse-item" href="{{ route('admin.admin') }}"><i
                        class="fa-solid fa-lock fa-beat"></i>&nbsp;Admin</a>
                <a class="collapse-item" href="{{ route('admin.karyawan') }}"><i
                        class="fa-solid fa-user fa-beat"></i>&nbsp;Karyawan</a>
                <a class="collapse-item" href="{{ route('admin.currency') }}"><i
                        class="fa-solid fa-money-check fa-beat"></i>&nbsp;Mata Uang</a>
                <a class="collapse-item" href="{{ route('admin.accounting') }}"><i
                        class="fa-solid fa-calculator fa-beat"></i>&nbsp;Accounting</a>
                <a class="collapse-item" href="{{ route('admin.kasir') }}"><i
                        class="fa-solid fa-cash-register fa-beat"></i>&nbsp;Kasir</a>
                <a class="collapse-item" href="{{ route('admin.menyetujui') }}"><i
                        class="fa-solid fa-user fa-beat"></i>&nbsp;Menyetujui</a>
                <a class="collapse-item" href="{{ route('admin.master_timesheet') }}"><i
                        class="fa-solid fa-coins fa-beat"></i>&nbsp;Rate Timesheet Project</a>
                <a class="collapse-item" href="{{ route('admin.master_fee_project') }}"><i
                        class="fa-solid fa-coins fa-beat"></i>&nbsp;Rate Lembur & Ticket</a>
                <a class="collapse-item" href="{{ route('admin.supplier') }}">
                    <i class="fa-solid fa-truck-field-un fa-beat"></i>&nbsp;Supplier</a>
                <a class="collapse-item" href="{{ route('admin.client') }}">
                    <i class="fa-solid fa-user fa-beat"></i>&nbsp;Client</a>
                <a class="collapse-item" href="{{ route('admin.master_PO') }}">
                    <i class="fa-solid fa-user fa-beat"></i>&nbsp;Master PO</a>
            </div>
        </div>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fa-solid fa-print"></i>
            <span>Report</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.reimbursement.report_RB') }}">Reimbursement</a>
                <a class="collapse-item" href="{{ route('admin.CA.report_CA') }}">Cash Advance</a>
                <a class="collapse-item" href="{{ route('admin.CAR.report_CAR') }}">Cash Advance Report</a>
                <a class="collapse-item" href="{{ route('admin.PR.report_PR') }}">Purchase Request</a>
                <a class="collapse-item" href="{{ route('admin.PO.report_PO') }}">Purchase Order</a>
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="https://drive.google.com/file/d/1RJmZuL2LmXJKe3NlkAESjgsCJc9pcX8l/view?usp=sharing">
            <i class="fa-regular fa-circle-question"></i>
            <span>Help</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
