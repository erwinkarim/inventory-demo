<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Create new inventory") }}
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form id="update-form">
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                              <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-4">
                                  <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Inventory Name</label>
                                  <div class="mt-2">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-xl">
                                      <input type="text" name="name" id="username" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="Name ..." value="{{ $inventory -> name }}">
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="col-span-full mt-2">
                                <label for="about" class="block text-sm font-medium leading-6 text-gray-900">Description</label>
                                <div class="mt-2">
                                  <textarea id="about" name="desc" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{ $inventory -> desc }}</textarea>
                                </div>
                              </div>

                              <div class="mt-2 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                <div class="sm:col-span-4">
                                  <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Picture URL</label>
                                  <div class="mt-2">
                                    <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-xl">
                                      <input type="text" name="picture" id="picture" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="http://picsum.photos/200/300" value="{{ $inventory -> picture }}">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <button type="button" class="bg-blue-500" onclick="clickCreate()">Create</button>
                    <a href="{{ route('inventory.index') }}">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        let clickCreate = () => {
            console.log('update button clicked');
            let form = document.getElementById('update-form');
            let formData = new FormData(form)
            axios({
              method: 'post', 
              url: "{{ route('api.inventory.store') }}",
              data: formData,
              headers: { "Content-Type": "multipart/form-data" },
            }).then((e) => {
              alert('inventory created');
              window.location.href=`/inventory/${e.data.inventory.id}`;
            }).catch((err) => {
              // display error messages
              if(err.response){
                alert(`Error creating inventory: ${err.response.data.message}`);
              }
            });
        }
    </script>
</x-app-layout>