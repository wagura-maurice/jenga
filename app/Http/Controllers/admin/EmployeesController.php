<?php
namespace App\Http\Controllers\admin;
use App\User;
use App\Banks;
use App\Users;
use App\Genders;
use App\Modules;
use App\Branches;
use App\PayModes;
use App\Companies;
use App\Employees;
use App\PayPoints;
use App\Positions;
use App\Departments;
use App\BankBranches;
use App\Http\Requests;
use App\UsersAccounts;
use App\EmployeeGroups;
use App\MaritalStatuses;
use App\EmployeeCategories;
use App\UsersAccountsRoles;
use Illuminate\Http\Request;
use App\NextOfKinRelationships;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmployeesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function employeesCount(){
		
		return Employees::count();
	}
	
	public function index(){
		$employeesdata['genders']=Genders::all();
		$employeesdata['maritalstatuses']=MaritalStatuses::all();
		$employeesdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$employeesdata['paypoints']=PayPoints::all();
		$employeesdata['paymodes']=PayModes::all();
		$employeesdata['banks']=Banks::all();
		$employeesdata['bankbranches']=BankBranches::all();
		$employeesdata['departments']=Departments::all();
		$employeesdata['employeecategories']=EmployeeCategories::all();
		$employeesdata['employeegroups']=EmployeeGroups::all();
		$employeesdata['positions']=Positions::all();
		$employeesdata['branches']=Branches::all();
		$employeesdata['list']=Employees::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Employees']])->get();
		$employeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeesdata['usersaccountsroles'][0]['_add']==0&&$employeesdata['usersaccountsroles'][0]['_list']==0&&$employeesdata['usersaccountsroles'][0]['_edit']==0&&$employeesdata['usersaccountsroles'][0]['_edit']==0&&$employeesdata['usersaccountsroles'][0]['_show']==0&&$employeesdata['usersaccountsroles'][0]['_delete']==0&&$employeesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('employeesdata'));
		}else{
			return view('admin.employees.index',compact('employeesdata'));
		}
	}

	public function create(){
		$employeesdata;
		$employeesdata['usersaccounts']=UsersAccounts::all();
		$employeesdata['genders']=Genders::all();
		$employeesdata['maritalstatuses']=MaritalStatuses::all();
		$employeesdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$employeesdata['paypoints']=PayPoints::all();
		$employeesdata['paymodes']=PayModes::all();
		$employeesdata['banks']=Banks::all();
		$employeesdata['bankbranches']=BankBranches::all();
		$employeesdata['departments']=Departments::all();
		$employeesdata['employeecategories']=EmployeeCategories::all();
		$employeesdata['employeegroups']=EmployeeGroups::all();
		$employeesdata['positions']=Positions::all();
		$employeesdata['branches']=Branches::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Employees']])->get();
		$employeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('employeesdata'));
		}else{
			return view('admin.employees.create',compact('employeesdata'));
		}
	}

	public function filter(Request $request){
		$employeesdata['genders']=Genders::all();
		$employeesdata['maritalstatuses']=MaritalStatuses::all();
		$employeesdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$employeesdata['paypoints']=PayPoints::all();
		$employeesdata['paymodes']=PayModes::all();
		$employeesdata['banks']=Banks::all();
		$employeesdata['bankbranches']=BankBranches::all();
		$employeesdata['departments']=Departments::all();
		$employeesdata['employeecategories']=EmployeeCategories::all();
		$employeesdata['employeegroups']=EmployeeGroups::all();
		$employeesdata['positions']=Positions::all();
		$employeesdata['branches']=Branches::all();
		$employeesdata['list']=Employees::where([['first_name','LIKE','%'.$request->get('first_name').'%'],['middle_name','LIKE','%'.$request->get('middle_name').'%'],['last_name','LIKE','%'.$request->get('last_name').'%'],['employee_number','LIKE','%'.$request->get('employee_number').'%'],['id_number','LIKE','%'.$request->get('id_number').'%'],['passport_number','LIKE','%'.$request->get('passport_number').'%'],['country_of_issue','LIKE','%'.$request->get('country_of_issue').'%'],['gender','LIKE','%'.$request->get('gender').'%'],['marital_status','LIKE','%'.$request->get('marital_status').'%'],['dependencies','LIKE','%'.$request->get('dependencies').'%'],['next_of_kin_name','LIKE','%'.$request->get('next_of_kin_name').'%'],['relationship_with_next_of_kin','LIKE','%'.$request->get('relationship_with_next_of_kin').'%'],['next_of_kin_phone_number','LIKE','%'.$request->get('next_of_kin_phone_number').'%'],['is_disabled','LIKE','%'.$request->get('is_disabled').'%'],['nature_of_disability','LIKE','%'.$request->get('nature_of_disability').'%'],['phone_number','LIKE','%'.$request->get('phone_number').'%'],['email_address','LIKE','%'.$request->get('email_address').'%'],['physical_address','LIKE','%'.$request->get('physical_address').'%'],['postal_address','LIKE','%'.$request->get('postal_address').'%'],['postal_code','LIKE','%'.$request->get('postal_code').'%'],['pin_number','LIKE','%'.$request->get('pin_number').'%'],['nhif_number','LIKE','%'.$request->get('nhif_number').'%'],['nssf_number','LIKE','%'.$request->get('nssf_number').'%'],['helb_number','LIKE','%'.$request->get('helb_number').'%'],['university_registration_number','LIKE','%'.$request->get('university_registration_number').'%'],['is_terminated','LIKE','%'.$request->get('is_terminated').'%'],['previous_employer_name','LIKE','%'.$request->get('previous_employer_name').'%'],['pay_point','LIKE','%'.$request->get('pay_point').'%'],['pay_mode','LIKE','%'.$request->get('pay_mode').'%'],['bank','LIKE','%'.$request->get('bank').'%'],['bank_branch','LIKE','%'.$request->get('bank_branch').'%'],['bank_account_number','LIKE','%'.$request->get('bank_account_number').'%'],['bank_account_name','LIKE','%'.$request->get('bank_account_name').'%'],['department','LIKE','%'.$request->get('department').'%'],['employee_category','LIKE','%'.$request->get('employee_category').'%'],['employee_group','LIKE','%'.$request->get('employee_group').'%'],['position','LIKE','%'.$request->get('position').'%'],['branch','LIKE','%'.$request->get('branch').'%'],['user_name','LIKE','%'.$request->get('user_name').'%'],['password','LIKE','%'.$request->get('password').'%'],])->orWhereBetween('expiry_date',[$request->get('expiry_datefrom'),$request->get('expiry_dateto')])->orWhereBetween('date_of_birth',[$request->get('date_of_birthfrom'),$request->get('date_of_birthto')])->orWhereBetween('employment_date',[$request->get('employment_datefrom'),$request->get('employment_dateto')])->orWhereBetween('termination_date',[$request->get('termination_datefrom'),$request->get('termination_dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Employees']])->get();
		$employeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeesdata['usersaccountsroles'][0]['_add']==0&&$employeesdata['usersaccountsroles'][0]['_list']==0&&$employeesdata['usersaccountsroles'][0]['_edit']==0&&$employeesdata['usersaccountsroles'][0]['_edit']==0&&$employeesdata['usersaccountsroles'][0]['_show']==0&&$employeesdata['usersaccountsroles'][0]['_delete']==0&&$employeesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('employeesdata'));
		}else{
			return view('admin.employees.index',compact('employeesdata'));
		}
	}

	public function report(){
		$employeesdata['company']=Companies::all();
		$employeesdata['list']=Employees::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Employees']])->get();
		$employeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('employeesdata'));
		}else{
			return view('admin.employees.report',compact('employeesdata'));
		}
	}

	public function chart(){
		return view('admin.employees.chart');
	}

	public function store(Request $request){
		$employees=new Employees();
		$employees->first_name=$request->get('first_name');
		$employees->middle_name=$request->get('middle_name');
		$employees->last_name=$request->get('last_name');
		$employees->employee_number=$request->get('employee_number');
		$employees->id_number=$request->get('id_number');
		$employees->passport_number=$request->get('passport_number');
		$employees->country_of_issue=$request->get('country_of_issue');
		$employees->expiry_date=$request->get('expiry_date');
		$employees->gender=$request->get('gender');
		$employees->date_of_birth=$request->get('date_of_birth');
		$employees->marital_status=$request->get('marital_status');
		$employees->dependencies=$request->get('dependencies');
		$employees->next_of_kin_name=$request->get('next_of_kin_name');
		$employees->relationship_with_next_of_kin=$request->get('relationship_with_next_of_kin');
		$employees->next_of_kin_phone_number=$request->get('next_of_kin_phone_number');
		$employees->is_disabled=$request->get('is_disabled');
		$employees->nature_of_disability=$request->get('nature_of_disability');
		$employees->phone_number=$request->get('phone_number');
		$employees->email_address=$request->get('email_address');
		$employees->physical_address=$request->get('physical_address');
		$employees->postal_address=$request->get('postal_address');
		$employees->postal_code=$request->get('postal_code');
		$employees->pin_number=$request->get('pin_number');
		$employees->nhif_number=$request->get('nhif_number');
		$employees->nssf_number=$request->get('nssf_number');
		$employees->helb_number=$request->get('helb_number');
		$employees->university_registration_number=$request->get('university_registration_number');
		$employees->employment_date=$request->get('employment_date');
		$employees->is_terminated=$request->get('is_terminated');
		$employees->termination_date=$request->get('termination_date');
		$employees->previous_employer_name=$request->get('previous_employer_name');
		$employees->pay_point=$request->get('pay_point');
		$employees->pay_mode=$request->get('pay_mode');
		$employees->bank=$request->get('bank');
		$employees->bank_branch=$request->get('bank_branch');
		$employees->bank_account_number=$request->get('bank_account_number');
		$employees->bank_account_name=$request->get('bank_account_name');
		$employees->department=$request->get('department');
		$employees->employee_category=$request->get('employee_category');
		$employees->employee_group=$request->get('employee_group');
		$employees->position=$request->get('position');
		$employees->branch=$request->get('branch');
		$employees->user_name=$request->get('user_name');
		$employees->password=bcrypt($request->get('password'));
		$employees->image=time() . '_' . rand(1000, 9999) . '.jpg';
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Employees']])->get();
		$employeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeesdata['usersaccountsroles'][0]['_show']==1){
			try {
				if($employees->save()) {
					$user = new User;
					$user->name = strtoupper($employees->first_name);
					$user->user_account = $request->get('user_account');
					$user->email = $employees->email_address;
					$user->branch_id = $employees->branch;
					$user->password = $employees->password;
					$user->save();

					$employees->user_id = $user->id;
					$employees->save();

					$ImageImage = $request->file('image');
					$ImageImage->move('uploads/images',$employees->image);
					$response['status']='1';
					$response['message']='employees Added successfully';
				} else {
						$response['status']='0';
						$response['message']='Failed to add employees. Please try again';
					}
				}
			catch(\Exception $e){
				$response['status']='0';
				$response['message']='An Error occured while attempting to add employees. Please try again';
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
		}

		return json_encode($response);
	}

	public function dbimport(){
		ini_set('max_execution_time', 600);
		$query = DB::connection('mysql2')->select("select * from user");
		DB::transaction(function() use($query){
			foreach ($query as $employee) {
				$employees=new Employees();
				$employees->first_name=$employee->first_name;
				$employees->middle_name='';
				$employees->last_name=$employee->other_names;
				$employees->employee_number=$employee->user_number;
				$employees->id_number='';
				$employees->passport_number='';
				$employees->country_of_issue='';
				$employees->expiry_date='';
				if($employee->gender=='MALE'){
					$gender=Genders::where([['code','=','001']])->get();
					$employees->gender=$gender[0]['id'];

				}else{
					$gender=Genders::where([['code','=','002']])->get();
					$employees->gender=$gender[0]['id'];

				}
				$employees->date_of_birth='';
				$maritalstatus=MaritalStatuses::where([['code','=','001']])->get();
				$employees->marital_status=$maritalstatus[0]['id'];
				$employees->dependencies=0;
				$employees->next_of_kin_name='';

				$employees->relationship_with_next_of_kin=1;
				$employees->next_of_kin_phone_number='';
				$employees->is_disabled=0;
				$employees->nature_of_disability='';
				$employees->phone_number=$employee->mobile_number;
				$employees->email_address=$employee->email;
				$employees->physical_address='';
				$employees->postal_address='';
				$employees->postal_code='';
				$employees->pin_number='';
				$employees->nhif_number='';
				$employees->nssf_number='';
				$employees->helb_number='';
				$employees->university_registration_number='';
				$employees->employment_date='';
				$employees->is_terminated=0;
				$employees->termination_date='';
				$employees->previous_employer_name='';
				$employees->pay_point=1;
				$employees->pay_mode=1;
				$employees->bank=1;
				$employees->bank_branch=1;
				$employees->bank_account_number='';
				$employees->bank_account_name='';
				$employees->department=1;
				$employees->employee_category=1;
				$employees->employee_group=1;
				$employees->position=1;
				$employees->branch=1;
				$employees->user_name=$employee->email;
				$employees->password=bcrypt($employee->mobile_number);
				$employees->image='';
				$employees->save();

			}

		});		
		$employeesdata['genders']=Genders::all();
		$employeesdata['maritalstatuses']=MaritalStatuses::all();
		$employeesdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$employeesdata['paypoints']=PayPoints::all();
		$employeesdata['paymodes']=PayModes::all();
		$employeesdata['banks']=Banks::all();
		$employeesdata['bankbranches']=BankBranches::all();
		$employeesdata['departments']=Departments::all();
		$employeesdata['employeecategories']=EmployeeCategories::all();
		$employeesdata['employeegroups']=EmployeeGroups::all();
		$employeesdata['positions']=Positions::all();
		$employeesdata['branches']=Branches::all();
		$employeesdata['list']=Employees::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Employees']])->get();
		$employeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeesdata['usersaccountsroles'][0]['_add']==0&&$employeesdata['usersaccountsroles'][0]['_list']==0&&$employeesdata['usersaccountsroles'][0]['_edit']==0&&$employeesdata['usersaccountsroles'][0]['_edit']==0&&$employeesdata['usersaccountsroles'][0]['_show']==0&&$employeesdata['usersaccountsroles'][0]['_delete']==0&&$employeesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('employeesdata'));
		}else{
			return view('admin.employees.index',compact('employeesdata'));
		}

	}
	public function edit($id){
		$employeesdata['genders']=Genders::all();
		$employeesdata['maritalstatuses']=MaritalStatuses::all();
		$employeesdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$employeesdata['paypoints']=PayPoints::all();
		$employeesdata['paymodes']=PayModes::all();
		$employeesdata['banks']=Banks::all();
		$employeesdata['bankbranches']=BankBranches::all();
		$employeesdata['departments']=Departments::all();
		$employeesdata['employeecategories']=EmployeeCategories::all();
		$employeesdata['employeegroups']=EmployeeGroups::all();
		$employeesdata['positions']=Positions::all();
		$employeesdata['branches']=Branches::all();
		$employeesdata['data']=Employees::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Employees']])->get();
		$employeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('employeesdata'));
		}else{
		return view('admin.employees.edit',compact('employeesdata','id'));
		}
	}

	public function show($id){
		$employeesdata['genders']=Genders::all();
		$employeesdata['maritalstatuses']=MaritalStatuses::all();
		$employeesdata['nextofkinrelationships']=NextOfKinRelationships::all();
		$employeesdata['paypoints']=PayPoints::all();
		$employeesdata['paymodes']=PayModes::all();
		$employeesdata['banks']=Banks::all();
		$employeesdata['bankbranches']=BankBranches::all();
		$employeesdata['departments']=Departments::all();
		$employeesdata['employeecategories']=EmployeeCategories::all();
		$employeesdata['employeegroups']=EmployeeGroups::all();
		$employeesdata['positions']=Positions::all();
		$employeesdata['branches']=Branches::all();
		$employeesdata['data']=Employees::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Employees']])->get();
		$employeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('employeesdata'));
		}else{
		return view('admin.employees.show',compact('employeesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$employees=Employees::find($id);
		$employees->first_name=$request->get('first_name');
		$employees->middle_name=$request->get('middle_name');
		$employees->last_name=$request->get('last_name');
		$employees->employee_number=$request->get('employee_number');
		$employees->id_number=$request->get('id_number');
		$employees->passport_number=$request->get('passport_number');
		$employees->country_of_issue=$request->get('country_of_issue');
		$employees->expiry_date=$request->get('expiry_date');
		$employees->gender=$request->get('gender');
		$employees->date_of_birth=$request->get('date_of_birth');
		$employees->marital_status=$request->get('marital_status');
		$employees->dependencies=$request->get('dependencies');
		$employees->next_of_kin_name=$request->get('next_of_kin_name');
		$employees->relationship_with_next_of_kin=$request->get('relationship_with_next_of_kin');
		$employees->next_of_kin_phone_number=$request->get('next_of_kin_phone_number');
		$employees->is_disabled=$request->get('is_disabled');
		$employees->nature_of_disability=$request->get('nature_of_disability');
		$employees->phone_number=$request->get('phone_number');
		$employees->email_address=$request->get('email_address');
		$employees->physical_address=$request->get('physical_address');
		$employees->postal_address=$request->get('postal_address');
		$employees->postal_code=$request->get('postal_code');
		$employees->pin_number=$request->get('pin_number');
		$employees->nhif_number=$request->get('nhif_number');
		$employees->nssf_number=$request->get('nssf_number');
		$employees->helb_number=$request->get('helb_number');
		$employees->university_registration_number=$request->get('university_registration_number');
		$employees->employment_date=$request->get('employment_date');
		$employees->is_terminated=$request->get('is_terminated');
		$employees->termination_date=$request->get('termination_date');
		$employees->previous_employer_name=$request->get('previous_employer_name');
		$employees->pay_point=$request->get('pay_point');
		$employees->pay_mode=$request->get('pay_mode');
		$employees->bank=$request->get('bank');
		$employees->bank_branch=$request->get('bank_branch');
		$employees->bank_account_number=$request->get('bank_account_number');
		$employees->bank_account_name=$request->get('bank_account_name');
		$employees->department=$request->get('department');
		$employees->employee_category=$request->get('employee_category');
		$employees->employee_group=$request->get('employee_group');
		$employees->position=$request->get('position');
		$employees->branch=$request->get('branch');
		$employees->user_name=$request->get('user_name');
		$employees->password=$request->get('password');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Employees']])->get();
		$employeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('employeesdata'));
		}else{
			$employees->save();
			$employeesdata['data']=Employees::find($id);
			return view('admin.employees.edit',compact('employeesdata','id'));
		}
	}

	public function destroy($id){
		$employees=Employees::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Employees']])->get();
		$employeesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($employeesdata['usersaccountsroles'][0]['_delete']==1){
			$employees->delete();
		}return redirect('admin/employees')->with('success','employees has been deleted!');
	}
}