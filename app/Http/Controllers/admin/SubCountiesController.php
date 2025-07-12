<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SubCounties;
use App\Companies;
use App\Modules;
use App\Users;
use App\Counties;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class SubCountiesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$subcountiesdata['counties']=Counties::all();
		$subcountiesdata['list']=SubCounties::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubCounties']])->get();
		$subcountiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subcountiesdata['usersaccountsroles'][0]['_add']==0&&$subcountiesdata['usersaccountsroles'][0]['_list']==0&&$subcountiesdata['usersaccountsroles'][0]['_edit']==0&&$subcountiesdata['usersaccountsroles'][0]['_edit']==0&&$subcountiesdata['usersaccountsroles'][0]['_show']==0&&$subcountiesdata['usersaccountsroles'][0]['_delete']==0&&$subcountiesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('subcountiesdata'));
		}else{
			return view('admin.sub_counties.index',compact('subcountiesdata'));
		}
	}

	public function create(){
		$subcountiesdata;
		$subcountiesdata['counties']=Counties::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubCounties']])->get();
		$subcountiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subcountiesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('subcountiesdata'));
		}else{
			return view('admin.sub_counties.create',compact('subcountiesdata'));
		}
	}

	public function filter(Request $request){
		$subcountiesdata['counties']=Counties::all();
		$subcountiesdata['list']=SubCounties::where([['county','LIKE','%'.$request->get('county').'%'],['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubCounties']])->get();
		$subcountiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subcountiesdata['usersaccountsroles'][0]['_add']==0&&$subcountiesdata['usersaccountsroles'][0]['_list']==0&&$subcountiesdata['usersaccountsroles'][0]['_edit']==0&&$subcountiesdata['usersaccountsroles'][0]['_edit']==0&&$subcountiesdata['usersaccountsroles'][0]['_show']==0&&$subcountiesdata['usersaccountsroles'][0]['_delete']==0&&$subcountiesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('subcountiesdata'));
		}else{
			return view('admin.sub_counties.index',compact('subcountiesdata'));
		}
	}

	public function report(){
		$subcountiesdata['company']=Companies::all();
		$subcountiesdata['list']=SubCounties::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubCounties']])->get();
		$subcountiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subcountiesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('subcountiesdata'));
		}else{
			return view('admin.sub_counties.report',compact('subcountiesdata'));
		}
	}

	public function chart(){
		return view('admin.sub_counties.chart');
	}

	public function store(Request $request){
		$subcounties=new SubCounties();
		$subcounties->county=$request->get('county');
		$subcounties->code=$request->get('code');
		$subcounties->name=$request->get('name');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubCounties']])->get();
		$subcountiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subcountiesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($subcounties->save()){
					$response['status']='1';
					$response['message']='sub counties Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add sub counties. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add sub counties. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$subcountiesdata['counties']=Counties::all();
		$subcountiesdata['data']=SubCounties::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubCounties']])->get();
		$subcountiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subcountiesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('subcountiesdata'));
		}else{
		return view('admin.sub_counties.edit',compact('subcountiesdata','id'));
		}
	}

	public function show($id){
		$subcountiesdata['counties']=Counties::all();
		$subcountiesdata['data']=SubCounties::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubCounties']])->get();
		$subcountiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subcountiesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('subcountiesdata'));
		}else{
		return view('admin.sub_counties.show',compact('subcountiesdata','id'));
		}
	}

	public function getSubCountiesByCounty(Request $request){
		
		$subcountiesdata=SubCounties::where([['county','=',$request->get('county')]])->get();
		return json_encode($subcountiesdata);
	}	

	public function update(Request $request,$id){
		$subcounties=SubCounties::find($id);
		$subcounties->county=$request->get('county');
		$subcounties->code=$request->get('code');
		$subcounties->name=$request->get('name');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubCounties']])->get();
		$subcountiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subcountiesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('subcountiesdata'));
		}else{
		$subcounties->save();
		$subcountiesdata['data']=SubCounties::find($id);
		return view('admin.sub_counties.edit',compact('subcountiesdata','id'));
		}
	}

	public function destroy($id){
		$subcounties=SubCounties::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SubCounties']])->get();
		$subcountiesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($subcountiesdata['usersaccountsroles'][0]['_delete']==1){
			$subcounties->delete();
		}return redirect('admin/subcounties')->with('success','sub counties has been deleted!');
	}
}