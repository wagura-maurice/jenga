<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Countries;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class CountriesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$countriesdata['list']=Countries::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Countries']])->get();
		$countriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countriesdata['usersaccountsroles'][0]['_add']==0&&$countriesdata['usersaccountsroles'][0]['_list']==0&&$countriesdata['usersaccountsroles'][0]['_edit']==0&&$countriesdata['usersaccountsroles'][0]['_edit']==0&&$countriesdata['usersaccountsroles'][0]['_show']==0&&$countriesdata['usersaccountsroles'][0]['_delete']==0&&$countriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('countriesdata'));
		}else{
			return view('admin.countries.index',compact('countriesdata'));
		}
	}

	public function create(){
		$countriesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Countries']])->get();
		$countriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countriesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('countriesdata'));
		}else{
			return view('admin.countries.create',compact('countriesdata'));
		}
	}

	public function filter(Request $request){
		$countriesdata['list']=Countries::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['abbreviation','LIKE','%'.$request->get('abbreviation').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Countries']])->get();
		$countriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countriesdata['usersaccountsroles'][0]['_add']==0&&$countriesdata['usersaccountsroles'][0]['_list']==0&&$countriesdata['usersaccountsroles'][0]['_edit']==0&&$countriesdata['usersaccountsroles'][0]['_edit']==0&&$countriesdata['usersaccountsroles'][0]['_show']==0&&$countriesdata['usersaccountsroles'][0]['_delete']==0&&$countriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('countriesdata'));
		}else{
			return view('admin.countries.index',compact('countriesdata'));
		}
	}

	public function report(){
		$countriesdata['company']=Companies::all();
		$countriesdata['list']=Countries::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Countries']])->get();
		$countriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countriesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('countriesdata'));
		}else{
			return view('admin.countries.report',compact('countriesdata'));
		}
	}

	public function chart(){
		return view('admin.countries.chart');
	}

	public function store(Request $request){
		$countries=new Countries();
		$countries->flag=time() . '_' . rand(1000, 9999) . '.jpg';
		$countries->code=$request->get('code');
		$countries->name=$request->get('name');
		$countries->abbreviation=$request->get('abbreviation');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Countries']])->get();
		$countriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countriesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($countries->save()){
			$FlagImage = $request->file('flag');
			$FlagImage->move('uploads/images',$countries->flag);
					$response['status']='1';
					$response['message']='countries Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add countries. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add countries. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$countriesdata['data']=Countries::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Countries']])->get();
		$countriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('countriesdata'));
		}else{
		return view('admin.countries.edit',compact('countriesdata','id'));
		}
	}

	public function show($id){
		$countriesdata['data']=Countries::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Countries']])->get();
		$countriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countriesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('countriesdata'));
		}else{
		return view('admin.countries.show',compact('countriesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$countries=Countries::find($id);
		$countries->code=$request->get('code');
		$countries->name=$request->get('name');
		$countries->abbreviation=$request->get('abbreviation');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Countries']])->get();
		$countriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countriesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('countriesdata'));
		}else{
		$countries->save();
		$countriesdata['data']=Countries::find($id);
		return view('admin.countries.edit',compact('countriesdata','id'));
		}
	}

	public function destroy($id){
		$countries=Countries::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Countries']])->get();
		$countriesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($countriesdata['usersaccountsroles'][0]['_delete']==1){
			$countries->delete();
		}return redirect('admin/countries')->with('success','countries has been deleted!');
	}
}