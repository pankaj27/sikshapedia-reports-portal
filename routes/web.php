<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MouController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\RoleController;
//use App\Http\Controllers\backend\ClosingReports;
use App\Http\Controllers\backend\VisitReports;
use App\Http\Controllers\backend\CallingReports;
use App\Http\Controllers\backend\MailController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\ProposalReports;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\backend\CourseController;
use App\Http\Controllers\backend\ModulesController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\AppointmentReports;
use App\Http\Controllers\backend\ProposalController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\backend\OnboardingController;
use App\Http\Controllers\backend\CallRegisterController;
use App\Http\Controllers\backend\VisitRegisterController;
use App\Http\Controllers\backend\BookAppointmentController;
use App\Http\Controllers\backend\GeneralSettingsController;
use App\Http\Controllers\backend\MemorandamOfUnderstanding;
use App\Http\Controllers\backend\VisitorManageentController;
use App\Http\Controllers\backend\VisitorManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LoginRegisterController::class, 'index']);

Route::post('/uploadFile', [MouController::class, 'indexNewP'])->name('uploadFile');
Route::get('/mou/{id}', [MouController::class, 'index'])->name('upload-mou');
Route::get('/mou', [MouController::class, 'indexNew'])->name('view-mou');
Route::get('/success', [MouController::class, 'success'])->name('success-mou');

Route::post('/generate-link', [LinkController::class, 'create'])->name('generate-mou-upload-link');
Route::post('/store', [LinkController::class, 'store'])->name('link.store');
Route::get('/{shortUrl}', [LinkController::class, 'show'])->name('link.show');



