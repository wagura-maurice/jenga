<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ClientLgfBalances;
use App\Clients;
use App\Loans;
use App\LoanPayments;
use App\Groups;
use App\GroupClients;
use App\LoanProducts;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dashboarddata['lgfbalance']=ClientLGfBalances::sum('balance');
        $dashboarddata['clientscount']=Clients::count();
        $dashboarddata['totalloanbalance']=Loans::sum('amount')-LoanPayments::sum('amount');
        $dashboarddata['groups']=Groups::take(10)->offset(0)->get();
        
        $colors=array("red","orange","green","aqua","blue","purple","grey","dark","cyan","violet");
        $colors1=array("blue","purple","grey","dark","cyan","violet","red","orange","green","aqua");
        
        for($r=0;$r<count($dashboarddata['groups']);$r++){

            if($r<5){
                $dashboarddata['groupclients']=GroupClients::where([['client_group','=',$dashboarddata['groups'][$r]->id]])->get();
                $dashboarddata['groupcontribution'][$r]['group']=$dashboarddata['groups'][$r]->group_name;
                
                $balance=0;
                for($c=0;$c<count($dashboarddata['groupclients']);$c++){
                    $balance+=ClientLgfBalances::where([['client','=',$dashboarddata['groupclients'][$c]->client]])->sum('balance');
                }
                $dashboarddata['groupcontribution'][$r]['amount']=$balance;
                $dashboarddata['groupcontribution'][$r]['color']=$colors[$r];
            }


        }
        for($r=0;$r<count($dashboarddata['groups']);$r++){
            $dashboarddata['groupclients']=GroupClients::where([['client_group','=',$dashboarddata['groups'][$r]->id]])->get();
            $dashboarddata['grouploans'][$r]['group']=$dashboarddata['groups'][$r]->group_name;
            
            $amount=0;
            $paid=0;
            $balance=0;
            for($c=0;$c<count($dashboarddata['groupclients']);$c++){
                $amount+=Loans::where([['client','=',$dashboarddata['groupclients'][$c]->client]])->sum('total_loan_amount');
                $loans=Loans::where([['client','=',$dashboarddata['groupclients'][$c]->client]])->get();
                for($k=0;$k<count($loans);$k++){
                    $paid+=LoanPayments::where([['loan','=',$loans[$k]->id]])->sum('amount');
                }
                $balance=$amount-$paid;
            }
            $dashboarddata['grouploans'][$r]['amount']=$balance;
            $dashboarddata['grouploans'][$r]['color']=$colors[9-$r];

        }    
        $loanproudcts=LoanProducts::take(5)->offset(0)->get();
        $amount=0;
        for($r=0;$r<count($loanproudcts);$r++){
            $dashboarddata['productloans'][$r]['product']=$loanproudcts[$r]->name;
            $loans=Loans::where([['loan_product','=',$loanproudcts[$r]->id]])->get();
            $amount+=Loans::where([['loan_product','=',$loanproudcts[$r]->id]])->sum('total_loan_amount');
            $balance=0;
            $paid=0;
            for($c=0;$c<count($loans);$c++){
                $paid+=LoanPayments::where([['loan','=',$loans[$c]->id]])->sum('amount');
            }
            $balance=$amount-$paid;
            $dashboarddata['productloans'][$r]['amount']=$balance;
            $dashboarddata['productloans'][$r]['color']=$colors1[$r];

        }    
        return view('admin.dashboard',compact('dashboarddata'));
        
    }

    public function dashboard()
    {
        return redirect()->route('home');
    }
}
