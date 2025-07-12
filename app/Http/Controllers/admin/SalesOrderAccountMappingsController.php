<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (sales order account mappings)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SalesOrderAccountMappings;
use App\Companies;
use App\Modules;
use App\Users;
use App\Products;
use App\PaymentModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class SalesOrderAccountMappingsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$salesorderaccountmappingsdata['products']=Products::all();
		$salesorderaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$salesorderaccountmappingsdata['accounts']=Accounts::all();
		$salesorderaccountmappingsdata['accounts']=Accounts::all();
		$salesorderaccountmappingsdata['list']=SalesOrderAccountMappings::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderAccountMappings']])->get();
		$salesorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderaccountmappingsdata['usersaccountsroles'][0]['_add']==0&&$salesorderaccountmappingsdata['usersaccountsroles'][0]['_list']==0&&$salesorderaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$salesorderaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$salesorderaccountmappingsdata['usersaccountsroles'][0]['_show']==0&&$salesorderaccountmappingsdata['usersaccountsroles'][0]['_delete']==0&&$salesorderaccountmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesorderaccountmappingsdata'));
		}else{
			return view('admin.sales_order_account_mappings.index',compact('salesorderaccountmappingsdata'));
		}
	}

	public function create(){
		$salesorderaccountmappingsdata;
		$salesorderaccountmappingsdata['products']=Products::all();
		$salesorderaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$salesorderaccountmappingsdata['accounts']=Accounts::all();
		$salesorderaccountmappingsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderAccountMappings']])->get();
		$salesorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderaccountmappingsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('salesorderaccountmappingsdata'));
		}else{
			return view('admin.sales_order_account_mappings.create',compact('salesorderaccountmappingsdata'));
		}
	}

	public function filter(Request $request){
		$salesorderaccountmappingsdata['products']=Products::all();
		$salesorderaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$salesorderaccountmappingsdata['accounts']=Accounts::all();
		$salesorderaccountmappingsdata['accounts']=Accounts::all();
		$salesorderaccountmappingsdata['list']=SalesOrderAccountMappings::where([['product','LIKE','%'.$request->get('product').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderAccountMappings']])->get();
		$salesorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderaccountmappingsdata['usersaccountsroles'][0]['_add']==0&&$salesorderaccountmappingsdata['usersaccountsroles'][0]['_list']==0&&$salesorderaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$salesorderaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$salesorderaccountmappingsdata['usersaccountsroles'][0]['_show']==0&&$salesorderaccountmappingsdata['usersaccountsroles'][0]['_delete']==0&&$salesorderaccountmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesorderaccountmappingsdata'));
		}else{
			return view('admin.sales_order_account_mappings.index',compact('salesorderaccountmappingsdata'));
		}
	}

	public function report(){
		$salesorderaccountmappingsdata['company']=Companies::all();
		$salesorderaccountmappingsdata['list']=SalesOrderAccountMappings::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderAccountMappings']])->get();
		$salesorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderaccountmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesorderaccountmappingsdata'));
		}else{
			return view('admin.sales_order_account_mappings.report',compact('salesorderaccountmappingsdata'));
		}
	}

	public function chart(){
		return view('admin.sales_order_account_mappings.chart');
	}

	public function store(Request $request){
		$salesorderaccountmappings=new SalesOrderAccountMappings();
		$salesorderaccountmappings->product=$request->get('product');
		$salesorderaccountmappings->payment_mode=$request->get('payment_mode');
		$salesorderaccountmappings->debit_account=$request->get('debit_account');
		$salesorderaccountmappings->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderAccountMappings']])->get();
		$salesorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderaccountmappingsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($salesorderaccountmappings->save()){
					$response['status']='1';
					$response['message']='sales order account mappings Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add sales order account mappings. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add sales order account mappings. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$salesorderaccountmappingsdata['products']=Products::all();
		$salesorderaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$salesorderaccountmappingsdata['accounts']=Accounts::all();
		$salesorderaccountmappingsdata['accounts']=Accounts::all();
		$salesorderaccountmappingsdata['data']=SalesOrderAccountMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderAccountMappings']])->get();
		$salesorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderaccountmappingsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('salesorderaccountmappingsdata'));
		}else{
		return view('admin.sales_order_account_mappings.edit',compact('salesorderaccountmappingsdata','id'));
		}
	}

	public function show($id){
		$salesorderaccountmappingsdata['products']=Products::all();
		$salesorderaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$salesorderaccountmappingsdata['accounts']=Accounts::all();
		$salesorderaccountmappingsdata['accounts']=Accounts::all();
		$salesorderaccountmappingsdata['data']=SalesOrderAccountMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderAccountMappings']])->get();
		$salesorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderaccountmappingsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('salesorderaccountmappingsdata'));
		}else{
		return view('admin.sales_order_account_mappings.show',compact('salesorderaccountmappingsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$salesorderaccountmappings=SalesOrderAccountMappings::find($id);
		$salesorderaccountmappingsdata['products']=Products::all();
		$salesorderaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$salesorderaccountmappingsdata['accounts']=Accounts::all();
		$salesorderaccountmappingsdata['accounts']=Accounts::all();
		$salesorderaccountmappings->product=$request->get('product');
		$salesorderaccountmappings->payment_mode=$request->get('payment_mode');
		$salesorderaccountmappings->debit_account=$request->get('debit_account');
		$salesorderaccountmappings->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderAccountMappings']])->get();
		$salesorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderaccountmappingsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('salesorderaccountmappingsdata'));
		}else{
		$salesorderaccountmappings->save();
		$salesorderaccountmappingsdata['data']=SalesOrderAccountMappings::find($id);
		return view('admin.sales_order_account_mappings.edit',compact('salesorderaccountmappingsdata','id'));
		}
	}

	public function destroy($id){
		$salesorderaccountmappings=SalesOrderAccountMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderAccountMappings']])->get();
		$salesorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderaccountmappingsdata['usersaccountsroles'][0]['_delete']==1){
			$salesorderaccountmappings->delete();
		}return redirect('admin/salesorderaccountmappings')->with('success','sales order account mappings has been deleted!');
	}
}