<?php

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

Auth::routes();

// Route::get('/tables', 'admin\JengaController@tables')->name('home');

Route::get('/invoke', 'SetupController@invoke')->name('invoke');

Route::get('/', 'admin\DashboardController@index')->name('home');
Route::get('/dashboard', 'admin\DashboardController@dashboard')->name('dashboard');

Route::get('/register', '\App\Http\Controllers\Auth\RegisterController@create')->name('home');

Route::get('/admin', 'admin\DashboardController@index')->name('dashboard');
Route::get('/driver', 'DriverController@index')->name('driver');
Route::get('/admin/dashboard', 'admin\DashboardController@index')->name('dashboard');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

//menu
Route::get('admin/clientsmenu', '\App\Http\Controllers\admin\ClientsMenuController@index');
Route::get('admin/loansmenu', '\App\Http\Controllers\admin\LoansMenuController@index');
Route::get('admin/transactionsmenu', '\App\Http\Controllers\admin\TransactionsMenuController@index');
Route::get('admin/transfersmenu', '\App\Http\Controllers\admin\TransfersMenuController@index');
Route::get('admin/withdrawalsmenu', '\App\Http\Controllers\admin\WithdrawalsMenuController@index');


Route::resource('admin/modules','admin\ModulesController');

Route::resource('modules','admin\ModulesController');

Route::get('/admin/modulesreport', 'admin\ModulesController@report');


Route::resource('admin/companies','admin\CompaniesController');

Route::resource('admin/usersaccounts','admin\UsersAccountsController');

Route::get('/admin/usersaccountsreport', 'admin\UsersAccountsController@report');


Route::post('/admin/usersaccountsfilter', 'admin\UsersAccountsController@filter');

Route::resource('admin/users','admin\UsersController');

Route::get('/admin/usersreport', 'admin\UsersController@report');

Route::post('/admin/usersfilter', 'admin\UsersController@filter');

Route::resource('admin/roles','admin\RolesController');

Route::get('/admin/rolesreport', 'admin\RolesController@report');

Route::post('/admin/rolesfilter', 'admin\RolesController@filter');

Route::resource('admin/usersaccountsroles','admin\UsersAccountsRolesController');

Route::get('/admin/usersaccountsrolesreport', 'admin\UsersAccountsRolesController@report');

Route::post('/admin/usersaccountsrolesfilter', 'admin\UsersAccountsRolesController@filter');

Route::get('/admin/useraccountrolesmanagement/{id}', 'admin\UsersAccountsRolesController@useraccountrolesmanagement');


Route::resource('admin/countries','admin\CountriesController');

Route::get('/admin/countriesreport', 'admin\CountriesController@report');

Route::post('/admin/countriesfilter', 'admin\CountriesController@filter');

Route::resource('admin/countries','admin\CountriesController');

Route::get('/admin/countriesreport', 'admin\CountriesController@report');

Route::post('/admin/countriesfilter', 'admin\CountriesController@filter');

Route::resource('admin/countries','admin\CountriesController');

Route::get('/admin/countriesreport', 'admin\CountriesController@report');

Route::post('/admin/countriesfilter', 'admin\CountriesController@filter');

Route::resource('admin/countries','admin\CountriesController');

Route::get('/admin/countriesreport', 'admin\CountriesController@report');

Route::post('/admin/countriesfilter', 'admin\CountriesController@filter');

Route::resource('admin/countries','admin\CountriesController');



Route::get('/admin/countriesreport', 'admin\CountriesController@report');

Route::post('/admin/countriesfilter', 'admin\CountriesController@filter');

Route::resource('admin/currencies','admin\CurrenciesController');

Route::get('/admin/currenciesreport', 'admin\CurrenciesController@report');

Route::post('/admin/currenciesfilter', 'admin\CurrenciesController@filter');

Route::resource('admin/clienttypes','admin\ClientTypesController');

Route::get('/admin/clienttypesreport', 'admin\ClientTypesController@report');

Route::post('/admin/clienttypesfilter', 'admin\ClientTypesController@filter');
Route::post('/admin/getclienttype', 'admin\ClientTypesController@getclienttype');

//ClientTypes routes .....

Route::resource('admin/clienttypes','admin\ClientTypesController');

Route::get('/admin/clienttypesreport', 'admin\ClientTypesController@report');

Route::post('/admin/clienttypesfilter', 'admin\ClientTypesController@filter');

//ClientCategories routes .....

Route::resource('admin/clientcategories','admin\ClientCategoriesController');

Route::get('/admin/clientcategoriesreport', 'admin\ClientCategoriesController@report');

Route::post('/admin/clientcategoriesfilter', 'admin\ClientCategoriesController@filter');

//MainEconomicActivities routes .....

Route::resource('admin/maineconomicactivities','admin\MainEconomicActivitiesController');

Route::get('/admin/maineconomicactivitiesreport', 'admin\MainEconomicActivitiesController@report');

Route::post('/admin/maineconomicactivitiesfilter', 'admin\MainEconomicActivitiesController@filter');

//SecondaryEconomicActivities routes .....

Route::resource('admin/secondaryeconomicactivities','admin\SecondaryEconomicActivitiesController');

Route::get('/admin/secondaryeconomicactivitiesreport', 'admin\SecondaryEconomicActivitiesController@report');

Route::post('/admin/secondaryeconomicactivitiesfilter', 'admin\SecondaryEconomicActivitiesController@filter');

//NextOfKinRelationships routes .....

Route::resource('admin/nextofkinrelationships','admin\NextOfKinRelationshipsController');

Route::get('/admin/nextofkinrelationshipsreport', 'admin\NextOfKinRelationshipsController@report');

Route::post('/admin/nextofkinrelationshipsfilter', 'admin\NextOfKinRelationshipsController@filter');
Route::get('/admin/getnextofkinrelationship/{id}', 'admin\NextOfKinRelationshipsController@getnextofkinrelationship');

//Genders routes .....

Route::resource('admin/genders','admin\GendersController');

Route::get('/admin/gendersreport', 'admin\GendersController@report');

Route::post('/admin/gendersfilter', 'admin\GendersController@filter');

//Counties routes .....

Route::resource('admin/counties','admin\CountiesController');

Route::get('/admin/countiesreport', 'admin\CountiesController@report');

Route::post('/admin/countiesfilter', 'admin\CountiesController@filter');

//SubCounties routes .....

Route::resource('admin/subcounties','admin\SubCountiesController');

Route::get('/admin/subcountiesreport', 'admin\SubCountiesController@report');

Route::post('/admin/subcountiesfilter', 'admin\SubCountiesController@filter');
Route::post('/admin/getsubcounties', 'admin\SubCountiesController@getSubCountiesByCounty');

//Branches routes .....

Route::resource('admin/branches','admin\BranchesController');

Route::get('/admin/branchesreport', 'admin\BranchesController@report');

Route::post('/admin/branchesfilter', 'admin\BranchesController@filter');

//BankingModes routes .....

Route::resource('admin/bankingmodes','admin\BankingModesController');

Route::get('/admin/bankingmodesreport', 'admin\BankingModesController@report');

Route::post('/admin/bankingmodesfilter', 'admin\BankingModesController@filter');

//ManagesDepartmentsData routes .....

Route::resource('admin/managesdepartmentsdata','admin\ManagesDepartmentsDataController');

Route::get('/admin/managesdepartmentsdatareport', 'admin\ManagesDepartmentsDataController@report');

Route::post('/admin/managesdepartmentsdatafilter', 'admin\ManagesDepartmentsDataController@filter');

//Departments routes .....

Route::resource('admin/departments','admin\DepartmentsController');

Route::get('/admin/departmentsreport', 'admin\DepartmentsController@report');

Route::post('/admin/departmentsfilter', 'admin\DepartmentsController@filter');

//Departments routes .....

Route::resource('admin/departments','admin\DepartmentsController');

Route::get('/admin/departmentsreport', 'admin\DepartmentsController@report');

Route::post('/admin/departmentsfilter', 'admin\DepartmentsController@filter');

//Departments routes .....

Route::resource('admin/departments','admin\DepartmentsController');

Route::get('/admin/departmentsreport', 'admin\DepartmentsController@report');

Route::post('/admin/departmentsfilter', 'admin\DepartmentsController@filter');

//EmployeeCategories routes .....

Route::resource('admin/employeecategories','admin\EmployeeCategoriesController');

Route::get('/admin/employeecategoriesreport', 'admin\EmployeeCategoriesController@report');

Route::post('/admin/employeecategoriesfilter', 'admin\EmployeeCategoriesController@filter');

//EmployeeGroups routes .....

Route::resource('admin/employeegroups','admin\EmployeeGroupsController');

Route::get('/admin/employeegroupsreport', 'admin\EmployeeGroupsController@report');

Route::post('/admin/employeegroupsfilter', 'admin\EmployeeGroupsController@filter');
Route::get('/admin/groupsimport','admin\GroupsController@dbimport');

//PayFrequencies routes .....

Route::resource('admin/payfrequencies','admin\PayFrequenciesController');

Route::get('/admin/payfrequenciesreport', 'admin\PayFrequenciesController@report');

Route::post('/admin/payfrequenciesfilter', 'admin\PayFrequenciesController@filter');

//PayModes routes .....

Route::resource('admin/paymodes','admin\PayModesController');

Route::get('/admin/paymodesreport', 'admin\PayModesController@report');

Route::post('/admin/paymodesfilter', 'admin\PayModesController@filter');

//PayPoints routes .....

Route::resource('admin/paypoints','admin\PayPointsController');

Route::get('/admin/paypointsreport', 'admin\PayPointsController@report');

Route::post('/admin/paypointsfilter', 'admin\PayPointsController@filter');

//MaritalStatuses routes .....

Route::resource('admin/maritalstatuses','admin\MaritalStatusesController');

Route::get('/admin/maritalstatusesreport', 'admin\MaritalStatusesController@report');

Route::post('/admin/maritalstatusesfilter', 'admin\MaritalStatusesController@filter');

Route::get('/admin/getmaritalstatus/{id}', 'admin\MaritalStatusesController@getmaritalstatus');

//Banks routes .....

Route::resource('admin/banks','admin\BanksController');

Route::get('/admin/banksreport', 'admin\BanksController@report');

Route::post('/admin/banksfilter', 'admin\BanksController@filter');

//BankBranches routes .....

Route::resource('admin/bankbranches','admin\BankBranchesController');

Route::get('/admin/bankbranchesreport', 'admin\BankBranchesController@report');

Route::post('/admin/bankbranchesfilter', 'admin\BankBranchesController@filter');

//Positions routes .....

Route::resource('admin/positions','admin\PositionsController');

Route::get('/admin/positionsreport', 'admin\PositionsController@report');

Route::post('/admin/positionsfilter', 'admin\PositionsController@filter');

//Employees routes .....

Route::resource('admin/employees','admin\EmployeesController');

Route::get('/admin/employeesreport', 'admin\EmployeesController@report');
Route::get('/admin/employeesimport', 'admin\EmployeesController@dbimport');

Route::post('/admin/employeesfilter', 'admin\EmployeesController@filter');
Route::post('/admin/employeescount', 'admin\EmployeesController@employeesCount');

//Clients routes .....

Route::resource('admin/clients','admin\ClientsController');

Route::get('/admin/clientsreport', 'admin\ClientsController@report');

Route::get('/admin/importfromdb', 'admin\ClientsController@importfromdb');

Route::post('/admin/dbimport', 'admin\ClientsImportController@dbimport');

Route::post('/admin/clientsfilter', 'admin\ClientsController@filter');

Route::post('/admin/clientscount', 'admin\ClientsController@clientsCount');

Route::get('/admin/clientssearch', 'admin\ClientsController@clientssearch');

Route::post('/admin/searchclient', 'admin\ClientsController@searchclient');

Route::get('/admin/clientapproval/{id}', 'admin\ClientsController@clientapproval');
Route::get('/admin/clientremoval/{id}', 'admin\ClientsController@clientremoval');
Route::get('/admin/clientblacklisting/{id}', 'admin\ClientsController@clientblacklisting');
Route::get('/admin/clientsuspension/{id}', 'admin\ClientsController@clientsuspension');
Route::get('/admin/clientgroupchange/{id}', 'admin\ClientsController@clientgroupchange');
Route::post('/admin/changeclientgroup/{id}', 'admin\ClientsController@changeclientgroup');
Route::get('/admin/clienttypechange/{id}/{code}', 'admin\ClientsController@clienttypechange');
Route::post('/admin/changeclienttype/{id}/{code}', 'admin\ClientsController@changeclienttype');
Route::post('/admin/getclients', 'admin\ClientsController@getclients');

Route::post('/admin/approveclient/{id}', 'admin\ClientsController@approveclient');
Route::post('/admin/blacklistclient/{id}', 'admin\ClientsController@blacklistclient');
Route::post('/admin/removeclient/{id}', 'admin\ClientsController@removeclient');
Route::post('/admin/suspendclient/{id}', 'admin\ClientsController@suspendclient');

// Client Query routes .....

Route::post('admin/client/query','admin\ClientsController@query')->name('client.query');
Route::post('admin/client/query2','admin\ClientsController@query2')->name('client.query2');
Route::post('admin/client/contribute','admin\ClientsController@contribute')->name('client.contribute');

Route::post('admin/client/individualize/{client}','admin\ClientsController@individualize')->name('client.individualize');

//Days routes .....


Route::resource('admin/days','admin\DaysController');

Route::get('/admin/daysreport', 'admin\DaysController@report');

Route::post('/admin/daysfilter', 'admin\DaysController@filter');

//MeetingFrequencies routes .....

