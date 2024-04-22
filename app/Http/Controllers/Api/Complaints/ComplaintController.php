<?php

namespace App\Http\Controllers\Api\Complaints;

use Exception;
use App\Models\Complaint;
use App\Http\Controllers\Controller;
use App\Http\Requests\Complaints\StoreComplaintRequestRequest;

class ComplaintController extends Controller
{
    //
    public function store(StoreComplaintRequestRequest $request)
    {
        try {
            $complaint = Complaint::create($request->validated());
            return response()->json([
                'id' => $complaint->id
            ], 201);
        } catch (Exception $exception) {
            //
            return response()->json(['message' => $exception->getMessage()], 400);
        }
    }
}
