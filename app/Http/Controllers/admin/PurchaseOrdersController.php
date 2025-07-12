<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (Purchases)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PurchaseOrders;
use App\Companies;
use App\Modules;
use App\Users;
use App\Products;
use App\OrderStatuses;
use Illuminate\Support\Facades\DB;
use App\PurchaseOrderLines;
use App\PurchaseOrderPayments;
use App\Suppliers;
use App\PurchaseOrderAccountMappings;
use App\GeneralLedgers;
use App\ApprovalLevels;
use App\ApprovalStatuses;
use App\PurchaseOrderApprovalMappings;
use App\PurchaseOrderApprovals;
use App\EntryTypes;
use App\Stores;
use App\PaymentModes;
use App\ProductStocks;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class PurchaseOrdersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$purchaseordersdata['suppliers']=Suppliers::all();
		$purchaseordersdata['stores']=Stores::all();
		$purchaseordersdata['list']=PurchaseOrders::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrders']])->get();
		$purchaseordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseordersdata['usersaccountsroles'][0]['_add']==0&&$purchaseordersdata['usersaccountsroles'][0]['_list']==0&&$purchaseordersdata['usersaccountsroles'][0]['_edit']==0&&$purchaseordersdata['usersaccountsroles'][0]['_edit']==0&&$purchaseordersdata['usersaccountsroles'][0]['_show']==0&&$purchaseordersdata['usersaccountsroles'][0]['_delete']==0&&$purchaseordersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseordersdata'));
		}else{
			return view('admin.purchase_orders.index',compact('purchaseordersdata'));
		}
	}

	public function create(){
		$purchaseordersdata;
		$purchaseordersdata['suppliers']=Suppliers::all();
		$purchaseordersdata['products']=Products::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$purchaseordersdata['stores']=Stores::where([["staff","=",$user[0]["id"]]])->get();		
		$module=Modules::where([['name','=','PurchaseOrders']])->get();
		$purchaseordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseordersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('purchaseordersdata'));
		}else{
			return view('admin.purchase_orders.create',compact('purchaseordersdata'));
		}
	}

	public function filter(Request $request){
		$purchaseordersdata['stores']=Stores::all();
		$purchaseordersdata['suppliers']=Suppliers::all();
		$purchaseordersdata['list']=PurchaseOrders::where([['order_number','LIKE','%'.$request->get('order_number').'%'],['supplier','LIKE','%'.$request->get('supplier').'%'],['notes','LIKE','%'.$request->get('notes').'%'],])->orWhereBetween('order_date',[$request->get('order_datefrom'),$request->get('order_dateto')])->orWhereBetween('due_date',[$request->get('due_datefrom'),$request->get('due_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrders']])->get();
		$purchaseordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseordersdata['usersaccountsroles'][0]['_add']==0&&$purchaseordersdata['usersaccountsroles'][0]['_list']==0&&$purchaseordersdata['usersaccountsroles'][0]['_edit']==0&&$purchaseordersdata['usersaccountsroles'][0]['_edit']==0&&$purchaseordersdata['usersaccountsroles'][0]['_show']==0&&$purchaseordersdata['usersaccountsroles'][0]['_delete']==0&&$purchaseordersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseordersdata'));
		}else{
			return view('admin.purchase_orders.index',compact('purchaseordersdata'));
		}
	}

	public function report(){
		$purchaseordersdata['stores']=Stores::all();
		$purchaseordersdata['company']=Companies::all();
		$purchaseordersdata['list']=PurchaseOrders::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrders']])->get();
		$purchaseordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseordersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseordersdata'));
		}else{
			return view('admin.purchase_orders.report',compact('purchaseordersdata'));
		}
	}

	public function approve($id){
		$purchaseordersdata['stores']=Stores::all();
		$purchaseordersdata['suppliers']=Suppliers::all();
		$purchaseordersdata['data']=PurchaseOrders::find($id);
		$purchaseordersdata['orderlines']=PurchaseOrderLines::where([["purchase_order","=",$id]])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$purchaseordersdata['approvalstatuses']=ApprovalStatuses::all();

		$mymapping=PurchaseOrderApprovalMappings::where([["store","=",$purchaseordersdata['data']->store],["user_account","=",$user[0]->user_account]])->get()->first();

		$purchaseordersdata['mymapping']=$mymapping;

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$purchaseordersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=PurchaseOrderApprovals::where([["purchase_order","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=PurchaseOrderApprovals::where([["purchase_order","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$purchaseordersdata['myturn']="1";
					}else if(isset($purchaseordersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$purchaseordersdata['myturn']="1";
					}else if(isset($myapproval)){
						$purchaseordersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$purchaseordersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}

		$purchaseordersdata['approvals']=PurchaseOrderApprovals::where([[""]]);
		$module=Modules::where([['name','=','PurchaseOrders']])->get();
		$purchaseordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseordersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseordersdata'));
		}else{
			return view('admin.purchase_orders.approve',compact('purchaseordersdata'));
		}
	}

	public function approval(Request $request,$id){
		$purchaseordersdata['stores']=Stores::all();
		$purchaseordersdata['suppliers']=Suppliers::all();
		$purchaseOrder=PurchaseOrders::find($id);
		$purchaseordersdata['data']=$purchaseOrder;
		$purchaseordersdata['orderlines']=PurchaseOrderLines::where([["purchase_order","=",$id]])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();



		$purchaseordersdata['approvalstatuses']=ApprovalStatuses::all();

		$mymapping=PurchaseOrderApprovalMappings::where([["store","=",$purchaseordersdata['data']->store],["user_account","=",$user[0]->user_account]])->get()->first();
		$purchaseordersdata['mymapping']=$mymapping;

		if($purchaseOrder->approvalstatusmodel->code=="003"){
			DB::transaction(function() use($request,$user,$id,$mymapping,$purchaseOrder,$purchaseordersdata){
				try{


					$purchaseorderapprovals=new PurchaseOrderApprovals();
					$purchaseorderapprovals->purchase_order=$id;
					$purchaseorderapprovals->approval_level=$mymapping->approval_level;
					$purchaseorderapprovals->user=$user[0]->id;
					$purchaseorderapprovals->remarks=$request->get('remarks');
					$purchaseorderapprovals->approval_status=$request->get('approval_status');
					$purchaseorderapprovals->save();

					$mappings=PurchaseOrderApprovalMappings::where([["store","=",$purchaseordersdata['data']->store]])->get();

					$maxapprovallevel=0;

					for($r=0;$r<count($mappings);$r++){

						$maxapprovallevel=$mappings[$r]->approvallevelmodel->approval_level>$maxapprovallevel?$mappings[$r]->approvallevelmodel->approval_level:$maxapprovallevel;
					}

					$rejeted=ApprovalStatuses::where([["code","=","002"]])->get()->first();

					if($maxapprovallevel==$mymapping->approvallevelmodel->approval_level || $rejeted->id==$request->get('approval_status')){

						$purchaseOrder->approval_status=$request->get('approval_status');

						$purchaseOrder->save();
					}

				}catch(Exception $e){

				}
			});			
		}

		

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$purchaseordersdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=PurchaseOrderApprovals::where([["purchase_order","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=PurchaseOrderApprovals::where([["purchase_order","=",$id],["approval_level","=",$mymapping->approval_level]])->get();

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$purchaseordersdata['myturn']="1";
					}else if(isset($purchaseordersdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$purchaseordersdata['myturn']="1";
					}else if(isset($myapproval)){
						$purchaseordersdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}

				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$purchaseordersdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}

		$purchaseordersdata['approvals']=PurchaseOrderApprovals::where([[""]]);
		$module=Modules::where([['name','=','PurchaseOrders']])->get();
		$purchaseordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();

		if($purchaseordersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseordersdata'));
		}else{
			return view('admin.purchase_orders.approve',compact('purchaseordersdata'));
		}
	}		

	public function chart(){
		return view('admin.purchase_orders.chart');
	}

	public function store(Request $request){
		$purchaseordersdata['stores']=Stores::all();
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrders']])->get();
		$purchaseordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseordersdata['usersaccountsroles'][0]['_show']==1){
			return DB::transaction(function() use($request,$user){
				try{

					$orderstatus=OrderStatuses::where([['code','=','0001']])->get()->first();

					$pending=ApprovalStatuses::where([["code","=","003"]])->get()->first();

					$purchaseorders=new PurchaseOrders();
					$purchaseorders->order_status=$orderstatus->id;
					$purchaseorders->order_number=$request->get('order_number');
					$purchaseorders->supplier=$request->get('supplier');
					$purchaseorders->order_date=$request->get('order_date');
					$purchaseorders->due_date=$request->get('due_date');
					$purchaseorders->notes=$request->get('notes');
					$purchaseorders->store=$request->get('store');
					$purchaseorders->approval_status=$pending->id;
					$purchaseorders->initiated_by=$user["0"]["name"];

					if($purchaseorders->save()){

						$products=$request->get("product");
						$quantities=$request->get("quantity");
						$unitPrices=$request->get("unit_price");
						$discount=$request->get("discount");
						$totalPrices=$request->get("total_price");

						for($r=0;$r<count($products);$r++){
							$purchaseorderlines=new PurchaseOrderLines();
							$purchaseorderlines->purchase_order=$purchaseorders->id;
							$purchaseorderlines->product=$products[$r];
							$purchaseorderlines->quantity=$quantities[$r];
							$purchaseorderlines->unit_price=$unitPrices[$r];
							$purchaseorderlines->discount=$discount[$r];
							$purchaseorderlines->total_price=$totalPrices[$r];
							$purchaseorderlines->save();
						}


						$response['status']='1';
						$response['message']='purchase orders Added successfully';

						return json_encode($response);
				}else{
						$response['status']='0';
						$response['message']='Failed to add purchase orders. Please try again';
						return json_encode($response);
					}
				}
				catch(Exception $e){
						$response['status']='0';
						$response['message']='An Error occured while attempting to add purchase orders. Please try again';
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
		$purchaseordersdata['stores']=Stores::all();
		$purchaseordersdata['suppliers']=Suppliers::all();
		$purchaseordersdata['data']=PurchaseOrders::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrders']])->get();
		$purchaseordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseordersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchaseordersdata'));
		}else{
		return view('admin.purchase_orders.edit',compact('purchaseordersdata','id'));
		}
	}

	public function show($id){
		$purchaseordersdata['stores']=Stores::all();
		$purchaseordersdata['suppliers']=Suppliers::all();
		$purchaseordersdata['data']=PurchaseOrders::find($id);
		$purchaseordersdata['data']->amount=PurchaseOrderLines::where([["purchase_order","=",$id]])->sum("total_price");
		$purchaseordersdata['orderlines']=PurchaseOrderLines::where([["purchase_order","=",$id]])->get();
		$purchaseordersdata['company']=Companies::all()->first();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrders']])->get();
		$purchaseordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseordersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('purchaseordersdata'));
		}else{
		return view('admin.purchase_orders.show',compact('purchaseordersdata','id'));
		}
	}

	public function update(Request $request,$id){
		$purchaseordersdata['stores']=Stores::all();
		$purchaseorders=PurchaseOrders::find($id);
		$purchaseordersdata['suppliers']=Suppliers::all();
		$purchaseorders->order_number=$request->get('order_number');
		$purchaseorders->supplier=$request->get('supplier');
		$purchaseorders->order_date=$request->get('order_date');
		$purchaseorders->due_date=$request->get('due_date');
		$purchaseorders->notes=$request->get('notes');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrders']])->get();
		$purchaseordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseordersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchaseordersdata'));
		}else{
		$purchaseorders->save();
		$purchaseordersdata['data']=PurchaseOrders::find($id);
		return view('admin.purchase_orders.edit',compact('purchaseordersdata','id'));
		}
	}

	public function destroy($id){
		$purchaseordersdata['stores']=Stores::all();
		$purchaseorders=PurchaseOrders::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrders']])->get();
		$purchaseordersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseordersdata['usersaccountsroles'][0]['_delete']==1){
			$purchaseorders->delete();
		}return redirect('admin/purchaseorders')->with('success','purchase orders has been deleted!');
	}

	public function getpurchaseorderlines($id){
		$purchaseorderlinesdata['stores']=Stores::all();
		$purchaseorderlinesdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderlinesdata['products']=Products::all();
		$purchaseorderlinesdata['list']=PurchaseOrderLines::where([["purchase_order","=",$id]])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderLines']])->get();
		$purchaseorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderlinesdata['usersaccountsroles'][0]['_add']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_list']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_show']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_delete']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderlinesdata'));
		}else{
			return view('admin.purchase_order_lines.index',compact('purchaseorderlinesdata'));
		}
	}

	public function getpurchaseorderpayments($id){
		$purchaseorderpaymentsdata['stores']=Stores::all();
		$purchaseorderpaymentsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderpaymentsdata['purchaseorder']=PurchaseOrders::where([["id","=",$id]])->get()->first();
		$purchaseorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$purchaseorderpaymentsdata['list']=PurchaseOrderPayments::where([["purchase_order","=",$id]])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderPayments']])->get();
		$purchaseorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderpaymentsdata['usersaccountsroles'][0]['_add']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_list']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_show']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_delete']==0&&$purchaseorderpaymentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderpaymentsdata'));
		}else{
			return view('admin.purchase_order_payments.index',compact('purchaseorderpaymentsdata'));
		}		
	}

	public function createpurchaseorderpayment($id){
		$purchaseorderpaymentsdata;
		$purchaseorderpaymentsdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderpaymentsdata['paymentmodes']=PaymentModes::all();
		$purchaseorderpaymentsdata['purchaseorder']=PurchaseOrders::where([["id","=",$id]])->get()->first();
		$purchaseorderpaymentsdata['purchaseorder']->amount=PurchaseOrderLines::where([["purchase_order","=",$id]])->sum("total_price");
		
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderPayments']])->get();
		$purchaseorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderpaymentsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('purchaseorderpaymentsdata'));
		}else{
			return view('admin.purchase_order_payments.create',compact('purchaseorderpaymentsdata'));
		}		
	}

	public function storepurchaseorderpayment($id,Request $request){
		$purchaseorderlinesdata['purchaseorders']=PurchaseOrders::all();
		
		$purchaseorderlinesdata['products']=Products::all();
		$purchaseorderlinesdata['list']=PurchaseOrderLines::where([["purchase_order","=",$id]])->get();		
		$purchaseorderpaymentsdata['purchaseorders']=PurchaseOrders::all();		
		$purchaseorderpaymentsdata['purchaseorder']=PurchaseOrders::where([["id","=",$id]])->get()->first();
		$purchaseorderpaymentsdata['paymentmodes']=PaymentModes::all();
		
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderPayments']])->get();
		$purchaseorderpaymentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderpaymentsdata['usersaccountsroles'][0]['_show']==1){
			return DB::transaction(function() use($request,$id,$purchaseorderpaymentsdata){
				try{
					
					$purchaseorderpayments=new PurchaseOrderPayments();
					$purchaseorderpayments->purchase_order=$request->get('purchase_order');
					$purchaseorderpayments->payment_mode=$request->get('payment_mode');
					$purchaseorderpayments->payment_date=$request->get('payment_date');
					$purchaseorderpayments->amount=$request->get('amount');
					$purchaseorderpayments->reference=$request->get('reference');

					if($purchaseorderpayments->save()){

						$purchaseorder=PurchaseOrders::where([["id","=",$id]])->get()->first();

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

						}

						$purchaseorderpaymentsdata['purchaseorder']=PurchaseOrders::where([["id","=",$id]])->get()->first();
						$purchaseorderpaymentsdata['list']=PurchaseOrderPayments::where([["purchase_order","=",$id]])->get();	

						$response['status']='1';
						$response['message']='Purchase Order Payments Added successfully';

						return view('admin.purchase_order_payments.index',compact('purchaseorderpaymentsdata'));
				}else{
						$response['status']='0';
						$response['message']='Failed to add Purchase Order Payments. Please try again';
						return json_encode($response);
					}
				}
				catch(Exception $e){
						$response['status']='0';
						$response['message']='An Error occured while attempting to add Purchase Order Payments. Please try again';
						return json_encode($response);
				}				
			});

		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}		
	}	

	public function getpurchaseordernumber(){
		return (PurchaseOrders::all()->count()+1);
	}

}