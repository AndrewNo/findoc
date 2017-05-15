var modal_add_account = document.getElementById('add_account_modal');
var modal_mask = document.querySelector('.modal-mask');
var add_img_button = document.querySelector('.modal-body .add_img');

/*Image add*/
add_img_button.addEventListener('click', function () {

    var images_list = document.querySelector('.modal-body .images');

    images_list.style.display = 'block';

    var account_image = document.querySelectorAll('.modal-body .images ul li');
    account_image.forEach(function (item) {
        item.addEventListener('click', function () {
            var img = document.createElement('img');
            img.src = this.children[0].attributes[0].value;
            img.style.width = '40px';

            add_img_button.innerText = '';
            add_img_button.appendChild(img);
            document.querySelector('input[name="pic"]').value = this.children[0].attributes[0].value;
            images_list.style.display = 'none';

        })
    });
});

/*Open modal window add account*/
modal_add_account.addEventListener('click', function () {
    modal_mask.style.display = 'table';
});

/*Close modal window add account*/
document.querySelector('.modal-default-button').addEventListener('click', function () {
    modal_mask.style.display = 'none';
    document.getElementById('title').value = '';
    document.getElementById('total_sum').value = '';
    document.getElementById('currency').value = 'UAH';
    document.querySelector('.add_img').innerText = 'Add image';
    document.querySelector('input[name="pic"]').value = '';
});

window.addEventListener("keydown", function(e){
    if (e.keyCode == 27) {
        modal_mask.style.display = 'none';
    }
}, true);





