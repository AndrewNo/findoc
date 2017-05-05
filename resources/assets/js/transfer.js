/*Disactive one of accounts*/
document.getElementById('account_from').addEventListener('change', function () {
    var account_from_value = this.value;
    var currency = this.options[this.selectedIndex].dataset.currency;

    document.querySelector('span.currency_from').innerText = currency;

    document.querySelectorAll('#account_to option').forEach(function (item) {

        if (item.value == account_from_value || item.value == '') {
            item.setAttribute('disabled', '');
        }else {
            item.removeAttribute('disabled');
        }

    });

    if (document.querySelector('span.currency_from').innerText != document.querySelector('span.currency_to').innerText) {
        document.querySelector('span.currency_from').style.color = 'red';
        document.querySelector('span.currency_to').style.color = 'red';
        document.querySelector('.warning').style.display = 'block';
    } else {
        document.querySelector('span.currency_from').style.color = '#2ab27b';
        document.querySelector('span.currency_to').style.color = '#2ab27b';
        document.querySelector('.warning').style.display = 'none';
        document.querySelector('form input[name="currency"]').value = document.querySelector('span.currency_from').innerText;
    }


});

document.getElementById('account_to').addEventListener('change', function () {
    var account_from_value = this.value;
    document.querySelectorAll('#account_from option').forEach(function (item) {
        if (item.value == account_from_value || item.value == '') {
            item.setAttribute('disabled', '');
        }else {
            item.removeAttribute('disabled');
        }
    });

    document.querySelector('span.currency_to').innerText = this.options[this.selectedIndex].dataset.currency;

    if (document.querySelector('span.currency_from').innerText != document.querySelector('span.currency_to').innerText) {
        document.querySelector('span.currency_from').style.color = 'red';
        document.querySelector('span.currency_to').style.color = 'red';
        document.querySelector('.warning').style.display = 'block';
    } else {
        document.querySelector('span.currency_from').style.color = '#2ab27b';
        document.querySelector('span.currency_to').style.color = '#2ab27b';
        document.querySelector('.warning').style.display = 'none';
        document.querySelector('form input[name="currency"]').value = document.querySelector('span.currency_from').innerText;
    }

});


/*Refresh selects accounts*/
document.querySelector('span.refresh').addEventListener('click', function () {

    document.getElementById('account_from').value = '';
    document.getElementById('account_to').value = '';
    document.querySelector('span.currency_from').innerText = '';
    document.querySelector('span.currency_to').innerText = '';
    document.querySelector('.warning').style.display = 'none';

    document.querySelectorAll('#account_from option').forEach(function (item) {
        if (item.value == '') {
            item.setAttribute('disabled', '');
            item.setAttribute('selected', '');
        }else {
            item.removeAttribute('disabled');
            item.removeAttribute('selected');
        }
    });

    document.querySelectorAll('#account_to option').forEach(function (item) {
        if (item.value == '') {
            item.setAttribute('disabled', '');
            item.setAttribute('selected', '');
        }else {
            item.removeAttribute('disabled');
            item.removeAttribute('selected');
        }
    });
});

/*Show modal*/
document.querySelector('.add_transfer').addEventListener('click', function () {
    document.querySelector('.modal_bg').style.display = 'block';
});

/*Close modal*/
document.getElementById('exit_modal').addEventListener('click', function () {
    document.querySelector('.modal_bg').style.display = 'none';
    document.getElementById('account_from').value = '';
    document.getElementById('account_to').value = '';
    document.querySelector('.warning').style.display = 'none';
    document.querySelector('span.currency_from').innerText = '';
    document.querySelector('span.currency_to').innerText = '';

    document.querySelectorAll('#account_from option').forEach(function (item) {
        if (item.value == '') {
            item.setAttribute('disabled', '');
            item.setAttribute('selected', '');
        }else {
            item.removeAttribute('disabled');
            item.removeAttribute('selected');
        }
    });

    document.querySelectorAll('#account_to option').forEach(function (item) {
        if (item.value == '') {
            item.setAttribute('disabled', '');
            item.setAttribute('selected', '');
        }else {
            item.removeAttribute('disabled');
            item.removeAttribute('selected');
        }
    });

    document.getElementById('total_sum').value = '';
});