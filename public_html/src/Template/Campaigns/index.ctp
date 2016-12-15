<section>

	<div class="content">
		<form action="/campaigns/" method="post">
			<select name="campaign_id">
				<?php foreach($campaigns as $k => $v): ?>
					<option value="<?= $v->id; ?>"> <?= $v->name; ?></option>
				<?php endforeach; ?>
			</select>
			
			<button type="submit" class="btn"> Migrar </button>
		</form>
	</div>

</section>