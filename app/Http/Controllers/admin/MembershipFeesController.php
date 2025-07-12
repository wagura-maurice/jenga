<?php
namespace App\Http\Controllers\admin;
use App\Users;
use App\Groups;
use App\Clients;
use App\Modules;
use App\Companies;
use Carbon\Carbon;
use App\EntryTypes;
use App\PaymentModes;
use App\Http\Requests;
use App\GeneralLedgers;
use App\GroupCashBooks;
use App\MembershipFees;

use App\ClientCategories;
use App\UsersAccountsRoles;
use App\TransactionStatuses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\MembershipFeeConfigurations;
use Illuminate\Support\Facades\Auth;

class MembershipFeesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$clientCategory=ClientCategories::where([['code','=','001']])->get();
		$membershipfeesdata['clients']=Clients::where([['client_category','=',$clientCategory[0]['id']]])->get();
		$membershipfeesdata['paymentmodes']=PaymentModes::all();
		$membershipfeesdata['transactionstatuses']=TransactionStatuses::all();
		$membershipfeesdata['list']=MembershipFees::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFees']])->get();
		$membershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeesdata['usersaccountsroles'][0]['_add']==0&&$membershipfeesdata['usersaccountsroles'][0]['_list']==0&&$membershipfeesdata['usersaccountsroles'][0]['_edit']==0&&$membershipfeesdata['usersaccountsroles'][0]['_edit']==0&&$membershipfeesdata['usersaccountsroles'][0]['_show']==0&&$membershipfeesdata['usersaccountsroles'][0]['_delete']==0&&$membershipfeesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('membershipfeesdata'));
		}else{
			return view('admin.membership_fees.index',compact('membershipfeesdata'));
		}
	}

	public function create(){
		$membershipfeesdata;
		$clientCategory=ClientCategories::where([['code','=','001']])->get();
		$exited=ClientCategories::where([['code','=','006']])->get();
		$membershipfeesdata['clients']=Clients::where([['membership_fees_paid','=','0']])->orWhere([['client_category','=',$clientCategory[0]['id']]])->orWhere([['client_category','=',$exited[0]['id']]])->get();
		$membershipfeesdata['paymentmodes']=PaymentModes::all();
		$membershipfeesdata['transactionstatuses']=TransactionStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFees']])->get();
		$membershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('membershipfeesdata'));
		}else{
			return view('admin.membership_fees.create',compact('membershipfeesdata'));
		}
	}

	public function filter(Request $request){
		$clientCategory=ClientCategories::where([['code','=','001']])->get();
		$membershipfeesdata['clients']=Clients::where([['client_category','=',$clientCategory[0]['id']]])->get();
		$membershipfeesdata['paymentmodes']=PaymentModes::all();
		$membershipfeesdata['transactionstatuses']=TransactionStatuses::all();
		$membershipfeesdata['list']=MembershipFees::where([['client','LIKE','%'.$request->get('client').'%'],['payment_mode','LIKE','%'.$request->get('payment_mode').'%'],['transaction_number','LIKE','%'.$request->get('transaction_number').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['transaction_status','LIKE','%'.$request->get('transaction_status').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFees']])->get();
		$membershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeesdata['usersaccountsroles'][0]['_add']==0&&$membershipfeesdata['usersaccountsroles'][0]['_list']==0&&$membershipfeesdata['usersaccountsroles'][0]['_edit']==0&&$membershipfeesdata['usersaccountsroles'][0]['_edit']==0&&$membershipfeesdata['usersaccountsroles'][0]['_show']==0&&$membershipfeesdata['usersaccountsroles'][0]['_delete']==0&&$membershipfeesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('membershipfeesdata'));
		}else{
			return view('admin.membership_fees.index',compact('membershipfeesdata'));
		}
	}

	public function report(){
		$membershipfeesdata['company']=Companies::all();
		$membershipfeesdata['list']=MembershipFees::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFees']])->get();
		$membershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('membershipfeesdata'));
		}else{
			return view('admin.membership_fees.report',compact('membershipfeesdata'));
		}
	}

	public function chart(){
		return view('admin.membership_fees.chart');
	}

	public function store(Request $request){
		$membershipfees=new MembershipFees();
		$membershipfees->client=$request->get('client');
		$membershipfees->payment_mode=$request->get('payment_mode');
		$membershipfees->transaction_number=$request->get('transaction_number');
		$membershipfees->date=$request->get('date');
		$membershipfees->amount=$request->get('amount');
		$transactionstatuses=TransactionStatuses::where([['code','=','002']])->get();
		$membershipfees->transaction_status=$transactionstatuses[0]['id'];
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFees']])->get();
		$membershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		$client=Clients::find($membershipfees->client);
		$clientCategory=ClientCategories::where([['code','=','002']])->get();

		//configuration
		$membershipFeeConfiguration=MembershipFeeConfigurations::where([['client_type','=',$client->client_type],['payment_mode','=',$membershipfees->payment_mode]])->get();
		$debit=EntryTypes::where([['code','=','001']])->get();
		$credit=EntryTypes::where([['code','=','002']])->get();

		if($membershipfeesdata['usersaccountsroles'][0]['_add']==1){
			
				return DB::transaction(function() use ($membershipfees,$client,$clientCategory,$membershipFeeConfiguration,$debit,$credit, $request){


					try{

						$membershipfees->save();
						
						$generalLedger=new GeneralLedgers();
						$generalLedger->account=$membershipFeeConfiguration[0]['debit_account'];
						$generalLedger->entry_type=$debit[0]['id'];
						$generalLedger->transaction_number=$membershipfees->transaction_number;
						$generalLedger->amount=$membershipfees->amount;
						$generalLedger->date=$membershipfees->date;
						$generalLedger->save();


						$generalLedger=new GeneralLedgers();
						$generalLedger->account=$membershipFeeConfiguration[0]['credit_account'];
						$generalLedger->entry_type=$credit[0]['id'];
						$generalLedger->transaction_number=$membershipfees->transaction_number;
						$generalLedger->amount=$membershipfees->amount;
						$generalLedger->date=$membershipfees->date;
						$generalLedger->save();

						$client->membership_fees_paid='1';
						$client->save();

						$groupcashbooks= new GroupCashBooks();
						$groupcashbooks->officer_id = $client->officermodel->id;
						$groupcashbooks->branch_id = $client->branchmodel->id;
						$groupcashbooks->transaction_id = $request->get('transaction_number');
						$groupcashbooks->transacting_group = $client->group->client_group;
						$groupcashbooks->transaction_reference = $request->get('transaction_number');
						$groupcashbooks->transaction_type = 1;
						$groupcashbooks->amount = $request->get('amount');
						$groupcashbooks->collecting_officer = auth()->user()->name;
						$groupcashbooks->payment_mode = $request->get('payment_mode');
						$groupcashbooks->account = $membershipFeeConfiguration[0]['debit_account'];
						$groupcashbooks->transaction_date = Carbon::parse($request->get('date'))->toDateTimeString();
						$groupcashbooks->save();

						$groupcashbooks= new GroupCashBooks();
						$groupcashbooks->officer_id = $client->officermodel->id;
						$groupcashbooks->branch_id = $client->branchmodel->id;
						$groupcashbooks->transaction_id = $request->get('transaction_number');
						$groupcashbooks->transacting_group = $client->group->client_group;
						$groupcashbooks->transaction_reference = $request->get('transaction_number');
						$groupcashbooks->transaction_type = 2;
						$groupcashbooks->amount = $request->get('amount');
						$groupcashbooks->collecting_officer = auth()->user()->name;
						$groupcashbooks->payment_mode = $request->get('payment_mode');
						$groupcashbooks->account = $membershipFeeConfiguration[0]['credit_account'];
						$groupcashbooks->transaction_date = Carbon::parse($request->get('date'))->toDateTimeString();
						$groupcashbooks->save();
					
						$response['status']='1';
						$response['message']='membership fees Added successfully';
						return json_encode($response);

					}
					catch(Exception $e){
						$response['status']='0';
						$response['message']='An Error occured while attempting to add membership fees. Please try again';
						return json_encode($response);
					}
				});

		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$membershipfeesdata['clients']=Clients::all();
		$membershipfeesdata['paymentmodes']=PaymentModes::all();
		$membershipfeesdata['transactionstatuses']=TransactionStatuses::all();
		$membershipfeesdata['data']=MembershipFees::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFees']])->get();
		$membershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('membershipfeesdata'));
		}else{
		return view('admin.membership_fees.edit',compact('membershipfeesdata','id'));
		}
	}

	public function show($id){
		$membershipfeesdata['clients']=Clients::all();
		$membershipfeesdata['paymentmodes']=PaymentModes::all();
		$membershipfeesdata['transactionstatuses']=TransactionStatuses::all();
		$membershipfeesdata['data']=MembershipFees::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFees']])->get();
		$membershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('membershipfeesdata'));
		}else{
		return view('admin.membership_fees.show',compact('membershipfeesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$membershipfees=MembershipFees::find($id);
		$membershipfees->client=$request->get('client');
		$membershipfees->payment_mode=$request->get('payment_mode');
		$membershipfees->transaction_number=$request->get('transaction_number');
		$membershipfees->date=$request->get('date');
		$membershipfees->amount=$request->get('amount');
		$membershipfees->transaction_status=$request->get('transaction_status');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','MembershipFees']])->get();
		$membershipfeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($membershipfeesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('membershipfeesdata'));
		}else{
		$membershipfees->save();
		$membershipfeesdata['data']=MembershipFees::find($id);
		return view('admin.membership_fees.edit',compact('membershipfeesdata','id'));
		}
	}

	public function destroy($id){
		$membershipfees=MembershipFees::find($id);
		$date=date('d/m/Y');
		$transactionstatuses=TransactionStatuses::where([['code','=','002']])->get();
		if($transactionstatuses[0]['id']==$membershipfees->transaction_status){
				DB::transaction(function() use($membershipfees,$date){
				
				$transactionstatuses=TransactionStatuses::where([['code','=','003']])->get();
				$membershipfees->transaction_status=$transactionstatuses[0]['id'];
				$membershipfees->save();
				$clientCategory=ClientCategories::where([['code','=','001']])->get();
				$client=Clients::find($membershipfees->client);
				$client->client_category=$clientCategory[0]['id'];
				$client->save();

				$membershipFeeConfiguration=MembershipFeeConfigurations::where([['client_type','=',$client->client_type],['payment_mode','=',$membershipfees->payment_mode]])->get();

				$debit=EntryTypes::where([['code','=','001']])->get();
				$credit=EntryTypes::where([['code','=','002']])->get();

				$generalLedger=new GeneralLedgers();
				$generalLedger->account=$membershipFeeConfiguration[0]['debit_account'];
				$generalLedger->entry_type=$credit[0]['id'];
				$generalLedger->transaction_number="Rejected  ".$membershipfees->transaction_number;
				$generalLedger->amount=$membershipfees->amount;
				$generalLedger->date=$date;
				$generalLedger->save();


				$generalLedger=new GeneralLedgers();
				$generalLedger->account=$membershipFeeConfiguration[0]['credit_account'];
				$generalLedger->entry_type=$debit[0]['id'];
				$generalLedger->transaction_number="Rejected ".$membershipfees->transaction_number;
				$generalLedger->amount=$membershipfees->amount;
				$generalLedger->date=$date;
				$generalLedger->save();			
			});

		}
			
		return redirect('admin/membershipfees')->with('success','membership fees has been deleted!');
	}
}