<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (managers interest rate periods data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\InterestRatePeriods;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class InterestRatePeriodsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$interestrateperiodsdata['list']=InterestRatePeriods::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRatePeriods']])->get();
		$interestrateperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestrateperiodsdata['usersaccountsroles'][0]['_add']==0&&$interestrateperiodsdata['usersaccountsroles'][0]['_list']==0&&$interestrateperiodsdata['usersaccountsroles'][0]['_edit']==0&&$interestrateperiodsdata['usersaccountsroles'][0]['_edit']==0&&$interestrateperiodsdata['usersaccountsroles'][0]['_show']==0&&$interestrateperiodsdata['usersaccountsroles'][0]['_delete']==0&&$interestrateperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('interestrateperiodsdata'));
		}else{
			return view('admin.interest_rate_periods.index',compact('interestrateperiodsdata'));
		}
	}

	public function create(){
		$interestrateperiodsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRatePeriods']])->get();
		$interestrateperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestrateperiodsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('interestrateperiodsdata'));
		}else{
			return view('admin.interest_rate_periods.create',compact('interestrateperiodsdata'));
		}
	}

	public function filter(Request $request){
		$interestrateperiodsdata['list']=InterestRatePeriods::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['number_of_days','LIKE','%'.$request->get('number_of_days').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRatePeriods']])->get();
		$interestrateperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestrateperiodsdata['usersaccountsroles'][0]['_add']==0&&$interestrateperiodsdata['usersaccountsroles'][0]['_list']==0&&$interestrateperiodsdata['usersaccountsroles'][0]['_edit']==0&&$interestrateperiodsdata['usersaccountsroles'][0]['_edit']==0&&$interestrateperiodsdata['usersaccountsroles'][0]['_show']==0&&$interestrateperiodsdata['usersaccountsroles'][0]['_delete']==0&&$interestrateperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('interestrateperiodsdata'));
		}else{
			return view('admin.interest_rate_periods.index',compact('interestrateperiodsdata'));
		}
	}

	public function report(){
		$interestrateperiodsdata['company']=Companies::all();
		$interestrateperiodsdata['list']=InterestRatePeriods::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRatePeriods']])->get();
		$interestrateperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestrateperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('interestrateperiodsdata'));
		}else{
			return view('admin.interest_rate_periods.report',compact('interestrateperiodsdata'));
		}
	}

	public function chart(){
		return view('admin.interest_rate_periods.chart');
	}

	public function store(Request $request){
		$interestrateperiods=new InterestRatePeriods();
		$interestrateperiods->code=$request->get('code');
		$interestrateperiods->name=$request->get('name');
		$interestrateperiods->number_of_days=$request->get('number_of_days');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRatePeriods']])->get();
		$interestrateperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestrateperiodsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($interestrateperiods->save()){
					$response['status']='1';
					$response['message']='interest rate periods Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add interest rate periods. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add interest rate periods. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$interestrateperiodsdata['data']=InterestRatePeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRatePeriods']])->get();
		$interestrateperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestrateperiodsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('interestrateperiodsdata'));
		}else{
		return view('admin.interest_rate_periods.edit',compact('interestrateperiodsdata','id'));
		}
	}

	public function show($id){
		$interestrateperiodsdata['data']=InterestRatePeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRatePeriods']])->get();
		$interestrateperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestrateperiodsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('interestrateperiodsdata'));
		}else{
		return view('admin.interest_rate_periods.show',compact('interestrateperiodsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$interestrateperiods=InterestRatePeriods::find($id);
		$interestrateperiods->code=$request->get('code');
		$interestrateperiods->name=$request->get('name');
		$interestrateperiods->number_of_days=$request->get('number_of_days');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRatePeriods']])->get();
		$interestrateperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestrateperiodsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('interestrateperiodsdata'));
		}else{
		$interestrateperiods->save();
		$interestrateperiodsdata['data']=InterestRatePeriods::find($id);
		return view('admin.interest_rate_periods.edit',compact('interestrateperiodsdata','id'));
		}
	}

	public function destroy($id){
		$interestrateperiods=InterestRatePeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRatePeriods']])->get();
		$interestrateperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestrateperiodsdata['usersaccountsroles'][0]['_delete']==1){
			$interestrateperiods->delete();
		}return redirect('admin/interestrateperiods')->with('success','interest rate periods has been deleted!');
	}
}