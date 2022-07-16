<?php

namespace App\Http\Controllers;

use App\Http\Resources\reportHouseRessource;
use App\Models\reportHouse;
use Exception;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class reportHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportHouse=reportHouse::where('report_houses.state',1)->paginate(10);
        return reportHouseRessource::collection($reportHouse);
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
        $rules = array('idUser'=>'required','Message'=>'required','idhouse'=>'required');
        $validat= Validator::make($request->all(),$rules);
        if ($validat->fails()) {
            return response()->json( $validat->errors(),400);
        } else {
            $message=explode(' ',$request->Message);
            if ($message>500) {
                return response()->json("Message too long",400);
            } else {
                try{
                    $reportHouse=new reportHouse();
                    $reportHouse->idUser=$request->idUser;
                    $reportHouse->Message=$request->Message;
                    $reportHouse->idhouse=$request->idhouse;
                    if ($reportHouse->save())
                     {
                        return new reportHouseRessource($reportHouse);
                    }
                }catch(Exception $e){
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
        $reportHouse=reportHouse::where('report_houses.idhouse',$id)->get();
        return new reportHouseRessource($reportHouse);
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
        $reportHouse=reportHouse::findOrFail($id);
        $reportHouse->state=false;
        if ($reportHouse->save())
        {
           return new reportHouseRessource($reportHouse);
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
    public function getbyuser($id,$state)
    {
        if ($state==1) {
            $reportHouse=reportHouse::where('report_houses.idUser',$id)
            ->where('report_houses.state',1)
            ->paginate(10);
        return new reportHouseRessource($reportHouse);
        } else {
            $reportHouse=reportHouse::where('report_houses.idUser',$id)
            ->where('report_houses.state',0)
            ->paginate(10);
        return new reportHouseRessource($reportHouse);
        }
    }
    public function getByUserByHouse($idUser,$idhouse,$state)
    {
      if ($state==1) {
        $reportHouse=reportHouse::where('report_houses.idUser',$idUser)
        ->where('report_houses.idhouse',$idhouse)
        ->where('report_houses.state',1)->paginate(10);
        return new reportHouseRessource($reportHouse);
      } else {
        if ($state==0) {
          $reportHouse=reportHouse::where('report_houses.idUser',$idUser)
          ->where('report_houses.idhouse',$idhouse)
          ->where('report_houses.state',0)->paginate(10);
          return new reportHouseRessource($reportHouse);
        }
      }

    }
}
