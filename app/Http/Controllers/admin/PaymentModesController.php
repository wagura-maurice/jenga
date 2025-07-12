<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\PaymentModes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class PaymentModesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$paymentmodesdata['list']=PaymentModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PaymentModes']])->get();
		$paymentmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymentmodesdata['usersaccountsroles'][0]['_add']==0&&$paymentmodesdata['usersaccountsroles'][0]['_list']==0&&$paymentmodesdata['usersaccountsroles'][0]['_edit']==0&&$paymentmodesdata['usersaccountsroles'][0]['_edit']==0&&$paymentmodesdata['usersaccountsroles'][0]['_show']==0&&$paymentmodesdata['usersaccountsroles'][0]['_delete']==0&&$paymentmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('paymentmodesdata'));
		}else{
			return view('admin.payment_modes.index',compact('paymentmodesdata'));
		}
	}

	public function create(){
		$paymentmodesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PaymentModes']])->get();
		$paymentmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymentmodesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('paymentmodesdata'));
		}else{
			return view('admin.payment_modes.create',compact('paymentmodesdata'));
		}
	}

	public function filter(Request $request){
		$paymentmodesdata['list']=PaymentModes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PaymentModes']])->get();
		$paymentmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymentmodesdata['usersaccountsroles'][0]['_add']==0&&$paymentmodesdata['usersaccountsroles'][0]['_list']==0&&$paymentmodesdata['usersaccountsroles'][0]['_edit']==0&&$paymentmodesdata['usersaccountsroles'][0]['_edit']==0&&$paymentmodesdata['usersaccountsroles'][0]['_show']==0&&$paymentmodesdata['usersaccountsroles'][0]['_delete']==0&&$paymentmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('paymentmodesdata'));
		}else{
			return view('admin.payment_modes.index',compact('paymentmodesdata'));
		}
	}

	public function report(){
		$paymentmodesdata['company']=Companies::all();
		$paymentmodesdata['list']=PaymentModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PaymentModes']])->get();
		$paymentmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymentmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('paymentmodesdata'));
		}else{
			return view('admin.payment_modes.report',compact('paymentmodesdata'));
		}
	}

	public function chart(){
		return view('admin.payment_modes.chart');
	}

	public function store(Request $request){
		$paymentmodes=new PaymentModes();
		$paymentmodes->code=$request->get('code');
		$paymentmodes->name=$request->get('name');
		$paymentmodes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PaymentModes']])->get();
		$paymentmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymentmodesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($paymentmodes->save()){
					$response['status']='1';
					$response['message']='payment modes Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add payment modes. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add payment modes. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$paymentmodesdata['data']=PaymentModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PaymentModes']])->get();
		$paymentmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymentmodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('paymentmodesdata'));
		}else{
		return view('admin.payment_modes.edit',compact('paymentmodesdata','id'));
		}
	}

	public function show($id){
		$paymentmodesdata['data']=PaymentModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PaymentModes']])->get();
		$paymentmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymentmodesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('paymentmodesdata'));
		}else{
		return view('admin.payment_modes.show',compact('paymentmodesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$paymentmodes=PaymentModes::find($id);
		$paymentmodes->code=$request->get('code');
		$paymentmodes->name=$request->get('name');
		$paymentmodes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PaymentModes']])->get();
		$paymentmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymentmodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('paymentmodesdata'));
		}else{
		$paymentmodes->save();
		$paymentmodesdata['data']=PaymentModes::find($id);
		return view('admin.payment_modes.edit',compact('paymentmodesdata','id'));
		}
	}

	public function destroy($id){
		$paymentmodes=PaymentModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','PaymentModes']])->get();
		$paymentmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($paymentmodesdata['usersaccountsroles'][0]['_delete']==1){
			$paymentmodes->delete();
		}return redirect('admin/paymentmodes')->with('success','payment modes has been deleted!');
	}
}