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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/activate','AdminController@addAdmin');
Route::post('/activate','AdminController@createAdmin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');


Route::get('/home-2', function () {
    return view('home-2');
});




//Main Routes
// Route::get('/saleslip/list', function () {
//     return view('saleslip.salesliplist');
// });
//End Main Routes
Route::get('/getThreeUserTotal','ThreeSaleController@getUserTotal');


Route::get('/changepassword','CommissionController@changePassword');
Route::post('/changepassword','CommissionController@changedPassword');

//For 2D Sale
Route::get('/2dsale/add','TwoSaleController@chooseTwoSale');

Route::get('/2dsale/add/{id}','TwoSaleController@addTwoSale');
Route::post('/2dsale/add/{id}','TwoSaleController@createTwoSale');

Route::get('/2dsale/add/{id}/{s_id}','TwoSaleController@addTwoSale');
Route::post('/2dsale/add/{id}/{s_id}','TwoSaleController@createTwoSale');

Route::get('/2dsale/del/{id}','TwoSaleController@delTwoSale');
Route::get('/2dsale/typedel/{id}','TwoSaleController@typedelTwoSale');
Route::get('/2dsale/alldel/{w_id}/{u_id}/{c_id}/{s_id}','TwoSaleController@alldelTwoSale');

Route::get('/2dsale/save/{w_id}/{u_id}/{s_id}','TwoSaleController@saveTwoSale');


Route::get('/2dsale/padaythar/bet/{work_file_id}','TwoSaleController@padaytharbetTwoSale');
Route::post('/2dsale/padaythar/bet/{work_file_id}','TwoSaleController@createpadaytharbetTwoSale');

Route::get('/2dsale/image-text/bet/{work_file_id}','TwoSaleController@imagetextTwoSale');
Route::post('/2dsale/image-text/bet/{work_file_id}','TwoSaleController@createimagetextTwoSale');

Route::get('/2dsale/image/add/{work_file_id}','TwoSaleController@addImage');	
Route::post('/2dsale/image/add/{work_file_id}','TwoSaleController@createImage');
//End 2D Sale


//For 3dsale

Route::get('/3dsale/list','ThreeSaleController@chooseThreeSale');

Route::get('/3dsale/add/{id}','ThreeSaleController@addThreeSale');

Route::get('/3dsale/add/{w_id}/{u_id}/{s_id}','ThreeSaleController@editThreeSale');


Route::get('/3dsale/add/{w_id}/{s_id}','ThreeSaleController@showThreeSale');

Route::get('/3dsale/update-del','ThreeSaleController@updDelThreeSale');





// Route::get('/3dsale/add/{id}/{s_id}','ThreeSaleController@addThreeSale');


// Route::post('/3dsale/add/{id}','ThreeSaleController@createThreeSale');

// Route::post('/3dsale/add/{id}/{s_id}','ThreeSaleController@createThreeSale');

Route::get('/3dsale/del/{id}','ThreeSaleController@delThreeSale');
Route::get('/3dsale/typedel/{id}','ThreeSaleController@typedelThreeSale');

// Route::get('/3dsale/alldel/{w_id}/{u_id}/{c_id}/{s_id}','ThreeSaleController@alldelThreeSale');

Route::get('/3dsale/save','ThreeSaleController@saveThreeSale');


Route::get('/3dsale/padaythar','ThreeSaleController@padaytharbetThreeSale');
Route::post('/3dsale/padaythar','ThreeSaleController@createpadaytharbetThreeSale');

Route::get('/3dsale/position','ThreeSaleController@positionbetThreeSale');
Route::post('/3dsale/position','ThreeSaleController@createpositionbetThreeSale');

Route::get('/3dsale/image-text','ThreeSaleController@imagetextThreeSale');
Route::post('/3dsale/image-text','ThreeSaleController@createimagetextThreeSale');

Route::get('/3dsale/image/add','ThreeSaleController@addImage');	
Route::post('/3dsale/image/add','ThreeSaleController@createImage');

	// Ajax	
	Route::get('/getDigits','ThreeSaleController@getDigits');

	Route::get('/showDigits','ThreeSaleController@showDigits');

	Route::get('/getOverBreakDigits','ThreeSaleController@getOverBreakDigits');

	Route::get('/delDigits','ThreeSaleController@delDigits');
	Route::get('/groupdelDigits','ThreeSaleController@groupdelDigits');

//End 3dsale

//For Ledger
Route::get('/ledger/list','ThreeSaleController@ledgerList');
Route::get('/ledger/list/show','ThreeSaleController@ledgerListShow');


//End Ledger


//For Commission 
Route::get('/commission/list','CommissionController@listCommission');
Route::get('/commission/list/show','CommissionController@listCommissionShow');
Route::get('/commission/list/{id}','CommissionController@detailCommission');


Route::get('/commission/add','CommissionController@addCommission');
Route::post('/commission/add','CommissionController@createCommission');

Route::get('/commission/del/{id}','CommissionController@delCommission');

Route::get('/commission/upd/{id}','CommissionController@updCommission');
Route::post('/commission/upd/{id}','CommissionController@updateCommission');

