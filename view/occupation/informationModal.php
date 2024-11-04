<div class="modal fade" id="informationModal" tabindex="-1" aria-labelledby="flightModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="justify-content: center;">
                <h1 class="modal-title" style="background-color: transparent;" id="flightModalLabel"><i class="bi bi-check-circle"></i></h1>
            </div>
            <div class="modal-body
            ">
                <p>Ação realizada com sucesso!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<script>
    function openInformationModal() {
        var informationModal = new bootstrap.Modal(document.getElementById('informationModal'));
        var flightModal = new bootstrap.Modal(document.getElementById('flightModal'));
        flightModal.hide();
        informationModal.show();
    }
    document.addEventListener('DOMContentLoaded', function() {
        const showInformationModal = localStorage.getItem('showInformationModal');

        if (showInformationModal) {
            openInformationModal();
            localStorage.removeItem('showInformationModal'); // Limpa a flag
        }
    });

</script>

