<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CampaignFormXRef1Table extends Table
{
	public static function defaultConnectionName() {
		return 'mautic1';
	}
	
	public function initialize(array $config)
	{
		$this->table('campaign_form_xref');
		$this->entityClass('App\Model\Entity\CampaignFormXRef');
		
		$this->belongsTo('Forms', [
				'className' => 'Forms1',
				'foreignKey' => 'form_id'
		]);
	}
}