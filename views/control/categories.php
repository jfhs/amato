<div style="span12">
    <table class="table">
        <tr>
            <th>Название</th>
            <th>Действия</th>
        </tr>
        <?php foreach($categories as $item):?>
        <tr>
            <td><?php echo htmlspecialchars($item->title)?></td>
            <td>
                <?php echo HTML::anchor('control/categories/'.$item->id, '', array('class' => 'icon-pencil', 'title' => 'Редактировать'))?>
                <?php echo HTML::anchor('control/categories/'.$item->id.'/delete', '', array('class' => 'icon-remove', 'title' => 'Удалить'))?>
            </td>
        </tr>
        <?php endforeach?>
    </table>
    <?php echo HTML::anchor('control/categories/0', '<span class="icon-plus"></span>&nbsp;Добавить', array('class' => 'btn'))?>
</div>