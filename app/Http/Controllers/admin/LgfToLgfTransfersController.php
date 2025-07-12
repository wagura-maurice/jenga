<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (lgf to lgf transfers)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LgfToLgfTransfers;
use App\Companies;
use App\Modules;
use App\Clients;
use Illuminate\Support\Facades\DB;
use App\LgfTransferApprovals;
use App\Users;
use App\ClientLgfBalances;
use App\EntryTypes;
use App\ClientLgfContributions;
use App\TransactionStatuses;
use App\PaymentModes;
use App\LgfContributionConfigurations;
use App\GeneralLedgers;
use App\LgfTransferApprovalLevels;
use App\GroupCashBooks;
use App\ApprovalLevels;
use App\ApprovalStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LgfToLgfTransfersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$lgftolgftransfersdata['clients']=Clients::all();
		$lgftolgftransfersdata['clients']=Clients::all();
		$lgftolgftransfersdata["users"]=Users::all();
		$lgftolgftransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftolgftransfersdata['list']=LgfToLgfTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLgfTransfers']])->get();
		$lgftolgftransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftolgftransfersdata['usersaccountsroles'][0]) && $lgftolgftransfersdata['usersaccountsroles'][0]['_add']==0&&$lgftolgftransfersdata['usersaccountsroles'][0]['_list']==0&&$lgftolgftransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftolgftransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftolgftransfersdata['usersaccountsroles'][0]['_show']==0&&$lgftolgftransfersdata['usersaccountsroles'][0]['_delete']==0&&$lgftolgftransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftolgftransfersdata'));
		}else{
			return view('admin.lgf_to_lgf_transfers.index',compact('lgftolgftransfersdata'));
		}
	}

	public function create(){
		$lgftolgftransfersdata;
		$lgftolgftransfersdata['clients']=Clients::all();
		$lgftolgftransfersdata['clients']=Clients::all();
		$lgftolgftransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLgfTransfers']])->get();
		$lgftolgftransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftolgftransfersdata['usersaccountsroles'][0]) && $lgftolgftransfersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('lgftolgftransfersdata'));
		}else{
			return view('admin.lgf_to_lgf_transfers.create',compact('lgftolgftransfersdata'));
		}
	}

	public function filter(Request $request){
		$lgftolgftransfersdata['clients']=Clients::all();
		$lgftolgftransfersdata['clients']=Clients::all();
		$lgftolgftransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftolgftransfersdata['list']=LgfToLgfTransfers::where([['client_from','LIKE','%'.$request->get('client_from').'%'],['client_to','LIKE','%'.$request->get('client_to').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['transacted_by','LIKE','%'.$request->get('transacted_by').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],])->orWhereBetween('transaction_date',[$request->get('transaction_datefrom'),$request->get('transaction_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLgfTransfers']])->get();
		$lgftolgftransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftolgftransfersdata['usersaccountsroles'][0]) && $lgftolgftransfersdata['usersaccountsroles'][0]['_add']==0&&$lgftolgftransfersdata['usersaccountsroles'][0]['_list']==0&&$lgftolgftransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftolgftransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftolgftransfersdata['usersaccountsroles'][0]['_show']==0&&$lgftolgftransfersdata['usersaccountsroles'][0]['_delete']==0&&$lgftolgftransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftolgftransfersdata'));
		}else{
			return view('admin.lgf_to_lgf_transfers.index',compact('lgftolgftransfersdata'));
		}
	}

	public function report(){
		$lgftolgftransfersdata['company']=Companies::all();
		$lgftolgftransfersdata['list']=LgfToLgfTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLgfTransfers']])->get();
		$lgftolgftransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftolgftransfersdata['usersaccountsroles'][0]) && $lgftolgftransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftolgftransfersdata'));
		}else{
			return view('admin.lgf_to_lgf_transfers.report',compact('lgftolgftransfersdata'));
		}
	}

	public function chart(){
		return view('admin.lgf_to_lgf_transfers.chart');
	}

	public function getlgftolgftransactionnumber(){
		return LgfToLgfTransfers::all()->count()+1;
	}

	public function store(Request $request){
		$lgftolgftransfers=new LgfToLgfTransfers();
		$lgftolgftransfers->transaction_number=$request->get('transaction_number');
		$lgftolgftransfers->client_from=$request->get('client_from');
		$lgftolgftransfers->client_to=$request->get('client_to');
		$lgftolgftransfers->amount=$request->get('amount');
		$lgftolgftransfers->transaction_date=\Carbon\Carbon::parse($request->transaction_date)->toDateString();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$lgftolgftransfers->transacted_by=$user[0]["id"];
		$approvalstatuses=ApprovalStatuses::where([["code","=","003"]])->get()->first();
		$lgftolgftransfers->approval_status=$approvalstatuses->id;
		$response=array();
		$module=Modules::where([['name','=','LgfToLgfTransfers']])->get();
		$lgftolgftransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftolgftransfersdata['usersaccountsroles'][0]) && $lgftolgftransfersdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($lgftolgftransfers->save()){
					$response['status']='1';
					$response['message']='lgf to lgf transfers Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add lgf to lgf transfers. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add lgf to lgf transfers. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$lgftolgftransfersdata['clients']=Clients::all();
		$lgftolgftransfersdata['clients']=Clients::all();
		$lgftolgftransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftolgftransfersdata['approvallevels']=Approvallevels::all();
		$lgftolgftransfersdata['data']=LgfToLgfTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();

		$mymapping=LgfTransferApprovalLevels::where([["client_type","=",$lgftolgftransfersdata['data']->clientfrommodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();

		$lgftolgftransfersdata['mymapping']=$mymapping;

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$lgftolgftransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=LgfTransferApprovals::where([["lgf_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=LgfTransferApprovals::where([["lgf_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$lgftolgftransfersdata['myturn']="1";
					}else if(isset($lgftolgftransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$lgftolgftransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$lgftolgftransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$lgftolgftransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}

		$module=Modules::where([['name','=','LgfToLgfTransfers']])->get();
		$lgftolgftransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftolgftransfersdata['usersaccountsroles'][0]) && $lgftolgftransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftolgftransfersdata'));
		}else{
		return view('admin.lgf_to_lgf_transfers.edit',compact('lgftolgftransfersdata','id'));
		}
	}

	public function show($id){
		$lgftolgftransfersdata['clients']=Clients::all();
		$lgftolgftransfersdata['clients']=Clients::all();
		$lgftolgftransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftolgftransfersdata['data']=LgfToLgfTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLgfTransfers']])->get();

		$lgftolgftransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftolgftransfersdata['usersaccountsroles'][0]) && $lgftolgftransfersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('lgftolgftransfersdata'));
		}else{
		return view('admin.lgf_to_lgf_transfers.show',compact('lgftolgftransfersdata','id'));
		}
	}

	public function update(Request $request,$id){

		$lgftolgftransfers=LgfToLgfTransfers::find($id);
		$lgftolgftransfersdata['clients']=Clients::all();
		$lgftolgftransfersdata['clients']=Clients::all();
		$lgftolgftransfersdata['approvallevels']=Approvallevels::all();
		$lgftolgftransfersdata['approvalstatuses']=ApprovalStatuses::all();

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLgfTransfers']])->get();

		$lgftolgftransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();

		if($lgftolgftransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftolgftransfersdata'));
		}else{

		$mymapping=LgfTransferApprovalLevels::where([["client_type","=",$lgftolgftransfers->clientfrommodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();			

		if($lgftolgftransfers->approvalstatusmodel->code=="003"){
			DB::transaction(function() use($request,$user,$id,$mymapping,$lgftolgftransfers,$lgftolgftransfersdata){
				try{


					$lgftransferapprovals=new LgfTransferApprovals();
					$lgftransferapprovals->lgf_transfer=$id;
					$lgftransferapprovals->approval_level=$mymapping->approval_level;
					$lgftransferapprovals->approved_by=$user[0]->id;
					$lgftransferapprovals->user_account=$user[0]->user_account;
					$lgftransferapprovals->remarks=$request->get('remarks');
					$lgftransferapprovals->approval_status=$request->get('approval_status');
					$lgftransferapprovals->save();

					$mappings=LgfTransferApprovalLevels::where([["client_type","=",$lgftolgftransfers->clientfrommodel->client_type]])->get();

					$maxapprovallevel=0;

					for($r=0;$r<count($mappings);$r++){

						$maxapprovallevel=$mappings[$r]->approvallevelmodel->approval_level>$maxapprovallevel?$mappings[$r]->approvallevelmodel->approval_level:$maxapprovallevel;
					}

					$rejeted=ApprovalStatuses::where([["code","=","002"]])->get()->first();

					if($maxapprovallevel==$mymapping->approvallevelmodel->approval_level || $rejeted->id==$request->get('approval_status')){

						$lgftolgftransfers->approval_status=$request->get('approval_status');

						$lgftolgftransfers->save();

						$approved=ApprovalStatuses::where([["code","=","001"]])->get()->first();

						if($approved->id==$lgftolgftransfers->approval_status){

							$clientfromlgfbalance=ClientLgfBalances::where([["client","=",$lgftolgftransfers->client_from]])->get()->first();

							$clientfromlgfbalance->balance=$clientfromlgfbalance->balance-$lgftolgftransfers->amount;

							$clientfromlgfbalance->save();

							$clienttolgfbalance=ClientLgfBalances::where([["client","=",$lgftolgftransfers->client_to]])->get()->first();	

							if(!isset($clienttolgfbalance)){

								$clienttolgfbalance=new ClientLgfBalances();

								$clienttolgfbalance->client=$lgftolgftransfers->client_to;

								$clienttolgfbalance->balance=$clienttolgfbalance->balance+$lgftolgftransfers->amount;

								$clienttolgfbalance->save();

							}else{

								$clienttolgfbalance->balance=$clienttolgfbalance->balance+$lgftolgftransfers->amount;

								$clienttolgfbalance->save();

							}

							$approvedtransaction=TransactionStatuses::where([["code","=","002"]])->get()->first();

							$clientlgfcontributions=new ClientLgfContributions();
							$clientlgfcontributions->client=$lgftolgftransfers->client_to;
							$clientlgfcontributions->date=date('m/d/Y');
							$clientlgfcontributions->transaction_number=$lgftolgftransfers->transaction_number;
							$clientlgfcontributions->amount=$lgftolgftransfers->amount;
							$clientlgfcontributions->transaction_status=$approvedtransaction->id;
							$clientlgfcontributions->save();


							$paymentmode=PaymentModes::where([["code","=","000"]])->get()->first();

					        $accounts=LgfContributionConfigurations::where([["client_type","=",$lgftolgftransfers->clientfrommodel->clienttypemodel->id],["payment_mode","=",$paymentmode->id]])->get()->first();

					        $debitAccount=$accounts->debit_account;
					        $creditAccount=$accounts->credit_account;
		    			    
		    			    $debit=EntryTypes::where([['code','=','001']])->get()->first();
		    		        $credit=EntryTypes::where([['code','=','002']])->get()->first();
		    
		        			$generalLedger=new GeneralLedgers();
		        			$generalLedger->account=$debitAccount;
		        			$generalLedger->entry_type=$debit->id;
		        			$generalLedger->transaction_number=$lgftolgftransfers->transaction_number;
		        			$generalLedger->primary_description="lgf to lgf transfer";
		        			$generalLedger->secondary_description="transfer from ".$lgftolgftransfers->clientfrommodel->client_number." to ".$lgftolgftransfers->clienttomodel->client_number;
		        			$generalLedger->amount=$lgftolgftransfers->amount;
		        			$generalLedger->date=date('m/d/Y');
		        			$generalLedger->save();
		        			
		        			$generalLedger=new GeneralLedgers();
		        			$generalLedger->account=$creditAccount;
		        			$generalLedger->entry_type=$credit->id;
		        			$generalLedger->primary_description="lgf to lgf transfer";
		        			$generalLedger->secondary_description="transfer from ".$lgftolgftransfers->clientfrommodel->client_number." to ".$lgftolgftransfers->clienttomodel->client_number;	        			
		        			$generalLedger->transaction_number=$lgftolgftransfers->transaction_number;
		        			$generalLedger->amount=$lgftolgftransfers->amount;
		        			$generalLedger->date=date('m/d/Y');
							$generalLedger->save();	
							
							$groupcashbook=new GroupCashBooks();

							$groupcashbook->transaction_id= $lgftolgftransfers->transaction_number;
							$groupcashbook->transaction_reference=$lgftolgftransfers->transaction_number;
							$groupcashbook->transaction_date=$lgftolgftransfers->transaction_date;
							$groupcashbook->transaction_type=2;
							$groupcashbook->transacting_group=null;
							$groupcashbook->amount=$lgftolgftransfers->amount;
							$groupcashbook->payment_mode=$paymentmode->id;
							$groupcashbook->lgf=0;
							$groupcashbook->account=$debit->id;
							$groupcashbook->loan_principal=0;
							$groupcashbook->loan_interest=0;
							$groupcashbook->mpesa_charges=0;
							$groupcashbook->fine=0;
							$groupcashbook->processing_fees=0;
							$groupcashbook->insurance_deduction_fees=0;
							$groupcashbook->collecting_officer=$user[0]->name;
							$groupcashbook->clearing_fees=0;
							$groupcashbook->particulars=$lgftolgftransfers->clientfrommodel->first_name." ".$lgftolgftransfers->clientfrommodel->middle_name." ".$lgftolgftransfers->clientfrommodel->last_name." lgf to lgf";
							
							$groupcashbook->save();		
						
							$groupcashbook2=new GroupCashBooks();

							$groupcashbook2->transaction_id= $lgftolgftransfers->transaction_number;
							$groupcashbook2->transaction_reference=$lgftolgftransfers->transaction_number;
							$groupcashbook2->transaction_date=$lgftolgftransfers->transaction_date;
							$groupcashbook2->transaction_type=1;
							$groupcashbook2->transacting_group=null;
							$groupcashbook2->amount=$lgftolgftransfers->amount;
							$groupcashbook2->payment_mode=$paymentmode->id;
							$groupcashbook2->lgf=0;
							$groupcashbook2->account=$credit->id;
							$groupcashbook2->loan_principal=0;
							$groupcashbook2->loan_interest=0;
							$groupcashbook2->mpesa_charges=0;
							$groupcashbook2->fine=0;
							$groupcashbook2->processing_fees=0;
							$groupcashbook2->insurance_deduction_fees=0;
							$groupcashbook2->collecting_officer=$user[0]->name;
							$groupcashbook2->clearing_fees=0;
							$groupcashbook2->particulars=$lgftolgftransfers->clientfrommodel->first_name." ".$lgftolgftransfers->clientfrommodel->middle_name." ".$lgftolgftransfers->clientfrommodel->last_name." lgf to lgf";
							
							$groupcashbook2->save();		
							

						}
					}

				}catch(Exception $e){

				}
			});			
		}	

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$lgftolgftransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=LgfTransferApprovals::where([["lgf_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=LgfTransferApprovals::where([["lgf_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$lgftolgftransfersdata['myturn']="1";
					}else if(isset($lgftolgftransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$lgftolgftransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$lgftolgftransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$lgftolgftransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}				
		
		$lgftolgftransfersdata['data']=LgfToLgfTransfers::find($id);
		return view('admin.lgf_to_lgf_transfers.edit',compact('lgftolgftransfersdata','id'));
		}
	}

	public function destroy($id){
		$lgftolgftransfers=LgfToLgfTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToLgfTransfers']])->get();
		$lgftolgftransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftolgftransfersdata['usersaccountsroles'][0]) && $lgftolgftransfersdata['usersaccountsroles'][0]['_delete']==1){
			$lgftolgftransfers->delete();
		}return redirect('admin/lgftolgftransfers')->with('success','lgf to lgf transfers has been deleted!');
	}
}
