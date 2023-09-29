<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\QRCode as Code;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends APIBaseController
{

    public function igniteAttendance(Request $request) {
        $classCode = $this->generateAttendanceCode();

        Code::create([
            'codeID' => $classCode,
            'staffID' => 'AID8W76G1M',
        ]);

        $link = secure_url('/api/mark-as-present', [$classCode]);

        return view('ignite')->with('qrcode', 
            QrCode::size(300)
                ->format('svg')
                ->style('round')
                ->errorCorrection('M')
                ->generate($link)
        );
    }

    public function takeAttendance() {
        
    }

    public function markAsPresent($code, $student) {
        $rules = [
            'code' => ['required', 'string', 'min:8', 'max:10', 'exists:qrcodes,codeID'],
            'student' => ['required', 'string', 'min:2', 'max:10', 'exists:student,studentID'],
        ];

        $messages = [
            'code.required' => 'The code field is required.',
            'code.min' => 'The code must be at least 8 characters.',
            'code.max' => 'The code may not be greater than 10 characters.',
            'student.required' => 'The student field is required.',
            'student.min' => 'The student must be at least 2 characters.',
            'student.max' => 'The student may not be greater than 10 characters.', // Modify the message as needed
        ];
    
        // Create a validator instance
        $validator = Validator::make(['code' => $code, 'student' => $student], $rules, $messages);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Attendance::create([
            'codeID' => $code,
            'studentID' => $student
        ]);

        $payload = [
            'studentID' => Auth::id()
        ];

        return $this->successResponse($payload, "Marked present");
    }

    public function generateAttendanceCode()
    {
        $charset = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = 10;
        $input_length = strlen($charset);
        $random_string = '';

        for ($i = 0; $i < $length; $i++) {
            $random_character = $charset[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }
}
