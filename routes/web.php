<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Portal;
use App\Http\Controllers\V2;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['UserNoAuth'])->group(function () {
    Route::get('register', [Portal\RegisterController::class, 'index'])->name('portal.register');
    Route::post('check/user', [Portal\RegisterController::class, 'checkUserData'])->name('portal.register.check.user');
    Route::post('check/company', [Portal\RegisterController::class, 'checkCompanyData'])->name('portal.register.check.company');
    Route::post('check/code', [Portal\RegisterController::class, 'checkCode'])->name('portal.register.check.code');
    Route::post('code/resend', [Portal\RegisterController::class, 'codeResend'])->name('portal.register.resend.code');
    Route::post('password/create', [Portal\RegisterController::class, 'CreatePassword'])->name('portal.register.password.create');

    Route::get('login', [Auth\LoginController::class, 'index'])->name('portal.login');
    Route::post('login/number/check', [Auth\LoginController::class, 'checkNumber'])->name('portal.login.number.check');
    Route::post('login/submit', [Auth\LoginController::class, 'login'])->name('portal.login.submit');

    Route::get('password/forget/by', [Auth\ForgetPasswordController::class, 'by'])->name('portal.password.forget.by');
    Route::get('password/forget', [Auth\ForgetPasswordController::class, 'index'])->name('portal.password.forget');
    Route::get('password/forget/mobile', [Auth\ForgetPasswordController::class, 'indexByMobile'])->name('portal.password.forget.mobile');
    Route::get('password/forget/email', [Auth\ForgetPasswordController::class, 'indexByEmail'])->name('portal.password.forget.email');
    Route::post('password/code/request', [Auth\ForgetPasswordController::class, 'requestCode'])->name('portal.password.code.request');
    Route::post('password/code/verify', [Auth\ForgetPasswordController::class, 'verifyCode'])->name('portal.password.code.verify');

    Route::get('account/activation', [Auth\AccountActivateController::class, 'index'])->name('portal.account.activate.index');
    Route::post('account/activation/code/request', [Auth\AccountActivateController::class, 'requestCode'])->name('portal.account.activate.code.request');
    Route::post('account/activation/code/check', [Auth\AccountActivateController::class, 'checkCode'])->name('portal.account.activate.code.check');
});

