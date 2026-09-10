<x-layout>
    <div class="min-h-screen flex flex-col sm:justify-start items-start max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">

        <h1 class="text-5xl font-normal mt-8">Создать задачу</h1>


        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            <form method="POST" action="{{ route('task_statuses.store') }}">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Имя')" />
                    <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')"
                        required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('Описание')" />
                    <x-textarea-input name="description" rows="4" class="block w-full mt-1">{{ old('description') }}</x-textarea-input>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="status_id" :value="__('Статус')" />
                    <x-select-input id="status_id" class="block w-full mt-1" name="status_id" :options="$statuses"/>
                    <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="assigned_to_id" :value="__('Исполнитель')" />
                    <x-select-input id="assigned_to_id" class="block w-full mt-1" name="assigned_to_id" :options="$users" />
                    <x-input-error :messages="$errors->get('assigned_to_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="label" :value="__('Метки')" />
                    <x-text-input id="label" class="block w-full mt-1" type="text" name="label" />
                    <x-input-error :messages="$errors->get('label')" class="mt-2" />
                </div>

                <div>
                    <x-primary-button class="mt-4">
                        {{ __('Создать') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

    </x-layuot>
