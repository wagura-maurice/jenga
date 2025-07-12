<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - ()
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SalesOrderMarginAccountMappings;
use App\Companies;
use App\Modules;
use App\Users;
use App\Products;
use App\PaymentModes;
use App\Accounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class SalesOrderMarginAccountMappingsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$salesordermarginaccountmappingsdata['products']=Products::all();
		$salesordermarginaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$salesordermarginaccountmappingsdata['accounts']=Accounts::all();
		$salesordermarginaccountmappingsdata['accounts']=Accounts::all();
		$salesordermarginaccountmappingsdata['list']=SalesOrderMarginAccountMappings::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderMarginAccountMappings']])->get();
		$salesordermarginaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_add']==0&&$salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_list']==0&&$salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_show']==0&&$salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_delete']==0&&$salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesordermarginaccountmappingsdata'));
		}else{
			return view('admin.sales_order_margin_account_mappings.index',compact('salesordermarginaccountmappingsdata'));
		}
	}

	public function create(){
		$salesordermarginaccountmappingsdata;
		$salesordermarginaccountmappingsdata['products']=Products::all();
		$salesordermarginaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$salesordermarginaccountmappingsdata['accounts']=Accounts::all();
		$salesordermarginaccountmappingsdata['accounts']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderMarginAccountMappings']])->get();
		$salesordermarginaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('salesordermarginaccountmappingsdata'));
		}else{
			return view('admin.sales_order_margin_account_mappings.create',compact('salesordermarginaccountmappingsdata'));
		}
	}

	public function filter(Request $request){
		$salesordermarginaccountmappingsdata['products']=Products::all();
		$salesordermarginaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$salesordermarginaccountmappingsdata['accounts']=Accounts::all();
		$salesordermarginaccountmappingsdata['accounts']=Accounts::all();
		$salesordermarginaccountmappingsdata['list']=SalesOrderMarginAccountMappings::where([['product','LIKE','%'.$request->get('product').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderMarginAccountMappings']])->get();
		$salesordermarginaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_add']==0&&$salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_list']==0&&$salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_show']==0&&$salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_delete']==0&&$salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesordermarginaccountmappingsdata'));
		}else{
			return view('admin.sales_order_margin_account_mappings.index',compact('salesordermarginaccountmappingsdata'));
		}
	}

	public function report(){
		$salesordermarginaccountmappingsdata['company']=Companies::all();
		$salesordermarginaccountmappingsdata['list']=SalesOrderMarginAccountMappings::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderMarginAccountMappings']])->get();
		$salesordermarginaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesordermarginaccountmappingsdata'));
		}else{
			return view('admin.sales_order_margin_account_mappings.report',compact('salesordermarginaccountmappingsdata'));
		}
	}

	public function chart(){
		return view('admin.sales_order_margin_account_mappings.chart');
	}

	public function store(Request $request){
		$salesordermarginaccountmappings=new SalesOrderMarginAccountMappings();
		$salesordermarginaccountmappings->product=$request->get('product');
		$salesordermarginaccountmappings->payment_mode=$request->get('payment_mode');
		$salesordermarginaccountmappings->debit_account=$request->get('debit_account');
		$salesordermarginaccountmappings->credit_account=$request->get('credit_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderMarginAccountMappings']])->get();
		$salesordermarginaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($salesordermarginaccountmappings->save()){
					$response['status']='1';
					$response['message']='sales order margin account mappings Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add sales order margin account mappings. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add sales order margin account mappings. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$salesordermarginaccountmappingsdata['products']=Products::all();
		$salesordermarginaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$salesordermarginaccountmappingsdata['accounts']=Accounts::all();
		$salesordermarginaccountmappingsdata['accounts']=Accounts::all();
		$salesordermarginaccountmappingsdata['data']=SalesOrderMarginAccountMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderMarginAccountMappings']])->get();
		$salesordermarginaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('salesordermarginaccountmappingsdata'));
		}else{
		return view('admin.sales_order_margin_account_mappings.edit',compact('salesordermarginaccountmappingsdata','id'));
		}
	}

	public function show($id){
		$salesordermarginaccountmappingsdata['products']=Products::all();
		$salesordermarginaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$salesordermarginaccountmappingsdata['accounts']=Accounts::all();
		$salesordermarginaccountmappingsdata['accounts']=Accounts::all();
		$salesordermarginaccountmappingsdata['data']=SalesOrderMarginAccountMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderMarginAccountMappings']])->get();
		$salesordermarginaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('salesordermarginaccountmappingsdata'));
		}else{
		return view('admin.sales_order_margin_account_mappings.show',compact('salesordermarginaccountmappingsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$salesordermarginaccountmappings=SalesOrderMarginAccountMappings::find($id);
		$salesordermarginaccountmappingsdata['products']=Products::all();
		$salesordermarginaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$salesordermarginaccountmappingsdata['accounts']=Accounts::all();
		$salesordermarginaccountmappingsdata['accounts']=Accounts::all();
		$salesordermarginaccountmappings->product=$request->get('product');
		$salesordermarginaccountmappings->payment_mode=$request->get('payment_mode');
		$salesordermarginaccountmappings->debit_account=$request->get('debit_account');
		$salesordermarginaccountmappings->credit_account=$request->get('credit_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderMarginAccountMappings']])->get();
		$salesordermarginaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('salesordermarginaccountmappingsdata'));
		}else{
		$salesordermarginaccountmappings->save();
		$salesordermarginaccountmappingsdata['data']=SalesOrderMarginAccountMappings::find($id);
		return view('admin.sales_order_margin_account_mappings.edit',compact('salesordermarginaccountmappingsdata','id'));
		}
	}

	public function destroy($id){
		$salesordermarginaccountmappings=SalesOrderMarginAccountMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderMarginAccountMappings']])->get();
		$salesordermarginaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesordermarginaccountmappingsdata['usersaccountsroles'][0]['_delete']==1){
			$salesordermarginaccountmappings->delete();
		}return redirect('admin/salesordermarginaccountmappings')->with('success','sales order margin account mappings has been deleted!');
	}
}