Route::middleware(['UserAuth'])->group(function () {

    //profile
    Route::get('profile', [Portal\ProfileController::class, 'index'])->name('portal.profile.index');
    Route::get('profile/edit', [Portal\ProfileController::class, 'edit'])->name('portal.profile.edit');
    Route::post('profile/update', [Portal\ProfileController::class, 'update'])->name('portal.profile.update');
    Route::post('profile/phone/update', [Portal\ProfileController::class, 'updatePhone'])->name('portal.profile.phone.update');
    Route::post('profile/password/change', [Portal\ProfileController::class, 'changePassword'])->name('portal.profile.password.change');

    Route::middleware(['UserPassword'])->group(function () {
        Route::get('/', [Portal\HomeController::class, 'index'])->name('portal.home');
        Route::post('/loans/get', [Portal\HomeController::class, 'getLoans'])->name('portal.loans.get');

        Route::post('calculate/currencies/get', [Portal\CalculatorController::class, 'getCurrencies'])->name('portal.calculate.currencies.get');
        Route::post('calculate/money/get', [Portal\CalculatorController::class, 'getMoneyRange'])->name('portal.calculate.money.get');
        Route::post('calculate/time/get', [Portal\CalculatorController::class, 'getTimeRange'])->name('portal.calculate.time.get');
        Route::post('calculate', [Portal\CalculatorController::class, 'calculate'])->name('portal.calculate');

        Route::get('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('portal.logout');

        //programs
        Route::get('/programs', [Portal\ProgramController::class, 'index'])->name('portal.programs.index');
        Route::get('/programs/{id}', [Portal\ProgramController::class, 'show'])->name('portal.programs.show');
        Route::post('/programs/product/details', [Portal\ProgramController::class, 'productDetails'])->name('portal.programs.product.details');

        //constants
        Route::post('states/fetch', [Portal\ConstantsController::class, 'fetchStates'])->name('portal.states.fetch');
        Route::post('cities/fetch', [Portal\ConstantsController::class, 'fetchCities'])->name('portal.cities.fetch');
        Route::post('company-activities/fetch', [Portal\ConstantsController::class, 'fetchActivities'])->name('portal.company-activities.fetch');

        //company pages
        Route::get('company/info', [Portal\Company\InfoController::class, 'index'])->name('portal.company.info.index');
        Route::get('company/info/edit', [Portal\Company\InfoController::class, 'edit'])->name('portal.company.info.edit');
        Route::post('company/info/update', [Portal\Company\InfoController::class, 'update'])->name('portal.company.info.update');

        Route::get('company/contact', [Portal\Company\ContactController::class, 'index'])->name('portal.company.contact.index');
        Route::get('company/contact/edit', [Portal\Company\ContactController::class, 'edit'])->name('portal.company.contact.edit');
        Route::post('company/contact/update', [Portal\Company\ContactController::class, 'update'])->name('portal.company.contact.update');

        Route::get('company/partner', [Portal\Company\PartnerController::class, 'index'])->name('portal.company.partner.index');
        Route::get('company/partner/add', [Portal\Company\PartnerController::class, 'add'])->name('portal.company.partner.add.index');
        Route::get('company/partner/add/person', [Portal\Company\PartnerController::class, 'addPerson'])->name('portal.company.partner.add.person');
        Route::post('company/partner/store/person', [Portal\Company\PartnerController::class, 'storePerson'])->name('portal.company.partner.store.person');
        Route::get('company/partner/edit/person/{id}', [Portal\Company\PartnerController::class, 'editPerson'])->name('portal.company.partner.edit.person');
        Route::post('company/partner/update/person', [Portal\Company\PartnerController::class, 'updatePerson'])->name('portal.company.partner.update.person');
        Route::get('company/partner/add/firm', [Portal\Company\PartnerController::class, 'addFirm'])->name('portal.company.partner.add.firm');
        Route::post('company/partner/store/firm', [Portal\Company\PartnerController::class, 'storeFirm'])->name('portal.company.partner.store.firm');
        Route::get('company/partner/edit/firm/{id}', [Portal\Company\PartnerController::class, 'editFirm'])->name('portal.company.partner.edit.firm');
        Route::post('company/partner/update/firm', [Portal\Company\PartnerController::class, 'updateFirm'])->name('portal.company.partner.update.firm');
        Route::post('company/partner/delete', [Portal\Company\PartnerController::class, 'delete'])->name('portal.company.partner.delete');
        Route::post('company/partner/is-borrower', [Portal\Company\PartnerController::class, 'isBorrower'])->name('portal.company.partner.is-borrower');

        Route::get('company/board-members', [Portal\Company\BoardController::class, 'index'])->name('portal.company.board.index');
        Route::post('company/board-members/store', [Portal\Company\BoardController::class, 'store'])->name('portal.company.board.store');
        Route::post('company/board-members/update', [Portal\Company\BoardController::class, 'update'])->name('portal.company.board.update');
        Route::post('company/board-members/delete', [Portal\Company\BoardController::class, 'delete'])->name('portal.company.board.delete');
        Route::post('company/board-members/no-member', [Portal\Company\BoardController::class, 'noMember'])->name('portal.company.board.no-member');

        Route::get('company/management', [Portal\Company\ManagementController::class, 'index'])->name('portal.company.management.index');
        Route::post('company/management/store', [Portal\Company\ManagementController::class, 'store'])->name('portal.company.management.store');
        Route::post('company/management/update', [Portal\Company\ManagementController::class, 'update'])->name('portal.company.management.update');
        Route::post('company/management/delete', [Portal\Company\ManagementController::class, 'delete'])->name('portal.company.management.delete');
        Route::post('company/management/search', [Portal\Company\ManagementController::class, 'search'])->name('portal.company.management.search');

        Route::get('company/acknowledgement', [Portal\Company\AcknowledgementController::class, 'index'])->name('portal.company.acknowledgement.index');
        Route::get('company/acknowledgement/edit', [Portal\Company\AcknowledgementController::class, 'edit'])->name('portal.company.acknowledgement.store');
        Route::post('company/acknowledgement/update', [Portal\Company\AcknowledgementController::class, 'update'])->name('portal.company.acknowledgement.update');

        Route::get('company/activity/description', [Portal\Company\ActivityDescriptionController::class, 'index'])->name('portal.company.activity.description.index');
        Route::get('company/activity/description/edit', [Portal\Company\ActivityDescriptionController::class, 'edit'])->name('portal.company.activity.description.edit');
        Route::post('company/activity/description/update', [Portal\Company\ActivityDescriptionController::class, 'update'])->name('portal.company.activity.description.update');
        Route::post('company/activity/description/sell/store', [Portal\Company\ActivityDescriptionController::class, 'storeSellWay'])->name('portal.company.activity.description.sell.store');
        Route::post('company/activity/description/sell/update', [Portal\Company\ActivityDescriptionController::class, 'updateSellWay'])->name('portal.company.activity.description.sell.update');
        Route::post('company/activity/description/sell/delete', [Portal\Company\ActivityDescriptionController::class, 'deleteSellWay'])->name('portal.company.activity.description.sell.delete');

        Route::get('company/activity/selling', [Portal\Company\ActivitySellingController::class, 'index'])->name('portal.company.activity.selling.index');
        Route::get('company/activity/selling/edit', [Portal\Company\ActivitySellingController::class, 'edit'])->name('portal.company.activity.selling.edit');
        Route::post('company/activity/selling/store', [Portal\Company\ActivitySellingController::class, 'store'])->name('portal.company.activity.selling.store');
        Route::post('company/activity/selling/update', [Portal\Company\ActivitySellingController::class, 'update'])->name('portal.company.activity.selling.update');
        Route::post('company/activity/selling/delete', [Portal\Company\ActivitySellingController::class, 'delete'])->name('portal.company.activity.selling.delete');
        Route::post('company/activity/selling/policy/store', [Portal\Company\ActivitySellingController::class, 'storePolicy'])->name('portal.company.activity.selling.policy.store');
        Route::post('company/activity/selling/policy/update', [Portal\Company\ActivitySellingController::class, 'updatePolicy'])->name('portal.company.activity.selling.policy.update');
        Route::post('company/activity/selling/policy/delete', [Portal\Company\ActivitySellingController::class, 'deletePolicy'])->name('portal.company.activity.selling.policy.delete');

        Route::get('company/activity/buying', [Portal\Company\ActivityBuyingController::class, 'index'])->name('portal.company.activity.buying.index');
        Route::get('company/activity/buying/edit', [Portal\Company\ActivityBuyingController::class, 'edit'])->name('portal.company.activity.buying.edit');
        Route::post('company/activity/buying/store', [Portal\Company\ActivityBuyingController::class, 'store'])->name('portal.company.activity.buying.store');
        Route::post('company/activity/buying/update', [Portal\Company\ActivityBuyingController::class, 'update'])->name('portal.company.activity.buying.update');
        Route::post('company/activity/buying/delete', [Portal\Company\ActivityBuyingController::class, 'delete'])->name('portal.company.activity.buying.delete');
        Route::post('company/activity/buying/policy/store', [Portal\Company\ActivityBuyingController::class, 'storePolicy'])->name('portal.company.activity.buying.policy.store');
        Route::post('company/activity/buying/policy/update', [Portal\Company\ActivityBuyingController::class, 'updatePolicy'])->name('portal.company.activity.buying.policy.update');
        Route::post('company/activity/buying/policy/delete', [Portal\Company\ActivityBuyingController::class, 'deletePolicy'])->name('portal.company.activity.buying.policy.delete');

        Route::get('company/activity/competitors', [Portal\Company\ActivityCompetitorsController::class, 'index'])->name('portal.company.activity.competitors.index');
        Route::post('company/activity/competitors/store', [Portal\Company\ActivityCompetitorsController::class, 'store'])->name('portal.company.activity.competitors.store');
        Route::post('company/activity/competitors/update', [Portal\Company\ActivityCompetitorsController::class, 'update'])->name('portal.company.activity.competitors.update');
        Route::post('company/activity/competitors/delete', [Portal\Company\ActivityCompetitorsController::class, 'delete'])->name('portal.company.activity.competitors.delete');
        Route::post('company/activity/competitors/no-member', [Portal\Company\ActivityCompetitorsController::class, 'noMember'])->name('portal.company.activity.competitors..no-member');

        Route::get('company/notes', [Portal\Company\NoteController::class, 'index'])->name('portal.company.note.index');
        Route::get('company/notes/edit', [Portal\Company\NoteController::class, 'edit'])->name('portal.company.note.edit');
        Route::post('company/notes/update', [Portal\Company\NoteController::class, 'update'])->name('portal.company.note.update');

        //request loan pages
        Route::get('loan-request', [Portal\RequestLoan\RequestLoanController::class, 'index'])->name('portal.loan-request.index');
        Route::get('loan-request/{id}/edit', [Portal\RequestLoan\RequestLoanController::class, 'edit'])->name('portal.loan-request.edit');
        Route::get('loan-request/{id}/duplicate', [Portal\RequestLoan\RequestLoanController::class, 'duplicate'])->name('portal.loan-request.duplicate');

        Route::post('loan-request/program/fetch', [Portal\RequestLoan\MainInfoController::class, 'fetchProgram'])->name('portal.loan-request.program.fetch');
        Route::post('loan-request/purpose/fetch', [Portal\RequestLoan\MainInfoController::class, 'fetchPurpose'])->name('portal.loan-request.purpose.fetch');
        Route::post('loan-request/address/get', [Portal\RequestLoan\MainInfoController::class, 'getAddress'])->name('portal.loan-request.address.get');
        Route::post('loan-request/main-info/store', [Portal\RequestLoan\MainInfoController::class, 'store'])->name('portal.loan-request.main-info.store');
        Route::post('loan-request/main-info/update', [Portal\RequestLoan\MainInfoController::class, 'update'])->name('portal.loan-request.main-info.update');

        Route::post('loan-request/fund-source/store', [Portal\RequestLoan\PaymentSourceController::class, 'fundSource'])->name('portal.loan-request.fund-source.store');
        Route::post('loan-request/fund-source/delete', [Portal\RequestLoan\PaymentSourceController::class, 'fundSourceDelete'])->name('portal.loan-request.fund-source.delete');

        Route::post('loan-request/fund-source-desc/store', [Portal\RequestLoan\PaymentSourceController::class, 'fundSourceDesc'])->name('portal.loan-request.fund-desc.store');
        Route::post('loan-request/fund-source-desc/delete', [Portal\RequestLoan\PaymentSourceController::class, 'fundSourceDescDelete'])->name('portal.loan-request.fund-desc.delete');

        Route::post('loan-request/warranty/store', [Portal\RequestLoan\WarrantyController::class, 'store'])->name('portal.loan-request.warranty.store');
        Route::post('loan-request/warranty/delete', [Portal\RequestLoan\WarrantyController::class, 'delete'])->name('portal.loan-request.warranty.delete');

        Route::post('loan-request/guarantee/store', [Portal\RequestLoan\GuaranteeController::class, 'store'])->name('portal.loan-request.guarantee.store');
        Route::post('loan-request/guarantee/delete', [Portal\RequestLoan\GuaranteeController::class, 'delete'])->name('portal.loan-request.guarantee.delete');

        Route::post('loan-request/financial-info/store', [Portal\RequestLoan\FinancialInfoController::class, 'store'])->name('portal.loan-request.financial-info.store');
        Route::post('loan-request/income-financial-info/store', [Portal\RequestLoan\FinancialInfoController::class, 'storeIncome'])->name('portal.loan-request.income-financial-info.store');

        Route::post('loan-request/attachments/store', [Portal\RequestLoan\AttachmentController::class, 'store'])->name('portal.loan-request.attachments.store');
        Route::post('loan-request/attachments/delete', [Portal\RequestLoan\AttachmentController::class, 'delete'])->name('portal.loan-request.attachments.delete');
        Route::post('loan-request/attachments/submit', [Portal\RequestLoan\AttachmentController::class, 'submit'])->name('portal.loan-request.attachments.submit');

        //my orders pages
        Route::get('orders', [Portal\OrderController::class, 'index'])->name('portal.orders.index');
        Route::post('orders/get', [Portal\OrderController::class, 'getFund'])->name('portal.orders.fund.get');
        Route::post('orders/comment/add', [Portal\OrderController::class, 'addComment'])->name('portal.orders.comment.add');
        Route::post('orders/cancel', [Portal\OrderController::class, 'cancel'])->name('portal.orders.cancel');
        Route::get('orders/{id}/print', [Portal\OrderController::class, 'print'])->name('portal.orders.print');

        //my loans pages
        Route::get('loans', [Portal\LoanController::class, 'index'])->name('portal.loans.index');
        Route::get('loans/{id}/installments', [Portal\LoanController::class, 'show'])->name('portal.loans.show');
        Route::get('loans/{id}/installments/print', [Portal\LoanController::class, 'print'])->name('portal.loans.print');

        //currencies page
        Route::get('currencies', [Portal\CurrenciesController::class, 'index'])->name('portal.currencies.index');
        Route::post('currencies/update', [Portal\CurrenciesController::class, 'updateCurrenciesData'])->name('portal.currencies.update');
        Route::get('GetCurrenciesData', [Portal\CurrenciesController::class, 'GetCurrenciesData'])->name('portal.currencies.GetCurrenciesData');
        Route::post('currencyExchange', [Portal\CurrenciesController::class, 'currencyExchange'])->name('portal.currencyExchange');

        //technical support pages
        Route::get('technicalSupport', [Portal\TechnicalSupportController::class, 'index'])->name('portal.technicalSupport.index');
    });
});

Route::prefix('v2')->middleware(['UserAuth'])->group(function () {
    Route::match(['get', 'post'], '/', [V2\HomeController::class, 'index'])->name('portal.v2.home');
    Route::post('deposits/calculate', [V2\CalculatorController::class, 'getDepositRange'])->name('portal.v2.deposit.calculate');
    Route::post('interest/calculate', [V2\CalculatorController::class, 'calculate'])->name('portal.v2.calculate');
    Route::get('logout', [Auth\LoginController::class, 'logout'])->name('portal.v2.logout');

    //constants
    Route::post('bank/branches/get', [V2\ConstantsController::class, 'bankBranches'])->name('portal.v2.bank.branches');

    //profile
    Route::get('profile', [V2\ProfileController::class, 'index'])->name('portal.v2.profile.index');
    Route::post('profile/password/change', [V2\ProfileController::class, 'changePassword'])->name('portal.v2.profile.password.change');
    Route::get('profile/edit', [V2\ProfileController::class, 'edit'])->name('portal.v2.profile.edit');
    Route::post('profile/update', [V2\ProfileController::class, 'update'])->name('portal.v2.profile.update');
    Route::post('profile/phone/update', [V2\ProfileController::class, 'updatePhone'])->name('portal.v2.profile.phone.update');

    //company pages
    Route::get('company/info', [V2\Company\InfoController::class, 'index'])->name('portal.v2.company.info.index');
    Route::get('company/contact', [V2\Company\ContactController::class, 'index'])->name('portal.v2.company.contact.index');

    //beneficiaries pages
    Route::match(['get', 'post'], 'beneficiaries', [V2\BeneficiariesController::class, 'index'])->name('portal.v2.beneficiaries.index');
    Route::post('beneficiaries/show', [V2\BeneficiariesController::class, 'show'])->name('portal.v2.beneficiaries.details');
    Route::get('beneficiaries/create', [V2\BeneficiariesController::class, 'create'])->name('portal.v2.beneficiaries.create');
    Route::get('beneficiaries/{id}/edit', [V2\BeneficiariesController::class, 'edit'])->name('portal.v2.beneficiaries.edit');
    Route::post('beneficiaries/submit', [V2\BeneficiariesController::class, 'storeOrUpdate'])->name('portal.v2.beneficiaries.submit');
    Route::post('/beneficiaries/delete', [V2\BeneficiariesController::class, 'delete'])->name('portal.v2.beneficiaries.delete');

    //transfers pages
    Route::match(['get', 'post'], 'transfers', [V2\TransfersController::class, 'index'])->name('portal.v2.transfers.index');
    Route::post('transfers/show', [V2\TransfersController::class, 'show'])->name('portal.v2.transfers.details');
    Route::get('transfers/create', [V2\TransfersController::class, 'create'])->name('portal.v2.transfers.create');
    Route::post('transfers/check', [V2\TransfersController::class, 'GetTransferSummary'])->name('portal.v2.transfers.check');
    Route::post('transfers/submit', [V2\TransfersController::class, 'store'])->name('portal.v2.transfers.submit');
    Route::post('transfers/excel/print', [V2\TransfersController::class, 'print'])->name('portal.v2.transfers.print');
    Route::post('transfers/pdf/print', [V2\TransfersController::class, 'pdfPrint'])->name('portal.v2.transfers.pdf.print');

    //deposits pages
    Route::get('deposits', [V2\DepositsController::class, 'index'])->name('portal.v2.deposits.index');
    Route::get('deposits/{id}/show', [V2\DepositsController::class, 'show'])->name('portal.v2.deposits.show');
    Route::get('deposits/create', [V2\DepositsController::class, 'create'])->name('portal.v2.deposits.create');
    Route::post('deposits/getAccounts', [V2\DepositsController::class, 'GetAccounts'])->name('portal.v2.deposits.accounts.get');
    Route::post('deposits/numToText', [V2\DepositsController::class, 'numToText'])->name('portal.v2.deposits.numToText');
    Route::post('deposits/submit', [V2\DepositsController::class, 'store'])->name('portal.v2.deposits.submit');

    Route::post('deposits/install', [V2\DepositActionsController::class, 'feeding'])->name('portal.v2.deposits.feeding');
    Route::post('deposits/break', [V2\DepositActionsController::class, 'break'])->name('portal.v2.deposits.break');

    //accounts pages
    Route::match(['get', 'post'], 'accounts', [V2\AccountsController::class, 'index'])->name('portal.v2.accounts.index');
    Route::get('accounts/{index}/details', [V2\AccountsController::class, 'show'])->name('portal.v2.accounts.show');
    Route::post('accounts/{index}/details/search', [V2\AccountsController::class, 'search'])->name('portal.v2.accounts.search');
    Route::get('accounts/{type}/print/{index?}', [V2\AccountsController::class, 'print'])->name('portal.v2.accounts.print');
    Route::post('accounts/comment/add', [V2\AccountsController::class, 'addComment'])->name('portal.v2.accounts.comment.add');

    //currencies page
    Route::get('currencies', [V2\CurrenciesController::class, 'index'])->name('portal.v2.currencies.index');
    Route::post('currencies/update', [V2\CurrenciesController::class, 'updateCurrenciesData'])->name('portal.v2.currencies.update');
    Route::post('currencyExchange', [V2\CurrenciesController::class, 'currencyExchange'])->name('portal.v2.currencyExchange');

    //technical support pages
    Route::match(['get', 'post'], 'tickets', [V2\TicketsController::class, 'index'])->name('portal.v2.tickets.index');
    Route::post('tickets/store', [V2\TicketsController::class, 'store'])->name('portal.v2.tickets.store');
    Route::get('tickets/{id}/show', [V2\TicketsController::class, 'show'])->name('portal.v2.tickets.show');
    Route::post('tickets/comment/store', [V2\TicketsController::class, 'storeComment'])->name('portal.v2.tickets.comment.store');

    //technical support pages
    Route::get('technicalSupport', [V2\TechnicalSupportController::class, 'index'])->name('portal.v2.technicalSupport.index');

    //checks pages
    Route::match(['get', 'post'], 'checks', [V2\ChecksController::class, 'index'])->name('portal.v2.checks.index');
    Route::post('checks/print', [V2\ChecksController::class, 'print'])->name('portal.v2.checks.print');
    Route::get('checks/create', [V2\ChecksController::class, 'create'])->name('portal.v2.checks.create');
    Route::post('checks/submit', [V2\ChecksController::class, 'store'])->name('portal.v2.checks.store');

    //orders pages
    Route::get('orders', [V2\OrdersController::class, 'index'])->name('portal.v2.orders.index');
    Route::post('orders/filter', [V2\OrdersController::class, 'filter'])->name('portal.v2.orders.filter');
    Route::post('orders/details', [V2\OrdersController::class, 'details'])->name('portal.v2.orders.details');
    Route::post('orders/reject', [V2\OrdersController::class, 'reject'])->name('portal.v2.orders.reject');
    Route::post('orders/transfers/print', [V2\OrdersController::class, 'print'])->name('portal.v2.orders.transfers.print');

    Route::post('orders/steps', [V2\OrdersStepController::class, 'getSteps'])->name('portal.v2.orders.steps');
    Route::post('orders/change', [V2\OrdersStepController::class, 'change'])->name('portal.v2.orders.change');
    Route::post('orders/undo', [V2\OrdersStepController::class, 'undo'])->name('portal.v2.orders.undo');
    Route::post('orders/return', [V2\OrdersStepController::class, 'return'])->name('portal.v2.orders.return');

    Route::get('orders/transfers/{seq}/edit', [V2\OrdersEditController::class, 'transfersEdit'])->name('portal.v2.orders.transfer.edit');
    Route::get('orders/beneficiaries/{seq}/edit', [V2\OrdersEditController::class, 'beneficiariesEdit'])->name('portal.v2.orders.beneficiaries.edit');
});

Route::get('/clear-all', function() {
    \Artisan::call('view:clear');
    \Artisan::call('route:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('config:cache');
    dd('done');
});
