class Settings {

	constructor() {
		this.mode = 'dark';
		this.settingsButton = document.getElementById('settings-button');
		this.settingsArea = document.getElementById('settings-area');
		this.themeRadioButtons = document.querySelectorAll('input[name="user-theme"]');

		/* Set the theme */
		const theme = document.querySelector('input[name="user-theme"]:checked').value;
		document.documentElement.classList.add(`theme-${theme}`);

		/* Event handler for expanding the settings */
		this.settingsButton.addEventListener( 'click',
			function (e) {
				e.preventDefault();
				rw_settings.settingsArea.classList.toggle('open');
			});

		/* Event handler for theme radio buttons */
		this.themeRadioButtons.forEach(
			function (item) {
				item.addEventListener('click',
					function(e) {
						const newTheme = e.target.value;
						const oldTheme = docCookies.getItem('rw_user_theme');
						docCookies.setItem('rw_user_theme', newTheme, null, '/');
						document.documentElement.classList.remove(`theme-${oldTheme}`);
						document.documentElement.classList.add(`theme-${newTheme}`);
					});
			});


	}

}

const rw_settings = new Settings();
