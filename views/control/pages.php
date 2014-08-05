<div style="span12">
    <table class="table">
        <tr>
            <th>#</th>
            <th>Название</th>
            <th>Действия</th>
        </tr>
        <?php foreach($pages as $item):?>
        <tr>
            <td><?php echo $item->id?></td>
            <td><?php echo htmlspecialchars($item->title)?></td>
            <td>
                <?php echo HTML::anchor('control/pages/'.$item->id, '', array('class' => 'icon-pencil', 'title' => 'Редактировать'))?>
                <?php echo HTML::anchor('control/pages/'.$item->id.'/delete', '', array('class' => 'icon-remove', 'title' => 'Удалить'))?>
            </td>
        </tr>
        <?php endforeach?>
    </table>
    <?php echo HTML::anchor('control/pages/0', '<span class="icon-plus"></span>&nbsp;Добавить', array('class' => 'btn'))?>
</div>