<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="flightModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="flightModalLabel">Confirmação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir este avião?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="window.location.href=`/plane/delete/${planeIdToDelete}`">Excluir</button>
            </div>
        </div>
    </div>
</div>
<script>
    let planeIdToDelete;

    function openConfirmationModal(id) {
        planeIdToDelete = id;
        var confirmationModal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        confirmationModal.show();
    }

</script>