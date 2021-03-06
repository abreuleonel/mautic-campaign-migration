<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use App\Model\Entity\Campaign;
use App\Model\Entity\CampaignEvents;
use Cake\Datasource\ConnectionManager;

class CampaignLeadListXRef1Table extends Table
{
	public static function defaultConnectionName() {
		return 'mautic1';
	}
	
	public function initialize(array $config)
	{
		$dbObject = ConnectionManager::get('mautic1');
		$prefix = $dbObject->config()['prefix'];
		
		$this->table($prefix .'campaign_leadlist_xref');
		$this->entityClass('App\Model\Entity\CampaignLeadListXRef');
		
		$this->belongsTo('Lists', [
				'className' => 'Lists1',
				'foreignKey' => 'leadlist_id'
		]);
	}
}