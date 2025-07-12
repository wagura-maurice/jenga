<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\NextOfKinRelationships;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class NextOfKinRelationshipsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$nextofkinrelationshipsdata['list']=NextOfKinRelationships::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','NextOfKinRelationships']])->get();
		$nextofkinrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($nextofkinrelationshipsdata['usersaccountsroles'][0]['_add']==0&&$nextofkinrelationshipsdata['usersaccountsroles'][0]['_list']==0&&$nextofkinrelationshipsdata['usersaccountsroles'][0]['_edit']==0&&$nextofkinrelationshipsdata['usersaccountsroles'][0]['_edit']==0&&$nextofkinrelationshipsdata['usersaccountsroles'][0]['_show']==0&&$nextofkinrelationshipsdata['usersaccountsroles'][0]['_delete']==0&&$nextofkinrelationshipsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('nextofkinrelationshipsdata'));
		}else{
			return view('admin.next_of_kin_relationships.index',compact('nextofkinrelationshipsdata'));
		}
	}

	public function create(){
		$nextofkinrelationshipsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','NextOfKinRelationships']])->get();
		$nextofkinrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($nextofkinrelationshipsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('nextofkinrelationshipsdata'));
		}else{
			return view('admin.next_of_kin_relationships.create',compact('nextofkinrelationshipsdata'));
		}
	}

	public function filter(Request $request){
		$nextofkinrelationshipsdata['list']=NextOfKinRelationships::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','NextOfKinRelationships']])->get();
		$nextofkinrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($nextofkinrelationshipsdata['usersaccountsroles'][0]['_add']==0&&$nextofkinrelationshipsdata['usersaccountsroles'][0]['_list']==0&&$nextofkinrelationshipsdata['usersaccountsroles'][0]['_edit']==0&&$nextofkinrelationshipsdata['usersaccountsroles'][0]['_edit']==0&&$nextofkinrelationshipsdata['usersaccountsroles'][0]['_show']==0&&$nextofkinrelationshipsdata['usersaccountsroles'][0]['_delete']==0&&$nextofkinrelationshipsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('nextofkinrelationshipsdata'));
		}else{
			return view('admin.next_of_kin_relationships.index',compact('nextofkinrelationshipsdata'));
		}
	}

	public function report(){
		$nextofkinrelationshipsdata['company']=Companies::all();
		$nextofkinrelationshipsdata['list']=NextOfKinRelationships::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','NextOfKinRelationships']])->get();
		$nextofkinrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($nextofkinrelationshipsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('nextofkinrelationshipsdata'));
		}else{
			return view('admin.next_of_kin_relationships.report',compact('nextofkinrelationshipsdata'));
		}
	}

	public function chart(){
		return view('admin.next_of_kin_relationships.chart');
	}
	function getnextofkinrelationship($id){
		return json_encode(NextOfKinRelationships::find($id));
	}

	public function store(Request $request){
		$nextofkinrelationships=new NextOfKinRelationships();
		$nextofkinrelationships->code=$request->get('code');
		$nextofkinrelationships->name=$request->get('name');
		$nextofkinrelationships->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','NextOfKinRelationships']])->get();
		$nextofkinrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($nextofkinrelationshipsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($nextofkinrelationships->save()){
					$response['status']='1';
					$response['message']='next of kin relationships Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add next of kin relationships. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add next of kin relationships. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$nextofkinrelationshipsdata['data']=NextOfKinRelationships::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','NextOfKinRelationships']])->get();
		$nextofkinrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($nextofkinrelationshipsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('nextofkinrelationshipsdata'));
		}else{
		return view('admin.next_of_kin_relationships.edit',compact('nextofkinrelationshipsdata','id'));
		}
	}

	public function show($id){
		$nextofkinrelationshipsdata['data']=NextOfKinRelationships::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','NextOfKinRelationships']])->get();
		$nextofkinrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($nextofkinrelationshipsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('nextofkinrelationshipsdata'));
		}else{
		return view('admin.next_of_kin_relationships.show',compact('nextofkinrelationshipsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$nextofkinrelationships=NextOfKinRelationships::find($id);
		$nextofkinrelationships->code=$request->get('code');
		$nextofkinrelationships->name=$request->get('name');
		$nextofkinrelationships->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','NextOfKinRelationships']])->get();
		$nextofkinrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($nextofkinrelationshipsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('nextofkinrelationshipsdata'));
		}else{
		$nextofkinrelationships->save();
		$nextofkinrelationshipsdata['data']=NextOfKinRelationships::find($id);
		return view('admin.next_of_kin_relationships.edit',compact('nextofkinrelationshipsdata','id'));
		}
	}

	public function destroy($id){
		$nextofkinrelationships=NextOfKinRelationships::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','NextOfKinRelationships']])->get();
		$nextofkinrelationshipsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($nextofkinrelationshipsdata['usersaccountsroles'][0]['_delete']==1){
			$nextofkinrelationships->delete();
		}return redirect('admin/nextofkinrelationships')->with('success','next of kin relationships has been deleted!');
	}
}