<?php

namespace App\Http\Controllers\Admin;

use App\Model\LogAdmin;
use App\Model\LogError;
use App\Model\LogVacancyModel;
use App\Model\LogApproval;
use App\Traits\Fungsi;
use App\CompanyVerifikasi;
use Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB;
use URL;
use DateTime;
use Illuminate\Routing\Controller as BaseController;
use Redirect;
use SendGrid\Mail\Mail;
use App\Classes\S3;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sidebar()
    {
        $currentURL = url()->current();
        $arrayURL = explode("/",$currentURL);
        $jumlah = count($arrayURL);
        
        return $data;
    }
      
}
