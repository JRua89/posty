@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        <h1 class="text-3xl font-bold mb-4">Welcome to Our Platform</h1>

        <p class="text-gray-700 mb-6">
            This is the homepage of our amazing platform.  Here you'll find information about what we offer,
            explore our features, and get started on your journey. We're excited to have you here!
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="bg-gray-100 p-4 rounded-lg mb-2">
                <h2 class="text-xl font-semibold mb-2">Feature 1</h2>
                <p class="text-gray-700">Short description of Feature 1.  Highlight its key benefits and value proposition.</p>
                <a href="#" class="text-blue-500 hover:underline">Learn More</a>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg mb-2">
                <h2 class="text-xl font-semibold mb-2">Feature 2</h2>
                <p class="text-gray-700">Short description of Feature 2. Explain how it solves a problem or makes things easier.</p>
                <a href="#" class="text-blue-500 hover:underline">Learn More</a>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg mb-2">
                <h2 class="text-xl font-semibold mb-2">Feature 3</h2>
                <p class="text-gray-700">Short description of Feature 3.  Focus on the positive impact it has on users.</p>
                <a href="#" class="text-blue-500 hover:underline">Learn More</a>
            </div>
            <div class="bg-gray-100 p-4 rounded-lg mb-2">
                <h2 class="text-xl font-semibold mb-2">Feature 4</h2>
                <p class="text-gray-700">Short description of Feature 4.  Emphasize its unique selling points.</p>
                <a href="#" class="text-blue-500 hover:underline">Learn More</a>
            </div>
        </div>

        <div class="bg-blue-500 p-6 rounded-lg text-white text-center">
            <h2 class="text-2xl font-semibold mb-2">Ready to Get Started?</h2>
            <p class="mb-4">Click the button below to sign up and experience the platform for yourself.</p>
            <a href="/register" class="bg-white text-blue-500 py-2 px-4 rounded-lg hover:bg-blue-100 font-semibold">Sign Up Now</a>
        </div>

    </div>
</div>
@endsection