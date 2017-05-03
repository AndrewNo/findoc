require('./bootstrap');

var category_add = document.querySelector('.add_category');

category_add.addEventListener('click', function () {

    var modal_category = document.querySelector('.outcome_modal .category_add_new');

    modal_category.style.display = 'block';
    document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'hidden';

    var add_image = document.querySelector('div.add_img');

    add_image.addEventListener('click', function () {
        var images_list = document.querySelector('.images');
        images_list.style.display = 'block';

        var account_image = document.querySelectorAll('.outcome_modal .category_add_new form .images ul li');

        account_image.forEach(function (item) {
            item.addEventListener('click', function () {
                var img = document.createElement('img');
                img.src = this.children[0].attributes[0].value;
                img.style.width = '40px';

                add_image.innerText = '';
                add_image.appendChild(img);
                document.querySelector('input[name="pic"]').value = this.children[0].attributes[0].value;
                images_list.style.display = 'none';

            })
        });
    });

    document.querySelector('.category_add_new input[type="submit"]').addEventListener('click', function (e) {
        e.preventDefault();
        var title = document.querySelector('.category_add_new input[name="category_title"]').value;
        var pic = document.querySelector('.category_add_new input[name="pic"]').value;
        var type = document.querySelector('.category_add_new input[name="type"]').value;

        axios.post('category/add', {
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

                modal_category.style.display = 'none';
                document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'visible';
                document.querySelector('.outcome_modal .subcategory_block').style.display = 'inline-block';

                document.querySelector('.subcategory_add_new input[name="category_id"]').value = response.data.id;
                var subcategory_add = document.querySelector('.add_subcategory');

                subcategory_add.addEventListener('click', function () {
                    var modal_subcategory = document.querySelector('.outcome_modal .subcategory_add_new');

                    modal_subcategory.style.display = 'block';
                    document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'hidden';

                    var add_image = document.querySelector('.subcategory_add_new div.add_img');

                    add_image.addEventListener('click', function () {
                        var images_list = document.querySelector('.subcategory_add_new .images');
                        images_list.style.display = 'block';

                        var account_image = document.querySelectorAll('.outcome_modal .subcategory_add_new form .images ul li');

                        account_image.forEach(function (item) {
                            item.addEventListener('click', function () {
                                var img = document.createElement('img');
                                img.src = this.children[0].attributes[0].value;
                                img.style.width = '40px';

                                add_image.innerText = '';
                                add_image.appendChild(img);
                                document.querySelector('.subcategory_add_new input[name="pic"]').value = this.children[0].attributes[0].value;
                                images_list.style.display = 'none';

                            })
                        });
                    });


                    document.querySelector('.subcategory_add_new input[type="submit"]').addEventListener('click', function (e) {
                        e.preventDefault();
                        var title = document.querySelector('.subcategory_add_new input[name="subcategory_title"]').value;
                        var pic = document.querySelector('.subcategory_add_new input[name="pic"]').value;
                        var category_id = document.querySelector('.subcategory_add_new input[name="category_id"]').value;

                        axios.post('subcategory/add', {
                            subcategory_title: title,
                            subcategory_pic: pic,
                            category_id: category_id
                        })
                            .then(function (response) {
                                var select_subcategory = document.getElementById('subcategory_id');
                                var option = document.createElement('option');
                                option.value = response.data.id;
                                option.innerText = response.data.title;
                                option.setAttribute('selected', '');
                                select_subcategory.appendChild(option);

                                var img_subcategory = document.getElementById('img_subcategory');
                                img_subcategory.src = response.data.pic;

                                modal_subcategory.style.display = 'none';
                                document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'visible';
                                document.querySelector('.outcome_modal .subcategory_block').style.display = 'inline-block';

                            }).catch(function (error) {
                            console.log(error);
                        });


                    })

                })
                    .catch(function (error) {
                        console.log(error);
                    });

            });


    });
});


document.getElementById('category_add_exit').addEventListener('click', function () {
    console.log(this);
    document.querySelector('.outcome_modal .category_add_new').style.display = 'none';
    document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'visible';
});


document.getElementById('subcategory_add_exit').addEventListener('click', function () {
    document.querySelector('.outcome_modal .subcategory_add_new').style.display = 'none';
    document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'visible';
});

document.getElementById('seller_add_exit').addEventListener('click', function () {
    document.querySelector('.outcome_modal .seller_add_new').style.display = 'none';
    document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'visible';
});

document.getElementById('exit_add_outcome').addEventListener('click', function () {
    document.querySelector('.outcome_modal').style.display = 'none';
});

/*
 Currency
 */
