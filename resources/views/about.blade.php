@extends('layouts.frontend')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        .animate-fadeInDown {
            animation: fadeInDown 1s ease-out;
        }
        .animate-fadeIn {
            animation: fadeIn 1.5s ease-out;
        }
    </style>
</head>
<body class="font-sans leading-relaxed text-gray-700 bg-gray-100 box-border">
    <header class="bg-gradient-to-r from-gray-800 to-blue-600 text-white py-12 text-center shadow-lg">
        <div class="max-w-6xl mx-auto px-5">
            <h1 class="text-4xl font-bold mb-4 animate-fadeInDown">About Us</h1>
            <p class="text-lg opacity-90 animate-fadeIn">Discover our story, mission, and the team behind our success</p>
        </div>
    </header>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-5 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="about-text">
                <h2 class="text-3xl font-bold text-gray-800 mb-6 relative after:content-[''] after:w-16 after:h-1 after:bg-blue-600 after:absolute after:bottom-[-10px] after:left-0">Our Story</h2>
                <p class="mb-6 text-gray-600">We started with a simple idea: to create meaningful solutions that make a difference. Over the years, our passion for innovation and commitment to excellence have driven us to achieve great things.</p>
                <p class="mb-6 text-gray-600">Our mission is to empower individuals and businesses through creativity, technology, and collaboration. We believe in building a future where everyone can thrive.</p>
            </div>
            <div class="about-image">
                <img src="https://picsum.photos/600/400" alt="Our Story" class="w-full rounded-lg shadow-xl transform transition-transform duration-300 hover:scale-105 object-cover max-h-80">
            </div>
        </div>
    </section>

    <section class="bg-white py-16 text-center">
        <div class="max-w-7xl mx-auto px-5">
            <h2 class="text-3xl font-bold text-gray-800 mb-12">Meet Our Team</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <img src="https://picsum.photos/120/120" alt="John Doe" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">John Doe</h3>
                    <p class="text-sm text-gray-500">Founder & CEO</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <img src="https://picsum.photos/120/120" alt="Jane Smith" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Jane Smith</h3>
                    <p class="text-sm text-gray-500">Creative Director</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg transform transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <img src="https://picsum.photos/120/120" alt="Mike Johnson" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Mike Johnson</h3>
                    <p class="text-sm text-gray-500">Lead Developer</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
@endsection