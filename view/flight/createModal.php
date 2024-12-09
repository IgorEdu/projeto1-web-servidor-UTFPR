<div class="modal fade" id="flightModal" tabindex="-1" aria-labelledby="flightModalLabel" aria-hidden="true" 
style="z-index: 1051;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="flightModalLabel">Voo</h5>
                <button type="button" onclick="clean()" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="error-message" style="border-radius: 5px; background-color: indianred; color: black; text-align: center; padding: 5px; display: none; justify-content: center; align-items: center; margin: 1vh;">
                </div>
            <div class="modal-body">
                <form id="flightForm" action="/flight/save" method="POST">
                    <input type="hidden" id="id" name="id" value="" />
                    <div class="mb-3">
                        <label for="code" class="form-label">Código do Vôo</label>
                        <input type="text" class="form-control uppercase" id="code" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label for="departureDate" class="form-label">Data de Partida</label>
                        <input type="date" class="form-control" id="departureDate" name="departureDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="departureTime" class="form-label">Horário de Partida</label>
                        <input type="time" class="form-control" id="departureTime" name="departureTime" value="<?php echo date('H:i');?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="destination" class="form-label">Destino</label>
                        <input type="text" class="form-control" id="destination" name="destination" required>
                    </div>
                    <div class="mb-3">
                        <label for="ticketPrice" class="form-label">Preço da Passagem</label>
                        <input type="number" class="form-control" id="ticketPrice" name="ticketPrice" min="1" step="any" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" onclick="saveFlight()">Salvar</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>

<script>

    function openModal(id) {
        fetch(`/flight/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data && !data.error) {
                    document.getElementById('id').value = data.id;
                    document.getElementById('code').value = data.code;
                    document.getElementById('departureDate').value = data.departureDate;
                    document.getElementById('departureTime').value = data.departureTime;
                    document.getElementById('destination').value = data.destination;
                    document.getElementById('ticketPrice').value = data.ticketPrice;

                    var flightModal = new bootstrap.Modal(document.getElementById('flightModal'));
                    flightModal.show();
                } else {
                    alert(data.error || 'Voo não encontrado.');
                }
            })
            .catch(error => console.error('Erro:', error));
    }

    function clean() {
        // Preencher os campos do modal
        document.getElementById('id').value = '';
        document.getElementsByClassName('error-message')[0].style.display = 'none';
        document.getElementById('code').value = '';
        document.getElementById('departureDate').value = '';
        document.getElementById('departureTime').value = setCurrentTime();
        document.getElementById('destination').value = '';
        document.getElementById('ticketPrice').value = null;
    }

    function saveFlight() {
        localStorage.setItem('showInformationModal', 'true');
        location.reload();
    }


    function setCurrentTime() {
        const now = new Date(); // Obtém a data e hora atuais

        const hours = String(now.getHours()).padStart(2, '0'); // Obtém a hora e formata para dois dígitos
        const minutes = String(now.getMinutes()).padStart(2, '0'); // Obtém os minutos e formata para dois dígitos

        // Formata o horario no padrão hh:mm
        const formattedDateTime = `${hours}:${minutes}`;

        return  formattedDateTime;
    }

    function showError (message) {
        if (!message) {
            document.getElementsByClassName('error-message')[0].style.display = 'none';
            return;
        }
        document.getElementsByClassName('error-message')[0].style.display = 'flex';
        document.getElementsByClassName('error-message')[0].innerHTML = `<p class="text" style="margin: 0;">${message}</p>`;
    }
</script>
