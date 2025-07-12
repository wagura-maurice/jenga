<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (Sales Order Lines)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\SalesOrderLines;
use App\Companies;
use App\Modules;
use App\Users;
use App\Products;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class SalesOrderLinesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$salesorderlinesdata['products']=Products::all();
		$salesorderlinesdata['list']=SalesOrderLines::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderLines']])->get();
		$salesorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderlinesdata['usersaccountsroles'][0]['_add']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_list']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_edit']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_edit']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_show']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_delete']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesorderlinesdata'));
		}else{
			return view('admin.sales_order_lines.index',compact('salesorderlinesdata'));
		}
	}

	public function create(){
		$salesorderlinesdata;
		$salesorderlinesdata['products']=Products::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderLines']])->get();
		$salesorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderlinesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('salesorderlinesdata'));
		}else{
			return view('admin.sales_order_lines.create',compact('salesorderlinesdata'));
		}
	}

	public function filter(Request $request){
		$salesorderlinesdata['products']=Products::all();
		$salesorderlinesdata['list']=SalesOrderLines::where([['product','LIKE','%'.$request->get('product').'%'],['quantity','LIKE','%'.$request->get('quantity').'%'],['unit_price','LIKE','%'.$request->get('unit_price').'%'],['discount','LIKE','%'.$request->get('discount').'%'],['total_price','LIKE','%'.$request->get('total_price').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderLines']])->get();
		$salesorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderlinesdata['usersaccountsroles'][0]['_add']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_list']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_edit']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_edit']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_show']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_delete']==0&&$salesorderlinesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesorderlinesdata'));
		}else{
			return view('admin.sales_order_lines.index',compact('salesorderlinesdata'));
		}
	}

	public function report(){
		$salesorderlinesdata['company']=Companies::all();
		$salesorderlinesdata['list']=SalesOrderLines::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderLines']])->get();
		$salesorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderlinesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('salesorderlinesdata'));
		}else{
			return view('admin.sales_order_lines.report',compact('salesorderlinesdata'));
		}
	}

	public function chart(){
		return view('admin.sales_order_lines.chart');
	}

	public function store(Request $request){
		$salesorderlines=new SalesOrderLines();
		$salesorderlines->product=$request->get('product');
		$salesorderlines->quantity=$request->get('quantity');
		$salesorderlines->unit_price=$request->get('unit_price');
		$salesorderlines->discount=$request->get('discount');
		$salesorderlines->total_price=$request->get('total_price');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderLines']])->get();
		$salesorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderlinesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($salesorderlines->save()){
					$response['status']='1';
					$response['message']='Sales Order Lines Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add Sales Order Lines. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add Sales Order Lines. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$salesorderlinesdata['products']=Products::all();
		$salesorderlinesdata['data']=SalesOrderLines::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderLines']])->get();
		$salesorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderlinesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('salesorderlinesdata'));
		}else{
		return view('admin.sales_order_lines.edit',compact('salesorderlinesdata','id'));
		}
	}

	public function show($id){
		$salesorderlinesdata['products']=Products::all();
		$salesorderlinesdata['data']=SalesOrderLines::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderLines']])->get();
		$salesorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderlinesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('salesorderlinesdata'));
		}else{
		return view('admin.sales_order_lines.show',compact('salesorderlinesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$salesorderlines=SalesOrderLines::find($id);
		$salesorderlinesdata['products']=Products::all();
		$salesorderlines->product=$request->get('product');
		$salesorderlines->quantity=$request->get('quantity');
		$salesorderlines->unit_price=$request->get('unit_price');
		$salesorderlines->discount=$request->get('discount');
		$salesorderlines->total_price=$request->get('total_price');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderLines']])->get();
		$salesorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderlinesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('salesorderlinesdata'));
		}else{
		$salesorderlines->save();
		$salesorderlinesdata['data']=SalesOrderLines::find($id);
		return view('admin.sales_order_lines.edit',compact('salesorderlinesdata','id'));
		}
	}

	public function destroy($id){
		$salesorderlines=SalesOrderLines::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','SalesOrderLines']])->get();
		$salesorderlinesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($salesorderlinesdata['usersaccountsroles'][0]['_delete']==1){
			$salesorderlines->delete();
		}return redirect('admin/salesorderlines')->with('success','Sales Order Lines has been deleted!');
	}
}