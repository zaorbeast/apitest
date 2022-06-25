<?php

namespace App\Http\Controllers;

use App\Http\Resources\reportHotelRessource;
use App\Models\reportHotel;
use Illuminate\Http\Request;

class reportHotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportHotel=reportHotel::paginate(10);
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
        $reportHotel=new reportHotel();
        $reportHotel->idUser=$request->idUser;
        $reportHotel->Message=$request->Message;
        $reportHotel->idhotel=$request->idhotel;
        if ($reportHotel->save())
         {
            return new reportHotelRessource($reportHotel);
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
}
