require('./bootstrap');

var add_image = document.querySelector('div.add_img');

add_image.addEventListener('click', function () {
    document.querySelector('.images').style.display = 'block';
});