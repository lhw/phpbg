<h3>Ressources</h3>
    <table>
        <? if(count($ressource) > 0): ?>
        <? foreach($ressource as $res): ?>
            <tr>
                <td><?=$res['name'];?></td>
                <td><?=$res['count'];?></td>
            </tr>
        <? endforeach; ?>
        <? endif; ?>
    </table>
