<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;

class AR11Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $physicalAddress = new Address;
        $physicalAddress->streetNumberAndName = $request->input('physicalStreetInput');
        $physicalAddress->homeType = $request->input('apartStatusSelect');
        if($request->input('apartStatusSelect') !== 'No') {
            $physicalAddress->floorNumber = $request->input('apartNumberInput');
        }
        $physicalAddress->city = $request->input('cityInput');
        $physicalAddress->state = $request->input('stateInput');
        $physicalAddress->zipcode = $request->input('zipcodeInput');
        $physicalAddress->save();
        return $physicalAddress->streetNumberAndName;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
