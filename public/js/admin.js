const $ = (el) => document.querySelector(el);

const newbies = $('.newbies');
const reservation = $('.reservation');
const bookers = $('.bookers');
const subscribers = $('.subscribers');
const target = $('#target');

//Newbies button click event

window.onload = () => {
    target.innerHTML = 'chargement...';
    newbies.classList.add('active');
    fetch('/admin/newbies', {
        method: 'get',
        headers: {'Content-type': 'text/html'}
    })
    .then(res => res.text()
    .then(data => {
        target.innerHTML = data;
    }))
}

newbies.addEventListener('click', (e) => {
    target.innerHTML = 'chargement...';
    const el = e.target;
    el.classList.add('active');
    if(reservation.classList.value.includes('active')) reservation.classList.remove('active');
    else if(bookers.classList.value.includes('active')) bookers.classList.remove('active');
    else if(subscribers.classList.value.includes('active')) subscribers.classList.remove('active');
    fetch('/admin/newbies', {
        method: 'get',
        headers: {'Content-type': 'text/html'}
    })
    .then(res => res.text()
    .then(data => {
        target.innerHTML = data;
    }))
});

reservation.addEventListener('click', (e) => {
    target.innerHTML = 'chargement...';
    const el = e.target;
    el.classList.add('active');
    if(newbies.classList.value.includes('active')) newbies.classList.remove('active');
    else if(bookers.classList.value.includes('active')) bookers.classList.remove('active');
    else if(subscribers.classList.value.includes('active')) subscribers.classList.remove('active');
    fetch('/admin/reservations', {
        method: 'get',
        headers: {'Content-type': 'text/html'}
    })
    .then(res => res.text()
    .then(data => {
        target.innerHTML = data;
    }))
});

bookers.addEventListener('click', (e) => {
    target.innerHTML = 'chargement...';
    const el = e.target;
    el.classList.add('active');
    if(newbies.classList.value.includes('active')) newbies.classList.remove('active');
    else if(reservation.classList.value.includes('active')) reservation.classList.remove('active');
    else if(subscribers.classList.value.includes('active')) subscribers.classList.remove('active');
    fetch('/admin/bookers', {
        method: 'get',
        headers: {'Content-type': 'text/html'}
    })
    .then(res => res.text()
    .then(data => {
        target.innerHTML = data;
    }))
});

subscribers.addEventListener('click', (e) => {
    target.innerHTML = 'chargement...';
    const el = e.target;
    el.classList.add('active');
    if(newbies.classList.value.includes('active')) newbies.classList.remove('active');
    else if(bookers.classList.value.includes('active')) bookers.classList.remove('active');
    else if(reservation.classList.value.includes('active')) reservation.classList.remove('active');
    fetch('/admin/subscribers', {
        method: 'get',
        headers: {'Content-type': 'text/html'}
    })
    .then(res => res.text()
    .then(data => {
        target.innerHTML = data;
    }))
});
