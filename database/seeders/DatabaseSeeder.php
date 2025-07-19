<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Assignment;
use App\Models\Question;
use App\Models\Choice;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'status' => 'approved', // Fixed typo
        ]);

        // Create students (users)
        $students = User::factory()->count(5)->create([
            'role' => 'user',
            'status' => 'approved',
        ]);

        // Create assignment
        $assignment = Assignment::factory()->create([
            'create_by' => $admin->id,
        ]);

        // Assign students
        $assignment->students()->attach($students->pluck('id'));

        // Create questions
        $questions = Question::factory()->count(3)->create([
            'assignment_id' => $assignment->id,
        ]);

        // Create choices for each question
        foreach ($questions as $question) {
            foreach (['A', 'B', 'C'] as $option) {
                Choice::factory()->create([
                    'question_id' => $question->id,
                    'option' => $option,
                    'option_text' => "Option $option",
                ]);
            }
    }
    }
}
