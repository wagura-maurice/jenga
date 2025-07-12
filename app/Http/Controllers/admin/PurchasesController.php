<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (Product Purchases)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Purchases;
use App\Companies;
use App\Modules;
use App\Users;
use App\Suppliers;
use App\Products;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class PurchasesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$purchasesdata['suppliers']=Suppliers::all();
		$purchasesdata['products']=Products::all();
		$purchasesdata['list']=Purchases::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Purchases']])->get();
		$purchasesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchasesdata['usersaccountsroles'][0]['_add']==0&&$purchasesdata['usersaccountsroles'][0]['_list']==0&&$purchasesdata['usersaccountsroles'][0]['_edit']==0&&$purchasesdata['usersaccountsroles'][0]['_edit']==0&&$purchasesdata['usersaccountsroles'][0]['_show']==0&&$purchasesdata['usersaccountsroles'][0]['_delete']==0&&$purchasesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchasesdata'));
		}else{
			return view('admin.purchases.index',compact('purchasesdata'));
		}
	}

	public function create(){
		$purchasesdata;
		$purchasesdata['suppliers']=Suppliers::all();
		$purchasesdata['products']=Products::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Purchases']])->get();
		$purchasesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchasesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('purchasesdata'));
		}else{
			return view('admin.purchases.create',compact('purchasesdata'));
		}
	}

	public function filter(Request $request){
		$purchasesdata['suppliers']=Suppliers::all();
		$purchasesdata['products']=Products::all();
		$purchasesdata['list']=Purchases::where([['supplier','LIKE','%'.$request->get('supplier').'%'],['product','LIKE','%'.$request->get('product').'%'],['quantity','LIKE','%'.$request->get('quantity').'%'],])->orWhereBetween('purchase_date',[$request->get('purchase_datefrom'),$request->get('purchase_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Purchases']])->get();
		$purchasesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchasesdata['usersaccountsroles'][0]['_add']==0&&$purchasesdata['usersaccountsroles'][0]['_list']==0&&$purchasesdata['usersaccountsroles'][0]['_edit']==0&&$purchasesdata['usersaccountsroles'][0]['_edit']==0&&$purchasesdata['usersaccountsroles'][0]['_show']==0&&$purchasesdata['usersaccountsroles'][0]['_delete']==0&&$purchasesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchasesdata'));
		}else{
			return view('admin.purchases.index',compact('purchasesdata'));
		}
	}

	public function report(){
		$purchasesdata['company']=Companies::all();
		$purchasesdata['list']=Purchases::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Purchases']])->get();
		$purchasesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchasesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchasesdata'));
		}else{
			return view('admin.purchases.report',compact('purchasesdata'));
		}
	}

	public function chart(){
		return view('admin.purchases.chart');
	}

	public function store(Request $request){
		$purchases=new Purchases();
		$purchases->supplier=$request->get('supplier');
		$purchases->product=$request->get('product');
		$purchases->quantity=$request->get('quantity');
		$purchases->purchase_date=$request->get('purchase_date');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Purchases']])->get();
		$purchasesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchasesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($purchases->save()){
					$response['status']='1';
					$response['message']='purchases Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add purchases. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add purchases. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$purchasesdata['suppliers']=Suppliers::all();
		$purchasesdata['products']=Products::all();
		$purchasesdata['data']=Purchases::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Purchases']])->get();
		$purchasesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchasesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchasesdata'));
		}else{
		return view('admin.purchases.edit',compact('purchasesdata','id'));
		}
	}

	public function show($id){
		$purchasesdata['suppliers']=Suppliers::all();
		$purchasesdata['products']=Products::all();
		$purchasesdata['data']=Purchases::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Purchases']])->get();
		$purchasesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchasesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('purchasesdata'));
		}else{
		return view('admin.purchases.show',compact('purchasesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$purchases=Purchases::find($id);
		$purchasesdata['suppliers']=Suppliers::all();
		$purchasesdata['products']=Products::all();
		$purchases->supplier=$request->get('supplier');
		$purchases->product=$request->get('product');
		$purchases->quantity=$request->get('quantity');
		$purchases->purchase_date=$request->get('purchase_date');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Purchases']])->get();
		$purchasesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchasesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchasesdata'));
		}else{
		$purchases->save();
		$purchasesdata['data']=Purchases::find($id);
		return view('admin.purchases.edit',compact('purchasesdata','id'));
		}
	}

	public function destroy($id){
		$purchases=Purchases::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Purchases']])->get();
		$purchasesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchasesdata['usersaccountsroles'][0]['_delete']==1){
			$purchases->delete();
		}return redirect('admin/purchases')->with('success','purchases has been deleted!');
	}
}