<div class="modal fade" id="delete-modal" data-form="{{ $curElem->id }}"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="ModaleLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
             {{-- text and button modal --}}
            <div id='message' class="modal-body text-center">
                {{-- testo dinamico --}}
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn w-25 btn-outline-danger" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn w-25 btn-outline-success" id="modal-delete-btn">Conferma</button>
              </div>
            {{--  /text and button modal --}}

        </div>
    </div>
</div>
