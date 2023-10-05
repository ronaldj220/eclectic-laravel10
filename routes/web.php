<?php

use App\Http\Controllers\Admin\AccountingController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BerandaController;
use App\Http\Controllers\Admin\Cash_AdvanceController;
use App\Http\Controllers\Admin\CashAdvanceReportController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\Fee_ProjectController;
use App\Http\Controllers\Admin\Fee_TimesheetController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\KasirController;
use App\Http\Controllers\Admin\MasterPOController;
use App\Http\Controllers\Admin\MenyetujuiController;
use App\Http\Controllers\Admin\PurchaseOrderController;
use App\Http\Controllers\Admin\PurchaseRequestController;
use App\Http\Controllers\Admin\ReimbursementController;
use App\Http\Controllers\Admin\Report\ReportCAController;
use App\Http\Controllers\Admin\Report\ReportCARController;
use App\Http\Controllers\Admin\Report\ReportPOController;
use App\Http\Controllers\Admin\Report\ReportPRController;
use App\Http\Controllers\Admin\Report\ReportRBController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Auth\ForgotPasswordManager;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Direksi\BerandaController as DireksiBerandaController;
use App\Http\Controllers\Direksi\CashAdvanceController;
use App\Http\Controllers\Direksi\CashAdvanceReportController as DireksiCashAdvanceReportController;
use App\Http\Controllers\Direksi\PurchaseOrderController as DireksiPurchaseOrderController;
use App\Http\Controllers\Direksi\PurchaseRequestController as DireksiPurchaseRequestController;
use App\Http\Controllers\Direksi\ReimbursementController as DireksiReimbursementController;
use App\Http\Controllers\Direksi\Report\CAController;
use App\Http\Controllers\Direksi\Report\CARController;
use App\Http\Controllers\Direksi\Report\POController;
use App\Http\Controllers\Direksi\Report\PRController;
use App\Http\Controllers\Direksi\Report\RBController;
use App\Http\Controllers\Direksi\SupplierController as DireksiSupplierController;
use App\Http\Controllers\Karyawan\BerandaController as KaryawanBerandaController;
use App\Http\Controllers\Karyawan\CashAdvanceController as KaryawanCashAdvanceController;
use App\Http\Controllers\Karyawan\CashAdvanceReportController as KaryawanCashAdvanceReportController;
use App\Http\Controllers\Karyawan\PurchaseOrderController as KaryawanPurchaseOrderController;
use App\Http\Controllers\Karyawan\PurchaseRequestController as KaryawanPurchaseRequestController;
use App\Http\Controllers\Karyawan\ReimbursementController as KaryawanReimbursementController;
use App\Http\Controllers\Karyawan\Report\CAController as KaryawanReportCAController;
use App\Http\Controllers\Karyawan\Report\CARController as KaryawanReportCARController;
use App\Http\Controllers\Karyawan\Report\POController as KaryawanReportPOController;
use App\Http\Controllers\Karyawan\Report\PRController as KaryawanReportPRController;
use App\Http\Controllers\Karyawan\Report\RBController as KaryawanReportRBController;
use App\Http\Controllers\Karyawan\SupplierController as KaryawanSupplierController;
use App\Http\Controllers\Kasir\BerandaController as KasirBerandaController;
use App\Http\Controllers\Kasir\CashAdvanceController as KasirCashAdvanceController;
use App\Http\Controllers\Kasir\CashAdvanceReportController as KasirCashAdvanceReportController;
use App\Http\Controllers\Kasir\PurchaseOrderController as KasirPurchaseOrderController;
use App\Http\Controllers\Kasir\PurchaseRequestController as KasirPurchaseRequestController;
use App\Http\Controllers\Kasir\ReimbursementController as KasirReimbursementController;
use App\Http\Controllers\Kasir\Report\ReportCAController as ReportReportCAController;
use App\Http\Controllers\Kasir\Report\ReportCARController as ReportReportCARController;
use App\Http\Controllers\Kasir\Report\ReportPOController as ReportReportPOController;
use App\Http\Controllers\Kasir\Report\ReportPRController as ReportReportPRController;
use App\Http\Controllers\Kasir\Report\ReportRBController as ReportReportRBController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, 'home'])->name('home');

Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'aksilogin'])->name('aksilogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk Lupa Password
Route::get('forget-password', [ForgotPasswordManager::class, 'forgotPassword'])->name('forgot-password');
Route::post('forget-password', [ForgotPasswordManager::class, 'forgotPasswordPost'])->name('forgot-password');

Route::get('reset-password/{token}', [ForgotPasswordManager::class, 'resetPassword'])->name('reset-password');
Route::post('reset-password', [ForgotPasswordManager::class, 'resetPasswordPost'])->name('reset-password-post');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('admin.beranda');

    // Route Admin
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.admin');
    Route::get('/admin/tambah_admin', [AdminController::class, 'tambah_admin'])->name('admin.admin.tambah_admin');
    Route::post('/admin/simpan_admin', [AdminController::class, 'simpan_admin'])->name('admin.admin.simpan_admin');
    Route::get('/admin/edit_admin/{id}', [AdminController::class, 'edit_admin'])->name('admin.admin.edit_admin');
    Route::post('/admin/edit_admin/{id}', [AdminController::class, 'update_admin'])->name('admin.admin.update_admin');
    Route::get('/admin/hapus_admin/{id}', [AdminController::class, 'hapus_admin'])->name('admin.admin.hapus_admin');

    // Route Karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('admin.karyawan');
    Route::get('/karyawan/tambah_karyawan', [KaryawanController::class, 'tambah_karyawan'])->name('admin.karyawan.tambah_karyawan');
    Route::post('/karyawan/tambah_karyawan', [KaryawanController::class, 'simpan_karyawan'])->name('admin.karyawan.simpan_karyawan');
    Route::get('/karyawan/edit_karyawan/{id}', [KaryawanController::class, 'edit_karyawan'])->name('admin.karyawan.edit_karyawan');
    Route::post('/karyawan/edit_karyawan/{id}', [KaryawanController::class, 'update_karyawan'])->name('admin.karyawan.update_karyawan');
    Route::get('/karyawan/hapus_karyawan/{id}', [KaryawanController::class, 'hapus_karyawan'])->name('admin.karyawan.hapus_karyawan');

    // Route Mata Uang
    Route::get('/currency', [CurrencyController::class, 'index'])->name('admin.currency');
    Route::get('/currency/tambah_currency', [CurrencyController::class, 'tambah_currency'])->name('admin.currency.tambah_currency');
    Route::post('/currency/simpan_currency', [CurrencyController::class, 'simpan_currency'])->name('admin.currency.simpan_currency');
    Route::get('/currency/edit_currency/{id}', [CurrencyController::class, 'edit_currency'])->name('admin.currency.edit_currency');
    Route::post('/currency/edit_currency/{id}', [CurrencyController::class, 'update_currency'])->name('admin.currency.update_currency');
    Route::get('/currency/hapus_currency/{id}', [CurrencyController::class, 'hapus_currency'])->name('admin.currency.hapus_currency');

    // Route Accounting
    Route::get('/accounting', [AccountingController::class, 'index'])->name('admin.accounting');
    Route::get('/accounting/tambah_accounting', [AccountingController::class, 'tambah_accounting'])->name('admin.accounting.tambah_accounting');
    Route::post('/accounting/simpan_accounting', [AccountingController::class, 'simpan_accounting'])->name('admin.accounting.simpan_accounting');
    Route::get('/accounting/edit_accounting/{id}', [AccountingController::class, 'edit_accounting'])->name('admin.accounting.edit_accounting');
    Route::post('/accounting/edit_accounting/{id}', [AccountingController::class, 'update_accounting'])->name('admin.accounting.update_accounting');
    Route::get('/accounting/hapus_accounting/{id}', [AccountingController::class, 'hapus_accounting'])->name('admin.accounting.hapus_accounting');

    // Route Kasir
    Route::get('/kasir', [KasirController::class, 'index'])->name('admin.kasir');
    Route::get('/kasir/tambah_kasir', [KasirController::class, 'tambah_kasir'])->name('admin.kasir.tambah_kasir');
    Route::post('/kasir/simpan_kasir', [KasirController::class, 'simpan_kasir'])->name('admin.kasir.simpan_kasir');
    Route::get('/kasir/edit_kasir/{id}', [KasirController::class, 'edit_kasir'])->name('admin.kasir.edit_kasir');
    Route::post('/kasir/edit_kasir/{id}', [KasirController::class, 'update_kasir'])->name('admin.kasir.update_kasir');
    Route::get('/kasir/hapus_kasir/{id}', [KasirController::class, 'hapus_kasir'])->name('admin.kasir.hapus_kasir');

    // Route Menyetujui
    Route::get('/menyetujui', [MenyetujuiController::class, 'index'])->name('admin.menyetujui');
    Route::get('/menyetujui/tambah_menyetujui', [MenyetujuiController::class, 'tambah_menyetujui'])->name('admin.menyetujui.tambah_menyetujui');
    Route::post('/menyetujui/simpan_menyetujui', [MenyetujuiController::class, 'simpan_menyetujui'])->name('admin.menyetujui.simpan_menyetujui');
    Route::get('/menyetujui/edit_menyetujui/{id}', [MenyetujuiController::class, 'edit_menyetujui'])->name('admin.menyetujui.edit_menyetujui');
    Route::post('/menyetujui/edit_menyetujui/{id}', [MenyetujuiController::class, 'update_menyetujui'])->name('admin.menyetujui.update_menyetujui');
    Route::get('/menyetujui/hapus_menyetujui/{id}', [MenyetujuiController::class, 'hapus_menyetujui'])->name('admin.menyetujui.hapus_menyetujui');

    // Route Biaya Timesheet
    Route::get('/master_timesheet', [Fee_TimesheetController::class, 'index'])->name('admin.master_timesheet');
    Route::get('/master_timesheet/tambah_timesheet', [Fee_TimesheetController::class, 'tambah_fee_timesheet'])->name('admin.master_timesheet.tambah_timesheet');
    Route::post('/master_timesheet/simpan_timesheet', [Fee_TimesheetController::class, 'simpan_fee_timesheet'])->name('admin.master_timesheet.simpan_fee_timesheet');
    Route::get('/master_timesheet/edit_timesheet/{id}', [Fee_TimesheetController::class, 'edit_fee_timesheet'])->name('admin.master_timesheet.edit_timesheet');
    Route::post('/master_timesheet/edit_timesheet/{id}', [Fee_TimesheetController::class, 'update_fee_timesheet'])->name('admin.master_timesheet.update_timesheet');
    Route::get('/master_timesheet/hapus_timesheet/{id}', [Fee_TimesheetController::class, 'hapus_fee_timesheet'])->name('admin.master_timesheet.hapus_timesheet');

    // Route Biaya Project
    Route::get('/master_fee_project', [Fee_ProjectController::class, 'index'])->name('admin.master_fee_project');
    Route::get('/master_fee_project/tambah_fee_project', [Fee_ProjectController::class, 'tambah_fee_project'])->name('admin.master_fee_project.tambah_fee_project');
    Route::post('/master_fee_project/simpan_fee_project', [Fee_ProjectController::class, 'simpan_fee_project'])->name('admin.master_fee_project.simpan_fee_project');
    Route::get('/master_fee_project/edit_fee_project/{id}', [Fee_ProjectController::class, 'edit_fee_project'])->name('admin.master_fee_project.edit_fee_project');
    Route::post('/master_fee_project/edit_fee_project/{id}', [Fee_ProjectController::class, 'update_fee_project'])->name('admin.master_fee_project.update_fee_project');
    Route::get('/master_fee_project/hapus_fee_project/{id}', [Fee_ProjectController::class, 'hapus_fee_project'])->name('admin.master_fee_project.hapus_fee_project');

    // Route Supplier
    Route::get('/master_supplier', [SupplierController::class, 'index'])->name('admin.supplier');
    Route::get('/master_supplier/tambah_supplier', [SupplierController::class, 'tambah_supplier'])->name('admin.supplier.tambah_supplier');
    Route::post('/master_supplier/tambah_supplier', [SupplierController::class, 'simpan_supplier'])->name('admin.supplier.simpan_supplier');
    Route::get('/master_supplier/edit_supplier/{id}', [SupplierController::class, 'edit_supplier'])->name('admin.supplier.edit_supplier');
    Route::post('/master_supplier/edit_supplier/{id}', [SupplierController::class, 'update_supplier'])->name('admin.supplier.update_supplier');
    Route::get('/master_supplier/hapus_supplier/{id}', [SupplierController::class, 'hapus_supplier'])->name('admin.supplier.hapus_supplier');

    // Route Client
    Route::get('/client', [ClientController::class, 'index'])->name('admin.client');
    Route::get('/client/tambah_client', [ClientController::class, 'tambah_client'])->name('admin.client.tambah_client');
    Route::post('/client/simpan_client', [ClientController::class, 'simpan_client'])->name('admin.client.simpan_client');
    Route::get('/client/edit_client/{id}', [ClientController::class, 'edit_client'])->name('admin.client.edit_client');
    Route::post('/client/edit_client/{id}', [ClientController::class, 'update_client'])->name('admin.client.update_client');
    Route::get('/client/hapus_client/{id}', [ClientController::class, 'hapus_client'])->name('admin.client.hapus_client');

    // Route Master PO (Purchase Order)
    Route::get('/master_PO', [MasterPOController::class, 'index'])->name('admin.master_PO');
    Route::get('/master_PO/edit_PO/{id}', [MasterPOController::class, 'edit_PO'])->name('admin.master_PO.edit_PO');
    Route::post('/master_PO/update_PO/{id}', [MasterPOController::class, 'update_PO'])->name('admin.master_PO.update_PO');

    // Route Reimbursement
    Route::get('/reimbursement', [ReimbursementController::class, 'index'])->name('admin.reimbursement');
    Route::get('/reimbursement/add_doc_RB', [ReimbursementController::class, 'new_doc_RB'])->name('admin.reimbursement.new_doc_RB');
    Route::post('/reimbursement/save_doc_RB', [ReimbursementController::class, 'save_no_doku_RB'])->name('admin.reimbursement.save_doc_RB');
    Route::get('/reimbursement/edit_doc_RB/{id}', [ReimbursementController::class, 'edit_doc_RB'])->name('admin.reimbursement.edit_doc_RB');
    Route::post('/reimbursement/update_doc_RB/{id}', [ReimbursementController::class, 'update_doc_RB'])->name('admin.reimbursement.update_doc_RB');
    Route::get('/reimbursement/edit_RB/{id}', [ReimbursementController::class, 'edit_RB'])->name('admin.reimbursement.edit_RB');
    Route::post('/reimbursement/update_RB/{id}', [ReimbursementController::class, 'update_RB'])->name('admin.reimbursement.update_RB');
    Route::get('/reimbursement/tambah_reimbursement', [ReimbursementController::class, 'tambah_reimbursement'])->name('admin.reimbursement.tambah_reimbursement');
    Route::post('/reimbursement/tambah_reimbursement', [ReimbursementController::class, 'simpan_reimbursement'])->name('admin.reimbursement.simpan_reimbursement');
    Route::get('/reimbursement/excel_reimbursement/{id}', [ReimbursementController::class, 'excel_reimbursement'])->name('admin.reimbursement.excel_reimbursement');
    Route::get('/reimbursement/view_reimbursement/{id}', [ReimbursementController::class, 'view_reimbursement'])->name('admin.reimbursement.view_reimbursement');
    Route::post('/reimbursement/setujui_reimbursement/{id}', [ReimbursementController::class, 'setujui_reimbursement'])->name('admin.reimbursement.setujui_reimbursement');
    Route::get('/reimbursement/tolak_reimbursement/{id}', [ReimbursementController::class, 'tolak_reimbursement'])->name('admin.reimbursement.tolak_reimbursement');
    Route::get('/reimbursement/view_RB/{id}', [ReimbursementController::class, 'lihat_reimbursement'])->name('admin.reimbursement.lihat_reimbursement');
    Route::get('/reimbursement/print_reimbursement/{id}', [ReimbursementController::class, 'print_reimbursement'])->name('admin.reimbursement.print_reimbursement');
    Route::get('/reimbursement/print_bukti_reimbursement/{id}', [ReimbursementController::class, 'print_bukti_reimbursement'])->name('admin.reimbursement.print_bukti_reimbursement');

    // Route untuk mendapatkan Nomor Telepon Direksi
    Route::get('/reimbursement/getNomor', [ReimbursementController::class, 'getNomor'])->name('admin.reimbursement.getNomor');

    Route::get('/reimbursement/bulan', [ReimbursementController::class, 'search_by_date'])->name('admin.reimbursement.bulan');

    // Route untuk Edit Reimbursement
    Route::get('reimbursement/edit_reimbursement/{id}', [ReimbursementController::class, 'edit_reimbursement'])->name('admin.reimbursement.edit_reimbursement');
    Route::post('reimbursement/update_reimbursement/{id}', [ReimbursementController::class, 'update_reimbursement'])->name('admin.reimbursement.update_reimbursement');

    // Route untuk Edit TS
    Route::get('/reimbursement/edit_TS/{id}', [ReimbursementController::class, 'edit_TS'])->name('admin.RB.edit_TS');
    Route::post('/reimbursement/update_TS/{id}', [ReimbursementController::class, 'update_TS'])->name('admin.RB.update_TS');

    // Route untuk edit ST
    Route::get('/reimbursement/edit_ST/{id}', [ReimbursementController::class, 'edit_ST'])->name('admin.RB.edit_ST');
    Route::post('/reimbursement/update_ST/{id}', [ReimbursementController::class, 'update_ST'])->name('admin.RB.update_ST');

    // Route untuk edit SL
    Route::get('/reimbursement/edit_SL/{id}', [ReimbursementController::class, 'edit_SL'])->name('admin.RB.edit_SL');
    Route::post('/reimbursement/update_SL/{id}', [ReimbursementController::class, 'update_SL'])->name('admin.RB.update_SL');

    // Route Kirim WA ke Direksi untuk Reimbursement
    Route::get('/reimbursement/kirim_WA/{id}', [ReimbursementController::class, 'kirim_WA'])->name('admin.reimbursement.kirim_WA');

    // Route untuk Menyetujui Khusus Pak Aris
    Route::get('/reimbursement/setujui_RB/{id}', [ReimbursementController::class, 'setujui_RB'])->name('admin.reimbursement.setujui_RB');

    // Route unt\uk tolak persetujuan RB 
    Route::post('/reimbursement/tolak_RB/{id}', [ReimbursementController::class, 'tolak_RB'])->name('admin.reimbursement.tolak_RB');

    Route::get('/reimbursement/hapus_RB/{id}', [ReimbursementController::class, 'delete_RB'])->name('admin.reimbursement.delete_RB');

    // Route Cash Advance 
    Route::get('/cash_advance', [Cash_AdvanceController::class, 'index'])->name('admin.cash_advance');
    Route::get('/cash_advance/tambah_cash_advance', [Cash_AdvanceController::class, 'tambah_CA'])->name('admin.cash_advance.tambah_cash_advance');
    Route::post('/cash_advance/simpan_cash_advance', [Cash_AdvanceController::class, 'simpan_CA'])->name('admin.cash_advance.simpan_cash_advance');
    Route::get('/cash_advance/view_CA/{id}', [Cash_AdvanceController::class, 'view_CA'])->name('admin.cash_advance.view_cash_advance');
    Route::get('/cash_advance/view_CAR/{id}', [Cash_AdvanceController::class, 'view_CAR'])->name('admin.cash_advance.view_CAR');
    Route::post('/cash_advance/setujui_cash_advance/{id}', [Cash_AdvanceController::class, 'setujui_CA'])->name('admin.cash_advance.setujui_cash_advance');
    Route::get('/cash_advance/tolak_cash_advance/{id}', [Cash_AdvanceController::class, 'reject_CA'])->name('admin.cash_advance.tolak_cash_advance');
    Route::get('/cash_advance/print_cash_advance/{id}', [Cash_AdvanceController::class, 'print_CA'])->name('admin.cash_advance.print_cash_advance');
    Route::get('/cash_advance/excel_cash_advance/{id}', [Cash_AdvanceController::class, 'excel_CA'])->name('admin.cash_advance.excel_cash_advance');
    Route::get('/cash_advance/edit_CA/{id}', [Cash_AdvanceController::class, 'edit_CA'])->name('admin.cash_advance.edit_CA');
    Route::post('/cash_advance/update_CA/{id}', [Cash_AdvanceController::class, 'update_CA'])->name('admin.cash_advance.update_CA');
    Route::get('/cash_advance/hapus_CA/{id}', [Cash_AdvanceController::class, 'hapus_CA'])->name('admin.cash_advance.hapus_CA');

    Route::get('/cash_advance/bulan', [Cash_AdvanceController::class, 'search_by_date'])->name('admin.cash_advance.bulan');

    // Route untuk Menyetujui Khusus Pak Aris di CA
    Route::get('/cash_advance/setujui_CA/{id}', [Cash_AdvanceController::class, 'approved_CA'])->name('admin.cash_advance.setujui_CA');
    Route::post('/cash_advance/tolak_CA/{id}', [Cash_AdvanceController::class, 'tolak_CA'])->name('admin.cash_advance.tolak_CA');

    Route::get('/cash_advance/getNomor', [Cash_AdvanceController::class, 'getNomor'])->name('admin.cash_advance.getNomor');

    Route::get('/cash_advance/kirim_WA/{id}', [Cash_AdvanceController::class, 'kirim_WA'])->name('admin.cash_advance.kirim_WA');

    // Route Cash Advance Report untuk Admin
    Route::get('/cash_advance_report', [CashAdvanceReportController::class, 'index'])->name('admin.cash_advance_report');
    Route::get('/cash_advance_report/tambah_cash_advance_report', [CashAdvanceReportController::class, 'tambah_CAR'])->name('admin.cash_advance_report.tambah_cash_advance_report');
    Route::post('/cash_advance_report/simpan_cash_advance_report', [CashAdvanceReportController::class, 'simpan_CAR'])->name('admin.cash_advance_report.simpan_cash_advance_report');
    Route::get('/cash_advance_report/excel_cash_advance_report/{id}', [CashAdvanceReportController::class, 'excel_cash_advance_report'])->name('admin.cash_advance_report.excel_cash_advance_report');
    Route::get('/cash_advance_report/view_cash_advance_report/{id}', [CashAdvanceReportController::class, 'view_cash_advance_report'])->name('admin.cash_advance_report.view_cash_advance_report');
    Route::get('/cash_advance_report/view_CA/{id}', [CashAdvanceReportController::class, 'view_CA'])->name('admin.cash_advance_report.view_CA');
    Route::get('/cash_advance_report/setujui_cash_advance_report/{id}', [CashAdvanceReportController::class, 'setujui_cash_advance_report'])->name('admin.cash_advance_report.setujui_cash_advance_report');
    Route::get('/cash_advance_report/tolak_cash_advance_report/{id}', [CashAdvanceReportController::class, 'reject_cash_advance_report'])->name('admin.cash_advance_report.tolak_CAR');
    Route::get('/cash_advance_report/print_cash_advance_report/{id}', [CashAdvanceReportController::class, 'print_cash_advance_report'])->name('admin.cash_advance_report.print_cash_advance_report');
    Route::get('/cash_advance_report/print_bukti_cash_advance_report/{id}', [CashAdvanceReportController::class, 'print_bukti_cash_advance_report'])->name('admin.cash_advance_report.print_bukti_cash_advance_report');
    Route::get('/cash_advance_report/edit_CAR/{id}', [CashAdvanceReportController::class, 'edit_CAR'])->name('admin.cash_advance_report.edit_CAR');
    Route::post('/cash_advance_report/update_CAR/{id}', [CashAdvanceReportController::class, 'update_CAR'])->name('admin.cash_advance_report.update_CAR');


    Route::get('/cash_advance_report/hapus_CAR/{id}', [CashAdvanceReportController::class, 'hapus_CAR'])->name('admin.cash_advance_report.hapus_CAR');
    // Route untuk Menyetujui Pak Aris
    Route::get('/cash_advance_report/setujui_CAR/{id}', [CashAdvanceReportController::class, 'setujui_CAR'])->name('admin.cash_advance_report.setujui_CAR');
    Route::post('/cash_advance_report/tolak_CAR/{id}', [CashAdvanceReportController::class, 'tolak_CAR'])->name('admin.cash_advance_report.tolak_cash_advance_report');

    // Route untuk admin yang ingin bayar CAR dan nilainya lebih dari nominal CAR
    Route::post('/cash_advance_report/paid_CAR/{id}', [CashAdvanceReportController::class, 'paid_CAR'])->name('admin.cash_advance_report.paid_CAR');
    // Route untuk admin yang ingin membayar CAR dan nilainya sama dengan nominal CAR (nilainya 0)
    Route::get('/CAR/paid_CAR/{id}', [CashAdvanceReportController::class, 'done_CAR'])->name('admin.CAR.done_CAR');

    // Route untuk mendapatkan nominal CA
    Route::get('cash_advance_report/get-nominal', [CashAdvanceReportController::class, 'getNominal'])->name('admin.CAR.getNominal');

    Route::get('/cash_advance_report/get-bulan', [CashAdvanceReportController::class, 'search_by_date'])->name('admin.CAR.bulan');

    Route::get('/cash_advance_report/kirim_WA/{id}', [CashAdvanceReportController::class, 'kirim_WA'])->name('admin.cash_advance_report.kirim_WA');

    // Route Purchase Request untuk Admin
    Route::get('/purchase_request', [PurchaseRequestController::class, 'index'])->name('admin.purchase_request');
    Route::get('/purchase_request/tambah_purchase_request', [PurchaseRequestController::class, 'tambah_purchase_request'])->name('admin.purchase_request.tambah_purchase_request');
    Route::post('/purchase_request/simpan_purchase_request', [PurchaseRequestController::class, 'simpan_purchase_request'])->name('admin.purchase_request.simpan_purchase_request');
    Route::get('/purchase_request/excel_purchase_request/{id}', [PurchaseRequestController::class, 'excel_purchase_request'])->name('admin.purchase_request.excel_purchase_request');
    Route::get('/purchase_request/print_purchase_request/{id}', [PurchaseRequestController::class, 'print_purchase_request'])->name('admin.purchase_request.print_purchase_request');
    Route::get('/purchase_request/view_PR/{id}', [PurchaseRequestController::class, 'view_PR'])->name('admin.purchase_request.view_PR');
    Route::get('/purchase_request/view_PO/{id}', [PurchaseRequestController::class, 'view_PO'])->name('admin.purchase_request.view_PO');
    Route::post('/purchase_request/setujui_PR/{id}', [PurchaseRequestController::class, 'setujui_PR'])->name('admin.purchase_request.setujui_PR');
    // Route untuk Pak Aris
    Route::get('/purchase_request/acc_PR/{id}', [PurchaseRequestController::class, 'acc_PR'])->name('admin.purchase_request.acc_PR');
    Route::get('/purchase_request/tolak_PR/{id}', [PurchaseRequestController::class, 'tolak_PR'])->name('admin.purchase_request.tolak_PR');
    Route::get('/purchase_request/edit_PR/{id}', [PurchaseRequestController::class, 'edit_PR'])->name('admin.purchase_request.edit_PR');
    Route::post('/purchase_request/update_PR/{id}', [PurchaseRequestController::class, 'update_PR'])->name('admin.purchase_request.update_PR');
    // Hapus Data PR
    Route::get('/purchase_request/hapus_PR/{id}', [PurchaseRequestController::class, 'hapus_PR'])->name('admin.purchase_request.hapus_PR');

    Route::get('/purchase_request/bulan', [PurchaseRequestController::class, 'search_by_date'])->name('admin.purchase_request.bulan');

    // Route Purchase Order untuk Admin
    Route::get('/purchase_order', [PurchaseOrderController::class, 'index'])->name('admin.purchase_order');
    Route::get('/purchase_order/tambah_PO', [PurchaseOrderController::class, 'tambah_PO'])->name('admin.purchase_order.tambah_PO');

    Route::get('/get-data-by-supplier', [PurchaseOrderController::class, 'getDataBySupplier'])->name('admin.getDataBySupplier');
    Route::get('/admin/getDetailByTipePR', [PurchaseOrderController::class, 'getDataByPR'])->name('admin.getDetailByTipePR');

    Route::post('/purchase_request/simpan_PO', [PurchaseOrderController::class, 'simpan_PO'])->name('admin.purchase_order.simpan_PO');
    Route::get('/purchase_order/excel_purchase_order/{id}', [PurchaseOrderController::class, 'excel_PO'])->name('admin.purchase_order.excel_PO');
    Route::get('/purchase_order/print_purchase_order/{id}', [PurchaseOrderController::class, 'print_PO'])->name('admin.purchase_order.print_PO');
    Route::get('/purchase_order/view_PO/{id}', [PurchaseOrderController::class, 'view_PO'])->name('admin.purchase_order.view_PO');
    Route::get('/purchase_order/view_PR/{id}', [PurchaseOrderController::class, 'view_PR'])->name('admin.purchase_order.view_PR');
    Route::get('/purchase_order/setujui_PO/{id}', [PurchaseOrderController::class, 'setujui_PO'])->name('admin.purchase_order.setujui_PO');
    // Route untuk Pak Aris
    Route::get('/purchase_order/acc_PO/{id}', [PurchaseOrderController::class, 'acc_PO'])->name('admin.purchase_order.acc_PO');
    // Route::get('/purchase_order/setujui_PO/{id}', [PurchaseOrderController::class, 'setujui_PO'])->name('admin.purchase_order.setujui_PO');
    Route::get('/purchase_order/tolak_PO/{id}', [PurchaseOrderController::class, 'tolak_PO'])->name('admin.purchase_order.tolak_PO');
    Route::get('/purchase_order/edit_PO/{id}', [PurchaseOrderController::class, 'edit_PO'])->name('admin.purchase_order.edit_PO');
    Route::post('/purchase_order/update_PO/{id}', [PurchaseOrderController::class, 'update_PO'])->name('admin.purchase_order.update_PO');
    Route::get('/purchase_order/hapus_PO/{id}', [PurchaseOrderController::class, 'hapus_PO'])->name('admin.purchase_order.hapus_PO');

    Route::get('/purchase_order/bulan', [PurchaseOrderController::class, 'search_by_date'])->name('admin.purchase_order.bulan');

    // Route Laporan RB untuk Admin
    Route::get('/report/RB', [ReportRBController::class, 'index'])->name('admin.reimbursement.report_RB');
    Route::post('/report/RB/search_date', [ReportRBController::class, 'search_date'])->name('admin.reimbursement.search_date_RB');

    // Route Laporan CA untuk Admin
    Route::get('/report/CA', [ReportCAController::class, 'index'])->name('admin.CA.report_CA');
    Route::post('/report/CA/search_date', [ReportCAController::class, 'search_date'])->name('admin.CA.search_date_CA');

    // Route Laporan CAR
    Route::get('/report/CAR', [ReportCARController::class, 'index'])->name('admin.CAR.report_CAR');
    Route::post('/report/CAR/search_date', [ReportCARController::class, 'search_date'])->name('admin.CAR.search_date_CAR');
    // Route Laporan PR untuk Admin 
    Route::get('/report/PR', [ReportPRController::class, 'index'])->name('admin.PR.report_PR');
    Route::post('/report/PR/search_date', [ReportPRController::class, 'search_date'])->name('admin.PR.search_date_PR');
    // Route Laporan PO untuk Admin 
    Route::get('/report/PO', [ReportPOController::class, 'index'])->name('admin.PO.report_PO');
    Route::post('/report/PO/search_date', [ReportPOController::class, 'search_date'])->name('admin.PO.search_date_PO');
});

