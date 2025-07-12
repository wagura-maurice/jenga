<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (sales order payments)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SalesOrderPayments;
use App\Companies;
use App\Modules;
use App\Users;
use App\SalesOrders;
use App\PaymentModes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class SalesOrderPaymentsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$salesorderpaymentsdata['salesorders']=SalesOrders::all();
		$salesorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$salesorderpaymentsdata['list']=SalesOrderPayments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderPayments']])->get();
		$salesorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderpaymentsdata['usersaccountsroles'][0]['_add']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_list']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_show']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_delete']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesorderpaymentsdata'));
		}else{
			return view('admin.sales_order_payments.index',compact('salesorderpaymentsdata'));
		}
	}

	public function create(){
		$salesorderpaymentsdata;
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

	public function filter(Request $request){
		$salesorderpaymentsdata['salesorders']=SalesOrders::all();
		$salesorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$salesorderpaymentsdata['list']=SalesOrderPayments::where([['sales_order','LIKE','%'.$request->get('sales_order').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['reference','LIKE','%'.$request->get('reference').'%'],['amount','LIKE','%'.$request->get('amount').'%'],])->orWhereBetween('payment_date',[$request->get('payment_datefrom'),$request->get('payment_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderPayments']])->get();
		$salesorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderpaymentsdata['usersaccountsroles'][0]['_add']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_list']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_show']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_delete']==0&&$salesorderpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesorderpaymentsdata'));
		}else{
			return view('admin.sales_order_payments.index',compact('salesorderpaymentsdata'));
		}
	}

	public function report(){
		$salesorderpaymentsdata['company']=Companies::all();
		$salesorderpaymentsdata['list']=SalesOrderPayments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderPayments']])->get();
		$salesorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesorderpaymentsdata'));
		}else{
			return view('admin.sales_order_payments.report',compact('salesorderpaymentsdata'));
		}
	}

	public function chart(){
		return view('admin.sales_order_payments.chart');
	}

	public function store(Request $request){
		$salesorderpayments=new SalesOrderPayments();
		$salesorderpayments->sales_order=$request->get('sales_order');
		$salesorderpayments->payment_mode=$request->get('payment_mode');
		$salesorderpayments->payment_date=$request->get('payment_date');
		$salesorderpayments->reference=$request->get('reference');
		$salesorderpayments->amount=$request->get('amount');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderPayments']])->get();
		$salesorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderpaymentsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($salesorderpayments->save()){
					$response['status']='1';
					$response['message']='sales order payments Added successfully';
					return json_encode($response);
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
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$salesorderpaymentsdata['salesorders']=SalesOrders::all();
		$salesorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$salesorderpaymentsdata['data']=SalesOrderPayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderPayments']])->get();
		$salesorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderpaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('salesorderpaymentsdata'));
		}else{
		return view('admin.sales_order_payments.edit',compact('salesorderpaymentsdata','id'));
		}
	}

	public function show($id){
		$salesorderpaymentsdata['salesorders']=SalesOrders::all();
		$salesorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$salesorderpaymentsdata['data']=SalesOrderPayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderPayments']])->get();
		$salesorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderpaymentsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('salesorderpaymentsdata'));
		}else{
		return view('admin.sales_order_payments.show',compact('salesorderpaymentsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$salesorderpayments=SalesOrderPayments::find($id);
		$salesorderpaymentsdata['salesorders']=SalesOrders::all();
		$salesorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$salesorderpayments->sales_order=$request->get('sales_order');
		$salesorderpayments->payment_mode=$request->get('payment_mode');
		$salesorderpayments->payment_date=$request->get('payment_date');
		$salesorderpayments->reference=$request->get('reference');
		$salesorderpayments->amount=$request->get('amount');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderPayments']])->get();
		$salesorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderpaymentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('salesorderpaymentsdata'));
		}else{
		$salesorderpayments->save();
		$salesorderpaymentsdata['data']=SalesOrderPayments::find($id);
		return view('admin.sales_order_payments.edit',compact('salesorderpaymentsdata','id'));
		}
	}

	public function destroy($id){
		$salesorderpayments=SalesOrderPayments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderPayments']])->get();
		$salesorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderpaymentsdata['usersaccountsroles'][0]['_delete']==1){
			$salesorderpayments->delete();
		}return redirect('admin/salesorderpayments')->with('success','sales order payments has been deleted!');
	}
}