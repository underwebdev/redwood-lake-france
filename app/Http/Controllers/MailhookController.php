<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookingMailLog;
use Carbon\Carbon;

class MailhookController extends Controller
{
    public function handle(Request $request)
    {
        $this->verifySignature($request);
        
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

    protected function verifySignature(Request $request)
    {
        $timestamp = $request->header('X-Mailgun-Timestamp');
        $token     = $request->header('X-Mailgun-Token');
        $signature = $request->header('X-Mailgun-Signature');

        if (!$timestamp || !$token || !$signature) {
            abort(401, 'Missing Mailgun signature headers');
        }

        $signingKey = config('services.mailgun.webhook_signing_key');

        $hmac = hash_hmac('sha256', $timestamp . $token, $signingKey);

        if (!hash_equals($hmac, $signature)) {
            Log::warning('Invalid Mailgun webhook signature', [
                'ip' => $request->ip(),
            ]);
            abort(401, 'Invalid signature');
        }

        // Optional timestamp age check
        $age = time() - (int)$timestamp;
        if ($age > 900) { // 15 minutes
            abort(401, 'Timestamp too old');
        }

    }
}
