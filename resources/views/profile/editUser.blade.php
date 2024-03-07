<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Edit User '.$user -> name) }}
		</h2>
	</x-slot>

	<form id="user-form" method="post"> 
		<div class="pt-12 pb-3">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-6 text-gray-900 dark:text-gray-100">
						<div class="mb-5">
							<label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name email</label>
							<input type="text" name="name" value="{{ $user -> name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
						</div>
						<div class="mb-5">
							<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
							<input disabled type="email" name="email" value="{{ $user -> email }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="pt-3 pb-3">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
					<div class="p-6 text-gray-900 dark:text-gray-100">
						<fieldset>
							<legend>Roles & Permissions</legend>
							@foreach($roles as $role)
								<div class="flex items-center mb-4" onclick="clickOtherRoles()">
									<input id="role-option-{{ $role -> id }}" type="radio" name="roles" value="{{ $role -> id }}" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" 
									{{ $user -> roles -> where('id', $role -> id) -> count() != 0 ? 'checked' : '' }} />
									<label for="role-option-{{ $role -> id }}" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
										{{ $role -> name }}
									</label>
								</div>
							@endforeach
							<div class="flex items-center mb-4">
								<input id="role-option-0" type="radio" name="roles" value="0" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" 
									{{ $user -> permissions -> count() > 0 ? 'checked' : '' }}
								/>
								<label for="role-option-0" class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
									Custom
								</label>
							</div>
						</fieldset>
						<fieldset>
							<legend class="sr-only">Checkbox variants</legend>
							@foreach($permissions as $permission)
								<div class="flex items-center mb-4" onclick="clickCheckbox()">
										<input id="checkbox-{{ $permission -> id }}" type="checkbox" name="permissions[]" value="{{ $permission -> id }}" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" 
										{{ $user -> permissions -> where('id', $permission -> id) -> count() != 0 ? 'checked' : '' }} 
										/>
										<label for="checkbox-{{ $permission -> id}}" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
											{{ $permission -> name }}
										</label>
								</div>
							@endforeach
						</fieldset>
				</div>
			</div>
		</div>
	</div>
</form>

<div class="py-3">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
			<div class="p-6 text-gray-900 dark:text-gray-100">
				<x-primary-button type="button" onclick="clickUpdate()">Update</x-primary-button>
				<x-link-button-alt href="{{ route('profile.admin') }}">Cancel</x-link-button-alt>
				<x-danger-button type="button" onclick="clickDelete()">Delete</x-danger-button>
			</div>
		</div>
	</div>
</div>

<script>
	let clickDelete = () => {
		console.log('delete clicked');
	};

	let clickOtherRoles = () => {
		console.log('click other roles');
		Array.from(document.querySelectorAll('input[type=checkbox]')).forEach(el => {el.checked = false;})
	};

	// if the user click on the checkbox, move the radio button to custom
	let clickCheckbox = () => {
		console.log('checkbox clicked')
		document.getElementById('role-option-0').checked = true;
	};

	let clickUpdate = () => {
		console.log('update user')
		
		// build and populate form
		let handle = document.getElementById('user-form');
		let form = new FormData(handle);

		axios({
			method: "post",
			url: "{{ route('api.users.update', $user -> id )}}",
			data: form,
			headers: { "Content-Type": "multipart/form-data" },
		}).then(e => {
			alert('user updated');
			window.location = '/admin';
		});

	}


	window.addEventListener('load', async function () {
		// f the user click on checkbox-??, make sure that checkbox is unchecked
	})
</script>
</x-app-layout>
