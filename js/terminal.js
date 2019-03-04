class Terminal {

	constructor() {
		this.elTerminal     = document.getElementById('terminal');
		this.elTerminalTime = document.getElementById('terminal-time');
		this.elInput        = document.querySelector('#terminal input');
		this.elForm         = document.getElementById('terminal-form');
		this.elHeader       = document.querySelector('.terminal-header');
		this.files    		= {
			'about': {
				'who-am-i': '/who',
				'contact' : '/contact'
			},
			'blog': '/blog',
			'projects': '/projects',
		};
		this.cwd = [];

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
		const response = this.responseTo(inputText)

		this.printTerminalLines(response);

		// Clear the form input
		this.elInput.value = '';

		// Add a new "header"
		const newHeader     = this.elHeader.cloneNode(true);
		const newHeaderTime = newHeader.querySelector('.timestamp');
		const now = new Date();
		newHeaderTime.innerHTML = `[${now.getHours()}:${now.getMinutes()}:${now.getSeconds()}]`;

		this.elTerminal.insertBefore(newHeader, this.elForm);
	}

	printTerminalLines( responseText ) {
		const responseP = document.createElement('p');
		responseP.classList = 'terminal-response';

		if ('string' === typeof(responseText)) {
			responseText = [ responseText ];
		}

		responseText.forEach( function (line) {
			// I THINK that creating a text node like this escapes stuff and keeps me safe from XSS attacks
			const responseText = document.createTextNode(line);
			responseP.appendChild(responseText);
			const responseBreak = document.createElement('br');
			responseP.appendChild(responseBreak);
		} );

		this.elTerminal.insertBefore(responseP, this.elForm);

	}

	responseTo( inputText ) {
		if (inputText == 'ls') {
			return this.ls();
		} else if (inputText == 'pwd') {
			return '/home/rosswintle.uk/' . this.cwd.join('/');
		} else if (inputText == 'cat README.txt' || inputText == 'less README.txt') {
			return `ROSS WINTLE'S PERSONAL BLOG
			       ----------------------------

			       You should probably start by visiting the about page!`.split("\n");
		} else if (inputText.startsWith('cat')) {
			return 'cat: No such file or directory';
		} else if (inputText.startsWith('cd')) {
			return this.cd(inputText.split(' ')[1]);
		}
		return 'Aha! You got the right idea, but the terminal isn\'t working yet.';

	}

	ls() {
		return this.createListing(this.currentDirectoryFiles());
	}

	currentDirectoryFiles() {
		return this.directoryFiles(this.cwd, this.files);
	}

	directoryFiles( path, files ) {
		if (0 === path.length) {
			return files;
		}

		return this.directoryFiles( path.splice(1), files[path[0]] );
	}

	createListing( files ) {
		let output = "";
		for (let file in files) {
			if ('string' === typeof(files[file])) {
				// Make this a link?
				output += ('   ' + file);
			} else {
				output += ('   ' + file + '/');
			}
		}
		return output;
	}

	cd( directory ) {
		const currentFiles = this.currentDirectoryFiles();
		if ('..' === directory && this.cwd.length > 0) {
			this.cwd.pop();
			return '';
		}
		if (currentFiles.hasOwnProperty(directory) && 'object' === typeof(currentFiles[directory])) {
			this.cwd.push(directory);
			return '';
		} else {
			return 'cd: no such file or directory';
		}
	}


}

const rw_terminal = new Terminal;
