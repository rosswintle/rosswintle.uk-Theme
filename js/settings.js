class Settings {

	constructor() {
		/* Set the theme */
		document.addEventListener('DOMContentLoaded', this.addButtonHandlers);
	}

	addButtonHandlers() {
		const settingsButton = document.getElementById('settings-button');
		const settingsArea = document.getElementById('settings-area');
		const themeRadioButtons = document.querySelectorAll('input[name="user-theme"]');


		// Set the right radio button to on
		const theme = localStorage.getItem('site-theme');
		if (theme) {
			document.documentElement.classList.add(`theme-${theme}`);
			document.querySelector(`input[name="user-theme"][value="${theme}"]`).checked = true;
		}

		/* Event handler for expanding the settings */
		settingsButton.addEventListener('click',
			function (e) {
				e.preventDefault();
				settingsArea.classList.toggle('open');
			});

		/* Event handler for theme radio buttons */
		themeRadioButtons.forEach(
			function (item) {
				item.addEventListener('click',
					function (e) {
						const newTheme = e.target.value;
						const oldTheme = localStorage.getItem('site-theme');
						localStorage.setItem('site-theme', newTheme);
						document.documentElement.classList.remove(`theme-${oldTheme}`);
						document.documentElement.classList.add(`theme-${newTheme}`);
					});
			}
		);
	}
}

const rw_settings = new Settings();
