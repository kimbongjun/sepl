<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2019-06-12
 * Time: 오전 9:55
 */


/**
 *  회원가입후 자동 로그인
 *  출처 : 코스모팜
 */
//add_action('wpmem_post_register_data', 'my_registration_hook', 1);
//function my_registration_hook($fields){
//    $user = get_userdata($fields['ID']);
//    wp_set_current_user($user->ID, $user->user_login);
//    wp_set_auth_cookie($user->ID, false);
//    do_action('wp_login', $user->user_login, $user);
//}
/**
 * 회원가입약관 동의 후 회원가입 처리
 */

add_action('wp' , 'check_agreement');
function check_agreement(){
//    if(is_page('sign-up')){
//        if ( ! isset( $_POST['show_terms_of_membership_field'] )
//            || ! wp_verify_nonce( $_POST['show_terms_of_membership_field'], 'show_terms_of_membership_action' )
//        ) {
////            print '잘못된 경로로 접근';
//            wp_redirect('terms-of-membership');
//            die();
//        } else {
//            if ((isset($_POST['agree1']) && isset($_POST['agree2']))){
//                wp_redirect('terms-of-membership');
//                die();
//            }
//        }
//    }
}


add_filter('wpmem_register_form', 'my_register_form_filter', 10, 4);
function my_register_form_filter($form, $toggle, $rows, $hidden){
//    $form = '<form>새로운 레이아웃으로 바꿀 수 있습니다.</form>';
    $form = "
        <form name=\"form\" method=\"post\" action=\"/register_complete/\" id=\"wpmem_register_form\" class=\"form\">
        <div class='clearfix'>
            <h3 class='float-left'>회원정보입력</h3>
            <p class='float-right'><span class='accent'>*</span> 필수 입력 항목입니다.</p>
        </div>        
        <table class='register-table'>
        <caption>
        회원가입 - 회원정보입력
        </caption>
        <tbody>
        <tr>
            <th>이름 <span class='accent'>*</span></th>
            <td><input type=\"text\" id=\"first_name\" name=\"first_name\" class=\"int\" title=\"first_name\" maxlength=\"20\" required='required'></td>
        </tr>
        <tr>
            <th>학교명 <span class='accent'>*</span></th>
            <td><input type=\"text\" id=\"user_school\" name=\"user_school\" class=\"int\" title=\"user_school\" maxlength=\"20\" required='required'></td>
        </tr>
        <tr>
            <th>학년 <span class='accent'>*</span></th>
            <td><input type=\"text\" id=\"user_class\" name=\"user_class\" class=\"int\" title=\"user_class\" maxlength=\"20\" required='required'></td>
        </tr>
        <tr>
            <th>아이디 <span class='accent'>*</span></th>
            <td>
                <input type=\"text\" id=\"username\" name=\"username\" class=\"int\" title=\"username\" maxlength=\"20\" required='required'>
                <input type='button' onclick='' value='중복확인' class='btn btn-third'>
            </td>
        </tr>
        <tr>
            <th>비밀번호 <span class='accent'>*</span></th>
            <td><input type=\"password\" id=\"password\" name=\"password\" class=\"int\" title=\"password\" maxlength=\"20\" required='required'></td>
        </tr>
        <tr>
            <th>비밀번호 확인 <span class='accent'>*</span></th>
            <td><input type=\"password\" id=\"confirm_password\" name=\"confirm_password\" class=\"int\" title=\"confirm_password\" maxlength=\"20\" required='required'></td>
        </tr>
        <tr>
            <th>생년월일</th>
            <td><input type=\"text\" id=\"user_birth\" name=\"user_birth\" title=\"생년월일\" ></td>
        </tr>
        <tr>
            <th rowspan='2'>주소</th>
            <td style='font-size:0;'>
                <input type='text' class='input-inline' id='user_postcode' name='user_postcode' placeholder='우편번호'>
                <input type='button' onclick='daumAddress()' value='우편번호 찾기' class='btn btn-third'>                
            </td>                                                                                    
        </tr>
        <tr>
            <td style='font-size:0;'>
                <input type='text' class='input-inline' id='user_address' name='user_address' placeholder='주소'>
                <input type='text' class='input-inline' id='user_detailAddress' name='user_detailAddress' placeholder='상세주소'>
            </td>            
        </tr> 
        <tr>
            <th>이메일 <span class='accent'>*</span></th>
            <td><input type=\"text\" id=\"user_email\" name=\"user_email\" class=\"int\" title=\"user_email\" maxlength=\"20\" required='required'></td>
        </tr>
        <tr>
            <th>학생 휴대폰 <span class='accent'>*</span></th>
            <td><input type=\"text\" id=\"billing_phone\" name=\"billing_phone\" class=\"int\" title=\"billing_phone\" maxlength=\"20\" required='required'></td>
        </tr>
        <tr>
            <th>학부모 이름</th>
            <td><input type=\"text\" id=\"parent_name\" name=\"parent_name\" title=\"학부모 이름\" maxlength=\"20\"></td>
        </tr>
        <tr>
            <th>학부모 휴대폰</th>
            <td><input type=\"text\" id=\"user_hp1\" name=\"user_hp1\" class=\"int\" title=\"user_hp1\" maxlength=\"20\"></td>
        </tr>
        <tr>
            <th>E-Mail 수신동의</th>
            <td>
                <label class='custom-chk'>
                    <input type='checkbox' id='receiveEmail' name='receiveEmail' /> 학습정보 및 이벤트 정보를 수신합니다.
                    <span class='checkmark'></span>
                </label>
            </td>
        </tr>
        <tr>
            <th>SMS 수신동의</th>
            <td>
                <label class='custom-chk'>
                    <input type='checkbox' id='receiveSms' name='receiveSms' /> 학습정보 및 학습관리 서비스를 SMS로 받는 것에 동의합니다
                    <span class='checkmark'></span>
                </label>
            </td>
        </tr>
        </tbody>
        </table>                      
        <input name='wpmem_reg_page' type='hidden' value='/register/'>    
        <div class='btn-wrap'>
            <input type='submit' class='btn btn-primary' value='정보입력완료'>
            <input type='reset' class='btn btn-secondary' value='취소'>
        </div>
        </form>        
        <script src='https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js'></script>
        <script>
        function daumAddress() {
            new daum.Postcode({
                oncomplete: function(data) {       
                    var addr = ''; // 주소 변수
                    var extraAddr = ''; // 참고항목 변수
                
                    if (data.userSelectedType === 'R') {
                        addr = data.roadAddress;
                    } else {
                        addr = data.jibunAddress;
                    }
                    
                    document.getElementById('user_postcode').value = data.zonecode;
                    document.getElementById('user_address').value = addr;           
                    document.getElementById('user_detailAddress').focus();
                }
            }).open();
        }
        </script>
        ";



//    foreach($rows as $row){
//        $form .= "<div class=\"join_row\">
//                        <h3 class=\"join_title\"><label for=\"id\">{$row['label_text']}</label></h3>//                        
//							<input type=\"text\" id=\"{$row['meta']}\" name=\"{$row['meta']}\" class=\"int\" title=\"{$row['meta']}\" maxlength=\"20\">
//                          //                        
//                    </div>
//        ";
//    }
    return $form;
}

/**
 * author : bongjour
 * descrption: 동의없이 회원가입 페이지 이동 시 리다이렉트
 */
function check_regiter(){    
    if(is_page("register") && !isset($_POST['wpmem_reg_page']) ){
        if(!isset($_POST['agree1'])) {
            wp_redirect("/agreement");
            die();
        }
        if(!isset($_POST['agree2'])){
            wp_redirect("/agreement");
            die();
        }
    }
}
add_action("template_redirect" , "check_regiter");

add_action( 'wpmem_register_redirect','the_reg_redirect' );
function the_reg_redirect()
{
    wp_redirect( '/register_complete' );

    die();
}