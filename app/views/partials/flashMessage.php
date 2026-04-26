<?php if (isset($type) && isset($message)): ?>
    <div class="alert alert-<?= htmlspecialchars($type) ?>">
        <?= htmlspecialchars($message) ?>
    </div>

    <style>

    </style>
<?php endif; ?>
