<h3>Ressources</h3>
    <table>
<?
	$xml = new XMLReader();
	$xml->open("data/xml/ressources.xml");
	while($xml->read()) {
		if($xml->name == "ressource" && $xml->nodeType == 1) {
			$name = $xml->getAttribute("name");
			$value = $res[$name];
			print "        <tr>\n";
			print "            <td>$name</td>\n";
			print "            <td>".$res[$name]."</td>\n";
			print "        </tr>\n";
		}
	}
	$xml->close();
?>
    </table>
