require('./bootstrap');

/*Change currency*/
document.getElementById('account_id').addEventListener('change', function () {
    var currency = this.options[this.selectedIndex].dataset.currency;

    document.querySelector('#total_sum + span').innerText = currency;
    document.querySelector('input[name="currency"]').value = currency;
});

/*Change subcategories according category*/
document.getElementById('category_id').addEventListener('change', function () {

    document.getElementById('img_category').src = '/'+this.options[this.selectedIndex].dataset.img;

    axios.post('/subcategory/get', {
        category_id: this.value
    })
        .then(function (response) {
            document.getElementById('img_subcategory').src = '';
            var subcategory_select = document.getElementById('subcategory_id');
            subcategory_select.innerHTML = '';
            var default_option = document.createElement('option');
            default_option.innerText = "Choose subcategory";
            default_option.setAttribute('selected', '');
            default_option.setAttribute('disabled', '');
            subcategory_select.appendChild(default_option);

            response.data.forEach(function (item) {
                var option = document.createElement('option');
                option.value = item.id;
                option.innerText = item.title;
                option.setAttribute('data-subimage', item.pic);
                subcategory_select.appendChild(option);
            });
        })
        .catch(function (error) {
            console.log(error)
        });
});

/*Change img subcategory*/
document.getElementById('subcategory_id').addEventListener('change', function () {
    document.getElementById('img_subcategory').src = '/'+this.options[this.selectedIndex].dataset.subimage;
});

/*Add image show*/
document.getElementById('add_image').addEventListener('click', function () {
    document.querySelector('.add_new_category .images').style.display = 'block';


});

/*Add image in new category*/
var category_images = document.querySelectorAll('.add_new_category .images ul li');
category_images.forEach(function (item) {
    item.addEventListener('click', function () {
        document.getElementById('add_image').innerHTML = '<img src="'+ this.children[0].attributes[0].value +'">';
        document.querySelector('.add_new_category input[name="pic"]').value = this.children[0].attributes[0].value.substr(1);
        document.querySelector('.add_new_category .images').style.display = 'none';
    });
});

/*POST request for creating new category*/
document.querySelector('.add_new_category input[type="submit"]').addEventListener('click', function (e) {
    e.preventDefault();
    var category_title = document.getElementById('new_category_title');
    var category_pic = document.querySelector('.add_new_category input[name="pic"]');
    axios.post('/category/add', {
        category_title: category_title.value,
        category_pic: category_pic.value,
        type: document.querySelector('.add_new_category input[name="type"]').value
    })
        .then(function (response) {
            console.log(response);
            category_title.value = '';
            category_pic.value = '';
            document.getElementById('add_image').innerText = 'Add image';

            var new_category = document.createElement('option');
            new_category.value = response.data.id;
            new_category.innerText = response.data.title;
            new_category.setAttribute('selected', '');
            new_category.setAttribute('data-img', response.data.pic);
            document.getElementById('category_id').appendChild(new_category);
            document.getElementById('img_category').src = '/'+response.data.pic;

            document.getElementById('img_subcategory').src = '';
            var subcategory_select = document.getElementById('subcategory_id');
            subcategory_select.innerHTML = '';
            var default_option = document.createElement('option');
            default_option.innerText = "Choose subcategory";
            default_option.setAttribute('selected', '');
            default_option.setAttribute('disabled', '');
            subcategory_select.appendChild(default_option);

            document.querySelector('.modal_bg').style.display = 'none';
            document.querySelector('.modal_bg .add_new_category').style.display = 'none';
        })
        .catch(function (error) {
            console.log(error);
        });
});

/*Show modal add category*/
document.querySelector('.add_category').addEventListener('click', function(){
    document.querySelector('.modal_bg').style.display = 'block';
    document.querySelector('.modal_bg .add_new_category').style.display = 'block';
});

/*Exit from modal category*/
document.getElementById('category_exit').addEventListener('click', function () {
    document.getElementById('new_category_title').value = '';
    document.querySelector('.add_new_category input[name="pic"]').value = '';
    document.getElementById('add_image').innerText = 'Add image';
    document.querySelector('.modal_bg').style.display = 'none';
    document.querySelector('.modal_bg .add_new_category').style.display = 'none';
});

