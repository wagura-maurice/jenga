<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (product categories)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductCategories;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductCategoriesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productcategoriesdata['list']=ProductCategories::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductCategories']])->get();
		$productcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productcategoriesdata['usersaccountsroles'][0]['_add']==0&&$productcategoriesdata['usersaccountsroles'][0]['_list']==0&&$productcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$productcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$productcategoriesdata['usersaccountsroles'][0]['_show']==0&&$productcategoriesdata['usersaccountsroles'][0]['_delete']==0&&$productcategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productcategoriesdata'));
		}else{
			return view('admin.product_categories.index',compact('productcategoriesdata'));
		}
	}

	public function create(){
		$productcategoriesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductCategories']])->get();
		$productcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productcategoriesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productcategoriesdata'));
		}else{
			return view('admin.product_categories.create',compact('productcategoriesdata'));
		}
	}

	public function filter(Request $request){
		$productcategoriesdata['list']=ProductCategories::where([['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductCategories']])->get();
		$productcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productcategoriesdata['usersaccountsroles'][0]['_add']==0&&$productcategoriesdata['usersaccountsroles'][0]['_list']==0&&$productcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$productcategoriesdata['usersaccountsroles'][0]['_edit']==0&&$productcategoriesdata['usersaccountsroles'][0]['_show']==0&&$productcategoriesdata['usersaccountsroles'][0]['_delete']==0&&$productcategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productcategoriesdata'));
		}else{
			return view('admin.product_categories.index',compact('productcategoriesdata'));
		}
	}

	public function report(){
		$productcategoriesdata['company']=Companies::all();
		$productcategoriesdata['list']=ProductCategories::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductCategories']])->get();
		$productcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productcategoriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productcategoriesdata'));
		}else{
			return view('admin.product_categories.report',compact('productcategoriesdata'));
		}
	}

	public function chart(){
		return view('admin.product_categories.chart');
	}

	public function store(Request $request){
		$productcategories=new ProductCategories();
		$productcategories->name=$request->get('name');
		$productcategories->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductCategories']])->get();
		$productcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productcategoriesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productcategories->save()){
					$response['status']='1';
					$response['message']='product categories Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product categories. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product categories. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productcategoriesdata['data']=ProductCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductCategories']])->get();
		$productcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productcategoriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productcategoriesdata'));
		}else{
		return view('admin.product_categories.edit',compact('productcategoriesdata','id'));
		}
	}

	public function show($id){
		$productcategoriesdata['data']=ProductCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductCategories']])->get();
		$productcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productcategoriesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productcategoriesdata'));
		}else{
		return view('admin.product_categories.show',compact('productcategoriesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$productcategories=ProductCategories::find($id);
		$productcategories->name=$request->get('name');
		$productcategories->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductCategories']])->get();
		$productcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productcategoriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productcategoriesdata'));
		}else{
		$productcategories->save();
		$productcategoriesdata['data']=ProductCategories::find($id);
		return view('admin.product_categories.edit',compact('productcategoriesdata','id'));
		}
	}

	public function destroy($id){
		$productcategories=ProductCategories::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductCategories']])->get();
		$productcategoriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productcategoriesdata['usersaccountsroles'][0]['_delete']==1){
			$productcategories->delete();
		}return redirect('admin/productcategories')->with('success','product categories has been deleted!');
	}
}