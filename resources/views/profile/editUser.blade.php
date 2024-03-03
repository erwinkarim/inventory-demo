<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Edit User '.$user -> name) }}
		</h2>
	</x-slot>

	<div class="pt-12 pb-6">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">
					{{ $user }}
				</div>
			</div>
		</div>
	</div>

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
		let clickUpdate = () => {
			console.log('update clicked');
		}

		let clickDelete = () => {
			console.log('delete clicked');
		}
	</script>
</x-app-layout>
