<?= $this->extend('layouts/auth') ?>

<?= $this->section('content') ?>

<?php if(session()->get('errors')): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach(session()->get('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="<?= site_url('register') ?>">
    <?= csrf_field() ?>
    <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" value="<?= old('name') ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= old('email') ?>" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Register</button>
</form>

<hr>
<p class="text-center">
    Already have an account? <a href="<?= site_url('login') ?>">Login here</a>
</p>

<?= $this->endSection() ?>
