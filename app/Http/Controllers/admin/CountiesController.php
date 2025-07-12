<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Counties;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class CountiesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$countiesdata['list']=Counties::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Counties']])->get();
		$countiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countiesdata['usersaccountsroles'][0]['_add']==0&&$countiesdata['usersaccountsroles'][0]['_list']==0&&$countiesdata['usersaccountsroles'][0]['_edit']==0&&$countiesdata['usersaccountsroles'][0]['_edit']==0&&$countiesdata['usersaccountsroles'][0]['_show']==0&&$countiesdata['usersaccountsroles'][0]['_delete']==0&&$countiesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('countiesdata'));
		}else{
			return view('admin.counties.index',compact('countiesdata'));
		}
	}

	public function create(){
		$countiesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Counties']])->get();
		$countiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countiesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('countiesdata'));
		}else{
			return view('admin.counties.create',compact('countiesdata'));
		}
	}

	public function filter(Request $request){
		$countiesdata['list']=Counties::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Counties']])->get();
		$countiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countiesdata['usersaccountsroles'][0]['_add']==0&&$countiesdata['usersaccountsroles'][0]['_list']==0&&$countiesdata['usersaccountsroles'][0]['_edit']==0&&$countiesdata['usersaccountsroles'][0]['_edit']==0&&$countiesdata['usersaccountsroles'][0]['_show']==0&&$countiesdata['usersaccountsroles'][0]['_delete']==0&&$countiesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('countiesdata'));
		}else{
			return view('admin.counties.index',compact('countiesdata'));
		}
	}

	public function report(){
		$countiesdata['company']=Companies::all();
		$countiesdata['list']=Counties::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Counties']])->get();
		$countiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countiesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('countiesdata'));
		}else{
			return view('admin.counties.report',compact('countiesdata'));
		}
	}

	public function chart(){
		return view('admin.counties.chart');
	}

	public function store(Request $request){
		$counties=new Counties();
		$counties->code=$request->get('code');
		$counties->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Counties']])->get();
		$countiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countiesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($counties->save()){
					$response['status']='1';
					$response['message']='counties Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add counties. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add counties. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$countiesdata['data']=Counties::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Counties']])->get();
		$countiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countiesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('countiesdata'));
		}else{
		return view('admin.counties.edit',compact('countiesdata','id'));
		}
	}

	public function show($id){
		$countiesdata['data']=Counties::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Counties']])->get();
		$countiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countiesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('countiesdata'));
		}else{
		return view('admin.counties.show',compact('countiesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$counties=Counties::find($id);
		$counties->code=$request->get('code');
		$counties->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Counties']])->get();
		$countiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countiesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('countiesdata'));
		}else{
		$counties->save();
		$countiesdata['data']=Counties::find($id);
		return view('admin.counties.edit',compact('countiesdata','id'));
		}
	}

	public function destroy($id){
		$counties=Counties::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Counties']])->get();
		$countiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countiesdata['usersaccountsroles'][0]['_delete']==1){
			$counties->delete();
		}return redirect('admin/counties')->with('success','counties has been deleted!');
	}
}