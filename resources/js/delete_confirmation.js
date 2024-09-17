/* RECUPERO ELEMENTI */
const deleteForms = document.querySelectorAll('.del-form');
const modal = document.getElementById('modal');
const modalTitle = document.querySelector('.modal-title');
const modalBody = document.querySelector('.modal-body');
const confirmationButton = document.getElementById('modal-confirmation-button');

/* VARIAVILE ACTIVEFORM DA MANIPOLARE NELLA CONDIZIONE */
let activeForm = null;


/* VARIAVILE ACTIVEFORM */
deleteForms.forEach(form => {

    /* EVENTO AL FORM */
    form.addEventListener('submit', e => {

        /* BLOCCO INVIO AUTOMATICO */
        e.preventDefault();

        /* RIASSEGNO ACTIVEFORM SOLO SE VIENE SCATENATO EVENTO FORM */
        activeForm = form;

        /* NOME APPARTAMENTO SELEZIONATO PER ELIMINARLO */
        const apartmentTitle = form.dataset.apartment;

        /* CONTENUTO */
        confirmationButton.innerText = 'Conferma eliminazione';
        confirmationButton.className = 'btn btn-danger';
        modalTitle.innerText = 'Elimina appartamento';
        modalBody.innerText = `Sei sicuro di voler eliminare DEFINITIVAMENTE: "${apartmentTitle}"?`;
    })
})

/* EVENTO ALLA CONFERMA */
confirmationButton.addEventListener('click', () => {

    /* SE VIENE SCATENATO ACTIVEFORM EVENTO PROGRAMMABILE */
    if (activeForm) activeForm.submit();
});

/* DISATTIVO MODALE  */
modal.addEventListener('hidden.bs.modal', () => {
    activeForm = null;
})