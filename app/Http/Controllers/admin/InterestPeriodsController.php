<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (managers interest periods data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\InterestPeriods;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class InterestPeriodsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$interestperiodsdata['list']=InterestPeriods::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPeriods']])->get();
		$interestperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestperiodsdata['usersaccountsroles'][0]['_add']==0&&$interestperiodsdata['usersaccountsroles'][0]['_list']==0&&$interestperiodsdata['usersaccountsroles'][0]['_edit']==0&&$interestperiodsdata['usersaccountsroles'][0]['_edit']==0&&$interestperiodsdata['usersaccountsroles'][0]['_show']==0&&$interestperiodsdata['usersaccountsroles'][0]['_delete']==0&&$interestperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('interestperiodsdata'));
		}else{
			return view('admin.interest_periods.index',compact('interestperiodsdata'));
		}
	}

	public function create(){
		$interestperiodsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPeriods']])->get();
		$interestperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestperiodsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('interestperiodsdata'));
		}else{
			return view('admin.interest_periods.create',compact('interestperiodsdata'));
		}
	}

	public function filter(Request $request){
		$interestperiodsdata['list']=InterestPeriods::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['number_of_days','LIKE','%'.$request->get('number_of_days').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPeriods']])->get();
		$interestperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestperiodsdata['usersaccountsroles'][0]['_add']==0&&$interestperiodsdata['usersaccountsroles'][0]['_list']==0&&$interestperiodsdata['usersaccountsroles'][0]['_edit']==0&&$interestperiodsdata['usersaccountsroles'][0]['_edit']==0&&$interestperiodsdata['usersaccountsroles'][0]['_show']==0&&$interestperiodsdata['usersaccountsroles'][0]['_delete']==0&&$interestperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('interestperiodsdata'));
		}else{
			return view('admin.interest_periods.index',compact('interestperiodsdata'));
		}
	}

	public function report(){
		$interestperiodsdata['company']=Companies::all();
		$interestperiodsdata['list']=InterestPeriods::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPeriods']])->get();
		$interestperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestperiodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('interestperiodsdata'));
		}else{
			return view('admin.interest_periods.report',compact('interestperiodsdata'));
		}
	}

	public function chart(){
		return view('admin.interest_periods.chart');
	}

	public function store(Request $request){
		$interestperiods=new InterestPeriods();
		$interestperiods->code=$request->get('code');
		$interestperiods->name=$request->get('name');
		$interestperiods->number_of_days=$request->get('number_of_days');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPeriods']])->get();
		$interestperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestperiodsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($interestperiods->save()){
					$response['status']='1';
					$response['message']='interest periods Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add interest periods. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add interest periods. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$interestperiodsdata['data']=InterestPeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPeriods']])->get();
		$interestperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestperiodsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('interestperiodsdata'));
		}else{
		return view('admin.interest_periods.edit',compact('interestperiodsdata','id'));
		}
	}

	public function show($id){
		$interestperiodsdata['data']=InterestPeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPeriods']])->get();
		$interestperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestperiodsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('interestperiodsdata'));
		}else{
		return view('admin.interest_periods.show',compact('interestperiodsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$interestperiods=InterestPeriods::find($id);
		$interestperiods->code=$request->get('code');
		$interestperiods->name=$request->get('name');
		$interestperiods->number_of_days=$request->get('number_of_days');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPeriods']])->get();
		$interestperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestperiodsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('interestperiodsdata'));
		}else{
		$interestperiods->save();
		$interestperiodsdata['data']=InterestPeriods::find($id);
		return view('admin.interest_periods.edit',compact('interestperiodsdata','id'));
		}
	}

	public function destroy($id){
		$interestperiods=InterestPeriods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPeriods']])->get();
		$interestperiodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestperiodsdata['usersaccountsroles'][0]['_delete']==1){
			$interestperiods->delete();
		}return redirect('admin/interestperiods')->with('success','interest periods has been deleted!');
	}
}