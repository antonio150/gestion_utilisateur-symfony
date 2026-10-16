import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

const sidebar = document.querySelector('.sidebar');
const sidebarToggle = document.querySelector('.sidebar-toggle');

if (sidebar && sidebarToggle) {
	const isMobile = window.matchMedia('(max-width: 991px)').matches;

	if (isMobile) {
		sidebar.classList.add('is-collapsed');
	}

	const updateSidebarState = (isCollapsed) => {
		document.body.classList.toggle('sidebar-collapsed', isCollapsed);
		sidebarToggle.setAttribute('aria-expanded', String(!isCollapsed));
		sidebarToggle.setAttribute(
			'aria-label',
			isCollapsed ? 'Agrandir la barre latérale' : 'Réduire la barre latérale'
		);
		sidebarToggle.setAttribute(
			'title',
			isCollapsed ? 'Agrandir la barre latérale' : 'Réduire la barre latérale'
		);
		sidebarToggle.querySelector('.toggle-icon').textContent = isCollapsed ? '›' : '‹';
	};

	updateSidebarState(sidebar.classList.contains('is-collapsed'));

	sidebarToggle.addEventListener('click', () => {
		const isCollapsed = sidebar.classList.toggle('is-collapsed');
		updateSidebarState(isCollapsed);
	});
}

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
