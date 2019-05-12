<?php

namespace Anax\View;

/**
 * Debug file.
 */
?>

<!--
<link rel="stylesheet" type="text/css" href="css/prettify.min.css">
<link rel="stylesheet" type="text/css" href="css/guess.css">
<script type="text/javascript" src="js/prettify.min.js"></script>
 -->
<script type="text/javascript" >
/* var bod = document.body;
document.body = bod.onload = PR.prettyPrint();
console.log("cbod:", bod); */
</script>

<hr>

<?php

if ($game->playerHistory) {
    echo 'Player history';
    echo '<pre class="prettyprint">';
    echo var_dump($game->playerHistory);
    echo '</pre>';
}

if ($game->pcHistory) {
    echo 'PC history';
    echo '<pre class="prettyprint">';
    echo var_dump($game->pcHistory);
    echo '</pre>';
}

echo 'SESSION';
echo '<pre class="prettyprint">';
echo var_dump($app->session);
echo '</pre>';

echo 'GET';
echo '<pre class="prettyprint">';
echo var_dump($_GET);
echo '</pre>';

echo 'POST';
echo '<pre class="prettyprint">';
echo var_dump($_POST);
echo '</pre><hr>';

?>
