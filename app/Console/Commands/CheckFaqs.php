<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Faq;

class CheckFaqs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-faqs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check FAQ data and translations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $faqs = Faq::all();
        
        foreach ($faqs as $faq) {
            $this->info("FAQ ID: " . $faq->id);
            $this->info("Question (ID): " . $faq->question);
            $this->info("Answer (ID): " . $faq->answer);
            $this->info("Translations: " . json_encode($faq->translations));
            $this->info("---");
        }
        
        $this->info("Total FAQs: " . $faqs->count());
    }
}
