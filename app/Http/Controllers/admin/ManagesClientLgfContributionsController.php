<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ManagesClientLgfContributions;
use App\Companies;
use App\Modules;
use App\Users;
use App\Clients;
use App\PaymentModes;
use App\TransactionStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ManagesClientLgfContributionsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$managesclientlgfcontributionsdata['clients']=Clients::all();
		$managesclientlgfcontributionsdata['paymentmodes']=PaymentModes::all();
		$managesclientlgfcontributionsdata['transactionstatuses']=TransactionStatuses::all();
		$managesclientlgfcontributionsdata['list']=ManagesClientLgfContributions::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesClientLgfContributions']])->get();
		$managesclientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesclientlgfcontributionsdata['usersaccountsroles'][0]['_add']==0&&$managesclientlgfcontributionsdata['usersaccountsroles'][0]['_list']==0&&$managesclientlgfcontributionsdata['usersaccountsroles'][0]['_edit']==0&&$managesclientlgfcontributionsdata['usersaccountsroles'][0]['_edit']==0&&$managesclientlgfcontributionsdata['usersaccountsroles'][0]['_show']==0&&$managesclientlgfcontributionsdata['usersaccountsroles'][0]['_delete']==0&&$managesclientlgfcontributionsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('managesclientlgfcontributionsdata'));
		}else{
			return view('admin.manages_client_lgf_contributions.index',compact('managesclientlgfcontributionsdata'));
		}
	}

	public function create(){
		$managesclientlgfcontributionsdata;
		$managesclientlgfcontributionsdata['clients']=Clients::all();
		$managesclientlgfcontributionsdata['paymentmodes']=PaymentModes::all();
		$managesclientlgfcontributionsdata['transactionstatuses']=TransactionStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesClientLgfContributions']])->get();
		$managesclientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesclientlgfcontributionsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('managesclientlgfcontributionsdata'));
		}else{
			return view('admin.manages_client_lgf_contributions.create',compact('managesclientlgfcontributionsdata'));
		}
	}

	public function filter(Request $request){
		$managesclientlgfcontributionsdata['clients']=Clients::all();
		$managesclientlgfcontributionsdata['paymentmodes']=PaymentModes::all();
		$managesclientlgfcontributionsdata['transactionstatuses']=TransactionStatuses::all();
		$managesclientlgfcontributionsdata['list']=ManagesClientLgfContributions::where([['client','LIKE','%'.$request->get('client').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['transaction_number','LIKE','%'.$request->get('transaction_number').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['transaction_status','LIKE','%'.$request->get('transaction_status').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesClientLgfContributions']])->get();
		$managesclientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesclientlgfcontributionsdata['usersaccountsroles'][0]['_add']==0&&$managesclientlgfcontributionsdata['usersaccountsroles'][0]['_list']==0&&$managesclientlgfcontributionsdata['usersaccountsroles'][0]['_edit']==0&&$managesclientlgfcontributionsdata['usersaccountsroles'][0]['_edit']==0&&$managesclientlgfcontributionsdata['usersaccountsroles'][0]['_show']==0&&$managesclientlgfcontributionsdata['usersaccountsroles'][0]['_delete']==0&&$managesclientlgfcontributionsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('managesclientlgfcontributionsdata'));
		}else{
			return view('admin.manages_client_lgf_contributions.index',compact('managesclientlgfcontributionsdata'));
		}
	}

	public function report(){
		$managesclientlgfcontributionsdata['company']=Companies::all();
		$managesclientlgfcontributionsdata['list']=ManagesClientLgfContributions::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesClientLgfContributions']])->get();
		$managesclientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesclientlgfcontributionsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('managesclientlgfcontributionsdata'));
		}else{
			return view('admin.manages_client_lgf_contributions.report',compact('managesclientlgfcontributionsdata'));
		}
	}

	public function chart(){
		return view('admin.manages_client_lgf_contributions.chart');
	}

	public function store(Request $request){
		$managesclientlgfcontributions=new ManagesClientLgfContributions();
		$managesclientlgfcontributions->client=$request->get('client');
		$managesclientlgfcontributions->payment_mode=$request->get('payment_mode');
		$managesclientlgfcontributions->transaction_number=$request->get('transaction_number');
		$managesclientlgfcontributions->date=$request->get('date');
		$managesclientlgfcontributions->amount=$request->get('amount');
		$managesclientlgfcontributions->transaction_status=$request->get('transaction_status');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesClientLgfContributions']])->get();
		$managesclientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesclientlgfcontributionsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($managesclientlgfcontributions->save()){
					$response['status']='1';
					$response['message']='manages client lgf contributions Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add manages client lgf contributions. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add manages client lgf contributions. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$managesclientlgfcontributionsdata['clients']=Clients::all();
		$managesclientlgfcontributionsdata['paymentmodes']=PaymentModes::all();
		$managesclientlgfcontributionsdata['transactionstatuses']=TransactionStatuses::all();
		$managesclientlgfcontributionsdata['data']=ManagesClientLgfContributions::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesClientLgfContributions']])->get();
		$managesclientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesclientlgfcontributionsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('managesclientlgfcontributionsdata'));
		}else{
		return view('admin.manages_client_lgf_contributions.edit',compact('managesclientlgfcontributionsdata','id'));
		}
	}

	public function show($id){
		$managesclientlgfcontributionsdata['clients']=Clients::all();
		$managesclientlgfcontributionsdata['paymentmodes']=PaymentModes::all();
		$managesclientlgfcontributionsdata['transactionstatuses']=TransactionStatuses::all();
		$managesclientlgfcontributionsdata['data']=ManagesClientLgfContributions::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesClientLgfContributions']])->get();
		$managesclientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesclientlgfcontributionsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('managesclientlgfcontributionsdata'));
		}else{
		return view('admin.manages_client_lgf_contributions.show',compact('managesclientlgfcontributionsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$managesclientlgfcontributions=ManagesClientLgfContributions::find($id);
		$managesclientlgfcontributions->client=$request->get('client');
		$managesclientlgfcontributions->payment_mode=$request->get('payment_mode');
		$managesclientlgfcontributions->transaction_number=$request->get('transaction_number');
		$managesclientlgfcontributions->date=$request->get('date');
		$managesclientlgfcontributions->amount=$request->get('amount');
		$managesclientlgfcontributions->transaction_status=$request->get('transaction_status');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesClientLgfContributions']])->get();
		$managesclientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesclientlgfcontributionsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('managesclientlgfcontributionsdata'));
		}else{
		$managesclientlgfcontributions->save();
		$managesclientlgfcontributionsdata['data']=ManagesClientLgfContributions::find($id);
		return view('admin.manages_client_lgf_contributions.edit',compact('managesclientlgfcontributionsdata','id'));
		}
	}

	public function destroy($id){
		$managesclientlgfcontributions=ManagesClientLgfContributions::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ManagesClientLgfContributions']])->get();
		$managesclientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($managesclientlgfcontributionsdata['usersaccountsroles'][0]['_delete']==1){
			$managesclientlgfcontributions->delete();
		}return redirect('admin/managesclientlgfcontributions')->with('success','manages client lgf contributions has been deleted!');
	}
}