Route::get('/filecommission/add','CommissionController@addFileCommission');

//End Commission

	//Ajax for save
	Route::get('/saveWorkFile','ChoiceController@saveWorkFile');
	Route::get('/saveUser','ChoiceController@saveUser');
	Route::get('/saveCustomer','ChoiceController@saveCustomer');


	Route::get('/saveEntry','ChoiceController@saveEntry');
	Route::get('/saveView','ChoiceController@saveView');

	Route::get('/saveKeyboard','ChoiceController@saveKeyboard');
	Route::get('/saveMaxMinus','ChoiceController@saveMaxMinus');	
	Route::get('/saveSlip','ChoiceController@saveSlip');


	Route::get('/getWorkFile','ChoiceController@getWorkFile');	
	Route::get('/getUser','ChoiceController@getUser');	
	Route::get('/getCustomer','ChoiceController@getCustomer');	


	Route::get('/getUserInfo','ChoiceController@getUserInfo');	
	Route::get('/getUserThreeComm','ChoiceController@getUserThreeComm');
	Route::get('/getCashInfo','CashController@getCashInfo');
	Route::get('/getBreakAmount','ChoiceController@getBreakAmount');

	//Ajax 


//For User
Route::get('/user/list','CommissionController@listUser');

Route::get('/user/add','CommissionController@addUser');
Route::post('/user/add','CommissionController@createUser');

Route::get('/user/del/{id}','CommissionController@delUser');

Route::get('user/upd/{id}','CommissionController@updUser');
Route::post('user/upd/{id}','CommissionController@updateUser');
//End User

//For Member
Route::get('/member/list','MemberController@listMember');

Route::get('/member/add','MemberController@addMember');
Route::post('/member/add','MemberController@createMember');

Route::get('/member/del/{id}','MemberController@delMember');

Route::get('member/upd/{id}','MemberController@updMember');
Route::post('member/upd/{id}','MemberController@updateMember');
//End Member


//For WorkFile 
Route::get('/workfile/list','WorkFileController@listWorkFile');
Route::get('/workfile/list/show','WorkFileController@listWorkFileShow');
Route::get('/workfile/list/{id}','WorkFileController@detailWorkFile');

Route::get('/workfile/add','WorkFileController@addWorkFile');
Route::post('/workfile/add','WorkFileController@createWorkFile');

Route::get('/workfile/del/{id}','WorkFileController@delWorkFile');

Route::get('/workfile/upd/{id}','WorkFileController@updWorkFile');
Route::post('/workfile/upd/{id}','WorkFileController@updateWorkFile');	

Route::get('/workfile/open/{w_id}','WorkFileController@openWorkFile');
Route::get('/workfile/close/{w_id}','WorkFileController@closeWorkFile');
//End WorkFile

//For TwoDigit
Route::get('/2d/list','TwoDigitController@listTwoDigit');
Route::get('/2d/list/show','TwoDigitController@listTwoDigitShow');
//End TwoDigit

//For ThreeDigit
Route::get('/3d/list','ThreeDigitController@listThreeDigit');

Route::get('/3d/gameplay','ThreeDigitController@gameplayThreeDigit');

Route::get('/3d/list/show','ThreeDigitController@listThreeDigitShow');
//End ThreeDigit

// For Break Amount
Route::get('/break/list','BreakAmountController@listBreakAmount');
Route::get('/break/list/show','BreakAmountController@listBreakAmountShow');

Route::get('/break/add','BreakAmountController@addBreakAmount');
Route::post('/break/add','BreakAmountController@createBreakAmount');

Route::get('/break/del/{id}','BreakAmountController@delBreakAmount');

Route::get('/break/upd','BreakAmountController@updBreakAmount');
Route::post('/break/upd','BreakAmountController@updateBreakAmount');

	//Ajax
	Route::get('/saveBreak','BreakAmountController@saveBreak');
	//Ajax 

//End Break Amount


// For Hot
Route::get('/hot/list','HotController@listHot');
Route::get('/hot/list/show','HotController@listShowHot');

Route::get('/hot/add/{w_id}','HotController@addHotDigit');
Route::get('/hot/add/{w_id}/{s_id}','HotController@addMoreHotDigit');

Route::post('/hot/add','HotController@createHotDigit');

Route::get('/hot/save/{id}','HotController@saveHotDigit');

Route::get('/hot/del/{id}','HotController@delHot');
Route::get('/hot/typedel/{id}','HotController@typedelHot');
Route::get('/hot/alldel/{id}','HotController@alldelHot');
//End Hot


//For List 

Route::get('/list','ListController@viewList');
Route::get('/list/show','ListController@showList');

Route::get('/main/list','ListController@viewMain');
Route::get('/main/list/show','ListController@showMain');

//End List


// For Result
Route::get('/result/list','ResultController@listResult');
Route::get('/result/list/show','ResultController@listResultShow');


Route::get('/result/add','ResultController@addResult');
Route::post('/result/add','ResultController@createResult');

