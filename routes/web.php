<?php
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;
use App\EmailTemplate;
use App\Http\Controllers\LeaveController;
use App\Models\Leave;

Route::get('clear-cache', function () {
     \Artisan::call('route:clear');
      \Artisan::call('cache:clear');
       \Artisan::call('view:clear');

        dd(\Artisan::call('config:cache'));
});

Route::get('/verify/{user}/{phone}', function ($user,$phone) {
    return view('auth.verify')->with(['user'=>$user,'phone'=>$phone]);
})->name('verify')->middleware('signed');

Route::post('/code-verify','VerifyController@verifyCode')->name('code.verify');
Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');

Auth::routes();

Route::get('/', 'HomeController@index')->name('/');
Route::get('/new', 'HomeController@newIndex');

Route::get('crm-login', 'FrontendController@crmlogin');

Route::post('cubebooks/invoice-status','InvoiceController@invoiceStatus')->name('invoice.status');
Route::get('/invoice/show','InvoiceController@invoiceshow')->name('invoice-show');
Route::prefix('cubebooks')->group(function ()
{
    Route::middleware('auth')->group(function () 
    {
        
        

        /* ======================================================================= *
        /*    User Management   -------------------------------------------------- *
        ========================================================================== */
        Route::get('/user-profile', 'UserSettingsController@userProfile')->name('userProfile');
        Route::post('/update-user', 'UserSettingsController@updateUser')->name('updateUser');

        /* ======================================================================= *
        /*    Product Management   ----------------------------------------------- *
        ========================================================================== */
        Route::get('/products', 'ProductController@manageProduct')->name('products');
        Route::get('/ptaxinfo', 'ProductController@ptaxinfo')->name('catch.pactax');
        Route::post('/store-product', 'ProductController@storepro')->name('savepro');
        Route::get('/info-product/{id}', 'ProductController@infoProduct');
        Route::post('/update-product', 'ProductController@updateproduct')->name('updatepro');
        Route::get('/proinfo', 'ProductController@proInfoedit')->name('catchproinfo');


        // Old code
        Route::get('/staxinfo', 'ProductController@staxinfo')->name('catch.sactax');
        Route::post('/get-pro','ProductController@getPro')->name('productPro');
        Route::post('/count-pro','ProductController@proCount')->name('proCount');
        Route::post('/save-product','ProductController@saveProduct')->name('save.product');
        
        /* ======================================================================= *
        /*    Customer Management   ---------------------------------------------- *
        ========================================================================== */

        Route::get('/customers', 'CustomerController@manageCustomer')->name('customers');
        Route::post('/get-cust','CustomerController@getCust')->name('custPro');
        Route::post('/save-customer','CustomerController@saveCustomer')->name('saveCust');
        Route::get('/get-cust-info', 'CustomerController@customerInfo')->name('catch.customerInfo');
        Route::post('/update-customer', 'CustomerController@updateCustomer')->name('updateCustomer');
        Route::get('/inactive-customer', 'CustomerController@inactiveCustomer')->name('inactive.customer');

        Route::get('/inactive-cus-list', 'CustomerController@inactiveCustomers')->name('inactiveCustomers');
        Route::get('/active-customer', 'CustomerController@activeCustomer')->name('active.customer');

        /* ======================================================================= *
        /*    Suppliers Management   ---------------------------------------------- *
        ========================================================================== */

        Route::get('/suppliers','SupplierController@manageSupplier')->name('suppliers');
        Route::post('/save-supplier','SupplierController@saveSupplier')->name('saveSupplier');
        Route::get('/inactive-supplier', 'SupplierController@inactiveSupplier')->name('inactive.supplier');
        Route::get('/get-supp-info', 'SupplierController@supplierInfo')->name('catch.supplierInfo');
        Route::post('/update-supplier', 'SupplierController@updateSupplier')->name('updateSupplier');
        

        /* ======================================================================= *
        /*    Employee Management   ---------------------------------------------- *
        ========================================================================== */
        
        Route::get('/employee', 'EmployeeController@manageEmployee')->name('employee');
        Route::get('/add-employee','EmployeeController@add');
        Route::post('/save-employee','EmployeeController@store')->name('saveEmployee');
        Route::get('/get-emp-info', 'EmployeeController@employeeInfo')->name('catch.employeeInfo');
        Route::get('/edit-employee/{id}', 'EmployeeController@editEmployee');
        Route::post('/update-employee', 'EmployeeController@updateEmployee')->name('updateEmployee');
        
       
        
        /* ======================================================================= *
        /*    Payroll Management   ---------------------------------------------- *
        ========================================================================== */

        Route::resource('pays', PayController::class);
        Route::post('savePaySlip', [PayController::class, 'store']);
        Route::get('/pays', 'PayController@create')->name('pays');
        
        
        /* ======================================================================= *
        /*    Leave Management  -------------------------------------------------- *
        ========================================================================== */

        Route::resource('leaves', LeaveController::class);
        Route::get('approveLeave/{id}', [LeaveController::class ,'approveleave']);
        Route::get('/leaves', 'LeaveController@create')->name('leaves');


        /* ======================================================================= *
        /*    Invoices Management   ---------------------------------------------- *
        ========================================================================== */
        
        Route::get('/invoices','InvoiceController@manageInvoice')->name('invoices');
        Route::get('/add-invoice', 'InvoiceController@addInvoice')->name('add.invoice');
        Route::get('/catch-product', 'InvoiceController@catchProduct')->name('catch.product');
        Route::get('/catch-product-rate', 'InvoiceController@productRate')->name('catch.productRate');
        Route::get('/catch-product-acc', 'InvoiceController@productAcc')->name('catch.productAccount');
        Route::get('/catch-product-tax', 'InvoiceController@productTax')->name('catch.productTax');
        Route::get('/catch-product-taxAmount', 'InvoiceController@productTaxamount')->name('catch.productTaxamount');
        Route::get('/catch-actax', 'InvoiceController@catchAcTax')->name('chech.actax');
        Route::get('/catch-onlytax', 'InvoiceController@catchOnlytax')->name('chech.onlytax');
        Route::get('/catch-customer', 'InvoiceController@catchCustomer')->name('chech.customerInfo');
        Route::get('/catch-customerdue', 'InvoiceController@customerInfodue')->name('chech.customerInfodue');
        Route::get('/extraMorefield', 'InvoiceController@extraMorefield')->name('extraMorefield');
        Route::get('/update-invoice-status/{id}','InvoiceController@updateInvoiceStatus')->name('invoice-status');

        

        Route::get('/extraMorefieldname', 'InvoiceController@extraMorefieldname')->name('extraMorefieldname');
        
        Route::get('/extraMorefielddel', 'InvoiceController@extraMorefielddel')->name('extraMorefielddel');
        
        Route::get('/extraMorefielddeledit', 'InvoiceController@extraMorefielddeledit')->name('extraMorefielddeledit');
        Route::get('/chech.customerterms', 'InvoiceController@customerterms')->name('chech.customerterms');
        Route::get('/change.invdate', 'InvoiceController@changeInvDate')->name('change.invdate');

        Route::post('/store-inv-pro','InvoiceController@saveproInvoice')->name('saveproInvoice');
        Route::post('/store-inv-acc','InvoiceController@saveaccInvoice')->name('saveAccountInvoice');
        Route::post('/store-inv-tax','InvoiceController@savetaxInvoice')->name('savetaxInvoice');

        Route::post('/store-invoice', 'InvoiceController@storeInvoice')->name('store.invoice');
        Route::post('/store-invoice-ajax', 'InvoiceController@storeInvoiceAjax')->name('store.invoice.ajax');
        Route::post('/update-invoice-ajax', 'InvoiceController@updateInvoiceAjax')->name('update.invoice.ajax');

        Route::get('/update-invoice-print-status/{id}', 'InvoiceController@updateInvoicePrintStatus')->name('update.invoice.print');



        Route::post('/update-invoice', 'InvoiceController@updateInvoice')->name('update.invoice');

        Route::get('/edit-invoice/{id}', 'InvoiceController@editInvoice');
        Route::get('/view-invoice/{id}', 'InvoiceController@viewInvoice');
        Route::post('/store-inv-payment', 'InvoiceController@savePaymentInvoice')->name('savePaymentInvoice');

        Route::post('/invoice/email/send', 'InvoiceController@invoicesendmail')->name('invoice.send.email');

        Route::get('/catchInvInfo', 'InvoiceController@catchInvInfo')->name('catchInvInfo');
        Route::post('/invPrintPrev', 'InvoiceController@invPrintPrev')->name('invPrintPrev');

        Route::get('/sendinvmail', 'InvoiceController@sendinvmail')->name('sendinvmail');

        
        Route::get('/catch.invNumberup', 'InvoiceController@catchInvNumberup')->name('catch.invNumberup');

        Route::post('/saveSalesRep', 'InvoiceController@saveSalesRep')->name('saveSalesRep');

        /* ======================================================================= *
        /*    Expenses Management   ---------------------------------------------- *
        ========================================================================== */
        
        Route::get('/expenses','ExpenseController@manageExpense')->name('expenses');
        Route::get('/add-expense', 'ExpenseController@addExpense')->name('add.expense');
        Route::get('/catch-supp_product', 'ExpenseController@catchProduct')->name('catch.supp_product');
        Route::get('/catch-supp_product-rate', 'ExpenseController@productRate')->name('catch.supp_productRate');
        Route::get('/catch-supp_product-acc', 'ExpenseController@productAcc')->name('catch.supp_productAccount');
        Route::get('/catch-supplier', 'ExpenseController@catchSupplier')->name('chech.supplierInfo');
        Route::post('/store-expense', 'ExpenseController@storeExpense')->name('store.expense');
        Route::post('/store-expense-pro','ExpenseController@saveproExpense')->name('saveproExpense');
        Route::get('/edit-expense/{id}', 'ExpenseController@editExpense');
        Route::post('/update-expense', 'ExpenseController@updateExpense')->name('update.expense');
        Route::get('/view-expense/{id}', 'ExpenseController@viewExpense');
        Route::post('/store-exp-payment', 'ExpenseController@savePaymentExpense')->name('savePaymentExpense');

        /* ======================================================================= *
        /*    Account Management   ----------------------------------------------- *
        ========================================================================== */
        Route::get('/get-account', 'AccountController@getAccount')->name('account');
        Route::post('/save-account', 'AccountController@saveAccount')->name('saveAccount');
        Route::get('/catch-accinfo', 'AccountController@catchAccinfo')->name('catch.accinfo');
        Route::get('/catch-accnumber', 'AccountController@catchAcNumber')->name('catch.acNumber');
        Route::get('/catch-accnumberup', 'AccountController@catchAcNumberup')->name('catch.acNumberup');

        Route::get('/get-accinfo', 'AccountController@getAccInfo')->name('get.accinfo');

        Route::post('/update-account', 'AccountController@updateAcc')->name('updateAccount');
        Route::get('/general-ledger', 'AccountController@generalLedger')->name('general.ledger');
        Route::get('/search-general-ledger', 'AccountController@searchGeneralLedger')->name('search.ledger');
        
        Route::post('/create-budget', 'BudgetController@store')->name('budget.store');
        Route::post('/update-budget', 'BudgetController@update')->name('budget.update');
        Route::post('/get-variance', 'BudgetController@getVariance')->name('budget.getvariance');
        Route::get('/getbudget', 'BudgetController@getBudget')->name('budget.getbudget');
        Route::get('/budget-variance', 'BudgetController@variance')->name('budget.variance');

        /* ======================================================================= *
        /*    Settings Management   ---------------------------------------------- *
        ========================================================================== */
        
        Route::get('/tax','SetupController@tax')->name('tax.setup');
        Route::post('/save-tax','SetupController@taxSave')->name('savetax');

        Route::get('/invoice-setup', 'SetupController@invSetup')->name('invoice.setup');
        Route::get('/catch.invNumber', 'SetupController@CatchInvNumber')->name('catch.invNumber');
        Route::post('/update-inv', 'SetupController@updateInv')->name('updateinv');
        Route::get('/company-setup', 'SetupController@companySetup')->name('company.setup');
        Route::post('/updateComSetup', 'SetupController@updateCom')->name('updateComSetup');

        Route::get('/smtp-setup', 'SetupController@smtpSetup')->name('smtp.setup');
        Route::post('/update-smtp', 'SetupController@updateSmtp')->name('update.smtp');
        Route::get('/check-issmtp/{status}', 'SetupController@checkIssmtp')->name('check-issmtp');

         /* ======================================================================= *
        /*    Reports Management   -------------------------------------------------- *
        ========================================================================== */

        Route::get('reports', 'ReportController@index')->name('reports');
        Route::get('customer-statements', 'ReportController@customerstatment')->name('customer.statment');
        Route::post('create-statement', 'ReportController@createstatement')->name('customer.statment.create');


        
        /* ======================================================================= *
        /*    Email Template Management   ---------------------------------------------- *
        ========================================================================== */
        Route::get('/emailtemplate', 'EmailTemplatesController@index')->name('emailtemplate.index');
        Route::post('/emailtemplate', 'EmailTemplatesController@store')->name('emailtemplate.store');
        Route::post('/emailtemplate/edit', 'EmailTemplatesController@edit')->name('emailtemplate.edit');
        Route::post('/emailtemplate/update', 'EmailTemplatesController@update')->name('emailtemplate.update');
        Route::post('/emailtemplate/delete', 'EmailTemplatesController@destroy')->name('emailtemplate.delete');



        Route::get('/emailschedules', 'EmailSchedulesController@index')->name('emailschedules.index');
        Route::get('/emailschedules/create/{invoice_ids}', 'EmailSchedulesController@create')->name('emailschedules.create');
        Route::post('/emailschedules/create', 'EmailSchedulesController@store')->name('emailschedules.store');
        Route::post('/emailschedules/edit', 'EmailSchedulesController@edit')->name('emailschedules.edit');
        Route::post('/emailschedules/update', 'EmailSchedulesController@update')->name('emailschedules.update');
        Route::post('/emailschedules/delete', 'EmailSchedulesController@destroy')->name('emailschedules.delete');
        //Route::resource('/emailschedules', 'EmailSchedulesController');
        
        
        
        
        /* ======================================================================= *
        /*    Bank Management   -------------------------------------------------- *
        ========================================================================== */

        Route::get('/bank-category', 'BankController@bankCat')->name('bankCat');
        Route::post('/save-bank-cat', 'BankController@savebankCat')->name('saveBankCat');
        Route::post('/update-bank-cat', 'BankController@updateBankCat')->name('updateBankCat');

        Route::get('/bank-list', 'BankController@bankList')->name('bankList');
        Route::post('/save-bank', 'BankController@saveBank')->name('saveBank');
        Route::get('/catch-bank-info', 'BankController@catchBankInfo')->name('catchBankInfo');
        Route::post('/update-bank', 'BankController@updateBank')->name('updateBank');
        Route::get('/delete_bank', 'BankController@deleteBank')->name('deleteBank');
        Route::POST('/delete-bank-transaction', 'BankController@deleteBankTransaction')->name('deleteBankTransaction');
        Route::POST('/delete-bank-transaction-many', 'BankController@deleteManyBankTransaction')->name('deleteManyBankTransaction');
        Route::get('/search-bank-transaction', 'BankController@searchBankTransaction')->name('searchBankTransaction');


        Route::get('/bank-transaction', 'BankController@bank_transaction')->name('bank_transaction');
        Route::post('/bank-transaction-selection', 'BankController@getBankTansactionSelection')->name('bank_transaction_selection');
        Route::post('/save-bankcsv', 'BankController@savebankcsv')->name('savebankcsv');
        Route::post('/save-transactions', 'BankController@saveTransactions')->name('saveTransactions');
        Route::post('/reviewedselected-transactions', 'BankController@markSelectedAsReviewed')->name('reviewedSelectedTransactions');
        Route::post('/reviewedall-transactions', 'BankController@markAllAsReviewed')->name('reviewedAllTransactions');
        Route::post('/unreviewedselected-transactions', 'BankController@markSelectedAsUnReviewed')->name('unreviewedSelectedTransactions');
        Route::post('/unreviewedall-transactions', 'BankController@markAllAsUnReviewed')->name('unreviewedAllTransactions');


    });
});