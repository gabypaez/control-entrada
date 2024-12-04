<?php
// $_SESSION["mensaje"]["tipo"] Puede ser danger, warning, info, success, default, secondary, primary
if($_SESSION['mensaje'] ?? null ){
    echo '
        <p class="alert alert-'.($_SESSION["mensaje"]["tipo"] ?? 'default').' alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            '.($_SESSION["mensaje"]["mensaje"] ?? '').'
        </p>
    ';
}
unset($_SESSION['mensaje']);

?>
<script>
    setTimeout(() => {
        $('p.alert').fadeOut(3000);
    }, "3000");
</script>