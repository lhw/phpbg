<h3>Ressources</h3>
    <table>
        <? foreach($ressource as $res): ?>
            <tr>
                <td><?=$res['name'];?></td>
                <td><?=$res['count'];?></td>
            </tr>
        <? endforeach; ?>
    </table>
