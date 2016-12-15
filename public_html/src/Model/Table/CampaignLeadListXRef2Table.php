<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use App\Model\Entity\Campaign;
use App\Model\Entity\CampaignEvents;
use Cake\Datasource\ConnectionManager;

class CampaignLeadListXRef2Table extends Table
{
	public static function defaultConnectionName() {
		return 'mautic2';
	}
	
	public function initialize(array $config)
	{
		$dbObject = ConnectionManager::get('mautic2');
		$prefix = $dbObject->config()['prefix'];
		
		$this->table($prefix .'campaign_leadlist_xref');
		$this->entityClass('App\Model\Entity\CampaignLeadListXRef');
	}
}