Route::resource('admin/meetingfrequencies','admin\MeetingFrequenciesController');

Route::get('/admin/meetingfrequenciesreport', 'admin\MeetingFrequenciesController@report');

Route::post('/admin/meetingfrequenciesfilter', 'admin\MeetingFrequenciesController@filter');

//Groups routes .....

Route::resource('admin/groups','admin\GroupsController');
Route::post('/admin/groups/customize/{groups}', 'admin\GroupsController@customize')->name('groups.customize');

Route::resource('admin/groups/leadership/category','GroupLeadershipCategoryController', ['as' => 'groups.leadership']);
Route::resource('admin/groups/leadership/catalog','GroupLeadershipController', ['as' => 'groups.leadership']);

Route::get('/admin/groupsreport', 'admin\GroupsController@report');

Route::post('/admin/groupsfilter', 'admin\GroupsController@filter');
Route::post('/admin/groupscount', 'admin\GroupsController@groupsCount');

Route::resource('admin/groupcontributions','admin\GroupContributionsController');

Route::get('admin/groupcontributions/receipt/{id}','admin\GroupContributionsController@receipt');

Route::resource('admin/ptrreport','admin\PTRReportController');
Route::get('admin/ptrreport/{id}/export','admin\PTRReportController@export')->name('ptrreport.export');;

//GroupRoles routes .....

Route::resource('admin/grouproles','admin\GroupRolesController');

Route::get('/admin/grouprolesreport', 'admin\GroupRolesController@report');

Route::post('/admin/grouprolesfilter', 'admin\GroupRolesController@filter');

//GroupClients routes .....

Route::resource('admin/groupclients','admin\GroupClientsController');

Route::get('/admin/groupclientsreport', 'admin\GroupClientsController@report');

Route::get('/admin/groupclientsdbimport', 'admin\GroupClientsController@dbimport');

Route::post('/admin/groupclientsfilter', 'admin\GroupClientsController@filter');

//GroupClientRoles routes .....

Route::resource('admin/groupclientroles','admin\GroupClientRolesController');

Route::get('/admin/groupclientrolesreport', 'admin\GroupClientRolesController@report');

Route::post('/admin/groupclientrolesfilter', 'admin\GroupClientRolesController@filter');

//TransactionStatuses routes .....

Route::resource('admin/transactionstatuses','admin\TransactionStatusesController');

Route::get('/admin/transactionstatusesreport', 'admin\TransactionStatusesController@report');

Route::post('/admin/transactionstatusesfilter', 'admin\TransactionStatusesController@filter');

//FinancialCategories routes .....

Route::resource('admin/financialcategories','admin\FinancialCategoriesController');

Route::get('/admin/financialcategoriesreport', 'admin\FinancialCategoriesController@report');

Route::post('/admin/financialcategoriesfilter', 'admin\FinancialCategoriesController@filter');

//AccountLevels routes .....

Route::resource('admin/accountlevels','admin\AccountLevelsController');

Route::get('/admin/accountlevelsreport', 'admin\AccountLevelsController@report');

Route::post('/admin/accountlevelsfilter', 'admin\AccountLevelsController@filter');

//Accounts routes .....

Route::resource('admin/accounts','admin\AccountsController');

Route::get('/admin/accountsreport', 'admin\AccountsController@report');

Route::get('/admin/accountsdbimport', 'admin\AccountsController@dbimport');

Route::post('/admin/accountsfilter', 'admin\AccountsController@filter');

//SubAccounts routes .....

Route::resource('admin/subaccounts','admin\SubAccountsController');

Route::get('/admin/subaccountsreport', 'admin\SubAccountsController@report');

Route::post('/admin/subaccountsfilter', 'admin\SubAccountsController@filter');

//GracePeriods routes .....

Route::resource('admin/graceperiods','admin\GracePeriodsController');

Route::get('/admin/graceperiodsreport', 'admin\GracePeriodsController@report');

Route::post('/admin/graceperiodsfilter', 'admin\GracePeriodsController@filter');


//FineChargeFrequencies routes .....

Route::resource('admin/finechargefrequencies','admin\FineChargeFrequenciesController');

Route::get('/admin/finechargefrequenciesreport', 'admin\FineChargeFrequenciesController@report');

Route::post('/admin/finechargefrequenciesfilter', 'admin\FineChargeFrequenciesController@filter');

//LoanPaymentDurations routes .....

Route::resource('admin/loanpaymentdurations','admin\LoanPaymentDurationsController');

Route::get('/admin/loanpaymentdurationsreport', 'admin\LoanPaymentDurationsController@report');

Route::post('/admin/loanpaymentdurationsfilter', 'admin\LoanPaymentDurationsController@filter');

//MinimumMembershipPeriods routes .....

Route::resource('admin/minimummembershipperiods','admin\MinimumMembershipPeriodsController');

Route::get('/admin/minimummembershipperiodsreport', 'admin\MinimumMembershipPeriodsController@report');

Route::post('/admin/minimummembershipperiodsfilter', 'admin\MinimumMembershipPeriodsController@filter');

//FineTypes routes .....

Route::resource('admin/finetypes','admin\FineTypesController');

Route::get('/admin/finetypesreport', 'admin\FineTypesController@report');

Route::post('/admin/finetypesfilter', 'admin\FineTypesController@filter');

//InterestPaymentMethods routes .....

Route::resource('admin/interestpaymentmethods','admin\InterestPaymentMethodsController');

Route::get('/admin/interestpaymentmethodsreport', 'admin\InterestPaymentMethodsController@report');

Route::post('/admin/interestpaymentmethodsfilter', 'admin\InterestPaymentMethodsController@filter');

//InterestRateTypes routes .....

Route::resource('admin/interestratetypes','admin\InterestRateTypesController');

Route::get('/admin/interestratetypesreport', 'admin\InterestRateTypesController@report');

Route::post('/admin/interestratetypesfilter', 'admin\InterestRateTypesController@filter');
Route::get('/admin/getinterestratetype/{id}', 'admin\InterestRateTypesController@getinterestratetype');

//FineChargePeriods routes .....

Route::resource('admin/finechargeperiods','admin\FineChargePeriodsController');

Route::get('/admin/finechargeperiodsreport', 'admin\FineChargePeriodsController@report');

Route::post('/admin/finechargeperiodsfilter', 'admin\FineChargePeriodsController@filter');

//DisbursementModes routes .....

Route::resource('admin/disbursementmodes','admin\DisbursementModesController');

Route::get('/admin/disbursementmodesreport', 'admin\DisbursementModesController@report');

Route::post('/admin/disbursementmodesfilter', 'admin\DisbursementModesController@filter');

//LoanProducts routes .....

Route::resource('admin/loanproducts','admin\LoanProductsController');

Route::get('/admin/loanproductsreport', 'admin\LoanProductsController@report');

Route::post('/admin/loanproductsfilter', 'admin\LoanProductsController@filter');
Route::post('/admin/getloanproduct', 'admin\LoanProductsController@getloanproduct');
Route::get('/admin/getloanproductcode', 'admin\LoanProductsController@loanproductcode');
Route::get('/admin/checkifloanproductdependsonlgf/{id}/{clientid}/{loanamount}','admin\LoanProductsController@checkifloanproductdependsonlgf');

//LoanProductClientTypes routes .....

Route::resource('admin/loanproductclienttypes','admin\LoanProductClientTypesController');

Route::get('/admin/loanproductclienttypesreport', 'admin\LoanProductClientTypesController@report');

Route::post('/admin/loanproductclienttypesfilter', 'admin\LoanProductClientTypesController@filter');

//ApprovalLevels routes .....

Route::resource('admin/approvallevels','admin\ApprovalLevelsController');

Route::get('/admin/approvallevelsreport', 'admin\ApprovalLevelsController@report');

Route::post('/admin/approvallevelsfilter', 'admin\ApprovalLevelsController@filter');


//ProductDisbursementConfigurations routes .....

Route::resource('admin/productdisbursementconfigurations','admin\ProductDisbursementConfigurationsController');

Route::get('/admin/productdisbursementconfigurationsreport', 'admin\ProductDisbursementConfigurationsController@report');

Route::post('/admin/productdisbursementconfigurationsfilter', 'admin\ProductDisbursementConfigurationsController@filter');

//PaymentModes routes .....

Route::resource('admin/paymentmodes','admin\PaymentModesController');

Route::get('/admin/paymentmodesreport', 'admin\PaymentModesController@report');

Route::post('/admin/paymentmodesfilter', 'admin\PaymentModesController@filter');

//ClientLgfContributions routes .....

Route::resource('admin/clientlgfcontributions','admin\ClientLgfContributionsController');

Route::get('/admin/clientlgfcontributionsreport', 'admin\ClientLgfContributionsController@report');

Route::post('/admin/clientlgfcontributionsfilter', 'admin\ClientLgfContributionsController@filter');

Route::post('/admin/clientlgfcontributiondbimport', 'admin\ClientLgfContributionsController@dbimport');

//ClientLgfBalances routes .....

Route::resource('admin/clientlgfbalances','admin\ClientLgfBalancesController');

Route::get('/admin/clientlgfbalancesreport', 'admin\ClientLgfBalancesController@report');

Route::post('/admin/clientlgfbalancesfilter', 'admin\ClientLgfBalancesController@filter');

Route::get('/admin/getclientlgfbalance/{id}', 'admin\ClientLgfBalancesController@getclientlgfbalance');

//LgfContributionConfigurations routes .....

Route::resource('admin/lgfcontributionconfigurations','admin\LgfContributionConfigurationsController');

Route::get('/admin/lgfcontributionconfigurationsreport', 'admin\LgfContributionConfigurationsController@report');

Route::post('/admin/lgfcontributionconfigurationsfilter', 'admin\LgfContributionConfigurationsController@filter');

//MembershipFeeConfigurations routes .....

Route::resource('admin/membershipfeeconfigurations','admin\MembershipFeeConfigurationsController');

Route::get('/admin/membershipfeeconfigurationsreport', 'admin\MembershipFeeConfigurationsController@report');

Route::post('/admin/membershipfeeconfigurationsfilter', 'admin\MembershipFeeConfigurationsController@filter');

//MembershipFees routes .....

Route::resource('admin/membershipfees','admin\MembershipFeesController');

Route::get('/admin/membershipfeesreport', 'admin\MembershipFeesController@report');

Route::post('/admin/membershipfeesfilter', 'admin\MembershipFeesController@filter');

//ManagesClientLgfContributions routes .....

Route::resource('admin/managesclientlgfcontributions','admin\ManagesClientLgfContributionsController');

Route::get('/admin/managesclientlgfcontributionsreport', 'admin\ManagesClientLgfContributionsController@report');

Route::post('/admin/managesclientlgfcontributionsfilter', 'admin\ManagesClientLgfContributionsController@filter');

//ClientLgfContributions routes .....

Route::resource('admin/clientlgfcontributions','admin\ClientLgfContributionsController');

Route::get('/admin/clientlgfcontributionsreport', 'admin\ClientLgfContributionsController@report');

Route::post('/admin/clientlgfcontributionsfilter', 'admin\ClientLgfContributionsController@filter');

//TransactionTypes routes .....

Route::resource('admin/transactiontypes','admin\TransactionTypesController');

Route::get('/admin/transactiontypesreport', 'admin\TransactionTypesController@report');

Route::post('/admin/transactiontypesfilter', 'admin\TransactionTypesController@filter');

//EntryTypes routes .....

Route::resource('admin/entrytypes','admin\EntryTypesController');

Route::get('/admin/entrytypesreport', 'admin\EntryTypesController@report');

Route::post('/admin/entrytypesfilter', 'admin\EntryTypesController@filter');

//GeneralLedgers routes .....

Route::resource('admin/generalledgers','admin\GeneralLedgersController');
Route::get('/admin/generalledgersreport', 'admin\GeneralLedgersController@report');
Route::post('/admin/generalledgersfilter', 'admin\GeneralLedgersController@filter');


//Clients routes .....

Route::resource('admin/clients','admin\ClientsController');

Route::get('/admin/clientsreport', 'admin\ClientsController@report');

Route::post('/admin/clientsfilter', 'admin\ClientsController@filter');

Route::resource('admin/client/enquiry/category','EnquiryCategoryController', ['as' => 'client.enquiry']);
Route::resource('admin/client/enquiry/catalog','EnquiryController', ['as' => 'client.enquiry']);

//LoanPaymentFrequencies routes .....

Route::resource('admin/loanpaymentfrequencies','admin\LoanPaymentFrequenciesController');

Route::get('/admin/loanpaymentfrequenciesreport', 'admin\LoanPaymentFrequenciesController@report');

Route::post('/admin/loanpaymentfrequenciesfilter', 'admin\LoanPaymentFrequenciesController@filter');

//Loans routes .....

Route::resource('admin/loans','admin\LoansController');
Route::get('/admin/loans/reschedual/{loan}/{product}', 'admin\LoansController@loanreschedule')->name('loans.reschedule');

