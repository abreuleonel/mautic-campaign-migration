<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;

class CampaignEvents1Table extends Table
{
	public static function defaultConnectionName() {
		return 'mautic1';
	}
	
	public function initialize(array $config)
	{
		
		$dbObject = ConnectionManager::get('mautic1');
		$prefix = $dbObject->config()['prefix'];
		
		$this->table($prefix . 'campaign_events');
		$this->entityClass('App\Model\Entity\CampaignEvents');
	}
}