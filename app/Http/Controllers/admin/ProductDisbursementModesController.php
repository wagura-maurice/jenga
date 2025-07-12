<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (manages product disbursement modes)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductDisbursementModes;
use App\Companies;
use App\Modules;
use App\Users;
use App\LoanProducts;
use App\DisbursementModes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductDisbursementModesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productdisbursementmodesdata['loanproducts']=LoanProducts::all();
		$productdisbursementmodesdata['disbursementmodes']=DisbursementModes::all();
		$productdisbursementmodesdata['list']=ProductDisbursementModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementModes']])->get();
		$productdisbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementmodesdata['usersaccountsroles'][0]['_add']==0&&$productdisbursementmodesdata['usersaccountsroles'][0]['_list']==0&&$productdisbursementmodesdata['usersaccountsroles'][0]['_edit']==0&&$productdisbursementmodesdata['usersaccountsroles'][0]['_edit']==0&&$productdisbursementmodesdata['usersaccountsroles'][0]['_show']==0&&$productdisbursementmodesdata['usersaccountsroles'][0]['_delete']==0&&$productdisbursementmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productdisbursementmodesdata'));
		}else{
			return view('admin.product_disbursement_modes.index',compact('productdisbursementmodesdata'));
		}
	}

	public function create(){
		$productdisbursementmodesdata;
		$productdisbursementmodesdata['loanproducts']=LoanProducts::all();
		$productdisbursementmodesdata['disbursementmodes']=DisbursementModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementModes']])->get();
		$productdisbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementmodesdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productdisbursementmodesdata'));
		}else{
			return view('admin.product_disbursement_modes.create',compact('productdisbursementmodesdata'));
		}
	}

	public function filter(Request $request){
		$productdisbursementmodesdata['loanproducts']=LoanProducts::all();
		$productdisbursementmodesdata['disbursementmodes']=DisbursementModes::all();
		$productdisbursementmodesdata['list']=ProductDisbursementModes::where([['loan_product','LIKE','%'.$request->get('loan_product').'%'],['disbursement_mode','LIKE','%'.$request->get('disbursement_mode').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementModes']])->get();
		$productdisbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementmodesdata['usersaccountsroles'][0]['_add']==0&&$productdisbursementmodesdata['usersaccountsroles'][0]['_list']==0&&$productdisbursementmodesdata['usersaccountsroles'][0]['_edit']==0&&$productdisbursementmodesdata['usersaccountsroles'][0]['_edit']==0&&$productdisbursementmodesdata['usersaccountsroles'][0]['_show']==0&&$productdisbursementmodesdata['usersaccountsroles'][0]['_delete']==0&&$productdisbursementmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productdisbursementmodesdata'));
		}else{
			return view('admin.product_disbursement_modes.index',compact('productdisbursementmodesdata'));
		}
	}

	public function getproductdisbursementmode($productId){
		$productdisbursementmode=ProductDisbursementModes::where([['loan_product','=',$productId]])->orderBy('id','desc')->get();
		return $productdisbursementmode;
	}

	public function report(){
		$productdisbursementmodesdata['company']=Companies::all();
		$productdisbursementmodesdata['list']=ProductDisbursementModes::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementModes']])->get();
		$productdisbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementmodesdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productdisbursementmodesdata'));
		}else{
			return view('admin.product_disbursement_modes.report',compact('productdisbursementmodesdata'));
		}
	}

	public function chart(){
		return view('admin.product_disbursement_modes.chart');
	}

	public function store(Request $request){
		$productdisbursementmodes=new ProductDisbursementModes();
		$productdisbursementmodes->loan_product=$request->get('loan_product');
		$productdisbursementmodes->disbursement_mode=$request->get('disbursement_mode');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementModes']])->get();
		$productdisbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementmodesdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productdisbursementmodes->save()){
					$response['status']='1';
					$response['message']='product disbursement modes Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product disbursement modes. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product disbursement modes. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productdisbursementmodesdata['loanproducts']=LoanProducts::all();
		$productdisbursementmodesdata['disbursementmodes']=DisbursementModes::all();
		$productdisbursementmodesdata['data']=ProductDisbursementModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementModes']])->get();
		$productdisbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementmodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productdisbursementmodesdata'));
		}else{
		return view('admin.product_disbursement_modes.edit',compact('productdisbursementmodesdata','id'));
		}
	}

	public function show($id){
		$productdisbursementmodesdata['loanproducts']=LoanProducts::all();
		$productdisbursementmodesdata['disbursementmodes']=DisbursementModes::all();
		$productdisbursementmodesdata['data']=ProductDisbursementModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementModes']])->get();
		$productdisbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementmodesdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productdisbursementmodesdata'));
		}else{
		return view('admin.product_disbursement_modes.show',compact('productdisbursementmodesdata','id'));
		}
	}

	public function update(Request $request,$id){
		$productdisbursementmodes=ProductDisbursementModes::find($id);
		$productdisbursementmodesdata['loanproducts']=LoanProducts::all();
		$productdisbursementmodesdata['disbursementmodes']=DisbursementModes::all();
		$productdisbursementmodes->loan_product=$request->get('loan_product');
		$productdisbursementmodes->disbursement_mode=$request->get('disbursement_mode');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementModes']])->get();
		$productdisbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementmodesdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productdisbursementmodesdata'));
		}else{
		$productdisbursementmodes->save();
		$productdisbursementmodesdata['data']=ProductDisbursementModes::find($id);
		return view('admin.product_disbursement_modes.edit',compact('productdisbursementmodesdata','id'));
		}
	}

	public function destroy($id){
		$productdisbursementmodes=ProductDisbursementModes::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductDisbursementModes']])->get();
		$productdisbursementmodesdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productdisbursementmodesdata['usersaccountsroles'][0]['_delete']==1){
			$productdisbursementmodes->delete();
		}return redirect('admin/productdisbursementmodes')->with('success','product disbursement modes has been deleted!');
	}
}