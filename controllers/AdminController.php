<?php

/**
 * Controller AdminController
 * Main page in admin panel
 */
class AdminController extends AdminBase
{
	
	public function actionIndex()
	{
		// Check access
		self::checkAdmin();
		
		$metaTitle = 'Admin Panel';
		
		require_once(ROOT . '/views/admin/index.php');
		return true;
	}
}