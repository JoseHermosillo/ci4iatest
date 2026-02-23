<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<p>Welcome to your new AdminLTE-powered dashboard, <?= esc(session()->get('user_name')) ?>!</p>

<?= $this->endSection() ?>
