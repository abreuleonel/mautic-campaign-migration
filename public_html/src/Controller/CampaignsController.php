<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class CampaignsController extends AppController
{
	public function index() 
	{
		$campaign1Table = TableRegistry::get('Campaign1');
		$campaigns = $campaign1Table->getFullCampaign(4);
		
		debug($campaigns); exit;
	}
}