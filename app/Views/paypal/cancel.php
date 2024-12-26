<h2>Payment Failed or Canceled</h2>
<p>There was an issue with the payment. Please try again later.</p>
<?php if (isset($error)) : ?>
    <p>Error: <?= $error ?></p>
<?php endif; ?>
