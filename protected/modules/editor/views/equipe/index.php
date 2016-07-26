<table class="uk-table">
	<?php foreach($equipes as $e): ?>
		<tr>
			<td><?=$e->id?></td>
			<td><?=$e->nome?></td>
			<td><?=$e->abreviacao?></td>
			<td><?=$e->imagemBrasao('P');?></td>
			<td><?=$e->tipo?></td>
		</tr>
	<?php endforeach; ?>
</table>