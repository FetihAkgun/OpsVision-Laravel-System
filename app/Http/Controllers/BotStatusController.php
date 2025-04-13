<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BotStatusController extends Controller
{
    public function reportStatus(Request $request)
    {
        // Convert string boolean values to actual boolean
        if ($request->has('is_operational')) {
            $isOperational = $request->input('is_operational');
            if (is_string($isOperational)) {
                $request->merge(['is_operational' => $isOperational === 'true' || $isOperational === '1']);
            }
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'service_id' => 'required|exists:services,id',
            'is_operational' => 'required|boolean',
            'response_time' => 'nullable|numeric',
            'status_code' => 'nullable|integer',
            'response_data' => 'nullable|array',
            'error_message' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Get the service
        $service = Service::findOrFail($request->service_id);

        // Create a new status record
        $status = ServiceStatus::create([
            'service_id' => $service->id,
            'is_operational' => $request->is_operational,
            'response_time' => $request->response_time,
            'status_code' => $request->status_code,
            'response_data' => $request->response_data,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Status reported successfully',
            'data' => $status
        ]);
    }
} 