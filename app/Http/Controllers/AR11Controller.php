<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Applicant;
use App\Models\AR11;
use Inertia\Inertia;

class AR11Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Inertia::render('Services/AR-11');
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
        $validated = $request->validate([
            'prevPhysicalAddress.streetInput' => 'required|max:25',
            'prevPhysicalAddress.apartStatusSelect' => 'required',
            'prevPhysicalAddress.apartNumberInput' => 'required_unless:prevPhysicalAddress.apartStatusSelect,"No"|max:4',
            'prevPhysicalAddress.cityInput' => 'required|max:20',
            'prevPhysicalAddress.stateInput' => 'required|max:100',
            'prevPhysicalAddress.zipcodeInput' => 'required|digits:5',
            'newPhysicalAddress.streetInput' => 'required|max:25',
            'newPhysicalAddress.apartStatusSelect' => 'required',
            'newPhysicalAddress.apartNumberInput' => 'required_unless:newPhysicalAddress.apartStatusSelect,"No"|max:4',
            'newPhysicalAddress.cityInput' => 'required|max:20',
            'newPhysicalAddress.stateInput' => 'required|max:100',
            'newPhysicalAddress.zipcodeInput' => 'required|digits:5',
            'mailingAddress.streetInput' => 'required_if:mailingAddressSameFlag,false|max:25',
            'mailingAddress.apartStatusSelect' => 'required_if:mailingAddressSameFlag,false',
            'mailingAddress.apartNumberInput' => 'required_unless:mailingAddress.apartStatusSelect,"No"|max:4',
            'mailingAddress.cityInput' => 'required_if:mailingAddressSameFlag,false|max:20',
            'mailingAddress.stateInput' => 'required_if:mailingAddressSameFlag,false|max:100',
            'mailingAddress.zipcodeInput' => 'required_if:mailingAddressSameFlag,flase|nullable|digits:5',
            'applicantInfo.firstName' => 'required|max:18',
            'applicantInfo.middleName' => 'max:18',
            'applicantInfo.lastName' => 'required|max:30',
            'applicantInfo.birthday' => 'required|date',
            'applicantInfo.citizenship' => 'required',
            'applicantInfo.visitingRole' => 'required',
            'applicantInfo.immigrationStatus' => 'required',
            'applicantInfo.alienNumber' => 'nullable|digits:9'
        ]);

        $prevPhysicalAddress = new Address;
        $newPhysicalAddress = new Address;
        $applicantInfo = new Applicant;
        $ar11Row = new AR11;

        $prevPhysicalAddress->streetNumberAndName = $validated["prevPhysicalAddress"]["streetInput"];
        $prevPhysicalAddress->homeType = $validated["prevPhysicalAddress"]["apartStatusSelect"];
        if($validated["prevPhysicalAddress"]["apartStatusSelect"] !== 'No') {
            $prevPhysicalAddress->floorNumber = $validated["prevPhysicalAddress"]["apartNumberInput"];
        }
        $prevPhysicalAddress->city = $validated["prevPhysicalAddress"]["cityInput"];
        $prevPhysicalAddress->state = $validated["prevPhysicalAddress"]["stateInput"];
        $prevPhysicalAddress->zipcode = $validated["prevPhysicalAddress"]["zipcodeInput"];
        $prevPhysicalAddress->save();

        $newPhysicalAddress->streetNumberAndName = $validated["newPhysicalAddress"]["streetInput"];
        $newPhysicalAddress->homeType = $validated["newPhysicalAddress"]["apartStatusSelect"];
        if($validated["newPhysicalAddress"]["apartStatusSelect"] !== 'No') {
            $newPhysicalAddress->floorNumber = $validated["newPhysicalAddress"]["apartNumberInput"];
        }
        $newPhysicalAddress->city = $validated["newPhysicalAddress"]["cityInput"];
        $newPhysicalAddress->state = $validated["newPhysicalAddress"]["stateInput"];
        $newPhysicalAddress->zipcode = $validated["newPhysicalAddress"]["zipcodeInput"];
        $newPhysicalAddress->save();

        if($request->input('mailingAddressSameFlag') === false) {
            $mailingAddress = new Address;

            $mailingAddress->streetNumberAndName = $validated["mailingAddress"]["streetInput"];
            $mailingAddress->homeType = $validated["mailingAddress"]["apartStatusSelect"];
            if($validated["mailingAddress"]["apartStatusSelect"] !== 'No') {
                $mailingAddress->floorNumber = $validated["mailingAddress"]["apartNumberInput"];
            }
            $mailingAddress->city = $validated["mailingAddress"]["cityInput"];
            $mailingAddress->state = $validated["mailingAddress"]["stateInput"];
            $mailingAddress->zipcode = $validated["mailingAddress"]["zipcodeInput"];
            $mailingAddress->save();
        }

        $applicantInfo->firstName = $validated["applicantInfo"]["firstName"];
        $applicantInfo->middleName = $validated["applicantInfo"]["middleName"];
        $applicantInfo->lastName = $validated["applicantInfo"]["lastName"];
        $applicantInfo->birthday = $validated["applicantInfo"]["birthday"];
        $applicantInfo->alienNumber = $validated["applicantInfo"]["alienNumber"];
        $applicantInfo->save();

        $ar11Row->citizenship = $validated["applicantInfo"]["citizenship"];
        $ar11Row->visitingRole = $validated["applicantInfo"]["visitingRole"];
        $ar11Row->immigrationStatus = $validated["applicantInfo"]["immigrationStatus"];
        $ar11Row->previousPhysicalAddress = $prevPhysicalAddress->id;
        $ar11Row->presentPhysicalAddress = $newPhysicalAddress->id;
        if($request->input('mailingAddressSameFlag') === false) {
            $ar11Row->mailingAddress = $mailingAddress->id;
        }
        $ar11Row->applicantId = $applicantInfo->id;
        $ar11Row->save();

        return "success";
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
