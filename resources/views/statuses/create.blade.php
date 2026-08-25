<x-layout>

    <body class="font-sans text-gray-900 antialiased">
        <div
            class="min-h-screen flex flex-col sm:justify-start items-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <form method="POST" action="{{ route('task_statuses.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="__('Новый статус')" />
                        <x-text-input id="name" class="block mt-1" type="text" name="name" :value="old('name')"
                            required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-primary-button class="mt-4">
                            {{ __('Создать') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </body>


    </x-layuot>