Route::get('/admin', [LoginRegisterController::class, 'index'])->name('login');
Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    //Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::post('/generate-proposal', [ProposalController::class, 'generatePdf'])->name('proposal.generatepdf');
    
    Route::post('/generate-bills', [ProposalController::class, 'generateBillPdf'])->name('bills.generatepdf');


    Route::post('/generate-mou', [ProposalController::class, 'generateMouPdf'])->name('mou.generatepdf');

    Route::get('/generate-mou-get', [ProposalController::class, 'generateMouPdfget'])->name('mou.generatepdfd');

    Route::post('/generate-invoice', [ProposalController::class, 'generateInvoicePdf'])->name('closeDeal.generateInvoice');

    Route::get('/generate-invoice-get', [ProposalController::class, 'generateInvoicePdfGet'])->name('closeDeal.generateInvoicePdf');



    Route::post('/get-payment_option', [ProposalController::class, 'getPaymentOption'])->name('get-payment_option');

    Route::post('/get-product-cost', [ProposalController::class, 'getProductCost'])->name('get-product-cost');


    
    //user creation & its routes
    Route::group(['prefix' => '/users'], function () {

        Route::get('/', [UserController::class, 'index'])->name('users.list');
        Route::get('/add', [UserController::class, 'create'])->name('users.add');
        Route::post('/store', [UserController::class, 'store'])->name('users.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::patch('/{id}/update', [UserController::class, 'update'])->name('users.update');
        Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    });

     //user creation & its routes
     Route::group(['prefix' => '/visitor-management'], function () {

        Route::get('/', [VisitorManagementController::class, 'index'])->name('visitor-management.list');
        Route::get('/add', [VisitorManagementController::class, 'create'])->name('visitor-management.add');
        Route::post('/store', [VisitorManagementController::class, 'store'])->name('visitor-management.store');
        Route::post('/storeAgentData', [VisitorManagementController::class, 'storeAgentData'])->name('visitor-management.store-agent-data');
        Route::get('/{id}/edit', [VisitorManagementController::class, 'edit'])->name('visitor-management.edit');
        Route::patch('/{id}/update', [VisitorManagementController::class, 'update'])->name('visitor-management.update');
        Route::delete('/delete/{id}', [VisitorManagementController::class, 'destroy'])->name('visitor-management.destroy');

    });

     //Onboarding & its routes
     Route::group(['prefix' => '/onboarding'], function () {

        Route::get('/', [OnboardingController::class, 'index'])->name('onboarding.list');
        Route::get('/get-onboarding', [OnboardingController::class, 'onBoardingData'])->name('onboarding.list.view');
        Route::get('/approve', [OnboardingController::class, 'create'])->name('onboarding.approve');
        Route::post('/rejected', [OnboardingController::class, 'store'])->name('onboarding.rejected');
        

    });

    //user creation & its routes
    Route::group(['prefix' => '/call-register'], function () {

        Route::get('/', [CallRegisterController::class, 'index'])->name('call-register.list');
        Route::get('/add', [CallRegisterController::class, 'create'])->name('call-register.add');
        Route::post('/store', [CallRegisterController::class, 'store'])->name('call-register.store');
        Route::post('/storeAgentData', [CallRegisterController::class, 'storeAgentData'])->name('call-register.store-agent-data');
        Route::get('/{id}/edit', [CallRegisterController::class, 'edit'])->name('call-register.edit');
        Route::patch('/{id}/update', [CallRegisterController::class, 'update'])->name('call-register.update');
        Route::delete('/delete/{id}', [CallRegisterController::class, 'destroy'])->name('call-register.destroy');

        Route::post('/updatestatus', [CallRegisterController::class, 'updateStatus'])->name('call-register.updatestatus');



    });

    //user creation & its routes
    Route::group(['prefix' => '/visit-register'], function () {

        Route::get('/', [VisitRegisterController::class, 'index'])->name('visit-register.list');
        Route::get('/add', [VisitRegisterController::class, 'create'])->name('visit-register.add');
        Route::post('/store', [VisitRegisterController::class, 'store'])->name('visit-register.store');
        Route::post('/storeAgentData', [VisitRegisterController::class, 'storeAgentData'])->name('visit-register.store-agent-data');
        Route::get('/{id}/edit', [VisitRegisterController::class, 'edit'])->name('visiter-register.edit');
        Route::patch('/{id}/update', [VisitRegisterController::class, 'update'])->name('visit-register.update');
        Route::delete('/delete/{id}', [VisitRegisterController::class, 'destroy'])->name('visit-register.destroy');

        Route::get('/details-visit-report/{slug}', [VisitRegisterController::class, 'detailVisitReport'])->name('details-visit-report');

        Route::post('/get-district-details', [VisitRegisterController::class, 'getDistrictDetails'])->name('get-district-details');


        Route::post('/send-proposal', [ProposalController::class, 'sendProposal'])->name('send-proposal');
        
        Route::post('/send-complete-deal', [ProposalController::class, 'sendCompleteDeal'])->name('send-complete-deal');

        Route::post('/send-mou', [ProposalController::class, 'sendMou'])->name('send-mou');

        Route::post('/send-invoice', [ProposalController::class, 'sendInvoice'])->name('send-invoice');
        
        
         
         Route::post('/updatestatus', [VisitRegisterController::class, 'updateStatus'])->name('visit-register.updatestatus');





    });


    //user creation & its routes
    Route::group(['prefix' => '/book-appointment'], function () {

        Route::get('/', [BookAppointmentController::class, 'index'])->name('book-appointment.list');
        Route::get('/add', [BookAppointmentController::class, 'create'])->name('book-appointment.add');
        Route::post('/store', [BookAppointmentController::class, 'store'])->name('book-appointment.store');
        Route::post('/storeAgentData', [BookAppointmentController::class, 'storeAgentData'])->name('book-appointment.store-agent-data');
        Route::get('/{id}/edit', [BookAppointmentController::class, 'edit'])->name('book-appointment.edit');
        Route::patch('/{id}/update', [BookAppointmentController::class, 'update'])->name('book-appointment.update');
        Route::delete('/delete/{id}', [BookAppointmentController::class, 'destroy'])->name('book-appointment.destroy');
        Route::post('/get-institute-details', [BookAppointmentController::class, 'getInstituteDetails'])->name('get-institute-details');

    });


    Route::group(['prefix' => '/reports'], function () {

        Route::group(['prefix' => '/calling-report'], function () {
            Route::get('/', [CallingReports::class, 'index'])->name('reports.calling-reports.list');
            Route::post('/get-user-details', [CallingReports::class, 'getUserDetails'])->name('reports.user.list');
            Route::post('/get-details-calling-report', [CallingReports::class, 'getDetailsCallingReport'])->name('reports.details.list');
        });
        Route::group(['prefix' => '/visiting-report'], function () {
            Route::get('/', [VisitReports::class, 'index'])->name('reports.visiting-reports.list');
            Route::post('/get-details-appointment-report', [VisitReports::class, 'getDetailVistingReport'])->name('reports.visitingreport.list');
            
        });
        Route::group(['prefix' => '/appointment-reports'], function () {
            Route::get('/', [AppointmentReports::class, 'index'])->name('reports.appointment-reports.list');
            Route::post('/get-details-appointment-report', [AppointmentReports::class, 'getDetailAppointmentReport'])->name('reports.appointment.list');
        });
        Route::group(['prefix' => '/proposal-reports'], function () {
            Route::get('/', [ProposalReports::class, 'index'])->name('reports.proposal-reports.list');
            Route::post('/get-details-proposal-report', [ProposalReports::class, 'getDetailProposalReport'])->name('reports.proposal-send.list');
        });
        // Route::group(['prefix' => '/closing-reports'], function () {
        //     Route::get('/', [ClosingReports::class, 'index'])->name('reports.closing-reports.list');
        // });

    });

    Route::group(['prefix' => '/settings'], function () {

        Route::group(['prefix' => '/general'], function () {

            Route::get('/', [GeneralSettingsController::class, 'index'])->name('general-settings');
            Route::post('/store', [GeneralSettingsController::class, 'store'])->name('store-general-settings');
            Route::get('/{id}/edit', [GeneralSettingsController::class, 'edit'])->name('general-settings.edit');
            Route::post('/update', [GeneralSettingsController::class, 'update'])->name('update-general-settings');
            Route::delete('/delete/{id}', [GeneralSettingsController::class, 'destroy'])->name('general-settings.destroy');

        });

        Route::group(['prefix' => '/roles'], function () {

            Route::get('/', [GeneralSettingsController::class, 'roles'])->name('roles-settings');
            Route::get('/add', [RoleController::class, 'create'])->name('admin.addUserRole');
            Route::post('/store', [RoleController::class, 'store'])->name('admin.addUserRole');
            Route::get('/edit/{$id}', [RoleController::class, 'edit'])->name('roles.edit');
            Route::post('/update', [RoleController::class, 'update'])->name('admin.updateUserRole');
            Route::post('/delete/{$id}', [RoleController::class, 'destroy'])->name('roles.destroy');

        });


        Route::group(['prefix' => '/smtp'], function () {

            Route::get('/', [GeneralSettingsController::class, 'smtp'])->name('smtp-settings');            
            Route::post('/update', [MailController::class, 'update'])->name('update-smtp-settings');
            Route::post('/send', [MailController::class, 'send'])->name('send-smtp-test-mail');
           

        });

        Route::group(['prefix' => '/product'], function () {

            Route::get('/', [GeneralSettingsController::class, 'product'])->name('product-settings');
            Route::get('/add', [GeneralSettingsController::class, 'createProduct'])->name('create-product');
            Route::post('/store', [GeneralSettingsController::class, 'storeProduct'])->name('store-product');
            Route::get('/{id}/edit', [GeneralSettingsController::class, 'editProduct'])->name('product.edit');
            Route::post('/update', [GeneralSettingsController::class, 'updateProduct'])->name('product.update');
            Route::delete('/delete/{id}', [GeneralSettingsController::class, 'destroyProduct'])->name('product.delete');

        });


        Route::group(['prefix' => '/modules'], function () {

            Route::get('/', [ModulesController::class, 'index'])->name('modules-settings');
            Route::post('/modules/store', [ModulesController::class, 'store'])->name('store-system-module');
            Route::get('/modules/edit/{$id}', [ModulesController::class, 'edit'])->name('system-settings.modules.edit');
            Route::post('/modules/update', [ModulesController::class, 'update'])->name('update-system-modules');
            Route::delete('/modules/delete/{$id}', [ModulesController::class, 'destroy'])->name('delete-system-modules');

        });

        Route::group(['prefix' => '/mou'], function () {

            Route::get('/', [GeneralSettingsController::class, 'mouIndex'])->name('mou-settings');
            Route::post('/mou/store', [GeneralSettingsController::class, 'mouStore'])->name('store-mou-settings');
            Route::get('/mou/edit/{$id}', [GeneralSettingsController::class, 'mouEdit'])->name('system-settings.mou.edit');
            Route::post('/mou/update', [GeneralSettingsController::class, 'mouUpdate'])->name('update-mou-modules');
            Route::post('/delete/{$id}', [GeneralSettingsController::class, 'mouDestroy'])->name('mou.destroy');

        });

    });


    
    
    

    
    

    Route::group(['prefix' => '/roles'], function () {

        Route::get('/', [RoleController::class, 'index'])->name('admin.userRoleList');
        Route::get('/add', [RoleController::class, 'create'])->name('admin.addUserRole');
        Route::post('/store', [RoleController::class, 'store'])->name('admin.addUserRole');
        Route::get('/edit/{$id}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::post('/update', [RoleController::class, 'update'])->name('admin.updateUserRole');
        Route::post('/delete/{$id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    });


    Route::group(['prefix' => '/system-modules'], function () {

        Route::get('/', [ModulesController::class, 'index'])->name('system-modules');
        Route::post('/store', [ModulesController::class, 'store'])->name('store-system-module');
        Route::get('/{id}/edit', [ModulesController::class, 'edit'])->name('system-modules.edit');
        Route::post('/update', [ModulesController::class, 'update'])->name('update-system-modules');
        Route::delete('/delete/{id}', [ModulesController::class, 'destroy'])->name('system-modules.destroy');

    });

    Route::group(['prefix' => '/settings'], function () {

        Route::group(['prefix' => '/general-settings'], function () {

            Route::get('/', [GeneralSettingsController::class, 'index'])->name('general-settings');
            Route::post('/store', [GeneralSettingsController::class, 'store'])->name('store-general-settings');
            Route::get('/{id}/edit', [GeneralSettingsController::class, 'edit'])->name('general-settings.edit');
            Route::post('/update', [GeneralSettingsController::class, 'update'])->name('update-general-settings');
            Route::delete('/delete/{id}', [GeneralSettingsController::class, 'destroy'])->name('general-settings.destroy');

        });

    });
    
});



Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', CourseController::class);
});
