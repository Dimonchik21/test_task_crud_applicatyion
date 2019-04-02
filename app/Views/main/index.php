<p>Главная страница</p>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        $( "#menu" ).menu();
    } );
</script>
<style>
    .ui-menu { width: 150px; }
    .ui-link { text-decoration: none; }
</style>

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
            <?php if ($val['level'] != 1) :?>
                <ul>
                    <li></li>
                </ul>
            <?php endif;?>
        </li>
    <?php endforeach; ?>
</ul>