Route::prefix('karyawan')->middleware(['karyawan'])->group(function () {
    Route::get('/beranda', [KaryawanBerandaController::class, 'index'])->name('karyawan.beranda');
    Route::get('/beranda/profile', [KaryawanBerandaController::class, 'profile'])->name('karyawan.beranda.profile');
    Route::get('/beranda/profile/update_profile', [KaryawanBerandaController::class, 'update_profile'])->name('karyawan.beranda.profile.update_profile');
    Route::post('/beranda/profile/update_profile/{id}', [KaryawanBerandaController::class, 'update_profile_karyawan'])->name('karyawan.beranda.profile.update_profile_karyawan');

    // Route untuk Supplier
    Route::get('/supplier', [KaryawanSupplierController::class, 'index'])->name('karyawan.supplier');
    Route::get('/supplier/add_supplier', [KaryawanSupplierController::class, 'add_supplier'])->name('karyawan.supplier.add_supplier');
    Route::post('/supplier/save_supplier', [KaryawanSupplierController::class, 'save_supplier'])->name('karyawan.supplier.save_supplier');
    Route::get('/supplier/edit_supplier/{id}', [KaryawanSupplierController::class, 'edit_supplier'])->name('karyawan.supplier.edit_supplier');
    Route::post('/supplier/update_supplier/{id}', [KaryawanSupplierController::class, 'update_supplier'])->name('karyawan.supplier.update_supplier');
    Route::get('/supplier/delete_supplier/{id}', [KaryawanSupplierController::class, 'delete_supplier'])->name('karyawan.supplier.delete_supplier');

    // Route untuk Karyawan yang ingin mengajukan reimbursement
    Route::get('/reimbursement', [KaryawanReimbursementController::class, 'index'])->name('karyawan.reimbursement');
    Route::get('/reimbursement/tambah_reimbursement', [KaryawanReimbursementController::class, 'tambah_reimbursement'])->name('karyawan.reimbursement.tambah_reimbursement');
    Route::post('/reimbursement/simpan_reimbursement', [KaryawanReimbursementController::class, 'simpan_reimbursement'])->name('karyawan.reimbursement.simpan_reimbursement');
    Route::get('/reimbursement/view_RB/{id}', [KaryawanReimbursementController::class, 'view_reimbursement'])->name('karyawan.reimbursement.view_reimbursement');
    Route::get('/reimbursement/print_reimbursement/{id}', [KaryawanReimbursementController::class, 'print_reimbursement'])->name('karyawan.reimbursement.print_reimbursement');
    Route::get('/reimbursement/print_bukti_reimbursement/{id}', [KaryawanReimbursementController::class, 'lihat_bukti_reimbursement'])->name('karyawan.reimbursement.lihat_bukti_reimbursement');
    Route::get('/reimbursement/edit_RB/{id}', [KaryawanReimbursementController::class, 'edit_RB'])->name('karyawan.reimbursement.edit_RB');
    Route::post('/reimbursement/update_RB/{id}', [KaryawanReimbursementController::class, 'update_RB'])->name('karyawan.reimbursement.update_RB');
    Route::get('/reimbursement/getNomor', [KaryawanReimbursementController::class, 'getNomor'])->name('karyawan.reimbursement.getNomor');

    // Route untuk Karyawan yang ingin mengajukan Support Ticket(ST) dan Lembur (SL)
    Route::get('/reimbursement/add_ST', [KaryawanReimbursementController::class, 'add_ST'])->name('karyawan.RB.add_ST');
    Route::post('/reimbursement/save_ST', [KaryawanReimbursementController::class, 'save_ST'])->name('karyawan.RB.save_ST');
    Route::get('/reimbursement/add_SL', [KaryawanReimbursementController::class, 'add_SL'])->name('karyawan.RB.add_SL');
    Route::post('/reimbursement/save_SL', [KaryawanReimbursementController::class, 'save_SL'])->name('karyawan.RB.save_SL');

    // Route untuk Karyawan yang ingin mengajukan Timesheet Project (TS)
    Route::get('/reimbursement/add_TS', [KaryawanReimbursementController::class, 'add_TS'])->name('karyawan.RB.add_TS');
    Route::post('/reimbursement/save_TS', [KaryawanReimbursementController::class, 'save_TS'])->name('karyawan.RB.save_TS');

    Route::get('/reimbursement/hapus_RB/{id}', [KaryawanReimbursementController::class, 'delete_RB'])->name('karyawan.RB.delete_RB');
    // Route untuk karyawan yang ingin mengajukan cash advance
    Route::get('/cash_advance', [KaryawanCashAdvanceController::class, 'index'])->name('karyawan.cash_advance');
    Route::get('/cash_advance/tambah_cash_advance', [KaryawanCashAdvanceController::class, 'tambah_cash_advance'])->name('karyawan.cash_advance.tambah_cash_advance');
    Route::post('/cash_advance/simpan_cash_advance', [KaryawanCashAdvanceController::class, 'simpan_cash_advance'])->name('karyawan.cash_advance.simpan_cash_advance');
    Route::get('/cash_advance/view_CA/{id}', [KaryawanCashAdvanceController::class, 'view_cash_advance'])->name('karyawan.cash_advance.view_cash_advance');
    Route::get('/cash_advance/view_CAR/{id}', [KaryawanCashAdvanceController::class, 'view_CAR'])->name('karyawan.cash_advance.view_CAR');

    Route::get('/cash_advance/getNomor', [KaryawanCashAdvanceController::class, 'getNomor'])->name('karyawan.cash_advance.getNomor');

    // Route untuk karyawan yang ingin mengajukan CAR
    Route::get('/cash_advance_report', [KaryawanCashAdvanceReportController::class, 'index'])->name('karyawan.cash_advance_report');
    Route::get('/cash_advance_report/tambah_CAR', [KaryawanCashAdvanceReportController::class, 'tambah_CAR'])->name('karyawan.cash_advance_report.tambah_CAR');
    Route::post('/cash_advance_report/simpan_CAR', [KaryawanCashAdvanceReportController::class, 'simpan_CAR'])->name('karyawan.cash_advance_report.simpan_CAR');
    Route::get('/cash_advance_report/view_CAR/{id}', [KaryawanCashAdvanceReportController::class, 'view_CAR'])->name('karyawan.cash_advance_report.view_CAR');
    Route::get('/cash_advance_report/view_CA/{id}', [KaryawanCashAdvanceReportController::class, 'view_CA'])->name('karyawan.cash_advance_report.view_CA');

    Route::get('cash_advance_report/get-nominal', [KaryawanCashAdvanceReportController::class, 'getNominal'])->name('karyawan.CAR.get-nominal');
    // Route untuk karyawan yang ingin membayar kelebihan CAR
    Route::post('/CAR/paid_CAR/{id}', [KaryawanCashAdvanceReportController::class, 'paid_CAR'])->name('karyawan.CAR.paid_CAR');
    Route::get('/CAR/done_CAR/{id}', [KaryawanCashAdvanceReportController::class, 'done_CAR'])->name('karyawan.CAR.done_CAR');

    // Route untuk karyawan yang ingin mengajukan Purchase Request
    Route::get('/purchase_request', [KaryawanPurchaseRequestController::class, 'index'])->name('karyawan.purchase_request');
    Route::get('/purchase_request/tambah_PR', [KaryawanPurchaseRequestController::class, 'tambah_PR'])->name('karyawan.purchase_request.tambah_PR');
    Route::post('/purchase_request/simpan_PR', [KaryawanPurchaseRequestController::class, 'simpan_PR'])->name('karyawan.purchase_request.simpan_PR');
    Route::get('/purchase_request/view_PR/{id}', [KaryawanPurchaseRequestController::class, 'view_PR'])->name('karyawan.purchase_request.view_PR');
    Route::get('/purchase_request/view_PO/{id}', [KaryawanPurchaseRequestController::class, 'view_PO'])->name('karyawan.purchase_request.view_PO');

    // Route untuk karyawan yang ingin mengajukan Purchase Order
    Route::get('/purchase_order', [KaryawanPurchaseOrderController::class, 'index'])->name('karyawan.purchase_order');
    Route::get('/purchase_order/view_PO/{id}', [KaryawanPurchaseOrderController::class, 'view_PO'])->name('karyawan.purchase_order.view_PO');
    Route::get('/purchase_order/view_PR/{id}', [KaryawanPurchaseOrderController::class, 'view_PR'])->name('karyawan.purchase_order.view_PR');
    Route::get('/purchase_order/tambah_PO', [KaryawanPurchaseOrderController::class, 'tambah_PO'])->name('karyawan.purchase_order.tambah_PO');
    Route::post('/purchase_order/simpan_PO', [KaryawanPurchaseOrderController::class, 'simpan_PO'])->name('karyawan.purchase_order.simpan_PO');

    Route::get('/get-data-by-supplier', [KaryawanPurchaseOrderController::class, 'getDataBySupplier'])->name('karyawan.getDataBySupplier');
    Route::get('/admin/getDetailByTipePR', [KaryawanPurchaseOrderController::class, 'getDataByPR'])->name('karyawan.getDetailByTipePR');

    // Route untuk karyawan yang ingin membuat Laporan 
    // 1. Laporan RB
    Route::get('/report/RB', [KaryawanReportRBController::class, 'index'])->name('karyawan.RB.report_RB');
    Route::post('/RB/search_date_RB', [KaryawanReportRBController::class, 'search_date'])->name('karyawan.RB.search_date_RB');
    // 2. Laporan CA
    Route::get('/report/CA', [KaryawanReportCAController::class, 'index'])->name('karyawan.CA.report_CA');
    Route::post('/report/search_date_CA', [KaryawanReportCAController::class, 'search_date'])->name('karyawan.CA.search_date_CA');
    // 3. Laporan CAR
    Route::get('report/CAR', [KaryawanReportCARController::class, 'index'])->name('karyawan.CAR.report_CAR');
    Route::post('report/search_date_CAR', [KaryawanReportCARController::class, 'search_date'])->name('karyawan.CAR.search_date_CAR');
    // 4. Laporan PR
    Route::get('/report/PR', [KaryawanReportPRController::class, 'index'])->name('karyawan.PR.report_PR');
    Route::post('/report/search_date_PR', [KaryawanReportPRController::class, 'search_date'])->name('karyawan.PR.search_date_PR');
    // 5. Laporan PO
    Route::get('/report/PO', [KaryawanReportPOController::class, 'index'])->name('karyawan.PO.report_PO');
    Route::post('/report/search_date_PO', [KaryawanReportPOController::class, 'search_date'])->name('karyawan.PO.search_date_PO');
});

