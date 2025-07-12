<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (account to account transfers)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\AccountToAccountTransfers;
use App\Companies;
use App\Modules;
use App\Users;
use App\ApprovalLevels;
use Illuminate\Support\Facades\DB;
use App\EntryTypes;
use App\GeneralLedgers;
use App\Accounts;
use App\ApprovalStatuses;
use App\AccountTransferApprovals;
use App\GroupCashBooks;
use App\AccountTransferApprovalLevels;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class AccountToAccountTransfersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$accounttoaccounttransfersdata['accounts']=Accounts::all();
		$accounttoaccounttransfersdata['accounts']=Accounts::all();
		$accounttoaccounttransfersdata['users']=Users::all();
		$accounttoaccounttransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$accounttoaccounttransfersdata['list']=AccountToAccountTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountToAccountTransfers']])->get();
		$accounttoaccounttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttoaccounttransfersdata['usersaccountsroles'][0]) && $accounttoaccounttransfersdata['usersaccountsroles'][0]['_add']==0&&$accounttoaccounttransfersdata['usersaccountsroles'][0]['_list']==0&&$accounttoaccounttransfersdata['usersaccountsroles'][0]['_edit']==0&&$accounttoaccounttransfersdata['usersaccountsroles'][0]['_edit']==0&&$accounttoaccounttransfersdata['usersaccountsroles'][0]['_show']==0&&$accounttoaccounttransfersdata['usersaccountsroles'][0]['_delete']==0&&$accounttoaccounttransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accounttoaccounttransfersdata'));
		}else{
			return view('admin.account_to_account_transfers.index',compact('accounttoaccounttransfersdata'));
		}
	}

	public function create(){
		$accounttoaccounttransfersdata;
		$accounttoaccounttransfersdata['accounts']=Accounts::all();
		$accounttoaccounttransfersdata['accounts']=Accounts::all();
		$accounttoaccounttransfersdata['users']=Users::all();
		$accounttoaccounttransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountToAccountTransfers']])->get();
		$accounttoaccounttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttoaccounttransfersdata['usersaccountsroles'][0]) && $accounttoaccounttransfersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('accounttoaccounttransfersdata'));
		}else{
			return view('admin.account_to_account_transfers.create',compact('accounttoaccounttransfersdata'));
		}
	}

	public function filter(Request $request){
		$accounttoaccounttransfersdata['accounts']=Accounts::all();
		$accounttoaccounttransfersdata['accounts']=Accounts::all();
		$accounttoaccounttransfersdata['users']=Users::all();
		$accounttoaccounttransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$accounttoaccounttransfersdata['list']=AccountToAccountTransfers::where([['account_from','LIKE','%'.$request->get('account_from').'%'],['account_to','LIKE','%'.$request->get('account_to').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['initiated_by','LIKE','%'.$request->get('initiated_by').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],])->orWhereBetween('transaction_date',[$request->get('transaction_datefrom'),$request->get('transaction_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountToAccountTransfers']])->get();
		$accounttoaccounttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttoaccounttransfersdata['usersaccountsroles'][0]) && $accounttoaccounttransfersdata['usersaccountsroles'][0]['_add']==0&&$accounttoaccounttransfersdata['usersaccountsroles'][0]['_list']==0&&$accounttoaccounttransfersdata['usersaccountsroles'][0]['_edit']==0&&$accounttoaccounttransfersdata['usersaccountsroles'][0]['_edit']==0&&$accounttoaccounttransfersdata['usersaccountsroles'][0]['_show']==0&&$accounttoaccounttransfersdata['usersaccountsroles'][0]['_delete']==0&&$accounttoaccounttransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accounttoaccounttransfersdata'));
		}else{
			return view('admin.account_to_account_transfers.index',compact('accounttoaccounttransfersdata'));
		}
	}

	public function getacttoacttransactionnumber(){

		$transactionno=AccountToAccountTransfers::all()->count()+1;

		$existing=AccountToAccountTransfers::where([["transaction_number","=",$transactionno]])->get();

		while(isset($existing[0])){

			$transactionno=$transactionno+10;

			$existing=AccountToAccountTransfers::where([["transaction_number","=",$transactionno]])->get();

		}
		
		return $transactionno;
	}

	public function report(){
		$accounttoaccounttransfersdata['company']=Companies::all();
		$accounttoaccounttransfersdata['list']=AccountToAccountTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountToAccountTransfers']])->get();
		$accounttoaccounttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttoaccounttransfersdata['usersaccountsroles'][0]) && $accounttoaccounttransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('accounttoaccounttransfersdata'));
		}else{
			return view('admin.account_to_account_transfers.report',compact('accounttoaccounttransfersdata'));
		}
	}

	public function chart(){
		return view('admin.account_to_account_transfers.chart');
	}

	public function store(Request $request){
		$accounttoaccounttransfers=new AccountToAccountTransfers();
		$accounttoaccounttransfers->transaction_number=$request->get('transaction_number');
		$accounttoaccounttransfers->account_from=$request->get('account_from');
		$accounttoaccounttransfers->account_to=$request->get('account_to');
		$accounttoaccounttransfers->amount=$request->get('amount');
		$user=Users::where([['id','=',Auth::id()]])->get();		
		$accounttoaccounttransfers->initiated_by=$user[0]["id"];
		$approvalstatuses=ApprovalStatuses::where([["code","=","003"]])->get()->first();
		$accounttoaccounttransfers->approval_status=$approvalstatuses->id;
		$accounttoaccounttransfers->transaction_date=\Carbon\Carbon::parse($request->transaction_date)->toDateString();
		$response=array();
		$module=Modules::where([['name','=','AccountToAccountTransfers']])->get();
		$accounttoaccounttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttoaccounttransfersdata['usersaccountsroles'][0]) && $accounttoaccounttransfersdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($accounttoaccounttransfers->save()){
					$response['status']='1';
					$response['message']='account to account transfers Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add account to account transfers. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add account to account transfers. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$accounttoaccounttransfersdata['accounts']=Accounts::all();
		$accounttoaccounttransfersdata['accounts']=Accounts::all();
		$accounttoaccounttransfersdata['users']=Users::all();
		$accounttoaccounttransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$accounttoaccounttransfersdata['data']=AccountToAccountTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountToAccountTransfers']])->get();

		$mymapping=AccountTransferApprovalLevels::where([["user_account","=",$user[0]->user_account]])->get()->first();

		$accounttoaccounttransfersdata['mymapping']=$mymapping;

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$accounttoaccounttransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=AccountTransferApprovals::where([["account_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=AccountTransferApprovals::where([["account_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$accounttoaccounttransfersdata['myturn']="1";
					}else if(isset($accounttoaccounttransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$accounttoaccounttransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$accounttoaccounttransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$accounttoaccounttransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}

		$accounttoaccounttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttoaccounttransfersdata['usersaccountsroles'][0]) && $accounttoaccounttransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('accounttoaccounttransfersdata'));
		}else{
		return view('admin.account_to_account_transfers.edit',compact('accounttoaccounttransfersdata','id'));
		}
	}

	public function show($id){
		$accounttoaccounttransfersdata['accounts']=Accounts::all();
		$accounttoaccounttransfersdata['accounts']=Accounts::all();
		$accounttoaccounttransfersdata['users']=Users::all();
		$accounttoaccounttransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$accounttoaccounttransfersdata['data']=AccountToAccountTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountToAccountTransfers']])->get();
		$accounttoaccounttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttoaccounttransfersdata['usersaccountsroles'][0]) && $accounttoaccounttransfersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('accounttoaccounttransfersdata'));
		}else{
		return view('admin.account_to_account_transfers.show',compact('accounttoaccounttransfersdata','id'));
		}
	}

	public function update(Request $request,$id){
		$accounttoaccounttransfers=AccountToAccountTransfers::find($id);
		$accounttoaccounttransfersdata['accounts']=Accounts::all();
		$accounttoaccounttransfersdata['accounts']=Accounts::all();
		$accounttoaccounttransfersdata['users']=Users::all();
		$accounttoaccounttransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountToAccountTransfers']])->get();
		$accounttoaccounttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($accounttoaccounttransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('accounttoaccounttransfersdata'));
		}else{

			$mymapping=AccountTransferApprovalLevels::where([["user_account","=",$user[0]->user_account]])->get()->first();			
			if($accounttoaccounttransfers->approvalstatusmodel->code=="003"){
				DB::transaction(function() use($request,$user,$id,$mymapping,$accounttoaccounttransfers,$accounttoaccounttransfersdata){
					try{

						$mappings=AccountTransferApprovalLevels::all();

						$maxapprovallevel=0;

						for($r=0;$r<count($mappings);$r++){

							$maxapprovallevel=$mappings[$r]->approvallevelmodel->approval_level>$maxapprovallevel?$mappings[$r]->approvallevelmodel->approval_level:$maxapprovallevel;
						}

						$rejeted=ApprovalStatuses::where([["code","=","002"]])->get()->first();

						if($maxapprovallevel==$mymapping->approvallevelmodel->approval_level || $rejeted->id==$request->get('approval_status')){

							$accounttoaccounttransfers->approval_status=$request->get('approval_status');

							$accounttoaccounttransfers->save();

							$approved=ApprovalStatuses::where([["code","=","001"]])->get()->first();

							if($approved->id==$accounttoaccounttransfers->approval_status){

								$accounttransferapprvoals=new AccountTransferApprovals();
								$accounttransferapprvoals->account_transfer=$id;
								$accounttransferapprvoals->approval_level=$mymapping->approval_level;
								$accounttransferapprvoals->approved_by=$user[0]->id;
								$accounttransferapprvoals->user_account=$user[0]->user_account;
								$accounttransferapprvoals->remarks=$request->get('remarks');
								$accounttransferapprvoals->approval_status=$request->get('approval_status');
								$accounttransferapprvoals->save();


								$debit=EntryTypes::where([['code','=','001']])->get();
								$credit=EntryTypes::where([['code','=','002']])->get();	


								$generalLedger=new GeneralLedgers();
								$generalLedger->account=$accounttoaccounttransfers->account_from;
								$generalLedger->entry_type=$credit[0]['id'];
								$generalLedger->transaction_number=$accounttoaccounttransfers->transaction_number;
								$generalLedger->secondary_description="Account to account transfer";					
								$generalLedger->amount=$accounttoaccounttransfers->amount;
								$generalLedger->date=date('m/d/Y');
								$generalLedger->save();


								$generalLedger=new GeneralLedgers();
								$generalLedger->account=$accounttoaccounttransfers->account_to;
								$generalLedger->entry_type=$debit[0]['id'];
								$generalLedger->transaction_number=$accounttoaccounttransfers->transaction_number;
								$generalLedger->secondary_description="Account to account transfer";					
								$generalLedger->amount=$accounttoaccounttransfers->amount;
								$generalLedger->date=date('m/d/Y');
								$generalLedger->save();	

								$groupcashbook=new GroupCashBooks();

								$groupcashbook->transaction_id= $accounttoaccounttransfers->transaction_number;
								$groupcashbook->transaction_reference=$accounttoaccounttransfers->transaction_number;
								$groupcashbook->transaction_date=date('m/d/Y');
								$groupcashbook->transaction_type=2;
								$groupcashbook->transacting_group=null;
								$groupcashbook->amount=$accounttoaccounttransfers->amount;
								$groupcashbook->lgf=0;
								$groupcashbook->account=$accounttoaccounttransfers->account_to;
								$groupcashbook->loan_principal=0;
								$groupcashbook->loan_interest=0;
								$groupcashbook->mpesa_charges=0;
								$groupcashbook->fine=0;
								$groupcashbook->processing_fees=0;
								$groupcashbook->insurance_deduction_fees=0;
								$groupcashbook->collecting_officer=$user[0]->name;
								$groupcashbook->clearing_fees=0;
								$groupcashbook->particulars=" Account to account transfer";
								
								$groupcashbook->save();
	
								$groupcashbook2=new GroupCashBooks();
	
								$groupcashbook2->transaction_id= $accounttoaccounttransfers->transaction_number;
								$groupcashbook2->transaction_reference=$accounttoaccounttransfers->transaction_number;
								$groupcashbook2->transaction_date=date('m/d/Y');
								$groupcashbook2->transaction_type=1;
								$groupcashbook2->transacting_group=null;
								$groupcashbook2->amount=$accounttoaccounttransfers->amount;
								$groupcashbook2->lgf=0;
								$groupcashbook2->account=$accounttoaccounttransfers->account_from;
								$groupcashbook2->loan_principal=0;
								$groupcashbook2->loan_interest=0;
								$groupcashbook2->mpesa_charges=0;
								$groupcashbook2->fine=0;
								$groupcashbook2->processing_fees=0;
								$groupcashbook2->insurance_deduction_fees=0;
								$groupcashbook2->collecting_officer=$user[0]->name;
								$groupcashbook2->clearing_fees=0;
								$groupcashbook2->particulars=" Account to account transfer";
								
								$groupcashbook2->save();
	
							}							
						}											

					}catch(Exception $e){

					}
				});			
			}

		$accounttoaccounttransfersdata['mymapping']=$mymapping;

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$accounttoaccounttransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=AccountTransferApprovals::where([["account_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=AccountTransferApprovals::where([["account_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$accounttoaccounttransfersdata['myturn']="1";
					}else if(isset($accounttoaccounttransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$accounttoaccounttransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$accounttoaccounttransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$accounttoaccounttransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}			

		$accounttoaccounttransfersdata['data']=AccountToAccountTransfers::find($id);
		return view('admin.account_to_account_transfers.edit',compact('accounttoaccounttransfersdata','id'));
		}
	}

	public function destroy($id){
		$accounttoaccounttransfers=AccountToAccountTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','AccountToAccountTransfers']])->get();
		$accounttoaccounttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($accounttoaccounttransfersdata['usersaccountsroles'][0]) && $accounttoaccounttransfersdata['usersaccountsroles'][0]['_delete']==1){
			$accounttoaccounttransfers->delete();
		}return redirect('admin/accounttoaccounttransfers')->with('success','account to account transfers has been deleted!');
	}
}