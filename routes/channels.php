<?php

// routes/channels.php — Broadcast Channel Routes
// Tempat mendefinisikan authorization callbacks untuk broadcast channels.

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
