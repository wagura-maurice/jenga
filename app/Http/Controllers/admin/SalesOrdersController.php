<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (Sales Orders)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SalesOrders;
use App\Companies;
use App\Modules;
use App\Users;
use App\PaymentModes;
use App\SalesOrderPayments;
use App\ProductStocks;
use App\SalesOrderMarginAccountMappings;
use App\SalesOrderLines;
use App\GeneralLedgers;
use App\EntryTypes;
use App\SalesOrderAccountMappings;
use App\Stores;
use Illuminate\Support\Facades\DB;
use App\Products;
use App\OrderStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class SalesOrdersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$salesordersdata['stores']=Stores::all();
		$salesordersdata['products']=Products::all();
		$salesordersdata['orderstatuses']=OrderStatuses::all();
		$salesordersdata['list']=SalesOrders::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrders']])->get();
		$salesordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordersdata['usersaccountsroles'][0]['_add']==0&&$salesordersdata['usersaccountsroles'][0]['_list']==0&&$salesordersdata['usersaccountsroles'][0]['_edit']==0&&$salesordersdata['usersaccountsroles'][0]['_edit']==0&&$salesordersdata['usersaccountsroles'][0]['_show']==0&&$salesordersdata['usersaccountsroles'][0]['_delete']==0&&$salesordersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesordersdata'));
		}else{
			return view('admin.sales_orders.index',compact('salesordersdata'));
		}
	}

	public function create(){
		$salesordersdata;
		$salesordersdata['products']=Products::all();
		$salesordersdata['productstocks']=ProductStocks::all();
		$salesordersdata['orderstatuses']=OrderStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$salesordersdata['stores']=Stores::where([["staff","=",$user[0]["id"]]])->get();		
		$module=Modules::where([['name','=','SalesOrders']])->get();
		$salesordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('salesordersdata'));
		}else{
			return view('admin.sales_orders.create',compact('salesordersdata'));
		}
	}

	public function filter(Request $request){
		$salesordersdata['stores']=Stores::all();
		$salesordersdata['orderstatuses']=OrderStatuses::all();
		$salesordersdata['list']=SalesOrders::where([['order_status','LIKE','%'.$request->get('order_status').'%'],['customer_name','LIKE','%'.$request->get('customer_name').'%'],['customer_phone_number','LIKE','%'.$request->get('customer_phone_number').'%'],['customer_email_address','LIKE','%'.$request->get('customer_email_address').'%'],['order_number','LIKE','%'.$request->get('order_number').'%'],['notes','LIKE','%'.$request->get('notes').'%'],])->orWhereBetween('order_date',[$request->get('order_datefrom'),$request->get('order_dateto')])->orWhereBetween('due_date',[$request->get('due_datefrom'),$request->get('due_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrders']])->get();
		$salesordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordersdata['usersaccountsroles'][0]['_add']==0&&$salesordersdata['usersaccountsroles'][0]['_list']==0&&$salesordersdata['usersaccountsroles'][0]['_edit']==0&&$salesordersdata['usersaccountsroles'][0]['_edit']==0&&$salesordersdata['usersaccountsroles'][0]['_show']==0&&$salesordersdata['usersaccountsroles'][0]['_delete']==0&&$salesordersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesordersdata'));
		}else{
			return view('admin.sales_orders.index',compact('salesordersdata'));
		}
	}

	public function report(){
		$salesordersdata['stores']=Stores::all();
		$salesordersdata['company']=Companies::all();
		$salesordersdata['list']=SalesOrders::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrders']])->get();
		$salesordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesordersdata'));
		}else{
			return view('admin.sales_orders.report',compact('salesordersdata'));
		}
	}

	public function chart(){
		return view('admin.sales_orders.chart');
	}

	public function store(Request $request){
		$salesordersdata['stores']=Stores::all();
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrders']])->get();
		$salesordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordersdata['usersaccountsroles'][0]['_show']==1){
			return DB::transaction(function() use($request,$user){
				try{

					$orderstatus=OrderStatuses::where([['code','=','0001']])->get()->first();					

					$salesorders=new SalesOrders();
					$salesorders->order_status=$orderstatus->id;
					$salesorders->order_date=$request->get('order_date');
					$salesorders->customer_name=$request->get('customer_name');
					$salesorders->customer_phone_number=$request->get('customer_phone_number');
					$salesorders->customer_email_address=$request->get('customer_email_address');
					$salesorders->order_number=$request->get('order_number');
					$salesorders->due_date=$request->get('due_date');
					$salesorders->notes=$request->get('notes');
					$salesorders->initiated_by=$user["0"]["name"];
					$salesorders->store=$request->get('store');

					if($salesorders->save()){

						$products=$request->get("product");
						$quantities=$request->get("quantity");
						$unitPrices=$request->get("unit_price");
						$discount=$request->get("discount");
						$totalPrices=$request->get("total_price");

						for($r=0;$r<count($products);$r++){

							$salesorderlines=new SalesOrderLines();
							$salesorderlines->sales_order=$salesorders->id;
							$salesorderlines->product=$products[$r];
							$salesorderlines->quantity=$quantities[$r];
							$salesorderlines->unit_price=$unitPrices[$r];
							$salesorderlines->discount=$discount[$r];
							$salesorderlines->total_price=$totalPrices[$r];
							$salesorderlines->save();

						}

						$response['status']='1';
						$response['message']='Sales Orders Added successfully';
						return json_encode($response);
				}else{
						$response['status']='0';
						$response['message']='Failed to add Sales Orders. Please try again';
						return json_encode($response);
					}
				}
				catch(Exception $e){
						$response['status']='0';
						$response['message']='An Error occured while attempting to add Sales Orders. Please try again';
						return json_encode($response);
				}				
			});

		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$salesordersdata['stores']=Stores::all();
		$salesordersdata['orderstatuses']=OrderStatuses::all();
		$salesordersdata['data']=SalesOrders::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrders']])->get();
		$salesordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('salesordersdata'));
		}else{
		return view('admin.sales_orders.edit',compact('salesordersdata','id'));
		}
	}

	public function show($id){
		$salesordersdata['stores']=Stores::all();
		$salesordersdata['company']=Companies::all()->first();
		$salesordersdata['orderstatuses']=OrderStatuses::all();
		$salesordersdata['data']=SalesOrders::find($id);
		$salesordersdata['orderlines']=SalesOrderLines::where([["sales_order","=",$id]])->get();
		$salesordersdata['data']->amount=SalesOrderLines::where([["sales_order","=",$id]])->sum("total_price");
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrders']])->get();
		$salesordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('salesordersdata'));
		}else{
		return view('admin.sales_orders.show',compact('salesordersdata','id'));
		}
	}

	public function update(Request $request,$id){
		$salesordersdata['stores']=Stores::all();
		$salesorders=SalesOrders::find($id);
		$salesordersdata['orderstatuses']=OrderStatuses::all();
		$salesorders->order_date=$request->get('order_date');
		$salesorders->order_status=$request->get('order_status');
		$salesorders->customer_name=$request->get('customer_name');
		$salesorders->customer_phone_number=$request->get('customer_phone_number');
		$salesorders->customer_email_address=$request->get('customer_email_address');
		$salesorders->order_number=$request->get('order_number');
		$salesorders->due_date=$request->get('due_date');
		$salesorders->notes=$request->get('notes');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrders']])->get();
		$salesordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('salesordersdata'));
		}else{
		$salesorders->save();
		$salesordersdata['data']=SalesOrders::find($id);
		return view('admin.sales_orders.edit',compact('salesordersdata','id'));
		}
	}

	public function destroy($id){
		$salesordersdata['stores']=Stores::all();
		$salesorders=SalesOrders::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrders']])->get();
		$salesordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordersdata['usersaccountsroles'][0]['_delete']==1){
			$salesorders->delete();
		}return redirect('admin/salesorders')->with('success','Sales Orders has been deleted!');
	}

	function getsalesorderlines($id){
		$salesorderlinesdata['products']=Products::all();
		$salesorderlinesdata['salesorder']=SalesOrders::where([["id","=",$id]])->get()->first();
		$salesorderlinesdata['list']=SalesOrderLines::where([["sales_order","=",$id]])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderLines']])->get();
		$salesorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderlinesdata['usersaccountsroles'][0]['_add']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_list']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_edit']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_edit']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_show']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_delete']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesorderlinesdata'));
		}else{
			return view('admin.sales_order_lines.index',compact('salesorderlinesdata'));
		}		
	}

	function getsalesorderpayments($id){
		$salesorderpaymentsdata['salesorder']=SalesOrders::where([["id","=",$id]])->get()->first();
		$salesorderpaymentsdata['salesorders']=SalesOrders::all();
		$salesorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$salesorderpaymentsdata['list']=SalesOrderPayments::where([["sales_order","=",$id]])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderPayments']])->get();
		$salesorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderpaymentsdata['usersaccountsroles'][0]['_add']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_list']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_show']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_delete']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesorderpaymentsdata'));
		}else{
			return view('admin.sales_order_payments.index',compact('salesorderpaymentsdata'));
		}		
	}

	function createsalesorderpayments($id){

		$salesorderpaymentsdata;
		$salesorderpaymentsdata['salesorder']=SalesOrders::where([["id","=",$id]])->get()->first();
		$salesorderpaymentsdata['salesorder']->amount=SalesOrderLines::where([["sales_order","=",$id]])->sum("total_price");
		$salesorderpaymentsdata['salesorders']=SalesOrders::all();
		$salesorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderPayments']])->get();
		$salesorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderpaymentsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('salesorderpaymentsdata'));
		}else{
			return view('admin.sales_order_payments.create',compact('salesorderpaymentsdata'));
		}		
	}

	public function storesalesorderpayments($id,Request $request){

		$response=array();
		$salesorderpaymentsdata['list']=SalesOrderPayments::where([["sales_order","=",$id]])->get();
		$salesorderpaymentsdata['salesorder']=SalesOrders::where([["id","=",$id]])->get()->first();
		$salesorderpaymentsdata['salesorders']=SalesOrders::all();
		$salesorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderPayments']])->get();
		$salesorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderpaymentsdata['usersaccountsroles'][0]['_show']==1){

			return DB::transaction(function() use($request,$id,$salesorderpaymentsdata){
				try{

					$salesorderpayments=new SalesOrderPayments();
					$salesorderpayments->sales_order=$request->get('sales_order');
					$salesorderpayments->payment_mode=$request->get('payment_mode');
					$salesorderpayments->payment_date=$request->get('payment_date');
					$salesorderpayments->reference=$request->get('reference');
					$salesorderpayments->amount=$request->get('amount');

					$orderstatus=OrderStatuses::where([['code','=','0002']])->get()->first();

					$salesorder=SalesOrders::where([["id","=",$id]])->get()->first();

					$salesorder->order_status=$orderstatus->id;

					$salesorder->save();

					$salesoderlines=SalesOrderLines::where([["sales_order","=",$id]])->get();

					for($r=0;$r<count($salesoderlines);$r++){


						$productstocks=ProductStocks::where([["product","=",$salesoderlines[$r]->product],["store","=",$salesorder->store]])->get()->first();

						if(!isset($productstocks)){

							$productstocks=new ProductStocks();	
							$productstocks->product=$salesoderlines[$r]->product;
							$productstocks->size=$salesoderlines[$r]->quantity;
							$productstocks->store=$salesorder->store;
							$productstocks->save();				
						}else{
							$productstocks->size=$productstocks->size-$salesoderlines[$r]->quantity;
							$productstocks->save();
						}						

						$salesorderaccountmapping=SalesOrderAccountMappings::where([["payment_mode","=",$request->get("payment_mode")]])->get()->first();

				        $debitAccount=$salesorderaccountmapping->debit_account;
	    			    $creditAccount=$salesorderaccountmapping->credit_account;
	    			    
	    			    $debit=EntryTypes::where([['code','=','001']])->get()->first();
	    		        $credit=EntryTypes::where([['code','=','002']])->get()->first();

	    		        $margin=($salesorderlines[$r]->productmodel->selling_price)-($salesorderlines[$r]->productmodel->buying_price);

	    		        $totalmargin=$margin*$salesorderlines[$r]->quantity;
	    
	        			$generalLedger=new GeneralLedgers();
	        			$generalLedger->account=$debitAccount;
	        			$generalLedger->entry_type=$debit->id;
	        			$generalLedger->transaction_number=$request->get('reference');
	        			$generalLedger->amount=$salesoderlines[$r]->total_price-$totalmargin;
	        			$generalLedger->date=$request->get('payment_date');
	        			$generalLedger->save();
	        			
	        			$generalLedger=new GeneralLedgers();
	        			$generalLedger->account=$creditAccount;
	        			$generalLedger->entry_type=$credit->id;
	        			$generalLedger->transaction_number=$request->get('reference');
	        			$generalLedger->amount=$salesoderlines[$r]->total_price-$totalmargin;
	        			$generalLedger->date=$request->get('payment_date');
	        			$generalLedger->save();		

						$salesordermarginaccountmapping=SalesOrderMarginAccountMappings::where([["payment_mode","=",$request->get("payment_mode")]])->get()->first();


				        $debitAccount=$salesordermarginaccountmapping->debit_account;
	    			    $creditAccount=$salesordermarginaccountmapping->credit_account;
	    
	        			$generalLedger=new GeneralLedgers();
	        			$generalLedger->account=$debitAccount;
	        			$generalLedger->entry_type=$debit->id;
	        			$generalLedger->transaction_number=$request->get('reference');
	        			$generalLedger->amount=$totalmargin;
	        			$generalLedger->date=$request->get('payment_date');
	        			$generalLedger->save();
	        			
	        			$generalLedger=new GeneralLedgers();
	        			$generalLedger->account=$creditAccount;
	        			$generalLedger->entry_type=$credit->id;
	        			$generalLedger->transaction_number=$request->get('reference');
	        			$generalLedger->amount=$totalmargin;
	        			$generalLedger->date=$request->get('payment_date');
	        			$generalLedger->save();								

	        					
					}									

					if($salesorderpayments->save()){

						$salesorderpaymentsdata['salesorder']=SalesOrders::where([["id","=",$id]])->get()->first();
						$salesorderpaymentsdata['list']=SalesOrderPayments::where([["sales_order","=",$id]])->get();

						$response['status']='1';
						$response['message']='sales order payments Added successfully';
						return view('admin.sales_order_payments.index',compact('salesorderpaymentsdata'));
				}else{
						$response['status']='0';
						$response['message']='Failed to add sales order payments. Please try again';
						return json_encode($response);
					}
				}
				catch(Exception $e){
						$response['status']='0';
						$response['message']='An Error occured while attempting to add sales order payments. Please try again';
						return json_encode($response);
				}				
			});

		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}	

	public function getsalesordernumber(){
		return (SalesOrders::all()->count()+1);
	}

}