<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Act;
use App\Models\Visitor;
use App\Models\Firm;
use App\Models\Document;

class WorkerController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $responce = [];
        $workers = Act::where('id', 30)->first()->workers;
        
        foreach($workers as $worker) {
            $resp = [];
            $resp['name'] = $worker->name;
            $resp['surname'] = $worker->surname;
            $resp['patronymic'] = $worker->patronymic;
            $resp['position'] = $worker->position;
            $resp['firm'] = $worker->firm->name;
            $resp['files'] = $worker->document;

            $responce[] = $resp;
        }

        return json_encode($responce);
    }

    /**
     * Display a listing of the resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function indexByActId($id){
        $responce = [];
        $workers = Act::where('id', $id)->first()->workers;
        
        foreach($workers as $worker) {
            $resp = [];
            $resp['name'] = $worker->name;
            $resp['surname'] = $worker->surname;
            $resp['patronymic'] = $worker->patronymic;
            $resp['position'] = $worker->position;
            $resp['firm'] = $worker->firm->name;

            $files = [];
            foreach($worker->document as $file) {
                $files[] = [
                    "name" => $file->name,
                    "path" => Storage::url($file->path),
                    'id' => $file->id
                ];
            }
            // $resp['files'] = $worker->document;
            $resp['files'] = $files;

            $responce[] = $resp;
        }

        return json_encode($responce);
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
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            // 'contract.number' => ['required', 'string', 'max:255'],
        ]); 

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        DB::transaction(function() use ($request) {
            $isIncomeData = true;
            $index = 0;
            
            while($isIncomeData) {
                if($request->{$index . "-name"}) {
                    //visitor
                    $addVisitor = Visitor::where([
                        ['name', '=', $request->{$index . "-name"}], 
                        ['surname', '=', $request->{$index . "-surname"}],
                    ])->first();

                    if($addVisitor === null) {
                        $addVisitor = new Visitor;
                        $addVisitor->name = $request->{$index . "-name"};
                        $addVisitor->surname = $request->{$index . "-surname"};
                        $addVisitor->patronymic = $request->{$index . "-patronymic"};
                        $addVisitor->position = $request->{$index . "-position"};
                        $addVisitor->save();

                        //firm
                        $addFirm = Firm::where('name', '=', $request->{$index . "-firm"})->first();

                        if($addFirm === null) {
                            $addFirm = new Firm;
                            $addFirm->name = $request->{$index . "-firm"};
                            $addFirm->save();
                        }

                        $addFirm->visitor()->save($addVisitor);
                    }

                    //files
                    foreach($request->file($index . "-files") as $file) {
                        $path = $file->store('public/docs');

                        $document = new Document;
                        $document->path = $path;
                        $document->name = $file->getClientOriginalName();
                        $document->visitor_id = $addVisitor->id;
                        $document->save();
                    }

                    //act
                    $addAct = Act::where('id', $request->actId)->first();
                    $addAct->workers()->save($addVisitor);
                    
                    $index++;
                } else {
                    $isIncomeData = false;
                }
            }
            // $path = $request->file('files')->store('avatars');
            // return  $request->file('files')->getClientOriginalName();
        });



        return json_encode(asset('public/docs/4JHxTaLcuqK503OK1sHlNZYqSwEN3020eoBushQQ.png'));
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
}
