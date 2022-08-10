<?php

namespace App\Http\Controllers;

use App\Http\Resources\reportUserResource;
use App\Models\reportUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr;
use PHPUnit\Framework\Constraint\Count;

class reportUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $reportUser=reportUser::where('report_users.state',1)->paginate(10);
            return reportUserResource::collection($reportUser);
        } catch (Exception $es) {
            return response()->json(['error'=>$es],400);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=array('idReportedUser'=>'required','Message'=>'required');
        $validator=Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(),400);
        } else {
            $messages=explode(' ',$request->Message);
            if (count($messages)<=500) {
                try {
                    $report= new reportUser();
                    $report->idUser=$request->idUser;
                    $report->Message=$request->Message;
                    $report->idReportedUser=$request->idReportedUser;
                    if($report->save()){
                        return new reportUserResource($report);
                    }
                } catch (Exception $ex) {
                    return response()->json($ex,400);
                }


            } else {
                return response()->json("Massage too long allowed only 500 words",400);
            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $reportUser=reportUser::where('report_users.idReportedUser',1)->get();
            return response()->json(['report'=>$reportUser]);
        } catch (exception $es) {
            return response()->json(['error'=>$es],400);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
try {
    $reportUser=reportUser::findOrFail($id);
        $reportUser->state=false;
        if($reportUser->save()){
            return new reportUserResource($reportUser);
        }
} catch (Exception $es) {
    return response()->json(['error'=>$es],400);
}

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
    public function getReportUserByUser($id, $state)
    {
        try {
            $reportUser=reportUser::where('report_users.state',$state)
            ->where('report_users.idReportedUser',$id)->paginate(10);
            return reportUserResource::collection($reportUser);
        } catch (Exception $es) {
            return response()->json(['error'=>$es],400);
        }




    }
    public function getByuser($id,$idReported,$state)
    {
        try {
            $reportUser=reportUser::where('report_users.state',$state)
        ->where('report_users.idUser',$id)
        ->where('report_users.idReportedUser',$idReported)->paginate(10);
        return reportUserResource::collection($reportUser);
        } catch (Exception $es) {
            return response()->json(['error'=>$es],400);
        }

    }
}
