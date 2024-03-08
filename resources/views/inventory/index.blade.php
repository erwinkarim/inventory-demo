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
                    <x-search-input :categories=$categories :search=$search />
                    @can('create inventory')
                        <br />
                        <x-link-button href="{{ route('inventory.create') }}">New Inventory</x-link-button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Name
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                        </svg></a>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    <div class="flex items-center">
                                        Category
                                        <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
                                        </svg></a>
                                    </div>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="inventory-table">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex">
                        <div id="prev"></div>
                        <div id="next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let search = () => {
            console.log('search init');
            // setup url and populate data

            // get category value
            let category = [...document.querySelectorAll('input[name=category]:checked')].map(e => e.value).toString();
            // get search value
            let search_q = document.querySelector('input[name=q]').value;
            
            let searchUrl = `/inventory?page=1&category=${category}&q=${search_q}`;

            console.log('should go to ', searchUrl);
            window.location.href = searchUrl;

        };

        window.addEventListener('load', async function () {
            console.log('in inventory.index');
            const urlParams = new URLSearchParams(window.location.search); 
            let page = urlParams.get('page') || "1";
            let search_q = urlParams.get('q') || "";
            let category = urlParams.get('category') || "";
            axios.get(`/api/inventory?page=${page}&q=${search_q}&category=${category}`).then(e => {
                let elm = document.getElementById('inventory-index');
                let elmt = document.getElementById('inventory-table');
                console.log('e', e);
                e.data.inventory.data.forEach(element => {
                    elmt.innerHTML += `
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                ${element.name}
                            </td>
                            <td class="px-6 py-4">
                                ${element.cat_name}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="/inventory/${element.id}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">View</a>
                            </td>

                        </tr>
                    `;
                });



                if(e.data.inventory.current_page != 1){
                    let prevElm = document.getElementById('prev');
                    prevElm.innerHTML = `<a href="/inventory?page=${e.data.inventory.current_page-1}&q=${search_q}&category=${category}" class="flex items-center justify-center px-4 h-10 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"> Previous </a>`;
                }

                if(e.data.inventory.current_page != e.data.inventory.last_page ){
                    let nextElm = document.getElementById('next');
                    nextElm.innerHTML = `  <a href="/inventory?page=${e.data.inventory.current_page+1}&q=${search_q}&category=${category}" class="flex items-center justify-center px-4 h-10 ms-3 text-base font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"> Next </a>`;
                }
            })
        });

    </script>
</x-app-layout>