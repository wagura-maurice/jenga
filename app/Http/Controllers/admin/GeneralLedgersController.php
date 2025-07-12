<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\GeneralLedgers;
use App\Companies;
use App\Modules;
use App\Users;
use App\Accounts;
use App\EntryTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class GeneralLedgersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(Request $request) {
		$generalledgersdata['accounts']=Accounts::all();
		$generalledgersdata['entrytypes']=EntryTypes::all();
		$generalledgersdata['list']=GeneralLedgers::paginate(100);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$generalledgersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();

		if($generalledgersdata['usersaccountsroles'][0]['_add']==0&&$generalledgersdata['usersaccountsroles'][0]['_list']==0&&$generalledgersdata['usersaccountsroles'][0]['_edit']==0&&$generalledgersdata['usersaccountsroles'][0]['_edit']==0&&$generalledgersdata['usersaccountsroles'][0]['_show']==0&&$generalledgersdata['usersaccountsroles'][0]['_delete']==0&&$generalledgersdata['usersaccountsroles'][0]['_report']==0) {

			if ($request->ajax()) {
	            return \Response::json(View('admin.general_ledgers.presult', compact('generalledgersdata'))->render());
	        } else {
	        	 return View('admin.error.denied', compact('generalledgersdata'));
	        }
		} else {
			if ($request->ajax()) {
	            return \Response::json(View('admin.general_ledgers.presult', compact('generalledgersdata'))->render());
	        } else {
	        	return View('admin.general_ledgers.index', compact('generalledgersdata'));
	        }
		}
	}

	public function create(){
		$generalledgersdata;
		$generalledgersdata['accounts']=Accounts::all();
		$generalledgersdata['entrytypes']=EntryTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$generalledgersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($generalledgersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('generalledgersdata'));
		}else{
			return view('admin.general_ledgers.create',compact('generalledgersdata'));
		}
	}

	public function filter(Request $request){
		$generalledgersdata['accounts']=Accounts::all();
		$generalledgersdata['entrytypes']=EntryTypes::all();
		$generalledgersdata['list']=GeneralLedgers::where([['account','LIKE','%'.$request->get('account').'%'],['entry_type','LIKE','%'.$request->get('entry_type').'%'],['transaction_number','LIKE','%'.$request->get('transaction_number').'%'],['amount','LIKE','%'.$request->get('amount').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$generalledgersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($generalledgersdata['usersaccountsroles'][0]['_add']==0&&$generalledgersdata['usersaccountsroles'][0]['_list']==0&&$generalledgersdata['usersaccountsroles'][0]['_edit']==0&&$generalledgersdata['usersaccountsroles'][0]['_edit']==0&&$generalledgersdata['usersaccountsroles'][0]['_show']==0&&$generalledgersdata['usersaccountsroles'][0]['_delete']==0&&$generalledgersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('generalledgersdata'));
		}else{
			return view('admin.general_ledgers.index',compact('generalledgersdata'));
		}
	}

	public function report(){
		$generalledgersdata['company']=Companies::all();
		$generalledgersdata['list']=GeneralLedgers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$generalledgersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($generalledgersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('generalledgersdata'));
		}else{
			return view('admin.general_ledgers.report',compact('generalledgersdata'));
		}
	}

	public function chart(){
		return view('admin.general_ledgers.chart');
	}

	public function store(Request $request){
		$generalledgers=new GeneralLedgers();
		$generalledgers->account=$request->get('account');
		$generalledgers->entry_type=$request->get('entry_type');
		$generalledgers->transaction_number=$request->get('transaction_number');
		$generalledgers->amount=$request->get('amount');
		$generalledgers->date=$request->get('date');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$generalledgersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($generalledgersdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($generalledgers->save()){
					$response['status']='1';
					$response['message']='general ledgers Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add general ledgers. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add general ledgers. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$generalledgersdata['accounts']=Accounts::all();
		$generalledgersdata['entrytypes']=EntryTypes::all();
		$generalledgersdata['data']=GeneralLedgers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$generalledgersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($generalledgersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('generalledgersdata'));
		}else{
		return view('admin.general_ledgers.edit',compact('generalledgersdata','id'));
		}
	}

	public function show($id){
		$generalledgersdata['accounts']=Accounts::all();
		$generalledgersdata['entrytypes']=EntryTypes::all();
		$generalledgersdata['data']=GeneralLedgers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$generalledgersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($generalledgersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('generalledgersdata'));
		}else{
		return view('admin.general_ledgers.show',compact('generalledgersdata','id'));
		}
	}

	public function update(Request $request,$id){
		$generalledgers=GeneralLedgers::find($id);
		$generalledgers->account=$request->get('account');
		$generalledgers->entry_type=$request->get('entry_type');
		$generalledgers->transaction_number=$request->get('transaction_number');
		$generalledgers->amount=$request->get('amount');
		$generalledgers->date=$request->get('date');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$generalledgersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($generalledgersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('generalledgersdata'));
		}else{
		$generalledgers->save();
		$generalledgersdata['data']=GeneralLedgers::find($id);
		return view('admin.general_ledgers.edit',compact('generalledgersdata','id'));
		}
	}

	public function destroy($id){
		$generalledgers=GeneralLedgers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$generalledgersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($generalledgersdata['usersaccountsroles'][0]['_delete']==1){
			$generalledgers->delete();
		}return redirect('admin/generalledgers')->with('success','general ledgers has been deleted!');
	}
}