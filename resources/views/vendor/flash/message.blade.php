@foreach (session('flash_notification', []) as $message)
    @php
        $delay = 3000;

        $level = $message['level'] ?? 'info';

        $colors = match ($level) {
            'warning' => 'text-yellow-800 bg-yellow-50 border-yellow-200',
            'success' => 'text-green-800 bg-green-50 border-green-200',
            default   => 'text-blue-800 bg-blue-50 border-blue-200',
        };
    @endphp

    <div x-data="{ show: true }" 
         x-init="setTimeout(() => show = false, {{ $delay }})" 
         x-show="show" 
         x-transition.duration.500ms
         class="p-4 mb-4 text-sm rounded-lg border {{ $colors }}" 
         role="alert">
        {!! $message['message'] !!}
    </div>
@endforeach

{{ session()->forget('flash_notification') }}
