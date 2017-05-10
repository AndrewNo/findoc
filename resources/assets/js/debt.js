require('./bootstrap');

document.getElementById('account').addEventListener('change', function () {
    document.querySelector('span.currency').innerText = this.options[this.selectedIndex].dataset.currency;
    document.querySelector('input[name="currency"]').value = this.options[this.selectedIndex].dataset.currency;
});

document.getElementById('modal_exit').addEventListener('click', function () {
    document.querySelector('.modal_bg').style.display = 'none';
});

document.querySelector('.add_debt').addEventListener('click', function () {
    document.querySelector('.modal_bg').style.display = 'block';
    document.getElementById('account').value = '';
    document.getElementById('total_sum').value = '';
    document.getElementById('type').value = '';
});

document.querySelector('.add_agent').addEventListener('click', function () {
    document.querySelector('.modal_container').style.display = 'none';
    document.querySelector('.modal_agent').style.display = 'block';
});

document.getElementById('modal_agent_exit').addEventListener('click', function () {
    document.querySelector('.modal_container').style.display = 'block';
    document.querySelector('.modal_agent').style.display = 'none';
    document.querySelector('input[name="title"]').value = '';
});

document.querySelector('.modal_agent form input[type="submit"]').addEventListener('click', function (e) {
    e.preventDefault();
    axios.post('agent/add', {
        title: document.querySelector('input[name="title"]').value
    }).then(function (response) {
        var option = document.createElement('option');
        option.value = response.data.id;
        option.innerText = response.data.title;
        option.setAttribute('selected', '');
        document.getElementById('agent').appendChild(option);
        document.querySelector('.modal_container').style.display = 'block';
        document.querySelector('.modal_agent').style.display = 'none';
        document.querySelector('input[name="title"]').value = '';
    }).catch(function (error) {
        console.log(error);
    });
});