<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class Forms1Table extends Table
{
	public static function defaultConnectionName() {
		return 'mautic1';
	}
	
	public function initialize(array $config)
	{
		$this->table('forms');
		$this->entityClass('App\Model\Entity\Forms');
	}
}