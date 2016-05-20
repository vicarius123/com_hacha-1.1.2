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


?>
<?php if ($this->item) : ?>

	<div class="item_fields">
		<table class="table">
			<tr>
			<th><?php echo JText::_('COM_HACHA_FORM_LBL_CATEGORY_TITLE'); ?></th>
			<td><?php echo $this->item->title; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_HACHA_FORM_LBL_CATEGORY_ALIAS'); ?></th>
			<td><?php echo $this->item->alias; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_HACHA_FORM_LBL_CATEGORY_IMAGE'); ?></th>
			<td>
			<?php
			foreach ((array) $this->item->image as $singleFile) : 
				if (!is_array($singleFile)) : 
					$uploadPath = '/media/menu/' . DIRECTORY_SEPARATOR . $singleFile;
					 echo '<a href="' . JRoute::_(JUri::root() . $uploadPath, false) . '" target="_blank">' . $singleFile . '</a> ';
				endif;
			endforeach;
		?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_HACHA_FORM_LBL_CATEGORY_TITLE_EN'); ?></th>
			<td><?php echo $this->item->title_en; ?></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_HACHA_FORM_LBL_CATEGORY_STATE'); ?></th>
			<td>
			<i class="icon-<?php echo ($this->item->state == 1) ? 'publish' : 'unpublish'; ?>"></i></td>
</tr>
<tr>
			<th><?php echo JText::_('COM_HACHA_FORM_LBL_CATEGORY_CREATED_BY'); ?></th>
			<td><?php echo $this->item->created_by_name; ?></td>
</tr>

		</table>
	</div>
	
	<?php
else:
	echo JText::_('COM_HACHA_ITEM_NOT_LOADED');
endif;