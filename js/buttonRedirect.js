function onClickShow() {
    var toolBox = document.querySelector('.tool-box');
    toolBox.style.display = 'flex';
    toolBox.classList.add('active');
}

var button = document.querySelector('#shareWithBtn');
button.addEventListener('click', onClickShow);


function onClickRedirect(redirectUrl) {
    window.open(redirectUrl, '__blank', "noopener");
}

