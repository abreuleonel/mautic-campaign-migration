<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;

class SMS2Table extends Table
{
	public static function defaultConnectionName() {
		return 'mautic2';
	}
	
	public function initialize(array $config)
	{
		$dbObject = ConnectionManager::get('mautic2');
		$prefix = $dbObject->config()['prefix'];
		
		$this->table($prefix .'sms_messages');
		$this->entityClass('App\Model\Entity\SMS');
	}
}