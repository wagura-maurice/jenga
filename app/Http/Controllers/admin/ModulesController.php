<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Modules;
use App\Companies;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\UsersAccountsRoles;
class ModulesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$modulesdata=Modules::all();
		return view('modules.show',compact('modulesdata'));
	}

	public function create(){
		return view('modules.create');
	}

	public function report(){
		$modulesdata['company']=Companies::all();
		$modulesdata['list']=Modules::all();
		return view('modules.report',compact('modulesdata'));
	}

	public function chart(){
		return view('modules.chart');
	}

	public function store(Request $request){
		DB::transaction(function() use($request){
			$modules=new Modules();

			$modules->name=$request->get('name');
			$modules->description=$request->get('description');
			$modules->save();
			$user=Users::where([['id','=',Auth::id()]])->get();
			$usersaccountsroles=new UsersAccountsRoles();
			$usersaccountsroles->module=$modules->id;
			$usersaccountsroles->user_account=$user[0]->user_account;
			$usersaccountsroles->_add=0;
			$usersaccountsroles->_list=0;
			$usersaccountsroles->_edit=0;
			$usersaccountsroles->_delete=0;
			$usersaccountsroles->_show=0;
			$usersaccountsroles->_report=0;		
			$usersaccountsroles->save();

		});
		return redirect('modules')->with('success','New modules has been addded!');
	}

	public function edit($id){
		$modules=Modules::find($id);
		return view('modules.edit',compact('modules','id'));
	}

	public function update(Request $request,$id){
		$modules=Modules::find($id);
		$modules->name=$request->get('name');
		$modules->description=$request->get('description');
		$modules->save();
		return redirect('modules');
	}

	public function destroy($id){
		$modules=Modules::find($id);
		$modules->delete();return redirect('modules')->with('success','modules has been deleted!');
	}
}