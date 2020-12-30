// Autosize plugin

import autosize from 'autosize';

const elements = document.querySelectorAll('[data-toggle="autosize"]');
if (elements.length) {
	elements.forEach(function (element) {
		autosize(element);
	});
}
// Nested dropdowns

const selectors = '.dropdown, .dropup, .dropright, .dropleft',
	dropdowns = document.querySelectorAll(selectors);

let currentTarget = undefined;

dropdowns.forEach(dropdown => {
	dropdown.addEventListener('mousedown', (e) => {
		e.stopPropagation();

		if (e.target.dataset.toggle && e.target.dataset.toggle === 'dropdown') {
			currentTarget = e.currentTarget;
		}
	});

	dropdown.addEventListener('hide.bs.dropdown', (e) => {
		e.stopPropagation();

		const parent = currentTarget ? currentTarget.parentElement.closest(selectors) : undefined;

		if (parent && parent === dropdown) {
			e.preventDefault();
		}

		currentTarget = undefined;
	});
});
// Input mask plugin

import IMask from 'imask';

var maskElementList = [].slice.call(document.querySelectorAll('[data-mask]'));
maskElementList.map(function (maskEl) {
	return new IMask(maskEl, {
		mask: maskEl.dataset.mask,
		lazy: maskEl.dataset['mask-visible'] === 'true'
	})
});
//Vendor

import './autosize';
import './input-mask';
import './dropdown';

(function() {
	/**
	 */
	let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
	tooltipTriggerList.map(function (tooltipTriggerEl) {
		let options = {
			delay: {show: 50, hide: 50},
			html: true,
			placement: 'auto'
		};
		return new bootstrap.Tooltip(tooltipTriggerEl, options);
	});

	/**
	 */
	let popoverTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="popover"]'));
	popoverTriggerList.map(function (popoverTriggerEl) {
		let options = {
			delay: {show: 50, hide: 50},
			html: true,
			placement: 'auto'
		};
		return new bootstrap.Popover(popoverTriggerEl, options);
	});

	let dropdownTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="dropdown"]'));
	dropdownTriggerList.map(function (dropdownTriggerEl) {
		return new bootstrap.Dropdown(dropdownTriggerEl);
	});


	let switchesTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="switch-icon"]'));
	switchesTriggerList.map(function (switchTriggerEl) {
		switchTriggerEl.addEventListener('click', (e) => {
			e.stopPropagation();

			switchTriggerEl.classList.toggle('active');
		});
	});

})();