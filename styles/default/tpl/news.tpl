<h1>News</h1>
    <? foreach($newslist as $news): ?>
        <h2><?=$news['subject'];?></h2>
		<h3>Created by <?=$news['author'];?> on <?=date(DATE_RFC822, $news['date']);?></h3>
        <p><?=$news['text'];?></p>
    <? endforeach; ?>
