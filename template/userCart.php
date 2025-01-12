<?php
if (!isset($_SESSION["username"])) {
    header("location: login.php");
}
?>

<section class="text-center p-5">
    <h2>Numero articoli presenti:</h2>
    <h2>Totale provvisorio: </h2>
    <form id="createOrder-form" action="checkout.php" method="post" onsubmit='createOrder()' class="mx-auto" style="max-width: 500px;">
        <input form="createOrder-form" type="submit" name="submit" value="ordina"
            class="btn btn-secondary btn-lg mt-3 w-100" /> <!-- Button takes full width of the form -->
        <input form="createOrder-form" type="hidden" name="orderedArticles" value="" />
    </form>
</section>
<section>
</section>