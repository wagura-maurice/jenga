<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (Product Suppliers)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Suppliers;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class SuppliersController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$suppliersdata['list']=Suppliers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Suppliers']])->get();
		$suppliersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($suppliersdata['usersaccountsroles'][0]['_add']==0&&$suppliersdata['usersaccountsroles'][0]['_list']==0&&$suppliersdata['usersaccountsroles'][0]['_edit']==0&&$suppliersdata['usersaccountsroles'][0]['_edit']==0&&$suppliersdata['usersaccountsroles'][0]['_show']==0&&$suppliersdata['usersaccountsroles'][0]['_delete']==0&&$suppliersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('suppliersdata'));
		}else{
			return view('admin.suppliers.index',compact('suppliersdata'));
		}
	}

	public function create(){
		$suppliersdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Suppliers']])->get();
		$suppliersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($suppliersdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('suppliersdata'));
		}else{
			return view('admin.suppliers.create',compact('suppliersdata'));
		}
	}

	public function filter(Request $request){
		$suppliersdata['list']=Suppliers::where([['name','LIKE','%'.$request->get('name').'%'],['phone_number','LIKE','%'.$request->get('phone_number').'%'],['email_address','LIKE','%'.$request->get('email_address').'%'],['postal_code','LIKE','%'.$request->get('postal_code').'%'],['postal_address','LIKE','%'.$request->get('postal_address').'%'],['street','LIKE','%'.$request->get('street').'%'],['town','LIKE','%'.$request->get('town').'%'],['contact_person_name','LIKE','%'.$request->get('contact_person_name').'%'],['contact_person_phone_number','LIKE','%'.$request->get('contact_person_phone_number').'%'],['contact_person_email_address','LIKE','%'.$request->get('contact_person_email_address').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Suppliers']])->get();
		$suppliersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($suppliersdata['usersaccountsroles'][0]['_add']==0&&$suppliersdata['usersaccountsroles'][0]['_list']==0&&$suppliersdata['usersaccountsroles'][0]['_edit']==0&&$suppliersdata['usersaccountsroles'][0]['_edit']==0&&$suppliersdata['usersaccountsroles'][0]['_show']==0&&$suppliersdata['usersaccountsroles'][0]['_delete']==0&&$suppliersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('suppliersdata'));
		}else{
			return view('admin.suppliers.index',compact('suppliersdata'));
		}
	}

	public function report(){
		$suppliersdata['company']=Companies::all();
		$suppliersdata['list']=Suppliers::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Suppliers']])->get();
		$suppliersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($suppliersdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('suppliersdata'));
		}else{
			return view('admin.suppliers.report',compact('suppliersdata'));
		}
	}

	public function chart(){
		return view('admin.suppliers.chart');
	}

	public function store(Request $request){
		$suppliers=new Suppliers();
		$suppliers->name=$request->get('name');
		$suppliers->phone_number=$request->get('phone_number');
		$suppliers->email_address=$request->get('email_address');
		$suppliers->postal_code=$request->get('postal_code');
		$suppliers->postal_address=$request->get('postal_address');
		$suppliers->street=$request->get('street');
		$suppliers->town=$request->get('town');
		$suppliers->contact_person_name=$request->get('contact_person_name');
		$suppliers->contact_person_phone_number=$request->get('contact_person_phone_number');
		$suppliers->contact_person_email_address=$request->get('contact_person_email_address');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Suppliers']])->get();
		$suppliersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($suppliersdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($suppliers->save()){
					$response['status']='1';
					$response['message']='Suppliers Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add Suppliers. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add Suppliers. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$suppliersdata['data']=Suppliers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Suppliers']])->get();
		$suppliersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($suppliersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('suppliersdata'));
		}else{
		return view('admin.suppliers.edit',compact('suppliersdata','id'));
		}
	}

	public function show($id){
		$suppliersdata['data']=Suppliers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Suppliers']])->get();
		$suppliersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($suppliersdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('suppliersdata'));
		}else{
		return view('admin.suppliers.show',compact('suppliersdata','id'));
		}
	}

	public function update(Request $request,$id){
		$suppliers=Suppliers::find($id);
		$suppliers->name=$request->get('name');
		$suppliers->phone_number=$request->get('phone_number');
		$suppliers->email_address=$request->get('email_address');
		$suppliers->postal_code=$request->get('postal_code');
		$suppliers->postal_address=$request->get('postal_address');
		$suppliers->street=$request->get('street');
		$suppliers->town=$request->get('town');
		$suppliers->contact_person_name=$request->get('contact_person_name');
		$suppliers->contact_person_phone_number=$request->get('contact_person_phone_number');
		$suppliers->contact_person_email_address=$request->get('contact_person_email_address');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Suppliers']])->get();
		$suppliersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($suppliersdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('suppliersdata'));
		}else{
		$suppliers->save();
		$suppliersdata['data']=Suppliers::find($id);
		return view('admin.suppliers.edit',compact('suppliersdata','id'));
		}
	}

	public function destroy($id){
		$suppliers=Suppliers::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Suppliers']])->get();
		$suppliersdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($suppliersdata['usersaccountsroles'][0]['_delete']==1){
			$suppliers->delete();
		}return redirect('admin/suppliers')->with('success','Suppliers has been deleted!');
	}
}