<?php
/**
 * 회원 가입 약관
 */
function show_terms_of_membership(){
    ob_start();
    if(!is_user_logged_in()):
    ?>
<div class="register-tab">
    <ul>
        <li><span class="icon-icon-agree"></span></li>
        <li><span class="icon-icon-userinfo"></span></li>
        <li><span class="icon-icon-complete"></span></li>
    </ul>
</div>
<div class="agreement">
    <form id="agreementForm" method="post"
        action="<?php echo esc_url( get_permalink( get_page_by_path( 'register' ) ) ); ?>">
        <?php echo '<h3>'.get_the_title( 79 ).'</h3>' ?>
        <div class="box__textarea scrollable">
            <!-- 회원 가입 약관 -->
            <?php echo get_post_field('post_content', 79); ?>
        </div>
        <label class='custom-chk'>
            <input type='checkbox' id='agree1' name='agree1' required="required"> 위의 서비스 이용약관에 동의합니다.
            <span class='checkmark'></span>
        </label>
        <?php echo '<h3>'.get_the_title( 82 ).'</h3>' ?>
        <div class="box__textarea scrollable">
            <!-- 개인 보호 정책 -->
            <?php echo get_post_field('post_content', 82); ?>
        </div>
        <label class='custom-chk'>
            <input type="checkbox" id="agree2" name='agree2' required="required" /> 위의 개인정보 취급방침에 동의합니다.
            <span class='checkmark'></span>
        </label>
        <?php wp_nonce_field( 'show_terms_of_membership_action', 'show_terms_of_membership_field' ); ?>
        <div class="btn-wrap">
            <button type="submit" class="btn btn-primary terms-btn">동의합니다.</button>
            <button type="reset" class="btn btn-secondary">취소</button>
        </div>
    </form>
</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('.terms-btn').on('click', function() {
        var checkBox = document.getElementById("agree1");
        var checkBox2 = document.getElementById("agree2");
        var form = document.getElementById("agreementForm");
        if (checkBox.checked == false) {
            alert("서비스 이용약관에 동의하여 주시기 바랍니다.");
        } else if (checkBox2.checked == false) {
            alert("개인정보 취급방침에 동의하여 주시기 바랍니다.");
        } else {
            form.submit();
        }
        return false;
    });

    // $('#agree3').on('click', function() {
    //     var chk = $(this).is(":checked");
    //     if (chk) {
    //         $('#agree1').attr('checked', true);
    //         $('#agree2').attr('checked', true);
    //     } else {
    //         $('#agree1').attr('checked', false);
    //         $('#agree2').attr('checked', false);
    //     }
    // })
});
</script>
<?php
endif;
return ob_get_clean();
}
add_shortcode('show-terms-of-membership' , 'show_terms_of_membership');