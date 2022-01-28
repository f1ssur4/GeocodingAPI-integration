<?php

namespace App\Http\Controllers;

use App\Http\Resources\RequestDataResource;
use App\Models\RequestData;
use App\RequestDataHandler;
use Illuminate\Http\Request;

class RequestsGeolocationController extends Controller
{

    private $dataHandler;
    private $modelRequestData;

    public function __construct(RequestDataHandler $dataHandler, RequestData $modelRequestData)
    {
        $this->dataHandler = $dataHandler;
        $this->modelRequestData = $modelRequestData;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return json_encode($this->modelRequestData->all('address'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->dataHandler->prepareData($request->get('latitude'), $request->get('longitude'));
        $this->modelRequestData->addGeolocData($this->dataHandler->resultData());
        return $this->dataHandler->address;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return json_encode($this->modelRequestData::where('id', $id)->get('address'));

    }

    public function getSorted($id)
    {
        return RequestDataResource::collection($this->modelRequestData::with('RegionsCities')->where('regions_cities_id', $id)->get());
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