Route::prefix('direksi')->middleware(['direksi'])->group(function () {
    Route::get('/beranda', [DireksiBerandaController::class, 'index'])->name('direksi.beranda');
    Route::get('/beranda/profile', [DireksiBerandaController::class, 'profile'])->name('direksi.beranda.profile');
    Route::post('/beranda/profile/update_profile/{id}', [DireksiBerandaController::class, 'update_profile'])->name('direksi.beranda.update_profile');

    Route::get('/supplier', [DireksiSupplierController::class, 'index'])->name('direksi.supplier');
    Route::get('/supplier/add_supplier', [DireksiSupplierController::class, 'add_supplier'])->name('direksi.supplier.add_supplier');
    Route::post('/supplier/save_supplier', [DireksiSupplierController::class, 'save_supplier'])->name('direksi.supplier.save_supplier');
    Route::get('/supplier/edit_supplier/{id}', [DireksiSupplierController::class, 'edit_supplier'])->name('direksi.supplier.edit_supplier');
    Route::post('/supplier/update_supplier/{id}', [DireksiSupplierController::class, 'update_supplier'])->name('direksi.supplier.update_supplier');
    Route::get('/supplier/delete_supplier/{id}', [DireksiSupplierController::class, 'delete_supplier'])->name('direksi.supplier.delete_supplier');

    // Route untuk Reimbursement
    Route::get('/reimbursement', [DireksiReimbursementController::class, 'index'])->name('direksi.reimbursement');
    Route::get('/reimbursement/view_reimbursement/{id}', [DireksiReimbursementController::class, 'view_reimbursement'])->name('direksi.reimbursement.view_reimbursement');
    Route::get('/reimbursement/print_reimbursement/{id}', [DireksiReimbursementController::class, 'print_reimbursement'])->name('direksi.reimbursement.print_reimbursement');
    Route::get('/reimbursement/print_bukti_reimbursement/{id}', [DireksiReimbursementController::class, 'print_bukti_reimbursement'])->name('direksi.reimbursement.print_bukti_reimbursement');
    Route::get('/reimbursement/setujui_reimbursement/{id}', [DireksiReimbursementController::class, 'setujui_reimbursement'])->name('direksi.reimbursement.setujui_reimbursement');
    Route::post('/reimbursement/tolak_reimbursement/{id}', [DireksiReimbursementController::class, 'tolak_reimbursement'])->name('direksi.reimbursement.tolak_reimbursement');

    // Route untuk Direksi buat Reimbursement Baru
    Route::get('/reimbursement/tambah_RB', [DireksiReimbursementController::class, 'tambah_RB'])->name('direksi.reimbursement.tambah_RB');
    Route::post('/reimbursement/simpan_RB', [DireksiReimbursementController::class, 'simpan_RB'])->name('direksi.reimbursement.simpan_RB');

    Route::get('/reimbursement/getNomor', [DireksiReimbursementController::class, 'getNomor'])->name('direksi.reimbursement.getNomor');

    // Route untuk Cash Advance
    Route::get('/cash_advance', [CashAdvanceController::class, 'index'])->name('direksi.cash_advance');
    Route::get('/cash_advance/view_cash_advance/{id}', [CashAdvanceController::class, 'view_cash_advance'])->name('direksi.cash_advance.view_cash_advance');
    Route::get('/cash_advance/view_CAR/{id}', [CashAdvanceController::class, 'view_CAR'])->name('direksi.cash_advance.view_CAR');
    Route::get('/cash_advance/setujui_cash_advance/{id}', [CashAdvanceController::class, 'setujui_cash_advance'])->name('direksi.cash_advance.setujui_cash_advance');
    Route::post('/cash_advance/tolak_cash_advance/{id}', [CashAdvanceController::class, 'tolak_cash_advance'])->name('direksi.cash_advance.tolak_cash_advance');

    // Route untuk tambah CA
    Route::get('/cash_advance/tambah_CA', [CashAdvanceController::class, 'tambah_CA'])->name('direksi.cash_advance.tambah_CA');
    Route::post('/cash_advance/simpan_CA', [CashAdvanceController::class, 'simpan_CA'])->name('direksi.cash_advance.simpan_CA');

    Route::get('/cash_advance/getNomor', [CashAdvanceController::class, 'getNomor'])->name('direksi.cash_advance.getNomor');

    // Route untuk Cash Advance Report
    Route::get('/cash_advance_report', [DireksiCashAdvanceReportController::class, 'index'])->name('direksi.cash_advance_report');
    Route::get('/cash_advance_report/view_cash_advance_report/{id}', [DireksiCashAdvanceReportController::class, 'view_cash_advance_report'])->name('direksi.cash_advance_report.view_cash_advance_report');
    Route::get('/cash_advance_report/view_CA/{id}', [DireksiCashAdvanceReportController::class, 'view_CA'])->name('direksi.CAR.view_CA');
    Route::post('/cash_advance_report/paid_CAR/{id}', [DireksiCashAdvanceReportController::class, 'paid_CAR'])->name('direksi.CAR.paid_CAR');
    Route::get('/cash_advance_report/print_bukti_cash_advance_report/{id}', [DireksiCashAdvanceReportController::class, 'print_bukti_cash_advance_report'])->name('direksi.cash_advance_report.print_bukti_cash_advance_report');
    Route::get('/cash_advance_report/setujui_cash_advance_report/{id}', [DireksiCashAdvanceReportController::class, 'setujui_cash_advance_report'])->name('direksi.cash_advance_report.setujui_cash_advance_report');
    Route::post('/cash_advance_report/tolak_cash_advance_report/{id}', [DireksiCashAdvanceReportController::class, 'tolak_cash_advance_report'])->name('direksi.cash_advance_report.tolak_cash_advance_report');

    // Route untuk dapatkan nominal CA
    Route::get('cash_advance_report/get-nominal', [DireksiCashAdvanceReportController::class, 'getNominal'])->name('direksi.CAR.getNominal');

    // Route untuk tambah CAR
    Route::get('/cash_advance_report/tambah_CAR', [DireksiCashAdvanceReportController::class, 'tambah_CAR'])->name('direksi.cash_advance_report.tambah_CAR');
    Route::post('/cash_advance_report/simpan_CAR', [DireksiCashAdvanceReportController::class, 'simpan_CAR'])->name('direksi.cash_advance_report.simpan_CAR');

    // Route untuk Purchase Request
    Route::get('/purchase_request', [DireksiPurchaseRequestController::class, 'index'])->name('direksi.purchase_request');
    Route::get('/purchase_request/view_PR/{id}', [DireksiPurchaseRequestController::class, 'view_PR'])->name('direksi.purchase_request.view_PR');
    Route::get('/purchase_request/view_PO/{id}', [DireksiPurchaseRequestController::class, 'view_PO'])->name('direksi.PR.view_PO');
    Route::get('/purchase_request/setujui_PR/{id}', [DireksiPurchaseRequestController::class, 'setujui_PR'])->name('direksi.purchase_request.setujui_PR');
    Route::post('/purchase_request/tolak_PR/{id}', [DireksiPurchaseRequestController::class, 'tolak_PR'])->name('direksi.purchase_request.tolak_PR');

    // Route untuk buat PR
    Route::get('/purchase_request/tambah_PR', [DireksiPurchaseRequestController::class, 'tambah_PR'])->name('direksi.purchase_request.tambah_PR');
    Route::post('/purchase_request/simpan_PR', [DireksiPurchaseRequestController::class, 'simpan_PR'])->name('direksi.purchase_request.simpan_PR');

    // Route untuk Purchase Order
    Route::get('/purchase_order', [DireksiPurchaseOrderController::class, 'index'])->name('direksi.purchase_order');
    Route::get('/purchase_order/view_PO/{id}', [DireksiPurchaseOrderController::class, 'view_PO'])->name('direksi.purchase_order.view_PO');
    Route::get('/purchase_order/view_PR/{id}', [DireksiPurchaseOrderController::class, 'view_PR'])->name('direksi.purchase_order.view_PR');
    Route::get('/purchase_order/setujui_PO/{id}', [DireksiPurchaseOrderController::class, 'setujui_PO'])->name('direksi.purchase_order.setujui_PO');
    Route::post('/purchase_order/tolak_PO/{id}', [DireksiPurchaseOrderController::class, 'tolak_PO'])->name('direksi.purchase_order.tolak_PO');

    Route::get('/get-data-by-supplier', [DireksiPurchaseOrderController::class, 'getDataBySupplier'])->name('direksi.getDataBySupplier');
    Route::get('/admin/getDetailByTipePR', [DireksiPurchaseOrderController::class, 'getDataByPR'])->name('direksi.getDetailByTipePR');

    // Route untuk Direksi tambah PO
    Route::get('/purchase_order/tambah_PO', [DireksiPurchaseOrderController::class, 'tambah_PO'])->name('direksi.purchase_order.tambah_PO');
    Route::post('/purchase_order/simpan_PO', [DireksiPurchaseOrderController::class, 'simpan_PO'])->name('direksi.purchase_order.simpan_PO');

    // Route untuk Membuat Laporan RB
    Route::get('/report/RB', [RBController::class, 'index'])->name('direksi.RB.report_RB');
    Route::post('/report/search_date_RB', [RBController::class, 'search_date'])->name('direksi.RB.search_date_RB');
    // Route untuk Membuat Laporan CA
    Route::get('/report/CA', [CAController::class, 'index'])->name('direksi.CA.report_CA');
    Route::post('/report/search_date_CA', [CAController::class, 'search_date'])->name('direksi.CA.search_date_CA');
    // Route untuk Membuat Laporan CAR
    Route::get('/report/CAR', [CARController::class, 'index'])->name('direksi.CAR.report_CAR');
    Route::post('/report/search_date_CAR', [CARController::class, 'search_date'])->name('direksi.CAR.search_date_CAR');
    // Route untuk Membuat Laporan PR
    Route::get('/report/PR', [PRController::class, 'index'])->name('direksi.PR.report_PR');
    Route::post('/report/search_date_PR', [PRController::class, 'search_date'])->name('direksi.PR.search_date_PR');
    // Route untuk Membuat Laporan PO
    Route::get('/report/PO', [POController::class, 'index'])->name('direksi.PO.report_PO');
    Route::post('/report/search_date_PO', [POController::class, 'search_date'])->name('direksi.PO.search_date_PO');
});
Route::prefix('kasir')->middleware(['kasir'])->group(function () {
    Route::get('/beranda', [KasirBerandaController::class, 'index'])->name('kasir.beranda');
    Route::get('/beranda/profile', [KasirBerandaController::class, 'profile'])->name('kasir.beranda.profile');
    Route::post('/beranda/update_profile/{id}', [KasirBerandaController::class, 'update_profile'])->name('kasir.beranda.update_profile');

    // Route untuk RB
    Route::get('/reimbursement', [KasirReimbursementController::class, 'index'])->name('kasir.reimbursement');
    Route::get('/reimbursement/bulan', [KasirReimbursementController::class, 'search_by_month'])->name('kasir.reimbursement.bulan');
    Route::get('/reimbursement/view_reimbursement/{id}', [KasirReimbursementController::class, 'view_reimbursement'])->name('kasir.reimbursement.view_reimbursement');
    Route::get('/reimbursement/edit_RB/{id}', [KasirReimbursementController::class, 'edit_RB'])->name('kasir.reimbursement.edit_RB');
    Route::post('/reimbursement/update_doc_RB/{id}', [KasirReimbursementController::class, 'update_doc_RB'])->name('kasir.reimbursement.update_doc_RB');
    Route::get('/reimbursement/delete_RB/{id}', [KasirReimbursementController::class, 'delete_RB'])->name('kasir.reimbursement.delete_RB');
    Route::get('/reimbursement/print_reimbursement/{id}', [KasirReimbursementController::class, 'print_reimbursement'])->name('kasir.reimbursement.print_reimbursement');
    Route::get('/reimbursement/print_bukti_reimbursement/{id}', [KasirReimbursementController::class, 'print_bukti_reimbursement'])->name('kasir.reimbursement.print_bukti_reimbursement');
    Route::get('/reimbursement/excel_reimbursement/{id}', [KasirReimbursementController::class, 'excel_reimbursement'])->name('kasir.reimbursement.excel_reimbursement');

    Route::get('/reimbursement/bayar_reimbursement/{id}', [KasirReimbursementController::class, 'bayar_reimbursement'])->name('kasir.reimbursement.bayar_reimbursement');
    Route::post('/reimbursement/paid_reimbursement/{id}', [KasirReimbursementController::class, 'paid_RB'])->name('kasir.reimbursement.paid_RB');

    Route::get('/reimbursement/getNomor', [KasirReimbursementController::class, 'getNomor'])->name('kasir.reimbursement.getNomor');

    // Route untuk tambah RB bagian Finance
    Route::get('/reimbursement/tambah_RB', [KasirReimbursementController::class, 'tambah_RB'])->name('kasir.reimbursement.tambah_RB');
    Route::post('/reimbursement/simpan_RB', [KasirReimbursementController::class, 'simpan_RB'])->name('kasir.reimbursement.simpan_RB');

    // Route untuk membuat laporan RB
    Route::get('/report/RB', [ReportReportRBController::class, 'index'])->name('kasir.reimbursement.reportRB');
    Route::post('/report/RB/search_RB', [ReportReportRBController::class, 'search_date'])->name('kasir.reimbursement.searchRB');

    // Route untuk CA 
    Route::get('/cash_advance', [KasirCashAdvanceController::class, 'index'])->name('kasir.cash_advance');
    Route::get('/cash_advance/view_cash_advance/{id}', [KasirCashAdvanceController::class, 'view_cash_advance'])->name('kasir.cash_advance.view_cash_advance');
    Route::get('/cash_advance/view_CAR/{id}', [KasirCashAdvanceController::class, 'view_CAR'])->name('kasir.cash_advance.view_CAR');
    Route::get('/cash_advance/print_cash_advance/{id}', [KasirCashAdvanceController::class, 'print_cash_advance'])->name('kasir.cash_advance.print_cash_advance');
    Route::get('/cash_advance/excel_cash_advance/{id}', [KasirCashAdvanceController::class, 'excel_cash_advance'])->name('kasir.cash_advance.excel_cash_advance');

    Route::get('/cash_advance/bayar_cash_advance/{id}', [KasirCashAdvanceController::class, 'bayar_cash_advance'])->name('kasir.cash_advance.bayar_cash_advance');
    Route::post('/cash_advance/paid_CA/{id}', [KasirCashAdvanceController::class, 'paid_CA'])->name('kasir.cash_advance.paid_CA');

    // Route untuk tambah CA bagian Finance
    Route::get('/cash_advance/tambah_CA', [KasirCashAdvanceController::class, 'tambah_CA'])->name('kasir.cash_advance.tambah_CA');
    Route::post('/cash_advance/simpan_CA', [KasirCashAdvanceController::class, 'simpan_CA'])->name('kasir.cash_advance.simpan_CA');

    Route::get('/cash_advance/getNomor', [KasirCashAdvanceController::class, 'getNomor'])->name('kasir.cash_advance.getNomor');

    // Route untuk membuat laporan CA
    Route::get('/report/CA', [ReportReportCAController::class, 'index'])->name('kasir.CA.reportCA');
    Route::post('/report/CA/search_CA', [ReportReportCAController::class, 'search_date'])->name('kasir.CA.searchCA');

    // Route untuk CAR
    Route::get('/cash_advance_report', [KasirCashAdvanceReportController::class, 'index'])->name('kasir.cash_advance_report');
    Route::get('/cash_advance_report/view_cash_advance_report/{id}', [KasirCashAdvanceReportController::class, 'view_cash_advance_report'])->name('kasir.cash_advance_report.view_cash_advance_report');
    Route::get('/cash_advance_report/view_CA/{id}', [KasirCashAdvanceReportController::class, 'view_CA'])->name('kasir.cash_advance_report.view_CA');
    Route::get('/cash_advance_report/print_cash_advance_report/{id}', [KasirCashAdvanceReportController::class, 'print_cash_advance_report'])->name('kasir.cash_advance_report.print_cash_advance_report');
    Route::get('/cash_advance_report/print_bukti_cash_advance_report/{id}', [KasirCashAdvanceReportController::class, 'print_bukti_cash_advance_report'])->name('kasir.cash_advance_report.print_bukti_cash_advance_report');
    Route::get('/cash_advance_report/excel_cash_advance_report/{id}', [KasirCashAdvanceReportController::class, 'excel_cash_advance_report'])->name('kasir.cash_advance_report.excel_cash_advance_report');

    Route::get('/cash_advance_report/bayar_cash_advance_report/{id}', [KasirCashAdvanceReportController::class, 'bayar_cash_advance_report'])->name('kasir.cash_advance_report.bayar_cash_advance_report');
    Route::post('/cash_advance_report/paid_CAR/{id}', [KasirCashAdvanceReportController::class, 'paid_CAR'])->name('kasir.cash_advance_report.paid_CAR');

    // Route untuk Finance yang mau bayar dengan total kurang 0
    Route::get('/CAR/paid_CAR/{id}', [KasirCashAdvanceReportController::class, 'done_CAR'])->name('kasir.CAR.done_CAR');
    // Route untuk tambah CAR bagian Finance
    Route::get('/cash_advance_report/tambah_CAR', [KasirCashAdvanceReportController::class, 'tambah_CAR'])->name('kasir.cash_advance_report.tambah_CAR');
    Route::post('/cash_advance_report/simpan_CAR', [KasirCashAdvanceReportController::class, 'simpan_CAR'])->name('kasir.cash_advance_report.simpan_CAR');

    // Route untuk mendapatkan data dari CA
    Route::get('cash_advance_report/get-nominal', [KasirCashAdvanceReportController::class, 'getNominal'])->name('kasir.CAR.getNominal');

    // Route untuk membuat laporan CAR 
    Route::get('/report/CAR', [ReportReportCARController::class, 'index'])->name('kasir.CAR.reportCAR');
    Route::post('/report/CAR/search_CAR', [ReportReportCARController::class, 'search_date'])->name('kasir.CAR.searchCAR');
    // Route untuk PR
    Route::get('/purchase_request', [KasirPurchaseRequestController::class, 'index'])->name('kasir.purchase_request');
    Route::get('/purchase_request/excel_PR/{id}', [KasirPurchaseRequestController::class, 'excel_PR'])->name('kasir.purchase_request.excel_PR');
    Route::get('/purchase_request/view_PR/{id}', [KasirPurchaseRequestController::class, 'view_PR'])->name('kasir.purchase_request.view_PR');
    Route::get('/purchase_request/view_PO/{id}', [KasirPurchaseRequestController::class, 'view_PO'])->name('kasir.purchase_request.view_PO');
    Route::get('/purchase_request/print_PR/{id}', [KasirPurchaseRequestController::class, 'print_PR'])->name('kasir.purchase_request.print_PR');
    Route::get('/purchase_request/bayar_PR/{id}', [KasirPurchaseRequestController::class, 'bayar_PR'])->name('kasir.purchase_request.bayar_PR');
    Route::post('/purchase_request/paid_PR/{id}', [KasirPurchaseRequestController::class, 'paid_PR'])->name('kasir.purchase_request.paid_PR');

    // Route untuk tambah PR bagian Finance 
    Route::get('/purchase_request/tambah_PR', [KasirPurchaseRequestController::class, 'tambah_PR'])->name('kasir.purchase_request.tambah_PR');
    Route::post('/purchase_request/simpan_PR', [KasirPurchaseRequestController::class, 'simpan_PR'])->name('kasir.purchase_request.simpan_PR');

    // Route untuk membuat laporan PR
    Route::get('/report/PR', [ReportReportPRController::class, 'index'])->name('kasir.PR.reportPR');
    Route::post('/report/PR/search_PR', [ReportReportPRController::class, 'search_date'])->name('kasir.PR.searchPR');
    // Route untuk PO
    Route::get('/purchase_order', [KasirPurchaseOrderController::class, 'index'])->name('kasir.purchase_order');
    Route::get('/purchase_order/excel_PO/{id}', [KasirPurchaseOrderController::class, 'excel_PO'])->name('kasir.purchase_order.excel_PO');
    Route::get('/purchase_order/view_PO/{id}', [KasirPurchaseOrderController::class, 'view_PO'])->name('kasir.purchase_order.view_PO');
    Route::get('/purchase_order/view_PR/{id}', [KasirPurchaseOrderController::class, 'view_PR'])->name('kasir.purchase_order.view_PR');
    Route::get('/purchase_order/print_PO/{id}', [KasirPurchaseOrderController::class, 'print_PO'])->name('kasir.purchase_order.print_PO');
    Route::get('/purchase_order/bayar_PO/{id}', [KasirPurchaseOrderController::class, 'bayar_PO'])->name('kasir.purchase_order.bayar_PO');
    Route::post('/purchase_order/paid_PO/{id}', [KasirPurchaseOrderController::class, 'paid_PO'])->name('kasir.purchase_order.paid_PO');

    // Route untuk tambah PO bagian Finance
    Route::get('/purchase_order/tambah_PO', [KasirPurchaseOrderController::class, 'tambah_PO'])->name('kasir.purchase_order.tambah_PO');
    Route::post('/purchase_order/simpan_PO', [KasirPurchaseOrderController::class, 'simpan_PO'])->name('kasir.purchase_order.simpan_PO');

    Route::get('/get-data-by-supplier', [KasirPurchaseOrderController::class, 'getDataBySupplier'])->name('kasir.getDataBySupplier');
    Route::get('/admin/getDetailByTipePR', [KasirPurchaseOrderController::class, 'getDataByPR'])->name('kasir.getDetailByTipePR');

    // Route untuk membuat laporan PO
    Route::get('/report/PO', [ReportReportPOController::class, 'index'])->name('kasir.PO.reportPO');
    Route::post('/report/PO/search_PO', [ReportReportPOController::class, 'search_date'])->name('kasir.PO.searchPO');
});
