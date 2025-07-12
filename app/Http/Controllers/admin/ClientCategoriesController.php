<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClientCategories;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ClientCategoriesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$clientcategoriesdata['list']=ClientCategories::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientCategories']])->get();
		$clientcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientcategoriesdata['usersaccountsroles'][0]['_add']==0&&$clientcategoriesdata['usersaccountsroles'][0]['_list']==0&&$clientcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$clientcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$clientcategoriesdata['usersaccountsroles'][0]['_show']==0&&$clientcategoriesdata['usersaccountsroles'][0]['_delete']==0&&$clientcategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientcategoriesdata'));
		}else{
			return view('admin.client_categories.index',compact('clientcategoriesdata'));
		}
	}

	public function create(){
		$clientcategoriesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientCategories']])->get();
		$clientcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientcategoriesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clientcategoriesdata'));
		}else{
			return view('admin.client_categories.create',compact('clientcategoriesdata'));
		}
	}

	public function filter(Request $request){
		$clientcategoriesdata['list']=ClientCategories::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientCategories']])->get();
		$clientcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientcategoriesdata['usersaccountsroles'][0]['_add']==0&&$clientcategoriesdata['usersaccountsroles'][0]['_list']==0&&$clientcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$clientcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$clientcategoriesdata['usersaccountsroles'][0]['_show']==0&&$clientcategoriesdata['usersaccountsroles'][0]['_delete']==0&&$clientcategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientcategoriesdata'));
		}else{
			return view('admin.client_categories.index',compact('clientcategoriesdata'));
		}
	}

	public function report(){
		$clientcategoriesdata['company']=Companies::all();
		$clientcategoriesdata['list']=ClientCategories::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientCategories']])->get();
		$clientcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientcategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientcategoriesdata'));
		}else{
			return view('admin.client_categories.report',compact('clientcategoriesdata'));
		}
	}

	public function chart(){
		return view('admin.client_categories.chart');
	}

	public function store(Request $request){
		$clientcategories=new ClientCategories();
		$clientcategories->code=$request->get('code');
		$clientcategories->name=$request->get('name');
		$clientcategories->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientCategories']])->get();
		$clientcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientcategoriesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($clientcategories->save()){
					$response['status']='1';
					$response['message']='client categories Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add client categories. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add client categories. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$clientcategoriesdata['data']=ClientCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientCategories']])->get();
		$clientcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientcategoriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientcategoriesdata'));
		}else{
		return view('admin.client_categories.edit',compact('clientcategoriesdata','id'));
		}
	}

	public function show($id){
		$clientcategoriesdata['data']=ClientCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientCategories']])->get();
		$clientcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientcategoriesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clientcategoriesdata'));
		}else{
		return view('admin.client_categories.show',compact('clientcategoriesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clientcategories=ClientCategories::find($id);
		$clientcategories->code=$request->get('code');
		$clientcategories->name=$request->get('name');
		$clientcategories->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientCategories']])->get();
		$clientcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientcategoriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientcategoriesdata'));
		}else{
		$clientcategories->save();
		$clientcategoriesdata['data']=ClientCategories::find($id);
		return view('admin.client_categories.edit',compact('clientcategoriesdata','id'));
		}
	}

	public function destroy($id){
		$clientcategories=ClientCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientCategories']])->get();
		$clientcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientcategoriesdata['usersaccountsroles'][0]['_delete']==1){
			$clientcategories->delete();
		}return redirect('admin/clientcategories')->with('success','client categories has been deleted!');
	}
}