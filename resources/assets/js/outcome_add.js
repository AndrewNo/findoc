require('./bootstrap');

/*Open modal window add outcome*/
document.querySelector('.add_outcome').addEventListener('click', function () {
    document.querySelector('.outcome_modal').style.display = 'block';
});

/*Change account*/
document.getElementById('account_id').addEventListener('change', function () {
    var currency_title = this.options[this.selectedIndex].dataset.currency;
    document.querySelector('#total_sum + span').innerText = currency_title;
    document.querySelector('input[name="currency"]').value = currency_title;
});

/*Add category open modal window*/
document.querySelector('.add_category').addEventListener('click', function () {
    document.querySelector('.outcome_modal .category_add_new').style.display = 'block';
    document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'hidden';
});

/*Show category images*/
document.querySelector('.category_add_new div.add_img').addEventListener('click', function () {
    var images_list = document.querySelector('.images');
    images_list.style.display = 'block';
    var account_image = document.querySelectorAll('.outcome_modal .category_add_new form .images ul li');
    account_image.forEach(function (item) {
        item.addEventListener('click', function () {
            var img = document.createElement('img');
            img.src = this.children[0].attributes[0].value;
            img.style.width = '40px';

            document.querySelector('.category_add_new div.add_img').innerText = '';
            document.querySelector('.category_add_new div.add_img').appendChild(img);
            document.querySelector('input[name="pic"]').value = this.children[0].attributes[0].value;
            images_list.style.display = 'none';

        })
    });
});

/*Create new category*/
document.querySelector('.category_add_new input[type="submit"]').addEventListener('click', function (e) {
    e.preventDefault();

    axios.post('category/add', {
        category_title: document.querySelector('.category_add_new input[name="category_title"]').value,
        category_pic: document.querySelector('.category_add_new input[name="pic"]').value,
        type: document.querySelector('.category_add_new input[name="type"]').value
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


            document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'visible';
            document.querySelector('.outcome_modal .subcategory_block').style.display = 'inline-block';
            document.querySelector('.subcategory_add_new input[name="category_id"]').value = response.data.id;
            document.getElementById('category_title').value = '';
            document.querySelector('.category_add_new div.add_img').innerText = 'Add image';
            document.querySelector('.category_add_new input[name="pic"]').value = '';
            document.querySelector('.outcome_modal .category_add_new').style.display = 'none';
        })
        .catch(function (error) {
        console.log(error)
    });

});

/*Category exit modal*/
document.getElementById('category_add_exit').addEventListener('click', function () {
    document.querySelector('.outcome_modal .category_add_new').style.display = 'none';
    document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'visible';
    document.getElementById('category_title').value = '';
    document.querySelector('.category_add_new div.add_img').innerText = 'Add image';
    document.querySelector('.category_add_new input[name="pic"]').value = '';
});

/*Change category*/
document.getElementById('category_id').addEventListener('change', function () {
    var category_img = this.options[this.selectedIndex].dataset.img;
    document.getElementById('img_category').src = category_img;
    document.querySelector('.subcategory_add_new input[name="category_id"]').value = this.value;
    document.getElementById('img_subcategory').src = '';
    var category_id = this.value;

    axios.post('subcategory/get', {
        category_id: category_id
    })
        .then(function (response) {
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
        })
        .catch(function (error) {
            console.log(error)
        });

});

/*Subcategory open modal window*/
document.querySelector('.add_subcategory').addEventListener('click', function () {
    document.querySelector('.outcome_modal .subcategory_add_new').style.display = 'block';
    document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'hidden';
});

/*Show subcategories images*/
document.querySelector('.subcategory_add_new div.add_img').addEventListener('click', function () {
    var images_list = document.querySelector('.subcategory_add_new .images');
    images_list.style.display = 'block';

    var account_image = document.querySelectorAll('.outcome_modal .subcategory_add_new form .images ul li');

    account_image.forEach(function (item) {
        item.addEventListener('click', function () {
            var img = document.createElement('img');
            img.src = this.children[0].attributes[0].value;
            img.style.width = '40px';

            document.querySelector('.subcategory_add_new div.add_img').innerText = '';
            document.querySelector('.subcategory_add_new div.add_img').appendChild(img);
            document.querySelector('.subcategory_add_new input[name="pic"]').value = this.children[0].attributes[0].value;
            images_list.style.display = 'none';

        })
    });
});

/*Create new subcategory*/
document.querySelector('.subcategory_add_new input[type="submit"]').addEventListener('click', function (e) {
    e.preventDefault();

    axios.post('subcategory/add', {
        subcategory_title: document.querySelector('.subcategory_add_new input[name="subcategory_title"]').value,
        subcategory_pic: document.querySelector('.subcategory_add_new input[name="pic"]').value,
        category_id: document.querySelector('.subcategory_add_new input[name="category_id"]').value
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

            document.querySelector('.outcome_modal .subcategory_add_new').style.display = 'none';
            document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'visible';
            document.querySelector('.outcome_modal .subcategory_block').style.display = 'inline-block';

            document.querySelector('.subcategory_add_new div.add_img').innerText = 'Add image';
            document.getElementById('subcategory_title').value = '';

        }).catch(function (error) {
        console.log(error);
    });
});

/*Exit subcategory modal*/
document.getElementById('subcategory_add_exit').addEventListener('click', function () {
    document.querySelector('.outcome_modal .subcategory_add_new').style.display = 'none';
    document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'visible';
    document.querySelector('.subcategory_add_new div.add_img').innerText = 'Add image';
    document.getElementById('subcategory_title').value = '';
});

/*Change subcategory*/
document.getElementById('subcategory_id').addEventListener('change', function () {
    var subcategory_img = this.options[this.selectedIndex].dataset.pic;
    document.getElementById('img_subcategory').src = subcategory_img;
});

/*Open seller modal window*/
document.querySelector('.add_seller').addEventListener('click', function () {
    document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'hidden';
    document.querySelector('.outcome_modal .seller_add_new').style.display = 'block';
});

/*Create new seller*/
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
            document.getElementById('seller_title').value = '';

        }).catch(function (error) {
        console.log(error);
    });
});

/*Exit seller*/
document.getElementById('seller_add_exit').addEventListener('click', function () {
    document.querySelector('.outcome_modal .seller_add_new').style.display = 'none';
    document.querySelector('.outcome_modal .outcome_add_new').style.visibility = 'visible';
    document.getElementById('seller_title').value = '';
});

/*Exit outcome*/
document.getElementById('exit_add_outcome').addEventListener('click', function () {
    document.querySelector('.outcome_modal').style.display = 'none';
    document.getElementById('account_id').value = '';
    document.getElementById('total_sum').value = '';
    document.getElementById('total_sum').value = '';
    document.getElementById('category_id').value = '';
    document.getElementById('seller_id').value = '';
    document.getElementById('img_category').src = '';
    document.querySelector('.subcategory_block').style.display = 'none';
    document.getElementById('comment').value = '';
    document.querySelector('#total_sum + span').innerText = '';
});

/*Show refresh calendar and show incomes in another day*/
document.querySelector('.callendar input[name="date"]').addEventListener('change', function () {
    document.querySelector('.callendar a').style.display = 'inline-block';
    var input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'date');
    input.value = this.value;

    document.querySelector('form[action="outcome/add"]').appendChild(input);

    axios.post('outcome/date', {
        date: this.value
    })
        .then(function (response) {
            document.querySelector('table.account').innerHTML = response.data;
        })
        .catch(function (error) {
            console.log(error)
        });

});