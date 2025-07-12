<?php
namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ApprovalLevels;
use App\Companies;
use App\Modules;
use App\Users;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UsersAccountsRoles;
class WithdrawalsMenuController extends Controller
{

	public function __construct(){
		$this->middleware('auth');
	}
	public function index(){
		
		return view('admin.menu.withdrawals_menu');	
		
	}


}