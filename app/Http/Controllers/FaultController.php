<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currentdate;
use App\Models\Fault;

use App\Helpers\CurrentdateHelper;

class FaultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $faults = Fault::where('out_date', null)->get();

        return view('fault', compact('faults'))->with('page', 'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('fault')->with('page', 'new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $addIncFault = new Fault;
        $addIncFault->in_time = date("H:i:s");
        $addIncFault->system = $request->system;
        $addIncFault->name = $request->name;
        $addIncFault->place = $request->place;
        $addIncFault->comment = $request->comment;
        $currentdate = CurrentdateHelper::checkDate();
        $currentdate->incomecar()->save($addIncFault);

        return redirect()->route('fault-index')->with('success', 'Неисправность зарегистрирована');
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
    public function edit($id) {
        $fault = Fault::where('id', $id)->first();

        return view('fault', compact('fault'))->with('page', 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        Fault::where('id', $id)->
        update([
            'name' => $request->name,
            'place' => $request->place,
            'comment' => $request->comment,
            'in_time' => $request->in_time
        ]);

        return redirect()->route('fault-index')->with('success', 'Данные изменены');
    }

    /**
     * Update the specified resource in storage (insert close time).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function close(Request $request, $id) {
        $out_date = $request->out_date;

        if($out_date == null) {
            $out_date = date('Y-m-d');
        }

        Fault::where('id', $id)->update(['out_date' => $out_date]);

        return redirect()->route('fault-index')->with('success', 'Неисправность устранена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Fault::where('id', $id)->delete();

        return redirect()->route('fault-index')->with('success', 'Данные удалены!!');
    }
}
