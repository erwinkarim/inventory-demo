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
        console.log('loaded');
         
        let load = async () => {
            let form = new FormData();
            form.append('token_name', 'test');

            let response = await fetch('/tokens/create', {
                method: "POST",
                headers: {
                    'Accept': 'Application/json',
                    'X-CSRF-Token': "{{ csrf_token() }}",
                },
                body: form,
            });
            let token = await response.json();
            let token_code = token.token;

            console.log('inventory', response);
            console.log('token', token);
            
            // now fetch inventory
            response = await fetch('/api/inventory', {
                headers: {
                    'Accept': 'Application/json',
                    'Authorization': `Bearer ${token_code}`,
                },
            });
            let inventory = await response.json();
            console.log('inventory', inventory);
        };
        load();

    </script>
</x-app-layout>
