<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreVisitorRequest;
use Validator;
use Carbon\Carbon;

use App\Models\Card;
use App\Models\Cardcategory;
use App\Models\Category;
use App\Models\Currentdate;
use App\Models\Dategroup;
use App\Models\Employee;
use App\Models\Firm;
use App\Models\Incomevisitor;
use App\Models\Security;
use App\Models\Visitor;

use App\Helpers\CurrentdateHelper;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $in = Incomevisitor::where('out_time', '=', null)->get();
 
        $showVisitorArr = [];
        foreach($in as $arr) {
                $showVisitorArr[] = [
                    'id' => $arr->id,
                    'surname' => $arr->visitor->surname,
                    'name' => $arr->visitor->name,
                    'time' => Carbon::createFromFormat('H:i:s', $arr->in_time)->setTimezone('Europe/Moscow')->isoFormat('HH:mm'),
                    'phone' => $arr->visitor->phone
                ];
        }
       
        return view('visitor', compact('showVisitorArr'))->with('page', 'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $securityGroup = CurrentdateHelper::checkSecurityGroup();

        if ($securityGroup == null) {
            return redirect()->route('security-new')->with('warning_message', 'Сначала зарегистрируйте смену');
        }

        $category = Category::all();
        $securityWriter = $securityGroup->security->where('category', 'writer')->first();
        $cards = Cardcategory::where('name', 'visitor')->first()->card->where('status', false);

        return view( 'visitor', compact('category', 'securityWriter', 'cards') )->with('page', 'new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVisitorRequest $request) {
        $addIncVisitor = new Incomevisitor;
        $addIncVisitor->in_time = date("H:i:s");

        //card
        $addCard = Card::where('id', $request->card_id)->first();
        $addCard->status = true;
        $addCard->save();
        $addIncVisitor->card_id = $request->card_id;

        $currentdate = CurrentdateHelper::checkDate();
        $currentdate->incomevisitor()->save($addIncVisitor);

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
            $addVisitor->save();

            //firm
            $addFirm = Firm::where('name', '=', $request->visitor_firm)->first();

            if($addFirm === null) {
                $addFirm = new Firm;
                $addFirm->name = $request->visitor_firm;
                $addFirm->save();
            }

            $addFirm->visitor()->save($addVisitor);
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
        }

        $addVisitor->incomevisitor()->save($addIncVisitor);

        //employee
        $addEmployee = Employee::where('surname', '=', $request->employee_surname)->first();

        if($addEmployee === null) {
            $addEmployee = new Employee;
            $addEmployee->name = $request->employee_name;
            $addEmployee->surname = $request->employee_surname;
            $addEmployee->patronymic = $request->employee_patronymic;
            $addEmployee->save();
        }
        $addEmployee->incomevisitor()->save($addIncVisitor);

        //security
        $securityWriter = CurrentdateHelper::securityWriter();
        $securityWriter->incomevisitor()->save($addIncVisitor);

        $id =  $addIncVisitor->id;

        return redirect()->route('visitor-print', $id);
        
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
        $printData = Incomevisitor::where('id', '=', $id)->first();

        $printDataArr = [
            'id' => $id,
            'visitor' => $printData->visitor->surname . ' ' . mb_substr($printData->visitor->name, 0, 1) . '. ' . mb_substr($printData->visitor->patronymic, 0, 1) . '.',
            'firm' => $printData->visitor->firm->name,
            'employee' => $printData->employee->surname . ' ' . mb_substr($printData->employee->name, 0, 1) . '. ' . mb_substr($printData->employee->patronymic, 0, 1) . '.',
            'date' => Carbon::createFromFormat('Y-m-d', $printData->currentdate->currentdate)->format('d/m/Y'),
            'time' => Carbon::createFromFormat('H:i:s', $printData->in_time)->setTimezone('Europe/Moscow')->isoFormat('HH:mm'),
            'security' => $printData->security->name
        ];

        return view('includes/visitor/reportBlank', compact('printDataArr'));
    }

    /**
     * Registration people exit from territory.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exit(Request $request) {
        $exitPeople = Incomevisitor::where('id', '=', $request->id)->first();

        $exitCard = Card::where('id', $exitPeople->card->id)->first();
        $exitCard->status = false;
        $exitCard->save();
        
        if($request->out_time !== null) {
            $exitPeople->out_time = $request->out_time;
        } else {
            $exitPeople->out_time = date("H:i:s");
        }
        
        $exitPeople->save();

        return redirect()->route('visitor-index');
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
     * Check visitors in database, if exist -> return visitor.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function autoinsert(Request $request) {
        if($request->key == "id") {
            $resp =  Visitor::with('firm')
            ->where('id', '=', $request->data)
            ->first();
        } elseif($request->key == "name") {
            $resp =  Visitor::with('firm')->with('category')->where('surname', 'LIKE', $request->data . '%')->get();
        } 

        return $resp;
    }

}
