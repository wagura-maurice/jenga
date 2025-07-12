<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PayModes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class PayModesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$paymodesdata['list']=PayModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayModes']])->get();
		$paymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymodesdata['usersaccountsroles'][0]['_add']==0&&$paymodesdata['usersaccountsroles'][0]['_list']==0&&$paymodesdata['usersaccountsroles'][0]['_edit']==0&&$paymodesdata['usersaccountsroles'][0]['_edit']==0&&$paymodesdata['usersaccountsroles'][0]['_show']==0&&$paymodesdata['usersaccountsroles'][0]['_delete']==0&&$paymodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('paymodesdata'));
		}else{
			return view('admin.pay_modes.index',compact('paymodesdata'));
		}
	}

	public function create(){
		$paymodesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayModes']])->get();
		$paymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymodesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('paymodesdata'));
		}else{
			return view('admin.pay_modes.create',compact('paymodesdata'));
		}
	}

	public function filter(Request $request){
		$paymodesdata['list']=PayModes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayModes']])->get();
		$paymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymodesdata['usersaccountsroles'][0]['_add']==0&&$paymodesdata['usersaccountsroles'][0]['_list']==0&&$paymodesdata['usersaccountsroles'][0]['_edit']==0&&$paymodesdata['usersaccountsroles'][0]['_edit']==0&&$paymodesdata['usersaccountsroles'][0]['_show']==0&&$paymodesdata['usersaccountsroles'][0]['_delete']==0&&$paymodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('paymodesdata'));
		}else{
			return view('admin.pay_modes.index',compact('paymodesdata'));
		}
	}

	public function report(){
		$paymodesdata['company']=Companies::all();
		$paymodesdata['list']=PayModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayModes']])->get();
		$paymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('paymodesdata'));
		}else{
			return view('admin.pay_modes.report',compact('paymodesdata'));
		}
	}

	public function chart(){
		return view('admin.pay_modes.chart');
	}

	public function store(Request $request){
		$paymodes=new PayModes();
		$paymodes->code=$request->get('code');
		$paymodes->name=$request->get('name');
		$paymodes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayModes']])->get();
		$paymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymodesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($paymodes->save()){
					$response['status']='1';
					$response['message']='pay modes Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add pay modes. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add pay modes. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$paymodesdata['data']=PayModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayModes']])->get();
		$paymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('paymodesdata'));
		}else{
		return view('admin.pay_modes.edit',compact('paymodesdata','id'));
		}
	}

	public function show($id){
		$paymodesdata['data']=PayModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayModes']])->get();
		$paymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymodesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('paymodesdata'));
		}else{
		return view('admin.pay_modes.show',compact('paymodesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$paymodes=PayModes::find($id);
		$paymodes->code=$request->get('code');
		$paymodes->name=$request->get('name');
		$paymodes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayModes']])->get();
		$paymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('paymodesdata'));
		}else{
		$paymodes->save();
		$paymodesdata['data']=PayModes::find($id);
		return view('admin.pay_modes.edit',compact('paymodesdata','id'));
		}
	}

	public function destroy($id){
		$paymodes=PayModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayModes']])->get();
		$paymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymodesdata['usersaccountsroles'][0]['_delete']==1){
			$paymodes->delete();
		}return redirect('admin/paymodes')->with('success','pay modes has been deleted!');
	}
}