<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Accounts;
use App\Companies;
use App\Modules;
use App\Users;
use App\FinancialCategories;
use App\AccountLevels;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\UsersAccountsRoles;
class AccountsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$accountsdata['financialcategories']=FinancialCategories::all();
		$accountsdata['list']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Accounts']])->get();
		$accountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountsdata['usersaccountsroles'][0]['_add']==0&&$accountsdata['usersaccountsroles'][0]['_list']==0&&$accountsdata['usersaccountsroles'][0]['_edit']==0&&$accountsdata['usersaccountsroles'][0]['_edit']==0&&$accountsdata['usersaccountsroles'][0]['_show']==0&&$accountsdata['usersaccountsroles'][0]['_delete']==0&&$accountsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accountsdata'));
		}else{
			return view('admin.accounts.index',compact('accountsdata'));
		}
	}

	public function create(){
		$accountsdata;
		$accountsdata['financialcategories']=FinancialCategories::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Accounts']])->get();
		$accountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('accountsdata'));
		}else{
			return view('admin.accounts.create',compact('accountsdata'));
		}
	}

	public function filter(Request $request){
		$accountsdata['financialcategories']=FinancialCategories::all();
		$accountsdata['list']=Accounts::where([['financial_category','LIKE','%'.$request->get('financial_category').'%'],['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['level','LIKE','%'.$request->get('level').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Accounts']])->get();
		$accountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountsdata['usersaccountsroles'][0]['_add']==0&&$accountsdata['usersaccountsroles'][0]['_list']==0&&$accountsdata['usersaccountsroles'][0]['_edit']==0&&$accountsdata['usersaccountsroles'][0]['_edit']==0&&$accountsdata['usersaccountsroles'][0]['_show']==0&&$accountsdata['usersaccountsroles'][0]['_delete']==0&&$accountsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accountsdata'));
		}else{
			return view('admin.accounts.index',compact('accountsdata'));
		}
	}

	public function report(){
		$accountsdata['company']=Companies::all();
		$accountsdata['list']=Accounts::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Accounts']])->get();
		$accountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accountsdata'));
		}else{
			return view('admin.accounts.report',compact('accountsdata'));
		}
	}

	public function chart(){
		return view('admin.accounts.chart');
	}

	public function store(Request $request){
		$accounts=new Accounts();
		$accounts->financial_category=$request->get('financial_category');
		$accounts->code=$request->get('code');
		$accounts->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Accounts']])->get();
		$accountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($accounts->save()){
					$response['status']='1';
					$response['message']='accounts Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add accounts. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add accounts. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}
	public function dbimport(){
		ini_set('maximum_execution_time',600);
		$query=DB::connection('mysql2')->select("select * from accounts");
		DB::transaction(function() use($query){
			foreach($query as $account){
				if($account->code!='1-00-000000-00' && $account->code!='3-00-000000-00' && $account->code!='5-00-000000-00' && $account->code!='7-00-000000-00' && $account->code!='9-00-000000-00' && $account->code!='1-05-000000-00'){
					$query2=DB::connection('mysql2')->select("select * from accounts where accounts_id='".$account->account_type."'");
					$financialcategory=FinancialCategories::where([['code','=',$query2[0]->code]])->get();
					$accounts=new Accounts();
					$accounts->financial_category=$financialcategory[0]['id'];
					$accounts->code=$account->code;
					$accounts->name=$account->name;
					$accounts->save();

				}							
			}
		});

	}

	public function edit($id){
		$accountsdata['financialcategories']=FinancialCategories::all();
		$accountsdata['data']=Accounts::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Accounts']])->get();
		$accountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('accountsdata'));
		}else{
		return view('admin.accounts.edit',compact('accountsdata','id'));
		}
	}

	public function show($id){
		$accountsdata['financialcategories']=FinancialCategories::all();
		$accountsdata['accountlevels']=AccountLevels::all();
		$accountsdata['data']=Accounts::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Accounts']])->get();
		$accountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('accountsdata'));
		}else{
		return view('admin.accounts.show',compact('accountsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$accounts=Accounts::find($id);
		$accountsdata['financialcategories']=FinancialCategories::all();
		$accounts->financial_category=$request->get('financial_category');
		$accounts->code=$request->get('code');
		$accounts->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Accounts']])->get();
		$accountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('accountsdata'));
		}else{
		$accounts->save();
		$accountsdata['data']=Accounts::find($id);
		return view('admin.accounts.edit',compact('accountsdata','id'));
		}
	}

	public function destroy($id){
		$accounts=Accounts::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Accounts']])->get();
		$accountsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accountsdata['usersaccountsroles'][0]['_delete']==1){
			$accounts->delete();
		}return redirect('admin/accounts')->with('success','accounts has been deleted!');
	}
}