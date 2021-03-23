<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

use App\Models\Currentdate;
use App\Models\Dategroup;
use App\Models\Incident;
use App\Models\Fault;
use App\Models\Incomevisitor;
use App\Models\Incomecar;
use App\Models\Security;

use App\Helpers\CurrentdateHelper;

class SecurityController extends Controller {
    private function checkSecArr($arr, $el, $addDategroup) {
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
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $securityGroup = CurrentdateHelper::checkSecurityGroup();

        if ($securityGroup !== null) {
            return redirect()->route('security-edit')->with('success', 'Смена уже была зарегистрированна');
        }

        return view('security')->with('page', 'create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'sec_main' => 'required',
            'sec_writer' => 'required'
        ]); 

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        };

        $security = Security::all();
        $addDategroup = new Dategroup;
    
        $currentDate = Currentdate::where('currentdate', date('Y-m-d'))->first();
    
        if($currentDate == null){
            $currentDate = new Currentdate;
            $currentDate->currentdate = date('Y-m-d');
            $currentDate->save();
        }
        
        $currentDate->dategroup()->save($addDategroup);
    
        if(!$this->checkSecArr($security, $request->sec_main, $addDategroup)){
            $newMain = Security::where('name', $request->sec_main)->first();
            $newMain->category = 'main';
            $newMain->save();
        }
        if(!$this->checkSecArr($security, $request->sec_writer, $addDategroup)){
            $newWriter = Security::where('name', $request->sec_writer)->first();
            $newWriter->category = 'writer';
            $newWriter->save();
        }
        if($request->sec_1 !== null){
            $this->checkSecArr($security, $request->sec_1, $addDategroup);
        }
        if($request->sec_2 !== null){
            $this->checkSecArr($security, $request->sec_2, $addDategroup);
        }
        if($request->sec_3 !== null){
            $this->checkSecArr($security, $request->sec_3, $addDategroup);
        }
        if($request->sec_4 !== null){
            $this->checkSecArr($security, $request->sec_4, $addDategroup);
        }

        return redirect()->route('security-edit')->with('success', 'Смена добавлена');
    }

         /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        $securityGroup = CurrentdateHelper::checkSecurityGroup();

        if($securityGroup == null) {
            return redirect()->route('security-new')->with('warning_message', 'Сначала зарегистрируйте смену');
        }

        $securityGuys = $securityGroup->security;

        return view('security', compact('securityGuys'))->with('page', 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }


     public function report($date) { 
        $reportDay = $date;
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

        $foggotenPass = $currentdate->incomecard;
        // $foggotenPass = $foggotenPass->each(function($item) {
        //     return $item->employee;
        // });


        $reportDay = Carbon::createFromFormat('Y-m-d', $reportDay)->format('d/m');
        $reportDayTomorrow =  Carbon::createFromFormat('Y-m-d', $reportDayTomorrow)->format('d/m/Y');

        return view('/reports/mainReport', compact([
            'securityGuys',
            'faults',
            'incidents',
            'countPeopleArr',
            'countCarArr',
            'reportDay',
            'reportDayTomorrow',
            'foggotenPass'
        ]));
     }

     public function report_default() {
        $reportDay = date('Y-m-d');

        if(date("H:i") < '04:00') {
            $reportDay = date('Y-m-d', strtotime('-1 days'));
        }

        $currentdate = Currentdate::where('currentdate', $reportDay)->first();

        if($currentdate == null) {
            return redirect()->route('security-new')->with('warning_message', 'Сначала зарегистрируйте смену');
        }

        return redirect()->route('security-report-show', ['id' => $reportDay]);
     }

     public function report_post(Request $request) {
        if($request->has('reportDate')) {
            $reportDay = $request->reportDate;
        } else {
            $reportDay = date('Y-m-d');

            if(date("H:i") < '04:00') {
                $reportDay = date('Y-m-d', strtotime('-1 days'));
            }
        }

        $currentdate = Currentdate::where('currentdate', $reportDay)->first();

        if($currentdate == null) {
            $reportDay = date('Y-m-d');
            return redirect()->route('security-report-show', ['id' => $reportDay])->with('warning_message', 'За данный день отчета нет!');
        }

        return redirect()->route('security-report-show', ['id' => $reportDay]);
     }

    /**
     * Check into database security memmbers
     *    
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
     public function autoinsert(Request $request) {

        if($request->key == "id") {
            $resp =  Security::with('firm')
            ->where('id', '=', $request->data)
            ->first();
        } elseif($request->key == "name") {
            $resp =  Security::where('name', 'LIKE', $request->data . '%')->get();
        } 

        return $resp;
    }
}


// public function report(Request $request) {
//     if($request->has('reportDate')) {
//         $reportDay = $request->reportDate;
//     } else {
//         $reportDay = date('Y-m-d');

//         if(date("H:i") < '04:00') {
//             $reportDay = date('Y-m-d', strtotime('-1 days'));
//         }
//     }
     
//     $reportDayTomorrow = date("Y-m-d", strtotime($reportDay.'+ 1 days'));
//     $currentdate = Currentdate::where('currentdate', $reportDay)->first();

//     if($currentdate == null) {
//         return redirect()->route('security-new')->with('warning_message', 'Сначала зарегистрируйте смену');
//     }

//     $currentdateTomorrow = Currentdate::where('currentdate', $reportDayTomorrow)->first();

//     $securityGuys = $currentdate->dategroup->security;
//     $faults = Fault::where('out_date', '=',  null)->get();

//     $incidents = Incident::where('currentdate_id', '=',  $currentdate->id)
//         ->where('in_time', '>=', '04:00:00')
//         ->orWhere(function($query) use ($currentdateTomorrow) {
//            if($currentdateTomorrow !== null) {
//             $query->where('currentdate_id', '=',  $currentdateTomorrow->id)
//             ->where('in_time', '<=', '04:00:00');
//            } 
//         })
//         ->get();

//     $visitors = IncomeVisitor::where('currentdate_id', '=',  $currentdate->id)
//         ->where('in_time', '>=', '04:00:00')
//         ->orWhere(function($query) use ($currentdateTomorrow) {
//             if($currentdateTomorrow !== null) {
//                 $query->where('currentdate_id', '=',  $currentdateTomorrow->id)
//                 ->where('in_time', '<=', '04:00:00');
//             }
//         })
//         ->get();

//     $countPeopleArr = [];
//     $countPeopleArr['Всего'] = $visitors->count();
    
//     foreach($visitors as $arr) {
//         $key = $arr->visitor->category->description;
     
//         if(isset($countPeopleArr[$key])) {
//             $countPeopleArr[$arr->visitor->category->description]++;
//         } else {
//             $countPeopleArr[$arr->visitor->category->description] = 1;
//         }
//     }

//     $cars = IncomeCar::where('currentdate_id', '=',  $currentdate->id)
//     ->where('in_time', '>=', '04:00:00')
//     ->orWhere(function($query) use ($currentdateTomorrow) {
//         if($currentdateTomorrow !== null) {
//             $query->where('currentdate_id', '=',  $currentdateTomorrow->id)
//             ->where('in_time', '<=', '04:00:00');
//         }
//     })
//     ->get();

//     $countCarArr = [];
//     $countCarArr['Всего'] = $cars->count();

//     foreach($cars as $arr) {
//         $key = $arr->visitor->category->description;
     
//         if(isset($countCarArr[$key])) {
//             $countCarArr[$arr->visitor->category->description]++;
//         } else {
//             $countCarArr[$arr->visitor->category->description] = 1;
//         }
//     }

//     $reportDay = Carbon::createFromFormat('Y-m-d', $reportDay)->format('d/m');
//     $reportDayTomorrow =  Carbon::createFromFormat('Y-m-d', $reportDayTomorrow)->format('d/m/Y');

//     return view('/reports/mainReport', compact([
//         'securityGuys',
//         'faults',
//         'incidents',
//         'countPeopleArr',
//         'countCarArr',
//         'reportDay',
//         'reportDayTomorrow',
//         'request'
//     ]));
//  }