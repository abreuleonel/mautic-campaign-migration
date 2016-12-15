<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class CampaignsController extends AppController
{
	public function index() 
	{
		$campaign1Table = TableRegistry::get('Campaign1');
		$campaign = $campaign1Table->getFullCampaign(4);
		
		$campaign1Table->migrateData($campaign);
		exit('OK');
	}
}