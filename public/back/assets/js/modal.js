function loadModalAction(id, formId) {
    let form = document.getElementById(formId);
    let action = form.getAttribute('action');

    action = action.replace(/\/[^\/]*$/, '/' + id);
    form.setAttribute('action', action);
}

function loadEditModal(data, formToLoad, alertContainerId) {
    loadModalAction(data.id, formToLoad.formId);
    clearAlerts(alertContainerId);
    let inputs = formToLoad.inputs;
    Object.values(inputs).forEach(input => {
        if (input.attribute === 'option') {
            document.getElementById(input.id).value = data[input.value];
        }

        if (input.attribute === 'toggle') {
            let value = data[input.value];
            setStatusButtonBootstrap(input.id, value);
        }
        let inp = document.getElementById(input.id);
        inp[input.attribute] = data[input.value];
    });
    let elements = formToLoad.elements;
    Object.values(elements).forEach(element => {
        let el = document.getElementById(element.id);
        if (element.prependValue) {
            // prependValue true ise, mevcut değerin önüne ekle
            el[element.attribute] = data[element.value] + element.defaultValue;
        } else {
            // prependValue false ise doğrudan ata
            el[element.attribute] = data[element.value];
        }

    });
}

function clearAlerts(elementId) {
    const container = document.getElementById(elementId);
    const alerts = container.querySelectorAll('.alert');
    alerts.forEach(alert => alert.remove());
}


function displayMessages(messages, elementId, status = false) {
    // Belirli bir element ID'si ile hedef elementi bulun
    const container = document.getElementById(elementId);
    // Eğer mesajlar varsa
    // Eğer mesajlar varsa
    if (messages && typeof messages === 'object') {
        // Bootstrap alert div oluştur
        const alertDiv = document.createElement('div');
        if (status) {
            status = 'ok';
        } else {
            status = 'error';
        }
        alertDiv.classList.add('alert', 'profile__counterup', 'alert-' + status, 'alert-dismissible', 'fade', 'show');
        alertDiv.setAttribute('role', 'alert');

        // Kapatma düğmesi oluştur
        const closeButton = document.createElement('button');
        closeButton.classList.add('btn-close');
        closeButton.setAttribute('type', 'button');
        closeButton.setAttribute('data-bs-dismiss', 'alert');
        closeButton.setAttribute('aria-label', 'Close');

        // <ul> elemanı oluştur
        const ul = document.createElement('ul');
        ul.classList.add('text', 'text-light');

        // JSON içindeki her bir hata mesajını işleyin
        Object.keys(messages).forEach(key => {
            if (key !== 'success') {
                messages[key].forEach(message => {
                    const li = document.createElement('li');
                    li.textContent = message;
                    ul.appendChild(li);
                });
            } else {
                const li = document.createElement('li');
                li.textContent = messages[key];
                ul.appendChild(li);
            }
        });

        // <ul> ve kapatma düğmesini alert'in içine ekle
        alertDiv.appendChild(ul);
        alertDiv.appendChild(closeButton);

        // Alert mesajını container'ın en başına ekle
        container.prepend(alertDiv);
    }
}

async function sendUpdateRequest(formName, alertContainerId) {
    const csrf = document.querySelector('meta[name="csrf_token"]').content;
    const form = document.forms[formName];
    const data = Array.from(form.elements).reduce((acc, element) => {
        if (element.name && element.name !== '_token') {
            acc[element.name] = element.value;
        } else if (element.name === '_token') {
            acc[element.name] = csrf;
        }
        return acc;
    }, {});

    let response = await fetch(form.action, {
        method: form['_method'].value,
        headers: {
            'Content-Type': 'application/json;charset=utf-8',
            'X-CSRF-TOKEN': csrf,
        },
        body: JSON.stringify(data),
    });
    let result = await response.json();
    if (response.ok) {
        console.log(result);
        displayMessages(result, alertContainerId, true);
    } else {
        displayMessages(result, alertContainerId, false);
    }
}
