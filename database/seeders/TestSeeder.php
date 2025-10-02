<?php

namespace Database\Seeders;

use App\Models\Test;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@ielts-mock.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => bcrypt('password'),
            ]
        );

        $tests = [
            // Listening Tests (5 tests)
            [
                'name' => 'IELTS Listening Practice Test 1',
                'type' => 'listening',
                'description' => 'Complete listening test with 4 parts covering everyday conversations and academic lectures.',
                'duration_minutes' => 40,
            ],
            [
                'name' => 'IELTS Listening Practice Test 2',
                'type' => 'listening',
                'description' => 'Advanced listening test focusing on workplace scenarios and scientific discussions.',
                'duration_minutes' => 40,
            ],
            [
                'name' => 'IELTS Listening Practice Test 3',
                'type' => 'listening',
                'description' => 'Comprehensive listening assessment with social and academic contexts.',
                'duration_minutes' => 40,
            ],
            [
                'name' => 'IELTS Listening Practice Test 4',
                'type' => 'listening',
                'description' => 'Professional listening test with business and educational content.',
                'duration_minutes' => 40,
            ],
            [
                'name' => 'IELTS Listening Practice Test 5',
                'type' => 'listening',
                'description' => 'Challenging listening test with complex academic and social interactions.',
                'duration_minutes' => 40,
            ],

            // Reading Tests (5 tests)
            [
                'name' => 'IELTS Reading Practice Test 1',
                'type' => 'reading',
                'description' => 'General reading test with passages about technology, environment, and culture.',
                'duration_minutes' => 60,
            ],
            [
                'name' => 'IELTS Reading Practice Test 2',
                'type' => 'reading',
                'description' => 'Academic reading test focusing on scientific research and historical events.',
                'duration_minutes' => 60,
            ],
            [
                'name' => 'IELTS Reading Practice Test 3',
                'type' => 'reading',
                'description' => 'Professional reading test with business and workplace scenarios.',
                'duration_minutes' => 60,
            ],
            [
                'name' => 'IELTS Reading Practice Test 4',
                'type' => 'reading',
                'description' => 'Comprehensive reading assessment covering diverse topics and question types.',
                'duration_minutes' => 60,
            ],
            [
                'name' => 'IELTS Reading Practice Test 5',
                'type' => 'reading',
                'description' => 'Advanced reading test with complex passages and challenging questions.',
                'duration_minutes' => 60,
            ],

            // Writing Tests (5 tests)
            [
                'name' => 'IELTS Writing Practice Test 1',
                'type' => 'writing',
                'description' => 'General writing test with chart description and opinion essay tasks.',
                'duration_minutes' => 60,
            ],
            [
                'name' => 'IELTS Writing Practice Test 2',
                'type' => 'writing',
                'description' => 'Academic writing test with graph analysis and argumentative essays.',
                'duration_minutes' => 60,
            ],
            [
                'name' => 'IELTS Writing Practice Test 3',
                'type' => 'writing',
                'description' => 'Professional writing assessment with process description and discussion essays.',
                'duration_minutes' => 60,
            ],
            [
                'name' => 'IELTS Writing Practice Test 4',
                'type' => 'writing',
                'description' => 'Comprehensive writing test with multiple task types and essay formats.',
                'duration_minutes' => 60,
            ],
            [
                'name' => 'IELTS Writing Practice Test 5',
                'type' => 'writing',
                'description' => 'Advanced writing test with complex visual data and challenging essay topics.',
                'duration_minutes' => 60,
            ],

            // Speaking Tests (5 tests)
            [
                'name' => 'IELTS Speaking Practice Test 1',
                'type' => 'speaking',
                'description' => 'General speaking test covering personal topics and everyday conversations.',
                'duration_minutes' => 14,
            ],
            [
                'name' => 'IELTS Speaking Practice Test 2',
                'type' => 'speaking',
                'description' => 'Academic speaking test with educational and professional topics.',
                'duration_minutes' => 14,
            ],
            [
                'name' => 'IELTS Speaking Practice Test 3',
                'type' => 'speaking',
                'description' => 'Professional speaking assessment with business and workplace scenarios.',
                'duration_minutes' => 14,
            ],
            [
                'name' => 'IELTS Speaking Practice Test 4',
                'type' => 'speaking',
                'description' => 'Comprehensive speaking test with diverse topics and question formats.',
                'duration_minutes' => 14,
            ],
            [
                'name' => 'IELTS Speaking Practice Test 5',
                'type' => 'speaking',
                'description' => 'Advanced speaking test with complex topics and challenging questions.',
                'duration_minutes' => 14,
            ],
        ];

        foreach ($tests as $testData) {
            Test::create([
                'name' => $testData['name'],
                'type' => $testData['type'],
                'description' => $testData['description'],
                'duration_minutes' => $testData['duration_minutes'],
                'is_active' => true,
                'created_by' => $admin->id,
                'settings' => [
                    'auto_save' => true,
                    'allow_review' => true,
                    'show_timer' => true,
                    'randomize_questions' => false,
                ],
            ]);
        }

        $this->command->info('Created 20 IELTS practice tests with all types (listening, reading, writing, speaking)');
    }
}
