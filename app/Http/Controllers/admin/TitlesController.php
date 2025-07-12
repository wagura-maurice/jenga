<?php
/**
 * @author  Wanjala Innocent Khaemba
 */
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Titles;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class TitlesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$titlesdata['list']=Titles::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Titles']])->get();
		$titlesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($titlesdata['usersaccountsroles'][0]['_add']==0&&$titlesdata['usersaccountsroles'][0]['_list']==0&&$titlesdata['usersaccountsroles'][0]['_edit']==0&&$titlesdata['usersaccountsroles'][0]['_edit']==0&&$titlesdata['usersaccountsroles'][0]['_show']==0&&$titlesdata['usersaccountsroles'][0]['_delete']==0&&$titlesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('titlesdata'));
		}else{
			return view('admin.titles.index',compact('titlesdata'));
		}
	}

	public function create(){
		$titlesdata;
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Titles']])->get();
		$titlesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($titlesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('titlesdata'));
		}else{
			return view('admin.titles.create',compact('titlesdata'));
		}
	}

	public function filter(Request $request){
		$titlesdata['list']=Titles::where([['code','LIKE','%'.$request->get('code').'%'],['name','LIKE','%'.$request->get('name').'%'],['abbreviation','LIKE','%'.$request->get('abbreviation').'%'],['description','LIKE','%'.$request->get('description').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Titles']])->get();
		$titlesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($titlesdata['usersaccountsroles'][0]['_add']==0&&$titlesdata['usersaccountsroles'][0]['_list']==0&&$titlesdata['usersaccountsroles'][0]['_edit']==0&&$titlesdata['usersaccountsroles'][0]['_edit']==0&&$titlesdata['usersaccountsroles'][0]['_show']==0&&$titlesdata['usersaccountsroles'][0]['_delete']==0&&$titlesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('titlesdata'));
		}else{
			return view('admin.titles.index',compact('titlesdata'));
		}
	}

	public function report(){
		$titlesdata['company']=Companies::all();
		$titlesdata['list']=Titles::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Titles']])->get();
		$titlesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($titlesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('titlesdata'));
		}else{
			return view('admin.titles.report',compact('titlesdata'));
		}
	}

	public function chart(){
		return view('admin.titles.chart');
	}

	public function store(Request $request){
		$titles=new Titles();
		$titles->code=$request->get('code');
		$titles->name=$request->get('name');
		$titles->abbreviation=$request->get('abbreviation');
		$titles->description=$request->get('description');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Titles']])->get();
		$titlesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($titlesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($titles->save()){
					$response['status']='1';
					$response['message']='titles Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add titles. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add titles. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$titlesdata['data']=Titles::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Titles']])->get();
		$titlesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($titlesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('titlesdata'));
		}else{
		return view('admin.titles.edit',compact('titlesdata','id'));
		}
	}

	public function show($id){
		$titlesdata['data']=Titles::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Titles']])->get();
		$titlesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($titlesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('titlesdata'));
		}else{
		return view('admin.titles.show',compact('titlesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$titles=Titles::find($id);
		$titles->code=$request->get('code');
		$titles->name=$request->get('name');
		$titles->abbreviation=$request->get('abbreviation');
		$titles->description=$request->get('description');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Titles']])->get();
		$titlesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($titlesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('titlesdata'));
		}else{
		$titles->save();
		$titlesdata['data']=Titles::find($id);
		return view('admin.titles.edit',compact('titlesdata','id'));
		}
	}

	public function destroy($id){
		$titles=Titles::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Titles']])->get();
		$titlesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($titlesdata['usersaccountsroles'][0]['_delete']==1){
			$titles->delete();
		}return redirect('admin/titles')->with('success','titles has been deleted!');
	}
}