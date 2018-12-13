<div class="list-members col-md-12 col-lg-12 col-xl-12">
<table>
	<tr>
		<th class="pseudo">Pseudo</th>
		<th class="email">Email</th>
		<th class="date">Date</th>
		<th class="administrator">Statut</th>
		<th class="action">Action</th>
	</tr>

	

	<?php
		foreach ($members as $member){
	?>
	<tr>
		<td class="all-members-pseudo"><?= $member['pseudo'] ?></td>
		<td class="all-members-email"><?= $member['email'] ?></td>
		<td class="all-members-date"><?= $member['date'] ?></td>
		<td class="all-members-administrator">
			<?php
				if($member['administrator'] == 1){
			?>
					
					<p>Administrateur</p>
			<?php
			}else{
			?>
			
			<p>Membre</p>

			<?php
			}
			?>
			<td class="action"><a href="<?= $GLOBALS['ROOT_URL_BACK'] ?>member-delete-<?=$member['id'] ?>.html"><i class="fas fa-trash-alt"></i></a></td>
		</td>

	</tr>
		
	<?php
		}
	?>
</table>
</div>

<p><a class="link" href="<?= $GLOBALS['ROOT_URL_BACK'] ?>">Retour</a></p>