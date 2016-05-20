<?php

/**
 * @version    CVS: 1.1.2
 * @package    Com_Hacha
 * @author     Cristopher Chong <cris_chong2@hotmail.com>
 * @copyright  2016 nOne.ru
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

/**
 * Hacha helper.
 *
 * @since  1.6
 */
class HachaHelpersHacha
{
	/**
	 * Configure the Linkbar.
	 *
	 * @param   string  $vName  string
	 *
	 * @return void
	 */
	public static function addSubmenu($vName = '')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_HACHA_TITLE_CATEGORIES'),
			'index.php?option=com_hacha&view=categories',
			$vName == 'categories'
		);

JHtmlSidebar::addEntry(
			JText::_('COM_HACHA_TITLE_ITEMS'),
			'index.php?option=com_hacha&view=items',
			$vName == 'items'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return    JObject
	 *
	 * @since    1.6
	 */
	public static function getActions()
	{
		$user   = JFactory::getUser();
		$result = new JObject;

		$assetName = 'com_hacha';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action)
		{
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
	public static function getCats(){
		$db = JFactory::getDbo();
		
		$query = $db->getQuery(true);
		
		$query = "SELECT * FROM #__menu_category WHERE state = 1";
		
		$db->setQuery($query);
		$options = array();
		$results = $db->loadObjectList();
		
		foreach($results as $key=>$result){
			$options[] = JHtml::_('select.option', $result->id, $result->title);
		}
		
		return $options;
	}
}


class HachaHelper extends HachaHelpersHacha
{

}
