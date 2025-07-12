<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PayFrequencies;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class PayFrequenciesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$payfrequenciesdata['list']=PayFrequencies::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayFrequencies']])->get();
		$payfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($payfrequenciesdata['usersaccountsroles'][0]['_add']==0&&$payfrequenciesdata['usersaccountsroles'][0]['_list']==0&&$payfrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$payfrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$payfrequenciesdata['usersaccountsroles'][0]['_show']==0&&$payfrequenciesdata['usersaccountsroles'][0]['_delete']==0&&$payfrequenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('payfrequenciesdata'));
		}else{
			return view('admin.pay_frequencies.index',compact('payfrequenciesdata'));
		}
	}

	public function create(){
		$payfrequenciesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayFrequencies']])->get();
		$payfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($payfrequenciesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('payfrequenciesdata'));
		}else{
			return view('admin.pay_frequencies.create',compact('payfrequenciesdata'));
		}
	}

	public function filter(Request $request){
		$payfrequenciesdata['list']=PayFrequencies::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayFrequencies']])->get();
		$payfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($payfrequenciesdata['usersaccountsroles'][0]['_add']==0&&$payfrequenciesdata['usersaccountsroles'][0]['_list']==0&&$payfrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$payfrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$payfrequenciesdata['usersaccountsroles'][0]['_show']==0&&$payfrequenciesdata['usersaccountsroles'][0]['_delete']==0&&$payfrequenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('payfrequenciesdata'));
		}else{
			return view('admin.pay_frequencies.index',compact('payfrequenciesdata'));
		}
	}

	public function report(){
		$payfrequenciesdata['company']=Companies::all();
		$payfrequenciesdata['list']=PayFrequencies::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayFrequencies']])->get();
		$payfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($payfrequenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('payfrequenciesdata'));
		}else{
			return view('admin.pay_frequencies.report',compact('payfrequenciesdata'));
		}
	}

	public function chart(){
		return view('admin.pay_frequencies.chart');
	}

	public function store(Request $request){
		$payfrequencies=new PayFrequencies();
		$payfrequencies->code=$request->get('code');
		$payfrequencies->name=$request->get('name');
		$payfrequencies->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayFrequencies']])->get();
		$payfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($payfrequenciesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($payfrequencies->save()){
					$response['status']='1';
					$response['message']='pay frequencies Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add pay frequencies. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add pay frequencies. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$payfrequenciesdata['data']=PayFrequencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayFrequencies']])->get();
		$payfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($payfrequenciesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('payfrequenciesdata'));
		}else{
		return view('admin.pay_frequencies.edit',compact('payfrequenciesdata','id'));
		}
	}

	public function show($id){
		$payfrequenciesdata['data']=PayFrequencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayFrequencies']])->get();
		$payfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($payfrequenciesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('payfrequenciesdata'));
		}else{
		return view('admin.pay_frequencies.show',compact('payfrequenciesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$payfrequencies=PayFrequencies::find($id);
		$payfrequencies->code=$request->get('code');
		$payfrequencies->name=$request->get('name');
		$payfrequencies->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayFrequencies']])->get();
		$payfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($payfrequenciesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('payfrequenciesdata'));
		}else{
		$payfrequencies->save();
		$payfrequenciesdata['data']=PayFrequencies::find($id);
		return view('admin.pay_frequencies.edit',compact('payfrequenciesdata','id'));
		}
	}

	public function destroy($id){
		$payfrequencies=PayFrequencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PayFrequencies']])->get();
		$payfrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($payfrequenciesdata['usersaccountsroles'][0]['_delete']==1){
			$payfrequencies->delete();
		}return redirect('admin/payfrequencies')->with('success','pay frequencies has been deleted!');
	}
}