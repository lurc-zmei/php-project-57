<x-layout>
    <div class="py-12 px-4 max-w-7xl mx-auto">
        <h1 class="text-5xl font-normal mb-8">Метки</h1>

        <a href="{{ route('labels.create') }}"
            class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-lg text-sm transition duration-150 ease-in-out no-underline">
            Создать метку
        </a>

        <div class="py-12 px-4 max-w-7xl mx-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <td class="py-3 px-4">ID</td>
                    <td class="py-3 px-4">ИМЯ</td>
                    <td class="py-3 px-4">ОПИСАНИЕ</td>
                    <td class="py-3 px-4">ДАТА СОЗДАНИЯ</td>
                    <td class="py-3 px-4">ДЕЙСТВИЯ</td>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-600">
                    @foreach ($labels as $label)
                        <tr>
                            <td class="py-3 px-4">{{ $label->id }}</td>
                            <td class="py-3 px-4">{{ $label->name }}</td>
                            <td class="py-3 px-4">{{ $label->description }}</td>
                            <td class="py-3 px-4">{{ $label->created_at->format('d.m.Y') }}</td>
                            <td class="py-3 px-4">
                                <form action="{{ route('labels.destroy', $label->id) }}" method="POST" onsubmit="return confirm('Вы уверены?');"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Удалить</button>
                                </form>
                                <a href="{{ route('labels.edit', $label->id) }}"
                                    class="text-blue-600 hover:underline">Изменить</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-layout>
