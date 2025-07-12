<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\FinancialCategories;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class FinancialCategoriesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$financialcategoriesdata['list']=FinancialCategories::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinancialCategories']])->get();
		$financialcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($financialcategoriesdata['usersaccountsroles'][0]['_add']==0&&$financialcategoriesdata['usersaccountsroles'][0]['_list']==0&&$financialcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$financialcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$financialcategoriesdata['usersaccountsroles'][0]['_show']==0&&$financialcategoriesdata['usersaccountsroles'][0]['_delete']==0&&$financialcategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('financialcategoriesdata'));
		}else{
			return view('admin.financial_categories.index',compact('financialcategoriesdata'));
		}
	}

	public function create(){
		$financialcategoriesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinancialCategories']])->get();
		$financialcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($financialcategoriesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('financialcategoriesdata'));
		}else{
			return view('admin.financial_categories.create',compact('financialcategoriesdata'));
		}
	}

	public function filter(Request $request){
		$financialcategoriesdata['list']=FinancialCategories::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinancialCategories']])->get();
		$financialcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($financialcategoriesdata['usersaccountsroles'][0]['_add']==0&&$financialcategoriesdata['usersaccountsroles'][0]['_list']==0&&$financialcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$financialcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$financialcategoriesdata['usersaccountsroles'][0]['_show']==0&&$financialcategoriesdata['usersaccountsroles'][0]['_delete']==0&&$financialcategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('financialcategoriesdata'));
		}else{
			return view('admin.financial_categories.index',compact('financialcategoriesdata'));
		}
	}

	public function report(){
		$financialcategoriesdata['company']=Companies::all();
		$financialcategoriesdata['list']=FinancialCategories::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinancialCategories']])->get();
		$financialcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($financialcategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('financialcategoriesdata'));
		}else{
			return view('admin.financial_categories.report',compact('financialcategoriesdata'));
		}
	}

	public function chart(){
		return view('admin.financial_categories.chart');
	}

	public function store(Request $request){
		$financialcategories=new FinancialCategories();
		$financialcategories->code=$request->get('code');
		$financialcategories->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinancialCategories']])->get();
		$financialcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($financialcategoriesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($financialcategories->save()){
					$response['status']='1';
					$response['message']='financial categories Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add financial categories. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add financial categories. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$financialcategoriesdata['data']=FinancialCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinancialCategories']])->get();
		$financialcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($financialcategoriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('financialcategoriesdata'));
		}else{
		return view('admin.financial_categories.edit',compact('financialcategoriesdata','id'));
		}
	}

	public function show($id){
		$financialcategoriesdata['data']=FinancialCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinancialCategories']])->get();
		$financialcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($financialcategoriesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('financialcategoriesdata'));
		}else{
		return view('admin.financial_categories.show',compact('financialcategoriesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$financialcategories=FinancialCategories::find($id);
		$financialcategories->code=$request->get('code');
		$financialcategories->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinancialCategories']])->get();
		$financialcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($financialcategoriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('financialcategoriesdata'));
		}else{
		$financialcategories->save();
		$financialcategoriesdata['data']=FinancialCategories::find($id);
		return view('admin.financial_categories.edit',compact('financialcategoriesdata','id'));
		}
	}

	public function destroy($id){
		$financialcategories=FinancialCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FinancialCategories']])->get();
		$financialcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($financialcategoriesdata['usersaccountsroles'][0]['_delete']==1){
			$financialcategories->delete();
		}return redirect('admin/financialcategories')->with('success','financial categories has been deleted!');
	}
}