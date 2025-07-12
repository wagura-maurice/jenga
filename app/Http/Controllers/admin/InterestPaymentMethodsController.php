<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\InterestPaymentMethods;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class InterestPaymentMethodsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$interestpaymentmethodsdata['list']=InterestPaymentMethods::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPaymentMethods']])->get();
		$interestpaymentmethodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestpaymentmethodsdata['usersaccountsroles'][0]['_add']==0&&$interestpaymentmethodsdata['usersaccountsroles'][0]['_list']==0&&$interestpaymentmethodsdata['usersaccountsroles'][0]['_edit']==0&&$interestpaymentmethodsdata['usersaccountsroles'][0]['_edit']==0&&$interestpaymentmethodsdata['usersaccountsroles'][0]['_show']==0&&$interestpaymentmethodsdata['usersaccountsroles'][0]['_delete']==0&&$interestpaymentmethodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('interestpaymentmethodsdata'));
		}else{
			return view('admin.interest_payment_methods.index',compact('interestpaymentmethodsdata'));
		}
	}

	public function create(){
		$interestpaymentmethodsdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPaymentMethods']])->get();
		$interestpaymentmethodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestpaymentmethodsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('interestpaymentmethodsdata'));
		}else{
			return view('admin.interest_payment_methods.create',compact('interestpaymentmethodsdata'));
		}
	}

	public function filter(Request $request){
		$interestpaymentmethodsdata['list']=InterestPaymentMethods::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPaymentMethods']])->get();
		$interestpaymentmethodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestpaymentmethodsdata['usersaccountsroles'][0]['_add']==0&&$interestpaymentmethodsdata['usersaccountsroles'][0]['_list']==0&&$interestpaymentmethodsdata['usersaccountsroles'][0]['_edit']==0&&$interestpaymentmethodsdata['usersaccountsroles'][0]['_edit']==0&&$interestpaymentmethodsdata['usersaccountsroles'][0]['_show']==0&&$interestpaymentmethodsdata['usersaccountsroles'][0]['_delete']==0&&$interestpaymentmethodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('interestpaymentmethodsdata'));
		}else{
			return view('admin.interest_payment_methods.index',compact('interestpaymentmethodsdata'));
		}
	}

	public function report(){
		$interestpaymentmethodsdata['company']=Companies::all();
		$interestpaymentmethodsdata['list']=InterestPaymentMethods::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPaymentMethods']])->get();
		$interestpaymentmethodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestpaymentmethodsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('interestpaymentmethodsdata'));
		}else{
			return view('admin.interest_payment_methods.report',compact('interestpaymentmethodsdata'));
		}
	}

	public function chart(){
		return view('admin.interest_payment_methods.chart');
	}

	public function store(Request $request){
		$interestpaymentmethods=new InterestPaymentMethods();
		$interestpaymentmethods->code=$request->get('code');
		$interestpaymentmethods->name=$request->get('name');
		$interestpaymentmethods->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPaymentMethods']])->get();
		$interestpaymentmethodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestpaymentmethodsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($interestpaymentmethods->save()){
					$response['status']='1';
					$response['message']='interest payment methods Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add interest payment methods. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add interest payment methods. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$interestpaymentmethodsdata['data']=InterestPaymentMethods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPaymentMethods']])->get();
		$interestpaymentmethodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestpaymentmethodsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('interestpaymentmethodsdata'));
		}else{
		return view('admin.interest_payment_methods.edit',compact('interestpaymentmethodsdata','id'));
		}
	}

	public function show($id){
		$interestpaymentmethodsdata['data']=InterestPaymentMethods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPaymentMethods']])->get();
		$interestpaymentmethodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestpaymentmethodsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('interestpaymentmethodsdata'));
		}else{
		return view('admin.interest_payment_methods.show',compact('interestpaymentmethodsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$interestpaymentmethods=InterestPaymentMethods::find($id);
		$interestpaymentmethods->code=$request->get('code');
		$interestpaymentmethods->name=$request->get('name');
		$interestpaymentmethods->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPaymentMethods']])->get();
		$interestpaymentmethodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestpaymentmethodsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('interestpaymentmethodsdata'));
		}else{
		$interestpaymentmethods->save();
		$interestpaymentmethodsdata['data']=InterestPaymentMethods::find($id);
		return view('admin.interest_payment_methods.edit',compact('interestpaymentmethodsdata','id'));
		}
	}

	public function destroy($id){
		$interestpaymentmethods=InterestPaymentMethods::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestPaymentMethods']])->get();
		$interestpaymentmethodsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestpaymentmethodsdata['usersaccountsroles'][0]['_delete']==1){
			$interestpaymentmethods->delete();
		}return redirect('admin/interestpaymentmethods')->with('success','interest payment methods has been deleted!');
	}
}