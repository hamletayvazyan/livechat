<?php

use Illuminate\Support\Facades\Broadcast;

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

//Broadcast::channel('App.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});
//Broadcast::channel('survey.{survey_id}', function ($user, $survey_id) {
//    return [
//        'id' => $user->id,
//        'image' => $user->image(),
//        'full_name' => $user->full_name
//    ];
//});

//Broadcast::channel('newMessage-{sender_id}-{receiver_id}', function ($user, $sender_id, $receiver_id) {
//    $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
//    $txt = $user;
//    fwrite($myfile, $txt);
//    fclose($myfile);
//    return [
//        'sender_id' => $sender_id,
//        'receiver_id' => $receiver_id,
//    ];
//});

//
//Broadcast::channel('newMessage.{receiver_id}-{sender_id}', function ($user, $receiver_id, $sender_id) {
//    return (int) $user->id !== null && $receiver_id == $sender_id;
//});
//Broadcast::channel('chat', function ($user) {
//    return (int) $user->id !== null;
//});
//
//Broadcast::channel('chat.{room_id}', function ($user, $room_id) {
//    return (int) $user->id !== null;
//});
