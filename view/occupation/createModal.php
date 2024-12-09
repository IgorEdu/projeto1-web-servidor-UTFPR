<div class="modal fade" id="flightModal" tabindex="-1" aria-labelledby="flightModalLabel" aria-hidden="true"
    style="z-index: 1051;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="flightModalLabel">Ocupação</h5>
                <button type="button" onclick="clean()" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="error-message"
                style="border-radius: 5px; background-color: indianred; color: black; text-align: center; padding: 5px; display: none; justify-content: center; align-items: center; margin: 1vh;">
            </div>
            <div class="modal-body">
                <form id="flightForm" action="/occupation/save" method="POST">
                    <input type="hidden" id="flightId" value="" />
                    <div class="mb-3">
                        <label for="flightCode" class="form-label">Número do Vôo</label>
                        <input type="text" class="form-control uppercase" id="flightCode" required
                            onfocus="savePreviousValueFlightCode()" onchange="validateFlight()">
                    </div>
                    <div class="mb-3">
                        <label for="flightDate" class="form-label">Data do Vôo</label>
                        <input type="datetime-local" class="form-control" id="flightDate" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="flightPurchaseDate" class="form-label">Data da Compra</label>
                        <input type="datetime-local" class="form-control" id="flightPurchaseDate"
                            value="<?php echo date('Y-m-d\TH:i'); ?>" required disabled>
                    </div>
                    <div class="mb-3">
                        <label for="seatNumber" class="form-label">Número do Assento</label>
                        <input type="text" class="form-control" onfocus="savePreviousValueSeatNumber()"
                            onchange="validateSeat()" id="seatNumber" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="saveFlight()">Salvar</button>
            </div>
        </div>
    </div>
</div>

