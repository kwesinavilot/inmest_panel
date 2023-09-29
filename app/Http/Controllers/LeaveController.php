<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;

class LeaveController extends APIBaseController
{
    public $message = '';

    public function requestSickLeave(Request $request) {
        // dd($request);

        $rules = [
            'studentID' => ['required', 'string', 'min:2', 'max:10', 'exists:student,studentID'],
            'type' => ['required', 'string', 'min:2'],
            'symptoms' => ['nullable', 'string', 'min:2'],
            'allergies' => ['nullable', 'string', 'min:2'],
            'reason' => ['nullable', 'string', 'min:2'],
            'days' => ['nullable', 'numeric', 'min:1'],
            'description' => ['nullable', 'string', 'min:2'],
        ];

        $this->validate($request, $rules, [], []);

        if($request->type == 'sick') {
            // dd($request->all());
            Leave::create([
                'leaveID' => $this->generateLeaveID(),
                'studentID' => $request->studentID,
                'type' => $request->type,
                'symptoms' => $request->symptoms,
                'allergies' => $request->allergies,
                'description' => $request->description
            ]);

            $message = "Sick leave request successful";
        } else {
            Leave::create([
                'leaveID' => $this->generateLeaveID(),
                'studentID' => $request->studentID,
                'type' => $request->type,
                'reason' => $request->reason,
                'days' => $request->days,
                'description' => $request->description
            ]);

            $message = "Alternative leave request successful";
        }

        $payload = [
            'studentID' => Auth::id(),
            'status' => 'pending'
        ];

        return $this->successResponse($payload, $message);
    }

    public function requestOtherLeave(Request $request) {
        
    }

    public function generateLeaveID()
    {
        $charset = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 7;
        $input_length = strlen($charset);
        $random_string = '';

        for ($i = 0; $i < $length; $i++) {
            $random_character = $charset[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return 'LID' . $random_string;
    }
}
