<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - ()
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanProductAssets;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\Products;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanProductAssetsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loanproductassetsdata['loanproducts']=LoanProducts::all();
		$loanproductassetsdata['products']=Products::all();
		$loanproductassetsdata['list']=LoanProductAssets::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductAssets']])->get();
		$loanproductassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductassetsdata['usersaccountsroles'][0]['_add']==0&&$loanproductassetsdata['usersaccountsroles'][0]['_list']==0&&$loanproductassetsdata['usersaccountsroles'][0]['_edit']==0&&$loanproductassetsdata['usersaccountsroles'][0]['_edit']==0&&$loanproductassetsdata['usersaccountsroles'][0]['_show']==0&&$loanproductassetsdata['usersaccountsroles'][0]['_delete']==0&&$loanproductassetsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductassetsdata'));
		}else{
			return view('admin.loan_product_assets.index',compact('loanproductassetsdata'));
		}
	}

	public function create(){
		$loanproductassetsdata;
		$loanproductassetsdata['loanproducts']=LoanProducts::all();
		$loanproductassetsdata['products']=Products::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductAssets']])->get();
		$loanproductassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductassetsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loanproductassetsdata'));
		}else{
			return view('admin.loan_product_assets.create',compact('loanproductassetsdata'));
		}
	}

	public function filter(Request $request){
		$loanproductassetsdata['loanproducts']=LoanProducts::all();
		$loanproductassetsdata['products']=Products::all();
		$loanproductassetsdata['list']=LoanProductAssets::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['asset','LIKE','%'.$request->get('asset').'%'],['quantity','LIKE','%'.$request->get('quantity').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductAssets']])->get();
		$loanproductassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductassetsdata['usersaccountsroles'][0]['_add']==0&&$loanproductassetsdata['usersaccountsroles'][0]['_list']==0&&$loanproductassetsdata['usersaccountsroles'][0]['_edit']==0&&$loanproductassetsdata['usersaccountsroles'][0]['_edit']==0&&$loanproductassetsdata['usersaccountsroles'][0]['_show']==0&&$loanproductassetsdata['usersaccountsroles'][0]['_delete']==0&&$loanproductassetsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductassetsdata'));
		}else{
			return view('admin.loan_product_assets.index',compact('loanproductassetsdata'));
		}
	}

	public function report(){
		$loanproductassetsdata['company']=Companies::all();
		$loanproductassetsdata['list']=LoanProductAssets::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductAssets']])->get();
		$loanproductassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductassetsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanproductassetsdata'));
		}else{
			return view('admin.loan_product_assets.report',compact('loanproductassetsdata'));
		}
	}

	public function chart(){
		return view('admin.loan_product_assets.chart');
	}

	public function store(Request $request){
		$loanproductassets=new LoanProductAssets();
		$loanproductassets->loan_product=$request->get('loan_product');
		$loanproductassets->asset=$request->get('asset');
		$loanproductassets->quantity=$request->get('quantity');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductAssets']])->get();
		$loanproductassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductassetsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loanproductassets->save()){
					$response['status']='1';
					$response['message']='loan product assets Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan product assets. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan product assets. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loanproductassetsdata['loanproducts']=LoanProducts::all();
		$loanproductassetsdata['products']=Products::all();
		$loanproductassetsdata['data']=LoanProductAssets::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductAssets']])->get();
		$loanproductassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductassetsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanproductassetsdata'));
		}else{
		return view('admin.loan_product_assets.edit',compact('loanproductassetsdata','id'));
		}
	}

	public function show($id){
		$loanproductassetsdata['loanproducts']=LoanProducts::all();
		$loanproductassetsdata['products']=Products::all();
		$loanproductassetsdata['data']=LoanProductAssets::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductAssets']])->get();
		$loanproductassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductassetsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loanproductassetsdata'));
		}else{
		return view('admin.loan_product_assets.show',compact('loanproductassetsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loanproductassets=LoanProductAssets::find($id);
		$loanproductassetsdata['loanproducts']=LoanProducts::all();
		$loanproductassetsdata['products']=Products::all();
		$loanproductassets->loan_product=$request->get('loan_product');
		$loanproductassets->asset=$request->get('asset');
		$loanproductassets->quantity=$request->get('quantity');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductAssets']])->get();
		$loanproductassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductassetsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanproductassetsdata'));
		}else{
		$loanproductassets->save();
		$loanproductassetsdata['data']=LoanProductAssets::find($id);
		return view('admin.loan_product_assets.edit',compact('loanproductassetsdata','id'));
		}
	}

	public function destroy($id){
		$loanproductassets=LoanProductAssets::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanProductAssets']])->get();
		$loanproductassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanproductassetsdata['usersaccountsroles'][0]['_delete']==1){
			$loanproductassets->delete();
		}return redirect('admin/loanproductassets')->with('success','loan product assets has been deleted!');
	}
}