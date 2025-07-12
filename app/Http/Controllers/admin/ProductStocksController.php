<?php
/**
* @author  Wanjala Innocent Khaemba
*Controller - (product stocks)
*/
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ProductStocks;
use App\Companies;
use App\Modules;
use App\Users;
use App\Products;
use App\Stores;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class ProductStocksController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$productstocksdata['products']=Products::all();
		$productstocksdata['stores']=Stores::all();
		$productstocksdata['list']=ProductStocks::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductStocks']])->get();
		$productstocksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productstocksdata['usersaccountsroles'][0]['_add']==0&&$productstocksdata['usersaccountsroles'][0]['_list']==0&&$productstocksdata['usersaccountsroles'][0]['_edit']==0&&$productstocksdata['usersaccountsroles'][0]['_edit']==0&&$productstocksdata['usersaccountsroles'][0]['_show']==0&&$productstocksdata['usersaccountsroles'][0]['_delete']==0&&$productstocksdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productstocksdata'));
		}else{
			return view('admin.product_stocks.index',compact('productstocksdata'));
		}
	}

	public function create(){
		$productstocksdata;
		$productstocksdata['products']=Products::all();
		$productstocksdata['stores']=Stores::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductStocks']])->get();
		$productstocksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productstocksdata['usersaccountsroles'][0]['_add']==0){
			return view('admin.error.denied',compact('productstocksdata'));
		}else{
			return view('admin.product_stocks.create',compact('productstocksdata'));
		}
	}

	public function filter(Request $request){
		$productstocksdata['products']=Products::all();
		$productstocksdata['stores']=Stores::all();
		$productstocksdata['list']=ProductStocks::where([['product','LIKE','%'.$request->get('product').'%'],['store','LIKE','%'.$request->get('store').'%'],['size','LIKE','%'.$request->get('size').'%'],])->get();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductStocks']])->get();
		$productstocksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productstocksdata['usersaccountsroles'][0]['_add']==0&&$productstocksdata['usersaccountsroles'][0]['_list']==0&&$productstocksdata['usersaccountsroles'][0]['_edit']==0&&$productstocksdata['usersaccountsroles'][0]['_edit']==0&&$productstocksdata['usersaccountsroles'][0]['_show']==0&&$productstocksdata['usersaccountsroles'][0]['_delete']==0&&$productstocksdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productstocksdata'));
		}else{
			return view('admin.product_stocks.index',compact('productstocksdata'));
		}
	}

	public function report(){
		$productstocksdata['company']=Companies::all();
		$productstocksdata['list']=ProductStocks::all();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductStocks']])->get();
		$productstocksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productstocksdata['usersaccountsroles'][0]['_report']==0){
			return view('admin.error.denied',compact('productstocksdata'));
		}else{
			return view('admin.product_stocks.report',compact('productstocksdata'));
		}
	}

	public function chart(){
		return view('admin.product_stocks.chart');
	}

	public function store(Request $request){
		$productstocks=new ProductStocks();
		$productstocks->product=$request->get('product');
		$productstocks->store=$request->get('store');
		$productstocks->size=$request->get('size');
		$response=array();
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductStocks']])->get();
		$productstocksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productstocksdata['usersaccountsroles'][0]['_show']==1){
			try{
				if($productstocks->save()){
					$response['status']='1';
					$response['message']='product stocks Added successfully';
					return json_encode($response);
			}else{
					$response['status']='0';
					$response['message']='Failed to add product stocks. Please try again';
					return json_encode($response);
				}
			}
			catch(Exception $e){
					$response['status']='0';
					$response['message']='An Error occured while attempting to add product stocks. Please try again';
					return json_encode($response);
			}
		}else{
			$response['status']='0';
			$response['message']='Access Denied!';
			return json_encode($response);
		}
	}

	public function edit($id){
		$productstocksdata['products']=Products::all();
		$productstocksdata['stores']=Stores::all();
		$productstocksdata['data']=ProductStocks::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductStocks']])->get();
		$productstocksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productstocksdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productstocksdata'));
		}else{
		return view('admin.product_stocks.edit',compact('productstocksdata','id'));
		}
	}

	public function show($id){
		$productstocksdata['products']=Products::all();
		$productstocksdata['stores']=Stores::all();
		$productstocksdata['data']=ProductStocks::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductStocks']])->get();
		$productstocksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productstocksdata['usersaccountsroles'][0]['_show']==0){
			return view('admin.error.denied',compact('productstocksdata'));
		}else{
		return view('admin.product_stocks.show',compact('productstocksdata','id'));
		}
	}

	public function getstockbystoreid($id){

		$stocks=ProductStocks::where([["store","=",$id]])->get();

		for($r=0;$r<count($stocks); $r++){
			$product=Products::find($stocks[$r]->product);
			$stocks[$r]->productdata=$product;
		}

		return $stocks;
	}	

	public function getstockbyproductidandstoreid($productid,$stockid){

		$stocks=ProductStocks::where([["product","=",$productid],["store","=",$stockid]])->get()->first();

		return $stocks;
	}		

	public function update(Request $request,$id){
		$productstocks=ProductStocks::find($id);
		$productstocksdata['products']=Products::all();
		$productstocksdata['stores']=Stores::all();
		$productstocks->product=$request->get('product');
		$productstocks->store=$request->get('store');
		$productstocks->size=$request->get('size');
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductStocks']])->get();
		$productstocksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productstocksdata['usersaccountsroles'][0]['_edit']==0){
			return view('admin.error.denied',compact('productstocksdata'));
		}else{
		$productstocks->save();
		$productstocksdata['data']=ProductStocks::find($id);
		return view('admin.product_stocks.edit',compact('productstocksdata','id'));
		}
	}

	public function destroy($id){
		$productstocks=ProductStocks::find($id);
		$user=Users::where([['id','=',Auth::id()]])->get();
		$module=Modules::where([['name','=','ProductStocks']])->get();
		$productstocksdata['usersaccountsroles']=UsersAccountsRoles::where([['user_account','=',$user[0]['user_account']],['module','=',$module[0]['id']]])->get();
		if($productstocksdata['usersaccountsroles'][0]['_delete']==1){
			$productstocks->delete();
		}return redirect('admin/productstocks')->with('success','product stocks has been deleted!');
	}
}