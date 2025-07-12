<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\UsersAccounts;
use App\Companies;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class UsersAccountsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$usersaccountsdata['list']=UsersAccounts::all();
		return view('admin.users_accounts.index',compact('usersaccountsdata'));
	}

	public function create(){

		// $usersaccountsdata;
		// return view('admin.users_accounts.create',
		
		return view('admin.users_accounts.create');
	}

	public function filter(Request $request){
		$usersaccountsdata['list']=UsersAccounts::where([['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		return view('admin.users_accounts.index',compact('usersaccountsdata'));
	}

	public function report(){
		$usersaccountsdata['company']=Companies::all();
		$usersaccountsdata['list']=UsersAccounts::all();
		return view('admin.users_accounts.report',compact('usersaccountsdata'));
	}

	public function chart(){
		return view('admin.users_accounts.chart');
	}

	public function store(Request $request){
		$usersaccounts=new UsersAccounts();
		$usersaccounts->name=$request->get('name');
		$usersaccounts->description=$request->get('description');
		$response=array();
		try{
			if($usersaccounts->save()){
				$response['status']='1';
				$response['message']='users accounts Added successfully';
				return json_encode($response);
		}else{
				$response['status']='0';
				$response['message']='Failed to add users accounts. Please try again';
				return json_encode($response);
		}
		}
		catch(Exception $e){
				$response['status']='0';
				$response['message']='An Error occured while attempting to add users accounts. Please try again';
				return json_encode($response);
		}
		return json_encode($response);
	}

	public function edit($id){
		$usersaccountsdata['data']=UsersAccounts::find($id);
		return view('admin.users_accounts.edit',compact('usersaccountsdata','id'));
	}

	public function show($id){
		$usersaccountsdata['data']=UsersAccounts::find($id);
		return view('admin.users_accounts.show',compact('usersaccountsdata','id'));
	}

	public function update(Request $request,$id){
		$usersaccounts=UsersAccounts::find($id);
		$usersaccounts->name=$request->get('name');
		$usersaccounts->description=$request->get('description');
		$usersaccounts->save();
		$usersaccountsdata['data']=UsersAccounts::find($id);
		return view('admin.users_accounts.edit',compact('usersaccountsdata','id'));
	}

	public function destroy($id){
		$usersaccounts=UsersAccounts::find($id);
		$usersaccounts->delete();return redirect('admin/usersaccounts')->with('success','users accounts has been deleted!');
	}
}