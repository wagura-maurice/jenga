<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanGuarantors;
use App\Companies;
use App\Modules;
use App\Users;
use App\Loans;
use App\Guarantors;
use App\GuarantorRelationships;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanGuarantorsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loanguarantorsdata['loans']=Loans::all();
		$loanguarantorsdata['guarantors']=Guarantors::all();
		$loanguarantorsdata['guarantorrelationships']=GuarantorRelationships::all();
		$loanguarantorsdata['list']=LoanGuarantors::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanGuarantors']])->get();
		$loanguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanguarantorsdata['usersaccountsroles'][0]['_add']==0&&$loanguarantorsdata['usersaccountsroles'][0]['_list']==0&&$loanguarantorsdata['usersaccountsroles'][0]['_edit']==0&&$loanguarantorsdata['usersaccountsroles'][0]['_edit']==0&&$loanguarantorsdata['usersaccountsroles'][0]['_show']==0&&$loanguarantorsdata['usersaccountsroles'][0]['_delete']==0&&$loanguarantorsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanguarantorsdata'));
		}else{
			return view('admin.loan_guarantors.index',compact('loanguarantorsdata'));
		}
	}

	public function create(){
		$loanguarantorsdata;
		
		$loanguarantorsdata['loans']=Loans::all();
		$loanguarantorsdata['guarantors']=Guarantors::all();
		$loanguarantorsdata['guarantorrelationships']=GuarantorRelationships::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanGuarantors']])->get();
		$loanguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanguarantorsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loanguarantorsdata'));
		}else{
			return view('admin.loan_guarantors.create',compact('loanguarantorsdata'));
		}
	}

	public function filter(Request $request){
		$loanguarantorsdata['loans']=Loans::all();
		$loanguarantorsdata['guarantors']=Guarantors::all();
		$loanguarantorsdata['guarantorrelationships']=GuarantorRelationships::all();
		$loanguarantorsdata['list']=LoanGuarantors::where([['loan','LIKE','%'.$request->get('loan').'%'],['guarantor','LIKE','%'.$request->get('guarantor').'%'],['relationship_with_guarantor','LIKE','%'.$request->get('relationship_with_guarantor').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanGuarantors']])->get();
		$loanguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanguarantorsdata['usersaccountsroles'][0]['_add']==0&&$loanguarantorsdata['usersaccountsroles'][0]['_list']==0&&$loanguarantorsdata['usersaccountsroles'][0]['_edit']==0&&$loanguarantorsdata['usersaccountsroles'][0]['_edit']==0&&$loanguarantorsdata['usersaccountsroles'][0]['_show']==0&&$loanguarantorsdata['usersaccountsroles'][0]['_delete']==0&&$loanguarantorsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanguarantorsdata'));
		}else{
			return view('admin.loan_guarantors.index',compact('loanguarantorsdata'));
		}
	}

	public function report(){
		$loanguarantorsdata['company']=Companies::all();
		$loanguarantorsdata['list']=LoanGuarantors::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanGuarantors']])->get();
		$loanguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanguarantorsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loanguarantorsdata'));
		}else{
			return view('admin.loan_guarantors.report',compact('loanguarantorsdata'));
		}
	}

	public function chart(){
		return view('admin.loan_guarantors.chart');
	}

	public function store(Request $request){
		$loanguarantors=new LoanGuarantors();
		$loanguarantors->loan=$request->get('loan');
		$loanguarantors->guarantor=$request->get('guarantor');
		$loanguarantors->relationship_with_guarantor=$request->get('relationship_with_guarantor');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanGuarantors']])->get();
		$loanguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanguarantorsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loanguarantors->save()){
					$response['status']='1';
					$response['message']='loan guarantors Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan guarantors. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan guarantors. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loanguarantorsdata['loans']=Loans::all();
		$loanguarantorsdata['guarantors']=Guarantors::all();
		$loanguarantorsdata['guarantorrelationships']=GuarantorRelationships::all();
		$loanguarantorsdata['data']=LoanGuarantors::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanGuarantors']])->get();
		$loanguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanguarantorsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanguarantorsdata'));
		}else{
		return view('admin.loan_guarantors.edit',compact('loanguarantorsdata','id'));
		}
	}

	public function show($id){
		$loanguarantorsdata['loans']=Loans::all();
		$loanguarantorsdata['guarantors']=Guarantors::all();
		$loanguarantorsdata['guarantorrelationships']=GuarantorRelationships::all();
		$loanguarantorsdata['data']=LoanGuarantors::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanGuarantors']])->get();
		$loanguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanguarantorsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loanguarantorsdata'));
		}else{
		return view('admin.loan_guarantors.show',compact('loanguarantorsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loanguarantors=LoanGuarantors::find($id);
		$loanguarantorsdata['loans']=Loans::all();
		$loanguarantorsdata['guarantors']=Guarantors::all();
		$loanguarantorsdata['guarantorrelationships']=GuarantorRelationships::all();
		$loanguarantors->loan=$request->get('loan');
		$loanguarantors->guarantor=$request->get('guarantor');
		$loanguarantors->relationship_with_guarantor=$request->get('relationship_with_guarantor');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanGuarantors']])->get();
		$loanguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanguarantorsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loanguarantorsdata'));
		}else{
		$loanguarantors->save();
		$loanguarantorsdata['data']=LoanGuarantors::find($id);
		return view('admin.loan_guarantors.edit',compact('loanguarantorsdata','id'));
		}
	}

	public function destroy($id){
		$loanguarantors=LoanGuarantors::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanGuarantors']])->get();
		$loanguarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loanguarantorsdata['usersaccountsroles'][0]['_delete']==1){
			$loanguarantors->delete();
		}return redirect('admin/loanguarantors')->with('success','loan guarantors has been deleted!');
	}
}