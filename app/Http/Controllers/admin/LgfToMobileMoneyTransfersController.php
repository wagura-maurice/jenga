<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (lgf to mobile money transfers)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LgfToMobileMoneyTransfers;
use App\Companies;
use App\EntryTypes;
use App\GeneralLedgers;
use App\Modules;
use App\Users;
use App\MobileMoneyTransferApprovalLevels;
use App\MobileMoneyTransferApprovals;
use App\ApprovalLevels;
use App\ClientLgfBalances;
use App\PaymentModes;
use App\GroupCashBooks;
use App\Clients;
use App\ApprovalStatuses;
use App\MobileMoneyTransactionChargeConfigurations;
use App\MobileMoneyTransferConfigurations;
use App\MobileMoneyModes;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LgfToMobileMoneyTransfersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$lgftomobilemoneytransfersdata['clients']=Clients::all();
		$lgftomobilemoneytransfersdata['users']=Users::all();
		$lgftomobilemoneytransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneytransfersdata['list']=LgfToMobileMoneyTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyTransfers']])->get();
		$lgftomobilemoneytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneytransfersdata['usersaccountsroles'][0]) && $lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_add']==0&&$lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_list']==0&&$lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_show']==0&&$lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_delete']==0&&$lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftomobilemoneytransfersdata'));
		}else{
			return view('admin.lgf_to_mobile_money_transfers.index',compact('lgftomobilemoneytransfersdata'));
		}
	}

	public function create(){
		$lgftomobilemoneytransfersdata;
		$lgftomobilemoneytransfersdata['clients']=Clients::all();
		$lgftomobilemoneytransfersdata['users']=Users::all();
		$lgftomobilemoneytransfersdata["mobilemoneymodes"]=MobileMoneyModes::all();
		$lgftomobilemoneytransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyTransfers']])->get();
		$lgftomobilemoneytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneytransfersdata['usersaccountsroles'][0]) && $lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('lgftomobilemoneytransfersdata'));
		}else{
			return view('admin.lgf_to_mobile_money_transfers.create',compact('lgftomobilemoneytransfersdata'));
		}
	}

	public function filter(Request $request){
		$lgftomobilemoneytransfersdata['clients']=Clients::all();
		$lgftomobilemoneytransfersdata['users']=Users::all();
		$lgftomobilemoneytransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneytransfersdata['list']=LgfToMobileMoneyTransfers::where([['transaction_number','LIKE','%'.$request->get('transaction_number').'%'],['client','LIKE','%'.$request->get('client').'%'],['to_other_number','LIKE','%'.$request->get('to_other_number').'%'],['other_phone_number','LIKE','%'.$request->get('other_phone_number').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['initiated_by','LIKE','%'.$request->get('initiated_by').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],])->orWhereBetween('transaction_date',[$request->get('transaction_datefrom'),$request->get('transaction_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyTransfers']])->get();
		$lgftomobilemoneytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneytransfersdata['usersaccountsroles'][0]) && $lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_add']==0&&$lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_list']==0&&$lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_show']==0&&$lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_delete']==0&&$lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftomobilemoneytransfersdata'));
		}else{
			return view('admin.lgf_to_mobile_money_transfers.index',compact('lgftomobilemoneytransfersdata'));
		}
	}

	public function report(){
		$lgftomobilemoneytransfersdata['company']=Companies::all();
		$lgftomobilemoneytransfersdata['list']=LgfToMobileMoneyTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyTransfers']])->get();
		$lgftomobilemoneytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneytransfersdata['usersaccountsroles'][0]) && $lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftomobilemoneytransfersdata'));
		}else{
			return view('admin.lgf_to_mobile_money_transfers.report',compact('lgftomobilemoneytransfersdata'));
		}
	}

	public function chart(){
		return view('admin.lgf_to_mobile_money_transfers.chart');
	}

	public function getlgftomobiletransactionnumber(){
		return LgfToMobileMoneyTransfers::all()->count()+1;
	}

	public function store(Request $request){
		$lgftomobilemoneytransfers=new LgfToMobileMoneyTransfers();
		$lgftomobilemoneytransfers->transaction_number=$request->get('transaction_number');
		$lgftomobilemoneytransfers->client=$request->get('client');
		$lgftomobilemoneytransfers->to_other_number=$request->get('to_other_number');
		$lgftomobilemoneytransfers->other_phone_number=$request->get('other_phone_number');
		$lgftomobilemoneytransfers->amount=$request->get('amount');
		$lgftomobilemoneytransfers->transaction_charges=$request->get('transaction_charges');
		$lgftomobilemoneytransfers->mobile_money_mode=$request->get('mobile_money_mode');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$lgftomobilemoneytransfers->initiated_by=$user[0]["id"];
		$lgftomobilemoneytransfers->transaction_date=\Carbon\Carbon::parse($request->transaction_date)->toDateString();
		$approvalstatuses=ApprovalStatuses::where([["code","=","003"]])->get()->first();
		$lgftomobilemoneytransfers->approval_status=$approvalstatuses->id;
		$response=array();

		$lgftomobilemoneytransfersdata["mobilemoneymodes"]=MobileMoneyModes::all();
		
		$module=Modules::where([['name','=','LgfToMobileMoneyTransfers']])->get();
		$lgftomobilemoneytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneytransfersdata['usersaccountsroles'][0]) && $lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($lgftomobilemoneytransfers->save()){
					$response['status']='1';
					$response['message']='lgf to mobile money transfers Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add lgf to mobile money transfers. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add lgf to mobile money transfers. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$lgftomobilemoneytransfersdata['clients']=Clients::all();
		$lgftomobilemoneytransfersdata['users']=Users::all();
		$lgftomobilemoneytransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneytransfersdata['data']=LgfToMobileMoneyTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();		
		$module=Modules::where([['name','=','LgfToMobileMoneyTransfers']])->get();

		$mymapping=MobileMoneyTransferApprovalLevels::where([["client_type","=",$lgftomobilemoneytransfersdata['data']->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();

		$lgftomobilemoneytransfersdata['mymapping']=$mymapping;

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$lgftomobilemoneytransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=MobileMoneyTransferApprovals::where([["mobile_money_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=MobileMoneyTransferApprovals::where([["mobile_money_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$lgftomobilemoneytransfersdata['myturn']="1";
					}else if(isset($lgftomobilemoneytransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$lgftomobilemoneytransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$lgftomobilemoneytransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$lgftomobilemoneytransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}

		$lgftomobilemoneytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneytransfersdata['usersaccountsroles'][0]) && $lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftomobilemoneytransfersdata'));
		}else{
		return view('admin.lgf_to_mobile_money_transfers.edit',compact('lgftomobilemoneytransfersdata','id'));
		}
	}

	public function show($id){
		$lgftomobilemoneytransfersdata['clients']=Clients::all();
		$lgftomobilemoneytransfersdata['users']=Users::all();
		$lgftomobilemoneytransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftomobilemoneytransfersdata['data']=LgfToMobileMoneyTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyTransfers']])->get();
		$lgftomobilemoneytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneytransfersdata['usersaccountsroles'][0]) && $lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('lgftomobilemoneytransfersdata'));
		}else{
		return view('admin.lgf_to_mobile_money_transfers.show',compact('lgftomobilemoneytransfersdata','id'));
		}
	}

	public function update(Request $request,$id){
		$lgftomobilemoneytransfers=LgfToMobileMoneyTransfers::find($id);
		$lgftomobilemoneytransfersdata['clients']=Clients::all();
		$lgftomobilemoneytransfersdata['users']=Users::all();
		$lgftomobilemoneytransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyTransfers']])->get();
		$lgftomobilemoneytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftomobilemoneytransfersdata'));
		}else{

		$mymapping=MobileMoneyTransferApprovalLevels::where([["client_type","=",$lgftomobilemoneytransfers->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();			

		if($lgftomobilemoneytransfers->approvalstatusmodel->code=="003"){
			DB::transaction(function() use($request,$user,$id,$mymapping,$lgftomobilemoneytransfers,$lgftomobilemoneytransfersdata){
				try{

					$mobilemoneytransferaproval=new MobileMoneyTransferApprovals();
					$mobilemoneytransferaproval->mobile_money_transfer=$id;
					$mobilemoneytransferaproval->approval_level=$mymapping->approval_level;
					$mobilemoneytransferaproval->approved_by=$user[0]->id;
					$mobilemoneytransferaproval->user_account=$user[0]->user_account;
					$mobilemoneytransferaproval->remarks=$request->get('remarks');
					$mobilemoneytransferaproval->approval_status=$request->get('approval_status');
					$mobilemoneytransferaproval->save();

					$mappings=MobileMoneyTransferApprovalLevels::where([["client_type","=",$lgftomobilemoneytransfers->clientmodel->client_type]])->get();

					$maxapprovallevel=0;

					for($r=0;$r<count($mappings);$r++){

						$maxapprovallevel=$mappings[$r]->approvallevelmodel->approval_level>$maxapprovallevel?$mappings[$r]->approvallevelmodel->approval_level:$maxapprovallevel;
					}

					$rejeted=ApprovalStatuses::where([["code","=","002"]])->get()->first();

					if($maxapprovallevel==$mymapping->approvallevelmodel->approval_level || $rejeted->id==$request->get('approval_status')){

						$lgftomobilemoneytransfers->approval_status=$request->get('approval_status');

						$lgftomobilemoneytransfers->save();

						$approved=ApprovalStatuses::where([["code","=","001"]])->get()->first();

						if($approved->id==$lgftomobilemoneytransfers->approval_status){
							
							$clientfromlgfbalance=ClientLgfBalances::where([["client","=",$lgftomobilemoneytransfers->client]])->get()->first();

							$clientfromlgfbalance->balance=$clientfromlgfbalance->balance-$lgftomobilemoneytransfers->amount-$lgftomobilemoneytransfers->transaction_charges;

							$clientfromlgfbalance->save();

							$mobilemoneytransferconfigurations=MobileMoneyTransferConfigurations::where([['client_type','=',$lgftomobilemoneytransfers->clientmodel->client_type],['mobile_money_mode','=',$lgftomobilemoneytransfers->mobile_money_mode]])->get();

							$debit=EntryTypes::where([['code','=','001']])->get();
							$credit=EntryTypes::where([['code','=','002']])->get();	

							$generalLedger=new GeneralLedgers();
							$generalLedger->account=$mobilemoneytransferconfigurations[0]['debit_account'];
							$generalLedger->entry_type=$debit[0]['id'];
							$generalLedger->transaction_number=$lgftomobilemoneytransfers->transaction_number;
							$generalLedger->loan=$lgftomobilemoneytransfers->client;
							$generalLedger->secondary_description="Lgf to mobile money";
							$generalLedger->amount=$lgftomobilemoneytransfers->amount;
							$generalLedger->date=date('m/d/Y');
							$generalLedger->save();


							$generalLedger=new GeneralLedgers();
							$generalLedger->account=$mobilemoneytransferconfigurations[0]['credit_account'];
							$generalLedger->entry_type=$credit[0]['id'];
							$generalLedger->transaction_number=$lgftomobilemoneytransfers->transaction_number;
							$generalLedger->loan=$lgftomobilemoneytransfers->client;
							$generalLedger->secondary_description="Lgf to mobile money";					
							$generalLedger->amount=$lgftomobilemoneytransfers->amount;
							$generalLedger->date=date('m/d/Y');
							$generalLedger->save();

							$mobilemoneytransactionchargeconfigurations=MobileMoneyTransactionChargeConfigurations::where([['client_type','=',$lgftomobilemoneytransfers->clientmodel->client_type],['mobile_money_mode','=',$lgftomobilemoneytransfers->mobile_money_mode]])->get();

							$generalLedger=new GeneralLedgers();
							$generalLedger->account=$mobilemoneytransactionchargeconfigurations[0]['debit_account'];
							$generalLedger->entry_type=$debit[0]['id'];
							$generalLedger->transaction_number=$lgftomobilemoneytransfers->transaction_number;
							$generalLedger->loan=$lgftomobilemoneytransfers->client;
							$generalLedger->secondary_description="Lgf to mobile money transaction charges";
							$generalLedger->amount=$lgftomobilemoneytransfers->transaction_charges;
							$generalLedger->date=date('m/d/Y');
							$generalLedger->save();


							$generalLedger=new GeneralLedgers();
							$generalLedger->account=$mobilemoneytransactionchargeconfigurations[0]['credit_account'];
							$generalLedger->entry_type=$credit[0]['id'];
							$generalLedger->transaction_number=$lgftomobilemoneytransfers->transaction_number;
							$generalLedger->loan=$lgftomobilemoneytransfers->client;
							$generalLedger->secondary_description="Lgf to mobile money transaction charges";					
							$generalLedger->amount=$lgftomobilemoneytransfers->transaction_charges;
							$generalLedger->date=date('m/d/Y');
							$generalLedger->save();		

							$paymentmode=PaymentModes::where([["code","=","000"]])->get()->first();

							$groupcashbook=new GroupCashBooks();

							$groupcashbook->transaction_id= $lgftomobilemoneytransfers->transaction_number;
							$groupcashbook->transaction_reference=$lgftomobilemoneytransfers->transaction_number;
							$groupcashbook->transaction_date=$lgftomobilemoneytransfers->transaction_date;
							$groupcashbook->transaction_type=2;
							$groupcashbook->transacting_group=null;
							$groupcashbook->amount=$lgftomobilemoneytransfers->amount;
							$groupcashbook->payment_mode=$paymentmode->id;
							$groupcashbook->account=$mobilemoneytransferconfigurations[0]['debit_account'];
							$groupcashbook->lgf=0;
							$groupcashbook->loan_principal=0;
							$groupcashbook->loan_interest=0;
							$groupcashbook->mpesa_charges=0;
							$groupcashbook->fine=0;
							$groupcashbook->processing_fees=0;
							$groupcashbook->insurance_deduction_fees=0;
							$groupcashbook->collecting_officer=$user[0]->name;
							$groupcashbook->clearing_fees=0;
							$groupcashbook->particulars=$lgftomobilemoneytransfers->clientmodel->first_name." ".$lgftomobilemoneytransfers->clientmodel->middle_name." ".$lgftomobilemoneytransfers->clientmodel->last_name." lgf withdrawal";
							
							$groupcashbook->save();				

							$groupcashbook1=new GroupCashBooks();

							$groupcashbook1->transaction_id= $lgftomobilemoneytransfers->transaction_number;
							$groupcashbook1->transaction_reference=$lgftomobilemoneytransfers->transaction_number;
							$groupcashbook1->transaction_date=$lgftomobilemoneytransfers->transaction_date;
							$groupcashbook1->account=$mobilemoneytransferconfigurations[0]['credit_account'];
							$groupcashbook1->transaction_type=1;
							$groupcashbook1->transacting_group=null;
							$groupcashbook1->amount=$lgftomobilemoneytransfers->amount;
							$groupcashbook1->payment_mode=$paymentmode->id;
							$groupcashbook1->lgf=0;
							$groupcashbook1->loan_principal=0;
							$groupcashbook1->loan_interest=0;
							$groupcashbook1->mpesa_charges=0;
							$groupcashbook1->fine=0;
							$groupcashbook1->processing_fees=0;
							$groupcashbook1->insurance_deduction_fees=0;
							$groupcashbook1->collecting_officer=$user[0]->name;
							$groupcashbook1->clearing_fees=0;
							$groupcashbook1->particulars=$lgftomobilemoneytransfers->clientmodel->first_name." ".$lgftomobilemoneytransfers->clientmodel->middle_name." ".$lgftomobilemoneytransfers->clientmodel->last_name." lgf withdrawal";
							
							$groupcashbook1->save();				


							$groupcashbook2=new GroupCashBooks();

							$groupcashbook2->transaction_id= $lgftomobilemoneytransfers->transaction_number;
							$groupcashbook2->transaction_reference=$lgftomobilemoneytransfers->transaction_number;
							$groupcashbook2->transaction_date=$lgftomobilemoneytransfers->transaction_date;
							$groupcashbook2->transaction_type=2;
							$groupcashbook2->transacting_group=null;
							$groupcashbook2->amount=$lgftomobilemoneytransfers->transaction_charges;
							$groupcashbook2->payment_mode=$paymentmode->id;
							$groupcashbook2->account=$mobilemoneytransactionchargeconfigurations[0]['debit_account'];
							$groupcashbook2->lgf=0;
							$groupcashbook2->loan_principal=0;
							$groupcashbook2->loan_interest=0;
							$groupcashbook2->mpesa_charges=0;
							$groupcashbook2->fine=0;
							$groupcashbook2->processing_fees=0;
							$groupcashbook2->insurance_deduction_fees=0;
							$groupcashbook2->collecting_officer=$user[0]->name;
							$groupcashbook2->clearing_fees=0;
							$groupcashbook2->particulars=$lgftomobilemoneytransfers->clientmodel->first_name." ".$lgftomobilemoneytransfers->clientmodel->middle_name." ".$lgftomobilemoneytransfers->clientmodel->last_name." lgf withdrawal charges";
							
							$groupcashbook2->save();				

							$groupcashbook3=new GroupCashBooks();

							$groupcashbook3->transaction_id= $lgftomobilemoneytransfers->transaction_number;
							$groupcashbook3->transaction_reference=$lgftomobilemoneytransfers->transaction_number;
							$groupcashbook3->transaction_date=$lgftomobilemoneytransfers->transaction_date;
							$groupcashbook3->account=$mobilemoneytransactionchargeconfigurations[0]['credit_account'];
							$groupcashbook3->transaction_type=1;
							$groupcashbook3->transacting_group=null;
							$groupcashbook3->amount=$lgftomobilemoneytransfers->transaction_charges;
							$groupcashbook3->payment_mode=$paymentmode->id;
							$groupcashbook3->lgf=0;
							$groupcashbook3->loan_principal=0;
							$groupcashbook3->loan_interest=0;
							$groupcashbook3->mpesa_charges=0;
							$groupcashbook3->fine=0;
							$groupcashbook3->processing_fees=0;
							$groupcashbook3->insurance_deduction_fees=0;
							$groupcashbook3->collecting_officer=$user[0]->name;
							$groupcashbook3->clearing_fees=0;
							$groupcashbook3->particulars=$lgftomobilemoneytransfers->clientmodel->first_name." ".$lgftomobilemoneytransfers->clientmodel->middle_name." ".$lgftomobilemoneytransfers->clientmodel->last_name." lgf withdrawal charges";
							
							$groupcashbook3->save();

						}
											
					}

				}catch(Exception $e){

				}
			});			
		}

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$lgftomobilemoneytransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=MobileMoneyTransferApprovals::where([["mobile_money_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=MobileMoneyTransferApprovals::where([["mobile_money_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$lgftomobilemoneytransfersdata['myturn']="1";
					}else if(isset($lgftomobilemoneytransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$lgftomobilemoneytransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$lgftomobilemoneytransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$lgftomobilemoneytransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}

		$lgftomobilemoneytransfersdata['data']=LgfToMobileMoneyTransfers::find($id);
		return view('admin.lgf_to_mobile_money_transfers.edit',compact('lgftomobilemoneytransfersdata','id'));
		}
	}

	public function destroy($id){
		$lgftomobilemoneytransfers=LgfToMobileMoneyTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToMobileMoneyTransfers']])->get();
		$lgftomobilemoneytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftomobilemoneytransfersdata['usersaccountsroles'][0]) && $lgftomobilemoneytransfersdata['usersaccountsroles'][0]['_delete']==1){
			$lgftomobilemoneytransfers->delete();
		}return redirect('admin/lgftomobilemoneytransfers')->with('success','lgf to mobile money transfers has been deleted!');
	}
}