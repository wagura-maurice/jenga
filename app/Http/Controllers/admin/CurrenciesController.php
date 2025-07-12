<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Currencies;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class CurrenciesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$currenciesdata['list']=Currencies::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$currenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($currenciesdata['usersaccountsroles'][0]['_add']==0&&$currenciesdata['usersaccountsroles'][0]['_list']==0&&$currenciesdata['usersaccountsroles'][0]['_edit']==0&&$currenciesdata['usersaccountsroles'][0]['_edit']==0&&$currenciesdata['usersaccountsroles'][0]['_show']==0&&$currenciesdata['usersaccountsroles'][0]['_delete']==0&&$currenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('currenciesdata'));
		}else{
			return view('admin.currencies.index',compact('currenciesdata'));
		}
	}

	public function create(){
		$currenciesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$currenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($currenciesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('currenciesdata'));
		}else{
			return view('admin.currencies.create',compact('currenciesdata'));
		}
	}

	public function filter(Request $request){
		$currenciesdata['list']=Currencies::where([['name','LIKE','%'.$request->get('name').'%'],['abbreviation','LIKE','%'.$request->get('abbreviation').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$currenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($currenciesdata['usersaccountsroles'][0]['_add']==0&&$currenciesdata['usersaccountsroles'][0]['_list']==0&&$currenciesdata['usersaccountsroles'][0]['_edit']==0&&$currenciesdata['usersaccountsroles'][0]['_edit']==0&&$currenciesdata['usersaccountsroles'][0]['_show']==0&&$currenciesdata['usersaccountsroles'][0]['_delete']==0&&$currenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('currenciesdata'));
		}else{
			return view('admin.currencies.index',compact('currenciesdata'));
		}
	}

	public function report(){
		$currenciesdata['company']=Companies::all();
		$currenciesdata['list']=Currencies::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$currenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($currenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('currenciesdata'));
		}else{
			return view('admin.currencies.report',compact('currenciesdata'));
		}
	}

	public function chart(){
		return view('admin.currencies.chart');
	}

	public function store(Request $request){
		$currencies=new Currencies();
		$currencies->image=time() . '_' . rand(1000, 9999) . '.jpg';
		$currencies->name=$request->get('name');
		$currencies->abbreviation=$request->get('abbreviation');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$currenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($currenciesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($currencies->save()){
			$ImageImage = $request->file('image');
			$ImageImage->move('uploads/images',$currencies->image);
					$response['status']='1';
					$response['message']='currencies Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add currencies. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add currencies. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$currenciesdata['data']=Currencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$currenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($currenciesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('currenciesdata'));
		}else{
		return view('admin.currencies.edit',compact('currenciesdata','id'));
		}
	}

	public function show($id){
		$currenciesdata['data']=Currencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$currenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($currenciesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('currenciesdata'));
		}else{
		return view('admin.currencies.show',compact('currenciesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$currencies=Currencies::find($id);
		$currencies->name=$request->get('name');
		$currencies->abbreviation=$request->get('abbreviation');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$currenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($currenciesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('currenciesdata'));
		}else{
		$currencies->save();
		$currenciesdata['data']=Currencies::find($id);
		return view('admin.currencies.edit',compact('currenciesdata','id'));
		}
	}

	public function destroy($id){
		$currencies=Currencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Users']])->get();
		$currenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($currenciesdata['usersaccountsroles'][0]['_delete']==1){
			$currencies->delete();
		}return redirect('admin/currencies')->with('success','currencies has been deleted!');
	}
}