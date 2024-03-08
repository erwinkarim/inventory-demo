<div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
	<a href="/inventory/{{ $theID }}">
			<img class="rounded-t-lg h-auto max-w-full " src="{{ $picture }}" alt="" />
	</a>
	<div class="p-5">
			<a href="#">
					<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $name }}</h5>
			</a>
			<h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $catName }}</h5>
			<p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $desc }}</p>
	</div>
</div>

