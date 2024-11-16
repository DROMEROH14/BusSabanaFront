const busForm = document.getElementById("bus-form");
const rutaForm = document.getElementById("ruta-form");
const horarioForm = document.getElementById("horario-form");
const notificacionForm = document.getElementById("notificacion-form");

notificacionForm.addEventListener("submit", function(event) {
    event.preventDefault();
    
    const notificacionSelect = document.getElementById("notificacionSelect").value;
    const mensaje = document.getElementById("notification-message").value;
    const fechaNoti = document.getElementById("fechaNoti").value;
    
    const data = {
        notificacionSelect: notificacionSelect,
        mensaje: mensaje,
        fechaNoti: fechaNoti,
        action: "notiAgre"
    };

    fetch("../models/ModelDashA.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data) 
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Notificación agregado',
                text: data.message
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error al agregar el notificación.',
                text: data.message
            });
            
        }
    })
    .catch(error => {
        alert("Hubo un error al procesar la solicitud: " + error); 
    });
});

busForm.addEventListener("submit", function(event) {
    event.preventDefault();
    
    const licencia = document.getElementById("bus-licencia").value;
    const capacidad = document.getElementById("bus-capacidad").value;
    
    const data = {
        licencia: licencia,
        capacidad: capacidad,
        action: "busesAgre"
    };

    fetch("../models/ModelDashA.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data) 
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Bus agregado',
                text: data.message
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error al agregar el bus.',
                text: data.message
            });
            
        }
    })
    .catch(error => {
        alert("Hubo un error al procesar la solicitud: " + error); 
    });
});


function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => section.style.display = 'none');
    document.getElementById(sectionId).style.display = 'block';
}

function logout() {
    window.location.href = '../models/logout.php';
}

document.addEventListener("DOMContentLoaded", function () {
    fetchBuses();
    fetchRutas();
    fetchHorarios();
    fetchNotificaciones();
    fetchUsuarios();
});

function fetchUsuarios() {
    const data = {
        action: "getUser"
    };
    fetch('../models/ModelDashA.php', {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data) 
    }) 
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector("#usuario-table tbody");

            // Limpiar la tabla antes de agregar nuevas filas
            tableBody.innerHTML = '';

            // Insertar cada bus como una fila de la tabla
            data.forEach(user => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${user.Name}</td>
                    <td>${user.LastName}</td>
                    <td>${user.Email}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editUser(${user.IdUser}, ${user.FKIdUserType}, '${user.Name}', '${user.LastName}', '${user.Email}')">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los buses:', error));
}

function editUser(id, tipo, name, apellido, email) {
    // Rellenar el formulario con los datos actuales
    document.getElementById('user-id').value = id;
    document.getElementById('nomUser').value = name;
    document.getElementById('apellUser').value = apellido;
    document.getElementById('userRole').value = tipo;
    document.getElementById('emailUser').value = email;

    // Mostrar el modal
    var myModal = new bootstrap.Modal(document.getElementById('editModal4'));
    myModal.show();
}

// Manejo del formulario para actualizar los datos
document.getElementById('editUsuarioForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const id = document.getElementById('user-id').value;
    const name = document.getElementById('nomUser').value;
    const apellido = document.getElementById('apellUser').value;
    const tipo = document.getElementById('userRole').value;
    const email = document.getElementById('emailUser').value;

    const data = {
        id: id,
        name: name,
        apellido: apellido,
        tipo: tipo,
        email: email,
        action: "UsersUpdate"
    };

    // Enviar los datos al servidor para actualizar
    fetch('../models/ModelDashA.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(responseData => {
        if (responseData.success) {
            // Actualizar la tabla o recargar los datos
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: responseData.message
            }).then(() => {
                var myModal = new bootstrap.Modal(document.getElementById('editModal4'));
                myModal.hide();
        
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: responseData.message
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Hubo un error',
            text: 'No se pudo actualizar los datos.'
        });
    });
});

