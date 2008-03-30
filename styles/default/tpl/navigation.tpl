<h3><?=$menu;?></h3>
        <ul>
        <? foreach($items as $item): ?>
            <li><a href="<?=$item['link'];?>"><?=$item['name'];?></a></li>
        <? endforeach; ?>
        </ul>