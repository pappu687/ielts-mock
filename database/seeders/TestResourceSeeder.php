<?php

namespace Database\Seeders;

use App\Models\TestSection;
use App\Models\TestResource;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = TestSection::with('test')->get();

        foreach ($sections as $section) {
            $resources = $this->getResourcesForSection($section);
            
            foreach ($resources as $resourceData) {
                TestResource::create($resourceData);
            }
        }

        $this->command->info('Created test resources for all sections');
    }

    private function getResourcesForSection(TestSection $section): array
    {
        $testType = $section->test->type;
        $sectionName = $section->name;
        $resources = [];

        switch ($testType) {
            case 'listening':
                // Add audio resource for each listening section
                $resources[] = [
                    'test_section_id' => $section->id,
                    'type' => 'audio',
                    'title' => "Audio Recording - {$sectionName}",
                    'file_path' => "audios/test_{$section->test_id}/section_{$section->id}.mp3",
                    'file_name' => "section_{$section->id}.mp3",
                    'mime_type' => 'audio/mpeg',
                    'file_size' => rand(2000000, 8000000), // 2-8 MB
                    'metadata' => [
                        'duration' => $section->time_limit_minutes * 60, // Convert to seconds
                        'bitrate' => 128,
                        'format' => 'mp3'
                    ],
                    'order' => 1,
                    'is_active' => true,
                ];

                // Add transcript for listening sections
                $resources[] = [
                    'test_section_id' => $section->id,
                    'type' => 'transcript',
                    'title' => "Transcript - {$sectionName}",
                    'content' => $this->generateListeningTranscript($section),
                    'order' => 2,
                    'is_active' => true,
                ];
                break;

            case 'reading':
                // Add passage content for each reading section
                $resources[] = [
                    'test_section_id' => $section->id,
                    'type' => 'passage',
                    'title' => "Reading Passage - {$sectionName}",
                    'content' => $this->generateReadingPassage($section),
                    'order' => 1,
                    'is_active' => true,
                ];
                break;

            case 'writing':
                if ($section->name === 'Task 1') {
                    // Add image/chart for writing task 1
                    $resources[] = [
                        'test_section_id' => $section->id,
                        'type' => 'image',
                        'title' => "Visual Data - {$sectionName}",
                        'file_path' => "images/writing/test_{$section->test_id}/task1_chart.png",
                        'file_name' => "task1_chart.png",
                        'mime_type' => 'image/png',
                        'file_size' => rand(500000, 2000000), // 500KB - 2MB
                        'metadata' => [
                            'width' => 800,
                            'height' => 600,
                            'format' => 'png'
                        ],
                        'order' => 1,
                        'is_active' => true,
                    ];
                }
                
                // Add prompt for both writing tasks
                $resources[] = [
                    'test_section_id' => $section->id,
                    'type' => 'prompt',
                    'title' => "Writing Prompt - {$sectionName}",
                    'content' => $this->generateWritingPrompt($section),
                    'order' => 2,
                    'is_active' => true,
                ];
                break;

            case 'speaking':
                // Add prompt/topic for speaking sections
                $resources[] = [
                    'test_section_id' => $section->id,
                    'type' => 'prompt',
                    'title' => "Speaking Topic - {$sectionName}",
                    'content' => $this->generateSpeakingPrompt($section),
                    'order' => 1,
                    'is_active' => true,
                ];
                break;
        }

        return $resources;
    }

    private function generateListeningTranscript(TestSection $section): string
    {
        $transcripts = [
            'Part 1' => "Good morning, welcome to our university campus tour. My name is Sarah, and I'll be your guide today. We'll start at the main entrance and visit the library, student center, and dormitories. Please feel free to ask any questions during our walk. The tour will last approximately 45 minutes.",
            
            'Part 2' => "The local community center is organizing a series of workshops next month. Topics include digital photography, creative writing, and cooking classes. Registration begins tomorrow at 9 AM. The cost is $25 per workshop, with discounts available for seniors and students. All materials are provided.",
            
            'Part 3' => "Professor: Today we're discussing renewable energy sources. Student A: I'm particularly interested in solar power. Professor: Excellent choice. Solar technology has advanced significantly in recent years. Student B: What about wind energy? Professor: Wind energy is also very promising, especially in coastal areas.",
            
            'Part 4' => "The study of ancient civilizations reveals fascinating insights into human development. Archaeological evidence suggests that early societies developed complex social structures and advanced technologies. These discoveries challenge our understanding of historical progress and cultural evolution."
        ];

        return $transcripts[$section->name] ?? "This is a sample transcript for {$section->name}.";
    }

    private function generateReadingPassage(TestSection $section): string
    {
        $passages = [
            'Passage 1' => "The Impact of Technology on Modern Society\n\nTechnology has revolutionized the way we live, work, and communicate. From smartphones to artificial intelligence, technological advances have created new opportunities while also presenting unique challenges. The digital age has transformed education, healthcare, and business practices worldwide.\n\nOne significant development is the rise of remote work, which has been accelerated by video conferencing tools and cloud computing. This shift has allowed companies to access global talent pools and has given employees more flexibility in their work arrangements.\n\nHowever, the rapid pace of technological change has also raised concerns about privacy, cybersecurity, and the digital divide between those who have access to technology and those who do not. As we continue to integrate technology into every aspect of our lives, it's crucial to address these challenges thoughtfully.",
            
            'Passage 2' => "Sustainable Energy Solutions for the Future\n\nAs the world faces increasing pressure from climate change, the search for sustainable energy solutions has become more urgent than ever. Renewable energy sources such as solar, wind, and hydroelectric power offer promising alternatives to fossil fuels.\n\nSolar energy has seen remarkable growth in recent years, with costs decreasing by over 80% since 2010. This makes it increasingly competitive with traditional energy sources. Wind energy has also made significant strides, particularly in offshore installations where wind speeds are higher and more consistent.\n\nDespite these advances, challenges remain. Energy storage technology needs further development to address the intermittent nature of renewable sources. Grid infrastructure must also be updated to accommodate distributed energy generation. Nevertheless, the transition to renewable energy represents one of the most important steps toward a sustainable future.",
            
            'Passage 3' => "The Psychology of Consumer Behavior\n\nUnderstanding consumer behavior is essential for businesses seeking to develop effective marketing strategies. Psychological research has revealed numerous factors that influence purchasing decisions, from emotional triggers to cognitive biases.\n\nOne key finding is the importance of social proof in consumer decision-making. People are more likely to purchase products that others have recommended or that appear popular. This phenomenon explains the effectiveness of customer reviews and social media marketing.\n\nAnother significant factor is the concept of loss aversion, where people feel the pain of losing something more acutely than the pleasure of gaining something of equivalent value. This psychological principle is often used in marketing through limited-time offers and scarcity tactics. By understanding these and other psychological principles, businesses can create more compelling and effective marketing campaigns."
        ];

        return $passages[$section->name] ?? "This is a sample reading passage for {$section->name}.";
    }

    private function generateWritingPrompt(TestSection $section): string
    {
        if ($section->name === 'Task 1') {
            return "The chart below shows the percentage of households in different income brackets in Country X from 2010 to 2020.\n\nSummarize the information by selecting and reporting the main features, and make comparisons where relevant.\n\nWrite at least 150 words.";
        } else {
            return "Some people believe that technology has made our lives more complicated, while others argue that it has simplified daily tasks.\n\nDiscuss both views and give your own opinion.\n\nGive reasons for your answer and include any relevant examples from your own knowledge or experience.\n\nWrite at least 250 words.";
        }
    }

    private function generateSpeakingPrompt(TestSection $section): string
    {
        $prompts = [
            'Part 1' => "Let's talk about your hometown.\n\n• Where do you come from?\n• What do you like most about your hometown?\n• Has your hometown changed much over the years?\n• Would you like to live there in the future?",
            
            'Part 2' => "Describe a memorable trip you have taken.\n\nYou should say:\n• where you went\n• who you went with\n• what you did there\n• and explain why this trip was memorable for you\n\nYou have one minute to prepare your answer.",
            
            'Part 3' => "Let's discuss travel and tourism.\n\n• How has tourism changed in your country over the past few decades?\n• What are the benefits and drawbacks of mass tourism?\n• Do you think technology will change the way people travel in the future?\n• How important is it to preserve local cultures in tourist destinations?"
        ];

        return $prompts[$section->name] ?? "This is a sample speaking prompt for {$section->name}.";
    }
}
