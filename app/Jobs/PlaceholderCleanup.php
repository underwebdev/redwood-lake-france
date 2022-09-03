<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Placeholder;

class PlaceholderCleanup implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $placeholder;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Placeholder $placeholder)
    {
        $this->placeholder = $placeholder;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->placeholder->delete();
    }
}
