<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages product client types data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductClientTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\ClientTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductClientTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productclienttypesdata['loanproducts']=LoanProducts::all();
		$productclienttypesdata['clienttypes']=ClientTypes::all();
		$productclienttypesdata['list']=ProductClientTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypes']])->get();
		$productclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypesdata['usersaccountsroles'][0]['_add']==0&&$productclienttypesdata['usersaccountsroles'][0]['_list']==0&&$productclienttypesdata['usersaccountsroles'][0]['_edit']==0&&$productclienttypesdata['usersaccountsroles'][0]['_edit']==0&&$productclienttypesdata['usersaccountsroles'][0]['_show']==0&&$productclienttypesdata['usersaccountsroles'][0]['_delete']==0&&$productclienttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productclienttypesdata'));
		}else{
			return view('admin.product_client_types.index',compact('productclienttypesdata'));
		}
	}

	public function create(){
		$productclienttypesdata;
		$productclienttypesdata['loanproducts']=LoanProducts::all();
		$productclienttypesdata['clienttypes']=ClientTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypes']])->get();
		$productclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productclienttypesdata'));
		}else{
			return view('admin.product_client_types.create',compact('productclienttypesdata'));
		}
	}

	public function filter(Request $request){
		$productclienttypesdata['loanproducts']=LoanProducts::all();
		$productclienttypesdata['clienttypes']=ClientTypes::all();
		$productclienttypesdata['list']=ProductClientTypes::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['client_type','LIKE','%'.$request->get('client_type').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypes']])->get();
		$productclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypesdata['usersaccountsroles'][0]['_add']==0&&$productclienttypesdata['usersaccountsroles'][0]['_list']==0&&$productclienttypesdata['usersaccountsroles'][0]['_edit']==0&&$productclienttypesdata['usersaccountsroles'][0]['_edit']==0&&$productclienttypesdata['usersaccountsroles'][0]['_show']==0&&$productclienttypesdata['usersaccountsroles'][0]['_delete']==0&&$productclienttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productclienttypesdata'));
		}else{
			return view('admin.product_client_types.index',compact('productclienttypesdata'));
		}
	}

	public function report(){
		$productclienttypesdata['company']=Companies::all();
		$productclienttypesdata['list']=ProductClientTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypes']])->get();
		$productclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productclienttypesdata'));
		}else{
			return view('admin.product_client_types.report',compact('productclienttypesdata'));
		}
	}

	public function chart(){
		return view('admin.product_client_types.chart');
	}

	public function store(Request $request){
		$productclienttypes=new ProductClientTypes();
		$productclienttypes->loan_product=$request->get('loan_product');
		$productclienttypes->client_type=$request->get('client_type');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypes']])->get();
		$productclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productclienttypes->save()){
					$response['status']='1';
					$response['message']='product client types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product client types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product client types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productclienttypesdata['loanproducts']=LoanProducts::all();
		$productclienttypesdata['clienttypes']=ClientTypes::all();
		$productclienttypesdata['data']=ProductClientTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypes']])->get();
		$productclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productclienttypesdata'));
		}else{
		return view('admin.product_client_types.edit',compact('productclienttypesdata','id'));
		}
	}

	public function show($id){
		$productclienttypesdata['loanproducts']=LoanProducts::all();
		$productclienttypesdata['clienttypes']=ClientTypes::all();
		$productclienttypesdata['data']=ProductClientTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypes']])->get();
		$productclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productclienttypesdata'));
		}else{
		return view('admin.product_client_types.show',compact('productclienttypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$productclienttypes=ProductClientTypes::find($id);
		$productclienttypesdata['loanproducts']=LoanProducts::all();
		$productclienttypesdata['clienttypes']=ClientTypes::all();
		$productclienttypes->loan_product=$request->get('loan_product');
		$productclienttypes->client_type=$request->get('client_type');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypes']])->get();
		$productclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productclienttypesdata'));
		}else{
		$productclienttypes->save();
		$productclienttypesdata['data']=ProductClientTypes::find($id);
		return view('admin.product_client_types.edit',compact('productclienttypesdata','id'));
		}
	}

	public function destroy($id){
		$productclienttypes=ProductClientTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductClientTypes']])->get();
		$productclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productclienttypesdata['usersaccountsroles'][0]['_delete']==1){
			$productclienttypes->delete();
		}return redirect('admin/productclienttypes')->with('success','product client types has been deleted!');
	}
}