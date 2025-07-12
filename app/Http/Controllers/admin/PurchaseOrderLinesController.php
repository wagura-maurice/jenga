<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (purchase order lines)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PurchaseOrderLines;
use App\Companies;
use App\Modules;
use App\Users;
use App\PurchaseOrders;
use App\Products;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class PurchaseOrderLinesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$purchaseorderlinesdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderlinesdata['products']=Products::all();
		$purchaseorderlinesdata['list']=PurchaseOrderLines::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderLines']])->get();
		$purchaseorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderlinesdata['usersaccountsroles'][0]['_add']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_list']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_show']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_delete']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderlinesdata'));
		}else{
			return view('admin.purchase_order_lines.index',compact('purchaseorderlinesdata'));
		}
	}

	public function create(){
		$purchaseorderlinesdata;
		$purchaseorderlinesdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderlinesdata['products']=Products::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderLines']])->get();
		$purchaseorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderlinesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('purchaseorderlinesdata'));
		}else{
			return view('admin.purchase_order_lines.create',compact('purchaseorderlinesdata'));
		}
	}

	public function filter(Request $request){
		$purchaseorderlinesdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderlinesdata['products']=Products::all();
		$purchaseorderlinesdata['list']=PurchaseOrderLines::where([['purchase_order','LIKE','%'.$request->get('purchase_order').'%'],['product','LIKE','%'.$request->get('product').'%'],['quantity','LIKE','%'.$request->get('quantity').'%'],['unit_price','LIKE','%'.$request->get('unit_price').'%'],['discount','LIKE','%'.$request->get('discount').'%'],['total_price','LIKE','%'.$request->get('total_price').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderLines']])->get();
		$purchaseorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderlinesdata['usersaccountsroles'][0]['_add']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_list']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_edit']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_show']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_delete']==0&&$purchaseorderlinesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderlinesdata'));
		}else{
			return view('admin.purchase_order_lines.index',compact('purchaseorderlinesdata'));
		}
	}

	public function report(){
		$purchaseorderlinesdata['company']=Companies::all();
		$purchaseorderlinesdata['list']=PurchaseOrderLines::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderLines']])->get();
		$purchaseorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderlinesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('purchaseorderlinesdata'));
		}else{
			return view('admin.purchase_order_lines.report',compact('purchaseorderlinesdata'));
		}
	}

	public function chart(){
		return view('admin.purchase_order_lines.chart');
	}

	public function store(Request $request){
		$purchaseorderlines=new PurchaseOrderLines();
		$purchaseorderlines->purchase_order=$request->get('purchase_order');
		$purchaseorderlines->product=$request->get('product');
		$purchaseorderlines->quantity=$request->get('quantity');
		$purchaseorderlines->unit_price=$request->get('unit_price');
		$purchaseorderlines->discount=$request->get('discount');
		$purchaseorderlines->total_price=$request->get('total_price');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderLines']])->get();
		$purchaseorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderlinesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($purchaseorderlines->save()){
					$response['status']='1';
					$response['message']='purchase order lines Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add purchase order lines. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add purchase order lines. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$purchaseorderlinesdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderlinesdata['products']=Products::all();
		$purchaseorderlinesdata['data']=PurchaseOrderLines::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderLines']])->get();
		$purchaseorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderlinesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchaseorderlinesdata'));
		}else{
		return view('admin.purchase_order_lines.edit',compact('purchaseorderlinesdata','id'));
		}
	}

	public function show($id){
		$purchaseorderlinesdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderlinesdata['products']=Products::all();
		$purchaseorderlinesdata['data']=PurchaseOrderLines::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderLines']])->get();
		$purchaseorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderlinesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('purchaseorderlinesdata'));
		}else{
		return view('admin.purchase_order_lines.show',compact('purchaseorderlinesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$purchaseorderlines=PurchaseOrderLines::find($id);
		$purchaseorderlinesdata['purchaseorders']=PurchaseOrders::all();
		$purchaseorderlinesdata['products']=Products::all();
		$purchaseorderlines->purchase_order=$request->get('purchase_order');
		$purchaseorderlines->product=$request->get('product');
		$purchaseorderlines->quantity=$request->get('quantity');
		$purchaseorderlines->unit_price=$request->get('unit_price');
		$purchaseorderlines->discount=$request->get('discount');
		$purchaseorderlines->total_price=$request->get('total_price');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderLines']])->get();
		$purchaseorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderlinesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('purchaseorderlinesdata'));
		}else{
		$purchaseorderlines->save();
		$purchaseorderlinesdata['data']=PurchaseOrderLines::find($id);
		return view('admin.purchase_order_lines.edit',compact('purchaseorderlinesdata','id'));
		}
	}

	public function destroy($id){
		$purchaseorderlines=PurchaseOrderLines::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PurchaseOrderLines']])->get();
		$purchaseorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($purchaseorderlinesdata['usersaccountsroles'][0]['_delete']==1){
			$purchaseorderlines->delete();
		}return redirect('admin/purchaseorderlines')->with('success','purchase order lines has been deleted!');
	}
}