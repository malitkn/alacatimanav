function generateSlug(id, setId) {
    const data = document.getElementById(id).value;
    const slug = data
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')      // Harf ve sayı dışındaki karakterleri kaldırır
        .replace(/\s+/g, '-')              // Boşlukları tire ile değiştirir
        .replace(/-+/g, '-')               // Çift tireleri tek tireye indirger
        .trim();                           // Başta ve sonda boşlukları temizler
    document.getElementById(setId).value = slug;
}
function toggleStatusButtonBootstrap(buttonId, hiddenInputId = false) {
    let button = document.getElementById(buttonId);
    let input = document.getElementById(hiddenInputId);
    if (button.classList.contains('btn-success')) {
        button.textContent = "Pasif";
        button.classList.remove('btn-success');
        button.classList.add('btn-danger');
        if (hiddenInputId) {
            input.value = 0;
        }
    } else {
        button.textContent = "Aktif";
        button.classList.remove('btn-danger');
        button.classList.add('btn-success');
        if (hiddenInputId) {
            input.value = 1;
        }
    }
}

function setStatusButtonBootstrap(buttonId, status) {
    let button = document.getElementById(buttonId);
    if (parseInt(status)) {
        button.textContent = "Aktif";
        button.classList.remove('btn-danger');
        button.classList.add('btn-success');
    } else {
        button.textContent = "Pasif";
        button.classList.remove('btn-success');
        button.classList.add('btn-danger');
    }
}

// For theme buttons
/*function toggleStatusButtonBootstrap(buttonId, hiddenInputId) {
    let button = document.getElementById(buttonId);
    let input = document.getElementById(hiddenInputId);
    if (button.classList.contains('active')) {
        button.textContent = "Pasif";
        button.classList.remove('active');
        button.classList.add('pending');
        input.value = 0;
    } else {
        button.textContent = "Aktif";
        button.classList.remove('pending');
        button.classList.add('active');
        input.value = 1;
    }
}*/
