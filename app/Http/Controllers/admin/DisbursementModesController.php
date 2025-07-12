<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\DisbursementModes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class DisbursementModesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$disbursementmodesdata['list']=DisbursementModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementModes']])->get();
		$disbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementmodesdata['usersaccountsroles'][0]['_add']==0&&$disbursementmodesdata['usersaccountsroles'][0]['_list']==0&&$disbursementmodesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementmodesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementmodesdata['usersaccountsroles'][0]['_show']==0&&$disbursementmodesdata['usersaccountsroles'][0]['_delete']==0&&$disbursementmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementmodesdata'));
		}else{
			return view('admin.disbursement_modes.index',compact('disbursementmodesdata'));
		}
	}

	public function create(){
		$disbursementmodesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementModes']])->get();
		$disbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementmodesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('disbursementmodesdata'));
		}else{
			return view('admin.disbursement_modes.create',compact('disbursementmodesdata'));
		}
	}

	public function filter(Request $request){
		$disbursementmodesdata['list']=DisbursementModes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementModes']])->get();
		$disbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementmodesdata['usersaccountsroles'][0]['_add']==0&&$disbursementmodesdata['usersaccountsroles'][0]['_list']==0&&$disbursementmodesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementmodesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementmodesdata['usersaccountsroles'][0]['_show']==0&&$disbursementmodesdata['usersaccountsroles'][0]['_delete']==0&&$disbursementmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementmodesdata'));
		}else{
			return view('admin.disbursement_modes.index',compact('disbursementmodesdata'));
		}
	}

	public function report(){
		$disbursementmodesdata['company']=Companies::all();
		$disbursementmodesdata['list']=DisbursementModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementModes']])->get();
		$disbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementmodesdata'));
		}else{
			return view('admin.disbursement_modes.report',compact('disbursementmodesdata'));
		}
	}

	public function chart(){
		return view('admin.disbursement_modes.chart');
	}

	public function store(Request $request){
		$disbursementmodes=new DisbursementModes();
		$disbursementmodes->code=$request->get('code');
		$disbursementmodes->name=$request->get('name');
		$disbursementmodes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementModes']])->get();
		$disbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementmodesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($disbursementmodes->save()){
					$response['status']='1';
					$response['message']='disbursement modes Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add disbursement modes. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add disbursement modes. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$disbursementmodesdata['data']=DisbursementModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementModes']])->get();
		$disbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementmodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('disbursementmodesdata'));
		}else{
		return view('admin.disbursement_modes.edit',compact('disbursementmodesdata','id'));
		}
	}

	public function show($id){
		$disbursementmodesdata['data']=DisbursementModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementModes']])->get();
		$disbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementmodesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('disbursementmodesdata'));
		}else{
		return view('admin.disbursement_modes.show',compact('disbursementmodesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$disbursementmodes=DisbursementModes::find($id);
		$disbursementmodes->code=$request->get('code');
		$disbursementmodes->name=$request->get('name');
		$disbursementmodes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementModes']])->get();
		$disbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementmodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('disbursementmodesdata'));
		}else{
		$disbursementmodes->save();
		$disbursementmodesdata['data']=DisbursementModes::find($id);
		return view('admin.disbursement_modes.edit',compact('disbursementmodesdata','id'));
		}
	}

	public function destroy($id){
		$disbursementmodes=DisbursementModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementModes']])->get();
		$disbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementmodesdata['usersaccountsroles'][0]['_delete']==1){
			$disbursementmodes->delete();
		}return redirect('admin/disbursementmodes')->with('success','disbursement modes has been deleted!');
	}
}