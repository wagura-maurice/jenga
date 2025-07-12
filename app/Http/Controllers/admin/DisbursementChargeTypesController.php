<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages disbursement charge types data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\DisbursementChargeTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class DisbursementChargeTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$disbursementchargetypesdata['list']=DisbursementChargeTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargeTypes']])->get();
		$disbursementchargetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargetypesdata['usersaccountsroles'][0]['_add']==0&&$disbursementchargetypesdata['usersaccountsroles'][0]['_list']==0&&$disbursementchargetypesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementchargetypesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementchargetypesdata['usersaccountsroles'][0]['_show']==0&&$disbursementchargetypesdata['usersaccountsroles'][0]['_delete']==0&&$disbursementchargetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementchargetypesdata'));
		}else{
			return view('admin.disbursement_charge_types.index',compact('disbursementchargetypesdata'));
		}
	}

	public function create(){
		$disbursementchargetypesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargeTypes']])->get();
		$disbursementchargetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargetypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('disbursementchargetypesdata'));
		}else{
			return view('admin.disbursement_charge_types.create',compact('disbursementchargetypesdata'));
		}
	}

	public function filter(Request $request){
		$disbursementchargetypesdata['list']=DisbursementChargeTypes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargeTypes']])->get();
		$disbursementchargetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargetypesdata['usersaccountsroles'][0]['_add']==0&&$disbursementchargetypesdata['usersaccountsroles'][0]['_list']==0&&$disbursementchargetypesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementchargetypesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementchargetypesdata['usersaccountsroles'][0]['_show']==0&&$disbursementchargetypesdata['usersaccountsroles'][0]['_delete']==0&&$disbursementchargetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementchargetypesdata'));
		}else{
			return view('admin.disbursement_charge_types.index',compact('disbursementchargetypesdata'));
		}
	}

	public function report(){
		$disbursementchargetypesdata['company']=Companies::all();
		$disbursementchargetypesdata['list']=DisbursementChargeTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargeTypes']])->get();
		$disbursementchargetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementchargetypesdata'));
		}else{
			return view('admin.disbursement_charge_types.report',compact('disbursementchargetypesdata'));
		}
	}

	public function chart(){
		return view('admin.disbursement_charge_types.chart');
	}

	public function store(Request $request){
		$disbursementchargetypes=new DisbursementChargeTypes();
		$disbursementchargetypes->code=$request->get('code');
		$disbursementchargetypes->name=$request->get('name');
		$disbursementchargetypes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargeTypes']])->get();
		$disbursementchargetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargetypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($disbursementchargetypes->save()){
					$response['status']='1';
					$response['message']='disbursement charge types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add disbursement charge types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add disbursement charge types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$disbursementchargetypesdata['data']=DisbursementChargeTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargeTypes']])->get();
		$disbursementchargetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargetypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('disbursementchargetypesdata'));
		}else{
		return view('admin.disbursement_charge_types.edit',compact('disbursementchargetypesdata','id'));
		}
	}

	public function show($id){
		$disbursementchargetypesdata['data']=DisbursementChargeTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargeTypes']])->get();
		$disbursementchargetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargetypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('disbursementchargetypesdata'));
		}else{
		return view('admin.disbursement_charge_types.show',compact('disbursementchargetypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$disbursementchargetypes=DisbursementChargeTypes::find($id);
		$disbursementchargetypes->code=$request->get('code');
		$disbursementchargetypes->name=$request->get('name');
		$disbursementchargetypes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargeTypes']])->get();
		$disbursementchargetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargetypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('disbursementchargetypesdata'));
		}else{
		$disbursementchargetypes->save();
		$disbursementchargetypesdata['data']=DisbursementChargeTypes::find($id);
		return view('admin.disbursement_charge_types.edit',compact('disbursementchargetypesdata','id'));
		}
	}

	public function destroy($id){
		$disbursementchargetypes=DisbursementChargeTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementChargeTypes']])->get();
		$disbursementchargetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargetypesdata['usersaccountsroles'][0]['_delete']==1){
			$disbursementchargetypes->delete();
		}return redirect('admin/disbursementchargetypes')->with('success','disbursement charge types has been deleted!');
	}
}