<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (purchase order payments)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PurchaseOrderPayments;
use App\Companies;
use App\Modules;
use App\Users;
use App\PurchaseOrders;
use App\PaymentModes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class PurchaseOrderPaymentsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$purchaseorderpaymentsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$purchaseorderpaymentsdata['list']=PurchaseOrderPayments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderPayments']])->get();
		$purchaseorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderpaymentsdata['usersaccountsroles'][0]['_add']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_list']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_show']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_delete']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderpaymentsdata'));
		}else{
			return view('admin.purchase_order_payments.index',compact('purchaseorderpaymentsdata'));
		}
	}

	public function create(){
		$purchaseorderpaymentsdata;
		$purchaseorderpaymentsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderPayments']])->get();
		$purchaseorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderpaymentsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('purchaseorderpaymentsdata'));
		}else{
			return view('admin.purchase_order_payments.create',compact('purchaseorderpaymentsdata'));
		}
	}

	public function filter(Request $request){
		$purchaseorderpaymentsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$purchaseorderpaymentsdata['list']=PurchaseOrderPayments::where([['purchase_order','LIKE','%'.$request->get('purchase_order').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['reference','LIKE','%'.$request->get('reference').'%'],])->orWhereBetween('payment_date',[$request->get('payment_datefrom'),$request->get('payment_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderPayments']])->get();
		$purchaseorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderpaymentsdata['usersaccountsroles'][0]['_add']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_list']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_show']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_delete']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderpaymentsdata'));
		}else{
			return view('admin.purchase_order_payments.index',compact('purchaseorderpaymentsdata'));
		}
	}

	public function report(){
		$purchaseorderpaymentsdata['company']=Companies::all();
		$purchaseorderpaymentsdata['list']=PurchaseOrderPayments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderPayments']])->get();
		$purchaseorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderpaymentsdata'));
		}else{
			return view('admin.purchase_order_payments.report',compact('purchaseorderpaymentsdata'));
		}
	}

	public function chart(){
		return view('admin.purchase_order_payments.chart');
	}

	public function store(Request $request){
		$purchaseorderpayments=new PurchaseOrderPayments();
		$purchaseorderpayments->purchase_order=$request->get('purchase_order');
		$purchaseorderpayments->payment_mode=$request->get('payment_mode');
		$purchaseorderpayments->payment_date=$request->get('payment_date');
		$purchaseorderpayments->amount=$request->get('amount');
		$purchaseorderpayments->reference=$request->get('reference');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderPayments']])->get();
		$purchaseorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderpaymentsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($purchaseorderpayments->save()){
					$response['status']='1';
					$response['message']='Purchase Order Payments Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add Purchase Order Payments. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add Purchase Order Payments. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$purchaseorderpaymentsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$purchaseorderpaymentsdata['data']=PurchaseOrderPayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderPayments']])->get();
		$purchaseorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderpaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchaseorderpaymentsdata'));
		}else{
		return view('admin.purchase_order_payments.edit',compact('purchaseorderpaymentsdata','id'));
		}
	}

	public function show($id){
		$purchaseorderpaymentsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$purchaseorderpaymentsdata['data']=PurchaseOrderPayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderPayments']])->get();
		$purchaseorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderpaymentsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('purchaseorderpaymentsdata'));
		}else{
		return view('admin.purchase_order_payments.show',compact('purchaseorderpaymentsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$purchaseorderpayments=PurchaseOrderPayments::find($id);
		$purchaseorderpaymentsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$purchaseorderpayments->purchase_order=$request->get('purchase_order');
		$purchaseorderpayments->payment_mode=$request->get('payment_mode');
		$purchaseorderpayments->payment_date=$request->get('payment_date');
		$purchaseorderpayments->amount=$request->get('amount');
		$purchaseorderpayments->reference=$request->get('reference');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderPayments']])->get();
		$purchaseorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderpaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchaseorderpaymentsdata'));
		}else{
		$purchaseorderpayments->save();
		$purchaseorderpaymentsdata['data']=PurchaseOrderPayments::find($id);
		return view('admin.purchase_order_payments.edit',compact('purchaseorderpaymentsdata','id'));
		}
	}

	public function destroy($id){
		$purchaseorderpayments=PurchaseOrderPayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderPayments']])->get();
		$purchaseorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderpaymentsdata['usersaccountsroles'][0]['_delete']==1){
			$purchaseorderpayments->delete();
		}return redirect('admin/purchaseorderpayments')->with('success','Purchase Order Payments has been deleted!');
	}
}