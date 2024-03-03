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
                    <a href="{{ route('inventory.create') }}" class="underline">New Inventory</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div id="inventory-index" class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Inventory Listing Here") }}
                    <br />
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div id="" class="p-6 text-gray-900 dark:text-gray-100">
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
                    elm.innerHTML += `<a class="underline" href="/inventory/${element.id}">${element.name}</a><br />`
                    elm.innerHTML += `${JSON.stringify(element)} <br /><br />`;
                });
            })
        });

    </script>
</x-app-layout>