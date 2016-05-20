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
	
	JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
	JHtml::_('behavior.tooltip');
	JHtml::_('behavior.formvalidation');
	JHtml::_('formbehavior.chosen', 'select');
	JHtml::_('behavior.keepalive');
	
	// Import CSS
	$document = JFactory::getDocument();
	$document->addStyleSheet(JUri::root() . 'media/com_hacha/css/form.css');
?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {
		
		js('input:hidden.category_id').each(function(){
			var name = js(this).attr('name');
			if(name.indexOf('category_idhidden')){
				js('#jform_category_id option[value="'+js(this).val()+'"]').attr('selected',true);
			}
		});
		js("#jform_category_id").trigger("liszt:updated");
	});
	
	Joomla.submitbutton = function (task) {
		if (task == 'item.cancel') {
			Joomla.submitform(task, document.getElementById('item-form'));
		}
		else {
			
			js = jQuery.noConflict();
			if(js('#jform_image').val() != ''){
				js('#jform_image_hidden').val(js('#jform_image').val());
			}
			if (js('#jform_image').val() == '' && js('#jform_image_hidden').val() == '') {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
				return;
			}
			if (task != 'item.cancel' && document.formvalidator.isValid(document.id('item-form'))) {
				
				Joomla.submitform(task, document.getElementById('item-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form
action="<?php echo JRoute::_('index.php?option=com_hacha&layout=edit&id=' . (int) $this->item->id); ?>"
method="post" enctype="multipart/form-data" name="adminForm" id="item-form" class="form-validate">
	
	<div class="form-horizontal">
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">
					<?php echo JHtml::_('bootstrap.startTabSet', 'myTab_1', array('active' => 'general_ru')); ?>
					<?php echo JHtml::_('bootstrap.addTab', 'myTab_1', 'general_ru', JText::_('RU', true)); ?>
					<?php echo $this->form->renderField('title'); ?>
					<?php echo $this->form->renderField('text'); ?>
					<?php echo JHtml::_('bootstrap.endTab'); ?>		
					<?php echo JHtml::_('bootstrap.addTab', 'myTab_1', 'general_en', JText::_('EN', true)); ?>
					<?php echo $this->form->renderField('title_en'); ?>
					<?php echo $this->form->renderField('text_en'); ?>
					<?php echo JHtml::_('bootstrap.endTab'); ?>
					<?php echo $this->form->renderField('category_id'); ?>
					<?php
						foreach((array)$this->item->category_id as $value): 
						if(!is_array($value)):
						echo '<input type="hidden" class="category_id" name="jform[category_idhidden]['.$value.']" value="'.$value.'" />';
						endif;
						endforeach;
					?>				
					<?php echo $this->form->renderField('image'); ?>
					<?php if (!empty($this->item->image)) : ?>
					<?php foreach ((array)$this->item->image as $fileSingle) : ?>
					<?php if (!is_array($fileSingle)) : ?>
					<a href="<?php echo JRoute::_(JUri::root() . '/media/menu/' . DIRECTORY_SEPARATOR . $fileSingle, false);?>"><?php echo $fileSingle; ?></a> | 
					<?php endif; ?>
					<?php endforeach; ?>
					<?php endif; ?>
					<input type="hidden" name="jform[image][]" id="jform_image_hidden" value="<?php echo implode(',', (array)$this->item->image); ?>" />				
					<?php echo $this->form->renderField('price'); ?>
					<?php echo $this->form->renderField('weight'); ?>
					<?php echo JHtml::_('bootstrap.endTab'); ?>
				</fieldset>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
		
		<?php if(empty($this->item->created_by)){ ?>
			<input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>" />
			
			<?php } 
			else{ ?>
			<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
			
		<?php } ?>
		<?php if ($this->state->params->get('save_history', 1)) : ?>
		<div class="control-group">
			<div class="control-label"><?php echo $this->form->getLabel('version_note'); ?></div>
			<div class="controls"><?php echo $this->form->getInput('version_note'); ?></div>
		</div>
		<?php endif; ?>
		<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
		<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
		<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
		<input type="hidden" name="task" value=""/>
		<?php echo JHtml::_('form.token'); ?>		
	</div>
</form>
