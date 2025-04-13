<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktif Olaylar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 115px;
            width: 320px;
            background-color: #EA580C;
            overflow: hidden;
        }
        .warning-icon {
            width: 32px;
            height: 32px;
            background-color: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.5rem;
        }
        .warning-icon svg {
            width: 20px;
            height: 20px;
            color: #EA580C;
        }
    </style>
</head>
<body class="flex items-center justify-center p-2">
    <div class="w-full">
        @if($activeIncidents->isNotEmpty())
            @php
                $firstIncident = $activeIncidents->first();
                $remainingCount = $activeIncidents->count() - 1;
            @endphp
            <div class="flex flex-col items-center">
                <div class="warning-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="https://status.rfcompanyweb.com/round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h1 class="text-sm font-bold text-white mb-1 text-center leading-tight">{{ $firstIncident->title }}</h1>
                @if($firstIncident->services->isNotEmpty())
                    <div class="flex flex-wrap justify-center gap-1 mb-1">
                        @foreach($firstIncident->services as $service)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-white text-orange-600 line-through decoration-orange-600/70 decoration-1">
                                {{ $service->name }}
                            </span>
                        @endforeach
                    </div>
                @endif
                @if($remainingCount > 0)
                    <p class="text-white text-xs">+{{ $remainingCount }} more {{ Str::plural('incident', $remainingCount) }}</p>
                @endif
            </div>
          
            <div class="text-center mt-1">
                <a href="{{ route('status.index') }}" target="_blank" class="text-white hover:text-gray-200 underline text-xs font-medium">
                    Tüm Olaylar
                </a>
            </div>
        @else
            <div class="bg-white shadow-lg rounded-lg p-2 text-center">
                <p class="text-sm text-green-700 font-medium">Tüm sistemler çalışıyor</p>
            </div>
        @endif
    </div>
</body>
</html> 