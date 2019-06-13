<?php
add_filter( 'wpmem_login_form', 'my_login_form_filter', 10, 2 );
 
function my_login_form_filter( $form, $action )
{
   $form = "<div class='signin-form'>
        <div class='signin-form-wrap'>
        <h3>로그인 정보</h3>
        <div class='row'>
            <div class='col-md-6'>
                <form method='post' action='/login'>
<input type='hidden' name='a' value='login'>
<fieldset>
    <legend>로그인</legend>
<div class='div_text'>
    <input name='log' type='text' id='log' class='username' placeholder='아이디를 입력하세요'>
</div>
<?php endif?>
<div class='div_text'>
    <input name='pwd' type='password' id='pwd' class='password'>
</div>

<div class='button_div'>
    <label class='custom-chk'>
        <input type='checkbox' id='rememberme' name='rememberme' value='forever'> 아이디 저장하기
        <span class='checkmark'></span>
    </label>
    <input type='submit' class='button btn-submit' value='회원로그인'>
</div>
</fieldset>
</form>

</div>
<div class='col-md-6'>
    <figure>
        <img src='/wp-content/themes/Avada-Child-Theme/dist/imgs/login_image.jpg' alt=''>
    </figure>
</div>
</div>
<nav role='navigation' class='login-util-menu'>
    <ul>
        <li class='register'>
            <a href='/register/'>회원가입</a>
        </li>
        <li><a href='/profile/?a=getusername'>아이디 찾기</a></li>
        <li><a href='/profile/?a=pwdreset'>비밀번호 찾기</a></li>
    </ul>
</nav>
</div>
</div>";
return $form;
}