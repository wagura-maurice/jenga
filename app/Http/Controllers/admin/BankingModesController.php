<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\BankingModes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class BankingModesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$bankingmodesdata['list']=BankingModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankingModes']])->get();
		$bankingmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankingmodesdata['usersaccountsroles'][0]['_add']==0&&$bankingmodesdata['usersaccountsroles'][0]['_list']==0&&$bankingmodesdata['usersaccountsroles'][0]['_edit']==0&&$bankingmodesdata['usersaccountsroles'][0]['_edit']==0&&$bankingmodesdata['usersaccountsroles'][0]['_show']==0&&$bankingmodesdata['usersaccountsroles'][0]['_delete']==0&&$bankingmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('bankingmodesdata'));
		}else{
			return view('admin.banking_modes.index',compact('bankingmodesdata'));
		}
	}

	public function create(){
		$bankingmodesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankingModes']])->get();
		$bankingmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankingmodesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('bankingmodesdata'));
		}else{
			return view('admin.banking_modes.create',compact('bankingmodesdata'));
		}
	}

	public function filter(Request $request){
		$bankingmodesdata['list']=BankingModes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankingModes']])->get();
		$bankingmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankingmodesdata['usersaccountsroles'][0]['_add']==0&&$bankingmodesdata['usersaccountsroles'][0]['_list']==0&&$bankingmodesdata['usersaccountsroles'][0]['_edit']==0&&$bankingmodesdata['usersaccountsroles'][0]['_edit']==0&&$bankingmodesdata['usersaccountsroles'][0]['_show']==0&&$bankingmodesdata['usersaccountsroles'][0]['_delete']==0&&$bankingmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('bankingmodesdata'));
		}else{
			return view('admin.banking_modes.index',compact('bankingmodesdata'));
		}
	}

	public function report(){
		$bankingmodesdata['company']=Companies::all();
		$bankingmodesdata['list']=BankingModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankingModes']])->get();
		$bankingmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankingmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('bankingmodesdata'));
		}else{
			return view('admin.banking_modes.report',compact('bankingmodesdata'));
		}
	}

	public function chart(){
		return view('admin.banking_modes.chart');
	}

	public function store(Request $request){
		$bankingmodes=new BankingModes();
		$bankingmodes->code=$request->get('code');
		$bankingmodes->name=$request->get('name');
		$bankingmodes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankingModes']])->get();
		$bankingmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankingmodesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($bankingmodes->save()){
					$response['status']='1';
					$response['message']='banking modes Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add banking modes. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add banking modes. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$bankingmodesdata['data']=BankingModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankingModes']])->get();
		$bankingmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankingmodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('bankingmodesdata'));
		}else{
		return view('admin.banking_modes.edit',compact('bankingmodesdata','id'));
		}
	}

	public function show($id){
		$bankingmodesdata['data']=BankingModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankingModes']])->get();
		$bankingmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankingmodesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('bankingmodesdata'));
		}else{
		return view('admin.banking_modes.show',compact('bankingmodesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$bankingmodes=BankingModes::find($id);
		$bankingmodes->code=$request->get('code');
		$bankingmodes->name=$request->get('name');
		$bankingmodes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankingModes']])->get();
		$bankingmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankingmodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('bankingmodesdata'));
		}else{
		$bankingmodes->save();
		$bankingmodesdata['data']=BankingModes::find($id);
		return view('admin.banking_modes.edit',compact('bankingmodesdata','id'));
		}
	}

	public function destroy($id){
		$bankingmodes=BankingModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','BankingModes']])->get();
		$bankingmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($bankingmodesdata['usersaccountsroles'][0]['_delete']==1){
			$bankingmodes->delete();
		}return redirect('admin/bankingmodes')->with('success','banking modes has been deleted!');
	}
}