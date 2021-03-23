<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCarRequest;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Category;
use App\Models\Currentdate;
use App\Models\Employee;
use App\Models\Firm;
use App\Models\Incomecar;
use App\Models\Security;
use App\Models\Visitor;

use App\Helpers\CurrentdateHelper;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $in = Incomecar::where('out_time', '=', null)->get();
 
        $showCarArr = [];
        foreach($in as $arr) {
            $showCarArr[] = [
                    'id' => $arr->id,
                    'surname' => $arr->visitor->surname,
                    'name' => $arr->visitor->name,
                    'car_number' => $arr->visitor->car->number,
                    'time' => Carbon::createFromFormat('H:i:s', $arr->in_time)->setTimezone('Europe/Moscow')->isoFormat('HH:mm'),
                    'phone' => $arr->visitor->phone
                ];
        }

        return view('car', compact('showCarArr'))->with('page', 'index');
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

        $category = Category::all();
        $securityWriter = $securityGroup->security->where('category', 'writer')->first();

        return view('car', compact('category', 'securityWriter'))->with('page', 'new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request) {
        $addIncCar = new Incomecar;
        $addIncCar->in_time = date("H:i:s");

        $currentdate = Currentdate::where('currentdate', date('Y-m-d'))->first();
        $currentdate->incomecar()->save($addIncCar);

        //visitor
        $addVisitor = Visitor::where([
            ['name', '=', $request->visitor_name], 
            ['surname', '=', $request->visitor_surname],
        ])->first();

        if ($addVisitor === null) {
            $addVisitor = new Visitor;
            $addVisitor->name = $request->visitor_name;
            $addVisitor->surname = $request->visitor_surname;
            $addVisitor->patronymic = $request->visitor_patronymic;
            $addVisitor->phone = $request->visitor_phone;
            $addVisitor->category_id = Category::where('name', $request->visitor_category)->first()->id;

            //car
            $addCar = Car::where('number', '=', $request->visitor_car_number)->first();

            if($addCar === null){
                $addCar = new Car;
                $addCar->number = $request->visitor_car_number;
                $addCar->model = $request->visitor_car_model;
                $addCar->save();
            }
            $addCar->visitor()->save($addVisitor);

            //firm
            $addFirm = Firm::where('name', '=', $request->visitor_firm)->first();

            if($addFirm === null) {
                $addFirm = new Firm;
                $addFirm->name = $request->visitor_firm;
                $addFirm->save();
            }
            $addFirm->visitor()->save($addVisitor);

        } else if ($addVisitor->car === null) {
            $addCar = Car::where('number', '=', $request->visitor_car_number)->first();

            if($addCar === null){
                $addCar = new Car;
                $addCar->number = $request->visitor_car_number;
                $addCar->model = $request->visitor_car_model;
                $addCar->save();
            }
            $addCar->visitor()->save($addVisitor);

        } else {
            if ($addVisitor->phone !== $request->visitor_phone) {
                $addVisitor->phone = $request->visitor_phone;
                $addVisitor->save();
            }

            if ($addVisitor->category->name !== $request->visitor_category) {
                $addVisitor->category_id = Category::where('name', $request->visitor_category)->first()->id;
                $addVisitor->save();
            }

            if ($addVisitor->firm->name !== $request->visitor_firm) {
                $addFirm = Firm::where('name', '=', $request->visitor_firm)->first();

                if($addFirm === null) {
                    $addFirm = new Firm;
                    $addFirm->name = $request->visitor_firm;
                    $addFirm->save();
                }
    
                $addFirm->visitor()->save($addVisitor);
            }

            if ($addVisitor->car->number !== $request->visitor_car_number) {
                $addCar = new Car;
                $addCar->number = $request->visitor_car_number;
                $addCar->model = $request->visitor_car_model;
                $addCar->save();
                $addCar->visitor()->save($addVisitor);
            }
        }

        $addVisitor->incomecar()->save($addIncCar);

        //employee
        $addEmployee = Employee::where('surname', '=', $request->employee_surname)->first();

        if($addEmployee === null) {
            $addEmployee = new Employee;
            $addEmployee->name = $request->employee_name;
            $addEmployee->surname = $request->employee_surname;
            $addEmployee->patronymic = $request->employee_patronymic;
            $addEmployee->save();
        }
        $addEmployee->incomecar()->save($addIncCar);

        //security
        $securityWriter = Currentdate::where('currentdate', date('Y-m-d'))->first()->dategroup->security->where('category', '=', 'writer')->first();
        $securityWriter->incomevisitor()->save($addIncCar);
    
        $id =  $addIncCar->id;

        return redirect()->route('car-print', $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Display the print blank.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id) {
        $printData = Incomecar::where('id', '=', $id)->first();

        $printDataArr = [
            'id' => $id,
            'visitor' => $printData->visitor->surname . ' ' . mb_substr($printData->visitor->name, 0, 1) . '. ' . mb_substr($printData->visitor->patronymic, 0, 1) . '.',
            'car_number' => $printData->visitor->car->model . ' ' . $printData->visitor->car->number,
            'firm' => $printData->visitor->firm->name,
            'employee' => $printData->employee->surname . ' ' . mb_substr($printData->employee->name, 0, 1) . '. ' . mb_substr($printData->employee->patronymic, 0, 1) . '.',
            'date' => Carbon::createFromFormat('Y-m-d', $printData->currentdate->currentdate)->format('d/m/Y'),
            'time' => Carbon::createFromFormat('H:i:s', $printData->in_time)->setTimezone('Europe/Moscow')->isoFormat('HH:mm'),
            'security' => $printData->security->name
        ];

        return view('includes/car/reportBlank', compact('printDataArr'));
    }

    
    /**
     * Registration people exit from territory.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exit(Request $request) {
        $exitCar = Incomecar::where('id', '=', $request->id)->first();

        if($request->out_time !== null) {
            $exitCar->out_time = $request->out_time;
        } else {
            $exitCar->out_time = date("H:i:s");
        }
        
        $exitCar->save();
        return redirect()->route('car-index');
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

    public function autoinsert(Request $request) {
        if($request->key == "id") {
            $resp =  Visitor::with('firm')
            ->where('id', '=', $request->data)
            ->first();
        } elseif($request->key == "name") {
            $resp =  Visitor::with('firm')->with('car')->with('category')->where('surname', 'LIKE', $request->data . '%')->get();
        } 

        return $resp;
    }
}
