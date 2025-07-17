@extends('admin.layout.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Page Title -->
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Edit Assignment</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Edit Form -->
    <form action="{{ route('assignments.update', $assignment) }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        @method('PUT')

        <!-- Title Field -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" name="title" id="title" value="{{ $assignment->title }}"
                   class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                   required>
        </div>

        <!-- Description Field -->
        <div class="mb-6">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="description" id="description"
                      class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                      rows="5">{{ $assignment->description }}</textarea>
        </div>

        <!-- Assign Students -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Assign Students</label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach ($students as $student)
                    <div class="flex items-center">
                        <input type="checkbox" name="students[]" value="{{ $student->id }}"
                               id="student-{{ $student->id }}"
                               {{ $assignment->students->contains($student->id) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="student-{{ $student->id }}"
                               class="ml-2 text-sm text-gray-700">{{ $student->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Questions Container -->
        <div id="questions-container" class="mb-6">
            @foreach ($assignment->questions as $index => $question)
                <div class="question mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Question {{ $index + 1 }}</h3>

                    <!-- Question Text -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Question Text</label>
                        <input type="text" name="questions[{{ $index }}][question_text]"
                               value="{{ $question->question_text }}"
                               class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <!-- Correct Answer -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Correct Answer</label>
                        <select name="questions[{{ $index }}][correct_answer]"
                                class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                            <option value="A" {{ $question->correct_answer == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ $question->correct_answer == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ $question->correct_answer == 'C' ? 'selected' : '' }}>C</option>
                        </select>
                    </div>

                    <!-- Choices -->
                    <div class="choices">
                        @foreach ($question->choices as $choice)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Option {{ $choice->option }}</label>
                                <input type="text"
                                       name="questions[{{ $index }}][choices][{{ $choice->option == 'A' ? 0 : ($choice->option == 'B' ? 1 : 2) }}][option_text]"
                                       value="{{ $choice->option_text }}"
                                       class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       required>
                                <input type="hidden"
                                       name="questions[{{ $index }}][choices][{{ $choice->option == 'A' ? 0 : ($choice->option == 'B' ? 1 : 2) }}][option]"
                                       value="{{ $choice->option }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Buttons -->
        <div class="flex space-x-4">
            <button type="button" onclick="addQuestion()"
                    class="inline-block px-6 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-700 transition duration-200">
                Add Question
            </button>
            <button type="submit"
                    class="inline-block px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition duration-200">
                Update Assignment
            </button>
        </div>
    </form>

    <!-- JavaScript for Adding Questions -->
    <script>
        let questionCount = {{ $assignment->questions->count() }};

        function addQuestion() {
            questionCount++;
            const container = document.getElementById('questions-container');
            const questionDiv = document.createElement('div');
            questionDiv.className = 'question mb-6 p-4 bg-gray-50 rounded-lg border border-gray-200';
            questionDiv.innerHTML = `
                <h3 class="text-lg font-semibold text-gray-900 mb-3">Question ${questionCount}</h3>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Question Text</label>
                    <input type="text" name="questions[${questionCount}][question_text]"
                           class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           required>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Correct Answer</label>
                    <select name="questions[${questionCount}][correct_answer]"
                            class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>
                <div class="choices">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Option A</label>
                        <input type="text" name="questions[${questionCount}][choices][0][option_text]"
                               class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                        <input type="hidden" name="questions[${questionCount}][choices][0][option]" value="A">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Option B</label>
                        <input type="text" name="questions[${questionCount}][choices][1][option_text]"
                               class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                        <input type="hidden" name="questions[${questionCount}][choices][1][option]" value="B">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Option C</label>
                        <input type="text" name="questions[${questionCount}][choices][2][option_text]"
                               class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               required>
                        <input type="hidden" name="questions[${questionCount}][choices][2][option]" value="C">
                    </div>
                </div>
            `;
            container.appendChild(questionDiv);
        }
    </script>
</div>
@endsection