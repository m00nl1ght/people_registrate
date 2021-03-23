<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Currentdate;

use App\Helpers\CurrentdateHelper;
use Carbon\Carbon;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $currentDate = CurrentdateHelper::checkDate();

        if ($currentDate !== null) {
            $showIncidentArr = $currentDate->incident;
        }

        return view('incident', compact('showIncidentArr'))->with('page', 'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $currentdate = CurrentdateHelper::checkDate();
        $securityGroup = CurrentdateHelper::checkSecurityGroup();

        if ($securityGroup == null) {
            return redirect()->route('security-new')->with('warning_message', 'Сначала зарегистрируйте смену');
        }
        
        return view('incident')->with('page', 'new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $addIncIncident = new Incident;
        $addIncIncident->in_time = date("H:i:s");
        $addIncIncident->description = $request->description;
        $addIncIncident->action = $request->action;
        $currentdate = Currentdate::where('currentdate', date('Y-m-d'))->first();
        $currentdate->incomecar()->save($addIncIncident);

        return redirect()->route('incident-index')->with('success', 'Происшествие зарегистрировано');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $incident = Incident::where('id', $id)->first();

        return view('incident', compact('incident'))->with('page', 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $time = Carbon::createFromFormat('H:i', $request->in_time)->subHour(3)->format('H:i');

        Incident::where('id', $id)->
        update([
            'description' => $request->description,
            'action' => $request->action,
            'in_time' => $time
        ]);

        return redirect()->route('incident-index')->with('success', 'Данные изменены');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Incident::where('id', $id)->delete();

        return redirect()->route('incident-index')->with('success', 'Данные удалены!!');
    }
}
