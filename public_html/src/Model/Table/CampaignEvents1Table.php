<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class CampaignEvents1Table extends Table
{
	public static function defaultConnectionName() {
		return 'mautic1';
	}
	
	public function initialize(array $config)
	{
		
		$this->table('campaign_events');
		$this->entityClass('App\Model\Entity\CampaignEvents');
	}
}