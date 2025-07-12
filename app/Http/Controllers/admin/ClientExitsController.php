<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (client exits)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ClientExits;
use App\Companies;
use App\Modules;
use App\ApprovalStatuses;
use App\ApprovalLevels;
use App\ClientExitApprovals;
use App\ClientExitApprovalLevels;
use App\Clients;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\ClientCategories;

use App\UsersAccountsRoles;
class ClientExitsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$clientexitsdata['clients']=Clients::all();
		$clientexitsdata['users']=Users::all();
		$clientexitsdata['list']=ClientExits::all();
		$clientexitsdata["approvalstatuses"]=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExits']])->get();
		$clientexitsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitsdata['usersaccountsroles'][0]) && $clientexitsdata['usersaccountsroles'][0]['_add']==0&&$clientexitsdata['usersaccountsroles'][0]['_list']==0&&$clientexitsdata['usersaccountsroles'][0]['_edit']==0&&$clientexitsdata['usersaccountsroles'][0]['_edit']==0&&$clientexitsdata['usersaccountsroles'][0]['_show']==0&&$clientexitsdata['usersaccountsroles'][0]['_delete']==0&&$clientexitsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientexitsdata'));
		}else{
			return view('admin.client_exits.index',compact('clientexitsdata'));
		}
	}

	public function create(){
		$clientexitsdata;
		$clientexitsdata['clients']=Clients::all();
		$clientexitsdata['users']=Users::all();
		$clientexitsdata["approvalstatuses"]=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExits']])->get();
		$clientexitsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitsdata['usersaccountsroles'][0]) && $clientexitsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clientexitsdata'));
		}else{
			return view('admin.client_exits.create',compact('clientexitsdata'));
		}
	}

	public function filter(Request $request){
		$clientexitsdata['clients']=Clients::all();
		$clientexitsdata['users']=Users::all();
		$clientexitsdata['list']=ClientExits::where([['client','LIKE','%'.$request->get('client').'%'],['initiated_by','LIKE','%'.$request->get('initiated_by').'%'],['reason','LIKE','%'.$request->get('reason').'%'],['remarks','LIKE','%'.$request->get('remarks').'%'],])->orWhereBetween('request_date',[$request->get('request_datefrom'),$request->get('request_dateto')])->orWhereBetween('approved_date',[$request->get('approved_datefrom'),$request->get('approved_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExits']])->get();
		$clientexitsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitsdata['usersaccountsroles'][0]) && $clientexitsdata['usersaccountsroles'][0]['_add']==0&&$clientexitsdata['usersaccountsroles'][0]['_list']==0&&$clientexitsdata['usersaccountsroles'][0]['_edit']==0&&$clientexitsdata['usersaccountsroles'][0]['_edit']==0&&$clientexitsdata['usersaccountsroles'][0]['_show']==0&&$clientexitsdata['usersaccountsroles'][0]['_delete']==0&&$clientexitsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientexitsdata'));
		}else{
			return view('admin.client_exits.index',compact('clientexitsdata'));
		}
	}

	public function report(){
		$clientexitsdata['company']=Companies::all();
		$clientexitsdata['list']=ClientExits::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExits']])->get();
		$clientexitsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitsdata['usersaccountsroles'][0]) && $clientexitsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientexitsdata'));
		}else{
			return view('admin.client_exits.report',compact('clientexitsdata'));
		}
	}

	public function chart(){
		return view('admin.client_exits.chart');
	}

	public function store(Request $request){
		$clientexits=new ClientExits();
		$clientexits->client=$request->get('client');
		$clientexits->exit_number=$request->get('exit_number');
		$clientexits->request_date=$request->get('request_date');
		$clientexits->initiated_by=$request->get('initiated_by');
		$clientexits->reason=$request->get('reason');
		$clientexits->remarks=$request->get('remarks');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$clientexits->initiated_by=$user[0]["id"];
		$approvalstatuses=ApprovalStatuses::where([["code","=","003"]])->get()->first();
		$clientexits->approval_status=$approvalstatuses->id;

		$module=Modules::where([['name','=','ClientExits']])->get();
		$clientexitsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitsdata['usersaccountsroles'][0]) && $clientexitsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($clientexits->save()){
					$response['status']='1';
					$response['message']='client exits Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add client exits. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add client exits. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$clientexitsdata['clients']=Clients::all();
		$clientexitsdata['users']=Users::all();
		$clientexitsdata["approvalstatuses"]=ApprovalStatuses::all();
		$clientexitsdata['data']=ClientExits::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExits']])->get();

		$mymapping=ClientExitApprovalLevels::where([["client_type","=",$clientexitsdata['data']->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();

		$clientexitsdata['mymapping']=$mymapping;

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$clientexitsdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=ClientExitApprovals::where([["client_exit","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=ClientExitApprovals::where([["client_exit","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$clientexitsdata['myturn']="1";
					}else if(isset($clientexitsdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$clientexitsdata['myturn']="1";
					}else if(isset($myapproval)){
						$clientexitsdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$clientexitsdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}

		$clientexitsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitsdata['usersaccountsroles'][0]) && $clientexitsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientexitsdata'));
		}else{
		return view('admin.client_exits.edit',compact('clientexitsdata','id'));
		}
	}

	public function show($id){
		$clientexitsdata['clients']=Clients::all();
		$clientexitsdata['users']=Users::all();
		$clientexitsdata['data']=ClientExits::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExits']])->get();
		$clientexitsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitsdata['usersaccountsroles'][0]) && $clientexitsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clientexitsdata'));
		}else{
		return view('admin.client_exits.show',compact('clientexitsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clientexits=ClientExits::find($id);
		$clientexitsdata['data']=$clientexits;
		$clientexitsdata['clients']=Clients::all();
		$clientexitsdata['users']=Users::all();
		$clientexitsdata["approvalstatuses"]=ApprovalStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExits']])->get();
		$clientexitsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientexitsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientexitsdata'));
		}else{

		$mymapping=ClientExitApprovalLevels::where([["client_type","=",$clientexitsdata['data']->clientmodel->client_type],["user_account","=",$user[0]->user_account]])->get()->first();

		if($clientexits->approvalstatusmodel->code=="003"){
			DB::transaction(function() use($request,$user,$id,$mymapping,$clientexits,$clientexitsdata){
				try{

					$clientexitapproval=new ClientExitApprovals();
					$clientexitapproval->client_exit=$id;
					$clientexitapproval->approval_level=$mymapping->approval_level;
					$clientexitapproval->approved_by=$user[0]->id;
					$clientexitapproval->user_account=$user[0]->user_account;
					$clientexitapproval->remarks=$request->get('remarks');
					$clientexitapproval->approval_status=$request->get('approval_status');
					$clientexitapproval->save();

					$mappings=ClientExitApprovalLevels::where([["client_type","=",$clientexits->clientmodel->client_type]])->get();

					$maxapprovallevel=0;

					for($r=0;$r<count($mappings);$r++){

						$maxapprovallevel=$mappings[$r]->approvallevelmodel->approval_level>$maxapprovallevel?$mappings[$r]->approvallevelmodel->approval_level:$maxapprovallevel;
					}

					$rejeted=ApprovalStatuses::where([["code","=","002"]])->get()->first();

					if($maxapprovallevel==$mymapping->approvallevelmodel->approval_level || $rejeted->id==$request->get('approval_status')){

						$clientexits->approval_status=$request->get('approval_status');

						$clientexits->save();

						$approved=ApprovalStatuses::where([["code","=","001"]])->get()->first();

						if($approved->id==$clientexits->approval_status){
							
							
							$clientcategory=ClientCategories::where([["code","=","006"]])->get()->first();

							$client=Clients::find($clientexits->client);

							$client->client_category=$clientcategory->id;

							$client->save();

				
						}
											
					}

				}catch(Exception $e){

				}
			});			
		}

		$clientexitsdata['mymapping']=$mymapping;

		if(isset($mymapping)){

			$approvallevels=ApprovalLevels::orderByDesc("approval_level")->get();

			$clientexitsdata['otherapprovals']=array();

			$l=0;

			for($r=count($approvallevels)-1;$r>=0;$r--){

				$otherapproval=ClientExitApprovals::where([["client_exit","=",$id],["approval_level","=",$approvallevels[$r]->id]])->get();

				if($approvallevels[$r]->approval_level==$mymapping->approvallevelmodel->approval_level){

					$myapproval=ClientExitApprovals::where([["client_exit","=",$id],["approval_level","=",$mymapping->approval_level]])->get();						

					if(($l-1)<0 && !isset($myapproval[0]) ){
						$clientexitsdata['myturn']="1";
					}else if(isset($clientexitsdata['otherapprovals'][$l-1]) && !isset($myapproval[0]) ){
						$clientexitsdata['myturn']="1";
					}else if(isset($myapproval)){
						$clientexitsdata['otherapprovals'][$l]=$myapproval;
						$l++;
					}
				}

				if($approvallevels[$r]->approval_level<$mymapping->approvallevelmodel->approval_level && isset($otherapproval))
				{
					$clientexitsdata['otherapprovals'][$l]=$otherapproval;
					$l++;
				}

			}
		}
		$clientexitsdata['data']=ClientExits::find($id);
		return view('admin.client_exits.edit',compact('clientexitsdata','id'));
		}
	}

	public function destroy($id){
		$clientexits=ClientExits::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ClientExits']])->get();
		$clientexitsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if(isset($clientexitsdata['usersaccountsroles'][0]) && $clientexitsdata['usersaccountsroles'][0]['_delete']==1){
			$clientexits->delete();
		}return redirect('admin/clientexits')->with('success','client exits has been deleted!');
	}


	public function getclientexitnumber(){

		return (ClientExits::all()->count()+1);

	}
}