<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo / Название -->
            <div class="shrink-0 flex items-center">
                <a href="{{ url('/') }}" class="text-lg font-bold text-black no-underline">
                    Менеджер задач
                </a>
            </div>

            <!-- Ссылки навигации по центру через x-nav-link -->
            <div class="hidden sm:flex space-x-8 mx-auto h-full">
                <x-nav-link href="#" :active="request()->is('tasks*')">
                    {{ __('Задачи') }}
                </x-nav-link>

                <x-nav-link href="#" :active="request()->is('task_statuses*')">
                    {{ __('Статусы') }}
                </x-nav-link>

                <x-nav-link href="#" :active="request()->is('labels*')">
                    {{ __('Метки') }}
                </x-nav-link>
            </div>

            <!-- Правая часть (Авторизация / Гость) -->
            <div class="flex items-center">
                @auth
                <div class="flex items-center space-x-4">

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-lg text-sm transition duration-150 ease-in-out no-underline">
                            {{ __('Выход') }}
                        </button>
                    </form>
                </div>
                @else
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-lg text-sm transition duration-150 ease-in-out no-underline">
                        Вход
                    </a>

                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-4 py-2 rounded-lg text-sm transition duration-150 ease-in-out no-underline">
                        Регистрация
                    </a>
                    @endif
                </div>
                @endauth
            </div>
        </div>
    </div>
</nav>