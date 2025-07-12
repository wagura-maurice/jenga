<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages default meters data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\DefaulterMeters;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class DefaulterMetersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$defaultermetersdata['list']=DefaulterMeters::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DefaulterMeters']])->get();
		$defaultermetersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($defaultermetersdata['usersaccountsroles'][0]['_add']==0&&$defaultermetersdata['usersaccountsroles'][0]['_list']==0&&$defaultermetersdata['usersaccountsroles'][0]['_edit']==0&&$defaultermetersdata['usersaccountsroles'][0]['_edit']==0&&$defaultermetersdata['usersaccountsroles'][0]['_show']==0&&$defaultermetersdata['usersaccountsroles'][0]['_delete']==0&&$defaultermetersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('defaultermetersdata'));
		}else{
			return view('admin.defaulter_meters.index',compact('defaultermetersdata'));
		}
	}

	public function create(){
		$defaultermetersdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DefaulterMeters']])->get();
		$defaultermetersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($defaultermetersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('defaultermetersdata'));
		}else{
			return view('admin.defaulter_meters.create',compact('defaultermetersdata'));
		}
	}

	public function filter(Request $request){
		$defaultermetersdata['list']=DefaulterMeters::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['number_of_days','LIKE','%'.$request->get('number_of_days').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DefaulterMeters']])->get();
		$defaultermetersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($defaultermetersdata['usersaccountsroles'][0]['_add']==0&&$defaultermetersdata['usersaccountsroles'][0]['_list']==0&&$defaultermetersdata['usersaccountsroles'][0]['_edit']==0&&$defaultermetersdata['usersaccountsroles'][0]['_edit']==0&&$defaultermetersdata['usersaccountsroles'][0]['_show']==0&&$defaultermetersdata['usersaccountsroles'][0]['_delete']==0&&$defaultermetersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('defaultermetersdata'));
		}else{
			return view('admin.defaulter_meters.index',compact('defaultermetersdata'));
		}
	}

	public function report(){
		$defaultermetersdata['company']=Companies::all();
		$defaultermetersdata['list']=DefaulterMeters::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DefaulterMeters']])->get();
		$defaultermetersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($defaultermetersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('defaultermetersdata'));
		}else{
			return view('admin.defaulter_meters.report',compact('defaultermetersdata'));
		}
	}

	public function chart(){
		return view('admin.defaulter_meters.chart');
	}

	public function store(Request $request){
		$defaultermeters=new DefaulterMeters();
		$defaultermeters->code=$request->get('code');
		$defaultermeters->name=$request->get('name');
		$defaultermeters->number_of_days=$request->get('number_of_days');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DefaulterMeters']])->get();
		$defaultermetersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($defaultermetersdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($defaultermeters->save()){
					$response['status']='1';
					$response['message']='defaulter meters Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add defaulter meters. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add defaulter meters. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$defaultermetersdata['data']=DefaulterMeters::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DefaulterMeters']])->get();
		$defaultermetersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($defaultermetersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('defaultermetersdata'));
		}else{
		return view('admin.defaulter_meters.edit',compact('defaultermetersdata','id'));
		}
	}

	public function show($id){
		$defaultermetersdata['data']=DefaulterMeters::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DefaulterMeters']])->get();
		$defaultermetersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($defaultermetersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('defaultermetersdata'));
		}else{
		return view('admin.defaulter_meters.show',compact('defaultermetersdata','id'));
		}
	}

	public function update(Request $request,$id){
		$defaultermeters=DefaulterMeters::find($id);
		$defaultermeters->code=$request->get('code');
		$defaultermeters->name=$request->get('name');
		$defaultermeters->number_of_days=$request->get('number_of_days');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DefaulterMeters']])->get();
		$defaultermetersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($defaultermetersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('defaultermetersdata'));
		}else{
		$defaultermeters->save();
		$defaultermetersdata['data']=DefaulterMeters::find($id);
		return view('admin.defaulter_meters.edit',compact('defaultermetersdata','id'));
		}
	}

	public function destroy($id){
		$defaultermeters=DefaulterMeters::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','DefaulterMeters']])->get();
		$defaultermetersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($defaultermetersdata['usersaccountsroles'][0]['_delete']==1){
			$defaultermeters->delete();
		}return redirect('admin/defaultermeters')->with('success','defaulter meters has been deleted!');
	}
}