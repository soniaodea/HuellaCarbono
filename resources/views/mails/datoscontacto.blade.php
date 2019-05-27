
<h2>@lang("Lo que devuelve el formulario de contacto")</h2>

<?php
echo @lang("E-mail:").($_POST['email']).'<br/>';
echo @lang("Asunto:").($_POST['subject']).'<br/>';
echo @lang("Mensaje:").($_POST['message']).'<br/>';
?>