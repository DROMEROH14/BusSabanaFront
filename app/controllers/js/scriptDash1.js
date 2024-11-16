function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => section.style.display = 'none');
    document.getElementById(sectionId).style.display = 'block';
}

function logout() {
    window.location.href = '../models/logout.php';
}

document.addEventListener("DOMContentLoaded", function () {
    fetchRutas();
    fetchHorarios();
    fetchNotificaciones();
    fetchInicio();
});

function fetchRutas() {
    const data = {
        action: "getRutas"
    };
    fetch('../models/ModelDash.php', {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data) 
    }) 
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector("#ruta-table tbody");

            tableBody.innerHTML = '';

            data.forEach(ruta => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${ruta.RouteName}</td>
                    <td>${ruta.Origin}</td>
                    <td>${ruta.Destination}</td>
                    <td>${ruta.EstimatedDuration}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los buses:', error));
}

function fetchHorarios() {
    const data = {
        action: "getHorarios"
    };
    fetch('../models/ModelDash.php', {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data) 
    }) 
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector("#horario-table tbody");

            // Limpiar la tabla antes de agregar nuevas filas
            tableBody.innerHTML = '';

            // Insertar cada bus como una fila de la tabla
            data.forEach(horario => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${horario.FkIDRoute}</td>
                    <td>${horario.DepartureTime}</td>
                    <td>${horario.ArrivalTime}</td>
                    <td>${horario.Frequency}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los buses:', error));
}

function fetchNotificaciones() {
    const data = {
        action: "getNoti"
    };
    fetch('../models/ModelDash.php', {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data) 
    }) 
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector("#notificacion-table tbody");

            // Limpiar la tabla antes de agregar nuevas filas
            tableBody.innerHTML = '';

            // Insertar cada bus como una fila de la tabla
            data.forEach(noti => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${noti.FkIdSchedule}</td>
                    <td>${noti.Message}</td>
                    <td>${noti.DateTime}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los buses:', error));
}

function fetchInicio() {
    const data = {
        action: "getInicio"
    };
    fetch('../models/ModelDash.php', {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data) 
    }) 
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector("#inicio-table tbody");

            // Limpiar la tabla antes de agregar nuevas filas
            tableBody.innerHTML = '';

            // Insertar cada bus como una fila de la tabla
            data.forEach(inic => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${inic.NombreRuta}</td>
                    <td>${inic.Origen}</td>
                    <td>${inic.Destino}</td>
                    <td>${inic.HoraSalida}</td>
                    <td>${inic.MensajeNotificacion}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los datos:', error));
}