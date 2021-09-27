<?php

use Illuminate\Support\Facades\Config;

function get_default_lang(){
    return   Config::get('app.locale');
}


function uploadImage($folder, $image)
{
    //$image->store( $folder);
    $filename = $image->hashName();
    $path2 = public_path("images/".$folder);
    $image->move($path2,$filename);
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}

    function sendmessage( $token, $title , $body)
    {

        $token = $token;
        $from = "AAAAJ8k022I:APA91bEwcXdHoWDfc-IMv35cp9CN4MwH2adGq0tYqK9w5VeA2L8ygXZudvMeS5MTj_qHWLEE_u0NSIrPPR2o6tRysrWAX8GFrktqcVIUYMjKudzZ18d4u7OAmN0u5P0Xx_LwjcUP5BO9";
        $msg = array
              (
                'body'     => $body,
                'title'    => $title,
                'receiver' => 'erw',
                'icon'     => "https://salon-eljoker.com/images/joker.jpg",/*Default Icon*/
                'vibrate'	=> 1,
	            'sound'		=> "http://commondatastorage.googleapis.com/codeskulptor-demos/DDR_assets/Kangaroo_MusiQue_-_The_Neverwritten_Role_Playing_Game.mp3",
              );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        return $result;
    }

