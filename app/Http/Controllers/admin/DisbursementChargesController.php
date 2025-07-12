<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages disbursement charges data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\DisbursementCharges;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class DisbursementChargesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$disbursementchargesdata['list']=DisbursementCharges::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementCharges']])->get();
		$disbursementchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesdata['usersaccountsroles'][0]['_add']==0&&$disbursementchargesdata['usersaccountsroles'][0]['_list']==0&&$disbursementchargesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementchargesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementchargesdata['usersaccountsroles'][0]['_show']==0&&$disbursementchargesdata['usersaccountsroles'][0]['_delete']==0&&$disbursementchargesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementchargesdata'));
		}else{
			return view('admin.disbursement_charges.index',compact('disbursementchargesdata'));
		}
	}

	public function create(){
		$disbursementchargesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementCharges']])->get();
		$disbursementchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('disbursementchargesdata'));
		}else{
			return view('admin.disbursement_charges.create',compact('disbursementchargesdata'));
		}
	}

	public function filter(Request $request){
		$disbursementchargesdata['list']=DisbursementCharges::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementCharges']])->get();
		$disbursementchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesdata['usersaccountsroles'][0]['_add']==0&&$disbursementchargesdata['usersaccountsroles'][0]['_list']==0&&$disbursementchargesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementchargesdata['usersaccountsroles'][0]['_edit']==0&&$disbursementchargesdata['usersaccountsroles'][0]['_show']==0&&$disbursementchargesdata['usersaccountsroles'][0]['_delete']==0&&$disbursementchargesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementchargesdata'));
		}else{
			return view('admin.disbursement_charges.index',compact('disbursementchargesdata'));
		}
	}

	public function report(){
		$disbursementchargesdata['company']=Companies::all();
		$disbursementchargesdata['list']=DisbursementCharges::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementCharges']])->get();
		$disbursementchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('disbursementchargesdata'));
		}else{
			return view('admin.disbursement_charges.report',compact('disbursementchargesdata'));
		}
	}

	public function chart(){
		return view('admin.disbursement_charges.chart');
	}

	public function store(Request $request){
		$disbursementcharges=new DisbursementCharges();
		$disbursementcharges->code=$request->get('code');
		$disbursementcharges->name=$request->get('name');
		$disbursementcharges->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementCharges']])->get();
		$disbursementchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($disbursementcharges->save()){
					$response['status']='1';
					$response['message']='disbursement charges  Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add disbursement charges . Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add disbursement charges . Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$disbursementchargesdata['data']=DisbursementCharges::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementCharges']])->get();
		$disbursementchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('disbursementchargesdata'));
		}else{
		return view('admin.disbursement_charges.edit',compact('disbursementchargesdata','id'));
		}
	}

	public function show($id){
		$disbursementchargesdata['data']=DisbursementCharges::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementCharges']])->get();
		$disbursementchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('disbursementchargesdata'));
		}else{
		return view('admin.disbursement_charges.show',compact('disbursementchargesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$disbursementcharges=DisbursementCharges::find($id);
		$disbursementcharges->code=$request->get('code');
		$disbursementcharges->name=$request->get('name');
		$disbursementcharges->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementCharges']])->get();
		$disbursementchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('disbursementchargesdata'));
		}else{
		$disbursementcharges->save();
		$disbursementchargesdata['data']=DisbursementCharges::find($id);
		return view('admin.disbursement_charges.edit',compact('disbursementchargesdata','id'));
		}
	}

	public function destroy($id){
		$disbursementcharges=DisbursementCharges::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DisbursementCharges']])->get();
		$disbursementchargesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($disbursementchargesdata['usersaccountsroles'][0]['_delete']==1){
			$disbursementcharges->delete();
		}return redirect('admin/disbursementcharges')->with('success','disbursement charges  has been deleted!');
	}
}