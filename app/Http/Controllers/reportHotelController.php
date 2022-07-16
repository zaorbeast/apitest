<?php

namespace App\Http\Controllers;

use App\Http\Resources\reportHotelRessource;
use App\Models\reportHotel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class reportHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportHotel=reportHotel::where('report_hotels.state',1)->paginate();
        return reportHotelRessource::collection($reportHotel);
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
        $rules = array('idUser'=>'required','Message'=>'required','idhotel'=>'required');
        $validat=Validator::make($request->all(),$rules);
        if ($validat->fails()) {
            return response()->json( $validat->errors(),400);
        } else {
            $Message=explode(' ',$request->Message);
            if ($Message>500) {
                return response()->json("Message too long",400);
            } else {
                try{
                    $reportHotel=new reportHotel();
                    $reportHotel->idUser=$request->idUser;
                    $reportHotel->Message=$request->Message;
                    $reportHotel->idhotel=$request->idhotel;
                    if ($reportHotel->save())
                     {
                        return new reportHotelRessource($reportHotel);
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
        $reportHotel=reportHotel::findOrFail($id);
        return new reportHotelRessource($reportHotel);
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
        $reportHouse=reportHotel::findOrFail($id);
        $reportHouse->state=false;
        if ($reportHouse->save())
        {
           return new reportHotelRessource($reportHouse);
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
    public function getReportByUser($id,$state)
    {
        if ($state==1) {
            $reportHotel=reportHotel::where('report_hotels.state',1)
            ->where('report_hotels.idUser',$id)
            ->paginate();
        return reportHotelRessource::collection($reportHotel);
        } else {
            if ($state==0) {
                $reportHotel=reportHotel::where('report_hotels.state',0)
                ->where('report_hotels.idUser',$id)
                ->paginate();
            return reportHotelRessource::collection($reportHotel);
            }

        }

    }
    public function getByUserHotel($idUser,$idHotel,$state)
    {
      if ($state==1) {
        $reportHotel=reportHotel::where('report_hotels.idUser',$idUser)
        ->where('report_hotels.idhotel',$idHotel)
        ->where('report_hotels.state',1)->paginate();
        return reportHotelRessource::collection($reportHotel);
      } else {
        if ($state==0) {
          $reportHotel=reportHotel::where('report_hotels.idUser',$idUser)
          ->where('report_hotels.idhotel',$idHotel)
          ->where('report_hotels.state',0)->paginate();
          return reportHotelRessource::collection($reportHotel);
        }
      }

    }
}
