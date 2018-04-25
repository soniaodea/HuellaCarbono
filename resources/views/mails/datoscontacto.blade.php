
<h2>Lo que devuelve el formulario de contacto</h2>

<?php
echo 'Email: '.($_POST['email']).'<br/>';
echo 'Asunto: '.($_POST['subject']).'<br/>';
echo 'Mensaje: '.($_POST['message']).'<br/>';
?>