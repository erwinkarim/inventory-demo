<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Admin') }}
		</h2>
	</x-slot>

	<div class="pt-12 pb-6">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">
					{{ __("Inventory Count: ").$invCount }}
				</div>
				<div class="p-6 text-gray-900 dark:text-gray-100">
					@can('create inventory')
						<x-primary-button onclick="pumpit()">Pump It</x-primary-button>
						- Generates 1000 Inventory objects
					@endcan
					@cannot('create inventory')
						{{ __("You can't create inventory") }}
					@endcannot
				</div>
			</div>
		</div>
	</div>

	<div class="py-3">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">
					{{ __("User management") }}
						<br />
						<br />
						@can('manage users')
							<table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
								<thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
									<tr>
										<th scope="col" class="px-6 py-3">ID</th> 
										<th scope="col" class="px-6 py-3">Name</th> 
										<th scope="col" class="px-6 py-3">Email</th> 
										<th scope="col" class="px-6 py-3">Role</th> 
										<th scope="col" class="px-6 py-3">Action</th> 
									</tr>
								</thead>
								<tbody id="user-table"></tbody>
							</table>
							<br />
							<x-primary-button onclick="generateUser()">Generate User</x-primary-button>
						@endcan
						@cannot('manage users')
							{{ __("You can't manage users") }}
						@endcannot
					</div>
			</div>
		</div>
	</div>

	<script>
		let pumpit = () => {
			axios.post('/api/inventory/pump').then(e => {
				console.log('pumped');
				alert('1000 new inventory objects created');
				window.location.reload();

			});
			console.log('pump button clicked');
		};

		let loadUser = () => {
			axios('/api/users').then(e => {
				console.log('users', e);
				let tableHandle = document.getElementById('user-table');
				tableHandle.innerHTML = '';
				e.data.users.forEach(element => {
					tableHandle.innerHTML += `
						<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
							<th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">${ element.id}</th>
							<td>${ element.name }</td> <td>${ element.email }</td>
							<td>Admin/Guest/Custom</td>
							<td>
								<x-link-button href="/admin/${ element.id }">Edit</x-link-button>
								<x-danger-button onclick="deleteUser(${element.id})">Delete</x-danger-button>
							</td>
						</tr>
					`;
				});
			});
		}

		let generateUser = () => {
			console.log('generate user clicked');

		};
		
		let deleteUser = (id) => {
			console.log(`delete user ${id}`);
		}

		window.addEventListener('load', async function () {
			console.log('in admin page');
			loadUser();

		});


	</script>
</x-app-layout>
