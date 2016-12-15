<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use App\Model\Entity\Campaign;
use App\Model\Entity\CampaignEvents;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class Campaign2Table extends Table
{
	
	public static function defaultConnectionName() {
		return 'mautic2';
	}
	
	public function initialize(array $config)
	{
		$dbObject = ConnectionManager::get('mautic2');
		$prefix = $dbObject->config()['prefix'];
		
		$this->table($prefix . 'campaigns');
		$this->entityClass('App\Model\Entity\Campaign');
	}
}