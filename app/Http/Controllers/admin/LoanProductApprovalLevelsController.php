<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanProductApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\ApprovalLevels;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanProductApprovalLevelsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loanproductapprovallevelsdata['loanproducts']=LoanProducts::all();
		$loanproductapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$loanproductapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$loanproductapprovallevelsdata['list']=LoanProductApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevels']])->get();
		$loanproductapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$loanproductapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$loanproductapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$loanproductapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$loanproductapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$loanproductapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$loanproductapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductapprovallevelsdata'));
		}else{
			return view('admin.loan_product_approval_levels.index',compact('loanproductapprovallevelsdata'));
		}
	}

	public function create(){
		$loanproductapprovallevelsdata;
		$loanproductapprovallevelsdata['loanproducts']=LoanProducts::all();
		$loanproductapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$loanproductapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevels']])->get();
		$loanproductapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovallevelsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loanproductapprovallevelsdata'));
		}else{
			return view('admin.loan_product_approval_levels.create',compact('loanproductapprovallevelsdata'));
		}
	}

	public function filter(Request $request){
		$loanproductapprovallevelsdata['loanproducts']=LoanProducts::all();
		$loanproductapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$loanproductapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$loanproductapprovallevelsdata['list']=LoanProductApprovalLevels::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['level','LIKE','%'.$request->get('level').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevels']])->get();
		$loanproductapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovallevelsdata['usersaccountsroles'][0]['_add']==0&&$loanproductapprovallevelsdata['usersaccountsroles'][0]['_list']==0&&$loanproductapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$loanproductapprovallevelsdata['usersaccountsroles'][0]['_edit']==0&&$loanproductapprovallevelsdata['usersaccountsroles'][0]['_show']==0&&$loanproductapprovallevelsdata['usersaccountsroles'][0]['_delete']==0&&$loanproductapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductapprovallevelsdata'));
		}else{
			return view('admin.loan_product_approval_levels.index',compact('loanproductapprovallevelsdata'));
		}
	}

	public function report(){
		$loanproductapprovallevelsdata['company']=Companies::all();
		$loanproductapprovallevelsdata['list']=LoanProductApprovalLevels::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevels']])->get();
		$loanproductapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovallevelsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductapprovallevelsdata'));
		}else{
			return view('admin.loan_product_approval_levels.report',compact('loanproductapprovallevelsdata'));
		}
	}

	public function chart(){
		return view('admin.loan_product_approval_levels.chart');
	}

	public function store(Request $request){
		$loanproductapprovallevels=new LoanProductApprovalLevels();
		$loanproductapprovallevels->loan_product=$request->get('loan_product');
		$loanproductapprovallevels->level=$request->get('level');
		$loanproductapprovallevels->user_account=$request->get('user_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevels']])->get();
		$loanproductapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovallevelsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loanproductapprovallevels->save()){
					$response['status']='1';
					$response['message']='loan product approval levels Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan product approval levels. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan product approval levels. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loanproductapprovallevelsdata['loanproducts']=LoanProducts::all();
		$loanproductapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$loanproductapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$loanproductapprovallevelsdata['data']=LoanProductApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevels']])->get();
		$loanproductapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanproductapprovallevelsdata'));
		}else{
		return view('admin.loan_product_approval_levels.edit',compact('loanproductapprovallevelsdata','id'));
		}
	}

	public function show($id){
		$loanproductapprovallevelsdata['loanproducts']=LoanProducts::all();
		$loanproductapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$loanproductapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$loanproductapprovallevelsdata['data']=LoanProductApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevels']])->get();
		$loanproductapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovallevelsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loanproductapprovallevelsdata'));
		}else{
		return view('admin.loan_product_approval_levels.show',compact('loanproductapprovallevelsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loanproductapprovallevels=LoanProductApprovalLevels::find($id);
		$loanproductapprovallevelsdata['loanproducts']=LoanProducts::all();
		$loanproductapprovallevelsdata['approvallevels']=ApprovalLevels::all();
		$loanproductapprovallevelsdata['usersaccounts']=UsersAccounts::all();
		$loanproductapprovallevels->loan_product=$request->get('loan_product');
		$loanproductapprovallevels->level=$request->get('level');
		$loanproductapprovallevels->user_account=$request->get('user_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevels']])->get();
		$loanproductapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovallevelsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanproductapprovallevelsdata'));
		}else{
		$loanproductapprovallevels->save();
		$loanproductapprovallevelsdata['data']=LoanProductApprovalLevels::find($id);
		return view('admin.loan_product_approval_levels.edit',compact('loanproductapprovallevelsdata','id'));
		}
	}

	public function destroy($id){
		$loanproductapprovallevels=LoanProductApprovalLevels::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevels']])->get();
		$loanproductapprovallevelsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovallevelsdata['usersaccountsroles'][0]['_delete']==1){
			$loanproductapprovallevels->delete();
		}return redirect('admin/loanproductapprovallevels')->with('success','loan product approval levels has been deleted!');
	}
}