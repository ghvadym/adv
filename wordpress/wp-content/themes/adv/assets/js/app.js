document.addEventListener('DOMContentLoaded', function () {
    var ajax = myajax.ajaxurl;
    var menu = document.getElementById('menu');
    var burger = document.getElementById('burger');
    var form = document.getElementById('adv-form');
    var progress = document.getElementById('adv-progress');
    var cardsWrapper = document.getElementById('cards-wrapper');
    var fieldsData = {};

    burger.addEventListener('click', function () {
        menu.classList.toggle('open');
    });

    window.addEventListener('click', function (e) {
        if (!menu.contains(e.target) && !burger.contains(e.target)) {
            menu.classList.remove('open');
        }
    });

    if (form) {
        var fields = form.querySelectorAll('.adv-form__row input');
        fields.forEach((field) => {
            field.addEventListener('change', function (e) {
                if (field.name === 'image') {
                    var file = field.files[0];

                    if (!field.value || !file.type.includes('image/')) {
                        delete fieldsData[field.name];
                        field.value = '';
                    } else {
                        fieldsData[field.name] = file;
                    }
                } else {
                    if (e.target.checkValidity()) {
                        fieldsData[field.name] = field.value;
                    } else {
                        delete fieldsData[field.name];
                    }
                }

                progress.value = Object.values(fieldsData).length;
            });
        })

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            submitForm(fieldsData);
        });
    }

    async function submitForm(fields)
    {
        var data = new FormData();
        data.append('action', 'submit_form');
        data.append('title', fields.title);
        data.append('email', fields.email);
        data.append('image', fields.image);

        var response = await fetch(ajax, {
            method: 'POST',
            body  : data
        });

        var html = await response.json();
        if (!html) {
            message('warning');
            return;
        }

        var parser = new DOMParser();
        var doc = parser.parseFromString(html.result, 'text/html');
        var mainResult = doc.querySelector('.card');

        cardsWrapper.append(mainResult);

        message('success');
        formReset();
    }

    function formReset()
    {
        form.reset();
        progress.value = 0;
    }

    function message(status)
    {
        var message = document.querySelector('.adv-form .message.' + status);

        message.classList.remove('hide');

        setTimeout(function () {
            message.classList.add('hide');
        }, 3000);
    }
});