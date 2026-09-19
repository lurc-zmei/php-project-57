@if (isset($title) || isset($body))
    <div x-data="{ open: true }" x-show="open" x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/50 backdrop-blur-sm"
        style="display: none;">
        <div x-show="open" x-transition.scale.95 x-on:click.outside="open = false"
            class="w-full max-w-md p-6 bg-white rounded-lg shadow-xl border border-gray-200">
            @if (isset($title) && $title)
                <h3 class="text-lg font-semibold text-gray-900 mb-2">
                    {{ $title }}
                </h3>
            @endif

            <div class="text-sm text-gray-600 mb-6">
                {!! $body !!}
            </div>

            <div class="flex justify-end">
                <button type="button" x-on:click="open = false"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Закрыть
                </button>
            </div>
        </div>
    </div>
@endif
