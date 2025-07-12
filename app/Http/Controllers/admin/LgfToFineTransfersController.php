<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (lgf to fine transfers)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LgfToFineTransfers;
use App\Companies;
use App\Modules;
use App\FineTransferApprovalLevels;
use Illuminate\Support\Facades\DB;
use App\FinePaymentConfigurations;
use App\ApprovalLevels;
use App\ClientLgfBalances;
use App\PaymentModes;
use App\LoanPayments;
use App\EntryTypes;
use App\GeneralLedgers;
use App\Clients;
use App\Loans;
use App\Users;
use App\GroupCashBooks;
use App\FineTransferApprovals;
use App\ApprovalStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LgfToFineTransfersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$lgftofinetransfersdata['clients']=Clients::all();
		$lgftofinetransfersdata['loans']=Loans::all();
		$lgftofinetransfersdata['users']=Users::all();
		$lgftofinetransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftofinetransfersdata['list']=LgfToFineTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToFineTransfers']])->get();
		$lgftofinetransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftofinetransfersdata['usersaccountsroles'][0]) && $lgftofinetransfersdata['usersaccountsroles'][0]['_add']==0&&$lgftofinetransfersdata['usersaccountsroles'][0]['_list']==0&&$lgftofinetransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftofinetransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftofinetransfersdata['usersaccountsroles'][0]['_show']==0&&$lgftofinetransfersdata['usersaccountsroles'][0]['_delete']==0&&$lgftofinetransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftofinetransfersdata'));
		}else{
			return view('admin.lgf_to_fine_transfers.index',compact('lgftofinetransfersdata'));
		}
	}

	public function create(){
		$lgftofinetransfersdata;
		$lgftofinetransfersdata['clients']=Clients::all();
		$lgftofinetransfersdata['loans']=Loans::all();
		$lgftofinetransfersdata['users']=Users::all();
		$lgftofinetransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToFineTransfers']])->get();
		$lgftofinetransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftofinetransfersdata['usersaccountsroles'][0]) && $lgftofinetransfersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('lgftofinetransfersdata'));
		}else{
			return view('admin.lgf_to_fine_transfers.create',compact('lgftofinetransfersdata'));
		}
	}

	public function filter(Request $request){
		$lgftofinetransfersdata['clients']=Clients::all();
		$lgftofinetransfersdata['loans']=Loans::all();
		$lgftofinetransfersdata['users']=Users::all();
		$lgftofinetransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftofinetransfersdata['list']=LgfToFineTransfers::where([['client','LIKE','%'.$request->get('client').'%'],['loan','LIKE','%'.$request->get('loan').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['initiated_by','LIKE','%'.$request->get('initiated_by').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],['transaction_number','LIKE','%'.$request->get('transaction_number').'%'],])->orWhereBetween('transaction_date',[$request->get('transaction_datefrom'),$request->get('transaction_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToFineTransfers']])->get();
		$lgftofinetransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftofinetransfersdata['usersaccountsroles'][0]) && $lgftofinetransfersdata['usersaccountsroles'][0]['_add']==0&&$lgftofinetransfersdata['usersaccountsroles'][0]['_list']==0&&$lgftofinetransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftofinetransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftofinetransfersdata['usersaccountsroles'][0]['_show']==0&&$lgftofinetransfersdata['usersaccountsroles'][0]['_delete']==0&&$lgftofinetransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftofinetransfersdata'));
		}else{
			return view('admin.lgf_to_fine_transfers.index',compact('lgftofinetransfersdata'));
		}
	}

	public function report(){
		$lgftofinetransfersdata['company']=Companies::all();
		$lgftofinetransfersdata['list']=LgfToFineTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToFineTransfers']])->get();
		$lgftofinetransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftofinetransfersdata['usersaccountsroles'][0]) && $lgftofinetransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftofinetransfersdata'));
		}else{
			return view('admin.lgf_to_fine_transfers.report',compact('lgftofinetransfersdata'));
		}
	}

	public function chart(){
		return view('admin.lgf_to_fine_transfers.chart');
	}

	public function getlgftofinetransactionnumber(){
		$max = LgfToFineTransfers::whereRaw('transaction_number = (select max(CAST(transaction_number as SIGNED)) from lgf_to_fine_transfers)')->get()->first();
		return $max->transaction_number+1;
	}

	public function store(Request $request){
		$lgftofinetransfers=new LgfToFineTransfers();
		$lgftofinetransfers->client=$request->get('client');
		$lgftofinetransfers->loan=$request->get('loan');
		$lgftofinetransfers->amount=$request->get('amount');
		$user=Users::where([['id','=',Auth::id()]])->get();		
		$lgftofinetransfers->initiated_by=$user[0]["id"];
		$lgftofinetransfers->transaction_date=\Carbon\Carbon::parse($request->transaction_date)->toDateString();
		$approvalstatuses=ApprovalStatuses::where([["code","=","003"]])->get()->first();
		$lgftofinetransfers->approval_status=$approvalstatuses->id;
		$lgftofinetransfers->transaction_number=$request->get('transaction_number');
		$response=array();
		$module=Modules::where([['name','=','LgfToFineTransfers']])->get();
		$lgftofinetransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftofinetransfersdata['usersaccountsroles'][0]) && $lgftofinetransfersdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($lgftofinetransfers->save()){
					$response['status']='1';
					$response['message']='lgf to fine transfers Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add lgf to fine transfers. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add lgf to fine transfers. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$lgftofinetransfersdata['clients']=Clients::all();
		$lgftofinetransfersdata['loans']=Loans::all();
		$lgftofinetransfersdata['users']=Users::all();
		$lgftofinetransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftofinetransfersdata['data']=LgfToFineTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToFineTransfers']])->get();


		$mymapping=FineTransferApprovalLevels::where([["client_type","=",$lgftofinetransfersdata['data']->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();

		$lgftofinetransfersdata['mymapping']=$mymapping;

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$lgftofinetransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=FineTransferApprovals::where([["fine_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=FineTransferApprovals::where([["fine_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$lgftofinetransfersdata['myturn']="1";
					}else if(isset($lgftofinetransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$lgftofinetransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$lgftofinetransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$lgftofinetransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}


		$lgftofinetransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftofinetransfersdata['usersaccountsroles'][0]) && $lgftofinetransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftofinetransfersdata'));
		}else{
		return view('admin.lgf_to_fine_transfers.edit',compact('lgftofinetransfersdata','id'));
		}
	}

	public function show($id){
		$lgftofinetransfersdata['clients']=Clients::all();
		$lgftofinetransfersdata['loans']=Loans::all();
		$lgftofinetransfersdata['users']=Users::all();
		$lgftofinetransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftofinetransfersdata['data']=LgfToFineTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToFineTransfers']])->get();
		$lgftofinetransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftofinetransfersdata['usersaccountsroles'][0]) && $lgftofinetransfersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('lgftofinetransfersdata'));
		}else{
		return view('admin.lgf_to_fine_transfers.show',compact('lgftofinetransfersdata','id'));
		}
	}

	public function update(Request $request,$id){
		$lgftofinetransfers=LgfToFineTransfers::find($id);
		$lgftofinetransfersdata['clients']=Clients::all();
		$lgftofinetransfersdata['loans']=Loans::all();
		$lgftofinetransfersdata['users']=Users::all();
		$lgftofinetransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToFineTransfers']])->get();
		$lgftofinetransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftofinetransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftofinetransfersdata'));
		}else{

		$mymapping=FineTransferApprovalLevels::where([["client_type","=",$lgftofinetransfers->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();			

		if($lgftofinetransfers->approvalstatusmodel->code=="003"){

			DB::transaction(function() use($request,$user,$id,$mymapping,$lgftofinetransfers,$lgftofinetransfersdata){
				try{

					$finetransferapprvoals=new FineTransferApprovals();
					$finetransferapprvoals->fine_transfer=$id;
					$finetransferapprvoals->approval_level=$mymapping->approval_level;
					$finetransferapprvoals->approved_by=$user[0]->id;
					$finetransferapprvoals->users_accounts=$user[0]->user_account;
					$finetransferapprvoals->remarks=$request->get('remarks');
					$finetransferapprvoals->approval_status=$request->get('approval_status');
					$finetransferapprvoals->save();

					$mappings=FineTransferApprovalLevels::where([["client_type","=",$lgftofinetransfers->clientmodel->client_type]])->get();

					$maxapprovallevel=0;

					for($r=0;$r<count($mappings);$r++){

						$maxapprovallevel=$mappings[$r]->approvallevelmodel->approval_level>$maxapprovallevel?$mappings[$r]->approvallevelmodel->approval_level:$maxapprovallevel;
					}

					$rejeted=ApprovalStatuses::where([["code","=","002"]])->get()->first();

					if($maxapprovallevel==$mymapping->approvallevelmodel->approval_level || $rejeted->id==$request->get('approval_status')){

						$lgftofinetransfers->approval_status=$request->get('approval_status');

						$lgftofinetransfers->save();

						$approved=ApprovalStatuses::where([["code","=","001"]])->get()->first();

						if($approved->id==$lgftofinetransfers->approval_status){
							
							$clientfromlgfbalance=ClientLgfBalances::where([["client","=",$lgftofinetransfers->client]])->get()->first();

							$clientfromlgfbalance->balance=$clientfromlgfbalance->balance-$lgftofinetransfers->amount;

							$clientfromlgfbalance->save();

							$paymentmode=PaymentModes::where([["code","=","000"]])->get()->first();


							$productfineconfigurations=FinePaymentConfigurations::where([['loan_product','=',$lgftofinetransfers->loanmodel->loanproductmodel->id],['payment_mode','=',$paymentmode->id]])->get();


							$fine=$lgftofinetransfers->amount;

							$debit=EntryTypes::where([['code','=','001']])->get();
							$credit=EntryTypes::where([['code','=','002']])->get();	

							$generalLedger=new GeneralLedgers();
							$generalLedger->account=$productfineconfigurations[0]['debit_account'];
							$generalLedger->entry_type=$debit[0]['id'];
							$generalLedger->transaction_number=$lgftofinetransfers->transaction_number;
							$generalLedger->loan=$lgftofinetransfers->loanmodel->id;
							$generalLedger->secondary_description="Fine payments";
							$generalLedger->amount=$fine;
							$generalLedger->date=date('m/d/Y');
							$generalLedger->save();


							$generalLedger=new GeneralLedgers();
							$generalLedger->account=$productfineconfigurations[0]['credit_account'];
							$generalLedger->entry_type=$credit[0]['id'];
							$generalLedger->transaction_number=$lgftofinetransfers->transaction_number;
							$generalLedger->loan=$lgftofinetransfers->loanmodel->id;
							$generalLedger->secondary_description="Fine payments";					
							$generalLedger->amount=$fine;
							$generalLedger->date=date('m/d/Y');
							$generalLedger->save();

							$groupcashbook=new GroupCashBooks();

							$groupcashbook->transaction_id= $lgftofinetransfers->transaction_number;
							$groupcashbook->transaction_reference=$lgftofinetransfers->transaction_number;
							$groupcashbook->transaction_date=$lgftofinetransfers->transaction_date;
							$groupcashbook->transaction_type=2;
							$groupcashbook->transacting_group=null;
							$groupcashbook->amount=$fine;
							$groupcashbook->payment_mode=$paymentmode->id;
							$groupcashbook->lgf=0;
							$groupcashbook->account=$productfineconfigurations[0]['debit_account'];
							$groupcashbook->loan_principal=0;
							$groupcashbook->loan_interest=0;
							$groupcashbook->mpesa_charges=0;
							$groupcashbook->fine=0;
							$groupcashbook->processing_fees=0;
							$groupcashbook->insurance_deduction_fees=0;
							$groupcashbook->collecting_officer=$user[0]->name;
							$groupcashbook->clearing_fees=0;
							$groupcashbook->particulars=$lgftofinetransfers->clientmodel->first_name." ".$lgftofinetransfers->clientmodel->middle_name." ".$lgftofinetransfers->clientmodel->last_name." fine payment";
							
							$groupcashbook->save();

							$groupcashbook2=new GroupCashBooks();

							$groupcashbook2->transaction_id= $lgftofinetransfers->transaction_number;
							$groupcashbook2->transaction_reference=$lgftofinetransfers->transaction_number;
							$groupcashbook2->transaction_date=$lgftofinetransfers->transaction_date;
							$groupcashbook2->transaction_type=1;
							$groupcashbook2->transacting_group=null;
							$groupcashbook2->amount=$fine;
							$groupcashbook2->payment_mode=$paymentmode->id;
							$groupcashbook2->lgf=0;
							$groupcashbook2->account=$productfineconfigurations[0]['credit_account'];
							$groupcashbook2->loan_principal=0;
							$groupcashbook2->loan_interest=0;
							$groupcashbook2->mpesa_charges=0;
							$groupcashbook2->fine=0;
							$groupcashbook2->processing_fees=0;
							$groupcashbook2->insurance_deduction_fees=0;
							$groupcashbook2->collecting_officer=$user[0]->name;
							$groupcashbook2->clearing_fees=0;
							$groupcashbook2->particulars=$lgftofinetransfers->clientmodel->first_name." ".$lgftofinetransfers->clientmodel->middle_name." ".$lgftofinetransfers->clientmodel->last_name." fine payment";
							
							$groupcashbook2->save();


						}
											
					}

				}catch(Exception $e){

				}
			});			
		}	

		$mymapping=FineTransferApprovalLevels::where([["client_type","=",$lgftofinetransfers->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();

		$lgftofinetransfersdata['mymapping']=$mymapping;

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$lgftofinetransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=FineTransferApprovals::where([["fine_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=FineTransferApprovals::where([["fine_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$lgftofinetransfersdata['myturn']="1";
					}else if(isset($lgftofinetransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$lgftofinetransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$lgftofinetransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$lgftofinetransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}
		

		$lgftofinetransfersdata['data']=LgfToFineTransfers::find($id);
		return view('admin.lgf_to_fine_transfers.edit',compact('lgftofinetransfersdata','id'));
		}
	}

	public function destroy($id){
		$lgftofinetransfers=LgfToFineTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToFineTransfers']])->get();
		$lgftofinetransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftofinetransfersdata['usersaccountsroles'][0]) && $lgftofinetransfersdata['usersaccountsroles'][0]['_delete']==1){
			$lgftofinetransfers->delete();
		}return redirect('admin/lgftofinetransfers')->with('success','lgf to fine transfers has been deleted!');
	}
}