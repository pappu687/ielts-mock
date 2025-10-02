<?php

namespace Database\Seeders;

use App\Models\TestSection;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = TestSection::with('test')->get();

        foreach ($sections as $section) {
            $questions = $this->getQuestionsForSection($section);
            
            foreach ($questions as $questionData) {
                Question::create($questionData);
            }
        }

        $this->command->info('Created comprehensive questions for all test sections');
    }

    private function getQuestionsForSection(TestSection $section): array
    {
        $testType = $section->test->type;
        $questions = [];

        switch ($testType) {
            case 'listening':
                $questions = $this->getListeningQuestions($section);
                break;
            case 'reading':
                $questions = $this->getReadingQuestions($section);
                break;
            case 'writing':
                $questions = $this->getWritingQuestions($section);
                break;
            case 'speaking':
                $questions = $this->getSpeakingQuestions($section);
                break;
        }

        return $questions;
    }

    private function getListeningQuestions(TestSection $section): array
    {
        $questions = [];
        $questionCount = 10;
        $startQuestion = ($section->order - 1) * 10 + 1;

        for ($i = 1; $i <= $questionCount; $i++) {
            $questionNum = $startQuestion + $i - 1;
            $questionType = $this->getRandomListeningQuestionType();
            
            $questions[] = [
                'question_bank_id' => null,
                'test_section_id' => $section->id,
                'question_type_new' => $questionType,
                'question_text' => "Question {$questionNum}: Listen to the audio and answer the question.",
                'content' => [],
                'options' => $this->getListeningOptions($questionType),
                'correct_answers' => $this->getListeningCorrectAnswers($questionType),
                'explanation' => 'Listen carefully to the audio and select the correct answer.',
                'hint' => 'Pay attention to keywords and context clues.',
                'points' => 1,
                'order' => $i,
                'difficulty_level' => $this->getRandomDifficulty(),
                'estimated_time' => 60,
                'audio_segments' => $this->getAudioSegments($section->order, $i),
            ];
        }

        return $questions;
    }

    private function getReadingQuestions(TestSection $section): array
    {
        $questions = [];
        $questionCount = $section->name === 'Passage 1' ? 13 : 
                       ($section->name === 'Passage 2' ? 14 : 13);
        $startQuestion = $section->name === 'Passage 1' ? 1 : 
                        ($section->name === 'Passage 2' ? 14 : 28);

        for ($i = 1; $i <= $questionCount; $i++) {
            $questionNum = $startQuestion + $i - 1;
            $questionType = $this->getRandomReadingQuestionType();
            
            $questions[] = [
                'question_bank_id' => null,
                'test_section_id' => $section->id,
                'question_type_new' => $questionType,
                'question_text' => "Question {$questionNum}: Read the passage and answer the question.",
                'content' => [],
                'options' => $this->getReadingOptions($questionType),
                'correct_answers' => $this->getReadingCorrectAnswers($questionType),
                'explanation' => 'Read the passage carefully and find the supporting information.',
                'hint' => 'Look for specific details and keywords in the text.',
                'points' => 1,
                'order' => $i,
                'difficulty_level' => $this->getRandomDifficulty(),
                'estimated_time' => 90,
                'audio_segments' => [],
            ];
        }

        return $questions;
    }

    private function getWritingQuestions(TestSection $section): array
    {
        return [
            [
                'question_bank_id' => null,
                'test_section_id' => $section->id,
                'question_type_new' => 'essay',
                'question_text' => $section->name === 'Task 1' 
                    ? 'Describe the visual information provided.' 
                    : 'Write an essay responding to the given prompt.',
                'content' => [],
                'options' => [],
                'correct_answers' => [],
                'explanation' => 'Follow the task requirements and provide clear examples.',
                'hint' => $section->name === 'Task 1' ? 'Write at least 150 words.' : 'Write at least 250 words.',
                'points' => $section->name === 'Task 1' ? 1 : 2,
                'order' => 1,
                'difficulty_level' => $section->name === 'Task 1' ? 'medium' : 'hard',
                'estimated_time' => $section->name === 'Task 1' ? 1200 : 2400,
                'audio_segments' => [],
            ]
        ];
    }

    private function getSpeakingQuestions(TestSection $section): array
    {
        $questions = [];
        
        if ($section->name === 'Part 1') {
            $topics = ['hometown', 'work', 'hobbies', 'food', 'travel'];
            foreach ($topics as $index => $topic) {
                $questions[] = [
                    'question_bank_id' => null,
                    'test_section_id' => $section->id,
                    'question_type_new' => 'speaking_topic',
                    'question_text' => "Tell me about your {$topic}.",
                    'content' => [],
                    'options' => [],
                    'correct_answers' => [],
                    'explanation' => 'Speak naturally and provide detailed answers.',
                    'hint' => 'Give personal examples and expand on your answers.',
                    'points' => 1,
                    'order' => $index + 1,
                    'difficulty_level' => 'easy',
                    'estimated_time' => 60,
                    'audio_segments' => [],
                ];
            }
        } elseif ($section->name === 'Part 2') {
            $questions[] = [
                'question_bank_id' => null,
                'test_section_id' => $section->id,
                'question_type_new' => 'speaking_topic',
                'question_text' => "Describe a memorable event in your life.",
                'content' => [],
                'options' => [],
                'correct_answers' => [],
                'explanation' => 'Speak for 1-2 minutes on the topic.',
                'hint' => 'Use the preparation time wisely.',
                'points' => 2,
                'order' => 1,
                'difficulty_level' => 'medium',
                'estimated_time' => 120,
                'audio_segments' => [],
            ];
        } else { // Part 3
            $topics = ['technology', 'education', 'environment', 'society'];
            foreach ($topics as $index => $topic) {
                $questions[] = [
                    'question_bank_id' => null,
                    'test_section_id' => $section->id,
                    'question_type_new' => 'speaking_topic',
                    'question_text' => "Discuss {$topic} in detail.",
                    'content' => [],
                    'options' => [],
                    'correct_answers' => [],
                    'explanation' => 'Provide thoughtful analysis and examples.',
                    'hint' => 'Give detailed answers with personal opinions.',
                    'points' => 1,
                    'order' => $index + 1,
                    'difficulty_level' => 'hard',
                    'estimated_time' => 90,
                    'audio_segments' => [],
                ];
            }
        }

        return $questions;
    }

    // Helper methods
    private function getRandomListeningQuestionType(): string
    {
        $types = ['mcq', 'fill_blank', 'note_completion', 'table_completion', 'sentence_completion'];
        return $types[array_rand($types)];
    }

    private function getRandomReadingQuestionType(): string
    {
        $types = ['mcq', 'true_false', 'fill_blank', 'matching', 'summary_completion'];
        return $types[array_rand($types)];
    }

    private function getRandomDifficulty(): string
    {
        $difficulties = ['easy', 'medium', 'hard'];
        return $difficulties[array_rand($difficulties)];
    }

    private function getListeningOptions(string $type): array
    {
        if ($type === 'mcq') {
            return [
                'A. Option A',
                'B. Option B', 
                'C. Option C',
                'D. Option D'
            ];
        }
        return [];
    }

    private function getReadingOptions(string $type): array
    {
        if ($type === 'mcq') {
            return [
                'A. Option A',
                'B. Option B',
                'C. Option C',
                'D. Option D'
            ];
        }
        return [];
    }

    private function getListeningCorrectAnswers(string $type): array
    {
        if ($type === 'mcq') {
            return ['mcq' => 1]; // Option A
        } elseif ($type === 'fill_blank') {
            return ['fill_blank' => 'Sample Answer'];
        }
        return [];
    }

    private function getReadingCorrectAnswers(string $type): array
    {
        if ($type === 'mcq') {
            return ['mcq' => 2]; // Option B
        } elseif ($type === 'true_false') {
            return ['true_false' => 'true'];
        }
        return [];
    }

    private function getAudioSegments(int $sectionOrder, int $questionOrder): array
    {
        $startTime = ($sectionOrder - 1) * 600 + ($questionOrder - 1) * 30;
        return [
            [
                'start' => gmdate('i:s', $startTime),
                'end' => gmdate('i:s', $startTime + 30)
            ]
        ];
    }
}
