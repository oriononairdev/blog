require('../bootstrap');
import { Terminal } from 'xterm';

const term = new Terminal();
let curr_line = "";
term.open(document.getElementById('terminal'));

function runTerminal() {
    if (term._initialized) {
        return;
    }
    term._initialized = true;

    term.prompt = () => {
        term.write('\r\n\x1B[1;3;31mterminal\x1B[0m $ ');
    };

    term.writeln('public commands: login, logout, register');
    term.write('\x1B[1;3;31mterminal\x1B[0m $ ')

    term.onData(key => {
        switch (key) {
            case '\r': // Enter
                if (curr_line) {
                    switch (curr_line) {
                        case 'login':
                            window.location.replace('https://mucahitugur.com/login');
                            break;
                        case 'register':
                            window.location.replace('https://mucahitugur.com/register');
                            break;
                        case 'i am orion':
                            window.location.replace('https://mucahitugur.com/admin');
                            break;
                        case 'logout':
                            document.forms["logout-form"].submit();
                            break;
                        default:
                            prompt(term);
                    }
                } else {
                    prompt(term);
                }
                break;
            case '\u007F': // Backspace (DEL)
                // Do not delete the prompt
                if (term._core.buffer.x > 11) {
                    term.write('\b \b');
                }
                break;
            default:
                curr_line += key;
                term.write(key);
        }
    })
}

function prompt(term) {
    term.write('\r\n\x1B[1;3;31mterminal\x1B[0m $ ');
    curr_line="";
}

runTerminal();