function fetchBuses() {
    const data = {
        action: "getBuses"
    };
    fetch('../models/ModelDashA.php', {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data) 
    }) 
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector("#bus-table tbody");

            // Limpiar la tabla antes de agregar nuevas filas
            tableBody.innerHTML = '';

            // Insertar cada bus como una fila de la tabla
            data.forEach(bus => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${bus.LicensePlate}</td>
                    <td>${bus.Capacity}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editBus(${bus.IdBus}, '${bus.LicensePlate}', ${bus.Capacity})">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los buses:', error));
}

function editBus(id, licensePlate, capacity) {
    // Rellenar el formulario con los datos actuales
    document.getElementById('bus-id').value = id;
    document.getElementById('bus-licencia1').value = licensePlate;
    document.getElementById('bus-capacidad1').value = capacity;

    // Mostrar el modal
    var myModal = new bootstrap.Modal(document.getElementById('editModal'));
    myModal.show();
}

// Manejo del formulario para actualizar los datos
document.getElementById('editBusForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const id = document.getElementById('bus-id').value;
    const licencia = document.getElementById('bus-licencia1').value;
    const capacidad = document.getElementById('bus-capacidad1').value;

    const data = {
        id: id,
        licencia: licencia,
        capacidad: capacidad,
        action: "busesUpdate"
    };

    // Enviar los datos al servidor para actualizar
    fetch('../models/ModelDashA.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(responseData => {
        if (responseData.success) {
            // Actualizar la tabla o recargar los datos
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: responseData.message
            }).then(() => {
                var myModal = new bootstrap.Modal(document.getElementById('editModal'));
                myModal.hide();
        
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: responseData.message
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Hubo un error',
            text: 'No se pudo actualizar los datos.'
        });
    });
});

rutaForm.addEventListener("submit", function(event) {
    event.preventDefault();
    
    const nombre = document.getElementById("route-name").value;
    const inicio = document.getElementById("route-start").value;
    const fin = document.getElementById("route-end").value;
    const duracion = document.getElementById("duracion").value;
    
    const data = {
        nombre: nombre,
        inicio: inicio,
        fin: fin,
        duracion: duracion,
        action: "rutasAgre"
    };

    fetch("../models/ModelDashA.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data) 
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Bus agregado',
                text: data.message
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error al agregar el bus.',
                text: data.message
            });
            
        }
    })
    .catch(error => {
        alert("Hubo un error al procesar la solicitud: " + error); 
    });
});

function fetchRutas() {
    const data = {
        action: "getRutas"
    };
    fetch('../models/ModelDashA.php', {
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
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editRuta(${ruta.IdRoute}, '${ruta.RouteName}', '${ruta.Origin}', '${ruta.Destination}', '${ruta.EstimatedDuration}')">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los buses:', error));
}

function editRuta(id, nombre, origen, destino, duracion1) {
    // Rellenar el formulario con los datos actuales
    document.getElementById('ruta-id').value = id;
    document.getElementById('ruta').value = nombre;
    document.getElementById('origen').value = origen;
    document.getElementById('destino').value = destino;
    document.getElementById('duracion1').value = duracion1;

    // Mostrar el modal
    var myModal = new bootstrap.Modal(document.getElementById('editModal1'));
    myModal.show();
}

// Manejo del formulario para actualizar los datos
document.getElementById('editRutaForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const id = document.getElementById('ruta-id').value;
    const nombre = document.getElementById('ruta').value;
    const origen = document.getElementById('origen').value;
    const destino = document.getElementById('destino').value;
    const duracion1 = document.getElementById('duracion1').value;

    const data = {
        id: id,
        nombre: nombre,
        origen: origen,
        destino: destino,
        duracion1: duracion1,
        action: "rutasUpdate"
    };

    // Enviar los datos al servidor para actualizar
    fetch('../models/ModelDashA.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(responseData => {
        if (responseData.success) {
            // Actualizar la tabla o recargar los datos
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: responseData.message
            }).then(() => {
                var myModal = new bootstrap.Modal(document.getElementById('editModal'));
                myModal.hide();
        
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: responseData.message
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Hubo un error',
            text: 'No se pudo actualizar los datos.'
        });
    });
});

