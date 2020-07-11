<?php namespace App\Libraries;

use App\Models\Categories;
use DB;
use Auth;
use Carbon\Carbon;

class Permissions
{

    public function activeData()
    {
        $catagories=Categories::where('is_active',1)->get();
        return $catagories;
    }
}