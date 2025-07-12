<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (products)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Products;
use App\Companies;
use App\Modules;
use App\Users;
use App\ProductCategories;
use App\ProductBrands;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductsController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productsdata['productcategories']=ProductCategories::all();
		$productsdata['productbrands']=ProductBrands::all();
		$productsdata['list']=Products::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Products']])->get();
		$productsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productsdata['usersaccountsroles'][0]['_add']==0&&$productsdata['usersaccountsroles'][0]['_list']==0&&$productsdata['usersaccountsroles'][0]['_edit']==0&&$productsdata['usersaccountsroles'][0]['_edit']==0&&$productsdata['usersaccountsroles'][0]['_show']==0&&$productsdata['usersaccountsroles'][0]['_delete']==0&&$productsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productsdata'));
		}else{
			return view('admin.products.index',compact('productsdata'));
		}
	}

	public function create(){
		$productsdata;
		$productsdata['productcategories']=ProductCategories::all();
		$productsdata['productbrands']=ProductBrands::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Products']])->get();
		$productsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productsdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productsdata'));
		}else{
			return view('admin.products.create',compact('productsdata'));
		}
	}

	public function filter(Request $request){
		$productsdata['productcategories']=ProductCategories::all();
		$productsdata['productbrands']=ProductBrands::all();
		$productsdata['list']=Products::where([['name','LIKE','%'.$request->get('name').'%'],['category','LIKE','%'.$request->get('category').'%'],['brand','LIKE','%'.$request->get('brand').'%'],['description','LIKE','%'.$request->get('description').'%'],['reorder_level','LIKE','%'.$request->get('reorder_level').'%'],['reorder_quantity','LIKE','%'.$request->get('reorder_quantity').'%'],['other_details','LIKE','%'.$request->get('other_details').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Products']])->get();
		$productsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productsdata['usersaccountsroles'][0]['_add']==0&&$productsdata['usersaccountsroles'][0]['_list']==0&&$productsdata['usersaccountsroles'][0]['_edit']==0&&$productsdata['usersaccountsroles'][0]['_edit']==0&&$productsdata['usersaccountsroles'][0]['_show']==0&&$productsdata['usersaccountsroles'][0]['_delete']==0&&$productsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productsdata'));
		}else{
			return view('admin.products.index',compact('productsdata'));
		}
	}

	public function report(){
		$productsdata['company']=Companies::all();
		$productsdata['list']=Products::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Products']])->get();
		$productsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productsdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productsdata'));
		}else{
			return view('admin.products.report',compact('productsdata'));
		}
	}

	public function chart(){
		return view('admin.products.chart');
	}

	public function store(Request $request){
		$products=new Products();
		$products->product_number=$request->get('product_number');
		$products->name=$request->get('name');
		$products->category=$request->get('category');
		$products->brand=$request->get('brand');
		$products->description=$request->get('description');
		$products->reorder_level=$request->get('reorder_level');
		$products->reorder_quantity=$request->get('reorder_quantity');
		$products->buying_price=$request->get('buying_price');
		$products->selling_price=$request->get('selling_price');
		$products->margin=$request->get('margin');
		$products->other_details=$request->get('other_details');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Products']])->get();
		$productsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productsdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($products->save()){
					$response['status']='1';
					$response['message']='products Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add products. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add products. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productsdata['productcategories']=ProductCategories::all();
		$productsdata['productbrands']=ProductBrands::all();
		$productsdata['data']=Products::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Products']])->get();
		$productsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productsdata'));
		}else{
		return view('admin.products.edit',compact('productsdata','id'));
		}
	}

	public function show($id){
		$productsdata['productcategories']=ProductCategories::all();
		$productsdata['productbrands']=ProductBrands::all();
		$productsdata['data']=Products::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Products']])->get();
		$productsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productsdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productsdata'));
		}else{
		return view('admin.products.show',compact('productsdata','id'));
		}
	}

	public function getproduct($id){

		$productsdata=Products::find($id);

		return $productsdata;
		
	}	

	public function getproductnumber(){

		return (Products::All()->count()+1);
		
	}		

	public function update(Request $request,$id){
		$products=Products::find($id);
		$productsdata['productcategories']=ProductCategories::all();
		$productsdata['productbrands']=ProductBrands::all();
		$products->product_number=$request->get('product_number');
		$products->name=$request->get('name');
		$products->category=$request->get('category');
		$products->brand=$request->get('brand');
		$products->description=$request->get('description');
		$products->reorder_level=$request->get('reorder_level');
		$products->buying_price=$request->get('buying_price');
		$products->selling_price=$request->get('selling_price');
		$products->margin=$request->get('margin');
		$products->reorder_quantity=$request->get('reorder_quantity');
		$products->other_details=$request->get('other_details');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Products']])->get();
		$productsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productsdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productsdata'));
		}else{
		$products->save();
		$productsdata['data']=Products::find($id);
		return view('admin.products.edit',compact('productsdata','id'));
		}
	}

	public function destroy($id){
		$products=Products::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','Products']])->get();
		$productsdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productsdata['usersaccountsroles'][0]['_delete']==1){
			$products->delete();
		}return redirect('admin/products')->with('success','products has been deleted!');
	}
}