var currency = document.getElementById('account_id');
currency.addEventListener('change', function () {
    var currency_title = this.options[this.selectedIndex].dataset.currency;

    document.querySelector('#total_sum + span').innerText = currency_title;
    document.querySelector('input[name="currency"]').value = currency_title;
});
/*
 Change category
 */
var category_change = document.getElementById('category_id');
category_change.addEventListener('change', function () {
    var category_img = this.options[this.selectedIndex].dataset.img;
    document.getElementById('img_category').src = category_img;

    var category_id = this.value;
    axios.post('subcategory/get', {
        category_id: category_id
    }).then(function (response) {

        var select_subcategory = document.getElementById('subcategory_id');
        select_subcategory.innerHTML = '';
        var default_option = document.createElement('option');
        default_option.innerText = "Choose subcategory";
        default_option.setAttribute('selected', '');
        default_option.setAttribute('disabled', '');
        select_subcategory.appendChild(default_option);
        response.data.forEach(function (item) {

            var option = document.createElement('option');
            option.value = item.id;
            option.innerText = item.title;
            option.setAttribute('data-pic', item.pic);

            select_subcategory.appendChild(option);
        });

        document.querySelector('.outcome_modal .subcategory_block').style.display = 'inline-block';


        document.getElementById('subcategory_id').addEventListener('change', function () {
            var subcategory_img = this.options[this.selectedIndex].dataset.pic;
            document.getElementById('img_subcategory').src = subcategory_img;
        });

        var subcategory_add = document.querySelector('.add_subcategory');
        subcategory_add.addEventListener('click', function () {
            var modal_subcategory = document.querySelector('.outcome_modal .subcategory_add_new');

            modal_subcategory.style.display = 'block';
            document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'hidden';

            var add_image = document.querySelector('.subcategory_add_new div.add_img');

            add_image.addEventListener('click', function () {
                var images_list = document.querySelector('.subcategory_add_new .images');
                images_list.style.display = 'block';

                var account_image = document.querySelectorAll('.outcome_modal .subcategory_add_new form .images ul li');

                account_image.forEach(function (item) {
                    item.addEventListener('click', function () {
                        var img = document.createElement('img');
                        img.src = this.children[0].attributes[0].value;
                        img.style.width = '40px';

                        add_image.innerText = '';
                        add_image.appendChild(img);
                        document.querySelector('.subcategory_add_new input[name="pic"]').value = this.children[0].attributes[0].value;
                        images_list.style.display = 'none';

                    })
                });
            });


            document.querySelector('.subcategory_add_new input[type="submit"]').addEventListener('click', function (e) {
                e.preventDefault();
                var title = document.querySelector('.subcategory_add_new input[name="subcategory_title"]').value;
                var pic = document.querySelector('.subcategory_add_new input[name="pic"]').value;
                var category_id = document.getElementById('category_id').value;

                axios.post('subcategory/add', {
                    subcategory_title: title,
                    subcategory_pic: pic,
                    category_id: category_id
                })
                    .then(function (response) {
                        var select_subcategory = document.getElementById('subcategory_id');
                        var option = document.createElement('option');
                        option.value = response.data.id;
                        option.innerText = response.data.title;
                        option.setAttribute('selected', '');
                        select_subcategory.appendChild(option);

                        var img_subcategory = document.getElementById('img_subcategory');
                        img_subcategory.src = response.data.pic;

                        modal_subcategory.style.display = 'none';
                        document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'visible';
                        document.querySelector('.outcome_modal .subcategory_block').style.display = 'inline-block';

                    }).catch(function (error) {
                    console.log(error);
                });
            });
        });
    }).catch(function (error) {
        console.log(error);
    });
});

document.querySelector('.add_seller').addEventListener('click', function () {
    document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'hidden';
    document.querySelector('.outcome_modal .seller_add_new').style.display = 'block';

    document.querySelector('.seller_add_new input[type="submit"]').addEventListener('click', function (e) {
        e.preventDefault();
        var title = document.querySelector('.seller_add_new input[name="seller_title"]').value;

        axios.post('seller/add', {
            seller_title: title
        })
            .then(function (response) {
                var select_seller = document.getElementById('seller_id');
                var option = document.createElement('option');
                option.value = response.data.id;
                option.innerText = response.data.title;
                option.setAttribute('selected', '');
                select_seller.appendChild(option);

                document.querySelector('.outcome_modal .seller_add_new').style.display = 'none';
                document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'visible';

            }).catch(function (error) {
            console.log(error);
        });
    });
});

document.querySelector('.add_outcome').addEventListener('click', function () {
    document.querySelector('.outcome_modal').style.display = 'block';
});