// Route::resource('/cashbook/performance', 'CashbookPerformanceController', ['as' => 'cashbook']);
Route::get('/performance/client', 'PerformanceController@client')->name('performance.client');
Route::post('/performance/download/client', 'PerformanceController@downloadClient')->name('performance.client.download');
Route::get('/performance/disbursement', 'PerformanceController@disbursement')->name('performance.disbursement');
Route::post('/performance/download/disbursement', 'PerformanceController@downloadDisbursement')->name('performance.disbursement.download');
Route::get('/performance/interest/collection', 'PerformanceController@interestCollection')->name('performance.interest.collection');
Route::post('/performance/download/interest/collection', 'PerformanceController@downloadInterestCollection')->name('performance.interest.collection.download');
Route::get('/performance/loan/collection', 'PerformanceController@loanCollection')->name('performance.loan.collection');
Route::post('/performance/download/loan/collection', 'PerformanceController@downloadLoanCollection')->name('performance.loan.collection.download');
Route::get('/performance/processing/fees', 'PerformanceController@processingFee')->name('performance.processing.fee');
Route::post('/performance/download/processing/fees', 'PerformanceController@downloadProcessingFee')->name('performance.processing.fee.download');
Route::get('/performance/loan/guarantee/fund', 'PerformanceController@loanGuaranteeFund')->name('performance.loan.guarantee.fund');
Route::post('/performance/download/loan/guarantee/fund', 'PerformanceController@downloadLoanGuaranteeFund')->name('performance.loan.guarantee.fund.download');

Route::resource('admin/loanfine','LoanFineController');

Route::get("admin/getoverralloanbalance/{clientid}","admin\LoansController@getoverralloanbalance");

Route::get("admin/getloanbalancebyid/{id}","admin\LoansController@getloanbalancebyid");


Route::get('/admin/loansreport', 'admin\LoansController@report');
Route::get('/admin/loanapproval/{id}', 'admin\ApproveLoansController@loanApproval');
Route::post('/admin/getloans', 'admin\LoansController@getloans');

Route::post('/admin/getloanlist', 'admin\LoansController@getloanlist');

Route::post('/admin/loansfilter', 'admin\LoansController@filter');
Route::post('/admin/approveloan', 'admin\ApproveLoansController@approveLoan');
Route::post('/admin/loanscount', 'admin\LoansController@getLoansCount');
Route::post('/admin/getinterestcharged', 'admin\LoansController@getInterestChargedbyrequest');
Route::post('/admin/gettotalloanamount', 'admin\LoansController@getTotalLoanAmountbyrequest');
Route::post('/admin/getamounttobedisbursed', 'admin\LoansController@getAmountToBeDisbursedbyrequest');
Route::post('/admin/getloanschedule/', 'admin\LoansController@getloanschedulebyrequest');

Route::post('/admin/getclearingfee', 'admin\LoansController@getclearingfeebyrequest');
Route::post('/admin/getinsurancedeductionfee', 'admin\LoansController@getinsurancedeductionfeebyrequest');
Route::post('/admin/getprocessingfee', 'admin\LoansController@getprocessingfeebyrequest');
Route::get('/admin/loanapplicationproducts/', 'admin\LoansController@loanapplicationproducts');
Route::get('/admin/loanapplicationclienttypes/{productId}', 'admin\LoansController@loanapplicationclienttypes');
Route::get('/admin/loanapplicationclients/{productId}/{clientTypeId}', 'admin\LoansController@loanapplicationclients')->name('loanapplicationclients');
Route::get('/admin/loanapplication/{productId}/{clientId}', 'admin\LoansController@loanapplication')->name('loanapplication');
Route::get('/admin/getprocessingfeebalance/{loanid}','admin\LoansController@getprocessingfeebalance');

//LoanStatuses routes .....

Route::resource('admin/loanstatuses','admin\LoanStatusesController');

Route::get('/admin/loanstatusesreport', 'admin\LoanStatusesController@report');

Route::post('/admin/loanstatusesfilter', 'admin\LoanStatusesController@filter');

//GuarantorRelationships routes .....

Route::resource('admin/guarantorrelationships','admin\GuarantorRelationshipsController');

Route::get('/admin/guarantorrelationshipsreport', 'admin\GuarantorRelationshipsController@report');

Route::post('/admin/guarantorrelationshipsfilter', 'admin\GuarantorRelationshipsController@filter');

//Guarantors routes .....

Route::resource('admin/guarantors','admin\GuarantorsController');

Route::get('/admin/guarantorsreport', 'admin\GuarantorsController@report');
Route::get('/admin/getguarantorbyidno/{idNumber}/{client}', 'admin\GuarantorsController@getguarantorbyidno');

Route::post('/admin/guarantorsfilter', 'admin\GuarantorsController@filter');

Route::resource('admin/standing/order','StandingOrderController', ['as' => 'standing']);


//LoanGuarantors routes .....

Route::resource('admin/loanguarantors','admin\LoanGuarantorsController');

Route::get('/admin/loanguarantorsreport', 'admin\LoanGuarantorsController@report');

Route::post('/admin/loanguarantorsfilter', 'admin\LoanGuarantorsController@filter');

//LoanDocuments routes .....

Route::resource('admin/loandocuments','admin\LoanDocumentsController');

Route::get('/admin/loandocumentsreport', 'admin\LoanDocumentsController@report');

Route::post('/admin/loandocumentsfilter', 'admin\LoanDocumentsController@filter');

//CollateralCategories routes .....

Route::resource('admin/collateralcategories','admin\CollateralCategoriesController');

Route::get('/admin/collateralcategoriesreport', 'admin\CollateralCategoriesController@report');

Route::post('/admin/collateralcategoriesfilter', 'admin\CollateralCategoriesController@filter');

//LoanCollaterals routes .....

Route::resource('admin/loancollaterals','admin\LoanCollateralsController');

Route::get('/admin/loancollateralsreport', 'admin\LoanCollateralsController@report');

Route::post('/admin/loancollateralsfilter', 'admin\LoanCollateralsController@filter');

//LoanProductApprovalLevels routes .....

Route::resource('admin/loanproductapprovallevels','admin\LoanProductApprovalLevelsController');

Route::get('/admin/loanproductapprovallevelsreport', 'admin\LoanProductApprovalLevelsController@report');

Route::post('/admin/loanproductapprovallevelsfilter', 'admin\LoanProductApprovalLevelsController@filter');

//ApprovalStatuses routes .....

Route::resource('admin/approvalstatuses','admin\ApprovalStatusesController');

Route::get('/admin/approvalstatusesreport', 'admin\ApprovalStatusesController@report');

Route::post('/admin/approvalstatusesfilter', 'admin\ApprovalStatusesController@filter');

//LoanApprovals routes .....

Route::resource('admin/loanapprovals','admin\LoanApprovalsController');

Route::get('/admin/loanapprovalsreport', 'admin\LoanApprovalsController@report');

Route::post('/admin/loanapprovalsfilter', 'admin\LoanApprovalsController@filter');

//DisbursementStatuses routes .....

Route::resource('admin/disbursementstatuses','admin\DisbursementStatusesController');

Route::get('/admin/disbursementstatusesreport', 'admin\DisbursementStatusesController@report');

Route::post('/admin/disbursementstatusesfilter', 'admin\DisbursementStatusesController@filter');

//LoanDisbursements routes .....

Route::resource('admin/loandisbursements','admin\LoanDisbursementsController');

Route::get('/admin/loandisbursementsreport', 'admin\LoanDisbursementsController@report');

Route::post('/admin/loandisbursementsfilter', 'admin\LoanDisbursementsController@filter');

Route::post('/admin/getloandisbursementlist', 'admin\LoanDisbursementsController@getloandisbursementlist');

//ProductDisbursementConfigurations routes .....

Route::resource('admin/productdisbursementconfigurations','admin\ProductDisbursementConfigurationsController');

Route::get('/admin/productdisbursementconfigurationsreport', 'admin\ProductDisbursementConfigurationsController@report');

Route::post('/admin/productdisbursementconfigurationsfilter', 'admin\ProductDisbursementConfigurationsController@filter');

//ProductDisbursementConfigurations routes .....

Route::resource('admin/productdisbursementconfigurations','admin\ProductDisbursementConfigurationsController');

Route::get('/admin/productdisbursementconfigurationsreport', 'admin\ProductDisbursementConfigurationsController@report');

Route::post('/admin/productdisbursementconfigurationsfilter', 'admin\ProductDisbursementConfigurationsController@filter');

//LoanPayments routes .....

Route::resource('admin/loanpayments','admin\LoanPaymentsController');

Route::get('/admin/loanpaymentsreport', 'admin\LoanPaymentsController@report');

Route::post('/admin/loanpaymentsfilter', 'admin\LoanPaymentsController@filter');

//FinePayments routes .....

Route::resource('admin/finepayments','admin\FinePaymentsController');

Route::get('/admin/finepaymentsreport', 'admin\FinePaymentsController@report');

Route::post('/admin/finepaymentsfilter', 'admin\FinePaymentsController@filter');

Route::resource('expenseconfiguration','ExpenseConfigurationController');
Route::resource('expense','ExpenseController');

//LgfToLgfTransferes routes .....

Route::resource('admin/lgftolgftransferes','admin\LgfToLgfTransfersController');

Route::get('/admin/lgftolgftransferesreport', 'admin\LgfToLgfTransfersController@report');

Route::post('/admin/lgftolgftransferesfilter', 'admin\LgfToLgfTransfersController@filter');

//LgfWithdrawalModes routes .....

// Route::resource('admin/lgfwithdrawalmodes','admin\LgfWithdrawalModesController');

// Route::get('/admin/lgfwithdrawalmodesreport', 'admin\LgfWithdrawalModesController@report');

// Route::post('/admin/lgfwithdrawalmodesfilter', 'admin\LgfWithdrawalModesController@filter');

//LgfWithdrawals routes .....

// Route::resource('admin/lgfwithdrawals','admin\LgfWithdrawalsController');

// Route::get('/admin/lgfwithdrawalsreport', 'admin\LgfWithdrawalsController@report');

// Route::post('/admin/lgfwithdrawalsfilter', 'admin\LgfWithdrawalsController@filter');

//LgfToLoans routes .....

// Route::resource('admin/lgftoloans','admin\LgfToLoansController');

// Route::get('/admin/lgftoloansreport', 'admin\LgfToLoansController@report');

// Route::post('/admin/lgftoloansfilter', 'admin\LgfToLoansController@filter');

//LgfToFines routes .....

// Route::resource('admin/lgftofines','admin\LgfToFinesController');

// Route::get('/admin/lgftofinesreport', 'admin\LgfToFinesController@report');

// Route::post('/admin/lgftofinesfilter', 'admin\LgfToFinesController@filter');

//ProductDisbursementConfigurations routes .....

Route::resource('admin/productdisbursementconfigurations','admin\ProductDisbursementConfigurationsController');

Route::get('/admin/productdisbursementconfigurationsreport', 'admin\ProductDisbursementConfigurationsController@report');

Route::post('/admin/productdisbursementconfigurationsfilter', 'admin\ProductDisbursementConfigurationsController@filter');

//ProductInterestConfigurations routes .....

Route::resource('admin/productinterestconfigurations','admin\ProductInterestConfigurationsController');

Route::get('/admin/productinterestconfigurationsreport', 'admin\ProductInterestConfigurationsController@report');

Route::post('/admin/productinterestconfigurationsfilter', 'admin\ProductInterestConfigurationsController@filter');

//ProductPrincipalConfigurations routes .....

Route::resource('admin/productprincipalconfigurations','admin\ProductPrincipalConfigurationsController');

Route::get('/admin/productprincipalconfigurationsreport', 'admin\ProductPrincipalConfigurationsController@report');

Route::post('/admin/productprincipalconfigurationsfilter', 'admin\ProductPrincipalConfigurationsController@filter');

//ProductPrincipalConfigurations routes .....

Route::resource('admin/productprincipalconfigurations','admin\ProductPrincipalConfigurationsController');

Route::get('/admin/productprincipalconfigurationsreport', 'admin\ProductPrincipalConfigurationsController@report');

Route::post('/admin/productprincipalconfigurationsfilter', 'admin\ProductPrincipalConfigurationsController@filter');

//ProductPrincipalConfigurations routes .....

Route::resource('admin/productprincipalconfigurations','admin\ProductPrincipalConfigurationsController');

Route::get('/admin/productprincipalconfigurationsreport', 'admin\ProductPrincipalConfigurationsController@report');

Route::post('/admin/productprincipalconfigurationsfilter', 'admin\ProductPrincipalConfigurationsController@filter');

//OtherPaymentTypes routes .....

Route::resource('admin/otherpaymenttypes','admin\OtherPaymentTypesController');

Route::get('/admin/otherpaymenttypesreport', 'admin\OtherPaymentTypesController@report');

Route::post('/admin/otherpaymenttypesfilter', 'admin\OtherPaymentTypesController@filter');

//OtherPayments routes .....

Route::resource('admin/otherpayments','admin\OtherPaymentsController');

Route::get('/admin/otherpaymentsreport', 'admin\OtherPaymentsController@report');

Route::post('/admin/otherpaymentsfilter', 'admin\OtherPaymentsController@filter');

//ClientOfficers routes .....

Route::resource('admin/clientofficers','admin\ClientOfficersController');

Route::get('/admin/clientofficersreport', 'admin\ClientOfficersController@report');

Route::post('/admin/clientofficersfilter', 'admin\ClientOfficersController@filter');


//Reports

Route::get('admin/trialbalance/{pageIndex}/{pageSize}','admin\TrialBalanceController@page');
Route::get('admin/balancesheet/{pageIndex}/{pageSize}','admin\BalanceSheetController@page');
Route::get('admin/profitandloss/{pageIndex}/{pageSize}','admin\ProfitAndLossController@page');
//Accounts routes .....

Route::resource('admin/accounts','admin\AccountsController');

Route::get('/admin/accountsreport', 'admin\AccountsController@report');

Route::post('/admin/accountsfilter', 'admin\AccountsController@filter');

//LoanPayments routes .....

Route::resource('admin/loanpayments','admin\LoanPaymentsController');

Route::get('/admin/loanpaymentsreport', 'admin\LoanPaymentsController@report');

