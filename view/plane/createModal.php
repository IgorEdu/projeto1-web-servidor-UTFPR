<div class="modal fade" id="planeModal" tabindex="-1" aria-labelledby="planeModalLabel" aria-hidden="true"
    style="z-index: 1051;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="planeModalLabel">Avião</h5>
                <button type="button" onclick="clean()" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="error-message"
                style="border-radius: 5px; background-color: indianred; color: black; text-align: center; padding: 5px; display: none; justify-content: center; align-items: center; margin: 1vh;">
            </div>
            <div class="modal-body">
                <form id="planeForm" action="/plane/save" method="POST">
                    <input type="hidden" id="id" name="id" value="" />
                    <div class="mb-3">
                        <label for="code" class="form-label">Código do avião</label>
                        <input type="text" class="form-control uppercase" id="code" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Modelo do avião</label>
                        <input type="text" class="form-control uppercase" id="model" name="model" required>
                    </div>
                    <div class="mb-3">
                        <label for="totalSeats" class="form-label">Total de assentos</label>
                        <input type="text" class="form-control uppercase" id="totalSeats" name="totalSeats">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" onclick="savePlane()">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    function openModal(id) {
        fetch(`/plane/getById/?id=${id}`)
            .then(response => response.json())
            .then(data => {
                if (data && !data.error) {
                    document.getElementById('id').value = data.id;
                    document.getElementById('code').value = data.code;
                    document.getElementById('model').value = data.model;
                    document.getElementById('totalSeats').value = data.totalSeats;

                    var planeModal = new bootstrap.Modal(document.getElementById('planeModal'));
                    planeModal.show();
                } else {
                    alert(data.error || 'Avião não encontrado.');
                }
            })
            .catch(error => console.error('Erro:', error));
    }

    function clean() {
        // Preencher os campos do modal
        document.getElementById('id').value = '';
        document.getElementsByClassName('error-message')[0].style.display = 'none';
        document.getElementById('code').value = '';
        document.getElementById('model').value = '';
        document.getElementById('totalSeats').value = '';
    }

    function showError(message) {
        if (!message) {
            document.getElementsByClassName('error-message')[0].style.display = 'none';
            return;
        }
        document.getElementsByClassName('error-message')[0].style.display = 'flex';
        document.getElementsByClassName('error-message')[0].innerHTML = `<p class="text" style="margin: 0;">${message}</p>`;
    }

    function savePlane(){
        localStorage.setItem('showInformationModal', 'true');
        location.reload();
    }
</script>