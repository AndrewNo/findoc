/*Show images*/
document.querySelector('.add_img').addEventListener('click', function () {
    document.querySelector('.images').style.display = 'block';

    document.querySelectorAll('.images ul li img').forEach(function (item) {
        item.addEventListener('click', function () {
            console.dir(this)
            document.querySelector('form img').src = this.src;
            document.querySelector('input[name="pic"]').value = this.attributes[0].value;
            document.querySelector('.images').style.display = 'none';
        });
    });
});