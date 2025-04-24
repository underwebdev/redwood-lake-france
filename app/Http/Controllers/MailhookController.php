<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingMailLog;
use Carbon\Carbon;

class MailhookController extends Controller
{
    public function handle(Request $request)
    {
        $event = $request['event-data']['event'];
        $id = $request['event-data']['message']['headers']['message-id'];
        $timestamp = Carbon::parse($request['event-data']['timestamp'])->toDateTimeString();

        if(BookingMailLog::where('webhook_id', $id)->exists())
        {
            $record = BookingMailLog::where('webhook_id', $id)->first();

            if($event == 'delivered')
            {
                $record->update([
                    'delivered' => $timestamp
                ]);

            }

            if($event == 'opened' && $record->opened == Null)
            {
                $record->update([
                    'opened' => $timestamp
                ]);

            }

        }
    }
}
