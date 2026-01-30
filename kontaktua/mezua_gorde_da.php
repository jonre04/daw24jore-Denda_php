<p>Komentarioa gorde da.</p>
<table cellspacing="5" cellpadding="5" border="1">        
<tr>
<td align="right">Izena</td>
<td><?php echo $izena ?></td>
</tr>
<td align="right">Email</td>
<td><?php echo $email ?></td>
</tr>
<tr>
<td align="right">Mezua</td>
<td><?php echo $mezuaTestua ?></td>
</tr>
</table>
<form action=".." method="GET">
<p>
<input type="submit" value="Itzuli">
<input type="text" name="id" value="<?php echo $id ?>" readonly>
</p>
</form>
