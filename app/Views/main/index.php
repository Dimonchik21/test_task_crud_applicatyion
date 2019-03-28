<p>Главная страница</p>

<ul id="navbar">
    <?php foreach ($menu as $val): ?>
        <li>
            <a href="<?=$val['url']?>"
               id="<?=$val['id']?>"
               data-level="<?=$val['level']?>">
                <?=$val['name']?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>