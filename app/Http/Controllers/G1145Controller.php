<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\G1145;

use Illuminate\Support\Facades\Validator;

class G1145Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'Hello';
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
        // $validated = $request->validate([
        //     'fileName' => 'required',
        //     'firstName' => 'required|max:20',
        //     'lastName' => 'required|max:30',
        //     'email' => 'required|email',
        //     'mobileNumber' => 'nullable|digits:9'
        // ]);

        $validator = Validator::make($request->all(), [
            'fileName' => 'required',
            'firstName' => 'required|max:20',
            'lastName' => 'required|max:30',
            'email' => 'required|email',
            'mobileNumber' => 'nullable|digits:9'
        ]);
    
        if ($validator->fails()) {
            // Validation failed, handle the errors
            $errors = $validator->errors();
    
            // Optionally, you can redirect back with errors
            return $errors;
        }

        $applicantInfo = new Applicant;
        $g1145 = new G1145;

        $applicantInfo->firstName = $request->input('firstName');
        $applicantInfo->middleName = $request->input('middleName');
        $applicantInfo->lastName = $request->input('lastName');
        $applicantInfo->email = $request->input('email');
        $applicantInfo->mobilePhone = $request->input('mobileNumber');
        $applicantInfo->save();

        $g1145->fileName = $request->input('fileName');
        $g1145->applicantId = $applicantInfo->id;

        $g1145->save();
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
