<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Positions;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class PositionsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$positionsdata['list']=Positions::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Positions']])->get();
		$positionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($positionsdata['usersaccountsroles'][0]['_add']==0&&$positionsdata['usersaccountsroles'][0]['_list']==0&&$positionsdata['usersaccountsroles'][0]['_edit']==0&&$positionsdata['usersaccountsroles'][0]['_edit']==0&&$positionsdata['usersaccountsroles'][0]['_show']==0&&$positionsdata['usersaccountsroles'][0]['_delete']==0&&$positionsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('positionsdata'));
		}else{
			return view('admin.positions.index',compact('positionsdata'));
		}
	}

	public function create(){
		$positionsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Positions']])->get();
		$positionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($positionsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('positionsdata'));
		}else{
			return view('admin.positions.create',compact('positionsdata'));
		}
	}

	public function filter(Request $request){
		$positionsdata['list']=Positions::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Positions']])->get();
		$positionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($positionsdata['usersaccountsroles'][0]['_add']==0&&$positionsdata['usersaccountsroles'][0]['_list']==0&&$positionsdata['usersaccountsroles'][0]['_edit']==0&&$positionsdata['usersaccountsroles'][0]['_edit']==0&&$positionsdata['usersaccountsroles'][0]['_show']==0&&$positionsdata['usersaccountsroles'][0]['_delete']==0&&$positionsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('positionsdata'));
		}else{
			return view('admin.positions.index',compact('positionsdata'));
		}
	}

	public function report(){
		$positionsdata['company']=Companies::all();
		$positionsdata['list']=Positions::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Positions']])->get();
		$positionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($positionsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('positionsdata'));
		}else{
			return view('admin.positions.report',compact('positionsdata'));
		}
	}

	public function chart(){
		return view('admin.positions.chart');
	}

	public function store(Request $request){
		$positions=new Positions();
		$positions->code=$request->get('code');
		$positions->name=$request->get('name');
		$positions->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Positions']])->get();
		$positionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($positionsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($positions->save()){
					$response['status']='1';
					$response['message']='positions Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add positions. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add positions. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$positionsdata['data']=Positions::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Positions']])->get();
		$positionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($positionsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('positionsdata'));
		}else{
		return view('admin.positions.edit',compact('positionsdata','id'));
		}
	}

	public function show($id){
		$positionsdata['data']=Positions::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Positions']])->get();
		$positionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($positionsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('positionsdata'));
		}else{
		return view('admin.positions.show',compact('positionsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$positions=Positions::find($id);
		$positions->code=$request->get('code');
		$positions->name=$request->get('name');
		$positions->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Positions']])->get();
		$positionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($positionsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('positionsdata'));
		}else{
		$positions->save();
		$positionsdata['data']=Positions::find($id);
		return view('admin.positions.edit',compact('positionsdata','id'));
		}
	}

	public function destroy($id){
		$positions=Positions::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Positions']])->get();
		$positionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($positionsdata['usersaccountsroles'][0]['_delete']==1){
			$positions->delete();
		}return redirect('admin/positions')->with('success','positions has been deleted!');
	}
}