/*Add image show in subcategories*/
document.getElementById('add_image_subcategory').addEventListener('click', function () {
    document.querySelector('.add_new_subcategory .images').style.display = 'block';
});

/*Add image in new subcategory*/
var subcategory_images = document.querySelectorAll('.add_new_subcategory .images ul li');
subcategory_images.forEach(function (item) {
    item.addEventListener('click', function () {
        document.getElementById('add_image_subcategory').innerHTML = '<img src="'+ this.children[0].attributes[0].value +'">';
        document.querySelector('.add_new_subcategory input[name="pic"]').value = this.children[0].attributes[0].value.substr(1);
        document.querySelector('.add_new_subcategory .images').style.display = 'none';
    });
});

/*POST request for creating new subcategory*/
document.querySelector('.add_new_subcategory input[type="submit"]').addEventListener('click', function (e) {
    e.preventDefault();
    var subcategory_title = document.getElementById('new_subcategory_title');
    var subcategory_pic = document.querySelector('.add_new_subcategory input[name="pic"]');
    var category_id = document.getElementById('category_id').value;
    axios.post('/subcategory/add', {
        subcategory_title: subcategory_title.value,
        subcategory_pic: subcategory_pic.value,
        category_id: category_id
    })
        .then(function (response) {
            console.log(response);
            subcategory_title.value = '';
            subcategory_pic.value = '';
            document.getElementById('add_image').innerText = 'Add image';

            var new_subcategory = document.createElement('option');
            new_subcategory.value = response.data.id;
            new_subcategory.innerText = response.data.title;
            new_subcategory.setAttribute('selected', '');
            new_subcategory.setAttribute('data-img', response.data.pic);
            document.getElementById('subcategory_id').appendChild(new_subcategory);
            document.getElementById('img_subcategory').src = '/'+response.data.pic;

            document.querySelector('.modal_bg').style.display = 'none';
            document.querySelector('.modal_bg .add_new_category').style.display = 'none';
        })
        .catch(function (error) {
            console.log(error);
        });
});

/*Show modal add subcategory*/
document.querySelector('.add_subcategory').addEventListener('click', function(){
    document.querySelector('.modal_bg').style.display = 'block';
    document.querySelector('.modal_bg .add_new_subcategory').style.display = 'block';
});

/*Exit from modal subcategory*/
document.getElementById('subcategory_exit').addEventListener('click', function () {
    document.getElementById('new_subcategory_title').value = '';
    document.querySelector('.add_new_subcategory input[name="pic"]').value = '';
    document.getElementById('add_image_subcategory').innerText = 'Add image';
    document.querySelector('.modal_bg').style.display = 'none';
    document.querySelector('.modal_bg .add_new_subcategory').style.display = 'none';
});

/*Show modal add seller*/
document.querySelector('.add_seller').addEventListener('click', function(){
    document.querySelector('.modal_bg').style.display = 'block';
    document.querySelector('.modal_bg .add_new_seller').style.display = 'block';
});

/*Exit from modal seller*/
document.getElementById('seller_exit').addEventListener('click', function () {
    document.getElementById('new_seller_title').value = '';
    document.querySelector('.modal_bg').style.display = 'none';
    document.querySelector('.modal_bg .add_new_seller').style.display = 'none';
});

/*POST request for creating new seller*/
document.querySelector('.add_new_seller input[type="submit"]').addEventListener('click', function (e) {
    e.preventDefault();
    var seller_title = document.getElementById('new_seller_title');
    axios.post('/seller/add', {
        seller_title: seller_title.value,
    })
        .then(function (response) {
            seller_title.value = '';
            var new_seller = document.createElement('option');
            new_seller.value = response.data.id;
            new_seller.innerText = response.data.title;
            new_seller.setAttribute('selected', '');
            document.getElementById('seller_id').appendChild(new_seller);

            document.querySelector('.modal_bg').style.display = 'none';
            document.querySelector('.modal_bg .add_new_category').style.display = 'none';
        })
        .catch(function (error) {
            console.log(error);
        });
});