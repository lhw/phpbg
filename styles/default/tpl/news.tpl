<h1>News</h1>
    <? foreach($newslist as $news): ?>
        <h2><?=$news['title'];?></h2>
        <p><?=$news['text'];?></p>
    <? endforeach; ?>