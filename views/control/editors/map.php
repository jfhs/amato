<?php
	$id = $item->pk().'_'.$field;
	echo Form::input($field, $item->$field, array('id' => 'coords_'.$id, 'class' => 'span12'))
?>
<div style="padding-left:0px;" class="container-fluid">
    <div style="height:320px;" id="<?= htmlspecialchars('map_'.$id)?>" class="thumbnail span7"></div>
</div>
<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU&coordorder=longlat" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    var myMap;
	ymaps.ready(init);

    function init(){
        myMap = new ymaps.Map (<?=json_encode('map_'.$id)?>, {
            center: [<?= $item->$field?$item->$field:'71.45145,51.178629'?>],
            zoom: 17
        });
        myMap.controls
                .add('smallZoomControl', {right: 5, top: 75})
                .add('typeSelector');
		<?php if (isset($params['placemarks'])):
				$i = 0; foreach($params['placemarks'] as $place):
					if (!$place) continue;
		?>
        metka_<?= $i?> = new ymaps.Placemark([<?= $place?>], {
            balloonContent: ''
        }, {
            iconImageHref: '/media/img/mark1.gif',
            iconImageSize: [23, 37],
            iconImageOffset: [-15,-35]
        });
		myMap.geoObjects.add(metka_<?= $i?>);
		<?php
				++$i;
				endforeach;
			endif;
		?>

        myMap.events.add('click', function (e) {
            if(typeof metka != 'undefined')
                return false;
            metka = new ymaps.Placemark(e.get('coordPosition'), {
                balloonContent: ''
            }, {
                iconImageHref: '/media/img/mark.gif',
                iconImageSize: [23, 37],
                iconImageOffset: [-15,-35],
                draggable: true
            });
            myMap.geoObjects.add(metka);
            metka.events.add('dragend', function(e){
                $(<?= json_encode('#coords_'.$id)?>).val(e.get('target').geometry.getCoordinates());
            })
            $(<?= json_encode('#coords_'.$id)?>).val(e.get('coordPosition'));
        });
    }
});
</script>  