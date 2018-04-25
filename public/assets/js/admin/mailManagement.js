document.addEventListener("DOMContentLoaded", function () {
    addRemoveEvent();
    addReplyEvent();
}, false);

function addRemoveEvent() {
    for (element of document.querySelectorAll("[data-action=\"delete\"]")) {
        element.addEventListener("click", deleteMail, false);
    }
}

function addReplyEvent() {
    for (element of document.querySelectorAll("[data-action=\"reply\"]")) {
        element.addEventListener("click", replyMail, false);
    }
}

function deleteMail() {
    swal({
        title: "Eliminar correo",
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
            this.parentNode.getElementsByClassName("deleteForm")[0].submit();
        }
    });
}

function replyMail() {
    let row = this;
    while(row.tagName != "TR") {
        row = row.parentNode;
    }

    document.getElementById("for").value = row.getElementsByClassName("for")[0].innerText;
    document.getElementById("subject").value = (
            (row.getElementsByClassName("subject")[0].innerText.toUpperCase().indexOf("RE:") == -1) ? "RE: " : ""
        ) + row.getElementsByClassName("subject")[0].innerText;
    document.getElementById("message").innerText = row.getElementsByClassName("message")[0].innerText;

    // change form action
    let id = row.getElementsByClassName("id")[0].innerText;
    let form = document.getElementById("replyMailModal").getElementsByTagName("form")[0];
    form.action = form.getAttribute("data-action-url").replace("/id/", "/" + id + "/");

    $("#replyMailModal").modal("show");
    $("#replyMailModal").on('shown.bs.modal', function (e) {
        document.getElementById("reply").focus();
    });
}
