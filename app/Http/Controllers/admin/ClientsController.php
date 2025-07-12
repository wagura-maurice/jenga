<?php

namespace App\Http\Controllers\admin;

use Group;
use App\Loans;
use App\Users;
use Exception;
use App\Groups;
use App\Clients;
use App\Genders;
use App\Modules;
use App\Counties;
use App\Companies;
use App\Employees;
use App\Positions;
use Carbon\Carbon;
use App\EntryTypes;
use App\Industries;
use App\ClientTypes;
use App\Salutations;
use App\SubCounties;
use App\GroupClients;
use App\LoanPayments;
use App\LoanProducts;
use App\LoanStatuses;
use App\Http\Requests;
use App\OtherPayments;
use App\ClientOfficers;
use App\GeneralLedgers;
use App\GroupCashBooks;
use App\MembershipFees;
use App\PageCollection;
use App\GroupLeadership;
use App\MaritalStatuses;
use App\ClientCategories;
use App\ClientLgfBalances;
use App\LoanDisbursements;
use App\OtherPaymentTypes;
use App\ChangeTypeRequests;
use App\UsersAccountsRoles;
use App\ChangeGroupRequests;
use App\ClearingFeePayments;
use App\TransactionStatuses;
use Illuminate\Http\Request;
use App\DisbursementStatuses;
use App\ProcessingFeePayments;
use App\ClientLgfContributions;
use App\MainEconomicActivities;
use App\NextOfKinRelationships;
use App\ClientTypeMembershipFees;
use App\ChangeTypeRequestStatuses;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\ChangeGroupRequestStatuses;
use App\InsuranceDeductionPayments;
use App\Http\Controllers\Controller;
use App\SecondaryEconomicActivities;
use Illuminate\Support\Facades\Auth;
use App\LgfContributionConfigurations;
use App\ProductInterestConfigurations;
use App\ProductPrincipalConfigurations;
use App\OtherPaymentTypeAccountMappings;

class ClientsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(Request $request) {
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

		$clients = Clients::with('clienttypemodel', 'clientcategorymodel');

		if (isset($request->client_number)) {
			$clientsdata['client_number'] = trim($request->client_number);
			$clients->where('client_number', trim($request->client_number));
		}
		
		if (isset($request->primary_phone_number)) {
			$clientsdata['primary_phone_number'] = trim($request->primary_phone_number);
			$clients->where('primary_phone_number', trim($request->primary_phone_number));
		}

		if (isset($request->national_id_number)) {
			$clientsdata['id_number'] = trim($request->national_id_number);
			$clients->where('id_number', trim($request->national_id_number));
		}

