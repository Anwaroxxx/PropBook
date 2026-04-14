<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.authUser = document.getElementById("authUserInput");</script>
    <title>Schedule Your Visit - PropBook</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet" />
    
    <style>
        .fc { font-family: inherit; }
        .fc-button-primary { @apply !bg-blue-600 !border-blue-600 hover:!bg-blue-700 !text-white; }
        .fc-event-pending { @apply !bg-yellow-600 !border-yellow-700 !text-white; }
        .fc-event-confirmed { @apply !bg-green-700 !border-green-800 !text-white; }
        .fc-event-cancelled { @apply !bg-gray-700 !border-gray-800 !text-white line-through; }
        .fc-daygrid-day { @apply !bg-gray-800 !border-gray-700; }
        .fc-col-header-cell { @apply !bg-gray-900 !border-gray-700 !text-gray-300; }
        .fc-daygrid-day:hover { @apply !bg-gray-700; }
        .fc-daygrid-day-frame { @apply !bg-gray-900; }
        .fc-button-group { @apply !bg-gray-900 !border-gray-700; }
        .fc-button { @apply !border-gray-700; }
        .fc { @apply !bg-gray-900 !text-gray-300; }
    </style>
</head>
<body class="bg-gray-950 text-gray-300">
    <nav class="border-b border-gray-800 sticky top-0 z-40 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <div class="text-2xl font-bold text-blue-600">📅</div>
                    <div>
                        <a href="{{ route('home') }}" class="text-lg font-bold text-gray-100">PropBook</a>
                        <p class="text-xs text-gray-500">Real Estate Booking</p>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <a href="{{ route('properties.index') }}" class="text-gray-400 hover:text-blue-400 transition text-sm">Properties</a>
                    <a href="{{ route('calendar') }}" class="text-blue-400 font-medium text-sm">Calendar</a>
                    
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-400">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-red-500 transition text-sm">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-white mb-2">Schedule Your Visit</h1>
            <p class="text-gray-500">Select a date and time to book your property viewing</p>
        </div>

        <div class="bg-gray-900 rounded border border-gray-800 p-8">
            <div id="calendar"></div>
        </div>

        <div class="mt-8 bg-gray-900 border border-gray-800 rounded p-6">
            <div class="flex gap-4">
                <div class="text-2xl">ℹ️</div>
                <div>
                    <h3 class="font-medium text-gray-100 mb-1">How It Works</h3>
                    <p class="text-gray-500 text-sm">
                        Click on a date to schedule a visit. Select your preferred property and time, then confirm. Your booking will be processed immediately.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <form id="submitForm" method="POST" class="hidden">
        <input type="hidden" id="start" name="start">
        <input type="hidden" id="end" name="end">
        <input type="hidden" id="authUserInput" value="{{ Auth::id() }}">
        <button id="submitBtn" type="submit"></button>
    </form>

    <form id="updateForm" method="POST" class="hidden">
        <input type="hidden" id="updatedStart" name="start">
        <input type="hidden" id="updatedEnd" name="end">
        <button id="updateBtn" type="submit"></button>
    </form>

    <form id="deleteForm" method="POST" class="hidden">
        <button id="deleteBtn" type="submit"></button>
    </form>

    <div id="visitModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50 p-4">
        <div class="bg-gray-900 rounded w-full max-w-md p-8 border border-gray-800 shadow-xl">
            <h2 id="modalTitle" class="text-xl font-bold text-white mb-6">Schedule Visit</h2>
            
            <div class="space-y-5">
                <div>
                    <label for="propertySelect" class="block text-sm font-medium text-blue-400 mb-2">Select Property</label>
                    <select id="propertySelect" required class="w-full px-4 py-2 bg-gray-800 text-gray-100 border border-gray-700 rounded focus:outline-none focus:border-blue-500">
                        <option value="">Choose a property...</option>
                    </select>
                </div>

                <div>
                    <label for="startTime" class="block text-sm font-medium text-blue-400 mb-2">Start Time</label>
                    <input type="datetime-local" id="startTime" required class="w-full px-4 py-2 bg-gray-800 text-gray-100 border border-gray-700 rounded focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label for="endTime" class="block text-sm font-medium text-blue-400 mb-2">End Time</label>
                    <input type="datetime-local" id="endTime" required class="w-full px-4 py-2 bg-gray-800 text-gray-100 border border-gray-700 rounded focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="flex gap-3 justify-end mt-8 pt-6 border-t border-gray-800">
                <button onclick="document.getElementById('visitModal').classList.add('hidden')" class="px-4 py-2 text-gray-400 bg-gray-800 hover:bg-gray-700 rounded transition text-sm font-medium">
                    Cancel
                </button>
                <button id="saveVisitBtn" class="px-4 py-2 bg-blue-600 text-white hover:bg-blue-700 rounded transition text-sm font-medium">
                    Schedule
                </button>
            </div>
        </div>
    </div>

    <div id="detailsModal" class="hidden fixed inset-0 bg-black/70 flex items-center justify-center z-50 p-4">
        <div class="bg-gray-900 rounded w-full max-w-md p-8 border border-gray-800 shadow-xl">
            <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
                ℹ️ Visit Details
            </h2>
            <div id="detailsContent" class="mb-6 space-y-3 text-gray-400 text-sm"></div>
            
            <div class="flex flex-col gap-2 pt-6 border-t border-gray-800">
                <button id="payVisitBtn" class="w-full px-4 py-2.5 bg-blue-600 text-white hover:bg-blue-700 rounded transition font-medium text-sm">
                    💳 Pay Now
                </button>
                <button id="deleteVisitBtn" class="w-full px-4 py-2.5 bg-red-700 text-white hover:bg-red-800 rounded transition font-medium text-sm">
                    🗑️ Cancel
                </button>
                <button onclick="document.getElementById('detailsModal').classList.add('hidden')" class="w-full px-4 py-2.5 bg-gray-800 text-gray-400 hover:bg-gray-700 rounded transition font-medium text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>

    <div id="alertContainer" class="fixed top-20 right-6 z-40 space-y-3 max-w-sm"></div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
</body>
</html>
