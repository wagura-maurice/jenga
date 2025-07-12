<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\FineChargePeriods;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class FineChargePeriodsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$finechargeperiodsdata['list']=FineChargePeriods::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargePeriods']])->get();
		$finechargeperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargeperiodsdata['usersaccountsroles'][0]['_add']==0&&$finechargeperiodsdata['usersaccountsroles'][0]['_list']==0&&$finechargeperiodsdata['usersaccountsroles'][0]['_edit']==0&&$finechargeperiodsdata['usersaccountsroles'][0]['_edit']==0&&$finechargeperiodsdata['usersaccountsroles'][0]['_show']==0&&$finechargeperiodsdata['usersaccountsroles'][0]['_delete']==0&&$finechargeperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finechargeperiodsdata'));
		}else{
			return view('admin.fine_charge_periods.index',compact('finechargeperiodsdata'));
		}
	}

	public function create(){
		$finechargeperiodsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargePeriods']])->get();
		$finechargeperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargeperiodsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('finechargeperiodsdata'));
		}else{
			return view('admin.fine_charge_periods.create',compact('finechargeperiodsdata'));
		}
	}

	public function filter(Request $request){
		$finechargeperiodsdata['list']=FineChargePeriods::where([['name','LIKE','%'.$request->get('name').'%'],['number_of_days','LIKE','%'.$request->get('number_of_days').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargePeriods']])->get();
		$finechargeperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargeperiodsdata['usersaccountsroles'][0]['_add']==0&&$finechargeperiodsdata['usersaccountsroles'][0]['_list']==0&&$finechargeperiodsdata['usersaccountsroles'][0]['_edit']==0&&$finechargeperiodsdata['usersaccountsroles'][0]['_edit']==0&&$finechargeperiodsdata['usersaccountsroles'][0]['_show']==0&&$finechargeperiodsdata['usersaccountsroles'][0]['_delete']==0&&$finechargeperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finechargeperiodsdata'));
		}else{
			return view('admin.fine_charge_periods.index',compact('finechargeperiodsdata'));
		}
	}

	public function report(){
		$finechargeperiodsdata['company']=Companies::all();
		$finechargeperiodsdata['list']=FineChargePeriods::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargePeriods']])->get();
		$finechargeperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargeperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('finechargeperiodsdata'));
		}else{
			return view('admin.fine_charge_periods.report',compact('finechargeperiodsdata'));
		}
	}

	public function chart(){
		return view('admin.fine_charge_periods.chart');
	}

	public function store(Request $request){
		$finechargeperiods=new FineChargePeriods();
		$finechargeperiods->name=$request->get('name');
		$finechargeperiods->number_of_days=$request->get('number_of_days');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargePeriods']])->get();
		$finechargeperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargeperiodsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($finechargeperiods->save()){
					$response['status']='1';
					$response['message']='fine charge periods Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add fine charge periods. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add fine charge periods. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$finechargeperiodsdata['data']=FineChargePeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargePeriods']])->get();
		$finechargeperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargeperiodsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finechargeperiodsdata'));
		}else{
		return view('admin.fine_charge_periods.edit',compact('finechargeperiodsdata','id'));
		}
	}

	public function show($id){
		$finechargeperiodsdata['data']=FineChargePeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargePeriods']])->get();
		$finechargeperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargeperiodsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('finechargeperiodsdata'));
		}else{
		return view('admin.fine_charge_periods.show',compact('finechargeperiodsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$finechargeperiods=FineChargePeriods::find($id);
		$finechargeperiods->name=$request->get('name');
		$finechargeperiods->number_of_days=$request->get('number_of_days');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargePeriods']])->get();
		$finechargeperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargeperiodsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('finechargeperiodsdata'));
		}else{
		$finechargeperiods->save();
		$finechargeperiodsdata['data']=FineChargePeriods::find($id);
		return view('admin.fine_charge_periods.edit',compact('finechargeperiodsdata','id'));
		}
	}

	public function destroy($id){
		$finechargeperiods=FineChargePeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FineChargePeriods']])->get();
		$finechargeperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($finechargeperiodsdata['usersaccountsroles'][0]['_delete']==1){
			$finechargeperiods->delete();
		}return redirect('admin/finechargeperiods')->with('success','fine charge periods has been deleted!');
	}
}