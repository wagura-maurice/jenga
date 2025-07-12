<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages collateral value types data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\CollateralValueTypes;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class CollateralValueTypesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$collateralvaluetypesdata['list']=CollateralValueTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueTypes']])->get();
		$collateralvaluetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypesdata['usersaccountsroles'][0]['_add']==0&&$collateralvaluetypesdata['usersaccountsroles'][0]['_list']==0&&$collateralvaluetypesdata['usersaccountsroles'][0]['_edit']==0&&$collateralvaluetypesdata['usersaccountsroles'][0]['_edit']==0&&$collateralvaluetypesdata['usersaccountsroles'][0]['_show']==0&&$collateralvaluetypesdata['usersaccountsroles'][0]['_delete']==0&&$collateralvaluetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('collateralvaluetypesdata'));
		}else{
			return view('admin.collateral_value_types.index',compact('collateralvaluetypesdata'));
		}
	}

	public function create(){
		$collateralvaluetypesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueTypes']])->get();
		$collateralvaluetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('collateralvaluetypesdata'));
		}else{
			return view('admin.collateral_value_types.create',compact('collateralvaluetypesdata'));
		}
	}

	public function filter(Request $request){
		$collateralvaluetypesdata['list']=CollateralValueTypes::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueTypes']])->get();
		$collateralvaluetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypesdata['usersaccountsroles'][0]['_add']==0&&$collateralvaluetypesdata['usersaccountsroles'][0]['_list']==0&&$collateralvaluetypesdata['usersaccountsroles'][0]['_edit']==0&&$collateralvaluetypesdata['usersaccountsroles'][0]['_edit']==0&&$collateralvaluetypesdata['usersaccountsroles'][0]['_show']==0&&$collateralvaluetypesdata['usersaccountsroles'][0]['_delete']==0&&$collateralvaluetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('collateralvaluetypesdata'));
		}else{
			return view('admin.collateral_value_types.index',compact('collateralvaluetypesdata'));
		}
	}

	public function report(){
		$collateralvaluetypesdata['company']=Companies::all();
		$collateralvaluetypesdata['list']=CollateralValueTypes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueTypes']])->get();
		$collateralvaluetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('collateralvaluetypesdata'));
		}else{
			return view('admin.collateral_value_types.report',compact('collateralvaluetypesdata'));
		}
	}

	public function chart(){
		return view('admin.collateral_value_types.chart');
	}

	public function store(Request $request){
		$collateralvaluetypes=new CollateralValueTypes();
		$collateralvaluetypes->code=$request->get('code');
		$collateralvaluetypes->name=$request->get('name');
		$collateralvaluetypes->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueTypes']])->get();
		$collateralvaluetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($collateralvaluetypes->save()){
					$response['status']='1';
					$response['message']='collateral value types Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add collateral value types. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add collateral value types. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$collateralvaluetypesdata['data']=CollateralValueTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueTypes']])->get();
		$collateralvaluetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('collateralvaluetypesdata'));
		}else{
		return view('admin.collateral_value_types.edit',compact('collateralvaluetypesdata','id'));
		}
	}

	public function show($id){
		$collateralvaluetypesdata['data']=CollateralValueTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueTypes']])->get();
		$collateralvaluetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('collateralvaluetypesdata'));
		}else{
		return view('admin.collateral_value_types.show',compact('collateralvaluetypesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$collateralvaluetypes=CollateralValueTypes::find($id);
		$collateralvaluetypes->code=$request->get('code');
		$collateralvaluetypes->name=$request->get('name');
		$collateralvaluetypes->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueTypes']])->get();
		$collateralvaluetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('collateralvaluetypesdata'));
		}else{
		$collateralvaluetypes->save();
		$collateralvaluetypesdata['data']=CollateralValueTypes::find($id);
		return view('admin.collateral_value_types.edit',compact('collateralvaluetypesdata','id'));
		}
	}

	public function destroy($id){
		$collateralvaluetypes=CollateralValueTypes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueTypes']])->get();
		$collateralvaluetypesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypesdata['usersaccountsroles'][0]['_delete']==1){
			$collateralvaluetypes->delete();
		}return redirect('admin/collateralvaluetypes')->with('success','collateral value types has been deleted!');
	}
}