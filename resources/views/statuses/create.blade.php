<x-layout>
    <div>
        <h1 class="text-5xl font-normal">Создать статус</h1>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('task_statuses.store') }}">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Название статуса')" />
                    <x-text-input id="name" class="block mt-1" type="text" name="name" :value="old('name')"
                        required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-primary-button>
                        {{ __('Создать') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
