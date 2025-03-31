<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Styles / Scripts -->
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white flex flex-col items-center justify-center min-h-screen p-6">
    {{-- Navigation --}}
    <header class="w-full max-w-6xl flex justify-between items-center p-4 bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <h1 class="text-xl font-bold">TaskManager</h1>
        <nav class="flex gap-4">
            @auth
                <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm font-medium bg-blue-500 text-white rounded hover:bg-blue-600">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:underline">
                    Log in
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Get Started
                    </a>
                @endif
            @endauth
        </nav>
    </header>

    {{-- Hero Section --}}
    <section class="text-center mt-12 max-w-3xl">
        <h2 class="text-4xl font-extrabold text-gray-900 dark:text-white leading-tight">
            Organize, Prioritize, and Achieve Your Tasks
        </h2>
        <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
            TaskManager helps you stay productive and manage your tasks efficiently. Track your progress, set deadlines, and collaborate effortlessly.
        </p>
        <div class="mt-6 flex justify-center gap-4">
            <a href="{{ route('register') }}" class="px-6 py-3 bg-blue-600 text-white rounded-lg text-lg font-semibold hover:bg-blue-700">
                Start for Free
            </a>
            <a href="{{ route('login') }}" class="px-6 py-3 text-lg text-gray-700 dark:text-gray-300 border border-gray-400 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700">
                Log in
            </a>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
            <h3 class="text-xl font-semibold">📅 Task Scheduling</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-300">
                Easily set deadlines and reminders to stay on top of your work.
            </p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
            <h3 class="text-xl font-semibold">✅ Track Progress</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-300">
                Monitor your task completion and see what's next on your list.
            </p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
            <h3 class="text-xl font-semibold">👥 Collaborate</h3>
            <p class="mt-2 text-gray-600 dark:text-gray-300">
                Share tasks with teammates and stay productive together.
            </p>
        </div>
    </section>
</body>
</html>
