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
        $lead = new Lead();
        $lead->fill($data);
        $lead->save();

        Mail::to('zDj7Z@example.com')->send(new NewContact($lead));
    }
}
