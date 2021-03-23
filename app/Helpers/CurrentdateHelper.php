<?php 
namespace App\Helpers;

use App\Models\Currentdate;


class CurrentdateHelper {
    public static function checkDate() {
        $currentdate = Currentdate::where('currentdate', date('Y-m-d'))->first();

        if ($currentdate == null) {
            $currentdate = new Currentdate;
            $currentdate->currentdate = date('Y-m-d');
            $currentdate->save();
        }

        return $currentdate;
    }


    public static function checkSecurityGroup() {
        $currentSecurityDate = date('Y-m-d');

        if(date("H:i") < '04:00') {
            $currentSecurityDate = date('Y-m-d', strtotime('-1 days'));
        }

        $currentSecurityDate = Currentdate::where('currentdate', $currentSecurityDate)->first();

        if ($currentSecurityDate == null) {
            $currentSecurityDate = new Currentdate;
            $currentSecurityDate->currentdate = date('Y-m-d');
            $currentSecurityDate->save();
        }

        $securityGroup = $currentSecurityDate->dategroup;

        return $securityGroup;
    }

    public static function securityWriter() {
        $currentSecurityDate = date('Y-m-d');

        if(date("H:i") < '04:00') {
            $currentSecurityDate = date('Y-m-d', strtotime('-1 days'));
        }

        $securityGroup = Currentdate::where('currentdate', $currentSecurityDate)->first()->dategroup;       
        $securityWriter = $securityGroup->security->where('category', 'writer')->first();

        return $securityWriter;
    }
}