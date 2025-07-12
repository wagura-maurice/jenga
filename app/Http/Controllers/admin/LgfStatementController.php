<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Clients;
use App\Companies;
use App\Modules;
use App\Users;
use App\Genders;
use App\GroupClients;
use App\MaritalStatuses;
use App\ClientTypes;
use App\Industries;
use App\ClientCategories;
use App\MembershipFees;
use App\ChangeTypeRequests;
use App\ChangeTypeRequestStatuses;
use App\ClientTypeMembershipFees;
use Carbon\Carbon;
use App\LgfContributionConfigurations;
use App\GeneralLedgers;
use App\EntryTypes;
use App\Accounts;
use App\Counties;
use App\SubCounties;
use App\NextOfKinRelationships;
use App\Employees;
use App\Positions;
use App\ClientOfficers;
use App\Groups;
use App\Salutations;
use App\TransactionStatuses;
use App\MainEconomicActivities;
use App\SecondaryEconomicActivities;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\UsersAccountsRoles;
use App\ChangeGroupRequests;
use App\ChangeGroupRequestStatuses;
class LgfStatementController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$clientsdata['salutations']=Salutations::all();

		$clientsdata['blacklisted']=ClientCategories::where([['code','=','003']])->get();
		$clientsdata['suspended']=ClientCategories::where([['code','=','004']])->get();
		$clientsdata['removed']=ClientCategories::where([['code','=','005']])->get();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['groupclient']=ClientTypes::where([['code','=','001']])->get();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['active']=ClientCategories::where([['code','=','002']])->get();
		$clientsdata['counties']=Counties::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();
		$clientsdata['list']=Clients::orderBy('id','desc')->take(100)->skip(0)->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_add']==0&&$clientsdata['usersaccountsroles'][0]['_list']==0&&$clientsdata['usersaccountsroles'][0]['_edit']==0&&$clientsdata['usersaccountsroles'][0]['_edit']==0&&$clientsdata['usersaccountsroles'][0]['_show']==0&&$clientsdata['usersaccountsroles'][0]['_delete']==0&&$clientsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
			return view('admin.lgf_statement.index',compact('clientsdata'));
		}
	}


	public function show($id){

		$clientstatement['company']=Companies::all();
		$client=clients::find($id);
		$clientstatement["client"]=$client;
		$clientstatement["date"]=Carbon::now()->toDateTimeString();
		$lgfContributionConfiguration=LgfContributionConfigurations::where([['client_type','=',$client->client_type]])->get()->first();

		$clientstatement["data"]=GeneralLedgers::where([["client","=",$client->id],["account","=",$lgfContributionConfiguration->credit_account]])->get();

		for($r=0;$r<count($clientstatement["data"]); $r++){

				$debit=EntryTypes::where([['code','=','001']])->get()->first();

				if($debit->id==$clientstatement["data"][$r]->entry_type){
					$clientstatement["data"][$r]->amount=-$clientstatement["data"][($r)]->amount;
				}else{
					$clientstatement["data"][$r]->amount=$clientstatement["data"][($r)]->amount;
				}			

			if($r>0){

					$clientstatement["data"][$r]->balance=$clientstatement["data"][$r-1]->balance+($clientstatement["data"][$r]->amount);					
			}else{
				$clientstatement["data"][$r]->balance=($clientstatement["data"][$r]->amount);					
				
			}

		}	

		return view('admin.lgf_statement.show',compact('clientstatement'));

	}

}

?>