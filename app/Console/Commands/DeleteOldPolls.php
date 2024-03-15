<?php

namespace App\Console\Commands;

use App\Models\Poll;
use Illuminate\Console\Command;

class DeleteOldPolls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'c:polls:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete polls that are older than the end date.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Deleting old polls...');

        $polls = Poll::where('end_date', '<', now())->get();

        $polls->each->delete();

        $this->info('Old polls deleted successfully.');
    }
}
