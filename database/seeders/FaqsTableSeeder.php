<?php
namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqsTableSeeder extends Seeder
{
    public function run(): void
    {
        Faq::create(['question' => 'How do I book an appointment?', 'answer' => 'You can book online via our appointment page or call our hotline.', 'order' => 1]);
        Faq::create(['question' => 'What insurances do you accept?', 'answer' => 'We accept most major insurance providers.', 'order' => 2]);
    }
}
