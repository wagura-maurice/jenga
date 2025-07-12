<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (lgf to inventory transfers)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LgfToInventoryTransfers;
use App\Companies;
use App\Modules;
use App\Clients;
use App\ClientLgfBalances;
use App\GroupCashBooks;
use App\GeneralLedgers;
use App\ProductStocks;
use App\PurchaseOrderLines;
use App\PurchaseOrderAccountMappings;
use App\EntryTypes;
use App\PaymentModes;
use App\PurchaseOrderPayments;
use App\PurchaseOrders;
use App\InventoryTransferApprovalLevels;
use App\InventoryTransferApprovals;
use App\Users;
use App\ApprovalLevels;
use App\OrderStatuses;
use App\ApprovalStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\UsersAccountsRoles;
class LgfToInventoryTransfersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$lgftoinventorytransfersdata['clients']=Clients::all();
		$lgftoinventorytransfersdata['purchaseorders']=PurchaseOrders::all();
		$lgftoinventorytransfersdata['users']=Users::all();
		$lgftoinventorytransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftoinventorytransfersdata['list']=LgfToInventoryTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToInventoryTransfers']])->get();
		$lgftoinventorytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoinventorytransfersdata['usersaccountsroles'][0]) && $lgftoinventorytransfersdata['usersaccountsroles'][0]['_add']==0&&$lgftoinventorytransfersdata['usersaccountsroles'][0]['_list']==0&&$lgftoinventorytransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftoinventorytransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftoinventorytransfersdata['usersaccountsroles'][0]['_show']==0&&$lgftoinventorytransfersdata['usersaccountsroles'][0]['_delete']==0&&$lgftoinventorytransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftoinventorytransfersdata'));
		}else{
			return view('admin.lgf_to_inventory_transfers.index',compact('lgftoinventorytransfersdata'));
		}
	}

	public function create(){
		$lgftoinventorytransfersdata;
		$lgftoinventorytransfersdata['clients']=Clients::all();
		$orderstatus=OrderStatuses::where([["code","=","0001"]])->get()->first();
		$lgftoinventorytransfersdata['purchaseorders']=PurchaseOrders::where([["order_status","=",$orderstatus->id]])->get();
		$lgftoinventorytransfersdata['users']=Users::all();
		$lgftoinventorytransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToInventoryTransfers']])->get();
		$lgftoinventorytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoinventorytransfersdata['usersaccountsroles'][0]) && $lgftoinventorytransfersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('lgftoinventorytransfersdata'));
		}else{
			return view('admin.lgf_to_inventory_transfers.create',compact('lgftoinventorytransfersdata'));
		}
	}

	public function filter(Request $request){
		$lgftoinventorytransfersdata['clients']=Clients::all();
		$lgftoinventorytransfersdata['purchaseorders']=PurchaseOrders::all();
		$lgftoinventorytransfersdata['users']=Users::all();
		$lgftoinventorytransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftoinventorytransfersdata['list']=LgfToInventoryTransfers::where([['transaction_number','LIKE','%'.$request->get('transaction_number').'%'],['client','LIKE','%'.$request->get('client').'%'],['purchase_order','LIKE','%'.$request->get('purchase_order').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['initiated_by','LIKE','%'.$request->get('initiated_by').'%'],['approval_status','LIKE','%'.$request->get('approval_status').'%'],])->orWhereBetween('transaction_date',[$request->get('transaction_datefrom'),$request->get('transaction_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToInventoryTransfers']])->get();
		$lgftoinventorytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoinventorytransfersdata['usersaccountsroles'][0]) && $lgftoinventorytransfersdata['usersaccountsroles'][0]['_add']==0&&$lgftoinventorytransfersdata['usersaccountsroles'][0]['_list']==0&&$lgftoinventorytransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftoinventorytransfersdata['usersaccountsroles'][0]['_edit']==0&&$lgftoinventorytransfersdata['usersaccountsroles'][0]['_show']==0&&$lgftoinventorytransfersdata['usersaccountsroles'][0]['_delete']==0&&$lgftoinventorytransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftoinventorytransfersdata'));
		}else{
			return view('admin.lgf_to_inventory_transfers.index',compact('lgftoinventorytransfersdata'));
		}
	}

	public function report(){
		$lgftoinventorytransfersdata['company']=Companies::all();
		$lgftoinventorytransfersdata['list']=LgfToInventoryTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToInventoryTransfers']])->get();
		$lgftoinventorytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoinventorytransfersdata['usersaccountsroles'][0]) && $lgftoinventorytransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('lgftoinventorytransfersdata'));
		}else{
			return view('admin.lgf_to_inventory_transfers.report',compact('lgftoinventorytransfersdata'));
		}
	}

	public function chart(){
		return view('admin.lgf_to_inventory_transfers.chart');
	}

	public function store(Request $request){
		$lgftoinventorytransfers=new LgfToInventoryTransfers();
		$lgftoinventorytransfers->transaction_number=$request->get('transaction_number');
		$lgftoinventorytransfers->client=$request->get('client');
		$lgftoinventorytransfers->purchase_order=$request->get('purchase_order');
		$lgftoinventorytransfers->amount=$request->get('amount');
		$lgftoinventorytransfers->initiated_by=$request->get('initiated_by');
		$lgftoinventorytransfers->transaction_date=\Carbon\Carbon::parse($request->transaction_date)->toDateString();
		$lgftoinventorytransfers->approval_status=$request->get('approval_status');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$lgftoinventorytransfers->initiated_by=$user[0]["id"];
		$approvalstatuses=ApprovalStatuses::where([["code","=","003"]])->get()->first();
		$lgftoinventorytransfers->approval_status=$approvalstatuses->id;		
		$module=Modules::where([['name','=','LgfToInventoryTransfers']])->get();
		$lgftoinventorytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoinventorytransfersdata['usersaccountsroles'][0]) && $lgftoinventorytransfersdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($lgftoinventorytransfers->save()){
					$response['status']='1';
					$response['message']='lgf to inventory transfers Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add lgf to inventory transfers. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add lgf to inventory transfers. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$lgftoinventorytransfersdata['clients']=Clients::all();
		$orderstatus=OrderStatuses::where([["code","=","0001"]])->get()->first();
		$lgftoinventorytransfersdata['purchaseorders']=PurchaseOrders::where([["order_status","=",$orderstatus->id]])->get();
		$lgftoinventorytransfersdata['users']=Users::all();
		$lgftoinventorytransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftoinventorytransfersdata['data']=LgfToInventoryTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToInventoryTransfers']])->get();

		$mymapping=InventoryTransferApprovalLevels::where([["client_type","=",$lgftoinventorytransfersdata['data']->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();

		$lgftoinventorytransfersdata['mymapping']=$mymapping;

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$lgftoinventorytransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=InventoryTransferApprovals::where([["inventory_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=InventoryTransferApprovals::where([["inventory_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$lgftoinventorytransfersdata['myturn']="1";
					}else if(isset($lgftoinventorytransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$lgftoinventorytransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$lgftoinventorytransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$lgftoinventorytransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}

		$lgftoinventorytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoinventorytransfersdata['usersaccountsroles'][0]) && $lgftoinventorytransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftoinventorytransfersdata'));
		}else{
		return view('admin.lgf_to_inventory_transfers.edit',compact('lgftoinventorytransfersdata','id'));
		}
	}

	public function show($id){
		$lgftoinventorytransfersdata['clients']=Clients::all();
		$lgftoinventorytransfersdata['purchaseorders']=PurchaseOrders::all();
		$lgftoinventorytransfersdata['users']=Users::all();
		$lgftoinventorytransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$lgftoinventorytransfersdata['data']=LgfToInventoryTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToInventoryTransfers']])->get();
		$lgftoinventorytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoinventorytransfersdata['usersaccountsroles'][0]) && $lgftoinventorytransfersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('lgftoinventorytransfersdata'));
		}else{
		return view('admin.lgf_to_inventory_transfers.show',compact('lgftoinventorytransfersdata','id'));
		}
	}

	public function update(Request $request,$id){
		$lgftoinventorytransfers=LgfToInventoryTransfers::find($id);
		$lgftoinventorytransfersdata['clients']=Clients::all();
		$orderstatus=OrderStatuses::where([["code","=","0001"]])->get()->first();
		$lgftoinventorytransfersdata['purchaseorders']=PurchaseOrders::where([["order_status","=",$orderstatus->id]])->get();
		$lgftoinventorytransfersdata['users']=Users::all();
		$lgftoinventorytransfersdata['approvalstatuses']=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToInventoryTransfers']])->get();
		$lgftoinventorytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($lgftoinventorytransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('lgftoinventorytransfersdata'));
		}else{

		$mymapping=InventoryTransferApprovalLevels::where([["client_type","=",$lgftoinventorytransfers->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();			

		if($lgftoinventorytransfers->approvalstatusmodel->code=="003"){
			DB::transaction(function() use($request,$user,$id,$mymapping,$lgftoinventorytransfers,$lgftoinventorytransfersdata){
				try{

					$inventorytransferapprovals=new InventoryTransferApprovals();
					$inventorytransferapprovals->inventory_transfer=$id;
					$inventorytransferapprovals->approval_level=$mymapping->approval_level;
					$inventorytransferapprovals->approved_by=$user[0]->id;
					$inventorytransferapprovals->user_account=$user[0]->user_account;
					$inventorytransferapprovals->remarks=$request->get('remarks');
					$inventorytransferapprovals->approval_status=$request->get('approval_status');
					$inventorytransferapprovals->save();

					$mappings=InventoryTransferApprovalLevels::where([["client_type","=",$lgftoinventorytransfers->clientmodel->client_type]])->get();

					$maxapprovallevel=0;

					for($r=0;$r<count($mappings);$r++){

						$maxapprovallevel=$mappings[$r]->approvallevelmodel->approval_level>$maxapprovallevel?$mappings[$r]->approvallevelmodel->approval_level:$maxapprovallevel;
					}

					$rejeted=ApprovalStatuses::where([["code","=","002"]])->get()->first();

					if($maxapprovallevel==$mymapping->approvallevelmodel->approval_level || $rejeted->id==$request->get('approval_status')){

						$lgftoinventorytransfers->approval_status=$request->get('approval_status');

						$lgftoinventorytransfers->save();

						$approved=ApprovalStatuses::where([["code","=","001"]])->get()->first();

						if($approved->id==$lgftoinventorytransfers->approval_status){
							
							$clientfromlgfbalance=ClientLgfBalances::where([["client","=",$lgftoinventorytransfers->client]])->get()->first();

							$clientfromlgfbalance->balance=$clientfromlgfbalance->balance-$lgftoinventorytransfers->amount;

							$clientfromlgfbalance->save();

							$paymentmode=PaymentModes::where([["code","=","000"]])->get()->first();

							$purhcaseorderpayments=new PurchaseOrderPayments();

							$purhcaseorderpayments->purchase_order=$lgftoinventorytransfers->purchase_order;
							$purhcaseorderpayments->payment_mode=$paymentmode->id;
							$purhcaseorderpayments->amount=$lgftoinventorytransfers->amount;
							$purhcaseorderpayments->payment_date=date('m/d/Y');
							$purhcaseorderpayments->reference=$lgftoinventorytransfers->transaction_number;
							$purhcaseorderpayments->save();

							$purchaseorder=PurchaseOrders::where([["id","=",$lgftoinventorytransfers->purchase_order]])->get()->first();

							$orderstatus=OrderStatuses::where([['code','=','0002']])->get()->first();

							$purchaseorder->order_status=$orderstatus->id;

							$purchaseorder->save();

							$purchaseorderlines=PurchaseOrderLines::where([["purchase_order","=",$id]])->get();

							for($r=0;$r<count($purchaseorderlines);$r++){

								$productstocks=ProductStocks::where([["product","=",$purchaseorderlines[$r]->product],["store","=",$purchaseorder->store]])->get()->first();

								if(!isset($productstocks)){

									$productstocks=new ProductStocks();	
									$productstocks->product=$purchaseorderlines[$r]->product;
									$productstocks->size=$purchaseorderlines[$r]->quantity;
									$productstocks->store=$purchaseorder->store;
									$productstocks->save();				
								}else{
									$productstocks->size=$productstocks->size+$purchaseorderlines[$r]->quantity;
									$productstocks->save();
								}

								$purchaseorderaccountmapping=PurchaseOrderAccountMappings::where([["product","=",$purchaseorderlines[$r]->product],["payment_mode","=",$request->get("payment_mode")]])->get()->first();

						        $debitAccount=$purchaseorderaccountmapping->debit_account;
			    			    $creditAccount=$purchaseorderaccountmapping->credit_account;
			    			    
			    			    $debit=EntryTypes::where([['code','=','001']])->get()->first();
			    		        $credit=EntryTypes::where([['code','=','002']])->get()->first();
			    
			        			$generalLedger=new GeneralLedgers();
			        			$generalLedger->account=$debitAccount;
			        			$generalLedger->entry_type=$debit->id;
			        			$generalLedger->transaction_number=$request->get('reference');
			        			$generalLedger->amount=$purchaseorderlines[$r]->total_price;
			        			$generalLedger->date=$request->get('payment_date');
			        			$generalLedger->save();
			        			
			        			$generalLedger=new GeneralLedgers();
			        			$generalLedger->account=$creditAccount;
			        			$generalLedger->entry_type=$credit->id;
			        			$generalLedger->transaction_number=$request->get('reference');
			        			$generalLedger->amount=$purchaseorderlines[$r]->total_price;
			        			$generalLedger->date=$request->get('payment_date');
								$generalLedger->save();	
								
								
								$groupcashbook=new GroupCashBooks();

								$groupcashbook->transaction_id= $lgftoinventorytransfers->transaction_number;
								$groupcashbook->transaction_reference=$lgftoinventorytransfers->transaction_number;
								$groupcashbook->transaction_date=$lgftoinventorytransfers->transaction_date;
								$groupcashbook->transaction_type=2;
								$groupcashbook->transacting_group=null;
								$groupcashbook->amount=$lgftoinventorytransfers->amount;
								$groupcashbook->payment_mode=$request->get("payment_mode");
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
								$groupcashbook->particulars=$lgftoinventorytransfers->clientmodel->first_name." ".$lgftoinventorytransfers->clientmodel->middle_name." ".$lgftoinventorytransfers->clientmodel->last_name." lgf to inventory";
								
								$groupcashbook->save();				
	
								
								$groupcashbook2=new GroupCashBooks();

								$groupcashbook2->transaction_id= $lgftoinventorytransfers->transaction_number;
								$groupcashbook2->transaction_reference=$lgftoinventorytransfers->transaction_number;
								$groupcashbook2->transaction_date=$lgftoinventorytransfers->transaction_date;
								$groupcashbook2->transaction_type=1;
								$groupcashbook2->transacting_group=null;
								$groupcashbook2->amount=$lgftoinventorytransfers->amount;
								$groupcashbook2->payment_mode=$request->get("payment_mode");
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
								$groupcashbook2->particulars=$lgftoinventorytransfers->clientmodel->first_name." ".$lgftoinventorytransfers->clientmodel->middle_name." ".$lgftoinventorytransfers->clientmodel->last_name." lgf to inventory";
								
								$groupcashbook2->save();				


							}

						}
											
					}

				}catch(Exception $e){

				}
			});			
		}	


		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$lgftoinventorytransfersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=InventoryTransferApprovals::where([["inventory_transfer","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=InventoryTransferApprovals::where([["inventory_transfer","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$lgftoinventorytransfersdata['myturn']="1";
					}else if(isset($lgftoinventorytransfersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$lgftoinventorytransfersdata['myturn']="1";
					}else if(isset($myapproval)){
						$lgftoinventorytransfersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$lgftoinventorytransfersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}

		$lgftoinventorytransfersdata['data']=LgfToInventoryTransfers::find($id);
		return view('admin.lgf_to_inventory_transfers.edit',compact('lgftoinventorytransfersdata','id'));
		}
	}

	public function destroy($id){
		$lgftoinventorytransfers=LgfToInventoryTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LgfToInventoryTransfers']])->get();
		$lgftoinventorytransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($lgftoinventorytransfersdata['usersaccountsroles'][0]) && $lgftoinventorytransfersdata['usersaccountsroles'][0]['_delete']==1){
			$lgftoinventorytransfers->delete();
		}return redirect('admin/lgftoinventorytransfers')->with('success','lgf to inventory transfers has been deleted!');
	}

	public function getgftoinventorytransactionnumber(){
		return (LgfToInventoryTransfers::all()->count()+1);
	}
}