<div style="span12">
    <?php echo Form::open('', array('method' => 'post'));?>
    <table style="width: 100%;" class="table" >
        <tr style="background-color: #F2F2F2">
            <?php foreach($languages as $id=>$title):?>
            <th><?php echo htmlspecialchars($title)?></th>
            <?php endforeach;?>
        </tr>
        <?php foreach($literals as $literal):?>
        <tr style="width:40%;">
            <?php foreach($languages as $id=>$title): $tr = ORM::factory('Literal', array('id' => $literal->id, 'lang' => $id)); ?>
            <td>
                <?php if ($id == 'ru'):?>
                    <?php echo $literal->text?>
                <?php else:?>
                    <?php echo Form::input('literal['.$literal->id.']['.$id.']', $tr->translation, array('class' => 'span9'))?>
                <?php endif;?>
            </td>
            <?php endforeach;?>
        </tr>
        <?php endforeach;?>
    </table>
    <?php echo Form::submit('', 'Сохранить', array('class' => 'btn btn-primary'))?>
    <?php echo Form::close();?>
</div>