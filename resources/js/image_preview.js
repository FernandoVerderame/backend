/* RECUPERO ELEMENTI */
const placeholder = 'https://marcolanci.it/boolean/assets/placeholder.png'
const imageFiels = document.getElementById('cover')
const previewField = document.getElementById('preview')

const changeImageButton = document.getElementById('change-image-button')
const previousImageFiled = document.getElementById('previous-image-field')


/* VARIABILE BLOB */
let blobUrl;


/* VARIABILE BLOB */
imageFiels.addEventListener('change', () => {

    /* SE SELEZIONATO UN FILE E E VIENE PRESO IL PRIMO */
    if (imageFiels.files && imageFiels.files[0]) {

        /* PRENDO IL FILE */
        const file = imageFiels.files[0];

        /* CREO IN MODO TEMPORANIO UN BLOB */
        blobUrl = URL.createObjectURL(file);

        /* INSERISCO IL BLOB NEL TAG SRC IN HTML */
        previewField.src = blobUrl;
    } else {

        /* SE NON CE UN FILE METTI */
        previewField.src = previewField;
    }

});


/* EVENTO PRIMA DI LASCIARE LA PAGINA */
window.addEventListener('beforeunload', () => {

    /* SE CE UN BLOB RIMUOVILO */
    if (blobUrl) URL.revokeObjectURL(blobUrl)
})

changeImageButton.addEventListener('click', () => {
    previousImageFiled.classList.add('d-none');
    imageFiels.classList.remove('d-none');
    previewField.src = placeholder;
    imageFiels.click();
})


