<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\MaritalStatuses;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class MaritalStatusesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$maritalstatusesdata['list']=MaritalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MaritalStatuses']])->get();
		$maritalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maritalstatusesdata['usersaccountsroles'][0]['_add']==0&&$maritalstatusesdata['usersaccountsroles'][0]['_list']==0&&$maritalstatusesdata['usersaccountsroles'][0]['_edit']==0&&$maritalstatusesdata['usersaccountsroles'][0]['_edit']==0&&$maritalstatusesdata['usersaccountsroles'][0]['_show']==0&&$maritalstatusesdata['usersaccountsroles'][0]['_delete']==0&&$maritalstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('maritalstatusesdata'));
		}else{
			return view('admin.marital_statuses.index',compact('maritalstatusesdata'));
		}
	}

	public function create(){
		$maritalstatusesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MaritalStatuses']])->get();
		$maritalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maritalstatusesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('maritalstatusesdata'));
		}else{
			return view('admin.marital_statuses.create',compact('maritalstatusesdata'));
		}
	}

	public function filter(Request $request){
		$maritalstatusesdata['list']=MaritalStatuses::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MaritalStatuses']])->get();
		$maritalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maritalstatusesdata['usersaccountsroles'][0]['_add']==0&&$maritalstatusesdata['usersaccountsroles'][0]['_list']==0&&$maritalstatusesdata['usersaccountsroles'][0]['_edit']==0&&$maritalstatusesdata['usersaccountsroles'][0]['_edit']==0&&$maritalstatusesdata['usersaccountsroles'][0]['_show']==0&&$maritalstatusesdata['usersaccountsroles'][0]['_delete']==0&&$maritalstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('maritalstatusesdata'));
		}else{
			return view('admin.marital_statuses.index',compact('maritalstatusesdata'));
		}
	}

	public function report(){
		$maritalstatusesdata['company']=Companies::all();
		$maritalstatusesdata['list']=MaritalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MaritalStatuses']])->get();
		$maritalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maritalstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('maritalstatusesdata'));
		}else{
			return view('admin.marital_statuses.report',compact('maritalstatusesdata'));
		}
	}

	public function chart(){
		return view('admin.marital_statuses.chart');
	}

	public function store(Request $request){
		$maritalstatuses=new MaritalStatuses();
		$maritalstatuses->code=$request->get('code');
		$maritalstatuses->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MaritalStatuses']])->get();
		$maritalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maritalstatusesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($maritalstatuses->save()){
					$response['status']='1';
					$response['message']='marital statuses Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add marital statuses. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add marital statuses. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$maritalstatusesdata['data']=MaritalStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MaritalStatuses']])->get();
		$maritalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maritalstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('maritalstatusesdata'));
		}else{
		return view('admin.marital_statuses.edit',compact('maritalstatusesdata','id'));
		}
	}

	public function show($id){
		$maritalstatusesdata['data']=MaritalStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MaritalStatuses']])->get();
		$maritalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maritalstatusesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('maritalstatusesdata'));
		}else{
		return view('admin.marital_statuses.show',compact('maritalstatusesdata','id'));
		}
	}

	public function getmaritalstatus($id){
		$maritalstatusesdata=MaritalStatuses::find($id);
		return json_encode($maritalstatusesdata);
	}


	public function update(Request $request,$id){
		$maritalstatuses=MaritalStatuses::find($id);
		$maritalstatuses->code=$request->get('code');
		$maritalstatuses->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MaritalStatuses']])->get();
		$maritalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maritalstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('maritalstatusesdata'));
		}else{
		$maritalstatuses->save();
		$maritalstatusesdata['data']=MaritalStatuses::find($id);
		return view('admin.marital_statuses.edit',compact('maritalstatusesdata','id'));
		}
	}

	public function destroy($id){
		$maritalstatuses=MaritalStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MaritalStatuses']])->get();
		$maritalstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($maritalstatusesdata['usersaccountsroles'][0]['_delete']==1){
			$maritalstatuses->delete();
		}return redirect('admin/maritalstatuses')->with('success','marital statuses has been deleted!');
	}
}