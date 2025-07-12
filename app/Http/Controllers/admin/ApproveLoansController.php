<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Loans;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\Clients;
use App\PaymentModes;
use App\InterestRateTypes;
use App\InterestPaymentMethods;
use App\LoanPaymentDurations;
use App\LoanPaymentFrequencies;
use App\ClearingFeePayments;
use App\ProcessingFeePayments;
use App\InsuranceDeductionPayments;
use App\FeeTypes;
use App\FeePaymentTypes;
use App\GracePeriods;
use App\LoanGuarantors;
use App\DisbursementModes;
use App\FineTypes;
use Carbon\Carbon;
use App\LoanCollaterals;
use App\FineChargeFrequencies;
use App\FineChargePeriods;
use App\LoanStatuses;
use App\ProductApprovalConfigurations;
use App\ApprovalLevels;
use App\LoanDocuments;
use App\LoanApprovals;
use App\ApprovalStatuses;
use App\UsersAccounts;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
use Illuminate\Support\Facades\DB;
use App\LoanDisbursements;
use App\DisbursementStatuses;
class ApproveLoansController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$loansdata['loanproducts']=LoanProducts::all();
		$loansdata['clients']=Clients::all();
		$loansdata['interestratetypes']=InterestRateTypes::all();
		$loansdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations']=LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies']=LoanPaymentFrequencies::all();
		$loansdata['graceperiods']=GracePeriods::all();
		$loansdata['disbursementmodes']=DisbursementModes::all();
		$loansdata['finetypes']=FineTypes::all();
		$loansdata['finechargefrequencies']=FineChargeFrequencies::all();
		$loansdata['finechargeperiods']=FineChargePeriods::all();
		$loansdata['loanstatuses']=LoanStatuses::all();
		$loansdata['list']=Loans::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Loans']])->get();
		$loansdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loansdata['usersaccountsroles'][0]['_add']==0&&$loansdata['usersaccountsroles'][0]['_list']==0&&$loansdata['usersaccountsroles'][0]['_edit']==0&&$loansdata['usersaccountsroles'][0]['_edit']==0&&$loansdata['usersaccountsroles'][0]['_show']==0&&$loansdata['usersaccountsroles'][0]['_delete']==0&&$loansdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loansdata'));
		}else{
			return view('admin.loans.index',compact('loansdata'));
		}
	}

	function getLoansCount(){
		return Loans::count();
	}
	function getInterestCharged(Request $request){
		$loans=new Loans();
		$loanAmount=$request->get('loan_amount');
		$interestRate=$request->get('interest_rate');
		$interestRateTypeId=$request->get('interest_rate_type');
		$interestRateType=InterestRateTypes::find($interestRateTypeId);
		$interestRateTypeCode=$interestRateType->code;
		return $loans->getInterestCharged($loanAmount,$interestRate,$interestRateTypeCode);
	}

	function getTotalLoanAmount(Request $request){
		$loans=new Loans();
		$loanAmount=$request->get('loan_amount');
		$interestCharged=$request->get('interest_charged');
		$interestPaymentMethodId=$request->get('interest_payment_method');
		$interestPaymentMethod=InterestPaymentMethods::find($interestPaymentMethodId);
		$interestPaymentMethodCode=$interestPaymentMethod->code;
		return $loans->getTotalLoanAmount($loanAmount,$interestCharged,$interestPaymentMethodCode);
	}
	function getAmountToBeDisbursed(Request $request){
		$loans=new Loans();
		$loanAmount=$request->get('loan_amount');
		$interestCharged=$request->get('interest_charged');
		$interestPaymentMethodId=$request->get('interest_payment_method');
		$clearingFee=$request->get("clearing_fee");
		$insuranceDeductionFee=$request->get("insurance_deduction_fee");
		$interestPaymentMethod=InterestPaymentMethods::find($interestPaymentMethodId);
		$interestPaymentMethodCode=$interestPaymentMethod->code;
		return $loans->getAmountToBeDisbursed($loanAmount,$interestCharged,$interestPaymentMethodCode,$clearingFee,$insuranceDeductionFee);
	}

	public function create(){
		$loansdata;
		$loansdata['loanproducts']=LoanProducts::all();
		$loansdata['clients']=Clients::all();
		$loansdata['interestratetypes']=InterestRateTypes::all();
		$loansdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations']=LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies']=LoanPaymentFrequencies::all();
		$loansdata['graceperiods']=GracePeriods::all();
		$loansdata['disbursementmodes']=DisbursementModes::all();
		$loansdata['finetypes']=FineTypes::all();
		$loansdata['finechargefrequencies']=FineChargeFrequencies::all();
		$loansdata['finechargeperiods']=FineChargePeriods::all();
		$loansdata['loanstatuses']=LoanStatuses::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Loans']])->get();
		$loansdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loansdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('loansdata'));
		}else{
			return view('admin.loans.create',compact('loansdata'));
		}
	}

	public function filter(Request $request){
		$loansdata['loanproducts']=LoanProducts::all();
		$loansdata['clients']=Clients::all();
		$loansdata['interestratetypes']=InterestRateTypes::all();
		$loansdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations']=LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies']=LoanPaymentFrequencies::all();
		$loansdata['graceperiods']=GracePeriods::all();
		$loansdata['disbursementmodes']=DisbursementModes::all();
		$loansdata['finetypes']=FineTypes::all();
		$loansdata['finechargefrequencies']=FineChargeFrequencies::all();
		$loansdata['finechargeperiods']=FineChargePeriods::all();
		$loansdata['loanstatuses']=LoanStatuses::all();
		$loansdata['list']=Loans::where([['loan_number','LIKE','%'.$request->get('loan_number').'%'],['loan_product','LIKE','%'.$request->get('loan_product').'%'],['client','LIKE','%'.$request->get('client').'%'],['amount','LIKE','%'.$request->get('amount').'%'],['interest_rate_type','LIKE','%'.$request->get('interest_rate_type').'%'],['interest_rate','LIKE','%'.$request->get('interest_rate').'%'],['interest_payment_method','LIKE','%'.$request->get('interest_payment_method').'%'],['loan_payment_duration','LIKE','%'.$request->get('loan_payment_duration').'%'],['loan_payment_frequency','LIKE','%'.$request->get('loan_payment_frequency').'%'],['grace_period','LIKE','%'.$request->get('grace_period').'%'],['interest_charged','LIKE','%'.$request->get('interest_charged').'%'],['total_loan_amount','LIKE','%'.$request->get('total_loan_amount').'%'],['amount_to_be_disbursed','LIKE','%'.$request->get('amount_to_be_disbursed').'%'],['mode_of_disbursement','LIKE','%'.$request->get('mode_of_disbursement').'%'],['clearing_fee','LIKE','%'.$request->get('clearing_fee').'%'],['insurance_deduction_fee','LIKE','%'.$request->get('insurance_deduction_fee').'%'],['fine_type','LIKE','%'.$request->get('fine_type').'%'],['fine_charge','LIKE','%'.$request->get('fine_charge').'%'],['fine_charge_frequency','LIKE','%'.$request->get('fine_charge_frequency').'%'],['fine_charge_period','LIKE','%'.$request->get('fine_charge_period').'%'],['initial_deposit','LIKE','%'.$request->get('initial_deposit').'%'],['status','LIKE','%'.$request->get('status').'%'],])->orWhereBetween('date',[$request->get('datefrom'),$request->get('dateto')])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Loans']])->get();
		$loansdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loansdata['usersaccountsroles'][0]['_add']==0&&$loansdata['usersaccountsroles'][0]['_list']==0&&$loansdata['usersaccountsroles'][0]['_edit']==0&&$loansdata['usersaccountsroles'][0]['_edit']==0&&$loansdata['usersaccountsroles'][0]['_show']==0&&$loansdata['usersaccountsroles'][0]['_delete']==0&&$loansdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loansdata'));
		}else{
			return view('admin.loans.index',compact('loansdata'));
		}
	}

	public function report(){
		$loansdata['company']=Companies::all();
		$loansdata['list']=Loans::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Loans']])->get();
		$loansdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loansdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('loansdata'));
		}else{
			return view('admin.loans.report',compact('loansdata'));
		}
	}

	public function chart(){
		return view('admin.loans.chart');
	}

	public function store(Request $request){
		$loans=new Loans();
		$loans->loan_number=$request->get('loan_number');
		$loans->loan_product=$request->get('loan_product');
		$loans->client=$request->get('client');
		$loans->date=$request->get('date');
		$loans->amount=$request->get('amount');
		$loans->interest_rate_type=$request->get('interest_rate_type');
		$loans->interest_rate=$request->get('interest_rate');
		$loans->interest_payment_method=$request->get('interest_payment_method');
		$loans->loan_payment_duration=$request->get('loan_payment_duration');
		$loans->loan_payment_frequency=$request->get('loan_payment_frequency');
		$loans->grace_period=$request->get('grace_period');
		$loans->interest_charged=$request->get('interest_charged');
		$loans->total_loan_amount=$request->get('total_loan_amount');
		$loans->amount_to_be_disbursed=$request->get('amount_to_be_disbursed');
		$loans->mode_of_disbursement=$request->get('mode_of_disbursement');
		$loans->clearing_fee=$request->get('clearing_fee');
		$loans->insurance_deduction_fee=$request->get('insurance_deduction_fee');
		$loans->fine_type=$request->get('fine_type');
		$loans->fine_charge=$request->get('fine_charge');
		$loans->fine_charge_frequency=$request->get('fine_charge_frequency');
		$loans->fine_charge_period=$request->get('fine_charge_period');
		$loans->initial_deposit=$request->get('initial_deposit');
		$loans->status=$request->get('status');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Loans']])->get();
		$loansdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loansdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($loans->save()){
					$response['status']='1';
					$response['message']='loans Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add loans. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add loans. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$loansdata['clients']=Clients::all();
		$loansdata['interestratetypes']=InterestRateTypes::all();
		$loansdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations']=LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies']=LoanPaymentFrequencies::all();
		$loansdata['graceperiods']=GracePeriods::all();
		$loansdata['disbursementmodes']=DisbursementModes::all();
		$loansdata['finetypes']=FineTypes::all();
		$loansdata['finechargefrequencies']=FineChargeFrequencies::all();
		$loansdata['finechargeperiods']=FineChargePeriods::all();
		$loansdata['loanstatuses']=LoanStatuses::all();
		$loansdata['data']=Loans::find($id);
		$loansdata['documents']=LoanDocuments::where([['loan','=',$id]])->orderBy('id','desc')->get();		
		$loansdata['guarantors']=LoanGuarantors::where([['loan','=',$id]])->orderBy('id','desc')->get();
		$loansdata['collaterals']=LoanCollaterals::where([['loan','=',$id]])->orderBy('id','desc')->get();
		$loansdata['loanproduct']=LoanProducts::find($loansdata['data']->loan_product);;
		$loanproduct=$loansdata['loanproduct'];

		$loansdata['loanschedule']=app('App\Http\Controllers\admin\LoansController')->getloanschedule(Carbon::now(),$loanproduct->graceperiodmodel->number_of_days,$loanproduct->loanpaymentfrequencymodel->number_of_days,$loanproduct->loanpaymentdurationmodel->number_of_days,$loansdata['data']->total_loan_amount);

		

		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Loans']])->get();
		$loansdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loansdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loansdata'));
		}else{
		return view('admin.loans.edit',compact('loansdata','id'));
		}
	}

	public function show($id){
		$loansdata['loanproduct']=LoanProducts::all();
		$loansdata['clients']=Clients::all();
		$loansdata['interestratetypes']=InterestRateTypes::all();
		$loansdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations']=LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies']=LoanPaymentFrequencies::all();
		$loansdata['graceperiods']=GracePeriods::all();
		$loansdata['disbursementmodes']=DisbursementModes::all();
		$loansdata['finetypes']=FineTypes::all();
		$loansdata['finechargefrequencies']=FineChargeFrequencies::all();
		$loansdata['finechargeperiods']=FineChargePeriods::all();
		$loansdata['loanstatuses']=LoanStatuses::all();
		$loansdata['data']=Loans::find($id);
		
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Loans']])->get();
		$loansdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loansdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('loansdata'));
		}else{
		return view('admin.loans.show',compact('loansdata','id'));
		}
	}

	public function loanApproval($id){
		$loansdata['data']=Loans::find($id);
		$loansdata['paymentmodes']=PaymentModes::all();
		$loansdata['clients']=Clients::all();
		$loansdata['interestratetypes']=InterestRateTypes::all();
		$loansdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations']=LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies']=LoanPaymentFrequencies::all();
		$loansdata['graceperiods']=GracePeriods::all();
		$loansdata['disbursementmodes']=DisbursementModes::all();
		$loansdata['finetypes']=FineTypes::all();
		$loansdata['finechargefrequencies']=FineChargeFrequencies::all();
		$loansdata['finechargeperiods']=FineChargePeriods::all();
		$loansdata['loanstatuses']=LoanStatuses::all();
		
		$loansdata['myturn']=false;
		$loan=$loansdata['data']::find($id);
		$loansdata['documents']=LoanDocuments::where([['loan','=',$id]])->orderBy('id','desc')->get();		
		$loansdata['guarantors']=LoanGuarantors::where([['loan','=',$id]])->orderBy('id','desc')->get();
		$loansdata['collaterals']=LoanCollaterals::where([['loan','=',$id]])->orderBy('id','desc')->get();
		$loansdata['loanproduct']=LoanProducts::find($loansdata['data']->loan_product);
		
		$feepaymenttype=FeePaymentTypes::where([['code','001']])->get();
		
		// $loansdata["processingfee"]=isset($feepaymenttype[0]) && $feepaymenttype[0]->id==$loansdata['data']->processing_fee_payment_type?app('App\Http\Controllers\admin\LoansController')->getProcessingFee($loansdata['loanproduct']):0;
		$loansdata['processingfee'] = $loansdata['data']['processing_fee'];
		
		// $loansdata['clearingfee']=isset($feepaymenttype[0]) && $feepaymenttype[0]->id==$loansdata['data']->clearing_fee_payment_type?app('App\Http\Controllers\admin\LoansController')->getClearingFee($loansdata['loanproduct']):0;
		$loansdata['clearingfee'] = $loansdata['data']['clearing_fee'];

		// $loansdata['insurancedeductionfee']=isset($feepaymenttype[0]) && $feepaymenttype[0]->id==$loansdata['data']->insurance_deduction_payment_fee_type?app('App\Http\Controllers\admin\LoansController')->getInsuranceDeductionFee($loansdata['loanproduct']):0;
		$loansdata['insurancedeductionfee'] = $loansdata['data']['insurance_deduction_fee'];

		$loansdata["clearingfeepaid"]=isset($feepaymenttype[0]) && $feepaymenttype[0]->id==$loansdata['data']->clearing_fee_payment_type?ClearingFeePayments::where([["loan_number","=",$id]])->sum("amount"):0;

		$pendingclearingfee=isset($feepaymenttype[0]) && $feepaymenttype[0]->id==$loansdata['data']->clearing_fee_payment_type?$loansdata['clearingfee']:0;

		$loansdata["processingfeepaid"]=isset($feepaymenttype[0]) && $feepaymenttype[0]->id==$loansdata['data']->processing_fee_payment_type?ProcessingFeePayments::where([["loan_number","=",$id]])->sum("amount"):0;

		$pendingprocessingfee=isset($feepaymenttype[0]) && $feepaymenttype[0]->id==$loansdata['data']->processing_fee_payment_type?$loansdata['processingfee']:0;

		$loansdata["insurancedeductionfeepaid"]=isset($feepaymenttype[0]) && $feepaymenttype[0]->id==$loansdata['data']->insurance_deduction_fee_payment_type?InsuranceDeductionPayments::where([["loan_number","=",$id]])->sum("amount"):0;

		$pendinginsurancedeductionfee=isset($feepaymenttype[0]) && $feepaymenttype[0]->id==$loansdata['data']->insurance_deduction_fee_payment_type?$loansdata['insurancedeductionfee']:0;

		$loansdata["pendingfee"]=($pendingclearingfee + $pendingprocessingfee + $pendinginsurancedeductionfee)-($loansdata["clearingfeepaid"]+$loansdata["processingfeepaid"]+$loansdata["insurancedeductionfeepaid"]);
		
		

		$loanproduct=$loansdata['loanproduct'];
		// print_r($loansdata['data']);
		// die();
		$loansdata['loanschedule']=app('App\Http\Controllers\admin\LoansController')->getloanschedule(Carbon::now(),$loanproduct->graceperiodmodel->number_of_days,$loanproduct->loanpaymentfrequencymodel->number_of_days,$loanproduct->loanpaymentdurationmodel->number_of_days,$loansdata['data']->total_loan_amount);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Loans']])->get();
		$loansdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		$myapprovallevel=ProductApprovalConfigurations::where([['loan_product','=',$loansdata['data']->loan_product],['user_account','=',$user[0]->user_account]])->get();
		if(count($myapprovallevel)>0){
			$productapprovallevels=ProductApprovalConfigurations::where([['loan_product','=',$loan->loan_product]])->get();
			$approvallevels=ApprovalLevels::all();
			$loansdata['approvallevels']=$approvallevels;
			
			$k=0;
			$y=0;
			$loansdata['myapprovals']=array();
			$loansdata['otherapprovals']=array();
			for($r=0;$r<count($productapprovallevels);$r++){
				$mylevel=ApprovalLevels::find($myapprovallevel[0]->approval_level);
				if(($mylevel->approval_level-1)==0){
					$loansdata['myturn']=true;
				}
				if($productapprovallevels[$r]->user_account==$user[0]->user_account){
					$loansdata['myapprovals'][$k]['user_account']=$productapprovallevels[$r]->user_account;
					$loansdata['myapprovals'][$k]['approval_level']=$productapprovallevels[$r]->approval_level;

					$loanapproval=LoanApprovals::where([['approval_level','=',$productapprovallevels[$r]->approval_level],['loan','=',$loan->id]])->get();
					if(count($loanapproval)>0){
						$loansdata['myapprovals'][$k]['user']=$loanapproval[0]->user;
						$loansdata['myapprovals'][$k]['date']=$loanapproval[0]->date;
						$loansdata['myapprovals'][$k]['status']=$loanapproval[0]->status;
						$loansdata['myapprovals'][$k]['comments']=$loanapproval[0]->comment;
					}
					
					$k++;
				}else{
					
					$otherlevel=ApprovalLevels::find($productapprovallevels[$r]->approval_level);
					if($otherlevel->approval_level<$mylevel->approval_level){
						$loansdata['otherapprovals'][$y]['user_account']=$productapprovallevels[$r]->user_account;
						$loansdata['otherapprovals'][$y]['approval_level']=$productapprovallevels[$r]->approval_level;
						$loanapproval=LoanApprovals::where([['approval_level','=',$productapprovallevels[$r]->approval_level],['loan','=',$loan->id]])->get();
						if(count($loanapproval)>0){
							$loansdata['otherapprovals'][$y]['user']=$loanapproval[0]->user;
							$loansdata['otherapprovals'][$y]['date']=$loanapproval[0]->date;
							$loansdata['otherapprovals'][$y]['status']=$loanapproval[0]->status;
							$loansdata['otherapprovals'][$y]['comments']=$loanapproval[0]->comment;
						}
						
						
						if($otherlevel->approval_level==($mylevel->approval_level-1) ){
							if(isset($loansdata['otherapprovals'][$y]['status'])){
								$loansdata['myturn']=true;
							}else{
								$loansdata['myturn']=false;	
							}
							
						}else{
							$loansdata['myturn']=false;
						}
						$y++;
					}					

				}
			}

			
			$loansdata['today']=date('m/d/Y');
			$loansdata['usersaccounts']=UsersAccounts::all();
			$loansdata['users']=Users::all();
			$loansdata['user']=$user;
			$loansdata['approvalstatuses']=ApprovalStatuses::all();

			
			
			if($loansdata['usersaccountsroles'][0]['_show']==0){
				return view('admin.error.denied',compact('loansdata'));
			}else{
				return view('admin.approve_loans.index',compact('loansdata'));
			}

		}else{
			return view('admin.error.denied',compact('loansdata'));
		}
	}
	public function approveLoan(Request $request){
		$currentApprovalLevel=ApprovalLevels::find($request->get('approval_level'));
		$loanapprovals=new LoanApprovals();
		$loanapprovals->loan=$request->get('loan');
		$loanapprovals->approval_level=$request->get('approval_level');
		$loanapprovals->user_account=$request->get('user_account');
		$loanapprovals->user=$request->get('user');
		$loanapprovals->date=$request->get('date');
		$loanapprovals->status=$request->get('status');
		$loanapprovals->comment=$request->get('comment');
		$id=$request->get('loan');
		$loansdata['data']=Loans::find($id);
		$loan=$loansdata['data']::find($id);
		$loanapprovalstatus=ApprovalStatuses::find($loanapprovals->status);
		// die(json_encode($loanapprovalstatus));

		$loandisbursements=new LoanDisbursements();
		$loandisbursements->loan=$loan->id;
		$pendingdisbursement=DisbursementStatuses::where([['code','=','001']])->get();
		$loandisbursements->disbursement_status=$pendingdisbursement[0]['id'];
		$loansdata['paymentmodes']=PaymentModes::all();

		$loansdata['documents']=LoanDocuments::where([['loan','=',$id]])->orderBy('id','desc')->get();		
		$loansdata['guarantors']=LoanGuarantors::where([['loan','=',$id]])->orderBy('id','desc')->get();
		$loansdata['collaterals']=LoanCollaterals::where([['loan','=',$id]])->orderBy('id','desc')->get();
		$loansdata['loanproduct']=LoanProducts::find($loansdata['data']->loan_product);;
		$loansdata["processingfee"]=app('App\Http\Controllers\admin\LoansController')->getProcessingFee($loansdata['loanproduct']);
		$loanproduct=$loansdata['loanproduct'];
		$loansdata['loanschedule']=app('App\Http\Controllers\admin\LoansController')->getloanschedule(Carbon::now(),$loanproduct->graceperiodmodel->number_of_days,$loanproduct->loanpaymentfrequencymodel->number_of_days,$loanproduct->loanpaymentdurationmodel->number_of_days,$loansdata['data']->total_loan_amount);


		$loansdata['clearingfee']=app('App\Http\Controllers\admin\LoansController')->getClearingFee($loansdata['loanproduct']);

		$loansdata['insurancedeductionfee']=app('App\Http\Controllers\admin\LoansController')->getInsuranceDeductionFee($loansdata['loanproduct']);

		

		
		$loansdata['loanproducts']=LoanProducts::all();
		$loansdata['clients']=Clients::all();
		$loansdata['interestratetypes']=InterestRateTypes::all();
		$loansdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations']=LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies']=LoanPaymentFrequencies::all();
		$loansdata['graceperiods']=GracePeriods::all();
		$loansdata['disbursementmodes']=DisbursementModes::all();
		$loansdata['finetypes']=FineTypes::all();
		$loansdata['finechargefrequencies']=FineChargeFrequencies::all();
		$loansdata['finechargeperiods']=FineChargePeriods::all();
		$loansdata['loanstatuses']=LoanStatuses::all();
		$loansdata['myturn']=false;
		
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Loans']])->get();
		$loansdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		$myapprovallevel=ProductApprovalConfigurations::where([['loan_product','=',$loansdata['data']->loan_product],['user_account','=',$user[0]->user_account]])->get();

		if(count($myapprovallevel)>0){
			$productapprovallevels=ProductApprovalConfigurations::where([['loan_product','=',$loan->loan_product]])->get();
			$approvallevels=ApprovalLevels::all();
			$loansdata['approvallevels']=$approvallevels;

			$k=0;
			$y=0;
			$loansdata['myapprovals']=array();
			$loansdata['otherapprovals']=array();
			$mylevel=ApprovalLevels::find($myapprovallevel[0]->approval_level);
			$maxapprovallevel=0;
			for($r=0;$r<count($productapprovallevels);$r++){
				$maxapprovallevel=$productapprovallevels[$r]->approval_level>$maxapprovallevel?$productapprovallevels[$r]->approval_level:$maxapprovallevel;

			}
			if(count($productapprovallevels)==1){
				DB::transaction(function() use($loanapprovals,$loandisbursements,$loan,$loanapprovalstatus){
					try{
						$loandisbursements->save();
						if($loanapprovalstatus->code=="001"){
							$approvedloans=LoanStatuses::where([['code','=','002']])->get();
						}else if($loanapprovalstatus->code=="002"){
							$approvedloans=LoanStatuses::where([['code','=','003']])->get();
						}else if($loanapprovalstatus->code=="003"){
							$approvedloans=LoanStatuses::where([['code','=','004']])->get();
						}
						$loan->status=$approvedloans[0]->id;
						// die();
						$loan->save();

						$loanapprovals->save();

					}catch(Exception $e){


					}
				});
			}else{
				if($maxapprovallevel==$mylevel->approval_level){
					DB::transaction(function() use($loanapprovals,$loandisbursements,$loan,$loanapprovalstatus){
						try{
							$loandisbursements->save();
							if($loanapprovalstatus->code=="001"){
								$approvedloans=LoanStatuses::where([['code','=','002']])->get();
							}else if($loanapprovalstatus->code=="002"){
								$approvedloans=LoanStatuses::where([['code','=','003']])->get();
							}else if($loanapprovalstatus->code=="003"){
								$approvedloans=LoanStatuses::where([['code','=','004']])->get();
							}

							$loan->status=$approvedloans[0]->id;
							$loan->save();

							$loanapprovals->save();
						}catch(Exception $e){


						}
					});
				}else{
					DB::transaction(function() use($loanapprovals){
						try{
							$loanapprovals->save();
						}catch(Exception $e){


						}
					});

				}
			}

			for($r=0;$r<count($productapprovallevels);$r++){
				
				if(($mylevel->approval_level-1)==0){
					$loansdata['myturn']=true;
				}

				if($productapprovallevels[$r]->user_account==$user[0]->user_account){

					$loansdata['myapprovals'][$k]['user_account']=$productapprovallevels[$r]->user_account;
					$loansdata['myapprovals'][$k]['approval_level']=$productapprovallevels[$r]->approval_level;

					$loanapproval=LoanApprovals::where([['approval_level','=',$productapprovallevels[$r]->approval_level],['loan','=',$loan->id]])->get();
					
					if(count($loanapproval)>0){
						$loansdata['myapprovals'][$k]['user']=$loanapproval[0]->user;
						$loansdata['myapprovals'][$k]['date']=$loanapproval[0]->date;
						$loansdata['myapprovals'][$k]['status']=$loanapproval[0]->status;
						$loansdata['myapprovals'][$k]['comments']=$loanapproval[0]->comment;
					}
					
					$k++;
				}else{
					
					$otherlevel=ApprovalLevels::find($productapprovallevels[$r]->approval_level);
					if($otherlevel->approval_level<$mylevel->approval_level){
						$loansdata['otherapprovals'][$y]['user_account']=$productapprovallevels[$r]->user_account;
						$loansdata['otherapprovals'][$y]['approval_level']=$productapprovallevels[$r]->approval_level;
						$loanapproval=LoanApprovals::where([['approval_level','=',$productapprovallevels[$r]->approval_level],['loan','=',$loan->id]])->get();
						if(count($loanapproval)>0){
							$loansdata['otherapprovals'][$y]['user']=$loanapproval[0]->user;
							$loansdata['otherapprovals'][$y]['date']=$loanapproval[0]->date;
							$loansdata['otherapprovals'][$y]['status']=$loanapproval[0]->status;
							$loansdata['otherapprovals'][$y]['comments']=$loanapproval[0]->comment;
						}
						if($otherlevel->approval_level==($mylevel->approval_level-1) ){
							if(isset($loansdata['otherapprovals'][$y]['status'])){
								$loansdata['myturn']=true;
							}else{
								$loansdata['myturn']=false;	
							}
							
						}else{
							$loansdata['myturn']=false;
						}						
						$y++;


					}					

				}
			}

			$loansdata['data']=Loans::find($id);
			$loansdata['today']=date('m/d/Y');
			$loansdata['usersaccounts']=UsersAccounts::all();
			$loansdata['users']=Users::all();
			$loansdata['user']=$user;
			$loansdata['approvalstatuses']=ApprovalStatuses::all();

			
			
			if($loansdata['usersaccountsroles'][0]['_show']==0){
				return redirect('admin/loanapproval/'.$id);
			}else{
				return redirect('admin/loanapproval/'.$id);
			}

		}else{
			return redirect('admin/loanapproval/'.$id);
		}
		
	}
	
	public function update(Request $request,$id){
		$loans=Loans::find($id);
		$loansdata['loanproducts']=LoanProducts::all();
		$loansdata['clients']=Clients::all();
		$loansdata['interestratetypes']=InterestRateTypes::all();
		$loansdata['interestpaymentmethods']=InterestPaymentMethods::all();
		$loansdata['loanpaymentdurations']=LoanPaymentDurations::all();
		$loansdata['loanpaymentfrequencies']=LoanPaymentFrequencies::all();
		$loansdata['graceperiods']=GracePeriods::all();
		$loansdata['disbursementmodes']=DisbursementModes::all();
		$loansdata['finetypes']=FineTypes::all();
		$loansdata['finechargefrequencies']=FineChargeFrequencies::all();
		$loansdata['finechargeperiods']=FineChargePeriods::all();
		$loansdata['loanstatuses']=LoanStatuses::all();
		$loans->loan_number=$request->get('loan_number');
		$loans->loan_product=$request->get('loan_product');
		$loans->client=$request->get('client');
		$loans->date=$request->get('date');
		$loans->amount=$request->get('amount');
		$loans->interest_rate_type=$request->get('interest_rate_type');
		$loans->interest_rate=$request->get('interest_rate');
		$loans->interest_payment_method=$request->get('interest_payment_method');
		$loans->loan_payment_duration=$request->get('loan_payment_duration');
		$loans->loan_payment_frequency=$request->get('loan_payment_frequency');
		$loans->grace_period=$request->get('grace_period');
		$loans->interest_charged=$request->get('interest_charged');
		$loans->total_loan_amount=$request->get('total_loan_amount');
		$loans->amount_to_be_disbursed=$request->get('amount_to_be_disbursed');
		$loans->mode_of_disbursement=$request->get('mode_of_disbursement');
		$loans->clearing_fee=$request->get('clearing_fee');
		$loans->insurance_deduction_fee=$request->get('insurance_deduction_fee');
		$loans->fine_type=$request->get('fine_type');
		$loans->fine_charge=$request->get('fine_charge');
		$loans->fine_charge_frequency=$request->get('fine_charge_frequency');
		$loans->fine_charge_period=$request->get('fine_charge_period');
		$loans->initial_deposit=$request->get('initial_deposit');
		$loans->status=$request->get('status');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Loans']])->get();
		$loansdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loansdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('loansdata'));
		}else{
		$loans->save();
		$loansdata['data']=Loans::find($id);
		return view('admin.loans.edit',compact('loansdata','id'));
		}
	}

	public function destroy($id){
		$loans=Loans::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Loans']])->get();
		$loansdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($loansdata['usersaccountsroles'][0]['_delete']==1){
			$loans->delete();
		}return redirect('admin/loans')->with('success','loans has been deleted!');
	}
}