<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Calendar - PropBook</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        .fc { font-family: 'Figtree', sans-serif; }
        .fc .fc-toolbar { margin-bottom: 1.5rem !important; }
        .fc .fc-toolbar-title { font-size: 1.25rem !important; font-weight: 600 !important; color: #f9fafb !important; }
        
        .fc-button-primary { 
            @apply !bg-yellow-600 !border-yellow-700 hover:!bg-yellow-700 !text-white !font-medium !text-sm !px-3 !py-2;
        }
        .fc-button-primary:disabled {
            @apply !opacity-50 !cursor-not-allowed;
        }
        
        .fc-event-pending { @apply !bg-yellow-600/80 !border-yellow-700 !text-white; }
        .fc-event-confirmed { @apply !bg-green-600/80 !border-green-700 !text-white; }
        .fc-event-cancelled { @apply !bg-red-600/80 !border-red-700 !text-white !line-through; }
        
        .fc-daygrid-day { @apply !bg-gray-900 !border-gray-800; }
        .fc-daygrid-day:hover { @apply !bg-gray-800/50; }
        .fc-daygrid-day-number { @apply !text-gray-400 !p-2 !text-sm; }
        .fc-day-today .fc-daygrid-day-number { @apply !bg-yellow-600 !text-white !rounded-full; }
        
        .fc-col-header-cell { @apply !bg-gray-800 !border-gray-700 !text-gray-300 !font-semibold; }
        .fc-col-header-cell-cushion { @apply !text-gray-300 !text-sm; }
        
        .fc-scrollgrid { @apply !border-gray-800 !rounded-lg overflow-hidden; }
        .fc-scrollgrid-section > td { @apply !border-gray-800; }
        
        .fc-daygrid-day-frame { @apply !min-h-[100px]; }
        
        .fc .fc-button-group { @apply !gap-2; }
        
        .fc-timegrid-slot { @apply !border-gray-800 !h-12; }
        .fc-timegrid-axis { @apply !text-gray-500 !text-xs; }
        .fc-timegrid-slot-label { @apply !text-gray-400 !text-xs; }
        
        .fc .fc-highlight { @apply !bg-yellow-600/10; }
        
        .fc-daygrid-day-top { @apply !text-center; }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #111827; }
        ::-webkit-scrollbar-thumb { background: #374151; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #4b5563; }
    </style>
</head>
<body class="bg-gray-950 text-gray-300">
    <nav class="border-b border-gray-800 sticky top-0 z-40 bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-yellow-600 flex items-center justify-center">
                            <i class="fas fa-building text-white text-lg"></i>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-white">PropBook</p>
                            <p class="text-xs text-gray-500">Real Estate Booking</p>
                        </div>
                    </a>
                </div>

                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="text-gray-400 hover:text-yellow-600 transition text-sm font-medium inline-flex items-center gap-2">
                        <i class="fas fa-chart-bar"></i><span class="hidden sm:inline">Dashboard</span>
                    </a>
                    <a href="{{ route('properties.index') }}" class="text-gray-400 hover:text-yellow-600 transition text-sm font-medium inline-flex items-center gap-2">
                        <i class="fas fa-list"></i><span class="hidden sm:inline">Properties</span>
                    </a>
                    <a href="{{ route('calendar') }}" class="text-yellow-600 font-medium text-sm inline-flex items-center gap-2">
                        <i class="fas fa-calendar"></i><span class="hidden sm:inline">Calendar</span>
                    </a>

                    <div class="flex items-center gap-4 pl-6 border-l border-gray-800">
                        <div class="text-sm">
                            <p class="font-medium text-gray-300">{{ Auth::user()->name }}</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-400 hover:text-red-600 transition p-2 rounded-lg hover:bg-gray-800">
                                <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-white mb-2 flex items-center gap-3">
                <i class="fas fa-calendar-alt text-yellow-600"></i>Schedule Your Visits
            </h1>
            <p class="text-gray-400">Select a date and time to book your property viewing</p>
        </div>

        <div class="card p-6">
            <div id="calendar"></div>
        </div>

        {{-- Legend --}}
        <div class="mt-6 card p-4">
            <div class="flex flex-wrap gap-6 text-sm">
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded bg-yellow-600/80 border border-yellow-700"></div>
                    <span class="text-gray-400">Pending</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded bg-green-600/80 border border-green-700"></div>
                    <span class="text-gray-400">Confirmed</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-4 h-4 rounded bg-red-600/80 border border-red-700"></div>
                    <span class="text-gray-400">Cancelled</span>
                </div>
                <div class="ml-auto text-gray-500 text-xs">
                    <i class="fas fa-info-circle mr-1"></i>Click on a time slot to schedule a visit
                </div>
            </div>
        </div>
    </div>

    {{-- Hidden Forms --}}
    <form id="submitForm" method="POST" class="" action="{{ route('visits.store')}}">
        @csrf
        <input type="hidden" id="propertyId" name="property_id">
        <input type="hidden" id="startTime" name="start_time">
        <input type="hidden" id="endTime" name="end_time">
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

    {{-- Schedule Visit Modal --}}
    <div id="visitModal" class="modal-backdrop hidden">
        <div class="modal-content">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white flex items-center gap-2">
                    <i class="fas fa-calendar-plus text-yellow-600"></i>Schedule Visit
                </h2>
                <button onclick="document.getElementById('visitModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-300 transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="space-y-5">
                <div>
                    <label for="propertySelect" class="block text-sm font-medium text-gray-300 mb-2">Select Property <span class="text-red-500">*</span></label>
                    <select id="propertySelect" required class="w-full">
                        <option value="">Choose a property...</option>
                    </select>
                </div>

                <div>
                    <label for="modalStartTime" class="block text-sm font-medium text-gray-300 mb-2">Start Time <span class="text-red-500">*</span></label>
                    <input type="datetime-local" id="modalStartTime" required class="w-full">
                </div>

                <div>
                    <label for="modalEndTime" class="block text-sm font-medium text-gray-300 mb-2">End Time</label>
                    <input type="datetime-local" id="modalEndTime" class="w-full">
                    <p class="text-xs text-gray-500 mt-1">Leave empty for 1-hour visit by default</p>
                </div>
            </div>

            <div class="flex gap-3 justify-end mt-6 pt-6 border-t border-gray-800">
                <button onclick="document.getElementById('visitModal').classList.add('hidden')" class="btn-secondary">
                    Cancel
                </button>
                <button id="saveVisitBtn" class="btn-primary">
                    Schedule Visit
                </button>
            </div>
        </div>
    </div>

    {{-- Visit Details Modal --}}
    <div id="detailsModal" class="modal-backdrop hidden">
        <div class="modal-content">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-white flex items-center gap-2">
                    <i class="fas fa-info-circle text-yellow-600"></i>Visit Details
                </h2>
                <button onclick="document.getElementById('detailsModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-300 transition">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div id="detailsContent" class="mb-6 space-y-3 text-gray-300 text-sm"></div>

            <div class="flex flex-col gap-3 pt-6 border-t border-gray-800">
                <button id="payVisitBtn" class="w-full btn-primary">
                    <i class="fas fa-credit-card mr-2"></i>Pay Now
                </button>
                <button id="deleteVisitBtn" class="w-full btn-danger">
                    <i class="fas fa-trash mr-2"></i>Cancel Visit
                </button>
                <button onclick="document.getElementById('detailsModal').classList.add('hidden')" class="w-full btn-secondary">
                    Close
                </button>
            </div>
        </div>
    </div>

    {{-- Alert Container --}}
    <div id="alertContainer" class="fixed top-20 right-6 z-50 space-y-3 max-w-sm"></div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>    <script>
        window.properties = {!! json_encode($properties) !!};
    </script>    @vite(['resources/js/calendar.js'])
</body>
</html>