		$clientsdata['list']= auth()->user()->user_account != '8' ? $clients->where('officer_id', auth()->user()->employeemodel->id)->orderBy('id','desc')->paginate(100) : $clients->orderBy('id','desc')->paginate(100);

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_add']==0&&$clientsdata['usersaccountsroles'][0]['_list']==0&&$clientsdata['usersaccountsroles'][0]['_edit']==0&&$clientsdata['usersaccountsroles'][0]['_edit']==0&&$clientsdata['usersaccountsroles'][0]['_show']==0&&$clientsdata['usersaccountsroles'][0]['_delete']==0&&$clientsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
			return view('admin.clients.index',compact('clientsdata'));
		}
	}

	function getclients(Request $request){

		$start=$request->get("start");
		$length=$request->get("length");

		$searchvalue=$request->get("search")["value"];

		if(isset($searchvalue) && !empty($searchvalue)){

			$data=Clients::where([['client_number','LIKE','%'.$searchvalue.'%']])->orWhere([['first_name','LIKE','%'.$searchvalue.'%']])->orWhere([['middle_name','LIKE','%'.$searchvalue.'%']])->orWhere([['last_name','LIKE','%'.$searchvalue.'%']])->orWhere([['id_number','LIKE','%'.$searchvalue.'%']])->orWhere([['primary_phone_number','LIKE','%'.$searchvalue.'%']])->orWhere([['secondary_phone_number','LIKE','%'.$searchvalue.'%']])->orWhere([['email_address','LIKE','%'.$searchvalue.'%']])->with('clienttypemodel')->orderBy('created_at','desc')->take($length)->skip($start)->get();
		}else{
			$data=Clients::with('clienttypemodel')->orderBy('created_at','desc')->take($length)->skip($start)->get();
		}

		$totalcount=Clients::all()->count();

		$collection=new PageCollection();
		$collection->aaData=$data;
		$collection->iTotalRecords=$totalcount;
		$collection->iTotalDisplayRecords=$totalcount;

		return json_encode($collection);
	}

	function clientsCount(){
		$count=Clients::count();
		return $count;
	}

	public function create(){
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['industries']=Industries::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']= auth()->user()->user_account != '8' ? Groups::where('officer', auth()->user()->employeemodel->id)->get() : Groups::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		
		$position=Positions::where([['code','=','BDO']])->get();

		$clientsdata['employees']= auth()->user()->user_account != '8' ? Employees::where([
			'position' => $position[0]['id'],
			'user_id' => auth()->user()->id
		])->get() : Employees::where([['position','=',$position[0]['id']]])->get();

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
			return view('admin.clients.create',compact('clientsdata'));
		}
	}

	public function importfromdb(){
		$clientsdata;
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['subcounties']=SubCounties::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
			return view('admin.clients.import_from_db',compact('clientsdata'));
		}
	}	

	public function filter(Request $request){
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
		$clientsdata['industries']=Industries::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();

		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();

		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['list']=Clients::where([['client_number','LIKE','%'.$request->get('client_number').'%'],['first_name','LIKE','%'.$request->get('first_name').'%'],['middle_name','LIKE','%'.$request->get('middle_name').'%'],['last_name','LIKE','%'.$request->get('last_name').'%'],['id_number','LIKE','%'.$request->get('id_number').'%'],['primary_phone_number','LIKE','%'.$request->get('primary_phone_number').'%'],['secondary_phone_number','LIKE','%'.$request->get('secondary_phone_number').'%'],['gender','LIKE','%'.$request->get('gender').'%'],['marital_status','LIKE','%'.$request->get('marital_status').'%'],['postal_address','LIKE','%'.$request->get('postal_address').'%'],['postal_code','LIKE','%'.$request->get('postal_code').'%'],['postal_town','LIKE','%'.$request->get('postal_town').'%'],['email_address','LIKE','%'.$request->get('email_address').'%'],['client_type','LIKE','%'.$request->get('client_type').'%'],['client_category','LIKE','%'.$request->get('client_category').'%'],['county','LIKE','%'.$request->get('county').'%'],['sub_county','LIKE','%'.$request->get('sub_county').'%'],['location','LIKE','%'.$request->get('location').'%'],['village','LIKE','%'.$request->get('village').'%'],['nearest_center','LIKE','%'.$request->get('nearest_center').'%'],['spouse_first_name','LIKE','%'.$request->get('spouse_first_name').'%'],['spouse_middle_name','LIKE','%'.$request->get('spouse_middle_name').'%'],['spouse_last_name','LIKE','%'.$request->get('spouse_last_name').'%'],['spouse_id_number','LIKE','%'.$request->get('spouse_id_number').'%'],['spouse_primary_phone_number','LIKE','%'.$request->get('spouse_primary_phone_number').'%'],['spouse_secondary_phone_number','LIKE','%'.$request->get('spouse_secondary_phone_number').'%'],['spouse_email_address','LIKE','%'.$request->get('spouse_email_address').'%'],['next_of_kin_first_name','LIKE','%'.$request->get('next_of_kin_first_name').'%'],['next_of_kin_middle_name','LIKE','%'.$request->get('next_of_kin_middle_name').'%'],['next_of_kin_last_name','LIKE','%'.$request->get('next_of_kin_last_name').'%'],['relationship_with_next_of_kin','LIKE','%'.$request->get('relationship_with_next_of_kin').'%'],['next_of_kin_primary_phone_number','LIKE','%'.$request->get('next_of_kin_primary_phone_number').'%'],['next_of_kin_secondary_phone_number','LIKE','%'.$request->get('next_of_kin_secondary_phone_number').'%'],['next_of_kin_email_address','LIKE','%'.$request->get('next_of_kin_email_address').'%'],['next_of_kin_county','LIKE','%'.$request->get('next_of_kin_county').'%'],['next_of_kin_sub_county','LIKE','%'.$request->get('next_of_kin_sub_county').'%'],['location','LIKE','%'.$request->get('location').'%'],['main_economic_activity','LIKE','%'.$request->get('main_economic_activity').'%'],['secondary_economic_activity','LIKE','%'.$request->get('secondary_economic_activity').'%'],['comments','LIKE','%'.$request->get('comments').'%'],])->orWhereBetween('date_of_birth',[$request->get('date_of_birthfrom'),$request->get('date_of_birthto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_add']==0&&$clientsdata['usersaccountsroles'][0]['_list']==0&&$clientsdata['usersaccountsroles'][0]['_edit']==0&&$clientsdata['usersaccountsroles'][0]['_edit']==0&&$clientsdata['usersaccountsroles'][0]['_show']==0&&$clientsdata['usersaccountsroles'][0]['_delete']==0&&$clientsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
			return view('admin.clients.index',compact('clientsdata'));
		}
	}

	function clientssearch(){
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

		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();		
		
		
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_add']==0&&$clientsdata['usersaccountsroles'][0]['_list']==0&&$clientsdata['usersaccountsroles'][0]['_edit']==0&&$clientsdata['usersaccountsroles'][0]['_edit']==0&&$clientsdata['usersaccountsroles'][0]['_show']==0&&$clientsdata['usersaccountsroles'][0]['_delete']==0&&$clientsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
			return view('admin.clients.search',compact('clientsdata'));
		}
	}
	function searchclient(Request $request){
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

		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();		
		$searchtext=$request->get("search_text");
		$searchtextarr=explode(" ",$searchtext);
		if(count($searchtextarr)==1){
			$clientsdata['list']=Clients::where([['first_name','like','%'.$searchtext.'%']])->orWhere([['middle_name','like','%'.$searchtext.'%']])->orWhere([['last_name','like','%'.$searchtext.'%']])->orWhere([['id_number','like','%'.$searchtext.'%']])->orWhere([['client_number','like','%'.$searchtext.'%']])->orderBy("id",'desc')->take(50)->skip(0)->get();
		}else if(count($searchtextarr)==2){
			$clientsdata['list']=Clients::where([['first_name','like','%'.$searchtextarr[1].'%']])->orWhere([['middle_name','like','%'.$searchtextarr[0].'%']])->orWhere([['last_name','like','%'.$searchtext.'%']])->orWhere([['id_number','like','%'.$searchtext.'%']])->orWhere([['client_number','like','%'.$searchtext.'%']])->orderBy("id",'desc')->take(50)->skip(0)->get();
		}else if(count($searchtextarr)==3){
			$clientsdata['list']=Clients::where([['first_name','like','%'.$searchtextarr[2].'%']])->orWhere([['middle_name','like','%'.$searchtextarr[1].'%']])->orWhere([['last_name','like','%'.$searchtextarr[0].'%']])->orWhere([['id_number','like','%'.$searchtext.'%']])->orWhere([['client_number','like','%'.$searchtext.'%']])->orderBy("id",'desc')->take(50)->skip(0)->get();
		}
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_add']==0&&$clientsdata['usersaccountsroles'][0]['_list']==0&&$clientsdata['usersaccountsroles'][0]['_edit']==0&&$clientsdata['usersaccountsroles'][0]['_edit']==0&&$clientsdata['usersaccountsroles'][0]['_show']==0&&$clientsdata['usersaccountsroles'][0]['_delete']==0&&$clientsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
			return view('admin.clients.index',compact('clientsdata'));
		}
	}

	public function report(){
		$clientsdata['company']=Companies::all();
		$clientsdata['list']=Clients::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
			return view('admin.clients.report',compact('clientsdata'));
		}
	}

	public function chart(){
		return view('admin.clients.chart');
	}

	public function store(Request $request){

		$clients=new Clients();

		$count=Clients::all()->count();

		if($count<10){
            $clients->client_number="C0000".($count+1);
        }else if($count<100){
            $clients->client_number="C000".($count+1);
        }else if($count<1000){
            $clients->client_number="C00".($count+1);
        }else if($count<10000){
            $clients->client_number="C0".($count+1);
        }else{
            $clients->client_number="C".($count+1);
        }

        $client=Clients::where([["client_number","=",$clients->client_number]])->get()->first();

        $count+=1;

        while(isset($client)){

				if($count<10){
		            $clients->client_number="C0000".($count+1);
		        }else if($count<100){
		            $clients->client_number="C000".($count+1);
		        }else if($count<1000){
		            $clients->client_number="C00".($count+1);
		        }else if($count<10000){
		            $clients->client_number="C0".($count+1);
		        }else{
		            $clients->client_number="C".($count+1);
		        }

        	$client=Clients::where([["client_number","=",$clients->client_number]])->get()->first();

        	$count+=1;
        }

		// $clients->client_number=$request->get('client_number');
		$clients->first_name=$request->get('first_name');
		$clients->middle_name=$request->get('middle_name');
		$clients->last_name=$request->get('last_name');
		$clients->id_number=$request->get('id_number');
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clients->primary_phone_number=$request->get('primary_phone_number');
		$clients->secondary_phone_number=$request->get('secondary_phone_number');
		$clients->gender=$request->get('gender');
		$clients->date_of_birth=$request->get('date_of_birth');
		$clients->marital_status=$request->get('marital_status');
		$clients->postal_address=$request->get('postal_address');
		$clients->postal_code=$request->get('postal_code');
		$clients->postal_town=$request->get('postal_town');
		$clients->email_address=$request->get('email_address');
		$clients->client_type=$request->get('client_type');
		$clients->client_category=$request->get('client_category');
		$clients->county=$request->get('county');
		$clients->sub_county=$request->get('sub_county');
		$clients->location=$request->get('location');
		$clients->village=$request->get('village');
		$clients->nearest_center=$request->get('nearest_center');
		$clients->spouse_first_name=$request->get('spouse_first_name');
		$clients->spouse_middle_name=$request->get('spouse_middle_name');
		$clients->spouse_last_name=$request->get('spouse_last_name');
		$clients->spouse_id_number=$request->get('spouse_id_number');
		$clients->spouse_primary_phone_number=$request->get('spouse_primary_phone_number');
		$clients->spouse_secondary_phone_number=$request->get('spouse_secondary_phone_number');
		$clients->spouse_email_address=$request->get('spouse_email_address');
		$clients->next_of_kin_first_name=$request->get('next_of_kin_first_name');
		$clients->next_of_kin_middle_name=$request->get('next_of_kin_middle_name');
		$clients->next_of_kin_last_name=$request->get('next_of_kin_last_name');
		$clients->relationship_with_next_of_kin=$request->get('relationship_with_next_of_kin');
		$clients->next_of_kin_primary_phone_number=$request->get('next_of_kin_primary_phone_number');
		$clients->next_of_kin_secondary_phone_number=$request->get('next_of_kin_secondary_phone_number');
		$clients->next_of_kin_email_address=$request->get('next_of_kin_email_address');
		$clients->next_of_kin_county=$request->get('next_of_kin_county');
		$clients->next_of_kin_sub_county=$request->get('next_of_kin_sub_county');
		$clients->location=$request->get('location');
		$clients->main_economic_activity=$request->get('main_economic_activity');
		$clients->secondary_economic_activity=$request->get('secondary_economic_activity');
		$clients->client_photo=time() . '_' . rand(1000, 9999) . '.jpg';
		$clients->client_finger_print=time() . '_' . rand(1000, 9999) . '.jpg';
		$clients->client_signature=time() . '_' . rand(1000, 9999) . '.jpg';
		$clients->comments=$request->get('comments');
		$clients->assigned_officer=$request->get('assigned_officer');
		$clients->home_image_1 = time() . '_' . rand(1000, 9999) . '.jpg';
		$clients->home_image_2 = time() . '_' . rand(1000, 9999) . '.jpg';
		$clients->home_image_3 = time() . '_' . rand(1000, 9999) . '.jpg';
		$clients->business_image_1 = time() . '_' . rand(1000, 9999) . '.jpg';
		$clients->business_image_2 = time() . '_' . rand(1000, 9999) . '.jpg';
		$clients->business_image_3 = time() . '_' . rand(1000, 9999) . '.jpg';
		$clients->home_gps_latitude = $request->get('home_gps_latitude');
		$clients->home_gps_longitude = $request->get('home_gps_longitude');
		$clients->business_gps_latitude = $request->get('business_gps_latitude');
		$clients->business_gps_longitude = $request->get('business_gps_longitude');
		$clients->front_national_id = time() . '_' . rand(1000, 9999) . '.jpg';
		$clients->back_national_id = time() . '_' . rand(1000, 9999) . '.jpg';

		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_show']==1){

			return DB::transaction(function() use($clients,$request){
				$response=array();
				try{	
					$clienttype=ClientTypes::find($clients->client_type);
					if($clienttype->code=="001"){	
						$clients->assigned_group='1';	

					}
					$clients->membership_fees_paid="0";

					if($clients->save()){
						$ClientPhotoImage = $request->file('client_photo');
						$ClientPhotoImage->move('uploads/images',$clients->client_photo);
						$ClientFingerPrintImage = $request->file('client_finger_print');
						$ClientFingerPrintImage->move('uploads/images',$clients->client_finger_print);
						$ClientSignatureImage = $request->file('client_signature');
						$ClientSignatureImage->move('uploads/images',$clients->client_signature);

						$ClientHomeImage1 = $request->file('home_image_1');
						$ClientHomeImage1->move('uploads/images',$clients->home_image_1);
						$ClientHomeImage2 = $request->file('home_image_2');
						$ClientHomeImage2->move('uploads/images',$clients->home_image_2);
						$ClientHomeImage3 = $request->file('home_image_3');
						$ClientHomeImage3->move('uploads/images',$clients->home_image_3);
						$ClientBusinessImage1 = $request->file('business_image_1');
						$ClientBusinessImage1->move('uploads/images',$clients->business_image_1);
						$ClientBusinessImage2 = $request->file('business_image_2');
						$ClientBusinessImage2->move('uploads/images',$clients->business_image_2);
						$ClientBusinessImage3 = $request->file('business_image_3');
						$ClientBusinessImage3->move('uploads/images',$clients->business_image_3);
						$ClientNationalIDImageFront = $request->file('front_national_id');
						$ClientNationalIDImageFront->move('uploads/images',$clients->front_national_id);
						$ClientNationalIDImageBack = $request->file('back_national_id');
						$ClientNationalIDImageBack->move('uploads/images',$clients->back_national_id);

						$clientofficer=new ClientOfficers();
						$clientofficer->client=$clients->id;
						
						if($clienttype->code=="001"){
							$groupclient=new GroupClients();
							$groupclient->client_group=$request->get('client_group');
							$groupclient->client=$clients->id;
							$groupclient->save();

							$group = Groups::find($groupclient->client_group);

							$clientofficer->officer=$group->officermodel->id;

						}elseif ($clienttype->code=="002") {
							$clientofficer->officer=$request->get("bdo");
							$fictitious_system_group = Groups::where('group_number', 'I0001')->first();

							if ($fictitious_system_group) {
								$groupclient=new GroupClients();
								$groupclient->client_group = $fictitious_system_group->id;
								$groupclient->client=$clients->id;
								$groupclient->save();
							}
						}

						$clientofficer->save();
						$clients->branch_id = $clientofficer->officermodel->branch;
						$clients->officer_id = $clientofficer->officer;
						$clients->save();

						$response['status']='1';
						$response['message']='clients Added successfully';
						return json_encode($response);
					}else{
						$response['status']='0';
						$response['message']='Failed to add clients. Please try again';
						return json_encode($response);
					}
				}
				catch(Exception $e){
						$response['status']='0';
						$response['message']='An Error occured while attempting to add clients. Please try again';
						return json_encode($response);
				}

			});
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function dbimport(Request $request){
		$clients=new Clients();
		$clientsdata['salutations']=Salutations::all();
		$clients->client_number=$request->get('client_number');
		$clients->first_name=$request->get('first_name');
		$clients->middle_name=$request->get('middle_name');
		$clients->last_name=$request->get('last_name');
		$clients->id_number=$request->get('id_number');
		$clients->primary_phone_number=$request->get('primary_phone_number');
		$clients->secondary_phone_number=$request->get('secondary_phone_number');
		$clients->gender=$request->get('gender');
		$clients->date_of_birth=$request->get('date_of_birth');
		$clients->marital_status=$request->get('marital_status');
		$clients->postal_address=$request->get('postal_address');
		$clients->postal_code=$request->get('postal_code');
		$clients->postal_town=$request->get('postal_town');
		$clients->email_address=$request->get('email_address');
		$clients->client_type=$request->get('client_type');
		$clients->client_category=$request->get('client_category');
		$clients->county=$request->get('county');
		$clients->sub_county=$request->get('sub_county');
		$clients->location=$request->get('location');
		$clients->village=$request->get('village');
		$clients->nearest_center=$request->get('nearest_center');
		$clients->spouse_first_name=$request->get('spouse_first_name');
		$clients->spouse_middle_name=$request->get('spouse_middle_name');
		$clients->spouse_last_name=$request->get('spouse_last_name');
		$clients->spouse_id_number=$request->get('spouse_id_number');
		$clients->spouse_primary_phone_number=$request->get('spouse_primary_phone_number');
		$clients->spouse_secondary_phone_number=$request->get('spouse_secondary_phone_number');
		$clients->spouse_email_address=$request->get('spouse_email_address');
		$clients->next_of_kin_first_name=$request->get('next_of_kin_first_name');
		$clients->next_of_kin_middle_name=$request->get('next_of_kin_middle_name');
		$clients->next_of_kin_last_name=$request->get('next_of_kin_last_name');
		$clients->relationship_with_next_of_kin=$request->get('relationship_with_next_of_kin');
		$clients->next_of_kin_primary_phone_number=$request->get('next_of_kin_primary_phone_number');
		$clients->next_of_kin_secondary_phone_number=$request->get('next_of_kin_secondary_phone_number');
		$clients->next_of_kin_email_address=$request->get('next_of_kin_email_address');
		$clients->next_of_kin_county=$request->get('next_of_kin_county');
		$clients->next_of_kin_sub_county=$request->get('next_of_kin_sub_county');
		$clients->location=$request->get('location');
		$clients->main_economic_activity=$request->get('main_economic_activity');
		$clients->secondary_economic_activity=$request->get('secondary_economic_activity');
		$clients->client_photo=time() . '_' . rand(1000, 9999) . '.jpg';
		$clients->client_finger_print=time() . '_' . rand(1000, 9999) . '.jpg';
		$clients->client_signature=time() . '_' . rand(1000, 9999) . '.jpg';
		$clients->comments=$request->get('comments');

		// $dbconnection=new mysqli($request->get('db_host'),$request->get('db_user_name'),$request->get('db_password'),$request->get('db_name'));
		// $response=array();
		// if($mysqli->connection_errno()){
		// 	$response['status']='0';
		// 	$response['message']='Database connection failed!!';
		// 	return json_encode($response);
		// }	
		$query = DB::connection('mysql2')->select("select * from ".$request->get('db_table'));
		

			DB::transaction(function() use($result){
				foreach($query as $result){
					$result=(array)$result;

					$clients=new Clients();
					$clients->client_number=$result['client_number'];
					$clients->first_name=$result['first_name'];
					$clients->middle_name=$result['middle_name'];
					$clients->last_name=$result['last_name'];
					$clients->id_number=$result['id_number'];
					$clients->primary_phone_number=$result['primary_phone_number'];
					$clients->secondary_phone_number=$result['secondary_phone_number'];
					$clients->gender=$result['gender'];
					$clients->date_of_birth=$result['date_of_birth'];
					$clients->marital_status=$result['marital_status'];
					$clients->postal_address=$result['postal_address'];
					$clients->postal_code=$result['code'];
					$clients->postal_town=$result['postal_address'];
					$clients->email_address=$result['email_address'];
					$clients->client_type=$result['client_type'];
					$clients->client_category=$result['client_category'];
					$clients->county=$result['county'];
					$clients->sub_county=$result['sub_county'];
					$clients->location=$result['location'];
					$clients->village=$result['village'];
					$clients->nearest_center=$result['nearest_center'];
					$clients->spouse_first_name=$result['spouse_first_name'];
					$clients->spouse_middle_name=$result['spouse_middle_name'];
					$clients->spouse_last_name=$result['spouse_last_name'];
					$clients->spouse_id_number=$result['spouse_id_number'];
					$clients->spouse_primary_phone_number=$result['spouse_primary_phone_number'];
					$clients->spouse_secondary_phone_number=$result['spouse_secondary_phone_number'];
					$clients->spouse_email_address=$result['spouse_email_address'];
					$clients->next_of_kin_first_name=$result['next_of_kin_first_name'];
					$clients->next_of_kin_middle_name=$result['next_of_kin_middle_name'];
					$clients->next_of_kin_last_name=$result['next_of_kin_last_name'];
					$clients->relationship_with_next_of_kin=$result['relationship'];
					$clients->next_of_kin_primary_phone_number=$result['next_of_kin_phone_number'];
					$clients->next_of_kin_secondary_phone_number=$result['next_of_kin_secondary_phone_number'];
					$clients->next_of_kin_email_address='';
					$clients->next_of_kin_county=$result['next_of_kin_county'];
					$clients->next_of_kin_sub_county='';
					$clients->next_of_kin_location=$result['next_of_kin_location'];
					$clients->main_economic_activity=$result['main_economy_activity'];
					$clients->secondary_economic_activity=$result['secondary_economy_activity'];
					$clients->client_photo='';
					$clients->client_finger_print='';
					$clients->client_signature='';
					$clients->comments=$result['comments'];
					$clients->save();
				}
			});			
		
		$response['status']='1';
		$response['message']='clients Added successfully';
		return json_encode($response);
	}

	public function edit($id){
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		return view('admin.clients.edit',compact('clientsdata','id'));
		}
	}


	public function clientapproval($id){
		$clientsdata['active']=ClientCategories::where([['code','=','002']])->get();
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$transactionstatus=TransactionStatuses::where([['code','=','002']])->get();
		$clientsdata['membershipfees']=MembershipFees::where([['client','=',$id],['transaction_status','=',$transactionstatus[0]->id]])->sum("amount");
		$clientsdata['clienttypemembershipfees']=ClientTypeMembershipFees::where([['client_type','=',$clientsdata['data']->client_type]])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		return view('admin.clients.approval',compact('clientsdata','id'));
		}
	}

	
	public function clientgroupchange($id){
		dd('here');
		$clientsdata['active']=ClientCategories::where([['code','=','002']])->get();
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['today']=date('m/d/Y');
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$clientsdata['membershipfees']=MembershipFees::where([['client','=',$id]])->sum("amount");
		$clientsdata['clienttypemembershipfees']=ClientTypeMembershipFees::where([['client_type','=',$clientsdata['data']->client_type]])->get();
		$client=$clientsdata['data'];
		$clientgroup=GroupClients::where([['client','=',$client->id]])->get();
		if(isset($clientgroup[0])){
			$clientsdata['clientgroup']=Groups::find($clientgroup[0]->client_group);
		}
		
		
		if(isset($clientsdata['clientgroup'][0])){
			$clientsdata['group']=Groups::find($clientsdata['clientgroup'][0]['id']);	
		}
		$status=ChangeGroupRequestStatuses::where([['code','=','001']])->get();
		$clientsdata['pendingchangegrouprequest']=ChangeGroupRequests::where([['status','=',$status[0]['id']],['client','=',$id]])->get();

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		return view('admin.clients.changegroup',compact('clientsdata','id'));
		}
	}	

	public function changeclientgroup(Request $request,$id){
		$clientsdata['active']=ClientCategories::where([['code','=','002']])->get();
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$position=Positions::where([['code','=','BDO']])->get();

		$transactionstatus=TransactionStatuses::where([['code','=','002']])->get();
		$clientsdata['membershipfees']=MembershipFees::where([['client','=',$id],['transaction_status','=',$transactionstatus[0]->id]])->sum("amount");
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$clientsdata['today']=date('m/d/Y');
		$client=$clientsdata['data'];
		$clientgroup=GroupClients::where([['client','=',$client->id]])->get();
		if(isset($clientgroup[0])){
			$clientsdata['clientgroup']=Groups::find($clientgroup[0]->client_group);
		}
		
		$clientsdata['clienttypemembershipfees']=ClientTypeMembershipFees::where([['client_type','=',$clientsdata['data']->client_type]])->get();
		$client=$clientsdata['data'];

		if(isset($clientsdata['clientgroup'][0])){
			$clientsdata['group']=Groups::find($clientsdata['clientgroup'][0]['id']);	
		}
		$status=ChangeGroupRequestStatuses::where([['code','=','001']])->get();
	
		$clientsdata['pendingchangegrouprequest']=ChangeGroupRequests::where([['status','=',$status[0]['id']]])->get();

		DB::transaction(function() use ($client,$clientsdata,$request,$status){

			try{
				
				if($clientsdata['active'][0]['id']==$client->client_category){
					if(isset($clientsdata['clientgroup'][0]) && !isset($clientsdata['pendingchangegrouprequest'][0])){
						$changegrouprequest=new ChangeGroupRequests();
						$changegrouprequest->client=$client->id;
						$changegrouprequest->current_group=$clientsdata['clientgroup'][0]->client_group;
						$changegrouprequest->new_group=$request->get('new_group');
						$changegrouprequest->date=$request->get("date");
						$changegrouprequest->comments=$request->get("comments");
						$changegrouprequest->status=$status[0]['id'];
						$changegrouprequest->save();
					}
				}

			}catch(Exception $e){

			}
		});
		$clientsdata['pendingchangegrouprequest']=ChangeGroupRequests::where([['status','=',$status[0]['id']],['client','=',$id]])->get();

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		return view('admin.clients.changegroup',compact('clientsdata','id'));
		}
	}

	public function clienttypechange($id,$code){
		$clientsdata['active']=ClientCategories::where([['code','=','002']])->get();
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['today']=date('m/d/Y');
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$transactionstatus=TransactionStatuses::where([['code','=','002']])->get();
		$clientsdata['membershipfees']=MembershipFees::where([['client','=',$id],['transaction_status','=',$transactionstatus[0]->id]])->sum("amount");
		$clientsdata['clienttypemembershipfees']=ClientTypeMembershipFees::where([['client_type','=',$clientsdata['data']->client_type]])->get();
		$client=$clientsdata['data'];
		$clientsdata['clientgroup']=GroupClients::where([['client','=',$client->id]])->get();
		$clientsdata['availabletypes']=ClientTypes::where([['code','=',$code]])->orderBy('code','asc')->get();
		if(isset($clientsdata['clientgroup'][0])){
			$clientsdata['group']=Groups::find($clientsdata['clientgroup'][0]['id']);	
		}
		$status=ChangeTypeRequestStatuses::where([['code','=','001']])->get();
		$clientsdata['pendingchangetyperequest']=ChangeTypeRequests::where([['status','=',$status[0]['id']],['client','=',$id]])->get();

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
			return view('admin.clients.changetype',compact('clientsdata','id'));
		}
	}

	public function changeclienttype(Request $request,$id,$code){
		$clientsdata['active']=ClientCategories::where([['code','=','002']])->get();
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['today']=date('m/d/Y');
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$transactionstatus=TransactionStatuses::where([['code','=','002']])->get();
		$clientsdata['membershipfees']=MembershipFees::where([['client','=',$id],['transaction_status','=',$transactionstatus[0]->id]])->sum("amount");
		$clientsdata['clienttypemembershipfees']=ClientTypeMembershipFees::where([['client_type','=',$clientsdata['data']->client_type]])->get();
		$client=$clientsdata['data'];
		$clientsdata['clientgroup']=GroupClients::where([['client','=',$client->id]])->get();
		$clientsdata['availabletypes']=ClientTypes::where([['code','=',$code]])->orderBy('code','asc')->get();
		if(isset($clientsdata['clientgroup'][0])){
			$clientsdata['group']=Groups::find($clientsdata['clientgroup'][0]['id']);	
		}
		$status=ChangeTypeRequestStatuses::where([['code','=','001']])->get();
		$clientsdata['pendingchangetyperequest']=ChangeTypeRequests::where([['status','=',$status[0]['id']],['client','=',$id]])->get();
		DB::transaction(function() use ($client,$clientsdata,$request,$status) {
			try{
				if($clientsdata['active'][0]['id']==$client->client_category){
						$changetyperequest=new ChangeTypeRequests();
						$changetyperequest->client=$client->id;
						$changetyperequest->current_type=$client->client_type;
						$changetyperequest->new_type=$request->get('new_type');
						$changetyperequest->date=$request->get("date");
						$changetyperequest->comments=$request->get("comments");
						$changetyperequest->status=$status[0]['id'];
						$changetyperequest->save();
					
				}

			}catch(Exception $e){

			}
		});
		$clientsdata['pendingchangetyperequest']=ChangeTypeRequests::where([['status','=',$status[0]['id']],['client','=',$id]])->get();

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
			return view('admin.clients.changetype',compact('clientsdata','id'));
		}
	}


	public function approveclient($id){
		$clientsdata['active']=ClientCategories::where([['code','=','002']])->get();
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$client=$clientsdata['data'];
		DB::transaction(function() use ($client,$clientsdata){

			try{
				
				if($clientsdata['active'][0]['id']!=$client->client_category){
					$clientCategory=ClientCategories::where([['code','=','002']])->get();
					$client->client_category=$clientCategory[0]['id'];
					$client->save();
					
				}

			}catch(Exception $e){

			}
		});

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		return view('admin.clients.approval',compact('clientsdata','id'));
		}
	}

	public function clientblacklisting($id){
		$clientsdata['blacklisted']=ClientCategories::where([['code','=','003']])->get();
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		return view('admin.clients.blacklist',compact('clientsdata','id'));
		}
	}
	public function blacklistclient($id){
		$clientsdata['blacklisted']=ClientCategories::where([['code','=','003']])->get();
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$client=$clientsdata['data'];
		DB::transaction(function() use ($client,$clientsdata){

			try{
				
				if($clientsdata['blacklisted'][0]['id']!=$client->client_category){
					$clientCategory=ClientCategories::where([['code','=','003']])->get();
					$client->client_category=$clientCategory[0]['id'];
					$client->save();
					
				}

			}catch(Exception $e){

			}
		});

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		return view('admin.clients.blacklist',compact('clientsdata','id'));
		}
	}

	public function clientremoval($id){
		$clientsdata['removed']=ClientCategories::where([['code','=','005']])->get();
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		return view('admin.clients.removal',compact('clientsdata','id'));
		}
	}
	public function removeclient($id){
		$clientsdata['removed']=ClientCategories::where([['code','=','005']])->get();
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$client=$clientsdata['data'];
		DB::transaction(function() use ($client,$clientsdata){

			try{
				
				if($clientsdata['removed'][0]['id']!=$client->client_category){
					$clientCategory=ClientCategories::where([['code','=','005']])->get();
					$client->client_category=$clientCategory[0]['id'];
					$client->save();
					
				}

			}catch(Exception $e){

			}
		});

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		return view('admin.clients.removal',compact('clientsdata','id'));
		}
	}

	public function clientsuspension($id){
		$clientsdata['suspended']=ClientCategories::where([['code','=','004']])->get();
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		return view('admin.clients.suspend',compact('clientsdata','id'));
		}
	}
	public function suspendclient($id){
		$clientsdata['suspended']=ClientCategories::where([['code','=','004']])->get();
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$position=Positions::where([['code','=','BDO']])->get();
		$clientsdata['employees']=Employees::where([['position','=',$position[0]['id']]])->get();		
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$client=$clientsdata['data'];
		DB::transaction(function() use ($client,$clientsdata){

			try{
				
				if($clientsdata['suspended'][0]['id']!=$client->client_category){
					$clientCategory=ClientCategories::where([['code','=','004']])->get();
					$client->client_category=$clientCategory[0]['id'];
					$client->save();
					
				}

			}catch(Exception $e){

			}
		});

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		return view('admin.clients.suspend',compact('clientsdata','id'));
		}
	}

	public function show($id){
		$clientsdata['salutations']=Salutations::all();
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['groups']=Groups::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();
		$clientsdata['data']=Clients::find($id);
		$clientsdata['employees']=Employees::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		return view('admin.clients.show',compact('clientsdata','id'));
		}
	}

	public function update(Request $request,$id){
		$clients=Clients::find($id);
		$clientsdata['salutations']=Salutations::all();
		$clients->client_number=$request->get('client_number');
		$clients->first_name=$request->get('first_name');
		$clients->middle_name=$request->get('middle_name');		
		$clients->last_name=$request->get('last_name');
		$clients->id_number=$request->get('id_number');
		$clients->primary_phone_number=$request->get('primary_phone_number');
		$clients->secondary_phone_number=$request->get('secondary_phone_number');
		$clients->gender=$request->get('gender');
		$clients->date_of_birth=$request->get('date_of_birth');
		$clients->marital_status=$request->get('marital_status');
		$clients->postal_address=$request->get('postal_address');
		$clients->postal_code=$request->get('postal_code');
		$clients->postal_town=$request->get('postal_town');
		$clients->email_address=$request->get('email_address');
		$clients->client_type=$request->get('client_type');
		$clients->client_category=$request->get('client_category');
		$clients->county=$request->get('county');
		$clients->sub_county=$request->get('sub_county');
		$clients->location=$request->get('location');
		$clients->village=$request->get('village');
		$clients->nearest_center=$request->get('nearest_center');
		$clients->spouse_first_name=$request->get('spouse_first_name');
		$clients->spouse_middle_name=$request->get('spouse_middle_name');
		$clients->spouse_last_name=$request->get('spouse_last_name');
		$clients->spouse_id_number=$request->get('spouse_id_number');
		$clients->spouse_primary_phone_number=$request->get('spouse_primary_phone_number');
		$clients->spouse_secondary_phone_number=$request->get('spouse_secondary_phone_number');
		$clients->spouse_email_address=$request->get('spouse_email_address');
		$clients->next_of_kin_first_name=$request->get('next_of_kin_first_name');
		$clients->next_of_kin_middle_name=$request->get('next_of_kin_middle_name');
		$clients->next_of_kin_last_name=$request->get('next_of_kin_last_name');
		$clients->relationship_with_next_of_kin=$request->get('relationship_with_next_of_kin');
		$clients->next_of_kin_primary_phone_number=$request->get('next_of_kin_primary_phone_number');
		$clients->next_of_kin_secondary_phone_number=$request->get('next_of_kin_secondary_phone_number');
		$clients->next_of_kin_email_address=$request->get('next_of_kin_email_address');
		$clients->next_of_kin_county=$request->get('next_of_kin_county');
		$clients->next_of_kin_sub_county=$request->get('next_of_kin_sub_county');
		$clients->location=$request->get('location');
		$clients->main_economic_activity=$request->get('main_economic_activity');
		$clients->secondary_economic_activity=$request->get('secondary_economic_activity');
		$clients->comments=$request->get('comments');
		$clients->assigned_officer=$request->get('assigned_officer');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		$clients->save();
		$clientsdata;
		$clientsdata['genders']=Genders::all();
		$clientsdata['maritalstatuses']=MaritalStatuses::all();
		$clientsdata['clienttypes']=ClientTypes::all();
		$clientsdata['clientcategories']=ClientCategories::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$clientsdata['counties']=Counties::all();
		$clientsdata['subcounties']=SubCounties::all();
		$clientsdata['maineconomicactivities']=MainEconomicActivities::all();
		$clientsdata['secondaryeconomicactivities']=SecondaryEconomicActivities::all();		
		$clientsdata['data']=Clients::find($id);
		return view('admin.clients.edit',compact('clientsdata','id'));
		}
	}

	public function individualize(Clients $client) {
		$groupClient = GroupClients::where('client', $client->id)->orderBy('id', 'DESC')->first();

		if($groupClient) {
			$group = Groups::find($groupClient->group_id);
			$client->assigned_officer=isset($group->group_officer) ? $group->group_officer : NULL;

			$groupClient->delete();

			$leadership = GroupLeadership::where([
                'client_id' => $client->id
            ])->where('vacated_at', '=', NULL)->first();

			if($leadership) {
				$leadership->vacated_at = Carbon::now()->toDateTimeString();
				$leadership->save();
			}
		}

		$clientType = ClientTypes::where('name', 'Individual Client')->first();

		$client->client_type = $clientType->id;
		$client->save();

		return redirect()->back()->with('success','clients has been individualized!');
	}

	public function destroy($id){
		$clients=Clients::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_delete']==1) {
			$clients->delete();
		}
		return redirect('admin/clients')->with('success','clients has been deleted!');
	}

	public function query(Request $request) {

		$query = Clients::where('client_number', $request->clientNumber)->with([
            'group.client_groupmodel',
            'clientcategorymodel',
            'lgf_balance',
            'lgf_contributions',
            'loans.loan_payments'
        ])->first();

        $client                     = new Collection();
        $client->number             = strtoupper($query->client_number);
        $client->name               = strtoupper($query->first_name . ' ' . $query->middle_name);
        $client->category           = strtoupper($query->clientcategorymodel->code . ' - ' . $query->clientcategorymodel->name);
        $client->group              = strtoupper($query->group->client_groupmodel->group_number . ' - ' . $query->group->client_groupmodel->group_name);
        $client->national_id        = strtoupper($query->id_number);
        $client->phone_number       = $query->primary_phone_number ? '+254' . substr($query->primary_phone_number, -9) : NULL;
        $client->lgf_balance        = $query->lgf_balance ? $query->lgf_balance->balance : 0;
        $client->lgf_contributions  = 0;
        $client->shares             = 0;
        $client->total_loan_taken   = 0;
        $client->total_loan_paid    = 0;
        $client->total_loan_balance = 0;
        $client->photo              = asset('/uploads/images/' . $query->client_photo);
        $client->finger_print       = asset('/uploads/images/' . $query->client_finger_print);
        $client->signature          = asset('/uploads/images/' . $query->client_signature);

        foreach ($query->lgf_contributions as $contribution) {
            $client->lgf_contributions += $contribution->amount ?? 0;
        }

        foreach ($query->loans as $loan) {
            $client->total_loan_taken += $loan->total_loan_amount ?? 0;
            foreach ($loan->loan_payments as $payment) {
                $client->total_loan_paid  += $payment->amount ?? 0;
            }
            $client->total_loan_balance += ($client->total_loan_taken - $client->total_loan_paid);
        }

        $client->lgf_balance        = number_format($client->lgf_balance, 2);
        $client->lgf_contributions  = number_format($client->lgf_contributions, 2);
        $client->shares             = number_format($client->shares, 2);
        $client->total_loan_taken   = number_format($client->total_loan_taken, 2);
        $client->total_loan_paid    = number_format($client->total_loan_paid, 2);
        $client->total_loan_balance = number_format($client->total_loan_balance, 2);

		return response()->json((array) $client);	
		
	}

	public function query2(Request $request) {

		$client = auth()->user()->user_account != '8' ? Clients::where([
			'client_number' => $request->clientNumber,
			'officer_id' => auth()->user()->employeemodel->id
			])->with('lgf_balance')->first() : Clients::where('client_number', $request->clientNumber)->with('lgf_balance')->first();

        $data              = new Collection();

		if (isset($client) && !empty($client)) {
			$data->number      = strtoupper($client->client_number);
			$data->name        = strtoupper($client->first_name . ' ' . $client->middle_name);
			$data->lgf_balance = $client->lgf_balance ? number_format($client->lgf_balance->balance, 2) : number_format(0, 2);
			$approvedloans     = LoanStatuses::where([['code', '=', '002']])->get();
			$data->loans       = Loans::where([
				'client' => $client->id,
				'status' => $approvedloans[0]->id
			])->orderBy('id', 'desc')->get();

			$l = 0;
			for ($k = 0; $k < count($data->loans); $k++) {
				$disbursementStatus = DisbursementStatuses::where([['code', '=', '002']])->get();
				$loanDisbursed      = LoanDisbursements::where([['disbursement_status', '=', $disbursementStatus[0]->id], ['loan', '=', $data->loans[$k]->id]])->get();

				if (!isset($loanDisbursed[0]) > 0) {continue;}
				$loanPaid = LoanPayments::where('loan', $data->loans[$k]->id)->sum('amount');
				$balance  = $data->loans[$k]['total_loan_amount'] - $loanPaid;

				if ($balance > 0) {
					$data->loans[$k]['total_loan_balance'] += $balance;
					$l++;
				}
			}

			$data->Other_Payment_Types = OtherPaymentTypes::all();
		}
		
		return response()->json((array) $data);	
		
	}

	public function contribute(Request $request) {
		$client = Clients::where('client_number', $request->client_number)->firstOrFail();
		$input = $request->all();

		if (isset($input['other_payments'])) {
			foreach ($input['other_payments'] as $key => $value) {
				if (is_null($value)) {
					unset($input['other_payments'][$key]);
				}
			}
		}

		$data = [
			"transaction_date" => \Carbon\Carbon::parse($input['transaction_date'] ?? \Carbon\Carbon::now())->toDateString() ?? null,
			"transaction_number" => $input['transaction_number'] ?? null,
			"payment_mode" => $input['payment_mode'] ?? null,
			"client_id" => $client->id,
			"client_type" => $client->client_type,
			"loan_payments" => isset($input['loan_payment']) && !empty($input['loan_payment']) ? array_combine(array_keys($input['loan_payment']), array_values($input['loan_payment'])) : [],
			"client_lgf_contribution" => $input['lgf_contribution'],
			"other_payments" => array_combine(array_keys($input['other_payments']), array_values($input['other_payments'])),
			"officer_id" => $client->officermodel->id,
			"branch_id" => $client->branchmodel->id,
			"group_id" => $client->group->client_group
		];

		return DB::transaction(function () use ($data) {
			$debit = EntryTypes::where([['code', '=', '001']])->get();
			$credit = EntryTypes::where([['code', '=', '002']])->get();
			$transactionstatuses = TransactionStatuses::where([['code', '=', '002']])->get();

			$user = Users::where([['id', '=', Auth::id()]])->get()->first();

			//principal debit
			$groupcashbook=new GroupCashBooks();
			$groupcashbook->transaction_id= $data['transaction_number'];
			$groupcashbook->transacting_group = $data['group_id'];
			$groupcashbook->transaction_reference= $data['transaction_number'];
			$groupcashbook->transaction_date=$data['transaction_date'];
			$groupcashbook->transaction_type=2;
			$groupcashbook->amount=0;
			$groupcashbook->payment_mode=$data['payment_mode'];
			$groupcashbook->lgf=0;
			$groupcashbook->loan_principal=0;
			$groupcashbook->loan_interest=0;
			$groupcashbook->mpesa_charges=0;
			$groupcashbook->fine=0;
			$groupcashbook->processing_fees=0;
			$groupcashbook->insurance_deduction_fees=0;
			$groupcashbook->collecting_officer=$user->name;
			$groupcashbook->clearing_fees=0;
			$groupcashbook->officer_id = $data['officer_id'];
			$groupcashbook->branch_id = $data['branch_id'];

			//principal credit
			$groupcashbook1=new GroupCashBooks();
			$groupcashbook1->transaction_id= $data['transaction_number'];
			$groupcashbook1->transacting_group=$data['group_id'];
			$groupcashbook1->transaction_reference= $data['transaction_number'];
			$groupcashbook1->transaction_date=$data['transaction_date'];
			$groupcashbook1->transaction_type=1;
			$groupcashbook1->amount=0;
			$groupcashbook1->payment_mode=$data['payment_mode'];
			$groupcashbook1->lgf=0;
			$groupcashbook1->loan_principal=0;
			$groupcashbook1->loan_interest=0;
			$groupcashbook1->mpesa_charges=0;
			$groupcashbook1->fine=0;
			$groupcashbook1->processing_fees=0;
			$groupcashbook1->insurance_deduction_fees=0;
			$groupcashbook1->collecting_officer=$user->name;
			$groupcashbook1->clearing_fees=0;
			$groupcashbook1->officer_id = $data['officer_id'];
			$groupcashbook1->branch_id = $data['branch_id'];		

			//interest debit
			$groupcashbook2=new GroupCashBooks();
			$groupcashbook2->transaction_id= $data['transaction_number'];
			$groupcashbook2->transacting_group=$data['group_id'];
			$groupcashbook2->transaction_reference= $data['transaction_number'];
			$groupcashbook2->transaction_date=$data['transaction_date'];
			$groupcashbook2->transaction_type=2;
			$groupcashbook2->amount=0;
			$groupcashbook2->payment_mode=$data['payment_mode'];
			$groupcashbook2->lgf=0;
			$groupcashbook2->loan_principal=0;
			$groupcashbook2->loan_interest=0;
			$groupcashbook2->mpesa_charges=0;
			$groupcashbook2->fine=0;
			$groupcashbook2->processing_fees=0;
			$groupcashbook2->insurance_deduction_fees=0;
			$groupcashbook2->collecting_officer=$user->name;
			$groupcashbook2->clearing_fees=0;
			$groupcashbook2->officer_id = $data['officer_id'];
			$groupcashbook2->branch_id = $data['branch_id'];

			//interest credti
			$groupcashbook21=new GroupCashBooks();
			$groupcashbook21->transaction_id= $data['transaction_number'];
			$groupcashbook21->transacting_group=$data['group_id'];
			$groupcashbook21->transaction_reference= $data['transaction_number'];
			$groupcashbook21->transaction_date=$data['transaction_date'];
			$groupcashbook21->transaction_type=1;
			$groupcashbook21->amount=0;
			$groupcashbook21->payment_mode=$data['payment_mode'];
			$groupcashbook21->lgf=0;
			$groupcashbook21->loan_principal=0;
			$groupcashbook21->loan_interest=0;
			$groupcashbook21->mpesa_charges=0;
			$groupcashbook21->fine=0;
			$groupcashbook21->processing_fees=0;
			$groupcashbook21->insurance_deduction_fees=0;
			$groupcashbook21->collecting_officer=$user->name;
			$groupcashbook21->clearing_fees=0;
			$groupcashbook21->officer_id = $data['officer_id'];
			$groupcashbook21->branch_id = $data['branch_id'];

			//other payment debit
			$groupcashbook3=new GroupCashBooks();
			$groupcashbook3->transaction_id= $data['transaction_number'];
			$groupcashbook3->transacting_group=$data['group_id'];
			$groupcashbook3->transaction_reference= $data['transaction_number'];
			$groupcashbook3->transaction_date=$data['transaction_date'];
			$groupcashbook3->transaction_type=2;
			$groupcashbook3->amount=0;
			$groupcashbook3->payment_mode=$data['payment_mode'];
			$groupcashbook3->lgf=0;
			$groupcashbook3->loan_principal=0;
			$groupcashbook3->loan_interest=0;
			$groupcashbook3->mpesa_charges=0;
			$groupcashbook3->fine=0;
			$groupcashbook3->processing_fees=0;
			$groupcashbook3->insurance_deduction_fees=0;
			$groupcashbook3->collecting_officer=$user->name;
			$groupcashbook3->clearing_fees=0;
			$groupcashbook3->officer_id = $data['officer_id'];
			$groupcashbook3->branch_id = $data['branch_id'];

			//other payment credit
			$groupcashbook31=new GroupCashBooks();
			$groupcashbook31->transaction_id= $data['transaction_number'];
			$groupcashbook31->transacting_group=$data['group_id'];
			$groupcashbook31->transaction_reference= $data['transaction_number'];
			$groupcashbook31->transaction_date=$data['transaction_date'];
			$groupcashbook31->transaction_type=1;
			$groupcashbook31->amount=0;
			$groupcashbook31->payment_mode=$data['payment_mode'];
			$groupcashbook31->lgf=0;
			$groupcashbook31->loan_principal=0;
			$groupcashbook31->loan_interest=0;
			$groupcashbook31->mpesa_charges=0;
			$groupcashbook31->fine=0;
			$groupcashbook31->processing_fees=0;
			$groupcashbook31->insurance_deduction_fees=0;
			$groupcashbook31->collecting_officer=$user->name;
			$groupcashbook31->clearing_fees=0;
			$groupcashbook31->officer_id = $data['officer_id'];
			$groupcashbook31->branch_id = $data['branch_id'];

			//lgf debit
			$groupcashbook4=new GroupCashBooks();
			$groupcashbook4->transaction_id= $data['transaction_number'];
			$groupcashbook4->transacting_group=$data['group_id'];
			$groupcashbook4->transaction_reference= $data['transaction_number'];
			$groupcashbook4->transaction_date=$data['transaction_date'];
			$groupcashbook4->transaction_type=2;
			$groupcashbook4->amount=0;
			$groupcashbook4->payment_mode=$data['payment_mode'];
			$groupcashbook4->lgf=0;
			$groupcashbook4->loan_principal=0;
			$groupcashbook4->loan_interest=0;
			$groupcashbook4->mpesa_charges=0;
			$groupcashbook4->fine=0;
			$groupcashbook4->processing_fees=0;
			$groupcashbook4->insurance_deduction_fees=0;
			$groupcashbook4->collecting_officer=$user->name;
			$groupcashbook4->clearing_fees=0;
			$groupcashbook4->officer_id = $data['officer_id'];
			$groupcashbook4->branch_id = $data['branch_id'];

			//lgf credit
			$groupcashbook5=new GroupCashBooks();
			$groupcashbook5->transaction_id= $data['transaction_number'];
			$groupcashbook5->transacting_group=$data['group_id'];
			$groupcashbook5->transaction_reference= $data['transaction_number'];
			$groupcashbook5->transaction_date=$data['transaction_date'];
			$groupcashbook5->transaction_type=1;
			$groupcashbook5->amount=0;
			$groupcashbook5->payment_mode=$data['payment_mode'];
			$groupcashbook5->lgf=0;
			$groupcashbook5->loan_principal=0;
			$groupcashbook5->loan_interest=0;
			$groupcashbook5->mpesa_charges=0;
			$groupcashbook5->fine=0;
			$groupcashbook5->processing_fees=0;
			$groupcashbook5->insurance_deduction_fees=0;
			$groupcashbook5->collecting_officer=$user->name;
			$groupcashbook5->clearing_fees=0;
			$groupcashbook5->officer_id = $data['officer_id'];
			$groupcashbook5->branch_id = $data['branch_id'];

			$groupcashbook4->amount = isset($data['client_lgf_contribution']) ? $groupcashbook4->amount + $data['client_lgf_contribution'] : $groupcashbook4->amount + 0;
			$groupcashbook5->amount = isset($data['client_lgf_contribution']) ? $groupcashbook5->amount + $data['client_lgf_contribution'] : $groupcashbook5->amount + 0;

			//contribution
			if (isset($data['client_lgf_contribution']) && $data['client_lgf_contribution'] > 0) {
				$ExistingClientLgfContributions=ClientLgfContributions::where([["transaction_number","=",$data['transaction_number']],["client","=",$data['client_id']]])->get();

				if(isset($ExistingClientLgfContributions) && count($ExistingClientLgfContributions)>0)
					throw new Exception("Transaction already exists");

				$clientlgfcontributions = new ClientLgfContributions();
				$clientlgfcontributions->client = $data['client_id'];
				$clientlgfcontributions->payment_mode = $data['payment_mode'];
				$clientlgfcontributions->transaction_number = $data['transaction_number'];
				$clientlgfcontributions->date = $data['transaction_date'];
				$clientlgfcontributions->amount = isset($data['client_lgf_contribution']) ? $data['client_lgf_contribution'] : 0;
				$clientlgfcontributions->transaction_status = $transactionstatuses[0]['id'];


				$clientlgfbalance = ClientLgfBalances::where([['client', '=', $clientlgfcontributions->client]])->get();

				$lgfContributionConfiguration = LgfContributionConfigurations::where([['client_type', '=', $data['client_type']], ['payment_mode', '=', $clientlgfcontributions->payment_mode]])->get();

				if (isset($lgfContributionConfiguration[0])) {
					$clientlgfcontributions->save();
					if ($clientlgfbalance != null && $clientlgfbalance->count() > 0) {

						$clientlgfbalance = ClientLgfBalances::find($clientlgfbalance[0]['id']);
						$clientlgfbalance->balance = $clientlgfbalance->balance + $clientlgfcontributions->amount;
						$clientlgfbalance->save();
					} else {
						$clientlgfbalance = new ClientLgfBalances();
						$clientlgfbalance->client = $clientlgfcontributions->client;
						$clientlgfbalance->balance = $clientlgfcontributions->amount;
						$clientlgfbalance->save();
					}

					$generalLedger = new GeneralLedgers();
					$generalLedger->account = $lgfContributionConfiguration[0]['debit_account'];
					$generalLedger->entry_type = $debit[0]['id'];
					$generalLedger->client = $data['client_id'];
					$generalLedger->secondary_description = "Lgf contribution";
					$generalLedger->transaction_number = $clientlgfcontributions->transaction_number;
					$generalLedger->amount = $clientlgfcontributions->amount;
					$generalLedger->date = $clientlgfcontributions->date;
					$generalLedger->save();


					$generalLedger = new GeneralLedgers();
					$generalLedger->account = $lgfContributionConfiguration[0]['credit_account'];
					$generalLedger->entry_type = $credit[0]['id'];
					$generalLedger->client = $data['client_id'];
					$generalLedger->secondary_description = "Lgf contribution";
					$generalLedger->transaction_number = $clientlgfcontributions->transaction_number;
					$generalLedger->amount = $clientlgfcontributions->amount;
					$generalLedger->date = $clientlgfcontributions->date;
					$generalLedger->save();

					$groupcashbook4->account=$lgfContributionConfiguration[0]['debit_account'];
					$groupcashbook5->account=$lgfContributionConfiguration[0]['credit_account'];
				}
			}

			// loan payment
			if (isset($data['loan_payments']) && !empty($data['loan_payments'])) {
				foreach ($data['loan_payments'] as $key => $amount) {
					$ExistingLoanPayments=LoanPayments::where([["transaction_number","=",$data['transaction_number']],["loan","=",$key]])->get();

					if(isset($ExistingLoanPayments) && count($ExistingLoanPayments)>0)
						throw new Exception("Transaction already exists");

					$loanpayments = new LoanPayments();
					$loanpayments->loan = $key;
					$loanpayments->mode_of_payment = $data['payment_mode'];
					$loanpayments->amount = $amount;
					$loanpayments->date = $data['transaction_date'];
					$loanpayments->transaction_number = $data['transaction_number'];
					$transactionstatuses = TransactionStatuses::where([['code', '=', '002']])->get();
					$loanpayments->transaction_status = $transactionstatuses[0]['id'];
					$loanpayments->officer_id = $data['officer_id'];
					$loanpayments->branch_id = $data['branch_id'];

					$loan = Loans::find($loanpayments->loan);
					$productprincipalconfigurations = ProductPrincipalConfigurations::where([['loan_product', '=', $loan->loan_product], ['payment_mode', '=', $loanpayments->mode_of_payment]])->get();

					$productinterestconfigurations = ProductInterestConfigurations::where([['loan_product', '=', $loan->loan_product], ['payment_mode', '=', $loanpayments->mode_of_payment], ['interest_payment_method', '=', $loan->interest_payment_method]])->get();


					$interest = (($loanpayments->amount / (1 + $loan->interest_rate / 100)) * ($loan->interest_rate / 100));

					$principal = $loanpayments->amount - $interest;

					$groupcashbook->amount=$groupcashbook->amount+$principal;
					$groupcashbook->account=$productprincipalconfigurations[0]['debit_account'];

					$groupcashbook1->amount=$groupcashbook1->amount+$principal;
					$groupcashbook1->loan_interest=$groupcashbook1->loan_interest+$interest;
					$groupcashbook1->account=$productprincipalconfigurations[0]['credit_account'];


					$groupcashbook2->amount=$groupcashbook2->amount+$interest;
					$groupcashbook2->account=$productinterestconfigurations[0]['debit_account'];

					$groupcashbook21->amount=$groupcashbook21->amount+$interest;
					$groupcashbook21->account=$productinterestconfigurations[0]['credit_account'];


					if (isset($productinterestconfigurations[0]) && isset($productprincipalconfigurations[0])) {

						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $productinterestconfigurations[0]['debit_account'];
						$generalLedger->entry_type = $debit[0]['id'];
						$generalLedger->transaction_number = $data['transaction_number'];
						$generalLedger->loan = $key;
						$generalLedger->secondary_description = "Interest payments";
						$generalLedger->amount = $interest;
						$generalLedger->date = $loanpayments->date;
						$generalLedger->save();


						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $productinterestconfigurations[0]['credit_account'];
						$generalLedger->entry_type = $credit[0]['id'];
						$generalLedger->transaction_number = $data['transaction_number'];
						$generalLedger->amount = $interest;
						$generalLedger->loan = $key;
						$generalLedger->secondary_description = "Interest payments";
						$generalLedger->date = $loanpayments->date;
						$generalLedger->save();

						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $productprincipalconfigurations[0]['debit_account'];
						$generalLedger->entry_type = $debit[0]['id'];
						$generalLedger->transaction_number = $data['transaction_number'];
						$generalLedger->loan = $key;
						$generalLedger->secondary_description = "Principal payments";
						$generalLedger->amount = $principal;
						$generalLedger->date = $loanpayments->date;
						$generalLedger->save();

						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $productprincipalconfigurations[0]['credit_account'];
						$generalLedger->entry_type = $credit[0]['id'];
						$generalLedger->transaction_number = $data['transaction_number'];
						$generalLedger->loan = $key;
						$generalLedger->secondary_description = "Principal payments";
						$generalLedger->amount = $principal;
						$generalLedger->date = $loanpayments->date;
						$generalLedger->save();

						$loanpayments->save();

					} else {
						throw new Exception("Loan configurations missing for !" . $loan->loan_number);
					}
				}
			}

			// other payment types
			if (isset($data['other_payments']) && !empty($data['other_payments'])) {
				foreach ($data['other_payments'] as $key => $amount) {
					$otherpaymenttype = OtherPaymentTypes::find($key);

					$otherpaymenttypeaccountmappings = OtherPaymentTypeAccountMappings::where([["other_payment_type", "=", $key], ["payment_mode", "=", $data['payment_mode']]])->first();

					if (isset($otherpaymenttypeaccountmappings)) {
						$otherpayments = new OtherPayments();
						$otherpayments->other_payment_type = $key;
						$otherpayments->transaction_number=$data['transaction_number'];
						$otherpayments->payment_mode = $data['payment_mode'];
						$otherpayments->date = $data['transaction_date'];
						$otherpayments->amount = $amount;
						$otherpayments->client=$data['client_id'];
						$otherpayments->save();

						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $otherpaymenttypeaccountmappings->debit_account;
						$generalLedger->entry_type = $debit[0]['id'];
						$generalLedger->transaction_number = $data['transaction_number'];
						$generalLedger->client = $data['client_id'];
						$generalLedger->secondary_description = $otherpaymenttype->name . " payments";
						$generalLedger->amount = $amount;
						$generalLedger->date = $data['transaction_date'];
						$generalLedger->save();


						$generalLedger = new GeneralLedgers();
						$generalLedger->account = $otherpaymenttypeaccountmappings->credit_account;
						$generalLedger->entry_type = $credit[0]['id'];
						$generalLedger->transaction_number = $data['transaction_number'];
						$generalLedger->client = $data['client_id'];
						$generalLedger->secondary_description = $otherpaymenttype->name . " payments";
						$generalLedger->amount = $amount;
						$generalLedger->date = $data['transaction_date'];
						$generalLedger->save();

						$groupcashbook3->amount= $groupcashbook3->amount+$amount;
						$groupcashbook3->account = $otherpaymenttypeaccountmappings->debit_account;

						$groupcashbook31->amount= $groupcashbook31->amount+$amount;
						$groupcashbook31->account = $otherpaymenttypeaccountmappings->credit_account;


						if (isset($otherpayments) && !empty($otherpayments)) {
							$approved = TransactionStatuses::where([["code", "=", "002"]])->get()->first();
							if ($otherpaymenttype->code == "003") { //processing fee

								$processingfeepayments = new ProcessingFeePayments();

								$processingfeepayments->payment_mode = $data['payment_mode'];
								$processingfeepayments->transaction_number = $data['transaction_number'];
								$processingfeepayments->amount = $amount;
								$processingfeepayments->date = $data['transaction_date'];
								$processingfeepayments->transaction_status = $approved->id;
								$processingfeepayments->save();

								$groupcashbook->processing_fees=$groupcashbook->processing_fees+ $amount;
								
							} else if ($otherpaymenttype->code == "004") { //clearing fee

								$clearingfeepayments = new ClearingFeePayments();
								
								$clearingfeepayments->payment_mode = $data['payment_mode'];
								$clearingfeepayments->transaction_reference = $data['transaction_number'];
								$clearingfeepayments->amount = $amount;
								$clearingfeepayments->date = $data['transaction_date'];
								$clearingfeepayments->transaction_status = $approved->id;
								$clearingfeepayments->save();

								$groupcashbook->clearing_fees=$groupcashbook->clearing_fees+ $amount;

								// $groupcashbook2->clearing_fees=$groupcashbook2->clearing_fees+ $amount;

							} else if ($otherpaymenttype->code == "005") { //insurance deduction fee

								$insurancedeductionpayments = new InsuranceDeductionPayments();
								$insurancedeductionpayments->payment_mode = $data['payment_mode'];
								$insurancedeductionpayments->transaction_reference = $data['transaction_number'];
								$insurancedeductionpayments->amount = $amount;
								$insurancedeductionpayments->date = $data['transaction_date'];
								$insurancedeductionpayments->transaction_status = $approved->id;
								$insurancedeductionpayments->save();

								$groupcashbook->insurance_deduction_fees=$groupcashbook->insurance_deduction_fees+ $amount;

								// $groupcashbook2->insurance_deduction_fees=$groupcashbook2->insurance_deduction_fees+ $key;

							}else if($otherpaymenttype->code=="002"){
								$groupcashbook->fine=$groupcashbook->fine+$amount;
								// $groupcashbook2->fine=$groupcashbook2->fine+$amount;

							}else if($otherpaymenttype->code=="001"){
								// $groupcashbook2->mpesa_charges=$groupcashbook2->mpesa_charges+$amount;
							}
						}

					}
				}
			}

			$groupcashbook->save();
			$groupcashbook1->save();
			$groupcashbook2->save();
			$groupcashbook21->save();
			$groupcashbook3->save();
			$groupcashbook31->save();
			$groupcashbook4->save();
			$groupcashbook5->save();

			return response()->json([
				'status' => 'Successful',
				'message' => 'Transaction successful, Refresh page and please try again!!'
			]);
		});
	}
}