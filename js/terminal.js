class Terminal {

	constructor() {
		this.elTerminal     = document.getElementById('terminal');
		this.elTerminalTime = document.getElementById('terminal-time');
		this.elInput        = document.querySelector('#terminal input');
		this.elForm         = document.getElementById('terminal-form');
		this.elHeader       = document.querySelector('.terminal-header');
		this.files    		= {
			'about': {
				type: 'dir',
				entries: {
					'who-am-i': {
						type: 'url',
						url: '/who'
					},
					'contact': {
						type: 'url',
						url: '/contact'
					}
				}
			},
			'blog': {
				type: 'url',
				url: '/blog'
			},
			'projects': {
				type: 'url',
				url: '/projects'
			},
			'README.txt': {
				type: 'text',
				text: `ROSS WINTLE'S PERSONAL BLOG
			       ----------------------------

			       You should probably start by visiting the about page!`
			}
		};
		this.cwd = [];

		this.elInput.focus();
		this.elInput.select();

		this.elForm.addEventListener('submit', function (e) {
			e.preventDefault();
			rw_terminal.updateTerminal();
		});
	}

	padInt( num, digits ) {
		if ('number' === typeof(num)) {
			num = num.toString();
		}
		while (num.length < digits) {
			num = "0" + num;
		}
		return num;
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
		newHeaderTime.innerHTML = `[${this.padInt(now.getHours(), 2)}:${this.padInt(now.getMinutes(), 2)}:${this.padInt(now.getSeconds(), 2)}]`;

		this.elTerminal.insertBefore(newHeader, this.elForm);
	}

	printTerminalLines( responseText ) {

		const responseP = document.createElement('p');
		responseP.classList = 'terminal-response';

		if (responseText instanceof Node) {
			responseP.appendChild(responseText);
		} else {
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
		}

		this.elTerminal.insertBefore(responseP, this.elForm);

	}

	responseTo( inputText ) {
		if (inputText == 'ls') {
			return this.ls();
		} else if (inputText == 'pwd') {
			return '/home/rosswintle.uk/' + this.cwd.join('/');
		} else if (inputText.startsWith('cat') || inputText.startsWith('less')) {
			return this.cat(inputText.split(' ')[1]);
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

		return this.directoryFiles( path.splice(1), files[path[0]]['entries'] );
	}

	createListing( files ) {
		let output = document.createElement('span');
		for (let file in files) {
			if ('url' === files[file]['type']) {
				let thisLink = document.createElement('a');
				thisLink.href = files[file]['url'];
				thisLink.appendChild(document.createTextNode(' ' + file));
				output.appendChild(thisLink);
			} else if ( 'text' === files[file]['type']) {
				output.appendChild(document.createTextNode(' ' + file));
			} else if ( 'dir' === files[file]['type']) {
				output.appendChild(document.createTextNode(' ' + file + '/'));
			}
		}
		return output;
	}

	cd( directory ) {
		const currentFiles = this.currentDirectoryFiles();
		if ('..' === directory) {
			if (this.cwd.length > 0) {
				this.cwd.pop();
			}
			return  '';
		}
		if (currentFiles.hasOwnProperty(directory) && 'dir' === currentFiles[directory]['type']) {
			this.cwd.push(directory);
			return '';
		} else {
			return 'cd: no such file or directory';
		}
	}

	cat( file ) {
		const currentFiles = this.currentDirectoryFiles();
		if (currentFiles.hasOwnProperty(file) && 'text' === currentFiles[file]['type']) {
			return currentFiles[file]['text'].split("\n");
		}
	}


}

const rw_terminal = new Terminal;
