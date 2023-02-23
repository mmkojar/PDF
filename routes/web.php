<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\WeightController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\MilkCollectionController;
use App\Http\Controllers\Customer\MilkSoldController;
use App\Http\Controllers\Salve\SalveController;
use App\Http\Controllers\Expenses\RentController;
use App\Http\Controllers\Expenses\GeneralIncomeController;
use App\Http\Controllers\Expenses\MedicalController;
use App\Http\Controllers\Expenses\FoodController;
use App\Http\Controllers\Expenses\ManageCategoryController;
use App\Http\Controllers\Expenses\ExpenseController;
use App\Http\Controllers\Billing\BillingController;
use App\Http\Controllers\Days\DaysController;
use App\Http\Controllers\Processing\ProcessingController;
use App\Http\Controllers\Processing\MedicalCheckupcontroller;
use App\Http\Controllers\Processing\PregnantController;
use App\Http\Controllers\Processing\ReportController;
use App\Http\Controllers\Location\Khilla_location;
use App\Http\Controllers\Stock\StockController;
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

// Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['disablebackbtn'])->group(function () {

    Route::name('dashboard')->group(function() {
        Route::get('/', [DashboardController::class,'index']);
        Route::get('/dashboard', [DashboardController::class,'index']);
    });
    
    Route::prefix('attendance')->group(function() {
        Route::get('/', [AttendanceController::class,'index'])->name('attendance.index');
        Route::post('/store', [AttendanceController::class,'store'])->name('attendance.store');
        Route::get('/api', [AttendanceController::class,'month_wise_data'])->name('attendance.api');
    });

    Route::delete('/employee/delete/{id}', [EmployeeController::class,'delete'])->name('employee.delete');
    Route::resource('/employee', EmployeeController::class)->except(['show','destroy','create']);

    Route::get('/common/api/{name}/{tbl}/{col}', [CommonController::class,'unique_name'])->name('common.api');
    Route::get('/notifications', [CommonController::class,'index'])->name('common.index');

    Route::delete('/weight/delete/{id}', [WeightController::class,'delete'])->name('weight.delete');
    Route::post('/weight/store', [WeightController::class,'store'])->name('weight.store');
    Route::get('/weight/{id}/edit', [WeightController::class,'edit'])->name('weight.edit');
    Route::get('/weight', [WeightController::class,'index'])->name('weight.index');
    // Route::post('/import', [WeightController::class,'import_excel'])->name('weight.import');

    // Products Reports
    Route::get('/reports', [ReportController::class,'index'])->name('report.index');
    
    // Product Stoock
    Route::get('/product_stock', [ProductController::class,'stock'])->name('product.stock');
    Route::get('/product_stock/create', [ProductController::class,'create_stock'])->name('product.stock.create');
    Route::post('/product/stock/store', [ProductController::class,'store_stock'])->name('product.stock.store');
    Route::delete('/product/stock/delete/{id}', [ProductController::class,'delete_stock'])->name('product.stock.delete');
    Route::get('/product_stock/{id}/edit', [ProductController::class,'edit_stock'])->name('product.stock.edit');
    Route::put('/product/stock/update/{product}', [ProductController::class,'update_stock'])->name('product.stock.update');
    Route::get('/product/stock/api/{id}', [ProductController::class,'khilla_api'])->name('product.stock.api');
    Route::get('/product/stock/pkl_api', [ProductController::class,'pkl_api'])->name('product.stock.pkl_api');
    Route::get('/product/api/{id}', [ProductController::class,'unique_prod_no'])->name('location.api');
    
    Route::delete('/product/delete/{id}', [ProductController::class,'delete'])->name('product.delete');
    Route::resource('/categories', ProductController::class)->except(['show','create','update','destroy']);
    
    Route::delete('/customer/delete/{id}', [CustomerController::class,'delete'])->name('customer.delete');
    Route::resource('/customer', CustomerController::class)->except(['show','destroy','create']);

    // Route::delete('/collection/delete/{id}', [MilkCollectionController::class,'delete'])->name('collection.delete');
    // Route::resource('/milk_collection', MilkCollectionController::class)->except(['show','destroy']);
    Route::get('/milk_collection', [MilkCollectionController::class,'index'])->name('milk_collection.index');
    Route::get('/milk_collection/internal', [MilkCollectionController::class,'internal'])->name('milk_collection.internal');
    Route::get('/milk_collection/external', [MilkCollectionController::class,'external'])->name('milk_collection.external');
    Route::put('/external_collection/update/{date}', [MilkCollectionController::class,'update'])->name('milk_collection.update');
    Route::get('/external_collection/{id}/edit/{cid?}', [MilkCollectionController::class,'edit'])->name('milk_collection.edit');
    Route::get('/external_collection/create', [MilkCollectionController::class,'create'])->name('milk_collection.create');
    Route::post('/external_collection/store', [MilkCollectionController::class,'store'])->name('milk_collection.store');

    Route::get('/sold/api', [MilkSoldController::class,'sold_api'])->name('sold.api');
    Route::delete('/sold/delete/{id}', [MilkSoldController::class,'delete'])->name('sold.delete');
    Route::resource('/milk_entries', MilkSoldController::class)->except(['show','destroy']);

    Route::get('/salve/transfer', [SalveController::class,'transfer'])->name('salve.transfer');
    Route::get('/salve/transfer/create', [SalveController::class,'create_transfer'])->name('salve.transfer.create');
    Route::post('/salve/transfer/store', [SalveController::class,'store_transfer'])->name('salve.transfer.store');
    Route::delete('/salve/transfer/delete/{id}', [SalveController::class,'delete_transfer'])->name('salve.transfer.delete');
    Route::get('/salve/transfer/{id}/edit', [SalveController::class,'edit_transfer'])->name('salve.transfer.edit');
    Route::put('/salve/transfer/update/{salve}', [SalveController::class,'update_transfer'])->name('salve.transfer.update');
    Route::get('/salve/api/{id}', [SalveController::class,'stock_api'])->name('salve.api');

    Route::delete('/salve/delete/{id}', [SalveController::class,'delete'])->name('salve.delete');
    Route::resource('/salves', SalveController::class)->except(['show','destroy']);

    Route::delete('/rent/delete/{id}', [RentController::class,'delete'])->name('rent.delete');
    Route::resource('/rent', RentController::class)->except(['show','destroy']);

    Route::delete('/general_income/delete/{id}', [GeneralIncomeController::class,'delete'])->name('general_income.delete');
    Route::resource('/income_expense', GeneralIncomeController::class)->except(['show','destroy']);

    Route::delete('/expense/delete/{id}', [ExpenseController::class,'delete'])->name('expense.delete');
    Route::resource('/expense', ExpenseController::class)->except(['show','destroy']);

    Route::delete('/medical/delete/{id}', [MedicalController::class,'delete'])->name('medical.delete');
    Route::resource('/medical', MedicalController::class)->except(['show','destroy']);

    // For Food used
    Route::delete('/food/delete/{id}', [FoodController::class,'delete'])->name('food.delete');
    Route::get('/food/stockUse/balqty/{item}', [FoodController::class,'get_bal_qty'])->name('food.stock.api');    
    Route::get('/food/stockUse/create', [FoodController::class,'food_use_create'])->name('food.stock.create');
    Route::get('/food/stockUse/{id}/edit', [FoodController::class,'food_use_edit'])->name('food.stock.edit');
    Route::put('/food/stockUse/update/{data}', [FoodController::class,'food_use_update'])->name('food.stock.update');
    Route::post('/food/stockUse/store', [FoodController::class,'food_use_store'])->name('food.stock.store');
    Route::delete('/food/stockUse/delete/{id}', [FoodController::class,'delete_food_use'])->name('food.stock.delete');
    // For Food Amount
    Route::get('/food/amount/api/{id}', [FoodController::class,'food_amount_api'])->name('food.amountpaid.api');
    Route::get('/food/amount/create', [FoodController::class,'food_amount_create'])->name('food.amountpaid.create');
    /*Route::get('/food/amount/{id}/edit', [FoodController::class,'food_amount_edit'])->name('food.amountpaid.edit');
    Route::put('/food/amount/update/{data}', [FoodController::class,'food_amount_update'])->name('food.amountpaid.update');*/
    Route::post('/food/amount/store', [FoodController::class,'food_amount_store'])->name('food.amountpaid.store');
    /* Route::delete('/food/amount/delete/{id}', [FoodController::class,'delete_food_use'])->name('food.amountpaid.delete');*/
    // For Food Stock
    Route::resource('/food', FoodController::class)->except(['show','destroy']);
    
    // For Category Management Amount
    Route::get('/category_management/amount/api/{id}', [ManageCategoryController::class,'cat_manage_amount_api'])->name('cat_manage.amount.api');
    Route::get('/category_management/amount/create', [ManageCategoryController::class,'cat_manage_amount_create'])->name('cat_manage.amount.create');
    Route::post('/category_management/amount/store', [ManageCategoryController::class,'cat_manage_amount_store'])->name('cat_manage.amount.store');
    // For Category Management
    Route::resource('/category_management', ManageCategoryController::class)->except(['show','destroy','edit','update']);

    // Days
    Route::get('/days', [DaysController::class,'index'])->name('days.index');
    Route::post('/days/store', [DaysController::class,'store'])->name('days.store');

    //Route::get('/processing/api', [ProcessingController::class,'process_api'])->name('processing.api');
    Route::get('api/medical',function (Request $request) {
        $medical_days = DB::table('days')->select('medical_days1')->get();
        
        $log = DB::table('audit_log')
        // ->select('actual_or_further_processing_date.')
        ->where('status','medical')
        ->get();
        foreach($log as $checkup)       {
            $date1 = str_replace('-', '/', $checkup->actual_or_further_processing_date);
            $newdate = date('Y-m-d',strtotime($date1 . +$medical_days[0]->medical_days1."days"));
            $checkup->medical_date = date('Y-m-d',strtotime($newdate));
            $alert_date = date('Y-m-d',strtotime($newdate."-15 days"));
            $checkup->alert_date = $alert_date; 
        }
        return $log;
    });
    Route::resource('/processing', ProcessingController::class);
    Route::resource('/medical_checkup', MedicalCheckupcontroller::class);
    Route::get('/ghabhan/salve/{id}/edit', [PregnantController::class,'edit_salves'])->name('ghabhan.salve.edit');
    Route::post('/ghabhan/update/{data}', [PregnantController::class,'update_salves'])->name('ghabhan.salve.update');
    Route::resource('/ghabhan', PregnantController::class);


    Route::get('/khilla', [Khilla_location::class,'khilla'])->name('location.khilla');
    Route::post('/location/khilla/store', [Khilla_location::class,'store_khilla'])->name('location.khilla.store');
    Route::get('/location/khilla/{id}/edit', [Khilla_location::class,'edit_khilla'])->name('location.khilla.edit');
    Route::delete('/location/khilla/delete/{id}', [Khilla_location::class,'delete_khilla'])->name('location.khilla.delete');
    Route::get('/location/api/{id}/{no}', [Khilla_location::class,'unique_khilla_no'])->name('location.api');

    Route::delete('/location/delete/{id}', [Khilla_location::class,'delete'])->name('location.delete');
    Route::resource('/location', Khilla_location::class)->except(['show','create','update']);

    // Route::get('/billing/pagination', [BillingController::class,'pagination'])->name('billing.pagination');
    Route::get('/billing/api/{id}/{cid}/{date1}/{date2}/{bill_id?}', [BillingController::class,'get_data_api'])->name('billing.api');
    Route::get('/billing/customer_api/{id}/{param1?}/{param2?}', [BillingController::class,'get_cust_api'])->name('billing.custapi');
    Route::post('/billing/store', [BillingController::class,'store'])->name('billing.store');
    Route::get('/billing/create', [BillingController::class,'create'])->name('billing.create');
    Route::get('/billing/{id}/edit', [BillingController::class,'edit'])->name('billing.edit');
    Route::put('/billing/update/{data}', [BillingController::class,'update'])->name('billing.update');
    Route::delete('/billing/delete/{id}/{tbname}', [BillingController::class,'delete'])->name('billing.delete');
    Route::get('/billing', [BillingController::class,'index'])->name('billing.index');

    Route::prefix('profile')->group(function() {
        Route::get('/', [ProfileController::class,'index'])->name('profile.index');
        Route::put('/{profile}', [ProfileController::class,'update'])->name('profile.update');
    });

    // For Stock
    Route::prefix('stock')->group(function() {
        Route::get('/',[StockController::class,'index'])->name('stock.index');
        Route::get('/api/{id?}',[StockController::class,'stock_api'])->name('stock.api');
        Route::post('/insert',[StockController::class,'stock_insert'])->name('stock.insert');               
        Route::get('/in/{id}/edit',[StockController::class,'stock_in_edit'])->name('stock.in.edit');
        Route::put('/in/update',[StockController::class,'stock_in_update'])->name('stock.in.update');
        Route::delete('/in/delete/{id}/{itmid}',[StockController::class,'stock_in_delete'])->name('stock.in.delete');        
        Route::get('/out/{id}/edit',[StockController::class,'stock_out_edit'])->name('stock.out.edit');
        Route::put('/out/update',[StockController::class,'stock_out_update'])->name('stock.out.update');
        Route::delete('/out/delete/{id}/{itmid}/{qty}',[StockController::class,'stock_out_delete'])->name('stock.out.delete');
        Route::get('/out/api/{id}',[StockController::class,'stock_out_api'])->name('stock.out.api');
    
            
        Route::delete('/items/delete/{id}',[StockController::class,'delete_items'])->name('stock.items.delete');
        Route::get('/form/{id?}',[StockController::class,'items_form'])->name('stock.items.form');
        Route::post('/store',[StockController::class,'store_items'])->name('stock.items.store');
    });

});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
