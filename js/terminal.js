class Terminal {

	constructor() {
		this.elTerminal = document.getElementById('terminal');
		this.elTerminalTime = document.getElementById('terminal-time');
		this.elInput = document.querySelector('#terminal input');

		this.elInput.focus();
		this.elInput.select();
		//const now = new Date();
		//this.terminalTime.innerHTML = `[${now.getHours()}:${now.getMinutes()}:${now.getSeconds()}]`;
	}


}

const rw_terminal = new Terminal;
