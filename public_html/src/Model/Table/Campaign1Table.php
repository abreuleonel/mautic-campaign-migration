<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use App\Model\Entity\Campaign;

class Campaign1Table extends Table
{
	public static function defaultConnectionName() {
		return 'mautic1';
	}
	
	public function initialize(array $config)
	{
		$this->table('campaigns');
		$this->entityClass('App\Model\Entity\Campaign');
		
		$this->hasMany('CampaignEvents', [
				'className' => 'CampaignEvents1',
				'foreignKey' => 'campaign_id',
		]);
	}
	
	public function getFullCampaign(int $id) 
	{
		$result = [];
		$campaign = $this
					->findById($id)
					->contain('CampaignEvents')
					->first();
		$result = $campaign;
		$result['canvas_settings'] = (object)unserialize($result->canvas_settings);
		$result->campaign_events = $this->getCampaignEventsProperties($result->campaign_events);
		return $result;
	}
	
	private function getCampaignEventsProperties(array $campaign_events)  
	{
		foreach($campaign_events as $k => $v) {
			$campaign_events[$k]->properties = (object)unserialize($v->properties);
		}
		return $campaign_events;		
	}
}