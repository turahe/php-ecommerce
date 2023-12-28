<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessMidtransWebhookJob;
use Illuminate\Http\Request;

class MidtransNotificationController extends Controller
{
    public function __invoke(Request $request)
    {
        ProcessMidtransWebhookJob::dispatch($request->all());

        return response()->json(['success' => true]);
    }
}