Route::post('/admin/loanpaymentsfilter', 'admin\LoanPaymentsController@filter');

//Titles routes .....

Route::resource('admin/titles','admin\TitlesController');

Route::get('/admin/titlesreport', 'admin\TitlesController@report');

Route::post('/admin/titlesfilter', 'admin\TitlesController@filter');

//Salutations routes .....

Route::resource('admin/salutations','admin\SalutationsController');

Route::get('/admin/salutationsreport', 'admin\SalutationsController@report');

Route::post('/admin/salutationsfilter', 'admin\SalutationsController@filter');

//ClientTypeMembershipFees routes .....

Route::resource('admin/clienttypemembershipfees','admin\ClientTypeMembershipFeesController');

Route::get('/admin/clienttypemembershipfeesreport', 'admin\ClientTypeMembershipFeesController@report');

Route::post('/admin/clienttypemembershipfeesfilter', 'admin\ClientTypeMembershipFeesController@filter');

Route::post('/admin/getclienttypemembershipfees', 'admin\ClientTypeMembershipFeesController@getclienttypemembershipfees');

//ChangeGroupRequests routes .....

Route::resource('admin/changegrouprequests','admin\ChangeGroupRequestsController');

Route::get('/admin/changegrouprequestsreport', 'admin\ChangeGroupRequestsController@report');

Route::post('/admin/changegrouprequestsfilter', 'admin\ChangeGroupRequestsController@filter');

//ChangeGroupRequestStatuses routes .....

Route::resource('admin/changegrouprequeststatuses','admin\ChangeGroupRequestStatusesController');

Route::get('/admin/changegrouprequeststatusesreport', 'admin\ChangeGroupRequestStatusesController@report');

Route::post('/admin/changegrouprequeststatusesfilter', 'admin\ChangeGroupRequestStatusesController@filter');

//ChangeGroupRequests routes .....

Route::resource('admin/changegrouprequests','admin\ChangeGroupRequestsController');

Route::get('/admin/changegrouprequestsreport', 'admin\ChangeGroupRequestsController@report');

Route::post('/admin/changegrouprequestsfilter', 'admin\ChangeGroupRequestsController@filter');

//ChangeGroupRequests routes .....

Route::resource('admin/changegrouprequests','admin\ChangeGroupRequestsController');

Route::get('/admin/changegrouprequestsreport', 'admin\ChangeGroupRequestsController@report');

Route::post('/admin/changegrouprequestsfilter', 'admin\ChangeGroupRequestsController@filter');

//ChangeGroupRequests routes .....

Route::resource('admin/changegrouprequests','admin\ChangeGroupRequestsController');

Route::get('/admin/changegrouprequestsreport', 'admin\ChangeGroupRequestsController@report');

Route::post('/admin/changegrouprequestsfilter', 'admin\ChangeGroupRequestsController@filter');

//ChangeTypeRequestStatuses routes .....

Route::resource('admin/changetyperequeststatuses','admin\ChangeTypeRequestStatusesController');

Route::get('/admin/changetyperequeststatusesreport', 'admin\ChangeTypeRequestStatusesController@report');

Route::post('/admin/changetyperequeststatusesfilter', 'admin\ChangeTypeRequestStatusesController@filter');

//ChangeTypeRequests routes .....

Route::resource('admin/changetyperequests','admin\ChangeTypeRequestsController');

Route::get('/admin/changetyperequestsreport', 'admin\ChangeTypeRequestsController@report');

Route::post('/admin/changetyperequestsfilter', 'admin\ChangeTypeRequestsController@filter');

//GroupStatuses routes .....

Route::resource('admin/groupstatuses','admin\GroupStatusesController');

Route::get('/admin/groupstatusesreport', 'admin\GroupStatusesController@report');

Route::post('/admin/groupstatusesfilter', 'admin\GroupStatusesController@filter');

//Industries routes .....

Route::resource('admin/industries','admin\IndustriesController');

Route::get('/admin/industriesreport', 'admin\IndustriesController@report');

Route::post('/admin/industriesfilter', 'admin\IndustriesController@filter');

//GracePeriodTypes routes .....

Route::resource('admin/graceperiodtypes','admin\GracePeriodTypesController');

Route::get('/admin/graceperiodtypesreport', 'admin\GracePeriodTypesController@report');

Route::post('/admin/graceperiodtypesfilter', 'admin\GracePeriodTypesController@filter');

Route::get('/admin/getgraceperiodtype/{id}', 'admin\GracePeriodTypesController@get');

//ProductPrincipalConfigurations routes .....

Route::resource('admin/productprincipalconfigurations','admin\ProductPrincipalConfigurationsController');

Route::get('/admin/productprincipalconfigurationsreport', 'admin\ProductPrincipalConfigurationsController@report');

Route::post('/admin/productprincipalconfigurationsfilter', 'admin\ProductPrincipalConfigurationsController@filter');

//ProductApprovalLevels routes .....

// Route::resource('admin/productapprovallevels','admin\ProductApprovalLevelsController');

// Route::get('/admin/productapprovallevelsreport', 'admin\ProductApprovalLevelsController@report');

// Route::post('/admin/productapprovallevelsfilter', 'admin\ProductApprovalLevelsController@filter');

//ProductApprovalLevels routes .....

// Route::resource('admin/productapprovallevels','admin\ProductApprovalLevelsController');

// Route::get('/admin/productapprovallevelsreport', 'admin\ProductApprovalLevelsController@report');

// Route::post('/admin/productapprovallevelsfilter', 'admin\ProductApprovalLevelsController@filter');

//ProductApprovalConfigurations routes .....

Route::resource('admin/productapprovalconfigurations','admin\ProductApprovalConfigurationsController');

Route::get('/admin/productapprovalconfigurationsreport', 'admin\ProductApprovalConfigurationsController@report');

Route::post('/admin/productapprovalconfigurationsfilter', 'admin\ProductApprovalConfigurationsController@filter');

//FeePaymentTypes routes .....

Route::resource('admin/feepaymenttypes','admin\FeePaymentTypesController');

Route::get('/admin/feepaymenttypesreport', 'admin\FeePaymentTypesController@report');

Route::get('/admin/getfeepaymenttype/{id}', 'admin\FeePaymentTypesController@getfeepaymenttype');

Route::post('/admin/feepaymenttypesfilter', 'admin\FeePaymentTypesController@filter');

//FeeTypes routes .....

Route::resource('admin/feetypes','admin\FeeTypesController');

Route::get('/admin/feetypesreport', 'admin\FeeTypesController@report');

Route::post('/admin/feetypesfilter', 'admin\FeeTypesController@filter');

//InsuranceDeductionConfigurations routes .....

Route::resource('admin/insurancedeductionconfigurations','admin\InsuranceDeductionConfigurationsController');

Route::get('/admin/insurancedeductionconfigurationsreport', 'admin\InsuranceDeductionConfigurationsController@report');

Route::post('/admin/insurancedeductionconfigurationsfilter', 'admin\InsuranceDeductionConfigurationsController@filter');

Route::post('/admin/checkinsurancedeductionconfiguration', 'admin\InsuranceDeductionConfigurationsController@check');

//ClearingFeeConfigurations routes .....

Route::resource('admin/clearingfeeconfigurations','admin\ClearingFeeConfigurationsController');

Route::get('/admin/clearingfeeconfigurationsreport', 'admin\ClearingFeeConfigurationsController@report');

Route::post('/admin/clearingfeeconfigurationsfilter', 'admin\ClearingFeeConfigurationsController@filter');

//ProductFineConfigurations routes .....

Route::resource('admin/productfineconfigurations','admin\ProductFineConfigurationsController');

Route::get('/admin/productfineconfigurationsreport', 'admin\ProductFineConfigurationsController@report');

Route::post('/admin/productfineconfigurationsfilter', 'admin\ProductFineConfigurationsController@filter');

//ProductConfigurations routes .....

Route::resource('admin/productconfigurations','admin\ProductConfigurationsController');

Route::get('/admin/productconfigurationsreport', 'admin\ProductConfigurationsController@report');

Route::post('/admin/productconfigurationsfilter', 'admin\ProductConfigurationsController@filter');

//FineConfigurations routes .....

Route::resource('admin/fineconfigurations','admin\FineConfigurationsController');

Route::get('/admin/fineconfigurationsreport', 'admin\FineConfigurationsController@report');

Route::post('/admin/fineconfigurationsfilter', 'admin\FineConfigurationsController@filter');

//FinePaymentConfigurations routes .....

Route::resource('admin/finepaymentconfigurations','admin\FinePaymentConfigurationsController');

Route::get('/admin/finepaymentconfigurationsreport', 'admin\FinePaymentConfigurationsController@report');

Route::post('/admin/finepaymentconfigurationsfilter', 'admin\FinePaymentConfigurationsController@filter');

//InsuranceDeductionsConfigurations routes .....

// Route::resource('admin/insurancedeductionsconfigurations','admin\InsuranceDeductionsConfigurationsController');

// Route::get('/admin/insurancedeductionsconfigurationsreport', 'admin\InsuranceDeductionsConfigurationsController@report');

// Route::post('/admin/insurancedeductionsconfigurationsfilter', 'admin\InsuranceDeductionsConfigurationsController@filter');

//InsuranceDeductionConfigurations routes .....

Route::resource('admin/insurancedeductionconfigurations','admin\InsuranceDeductionConfigurationsController');

Route::get('/admin/insurancedeductionconfigurationsreport', 'admin\InsuranceDeductionConfigurationsController@report');

Route::post('/admin/insurancedeductionconfigurationsfilter', 'admin\InsuranceDeductionConfigurationsController@filter');

//ClearingFeeConfigurations routes .....

Route::resource('admin/clearingfeeconfigurations','admin\ClearingFeeConfigurationsController');

Route::get('/admin/clearingfeeconfigurationsreport', 'admin\ClearingFeeConfigurationsController@report');

Route::post('/admin/clearingfeeconfigurationsfilter', 'admin\ClearingFeeConfigurationsController@filter');

//InsuranceDeductionConfigurations routes .....

Route::resource('admin/insurancedeductionconfigurations','admin\InsuranceDeductionConfigurationsController');

Route::get('/admin/insurancedeductionconfigurationsreport', 'admin\InsuranceDeductionConfigurationsController@report');

Route::post('/admin/insurancedeductionconfigurationsfilter', 'admin\InsuranceDeductionConfigurationsController@filter');

//InsuranceDeductionConfigurations routes .....

Route::resource('admin/insurancedeductionconfigurations','admin\InsuranceDeductionConfigurationsController');

Route::get('/admin/insurancedeductionconfigurationsreport', 'admin\InsuranceDeductionConfigurationsController@report');

Route::post('/admin/insurancedeductionconfigurationsfilter', 'admin\InsuranceDeductionConfigurationsController@filter');

//ClearingFeeConfigurations routes .....

Route::resource('admin/clearingfeeconfigurations','admin\ClearingFeeConfigurationsController');

Route::get('/admin/clearingfeeconfigurationsreport', 'admin\ClearingFeeConfigurationsController@report');

Route::post('/admin/clearingfeeconfigurationsfilter', 'admin\ClearingFeeConfigurationsController@filter');

//InsuranceDeductionConfigurations routes .....

Route::resource('admin/insurancedeductionconfigurations','admin\InsuranceDeductionConfigurationsController');

Route::get('/admin/insurancedeductionconfigurationsreport', 'admin\InsuranceDeductionConfigurationsController@report');

Route::post('/admin/insurancedeductionconfigurationsfilter', 'admin\InsuranceDeductionConfigurationsController@filter');

//ClearingFeeConfigurations routes .....

Route::resource('admin/clearingfeeconfigurations','admin\ClearingFeeConfigurationsController');

Route::get('/admin/clearingfeeconfigurationsreport', 'admin\ClearingFeeConfigurationsController@report');

Route::post('/admin/clearingfeeconfigurationsfilter', 'admin\ClearingFeeConfigurationsController@filter');

//ProductUserAccounts routes .....

Route::resource('admin/productuseraccounts','admin\ProductUserAccountsController');

Route::get('/admin/productuseraccountsreport', 'admin\ProductUserAccountsController@report');

Route::post('/admin/productuseraccountsfilter', 'admin\ProductUserAccountsController@filter');

//ProductClientTypes routes .....

Route::resource('admin/productclienttypes','admin\ProductClientTypesController');

Route::get('/admin/productclienttypesreport', 'admin\ProductClientTypesController@report');

Route::post('/admin/productclienttypesfilter', 'admin\ProductClientTypesController@filter');

//ProductClientTypeConfigurations routes .....

Route::resource('admin/productclienttypeconfigurations','admin\ProductClientTypeConfigurationsController');

Route::get('/admin/productclienttypeconfigurationsreport', 'admin\ProductClientTypeConfigurationsController@report');

Route::post('/admin/productclienttypeconfigurationsfilter', 'admin\ProductClientTypeConfigurationsController@filter');

//ProductDisbursementModes routes .....

Route::resource('admin/productdisbursementmodes','admin\ProductDisbursementModesController');

Route::get('/admin/productdisbursementmodesreport', 'admin\ProductDisbursementModesController@report');
Route::get('/admin/getproductdisbursementmode/{id}', 'admin\ProductDisbursementModesController@getproductdisbursementmode');

Route::post('/admin/productdisbursementmodesfilter', 'admin\ProductDisbursementModesController@filter');

//ProductDisbursementConfigurations routes .....

Route::resource('admin/productdisbursementconfigurations','admin\ProductDisbursementConfigurationsController');

Route::get('/admin/productdisbursementconfigurationsreport', 'admin\ProductDisbursementConfigurationsController@report');

