<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\FineTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class FineTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$finetypesdata['list']=FineTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTypes']])->get();
		$finetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finetypesdata['usersaccountsroles'][0]['_add']==0&&$finetypesdata['usersaccountsroles'][0]['_list']==0&&$finetypesdata['usersaccountsroles'][0]['_edit']==0&&$finetypesdata['usersaccountsroles'][0]['_edit']==0&&$finetypesdata['usersaccountsroles'][0]['_show']==0&&$finetypesdata['usersaccountsroles'][0]['_delete']==0&&$finetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finetypesdata'));
		}else{
			return view('admin.fine_types.index',compact('finetypesdata'));
		}
	}

	public function create(){
		$finetypesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTypes']])->get();
		$finetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finetypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('finetypesdata'));
		}else{
			return view('admin.fine_types.create',compact('finetypesdata'));
		}
	}

	public function filter(Request $request){
		$finetypesdata['list']=FineTypes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTypes']])->get();
		$finetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finetypesdata['usersaccountsroles'][0]['_add']==0&&$finetypesdata['usersaccountsroles'][0]['_list']==0&&$finetypesdata['usersaccountsroles'][0]['_edit']==0&&$finetypesdata['usersaccountsroles'][0]['_edit']==0&&$finetypesdata['usersaccountsroles'][0]['_show']==0&&$finetypesdata['usersaccountsroles'][0]['_delete']==0&&$finetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finetypesdata'));
		}else{
			return view('admin.fine_types.index',compact('finetypesdata'));
		}
	}

	public function report(){
		$finetypesdata['company']=Companies::all();
		$finetypesdata['list']=FineTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTypes']])->get();
		$finetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finetypesdata'));
		}else{
			return view('admin.fine_types.report',compact('finetypesdata'));
		}
	}

	public function chart(){
		return view('admin.fine_types.chart');
	}

	public function store(Request $request){
		$finetypes=new FineTypes();
		$finetypes->code=$request->get('code');
		$finetypes->name=$request->get('name');
		$finetypes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTypes']])->get();
		$finetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finetypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($finetypes->save()){
					$response['status']='1';
					$response['message']='fine types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add fine types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add fine types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$finetypesdata['data']=FineTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTypes']])->get();
		$finetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finetypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finetypesdata'));
		}else{
		return view('admin.fine_types.edit',compact('finetypesdata','id'));
		}
	}

	public function show($id){
		$finetypesdata['data']=FineTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTypes']])->get();
		$finetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finetypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('finetypesdata'));
		}else{
		return view('admin.fine_types.show',compact('finetypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$finetypes=FineTypes::find($id);
		$finetypes->code=$request->get('code');
		$finetypes->name=$request->get('name');
		$finetypes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTypes']])->get();
		$finetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finetypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finetypesdata'));
		}else{
		$finetypes->save();
		$finetypesdata['data']=FineTypes::find($id);
		return view('admin.fine_types.edit',compact('finetypesdata','id'));
		}
	}

	public function destroy($id){
		$finetypes=FineTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineTypes']])->get();
		$finetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finetypesdata['usersaccountsroles'][0]['_delete']==1){
			$finetypes->delete();
		}return redirect('admin/finetypes')->with('success','fine types has been deleted!');
	}
}