document.addEventListener("DOMContentLoaded", function () {
    for (let form of document.getElementsByName('submit')) {
        form.addEventListener("click", formSubmit, true);
    }
});

function formSubmit(e) {
    if (this.value == "Guardar borrador") {
        if ((document.getElementById("a1_gn").value == "") &&
            (document.getElementById("a1_gc").value == "") &&
            (document.getElementById("a1_fo").value == "")) {
            e.stopPropagation();
            e.preventDefault();
            swal("Dato no insertado", "Es imprescindible insertar uno de los siguientes datos: gas natural, gasoleoc o fueloleo", "info");
        }
    }

    if (this.value == "calculateStudy" && e.isTrusted) {
        let btn = this;
        e.stopPropagation();
        e.preventDefault();

        swal({
            "title": "Confirmación de calculo",
            "text": "Una vez realizado el calculo no podrás realizar cambios, ¿estás seguro?",
            "icon": "info",
            buttons: {
                "cancel": "Cancelar",
                "confirm": "Continuar con el calculo",
            }

        }).then(function (isConfirm) {
            if (isConfirm) {
                btn.click();
            }
        });
    }
}
