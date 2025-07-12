<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (mobile money modes)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MobileMoneyModes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class MobileMoneyModesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$mobilemoneymodesdata['list']=MobileMoneyModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyModes']])->get();
		$mobilemoneymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneymodesdata['usersaccountsroles'][0]) && $mobilemoneymodesdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneymodesdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneymodesdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneymodesdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneymodesdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneymodesdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneymodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneymodesdata'));
		}else{
			return view('admin.mobile_money_modes.index',compact('mobilemoneymodesdata'));
		}
	}

	public function create(){
		$mobilemoneymodesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyModes']])->get();
		$mobilemoneymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneymodesdata['usersaccountsroles'][0]) && $mobilemoneymodesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('mobilemoneymodesdata'));
		}else{
			return view('admin.mobile_money_modes.create',compact('mobilemoneymodesdata'));
		}
	}

	public function filter(Request $request){
		$mobilemoneymodesdata['list']=MobileMoneyModes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyModes']])->get();
		$mobilemoneymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneymodesdata['usersaccountsroles'][0]) && $mobilemoneymodesdata['usersaccountsroles'][0]['_add']==0&&$mobilemoneymodesdata['usersaccountsroles'][0]['_list']==0&&$mobilemoneymodesdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneymodesdata['usersaccountsroles'][0]['_edit']==0&&$mobilemoneymodesdata['usersaccountsroles'][0]['_show']==0&&$mobilemoneymodesdata['usersaccountsroles'][0]['_delete']==0&&$mobilemoneymodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneymodesdata'));
		}else{
			return view('admin.mobile_money_modes.index',compact('mobilemoneymodesdata'));
		}
	}

	public function report(){
		$mobilemoneymodesdata['company']=Companies::all();
		$mobilemoneymodesdata['list']=MobileMoneyModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyModes']])->get();
		$mobilemoneymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneymodesdata['usersaccountsroles'][0]) && $mobilemoneymodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('mobilemoneymodesdata'));
		}else{
			return view('admin.mobile_money_modes.report',compact('mobilemoneymodesdata'));
		}
	}

	public function chart(){
		return view('admin.mobile_money_modes.chart');
	}

	public function store(Request $request){
		$mobilemoneymodes=new MobileMoneyModes();
		$mobilemoneymodes->code=$request->get('code');
		$mobilemoneymodes->name=$request->get('name');
		$mobilemoneymodes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyModes']])->get();
		$mobilemoneymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneymodesdata['usersaccountsroles'][0]) && $mobilemoneymodesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($mobilemoneymodes->save()){
					$response['status']='1';
					$response['message']='mobile money modes Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add mobile money modes. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add mobile money modes. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$mobilemoneymodesdata['data']=MobileMoneyModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyModes']])->get();
		$mobilemoneymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneymodesdata['usersaccountsroles'][0]) && $mobilemoneymodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneymodesdata'));
		}else{
		return view('admin.mobile_money_modes.edit',compact('mobilemoneymodesdata','id'));
		}
	}

	public function show($id){
		$mobilemoneymodesdata['data']=MobileMoneyModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyModes']])->get();
		$mobilemoneymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneymodesdata['usersaccountsroles'][0]) && $mobilemoneymodesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('mobilemoneymodesdata'));
		}else{
		return view('admin.mobile_money_modes.show',compact('mobilemoneymodesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$mobilemoneymodes=MobileMoneyModes::find($id);
		$mobilemoneymodes->code=$request->get('code');
		$mobilemoneymodes->name=$request->get('name');
		$mobilemoneymodes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyModes']])->get();
		$mobilemoneymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($mobilemoneymodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('mobilemoneymodesdata'));
		}else{
		$mobilemoneymodes->save();
		$mobilemoneymodesdata['data']=MobileMoneyModes::find($id);
		return view('admin.mobile_money_modes.edit',compact('mobilemoneymodesdata','id'));
		}
	}

	public function destroy($id){
		$mobilemoneymodes=MobileMoneyModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MobileMoneyModes']])->get();
		$mobilemoneymodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($mobilemoneymodesdata['usersaccountsroles'][0]) && $mobilemoneymodesdata['usersaccountsroles'][0]['_delete']==1){
			$mobilemoneymodes->delete();
		}return redirect('admin/mobilemoneymodes')->with('success','mobile money modes has been deleted!');
	}
}