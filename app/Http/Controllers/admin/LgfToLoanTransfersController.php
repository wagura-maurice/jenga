<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (lgf to loan transfers)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LgfToLoanTransfers;
use App\Companies;
use App\Modules;
use App\Users;
use App\EntryTypes;
use App\GeneralLedgers;
use App\PaymentModes;
use App\LoanPayments;
use App\GroupCashBooks;
use Illuminate\Support\Facades\DB;
use App\Clients;
use App\ApprovalLevels;
use App\ProductPrincipalConfigurations;
use App\ProductInterestConfigurations;
use App\LoanTransferApprovals;
use App\LoanTransferApprovalLevels;
use App\Loans;
use App\ClientLgfBalances;
use App\ApprovalStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\UsersAccountsRoles;
class LgfToLoanTransfersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$lgftoloantransfersdata['clients']=Clients::all();
		$lgftoloantransfersdata['loans']=Loans::all();
		$lgftoloantransfersdata['users']=Users::all();
		$lgftoloantransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftoloantransfersdata['list']=LgfToLoanTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLoanTransfers']])->get();
		$lgftoloantransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoloantransfersdata['usersaccountsroles'][0]) && $lgftoloantransfersdata['usersaccountsroles'][0]['_add']==0&&$lgftoloantransfersdata['usersaccountsroles'][0]['_list']==0&&$lgftoloantransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftoloantransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftoloantransfersdata['usersaccountsroles'][0]['_show']==0&&$lgftoloantransfersdata['usersaccountsroles'][0]['_delete']==0&&$lgftoloantransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftoloantransfersdata'));
		}else{
			return view('admin.lgf_to_loan_transfers.index',compact('lgftoloantransfersdata'));
		}
	}

	public function create(){
		$lgftoloantransfersdata;
		$lgftoloantransfersdata['clients']=Clients::all();
		$lgftoloantransfersdata['loans']=Loans::all();
		$lgftoloantransfersdata['users']=Users::all();
		$lgftoloantransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLoanTransfers']])->get();
		$lgftoloantransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoloantransfersdata['usersaccountsroles'][0]) && $lgftoloantransfersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('lgftoloantransfersdata'));
		}else{
			return view('admin.lgf_to_loan_transfers.create',compact('lgftoloantransfersdata'));
		}
	}

	public function filter(Request $request){
		$lgftoloantransfersdata['clients']=Clients::all();
		$lgftoloantransfersdata['loans']=Loans::all();
		$lgftoloantransfersdata['users']=Users::all();
		$lgftoloantransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftoloantransfersdata['list']=LgfToLoanTransfers::where([['client','LIKE','%'.$request->get('client').'%'],['loan','LIKE','%'.$request->get('loan').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['initiated_by','LIKE','%'.$request->get('initiated_by').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],])->orWhereBetween('transaction_date',[$request->get('transaction_datefrom'),$request->get('transaction_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLoanTransfers']])->get();
		$lgftoloantransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoloantransfersdata['usersaccountsroles'][0]) && $lgftoloantransfersdata['usersaccountsroles'][0]['_add']==0&&$lgftoloantransfersdata['usersaccountsroles'][0]['_list']==0&&$lgftoloantransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftoloantransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftoloantransfersdata['usersaccountsroles'][0]['_show']==0&&$lgftoloantransfersdata['usersaccountsroles'][0]['_delete']==0&&$lgftoloantransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftoloantransfersdata'));
		}else{
			return view('admin.lgf_to_loan_transfers.index',compact('lgftoloantransfersdata'));
		}
	}

	public function report(){
		$lgftoloantransfersdata['company']=Companies::all();
		$lgftoloantransfersdata['list']=LgfToLoanTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLoanTransfers']])->get();
		$lgftoloantransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoloantransfersdata['usersaccountsroles'][0]) && $lgftoloantransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftoloantransfersdata'));
		}else{
			return view('admin.lgf_to_loan_transfers.report',compact('lgftoloantransfersdata'));
		}
	}

	public function chart(){
		return view('admin.lgf_to_loan_transfers.chart');
	}

	public function store(Request $request){
		$lgftoloantransfers=new LgfToLoanTransfers();
		$lgftoloantransfers->client=$request->get('client');
		$lgftoloantransfers->transaction_number=$request->get('transaction_number');
		$lgftoloantransfers->loan=$request->get('loan');
		$lgftoloantransfers->amount=$request->get('amount');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$lgftoloantransfers->initiated_by=$user[0]["id"];
		$lgftoloantransfers->transaction_date=\Carbon\Carbon::parse($request->transaction_date)->toDateString();
		$approvalstatuses=ApprovalStatuses::where([["code","=","003"]])->get()->first();
		$lgftoloantransfers->approval_status=$approvalstatuses->id;
		$response=array();
		
		$module=Modules::where([['name','=','LgfToLoanTransfers']])->get();
		$lgftoloantransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoloantransfersdata['usersaccountsroles'][0]) && $lgftoloantransfersdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($lgftoloantransfers->save()){
					$response['status']='1';
					$response['message']='lgf to loan transfers Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add lgf to loan transfers. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){

					$response['status']='0';
					$response['message']='An Error occured while attempting to add lgf to loan transfers. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function getlgftoloantransactionnumber()
	{
		$max = LgfToLoanTransfers::whereRaw('transaction_number = (select max(CAST(transaction_number as SIGNED)) from lgf_to_loan_transfers)')->get()->first();

		return $max->transaction_number+1;
	}

	public function edit($id){
		$lgftoloantransfersdata['clients']=Clients::all();
		$lgftoloantransfersdata['loans']=Loans::all();
		$lgftoloantransfersdata['users']=Users::all();
		$lgftoloantransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftoloantransfersdata['data']=LgfToLoanTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLoanTransfers']])->get();

		$mymapping=LoanTransferApprovalLevels::where([["client_type","=",$lgftoloantransfersdata['data']->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();

		$lgftoloantransfersdata['mymapping']=$mymapping;

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$lgftoloantransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=LoanTransferApprovals::where([["loan_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=LoanTransferApprovals::where([["loan_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$lgftoloantransfersdata['myturn']="1";
					}else if(isset($lgftoloantransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$lgftoloantransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$lgftoloantransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$lgftoloantransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}


		$lgftoloantransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoloantransfersdata['usersaccountsroles'][0]) && $lgftoloantransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftoloantransfersdata'));
		}else{
		return view('admin.lgf_to_loan_transfers.edit',compact('lgftoloantransfersdata','id'));
		}
	}

	public function show($id){
		$lgftoloantransfersdata['clients']=Clients::all();
		$lgftoloantransfersdata['loans']=Loans::all();
		$lgftoloantransfersdata['users']=Users::all();
		$lgftoloantransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftoloantransfersdata['data']=LgfToLoanTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLoanTransfers']])->get();
		$lgftoloantransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoloantransfersdata['usersaccountsroles'][0]) && $lgftoloantransfersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('lgftoloantransfersdata'));
		}else{
		return view('admin.lgf_to_loan_transfers.show',compact('lgftoloantransfersdata','id'));
		}
	}

	public function update(Request $request,$id){
		$lgftoloantransfers=LgfToLoanTransfers::find($id);
		$lgftoloantransfersdata['clients']=Clients::all();
		$lgftoloantransfersdata['loans']=Loans::all();
		$lgftoloantransfersdata['users']=Users::all();
		$lgftoloantransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLoanTransfers']])->get();
		$lgftoloantransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftoloantransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftoloantransfersdata'));
		}else{

		$mymapping=LoanTransferApprovalLevels::where([["client_type","=",$lgftoloantransfers->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();			

		if($lgftoloantransfers->approvalstatusmodel->code=="003"){
			
			DB::transaction(function() use($request,$user,$id,$mymapping,$lgftoloantransfers,$lgftoloantransfersdata){
				try{

					$loantransferapprovals=new LoanTransferApprovals();
					$loantransferapprovals->loan_transfer=$id;
					$loantransferapprovals->approval_level=$mymapping->approval_level;
					$loantransferapprovals->approved_by=$user[0]->id;
					$loantransferapprovals->users_accounts=$user[0]->user_account;
					$loantransferapprovals->remarks=$request->get('remarks');
					$loantransferapprovals->approval_status=$request->get('approval_status');
					$loantransferapprovals->save();

					$mappings=LoanTransferApprovalLevels::where([["client_type","=",$lgftoloantransfers->clientmodel->client_type]])->get();

					$maxapprovallevel=0;

					for($r=0;$r<count($mappings);$r++){

						$maxapprovallevel=$mappings[$r]->approvallevelmodel->approval_level>$maxapprovallevel?$mappings[$r]->approvallevelmodel->approval_level:$maxapprovallevel;
					}

					$rejeted=ApprovalStatuses::where([["code","=","002"]])->get()->first();

					if($maxapprovallevel==$mymapping->approvallevelmodel->approval_level || $rejeted->id==$request->get('approval_status')){

						$lgftoloantransfers->approval_status=$request->get('approval_status');

						$lgftoloantransfers->save();

						$approved=ApprovalStatuses::where([["code","=","001"]])->get()->first();

						if($approved->id==$lgftoloantransfers->approval_status){
							
							$clientfromlgfbalance=ClientLgfBalances::where([["client","=",$lgftoloantransfers->client]])->get()->first();

							if(isset($clientfromlgfbalance)){
							
								$clientfromlgfbalance->balance=$clientfromlgfbalance->balance-$lgftoloantransfers->amount;

								$clientfromlgfbalance->save();

								$paymentmode=PaymentModes::where([["code","=","000"]])->get()->first();

								$loanpayments=new LoanPayments();

								$loanpayments->loan=$lgftoloantransfers->loanmodel->id;
								$loanpayments->mode_of_payment=$paymentmode->id;
								$loanpayments->amount=$lgftoloantransfers->amount;
								$loanpayments->date= \Carbon\Carbon::now()->toDateString();
								$loanpayments->transaction_number=$lgftoloantransfers->transaction_number;
								$loanpayments->save();

								$productprincipalconfigurations=ProductPrincipalConfigurations::where([['loan_product','=',$lgftoloantransfers->loanmodel->loanproductmodel->id],['payment_mode','=',$paymentmode->id]])->get();


								$productinterestconfigurations=ProductInterestConfigurations::where([['loan_product','=',$lgftoloantransfers->loanmodel->loanproductmodel->id],['payment_mode','=',$paymentmode->id],['interest_payment_method','=',$lgftoloantransfers->loanmodel->interestpaymentmethodmodel->id]])->get();

								if(isset($productinterestconfigurations[0]) && isset($productprincipalconfigurations[0])){
									$interest=(($loanpayments->amount/(1+$lgftoloantransfers->loanmodel->interest_rate/100))*($lgftoloantransfers->loanmodel->interest_rate/100));


									$principal=$loanpayments->amount-$interest;
									$debit=EntryTypes::where([['code','=','001']])->get();
									$credit=EntryTypes::where([['code','=','002']])->get();	
									$generalLedger=new GeneralLedgers();
									$generalLedger->account=$productinterestconfigurations[0]['debit_account'];
									$generalLedger->entry_type=$debit[0]['id'];
									$generalLedger->transaction_number=$loanpayments->transaction_number;
									$generalLedger->loan=$lgftoloantransfers->loanmodel->id;
									$generalLedger->secondary_description="Interest payments";
									$generalLedger->amount=$interest;
									$generalLedger->date=date('m/d/Y');
									$generalLedger->save();


									$generalLedger=new GeneralLedgers();
									$generalLedger->account=$productinterestconfigurations[0]['credit_account'];
									$generalLedger->entry_type=$credit[0]['id'];
									$generalLedger->transaction_number=$loanpayments->transaction_number;
									$generalLedger->loan=$lgftoloantransfers->loanmodel->id;
									$generalLedger->secondary_description="Interest payments";					
									$generalLedger->amount=$interest;
									$generalLedger->date=date('m/d/Y');
									$generalLedger->save();

									$generalLedger=new GeneralLedgers();
									$generalLedger->account=$productprincipalconfigurations[0]['debit_account'];
									$generalLedger->entry_type=$debit[0]['id'];
									$generalLedger->transaction_number=$loanpayments->transaction_number;
									$generalLedger->loan=$lgftoloantransfers->loanmodel->id;
									$generalLedger->secondary_description="Principal payments";					
									$generalLedger->amount=$principal;
									$generalLedger->date=date('m/d/Y');
									$generalLedger->save();


									$generalLedger=new GeneralLedgers();
									$generalLedger->account=$productprincipalconfigurations[0]['credit_account'];
									$generalLedger->entry_type=$credit[0]['id'];
									$generalLedger->transaction_number=$loanpayments->transaction_number;
									$generalLedger->loan=$lgftoloantransfers->loanmodel->id;
									$generalLedger->secondary_description="principal payments";					
									$generalLedger->amount=$principal;
									$generalLedger->date=date('m/d/Y');
									$generalLedger->save();

									$groupcashbook=new GroupCashBooks();

									$groupcashbook->transaction_id= $loanpayments->transaction_number;
									$groupcashbook->transaction_reference=$loanpayments->transaction_number;
									$groupcashbook->transaction_date=$loanpayments->date;
									$groupcashbook->transaction_type=2;
									$groupcashbook->transacting_group=null;
									$groupcashbook->amount=$lgftoloantransfers->amount;
									$groupcashbook->payment_mode=$paymentmode->id;
									$groupcashbook->lgf=0;
									$groupcashbook->account=$productprincipalconfigurations[0]['debit_account'];
									$groupcashbook->loan_principal=0;
									$groupcashbook->loan_interest=0;
									$groupcashbook->mpesa_charges=0;
									$groupcashbook->fine=0;
									$groupcashbook->processing_fees=0;
									$groupcashbook->insurance_deduction_fees=0;
									$groupcashbook->collecting_officer=$user[0]->name;
									$groupcashbook->clearing_fees=0;
									$groupcashbook->particulars=$lgftoloantransfers->clientmodel->first_name." ".$lgftoloantransfers->clientmodel->middle_name." ".$lgftoloantransfers->clientmodel->last_name." lgf to loan payment";
									
									$groupcashbook->save();		


									$groupcashbook2=new GroupCashBooks();

									$groupcashbook2->transaction_id= $loanpayments->transaction_number;
									$groupcashbook2->transaction_reference=$loanpayments->transaction_number;
									$groupcashbook2->transaction_date=$loanpayments->date;
									$groupcashbook2->transaction_type=1;
									$groupcashbook2->transacting_group=null;
									$groupcashbook2->amount=$principal;
									$groupcashbook2->payment_mode=$paymentmode->id;
									$groupcashbook2->lgf=0;
									$groupcashbook2->account=$productprincipalconfigurations[0]['credit_account'];
									$groupcashbook2->loan_principal=0;
									$groupcashbook2->loan_interest=0;
									$groupcashbook2->mpesa_charges=0;
									$groupcashbook2->fine=0;
									$groupcashbook2->processing_fees=0;
									$groupcashbook2->insurance_deduction_fees=0;
									$groupcashbook2->collecting_officer=$user[0]->name;
									$groupcashbook2->clearing_fees=0;
									$groupcashbook2->particulars=$lgftoloantransfers->clientmodel->first_name." ".$lgftoloantransfers->clientmodel->middle_name." ".$lgftoloantransfers->clientmodel->last_name." lgf to loan payment";
									
									$groupcashbook2->save();	

									$groupcashbook3=new GroupCashBooks();

									$groupcashbook3->transaction_id= $loanpayments->transaction_number;
									$groupcashbook3->transaction_reference=$loanpayments->transaction_number;
									$groupcashbook3->transaction_date=$loanpayments->date;
									$groupcashbook3->transaction_type=2;
									$groupcashbook3->transacting_group=null;
									$groupcashbook3->amount=$interest;
									$groupcashbook3->payment_mode=$paymentmode->id;
									$groupcashbook3->lgf=0;
									$groupcashbook3->account=$productinterestconfigurations[0]['debit_account'];
									$groupcashbook3->loan_principal=0;
									$groupcashbook3->loan_interest=0;
									$groupcashbook3->mpesa_charges=0;
									$groupcashbook3->fine=0;
									$groupcashbook3->processing_fees=0;
									$groupcashbook3->insurance_deduction_fees=0;
									$groupcashbook3->collecting_officer=$user[0]->name;
									$groupcashbook3->clearing_fees=0;
									$groupcashbook3->particulars=$lgftoloantransfers->clientmodel->first_name." ".$lgftoloantransfers->clientmodel->middle_name." ".$lgftoloantransfers->clientmodel->last_name." lgf to loan interest payment";
									
									$groupcashbook3->save();
									
									$groupcashbook4=new GroupCashBooks();

									$groupcashbook4->transaction_id= $loanpayments->transaction_number;
									$groupcashbook4->transaction_reference=$loanpayments->transaction_number;
									$groupcashbook4->transaction_date=$loanpayments->date;
									$groupcashbook4->transaction_type=1;
									$groupcashbook4->transacting_group=null;
									$groupcashbook4->amount=$interest;
									$groupcashbook4->payment_mode=$paymentmode->id;
									$groupcashbook4->lgf=0;
									$groupcashbook4->account=$productinterestconfigurations[0]['credit_account'];
									$groupcashbook4->loan_principal=0;
									$groupcashbook4->loan_interest=0;
									$groupcashbook4->mpesa_charges=0;
									$groupcashbook4->fine=0;
									$groupcashbook4->processing_fees=0;
									$groupcashbook4->insurance_deduction_fees=0;
									$groupcashbook4->collecting_officer=$user[0]->name;
									$groupcashbook4->clearing_fees=0;
									$groupcashbook4->particulars=$lgftoloantransfers->clientmodel->first_name." ".$lgftoloantransfers->clientmodel->middle_name." ".$lgftoloantransfers->clientmodel->last_name." lgf to loan interest payment";
									
									$groupcashbook4->save();									
		

								}else{
									throw new Exception("configuration(interest or principal) not found for product : ".$lgftoloantransfers->loanmodel->loanproductmodel->name." payment mode : ".$paymentmode->name." interest payment method : ".$lgftoloantransfers->loanmodel->interestpaymentmethodmodel->name, 1);
									
								}

							}else{
								throw new Exception("Client has no lgf history", 1);
								
							}

						}
											
					}

				}catch(Exception $e){
					throw $e;
				}
			});			
		}	

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$lgftoloantransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=LoanTransferApprovals::where([["loan_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=LoanTransferApprovals::where([["loan_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$lgftoloantransfersdata['myturn']="1";
					}else if(isset($lgftoloantransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$lgftoloantransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$lgftoloantransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$lgftoloantransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}		

		$lgftoloantransfersdata['data']=LgfToLoanTransfers::find($id);

		return view('admin.lgf_to_loan_transfers.edit',compact('lgftoloantransfersdata','id'));
		}
	}

	public function destroy($id){
		$lgftoloantransfers=LgfToLoanTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLoanTransfers']])->get();
		$lgftoloantransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoloantransfersdata['usersaccountsroles'][0]) && $lgftoloantransfersdata['usersaccountsroles'][0]['_delete']==1){
			$lgftoloantransfers->delete();
		}return redirect('admin/lgftoloantransfers')->with('success','lgf to loan transfers has been deleted!');
	}
}
