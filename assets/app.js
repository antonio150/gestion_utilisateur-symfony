import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

let isSidebarCollapsed = window.matchMedia('(max-width: 991px)').matches;

const updateSidebarState = () => {
	const sidebar = document.querySelector('.sidebar');
	const sidebarToggle = document.querySelector('.sidebar-toggle');

	if (!sidebar || !sidebarToggle) {
		return;
	}

	sidebar.classList.toggle('is-collapsed', isSidebarCollapsed);
	document.body.classList.toggle('sidebar-collapsed', isSidebarCollapsed);
	sidebarToggle.setAttribute('aria-expanded', String(!isSidebarCollapsed));
	sidebarToggle.setAttribute(
		'aria-label',
		isSidebarCollapsed ? 'Agrandir la barre latérale' : 'Réduire la barre latérale'
	);
	sidebarToggle.setAttribute(
		'title',
		isSidebarCollapsed ? 'Agrandir la barre latérale' : 'Réduire la barre latérale'
	);
	sidebarToggle.querySelector('.toggle-icon').textContent = isSidebarCollapsed ? '›' : '‹';
};

document.addEventListener('click', (event) => {
	if (!event.target.closest('.sidebar-toggle')) {
		return;
	}

	isSidebarCollapsed = !isSidebarCollapsed;
	updateSidebarState();
});

document.addEventListener('turbo:load', updateSidebarState);
updateSidebarState();

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
