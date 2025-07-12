<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (Product Transfers)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductTransfers;
use App\Companies;
use App\Modules;
use App\Users;
use App\ProductTransferStatuses;
use App\Products;
use App\ProductStocks;
use Illuminate\Support\Facades\DB;
use App\Stores;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductTransfersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$producttransfersdata['products']=Products::all();
		$producttransfersdata['stores']=Stores::all();
		$producttransfersdata['stores']=Stores::all();
		$producttransfersdata['list']=ProductTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransfers']])->get();
		$producttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransfersdata['usersaccountsroles'][0]['_add']==0&&$producttransfersdata['usersaccountsroles'][0]['_list']==0&&$producttransfersdata['usersaccountsroles'][0]['_edit']==0&&$producttransfersdata['usersaccountsroles'][0]['_edit']==0&&$producttransfersdata['usersaccountsroles'][0]['_show']==0&&$producttransfersdata['usersaccountsroles'][0]['_delete']==0&&$producttransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('producttransfersdata'));
		}else{
			return view('admin.product_transfers.index',compact('producttransfersdata'));
		}
	}

	public function create(){
		$producttransfersdata;
		$producttransfersdata['products']=Products::all();
		$producttransfersdata['storesto']=Stores::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$producttransfersdata['storesfrom']=Stores::where([["staff","=",$user[0]["id"]]])->get();
		$module=Modules::where([['name','=','ProductTransfers']])->get();
		$producttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransfersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('producttransfersdata'));
		}else{
			return view('admin.product_transfers.create',compact('producttransfersdata'));
		}
	}

	public function filter(Request $request){
		$producttransfersdata['products']=Products::all();
		$producttransfersdata['stores']=Stores::all();
		$producttransfersdata['stores']=Stores::all();
		$producttransfersdata['list']=ProductTransfers::where([['product','LIKE','%'.$request->get('product').'%'],['store_from','LIKE','%'.$request->get('store_from').'%'],['store_to','LIKE','%'.$request->get('store_to').'%'],['size','LIKE','%'.$request->get('size').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransfers']])->get();
		$producttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransfersdata['usersaccountsroles'][0]['_add']==0&&$producttransfersdata['usersaccountsroles'][0]['_list']==0&&$producttransfersdata['usersaccountsroles'][0]['_edit']==0&&$producttransfersdata['usersaccountsroles'][0]['_edit']==0&&$producttransfersdata['usersaccountsroles'][0]['_show']==0&&$producttransfersdata['usersaccountsroles'][0]['_delete']==0&&$producttransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('producttransfersdata'));
		}else{
			return view('admin.product_transfers.index',compact('producttransfersdata'));
		}
	}

	public function report(){
		$producttransfersdata['company']=Companies::all();
		$producttransfersdata['list']=ProductTransfers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransfers']])->get();
		$producttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransfersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('producttransfersdata'));
		}else{
			return view('admin.product_transfers.report',compact('producttransfersdata'));
		}
	}

	public function chart(){
		return view('admin.product_transfers.chart');
	}

	public function store(Request $request){
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransfers']])->get();
		$producttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransfersdata['usersaccountsroles'][0]['_show']==1){
			return DB::transaction(function() use($request){
				try{

					$producttransfers=new ProductTransfers();
					$producttransfers->product=$request->get('product');
					$producttransfers->store_from=$request->get('store_from');
					$producttransfers->store_to=$request->get('store_to');
					$producttransfers->size=$request->get('size');

					$pending=ProductTransferStatuses::where([["code","=","001"]])->get()->first();

					$producttransfers->product_transfer_status=$pending->id;

					if($producttransfers->save()){
						$response['status']='1';
						$response['message']='Product Transfers Added successfully';
						return json_encode($response);
				}else{
						$response['status']='0';
						$response['message']='Failed to add Product Transfers. Please try again';
						return json_encode($response);
					}
				}
				catch(Exception $e){
						$response['status']='0';
						$response['message']='An Error occured while attempting to add Product Transfers. Please try again';
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
		$producttransfersdata['products']=Products::all();
		$producttransfersdata['data']=ProductTransfers::find($id);
		$producttransfersdata['statuses']=ProductTransferStatuses::where([["code","!=","001"]])->get();
		$producttransfersdata['stores']=Stores::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransfers']])->get();
		$producttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('producttransfersdata'));
		}else{
		return view('admin.product_transfers.edit',compact('producttransfersdata','id'));
		}
	}

	public function show($id){
		$producttransfersdata['products']=Products::all();
		$producttransfersdata['stores']=Stores::all();
		$producttransfersdata['stores']=Stores::all();
		$producttransfersdata['data']=ProductTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$producttransfersdata['statuses']=ProductTransferStatuses::where([["code","!=","001"]])->get();
		$module=Modules::where([['name','=','ProductTransfers']])->get();
		$producttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransfersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('producttransfersdata'));
		}else{
		return view('admin.product_transfers.show',compact('producttransfersdata','id'));
		}
	}

	public function update(Request $request,$id){
	
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransfers']])->get();
		$producttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		$producttransfersdata['products']=Products::all();
		$producttransfersdata['stores']=Stores::all();
		$producttransfersdata['statuses']=ProductTransferStatuses::where([["code","!=","001"]])->get();
		if($producttransfersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('producttransfersdata'));
		}else{	

			return DB::transaction(function() use($id,$request,$producttransfersdata){
				try{

					$producttransfers=ProductTransfers::find($id);
					$producttransfersdata['data']=$producttransfers;

					$pending=ProductTransferStatuses::where([["code","=","001"]])->get()->first();

					if($producttransfers->product_transfer_status!=$pending->id){
						
						return view('admin.product_transfers.edit',compact('producttransfersdata','id'));
					}

					$producttransfers->product_transfer_status=$request->get("product_transfer_status");

					$producttransfers->save();

					if($producttransfers->producttransferstatusmodel->code=="002"){

						$fromproductstocks=ProductStocks::where([["product","=",$producttransfers->product],["store","=",$producttransfers->store_from]])->get()->first();

						if(isset($fromproductstocks)){
							$fromproductstocks->size=$fromproductstocks->size-$producttransfers->size;
							$fromproductstocks->save();


							$toproductstocks=ProductStocks::where([["product","=",$producttransfers->product],["store","=",$producttransfers->store_to]])->get()->first();

							if(!isset($toproductstocks)){

								$toproductstocks=new ProductStocks();	
								$toproductstocks->product=$producttransfers->product;
								$toproductstocks->size=$producttransfers->size;
								$toproductstocks->store=$producttransfers->store_to;
								$toproductstocks->save();				
							}else{
								$toproductstocks->size=$toproductstocks->size+$producttransfers->size;
								$toproductstocks->save();
							}								
						}
						
					}				


					return view('admin.product_transfers.edit',compact('producttransfersdata','id'));

				}
				catch(Exception $e){

				}				
			});									
		
			$producttransfersdata['data']=ProductTransfers::find($id);
			return view('admin.product_transfers.edit',compact('producttransfersdata','id'));
		}
	}

	public function destroy($id){
		$producttransfers=ProductTransfers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransfers']])->get();
		$producttransfersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransfersdata['usersaccountsroles'][0]['_delete']==1){
			$producttransfers->delete();
		}return redirect('admin/producttransfers')->with('success','Product Transfers has been deleted!');
	}
}