<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\InterestRateTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class InterestRateTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$interestratetypesdata['list']=InterestRateTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRateTypes']])->get();
		$interestratetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestratetypesdata['usersaccountsroles'][0]['_add']==0&&$interestratetypesdata['usersaccountsroles'][0]['_list']==0&&$interestratetypesdata['usersaccountsroles'][0]['_edit']==0&&$interestratetypesdata['usersaccountsroles'][0]['_edit']==0&&$interestratetypesdata['usersaccountsroles'][0]['_show']==0&&$interestratetypesdata['usersaccountsroles'][0]['_delete']==0&&$interestratetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('interestratetypesdata'));
		}else{
			return view('admin.interest_rate_types.index',compact('interestratetypesdata'));
		}
	}

	public function getinterestratetype($id){
		$interestratetype=InterestRateTypes::find($id);
		return json_encode($interestratetype);
	}

	public function create(){
		$interestratetypesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRateTypes']])->get();
		$interestratetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestratetypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('interestratetypesdata'));
		}else{
			return view('admin.interest_rate_types.create',compact('interestratetypesdata'));
		}
	}

	public function filter(Request $request){
		$interestratetypesdata['list']=InterestRateTypes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRateTypes']])->get();
		$interestratetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestratetypesdata['usersaccountsroles'][0]['_add']==0&&$interestratetypesdata['usersaccountsroles'][0]['_list']==0&&$interestratetypesdata['usersaccountsroles'][0]['_edit']==0&&$interestratetypesdata['usersaccountsroles'][0]['_edit']==0&&$interestratetypesdata['usersaccountsroles'][0]['_show']==0&&$interestratetypesdata['usersaccountsroles'][0]['_delete']==0&&$interestratetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('interestratetypesdata'));
		}else{
			return view('admin.interest_rate_types.index',compact('interestratetypesdata'));
		}
	}

	public function report(){
		$interestratetypesdata['company']=Companies::all();
		$interestratetypesdata['list']=InterestRateTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRateTypes']])->get();
		$interestratetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestratetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('interestratetypesdata'));
		}else{
			return view('admin.interest_rate_types.report',compact('interestratetypesdata'));
		}
	}

	public function chart(){
		return view('admin.interest_rate_types.chart');
	}

	public function store(Request $request){
		$interestratetypes=new InterestRateTypes();
		$interestratetypes->code=$request->get('code');
		$interestratetypes->name=$request->get('name');
		$interestratetypes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRateTypes']])->get();
		$interestratetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestratetypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($interestratetypes->save()){
					$response['status']='1';
					$response['message']='interest rate types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add interest rate types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add interest rate types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$interestratetypesdata['data']=InterestRateTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRateTypes']])->get();
		$interestratetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestratetypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('interestratetypesdata'));
		}else{
		return view('admin.interest_rate_types.edit',compact('interestratetypesdata','id'));
		}
	}

	public function show($id){
		$interestratetypesdata['data']=InterestRateTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRateTypes']])->get();
		$interestratetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestratetypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('interestratetypesdata'));
		}else{
		return view('admin.interest_rate_types.show',compact('interestratetypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$interestratetypes=InterestRateTypes::find($id);
		$interestratetypes->code=$request->get('code');
		$interestratetypes->name=$request->get('name');
		$interestratetypes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRateTypes']])->get();
		$interestratetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestratetypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('interestratetypesdata'));
		}else{
		$interestratetypes->save();
		$interestratetypesdata['data']=InterestRateTypes::find($id);
		return view('admin.interest_rate_types.edit',compact('interestratetypesdata','id'));
		}
	}

	public function destroy($id){
		$interestratetypes=InterestRateTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','InterestRateTypes']])->get();
		$interestratetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($interestratetypesdata['usersaccountsroles'][0]['_delete']==1){
			$interestratetypes->delete();
		}return redirect('admin/interestratetypes')->with('success','interest rate types has been deleted!');
	}
}