<?php

/**
 * @author          Tassos Marinos <info@tassos.gr>
 * @link            https://www.tassos.gr
 * @copyright       Copyright © 2024 Tassos All Rights Reserved
 * @license         GNU GPLv3 <http://www.gnu.org/licenses/gpl.html> or later
 */

namespace NRFramework\Widgets;

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;

class BingMap extends Map
{
	/**
	 * Loads media files
	 * 
	 * @return  void
	 */
	public function loadMedia()
	{
		parent::loadMedia();
		
		HTMLHelper::script('plg_system_nrframework/widgets/bingmap.js', ['relative' => true, 'version' => 'auto']);
		HTMLHelper::script('https://www.bing.com/api/maps/mapcontrol?callback=TFBingMapsCallback&key=' . $this->options['provider_key']);
	}
}