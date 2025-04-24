const form = document.getElementById('livreForm');
const messagesDiv = document.getElementById('messages');

const initDBButton = document.getElementById('initDB');
if (initDBButton) {
    initDBButton.addEventListener('click', function () {
        if (confirm("Tu es sûr de vouloir réinitialiser la base ?")) {
            fetch('back/init_database.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error("initdb Erreur HTTP : " + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        chargerMessages();
                        location.reload();
                    } else {
                        alert("Erreur : " + data.error);
                    }
                })
                .catch(error => {
                    console.error('initdb ', error);
                    alert("initdb " + error);
                });
        }
    });
}

const dropDBButton = document.getElementById('dropDB');
if (dropDBButton) {
    dropDBButton.addEventListener('click', function () {
        if (confirm("Tu es sûr de vouloir SUPPRIMER la base de données ? Cette action est irréversible !")) {
            fetch('back/drop_database.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erreur HTTP : " + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert("Erreur : " + data.error);
                    }
                })
                .catch(error => {
                    console.error('Erreur réseau :', error);
                    alert("Erreur réseau lors de la suppression : " + error);
                });
        }
    });
}

function creerBoiteMessage(msg) {
    const box = document.createElement('div');
    box.className = 'alert alert-light shadow-sm mb-3';

    const nom = document.createElement('strong');
    nom.textContent = msg.nom;

    const date = document.createElement('small');
    date.className = 'text-muted';
    date.textContent = " " + msg.date;

    const br = document.createElement('br');

    const message = document.createElement('span');
    message.textContent = msg.message;

    box.appendChild(nom);
    box.appendChild(date);
    box.appendChild(br);
    box.appendChild(message);

    return box;
}

function chargerMessages() {
    fetch('./back/messages.php')
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur HTTP : " + response.status);
            }
            return response.json();
        })
        .then(data => {
            messagesDiv.innerHTML = '';
            data.forEach(msg => {
                const box = creerBoiteMessage(msg);
                messagesDiv.appendChild(box);
            });
        })
        .catch(error => {
            console.error('Erreur lors du chargement des messages :', error);
        });
}

function gererSoumissionFormulaire(event) {
    event.preventDefault();
    const formData = new FormData(form);

    fetch('back/submit.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error("Erreur HTTP : " + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                form.reset();
                chargerMessages();
            } else {
                alert("Erreur : " + data.error);
            }
        })
        .catch(error => {
            console.error('Erreur lors de la soumission du formulaire :', error);
            alert("Erreur réseau lors de la soumission : " + error);
        });
}

function initLivreOr() {
    if (form && messagesDiv) {
        form.addEventListener('submit', gererSoumissionFormulaire);
        chargerMessages();
    } else {
        console.warn("Les éléments du DOM ne sont pas disponibles");
    }
}

window.addEventListener('load', initLivreOr);
