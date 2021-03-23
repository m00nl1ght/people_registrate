<?php
use App\Models\Security;
use App\Models\Dategroup;
use App\Models\Currentdate;

function checkSecArr($arr, $el, $addDategroup) {
    $success = false;

    foreach ($arr as $data) {
        if($data->name == $el){
            $data->dategroup()->save($addDategroup);
            $success = true;
        }
    }

    if(!$success){
        $addSecurity = new Security;
        $addSecurity->name = $el;
        $addSecurity->save();
        $addSecurity->dategroup()->save($addDategroup);
    }

    return $success;
}


function checkSec($req) {
    $security = Security::all();
    $addDategroup = new Dategroup;

    $currentDate = Currentdate::where('currentdate', date('Y-m-d'))->first();

    if($currentDate == null){
        $currentDate = new Currentdate;
        $currentDate->currentdate = date('Y-m-d');
        $currentDate->save();
    }
    
    $currentDate->dategroup()->save($addDategroup);
   
    // $addDategroup->currentdate()->save($currentDate);

    if(!checkSecArr($security, $req->sec_main, $addDategroup)){
        $newMain = Security::where('name', $req->sec_main)->first();
        $newMain->category = 'main';
        $newMain->save();
    }
    if(!checkSecArr($security, $req->sec_writer, $addDategroup)){
        $newWriter = Security::where('name', $req->sec_writer)->first();
        $newWriter->category = 'writer';
        $newWriter->save();
    }
    if($req->sec_1 !== null){
        checkSecArr($security, $req->sec_1, $addDategroup);
    }
    if($req->sec_2 !== null){
        checkSecArr($security, $req->sec_2, $addDategroup);
    }
    if($req->sec_3 !== null){
        checkSecArr($security, $req->sec_3, $addDategroup);
    }
    if($req->sec_4 !== null){
        checkSecArr($security, $req->sec_4, $addDategroup);
    }
    
}

