<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2024 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Component\AkeebaBackup\Administrator\Controller;

defined('_JEXEC') || die;

use Akeeba\Component\AkeebaBackup\Administrator\Mixin\ControllerAjaxTrait;
use Akeeba\Component\AkeebaBackup\Administrator\Mixin\ControllerCustomACLTrait;
use Akeeba\Component\AkeebaBackup\Administrator\Mixin\ControllerEventsTrait;
use Akeeba\Component\AkeebaBackup\Administrator\Mixin\ControllerProfileAccessTrait;
use Akeeba\Component\AkeebaBackup\Administrator\Mixin\ControllerProfileRestrictionTrait;
use Akeeba\Component\AkeebaBackup\Administrator\Mixin\ControllerReusableModelsTrait;
use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Input\Input;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class IncludefoldersController extends BaseController
{
	use ControllerEventsTrait;
	use ControllerCustomACLTrait
	{
		ControllerCustomACLTrait::onBeforeExecute as onBeforeExecuteACL;
	}
	use ControllerProfileRestrictionTrait
	{
		ControllerProfileRestrictionTrait::onBeforeExecute as onBeforeExecuteRestrictedProfile;
	}
	use ControllerReusableModelsTrait;
	use ControllerAjaxTrait;
	use ControllerProfileAccessTrait;

	public function __construct($config = [], MVCFactoryInterface $factory = null, ?CMSApplication $app = null, ?Input $input = null)
	{
		parent::__construct($config, $factory, $app, $input);

		$this->decodeJsonAsArray = true;
	}

	protected function onBeforeExecute(&$task)
	{
		$this->onBeforeExecuteACL($task);
		$this->onBeforeExecuteRestrictedProfile($task);
	}
}