<?php

function iosys_api_url($type){
    return array(
        'newuser' => "http://kor.sepal.co.kr/okms-cli/api/member/add.dox",
        'edituser' => "http://kor.sepal.co.kr/okms-cli/api/member/edit.dox",
    );
}
/**
 *  iosys 전송
 *  회원 가입후 전송할 데이터를 불러와서 처리
 */
add_action( 'wpmem_post_register_data', 'iosys_send_userInfo', 999, 1 );
function iosys_send_userInfo( $fields ) {
    $jwt_data = array(
        'username' => $fields['username'],
        'password' => $fields['password']
    );

    $url = "http://sepl.co.kr/wp-json/jwt-auth/v1/token";

    $curl = curl_init($url);  //curl 초기화
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($jwt_data));       //POST data

    $response = curl_exec($curl);
    $array = json_decode($response);
    $token = $array->token;

    curl_close($curl);

    $data = array(
        'usergb' => $usergb,
        'username' => $fields['first_name'],
        'loginid' => $fields['username'],
        'userpwd' => $fields['password'],
        'schnm' => $fields['user_school'],
        'grade' => $fields['user_class'],
        'phnno' => $fields['billing_phone'],
        'pPhnno' => $fields['user_hp1'],
        'pPhnno2' => $fields['user_hp2'],
        'campusSeq' => get_option('campus_code'),       // 캠퍼스 코드
    );

    $response = send_iosys_user_api($data , iosys_api_url('newuser'));

    add_user_meta($fields['ID'], 'new_iosys_user_response', $response);
    $info = json_decode($response);
    add_user_meta($fields['ID'], 'new_iosys_user_seq' , $info->userInfo->userSeq);

    die();
}

/**
 * 회원 정보 수정후 IOSYS 전송
 */
add_action('wpmem_post_update_data' , 'wpmem_post_update_data');
function wpmem_post_update_data($fields){

    $userSeq = get_user_meta($fields['ID'] , 'new_iosys_user_seq' , true);      // IOSYS 회원 번호

    $data = array(
        'username' => $fields['first_name'],
        'loginid' => $fields['username'],
        'userpwd' => $fields['password'],
        'schnm' => $fields['user_school'],
        'grade' => $fields['user_class'],
        'phnno' => $fields['billing_phone'],
        'pPhnno' => $fields['user_hp1'],
        'pPhnno2' => $fields['user_hp2'],
        'campusSeq' => get_option('campus_code'),       // 캠퍼스 코드
    );

    if(!$userSeq) {              // 신규 정보가 없을때 다시 보내 등록
        $response = send_iosys_user_api($data, iosys_api_url('newuser'));
        update_user_meta($fields['ID'], 'new_iosys_user_response', $response);
        $info = json_decode($response);
        update_user_meta($fields['ID'], 'new_iosys_user_seq' , $info->userInfo->userSeq);
    }

    $data['userSeq'] = $userSeq;
    $data['userstat'] = 'S';

    $response = send_iosys_user_api($data, iosys_api_url('edituser'));
    update_user_meta($fields['ID'], 'new_iosys_user_last', $response . "|" . date("YmdHis"));       // 수정일

}

/**
 * IOSYS 신규 유저 추가 API
 * @param $fields
 * @return string
 */
function send_iosys_user_api( $data , $apiurl ){
    $usergb = "CS01";       // 권한 학생 : CS01 강사: CT01
    $data['usergb'] = $usergb;
    $postdata = json_encode($data);
    $opts = array('http' =>
        array(
            'method'  => 'POST',
            'header'  => 'Content-type: application/json',
            'content' => $postdata
        )
    );
    $context  = stream_context_create($opts);
    $result = file_get_contents($apiurl, false, $context);
    return $result;
}

