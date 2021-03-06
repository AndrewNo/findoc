require('./bootstrap');

var modal_mask = document.querySelector('.modal-mask');
var modal_catgory = document.querySelector('div.modal-catgory');
var modal_payer = document.querySelector('div.modal-payer');

var add_category = document.querySelector('div.add_category');
var add_payer = document.querySelector('div.add_payer');

add_category.addEventListener('click', function () {
    modal_mask.style.display = 'table';
    modal_catgory.style.display = 'table';
    modal_payer.style.display='none';

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
            modal_mask.style.display = 'none';
        }
    }, true);

    document.querySelector('.modal-catgory .modal-default-button').addEventListener('click', function () {
        modal_mask.style.display = 'none';
    });


    document.querySelector('.modal-catgory input[type="submit"]').addEventListener('click', function (e) {
        e.preventDefault();
        var title = document.querySelector('.modal-catgory input[name="category_title"]').value;
        var pic = document.querySelector('.modal-catgory input[name="pic"]').value;
        var type = document.querySelector('.modal-catgory input[name="type"]').value;

        axios.post('/category/add', {
            category_title: title,
            category_pic: pic,
            type: type
        })
            .then(function (response) {
                var select_category = document.getElementById('category_id');
                var option = document.createElement('option');
                option.value = response.data.id;
                option.innerText = response.data.title;
                option.setAttribute('selected', '');
                select_category.appendChild(option);

                var img_category = document.getElementById('img_category');
                img_category.src = response.data.pic;

                modal_mask.style.display = 'none';

            })
            .catch(function (error) {
                console.log(error);
            });

    });
});

add_payer.addEventListener('click', function () {
    modal_mask.style.display = 'table';
    modal_payer.style.display = 'table';
    modal_catgory.style.display = 'none';



    window.addEventListener("keydown", function (e) {
        if (e.keyCode == 27) {
            modal_mask.style.display = 'none';
                    }
    }, true);

    document.querySelector('.modal-payer .modal-default-button').addEventListener('click', function () {
        modal_mask.style.display = 'none';

    });


    document.querySelector('.modal-payer input[type="submit"]').addEventListener('click', function (e) {
        e.preventDefault();
        var title = document.querySelector('.modal-payer input[name="payer_title"]').value;

        axios.post('/payer/add', {
            payer_title: title
        })
            .then(function (response) {
                var select_payer = document.getElementById('payer_id');
                var option = document.createElement('option');
                option.value = response.data.id;
                option.innerText = response.data.title;
                option.setAttribute('selected', '');
                select_payer.appendChild(option);

                modal_mask.style.display = 'none';

            })
            .catch(function (error) {
                console.log(error);
            });

    });

});

var currency = document.getElementById('account');

currency.addEventListener('change', function () {
    var currency_title = this.options[this.selectedIndex].dataset.currency;

    document.querySelector('#total_sum + span').innerText = currency_title;
    document.querySelector('input[name="currency"]').value = currency_title;
});