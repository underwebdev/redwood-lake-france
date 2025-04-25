<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Jobs\SendPaymentReminder;
use App\Jobs\SendOverdueReminder;
use App\Jobs\SendGuestReminder;
use App\Jobs\SendWelcomeEmail;
use App\Jobs\SendReviewRequest;
use Carbon\Carbon;

class SendBookingNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-booking-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bookings = Booking::where('arrival', '>', Carbon::today())->get();

        // check bookings in advance
        foreach($bookings as $booking)
        {
            if($booking->payments()->where('status', 1)->sum('total') < $booking->total)
            {
                $balancedue = Carbon::parse($booking->arrival)->subDays($booking->priceguide->due);

                // check for bookings 1 week from balance due and total less than booking
                if($balancedue->copy()->subDays(7)->isToday())
                {
                    \Log::info('Booking #' . $booking->id . ' send payment reminder 7 days before');
                    SendPaymentReminder::dispatch($booking);
                }

                // check for bookings 3 days away from balance due and payments total less than booking
                if($balancedue->copy()->subDays(3)->isToday())
                {
                    \Log::info('Booking #' . $booking->id . ' send payment reminder 3 days before');
                    SendPaymentReminder::dispatch($booking);
                }

                // check for bookings the day of balance due 
                if($balancedue->isToday())
                {
                    \Log::info('Booking #' . $booking->id . ' send final payment reminder');

                    SendPaymentReminder::dispatch($booking);
                }

                // check for bookings past due date
                if($balancedue->copy()->isPast())
                {
                    if($booking->maillogs()->where('type', 'overdue')->where('sent', '>', Carbon::now()->subDays(3))->doesntExist())
                    {
                        \Log::info('Booking #' . $booking->id . ' send overdue reminder'); 

                        SendOverdueReminder::dispatch($booking);
                    }
                } 
            }

            if($booking->payments()->where('status', 1)->sum('total') >= $booking->total)
            {
                $totalGuests = $booking->guests->count() + 1;
                $eightWeeksAway = Carbon::parse($booking->arrival)->subWeeks(8);
                $sevenDaysAway = Carbon::parse($booking->arrival)->subDays(7);

                // Check if guests are not added and it's 8 weeks away
                if($totalGuests < $booking->anglers && $eightWeeksAway->isPast() && Carbon::parse($booking->arrival)->isFuture())
                {
                    if($booking->maillogs()->where('type', 'guest-info')->where('sent', '>', Carbon::now()->subDays(7))->doesntExist()) 
                    {
                        \Log::info('Booking #' . $booking->id . ' send guest details reminder');
                        SendGuestReminder::dispatch($booking);
                    }

                }

                // Check if arrival is 7 days away for the welcome email
                if($sevenDaysAway->isToday())
                {
                    if($booking->maillogs()->where('type', 'welcome')->doesntExist()) 
                    {
                        \Log::info('Booking #' . $booking->id . ' send welcome email');

                        SendWelcomeEmail::dispatch($booking);
                    }
                }
            }
        }

        // check booking departed 7 days ago and feedback request not sent 
        $departures = Booking::whereDate('departure', Carbon::now()->subdays(7))->get();

        foreach($departures as $departure)
        {
            if($departure->maillogs()->where('type', 'feedback')->doesntExist())
            {
                \Log::info('Booking #' . $departure->id . ' Feedback request');

                SendReviewRequest::dispatch($booking);
            }
        } 

        return Command::SUCCESS;
    }
}
