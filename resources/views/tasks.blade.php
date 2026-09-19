<x-layout>
    <div>
        <h1 class="text-5xl font-normal">Задачи</h1>

        <div class="flex items-center justify-between mt-8 gap-3">
            <form method="get" class="flex gap-3">
                <div class="inline-flex flex-col font-semibold">
                    <x-select-input class="w-40 h-9 py-0" name="filter[status_id]" :options="$statuses" placeholder="Статус"
                        :value="old('filter.status_id', request('filter.status_id'))" />
                    <x-input-error :messages="$errors->get('filter[status_id]')" class="mt-2" />
                </div>

                <div class="inline-flex flex-col font-semibold">
                    <x-select-input class="w-60 h-9 py-0" name="filter[created_by_id]" :options="$users"
                        placeholder="Автор" :value="old('filter.created_by_id', request('filter.created_by_id'))" />
                    <x-input-error :messages="$errors->get('filter[created_by_id]')" class="mt-2" />
                </div>

                <div class="inline-flex flex-col font-semibold">
                    <x-select-input class="w-60 h-9 py-0" name="filter[assigned_to_id]" :options="$users"
                        placeholder="Исполнитель" :value="old('filter.assigned_to_id', request('filter.assigned_to_id'))" />
                    <x-input-error :messages="$errors->get('filter[assigned_to_id]')" class="mt-2" />
                </div>

                <x-primary-button>
                    {{ __('Применить') }}
                </x-primary-button>
            </form>

            <a href="{{ route('tasks.create') }}"
                class='inline-flex flex-col items-center ml-auto px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600'>
                Создать задачу
            </a>
        </div>

        <div class="mt-6">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <td class="py-3 px-4">ID</td>
                    <td class="py-3 px-4">СТАТУС</td>
                    <td class="py-3 px-4">ИМЯ</td>
                    <td class="py-3 px-4">АВТОР</td>
                    <td class="py-3 px-4">ИСПОЛНИТЕЛЬ</td>
                    <td class="py-3 px-4">ДАТА СОЗДАНИЯ</td>
                    <td class="py-3 px-4">ДЕЙСТВИЯ</td>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-600">
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="py-3 px-4">{{ $task->id }}</td>
                            <td class="py-3 px-4">{{ $task->status->name }}</td>
                            <td class="py-3 px-4 text-blue-600 hover:underline"><a
                                    href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a></td>
                            <td class="py-3 px-4">{{ $task->createdBy->name }}</td>
                            <td class="py-3 px-4">{{ $task->assignedTo->name }}</td>
                            <td class="py-3 px-4">{{ $task->created_at->format('d.m.Y') }}</td>
                            <td class="py-3 px-4">
                                <a href="{{ route('tasks.edit', $task->id) }}"
                                    class="text-blue-600 hover:underline">Изменить</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
