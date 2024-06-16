<?php


namespace App\Helpers;
use Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserPermission as UserPermissionModel;


class UserPermission
{


    public static function checkpermission($user_id,$mod_id,$permission_name)
    {
    	if(DB::table('user_has_permission')
            ->where('user_id',$user_id)
            ->where('modules_id',$mod_id)
            ->where("$permission_name",'Yes')->first()){

                return true;
            }else{

                return false ;
            }
    }


    


}