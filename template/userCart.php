<?php
if (!isset($_SESSION["username"])) {
    header("location: login.php");
}
?>

<section>
    <h2>Numero articoli presenti:</h2>
    <h2>Totale provvisorio: </h2>
    <form id="checkout-form" action="utils/checkout.php" method="post">
        <input form="checkout-form" type="submit" name="submit" value="checkout">
    </form>
</section>
<section>

</section>