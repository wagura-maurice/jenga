<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (product brands)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductBrands;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductBrandsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productbrandsdata['list']=ProductBrands::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductBrands']])->get();
		$productbrandsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productbrandsdata['usersaccountsroles'][0]['_add']==0&&$productbrandsdata['usersaccountsroles'][0]['_list']==0&&$productbrandsdata['usersaccountsroles'][0]['_edit']==0&&$productbrandsdata['usersaccountsroles'][0]['_edit']==0&&$productbrandsdata['usersaccountsroles'][0]['_show']==0&&$productbrandsdata['usersaccountsroles'][0]['_delete']==0&&$productbrandsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productbrandsdata'));
		}else{
			return view('admin.product_brands.index',compact('productbrandsdata'));
		}
	}

	public function create(){
		$productbrandsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductBrands']])->get();
		$productbrandsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productbrandsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productbrandsdata'));
		}else{
			return view('admin.product_brands.create',compact('productbrandsdata'));
		}
	}

	public function filter(Request $request){
		$productbrandsdata['list']=ProductBrands::where([['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductBrands']])->get();
		$productbrandsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productbrandsdata['usersaccountsroles'][0]['_add']==0&&$productbrandsdata['usersaccountsroles'][0]['_list']==0&&$productbrandsdata['usersaccountsroles'][0]['_edit']==0&&$productbrandsdata['usersaccountsroles'][0]['_edit']==0&&$productbrandsdata['usersaccountsroles'][0]['_show']==0&&$productbrandsdata['usersaccountsroles'][0]['_delete']==0&&$productbrandsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productbrandsdata'));
		}else{
			return view('admin.product_brands.index',compact('productbrandsdata'));
		}
	}

	public function report(){
		$productbrandsdata['company']=Companies::all();
		$productbrandsdata['list']=ProductBrands::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductBrands']])->get();
		$productbrandsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productbrandsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productbrandsdata'));
		}else{
			return view('admin.product_brands.report',compact('productbrandsdata'));
		}
	}

	public function chart(){
		return view('admin.product_brands.chart');
	}

	public function store(Request $request){
		$productbrands=new ProductBrands();
		$productbrands->name=$request->get('name');
		$productbrands->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductBrands']])->get();
		$productbrandsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productbrandsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productbrands->save()){
					$response['status']='1';
					$response['message']='product brands Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product brands. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product brands. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productbrandsdata['data']=ProductBrands::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductBrands']])->get();
		$productbrandsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productbrandsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productbrandsdata'));
		}else{
		return view('admin.product_brands.edit',compact('productbrandsdata','id'));
		}
	}

	public function show($id){
		$productbrandsdata['data']=ProductBrands::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductBrands']])->get();
		$productbrandsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productbrandsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productbrandsdata'));
		}else{
		return view('admin.product_brands.show',compact('productbrandsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$productbrands=ProductBrands::find($id);
		$productbrands->name=$request->get('name');
		$productbrands->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductBrands']])->get();
		$productbrandsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productbrandsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productbrandsdata'));
		}else{
		$productbrands->save();
		$productbrandsdata['data']=ProductBrands::find($id);
		return view('admin.product_brands.edit',compact('productbrandsdata','id'));
		}
	}

	public function destroy($id){
		$productbrands=ProductBrands::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductBrands']])->get();
		$productbrandsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productbrandsdata['usersaccountsroles'][0]['_delete']==1){
			$productbrands->delete();
		}return redirect('admin/productbrands')->with('success','product brands has been deleted!');
	}
}