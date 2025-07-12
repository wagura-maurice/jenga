<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (product transfer statuses)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductTransferStatuses;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductTransferStatusesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$producttransferstatusesdata['list']=ProductTransferStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransferStatuses']])->get();
		$producttransferstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransferstatusesdata['usersaccountsroles'][0]['_add']==0&&$producttransferstatusesdata['usersaccountsroles'][0]['_list']==0&&$producttransferstatusesdata['usersaccountsroles'][0]['_edit']==0&&$producttransferstatusesdata['usersaccountsroles'][0]['_edit']==0&&$producttransferstatusesdata['usersaccountsroles'][0]['_show']==0&&$producttransferstatusesdata['usersaccountsroles'][0]['_delete']==0&&$producttransferstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('producttransferstatusesdata'));
		}else{
			return view('admin.product_transfer_statuses.index',compact('producttransferstatusesdata'));
		}
	}

	public function create(){
		$producttransferstatusesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransferStatuses']])->get();
		$producttransferstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransferstatusesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('producttransferstatusesdata'));
		}else{
			return view('admin.product_transfer_statuses.create',compact('producttransferstatusesdata'));
		}
	}

	public function filter(Request $request){
		$producttransferstatusesdata['list']=ProductTransferStatuses::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransferStatuses']])->get();
		$producttransferstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransferstatusesdata['usersaccountsroles'][0]['_add']==0&&$producttransferstatusesdata['usersaccountsroles'][0]['_list']==0&&$producttransferstatusesdata['usersaccountsroles'][0]['_edit']==0&&$producttransferstatusesdata['usersaccountsroles'][0]['_edit']==0&&$producttransferstatusesdata['usersaccountsroles'][0]['_show']==0&&$producttransferstatusesdata['usersaccountsroles'][0]['_delete']==0&&$producttransferstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('producttransferstatusesdata'));
		}else{
			return view('admin.product_transfer_statuses.index',compact('producttransferstatusesdata'));
		}
	}

	public function report(){
		$producttransferstatusesdata['company']=Companies::all();
		$producttransferstatusesdata['list']=ProductTransferStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransferStatuses']])->get();
		$producttransferstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransferstatusesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('producttransferstatusesdata'));
		}else{
			return view('admin.product_transfer_statuses.report',compact('producttransferstatusesdata'));
		}
	}

	public function chart(){
		return view('admin.product_transfer_statuses.chart');
	}

	public function store(Request $request){
		$producttransferstatuses=new ProductTransferStatuses();
		$producttransferstatuses->code=$request->get('code');
		$producttransferstatuses->name=$request->get('name');
		$producttransferstatuses->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransferStatuses']])->get();
		$producttransferstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransferstatusesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($producttransferstatuses->save()){
					$response['status']='1';
					$response['message']='product transfer statuses Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product transfer statuses. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product transfer statuses. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$producttransferstatusesdata['data']=ProductTransferStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransferStatuses']])->get();
		$producttransferstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransferstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('producttransferstatusesdata'));
		}else{
		return view('admin.product_transfer_statuses.edit',compact('producttransferstatusesdata','id'));
		}
	}

	public function show($id){
		$producttransferstatusesdata['data']=ProductTransferStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransferStatuses']])->get();
		$producttransferstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransferstatusesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('producttransferstatusesdata'));
		}else{
		return view('admin.product_transfer_statuses.show',compact('producttransferstatusesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$producttransferstatuses=ProductTransferStatuses::find($id);
		$producttransferstatuses->code=$request->get('code');
		$producttransferstatuses->name=$request->get('name');
		$producttransferstatuses->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransferStatuses']])->get();
		$producttransferstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransferstatusesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('producttransferstatusesdata'));
		}else{
		$producttransferstatuses->save();
		$producttransferstatusesdata['data']=ProductTransferStatuses::find($id);
		return view('admin.product_transfer_statuses.edit',compact('producttransferstatusesdata','id'));
		}
	}

	public function destroy($id){
		$producttransferstatuses=ProductTransferStatuses::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductTransferStatuses']])->get();
		$producttransferstatusesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($producttransferstatusesdata['usersaccountsroles'][0]['_delete']==1){
			$producttransferstatuses->delete();
		}return redirect('admin/producttransferstatuses')->with('success','product transfer statuses has been deleted!');
	}
}