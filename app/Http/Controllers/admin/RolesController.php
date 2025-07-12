<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Roles;
use App\Companies;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class RolesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$rolesdata['list']=Roles::all();
		return view('admin.roles.index',compact('rolesdata'));
	}

	public function create(){
		$rolesdata;
		return view('admin.roles.create',compact('rolesdata'));
	}

	public function filter(Request $request){
		$rolesdata['list']=Roles::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		return view('admin.roles.index',compact('rolesdata'));
	}

	public function report(){
		$rolesdata['company']=Companies::all();
		$rolesdata['list']=Roles::all();
		return view('admin.roles.report',compact('rolesdata'));
	}

	public function chart(){
		return view('admin.roles.chart');
	}

	public function store(Request $request){
		$roles=new Roles();
		$roles->code=$request->get('code');
		$roles->name=$request->get('name');
		$roles->description=$request->get('description');
		$response=array();
		try{
			if($roles->save()){
				$response['status']='1';
				$response['message']='roles Added successfully';
				return json_encode($response);
		}else{
				$response['status']='0';
				$response['message']='Failed to add roles. Please try again';
				return json_encode($response);
		}
		}
		catch(Exception $e){
				$response['status']='0';
				$response['message']='An Error occured while attempting to add roles. Please try again';
				return json_encode($response);
		}
		return json_encode($response);
	}

	public function edit($id){
		$rolesdata['data']=Roles::find($id);
		return view('admin.roles.edit',compact('rolesdata','id'));
	}

	public function show($id){
		$rolesdata['data']=Roles::find($id);
		return view('admin.roles.show',compact('rolesdata','id'));
	}

	public function update(Request $request,$id){
		$roles=Roles::find($id);
		$roles->code=$request->get('code');
		$roles->name=$request->get('name');
		$roles->description=$request->get('description');
		$roles->save();
		$rolesdata['data']=Roles::find($id);
		return view('admin.roles.edit',compact('rolesdata','id'));
	}

	public function destroy($id){
		$roles=Roles::find($id);
		$roles->delete();return redirect('admin/roles')->with('success','roles has been deleted!');
	}
}