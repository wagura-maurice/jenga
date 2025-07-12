<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\CollateralCategories;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class CollateralCategoriesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$collateralcategoriesdata['list']=CollateralCategories::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralCategories']])->get();
		$collateralcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralcategoriesdata['usersaccountsroles'][0]['_add']==0&&$collateralcategoriesdata['usersaccountsroles'][0]['_list']==0&&$collateralcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$collateralcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$collateralcategoriesdata['usersaccountsroles'][0]['_show']==0&&$collateralcategoriesdata['usersaccountsroles'][0]['_delete']==0&&$collateralcategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('collateralcategoriesdata'));
		}else{
			return view('admin.collateral_categories.index',compact('collateralcategoriesdata'));
		}
	}

	public function create(){
		$collateralcategoriesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralCategories']])->get();
		$collateralcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralcategoriesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('collateralcategoriesdata'));
		}else{
			return view('admin.collateral_categories.create',compact('collateralcategoriesdata'));
		}
	}

	public function filter(Request $request){
		$collateralcategoriesdata['list']=CollateralCategories::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralCategories']])->get();
		$collateralcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralcategoriesdata['usersaccountsroles'][0]['_add']==0&&$collateralcategoriesdata['usersaccountsroles'][0]['_list']==0&&$collateralcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$collateralcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$collateralcategoriesdata['usersaccountsroles'][0]['_show']==0&&$collateralcategoriesdata['usersaccountsroles'][0]['_delete']==0&&$collateralcategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('collateralcategoriesdata'));
		}else{
			return view('admin.collateral_categories.index',compact('collateralcategoriesdata'));
		}
	}

	public function report(){
		$collateralcategoriesdata['company']=Companies::all();
		$collateralcategoriesdata['list']=CollateralCategories::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralCategories']])->get();
		$collateralcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralcategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('collateralcategoriesdata'));
		}else{
			return view('admin.collateral_categories.report',compact('collateralcategoriesdata'));
		}
	}

	public function chart(){
		return view('admin.collateral_categories.chart');
	}

	public function store(Request $request){
		$collateralcategories=new CollateralCategories();
		$collateralcategories->code=$request->get('code');
		$collateralcategories->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralCategories']])->get();
		$collateralcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralcategoriesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($collateralcategories->save()){
					$response['status']='1';
					$response['message']='collateral categories Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add collateral categories. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add collateral categories. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$collateralcategoriesdata['data']=CollateralCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralCategories']])->get();
		$collateralcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralcategoriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('collateralcategoriesdata'));
		}else{
		return view('admin.collateral_categories.edit',compact('collateralcategoriesdata','id'));
		}
	}

	public function show($id){
		$collateralcategoriesdata['data']=CollateralCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralCategories']])->get();
		$collateralcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralcategoriesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('collateralcategoriesdata'));
		}else{
		return view('admin.collateral_categories.show',compact('collateralcategoriesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$collateralcategories=CollateralCategories::find($id);
		$collateralcategories->code=$request->get('code');
		$collateralcategories->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralCategories']])->get();
		$collateralcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralcategoriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('collateralcategoriesdata'));
		}else{
		$collateralcategories->save();
		$collateralcategoriesdata['data']=CollateralCategories::find($id);
		return view('admin.collateral_categories.edit',compact('collateralcategoriesdata','id'));
		}
	}

	public function destroy($id){
		$collateralcategories=CollateralCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralCategories']])->get();
		$collateralcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralcategoriesdata['usersaccountsroles'][0]['_delete']==1){
			$collateralcategories->delete();
		}return redirect('admin/collateralcategories')->with('success','collateral categories has been deleted!');
	}
}