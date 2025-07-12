<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages collateral value types data)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\CollateralValueType;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class CollateralValueTypeController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$collateralvaluetypedata['list']=CollateralValueType::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueType']])->get();
		$collateralvaluetypedata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypedata['usersaccountsroles'][0]['_add']==0&&$collateralvaluetypedata['usersaccountsroles'][0]['_list']==0&&$collateralvaluetypedata['usersaccountsroles'][0]['_edit']==0&&$collateralvaluetypedata['usersaccountsroles'][0]['_edit']==0&&$collateralvaluetypedata['usersaccountsroles'][0]['_show']==0&&$collateralvaluetypedata['usersaccountsroles'][0]['_delete']==0&&$collateralvaluetypedata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('collateralvaluetypedata'));
		}else{
			return view('admin.collateral_value_type.index',compact('collateralvaluetypedata'));
		}
	}

	public function create(){
		$collateralvaluetypedata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueType']])->get();
		$collateralvaluetypedata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypedata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('collateralvaluetypedata'));
		}else{
			return view('admin.collateral_value_type.create',compact('collateralvaluetypedata'));
		}
	}

	public function filter(Request $request){
		$collateralvaluetypedata['list']=CollateralValueType::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueType']])->get();
		$collateralvaluetypedata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypedata['usersaccountsroles'][0]['_add']==0&&$collateralvaluetypedata['usersaccountsroles'][0]['_list']==0&&$collateralvaluetypedata['usersaccountsroles'][0]['_edit']==0&&$collateralvaluetypedata['usersaccountsroles'][0]['_edit']==0&&$collateralvaluetypedata['usersaccountsroles'][0]['_show']==0&&$collateralvaluetypedata['usersaccountsroles'][0]['_delete']==0&&$collateralvaluetypedata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('collateralvaluetypedata'));
		}else{
			return view('admin.collateral_value_type.index',compact('collateralvaluetypedata'));
		}
	}

	public function report(){
		$collateralvaluetypedata['company']=Companies::all();
		$collateralvaluetypedata['list']=CollateralValueType::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueType']])->get();
		$collateralvaluetypedata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypedata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('collateralvaluetypedata'));
		}else{
			return view('admin.collateral_value_type.report',compact('collateralvaluetypedata'));
		}
	}

	public function chart(){
		return view('admin.collateral_value_type.chart');
	}

	public function store(Request $request){
		$collateralvaluetype=new CollateralValueType();
		$collateralvaluetype->code=$request->get('code');
		$collateralvaluetype->name=$request->get('name');
		$collateralvaluetype->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueType']])->get();
		$collateralvaluetypedata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypedata['usersaccountsroles'][0]['_show']==1){
			try{
				if($collateralvaluetype->save()){
					$response['status']='1';
					$response['message']='collateral value type Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add collateral value type. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add collateral value type. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$collateralvaluetypedata['data']=CollateralValueType::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueType']])->get();
		$collateralvaluetypedata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypedata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('collateralvaluetypedata'));
		}else{
		return view('admin.collateral_value_type.edit',compact('collateralvaluetypedata','id'));
		}
	}

	public function show($id){
		$collateralvaluetypedata['data']=CollateralValueType::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueType']])->get();
		$collateralvaluetypedata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypedata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('collateralvaluetypedata'));
		}else{
		return view('admin.collateral_value_type.show',compact('collateralvaluetypedata','id'));
		}
	}

	public function update(Request $request,$id){
		$collateralvaluetype=CollateralValueType::find($id);
		$collateralvaluetype->code=$request->get('code');
		$collateralvaluetype->name=$request->get('name');
		$collateralvaluetype->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueType']])->get();
		$collateralvaluetypedata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypedata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('collateralvaluetypedata'));
		}else{
		$collateralvaluetype->save();
		$collateralvaluetypedata['data']=CollateralValueType::find($id);
		return view('admin.collateral_value_type.edit',compact('collateralvaluetypedata','id'));
		}
	}

	public function destroy($id){
		$collateralvaluetype=CollateralValueType::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','CollateralValueType']])->get();
		$collateralvaluetypedata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($collateralvaluetypedata['usersaccountsroles'][0]['_delete']==1){
			$collateralvaluetype->delete();
		}return redirect('admin/collateralvaluetype')->with('success','collateral value type has been deleted!');
	}
}