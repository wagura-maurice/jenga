<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - ()
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanAssets;
use App\Companies;
use App\Modules;
use App\Users;
use App\Loans;
use App\Products;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanAssetsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loanassetsdata['loans']=Loans::all();
		$loanassetsdata['products']=Products::all();
		$loanassetsdata['list']=LoanAssets::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanAssets']])->get();
		$loanassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loanassetsdata['usersaccountsroles'][0]) && $loanassetsdata['usersaccountsroles'][0]['_add']==0&&$loanassetsdata['usersaccountsroles'][0]['_list']==0&&$loanassetsdata['usersaccountsroles'][0]['_edit']==0&&$loanassetsdata['usersaccountsroles'][0]['_edit']==0&&$loanassetsdata['usersaccountsroles'][0]['_show']==0&&$loanassetsdata['usersaccountsroles'][0]['_delete']==0&&$loanassetsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanassetsdata'));
		}else{
			return view('admin.loan_assets.index',compact('loanassetsdata'));
		}
	}

	public function create(){
		$loanassetsdata;
		$loanassetsdata['loans']=Loans::all();
		$loanassetsdata['products']=Products::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanAssets']])->get();
		$loanassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loanassetsdata['usersaccountsroles'][0]) && $loanassetsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loanassetsdata'));
		}else{
			return view('admin.loan_assets.create',compact('loanassetsdata'));
		}
	}

	public function filter(Request $request){
		$loanassetsdata['loans']=Loans::all();
		$loanassetsdata['products']=Products::all();
		$loanassetsdata['list']=LoanAssets::where([['loan','LIKE','%'.$request->get('loan').'%'],['asset','LIKE','%'.$request->get('asset').'%'],['quantity','LIKE','%'.$request->get('quantity').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanAssets']])->get();
		$loanassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loanassetsdata['usersaccountsroles'][0]) && $loanassetsdata['usersaccountsroles'][0]['_add']==0&&$loanassetsdata['usersaccountsroles'][0]['_list']==0&&$loanassetsdata['usersaccountsroles'][0]['_edit']==0&&$loanassetsdata['usersaccountsroles'][0]['_edit']==0&&$loanassetsdata['usersaccountsroles'][0]['_show']==0&&$loanassetsdata['usersaccountsroles'][0]['_delete']==0&&$loanassetsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanassetsdata'));
		}else{
			return view('admin.loan_assets.index',compact('loanassetsdata'));
		}
	}

	public function report(){
		$loanassetsdata['company']=Companies::all();
		$loanassetsdata['list']=LoanAssets::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanAssets']])->get();
		$loanassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loanassetsdata['usersaccountsroles'][0]) && $loanassetsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanassetsdata'));
		}else{
			return view('admin.loan_assets.report',compact('loanassetsdata'));
		}
	}

	public function chart(){
		return view('admin.loan_assets.chart');
	}

	public function store(Request $request){
		$loanassets=new LoanAssets();
		$loanassets->loan=$request->get('loan');
		$loanassets->asset=$request->get('asset');
		$loanassets->quantity=$request->get('quantity');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanAssets']])->get();
		$loanassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loanassetsdata['usersaccountsroles'][0]) && $loanassetsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loanassets->save()){
					$response['status']='1';
					$response['message']='loan assets Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan assets. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan assets. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loanassetsdata['loans']=Loans::all();
		$loanassetsdata['products']=Products::all();
		$loanassetsdata['data']=LoanAssets::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanAssets']])->get();
		$loanassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loanassetsdata['usersaccountsroles'][0]) && $loanassetsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanassetsdata'));
		}else{
		return view('admin.loan_assets.edit',compact('loanassetsdata','id'));
		}
	}

	public function show($id){
		$loanassetsdata['loans']=Loans::all();
		$loanassetsdata['products']=Products::all();
		$loanassetsdata['data']=LoanAssets::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanAssets']])->get();
		$loanassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loanassetsdata['usersaccountsroles'][0]) && $loanassetsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loanassetsdata'));
		}else{
		return view('admin.loan_assets.show',compact('loanassetsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loanassets=LoanAssets::find($id);
		$loanassetsdata['loans']=Loans::all();
		$loanassetsdata['products']=Products::all();
		$loanassets->loan=$request->get('loan');
		$loanassets->asset=$request->get('asset');
		$loanassets->quantity=$request->get('quantity');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanAssets']])->get();
		$loanassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanassetsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanassetsdata'));
		}else{
		$loanassets->save();
		$loanassetsdata['data']=LoanAssets::find($id);
		return view('admin.loan_assets.edit',compact('loanassetsdata','id'));
		}
	}

	public function destroy($id){
		$loanassets=LoanAssets::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanAssets']])->get();
		$loanassetsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($loanassetsdata['usersaccountsroles'][0]) && $loanassetsdata['usersaccountsroles'][0]['_delete']==1){
			$loanassets->delete();
		}return redirect('admin/loanassets')->with('success','loan assets has been deleted!');
	}
}