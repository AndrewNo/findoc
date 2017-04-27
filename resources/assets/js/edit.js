var change_img = document.querySelector('.account_edit .add_img');

change_img.addEventListener('click', function () {

    var images_list = document.querySelector('.account_edit .images');

    images_list.style.display = 'block';

    var account_image = document.querySelectorAll('.account_edit .images ul li');
    account_image.forEach(function (item) {
        item.addEventListener('click', function () {
            var img = document.querySelector('.account_edit .add_img img');
            img.src = this.children[0].attributes[0].value;

            document.querySelector('input[name="pic"]').value = this.children[0].attributes[0].value;
            images_list.style.display = 'none';

        })
    });


});
