document.addEventListener('DOMContentLoaded', () => {

    /* =======================
       SIMULADOR
    ======================= */
    const simulatorForm = document.getElementById('simulatorForm');

    if (simulatorForm && !simulatorForm.dataset.listenerAdded) {
        simulatorForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = simulatorForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;

            const amount = Number(document.getElementById('requested_amount').value);
            const installments = Number(document.getElementById('number_of_installments').value);

            if (amount < 100000 || amount > 100000000) {
                alert('El valor solicitado debe estar entre $100.000 y $100.000.000');
                submitBtn.disabled = false;
                return;
            }

            try {
                const response = await fetch(
                    `/api/simulate?requested_amount=${amount}&number_of_installments=${installments}`
                );
                const data = await response.json();

                const tbody = document.getElementById('tableBody');
                tbody.innerHTML = '';

                data.plan.forEach(item => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${item.installment}</td>
                            <td>$${item.amount.toLocaleString()}</td>
                            <td>$${item.remaining.toLocaleString()}</td>
                        </tr>`;
                });

                document.getElementById('result').style.display = 'block';

            } catch (err) {
                console.error('Error al simular:', err);
                alert('Ocurrió un error al simular.');
            } finally {
                submitBtn.disabled = false;
            }
        });

        simulatorForm.dataset.listenerAdded = "true";
    }

    /* =======================
    REGISTRO
    ======================= */
    const registerForm = document.getElementById('registerForm');

    if (registerForm && !registerForm.dataset.listenerAdded) {
        registerForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = registerForm.querySelector('button[type="submit"]');
            submitBtn.disabled = true;

            const formData = new FormData(registerForm);
            const data = Object.fromEntries(formData.entries());

            data.requested_amount = document.getElementById('requested_amount')?.value;
            data.number_of_installments = document.getElementById('number_of_installments')?.value;

            try {
                const response = await fetch('/api/loan-requests', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Solicitud registrada!',
                        text: 'Tu solicitud de crédito fue registrada correctamente.',
                        confirmButtonText: 'Aceptar'
                    });

                    registerForm.reset();
                    document.querySelector('#registerModal .btn-close')?.click();
                } else {
                    const res = await response.json();
                    const errors = res.errors
                        ? Object.values(res.errors).flat().join('\n')
                        : res.message;

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errors,
                        confirmButtonText: 'Aceptar'
                    });
                }

            } catch (err) {
                console.error('Error al registrar:', err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error al registrar la solicitud.',
                    confirmButtonText: 'Aceptar'
                });
            } finally {
                submitBtn.disabled = false;
            }
        });

        registerForm.dataset.listenerAdded = "true";
    }
});