// Route::get('/result/del/{id}','ResultController@delResult');

// Route::get('/result/upd/{id}','ResultController@updResult');
// Route::post('/result/upd/{id}','ResultController@updateResult');

//ပေါက်သီး စာရင်း စလစ်
Route::get('/user/list/result','ResultController@userListResult');
Route::get('/user/list/result/show','ResultController@userListResultShow');
//ပေါက်သီး စာရင်း စလစ်

//End Result


// For Cash
Route::get('/cash/list','CashController@listCash');

Route::get('/cash/add','CashController@addCash');
Route::post('/cash/add','CashController@createCash');

Route::get('/cash/del/{id}','CashController@delCash');

Route::get('/cash/upd/{id}','CashController@updCash');
Route::post('/cash/upd/{id}','CashController@updateCash');
//End Cash


//Start ထိုးပြီး ဂဏန်း ပြန်ကြည့်ရန်
Route::get('/confirm/list', 'HomeController@confirmList');
Route::get('/confirm/list/show', 'HomeController@confirmListShow');

Route::get('/confirm/del/{id}', 'HomeController@delConfirmList');

Route::get('/confirm/del/slip/{w_id}/{u_id}/{s_id}', 'HomeController@delSlipConfirmList');



Route::get('/confirm/upd/{id}', 'HomeController@updConfirmList');
Route::post('/confirm/upd/{id}', 'HomeController@updateConfirmList');

//End ထိုးပြီး ဂဏန်း ပြန်ကြည့်ရန်

//Start အရောင်းစလစ်
Route::get('/saleslip/list', 'HomeController@saleslipList');
Route::get('/saleslip/list/show', 'HomeController@saleslipListShow');
//End အရောင်းစလစ်

//Start စလစ်
Route::get('/slip/list', 'HomeController@slipList');
Route::get('/slip/list/show', 'HomeController@slipListShow');

Route::get('/slip/list/{w_id}/{u_id}/{s_id}', 'HomeController@slipListDetail');
//End စလစ်

//Start ရောင်းကြေး
Route::get('/saleamount/list', 'HomeController@saleAmountList');
Route::get('/saleamount/list/show', 'HomeController@saleAmountListShow');
//End ရောင်းကြေး

//For Customer 
Route::get('/customer/list','CustomerController@listCustomer');

Route::get('/customer/add','CustomerController@addCustomer');
Route::post('/customer/add','CustomerController@createCustomer');

Route::get('/customer/del/{id}','CustomerController@delCustomer');

Route::get('/customer/upd/{id}','CustomerController@updCustomer');
Route::post('/customer/upd/{id}','CustomerController@updateCustomer');	
//End Customer

//For File Permission 
Route::get('/filepermission/list','FilePermissionController@listFilePermission');

Route::get('/filepermission/add/{user_id}','FilePermissionController@addFilePermission');
Route::post('/filepermission/add/{user_id}','FilePermissionController@createFilePermission');

Route::get('/filepermission/del/{id}','FilePermissionController@delFilePermission');

Route::get('/filepermission/upd/{id}','FilePermissionController@updFilePermission');
Route::post('/filepermission/upd/{id}','FilePermissionController@updateFilePermission');	
//End File Permission

//For Digit Permission 
Route::get('/digitpermission/list','DigitPermissionController@listDigitPermission');

Route::get('/digitpermission/add/{id}','DigitPermissionController@addDigitPermission');
Route::post('/digitpermission/add/{id}','DigitPermissionController@createDigitPermission');

Route::get('/digitpermission/confirm/{id}','DigitPermissionController@confirmDigitPermission');

Route::get('/digitpermission/del/{id}','DigitPermissionController@delDigitPermission');
Route::get('/digitpermission/alldel/{id}','DigitPermissionController@delAllDigitPermission');
Route::get('/digitpermission/typedel/{id}','DigitPermissionController@delTypeDigitPermission');


// Route::get('/digitpermission/upd/{id}','DigitPermissionController@updDigitPermission');
// Route::post('/digitpermission/upd/{id}','DigitPermissionController@updateDigitPermission');	
//End Digit Permission

//For Other Permission 
Route::get('/otherpermission/list','OtherPermissionController@listOtherPermission');
// Route::get('/otherpermission/list/show','OtherPermissionController@listShowOtherPermission');

Route::get('/otherpermission/add/{id}','OtherPermissionController@addOtherPermission');
Route::post('/otherpermission/add/{id}','OtherPermissionController@createOtherPermission');

Route::get('/otherpermission/save/{id}','OtherPermissionController@saveOtherPermission');

Route::get('/otherpermission/del/{id}','OtherPermissionController@delOtherPermission');

Route::get('/otherpermission/delall/{w_id}','OtherPermissionController@delAllOtherPermission');

// Route::get('/otherpermission/deltype/{w_id}/{type}','OtherPermissionController@delTypeOtherPermission');


Route::get('/otherpermission/upd/{id}','OtherPermissionController@updOtherPermission');
Route::post('/otherpermission/upd/{id}','OtherPermissionController@updateOtherPermission');	
//End Other Permission