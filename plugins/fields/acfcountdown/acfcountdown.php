<?php

/**
 * @package         Advanced Custom Fields
 * @version         2.8.1-RC2 Pro
 * 
 * @author          Tassos Marinos <info@tassos.gr>
 * @link            http://www.tassos.gr
 * @copyright       Copyright © 2020 Tassos Marinos All Rights Reserved
 * @license         GNU GPLv3 <http://www.gnu.org/licenses/gpl.html> or later
*/

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

JLoader::register('ACF_Field', JPATH_PLUGINS . '/system/acf/helper/plugin.php');

if (!class_exists('ACF_Field'))
{
	Factory::getApplication()->enqueueMessage('Advanced Custom Fields System Plugin is missing', 'error');
	return;
}

class PlgFieldsACFCountdown extends ACF_Field
{
	/**
	 *  Override the field type
	 *
	 *  @var  string
	 */
	protected $overrideType = 'Countdown';

	/**
	 * The form event. Load additional parameters when available into the field form.
	 * Only when the type of the form is of interest.
	 *
	 * @param   Form     $form  The form
	 * @param   stdClass  $data  The data
	 *
	 * @return  void
	 */
	public function onContentPrepareForm(Form $form, $data)
	{
		$data = (object) $data;

		// Make sure we are manipulating the right field.
		if (isset($data->type) && $data->type != $this->_name)
		{
			return;
		}

		/**
		 * Set the configuration for the presets.
		 * 
		 * These are handed over to Javascript and
		 * whenever we click on a preset, these values
		 * are set to each setting on the backend.
		 */
		if (Factory::getApplication()->isClient('administrator'))
		{
			Text::script('ACF_FIELD_PREVIEWER');
			Text::script('ACF_FIELD_PREVIEWER_INFO_ICON_TITLE');
			Text::script('NR_AND_LC');
			Text::script('NR_DAYS');
			Text::script('NR_HOURS');
			Text::script('NR_MINUTES');
			Text::script('NR_SECONDS');
			
			// Include presets
			include 'fields/helper.php';

			$script = 'window.ACFCountdownPresetsData = ' . json_encode($presets) . ';';
			Factory::getDocument()->addScriptDeclaration($script);
			HTMLHelper::script('plg_system_nrframework/tffieldsvaluesapplier.js', ['relative' => true, 'version' => 'auto']);
			HTMLHelper::script('plg_fields_acfcountdown/countdown.js', ['relative' => true, 'version' => 'auto']);
			
			$script = 'window.ACFFieldsPreviewerData = ' . json_encode([
				'fullscreenActions' => true,
				'responsiveControls' => true
			]) . ';';
			Factory::getDocument()->addScriptDeclaration($script);
			HTMLHelper::script('plg_fields_acfcountdown/previewer.js', ['relative' => true, 'version' => 'auto']);
		}
		
		
		return parent::onContentPrepareForm($form, $data);
	}
}