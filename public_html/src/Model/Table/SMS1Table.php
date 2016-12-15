<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use App\Model\Entity\Campaign;
use App\Model\Entity\CampaignEvents;

class SMS1Table extends Table
{
	public static function defaultConnectionName() {
		return 'mautic1';
	}
	
	public function initialize(array $config)
	{
		$this->table('sms_messages');
		$this->entityClass('App\Model\Entity\SMS');
	}
}