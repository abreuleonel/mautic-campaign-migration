<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class CampaignsController extends AppController
{
	public function index() 
	{
		$campaign1Table = TableRegistry::get('Campaign1');
		$campaigns = $campaign1Table->find('all')->toArray();
		

		$this->set('campaigns', $campaigns);
		
		if($this->request->is('post')) {
			$campaign_id = $this->request->data['campaign_id'];
			$campaign = $campaign1Table->getFullCampaign($campaign_id);
			
			$campaign1Table->migrateData($campaign);
			echo 'OK';
			exit;
		}
	}
}