require('./bootstrap');

var modal_add_account = document.getElementById('show-modal');
var modal_mask = document.querySelector('.modal-mask');
var modal_catgory = document.querySelector('div.modal-catgory');

modal_add_account.addEventListener('click', function () {

    modal_mask.style.display = 'table';

    var add_category = document.querySelector('div.add_category');

    add_category.addEventListener('click', function () {


        document.querySelector('.modal-container').style.visibility = 'hidden';

        modal_catgory.style.display = 'table';

        var add_img_button = document.querySelector('.modal-body .add_img');

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

        window.addEventListener("keydown", function (e) {
            if (e.keyCode == 27) {
                modal_catgory.style.display = 'none';
                document.querySelector('.modal-container').style.visibility = 'visible';
            }
        }, true);

        document.querySelector('.modal-catgory .modal-default-button').addEventListener('click', function () {
            modal_catgory.style.display = 'none';
            document.querySelector('.modal-container').style.visibility = 'visible';
        });


        document.querySelector('.modal-catgory input[type="submit"]').addEventListener('click', function (e) {
            e.preventDefault();
            var title = document.querySelector('.modal-catgory input[name="category_title"]').value;
            var pic = document.querySelector('.modal-catgory input[name="pic"]').value;
            var type = document.querySelector('.modal-catgory input[name="type"]').value;

            axios.post('category/add', {
                category_title: title,
                category_pic: pic,
                type: type
            })
                .then(function (response) {
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                });

        });

    });

    document.querySelector('.modal-default-button').addEventListener('click', function () {
        modal_mask.style.display = 'none';
    });

});