Route::post('/admin/productdisbursementconfigurationsfilter', 'admin\ProductDisbursementConfigurationsController@filter');

//ProductDisbursementConfigurations routes .....

Route::resource('admin/productdisbursementconfigurations','admin\ProductDisbursementConfigurationsController');

Route::get('/admin/productdisbursementconfigurationsreport', 'admin\ProductDisbursementConfigurationsController@report');

Route::post('/admin/productdisbursementconfigurationsfilter', 'admin\ProductDisbursementConfigurationsController@filter');

//LgfTypes routes .....

Route::resource('admin/lgftypes','admin\LgfTypesController');

Route::get('/admin/lgftypesreport', 'admin\LgfTypesController@report');

Route::post('/admin/lgftypesfilter', 'admin\LgfTypesController@filter');

//InterestPeriods routes .....

Route::resource('admin/interestperiods','admin\InterestPeriodsController');

Route::get('/admin/interestperiodsreport', 'admin\InterestPeriodsController@report');

Route::post('/admin/interestperiodsfilter', 'admin\InterestPeriodsController@filter');

//InterestRatePeriods routes .....

Route::resource('admin/interestrateperiods','admin\InterestRatePeriodsController');

Route::get('/admin/interestrateperiodsreport', 'admin\InterestRatePeriodsController@report');

Route::post('/admin/interestrateperiodsfilter', 'admin\InterestRatePeriodsController@filter');

//InterestRatePeriods routes .....

Route::resource('admin/interestrateperiods','admin\InterestRatePeriodsController');

Route::get('/admin/interestrateperiodsreport', 'admin\InterestRatePeriodsController@report');

Route::post('/admin/interestrateperiodsfilter', 'admin\InterestRatePeriodsController@filter');

//ClearingFeePayments routes .....

Route::resource('admin/clearingfeepayments','admin\ClearingFeePaymentsController');

Route::get('/admin/clearingfeepaymentsreport', 'admin\ClearingFeePaymentsController@report');

Route::post('/admin/clearingfeepaymentsfilter', 'admin\ClearingFeePaymentsController@filter');

//InsuranceDeductionFeePayments routes .....

Route::resource('admin/insurancedeductionfeepayments','admin\InsuranceDeductionFeePaymentsController');

Route::get('/admin/insurancedeductionfeepaymentsreport', 'admin\InsuranceDeductionFeePaymentsController@report');

Route::post('/admin/insurancedeductionfeepaymentsfilter', 'admin\InsuranceDeductionFeePaymentsController@filter');


Route::get('admin/pendinginsurancedeductionfee/{id}','admin\PendingInsuranceDeductionFeeController@payment');
Route::get('admin/pendinginsurancedeductionfee','admin\PendingInsuranceDeductionFeeController@index');



//DefaulterMeters routes .....

Route::resource('admin/defaultermeters','admin\DefaulterMetersController');

Route::get('/admin/defaultermetersreport', 'admin\DefaulterMetersController@report');

Route::post('/admin/defaultermetersfilter', 'admin\DefaulterMetersController@filter');

//DefaulterMeters routes .....

Route::resource('admin/defaultermeters','admin\DefaulterMetersController');

Route::get('/admin/defaultermetersreport', 'admin\DefaulterMetersController@report');

Route::post('/admin/defaultermetersfilter', 'admin\DefaulterMetersController@filter');

//CollateralValueType routes .....

Route::resource('admin/collateralvaluetype','admin\CollateralValueTypeController');

Route::get('/admin/collateralvaluetypereport', 'admin\CollateralValueTypeController@report');

Route::post('/admin/collateralvaluetypefilter', 'admin\CollateralValueTypeController@filter');

//CollateralValueTypes routes .....

Route::resource('admin/collateralvaluetypes','admin\CollateralValueTypesController');

Route::get('/admin/collateralvaluetypesreport', 'admin\CollateralValueTypesController@report');

Route::post('/admin/collateralvaluetypesfilter', 'admin\CollateralValueTypesController@filter');

//DisbursementCharges routes .....

Route::resource('admin/disbursementcharges','admin\DisbursementChargesController');

Route::get('/admin/disbursementchargesreport', 'admin\DisbursementChargesController@report');

Route::post('/admin/disbursementchargesfilter', 'admin\DisbursementChargesController@filter');

//DisbursementChargesConfigurations routes .....

Route::resource('admin/disbursementchargesconfigurations','admin\DisbursementChargesConfigurationsController');

Route::get('/admin/disbursementchargesconfigurationsreport', 'admin\DisbursementChargesConfigurationsController@report');

Route::post('/admin/disbursementchargesconfigurationsfilter', 'admin\DisbursementChargesConfigurationsController@filter');

//DisbursementChargeTypes routes .....

Route::resource('admin/disbursementchargetypes','admin\DisbursementChargeTypesController');

Route::get('/admin/disbursementchargetypesreport', 'admin\DisbursementChargeTypesController@report');

Route::post('/admin/disbursementchargetypesfilter', 'admin\DisbursementChargeTypesController@filter');

//ProcessingFeeConfigurations routes .....

Route::resource('admin/processingfeeconfigurations','admin\ProcessingFeeConfigurationsController');

Route::get('/admin/processingfeeconfigurationsreport', 'admin\ProcessingFeeConfigurationsController@report');

Route::post('/admin/processingfeeconfigurationsfilter', 'admin\ProcessingFeeConfigurationsController@filter');

//Minimum_lgf_types routes .....

// Route::resource('admin/minimum_lgf_types','admin\Minimum_lgf_typesController');

// Route::get('/admin/minimum_lgf_typesreport', 'admin\Minimum_lgf_typesController@report');

// Route::post('/admin/minimum_lgf_typesfilter', 'admin\Minimum_lgf_typesController@filter');

//MinimumLGFTypes routes .....

// Route::resource('admin/minimumlgftypes','admin\MinimumLGFTypesController');

// Route::get('/admin/minimumlgftypesreport', 'admin\MinimumLGFTypesController@report');

// Route::post('/admin/minimumlgftypesfilter', 'admin\MinimumLGFTypesController@filter');

//MinimumLgfTypes routes .....

// Route::resource('admin/minimumlgftypes','admin\MinimumLgfTypesController');

// Route::get('/admin/minimumlgftypesreport', 'admin\MinimumLgfTypesController@report');

// Route::post('/admin/minimumlgftypesfilter', 'admin\MinimumLgfTypesController@filter');

//Trash routes .....

Route::resource('admin/trash','admin\TrashController');

Route::get('/admin/trashreport', 'admin\TrashController@report');

Route::post('/admin/trashfilter', 'admin\TrashController@filter');

//Trashes routes .....

Route::resource('admin/trashes','admin\TrashesController');

Route::get('/admin/trashesreport', 'admin\TrashesController@report');

Route::post('/admin/trashesfilter', 'admin\TrashesController@filter');

//ProductPrincipalConfigurations routes .....

Route::resource('admin/productprincipalconfigurations','admin\ProductPrincipalConfigurationsController');

Route::get('/admin/productprincipalconfigurationsreport', 'admin\ProductPrincipalConfigurationsController@report');

Route::post('/admin/productprincipalconfigurationsfilter', 'admin\ProductPrincipalConfigurationsController@filter');

//InsuranceDeductionApprovalLevels routes .....

Route::resource('admin/insurancedeductionapprovallevels','admin\InsuranceDeductionApprovalLevelsController');

Route::get('/admin/insurancedeductionapprovallevelsreport', 'admin\InsuranceDeductionApprovalLevelsController@report');

Route::post('/admin/insurancedeductionapprovallevelsfilter', 'admin\InsuranceDeductionApprovalLevelsController@filter');

//InsuranceDeductionApprovals routes .....

Route::resource('admin/insurancedeductionapprovals','admin\InsuranceDeductionApprovalsController');

Route::get('/admin/insurancedeductionapprovalsreport', 'admin\InsuranceDeductionApprovalsController@report');

Route::post('/admin/insurancedeductionapprovalsfilter', 'admin\InsuranceDeductionApprovalsController@filter');

//ProcessingFeePayments routes .....

Route::resource('admin/processingfeepayments','admin\ProcessingFeePaymentsController');

Route::get('/admin/processingfeepaymentsreport', 'admin\ProcessingFeePaymentsController@report');

Route::post('/admin/processingfeepaymentsfilter', 'admin\ProcessingFeePaymentsController@filter');

//ClearingFeePayments routes .....

Route::resource('admin/clearingfeepayments','admin\ClearingFeePaymentsController');

Route::get('/admin/clearingfeepaymentsreport', 'admin\ClearingFeePaymentsController@report');

Route::post('/admin/clearingfeepaymentsfilter', 'admin\ClearingFeePaymentsController@filter');

//ProcessingFeeApprovalLevels routes .....

Route::resource('admin/processingfeeapprovallevels','admin\ProcessingFeeApprovalLevelsController');

Route::get('/admin/processingfeeapprovallevelsreport', 'admin\ProcessingFeeApprovalLevelsController@report');

Route::post('/admin/processingfeeapprovallevelsfilter', 'admin\ProcessingFeeApprovalLevelsController@filter');

//ClearingFeeApprovalLevels routes .....

Route::resource('admin/clearingfeeapprovallevels','admin\ClearingFeeApprovalLevelsController');

Route::get('/admin/clearingfeeapprovallevelsreport', 'admin\ClearingFeeApprovalLevelsController@report');

Route::post('/admin/clearingfeeapprovallevelsfilter', 'admin\ClearingFeeApprovalLevelsController@filter');

//ProcessingFeeApprovals routes .....

Route::resource('admin/processingfeeapprovals','admin\ProcessingFeeApprovalsController');

Route::get('/admin/processingfeeapprovalsreport', 'admin\ProcessingFeeApprovalsController@report');

Route::post('/admin/processingfeeapprovalsfilter', 'admin\ProcessingFeeApprovalsController@filter');

//ClearingFeeApprovals routes .....

Route::resource('admin/clearingfeeapprovals','admin\ClearingFeeApprovalsController');

Route::get('/admin/clearingfeeapprovalsreport', 'admin\ClearingFeeApprovalsController@report');

Route::post('/admin/clearingfeeapprovalsfilter', 'admin\ClearingFeeApprovalsController@filter');

//InsuranceDeductionFeePayments routes .....

Route::resource('admin/insurancedeductionfeepayments','admin\InsuranceDeductionFeePaymentsController');

Route::get('/admin/insurancedeductionfeepaymentsreport', 'admin\InsuranceDeductionFeePaymentsController@report');

Route::post('/admin/insurancedeductionfeepaymentsfilter', 'admin\InsuranceDeductionFeePaymentsController@filter');

//InsuranceDeductionPayments routes .....

Route::resource('admin/insurancedeductionpayments','admin\InsuranceDeductionPaymentsController');

Route::get('/admin/insurancedeductionpaymentsreport', 'admin\InsuranceDeductionPaymentsController@report');

Route::post('/admin/insurancedeductionpaymentsfilter', 'admin\InsuranceDeductionPaymentsController@filter');

//ProcessingFeePayments routes .....

Route::resource('admin/processingfeepayments','admin\ProcessingFeePaymentsController');

Route::get('/admin/processingfeepaymentsreport', 'admin\ProcessingFeePaymentsController@report');

Route::post('/admin/processingfeepaymentsfilter', 'admin\ProcessingFeePaymentsController@filter');

//ClearingFeePayments routes .....

Route::resource('admin/clearingfeepayments','admin\ClearingFeePaymentsController');

Route::get('/admin/clearingfeepaymentsreport', 'admin\ClearingFeePaymentsController@report');

Route::post('/admin/clearingfeepaymentsfilter', 'admin\ClearingFeePaymentsController@filter');

//InsuranceDeductionApprovals routes .....

Route::resource('admin/insurancedeductionapprovals','admin\InsuranceDeductionApprovalsController');

Route::get('/admin/insurancedeductionapprovalsreport', 'admin\InsuranceDeductionApprovalsController@report');

Route::post('/admin/insurancedeductionapprovalsfilter', 'admin\InsuranceDeductionApprovalsController@filter');

//ProcessingFeePayments routes .....

Route::resource('admin/processingfeepayments','admin\ProcessingFeePaymentsController');

Route::get('/admin/processingfeepaymentsreport', 'admin\ProcessingFeePaymentsController@report');

Route::post('/admin/processingfeepaymentsfilter', 'admin\ProcessingFeePaymentsController@filter');

//ProcessingFeeApprovals routes .....

Route::resource('admin/processingfeeapprovals','admin\ProcessingFeeApprovalsController');

Route::get('/admin/processingfeeapprovalsreport', 'admin\ProcessingFeeApprovalsController@report');

Route::post('/admin/processingfeeapprovalsfilter', 'admin\ProcessingFeeApprovalsController@filter');

//ClearingFeeApprovals routes .....

Route::resource('admin/clearingfeeapprovals','admin\ClearingFeeApprovalsController');

Route::get('/admin/clearingfeeapprovalsreport', 'admin\ClearingFeeApprovalsController@report');

Route::post('/admin/clearingfeeapprovalsfilter', 'admin\ClearingFeeApprovalsController@filter');

//ProcessingFeePayments routes .....

Route::resource('admin/processingfeepayments','admin\ProcessingFeePaymentsController');

Route::get('/admin/processingfeepaymentsreport', 'admin\ProcessingFeePaymentsController@report');

Route::post('/admin/processingfeepaymentsfilter', 'admin\ProcessingFeePaymentsController@filter');

