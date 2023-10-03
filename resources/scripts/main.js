document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#register-form');
    clearInputsError();
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const checkbox = form.querySelector('input[name="acceptTerms"]');
        formData.append('acceptTerms', checkbox.checked)

        const url = this.getAttribute('action');
        const method = this.getAttribute('method');
        const xhr = new XMLHttpRequest();

        xhr.open(method, url);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest'); // Set header to indicate AJAX request
        xhr.send(formData);

        xhr.onload = function () {
            if (xhr.status !== 200) {
                return;
            }

            const response = JSON.parse(xhr.responseText);

            if (response.success === false) {
                handleErrors(response.data);
                return;
            }

            clearForm();
            alert('Użytownik został zarejestrowany');
        }
    });

    function handleErrors(errorFields) {
        const keys = Object.keys(errorFields);

        for (const key of keys) {
            const errorMessage = errorFields[key];
            const input = form.querySelector('input[name="' + key + '"]');
            const inputSibling = input.nextElementSibling;

            if (inputSibling && inputSibling.nodeType === 1) {
                inputSibling.innerHTML = errorMessage;
                inputSibling.classList.add('--active');
            }
        }


    }

    function clearInputsError() {
        const inputs = form.querySelectorAll('input')

        inputs.forEach((input) => {
            input.addEventListener('focusin', function () {
                toggleError(this);
            })
        })
    }

    function clearForm() {
        const inputs = form.querySelectorAll('input')
        const checkbox = form.querySelector('input[name="acceptTerms"]');

        checkbox.checked = false;

        form.reset();

        inputs.forEach(() => {
            toggleError(this);
        })
    }

    function toggleError(input) {
        const inputSibling = input.nextElementSibling;

        if (inputSibling && inputSibling.nodeType === 1) {
            inputSibling.innerHTML = '';
            inputSibling.classList.remove('--active');
        }
    }



})
