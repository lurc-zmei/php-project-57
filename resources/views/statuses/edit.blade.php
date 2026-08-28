<x-layout>
    <div class="min-h-screen flex flex-col sm:justify-start items-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">

        <h1 class="text-5xl font-normal mt-6">Изменить статус</h1>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('task_statuses.update', $status) }}">
                @csrf
                @method('PATCH')
                <div>
                    <x-input-label for="name" :value="__('Название статуса')" />
                    <x-text-input id="name" class="block mt-1" type="text" name="name" :value="old('name')"
                        required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-primary-button class="mt-4">
                        {{ __('Обновить') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