<script>

    function openModal(id) {
        fetch(`/occupation/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data && !data.error) {
                    document.getElementById('flightId').value = data.id;
                    document.getElementById('flightCode').value = data.flightCode;
                    document.getElementById('flightDate').value = data.flightDepartureDate;
                    document.getElementById('flightPurchaseDate').value = data.purchaseDate;
                    document.getElementById('seatNumber').value = data.seatNumber;

                    var flightModal = new bootstrap.Modal(document.getElementById('flightModal'));
                    flightModal.show();
                } else {
                    alert(data.error || 'Ocupação não encontrada.');
                }
            })
            .catch(error => console.error('Erro:', error));
    }

    function clean() {
        // Preencher os campos do modal
        document.getElementById('flightId').value = '';
        document.getElementsByClassName('error-message')[0].style.display = 'none';
        document.getElementById('flightCode').value = '';
        document.getElementById('flightDate').value = '';
        document.getElementById('flightPurchaseDate').value = setCurrentDateTime();
        document.getElementById('seatNumber').value = '';
    }

    function saveFlight() {
        let flightCode = document.getElementById('flightCode').value;
        let flightDate = document.getElementById('flightDate').value;
        let flightPurchaseDate = document.getElementById('flightPurchaseDate').value;
        let seatNumber = document.getElementById('seatNumber').value;
        let id = document.getElementById('flightId').value;

        const data = {
            flightCode: flightCode,
            flightDepartureDate: flightDate,
            purchaseDate: flightPurchaseDate,
            seatNumber: seatNumber
        };

        const options = {
            method: id ? 'POST' : 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                ...data,
                ...(id && { id })
            })
        };

        fetch(`occupation/save`, options)
            .then(response => response.json())
            .then(data => {
                if (data && !data.error) {
                    localStorage.setItem('showInformationModal', 'true');
                    location.reload();
                } else {
                    showError(data.error || 'Ocorreu um erro ao salvar a ocupação.');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                showError('Ocorreu um erro ao salvar a ocupação.');
            });
    }

    // function saveFlight() {
    //     let flightCode = document.getElementById('flightCode').value;
    //     let flightDate = document.getElementById('flightDate').value;
    //     let flightPurchaseDate = document.getElementById('flightPurchaseDate').value;
    //     let seatNumber = document.getElementById('seatNumber').value;
    //     let id = document.getElementById('flightId').value;

    //     const data = {
    //         flightCode: flightCode,
    //         flightDepartureDate: flightDate,
    //         purchaseDate: flightPurchaseDate,
    //         seatNumber: seatNumber
    //     };

    //     const options = {
    //         method: id ? 'POST' : 'POST',
    //         headers: {
    //             'Content-Type': 'application/x-www-form-urlencoded'
    //         },
    //         body: new URLSearchParams({
    //             ...data,
    //             ...(id && { id })
    //         })
    //     };

    //     fetch(`../../controller/occupationController.php?action=${id ? 'updateOccupation' : 'insertOccupation'}`, options)
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data && !data.error) {
    //                 localStorage.setItem('showInformationModal', 'true');
    //                 location.reload();
    //             } else {
    //                 showError(data.error || 'Ocorreu um erro ao salvar a ocupação.');
    //             }
    //         })
    //         .catch(error => {
    //             console.error('Erro:', error);
    //             showError('Ocorreu um erro ao salvar a ocupação.');
    //         });
    // }


    function setCurrentDateTime() {
        const now = new Date(); // Obtém a data e hora atuais

        const year = now.getFullYear(); // Obtém o ano
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Obtém o mês (0-11) e formata para dois dígitos
        const day = String(now.getDate()).padStart(2, '0'); // Obtém o dia e formata para dois dígitos
        const hours = String(now.getHours()).padStart(2, '0'); // Obtém a hora e formata para dois dígitos
        const minutes = String(now.getMinutes()).padStart(2, '0'); // Obtém os minutos e formata para dois dígitos

        // Formata a data no padrão yyyy-MM-ddThh:mm
        const formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

        return formattedDateTime;
    }

    let previousValueFlightCode = '';
    let previousValueSeatNumber = '';

    function savePreviousValueFlightCode() {
        previousValueFlightCode = document.getElementById('flightCode').value;
    }

    function savePreviousValueSeatNumber() {
        previousValueSeatNumber = document.getElementById('seatNumber').value;
    }

    function validateFlight() {

        let flightCode = document.getElementById('flightCode').value;
        fetch(`occupation/validateFlight/${flightCode}`)
            .then(response => response.json())
            .then(data => {

                if (data && !data.error) {
                    let date = `${data.flightDepartureDate}T${data.flightDepartureTime}`;
                    showError('');
                    document.getElementById('flightDate').value = date;
                    document.getElementById('seatNumber').value = '';
                    document.getElementById('seatNumber').focus();
                } else {
                    document.getElementById('flightCode').value = previousValueFlightCode;
                    document.getElementById('flightCode').focus();
                    showError(data.error || 'Vôo não encontrado.');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                document.getElementById('flightCode').value = previousValueFlightCode;
                document.getElementById('flightCode').focus();
            });
    }

    function validateSeat() {
        let id = document.getElementById('flightId').value;
        console.log(id);
        let seatNumber = document.getElementById('seatNumber').value;
        let flightCode = document.getElementById('flightCode').value;
        fetch(`occupation/validateSeat/${flightCode}/${seatNumber}/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data && !data.error) {
                    showError('');
                } else {
                    document.getElementById('seatNumber').value = previousValueSeatNumber;
                    document.getElementById('seatNumber').focus();
                    showError(data.error || 'Assento já ocupado.');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                ocument.getElementById('seatNumber').value = previousValueSeatNumber;
                showError('Ocorreu um erro ao validar o assento.');
            });
    }

    function deleteOccupation() {
        fetch(`/occupation/delete/${occupationIdToDelete}`)
            .then(response => response.json())
            .then(data => {
                if (data && !data.error) {
                    localStorage.setItem('showInformationModal', 'true');
                    location.reload();
                } else {
                    alert(data.error || 'Ocorreu um erro ao excluir a ocupação.');
                }
            })
            .catch(error => console.error('Erro:', error));
    }

    function showError(message) {
        if (!message) {
            document.getElementsByClassName('error-message')[0].style.display = 'none';
            return;
        }
        document.getElementsByClassName('error-message')[0].style.display = 'flex';
        document.getElementsByClassName('error-message')[0].innerHTML = `<p class="text" style="margin: 0;">${message}</p>`;
    }
</script>