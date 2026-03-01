<?php if (!empty($loggedIn) && !empty($userName)) : ?>
    <div class="alert alert-success mt-3">
        Bonjour ! <?= htmlspecialchars($userName) ?>
    </div>
<?php endif; ?>