class Terminal {

	constructor() {
		this.elTerminal     = document.getElementById('terminal');
		this.elTerminalTime = document.getElementById('terminal-time');
		this.elInput        = document.querySelector('#terminal input');
		this.elForm         = document.getElementById('terminal-form');
		this.elHeader       = document.querySelector('.terminal-header');

		this.elInput.focus();
		this.elInput.select();

		this.elForm.addEventListener('submit', function (e) {
			e.preventDefault();
			rw_terminal.updateTerminal();
		});
	}

	updateTerminal() {
		// Copy the input line
		const inputText = this.elInput.value;
		const newP = document.createElement('p');
		newP.innerHTML = inputText;
		this.elTerminal.insertBefore(newP, this.elForm);

		// Display a response
		const responseP = document.createElement('p');
		responseP.classList = 'terminal-response';
		responseP.innerHTML = this.responseTo(inputText) + '<br><br>';
		this.elTerminal.insertBefore(responseP, this.elForm);

		// Clear the form input
		this.elInput.value = '';

		// Add a new "header"
		const newHeader     = this.elHeader.cloneNode(true);
		const newHeaderTime = newHeader.querySelector('.timestamp');
		const now = new Date();
		newHeaderTime.innerHTML = `[${now.getHours()}:${now.getMinutes()}:${now.getSeconds()}]`;

		this.elTerminal.insertBefore(newHeader, this.elForm);
	}

	responseTo( inputText ) {
		if (inputText == 'ls') {
			return 'README.txt';
		} else if (inputText == 'pwd') {
			return '/home/rosswintle.uk';
		} else if (inputText == 'cat README.txt' || inputText == 'less README.txt') {
			return `ROSS WINTLE'S PERSONAL BLOG<br>
			       ----------------------------<br>
			       <br>
			       You should probably start by visiting the about page!`;
		} else if (inputText.startsWith('cat')) {
			return 'cat: No such file or directory';
		} else if (inputText.startsWith('cd')) {
			return 'cd: Don\'t be silly, it\'s not a REAL terminal!';
		}
		return 'Aha! You got the right idea, but the terminal isn\'t working yet.';

	}

}

const rw_terminal = new Terminal;
