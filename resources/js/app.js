import "./bootstrap";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";


// section modal for softDeletes

const deleteBtns = document.querySelectorAll('.delete button');

if(deleteBtns.length>0){

    deleteBtns.forEach((btn) => {

        btn.addEventListener('click', function (e){

            e.preventDefault();
                const title = btn.dataset.title;

            document.getElementById('message').innerHTML = `stai per cancellare<br> <strong>${title}</strong>,<br> ne sei sicuro?`;

            const modal = new bootstrap.Modal(document.getElementById('delete-modal'));

            document.getElementById("modal-delete-btn")

                .addEventListener("click", function () {
                    btn.parentElement.submit();
                });

             modal.show();
        });
});
}


// section preview image

// mi collego a degli elemnti in pagina
const oldImgElem = document.getElementById('oldImg')
const imgElem = document.getElementById('imagePreview');
const btnDeleteElem = document.getElementById('btnDelete');
const inputElem = document.getElementById('cover_image');

//listen change
inputElem.addEventListener('change',function(e){
    //istanzia nuovo oggetto FileReader( è un api che ha dei metodi per legere il contenuto dei file.)
    const reader = new FileReader();
    // use callback function to read input
    reader.onload = function() {
        //reader value in src on tag img
        imgElem.src = reader.result;
        // remove and add class "hide" (button remove,image preview, old image preview)
        imgElem.classList.remove('hide');
        btnDeleteElem.classList.remove('hide');
        oldImgElem.classList.add('hide');
    };
    // convert string in url for direcory image
    reader.readAsDataURL(e.target.files[0]);
});

// remove btn to reset input value and add class hide
btnDeleteElem.addEventListener('click', function(e){
    e.preventDefault();
    btnDeleteElem.classList.add('hide');
    imgElem.classList.add('hide');
    oldImgElem.classList.remove('hide');
    inputElem.value = "";
});


