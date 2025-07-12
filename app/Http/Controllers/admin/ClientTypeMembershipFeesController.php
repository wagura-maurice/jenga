<?php
/**
* @author  Wanjala Innocent Khaemba
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClientTypeMembershipFees;
use App\Companies;
use App\Modules;
use App\Users;
use App\ClientTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Clients;
use App\UsersAccountsRoles;
class ClientTypeMembershipFeesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$clienttypemembershipfeesdata['clienttypes']=ClientTypes::all();
		$clienttypemembershipfeesdata['list']=ClientTypeMembershipFees::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypeMembershipFees']])->get();
		$clienttypemembershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypemembershipfeesdata['usersaccountsroles'][0]['_add']==0&&$clienttypemembershipfeesdata['usersaccountsroles'][0]['_list']==0&&$clienttypemembershipfeesdata['usersaccountsroles'][0]['_edit']==0&&$clienttypemembershipfeesdata['usersaccountsroles'][0]['_edit']==0&&$clienttypemembershipfeesdata['usersaccountsroles'][0]['_show']==0&&$clienttypemembershipfeesdata['usersaccountsroles'][0]['_delete']==0&&$clienttypemembershipfeesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clienttypemembershipfeesdata'));
		}else{
			return view('admin.client_type_membership_fees.index',compact('clienttypemembershipfeesdata'));
		}
	}

	public function create(){
		$clienttypemembershipfeesdata;
		$clienttypemembershipfeesdata['clienttypes']=ClientTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypeMembershipFees']])->get();
		$clienttypemembershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypemembershipfeesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clienttypemembershipfeesdata'));
		}else{
			return view('admin.client_type_membership_fees.create',compact('clienttypemembershipfeesdata'));
		}
	}

	public function filter(Request $request){
		$clienttypemembershipfeesdata['clienttypes']=ClientTypes::all();
		$clienttypemembershipfeesdata['list']=ClientTypeMembershipFees::where([['client_type','LIKE','%'.$request->get('client_type').'%'],['fee','LIKE','%'.$request->get('fee').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypeMembershipFees']])->get();
		$clienttypemembershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypemembershipfeesdata['usersaccountsroles'][0]['_add']==0&&$clienttypemembershipfeesdata['usersaccountsroles'][0]['_list']==0&&$clienttypemembershipfeesdata['usersaccountsroles'][0]['_edit']==0&&$clienttypemembershipfeesdata['usersaccountsroles'][0]['_edit']==0&&$clienttypemembershipfeesdata['usersaccountsroles'][0]['_show']==0&&$clienttypemembershipfeesdata['usersaccountsroles'][0]['_delete']==0&&$clienttypemembershipfeesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clienttypemembershipfeesdata'));
		}else{
			return view('admin.client_type_membership_fees.index',compact('clienttypemembershipfeesdata'));
		}
	}

	public function report(){
		$clienttypemembershipfeesdata['company']=Companies::all();
		$clienttypemembershipfeesdata['list']=ClientTypeMembershipFees::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypeMembershipFees']])->get();
		$clienttypemembershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypemembershipfeesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clienttypemembershipfeesdata'));
		}else{
			return view('admin.client_type_membership_fees.report',compact('clienttypemembershipfeesdata'));
		}
	}
	public function getclienttypemembershipfees(Request $request){
		$client=Clients::find($request->get("client"));
		$clientType=$client->client_type;
		$membershipFees=ClientTypeMembershipFees::where([['client_type','=',$clientType]])->get();
		return $membershipFees[0]['fee'];
	}
	public function chart(){
		return view('admin.client_type_membership_fees.chart');
	}

	public function store(Request $request){
		$clienttypemembershipfees=new ClientTypeMembershipFees();
		$clienttypemembershipfees->client_type=$request->get('client_type');
		$clienttypemembershipfees->fee=$request->get('fee');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypeMembershipFees']])->get();
		$clienttypemembershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypemembershipfeesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($clienttypemembershipfees->save()){
					$response['status']='1';
					$response['message']='client type membership fees Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add client type membership fees. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add client type membership fees. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$clienttypemembershipfeesdata['clienttypes']=ClientTypes::all();
		$clienttypemembershipfeesdata['data']=ClientTypeMembershipFees::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypeMembershipFees']])->get();
		$clienttypemembershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypemembershipfeesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clienttypemembershipfeesdata'));
		}else{
		return view('admin.client_type_membership_fees.edit',compact('clienttypemembershipfeesdata','id'));
		}
	}

	public function show($id){
		$clienttypemembershipfeesdata['clienttypes']=ClientTypes::all();
		$clienttypemembershipfeesdata['data']=ClientTypeMembershipFees::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypeMembershipFees']])->get();
		$clienttypemembershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypemembershipfeesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clienttypemembershipfeesdata'));
		}else{
		return view('admin.client_type_membership_fees.show',compact('clienttypemembershipfeesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clienttypemembershipfees=ClientTypeMembershipFees::find($id);
		$clienttypemembershipfeesdata['clienttypes']=ClientTypes::all();
		$clienttypemembershipfees->client_type=$request->get('client_type');
		$clienttypemembershipfees->fee=$request->get('fee');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypeMembershipFees']])->get();
		$clienttypemembershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypemembershipfeesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clienttypemembershipfeesdata'));
		}else{
		$clienttypemembershipfees->save();
		$clienttypemembershipfeesdata['data']=ClientTypeMembershipFees::find($id);
		return view('admin.client_type_membership_fees.edit',compact('clienttypemembershipfeesdata','id'));
		}
	}

	public function destroy($id){
		$clienttypemembershipfees=ClientTypeMembershipFees::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientTypeMembershipFees']])->get();
		$clienttypemembershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clienttypemembershipfeesdata['usersaccountsroles'][0]['_delete']==1){
			$clienttypemembershipfees->delete();
		}return redirect('admin/clienttypemembershipfees')->with('success','client type membership fees has been deleted!');
	}
}