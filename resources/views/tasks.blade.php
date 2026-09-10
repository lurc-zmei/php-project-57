<x-layout>
    <div class="py-12 px-4 max-w-7xl mx-auto">
        <h1 class="text-5xl font-normal mb-8">Задачи</h1>

        <a href="{{ route('tasks.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-lg text-sm transition duration-150 ease-in-out no-underline">
            Создать задачу
        </a>

        <div class="py-12 px-4 max-w-7xl mx-auto">
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
        {{-- TODO: сделать вывод имен вместо цифр --}}
                            <td class="py-3 px-4">{{ $task->status_id }}</td>
                            <td class="py-3 px-4">{{ $task->name }}</td>
        {{-- TODO: сделать вывод имен вместо цифр --}}
                            <td class="py-3 px-4">{{ $task->created_by_id }}</td>
        {{-- TODO: сделать вывод имен вместо цифр --}}
                            <td class="py-3 px-4">{{ $task->assigned_to_id }}</td>
                            <td class="py-3 px-4">{{ $task->created_at }}</td>
                            <td class="py-3 px-4">
        {{-- FIXME: Изменить  маршрут route Task--}} 
                                <a href="{{ route('task_statuses.edit', $task->id) }}"
                                    class="text-blue-600 hover:underline">Изменить</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-layout>