<?php
/**
 * @package   akeebabackup
 * @copyright Copyright (c)2006-2024 Nicholas K. Dionysopoulos / Akeeba Ltd
 * @license   GNU General Public License version 3, or later
 */

namespace Akeeba\Alice\Check\Runtimeerrors;

defined('_JEXEC') || die();

use Akeeba\Alice\Check\Base;
use Joomla\CMS\Language\Text as JText;
use Joomla\Database\DatabaseInterface;

/**
 * Checks if error logs are included inside the backup. Since their size grows while we're trying to backup them,
 * this could led to corrupted archives.
 */
class ErrorLogsInArchive extends Base
{
	public function __construct(string $logFile, DatabaseInterface $dbo)
	{
		$this->priority         = 80;
		$this->checkLanguageKey = 'COM_AKEEBABACKUP_ALICE_ANALYZE_RUNTIME_ERRORS_ERRORFILES';

		parent::__construct($logFile, $dbo);
	}

	public function check()
	{
		$error_files = [];

		$this->scanLines(function ($data) use (&$error_files) {
			preg_match_all('#Adding(.*?(/php_error_cpanel\.|php_error_cpanel\.|/error_)log)#', $data, $tmp_matches);

			if (isset($tmp_matches[1]))
			{
				$error_files = array_merge($error_files, $tmp_matches[1]);
			}
		});

		if (empty($error_files))
		{
			return;
		}

		$this->setResult(-1);
		$this->setErrorLanguageKey([
			'COM_AKEEBABACKUP_ALICE_ANALYZE_RUNTIME_ERRORS_ERRORFILES_FOUND', implode("\n", $error_files),
		]);
	}

	public function getSolution()
	{
		return JText::_('COM_AKEEBABACKUP_ALICE_ANALYZE_RUNTIME_ERRORS_ERRORFILES_SOLUTION');
	}
}
