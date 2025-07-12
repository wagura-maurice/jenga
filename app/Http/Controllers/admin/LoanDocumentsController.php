<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\LoanDocuments;
use App\Companies;
use App\Modules;
use App\Users;
use App\Loans;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class LoanDocumentsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loandocumentsdata['loans']=Loans::all();
		$loandocumentsdata['list']=LoanDocuments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanDocuments']])->get();
		$loandocumentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loandocumentsdata['usersaccountsroles'][0]['_add']==0&&$loandocumentsdata['usersaccountsroles'][0]['_list']==0&&$loandocumentsdata['usersaccountsroles'][0]['_edit']==0&&$loandocumentsdata['usersaccountsroles'][0]['_edit']==0&&$loandocumentsdata['usersaccountsroles'][0]['_show']==0&&$loandocumentsdata['usersaccountsroles'][0]['_delete']==0&&$loandocumentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loandocumentsdata'));
		}else{
			return view('admin.loan_documents.index',compact('loandocumentsdata'));
		}
	}

	public function create(){
		$loandocumentsdata;
		$loandocumentsdata['loans']=Loans::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanDocuments']])->get();
		$loandocumentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loandocumentsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loandocumentsdata'));
		}else{
			return view('admin.loan_documents.create',compact('loandocumentsdata'));
		}
	}

	public function filter(Request $request){
		$loandocumentsdata['loans']=Loans::all();
		$loandocumentsdata['list']=LoanDocuments::where([['loan','LIKE','%'.$request->get('loan').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanDocuments']])->get();
		$loandocumentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loandocumentsdata['usersaccountsroles'][0]['_add']==0&&$loandocumentsdata['usersaccountsroles'][0]['_list']==0&&$loandocumentsdata['usersaccountsroles'][0]['_edit']==0&&$loandocumentsdata['usersaccountsroles'][0]['_edit']==0&&$loandocumentsdata['usersaccountsroles'][0]['_show']==0&&$loandocumentsdata['usersaccountsroles'][0]['_delete']==0&&$loandocumentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loandocumentsdata'));
		}else{
			return view('admin.loan_documents.index',compact('loandocumentsdata'));
		}
	}

	public function report(){
		$loandocumentsdata['company']=Companies::all();
		$loandocumentsdata['list']=LoanDocuments::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanDocuments']])->get();
		$loandocumentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loandocumentsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loandocumentsdata'));
		}else{
			return view('admin.loan_documents.report',compact('loandocumentsdata'));
		}
	}

	public function chart(){
		return view('admin.loan_documents.chart');
	}

	public function store(Request $request){
		$loandocuments=new LoanDocuments();
		$loandocuments->loan=$request->get('loan');
		$loandocuments->document=time() . '_' . rand(1000, 9999) . '.jpg';
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanDocuments']])->get();
		$loandocumentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loandocumentsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loandocuments->save()){
			$DocumentImage = $request->file('document');
			$DocumentImage->move('uploads/images',$loandocuments->document);
					$response['status']='1';
					$response['message']='loan documents Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loan documents. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loan documents. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loandocumentsdata['loans']=Loans::all();
		$loandocumentsdata['data']=LoanDocuments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanDocuments']])->get();
		$loandocumentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loandocumentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loandocumentsdata'));
		}else{
		return view('admin.loan_documents.edit',compact('loandocumentsdata','id'));
		}
	}

	public function show($id){
		$loandocumentsdata['loans']=Loans::all();
		$loandocumentsdata['data']=LoanDocuments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanDocuments']])->get();
		$loandocumentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loandocumentsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loandocumentsdata'));
		}else{
		return view('admin.loan_documents.show',compact('loandocumentsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$loandocuments=LoanDocuments::find($id);
		$loandocumentsdata['loans']=Loans::all();
		$loandocuments->loan=$request->get('loan');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanDocuments']])->get();
		$loandocumentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loandocumentsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loandocumentsdata'));
		}else{
		$loandocuments->save();
		$loandocumentsdata['data']=LoanDocuments::find($id);
		return view('admin.loan_documents.edit',compact('loandocumentsdata','id'));
		}
	}

	public function destroy($id){
		$loandocuments=LoanDocuments::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','LoanDocuments']])->get();
		$loandocumentsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loandocumentsdata['usersaccountsroles'][0]['_delete']==1){
			$loandocuments->delete();
		}return redirect('admin/loandocuments')->with('success','loan documents has been deleted!');
	}
}