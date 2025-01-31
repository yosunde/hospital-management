document.addEventListener('DOMContentLoaded', function () {
    const appointmentTableBody = document.querySelector('#appointmentTable tbody');

    // Güncel tarih ve saat gösterimi
    const datetimeElement = document.getElementById('datetime');
    setInterval(() => {
        const now = new Date();
        datetimeElement.textContent = now.toLocaleString('tr-TR', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric',
            hour: '2-digit', minute: '2-digit', second: '2-digit'
        });
    }, 1000);

    // Randevu verilerini getirme (localStorage'dan örnek veri)
    function getAppointments() {
        const appointments = localStorage.getItem('appointments');
        return appointments ? JSON.parse(appointments) : [];
    }

    // Randevuları tabloya yükleme
    async function loadAppointments() {
        try {
            const response = await fetch('get_appointments.php?type=patient');
            const data = await response.json();
            
            if (data.success) {
                const appointmentSection = document.getElementById('appointment');
                appointmentSection.innerHTML = '';

                data.appointments.forEach(appointment => {
                    const appointmentDiv = document.createElement('div');
                    appointmentDiv.className = 'appointment-details';
                    appointmentDiv.innerHTML = `
                        <h2>Appointment Details</h2>
                        <p><strong>Date:</strong> ${appointment.appointment_date}</p>
                        <p><strong>Department:</strong> ${appointment.department}</p>
                        <p><strong>Doctor:</strong> Dr. ${appointment.doctor_first_name} ${appointment.doctor_last_name}</p>
                        <p><strong>Time:</strong> ${appointment.appointment_time}</p>
                        <button class="cancelAppointment" data-id="${appointment.id}">Cancel</button>
                    `;
                    appointmentSection.appendChild(appointmentDiv);
                });
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    // Randevuyu silme
    function deleteAppointment(index) {
        const appointments = getAppointments();
        appointments.splice(index, 1);
        localStorage.setItem('appointments', JSON.stringify(appointments));
        loadAppointments();
    }

    // Silme düğmesi olay dinleyicisi
    appointmentTableBody.addEventListener('click', function (e) {
        if (e.target.classList.contains('delete-button')) {
            const index = e.target.dataset.index;
            if (confirm('Are you sure you want to cancel this appointment?')) {
                deleteAppointment(index);
            }
        }
    });

    // Sayfa yüklendiğinde randevuları göster
    document.addEventListener('DOMContentLoaded', loadAppointments);

    // İptal butonu için event listener
    document.addEventListener('click', async function(e) {
        if (e.target.classList.contains('cancelAppointment')) {
            if (confirm('Are you sure you want to cancel this appointment?')) {
                const appointmentId = e.target.dataset.id;
                try {
                    const response = await fetch('cancel_appointment.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            appointment_id: appointmentId
                        })
                    });
                    
                    const data = await response.json();
                    if (data.success) {
                        loadAppointments(); // Listeyi yenile
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }
        }
    });
});