// get insurance deduction fee - ajax
Route::post('/admin/getloaninsuarancedeductionfee', 'admin\JengaController@loaninsuarancedeductionfee');
// get loan clearing fee- ajax
Route::post('/admin/getloanclearingfee', 'admin\JengaController@loanclearingfee');
// get loan proccessing fee- ajax
Route::post('/admin/getloanprocessingfee', 'admin\JengaController@loanprocessingfee');


//  General Report
Route::get('/wp/genaral_report/ptr/{groups}', 'GeneralReportsController@ptr')->name('general.report.ptr');
Route::get('/wp/genaral_report/loan/statement/{loan}', 'GeneralReportsController@loan_statement')->name('general.report.loan.statement');
Route::get('/wp/genaral_report/group/payment', 'GeneralReportsController@group_payment')->name('general.report.group.payment');
Route::get('/wp/genaral_report/cashbook', 'GeneralReportsController@cashbook')->name('general.report.cashbook');
Route::get('/wp/genaral_report/lgf/statement', 'GeneralReportsController@lgf_statement')->name('general.report.lgf.statement');

//Suppliers routes .....

Route::resource('admin/suppliers','admin\SuppliersController');

Route::get('/admin/suppliersreport', 'admin\SuppliersController@report');

Route::post('/admin/suppliersfilter', 'admin\SuppliersController@filter');

//ProductCategories routes .....

Route::resource('admin/productcategories','admin\ProductCategoriesController');

Route::get('/admin/productcategoriesreport', 'admin\ProductCategoriesController@report');

Route::post('/admin/productcategoriesfilter', 'admin\ProductCategoriesController@filter');

//ProductBrands routes .....

Route::resource('admin/productbrands','admin\ProductBrandsController');

Route::get('/admin/productbrandsreport', 'admin\ProductBrandsController@report');

Route::post('/admin/productbrandsfilter', 'admin\ProductBrandsController@filter');

//Products routes .....

Route::resource('admin/products','admin\ProductsController');

Route::get('/admin/productsreport', 'admin\ProductsController@report');

Route::post('/admin/productsfilter', 'admin\ProductsController@filter');

Route::get('/admin/getproductbyid/{id}', 'admin\ProductsController@getproduct');

Route::get('/admin/getproductnumber', 'admin\ProductsController@getproductnumber');

//Purchases routes .....

Route::resource('admin/purchases','admin\PurchasesController');

Route::get('/admin/purchasesreport', 'admin\PurchasesController@report');

Route::post('/admin/purchasesfilter', 'admin\PurchasesController@filter');

//Purchases routes .....

Route::resource('admin/purchases','admin\PurchasesController');

Route::get('/admin/purchasesreport', 'admin\PurchasesController@report');

Route::post('/admin/purchasesfilter', 'admin\PurchasesController@filter');

//PurchaseOrders routes .....

Route::resource('admin/purchaseorders','admin\PurchaseOrdersController');

Route::get('/admin/purchaseordersreport', 'admin\PurchaseOrdersController@report');

Route::post('/admin/purchaseordersfilter', 'admin\PurchaseOrdersController@filter');

Route::get('/admin/getpurchaseorderlines/{id}', 'admin\PurchaseOrdersController@getpurchaseorderlines');

Route::get('/admin/getpurchaseorderpayments/{id}', 'admin\PurchaseOrdersController@getpurchaseorderpayments');

Route::get('/admin/createpurchaseorderpayment/{id}', 'admin\PurchaseOrdersController@createpurchaseorderpayment');

Route::post('/admin/storepurchaseorderpayment/{id}', 'admin\PurchaseOrdersController@storepurchaseorderpayment');

Route::get('/admin/getpurchaseordernumber', 'admin\PurchaseOrdersController@getpurchaseordernumber');

Route::get('/admin/approvepurchaseorder/{id}', 'admin\PurchaseOrdersController@approve');

Route::post('/admin/purchaseorderapproval/{id}', 'admin\PurchaseOrdersController@approval');

//PurchaseOrderLines routes .....

Route::resource('admin/purchaseorderlines','admin\PurchaseOrderLinesController');

Route::get('/admin/purchaseorderlinesreport', 'admin\PurchaseOrderLinesController@report');

Route::post('/admin/purchaseorderlinesfilter', 'admin\PurchaseOrderLinesController@filter');

//PurchaseOrderPayments routes .....

Route::resource('admin/purchaseorderpayments','admin\PurchaseOrderPaymentsController');

Route::get('/admin/purchaseorderpaymentsreport', 'admin\PurchaseOrderPaymentsController@report');

Route::post('/admin/purchaseorderpaymentsfilter', 'admin\PurchaseOrderPaymentsController@filter');

//OrderStatuses routes .....

Route::resource('admin/orderstatuses','admin\OrderStatusesController');

Route::get('/admin/orderstatusesreport', 'admin\OrderStatusesController@report');

Route::post('/admin/orderstatusesfilter', 'admin\OrderStatusesController@filter');

//ProductPaymentConfigurations routes .....

Route::resource('admin/productpaymentconfigurations','admin\ProductPaymentConfigurationsController');

Route::get('/admin/productpaymentconfigurationsreport', 'admin\ProductPaymentConfigurationsController@report');

Route::post('/admin/productpaymentconfigurationsfilter', 'admin\ProductPaymentConfigurationsController@filter');

//PurchaseOrderAccountMapping routes .....

// Route::resource('admin/purchaseorderaccountmapping','admin\PurchaseOrderAccountMappingController');

// Route::get('/admin/purchaseorderaccountmappingreport', 'admin\PurchaseOrderAccountMappingController@report');

// Route::post('/admin/purchaseorderaccountmappingfilter', 'admin\PurchaseOrderAccountMappingController@filter');

//PurchaseOrderAccountMappings routes .....

Route::resource('admin/purchaseorderaccountmappings','admin\PurchaseOrderAccountMappingsController');

Route::get('/admin/purchaseorderaccountmappingsreport', 'admin\PurchaseOrderAccountMappingsController@report');

Route::post('/admin/purchaseorderaccountmappingsfilter', 'admin\PurchaseOrderAccountMappingsController@filter');

//SalesOrders routes .....

Route::resource('admin/salesorders','admin\SalesOrdersController');

Route::get('/admin/salesordersreport', 'admin\SalesOrdersController@report');

Route::post('/admin/salesordersfilter', 'admin\SalesOrdersController@filter');

Route::get('/admin/getsalesorderlines/{id}', 'admin\SalesOrdersController@getsalesorderlines');

Route::get('/admin/getsalesorderpayments/{id}', 'admin\SalesOrdersController@getsalesorderpayments');

Route::get('/admin/createsalesorderpayments/{id}', 'admin\SalesOrdersController@createsalesorderpayments');

Route::post('/admin/storesalesorderpayments/{id}', 'admin\SalesOrdersController@storesalesorderpayments');

Route::get('/admin/getsalesordernumber', 'admin\SalesOrdersController@getsalesordernumber');

//SalesOrderLines routes .....

Route::resource('admin/salesorderlines','admin\SalesOrderLinesController');

Route::get('/admin/salesorderlinesreport', 'admin\SalesOrderLinesController@report');

Route::post('/admin/salesorderlinesfilter', 'admin\SalesOrderLinesController@filter');

//SalesOrderPayments routes .....

Route::resource('admin/salesorderpayments','admin\SalesOrderPaymentsController');

Route::get('/admin/salesorderpaymentsreport', 'admin\SalesOrderPaymentsController@report');

Route::post('/admin/salesorderpaymentsfilter', 'admin\SalesOrderPaymentsController@filter');

//ProductStocks routes .....

Route::resource('admin/productstocks','admin\ProductStocksController');

Route::get('/admin/productstocksreport', 'admin\ProductStocksController@report');

Route::post('/admin/productstocksfilter', 'admin\ProductStocksController@filter');

Route::get('/admin/getstockbystoreid/{id}', 'admin\ProductStocksController@getstockbystoreid');

Route::get('/admin/getstockbyproductidandstoreid/{productid}/{stockid}', 'admin\ProductStocksController@getstockbyproductidandstoreid');

//ProductStocks routes .....

Route::resource('admin/productstocks','admin\ProductStocksController');

Route::get('/admin/productstocksreport', 'admin\ProductStocksController@report');

Route::post('/admin/productstocksfilter', 'admin\ProductStocksController@filter');

//ProductStocks routes .....

Route::resource('admin/productstocks','admin\ProductStocksController');

Route::get('/admin/productstocksreport', 'admin\ProductStocksController@report');

Route::post('/admin/productstocksfilter', 'admin\ProductStocksController@filter');

//ProductStocks routes .....

Route::resource('admin/productstocks','admin\ProductStocksController');

Route::get('/admin/productstocksreport', 'admin\ProductStocksController@report');

Route::post('/admin/productstocksfilter', 'admin\ProductStocksController@filter');

//SalesOrderAccountMappings routes .....

Route::resource('admin/salesorderaccountmappings','admin\SalesOrderAccountMappingsController');

Route::get('/admin/salesorderaccountmappingsreport', 'admin\SalesOrderAccountMappingsController@report');

Route::post('/admin/salesorderaccountmappingsfilter', 'admin\SalesOrderAccountMappingsController@filter');

//Stores routes .....

Route::resource('admin/stores','admin\StoresController');

Route::get('/admin/storesreport', 'admin\StoresController@report');

Route::post('/admin/storesfilter', 'admin\StoresController@filter');

Route::get('/admin/getstorenumber', 'admin\StoresController@getstorenumber');

//ProductStocks routes .....

Route::resource('admin/productstocks','admin\ProductStocksController');

Route::get('/admin/productstocksreport', 'admin\ProductStocksController@report');

Route::post('/admin/productstocksfilter', 'admin\ProductStocksController@filter');

//ProductTransfers routes .....

Route::resource('admin/producttransfers','admin\ProductTransfersController');

Route::get('/admin/producttransfersreport', 'admin\ProductTransfersController@report');

Route::post('/admin/producttransfersfilter', 'admin\ProductTransfersController@filter');

//PurchaseOrderApprovalMappings routes .....

Route::resource('admin/purchaseorderapprovalmappings','admin\PurchaseOrderApprovalMappingsController');

Route::get('/admin/purchaseorderapprovalmappingsreport', 'admin\PurchaseOrderApprovalMappingsController@report');

Route::post('/admin/purchaseorderapprovalmappingsfilter', 'admin\PurchaseOrderApprovalMappingsController@filter');

//PurchaseOrderApprovals routes .....

Route::resource('admin/purchaseorderapprovals','admin\PurchaseOrderApprovalsController');

Route::get('/admin/purchaseorderapprovalsreport', 'admin\PurchaseOrderApprovalsController@report');

Route::post('/admin/purchaseorderapprovalsfilter', 'admin\PurchaseOrderApprovalsController@filter');

//Stores routes .....

Route::resource('admin/stores','admin\StoresController');

Route::get('/admin/storesreport', 'admin\StoresController@report');

Route::post('/admin/storesfilter', 'admin\StoresController@filter');

//Stores routes .....

Route::resource('admin/stores','admin\StoresController');

Route::get('/admin/storesreport', 'admin\StoresController@report');

Route::post('/admin/storesfilter', 'admin\StoresController@filter');

//Stores routes .....

Route::resource('admin/stores','admin\StoresController');

Route::get('/admin/storesreport', 'admin\StoresController@report');

Route::post('/admin/storesfilter', 'admin\StoresController@filter');

//ProductStocks routes .....

Route::resource('admin/productstocks','admin\ProductStocksController');

Route::get('/admin/productstocksreport', 'admin\ProductStocksController@report');

Route::post('/admin/productstocksfilter', 'admin\ProductStocksController@filter');

//ProductStocks routes .....

Route::resource('admin/productstocks','admin\ProductStocksController');

Route::get('/admin/productstocksreport', 'admin\ProductStocksController@report');

Route::post('/admin/productstocksfilter', 'admin\ProductStocksController@filter');

//ProductTransfers routes .....

Route::resource('admin/producttransfers','admin\ProductTransfersController');

Route::get('/admin/producttransfersreport', 'admin\ProductTransfersController@report');

Route::post('/admin/producttransfersfilter', 'admin\ProductTransfersController@filter');

//PurchaseOrderApprovalMappings routes .....

Route::resource('admin/purchaseorderapprovalmappings','admin\PurchaseOrderApprovalMappingsController');

Route::get('/admin/purchaseorderapprovalmappingsreport', 'admin\PurchaseOrderApprovalMappingsController@report');

Route::post('/admin/purchaseorderapprovalmappingsfilter', 'admin\PurchaseOrderApprovalMappingsController@filter');

//PurchaseOrderApprovalMappings routes .....

Route::resource('admin/purchaseorderapprovalmappings','admin\PurchaseOrderApprovalMappingsController');

Route::get('/admin/purchaseorderapprovalmappingsreport', 'admin\PurchaseOrderApprovalMappingsController@report');

Route::post('/admin/purchaseorderapprovalmappingsfilter', 'admin\PurchaseOrderApprovalMappingsController@filter');

//PurchaseOrderApprovalMappings routes .....

Route::resource('admin/purchaseorderapprovalmappings','admin\PurchaseOrderApprovalMappingsController');

Route::get('/admin/purchaseorderapprovalmappingsreport', 'admin\PurchaseOrderApprovalMappingsController@report');

Route::post('/admin/purchaseorderapprovalmappingsfilter', 'admin\PurchaseOrderApprovalMappingsController@filter');

//PurchaseOrderAccountMappings routes .....

Route::resource('admin/purchaseorderaccountmappings','admin\PurchaseOrderAccountMappingsController');

Route::get('/admin/purchaseorderaccountmappingsreport', 'admin\PurchaseOrderAccountMappingsController@report');

