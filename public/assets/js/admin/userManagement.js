document.addEventListener("DOMContentLoaded", function () {
    addRemoveEvent();
    addEditEvent();
}, false);

function addRemoveEvent() {
    for (element of document.querySelectorAll("[data-action=\"delete\"]")) {
        element.addEventListener("click", deleteUser, false);
    }
}

function addEditEvent() {
    for (element of document.querySelectorAll("[data-action=\"edit\"]")) {
        element.addEventListener("click", editUser, false);
    }
}

function deleteUser() {
    swal({
        title: "Eliminar usuario",
        text: "Esta acción no puede ser revertida, ¿deseas continuar?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            cancel: "No, cancelar",
            confirm: {
                text: "Si, eliminar"
            }
        }
    }).then((value) => {
        if (value) {
            this.parentNode.getElementsByTagName("form")[0].submit();
        }
    });
}

function editUser() {
    let row = this;
    while(row.tagName != "TR") {
        row = row.parentNode;
    }

    document.getElementById("id").value = row.getElementsByClassName("id")[0].innerText;
    document.getElementById("name").value = row.getElementsByClassName("name")[0].innerText;
    document.getElementById("nif").value = row.getElementsByClassName("nif")[0].innerText;
    document.getElementById("telephone").value = row.getElementsByClassName("telephone")[0].getAttribute("data-phone");
    document.getElementById("email").value = row.getElementsByClassName("email")[0].getAttribute("data-email");

    if (row.getElementsByClassName("verified")[0].getAttribute("data-verified") == "1") {
        document.querySelector("input[name=\"verified\"][value=\"1\"]").checked = true;

    } else {
        document.querySelector("input[name=\"verified\"][value=\"0\"]").checked = true;
    }

    $("#editUserModal").modal("show");
}
