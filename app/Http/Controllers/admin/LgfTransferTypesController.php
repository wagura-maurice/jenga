<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (lgf  transfer types)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LgfTransferTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LgfTransferTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$lgftransfertypesdata['list']=LgfTransferTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferTypes']])->get();
		$lgftransfertypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftransfertypesdata['usersaccountsroles'][0]['_add']==0&&$lgftransfertypesdata['usersaccountsroles'][0]['_list']==0&&$lgftransfertypesdata['usersaccountsroles'][0]['_edit']==0&&$lgftransfertypesdata['usersaccountsroles'][0]['_edit']==0&&$lgftransfertypesdata['usersaccountsroles'][0]['_show']==0&&$lgftransfertypesdata['usersaccountsroles'][0]['_delete']==0&&$lgftransfertypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftransfertypesdata'));
		}else{
			return view('admin.lgf_transfer_types.index',compact('lgftransfertypesdata'));
		}
	}

	public function create(){
		$lgftransfertypesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferTypes']])->get();
		$lgftransfertypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftransfertypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('lgftransfertypesdata'));
		}else{
			return view('admin.lgf_transfer_types.create',compact('lgftransfertypesdata'));
		}
	}

	public function filter(Request $request){
		$lgftransfertypesdata['list']=LgfTransferTypes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferTypes']])->get();
		$lgftransfertypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftransfertypesdata['usersaccountsroles'][0]['_add']==0&&$lgftransfertypesdata['usersaccountsroles'][0]['_list']==0&&$lgftransfertypesdata['usersaccountsroles'][0]['_edit']==0&&$lgftransfertypesdata['usersaccountsroles'][0]['_edit']==0&&$lgftransfertypesdata['usersaccountsroles'][0]['_show']==0&&$lgftransfertypesdata['usersaccountsroles'][0]['_delete']==0&&$lgftransfertypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftransfertypesdata'));
		}else{
			return view('admin.lgf_transfer_types.index',compact('lgftransfertypesdata'));
		}
	}

	public function report(){
		$lgftransfertypesdata['company']=Companies::all();
		$lgftransfertypesdata['list']=LgfTransferTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferTypes']])->get();
		$lgftransfertypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftransfertypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftransfertypesdata'));
		}else{
			return view('admin.lgf_transfer_types.report',compact('lgftransfertypesdata'));
		}
	}

	public function chart(){
		return view('admin.lgf_transfer_types.chart');
	}

	public function store(Request $request){
		$lgftransfertypes=new LgfTransferTypes();
		$lgftransfertypes->code=$request->get('code');
		$lgftransfertypes->name=$request->get('name');
		$lgftransfertypes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferTypes']])->get();
		$lgftransfertypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftransfertypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($lgftransfertypes->save()){
					$response['status']='1';
					$response['message']='lgf transfer types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add lgf transfer types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add lgf transfer types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$lgftransfertypesdata['data']=LgfTransferTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferTypes']])->get();
		$lgftransfertypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftransfertypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftransfertypesdata'));
		}else{
		return view('admin.lgf_transfer_types.edit',compact('lgftransfertypesdata','id'));
		}
	}

	public function show($id){
		$lgftransfertypesdata['data']=LgfTransferTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferTypes']])->get();
		$lgftransfertypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftransfertypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('lgftransfertypesdata'));
		}else{
		return view('admin.lgf_transfer_types.show',compact('lgftransfertypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$lgftransfertypes=LgfTransferTypes::find($id);
		$lgftransfertypes->code=$request->get('code');
		$lgftransfertypes->name=$request->get('name');
		$lgftransfertypes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferTypes']])->get();
		$lgftransfertypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftransfertypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftransfertypesdata'));
		}else{
		$lgftransfertypes->save();
		$lgftransfertypesdata['data']=LgfTransferTypes::find($id);
		return view('admin.lgf_transfer_types.edit',compact('lgftransfertypesdata','id'));
		}
	}

	public function destroy($id){
		$lgftransfertypes=LgfTransferTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfTransferTypes']])->get();
		$lgftransfertypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftransfertypesdata['usersaccountsroles'][0]['_delete']==1){
			$lgftransfertypes->delete();
		}return redirect('admin/lgftransfertypes')->with('success','lgf transfer types has been deleted!');
	}
}