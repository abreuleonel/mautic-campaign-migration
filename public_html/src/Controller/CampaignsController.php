<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class CampaignsController extends AppController
{
	public function index() 
	{
		
		
		$this->set('pagetitle', 'Mautic Campaign Migration');
		
		$campaign1Table = TableRegistry::get('Campaign1');
		$campaigns = $campaign1Table->find('all')->toArray();
		

		$this->set('campaigns', $campaigns);
		$this->set('mautic1', $this->getDBName('mautic1'));
		$this->set('mautic2', $this->getDBName('mautic2'));
		
		if($this->request->is('post')) {
			$campaign_id = $this->request->data['campaign_id'];
			$campaign = $campaign1Table->getFullCampaign($campaign_id);
			
			$campaign1Table->migrateData($campaign);
			echo 'OK';
			exit;
		}
	}
	
	private function getDBName(string $connection) 
	{
		$dbObject = ConnectionManager::get($connection);
		return $prefix = $dbObject->config()['database'];
	}
}