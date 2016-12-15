<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;

class Stages1Table extends Table
{
	public static function defaultConnectionName() {
		return 'mautic1';
	}
	
	public function initialize(array $config)
	{
		$dbObject = ConnectionManager::get('mautic1');
		$prefix = $dbObject->config()['prefix'];
		
		$this->table($prefix .'stages');
		$this->entityClass('App\Model\Entity\Stages');
		
		$this->belongsTo('Categories', [
				'className' => 'Categories1',
				'foreignKey' => 'category_id'
		]);
	}
}