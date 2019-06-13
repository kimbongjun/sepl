<?php
function location($atts = [], $tag = '') {
    ob_start();
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    $wporg_atts = shortcode_atts($atts, $tag);
    if($wporg_atts){
      if(isset($wporg_atts['id'])) $id =  $wporg_atts['id'];
      if(isset($wporg_atts['map'])) $map = $wporg_atts['map'];
      if(isset($wporg_atts['lat'])) $lat = $wporg_atts['lat'];
      if(isset($wporg_atts['lng'])) $lng = $wporg_atts['lng'];
      if(isset($wporg_atts['zoom'])) $zoom = $wporg_atts['zoom'];
      if(isset($wporg_atts['height'])) $height = $wporg_atts['height'];
    }
    if($map == 'google'){
      echo '<div id='.$id.' style="height:'.$height.'px"></div>';
      ?>
<script type="text/javascript">
var myLatLng = {
    lat: <?=$lat?>,
    lng: <?=$lng?>
};

var map = new google.maps.Map(document.getElementById('<?=$id?>'), {
    zoom: <?=$zoom?>,
    center: myLatLng
});
var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'Hello World!'
});
</script>
<?php
    }
    elseif ($map == 'daum') {
    ?>
<div id="<?=$id?>" style="height: <?php if($height) echo $height?>px;"></div>
<script type="text/javascript">
var mapContainer = document.getElementById('<?=$id?>'), // 지도를 표시할 div
    mapOption = {
        center: new daum.maps.LatLng(<?=$lat?>, <?=$lng?>), // 지도의 중심좌표
        level: <?=$zoom?> // 지도의 확대 레벨
    };
var map = new daum.maps.Map(mapContainer, mapOption); // 지도를 생성합니다
var mapTypeControl = new daum.maps.MapTypeControl();
map.addControl(mapTypeControl, daum.maps.ControlPosition.TOPRIGHT);

var zoomControl = new daum.maps.ZoomControl();
map.addControl(zoomControl, daum.maps.ControlPosition.RIGHT);

var markerPosition = new daum.maps.LatLng(<?=$lat?>, <?=$lng?>);
var marker = new daum.maps.Marker({
    position: markerPosition
});
marker.setMap(map);
</script>
<?php
  }elseif ($map == 'naver') {
    ?>
<div id="<?=$id?>"></div>
<script>
var map = null;
var mapOptions = {
    mapTypeControl: true,
    mapTypeControlOptions: {
        style: naver.maps.MapTypeControlStyle.BUTTON,
        position: naver.maps.Position.TOP_RIGHT
    },
    center: new naver.maps.LatLng(<?=$lat?>, <?=$lng?>),
    zoom: <?=$zoom?>,
    scaleControl: false,
    logoControl: false,
    mapDataControl: false,
    zoomControl: true,
    minZoom: 1
};
var map = new naver.maps.Map('<?=$id?>', mapOptions);
var marker = new naver.maps.Marker({
    position: new naver.maps.LatLng(<?=$lat?>, <?=$lng?>),
    map: map
});
</script>
<?php
  }
    return ob_get_clean();
}
add_shortcode( 'location', 'location' );