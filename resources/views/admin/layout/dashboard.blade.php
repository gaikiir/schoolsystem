<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-72 bg-indigo-900 text-white flex flex-col shadow-xl">
            <div class="p-6 text-3xl font-extrabold tracking-tight">School Admin</div>
            <nav class="flex-1 px-4 py-2">
                <ul>
                    <li class="mb-2"><a href="{{route('admindash')}}" class="block p-3 rounded-lg hover:bg-indigo-700 transition-colors duration-200">Dashboard</a></li>
                    <li class="mb-2"><a href="#" class="block p-3 rounded-lg hover:bg-indigo-700 transition-colors duration-200">Students</a></li>
                    <li class="mb-2"><a href="#" class="block p-3 rounded-lg hover:bg-indigo-700 transition-colors duration-200">Classes</a></li>
                    <!-- Events Dropdown -->
                    <li class="mb-2">
                        <button class="dropdown-toggle block p-3 rounded-lg hover:bg-indigo-700 w-full text-left transition-colors duration-200 flex items-center justify-between">
                            Events
                            <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul class="pl-6 mt-1 hidden dropdown-menu">
                            <li class="mb-2"><a href="{{route('events.index')}}" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">View Events</a></li>
                            <li class="mb-2"><a href="{{route('events.create')}}" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">Create Event</a></li>
                        </ul>
                    </li>
                    <!-- Blogs Dropdown -->
                    <li class="mb-2">
                        <button class="dropdown-toggle block p-3 rounded-lg hover:bg-indigo-700 w-full text-left transition-colors duration-200 flex items-center justify-between">
                            Blogs
                            <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul class="pl-6 mt-1 hidden dropdown-menu">
                            <li class="mb-2"><a href="{{route('blogs.index')}}" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">View Blogs</a></li>
                            <li class="mb-2"><a href="{{route('blogs.create')}}" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">Create Blog</a></li>
                        </ul>
                    </li>
                    <!-- Programs Dropdown -->
                    <li class="mb-2">
                        <button class="dropdown-toggle block p-3 rounded-lg hover:bg-indigo-700 w-full text-left transition-colors duration-200 flex items-center justify-between">
                            Programs
                            <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul class="pl-6 mt-1 hidden dropdown-menu">
                            <li class="mb-2"><a href="{{route('programs.index')}}" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">View Programs</a></li>
                            <li class="mb-2"><a href="{{route('programs.creat')}}" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">Add Program</a></li>
                        </ul>
                    </li>
                    <!-- Create Assignment Dropdown -->
                    <li class="mb-2">
                        <button class="dropdown-toggle block p-3 rounded-lg hover:bg-indigo-700 w-full text-left transition-colors duration-200 flex items-center justify-between">
                            Assignment
                            <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul class="pl-6 mt-1 hidden dropdown-menu">
                            <li class="mb-2"><a href="{{route('assignments.index')}}" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">View Assignments</a></li>
                            <li class="mb-2"><a href="{{route('assignments.create')}}" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">New Assignment</a></li>
                        </ul>
                    </li>
                    <!-- Add Student Dropdown -->
                    <li class="mb-2">
                        <button class="dropdown-toggle block p-3 rounded-lg hover:bg-indigo-700 w-full text-left transition-colors duration-200 flex items-center justify-between">
                            Add Student
                            <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul class="pl-6 mt-1 hidden dropdown-menu">
                            <li class="mb-2"><a href="#" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">Register Student</a></li>
                            <li class="mb-2"><a href="#" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">Import Students</a></li>
                        </ul>
                    </li>
                    <!-- Email Contents Dropdown -->
                    <li class="mb-2">
                        <button class="dropdown-toggle block p-3 rounded-lg hover:bg-indigo-700 w-full text-left transition-colors duration-200 flex items-center justify-between">
                            Email Contents
                            <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul class="pl-6 mt-1 hidden dropdown-menu">
                            <li class="mb-2"><a href="#" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">View Emails</a></li>
                            <li class="mb-2"><a href="#" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">Compose Email</a></li>
                            <li class="mb-2"><a href="#" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">Email Templates</a></li>
                        </ul>
                    </li>
                    <!-- Lecturer Dropdown -->
                    <li class="mb-2">
                        <button class="dropdown-toggle block p-3 rounded-lg hover:bg-indigo-700 w-full text-left transition-colors duration-200 flex items-center justify-between">
                            Lectures
                            <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul class="pl-6 mt-1 hidden dropdown-menu">
                            <li class="mb-2"><a href="#" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">View</a></li>
                            <li class="mb-2"><a href="#" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">Add Lecture</a></li>
                        </ul>
                    </li>
                    
                    <!-- Payment Dropdown -->
                    <li class="mb-2">
                        <button class="dropdown-toggle block p-3 rounded-lg hover:bg-indigo-700 w-full text-left transition-colors duration-200 flex items-center justify-between">
                            Payment
                            <svg class="w-5 h-5 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <ul class="pl-6 mt-1 hidden dropdown-menu">
                            <li class="mb-2"><a href="#" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">View Payments</a></li>
                            <li class="mb-2"><a href="#" class="block p-2 rounded-lg hover:bg-indigo-600 text-sm transition-colors duration-200">Process Payment</a></li>
                        </ul>
                    </li>
                    <li class="mb-2"><a href="#" class="block p-3 rounded-lg hover:bg-indigo-700 transition-colors duration-200">Settings</a></li>
                </ul>
            </nav>
            <div class="p-4 border-t border-indigo-700">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 rounded-lg text-white hover:bg-indigo-700 transition-colors duration-200">Logout</button>
                </form>
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold">Dashboard</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Admin User</span>
                    <img class="h-10 w-10 rounded-full" src="https://via.placeholder.com/40" alt="Profile">
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6 flex-1 overflow-auto">
                <!-- Metrics -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">Total Users</h3>
                        {{-- <p class="text-3xl font-bold text-indigo-600">{{ $total }}</p> --}}
                        <p class="text-3xl font-bold text-indigo-600">123</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">Total Lectures</h3>
                        <p class="text-3xl font-bold text-indigo-600">56</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">Active Classes</h3>
                        <p class="text-3xl font-bold text-indigo-600">78</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">Upcoming Events</h3>
                        <p class="text-3xl font-bold text-indigo-600">12</p>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow">
                        <h3 class="text-lg font-semibold text-gray-700">Total Applicants</h3>
                        <p class="text-3xl font-bold text-indigo-600">12</p>
                    </div>
                </div>

                <!-- Recent Results -->
                {{-- <div class="bg-white p-6 rounded-lg shadow mt-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Recent Results</h3>
                    <div class="space-y-4">
                        <div class="border-b pb-2">
                            <p class="text-gray-600"><span class="font-semibold">Student Registration:</span> John Doe successfully registered on July 7, 2025.</p>
                            <p class="text-sm text-gray-500">Email sent to john.doe@example.com with welcome details.</p>
                        </div>
                        <div class="border-b pb-2">
                            <p class="text-gray-600"><span class="font-semibold">Assignment Submission:</span> Jane Smith submitted Assignment #123 on July 6, 2025.</p>
                            <p class="text-sm text-gray-500">Confirmation email sent to jane.smith@example.com.</p>
                        </div>
                        <div class="border-b pb-2">
                            <p class="text-gray-600"><span class="font-semibold">Event Creation:</span> "Tech Workshop 2025" created by Admin on July 5, 2025.</p>
                            <p class="text-sm text-gray-500">Notification email sent to all registered participants.</p>
                        </div>
                    </div>
                </div> --}}

                @yield('content')
            </main>
        </div>
    </div>
    <script>
        // JavaScript to toggle dropdowns
document.addEventListener("DOMContentLoaded", () => {
    const dropdowns = document.querySelectorAll(".dropdown-toggle");
    dropdowns.forEach((dropdown) => {
        dropdown.addEventListener("click", () => {
            const content = dropdown.nextElementSibling;
            content.classList.toggle("hidden");
        });
    });
});

//script for approved user

// const isAprove = (userId) => {
//     if (confirm("Are you sure you want to approve this user?")) {
//         window.location.href = `/users/${userId}/approve`;
//     }
// };
    </script>
</body>
</html>
