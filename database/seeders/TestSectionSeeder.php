<?php

namespace Database\Seeders;

use App\Models\Test;
use App\Models\TestSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tests = Test::all();

        foreach ($tests as $test) {
            $sections = $this->getSectionsForTestType($test->type, $test->id);
            
            foreach ($sections as $sectionData) {
                TestSection::create($sectionData);
            }
        }

        $this->command->info('Created test sections for all 20 tests');
    }

    private function getSectionsForTestType(string $testType, int $testId): array
    {
        switch ($testType) {
            case 'listening':
                return [
                    [
                        'test_id' => $testId,
                        'name' => 'Part 1',
                        'description' => 'Conversation between two people in an everyday social context',
                        'order' => 1,
                        'time_limit_minutes' => 10,
                        'instructions' => [
                            'Listen to the conversation and answer questions 1-10.',
                            'You will hear the recording only once.',
                            'Write your answers on the answer sheet.'
                        ],
                        'is_active' => true,
                    ],
                    [
                        'test_id' => $testId,
                        'name' => 'Part 2',
                        'description' => 'Monologue set in an everyday social context',
                        'order' => 2,
                        'time_limit_minutes' => 10,
                        'instructions' => [
                            'Listen to the monologue and answer questions 11-20.',
                            'You will hear the recording only once.',
                            'Write your answers on the answer sheet.'
                        ],
                        'is_active' => true,
                    ],
                    [
                        'test_id' => $testId,
                        'name' => 'Part 3',
                        'description' => 'Conversation between up to four people set in an educational or training context',
                        'order' => 3,
                        'time_limit_minutes' => 10,
                        'instructions' => [
                            'Listen to the conversation and answer questions 21-30.',
                            'You will hear the recording only once.',
                            'Write your answers on the answer sheet.'
                        ],
                        'is_active' => true,
                    ],
                    [
                        'test_id' => $testId,
                        'name' => 'Part 4',
                        'description' => 'Monologue on an academic subject',
                        'order' => 4,
                        'time_limit_minutes' => 10,
                        'instructions' => [
                            'Listen to the lecture and answer questions 31-40.',
                            'You will hear the recording only once.',
                            'Write your answers on the answer sheet.'
                        ],
                        'is_active' => true,
                    ],
                ];

            case 'reading':
                return [
                    [
                        'test_id' => $testId,
                        'name' => 'Passage 1',
                        'description' => 'General interest text about everyday topics',
                        'order' => 1,
                        'time_limit_minutes' => 20,
                        'instructions' => [
                            'Read the passage and answer questions 1-13.',
                            'Choose the correct letter, A, B, C or D.',
                            'Write your answers on the answer sheet.'
                        ],
                        'is_active' => true,
                    ],
                    [
                        'test_id' => $testId,
                        'name' => 'Passage 2',
                        'description' => 'Workplace or training context text',
                        'order' => 2,
                        'time_limit_minutes' => 20,
                        'instructions' => [
                            'Read the passage and answer questions 14-27.',
                            'Choose the correct letter, A, B, C or D.',
                            'Write your answers on the answer sheet.'
                        ],
                        'is_active' => true,
                    ],
                    [
                        'test_id' => $testId,
                        'name' => 'Passage 3',
                        'description' => 'Academic text with complex ideas and arguments',
                        'order' => 3,
                        'time_limit_minutes' => 20,
                        'instructions' => [
                            'Read the passage and answer questions 28-40.',
                            'Choose the correct letter, A, B, C or D.',
                            'Write your answers on the answer sheet.'
                        ],
                        'is_active' => true,
                    ],
                ];

            case 'writing':
                return [
                    [
                        'test_id' => $testId,
                        'name' => 'Task 1',
                        'description' => 'Describe visual information (chart, graph, diagram, or table)',
                        'order' => 1,
                        'time_limit_minutes' => 20,
                        'instructions' => [
                            'Write at least 150 words.',
                            'Spend about 20 minutes on this task.',
                            'Summarize the information by selecting and reporting the main features.',
                            'Make comparisons where relevant.'
                        ],
                        'is_active' => true,
                    ],
                    [
                        'test_id' => $testId,
                        'name' => 'Task 2',
                        'description' => 'Write an essay in response to a point of view, argument, or problem',
                        'order' => 2,
                        'time_limit_minutes' => 40,
                        'instructions' => [
                            'Write at least 250 words.',
                            'Spend about 40 minutes on this task.',
                            'Give reasons for your answer and include any relevant examples.',
                            'Write in a formal style.'
                        ],
                        'is_active' => true,
                    ],
                ];

            case 'speaking':
                return [
                    [
                        'test_id' => $testId,
                        'name' => 'Part 1',
                        'description' => 'Introduction and interview about familiar topics',
                        'order' => 1,
                        'time_limit_minutes' => 5,
                        'instructions' => [
                            'The examiner will ask you questions about yourself.',
                            'Answer the questions naturally and in detail.',
                            'This part lasts 4-5 minutes.'
                        ],
                        'is_active' => true,
                    ],
                    [
                        'test_id' => $testId,
                        'name' => 'Part 2',
                        'description' => 'Individual long turn - speak about a given topic',
                        'order' => 2,
                        'time_limit_minutes' => 4,
                        'instructions' => [
                            'You will be given a task card with a topic.',
                            'You have 1 minute to prepare.',
                            'Speak for 1-2 minutes on the topic.',
                            'The examiner may ask 1-2 follow-up questions.'
                        ],
                        'is_active' => true,
                    ],
                    [
                        'test_id' => $testId,
                        'name' => 'Part 3',
                        'description' => 'Two-way discussion about abstract ideas related to Part 2',
                        'order' => 3,
                        'time_limit_minutes' => 5,
                        'instructions' => [
                            'The examiner will ask more abstract questions.',
                            'Discuss ideas and opinions in detail.',
                            'This part lasts 4-5 minutes.'
                        ],
                        'is_active' => true,
                    ],
                ];

            default:
                return [];
        }
    }
}
