<section>

	<div class="content">
		<div class="row">
			<div class="column large-5 platform checks large-centered" >
				<form action="/campaigns/" method="post">
					<select name="campaign_id">
						<?php foreach($campaigns as $k => $v): ?>
							<option value="<?= $v->id; ?>"> <?= $v->name; ?></option>
						<?php endforeach; ?>
					</select>
					
					<button type="submit" class="btn"> Migrate Campaign of <b> <?= $mautic1 ?></b> to <b><?= $mautic2 ?></b></button>
				</form>
			</div>
		</div>
	</div>

</section>