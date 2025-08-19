<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Faq;

class UpdateFaqTranslations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-faq-translations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update FAQ translations with English content';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // FAQ 1
        $faq1 = Faq::find(1);
        if ($faq1) {
            $faq1->translations = [
                'en' => [
                    'question' => 'What is the TRPL Study Program?',
                    'answer' => 'The Software Engineering Technology (TRPL) Study Program is a higher education program that focuses on software development, from design, implementation, testing, to maintenance. We equip students with practical and theoretical skills to become professionals in the field of software engineering.'
                ]
            ];
            $faq1->save();
            $this->info("Updated FAQ 1 translations");
        }

        // FAQ 2
        $faq2 = Faq::find(2);
        if ($faq2) {
            $faq2->translations = [
                'en' => [
                    'question' => 'What are the job prospects for TRPL graduates?',
                    'answer' => 'TRPL graduates have very bright job prospects in this digital era. They can have careers as Software Engineers, Web Developers, Mobile App Developers, Quality Assurance Engineers, Data Scientists, DevOps Engineers, and various other roles in the ever-growing technology industry.'
                ]
            ];
            $faq2->save();
            $this->info("Updated FAQ 2 translations");
        }

        // FAQ 3
        $faq3 = Faq::find(3);
        if ($faq3) {
            $faq3->translations = [
                'en' => [
                    'question' => 'What are the advantages of studying TRPL at Politeknik Negeri Banyuwangi?',
                    'answer' => 'Our advantages include an industry-based curriculum, modern laboratory facilities, experienced lecturers in their fields, and a mandatory internship program that allows students to gain real work experience before graduation. We also have close partnerships with leading technology companies.'
                ]
            ];
            $faq3->save();
            $this->info("Updated FAQ 3 translations");
        }

        // FAQ 4
        $faq4 = Faq::find(4);
        if ($faq4) {
            $faq4->translations = [
                'en' => [
                    'question' => 'Are there scholarships available for TRPL students?',
                    'answer' => 'Yes, Politeknik Negeri Banyuwangi provides various types of scholarships, both from the government and private entities, which can be applied for by TRPL students. More information about types of scholarships, requirements, and application procedures can be accessed through the student affairs department.'
                ]
            ];
            $faq4->save();
            $this->info("Updated FAQ 4 translations");
        }

        // FAQ 5
        $faq5 = Faq::find(5);
        if ($faq5) {
            $faq5->translations = [
                'en' => [
                    'question' => 'How to contact the TRPL Study Program?',
                    'answer' => 'You can contact us via email at trpl@poliwangi.ac.id or by phone at (0333) 636780. You can also visit our campus at Jl. Raya Jember - Banyuwangi KM.13, Labanasem, Kabat, Banyuwangi.'
                ]
            ];
            $faq5->save();
            $this->info("Updated FAQ 5 translations");
        }

        $this->info("All FAQ translations updated successfully!");
    }
}
