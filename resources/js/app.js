import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

console.log('in app.js');

/*
let test = async () => {
	await axios.get('/sanctum/csrf-cookie').then(response => {
		// Login...
		console.log(response);
	});
	await axios.get('/api/inventory', {
		headers: {
			'Accept': "Application/json",
		}
	}).then(response => {
		console.log(response);
	});
};

test();
*/