horarioForm.addEventListener("submit", function(event) {
    event.preventDefault();
    
    const salida = document.getElementById("departure-time").value;
    const llegada = document.getElementById("arrival-time").value;
    const frecuencia = document.getElementById("frecuencia").value;
    const routeHorario = document.getElementById("routeHorario").value;
    
    const data = {
        salida: salida,
        llegada: llegada,
        frecuencia: frecuencia,
        routeHorario: routeHorario,
        action: "horarioAgre"
    };

    fetch("../models/ModelDashA.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(data) 
    })
    .then(response => response.json()) 
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Horario agregado',
                text: data.message
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error al agregar el Horario.',
                text: data.message
            });
            
        }
    })
    .catch(error => {
        alert("Hubo un error al procesar la solicitud: " + error); 
    });
});

function fetchHorarios() {
    const data = {
        action: "getHorarios"
    };
    fetch('../models/ModelDashA.php', {
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
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editHorario(${horario.IDSchedule}, '${horario.FkIDRoute}', '${horario.DepartureTime}', '${horario.ArrivalTime}', ${horario.Frequency})">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los buses:', error));
}

function editHorario(id, fkRuta, salida, llegada, frecuencia) {
    // Rellenar el formulario con los datos actuales
    document.getElementById('horario-id').value = id;
    document.getElementById('ruta1').value = fkRuta;
    document.getElementById('salida1').value = salida;
    document.getElementById('llegada1').value = llegada;
    document.getElementById('frecuencia1').value = frecuencia;

    // Mostrar el modal
    var myModal = new bootstrap.Modal(document.getElementById('editModal2'));
    myModal.show();
}

// Manejo del formulario para actualizar los datos
document.getElementById('editHorarioForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const id = document.getElementById('horario-id').value;
    const fkRuta = document.getElementById('ruta1').value;
    const salida = document.getElementById('salida1').value;
    const llegada = document.getElementById('llegada1').value;
    const frecuencia = document.getElementById('frecuencia1').value;

    const data = {
        id: id,
        fkRuta: fkRuta,
        salida: salida,
        llegada: llegada,
        frecuencia: frecuencia,
        action: "horarioUpdate"
    };

    // Enviar los datos al servidor para actualizar
    fetch('../models/ModelDashA.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(responseData => {
        if (responseData.success) {
            // Actualizar la tabla o recargar los datos
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: responseData.message
            }).then(() => {
                var myModal = new bootstrap.Modal(document.getElementById('editModal2'));
                myModal.hide();
        
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: responseData.message
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Hubo un error',
            text: 'No se pudo actualizar los datos.'
        });
    });
});

function fetchNotificaciones() {
    const data = {
        action: "getNoti"
    };
    fetch('../models/ModelDashA.php', {
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
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editNoti(${noti.IDNotification}, ${noti.FkIdSchedule}, '${noti.Message}', '${noti.DateTime}')">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error al cargar los buses:', error));
}

function editNoti(id, hora, mensaje, time) {
    // Rellenar el formulario con los datos actuales
    document.getElementById('horNoti').value = hora;
    document.getElementById('noti-id').value = id;
    document.getElementById('mensaje1').value = mensaje;
    document.getElementById('fechaNoti1').value = time;

    // Mostrar el modal
    var myModal = new bootstrap.Modal(document.getElementById('editModal3'));
    myModal.show();
}

// Manejo del formulario para actualizar los datos
document.getElementById('editNotiForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const id = document.getElementById('noti-id').value;
    const hora = document.getElementById('horNoti').value;
    const mensaje = document.getElementById('mensaje1').value;
    const time = document.getElementById('fechaNoti1').value;

    const data = {
        id: id,
        hora: hora,
        mensaje: mensaje,
        time: time,
        action: "notiUpdate"
    };

    // Enviar los datos al servidor para actualizar
    fetch('../models/ModelDashA.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(responseData => {
        if (responseData.success) {
            // Actualizar la tabla o recargar los datos
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: responseData.message
            }).then(() => {
                var myModal = new bootstrap.Modal(document.getElementById('editModal2'));
                myModal.hide();
        
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: responseData.message
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Hubo un error',
            text: 'No se pudo actualizar los datos.'
        });
    });
});