<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Card;
use App\Models\Currentdate;
use App\Models\Cardcategory;
use App\Models\Employee;
use App\Models\Incomecard;

use App\Helpers\CurrentdateHelper;

class IncomeCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $currentDate = CurrentdateHelper::checkDate();

        $incCard = $currentDate->incomecard->where('out_time', null);

        return view('card', compact('incCard'))->with('page', 'income-index');
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

    
    public function createEmployee() {
        $cards = Cardcategory::where('name', 'employee')->first()->card->where('status', false);

        return view('card', compact('cards'))->with('page', 'create-employee');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    public function storeEmployee(Request $request) {
        $addIncCard = new Incomecard;
        $addIncCard->in_time = date("H:i:s");
        $currentdate = Currentdate::where('currentdate', date('Y-m-d'))->first();
        $currentdate->incomecard()->save($addIncCard);

        //employee
        $addEmployee = Employee::where('surname', '=', $request->employee_surname)->first();

        if($addEmployee === null) {
            $addEmployee = new Employee;
            $addEmployee->name = $request->employee_name;
            $addEmployee->surname = $request->employee_surname;
            $addEmployee->patronymic = $request->employee_patronymic;
            $addEmployee->position = $request->employee_position;
            $addEmployee->save();
        } elseif ($addEmployee->position == null) {
            $addEmployee->update([
                'position' => $request->employee_position
            ]);
        }

        $addEmployee->incomecard()->save($addIncCard);

        //employee_boss
        $addEmployeeBoss = Employee::where('surname', '=', $request->employee_boss_surname)->first();

        if($addEmployeeBoss === null) {
            $addEmployeeBoss = new Employee;
            $addEmployeeBoss->name = $request->employee_boss_name;
            $addEmployeeBoss->surname = $request->employee_boss_surname;
            $addEmployeeBoss->patronymic = $request->employee_boss_patronymic;
            $addEmployeeBoss->position = $request->employee_boss_position;
            $addEmployeeBoss->save();
        } elseif ($addEmployeeBoss->position == null) {
            $addEmployeeBoss->update([
                'position' => $request->employee_boss_position
            ]);
        }
        $addEmployeeBoss->incomecard()->save($addIncCard);

        //card
        $addCard = Card::where('id', $request->card_id)->first();
        $addCard->status = true;
        $addCard->save();
        $addCard->incomecard()->save($addIncCard);

        return redirect()->route('incomecard-index')->with('success', 'Пропуск выдан');
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
    public function update(Request $request, $id) {
        $time = $request->out_time;

        if ($time == null) {
            $time = date("H:i:s");
        }

        $incCard = Incomecard::where('id', $id);
        $incCard->update(['out_time' => $time]);

        Card::where('id', $incCard->first()->card_id)->update(['status' => 0]);

        return redirect()->route('incomecard-index')->with('success', 'Пропуск возвращен');
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
}
