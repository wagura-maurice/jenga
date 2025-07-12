<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClientLgfContributions;
use App\Companies;
use App\Modules;
use App\Users;
use App\Clients;
use App\PaymentModes;
use App\TransactionStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
use Illuminate\Support\Facades\DB;
use App\ClientLgfBalances;
use App\ClientCategories;
use App\LgfContributionConfigurations;
use App\GeneralLedgers;
use App\EntryTypes;
class ClientLgfContributionsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$clientCategory=ClientCategories::where([['code','=','002']])->get();
		$clientlgfcontributionsdata['clients']=Clients::where([['client_category','=',$clientCategory[0]['id']]])->get();
		$clientlgfcontributionsdata['paymentmodes']=PaymentModes::all();
		$clientlgfcontributionsdata['transactionstatuses']=TransactionStatuses::all();
		$clientlgfcontributionsdata['list']=ClientLgfContributions::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfContributions']])->get();
		$clientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfcontributionsdata['usersaccountsroles'][0]['_add']==0&&$clientlgfcontributionsdata['usersaccountsroles'][0]['_list']==0&&$clientlgfcontributionsdata['usersaccountsroles'][0]['_edit']==0&&$clientlgfcontributionsdata['usersaccountsroles'][0]['_edit']==0&&$clientlgfcontributionsdata['usersaccountsroles'][0]['_show']==0&&$clientlgfcontributionsdata['usersaccountsroles'][0]['_delete']==0&&$clientlgfcontributionsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientlgfcontributionsdata'));
		}else{
			return view('admin.client_lgf_contributions.index',compact('clientlgfcontributionsdata'));
		}
	}

	public function create(){
		$clientlgfcontributionsdata;
		$clientCategory=ClientCategories::where([['code','=','002']])->get();
		$clientlgfcontributionsdata['clients']=Clients::where([['client_category','=',$clientCategory[0]['id']]])->get();
		$clientlgfcontributionsdata['paymentmodes']=PaymentModes::all();
		$clientlgfcontributionsdata['transactionstatuses']=TransactionStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfContributions']])->get();
		$clientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfcontributionsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clientlgfcontributionsdata'));
		}else{
			return view('admin.client_lgf_contributions.create',compact('clientlgfcontributionsdata'));
		}
	}

	public function filter(Request $request){
		$clientCategory=ClientCategories::where([['code','=','002']])->get();
		$clientlgfcontributionsdata['clients']=Clients::where([['client_category','=',$clientCategory[0]['id']]])->get();

		$clientlgfcontributionsdata['paymentmodes']=PaymentModes::all();
		$clientlgfcontributionsdata['transactionstatuses']=TransactionStatuses::all();
		$clientlgfcontributionsdata['list']=ClientLgfContributions::where([['client','LIKE','%'.$request->get('client').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['transaction_number','LIKE','%'.$request->get('transaction_number').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['transaction_status','LIKE','%'.$request->get('transaction_status').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfContributions']])->get();
		$clientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfcontributionsdata['usersaccountsroles'][0]['_add']==0&&$clientlgfcontributionsdata['usersaccountsroles'][0]['_list']==0&&$clientlgfcontributionsdata['usersaccountsroles'][0]['_edit']==0&&$clientlgfcontributionsdata['usersaccountsroles'][0]['_edit']==0&&$clientlgfcontributionsdata['usersaccountsroles'][0]['_show']==0&&$clientlgfcontributionsdata['usersaccountsroles'][0]['_delete']==0&&$clientlgfcontributionsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientlgfcontributionsdata'));
		}else{
			return view('admin.client_lgf_contributions.index',compact('clientlgfcontributionsdata'));
		}
	}

	public function report(){
		$clientlgfcontributionsdata['company']=Companies::all();
		$clientlgfcontributionsdata['list']=ClientLgfContributions::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfContributions']])->get();
		$clientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfcontributionsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientlgfcontributionsdata'));
		}else{
			return view('admin.client_lgf_contributions.report',compact('clientlgfcontributionsdata'));
		}
	}

	public function chart(){
		return view('admin.client_lgf_contributions.chart');
	}

	public function store(Request $request){
		$clientlgfcontributions=new ClientLgfContributions();
		$clientlgfcontributions->client=$request->get('client');
		$clientlgfcontributions->payment_mode=$request->get('payment_mode');
		$clientlgfcontributions->transaction_number=$request->get('transaction_number');
		$clientlgfcontributions->date=$request->get('date');
		$clientlgfcontributions->amount=$request->get('amount');
		$transactionstatuses=TransactionStatuses::where([['code','=','002']])->get();
		$clientlgfcontributions->transaction_status=$transactionstatuses[0]['id'];
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfContributions']])->get();
		$clientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		//client lgf balance
		$clientlgfbalance=ClientLgfBalances::where([['client','=',$clientlgfcontributions->client]])->get();

		//lgf configuration
		$client=Clients::find($clientlgfcontributions->client);
		$lgfContributionConfiguration=LgfContributionConfigurations::where([['client_type','=',$client->client_type],['payment_mode','=',$clientlgfcontributions->payment_mode]])->get();


		$debit=EntryTypes::where([['code','=','001']])->get();
		$credit=EntryTypes::where([['code','=','002']])->get();


		if($clientlgfcontributionsdata['usersaccountsroles'][0]['_add']==1){
			return DB::transaction(function() use ($clientlgfcontributions,$clientlgfbalance,$lgfContributionConfiguration,$debit,$credit){
				try{
					if($clientlgfbalance!=null && $clientlgfbalance->count()>0){
						$clientlgfbalance=ClientLgfBalances::find($clientlgfbalance[0]['id']);
						$clientlgfbalance->balance=$clientlgfbalance->balance+$clientlgfcontributions->amount;
						$clientlgfbalance->save();

					}else{
						$clientlgfbalance=new ClientLgfBalances();
						$clientlgfbalance->client=$clientlgfcontributions->client;
						$clientlgfbalance->balance=$clientlgfcontributions->amount;
						$clientlgfbalance->save();
					}
					$generalLedger=new GeneralLedgers();
					$generalLedger->account=$lgfContributionConfiguration[0]['debit_account'];
					$generalLedger->entry_type=$debit[0]['id'];
					$generalLedger->transaction_number=$clientlgfcontributions->transaction_number;
					$generalLedger->amount=$clientlgfcontributions->amount;
					$generalLedger->date=$clientlgfcontributions->date;
					$generalLedger->save();


					$generalLedger=new GeneralLedgers();
					$generalLedger->account=$lgfContributionConfiguration[0]['credit_account'];
					$generalLedger->entry_type=$credit[0]['id'];
					$generalLedger->transaction_number=$clientlgfcontributions->transaction_number;
					$generalLedger->amount=$clientlgfcontributions->amount;
					$generalLedger->date=$clientlgfcontributions->date;
					$generalLedger->save();


					if($clientlgfcontributions->save()){
						$response['status']='1';
						$response['message']='client lgf contributions Added successfully';
						return json_encode($response);
					}else{
						$response['status']='0';
						$response['message']='Failed to add client lgf contributions. Please try again';
						return json_encode($response);
					}
				}
				catch(Exception $e){
						$response['status']='0';
						$response['message']='An Error occured while attempting to add client lgf contributions. Please try again';
						return json_encode($response);
				}
			});
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function dbimport(){

		$response=array();

		
			ini_set('max_execution_time', 600);
			return DB::transaction(function(){
				$query = DB::connection('mysql2')->select("select * from lgf_contribution");
				foreach ($query as $contribution) {
					$clientlgfcontributions=new ClientLgfContributions();
					$query1 = DB::connection('mysql2')->select("select client_number from client where client_id='".$contribution->client."'");
					$client=Clients::where([['client_number','=',$query1->client_number]])->get();
					$clientlgfcontributions->client=$client[0]['id'];
					$query2 = DB::connection('mysql2')->select("select code from payment_mode where payment_mode_id='".$contribution->payment_mode."'");
					$paymentmode=PaymentModes::where([['code','=',$query2->code]])->get();
					$clientlgfcontributions->payment_mode=$paymentmode[0]['id'];
					$clientlgfcontributions->transaction_number=$contribution->reference_number;
					$clientlgfcontributions->date='30/12/2017';
					$clientlgfcontributions->amount=$contribution->contribution_amount;

					$transactionstatuses=TransactionStatuses::where([['code','=','002']])->get();
					$clientlgfcontributions->transaction_status=$transactionstatuses[0]['id'];
					
					$response=array();
					$user=Users::where([['id','=',Auth::id()]])->get();
					$module=Modules::where([['name','=','ClientLgfContributions']])->get();
					$clientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
					//client lgf balance
					$clientlgfbalance=ClientLgfBalances::where([['client','=',$clientlgfcontributions->client]])->get();

					//lgf configuration
					$client=Clients::find($clientlgfcontributions->client);
					$lgfContributionConfiguration=LgfContributionConfigurations::where([['client_type','=',$client->client_type],['payment_mode','=',$clientlgfcontributions->payment_mode]])->get();


					$debit=EntryTypes::where([['code','=','001']])->get();
					$credit=EntryTypes::where([['code','=','002']])->get();

					try{
						if($clientlgfbalance!=null && $clientlgfbalance->count()>0){
							$clientlgfbalance=ClientLgfBalances::find($clientlgfbalance[0]['id']);
							$clientlgfbalance->balance=$clientlgfbalance->balance+$clientlgfcontributions->amount;
							$clientlgfbalance->save();

						}else{
							$clientlgfbalance=new ClientLgfBalances();
							$clientlgfbalance->client=$clientlgfcontributions->client;
							$clientlgfbalance->balance=$clientlgfcontributions->amount;
							$clientlgfbalance->save();
						}
						$generalLedger=new GeneralLedgers();
						$generalLedger->account=$lgfContributionConfiguration[0]['debit_account'];
						$generalLedger->entry_type=$debit[0]['id'];
						$generalLedger->transaction_number=$clientlgfcontributions->transaction_number;
						$generalLedger->amount=$clientlgfcontributions->amount;
						$generalLedger->date=$clientlgfcontributions->date;
						$generalLedger->save();


						$generalLedger=new GeneralLedgers();
						$generalLedger->account=$lgfContributionConfiguration[0]['credit_account'];
						$generalLedger->entry_type=$credit[0]['id'];
						$generalLedger->transaction_number=$clientlgfcontributions->transaction_number;
						$generalLedger->amount=$clientlgfcontributions->amount;
						$generalLedger->date=$clientlgfcontributions->date;
						$generalLedger->save();


						if($clientlgfcontributions->save()){
							$response['status']='1';
							$response['message']='client lgf contributions Added successfully';
							return json_encode($response);
						}else{
							$response['status']='0';
							$response['message']='Failed to add client lgf contributions. Please try again';
							return json_encode($response);
						}
					}
					catch(Exception $e){
							$response['status']='0';
							$response['message']='An Error occured while attempting to add client lgf contributions. Please try again';
							return json_encode($response);
					}
					
				}
			});
		
	}

	public function edit($id){
		$clientlgfcontributionsdata['clients']=Clients::all();
		$clientlgfcontributionsdata['paymentmodes']=PaymentModes::all();
		$clientlgfcontributionsdata['transactionstatuses']=TransactionStatuses::all();
		$clientlgfcontributionsdata['data']=ClientLgfContributions::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfContributions']])->get();
		$clientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfcontributionsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientlgfcontributionsdata'));
		}else{
		return view('admin.client_lgf_contributions.edit',compact('clientlgfcontributionsdata','id'));
		}
	}

	public function show($id){
		$clientlgfcontributionsdata['clients']=Clients::all();
		$clientlgfcontributionsdata['paymentmodes']=PaymentModes::all();
		$clientlgfcontributionsdata['transactionstatuses']=TransactionStatuses::all();
		$clientlgfcontributionsdata['data']=ClientLgfContributions::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfContributions']])->get();
		$clientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfcontributionsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clientlgfcontributionsdata'));
		}else{
		return view('admin.client_lgf_contributions.show',compact('clientlgfcontributionsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clientlgfcontributions=ClientLgfContributions::find($id);
		$clientlgfcontributions->client=$request->get('client');
		$clientlgfcontributions->payment_mode=$request->get('payment_mode');
		$clientlgfcontributions->transaction_number=$request->get('transaction_number');
		$clientlgfcontributions->date=$request->get('date');
		$clientlgfcontributions->amount=$request->get('amount');
		$clientlgfcontributions->transaction_status=$request->get('transaction_status');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientLgfContributions']])->get();
		$clientlgfcontributionsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientlgfcontributionsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientlgfcontributionsdata'));
		}else{
		$clientlgfcontributions->save();
		$clientlgfcontributionsdata['data']=ClientLgfContributions::find($id);
		return view('admin.client_lgf_contributions.edit',compact('clientlgfcontributionsdata','id'));
		}
	}

	public function destroy($id){
		$clientlgfcontributions=ClientLgfContributions::find($id);
		$transactionstatuses=TransactionStatuses::where([['code','=','002']])->get();
		DB::transaction(function() use($clientlgfcontributions){
			$transactionstatuses=TransactionStatuses::where([['code','=','003']])->get();
			$clientlgfcontributions->transaction_status=$transactionstatuses[0]['id'];
			$clientlgfcontributions->save();
			$client=Clients::find($clientlgfcontributions->client);
			$lgfContributionConfiguration=LgfContributionConfigurations::where([['client_type','=',$client->client_type],['payment_mode','=',$clientlgfcontributions->payment_mode]])->get();


			$debit=EntryTypes::where([['code','=','001']])->get();
			$credit=EntryTypes::where([['code','=','002']])->get();
			$clientlgfbalance=ClientLgfBalances::where([['client','=',$clientlgfcontributions->client]])->get();
			$clientlgfbalance=ClientLgfBalances::find($clientlgfbalance[0]['id']);
			$clientlgfbalance->balance=$clientlgfbalance->balance-$clientlgfcontributions->amount;
			$clientlgfbalance->save();			
			$date=date('m/d/Y');
			$generalLedger=new GeneralLedgers();
			$generalLedger->account=$lgfContributionConfiguration[0]['debit_account'];
			$generalLedger->entry_type=$credit[0]['id'];
			$generalLedger->transaction_number="Rejected ".$clientlgfcontributions->transaction_number;
			$generalLedger->amount=$clientlgfcontributions->amount;
			$generalLedger->date=$date;
			$generalLedger->save();


			$generalLedger=new GeneralLedgers();
			$generalLedger->account=$lgfContributionConfiguration[0]['credit_account'];
			$generalLedger->entry_type=$debit[0]['id'];
			$generalLedger->transaction_number="Rejected ".$clientlgfcontributions->transaction_number;
			$generalLedger->amount=$clientlgfcontributions->amount;
			$generalLedger->date=$date;
			$generalLedger->save();			
		});
		return redirect('admin/clientlgfcontributions')->with('success','client lgf contributions has been deleted!');
	}
}