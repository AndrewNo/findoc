/*Refresh page*/
document.querySelector('form .refresh').addEventListener('click', function () {
    location.reload();
});

document.querySelectorAll('form #account_to option').forEach(function (item) {
    if (item.value == document.getElementById('account_from').value) {
        item.setAttribute('disabled', '');
    }
});

document.querySelectorAll('form #account_from option').forEach(function (item) {
    if (item.value == document.getElementById('account_to').value) {
        item.setAttribute('disabled', '');
    }
});

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
        document.querySelector('form input[name="currency"]').value = document.querySelector('span.currency_to').innerText;
    }

});
