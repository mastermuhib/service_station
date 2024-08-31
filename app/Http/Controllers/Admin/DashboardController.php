<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\Product;
use App\Models\ImageProduct;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Redirect;
use Illuminate\Support\Facades\Hash;

// use App\Model\RoleModel;
// use App\MenuModel;


class DashboardController extends Controller
{     

    public function index()
    {
        $data['position_menu'] = "Dashboard";
        $data['header_title'] = "Dashboard";
        $data['this_month'] = date('m');
            
        return view('dashboard',$data);
    }

    public function get_dashboard(Request $request){
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;

        return view('admin.dashboard.'.$request->id,$data);
    }
}