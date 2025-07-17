<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Assignment;
use App\Models\Question;
use App\Models\Choice;
use Faker\Factory as Faker;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Create 5 sample assignments
        for ($i = 0; $i < 5; $i++) {
            $totalMarks = 0;
            $assignment = Assignment::create([
                'title' => $faker->sentence(4),
                'description' => $faker->paragraph,
                'total_marks' => 0, // Will be updated later
            ]);

            // Create 5-10 questions per assignment
            $numQuestions = rand(5, 10);
            for ($j = 0; $j < $numQuestions; $j++) {
                $marks = rand(5, 10); // Random marks between 5 and 10
                $totalMarks += $marks;

                $question = Question::create([
                    'assignment_id' => $assignment->id,
                    'question_text' => $faker->sentence(6) . '?',
                    'marks' => $marks,
                ]);

                // Create 4 choices per question
                $choices = [];
                $correctChoiceIndex = rand(0, 3); // Randomly select one correct choice
                for ($k = 0; $k < 4; $k++) {
                    $choices[] = [
                        'question_id' => $question->id,
                        'choice_text' => $faker->sentence(3),
                        'is_correct' => $k === $correctChoiceIndex,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                Choice::insert($choices);
            }

            // Update total marks for the assignment
            $assignment->update(['total_marks' => $totalMarks]);
        }
    }
}
