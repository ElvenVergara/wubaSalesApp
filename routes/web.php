<?php

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

Route::get('/{any}', function () {
    return view('home');
})->where("any",".*");


Auth::routes();


// Users Routes

	Route::post('/loginme',[App\Http\Controllers\UsersController::class, 'loginme']);
	Route::post('/RegisterUser',[App\Http\Controllers\UsersController::class, 'RegisterUser']);
	Route::post('/checkUserLogin',[App\Http\Controllers\UsersController::class, 'checkUserLogin']);
	Route::post('/getUsers',[App\Http\Controllers\UsersController::class, 'getUsers']);
	Route::post('/getSuppliers',[App\Http\Controllers\UsersController::class, 'getSuppliers']);
	Route::post('/getCustomers',[App\Http\Controllers\UsersController::class, 'getCustomers']);
	Route::post('/adduser',[App\Http\Controllers\UsersController::class, 'adduser']);
	Route::post('/blockUser',[App\Http\Controllers\UsersController::class, 'blockUser']);
	Route::post('/getdataforedit',[App\Http\Controllers\UsersController::class, 'getdataforedit']);
	Route::post('/edituser',[App\Http\Controllers\UsersController::class, 'edituser']);
	Route::post('/deleteuser',[App\Http\Controllers\UsersController::class, 'deleteuser']);
	Route::post('/getCurrentUser',[App\Http\Controllers\UsersController::class, 'getCurrentUser']);
	Route::post('/editAccountProccess',[App\Http\Controllers\UsersController::class, 'editAccountProccess']);
	Route::post('/getUserlogs',[App\Http\Controllers\UsersController::class, 'getUserlogs']);

// Users Routes






// Users Access Routes

	Route::post('/checkUserAccess',[App\Http\Controllers\UserAccessController::class, 'checkUserAccess']);
	Route::post('/getAccessforEdit',[App\Http\Controllers\UserAccessController::class, 'getAccessforEdit']);
	Route::post('/addaccess',[App\Http\Controllers\UserAccessController::class, 'addaccess']);
	Route::post('/editaccess',[App\Http\Controllers\UserAccessController::class, 'editaccess']);
	Route::post('/deleteaccess',[App\Http\Controllers\UserAccessController::class, 'deleteaccess']);
	Route::post('/getUserAccess',[App\Http\Controllers\UserAccessController::class, 'getUserAccess']);

// Users Access Routes






// Items Routes

	Route::post('/getSuppliersSelect',[App\Http\Controllers\ItemsController::class, 'getSuppliersSelect']);
	Route::post('/getItemCategory',[App\Http\Controllers\ItemsController::class, 'getItemCategory']);
	Route::post('/getUnitSelect',[App\Http\Controllers\ItemsController::class, 'getUnitSelect']);
	Route::post('/add_category',[App\Http\Controllers\ItemsController::class, 'add_category']);
	Route::post('/add_unit',[App\Http\Controllers\ItemsController::class, 'add_unit']);
	Route::post('/delete_category',[App\Http\Controllers\ItemsController::class, 'delete_category']);
	Route::post('/delete_unit',[App\Http\Controllers\ItemsController::class, 'delete_unit']);
	Route::post('/additem',[App\Http\Controllers\ItemsController::class, 'additem']);
	Route::post('/getItems',[App\Http\Controllers\ItemsController::class, 'getItems']);
	Route::post('/getItemForEdit',[App\Http\Controllers\ItemsController::class, 'getItemForEdit']);
	Route::post('/updateitem',[App\Http\Controllers\ItemsController::class, 'updateitem']);
	Route::post('/deleteitem',[App\Http\Controllers\ItemsController::class, 'deleteitem']);
	Route::post('/getSelectItem',[App\Http\Controllers\ItemsController::class, 'getSelectItem']);
	Route::post('/getSelectSuppliers',[App\Http\Controllers\ItemsController::class, 'getSelectSuppliers']);
	Route::post('/getSuppliersItem',[App\Http\Controllers\ItemsController::class, 'getSuppliersItem']);
	Route::post('/getSuppliersPrice',[App\Http\Controllers\ItemsController::class, 'getSuppliersPrice']);
	Route::post('/addPO',[App\Http\Controllers\ItemsController::class, 'addPO']);
	Route::post('/getPOs',[App\Http\Controllers\ItemsController::class, 'getPOs']);
	Route::post('/getSelectItemStockIn',[App\Http\Controllers\ItemsController::class, 'getSelectItemStockIn']);
	Route::post('/getSelectItemStockOut',[App\Http\Controllers\ItemsController::class, 'getSelectItemStockOut']);
	Route::post('/getSupplier',[App\Http\Controllers\ItemsController::class, 'getSupplier']);
	Route::post('/getSelectItemPOS',[App\Http\Controllers\ItemsController::class, 'getSelectItemPOS']);

