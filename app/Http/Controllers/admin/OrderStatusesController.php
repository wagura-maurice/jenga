<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (order statuses)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\OrderStatuses;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class OrderStatusesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$orderstatusesdata['list']=OrderStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OrderStatuses']])->get();
		$orderstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($orderstatusesdata['usersaccountsroles'][0]['_add']==0&&$orderstatusesdata['usersaccountsroles'][0]['_list']==0&&$orderstatusesdata['usersaccountsroles'][0]['_edit']==0&&$orderstatusesdata['usersaccountsroles'][0]['_edit']==0&&$orderstatusesdata['usersaccountsroles'][0]['_show']==0&&$orderstatusesdata['usersaccountsroles'][0]['_delete']==0&&$orderstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('orderstatusesdata'));
		}else{
			return view('admin.order_statuses.index',compact('orderstatusesdata'));
		}
	}

	public function create(){
		$orderstatusesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OrderStatuses']])->get();
		$orderstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($orderstatusesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('orderstatusesdata'));
		}else{
			return view('admin.order_statuses.create',compact('orderstatusesdata'));
		}
	}

	public function filter(Request $request){
		$orderstatusesdata['list']=OrderStatuses::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OrderStatuses']])->get();
		$orderstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($orderstatusesdata['usersaccountsroles'][0]['_add']==0&&$orderstatusesdata['usersaccountsroles'][0]['_list']==0&&$orderstatusesdata['usersaccountsroles'][0]['_edit']==0&&$orderstatusesdata['usersaccountsroles'][0]['_edit']==0&&$orderstatusesdata['usersaccountsroles'][0]['_show']==0&&$orderstatusesdata['usersaccountsroles'][0]['_delete']==0&&$orderstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('orderstatusesdata'));
		}else{
			return view('admin.order_statuses.index',compact('orderstatusesdata'));
		}
	}

	public function report(){
		$orderstatusesdata['company']=Companies::all();
		$orderstatusesdata['list']=OrderStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OrderStatuses']])->get();
		$orderstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($orderstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('orderstatusesdata'));
		}else{
			return view('admin.order_statuses.report',compact('orderstatusesdata'));
		}
	}

	public function chart(){
		return view('admin.order_statuses.chart');
	}

	public function store(Request $request){
		$orderstatuses=new OrderStatuses();
		$orderstatuses->code=$request->get('code');
		$orderstatuses->name=$request->get('name');
		$orderstatuses->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OrderStatuses']])->get();
		$orderstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($orderstatusesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($orderstatuses->save()){
					$response['status']='1';
					$response['message']='order statuses Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add order statuses. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add order statuses. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$orderstatusesdata['data']=OrderStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OrderStatuses']])->get();
		$orderstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($orderstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('orderstatusesdata'));
		}else{
		return view('admin.order_statuses.edit',compact('orderstatusesdata','id'));
		}
	}

	public function show($id){
		$orderstatusesdata['data']=OrderStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OrderStatuses']])->get();
		$orderstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($orderstatusesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('orderstatusesdata'));
		}else{
		return view('admin.order_statuses.show',compact('orderstatusesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$orderstatuses=OrderStatuses::find($id);
		$orderstatuses->code=$request->get('code');
		$orderstatuses->name=$request->get('name');
		$orderstatuses->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OrderStatuses']])->get();
		$orderstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($orderstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('orderstatusesdata'));
		}else{
		$orderstatuses->save();
		$orderstatusesdata['data']=OrderStatuses::find($id);
		return view('admin.order_statuses.edit',compact('orderstatusesdata','id'));
		}
	}

	public function destroy($id){
		$orderstatuses=OrderStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OrderStatuses']])->get();
		$orderstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($orderstatusesdata['usersaccountsroles'][0]['_delete']==1){
			$orderstatuses->delete();
		}return redirect('admin/orderstatuses')->with('success','order statuses has been deleted!');
	}
}