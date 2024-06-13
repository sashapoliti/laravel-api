<?php

namespace App\Http\Controllers\Api;

use App\Models\Lead;
use App\Mail\NewContact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class LeadController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required',
            'address' => 'required|email',
            'message' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        $lead = new Lead();
        $lead->fill($data);
        $lead->save();

        Mail::to('admin@boolpress.com')->send(new NewContact($lead));

        return response()->json([
            'status' => 'success',
            'message' => 'Lead created successfully'
        ], 200);
    }
}
