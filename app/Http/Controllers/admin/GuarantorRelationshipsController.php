<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\GuarantorRelationships;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class GuarantorRelationshipsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$guarantorrelationshipsdata['list']=GuarantorRelationships::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GuarantorRelationships']])->get();
		$guarantorrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($guarantorrelationshipsdata['usersaccountsroles'][0]['_add']==0&&$guarantorrelationshipsdata['usersaccountsroles'][0]['_list']==0&&$guarantorrelationshipsdata['usersaccountsroles'][0]['_edit']==0&&$guarantorrelationshipsdata['usersaccountsroles'][0]['_edit']==0&&$guarantorrelationshipsdata['usersaccountsroles'][0]['_show']==0&&$guarantorrelationshipsdata['usersaccountsroles'][0]['_delete']==0&&$guarantorrelationshipsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('guarantorrelationshipsdata'));
		}else{
			return view('admin.guarantor_relationships.index',compact('guarantorrelationshipsdata'));
		}
	}

	public function create(){
		$guarantorrelationshipsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GuarantorRelationships']])->get();
		$guarantorrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($guarantorrelationshipsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('guarantorrelationshipsdata'));
		}else{
			return view('admin.guarantor_relationships.create',compact('guarantorrelationshipsdata'));
		}
	}

	public function filter(Request $request){
		$guarantorrelationshipsdata['list']=GuarantorRelationships::where([['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GuarantorRelationships']])->get();
		$guarantorrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($guarantorrelationshipsdata['usersaccountsroles'][0]['_add']==0&&$guarantorrelationshipsdata['usersaccountsroles'][0]['_list']==0&&$guarantorrelationshipsdata['usersaccountsroles'][0]['_edit']==0&&$guarantorrelationshipsdata['usersaccountsroles'][0]['_edit']==0&&$guarantorrelationshipsdata['usersaccountsroles'][0]['_show']==0&&$guarantorrelationshipsdata['usersaccountsroles'][0]['_delete']==0&&$guarantorrelationshipsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('guarantorrelationshipsdata'));
		}else{
			return view('admin.guarantor_relationships.index',compact('guarantorrelationshipsdata'));
		}
	}

	public function report(){
		$guarantorrelationshipsdata['company']=Companies::all();
		$guarantorrelationshipsdata['list']=GuarantorRelationships::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GuarantorRelationships']])->get();
		$guarantorrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($guarantorrelationshipsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('guarantorrelationshipsdata'));
		}else{
			return view('admin.guarantor_relationships.report',compact('guarantorrelationshipsdata'));
		}
	}

	public function chart(){
		return view('admin.guarantor_relationships.chart');
	}

	public function store(Request $request){
		$guarantorrelationships=new GuarantorRelationships();
		$guarantorrelationships->name=$request->get('name');
		$guarantorrelationships->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GuarantorRelationships']])->get();
		$guarantorrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($guarantorrelationshipsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($guarantorrelationships->save()){
					$response['status']='1';
					$response['message']='guarantor relationships Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add guarantor relationships. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add guarantor relationships. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$guarantorrelationshipsdata['data']=GuarantorRelationships::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GuarantorRelationships']])->get();
		$guarantorrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($guarantorrelationshipsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('guarantorrelationshipsdata'));
		}else{
		return view('admin.guarantor_relationships.edit',compact('guarantorrelationshipsdata','id'));
		}
	}

	public function show($id){
		$guarantorrelationshipsdata['data']=GuarantorRelationships::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GuarantorRelationships']])->get();
		$guarantorrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($guarantorrelationshipsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('guarantorrelationshipsdata'));
		}else{
		return view('admin.guarantor_relationships.show',compact('guarantorrelationshipsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$guarantorrelationships=GuarantorRelationships::find($id);
		$guarantorrelationships->name=$request->get('name');
		$guarantorrelationships->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GuarantorRelationships']])->get();
		$guarantorrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($guarantorrelationshipsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('guarantorrelationshipsdata'));
		}else{
		$guarantorrelationships->save();
		$guarantorrelationshipsdata['data']=GuarantorRelationships::find($id);
		return view('admin.guarantor_relationships.edit',compact('guarantorrelationshipsdata','id'));
		}
	}

	public function destroy($id){
		$guarantorrelationships=GuarantorRelationships::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GuarantorRelationships']])->get();
		$guarantorrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($guarantorrelationshipsdata['usersaccountsroles'][0]['_delete']==1){
			$guarantorrelationships->delete();
		}return redirect('admin/guarantorrelationships')->with('success','guarantor relationships has been deleted!');
	}
}