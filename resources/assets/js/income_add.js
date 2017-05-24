require('./bootstrap');

var modal_add_account = document.getElementById('show-modal');
var modal_mask = document.querySelector('.modal-mask');
var modal_catgory = document.querySelector('div.modal-catgory');
var modal_payer = document.querySelector('div.modal-payer');
var add_category = document.querySelector('div.add_category');
var add_payer = document.querySelector('div.add_payer');
var currency = document.getElementById('account');
var category_img = document.getElementById('category_id');
var add_img_button = document.querySelector('.modal-body .add_img');

/*Open modal window add_income*/
modal_add_account.addEventListener('click', function () {

    modal_mask.style.display = 'table';

});

/*Close add_income*/
document.querySelector('.modal-default-button').addEventListener('click', function () {
    modal_mask.style.display = 'none';
    document.getElementById('account').value = '';
    document.getElementById('account_search').value = '';
    document.getElementById('category_search').value = '';
    document.getElementById('payer_search').value = '';
    document.getElementById('total_sum').value = '';
    document.getElementById('category_id').value = '';
    document.getElementById('payer_id').value = '';
    document.getElementById('comment').value = '';
    document.getElementById('img_category').src = '';
    document.querySelector('#total_sum + span').innerText = '';

    for (var i = 0; i < document.getElementById('category_id').options.length; i++) {
        document.getElementById('category_id').options[i].style.display = 'block';
    }

    for (var i = 0; i < document.getElementById('account').options.length; i++) {
        document.getElementById('account').options[i].style.display = 'block';

    }

    for (var i = 0; i < document.getElementById('payer_id').options.length; i++) {
        document.getElementById('payer_id').options[i].style.display = 'block';
    }

});

/*Category image*/
category_img.addEventListener('change', function () {
    var category_img = this.options[this.selectedIndex].dataset.categoryPic;
    document.getElementById('img_category').src = category_img;

});

/*Currency*/
currency.addEventListener('change', function () {
    var currency_title = this.options[this.selectedIndex].dataset.currency;

    document.querySelector('#total_sum + span').innerText = currency_title;
    document.querySelector('input[name="currency"]').value = currency_title;
});

/*add image in category*/
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

/*Close add category*/
document.querySelector('.modal-catgory .modal-default-button').addEventListener('click', function () {
    modal_catgory.style.display = 'none';
    document.querySelector('.modal-container').style.visibility = 'visible';
    document.getElementById('category_title').value = '';
    document.querySelector('.add_img').innerText = 'Add image';

});

/*Create new category*/
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
            var select_category = document.getElementById('category_id');
            var option = document.createElement('option');
            option.value = response.data.id;
            option.innerText = response.data.title;
            option.setAttribute('selected', '');
            select_category.appendChild(option);

            var img_category = document.getElementById('img_category');
            img_category.src = response.data.pic;

            modal_catgory.style.display = 'none';
            document.querySelector('.modal-container').style.visibility = 'visible';
            document.getElementById('category_title').value = '';
            document.querySelector('.add_img').innerText = 'Add image';

        })
        .catch(function (error) {
            console.log(error);
        });

});

/*Open modal window category*/
add_category.addEventListener('click', function () {
    document.querySelector('.modal-container').style.visibility = 'hidden';
    modal_catgory.style.display = 'table';
});

/*Close window add payer*/
document.querySelector('.modal-payer .modal-default-button').addEventListener('click', function () {
    modal_payer.style.display = 'none';
    document.querySelector('.modal-container').style.visibility = 'visible';
    document.getElementById('payer_title').value = '';
});

/*Create payer*/
document.querySelector('.modal-payer input[type="submit"]').addEventListener('click', function (e) {
    e.preventDefault();
    var title = document.querySelector('.modal-payer input[name="payer_title"]').value;

    axios.post('payer/add', {
        payer_title: title
    })
        .then(function (response) {
            var select_payer = document.getElementById('payer_id');
            var option = document.createElement('option');
            option.value = response.data.id;
            option.innerText = response.data.title;
            option.setAttribute('selected', '');
            select_payer.appendChild(option);

            modal_payer.style.display = 'none';
            document.querySelector('.modal-container').style.visibility = 'visible';
            document.getElementById('payer_title').value = '';

        })
        .catch(function (error) {
            console.log(error);
        });

});

/*Open modal window add payer*/
add_payer.addEventListener('click', function () {
    document.querySelector('.modal-container').style.visibility = 'hidden';
    modal_payer.style.display = 'table';
});

/*Show refresh calendar and show incomes in another day*/
document.querySelector('.callendar input[name="date"]').addEventListener('change', function () {
    document.querySelector('.callendar a').style.display = 'inline-block';
    var input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'date');
    input.value = this.value;

    document.querySelector('form[action="income/add"]').appendChild(input);

    axios.post('income/date', {
        date: this.value
    })
        .then(function (response) {
            document.querySelector('table.account').innerHTML = response.data;
        })
        .catch(function (error) {
            console.log(error)
        });

});

/*Search category*/
document.getElementById('category_search').addEventListener('keyup', function () {
    var search = new RegExp(this.value, 'ig');
    var options = document.getElementById('category_id').options;
    for (var i = 0; i < options.length; i++) {
        if (!options[i].innerText.match(search)) {
            options[i].style.display = 'none';
        } else {
            options[i].style.display = 'block';
        }
    }
});

/*Search account*/
document.getElementById('account_search').addEventListener('keyup', function () {
    var search = new RegExp(this.value, 'ig');
    var options = document.getElementById('account').options;
    for (var i = 0; i < options.length; i++) {
        if (!options[i].innerText.match(search)) {
            options[i].style.display = 'none';
        } else {
            options[i].style.display = 'block';
        }
    }
});

/*Search payer*/
document.getElementById('payer_search').addEventListener('keyup', function () {
    var search = new RegExp(this.value, 'ig');
    var options = document.getElementById('payer_id').options;
    for (var i = 0; i < options.length; i++) {
        if (!options[i].innerText.match(search)) {
            options[i].style.display = 'none';
        } else {
            options[i].style.display = 'block';
        }
    }
});

