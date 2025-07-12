<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanProductApprovalLevel;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\ApprovalLevels;
use App\EmployeeCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanProductApprovalLevelController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loanproductapprovalleveldata['loanproducts']=LoanProducts::all();
		$loanproductapprovalleveldata['approvallevels']=ApprovalLevels::all();
		$loanproductapprovalleveldata['employeecategories']=EmployeeCategories::all();
		$loanproductapprovalleveldata['list']=LoanProductApprovalLevel::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevel']])->get();
		$loanproductapprovalleveldata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovalleveldata['usersaccountsroles'][0]['_add']==0&&$loanproductapprovalleveldata['usersaccountsroles'][0]['_list']==0&&$loanproductapprovalleveldata['usersaccountsroles'][0]['_edit']==0&&$loanproductapprovalleveldata['usersaccountsroles'][0]['_edit']==0&&$loanproductapprovalleveldata['usersaccountsroles'][0]['_show']==0&&$loanproductapprovalleveldata['usersaccountsroles'][0]['_delete']==0&&$loanproductapprovalleveldata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductapprovalleveldata'));
		}else{
			return view('admin.loan_product_approval_level.index',compact('loanproductapprovalleveldata'));
		}
	}

	public function create(){
		$loanproductapprovalleveldata;
		$loanproductapprovalleveldata['loanproducts']=LoanProducts::all();
		$loanproductapprovalleveldata['approvallevels']=ApprovalLevels::all();
		$loanproductapprovalleveldata['employeecategories']=EmployeeCategories::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevel']])->get();
		$loanproductapprovalleveldata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovalleveldata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loanproductapprovalleveldata'));
		}else{
			return view('admin.loan_product_approval_level.create',compact('loanproductapprovalleveldata'));
		}
	}

	public function filter(Request $request){
		$loanproductapprovalleveldata['loanproducts']=LoanProducts::all();
		$loanproductapprovalleveldata['approvallevels']=ApprovalLevels::all();
		$loanproductapprovalleveldata['employeecategories']=EmployeeCategories::all();
		$loanproductapprovalleveldata['list']=LoanProductApprovalLevel::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['approval_level','LIKE','%'.$request->get('approval_level').'%'],['employee_category','LIKE','%'.$request->get('employee_category').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevel']])->get();
		$loanproductapprovalleveldata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovalleveldata['usersaccountsroles'][0]['_add']==0&&$loanproductapprovalleveldata['usersaccountsroles'][0]['_list']==0&&$loanproductapprovalleveldata['usersaccountsroles'][0]['_edit']==0&&$loanproductapprovalleveldata['usersaccountsroles'][0]['_edit']==0&&$loanproductapprovalleveldata['usersaccountsroles'][0]['_show']==0&&$loanproductapprovalleveldata['usersaccountsroles'][0]['_delete']==0&&$loanproductapprovalleveldata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductapprovalleveldata'));
		}else{
			return view('admin.loan_product_approval_level.index',compact('loanproductapprovalleveldata'));
		}
	}

	public function report(){
		$loanproductapprovalleveldata['company']=Companies::all();
		$loanproductapprovalleveldata['list']=LoanProductApprovalLevel::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevel']])->get();
		$loanproductapprovalleveldata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovalleveldata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductapprovalleveldata'));
		}else{
			return view('admin.loan_product_approval_level.report',compact('loanproductapprovalleveldata'));
		}
	}

	public function chart(){
		return view('admin.loan_product_approval_level.chart');
	}

	public function store(Request $request){
		$loanproductapprovallevel=new LoanProductApprovalLevel();
		$loanproductapprovallevel->loan_product=$request->get('loan_product');
		$loanproductapprovallevel->approval_level=$request->get('approval_level');
		$loanproductapprovallevel->employee_category=$request->get('employee_category');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevel']])->get();
		$loanproductapprovalleveldata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovalleveldata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loanproductapprovallevel->save()){
					$response['status']='1';
					$response['message']='loan product approval level Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan product approval level. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan product approval level. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loanproductapprovalleveldata['loanproducts']=LoanProducts::all();
		$loanproductapprovalleveldata['approvallevels']=ApprovalLevels::all();
		$loanproductapprovalleveldata['employeecategories']=EmployeeCategories::all();
		$loanproductapprovalleveldata['data']=LoanProductApprovalLevel::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevel']])->get();
		$loanproductapprovalleveldata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovalleveldata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanproductapprovalleveldata'));
		}else{
		return view('admin.loan_product_approval_level.edit',compact('loanproductapprovalleveldata','id'));
		}
	}

	public function show($id){
		$loanproductapprovalleveldata['loanproducts']=LoanProducts::all();
		$loanproductapprovalleveldata['approvallevels']=ApprovalLevels::all();
		$loanproductapprovalleveldata['employeecategories']=EmployeeCategories::all();
		$loanproductapprovalleveldata['data']=LoanProductApprovalLevel::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevel']])->get();
		$loanproductapprovalleveldata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovalleveldata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loanproductapprovalleveldata'));
		}else{
		return view('admin.loan_product_approval_level.show',compact('loanproductapprovalleveldata','id'));
		}
	}

	public function update(Request $request,$id){
		$loanproductapprovallevel=LoanProductApprovalLevel::find($id);
		$loanproductapprovallevel->loan_product=$request->get('loan_product');
		$loanproductapprovallevel->approval_level=$request->get('approval_level');
		$loanproductapprovallevel->employee_category=$request->get('employee_category');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevel']])->get();
		$loanproductapprovalleveldata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovalleveldata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanproductapprovalleveldata'));
		}else{
		$loanproductapprovallevel->save();
		$loanproductapprovalleveldata['data']=LoanProductApprovalLevel::find($id);
		return view('admin.loan_product_approval_level.edit',compact('loanproductapprovalleveldata','id'));
		}
	}

	public function destroy($id){
		$loanproductapprovallevel=LoanProductApprovalLevel::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductApprovalLevel']])->get();
		$loanproductapprovalleveldata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductapprovalleveldata['usersaccountsroles'][0]['_delete']==1){
			$loanproductapprovallevel->delete();
		}return redirect('admin/loanproductapprovallevel')->with('success','loan product approval level has been deleted!');
	}
}