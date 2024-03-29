<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    {{ csrf_token() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load', async function () {
            console.log('in dashboard');

            /*
                load cookies for api stuff
            */
            await axios.get('/sanctum/csrf-cookie').then(response => {
                // Login...
                console.log('got csrf cookie');
            });
        });


    </script>
</x-app-layout>