Route::post('/admin/purchaseorderaccountmappingsfilter', 'admin\PurchaseOrderAccountMappingsController@filter');

//PurchaseOrderAccountMappings routes .....

Route::resource('admin/purchaseorderaccountmappings','admin\PurchaseOrderAccountMappingsController');

Route::get('/admin/purchaseorderaccountmappingsreport', 'admin\PurchaseOrderAccountMappingsController@report');

Route::post('/admin/purchaseorderaccountmappingsfilter', 'admin\PurchaseOrderAccountMappingsController@filter');

//Loan Statement

Route::resource('admin/loanstatement','admin\LoanStatementController');

// Route::resource('admin/cashbook','admin\CashBookController');

Route::resource('admin/paymentmodesreport','admin\PaymentModesReportController');

Route::resource('admin/lgfstatement','admin\LgfStatementController');

//ProductTransferStatuses routes .....

Route::resource('admin/producttransferstatuses','admin\ProductTransferStatusesController');

Route::get('/admin/producttransferstatusesreport', 'admin\ProductTransferStatusesController@report');

Route::post('/admin/producttransferstatusesfilter', 'admin\ProductTransferStatusesController@filter');

//SalesOrderMarginAccountMappings routes .....

Route::resource('admin/salesordermarginaccountmappings','admin\SalesOrderMarginAccountMappingsController');

Route::get('/admin/salesordermarginaccountmappingsreport', 'admin\SalesOrderMarginAccountMappingsController@report');

Route::post('/admin/salesordermarginaccountmappingsfilter', 'admin\SalesOrderMarginAccountMappingsController@filter');

//LoanProductAssets routes .....

Route::resource('admin/loanproductassets','admin\LoanProductAssetsController');

Route::get('/admin/loanproductassetsreport', 'admin\LoanProductAssetsController@report');

Route::post('/admin/loanproductassetsfilter', 'admin\LoanProductAssetsController@filter');

//LoanProductAssets routes .....

Route::resource('admin/loanproductassets','admin\LoanProductAssetsController');

Route::get('/admin/loanproductassetsreport', 'admin\LoanProductAssetsController@report');

Route::post('/admin/loanproductassetsfilter', 'admin\LoanProductAssetsController@filter');

//LgfTransferTypes routes .....

Route::resource('admin/lgftransfertypes','admin\LgfTransferTypesController');

Route::get('/admin/lgftransfertypesreport', 'admin\LgfTransferTypesController@report');

Route::post('/admin/lgftransfertypesfilter', 'admin\LgfTransferTypesController@filter');

//LgfTransferTypes routes .....

Route::resource('admin/lgftransfertypes','admin\LgfTransferTypesController');

Route::get('/admin/lgftransfertypesreport', 'admin\LgfTransferTypesController@report');

Route::post('/admin/lgftransfertypesfilter', 'admin\LgfTransferTypesController@filter');

//LgfTransferTypes routes .....

Route::resource('admin/lgftransfertypes','admin\LgfTransferTypesController');

Route::get('/admin/lgftransfertypesreport', 'admin\LgfTransferTypesController@report');

Route::post('/admin/lgftransfertypesfilter', 'admin\LgfTransferTypesController@filter');

//LgfTransferTypes routes .....

Route::resource('admin/lgftransfertypes','admin\LgfTransferTypesController');

Route::get('/admin/lgftransfertypesreport', 'admin\LgfTransferTypesController@report');

Route::post('/admin/lgftransfertypesfilter', 'admin\LgfTransferTypesController@filter');

//LgfTransferTypes routes .....

Route::resource('admin/lgftransfertypes','admin\LgfTransferTypesController');

Route::get('/admin/lgftransfertypesreport', 'admin\LgfTransferTypesController@report');

Route::post('/admin/lgftransfertypesfilter', 'admin\LgfTransferTypesController@filter');

//OtherPaymentTypeAccountMappings routes .....

Route::resource('admin/otherpaymenttypeaccountmappings','admin\OtherPaymentTypeAccountMappingsController');

Route::get('/admin/otherpaymenttypeaccountmappingsreport', 'admin\OtherPaymentTypeAccountMappingsController@report');

Route::post('/admin/otherpaymenttypeaccountmappingsfilter', 'admin\OtherPaymentTypeAccountMappingsController@filter');

//OtherPaymentTypeAccountMappings routes .....

Route::resource('admin/otherpaymenttypeaccountmappings','admin\OtherPaymentTypeAccountMappingsController');

Route::get('/admin/otherpaymenttypeaccountmappingsreport', 'admin\OtherPaymentTypeAccountMappingsController@report');

Route::post('/admin/otherpaymenttypeaccountmappingsfilter', 'admin\OtherPaymentTypeAccountMappingsController@filter');

//OtherPaymentTypeAccountMappings routes .....

Route::resource('admin/otherpaymenttypeaccountmappings','admin\OtherPaymentTypeAccountMappingsController');

Route::get('/admin/otherpaymenttypeaccountmappingsreport', 'admin\OtherPaymentTypeAccountMappingsController@report');

Route::post('/admin/otherpaymenttypeaccountmappingsfilter', 'admin\OtherPaymentTypeAccountMappingsController@filter');

//LgfTransferApprovalLevels routes .....

Route::resource('admin/lgftransferapprovallevels','admin\LgfTransferApprovalLevelsController');

Route::get('/admin/lgftransferapprovallevelsreport', 'admin\LgfTransferApprovalLevelsController@report');

Route::post('/admin/lgftransferapprovallevelsfilter', 'admin\LgfTransferApprovalLevelsController@filter');

//LgfToLgfTransfers routes .....

Route::resource('admin/lgftolgftransfers','admin\LgfToLgfTransfersController');

Route::get('/admin/lgftolgftransfersreport', 'admin\LgfToLgfTransfersController@report');

Route::post('/admin/lgftolgftransfersfilter', 'admin\LgfToLgfTransfersController@filter');

Route::get('/admin/getlgftolgftransactionnumber', 'admin\LgfToLgfTransfersController@getlgftolgftransactionnumber');

//LgfTransferApprovals routes .....

Route::resource('admin/lgftransferapprovals','admin\LgfTransferApprovalsController');

Route::get('/admin/lgftransferapprovalsreport', 'admin\LgfTransferApprovalsController@report');

Route::post('/admin/lgftransferapprovalsfilter', 'admin\LgfTransferApprovalsController@filter');

//LgfToLoanTransfers routes .....

Route::resource('admin/lgftoloantransfers','admin\LgfToLoanTransfersController');

Route::get('/admin/lgftoloantransfersreport', 'admin\LgfToLoanTransfersController@report');

Route::post('/admin/lgftoloantransfersfilter', 'admin\LgfToLoanTransfersController@filter');

Route::get('/admin/getlgftoloantransactionnumber', 'admin\LgfToLoanTransfersController@getlgftoloantransactionnumber');

//LgfToFineTransfers routes .....

Route::resource('admin/lgftofinetransfers','admin\LgfToFineTransfersController');

Route::get('/admin/lgftofinetransfersreport', 'admin\LgfToFineTransfersController@report');

Route::post('/admin/lgftofinetransfersfilter', 'admin\LgfToFineTransfersController@filter');

Route::get('/admin/getlgftofinetransactionnumber', 'admin\LgfToFineTransfersController@getlgftofinetransactionnumber');

//MobileMoneyGateways routes .....

Route::resource('admin/mobilemoneygateways','admin\MobileMoneyGatewaysController');

Route::get('/admin/mobilemoneygatewaysreport', 'admin\MobileMoneyGatewaysController@report');

Route::post('/admin/mobilemoneygatewaysfilter', 'admin\MobileMoneyGatewaysController@filter');

//LgfToMobileMoneyTransfers routes .....

Route::resource('admin/lgftomobilemoneytransfers','admin\LgfToMobileMoneyTransfersController');

Route::get('/admin/lgftomobilemoneytransfersreport', 'admin\LgfToMobileMoneyTransfersController@report');

Route::post('/admin/lgftomobilemoneytransfersfilter', 'admin\LgfToMobileMoneyTransfersController@filter');

Route::get('/admin/getlgftomobiletransactionnumber', 'admin\LgfToMobileMoneyTransfersController@getlgftomobiletransactionnumber');

//TransactionGateways routes .....

Route::resource('admin/transactiongateways','admin\TransactionGatewaysController');

Route::get('/admin/transactiongatewaysreport', 'admin\TransactionGatewaysController@report');

Route::post('/admin/transactiongatewaysfilter', 'admin\TransactionGatewaysController@filter');

//WithdrawalModes routes .....

Route::resource('admin/withdrawalmodes','admin\WithdrawalModesController');

Route::get('/admin/withdrawalmodesreport', 'admin\WithdrawalModesController@report');

Route::post('/admin/withdrawalmodesfilter', 'admin\WithdrawalModesController@filter');

//AccountToAccountTransfers routes .....

Route::resource('admin/accounttoaccounttransfers','admin\AccountToAccountTransfersController');

Route::get('/admin/accounttoaccounttransfersreport', 'admin\AccountToAccountTransfersController@report');

Route::post('/admin/accounttoaccounttransfersfilter', 'admin\AccountToAccountTransfersController@filter');

Route::get('/admin/getacttoacttransactionnumber', 'admin\AccountToAccountTransfersController@getacttoacttransactionnumber');

//AccountTransferApprovalLevels routes .....

Route::resource('admin/accounttransferapprovallevels','admin\AccountTransferApprovalLevelsController');

Route::get('/admin/accounttransferapprovallevelsreport', 'admin\AccountTransferApprovalLevelsController@report');

Route::post('/admin/accounttransferapprovallevelsfilter', 'admin\AccountTransferApprovalLevelsController@filter');

//LoanTransferApprovalLevels routes .....

Route::resource('admin/loantransferapprovallevels','admin\LoanTransferApprovalLevelsController');

Route::get('/admin/loantransferapprovallevelsreport', 'admin\LoanTransferApprovalLevelsController@report');

Route::post('/admin/loantransferapprovallevelsfilter', 'admin\LoanTransferApprovalLevelsController@filter');

//FineTransferApprovalLevels routes .....

Route::resource('admin/finetransferapprovallevels','admin\FineTransferApprovalLevelsController');

Route::get('/admin/finetransferapprovallevelsreport', 'admin\FineTransferApprovalLevelsController@report');

Route::post('/admin/finetransferapprovallevelsfilter', 'admin\FineTransferApprovalLevelsController@filter');

//LoanTransferApprovals routes .....

Route::resource('admin/loantransferapprovals','admin\LoanTransferApprovalsController');

Route::get('/admin/loantransferapprovalsreport', 'admin\LoanTransferApprovalsController@report');

Route::post('/admin/loantransferapprovalsfilter', 'admin\LoanTransferApprovalsController@filter');

//FineTransferApprovals routes .....

Route::resource('admin/finetransferapprovals','admin\FineTransferApprovalsController');

Route::get('/admin/finetransferapprovalsreport', 'admin\FineTransferApprovalsController@report');

Route::post('/admin/finetransferapprovalsfilter', 'admin\FineTransferApprovalsController@filter');

//MobileMoneyTransferApprovalLevels routes .....

Route::resource('admin/mobilemoneytransferapprovallevels','admin\MobileMoneyTransferApprovalLevelsController');

Route::get('/admin/mobilemoneytransferapprovallevelsreport', 'admin\MobileMoneyTransferApprovalLevelsController@report');

Route::post('/admin/mobilemoneytransferapprovallevelsfilter', 'admin\MobileMoneyTransferApprovalLevelsController@filter');

//MobileMoneyTransferApprovals routes .....

Route::resource('admin/mobilemoneytransferapprovals','admin\MobileMoneyTransferApprovalsController');

Route::get('/admin/mobilemoneytransferapprovalsreport', 'admin\MobileMoneyTransferApprovalsController@report');

Route::post('/admin/mobilemoneytransferapprovalsfilter', 'admin\MobileMoneyTransferApprovalsController@filter');

//LgfToLoanTransfers routes .....

Route::resource('admin/lgftoloantransfers','admin\LgfToLoanTransfersController');

Route::get('/admin/lgftoloantransfersreport', 'admin\LgfToLoanTransfersController@report');

Route::post('/admin/lgftoloantransfersfilter', 'admin\LgfToLoanTransfersController@filter');

//LgfToFineTransfers routes .....

Route::resource('admin/lgftofinetransfers','admin\LgfToFineTransfersController');

Route::get('/admin/lgftofinetransfersreport', 'admin\LgfToFineTransfersController@report');

Route::post('/admin/lgftofinetransfersfilter', 'admin\LgfToFineTransfersController@filter');

//LoanTransferApprovals routes .....

Route::resource('admin/loantransferapprovals','admin\LoanTransferApprovalsController');

Route::get('/admin/loantransferapprovalsreport', 'admin\LoanTransferApprovalsController@report');

Route::post('/admin/loantransferapprovalsfilter', 'admin\LoanTransferApprovalsController@filter');

//FineTransferApprovalLevels routes .....

Route::resource('admin/finetransferapprovallevels','admin\FineTransferApprovalLevelsController');

Route::get('/admin/finetransferapprovallevelsreport', 'admin\FineTransferApprovalLevelsController@report');

Route::post('/admin/finetransferapprovallevelsfilter', 'admin\FineTransferApprovalLevelsController@filter');

//FineTransferApprovals routes .....

Route::resource('admin/finetransferapprovals','admin\FineTransferApprovalsController');

Route::get('/admin/finetransferapprovalsreport', 'admin\FineTransferApprovalsController@report');

