<?php
#-------------------------[Include]-------------------------#
require_once('./include/line_class.php');
require_once('./unirest-php-master/src/Unirest.php');
#-------------------------[Token]-------------------------#
$channelAccessToken = '1OSL49zxkfS0UHF+rgnlPPZr3v14+OwyxGwv/3UexqPCsDlPfy4gFetFknIbmYoMrVYGMBWbeK0000ucSiaNNWBqqKbTWWhgXvjbGQi5CsE1bpBouGPQ0PMLdxOFHna6VjJ6H7SH8U5mGGGKZNMggQdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '485c1b6d74506c3fb18954aa16c935c0';
#-------------------------[Events]-------------------------#
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$userId     = $client->parseEvents()[0]['source']['userId'];
$groupId    = $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp  = $client->parseEvents()[0]['timestamp'];
$type       = $client->parseEvents()[0]['type'];
$message    = $client->parseEvents()[0]['message'];
$profile    = $client->profil($userId);
$repro = json_encode($profile);
$messageid  = $client->parseEvents()[0]['message']['id'];
$msg_type      = $client->parseEvents()[0]['message']['type'];
$msg_message   = $client->parseEvents()[0]['message']['text'];
$msg_title     = $client->parseEvents()[0]['message']['title'];
$msg_address   = $client->parseEvents()[0]['message']['address'];
$msg_latitude  = $client->parseEvents()[0]['message']['latitude'];
$msg_longitude = $client->parseEvents()[0]['message']['longitude'];
#----command option----#
$usertext = explode(" ", $message['text']);
$command = $usertext[0];
$options = $usertext[1];
if (count($usertext) > 2) {
    for ($i = 2; $i < count($usertext); $i++) {
        $options .= '+';
        $options .= $explode[$i];
    }
}
#------------------------------------------
$modex = file_get_contents('./user/' . $userId . 'mode.json');
if ($modex == 'Normal') {
    #$uri = "https://itdev.win/test";
    #$urikey = file_get_contents($uri);
    #$json = json_decode($urikey, true);
    $uri = "https://script.google.com/macros/s/AKfycbwugQU30OsbDJQQXc9zW6fNfiWk2IKOr-L9CgOHfutDPCiiXdg/exec";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $results = array_filter($json['user'], function($user) use ($command) {
    return $user['SITE'] == $command;
    }
  );
$i=0;
$bb = array();
foreach($results as $resultsz){
$bb[$i] = $resultsz;
$i++;
}
$site01 .= $bb['0']['SITE DONOR JOB'];
$site02 .= $bb['1']['SITE DONOR JOB'];
$site03 .= $bb['2']['SITE DONOR JOB'];
$site04 .= $bb['3']['SITE DONOR JOB'];
$site05 .= $bb['4']['SITE DONOR JOB'];
$site06 .= $bb['5']['SITE DONOR JOB'];
if(empty($site01)) {
  $site01 .= 'ไม่มีเพิ่มเติม';
}
if(empty($site02)) {
  $site02 .= 'ไม่มีเพิ่มเติม';
}
if(empty($site03)) {
  $site03 .= 'ไม่มีเพิ่มเติม';
}
if(empty($site04)) {
  $site04 .= 'ไม่มีเพิ่มเติม';
}
if(empty($site05)) {
  $site05 .= 'ไม่มีเพิ่มเติม';
}
if(empty($site06)) {
  $site06 .= 'ไม่มีเพิ่มเติม';
}
$textz .= "กรุณาระบุ SITE DONOR JOB ที่ต้องการค้นหา";
if(empty($results)) {
      $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array( 
          array(
                'type' => 'text',
                'text' => 'ไม่พบข้อมูล'
)
        )
      );
    }
else {
    $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array( 
          array(
                'type' => 'text',
                'text' => $textz,
                'quickReply' => array(
                'items' => array(
                                   array(
                'type' => 'action',
                'action' => array(
                'type' => 'message',
                'label' => $site01,
                'text' => $site01
                                 )
              ),array(
                'type' => 'action',
                'action' => array(
                'type' => 'message',
                'label' => $site02,
                'text' => $site02
                                 )
              ),array(
                'type' => 'action',
                'action' => array(
                'type' => 'message',
                'label' => $site03,
                'text' => $site03
                                 )
              ),array(
                'type' => 'action',
                'action' => array(
                'type' => 'message',
                'label' => $site04,
                'text' => $site04
                                 )
              )
              ,array(
                'type' => 'action',
                'action' => array(
                'type' => 'message',
                'label' => $site05,
                'text' => $site05
                                 )
              )
              ,array(
                'type' => 'action',
                'action' => array(
                'type' => 'message',
                'label' => $site06,
                'text' => $site06
                                 )
              )
                                )
                                     )
     )
     )
     );
$enbb = json_encode($bb);
    file_put_contents('./user/' . $userId . 'data.json', $enbb);
    file_put_contents('./user/' . $userId . 'mode.json', 'keyword');
    }
}
elseif ($modex == 'keyword') {
    $urikey = file_get_contents('./user/' . $userId . 'data.json');
    $deckey = json_decode($urikey, true);
    $results = array_filter($deckey, function($user) use ($command) {
    return $user['SITE DONOR JOB'] == $command;
    }
  );
$i=0;
$zaza = array();
foreach($results as $resultsz){
$zaza[$i] = $resultsz;
$i++;
}
$enzz = json_encode($zaza);
    file_put_contents('./user/' . $userId . 'data.json', $enzz);
$text .= 'SITE : ' . $zaza[0]['SITE'];
$text .= "\n";
$text .= 'SITE DONOR JOB : ' . $zaza[0]['SITE DONOR JOB'];
$text .= "\n";
$text .= 'TEAM : ' . $zaza[0]['TEAM'];
$text .= "\n";
$text .= 'WBS : ' . $zaza[0]['WBS'];
$text .= "\n";
$text .= 'BRAND OLT : ' . $zaza[0]['BRAND OLT'];
$text .= "\n";
$text .= 'PON : ' . $zaza[0]['PON'];
$text .= "\n";
$text .= 'INSTALLATION DATE : ' . $zaza[0]['INSTALLATION DATE'];
$text .= "\n";
$text .= 'STATUS : ' . $zaza[0]['STATUS'];
$text .= "\n";
$text .= 'PHOTO ON WEB : ' . $zaza[0]['PHOTO ON WEB'];
$text .= "\n";
$text .= 'REMARK PHOTO : ' . $zaza[0]['REMARK PHOTO'];
$text .= "\n";
$text .= 'STATUS PHOTO : ' . $zaza[0]['STATUS PHOTO'];
$text .= "\n";
$text .= 'STATUS DOC : ' . $zaza[0]['STATUS DOC'];
$text .= "\n";
$text .= 'REMARK : ' . $zaza[0]['REMARK'];
$text .= "\n";
$text .= 'SSR ID : ' . $zaza[0]['SSR ID'];
$text .= "\n";
$text .= 'STATUS TPT : ' . $zaza[ 0]['STATUS TPT'];
    $mreply = array(
        'replyToken' => $replyToken,
        'messages' => array( 
          array(
                'type' => 'text',
                'text' => $text
     )
     )
     );
    file_put_contents('./user/' . $userId . 'mode.json', 'Normal');
}
else {
  file_put_contents('./user/' . $userId . 'mode.json', 'Normal');
}
if (isset($mreply)) {
    $result = json_encode($mreply);
    $client->replyMessage($mreply);
}  
?>
