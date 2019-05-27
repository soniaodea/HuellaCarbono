<div class="modal fade" tabindex="-1" role="dialog" id="tutorial">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">@lang("Tutorial")</h4>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="steps" data-step="0">
                    <div class="step-0">
                        <h5>@lang("Introducción")</h5>
                        <p class="text-justify">
                            @lang("Bienvenido")
                        </p>
                        <p class="text-justify">
                            @lang("Vamos")
                        </p>
                        <ol>
                            <li>@lang("Añadir nuevo edificio")</li>
                            <li>@lang("Inserción de datos (alcances)")</li>
                            <li>@lang("Realización del cálculo")</li>
                            <li>@lang("Visualización de estadísticas")</li>
                        </ol>
                    </div>
                    <div class="step-1 d-none">
                        <h5>@lang("Añadir nuevo edificio")</h5>

                        <p class="text-justify">
                            @lang("La huella de...")
                        </p>
                        <p class="text-justify">
                            @lang("Una vez finalizada...")
                        </p>
                        <p class="text-justify">
                            @lang("Puedes realizar modificaciones de cualquier campo pulsando sobre el lapiz ") <i class="fa fa-pencil"></i> @lang(", eliminarlo ") <i class="fa fa-trash"></i> @lang(" o establecer las coordenadas manualmente.")
                        </p>
                        <p>
                            <strong>@lang("Nota:")</strong> @lang("si eliminas el edificio también serán eliminados los registros de la huella.")
                        </p>
                    </div>
                    <div class="step-2 d-none">
                        <h5>@lang("Inserción de datos (alcances)")</h5>

                        <p class="text-justify">
                            @lang("Ahora que posees al menos un edificio puedes comenzar a completar los alcances para ello pulsa sobre la huella") (<i class="fa fa-paw"></i>). @lang("Los datos requeridos para realizar el cálculo están divididos en tres apartados:")
                        </p>
                        <ul class="list-unstyled">
                            <li>
                                <strong>@lang("Alcance 1:")</strong>
                                @lang("aquí se introducen las emisiones que ha realizado el centro de forma directa. Por ejemplo el gas consumido para cocinar, combustible para la calefacción, etc.")
                            </li>
                            <li>
                                <strong>@lang("Alcance 2:")</strong>
                                @lang("en este apartado se tienen en cuenta las emisiones realizadas de forma indirecta, como puede ser la electricidad en cuyo caso dependiendo de la compañia tendrá mayor o menor efecto.")
                            </li>
                            <li>
                                <strong>@lang("Alcance 3:")</strong>
                                @lang("otro tipo de emisiones, todas las que no estén contempladas en los previos alcances.")
                            </li>
                        </ul>
                        <p class="text-justify">
                            @lang("Para poder completar correctamente todos los campos deberás de consultar las facturas, te recomendamos ir completando estos campos cada vez que te llegue la mensualidad debido a que el calculo es anual. De esta forma te será más fácil y comodo.")
                        </p>
                    </div>
                    <div class="step-3 d-none">
                        <h5>@lang("Realización del cálculo")</h5>

                        <p class="test-justify">
                            @lang("Una vez hayas terminado con la inserción, a final de año en vez de pulsar sobre Guardar has de pulsar sobre Calcular huella de carbono de esta forma guardarás los cambios y se realizará el cálculo con lo indicado en los formularios.")
                        </p>
                    </div>
                    <div class="step-4 d-none">
                        <h5>@lang("Visualización de estadísticas")</h5>

                        <p class="text-justify">
                            @lang("Una vez realizado el cálculo final podrás ver comparaciones entre los edificios que has introducido y ver una comparativa respecto a otros centros registrados.")
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" name="next">
                    @lang("Siguiente")
                    <i class="fa fa-arrow-right"></i>
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    @lang("Cerrar")
                </button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(function () {
    $("#tutorial").modal("show");
    $("#tutorial [name=next]").on("click", function () {
        let $step = $("#tutorial .steps").first();
        let stepNum = parseInt($step.attr("data-step"));

        if ($("#tutorial .step-" + (stepNum + 1)).length) {

            $(".step-" + stepNum).toggleClass("d-none");
            stepNum++;

            $(".step-" + stepNum).toggleClass("d-none");
            $step.attr("data-step", stepNum);

            // no more steps
            if (!$("#tutorial .step-" + (stepNum + 1)).length) {
                $(this).text(@lang("Finalizar"));
            }

        } else {
            $(this).parents(".modal").modal("hide");
        }
    });
});
</script>
