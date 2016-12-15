<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use App\Model\Entity\Campaign;
use App\Model\Entity\CampaignEvents;
use Cake\ORM\TableRegistry;

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
		
		$this->hasMany('CampaignLeadListXRef', [
				'className' => 'CampaignLeadListXRef1',
				'foreignKey' => 'campaign_id'
		]);
		
		$this->hasMany('CampaignFormXRef', [
				'className' => 'CampaignFormXRef1',
				'foreignKey' => 'campaign_id'
		]);
	}
	
	public function getFullCampaign(int $id) 
	{
		$result = [];
		$campaign = $this
					->findById($id)
					->contain([
							'CampaignEvents', 
							'CampaignLeadListXRef', 
							'CampaignFormXRef' => function($cf) {
								return $cf->contain('Forms');
							}])
					->first();
		$result = $campaign;
		
		
		$result['_canvas_settings'] = unserialize($result->canvas_settings);
		$result->campaign_events = $this->getCampaignEventsProperties($result->campaign_events);
		return $result;
	}
	
	private function getCampaignEventsProperties(array $campaign_events)  
	{
		foreach($campaign_events as $k => $v) {
			$campaign_events[$k]['_properties'] = unserialize($v->properties);
		}
		
		$campaign_events = $this->getObjectsOfCampaignEvent($campaign_events);
		
		return $campaign_events;		
	}
	
	private function getObjectsOfCampaignEvent(array $campaignEvents) 
	{
		foreach($campaignEvents as $k=>$v) {
			$campaignEvents[$k] = $this->getObjectOfCampaignEvent($v);
		}
		
		return $campaignEvents;
	}
	
	private function getObjectOfCampaignEvent(CampaignEvents $campaignEvent) 
	{
		$table = null;
		if($campaignEvent->type == 'email.send') {
			$email_id = $campaignEvent->_properties['email'];
			$table = TableRegistry::get('Emails1');
			$campaignEvent->_email = $table->findById($email_id)->first();
		} elseif($campaignEvent->type == 'sms.send_text_sms') {
			$sms_id = $campaignEvent->_properties['sms'];
			$table = TableRegistry::get('SMS1');
			$campaignEvent->_sms = $table->findById($sms_id)->first();
		}
		
		return $campaignEvent;
	}
	
	private function getCanvasConnection(array $canvas_settings) 
	{
		foreach($canvas_settings['connections'] as $k => $v) {
			if($v['sourceId'] == 'lists') {
				$table = TableRegistry::get('Lists1');
 				$canvas_settings['connections'][$k]['lists'] = $table->findById($v['targetId'])->first();  
			} elseif($v['sourceId'] == 'forms') {
				$table = TableRegistry::get('Forms1');
				$canvas_settings['connections'][$k]['forms'] = $table->findById($v['targetId'])->first();
			}
		}
		
		return  $canvas_settings;
	}
}