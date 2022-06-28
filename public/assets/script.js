document.querySelectorAll('a[data-target]').forEach( obj => obj.addEventListener('click', () => {
    document.cookie = obj.getAttribute('data-target');
    location.href = "."
}));