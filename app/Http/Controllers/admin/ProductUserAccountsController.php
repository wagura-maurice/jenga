<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages loan product user accounts that can access is)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductUserAccounts;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductUserAccountsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productuseraccountsdata['loanproducts']=LoanProducts::all();
		$productuseraccountsdata['usersaccounts']=UsersAccounts::all();
		$productuseraccountsdata['list']=ProductUserAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductUserAccounts']])->get();
		$productuseraccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productuseraccountsdata['usersaccountsroles'][0]['_add']==0&&$productuseraccountsdata['usersaccountsroles'][0]['_list']==0&&$productuseraccountsdata['usersaccountsroles'][0]['_edit']==0&&$productuseraccountsdata['usersaccountsroles'][0]['_edit']==0&&$productuseraccountsdata['usersaccountsroles'][0]['_show']==0&&$productuseraccountsdata['usersaccountsroles'][0]['_delete']==0&&$productuseraccountsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productuseraccountsdata'));
		}else{
			return view('admin.product_user_accounts.index',compact('productuseraccountsdata'));
		}
	}

	public function create(){
		$productuseraccountsdata;
		$productuseraccountsdata['loanproducts']=LoanProducts::all();
		$productuseraccountsdata['usersaccounts']=UsersAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductUserAccounts']])->get();
		$productuseraccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productuseraccountsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productuseraccountsdata'));
		}else{
			return view('admin.product_user_accounts.create',compact('productuseraccountsdata'));
		}
	}

	public function filter(Request $request){
		$productuseraccountsdata['loanproducts']=LoanProducts::all();
		$productuseraccountsdata['usersaccounts']=UsersAccounts::all();
		$productuseraccountsdata['list']=ProductUserAccounts::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['user_account','LIKE','%'.$request->get('user_account').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductUserAccounts']])->get();
		$productuseraccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productuseraccountsdata['usersaccountsroles'][0]['_add']==0&&$productuseraccountsdata['usersaccountsroles'][0]['_list']==0&&$productuseraccountsdata['usersaccountsroles'][0]['_edit']==0&&$productuseraccountsdata['usersaccountsroles'][0]['_edit']==0&&$productuseraccountsdata['usersaccountsroles'][0]['_show']==0&&$productuseraccountsdata['usersaccountsroles'][0]['_delete']==0&&$productuseraccountsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productuseraccountsdata'));
		}else{
			return view('admin.product_user_accounts.index',compact('productuseraccountsdata'));
		}
	}

	public function report(){
		$productuseraccountsdata['company']=Companies::all();
		$productuseraccountsdata['list']=ProductUserAccounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductUserAccounts']])->get();
		$productuseraccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productuseraccountsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productuseraccountsdata'));
		}else{
			return view('admin.product_user_accounts.report',compact('productuseraccountsdata'));
		}
	}

	public function chart(){
		return view('admin.product_user_accounts.chart');
	}

	public function store(Request $request){
		$productuseraccounts=new ProductUserAccounts();
		$productuseraccounts->loan_product=$request->get('loan_product');
		$productuseraccounts->user_account=$request->get('user_account');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductUserAccounts']])->get();
		$productuseraccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productuseraccountsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productuseraccounts->save()){
					$response['status']='1';
					$response['message']='product user accounts Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product user accounts. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product user accounts. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productuseraccountsdata['loanproducts']=LoanProducts::all();
		$productuseraccountsdata['usersaccounts']=UsersAccounts::all();
		$productuseraccountsdata['data']=ProductUserAccounts::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductUserAccounts']])->get();
		$productuseraccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productuseraccountsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productuseraccountsdata'));
		}else{
		return view('admin.product_user_accounts.edit',compact('productuseraccountsdata','id'));
		}
	}

	public function show($id){
		$productuseraccountsdata['loanproducts']=LoanProducts::all();
		$productuseraccountsdata['usersaccounts']=UsersAccounts::all();
		$productuseraccountsdata['data']=ProductUserAccounts::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductUserAccounts']])->get();
		$productuseraccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productuseraccountsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productuseraccountsdata'));
		}else{
		return view('admin.product_user_accounts.show',compact('productuseraccountsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$productuseraccounts=ProductUserAccounts::find($id);
		$productuseraccountsdata['loanproducts']=LoanProducts::all();
		$productuseraccountsdata['usersaccounts']=UsersAccounts::all();
		$productuseraccounts->loan_product=$request->get('loan_product');
		$productuseraccounts->user_account=$request->get('user_account');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductUserAccounts']])->get();
		$productuseraccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productuseraccountsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productuseraccountsdata'));
		}else{
		$productuseraccounts->save();
		$productuseraccountsdata['data']=ProductUserAccounts::find($id);
		return view('admin.product_user_accounts.edit',compact('productuseraccountsdata','id'));
		}
	}

	public function destroy($id){
		$productuseraccounts=ProductUserAccounts::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductUserAccounts']])->get();
		$productuseraccountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productuseraccountsdata['usersaccountsroles'][0]['_delete']==1){
			$productuseraccounts->delete();
		}return redirect('admin/productuseraccounts')->with('success','product user accounts has been deleted!');
	}
}