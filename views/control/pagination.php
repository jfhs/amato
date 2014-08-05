<?php if ($count > 1):
    $symbol = (strpos($link, '?') !== false)?'&':'?'?>
<div class="pagination">
    Страницы: <ul>
        <?php for($i = 1; $i <= $count; ++$i):?>
        <?php if ($i == $current):?>
            <li class="active"><span><?php echo $i?></span></li>
        <?php else:?>
            <li><?php echo HTML::anchor($link.$symbol.'page='.$i, $i)?></li>
        <?php endif;?>
        <?php endfor;?>
    </ul>
</div>
<?php endif;?>