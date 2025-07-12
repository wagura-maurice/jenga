<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - ()
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClientGuarantors;
use App\Companies;
use App\Modules;
use App\Users;
use App\Clients;
use App\Guarantors;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ClientGuarantorsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$clientguarantorsdata['clients']=Clients::all();
		$clientguarantorsdata['guarantors']=Guarantors::all();
		$clientguarantorsdata['list']=ClientGuarantors::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientGuarantors']])->get();
		$clientguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientguarantorsdata['usersaccountsroles'][0]) && $clientguarantorsdata['usersaccountsroles'][0]['_add']==0&&$clientguarantorsdata['usersaccountsroles'][0]['_list']==0&&$clientguarantorsdata['usersaccountsroles'][0]['_edit']==0&&$clientguarantorsdata['usersaccountsroles'][0]['_edit']==0&&$clientguarantorsdata['usersaccountsroles'][0]['_show']==0&&$clientguarantorsdata['usersaccountsroles'][0]['_delete']==0&&$clientguarantorsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientguarantorsdata'));
		}else{
			return view('admin.client_guarantors.index',compact('clientguarantorsdata'));
		}
	}

	public function create(){
		$clientguarantorsdata;
		$clientguarantorsdata['clients']=Clients::all();
		$clientguarantorsdata['guarantors']=Guarantors::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientGuarantors']])->get();
		$clientguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientguarantorsdata['usersaccountsroles'][0]) && $clientguarantorsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clientguarantorsdata'));
		}else{
			return view('admin.client_guarantors.create',compact('clientguarantorsdata'));
		}
	}

	public function filter(Request $request){
		$clientguarantorsdata['clients']=Clients::all();
		$clientguarantorsdata['guarantors']=Guarantors::all();
		$clientguarantorsdata['list']=ClientGuarantors::where([['client','LIKE','%'.$request->get('client').'%'],['guarantor','LIKE','%'.$request->get('guarantor').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientGuarantors']])->get();
		$clientguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientguarantorsdata['usersaccountsroles'][0]) && $clientguarantorsdata['usersaccountsroles'][0]['_add']==0&&$clientguarantorsdata['usersaccountsroles'][0]['_list']==0&&$clientguarantorsdata['usersaccountsroles'][0]['_edit']==0&&$clientguarantorsdata['usersaccountsroles'][0]['_edit']==0&&$clientguarantorsdata['usersaccountsroles'][0]['_show']==0&&$clientguarantorsdata['usersaccountsroles'][0]['_delete']==0&&$clientguarantorsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientguarantorsdata'));
		}else{
			return view('admin.client_guarantors.index',compact('clientguarantorsdata'));
		}
	}

	public function report(){
		$clientguarantorsdata['company']=Companies::all();
		$clientguarantorsdata['list']=ClientGuarantors::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientGuarantors']])->get();
		$clientguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientguarantorsdata['usersaccountsroles'][0]) && $clientguarantorsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientguarantorsdata'));
		}else{
			return view('admin.client_guarantors.report',compact('clientguarantorsdata'));
		}
	}

	public function chart(){
		return view('admin.client_guarantors.chart');
	}

	public function store(Request $request){
		$clientguarantors=new ClientGuarantors();
		$clientguarantors->client=$request->get('client');
		$clientguarantors->guarantor=$request->get('guarantor');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientGuarantors']])->get();
		$clientguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientguarantorsdata['usersaccountsroles'][0]) && $clientguarantorsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($clientguarantors->save()){
					$response['status']='1';
					$response['message']='client guarantors Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add client guarantors. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add client guarantors. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$clientguarantorsdata['clients']=Clients::all();
		$clientguarantorsdata['guarantors']=Guarantors::all();
		$clientguarantorsdata['data']=ClientGuarantors::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientGuarantors']])->get();
		$clientguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientguarantorsdata['usersaccountsroles'][0]) && $clientguarantorsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientguarantorsdata'));
		}else{
		return view('admin.client_guarantors.edit',compact('clientguarantorsdata','id'));
		}
	}

	public function show($id){
		$clientguarantorsdata['clients']=Clients::all();
		$clientguarantorsdata['guarantors']=Guarantors::all();
		$clientguarantorsdata['data']=ClientGuarantors::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientGuarantors']])->get();
		$clientguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientguarantorsdata['usersaccountsroles'][0]) && $clientguarantorsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clientguarantorsdata'));
		}else{
		return view('admin.client_guarantors.show',compact('clientguarantorsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clientguarantors=ClientGuarantors::find($id);
		$clientguarantorsdata['clients']=Clients::all();
		$clientguarantorsdata['guarantors']=Guarantors::all();
		$clientguarantors->client=$request->get('client');
		$clientguarantors->guarantor=$request->get('guarantor');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientGuarantors']])->get();
		$clientguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientguarantorsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientguarantorsdata'));
		}else{
		$clientguarantors->save();
		$clientguarantorsdata['data']=ClientGuarantors::find($id);
		return view('admin.client_guarantors.edit',compact('clientguarantorsdata','id'));
		}
	}

	public function destroy($id){
		$clientguarantors=ClientGuarantors::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientGuarantors']])->get();
		$clientguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientguarantorsdata['usersaccountsroles'][0]) && $clientguarantorsdata['usersaccountsroles'][0]['_delete']==1){
			$clientguarantors->delete();
		}return redirect('admin/clientguarantors')->with('success','client guarantors has been deleted!');
	}
}