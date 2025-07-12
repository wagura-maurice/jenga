<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\OtherPaymentTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class OtherPaymentTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$otherpaymenttypesdata['list']=OtherPaymentTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypes']])->get();
		$otherpaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymenttypesdata['usersaccountsroles'][0]['_add']==0&&$otherpaymenttypesdata['usersaccountsroles'][0]['_list']==0&&$otherpaymenttypesdata['usersaccountsroles'][0]['_edit']==0&&$otherpaymenttypesdata['usersaccountsroles'][0]['_edit']==0&&$otherpaymenttypesdata['usersaccountsroles'][0]['_show']==0&&$otherpaymenttypesdata['usersaccountsroles'][0]['_delete']==0&&$otherpaymenttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('otherpaymenttypesdata'));
		}else{
			return view('admin.other_payment_types.index',compact('otherpaymenttypesdata'));
		}
	}

	public function create(){
		$otherpaymenttypesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypes']])->get();
		$otherpaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymenttypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('otherpaymenttypesdata'));
		}else{
			return view('admin.other_payment_types.create',compact('otherpaymenttypesdata'));
		}
	}

	public function filter(Request $request){
		$otherpaymenttypesdata['list']=OtherPaymentTypes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypes']])->get();
		$otherpaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymenttypesdata['usersaccountsroles'][0]['_add']==0&&$otherpaymenttypesdata['usersaccountsroles'][0]['_list']==0&&$otherpaymenttypesdata['usersaccountsroles'][0]['_edit']==0&&$otherpaymenttypesdata['usersaccountsroles'][0]['_edit']==0&&$otherpaymenttypesdata['usersaccountsroles'][0]['_show']==0&&$otherpaymenttypesdata['usersaccountsroles'][0]['_delete']==0&&$otherpaymenttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('otherpaymenttypesdata'));
		}else{
			return view('admin.other_payment_types.index',compact('otherpaymenttypesdata'));
		}
	}

	public function report(){
		$otherpaymenttypesdata['company']=Companies::all();
		$otherpaymenttypesdata['list']=OtherPaymentTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypes']])->get();
		$otherpaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymenttypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('otherpaymenttypesdata'));
		}else{
			return view('admin.other_payment_types.report',compact('otherpaymenttypesdata'));
		}
	}

	public function chart(){
		return view('admin.other_payment_types.chart');
	}

	public function store(Request $request){
		$otherpaymenttypes=new OtherPaymentTypes();
		$otherpaymenttypes->code=$request->get('code');
		$otherpaymenttypes->name=$request->get('name');
		$otherpaymenttypes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypes']])->get();
		$otherpaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymenttypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($otherpaymenttypes->save()){
					$response['status']='1';
					$response['message']='other payment types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add other payment types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add other payment types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$otherpaymenttypesdata['data']=OtherPaymentTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypes']])->get();
		$otherpaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymenttypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('otherpaymenttypesdata'));
		}else{
		return view('admin.other_payment_types.edit',compact('otherpaymenttypesdata','id'));
		}
	}

	public function show($id){
		$otherpaymenttypesdata['data']=OtherPaymentTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypes']])->get();
		$otherpaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymenttypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('otherpaymenttypesdata'));
		}else{
		return view('admin.other_payment_types.show',compact('otherpaymenttypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$otherpaymenttypes=OtherPaymentTypes::find($id);
		$otherpaymenttypes->code=$request->get('code');
		$otherpaymenttypes->name=$request->get('name');
		$otherpaymenttypes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypes']])->get();
		$otherpaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymenttypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('otherpaymenttypesdata'));
		}else{
		$otherpaymenttypes->save();
		$otherpaymenttypesdata['data']=OtherPaymentTypes::find($id);
		return view('admin.other_payment_types.edit',compact('otherpaymenttypesdata','id'));
		}
	}

	public function destroy($id){
		$otherpaymenttypes=OtherPaymentTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','OtherPaymentTypes']])->get();
		$otherpaymenttypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($otherpaymenttypesdata['usersaccountsroles'][0]['_delete']==1){
			$otherpaymenttypes->delete();
		}return redirect('admin/otherpaymenttypes')->with('success','other payment types has been deleted!');
	}
}