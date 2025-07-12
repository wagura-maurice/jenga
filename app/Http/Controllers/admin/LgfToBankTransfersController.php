<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (lgf to bank transfers)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LgfToBankTransfers;
use App\Companies;
use App\Modules;
use App\Clients;
use App\ApprovalLevels;
use App\BankTransferApprovals;
use App\ClientLgfBalances;
use App\BankTransferConfigurations;
use App\BankTransferChargeConfigurations;
use App\GroupCashBooks;
use App\EntryTypes;
use App\GeneralLedgers;
use App\PaymentModes;
use App\Banks;
use App\BankBranches;
use App\BankTransferApprovalLevels;
use App\Users;
use App\ApprovalStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\UsersAccountsRoles;
class LgfToBankTransfersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$lgftobanktransfersdata['clients']=Clients::all();
		$lgftobanktransfersdata['banks']=Banks::all();
		$lgftobanktransfersdata['bankbranches']=BankBranches::all();
		$lgftobanktransfersdata['users']=Users::all();
		$lgftobanktransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftobanktransfersdata['list']=LgfToBankTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToBankTransfers']])->get();
		$lgftobanktransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftobanktransfersdata['usersaccountsroles'][0]) && $lgftobanktransfersdata['usersaccountsroles'][0]['_add']==0&&$lgftobanktransfersdata['usersaccountsroles'][0]['_list']==0&&$lgftobanktransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftobanktransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftobanktransfersdata['usersaccountsroles'][0]['_show']==0&&$lgftobanktransfersdata['usersaccountsroles'][0]['_delete']==0&&$lgftobanktransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftobanktransfersdata'));
		}else{
			return view('admin.lgf_to_bank_transfers.index',compact('lgftobanktransfersdata'));
		}
	}

	public function create(){
		$lgftobanktransfersdata;
		$lgftobanktransfersdata['clients']=Clients::all();
		$lgftobanktransfersdata['banks']=Banks::all();
		$lgftobanktransfersdata['bankbranches']=BankBranches::all();
		$lgftobanktransfersdata['users']=Users::all();
		$lgftobanktransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToBankTransfers']])->get();
		$lgftobanktransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftobanktransfersdata['usersaccountsroles'][0]) && $lgftobanktransfersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('lgftobanktransfersdata'));
		}else{
			return view('admin.lgf_to_bank_transfers.create',compact('lgftobanktransfersdata'));
		}
	}

	public function filter(Request $request){
		$lgftobanktransfersdata['clients']=Clients::all();
		$lgftobanktransfersdata['banks']=Banks::all();
		$lgftobanktransfersdata['bankbranches']=BankBranches::all();
		$lgftobanktransfersdata['users']=Users::all();
		$lgftobanktransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftobanktransfersdata['list']=LgfToBankTransfers::where([['transaction_number','LIKE','%'.$request->get('transaction_number').'%'],['client','LIKE','%'.$request->get('client').'%'],['bank','LIKE','%'.$request->get('bank').'%'],['bank_branch','LIKE','%'.$request->get('bank_branch').'%'],['bank_account_number','LIKE','%'.$request->get('bank_account_number').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['transaction_charge','LIKE','%'.$request->get('transaction_charge').'%'],['initiated_by','LIKE','%'.$request->get('initiated_by').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],])->orWhereBetween('transaction_date',[$request->get('transaction_datefrom'),$request->get('transaction_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToBankTransfers']])->get();
		$lgftobanktransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftobanktransfersdata['usersaccountsroles'][0]) && $lgftobanktransfersdata['usersaccountsroles'][0]['_add']==0&&$lgftobanktransfersdata['usersaccountsroles'][0]['_list']==0&&$lgftobanktransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftobanktransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftobanktransfersdata['usersaccountsroles'][0]['_show']==0&&$lgftobanktransfersdata['usersaccountsroles'][0]['_delete']==0&&$lgftobanktransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftobanktransfersdata'));
		}else{
			return view('admin.lgf_to_bank_transfers.index',compact('lgftobanktransfersdata'));
		}
	}

	public function report(){
		$lgftobanktransfersdata['company']=Companies::all();
		$lgftobanktransfersdata['list']=LgfToBankTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToBankTransfers']])->get();
		$lgftobanktransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftobanktransfersdata['usersaccountsroles'][0]) && $lgftobanktransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftobanktransfersdata'));
		}else{
			return view('admin.lgf_to_bank_transfers.report',compact('lgftobanktransfersdata'));
		}
	}

	public function chart(){
		return view('admin.lgf_to_bank_transfers.chart');
	}

	public function store(Request $request){
		$lgftobanktransfers=new LgfToBankTransfers();
		$lgftobanktransfers->transaction_number=$request->get('transaction_number');
		$lgftobanktransfers->client=$request->get('client');
		$lgftobanktransfers->bank=$request->get('bank');
		$lgftobanktransfers->bank_branch=$request->get('bank_branch');
		$lgftobanktransfers->bank_account_number=$request->get('bank_account_number');
		$lgftobanktransfers->amount=$request->get('amount');
		$lgftobanktransfers->transaction_charge=$request->get('transaction_charge');
		$lgftobanktransfers->transaction_date=\Carbon\Carbon::parse($request->transaction_date)->toDateString();
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$lgftobanktransfers->initiated_by=$user[0]["id"];
		$approvalstatuses=ApprovalStatuses::where([["code","=","003"]])->get()->first();
		$lgftobanktransfers->approval_status=$approvalstatuses->id;

		$module=Modules::where([['name','=','LgfToBankTransfers']])->get();
		$lgftobanktransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftobanktransfersdata['usersaccountsroles'][0]) && $lgftobanktransfersdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($lgftobanktransfers->save()){
					$response['status']='1';
					$response['message']='lgf to bank transfers Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add lgf to bank transfers. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add lgf to bank transfers. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$lgftobanktransfersdata['clients']=Clients::all();
		$lgftobanktransfersdata['banks']=Banks::all();
		$lgftobanktransfersdata['bankbranches']=BankBranches::all();
		$lgftobanktransfersdata['users']=Users::all();
		$lgftobanktransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftobanktransfersdata['data']=LgfToBankTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToBankTransfers']])->get();

		$mymapping=BankTransferApprovalLevels::where([["client_type","=",$lgftobanktransfersdata['data']->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();

		$lgftobanktransfersdata['mymapping']=$mymapping;

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$lgftobanktransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=BankTransferApprovals::where([["bank_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=BankTransferApprovals::where([["bank_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$lgftobanktransfersdata['myturn']="1";
					}else if(isset($lgftobanktransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$lgftobanktransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$lgftobanktransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$lgftobanktransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}

		$lgftobanktransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftobanktransfersdata['usersaccountsroles'][0]) && $lgftobanktransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftobanktransfersdata'));
		}else{
		return view('admin.lgf_to_bank_transfers.edit',compact('lgftobanktransfersdata','id'));
		}
	}

	public function show($id){
		$lgftobanktransfersdata['clients']=Clients::all();
		$lgftobanktransfersdata['banks']=Banks::all();
		$lgftobanktransfersdata['bankbranches']=BankBranches::all();
		$lgftobanktransfersdata['users']=Users::all();
		$lgftobanktransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftobanktransfersdata['data']=LgfToBankTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToBankTransfers']])->get();
		$lgftobanktransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftobanktransfersdata['usersaccountsroles'][0]) && $lgftobanktransfersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('lgftobanktransfersdata'));
		}else{
		return view('admin.lgf_to_bank_transfers.show',compact('lgftobanktransfersdata','id'));
		}
	}

	public function update(Request $request,$id){
		$lgftobanktransfers=LgfToBankTransfers::find($id);
		$lgftobanktransfersdata['clients']=Clients::all();
		$lgftobanktransfersdata['banks']=Banks::all();
		$lgftobanktransfersdata['bankbranches']=BankBranches::all();
		$lgftobanktransfersdata['users']=Users::all();
		$lgftobanktransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$lgftobanktransfersdata['data']=LgfToBankTransfers::find($id);

		$module=Modules::where([['name','=','LgfToBankTransfers']])->get();
		$lgftobanktransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftobanktransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftobanktransfersdata'));
		}else{
			
		$mymapping=BankTransferApprovalLevels::where([["client_type","=",$lgftobanktransfers->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();			

		if($lgftobanktransfers->approvalstatusmodel->code=="003"){
			DB::transaction(function() use($request,$user,$id,$mymapping,$lgftobanktransfers,$lgftobanktransfersdata){
				try{

					$banktransferapproval=new BankTransferApprovals();
					$banktransferapproval->bank_transfer=$id;
					$banktransferapproval->approval_level=$mymapping->approval_level;
					$banktransferapproval->approved_by=$user[0]->id;
					$banktransferapproval->user_account=$user[0]->user_account;
					$banktransferapproval->remarks=$request->get('remarks');
					$banktransferapproval->approval_status=$request->get('approval_status');
					$banktransferapproval->save();

					$mappings=bankTransferApprovalLevels::where([["client_type","=",$lgftobanktransfers->clientmodel->client_type]])->get();

					$maxapprovallevel=0;

					for($r=0;$r<count($mappings);$r++){

						$maxapprovallevel=$mappings[$r]->approvallevelmodel->approval_level>$maxapprovallevel?$mappings[$r]->approvallevelmodel->approval_level:$maxapprovallevel;
					}

					$rejeted=ApprovalStatuses::where([["code","=","002"]])->get()->first();

					if($maxapprovallevel==$mymapping->approvallevelmodel->approval_level || $rejeted->id==$request->get('approval_status')){

						$lgftobanktransfers->approval_status=$request->get('approval_status');

						$lgftobanktransfers->save();

						$approved=ApprovalStatuses::where([["code","=","001"]])->get()->first();

						if($approved->id==$lgftobanktransfers->approval_status){
							
							$clientfromlgfbalance=ClientLgfBalances::where([["client","=",$lgftobanktransfers->client]])->get()->first();

							$clientfromlgfbalance->balance=$clientfromlgfbalance->balance-$lgftobanktransfers->amount-$lgftobanktransfers->transaction_charge;

							$clientfromlgfbalance->save();


							$banktransferconfigurations=BankTransferConfigurations::where([['client_type','=',$lgftobanktransfers->clientmodel->client_type]])->get();


							$debit=EntryTypes::where([['code','=','001']])->get();
							$credit=EntryTypes::where([['code','=','002']])->get();	

							$generalLedger=new GeneralLedgers();
							$generalLedger->account=$banktransferconfigurations[0]['debit_account'];
							$generalLedger->entry_type=$debit[0]['id'];
							$generalLedger->transaction_number=$lgftobanktransfers->transaction_number;
							$generalLedger->loan=$lgftobanktransfers->client;
							$generalLedger->secondary_description="Lgf to mobile money";
							$generalLedger->amount=$lgftobanktransfers->amount;
							$generalLedger->date=date('m/d/Y');
							$generalLedger->save();


							$generalLedger=new GeneralLedgers();
							$generalLedger->account=$banktransferconfigurations[0]['credit_account'];
							$generalLedger->entry_type=$credit[0]['id'];
							$generalLedger->transaction_number=$lgftobanktransfers->transaction_number;
							$generalLedger->loan=$lgftobanktransfers->client;
							$generalLedger->secondary_description="Lgf to mobile money";					
							$generalLedger->amount=$lgftobanktransfers->amount;
							$generalLedger->date=date('m/d/Y');
							$generalLedger->save();

							$banktransactionchargeconfigurations=BankTransferChargeConfigurations::where([['client_type','=',$lgftobanktransfers->clientmodel->client_type]])->get();

							$generalLedger=new GeneralLedgers();
							$generalLedger->account=$banktransactionchargeconfigurations[0]['debit_account'];
							$generalLedger->entry_type=$debit[0]['id'];
							$generalLedger->transaction_number=$lgftobanktransfers->transaction_number;
							$generalLedger->loan=$lgftobanktransfers->client;
							$generalLedger->secondary_description="Lgf to mobile money transaction charges";
							$generalLedger->amount=$lgftobanktransfers->transaction_charge;
							$generalLedger->date=date('m/d/Y');
							$generalLedger->save();


							$generalLedger=new GeneralLedgers();
							$generalLedger->account=$banktransactionchargeconfigurations[0]['credit_account'];
							$generalLedger->entry_type=$credit[0]['id'];
							$generalLedger->transaction_number=$lgftobanktransfers->transaction_number;
							$generalLedger->loan=$lgftobanktransfers->client;
							$generalLedger->secondary_description="Lgf to mobile money transaction charges";					
							$generalLedger->amount=$lgftobanktransfers->transaction_charge;
							$generalLedger->date=date('m/d/Y');
							$generalLedger->save();		

							$paymentmode=PaymentModes::where([["code","=","000"]])->get()->first();
							
							$groupcashbook=new GroupCashBooks();

							$groupcashbook->transaction_id= $lgftobanktransfers->transaction_number;
							$groupcashbook->transaction_reference=$lgftobanktransfers->transaction_number;
							$groupcashbook->transaction_date=$lgftobanktransfers->transaction_date;
							$groupcashbook->transaction_type=2;
							$groupcashbook->transacting_group=null;
							$groupcashbook->amount=$lgftobanktransfers->amount;
							$groupcashbook->payment_mode=$paymentmode->id;
							$groupcashbook->lgf=0;
							$groupcashbook->account=$banktransferconfigurations[0]['debit_account'];
							$groupcashbook->loan_principal=0;
							$groupcashbook->loan_interest=0;
							$groupcashbook->mpesa_charges=0;
							$groupcashbook->fine=0;
							$groupcashbook->processing_fees=0;
							$groupcashbook->insurance_deduction_fees=0;
							$groupcashbook->collecting_officer=$user[0]->name;
							$groupcashbook->clearing_fees=0;
							$groupcashbook->particulars=$lgftobanktransfers->clientmodel->first_name." ".$lgftobanktransfers->clientmodel->middle_name." ".$lgftobanktransfers->clientmodel->last_name." lgf to inventory";
							
							$groupcashbook->save();		

							$groupcashbook2=new GroupCashBooks();

							$groupcashbook2->transaction_id= $lgftobanktransfers->transaction_number;
							$groupcashbook2->transaction_reference=$lgftobanktransfers->transaction_number;
							$groupcashbook2->transaction_date=$lgftobanktransfers->transaction_date;
							$groupcashbook2->transaction_type=1;
							$groupcashbook2->transacting_group=null;
							$groupcashbook2->amount=$lgftobanktransfers->amount;
							$groupcashbook2->payment_mode=$paymentmode->id;
							$groupcashbook2->lgf=0;
							$groupcashbook2->account=$banktransferconfigurations[0]['credit_account'];
							$groupcashbook2->loan_principal=0;
							$groupcashbook2->loan_interest=0;
							$groupcashbook2->mpesa_charges=0;
							$groupcashbook2->fine=0;
							$groupcashbook2->processing_fees=0;
							$groupcashbook2->insurance_deduction_fees=0;
							$groupcashbook2->collecting_officer=$user[0]->name;
							$groupcashbook2->clearing_fees=0;
							$groupcashbook2->particulars=$lgftobanktransfers->clientmodel->first_name." ".$lgftobanktransfers->clientmodel->middle_name." ".$lgftobanktransfers->clientmodel->last_name." lgf to bank";
							
							$groupcashbook2->save();	

							$groupcashbook3=new GroupCashBooks();

							$groupcashbook3->transaction_id= $lgftobanktransfers->transaction_number;
							$groupcashbook3->transaction_reference=$lgftobanktransfers->transaction_number;
							$groupcashbook3->transaction_date=$lgftobanktransfers->transaction_date;
							$groupcashbook3->transaction_type=2;
							$groupcashbook3->transacting_group=null;
							$groupcashbook3->amount=$lgftobanktransfers->transaction_charge;
							$groupcashbook3->payment_mode=$paymentmode->id;
							$groupcashbook3->lgf=0;
							$groupcashbook3->account=$banktransactionchargeconfigurations[0]['debit_account'];
							$groupcashbook3->loan_principal=0;
							$groupcashbook3->loan_interest=0;
							$groupcashbook3->mpesa_charges=0;
							$groupcashbook3->fine=0;
							$groupcashbook3->processing_fees=0;
							$groupcashbook3->insurance_deduction_fees=0;
							$groupcashbook3->collecting_officer=$user[0]->name;
							$groupcashbook3->clearing_fees=0;
							$groupcashbook3->particulars=$lgftobanktransfers->clientmodel->first_name." ".$lgftobanktransfers->clientmodel->middle_name." ".$lgftobanktransfers->clientmodel->last_name." lgf to bank charges";
							
							$groupcashbook3->save();	
							

							$groupcashbook4=new GroupCashBooks();

							$groupcashbook4->transaction_id= $lgftobanktransfers->transaction_number;
							$groupcashbook4->transaction_reference=$lgftobanktransfers->transaction_number;
							$groupcashbook4->transaction_date=$lgftobanktransfers->transaction_date;
							$groupcashbook4->transaction_type=1;
							$groupcashbook4->transacting_group=null;
							$groupcashbook4->amount=$lgftobanktransfers->transaction_charge;
							$groupcashbook4->payment_mode=$paymentmode->id;
							$groupcashbook4->lgf=0;
							$groupcashbook4->account=$banktransactionchargeconfigurations[0]['credit_account'];
							$groupcashbook4->loan_principal=0;
							$groupcashbook4->loan_interest=0;
							$groupcashbook4->mpesa_charges=0;
							$groupcashbook4->fine=0;
							$groupcashbook4->processing_fees=0;
							$groupcashbook4->insurance_deduction_fees=0;
							$groupcashbook4->collecting_officer=$user[0]->name;
							$groupcashbook4->clearing_fees=0;
							$groupcashbook4->particulars=$lgftobanktransfers->clientmodel->first_name." ".$lgftobanktransfers->clientmodel->middle_name." ".$lgftobanktransfers->clientmodel->last_name." lgf to bank charges";
							
							$groupcashbook4->save();								
						

						}
											
					}

				}catch(Exception $e){

				}
			});			
		}

		$mymapping=BankTransferApprovalLevels::where([["client_type","=",$lgftobanktransfersdata['data']->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();

		$lgftobanktransfersdata['mymapping']=$mymapping;

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$lgftobanktransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=BankTransferApprovals::where([["bank_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=BankTransferApprovals::where([["bank_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$lgftobanktransfersdata['myturn']="1";
					}else if(isset($lgftobanktransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$lgftobanktransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$lgftobanktransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$lgftobanktransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}

		$lgftobanktransfersdata['data']=LgfToBankTransfers::find($id);
		return view('admin.lgf_to_bank_transfers.edit',compact('lgftobanktransfersdata','id'));
		}
	}

	public function destroy($id){
		$lgftobanktransfers=LgfToBankTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToBankTransfers']])->get();
		$lgftobanktransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftobanktransfersdata['usersaccountsroles'][0]) && $lgftobanktransfersdata['usersaccountsroles'][0]['_delete']==1){
			$lgftobanktransfers->delete();
		}return redirect('admin/lgftobanktransfers')->with('success','lgf to bank transfers has been deleted!');
	}

	public function getlgftobanktransactionnumber(){
		return (LgfToBankTransfers::all()->count()+1);
	}
}