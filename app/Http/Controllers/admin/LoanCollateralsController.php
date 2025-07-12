<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanCollaterals;
use App\Companies;
use App\Modules;
use App\Users;
use App\Loans;
use App\CollateralCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanCollateralsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loancollateralsdata['loans']=Loans::all();
		$loancollateralsdata['collateralcategories']=CollateralCategories::all();
		$loancollateralsdata['list']=LoanCollaterals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanCollaterals']])->get();
		$loancollateralsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loancollateralsdata['usersaccountsroles'][0]['_add']==0&&$loancollateralsdata['usersaccountsroles'][0]['_list']==0&&$loancollateralsdata['usersaccountsroles'][0]['_edit']==0&&$loancollateralsdata['usersaccountsroles'][0]['_edit']==0&&$loancollateralsdata['usersaccountsroles'][0]['_show']==0&&$loancollateralsdata['usersaccountsroles'][0]['_delete']==0&&$loancollateralsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loancollateralsdata'));
		}else{
			return view('admin.loan_collaterals.index',compact('loancollateralsdata'));
		}
	}

	public function create(){
		$loancollateralsdata;
		$loancollateralsdata['loans']=Loans::all();
		$loancollateralsdata['collateralcategories']=CollateralCategories::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanCollaterals']])->get();
		$loancollateralsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loancollateralsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loancollateralsdata'));
		}else{
			return view('admin.loan_collaterals.create',compact('loancollateralsdata'));
		}
	}

	public function filter(Request $request){
		$loancollateralsdata['loans']=Loans::all();
		$loancollateralsdata['collateralcategories']=CollateralCategories::all();
		$loancollateralsdata['list']=LoanCollaterals::where([['loan','LIKE','%'.$request->get('loan').'%'],['collateral_category','LIKE','%'.$request->get('collateral_category').'%'],['model','LIKE','%'.$request->get('model').'%'],['color','LIKE','%'.$request->get('color').'%'],['size','LIKE','%'.$request->get('size').'%'],['year_bought','LIKE','%'.$request->get('year_bought').'%'],['buying_price','LIKE','%'.$request->get('buying_price').'%'],['current_selling_price','LIKE','%'.$request->get('current_selling_price').'%'],['serial_number','LIKE','%'.$request->get('serial_number').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanCollaterals']])->get();
		$loancollateralsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loancollateralsdata['usersaccountsroles'][0]['_add']==0&&$loancollateralsdata['usersaccountsroles'][0]['_list']==0&&$loancollateralsdata['usersaccountsroles'][0]['_edit']==0&&$loancollateralsdata['usersaccountsroles'][0]['_edit']==0&&$loancollateralsdata['usersaccountsroles'][0]['_show']==0&&$loancollateralsdata['usersaccountsroles'][0]['_delete']==0&&$loancollateralsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loancollateralsdata'));
		}else{
			return view('admin.loan_collaterals.index',compact('loancollateralsdata'));
		}
	}

	public function report(){
		$loancollateralsdata['company']=Companies::all();
		$loancollateralsdata['list']=LoanCollaterals::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanCollaterals']])->get();
		$loancollateralsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loancollateralsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loancollateralsdata'));
		}else{
			return view('admin.loan_collaterals.report',compact('loancollateralsdata'));
		}
	}

	public function chart(){
		return view('admin.loan_collaterals.chart');
	}

	public function store(Request $request){
		$loancollaterals=new LoanCollaterals();
		$loancollaterals->loan=$request->get('loan');
		$loancollaterals->collateral_category=$request->get('collateral_category');
		$loancollaterals->model=$request->get('model');
		$loancollaterals->color=$request->get('color');
		$loancollaterals->size=$request->get('size');
		$loancollaterals->year_bought=$request->get('year_bought');
		$loancollaterals->buying_price=$request->get('buying_price');
		$loancollaterals->current_selling_price=$request->get('current_selling_price');
		$loancollaterals->serial_number=$request->get('serial_number');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanCollaterals']])->get();
		$loancollateralsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loancollateralsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loancollaterals->save()){
					$response['status']='1';
					$response['message']='loan collaterals Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan collaterals. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan collaterals. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loancollateralsdata['loans']=Loans::all();
		$loancollateralsdata['collateralcategories']=CollateralCategories::all();
		$loancollateralsdata['data']=LoanCollaterals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanCollaterals']])->get();
		$loancollateralsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loancollateralsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loancollateralsdata'));
		}else{
		return view('admin.loan_collaterals.edit',compact('loancollateralsdata','id'));
		}
	}

	public function show($id){
		$loancollateralsdata['loans']=Loans::all();
		$loancollateralsdata['collateralcategories']=CollateralCategories::all();
		$loancollateralsdata['data']=LoanCollaterals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanCollaterals']])->get();
		$loancollateralsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loancollateralsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loancollateralsdata'));
		}else{
		return view('admin.loan_collaterals.show',compact('loancollateralsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loancollaterals=LoanCollaterals::find($id);
		$loancollateralsdata['loans']=Loans::all();
		$loancollateralsdata['collateralcategories']=CollateralCategories::all();
		$loancollaterals->loan=$request->get('loan');
		$loancollaterals->collateral_category=$request->get('collateral_category');
		$loancollaterals->model=$request->get('model');
		$loancollaterals->color=$request->get('color');
		$loancollaterals->size=$request->get('size');
		$loancollaterals->year_bought=$request->get('year_bought');
		$loancollaterals->buying_price=$request->get('buying_price');
		$loancollaterals->current_selling_price=$request->get('current_selling_price');
		$loancollaterals->serial_number=$request->get('serial_number');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanCollaterals']])->get();
		$loancollateralsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loancollateralsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loancollateralsdata'));
		}else{
		$loancollaterals->save();
		$loancollateralsdata['data']=LoanCollaterals::find($id);
		return view('admin.loan_collaterals.edit',compact('loancollateralsdata','id'));
		}
	}

	public function destroy($id){
		$loancollaterals=LoanCollaterals::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanCollaterals']])->get();
		$loancollateralsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loancollateralsdata['usersaccountsroles'][0]['_delete']==1){
			$loancollaterals->delete();
		}return redirect('admin/loancollaterals')->with('success','loan collaterals has been deleted!');
	}
}