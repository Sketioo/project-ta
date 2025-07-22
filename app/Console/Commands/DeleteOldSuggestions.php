<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteOldSuggestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-suggestions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete suggestions that are older than 1 month and have been read.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \App\Models\Suggestion::where('is_read', true)
            ->where('created_at', '<=', now()->subMonth())
            ->delete();

        $this->info('Old, read suggestions deleted successfully.');
    }
}
