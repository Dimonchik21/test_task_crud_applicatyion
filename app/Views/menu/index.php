<p>
    <?=$title?>
</p>
<ul id="menu">
    <?php foreach ($menu as $val): ?>
        <li>
            <div>
                <a href="<?=$val['url']?>"
                   id="<?=$val['id']?>"
                   class="ui-link"
                   data-level="<?=$val['level']?>">
                    <?=$val['name']?>
                </a>
            </div>
            <?php if (!empty($val['child'])) :?>
                <ul>
                <?php foreach ($val['child'] as $item) :?>
                    <li>
                        <div>
                            <a href="<?=$item['url']?>"
                               id="<?=$item['id']?>"
                               class="ui-link"
                               data-level="<?=$item['level']?>">
                                <?=$item['name']?>
                            </a>
                        </div>
                    </li>
                <?php endforeach;?>
                </ul>
            <?php endif;?>
        </li>
    <?php endforeach; ?>
</ul>