Route::post('/admin/finetransferapprovalsfilter', 'admin\FineTransferApprovalsController@filter');

//AccountTransferApprovals routes .....

Route::resource('admin/accounttransferapprovals','admin\AccountTransferApprovalsController');

Route::get('/admin/accounttransferapprovalsreport', 'admin\AccountTransferApprovalsController@report');

Route::post('/admin/accounttransferapprovalsfilter', 'admin\AccountTransferApprovalsController@filter');

//WithdrawalChargeConfigurations routes .....

Route::resource('admin/withdrawalchargeconfigurations','admin\WithdrawalChargeConfigurationsController');

Route::get('/admin/withdrawalchargeconfigurationsreport', 'admin\WithdrawalChargeConfigurationsController@report');

Route::post('/admin/withdrawalchargeconfigurationsfilter', 'admin\WithdrawalChargeConfigurationsController@filter');

//MobileMoneyModes routes .....

Route::resource('admin/mobilemoneymodes','admin\MobileMoneyModesController');

Route::get('/admin/mobilemoneymodesreport', 'admin\MobileMoneyModesController@report');

Route::post('/admin/mobilemoneymodesfilter', 'admin\MobileMoneyModesController@filter');

//MobileMoneyChargeConfigurations routes .....

Route::resource('admin/mobilemoneychargeconfigurations','admin\MobileMoneyChargeConfigurationsController');

Route::get('/admin/mobilemoneychargeconfigurationsreport', 'admin\MobileMoneyChargeConfigurationsController@report');

Route::post('/admin/mobilemoneychargeconfigurationsfilter', 'admin\MobileMoneyChargeConfigurationsController@filter');

Route::get('/admin/getmobilemoneytransactioncharge/{clientid}/{mobilemoneymodeid}/{amount}', 'admin\MobileMoneyChargeConfigurationsController@gettransactioncharge');

//LgfToMobileMoneyApprovalLevels routes .....

Route::resource('admin/lgftomobilemoneyapprovallevels','admin\LgfToMobileMoneyApprovalLevelsController');

Route::get('/admin/lgftomobilemoneyapprovallevelsreport', 'admin\LgfToMobileMoneyApprovalLevelsController@report');

Route::post('/admin/lgftomobilemoneyapprovallevelsfilter', 'admin\LgfToMobileMoneyApprovalLevelsController@filter');

//LgfToMobileMoneyApprovals routes .....

Route::resource('admin/lgftomobilemoneyapprovals','admin\LgfToMobileMoneyApprovalsController');

Route::get('/admin/lgftomobilemoneyapprovalsreport', 'admin\LgfToMobileMoneyApprovalsController@report');

Route::post('/admin/lgftomobilemoneyapprovalsfilter', 'admin\LgfToMobileMoneyApprovalsController@filter');

//MobileMoneyTransferApprovalLevels routes .....

Route::resource('admin/mobilemoneytransferapprovallevels','admin\MobileMoneyTransferApprovalLevelsController');

Route::get('/admin/mobilemoneytransferapprovallevelsreport', 'admin\MobileMoneyTransferApprovalLevelsController@report');

Route::post('/admin/mobilemoneytransferapprovallevelsfilter', 'admin\MobileMoneyTransferApprovalLevelsController@filter');

//MobileMoneyTransferApprovals routes .....

Route::resource('admin/mobilemoneytransferapprovals','admin\MobileMoneyTransferApprovalsController');

Route::get('/admin/mobilemoneytransferapprovalsreport', 'admin\MobileMoneyTransferApprovalsController@report');

Route::post('/admin/mobilemoneytransferapprovalsfilter', 'admin\MobileMoneyTransferApprovalsController@filter');

//MobileMoneyChargeScales routes .....

Route::resource('admin/mobilemoneychargescales','admin\MobileMoneyChargeScalesController');

Route::get('/admin/mobilemoneychargescalesreport', 'admin\MobileMoneyChargeScalesController@report');

Route::post('/admin/mobilemoneychargescalesfilter', 'admin\MobileMoneyChargeScalesController@filter');

//MobileMoneyTransferConfigurations routes .....

Route::resource('admin/mobilemoneytransferconfigurations','admin\MobileMoneyTransferConfigurationsController');

Route::get('/admin/mobilemoneytransferconfigurationsreport', 'admin\MobileMoneyTransferConfigurationsController@report');

Route::post('/admin/mobilemoneytransferconfigurationsfilter', 'admin\MobileMoneyTransferConfigurationsController@filter');

//MobileMoneyTransactionChargeConfigurations routes .....

Route::resource('admin/mmtransactionchargeconfigurations','admin\MobileMoneyTransactionChargeConfigurationsController');

Route::get('/admin/mobilemoneytransactionchargeconfigurationsreport', 'admin\MobileMoneyTransactionChargeConfigurationsController@report');

Route::post('/admin/mobilemoneytransactionchargeconfigurationsfilter', 'admin\MobileMoneyTransactionChargeConfigurationsController@filter');

//LgfToBankTransfers routes .....

Route::resource('admin/lgftobanktransfers','admin\LgfToBankTransfersController');

Route::get('/admin/lgftobanktransfersreport', 'admin\LgfToBankTransfersController@report');

Route::post('/admin/lgftobanktransfersfilter', 'admin\LgfToBankTransfersController@filter');

Route::get('/admin/getlgftobanktransactionnumber', 'admin\LgfToBankTransfersController@getlgftobanktransactionnumber');

//LgfToInventoryTransfers routes .....

Route::resource('admin/lgftoinventorytransfers','admin\LgfToInventoryTransfersController');

Route::get('/admin/lgftoinventorytransfersreport', 'admin\LgfToInventoryTransfersController@report');

Route::post('/admin/lgftoinventorytransfersfilter', 'admin\LgfToInventoryTransfersController@filter');

Route::get('/admin/getgftoinventorytransactionnumber', 'admin\LgfToInventoryTransfersController@getgftoinventorytransactionnumber');

//InventoryTransferApprovalLevels routes .....

Route::resource('admin/inventorytransferapprovallevels','admin\InventoryTransferApprovalLevelsController');

Route::get('/admin/inventorytransferapprovallevelsreport', 'admin\InventoryTransferApprovalLevelsController@report');

Route::post('/admin/inventorytransferapprovallevelsfilter', 'admin\InventoryTransferApprovalLevelsController@filter');

//BankTransferApprovalLevels routes .....

Route::resource('admin/banktransferapprovallevels','admin\BankTransferApprovalLevelsController');

Route::get('/admin/banktransferapprovallevelsreport', 'admin\BankTransferApprovalLevelsController@report');

Route::post('/admin/banktransferapprovallevelsfilter', 'admin\BankTransferApprovalLevelsController@filter');

//InventoryTransferApprovals routes .....

Route::resource('admin/inventorytransferapprovals','admin\InventoryTransferApprovalsController');

Route::get('/admin/inventorytransferapprovalsreport', 'admin\InventoryTransferApprovalsController@report');

Route::post('/admin/inventorytransferapprovalsfilter', 'admin\InventoryTransferApprovalsController@filter');

//BankTransferApprovals routes .....

Route::resource('admin/banktransferapprovals','admin\BankTransferApprovalsController');

Route::get('/admin/banktransferapprovalsreport', 'admin\BankTransferApprovalsController@report');

Route::post('/admin/banktransferapprovalsfilter', 'admin\BankTransferApprovalsController@filter');

//BankTransferCharges routes .....

Route::resource('admin/banktransfercharges','admin\BankTransferChargesController');

Route::get('/admin/banktransferchargesreport', 'admin\BankTransferChargesController@report');

Route::post('/admin/banktransferchargesfilter', 'admin\BankTransferChargesController@filter');

Route::get('/admin/getbanktransactioncharges/{clientid}/{amount}', 'admin\BankTransferChargesController@getbanktransactioncharges');



//BankTransferCharges routes .....

Route::resource('admin/banktransfercharges','admin\BankTransferChargesController');

Route::get('/admin/banktransferchargesreport', 'admin\BankTransferChargesController@report');

Route::post('/admin/banktransferchargesfilter', 'admin\BankTransferChargesController@filter');

//BankTransferChargeScales routes .....

Route::resource('admin/banktransferchargescales','admin\BankTransferChargeScalesController');

Route::get('/admin/banktransferchargescalesreport', 'admin\BankTransferChargeScalesController@report');

Route::post('/admin/banktransferchargescalesfilter', 'admin\BankTransferChargeScalesController@filter');

//BankTransferConfigurations routes .....

Route::resource('admin/banktransferconfigurations','admin\BankTransferConfigurationsController');

Route::get('/admin/banktransferconfigurationsreport', 'admin\BankTransferConfigurationsController@report');

Route::post('/admin/banktransferconfigurationsfilter', 'admin\BankTransferConfigurationsController@filter');

//BankTransferChargeConfigurations routes .....

Route::resource('admin/banktransferchargeconfigurations','admin\BankTransferChargeConfigurationsController');

Route::get('/admin/banktransferchargeconfigurationsreport', 'admin\BankTransferChargeConfigurationsController@report');

Route::post('/admin/banktransferchargeconfigurationsfilter', 'admin\BankTransferChargeConfigurationsController@filter');

//BankTransferChargeConfigurations routes .....

Route::resource('admin/banktransferchargeconfigurations','admin\BankTransferChargeConfigurationsController');

Route::get('/admin/banktransferchargeconfigurationsreport', 'admin\BankTransferChargeConfigurationsController@report');

Route::post('/admin/banktransferchargeconfigurationsfilter', 'admin\BankTransferChargeConfigurationsController@filter');

//ClientExits routes .....

Route::resource('admin/clientexits','admin\ClientExitsController');

Route::get('/admin/clientexitsreport', 'admin\ClientExitsController@report');

Route::post('/admin/clientexitsfilter', 'admin\ClientExitsController@filter');

Route::get('/admin/getclientexitnumber', 'admin\ClientExitsController@getclientexitnumber');

//ClientExitApprovalLevels routes .....

Route::resource('admin/clientexitapprovallevels','admin\ClientExitApprovalLevelsController');

Route::get('/admin/clientexitapprovallevelsreport', 'admin\ClientExitApprovalLevelsController@report');

Route::post('/admin/clientexitapprovallevelsfilter', 'admin\ClientExitApprovalLevelsController@filter');

//ClientExitApprovals routes .....

Route::resource('admin/clientexitapprovals','admin\ClientExitApprovalsController');

Route::get('/admin/clientexitapprovalsreport', 'admin\ClientExitApprovalsController@report');

Route::post('/admin/clientexitapprovalsfilter', 'admin\ClientExitApprovalsController@filter');

//ProcessingFeePayments routes .....

Route::resource('admin/processingfeepayments','admin\ProcessingFeePaymentsController');

Route::get('/admin/processingfeepaymentsreport', 'admin\ProcessingFeePaymentsController@report');

Route::post('/admin/processingfeepaymentsfilter', 'admin\ProcessingFeePaymentsController@filter');

//ProcessingFeePayments routes .....

Route::resource('admin/processingfeepayments','admin\ProcessingFeePaymentsController');

Route::get('/admin/processingfeepaymentsreport', 'admin\ProcessingFeePaymentsController@report');

Route::post('/admin/processingfeepaymentsfilter', 'admin\ProcessingFeePaymentsController@filter');

//ProcessingFeePayments routes .....

Route::resource('admin/processingfeepayments','admin\ProcessingFeePaymentsController');

Route::get('/admin/processingfeepaymentsreport', 'admin\ProcessingFeePaymentsController@report');

Route::post('/admin/processingfeepaymentsfilter', 'admin\ProcessingFeePaymentsController@filter');

//Guarantors routes .....

Route::resource('admin/guarantors','admin\GuarantorsController');

Route::get('/admin/guarantorsreport', 'admin\GuarantorsController@report');

Route::post('/admin/guarantorsfilter', 'admin\GuarantorsController@filter');

//ClientGuarantors routes .....

Route::resource('admin/clientguarantors','admin\ClientGuarantorsController');

Route::get('/admin/clientguarantorsreport', 'admin\ClientGuarantorsController@report');

Route::post('/admin/clientguarantorsfilter', 'admin\ClientGuarantorsController@filter');

//LoanAssets routes .....

Route::resource('admin/loanassets','admin\LoanAssetsController');

Route::get('/admin/loanassetsreport', 'admin\LoanAssetsController@report');

Route::post('/admin/loanassetsfilter', 'admin\LoanAssetsController@filter');

//LoanAssets routes .....

Route::resource('admin/loanassets','admin\LoanAssetsController');

Route::get('/admin/loanassetsreport', 'admin\LoanAssetsController@report');

Route::post('/admin/loanassetsfilter', 'admin\LoanAssetsController@filter');


//GroupCashBooks routes .....

Route::resource('admin/groupcashbooks','admin\GroupCashBooksController');

Route::get('/admin/groupcashbooksreport/{id}', 'admin\GroupCashBooksController@report');

Route::post('/admin/groupcashbooksfilter', 'admin\GroupCashBooksController@filter');

Route::get('/admin/groupcashbooksreport/{id}/{startDate}/{endDate}', 'admin\GroupCashBooksController@reportbydate');

Route::get('/admin/groupcashbooksdateconverter', 'admin\GroupCashBooksController@dateconverter');

Route::get('/admin/groupcashbooksreport/export/{id}/{startDate?}/{endDate?}', 'admin\GroupCashBooksController@export')->name('groupcashbooksreport.export');

// transactions
Route::post('/transactions/c2b/validate', 'TransactionController@validateTransaction');

Route::get('/get-payment-modes/{id}', 'ExpenseController@getPaymentModes');