<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\GeneralLedgers;
use App\Companies;
use App\Modules;
use App\Users;
use App\Accounts;
use App\EntryTypes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
use Illuminate\Support\Facades\DB;
use App\FinancialCategories;
class ProfitAndLossController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function page($pageIndex,$pageSize){
		$profitandlossdata['company']=Companies::all();
		$profitandlossdata['list']=GeneralLedgers::skip($pageIndex)->take($pageSize);
		$profitandlossdata['accounts']=Accounts::all();
		$profitandlossdata['pageIndex']=$pageIndex;
		$profitandlossdata['pageSize']=$pageSize;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$income=FinancialCategories::where([['code','=','7-00-000000-00']])->get();
		$incomeaccounts=Accounts::where([['financial_category','=',$income[0]['id']]])->get();
		$debit=EntryTypes::where([['code','=','001']])->get();	
		$profitandlossdata['income']=array();
		$profitandlossdata['grossprofit']=0;
		for($r=0;$r<count($incomeaccounts);$r++){
			$profitandlossdata['income'][$r]['account']=$incomeaccounts[$r]['code'].' '.$incomeaccounts[$r]['name'];
			$amount=GeneralLedgers::where([['account','=',$incomeaccounts[$r]['id']],['entry_type','=',$debit[0]['id']]])->sum('amount');
			$profitandlossdata['income'][$r]['amount']=$amount;
			$profitandlossdata['grossprofit']+=$amount;
		}
		$expense=FinancialCategories::where([['code','=','5-00-000000-00']])->get();
		$expenseaccounts=Accounts::where([['financial_category','=',$expense[0]['id']]])->get();
		$profitandlossdata['expense']=array();
		$profitandlossdata['totalexpense']=0;

		for($r=0;$r<count($expenseaccounts);$r++){
			$profitandlossdata['expense'][$r]['account']=$expenseaccounts[$r]['code'].' '.$expenseaccounts[$r]['name'];
			$amount=GeneralLedgers::where([['account','=',$expenseaccounts[$r]['id']],['entry_type','=',$debit[0]['id']]])->sum('amount');
			$profitandlossdata['expense'][$r]['amount']=$amount;
			$profitandlossdata['totalexpense']+=$amount;
		}
		$profitandlossdata['netprofit']=$profitandlossdata['grossprofit']-$profitandlossdata['totalexpense'];

		return view('admin.reports.profit_and_loss',compact('profitandlossdata'));
		
	}

	public function create(){
		$profitandlossdata;
		$profitandlossdata['accounts']=Accounts::all();
		$profitandlossdata['entrytypes']=EntryTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$profitandlossdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($profitandlossdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('profitandlossdata'));
		}else{
			return view('admin.general_ledgers.create',compact('profitandlossdata'));
		}
	}

	public function filter(Request $request){
		$profitandlossdata['accounts']=Accounts::all();
		$profitandlossdata['entrytypes']=EntryTypes::all();
		$profitandlossdata['list']=GeneralLedgers::where([['account','LIKE','%'.$request->get('account').'%'],['entry_type','LIKE','%'.$request->get('entry_type').'%'],['transaction_number','LIKE','%'.$request->get('transaction_number').'%'],['amount','LIKE','%'.$request->get('amount').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$profitandlossdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($profitandlossdata['usersaccountsroles'][0]['_add']==0&&$profitandlossdata['usersaccountsroles'][0]['_list']==0&&$profitandlossdata['usersaccountsroles'][0]['_edit']==0&&$profitandlossdata['usersaccountsroles'][0]['_edit']==0&&$profitandlossdata['usersaccountsroles'][0]['_show']==0&&$profitandlossdata['usersaccountsroles'][0]['_delete']==0&&$profitandlossdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('profitandlossdata'));
		}else{
			return view('admin.general_ledgers.index',compact('profitandlossdata'));
		}
	}

	public function report(){
		$profitandlossdata['company']=Companies::all();
		$profitandlossdata['list']=GeneralLedgers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$profitandlossdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($profitandlossdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('profitandlossdata'));
		}else{
			return view('admin.general_ledgers.report',compact('profitandlossdata'));
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
		$profitandlossdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($profitandlossdata['usersaccountsroles'][0]['_show']==1){
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
		$profitandlossdata['accounts']=Accounts::all();
		$profitandlossdata['entrytypes']=EntryTypes::all();
		$profitandlossdata['data']=GeneralLedgers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$profitandlossdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($profitandlossdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('profitandlossdata'));
		}else{
		return view('admin.general_ledgers.edit',compact('profitandlossdata','id'));
		}
	}

	public function show($id){
		$profitandlossdata['accounts']=Accounts::all();
		$profitandlossdata['entrytypes']=EntryTypes::all();
		$profitandlossdata['data']=GeneralLedgers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$profitandlossdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($profitandlossdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('profitandlossdata'));
		}else{
		return view('admin.general_ledgers.show',compact('profitandlossdata','id'));
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
		$profitandlossdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($profitandlossdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('profitandlossdata'));
		}else{
		$generalledgers->save();
		$profitandlossdata['data']=GeneralLedgers::find($id);
		return view('admin.general_ledgers.edit',compact('profitandlossdata','id'));
		}
	}

	public function destroy($id){
		$generalledgers=GeneralLedgers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','GeneralLedgers']])->get();
		$profitandlossdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($profitandlossdata['usersaccountsroles'][0]['_delete']==1){
			$generalledgers->delete();
		}return redirect('admin/generalledgers')->with('success','general ledgers has been deleted!');
	}
}