
<x-layout>
    <div class="min-h-screen flex flex-col sm:justify-start items-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">

        <h1 class="text-4xl font-normal mt-8">Просмотр задачи: {{ $task->name }}</h1>

        <div class="w-full sm:max-w-xl mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="mb-3">
                <p class="inline font-semibold"> Имя: </p>
                <p class="inline"> {{ $task->name }} </p>
            </div>
            <div class="mb-3">
                <p class="inline font-semibold"> Статус: </p>
                <p class="inline"> {{ $task->status_id }} </p>
            </div>
            <div class="mb-3">
                <p class="inline font-semibold"> Описание: </p>
                <p class="inline"> {{ $task->description }} </p>
            </div>
            <div class="mb-3">
                <p class="inline font-semibold"> Метки: </p>
                {{-- TODO: Изменить метки когда появятся --}}
                <p class="inline"> {{ $task->description }} </p>
            </div>
        </div>
    </div>
</x-layout>
