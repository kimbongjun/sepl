<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2019-06-05
 * Time: 오전 9:44
 */

// iosys api 연결
include "iosys_api.php";
// 약관
include "wpmem_agree.php";
// 회원 가입
include "wpmem_register.php";
// 로그인
include "wpmem_login.php";
/// 캠퍼스 설정
if(is_admin()){
    include "option-page.php";
}

    