<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

use App\Mail\ReportSecurityMail;

use App\Models\Currentdate;
use App\Models\Dategroup;
use App\Models\Incident;
use App\Models\Fault;
use App\Models\Incomevisitor;
use App\Models\Incomecar;
use App\Models\Security;

class FeedbackController extends Controller {

    public function send() {
        $reportData = [];

        $reportDay = date('Y-m-d');

        if(date("H:i") < '04:00') {
            $reportDay = date('Y-m-d', strtotime('-1 days'));
        }

        $reportDayTomorrow = date("Y-m-d", strtotime($reportDay.'+ 1 days'));

        $currentdate = Currentdate::where('currentdate', $reportDay)->first();
        $currentdateTomorrow = Currentdate::where('currentdate', $reportDayTomorrow)->first();

        $securityGuys = $currentdate->dategroup->security;

        $faults = Fault::where('out_date', '=',  null)->get();

        $incidents = Incident::where('currentdate_id', '=',  $currentdate->id)
            ->where('in_time', '>=', '04:00:00')
            ->orWhere(function($query) use ($currentdateTomorrow) {
               if($currentdateTomorrow !== null) {
                $query->where('currentdate_id', '=',  $currentdateTomorrow->id)
                ->where('in_time', '<=', '04:00:00');
               } 
            })
            ->get();

        $visitors = IncomeVisitor::where('currentdate_id', '=',  $currentdate->id)
            ->where('in_time', '>=', '04:00:00')
            ->orWhere(function($query) use ($currentdateTomorrow) {
                if($currentdateTomorrow !== null) {
                    $query->where('currentdate_id', '=',  $currentdateTomorrow->id)
                    ->where('in_time', '<=', '04:00:00');
                }
            })
            ->get();

        $foggotenPass = $currentdate->incomecard;

        $countPeopleArr = [];
        $countPeopleArr['Всего'] = $visitors->count();
        
        foreach($visitors as $arr) {
            $key = $arr->visitor->category->description;
         
            if(isset($countPeopleArr[$key])) {
                $countPeopleArr[$arr->visitor->category->description]++;
            } else {
                $countPeopleArr[$arr->visitor->category->description] = 1;
            }
        }

        $cars = IncomeCar::where('currentdate_id', '=',  $currentdate->id)
        ->where('in_time', '>=', '04:00:00')
        ->orWhere(function($query) use ($currentdateTomorrow) {
            if($currentdateTomorrow !== null) {
                $query->where('currentdate_id', '=',  $currentdateTomorrow->id)
                ->where('in_time', '<=', '04:00:00');
            }
        })
        ->get();

        $countCarArr = [];
        $countCarArr['Всего'] = $cars->count();

        foreach($cars as $arr) {
            $key = $arr->visitor->category->description;
         
            if(isset($countCarArr[$key])) {
                $countCarArr[$arr->visitor->category->description]++;
            } else {
                $countCarArr[$arr->visitor->category->description] = 1;
            }
        }

        // $reportData['url'] = route('security-report') . '/' .  $reportDay; 
        // $reportData['reportDay'] = Carbon::createFromFormat('Y-m-d', $reportDay)->format('d/m');
        // $reportData['reportDayTomorrow'] = Carbon::createFromFormat('Y-m-d', $reportDayTomorrow)->format('d/m/Y');
        // $reportData['securityGuys'] = $securityGuys;
        // $reportData['faults'] = $faults;
        // $reportData['incidents'] = $incidents;
        // $reportData['countPeopleArr'] = $countPeopleArr;
        // $reportData['countCarArr'] = $countCarArr;

        $toEmail = explode(',', env('MAIL_REPORT_RECIVERS'));

        Mail::to($toEmail)->send(new ReportSecurityMail([
            'faults' => $faults,
            'incidents' => $incidents,
            'countPeopleArr' => $countPeopleArr,
            'countCarArr' => $countCarArr,
            'securityGuys' => $securityGuys,
            'url' => route('security-report') . '/' .  $reportDay,
            'reportDay' => Carbon::createFromFormat('Y-m-d', $reportDay)->format('d/m'),
            'reportDayTomorrow' => Carbon::createFromFormat('Y-m-d', $reportDayTomorrow)->format('d/m/Y'),
            'foggotenPass' => $foggotenPass
            ]));

        return redirect()->route('security-edit')->with('success', 'Отчет отправлен');
    }
}