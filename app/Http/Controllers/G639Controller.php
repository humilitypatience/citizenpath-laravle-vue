<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\G639;
use App\Models\Applicant;
use App\Models\Address;
use App\Models\OtherName;
use App\Models\Father;
use App\Models\Mother;
use App\Modles\Kinsfolk;

class G639Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'subjectOfRecord1.requestPurpose' => 'nullable|max:140',
            'subjectOfRecord1.exactRecordName' => 'required_if:subjectOfRecord1.requestInfo,"Other"|max:140',
            'subjectOfRecord1.firstName' => 'required|max:20',
            'subjectOfRecord1.lastName' => 'required|max:30',
            'subjectOfRecord1.otherNames.*.firstName' => 'required|max:20',
            'subjectOfRecord1.otherNames.*.lastName' => 'required|max:30',
            'subjectOfRecord1.inCareOfName' => 'nullable|max:35',
            'subjectOfRecord1.streetName' => 'required|max:25',
            'subjectOfRecord1.apartNumber' => 'required_unless:subjectOfRecord1.apartStatus,"No"|max:6',
            'subjectOfRecord1.city' => 'required|max:20',
            'subjectOfRecord1.province' => 'required|max:20',
            'subjectOfRecord1.country' => 'required|max:30',
            'subjectOfRecord1.postCode' => 'required|max:9',
            'subjectOfRecord1.datetimePhone' => 'required|digits',
            'subjectOfRecord2.birthday' => 'required|date',
            'subjectOfRecord2.birtthCountry' => 'required',
            'subjectOfRecord2.alienNumber' => 'nullable|digits:9',
            'subjectOfRecord2.firstNameAtArrivalInUS' => 'required|max:20',
            'subjectOfRecord2.middleNameAtArrivalInUS' => 'nullable|max:20',
            'subjectOfRecord2.lastNameAtArrivalInUS' => 'required|max:30',
            'subjectFile.fatherFirstName' => 'required_if:subjectFile.fatherunknown,true|max:20',
            'subjectFile.fatherMiddleName' => 'nullable|max:30',
            'subjectFile.fatherLastName' => 'required_if:subjectFile.fatherunknown,true|max:30',
            'subjectFile.motherFirstName' => 'required_if:subjectFile.motherunknown,true|max:20',
            'subjectFile.motherMiddleName' => 'nullable|max:30',
            'subjectFile.motherLastName' => 'required_if:subjectFile.motherunknown,true|max:30',
            'subjectFile.otherFamilyMembers.*.firstName' => 'required_if:subjectFile.otherFamilyMemberFlag,true|max:20',
            'subjectFile.otherFamilyMembers.*.lastName' => 'required_if:subjectFile.otherFamilyMemberFlag,true|max:30',
            'subjectFile.relationship' => 'required|max:30',
            'requestorInfo.firstName' => 'required|max:20',
            'requestorInfo.lastName' => 'required|max:30',
            'requestorInfo.streetName' => 'required|max:35',
            'requestorInfo.apartNumber' => 'required_unless:requestorInfo.apartStatus,"No"|max:4',
            'requestorInfo.city' => 'required|max:20',
            'requestorInfo.country' => 'required|max:30',
            'requestorInfo.state' => 'required|max:30',
            'requestorInfo.postalcode' => 'required|max:9',
            'requestorInfo.datetimePhone' => 'required|digits:10',
            'requestorInfo.mobilePhone' => 'nullable|digits:10',
            'requestorInfo.email' => 'nullable|email'
        ]);

        $g639 = new G639;
        $applicant = new Applicant;
        $address = new Address;

        $g639->requestInfo = $request['subjectOfRecord1']['requestInfo'];
        $g639->requestPurpose = $request['subjectOfRecord1']['requestPurpose'];
        if(isset($request['subjectOfRecord1']['exactRecordName'])) {
            $g639->exactRecordName = $request['subjectOfRecord1']['requestPurpose'];
        }
        if(isset($request['subjectOfRecord1']['insteadOfChild'])) {
            $g639->insteadOfChild = $request['subjectOfRecord1']['insteadOfChild'];
        }
        if(isset($request['subjectOfRecord1']['insteadOfSomeoneDeceased'])) {
            $g639->insteadOfSomeoneDeceased = $request['subjectOfRecord1']['insteadOfSomeoneDeceased'];
        }
        if(isset($request['subjectOfRecord1']['insteadForAttorney'])) {
            $g639->insteadForAttorney = $request['subjectOfRecord1']['insteadForAttorney'];
        }

        $applicant->firstName = $request['subjectOfRecord1']['firstName'];
        if(isset($request['subjectOfRecord1']['middleName'])) {
            $applicant->middleName = $request['subjectOfRecord1']['middleName'];
        }
        $applicant->lastName = $request['subjectOfRecord1']['lastName'];
        $applicant->datetimePhone = $request['subjectOfRecord1']['datetimePhone'];
        if(isset($request['subjectOfRecord1']['mobilePhone'])) {
            $applicant->mobilePhone = $request['subjectOfRecord1']['mobilePhone'];
        }
        if(isset($request['subjectOfRecord1']['email'])) {
            $applicant->email = $request['subjectOfRecord1']['email'];
        }
        $applicant->birthday = $request['subjectOfRecord2']['birthday'];
        $applicant->birthCountry = $request['subjectOfRecord2']['birthCountry'];
        if(isset($request['subjectOfRecord2']['alienNumber'])) {
            $applicant->alienNumber = $request['subjectOfRecord2']['alienNumber'];
        }
        $applicant->save();
        if($request['subjectOfRecord1']['otherNameFlag']) {
            foreach ($request['subjectOfRecord1']['otherNames'] as $name) {
                $otherName = new OtherName;
                $otherName->firstName = $name['firstName'];
                $otherName->lastName = $name['lastName'];
                if(isset($name['middleName'])) {
                    $otherName->middleName = $name['middleName'];
                }
                $otherName->applicantId = $applicant->id;
                $otherName->save();
            }
        }

        if(isset($request['subjectOfRecord1']['inCareOfName'])) {
            $address->inCareOfName = $request['subjectOfRecord1']['inCareOfName'];
        }
        $address->streetNumberAndName = $request['subjectOfRecord1']['streetName'];
        $address->homeType = $request['subjectOfRecord1']['apartStatus'];
        if($request['subjectOfRecord1']['apartStatus'] !== 'No') {
            $address->floorNumber = $request['subjectOfRecord1']['apartNumber'];
        }
        $address->city = $request['subjectOfRecord1']['city'];
        $address->country = $request['subjectOfRecord1']['country'];
        $address->state = $request['subjectOfRecord1']['province'];
        $address->zipcode = $request['subjectOfRecord1']['postCode'];
        $address->save();

        $g639->applicantId = $applicant->id;
        $g639->mailingAddressId = $address->id;
        $g639->urgentNeed = $request['subjectOfRecord1']['urgentNeed'];
        $g639->circumstance = $request['subjectOfRecord1']['circumstance'];
        $g639->firstNameAtArrivalInUS = $request['subjectOfRecord2']['firstNameAtArrivalInUS'];
        $g639->lastNameAtArrivalInUS = $request['subjectOfRecord2']['lastNameAtArrivalInUS'];
        if($request['subjectOfRecord2']['middleNameAtArrivalInUS']) {
            $g639->middleNameAtArrivalInUS = $request['subjectOfRecord2']['middleNameAtArrivalInUS'];
        }
        if(isset($request['subjectOfRecord2']['I94Number'])) {
            $g639->I94AdmissionNumber = $request['subjectOfRecord2']['I94Number'];
        }
        if(isset($request['subjectOfRecord2']['passportNumber'])) {
            $g639->passportNumber = $request['subjectOfRecord2']['passportNumber'];
        }
        if(isset($request['subjectFile']['applicationReceiptNumber'])) {
            $g639->applicationReceiptNumber = $request['subjectFile']['applicationReceiptNumber'];
        }
        if(isset($request['subjectFile']['USCISReceiptNumber'])) {
            $g639->USCISReceiptNumber = $request['subjectFile']['USCISReceiptNumber'];
        }

        if($request['subjectFile']['fatherunknown'] === false) {
            $fatherInfo = new Father;
            $fatherInfo->firstName = $request['subjectFile']['fatherFirstName'];
            $fatherInfo->lastName = $request['subjectFile']['fatherLastName'];
            if(isset($request['subjectFile']['fatherMiddleName'])) {
                $fatherInfo->middleName = $request['subjectFile']['FatherMiddleName'];
            }
            $fatherInfo->save();
            $g639->fatherId = $fatherInfo->id;
        }
        if($request['subjectFile']['motherunknown'] === false) {
            $motherInfo = new Mother;
            $motherInfo->firstName = $request['subjectFile']['motherFirstName'];
            $motherInfo->lastName = $request['subjectFile']['motherLastName'];
            if(isset($request['subjectFile']['motherMiddleName'])) {
                $motherInfo->middleName = $request['subjectFile']['motherMiddleName'];
            }
        }

        if($request['subjectFile']['otherFamilyMemberFlag'] === true) {
            foreach($request['subjectFile']['otherFamilyMembers'] as $member) {
                $kinsfolk = new Kinsfolk;
                $kinsfolk->firstName = $member['fistName'];
                $kinsfolk->lastName = $member['lastName'];
                if(isset($member['middleName'])) {
                    $kinsfolk->middleName = $member['middleName'];
                }
                $kinsfolk->relationship = $member['relationship'];
                $kinsfolk->applicantId = $applicant->id;
                $kinsfolk->save();
            }
        }
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
