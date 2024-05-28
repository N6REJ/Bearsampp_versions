<?php
/**
 * @package         Regular Labs Extension Manager
 * @version         9.0.0
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            https://regularlabs.com
 * @copyright       Copyright © 2023 Regular Labs All Rights Reserved
 * @license         GNU General Public License version 2 or later
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text as JText;
use Joomla\CMS\Layout\LayoutHelper as JLayoutHelper;

extract($displayData);

/**
 * @var   object $items
 */

if (empty($items))
{
    return;
}
?>
<div class="card mb-4 border-2 border-warning">

    <h2 class="card-header bg-warning text-black rounded-0">
        <span class="icon-warning text-black me-2" aria-hidden="true"></span>
        <?php echo JText::_('RLEM_UPDATES_AVAILABLE'); ?>
    </h2>

    <div class="card-body">
        <?php echo JLayoutHelper::render('button.update_all'); ?>

        <?php echo JLayoutHelper::render('table.updates_available', compact('items')); ?>
    </div>

</div>
