@extends('admin.layout.dashboard')

@section('content')
<section class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Create Assignment</h1>
    
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('assignments.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
            <input type="text" name="title" placeholder="Enter title" value="{{ old('title') }}" required 
                   class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
            <textarea name="description" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition h-32">{{ old('description') }}</textarea>
        </div>
        
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Assign Student</label>
            <div class="space-y-2">
                @foreach ($students as $student)
                    <div class="flex items-center">
                        <input type="checkbox" name="students[]" value="{{ $student->id }}" id="student-{{ $student->id }}"
                               {{ in_array($student->id, old('students', [])) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                        <label for="student-{{ $student->id }}" class="ml-2 text-sm text-gray-700">{{ $student->name }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div id="question-container" class="space-y-6">
            @if (old('questions'))
                @foreach (old('questions') as $index => $question)
                    <div class="question bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Question {{ $index + 1 }}</h3>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Question Text</label>
                            <input type="text" name="questions[{{ $index + 1 }}][question_text]" value="{{ $question['question_text'] ?? '' }}" required
                                   class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Correct Answer</label>
                            <select name="questions[{{ $index + 1 }}][correct_answer]" required
                                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                                <option value="A" {{ ($question['correct_answer'] ?? '') == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ ($question['correct_answer'] ?? '') == 'B' ? 'selected' : '' }}>B</option>
                                <option value="C" {{ ($question['correct_answer'] ?? '') == 'C' ? 'selected' : '' }}>C</option>
                            </select>
                        </div>
                        <div class="choices space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Option A</label>
                                <input type="hidden" name="questions[{{ $index + 1 }}][choices][0][option]" value="A">
                                <input type="text" name="questions[{{ $index + 1 }}][choices][0][option_text]" value="{{ $question['choices'][0]['option_text'] ?? '' }}" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Option B</label>
                                <input type="hidden" name="questions[{{ $index + 1 }}][choices][1][option]" value="B">
                                <input type="text" name="questions[{{ $index + 1 }}][choices][1][option_text]" value="{{ $question['choices'][1]['option_text'] ?? '' }}" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Option C</label>
                                <input type="hidden" name="questions[{{ $index + 1 }}][choices][2][option]" value="C">
                                <input type="text" name="questions[{{ $index + 1 }}][choices][2][option_text]" value="{{ $question['choices'][2]['option_text'] ?? '' }}" required
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                            </div>
                        </div>
                        <button type="button" onclick="removeQuestion(this)" class="mt-4 text-red-600 hover:text-red-800 font-medium">Remove Question</button>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="mt-6 flex space-x-4">
            <button type="button" onclick="addQuestion()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Add Question</button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Create Assignment</button>
        </div>
    </form>

    <script>
        let questionCount = {{ old('questions') ? count(old('questions')) : 0 }};

        function addQuestion() {
            questionCount++;
            const container = document.getElementById('question-container');
            const questionDiv = document.createElement('div');
            questionDiv.className = 'question bg-gray-50 p-4 rounded-lg border border-gray-200';
            questionDiv.innerHTML = `
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Question ${questionCount}</h3>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Question Text</label>
                    <input type="text" name="questions[${questionCount}][question_text]" required
                           class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Correct Answer</label>
                    <select name="questions[${questionCount}][correct_answer]" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>
                <div class="choices space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Option A</label>
                        <input type="hidden" name="questions[${questionCount}][choices][0][option]" value="A">
                        <input type="text" name="questions[${questionCount}][choices][0][option_text]" required
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Option B</label>
                        <input type="hidden" name="questions[${questionCount}][choices][1][option]" value="B">
                        <input type="text" name="questions[${questionCount}][choices][1][option_text]" required
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Option C</label>
                        <input type="hidden" name="questions[${questionCount}][choices][2][option]" value="C">
                        <input type="text" name="questions[${questionCount}][choices][2][option_text]" required
                               class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>
                </div>
                <button type="button" onclick="removeQuestion(this)" class="mt-4 text-red-600 hover:text-red-800 font-medium">Remove Question</button>
            `;
            container.appendChild(questionDiv);
        }

        function removeQuestion(button) {
            button.parentElement.remove();
            renumberQuestions();
        }

        function renumberQuestions() {
            const questions = document.querySelectorAll('.question');
            questionCount = 0;
            questions.forEach((question, index) => {
                questionCount++;
                const questionNumber = index + 1;
                question.querySelector('h3').textContent = `Question ${questionNumber}`;
                
                const inputs = question.querySelectorAll('input, select');
                inputs.forEach(input => {
                    const name = input.getAttribute('name');
                    if (name) {
                        input.setAttribute('name', name.replace(/questions\[\d+\]/, `questions[${questionNumber}]`));
                    }
                });
            });
        }
    </script>
</section>
@endsection