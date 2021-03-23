<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\Act;
use App\Models\Employee;
use App\Models\Visitor;
use App\Models\Firm;
use App\Models\Checkbox;
use App\Models\Approve;
use App\Models\Map;

class ActController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acts = Act::with('employee')
        ->with('checkbox')
        ->with('visitor', function($query) { 
            $query->with('firm');
        })
        ->with('approve')
        ->with('map')
        ->get();

        return $acts;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contract.number' => ['required', 'string', 'max:255'],
        ]); 

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        DB::transaction(function() use ($request) {
            $act = new Act;
            $act->place = $request->work['place'];
            $act->description = $request->work['description'];

            $act->from_time = $request->datetime['from_time'];
            $act->till_time = $request->datetime['till_time'];
            $act->from_date = $request->datetime['from_date'];
            $act->till_date = $request->datetime['till_date'];
            $act->weekend = $request->datetime['weekend'];

            $act->contract_number = $request->contract['number'];
            $act->contract_url = $request->contract['url'];

            $act->tz_number = $request->tz['number'];
            $act->tz_url = $request->tz['url'];

            //coordinator
            $coordinator = Employee::where([
                ['name', '=', $request->coordinator['name']], 
                ['surname', '=', $request->coordinator['surname']],
            ])->first();

            if($coordinator === null) {
                $coordinator = new Employee;
                $coordinator->name = $request->coordinator['name'];
                $coordinator->surname = $request->coordinator['surname'];
                $coordinator->patronymic = $request->coordinator['patronymic'];
                $coordinator->position = $request->coordinator['position'];
                $coordinator->save();
            }

            //representative
            $representative = Employee::where([
                ['name', '=', $request->representative['name']], 
                ['surname', '=', $request->representative['surname']],
            ])->first();

            if($representative === null) {
                $representative = new Employee;
                $representative->name = $request->representative['name'];
                $representative->surname = $request->representative['surname'];
                $representative->patronymic = $request->representative['patronymic'];
                $representative->position = $request->representative['position'];
                $representative->save();
            }

            //contractor
            $contractor = Visitor::where([
                ['name', '=', $request->contractor['name']], 
                ['surname', '=', $request->contractor['surname']],
            ])->first();

            if($contractor === null) {
                $contractor = new Visitor;
                $contractor->name = $request->contractor['name'];
                $contractor->surname = $request->contractor['surname'];
                $contractor->patronymic = $request->contractor['patronymic'];
                $contractor->position = $request->contractor['position'];
                $contractor->save();

                $firm = Firm::where('name', '=', $request->firm['name'])->first();

                if($firm === null) {
                    $firm = new Firm;
                    $firm->name = $request->firm['name'];
                    $firm->save();
                }

                $firm->visitor()->save($contractor);
             }

             $act->save();
             $representative->act()->save($act);
             $coordinator->act()->save($act);
             $contractor->act()->save($act);
            
            //checkbox
             $checkbox_options = new Checkbox;
             $checkbox_options->options = json_encode($request->checkboxes);

             $checkbox_options->save();
             $act->checkbox()->save($checkbox_options);
            
            //maps
            $maps = new Map;
            $maps->maps = json_encode($request->map);
            $maps->save();
            $act->map()->save($maps);

            //approvers
            $approvers = \Config::get('approver.act_approvers');
            $owner_roles = $request->roles;

            $owner_role = array_intersect($approvers, $owner_roles);

            $status = [];

            foreach($approvers as $approver) {
                foreach($owner_role as $role) {
                    if ($role == $approver) {
                        $status[$approver] = 'owner';
                    } else {
                        $status[$approver] = 'new';
                    }
                }     
            }

            $approve = new Approve;
            $approve->approval = json_encode($status);
            $approve->act_id = $act->id;
            $approve->user_id = $request->user()->id;
            $approve->save();
        });

        return 'act_added_success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Add new approval status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request) {
        $act = Act::where('id', '=', $request->id)->with('approve')->first()->approve;
        $act->approval = $request->currentStatus;
        $act->save();

        return 'success';
    }

}