// Items Routes











// PO Routes

	Route::post('/addPO',[App\Http\Controllers\POController::class, 'addPO']);
	Route::post('/getPOs',[App\Http\Controllers\POController::class, 'getPOs']);
	Route::post('/deletepo',[App\Http\Controllers\POController::class, 'deletepo']);

// PO Routes











// Stock In Routes

	Route::post('/getPOofTheItem',[App\Http\Controllers\StockInController::class, 'getPOofTheItem']);
	Route::post('/add_stockin',[App\Http\Controllers\StockInController::class, 'add_stockin']);
	Route::post('/getStockIn',[App\Http\Controllers\StockInController::class, 'getStockIn']);

// Stock In Routes











// Stock Out Routes

	Route::post('/add_stockout',[App\Http\Controllers\StockOutController::class, 'add_stockout']);
	Route::post('/getStockOut',[App\Http\Controllers\StockOutController::class, 'getStockOut']);

// Stock Out Routes







// POS Routes

	Route::post('/add_order',[App\Http\Controllers\OrderController::class, 'add_order']);
	Route::post('/getOrders',[App\Http\Controllers\OrderController::class, 'getOrders']);
	Route::post('/getQuantityForEdit',[App\Http\Controllers\OrderController::class, 'getQuantityForEdit']);
	Route::post('/edit_order',[App\Http\Controllers\OrderController::class, 'edit_order']);
	Route::post('/delete_order',[App\Http\Controllers\OrderController::class, 'delete_order']);
	Route::post('/save_transaction',[App\Http\Controllers\OrderController::class, 'save_transaction']);
	Route::post('/checkTransactionCode',[App\Http\Controllers\OrderController::class, 'checkTransactionCode']);
	Route::post('/getTransactionCode',[App\Http\Controllers\OrderController::class, 'getTransactionCode']);
	Route::post('/getSavedTransactions',[App\Http\Controllers\OrderController::class, 'getSavedTransactions']);
	Route::post('/getAllTransactions',[App\Http\Controllers\OrderController::class, 'getAllTransactions']);
	Route::post('/cancel_transaction',[App\Http\Controllers\OrderController::class, 'cancel_transaction']);
	Route::post('/addCustomer',[App\Http\Controllers\OrderController::class, 'addCustomer']);
	Route::post('/getTotalCost',[App\Http\Controllers\OrderController::class, 'getTotalCost']);
	Route::post('/paymentProcess',[App\Http\Controllers\OrderController::class, 'paymentProcess']);
	Route::post('/getdataforreceipt',[App\Http\Controllers\OrderController::class, 'getdataforreceipt']);
	Route::post('/getSalesReport',[App\Http\Controllers\OrderController::class, 'getSalesReport']);
	Route::post('/getPayoutReport',[App\Http\Controllers\OrderController::class, 'getPayoutReport']);
	Route::post('/getTotalCostNumber',[App\Http\Controllers\OrderController::class, 'getTotalCostNumber']);
	Route::post('/checkTransactionCodeStatus',[App\Http\Controllers\OrderController::class, 'checkTransactionCodeStatus']);
// POS Routes