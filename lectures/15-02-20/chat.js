class Helpers {
    static apiUrl = '/nordic-master/web/lectures/15-02-20/';

    static headers = () => ({
        'ContentType': 'application/json',
        'Application-Type': 'application/json'
    });
}

class Chat {
    from = 'from'; // свойство | поле
    to = 'to';
    token = '';
    lastUpdate = new Date();

    constructor () {

    }

    login(login, password) { // действие | метод
        const self = this;

        fetch (
            Helpers.apiUrl + 'login.php',
            {
                method: 'post',
                headers: Helpers.headers(),
                body: JSON.stringify({
                    login: login,
                    password: password
                })
            }
        ).then(function (res) { 
            return res.json();
        }).then(function (res) {
            self.token = res.token;
            self.from = login;
        }).catch(function (err) {
            console.log(err);
        });
    }

    changeDialog(to) {
        // this.classList.add('active');
        // document.getElementById('to').value = this.innerText;
        this.to = to;

        return fetch(
            Helpers.apiUrl + 'messages.php?from='+this.from+'&to='+this.to,
            {
                method: 'get',
                headers: Helpers.headers()
            }
        ).then(function (res) {
            return res.json();
        }).catch(function (err) {
            console.log(err);
        });
    }

    sendMessage(text) {
        // const text = document.getElementById('message').value;
        // const message = document.createElement('div');
        // message.innerText = text;
        // message.classList.add('from');
        // document.getElementById('messages').appendChild(message);
        // document.getElementById('message').value = '';

        fetch (
            Helpers.apiUrl + 'message.php',
            {
                method: 'post',
                headers: Helpers.headers(),
                body: JSON.stringify({
                    from: this.from,
                    to: this.to,
                    message: text
                })
            }
        ).catch(function (err) {
            console.log(err);
        });
    }

    getNewMessages = () => new Promise((resolve, reject) => {
        fetch(
            Helpers.apiUrl + 'now_messages.php?from='+this.from+'&to='+this.to+'&datetime='+this.lastUpdate.getTime(),
            {
                method: 'get',
                headers: Helpers.headers()
            }
        ).then(res => res.json()).then((res) => {
            if(res.messages.length > 0) {
                this.lastUpdate = new Date();
            }

            return resolve(res.messages);
        }).catch(err => reject(err));
    });
}

class privateChat extends Chat {
    constructor() {
        super();
    }
}

class CreateElements {
    
    constructor() {
        const app = document.getElementById('app');
        this.createForm(app);
        this.createMain(app);
    }

    createForm(app) {
        const form = document.createElement('form');
        app.appendChild(form);

        let type = [
            'text',
            'password',
            'submit'
        ];

        let nameInput = [
            'login',
            'password',
            'submit'
        ];

        for(let i = 0; i < 3; i++) {
            const input = document.createElement('input');
            
            input.type = type[i];
            input.name = nameInput[i];
            input.required = true;

            if(i == 0) {
                input.placeholder = 'login';
            }

            if(i == 1) {
                input.placeholder = 'password';
            }

            if(i == 2) {
                input.id = 'login';
                input.required = false;
                input.value = 'Войти';
            }
            
            form.appendChild(input);
        }
    }

    createMain(app) {
        const main = document.createElement('main');
        app.appendChild(main);

        let nameSection = [
            'users',
            'chat'
        ];

        for(let i = 0; i < 2; i++) {
            const section = document.createElement('section');
            section.className = nameSection[i];
            main.appendChild(section);
            
            if(i == 0) {
                fetch (
                    Helpers.apiUrl + 'users.php',
                    {
                        method: 'get',
                        headers: Helpers.headers(),
                    }
                ).then(function (res) { 
                    return res.json() 
                }).then(function (res) {
                    for (const user of res) {
                        const div = document.createElement('div');
                        div.classList.add('user');    
                        div.innerText = user;
                        section.appendChild(div);
                    }
                }).catch(function (err) {
                    console.log(err);
                });
            }

            if(i == 1) {

                let nameDiv = [
                    'messages',
                    'message'
                ]; 

                for(let j = 0; j < 2; j++) {
                    const div = document.createElement('div');
                    div.className = nameDiv[j];
                    if(j == 0) {
                        div.id = 'messages';
                    }
                    if(j == 1) {
                        let idInput = [
                            'from',
                            'to'
                        ];
                
                        for(let i = 0; i < 2; i++) {
                            const input = document.createElement('input');
                            
                            input.type = 'hidden';
                            input.id = idInput[i];
                            
                            div.appendChild(input);
                        }

                        const textarea = document.createElement('textarea');
                        textarea.id = 'message';

                        const button = document.createElement('button');
                        button.id = 'submit_message';
                        button.innerHTML = 'Send';

                        div.appendChild(textarea);
                        div.appendChild(button);
                    }
                    section.appendChild(div);
                }
            }
        }
    }
}

const create = new CreateElements();
const chat = new Chat();

// let lastUpdate = new Date();

document.getElementById('login').addEventListener('click', function (e) {
    e.preventDefault();
    chat.login(
        document.getElementsByName('login')[0].value,
        document.getElementsByName('password')[0].value
    );

    // [...document.getElementsByClassName('users')].map(function (el) {
    //     el.classList.add('show');
    // });

    // [...document.getElementsByClassName('chat')].map(function (el) {
    //     el.classList.add('show');
    // });
});

[...document.getElementsByClassName('user')].map(function (item) {
    item.addEventListener('click', function () {
        console.log('click');
        [...document.getElementsByClassName('user')].map(function (el) {
            el.classList.remove('active');
        });
        this.classList.add('active');

        chat.changeDialog(this.innerText).then(function (res) {
            document.getElementById('messages').innerHTML = '';

            for(const item of res.messages) {
                const el = document.createElement('div');
                el.classList.toggle(item.myself ? 'from' : 'to')
                el.innerText = item.text;
                document.getElementById('messages').appendChild(el);
            }
        });
    });
});

document.getElementById('submit_message').addEventListener('click', function () {
    const text = document.getElementById('message').value;
    const message = document.createElement('div');
    message.innerText = text;
    message.classList.add('from');
    document.getElementById('messages').appendChild(message);
    document.getElementById('message').value = '';

    chat.sendMessage(text);
});

const id = setInterval(function () {
        if (!!chat.from && !!chat.to) {
            chat.getNewMessages().then(function(messages) {
                for(const item of messages) {
                    const el = document.createElement('div');
                    el.classList.add(item.myself ? 'from' : 'to');
                    el.innerText = item.text;
                    document.getElementById('messages').appendChild(el);
                }
            }).catch(function(err) {
                console.log(err);
            });
        }  
    },
    10000
);