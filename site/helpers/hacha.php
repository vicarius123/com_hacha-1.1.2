<?php

/**
 * @version    CVS: 1.1.2
 * @package    Com_Hacha
 * @author     Cristopher Chong <cris_chong2@hotmail.com>
 * @copyright  2016 nOne.ru
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

/**
 * Class HachaFrontendHelper
 *
 * @since  1.6
 */
class HachaHelpersHacha
{
	/**
	 * Get an instance of the named model
	 *
	 * @param   string  $name  Model name
	 *
	 * @return null|object
	 */
	public static function getModel($name)
	{
		$model = null;

		// If the file exists, let's
		if (file_exists(JPATH_SITE . '/components/com_hacha/models/' . strtolower($name) . '.php'))
		{
			require_once JPATH_SITE . '/components/com_hacha/models/' . strtolower($name) . '.php';
			$model = JModelLegacy::getInstance($name, 'HachaModel');
		}

		return $model;
	}
}
