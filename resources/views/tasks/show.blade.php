<x-layout>
    <div class="w-full sm:max-w-xl">
        <h1 class="text-4xl font-normal break-words">Просмотр задачи: {{ $task->name }}</h1>

        <div class="mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg break-words">
            <div>
                <span class="font-semibold">Имя:</span>
                <span>{{ $task->name }}</span>
            </div>
            <div class="mt-1">
                <span class="font-semibold">Статус:</span>
                <span>{{ $task->status->name }}</span>
            </div>
            <div class="mt-1">
                <span class="font-semibold">Описание:</span>
                <span>{{ $task->description }}</span>
            </div>
            <div class="mt-1">
                <p class="font-semibold"> Метки: </p>
                <div class="flex flex-wrap gap-2 mt-1">
                    @foreach ($task->labels as $label)
                        <span
                            class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full font-medium text-sm uppercase bg-blue-200 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="2.5" stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                            </svg>
                            {{ $label->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-layout>
