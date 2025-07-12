<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages fee payment types data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\FeePaymentTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class FeePaymentTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$feepaymenttypesdata['list']=FeePaymentTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeePaymentTypes']])->get();
		$feepaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feepaymenttypesdata['usersaccountsroles'][0]['_add']==0&&$feepaymenttypesdata['usersaccountsroles'][0]['_list']==0&&$feepaymenttypesdata['usersaccountsroles'][0]['_edit']==0&&$feepaymenttypesdata['usersaccountsroles'][0]['_edit']==0&&$feepaymenttypesdata['usersaccountsroles'][0]['_show']==0&&$feepaymenttypesdata['usersaccountsroles'][0]['_delete']==0&&$feepaymenttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('feepaymenttypesdata'));
		}else{
			return view('admin.fee_payment_types.index',compact('feepaymenttypesdata'));
		}
	}
	public function getfeepaymenttype($id){
		$feepaymenttype=FeePaymentTypes::find($id);
		return json_encode($feepaymenttype);
	}

	public function create(){
		$feepaymenttypesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeePaymentTypes']])->get();
		$feepaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feepaymenttypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('feepaymenttypesdata'));
		}else{
			return view('admin.fee_payment_types.create',compact('feepaymenttypesdata'));
		}
	}

	public function filter(Request $request){
		$feepaymenttypesdata['list']=FeePaymentTypes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeePaymentTypes']])->get();
		$feepaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feepaymenttypesdata['usersaccountsroles'][0]['_add']==0&&$feepaymenttypesdata['usersaccountsroles'][0]['_list']==0&&$feepaymenttypesdata['usersaccountsroles'][0]['_edit']==0&&$feepaymenttypesdata['usersaccountsroles'][0]['_edit']==0&&$feepaymenttypesdata['usersaccountsroles'][0]['_show']==0&&$feepaymenttypesdata['usersaccountsroles'][0]['_delete']==0&&$feepaymenttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('feepaymenttypesdata'));
		}else{
			return view('admin.fee_payment_types.index',compact('feepaymenttypesdata'));
		}
	}

	public function report(){
		$feepaymenttypesdata['company']=Companies::all();
		$feepaymenttypesdata['list']=FeePaymentTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeePaymentTypes']])->get();
		$feepaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feepaymenttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('feepaymenttypesdata'));
		}else{
			return view('admin.fee_payment_types.report',compact('feepaymenttypesdata'));
		}
	}

	public function chart(){
		return view('admin.fee_payment_types.chart');
	}

	public function store(Request $request){
		$feepaymenttypes=new FeePaymentTypes();
		$feepaymenttypes->code=$request->get('code');
		$feepaymenttypes->name=$request->get('name');
		$feepaymenttypes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeePaymentTypes']])->get();
		$feepaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feepaymenttypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($feepaymenttypes->save()){
					$response['status']='1';
					$response['message']='fee payment types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add fee payment types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add fee payment types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$feepaymenttypesdata['data']=FeePaymentTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeePaymentTypes']])->get();
		$feepaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feepaymenttypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('feepaymenttypesdata'));
		}else{
		return view('admin.fee_payment_types.edit',compact('feepaymenttypesdata','id'));
		}
	}

	public function show($id){
		$feepaymenttypesdata['data']=FeePaymentTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeePaymentTypes']])->get();
		$feepaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feepaymenttypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('feepaymenttypesdata'));
		}else{
		return view('admin.fee_payment_types.show',compact('feepaymenttypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$feepaymenttypes=FeePaymentTypes::find($id);
		$feepaymenttypes->code=$request->get('code');
		$feepaymenttypes->name=$request->get('name');
		$feepaymenttypes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeePaymentTypes']])->get();
		$feepaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feepaymenttypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('feepaymenttypesdata'));
		}else{
		$feepaymenttypes->save();
		$feepaymenttypesdata['data']=FeePaymentTypes::find($id);
		return view('admin.fee_payment_types.edit',compact('feepaymenttypesdata','id'));
		}
	}

	public function destroy($id){
		$feepaymenttypes=FeePaymentTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','FeePaymentTypes']])->get();
		$feepaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($feepaymenttypesdata['usersaccountsroles'][0]['_delete']==1){
			$feepaymenttypes->delete();
		}return redirect('admin/feepaymenttypes')->with('success','fee payment types has been deleted!');
	}
}