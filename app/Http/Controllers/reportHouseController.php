<?php

namespace App\Http\Controllers;

use App\Http\Resources\reportHouseRessource;
use App\Models\reportHouse;
use Illuminate\Http\Request;

class reportHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reportHouse=reportHouse::paginate(10);
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
        $reportHouse=new reportHouse();
        $reportHouse->idUser=$request->idUser;
        $reportHouse->Message=$request->Message;
        $reportHouse->idhouse=$request->idhouse;
        if ($reportHouse->save())
         {
            return new reportHouseRessource($reportHouse);
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
        $reportHouse=reportHouse::findOrFail($id);
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
}
