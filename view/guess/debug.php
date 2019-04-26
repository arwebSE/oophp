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
<pre class="prettyprint">
<?php echo var_dump($_SESSION); ?>
</pre>

<pre class="prettyprint">
<?php echo var_dump($_POST); ?>
</pre>

<pre class="prettyprint">
<?php echo var_dump($_GET); ?>
</pre>
<hr>
