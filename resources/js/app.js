require('./bootstrap');
require('./students');
require('./home');

const nav = document.querySelector('nav');

const app = document.getElementById('app');
const loading = document.createElement('div');
loading.className = 'loading';
const loader = document.createElement('div');
loader.className = 'loader';
loading.appendChild(loader);
app.appendChild(loading);

app.querySelector('main').classList = 'is-loading';

window.addEventListener('load', () => {
    app.querySelector('main').classList.remove('is-loading');
    app.querySelector('main').classList.add('pt-4');
    app.querySelector('main').classList.add('mt-5');
    app.removeChild(loading);
});
