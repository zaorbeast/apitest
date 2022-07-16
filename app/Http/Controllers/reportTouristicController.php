<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reportTouristic;
use Prophecy\Exception\Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\reportTouristicRessource;



class reportTouristicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function finding()
    {
        $touristic=reportTouristic::where('state','=',1)->get();
        return $touristic;
    }
    public function index()
    {
        $reportHouse=reportTouristic::where('report_touristics.state',1)->paginate(10);
        return reportTouristicRessource::collection($reportHouse);
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
        $rules = array('idUser'=>'required','Message'=>'required','idTouristic'=>'required');
        $validat= Validator::make($request->all(),$rules);
        if ($validat->fails()) {
            return response()->json( $validat->errors(),400);
        } else {
            $message=explode(' ',$request->Message);
            if ($message>500) {
                return response()->json("Message too long",400);
            } else {
                try {
                    $reportHouse=new reportTouristic();
                    $reportHouse->idUser=$request->idUser;
                    $reportHouse->Message=$request->Message;
                    $reportHouse->idTouristic=$request->idTouristic;
                    if ($reportHouse->save())
                     {
                        return new reportTouristicRessource($reportHouse);
                    }
                } catch (Exception $e) {
                    return response()->json( $e,400);
                }
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
        $reportHouse=reportTouristic::where('report_touristics.idTouristic',$id)->get();
        return response()->json(["report"=>$reportHouse]);
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
        $reportHouse=reportTouristic::findOrFail($id);
        $reportHouse->state=false;
        if ($reportHouse->save())
        {
           return new reportTouristicRessource($reportHouse);
       }
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
    public function getTouristicByUser($id,$state)
    {
        if ($state==1) {
            $reportHouse=reportTouristic::where('report_touristics.state',1)
            ->where('report_touristics.idUser',$id)
            ->paginate(10);
            return reportTouristicRessource::collection($reportHouse);
        } else {
            if($state==0){
            $reportHouse=reportTouristic::where('report_touristics.state',0)
            ->where('report_touristics.idUser',$id)
            ->paginate(10);
            return reportTouristicRessource::collection($reportHouse);
        }


        }
    }
    public function getByUserHotel($idUser,$idTouristic,$state)
    {
        if ($state==1) {
            $reportTouristic=reportTouristic::where('report_touristics.idUser',$idUser)
            ->where('report_touristics.idTouristic',$idTouristic)
            ->where('report_touristics.state',1)->paginate(10);
            return new reportTouristicRessource($reportTouristic);
        } else {
            if($state==0)
            {
                $reportTouristic=reportTouristic::where('report_touristics.idUser',$idUser)
            ->where('report_touristics.idTouristic',$idTouristic)
            ->where('report_touristics.state',0)->paginate(10);
            return new reportTouristicRessource($reportTouristic);
            }
        }

    }
}
