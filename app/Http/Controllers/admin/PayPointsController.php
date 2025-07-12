<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PayPoints;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class PayPointsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$paypointsdata['list']=PayPoints::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayPoints']])->get();
		$paypointsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paypointsdata['usersaccountsroles'][0]['_add']==0&&$paypointsdata['usersaccountsroles'][0]['_list']==0&&$paypointsdata['usersaccountsroles'][0]['_edit']==0&&$paypointsdata['usersaccountsroles'][0]['_edit']==0&&$paypointsdata['usersaccountsroles'][0]['_show']==0&&$paypointsdata['usersaccountsroles'][0]['_delete']==0&&$paypointsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('paypointsdata'));
		}else{
			return view('admin.pay_points.index',compact('paypointsdata'));
		}
	}

	public function create(){
		$paypointsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayPoints']])->get();
		$paypointsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paypointsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('paypointsdata'));
		}else{
			return view('admin.pay_points.create',compact('paypointsdata'));
		}
	}

	public function filter(Request $request){
		$paypointsdata['list']=PayPoints::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayPoints']])->get();
		$paypointsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paypointsdata['usersaccountsroles'][0]['_add']==0&&$paypointsdata['usersaccountsroles'][0]['_list']==0&&$paypointsdata['usersaccountsroles'][0]['_edit']==0&&$paypointsdata['usersaccountsroles'][0]['_edit']==0&&$paypointsdata['usersaccountsroles'][0]['_show']==0&&$paypointsdata['usersaccountsroles'][0]['_delete']==0&&$paypointsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('paypointsdata'));
		}else{
			return view('admin.pay_points.index',compact('paypointsdata'));
		}
	}

	public function report(){
		$paypointsdata['company']=Companies::all();
		$paypointsdata['list']=PayPoints::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayPoints']])->get();
		$paypointsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paypointsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('paypointsdata'));
		}else{
			return view('admin.pay_points.report',compact('paypointsdata'));
		}
	}

	public function chart(){
		return view('admin.pay_points.chart');
	}

	public function store(Request $request){
		$paypoints=new PayPoints();
		$paypoints->code=$request->get('code');
		$paypoints->name=$request->get('name');
		$paypoints->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayPoints']])->get();
		$paypointsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paypointsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($paypoints->save()){
					$response['status']='1';
					$response['message']='pay points Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add pay points. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add pay points. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$paypointsdata['data']=PayPoints::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayPoints']])->get();
		$paypointsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paypointsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('paypointsdata'));
		}else{
		return view('admin.pay_points.edit',compact('paypointsdata','id'));
		}
	}

	public function show($id){
		$paypointsdata['data']=PayPoints::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayPoints']])->get();
		$paypointsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paypointsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('paypointsdata'));
		}else{
		return view('admin.pay_points.show',compact('paypointsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$paypoints=PayPoints::find($id);
		$paypoints->code=$request->get('code');
		$paypoints->name=$request->get('name');
		$paypoints->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayPoints']])->get();
		$paypointsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paypointsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('paypointsdata'));
		}else{
		$paypoints->save();
		$paypointsdata['data']=PayPoints::find($id);
		return view('admin.pay_points.edit',compact('paypointsdata','id'));
		}
	}

	public function destroy($id){
		$paypoints=PayPoints::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayPoints']])->get();
		$paypointsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paypointsdata['usersaccountsroles'][0]['_delete']==1){
			$paypoints->delete();
		}return redirect('admin/paypoints')->with('success','pay points has been deleted!');
	}
}