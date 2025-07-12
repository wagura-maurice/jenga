<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Companies;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class CompaniesController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		$companiesdata['list']=Companies::all();
		return view('admin.companies.index',compact('companiesdata'));
	}

	public function create(){
		$companiesdata;
		return view('admin.companies.create',compact('companiesdata'));
	}

	public function filter(Request $request){
		$companiesdata['list']=Companies::where([['name','LIKE','%'.$request->get('name').'%'],['phone_number','LIKE','%'.$request->get('phone_number').'%'],['email_address','LIKE','%'.$request->get('email_address').'%'],['street','LIKE','%'.$request->get('street').'%'],['address','LIKE','%'.$request->get('address').'%'],['city','LIKE','%'.$request->get('city').'%'],['zip_code','LIKE','%'.$request->get('zip_code').'%'],['website','LIKE','%'.$request->get('website').'%'],])->get();
		return view('admin.companies.index',compact('companiesdata'));
	}

	public function report(){
		$companiesdata['company']=Companies::all();
		$companiesdata['list']=Companies::all();
		return view('admin.companies.report',compact('companiesdata'));
	}

	public function chart(){
		return view('admin.companies.chart');
	}

	public function store(Request $request){
		$companies=new Companies();
		$companies->logo=time() . '_' . rand(1000, 9999) . '.jpg';
		$companies->name=$request->get('name');
		$companies->phone_number=$request->get('phone_number');
		$companies->email_address=$request->get('email_address');
		$companies->street=$request->get('street');
		$companies->address=$request->get('address');
		$companies->city=$request->get('city');
		$companies->zip_code=$request->get('zip_code');
		$companies->website=$request->get('website');
		$response=array();
		try{
			if($companies->save()){
		$LogoImage = $request->file('logo');
		$LogoImage->move('uploads/images',$companies->logo);
				$response['status']='1';
				$response['message']='companies Added successfully';
				return json_encode($response);
		}else{
				$response['status']='0';
				$response['message']='Failed to add admin.companies. Please try again';
				return json_encode($response);
		}
		}
		catch(Exception $e){
				$response['status']='0';
				$response['message']='An Error occured while attempting to add admin.companies. Please try again';
				return json_encode($response);
		}
		return json_encode($response);
	}

	public function edit($id){
		$companiesdata['data']=Companies::find($id);
		return view('admin.companies.edit',compact('companiesdata','id'));
	}

	public function show($id){
		$companiesdata['data']=Companies::find($id);
		return view('admin.companies.show',compact('companiesdata','id'));
	}

	public function update(Request $request,$id){
		$companies=Companies::find($id);
		$companies->logo=time() . '_' . rand(1000, 9999) . '.jpg';
		$companies->name=$request->get('name');
		$companies->phone_number=$request->get('phone_number');
		$companies->email_address=$request->get('email_address');
		$companies->street=$request->get('street');
		$companies->address=$request->get('address');
		$companies->city=$request->get('city');
		$companies->zip_code=$request->get('zip_code');
		$companies->website=$request->get('website');

		$companies->save();
		
		return redirect('companies');
	}

	public function destroy($id){
		$companies=Companies::find($id);
		$companies->delete();return redirect('admin/companies')->with('success','companies has been deleted!');
	}
}