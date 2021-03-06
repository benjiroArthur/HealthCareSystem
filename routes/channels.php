<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


/*Broadcast::channel('user.*', function ($user) {
    return Auth::check();
});*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('adminChannel', function () {
    return true; //Always return true or false
});
Broadcast::channel('online-users', function () {
    return true; //Always return true or false
});

Broadcast::channel('daily-tip', function () {
    return true; //Always return true or false
});

Broadcast::channel('messages.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('Online', function ($user) {
    return $user;
});
