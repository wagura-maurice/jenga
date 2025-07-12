<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - ()
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Guarantors;
use App\Companies;
use App\Modules;
use App\Users;
use App\Clients;
use App\Counties;
use App\GuarantorRelationships;
use App\SubCounties;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class GuarantorsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$guarantorsdata['counties']=Counties::all();
		$guarantorsdata['subcounties']=SubCounties::all();
		$guarantorsdata['list']=Guarantors::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Guarantors']])->get();
		$guarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($guarantorsdata['usersaccountsroles'][0]) && $guarantorsdata['usersaccountsroles'][0]['_add']==0&&$guarantorsdata['usersaccountsroles'][0]['_list']==0&&$guarantorsdata['usersaccountsroles'][0]['_edit']==0&&$guarantorsdata['usersaccountsroles'][0]['_edit']==0&&$guarantorsdata['usersaccountsroles'][0]['_show']==0&&$guarantorsdata['usersaccountsroles'][0]['_delete']==0&&$guarantorsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('guarantorsdata'));
		}else{
			return view('admin.guarantors.index',compact('guarantorsdata'));
		}
	}

	public function create(){
		$guarantorsdata;
		$guarantorsdata['relationships']=GuarantorRelationships::all();
		$guarantorsdata['counties']=Counties::all();
		$guarantorsdata['clients']=Clients::all();
		$guarantorsdata['subcounties']=SubCounties::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Guarantors']])->get();
		$guarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($guarantorsdata['usersaccountsroles'][0]) && $guarantorsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('guarantorsdata'));
		}else{
			return view('admin.guarantors.create',compact('guarantorsdata'));
		}
	}

	public function filter(Request $request){
		$guarantorsdata['counties']=Counties::all();
		$guarantorsdata['subcounties']=SubCounties::all();
		$guarantorsdata['list']=Guarantors::where([['first_name','LIKE','%'.$request->get('first_name').'%'],['middle_name','LIKE','%'.$request->get('middle_name').'%'],['last_name','LIKE','%'.$request->get('last_name').'%'],['id_number','LIKE','%'.$request->get('id_number').'%'],['county','LIKE','%'.$request->get('county').'%'],['sub_county','LIKE','%'.$request->get('sub_county').'%'],['primary_phone_number','LIKE','%'.$request->get('primary_phone_number').'%'],['secondary_phone_number','LIKE','%'.$request->get('secondary_phone_number').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Guarantors']])->get();
		$guarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($guarantorsdata['usersaccountsroles'][0]) && $guarantorsdata['usersaccountsroles'][0]['_add']==0&&$guarantorsdata['usersaccountsroles'][0]['_list']==0&&$guarantorsdata['usersaccountsroles'][0]['_edit']==0&&$guarantorsdata['usersaccountsroles'][0]['_edit']==0&&$guarantorsdata['usersaccountsroles'][0]['_show']==0&&$guarantorsdata['usersaccountsroles'][0]['_delete']==0&&$guarantorsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('guarantorsdata'));
		}else{
			return view('admin.guarantors.index',compact('guarantorsdata'));
		}
	}

	public function report(){
		$guarantorsdata['company']=Companies::all();
		$guarantorsdata['list']=Guarantors::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Guarantors']])->get();
		$guarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($guarantorsdata['usersaccountsroles'][0]) && $guarantorsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('guarantorsdata'));
		}else{
			return view('admin.guarantors.report',compact('guarantorsdata'));
		}
	}

	public function chart(){
		return view('admin.guarantors.chart');
	}

	public function store(Request $request){
		$guarantors=new Guarantors();
		$guarantors->first_name=$request->get('first_name');
		$guarantors->middle_name=$request->get('middle_name');
		$guarantors->last_name=$request->get('last_name');
		$guarantors->id_number=$request->get('id_number');
		$guarantors->client=$request->get('client');
		$guarantors->relationship=$request->get("relationship");
		$guarantors->occupation=$request->get("occupation");
		$guarantors->county=$request->get('county');
		$guarantors->sub_county=$request->get('sub_county');
		$guarantors->primary_phone_number=$request->get('primary_phone_number');
		$guarantors->secondary_phone_number=$request->get('secondary_phone_number');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Guarantors']])->get();
		$guarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($guarantorsdata['usersaccountsroles'][0]) && $guarantorsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($guarantors->save()){
					$response['status']='1';
					$response['message']='guarantors Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add guarantors. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add guarantors. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$guarantorsdata['counties']=Counties::all();
		$guarantorsdata['subcounties']=SubCounties::all();
		$guarantorsdata['data']=Guarantors::find($id);
		$guarantorsdata['relationships']=GuarantorRelationships::all();
		$guarantorsdata['clients']=Clients::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Guarantors']])->get();
		$guarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($guarantorsdata['usersaccountsroles'][0]) && $guarantorsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('guarantorsdata'));
		}else{
		return view('admin.guarantors.edit',compact('guarantorsdata','id'));
		}
	}

	public function show($id){
		$guarantorsdata['counties']=Counties::all();
		$guarantorsdata['subcounties']=SubCounties::all();
		$guarantorsdata['data']=Guarantors::find($id);
		$guarantorsdata['relationships']=GuarantorRelationships::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Guarantors']])->get();
		$guarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($guarantorsdata['usersaccountsroles'][0]) && $guarantorsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('guarantorsdata'));
		}else{
		return view('admin.guarantors.show',compact('guarantorsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$guarantors=Guarantors::find($id);
		$guarantorsdata['counties']=Counties::all();
		$guarantorsdata['relationships']=GuarantorRelationships::all();
		$guarantorsdata['subcounties']=SubCounties::all();
		$guarantorsdata['clients']=Clients::all();
		$guarantors->first_name=$request->get('first_name');
		$guarantors->middle_name=$request->get('middle_name');
		$guarantors->last_name=$request->get('last_name');
		$guarantors->occupation=$request->get("occupation");
		$guarantors->id_number=$request->get('id_number');
		$guarantors->client=$request->get('client');
		$guarantors->relationship=$request->get("relationship");
		$guarantors->county=$request->get('county');
		$guarantors->sub_county=$request->get('sub_county');
		$guarantors->primary_phone_number=$request->get('primary_phone_number');
		$guarantors->secondary_phone_number=$request->get('secondary_phone_number');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Guarantors']])->get();
		$guarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($guarantorsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('guarantorsdata'));
		}else{
		$guarantors->save();
		$guarantorsdata['data']=Guarantors::find($id);
		return view('admin.guarantors.edit',compact('guarantorsdata','id'));
		}
	}

	public function destroy($id){
		$guarantors=Guarantors::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Guarantors']])->get();
		$guarantorsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($guarantorsdata['usersaccountsroles'][0]) && $guarantorsdata['usersaccountsroles'][0]['_delete']==1){
			$guarantors->delete();
		}return redirect('admin/guarantors')->with('success','guarantors has been deleted!');
	}

	public function getguarantorbyidno($idno,$client){
		return Guarantors::where([["id_number","=",$idno],["client","=",$client]])->get();
	}
}