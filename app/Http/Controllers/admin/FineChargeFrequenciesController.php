<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\FineChargeFrequencies;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class FineChargeFrequenciesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$finechargefrequenciesdata['list']=FineChargeFrequencies::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargeFrequencies']])->get();
		$finechargefrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargefrequenciesdata['usersaccountsroles'][0]['_add']==0&&$finechargefrequenciesdata['usersaccountsroles'][0]['_list']==0&&$finechargefrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$finechargefrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$finechargefrequenciesdata['usersaccountsroles'][0]['_show']==0&&$finechargefrequenciesdata['usersaccountsroles'][0]['_delete']==0&&$finechargefrequenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finechargefrequenciesdata'));
		}else{
			return view('admin.fine_charge_frequencies.index',compact('finechargefrequenciesdata'));
		}
	}

	public function create(){
		$finechargefrequenciesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargeFrequencies']])->get();
		$finechargefrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargefrequenciesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('finechargefrequenciesdata'));
		}else{
			return view('admin.fine_charge_frequencies.create',compact('finechargefrequenciesdata'));
		}
	}

	public function filter(Request $request){
		$finechargefrequenciesdata['list']=FineChargeFrequencies::where([['name','LIKE','%'.$request->get('name').'%'],['number_of_days','LIKE','%'.$request->get('number_of_days').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargeFrequencies']])->get();
		$finechargefrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargefrequenciesdata['usersaccountsroles'][0]['_add']==0&&$finechargefrequenciesdata['usersaccountsroles'][0]['_list']==0&&$finechargefrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$finechargefrequenciesdata['usersaccountsroles'][0]['_edit']==0&&$finechargefrequenciesdata['usersaccountsroles'][0]['_show']==0&&$finechargefrequenciesdata['usersaccountsroles'][0]['_delete']==0&&$finechargefrequenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finechargefrequenciesdata'));
		}else{
			return view('admin.fine_charge_frequencies.index',compact('finechargefrequenciesdata'));
		}
	}

	public function report(){
		$finechargefrequenciesdata['company']=Companies::all();
		$finechargefrequenciesdata['list']=FineChargeFrequencies::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargeFrequencies']])->get();
		$finechargefrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargefrequenciesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finechargefrequenciesdata'));
		}else{
			return view('admin.fine_charge_frequencies.report',compact('finechargefrequenciesdata'));
		}
	}

	public function chart(){
		return view('admin.fine_charge_frequencies.chart');
	}

	public function store(Request $request){
		$finechargefrequencies=new FineChargeFrequencies();
		$finechargefrequencies->name=$request->get('name');
		$finechargefrequencies->number_of_days=$request->get('number_of_days');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargeFrequencies']])->get();
		$finechargefrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargefrequenciesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($finechargefrequencies->save()){
					$response['status']='1';
					$response['message']='fine charge frequencies Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add fine charge frequencies. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add fine charge frequencies. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$finechargefrequenciesdata['data']=FineChargeFrequencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargeFrequencies']])->get();
		$finechargefrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargefrequenciesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finechargefrequenciesdata'));
		}else{
		return view('admin.fine_charge_frequencies.edit',compact('finechargefrequenciesdata','id'));
		}
	}

	public function show($id){
		$finechargefrequenciesdata['data']=FineChargeFrequencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargeFrequencies']])->get();
		$finechargefrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargefrequenciesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('finechargefrequenciesdata'));
		}else{
		return view('admin.fine_charge_frequencies.show',compact('finechargefrequenciesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$finechargefrequencies=FineChargeFrequencies::find($id);
		$finechargefrequencies->name=$request->get('name');
		$finechargefrequencies->number_of_days=$request->get('number_of_days');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargeFrequencies']])->get();
		$finechargefrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargefrequenciesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finechargefrequenciesdata'));
		}else{
		$finechargefrequencies->save();
		$finechargefrequenciesdata['data']=FineChargeFrequencies::find($id);
		return view('admin.fine_charge_frequencies.edit',compact('finechargefrequenciesdata','id'));
		}
	}

	public function destroy($id){
		$finechargefrequencies=FineChargeFrequencies::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargeFrequencies']])->get();
		$finechargefrequenciesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargefrequenciesdata['usersaccountsroles'][0]['_delete']==1){
			$finechargefrequencies->delete();
		}return redirect('admin/finechargefrequencies')->with('success','fine charge frequencies has been deleted!');
	}
}