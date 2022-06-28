document.querySelectorAll('a[data-target]').forEach( obj => obj.addEventListener('click', e => {
    e.preventDefault();
    document.cookie = obj.getAttribute('data-target');
    location.href = "."
}));