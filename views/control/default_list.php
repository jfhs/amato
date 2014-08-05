<div class="container-fluid">
    <div class="row-fluid">

        <?php if ($categories = ORM::factory($model)->categories()):?>
        <div class="span2 slidebar">
            <h4>Разделы</h4>
            <ul style="top: 65px; position: absolute;width: 16.53%;" class="nav nav-list bs-docs-sidenav affix scrollaff">
                <?php if ($link = ORM::factory($model)->category_add_link()):?>
                <li>
                    <?= HTML::anchor($link, '<i class="icon-plus"></i>Добавить')?>
                </li>
                <?php endif;?>
                <?php foreach($categories as $category):?>
                <li>
                    <?= HTML::anchor($category['link'], $category['title'])?>
                    <?php if (isset($category['dropdown'])):?>
                    <div class="dropdown">
                        <i onmouseover="$(this).click();" data-toggle="dropdown" class="icon-chevron-down dropdown-toggle"></i>
                        <ul class="dropdown-menu">
                            <?php foreach($category['dropdown'] as $i=>$dropdown):?>
                            <li>
                                <?= HTML::anchor($dropdown['link'], $dropdown['title'], array('tabindex' => -1))?>
                            </li>
                            <?php if ($i != count($category['dropdown']) - 1):?>
                            <li class="divider"></li>
                            <?php endif;?>
                            <?php endforeach;?>
                        </ul>
                    </div>
                    <?php else:?>
                    <i class="icon-chevron-right"></i>
                    <?php endif;?>
                </li>
                <?php endforeach?>
            </ul>
        </div>
        <?php endif;?>
        <div class="<?= $categories?' span10 tabpad':''?>">
            <?php if (ORM::factory($model)->allows_add()):?>
            <?php echo HTML::anchor('control/'.$type.'/0'.'?'.http_build_query(array('filters' => $filters)), '<span class="icon-plus"></span>&nbsp;Добавить', array('class' => 'btn', 'style' => 'float: right; overflow:hidden; margin-bottom:5px;'))?>
            <?php endif;?>
            <table class="table table-bordered">
                <tr>
                    <?php foreach(ORM::factory($model)->table_fields() as $title):?>
                    <th class="pull-center"><?php echo htmlspecialchars(is_array($title)?$title[0]:$title)?></th>
                    <?php endforeach;?>
                    <th class="pull-center">Действия</th>
                </tr>
                <?php foreach($items as $item):?>
                <tr style="font-size: 14px; font-weight: bolder; margin-left: 10px">
                    <?php foreach($item->table_fields() as $field=>$title):?>
                    <?php
                    $link =  is_array($title) && in_array('link',  $title);
                    $check = is_array($title) && in_array('check', $title);
                    $image = is_array($title) && in_array('image', $title);
                    $title = is_array($title)?$title[0]:$title;
                    $path = explode('.', $field);
                    $result = $item;
                    foreach($path as $el) {
                        $result = $result->$el;
                    }
                    ?>
                    <td class="pull-center">
                        <?php if ($link):?>
                        <?php echo HTML::anchor('control/'.$type.'/'.$item->pk().'?'.http_build_query(array('filters' => $filters)), htmlspecialchars($result))?>
                        <?php elseif ($image):?>
                        <?php echo HTML::image($result, array('style' => 'max-width: 200px; max-height: 80px;'))?>
                        <?php elseif ($check):?>
                        <div class="s">
                            <label class="cb-enable<?php echo $result?' selected':''?>"><span>Вкл.</span></label>
                            <label class="cb-disable<?php echo $result?'':' selected'?>"><span>Выкл.</span></label>
                            <input data-type="<?php echo htmlspecialchars($type)?>" data-id="<?php echo $item->pk()?>" data-attr="status" type="checkbox" <?php echo $result?'checked ':''?>class="checkbox"/>
                        </div>
                        <?php else:?>
                        <?php echo htmlspecialchars($result)?>
                        <?php endif;?>
                    </td>
                    <?php endforeach;?>
                    <td class="pull-center">
                        <div class="btn-group">
                            <?php echo HTML::anchor('control/'.$type.'/'.$item->pk().'?'.http_build_query(array('filters' => $filters)), '<i class="icon-pencil"></i>', array('class' => 'btn', 'title' => 'Редактировать'))?>
                            <?php echo HTML::anchor('control/'.$type.'/'.$item->pk().'/delete'.'?'.http_build_query(array('filters' => $filters)), '<i class="icon-remove"></i>', array('class' => 'btn', 'title' => 'Удалить'))?>
                            <?php echo HTML::anchor($item->link(), '<i class="icon-search"></i>', array('class' => 'btn', 'title' => 'Глядеть', 'target' => '_blank'))?>
                        </div>
                    </td>
                </tr>
                <?php endforeach;?>
            </table>
            <?php echo View::factory('control/pagination', array('count' => $pages, 'current' => $current_page, 'link' => Request::current()->uri().'?'.http_build_query(array('filters' => $filters))));?>
        </div>
    </div>
</div>