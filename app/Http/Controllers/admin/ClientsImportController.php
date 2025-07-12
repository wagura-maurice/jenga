<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Clients;
use App\Companies;
use App\Modules;
use App\Users;
use App\Genders;
use App\MaritalStatuses;
use App\ClientTypes;
use App\ClientCategories;
use App\Counties;
use App\SubCounties;
use App\NextOfKinRelationships;
use App\MainEconomicActivities;
use App\SecondaryEconomicActivities;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\UsersAccountsRoles;
class ClientsImportController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
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
		$clientsdata['list']=Clients::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_add']==0&&$clientsdata['usersaccountsroles'][0]['_list']==0&&$clientsdata['usersaccountsroles'][0]['_edit']==0&&$clientsdata['usersaccountsroles'][0]['_edit']==0&&$clientsdata['usersaccountsroles'][0]['_show']==0&&$clientsdata['usersaccountsroles'][0]['_delete']==0&&$clientsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
			return view('admin.clients.index',compact('clientsdata'));
		}
	}

	function clientsCount(){
		$count=Clients::count();
		return $count;
	}

	public function create(){
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
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($clients->save()){
			$ClientPhotoImage = $request->file('client_photo');
			$ClientPhotoImage->move('uploads/images',$clients->client_photo);
			$ClientFingerPrintImage = $request->file('client_finger_print');
			$ClientFingerPrintImage->move('uploads/images',$clients->client_finger_print);
			$ClientSignatureImage = $request->file('client_signature');
			$ClientSignatureImage->move('uploads/images',$clients->client_signature);
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
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}
	public function dbimport(Request $request){
		$clients=new Clients();
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
		ini_set('max_execution_time', 600);
		$query = DB::connection('mysql2')->select("select * from ".$request->get('db_table'));
		
		foreach($query as $result){
			$result=(array)$result;

			DB::transaction(function() use($result){
				$clients=new Clients();
				$clients->client_number=$result['client_number'];
				$clients->first_name=$result['first_name'];
				$clients->middle_name=$result['middle_name'];
				$clients->last_name=$result['last_name'];
				$clients->id_number=$result['id_number'];
				$clients->primary_phone_number=$result['primary_phone_number'];
				$clients->secondary_phone_number=$result['secondary_phone_number'];
				if($result['gender']=="MALE"){
					$gender=Genders::where([['code','=','001']])->get();
					$clients->gender=$gender[0]['id'];
				}else{
					$gender=Genders::where([['code','=','002']])->get();
					$clients->gender=$clients->gender=$gender[0]['id'];
				}
				
				$clients->date_of_birth=$result['date_of_birth'];
				if($result['marital_status']=='MARRIED'){
					$maritalstatus=MaritalStatuses::where([['code','=','002']])->get();
					$clients->marital_status=$maritalstatus[0]['id'];
				}else{
					$maritalstatus=MaritalStatuses::where([['code','=','002']])->get();
					$clients->marital_status=$maritalstatus[0]['id'];
				}
				
				$clients->postal_address=$result['postal_address'];
				$clients->postal_code=$result['code'];
				$clients->postal_town=$result['postal_address'];
				$clients->email_address=$result['email_address'];
				$clienttype=ClientTypes::where([['code','=','001']])->get();
				$clients->client_type=$clienttype[0]['id'];
				$clientcategory=ClientCategories::where([['code','=','001']])->get();
				$clients->client_category=$clientcategory[0]['id'];

				$clients->county=1;
				$clients->sub_county=1;
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
				$clients->relationship_with_next_of_kin=1;
				$clients->next_of_kin_primary_phone_number=$result['next_of_kin_phone_number'];
				$clients->next_of_kin_secondary_phone_number=$result['next_of_kin_secondary_phone_number'];
				$clients->next_of_kin_email_address='';
				$clients->next_of_kin_county=1;
				$clients->next_of_kin_sub_county=1;
				$clients->next_of_kin_location=$result['next_of_kin_location'];
				$clients->main_economic_activity=1;
				$clients->secondary_economic_activity=1;
				$clients->client_photo='';
				$clients->client_finger_print='';
				$clients->client_signature='';
				$clients->comments=$result['comments'];
				$clients->save();

			});			
		}
		$response['status']='1';
		$response['message']='clients Added successfully';
		return json_encode($response);
	}

	public function edit($id){
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
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('clientsdata'));
		}else{
		return view('admin.clients.edit',compact('clientsdata','id'));
		}
	}

	public function show($id){
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

	public function destroy($id){
		$clients=Clients::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Clients']])->get();
		$clientsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($clientsdata['usersaccountsroles'][0]['_delete']==1){
			$clients->delete();
		}return redirect('admin/clients')->with('success','clients has been deleted!');
	}
}