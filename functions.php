<?php
include_once(get_stylesheet_directory().'/inc/woo-single.php');
include_once('shortcode.php');
include_once(get_stylesheet_directory().'/inc/functions-ext.php');
function theme_enqueue_styles() {
    wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/dist/main.css', array());
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );
    wp_enqueue_script( 'google-js', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBHILcxVee1y2h719Ry_AEedMITr9vkOB8', array(), '1.0.0', false );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );

// 커스텀 타이틀
function title_banner(){
    if(!is_front_page()):
    ?>
<div class="titleBanner">
    <div class="titleBanner__text">
        <h2>김면수 국어</h2>
        <p>한 단원을 탄탄하게 완성하는 내신국어<br />
            강력한 1:1 고등내신국어 프로그램으로 완벽하게 책임지겠습니다.</p>
    </div>
</div>
<?php
endif;
}
add_action('avada_override_current_page_title_bar', 'title_banner');

function lectureRoom($atts = [], $tag = ''){
    ob_start();    
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    $wporg_atts = shortcode_atts($atts, $tag);
    if($wporg_atts){
      if(isset($wporg_atts['column'])) $column =  $wporg_atts['column'];
    }
	?>
<ul class="list-lecture">
    <li>
        <div class="list-lecture-box">
            <h3>대치고1</h3>
            <p>1학기 중간고사</p>
            <a href="http://sepl.co.kr/product/%eb%8c%80%ec%b9%98%ea%b3%a01/" class="btn-lecture enterence"><span
                    class="btn-lecture-txt">강의실 입장</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>진선여고2</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture apply"><span class="btn-lecture-txt">수강신청</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>압구정고2</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture apply"><span class="btn-lecture-txt">수강신청</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>대치고2</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture enterence"><span class="btn-lecture-txt">강의실 입장</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>현대고1</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture enterence"><span class="btn-lecture-txt">강의실 입장</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>대치고1</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture enterence"><span class="btn-lecture-txt">강의실 입장</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>진선여고2</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture apply"><span class="btn-lecture-txt">수강신청</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>압구정고2</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture apply"><span class="btn-lecture-txt">수강신청</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>대치고2</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture enterence"><span class="btn-lecture-txt">강의실 입장</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>현대고1</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture enterence"><span class="btn-lecture-txt">강의실 입장</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>대치고1</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture enterence"><span class="btn-lecture-txt">강의실 입장</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>진선여고2</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture apply"><span class="btn-lecture-txt">수강신청</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>압구정고2</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture apply"><span class="btn-lecture-txt">수강신청</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>대치고2</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture enterence"><span class="btn-lecture-txt">강의실 입장</span></a>
        </div>
    </li>
    <li>
        <div class="list-lecture-box">
            <h3>현대고1</h3>
            <p>1학기 중간고사</p>
            <a href="#" class="btn-lecture enterence"><span class="btn-lecture-txt">강의실 입장</span></a>
        </div>
    </li>
</ul>
<?php
    return ob_get_clean();
}
add_shortcode("lectureRoom","lectureRoom");

function modify_avada_footer_copyright_content() {  
	?>
<div class="custom-footer-content">
    <div class="copyright">
        <div class="copyright-col">
            <h3>(주)오라인포 <em>운영사</em></h3>
            <p>주소 : 서울시 금천구 가산디지털1로83, 10층(가산동, 파트너스타워1차) | 사업자등록번호 : 106-86-21229 | 통신판매업신고번호 : 제2018-서울금천-0756호 | 대표전화
                : 1544-1680 | 대표자 : 조주형</p>
            <small>Copyright (C) 2019 OWRAINFO CO.,LTD All Rights Reserved</small>
        </div>
        <div class="copyright-col">
            <h3>김면수국어</h3>
            <p>주소 : 인천광역시 연수구 송도동 3-4 센타프라자 506호, 인천광역시 연수구 송도동 20-3 플러스애비뉴 401호 I 대표전화 : 032-816-7566 I 사업자등록번호
                :
                117-81-81450 I 대표자 : 김면수</p>
        </div>
        <div class="copyright-col social">
            <?php		
			global $social_icons;

			$footer_social_icon_options = array(
			'position'          => 'footer',
			'icon_boxed'        => Avada()->settings->get( 'footer_social_links_boxed' ),
			'icon_boxed_radius' => Fusion_Sanitize::size( Avada()->settings->get( 'footer_social_links_boxed_radius' ) ),
			'tooltip_placement' => Avada()->settings->get( 'footer_social_links_tooltip_placement' ),
			'linktarget'        => Avada()->settings->get( 'social_icons_new' ),
			);

			echo $social_icons->render_social_icons( $footer_social_icon_options ); // WPCS: XSS ok.
		?>
        </div>
    </div>
</div>
<?php
}
add_filter( 'avada_footer_copyright_content', 'modify_avada_footer_copyright_content' );


add_action( 'wp_footer', 'my_loginout_menu_item' );
function my_loginout_menu_item() {
    if ( is_user_logged_in() ) {
        // Handle the log out url.
        $logout = apply_filters( 'wpmem_logout_link', add_query_arg( 'a', 'logout' ) );
    ?>
<script type="text/javascript">
jQuery('.loginout').html(
    '<a class="login_button" href="<?php echo $logout; ?>"><span class="menu-text">로그아웃</span></a>');
jQuery('.loginout2').html('<a class="login_button" href="/profile"><span class="menu-text">프로필 보기</span></a>');
</script>
<?php }
}