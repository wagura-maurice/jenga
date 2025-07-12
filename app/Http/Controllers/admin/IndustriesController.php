<?php
/**
* @author  Wanjala Innocent Khaemba
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Industries;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class IndustriesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$industriesdata['list']=Industries::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Industries']])->get();
		$industriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($industriesdata['usersaccountsroles'][0]['_add']==0&&$industriesdata['usersaccountsroles'][0]['_list']==0&&$industriesdata['usersaccountsroles'][0]['_edit']==0&&$industriesdata['usersaccountsroles'][0]['_edit']==0&&$industriesdata['usersaccountsroles'][0]['_show']==0&&$industriesdata['usersaccountsroles'][0]['_delete']==0&&$industriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('industriesdata'));
		}else{
			return view('admin.industries.index',compact('industriesdata'));
		}
	}

	public function create(){
		$industriesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Industries']])->get();
		$industriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($industriesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('industriesdata'));
		}else{
			return view('admin.industries.create',compact('industriesdata'));
		}
	}

	public function filter(Request $request){
		$industriesdata['list']=Industries::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Industries']])->get();
		$industriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($industriesdata['usersaccountsroles'][0]['_add']==0&&$industriesdata['usersaccountsroles'][0]['_list']==0&&$industriesdata['usersaccountsroles'][0]['_edit']==0&&$industriesdata['usersaccountsroles'][0]['_edit']==0&&$industriesdata['usersaccountsroles'][0]['_show']==0&&$industriesdata['usersaccountsroles'][0]['_delete']==0&&$industriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('industriesdata'));
		}else{
			return view('admin.industries.index',compact('industriesdata'));
		}
	}

	public function report(){
		$industriesdata['company']=Companies::all();
		$industriesdata['list']=Industries::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Industries']])->get();
		$industriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($industriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('industriesdata'));
		}else{
			return view('admin.industries.report',compact('industriesdata'));
		}
	}

	public function chart(){
		return view('admin.industries.chart');
	}

	public function store(Request $request){
		$industries=new Industries();
		$industries->code=$request->get('code');
		$industries->name=$request->get('name');
		$industries->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Industries']])->get();
		$industriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($industriesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($industries->save()){
					$response['status']='1';
					$response['message']='industries Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add industries. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add industries. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$industriesdata['data']=Industries::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Industries']])->get();
		$industriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($industriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('industriesdata'));
		}else{
		return view('admin.industries.edit',compact('industriesdata','id'));
		}
	}

	public function show($id){
		$industriesdata['data']=Industries::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Industries']])->get();
		$industriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($industriesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('industriesdata'));
		}else{
		return view('admin.industries.show',compact('industriesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$industries=Industries::find($id);
		$industries->code=$request->get('code');
		$industries->name=$request->get('name');
		$industries->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Industries']])->get();
		$industriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($industriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('industriesdata'));
		}else{
		$industries->save();
		$industriesdata['data']=Industries::find($id);
		return view('admin.industries.edit',compact('industriesdata','id'));
		}
	}

	public function destroy($id){
		$industries=Industries::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Industries']])->get();
		$industriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($industriesdata['usersaccountsroles'][0]['_delete']==1){
			$industries->delete();
		}return redirect('admin/industries')->with('success','industries has been deleted!');
	}
}