<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanProductClientTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\ClientTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanProductClientTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loanproductclienttypesdata['loanproducts']=LoanProducts::all();
		$loanproductclienttypesdata['clienttypes']=ClientTypes::all();
		$loanproductclienttypesdata['list']=LoanProductClientTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductClientTypes']])->get();
		$loanproductclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductclienttypesdata['usersaccountsroles'][0]['_add']==0&&$loanproductclienttypesdata['usersaccountsroles'][0]['_list']==0&&$loanproductclienttypesdata['usersaccountsroles'][0]['_edit']==0&&$loanproductclienttypesdata['usersaccountsroles'][0]['_edit']==0&&$loanproductclienttypesdata['usersaccountsroles'][0]['_show']==0&&$loanproductclienttypesdata['usersaccountsroles'][0]['_delete']==0&&$loanproductclienttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductclienttypesdata'));
		}else{
			return view('admin.loan_product_client_types.index',compact('loanproductclienttypesdata'));
		}
	}

	public function create(){
		$loanproductclienttypesdata;
		$loanproductclienttypesdata['loanproducts']=LoanProducts::all();
		$loanproductclienttypesdata['clienttypes']=ClientTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductClientTypes']])->get();
		$loanproductclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductclienttypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loanproductclienttypesdata'));
		}else{
			return view('admin.loan_product_client_types.create',compact('loanproductclienttypesdata'));
		}
	}

	public function filter(Request $request){
		$loanproductclienttypesdata['loanproducts']=LoanProducts::all();
		$loanproductclienttypesdata['clienttypes']=ClientTypes::all();
		$loanproductclienttypesdata['list']=LoanProductClientTypes::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['client_type','LIKE','%'.$request->get('client_type').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductClientTypes']])->get();
		$loanproductclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductclienttypesdata['usersaccountsroles'][0]['_add']==0&&$loanproductclienttypesdata['usersaccountsroles'][0]['_list']==0&&$loanproductclienttypesdata['usersaccountsroles'][0]['_edit']==0&&$loanproductclienttypesdata['usersaccountsroles'][0]['_edit']==0&&$loanproductclienttypesdata['usersaccountsroles'][0]['_show']==0&&$loanproductclienttypesdata['usersaccountsroles'][0]['_delete']==0&&$loanproductclienttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductclienttypesdata'));
		}else{
			return view('admin.loan_product_client_types.index',compact('loanproductclienttypesdata'));
		}
	}

	public function report(){
		$loanproductclienttypesdata['company']=Companies::all();
		$loanproductclienttypesdata['list']=LoanProductClientTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductClientTypes']])->get();
		$loanproductclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductclienttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductclienttypesdata'));
		}else{
			return view('admin.loan_product_client_types.report',compact('loanproductclienttypesdata'));
		}
	}

	public function chart(){
		return view('admin.loan_product_client_types.chart');
	}

	public function store(Request $request){
		$loanproductclienttypes=new LoanProductClientTypes();
		$loanproductclienttypes->loan_product=$request->get('loan_product');
		$loanproductclienttypes->client_type=$request->get('client_type');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductClientTypes']])->get();
		$loanproductclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductclienttypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loanproductclienttypes->save()){
					$response['status']='1';
					$response['message']='loan product client types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan product client types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan product client types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loanproductclienttypesdata['loanproducts']=LoanProducts::all();
		$loanproductclienttypesdata['clienttypes']=ClientTypes::all();
		$loanproductclienttypesdata['data']=LoanProductClientTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductClientTypes']])->get();
		$loanproductclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductclienttypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanproductclienttypesdata'));
		}else{
		return view('admin.loan_product_client_types.edit',compact('loanproductclienttypesdata','id'));
		}
	}

	public function show($id){
		$loanproductclienttypesdata['loanproducts']=LoanProducts::all();
		$loanproductclienttypesdata['clienttypes']=ClientTypes::all();
		$loanproductclienttypesdata['data']=LoanProductClientTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductClientTypes']])->get();
		$loanproductclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductclienttypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loanproductclienttypesdata'));
		}else{
		return view('admin.loan_product_client_types.show',compact('loanproductclienttypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loanproductclienttypes=LoanProductClientTypes::find($id);
		$loanproductclienttypes->loan_product=$request->get('loan_product');
		$loanproductclienttypes->client_type=$request->get('client_type');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductClientTypes']])->get();
		$loanproductclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductclienttypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanproductclienttypesdata'));
		}else{
		$loanproductclienttypes->save();
		$loanproductclienttypesdata['data']=LoanProductClientTypes::find($id);
		return view('admin.loan_product_client_types.edit',compact('loanproductclienttypesdata','id'));
		}
	}

	public function destroy($id){
		$loanproductclienttypes=LoanProductClientTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductClientTypes']])->get();
		$loanproductclienttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductclienttypesdata['usersaccountsroles'][0]['_delete']==1){
			$loanproductclienttypes->delete();
		}return redirect('admin/loanproductclienttypes')->with('success','loan product client types has been deleted!');
	}
}