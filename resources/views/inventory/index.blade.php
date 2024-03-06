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
                console.log('e', e);
                e.data.inventory.data.forEach(element => {
                    elm.innerHTML += `<x-card catName="${element.cat_name}" theID="${element.id}" name="${element.name}" desc="${element.desc}" picture="${element.picture}" />`;
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