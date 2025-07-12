<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (purchase order account mappings)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PurchaseOrderAccountMappings;
use App\Companies;
use App\Modules;
use App\Users;
use App\Products;
use App\Accounts;
use App\PaymentModes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class PurchaseOrderAccountMappingsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$purchaseorderaccountmappingsdata['products']=Products::all();
		$purchaseorderaccountmappingsdata['accounts']=Accounts::all();
		$purchaseorderaccountmappingsdata['accounts']=Accounts::all();
		$purchaseorderaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$purchaseorderaccountmappingsdata['list']=PurchaseOrderAccountMappings::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderAccountMappings']])->get();
		$purchaseorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_add']==0&&$purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_list']==0&&$purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_show']==0&&$purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_delete']==0&&$purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderaccountmappingsdata'));
		}else{
			return view('admin.purchase_order_account_mappings.index',compact('purchaseorderaccountmappingsdata'));
		}
	}

	public function create(){
		$purchaseorderaccountmappingsdata;
		$purchaseorderaccountmappingsdata['products']=Products::all();
		$purchaseorderaccountmappingsdata['accounts']=Accounts::all();
		$purchaseorderaccountmappingsdata['accounts']=Accounts::all();
		$purchaseorderaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderAccountMappings']])->get();
		$purchaseorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('purchaseorderaccountmappingsdata'));
		}else{
			return view('admin.purchase_order_account_mappings.create',compact('purchaseorderaccountmappingsdata'));
		}
	}

	public function filter(Request $request){
		$purchaseorderaccountmappingsdata['products']=Products::all();
		$purchaseorderaccountmappingsdata['accounts']=Accounts::all();
		$purchaseorderaccountmappingsdata['accounts']=Accounts::all();
		$purchaseorderaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$purchaseorderaccountmappingsdata['list']=PurchaseOrderAccountMappings::where([['product','LIKE','%'.$request->get('product').'%'],['debit_account','LIKE','%'.$request->get('debit_account').'%'],['credit_account','LIKE','%'.$request->get('credit_account').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderAccountMappings']])->get();
		$purchaseorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_add']==0&&$purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_list']==0&&$purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_show']==0&&$purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_delete']==0&&$purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderaccountmappingsdata'));
		}else{
			return view('admin.purchase_order_account_mappings.index',compact('purchaseorderaccountmappingsdata'));
		}
	}

	public function report(){
		$purchaseorderaccountmappingsdata['company']=Companies::all();
		$purchaseorderaccountmappingsdata['list']=PurchaseOrderAccountMappings::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderAccountMappings']])->get();
		$purchaseorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderaccountmappingsdata'));
		}else{
			return view('admin.purchase_order_account_mappings.report',compact('purchaseorderaccountmappingsdata'));
		}
	}

	public function chart(){
		return view('admin.purchase_order_account_mappings.chart');
	}

	public function store(Request $request){
		$purchaseorderaccountmappings=new PurchaseOrderAccountMappings();
		$purchaseorderaccountmappings->product=$request->get('product');
		$purchaseorderaccountmappings->debit_account=$request->get('debit_account');
		$purchaseorderaccountmappings->credit_account=$request->get('credit_account');
		$purchaseorderaccountmappings->payment_mode=$request->get('payment_mode');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderAccountMappings']])->get();
		$purchaseorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($purchaseorderaccountmappings->save()){
					$response['status']='1';
					$response['message']='purchase order account mappings Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add purchase order account mappings. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add purchase order account mappings. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$purchaseorderaccountmappingsdata['products']=Products::all();
		$purchaseorderaccountmappingsdata['accounts']=Accounts::all();
		$purchaseorderaccountmappingsdata['accounts']=Accounts::all();
		$purchaseorderaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$purchaseorderaccountmappingsdata['data']=PurchaseOrderAccountMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderAccountMappings']])->get();
		$purchaseorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchaseorderaccountmappingsdata'));
		}else{
		return view('admin.purchase_order_account_mappings.edit',compact('purchaseorderaccountmappingsdata','id'));
		}
	}

	public function show($id){
		$purchaseorderaccountmappingsdata['products']=Products::all();
		$purchaseorderaccountmappingsdata['accounts']=Accounts::all();
		$purchaseorderaccountmappingsdata['accounts']=Accounts::all();
		$purchaseorderaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$purchaseorderaccountmappingsdata['data']=PurchaseOrderAccountMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderAccountMappings']])->get();
		$purchaseorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('purchaseorderaccountmappingsdata'));
		}else{
		return view('admin.purchase_order_account_mappings.show',compact('purchaseorderaccountmappingsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$purchaseorderaccountmappings=PurchaseOrderAccountMappings::find($id);
		$purchaseorderaccountmappingsdata['products']=Products::all();
		$purchaseorderaccountmappingsdata['accounts']=Accounts::all();
		$purchaseorderaccountmappingsdata['accounts']=Accounts::all();
		$purchaseorderaccountmappingsdata['paymentmodes']=PaymentModes::all();
		$purchaseorderaccountmappings->product=$request->get('product');
		$purchaseorderaccountmappings->debit_account=$request->get('debit_account');
		$purchaseorderaccountmappings->credit_account=$request->get('credit_account');
		$purchaseorderaccountmappings->payment_mode=$request->get('payment_mode');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderAccountMappings']])->get();
		$purchaseorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchaseorderaccountmappingsdata'));
		}else{
		$purchaseorderaccountmappings->save();
		$purchaseorderaccountmappingsdata['data']=PurchaseOrderAccountMappings::find($id);
		return view('admin.purchase_order_account_mappings.edit',compact('purchaseorderaccountmappingsdata','id'));
		}
	}

	public function destroy($id){
		$purchaseorderaccountmappings=PurchaseOrderAccountMappings::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderAccountMappings']])->get();
		$purchaseorderaccountmappingsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderaccountmappingsdata['usersaccountsroles'][0]['_delete']==1){
			$purchaseorderaccountmappings->delete();
		}return redirect('admin/purchaseorderaccountmappings')->with('success','purchase order account mappings has been deleted!');
	}
}