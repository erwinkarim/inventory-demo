<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inventory') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div id="" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Search Form + Buttons for New Inventory") }}
                    <br />
                    <x-link-button href="{{ route('inventory.create') }}">New Inventory</x-link-button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <!--div id="inventory-index" class="p-6 text-gray-900 dark:text-gray-100"-->
                <div id="inventory-index" class="grid grid-cols-2 md:grid-cols-3 gap-4">
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Pagination Here") }}
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', async function () {
            console.log('in inventory.index');
            axios.get('/api/inventory').then(e => {
                let elm = document.getElementById('inventory-index');
                console.log('e', e);
                e.data.forEach(element => {
                    elm.innerHTML += `<x-card theID="${element.id}" name="${element.name}" desc="${element.desc}" picture="${element.picture}"></x-card>`;
                });
            })
        });

    </script>
</x-app-layout>