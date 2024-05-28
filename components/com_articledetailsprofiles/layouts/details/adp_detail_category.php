<?php
/**
 * @copyright	Copyright (C) 2011 Simplify Your Web, Inc. All rights reserved.
 * @license		GNU General Public License version 3 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Content\Site\Helper\RouteHelper;

$lang = Factory::getLanguage();
$lang->load('plg_content_articledetails', JPATH_ADMINISTRATOR);

$view = $displayData['view'];

$params = $displayData['params'];

$item = $displayData['item'];
$item_params = $displayData['item_params'];

$label = isset($displayData['label']) ? $displayData['label'] : '';
$label = empty($label) ? Text::_('PLG_CONTENT_ARTICLEDETAILS_PREPEND_CATEGORY') : $label;

$postinfo = isset($displayData['postinfo']) ? $displayData['postinfo'] : '';

$show_icon = $displayData['show_icon'];
$icon = isset($displayData['icon']) ? $displayData['icon'] : '';

if (!$item_params->get('link_category')) {
	$icon_default = 'SYWicon-folder';
} else {
	$icon_default = 'SYWicon-folder-open';
}

$icon = empty($icon) ? $icon_default : $icon;
$extraclasses = isset($displayData['extraclasses']) ? ' ' . trim($displayData['extraclasses']) : '';

// using 'echo' to prevent spaces if using direct html tags

echo '<span class="detail detail_category' . $extraclasses . '">';

if ($show_icon && Factory::getDocument()->getDirection() != 'rtl') {
	echo '<i class="' . $icon . '"></i>';
}

if ($label && Factory::getDocument()->getDirection() != 'rtl') {
	echo '<span class="detail_label">' . $label . '</span>';
}

if ($postinfo && Factory::getDocument()->getDirection() == 'rtl') {
	echo '<span class="detail_post">' . $postinfo . '</span>';
}

if ($item_params->get('link_category') && !Factory::getApplication()->input->getBool('print')) {
    if ($view == 'article') {
        if (!empty($item->catslug)) {
            echo '<a class="detail_data" href="' . Route::_(RouteHelper::getCategoryRoute($item->catslug)) . '">' . $item->category_title . '</a>';
        } else {
            echo '<span class="detail_data">' . $item->category_title . '</span>';
        }
    } else {
        // No linking if the category is the one the view is in

        $cat_link = Route::_(RouteHelper::getCategoryRoute($item->catid));
        $current_link = Uri::current();

        if (substr( $current_link, strlen( $current_link ) - strlen( $cat_link ) ) != $cat_link) { 
            // the current links does not end with the category link
            echo '<a class="detail_data" href="' . Route::_(RouteHelper::getCategoryRoute($item->catid)) . '">' . $item->category_title . '</a>'; // keep linking in category view because of sub-categories
        } else {
            echo '<span class="detail_data">' . $item->category_title . '</span>';
        }
    }
} else {
    echo '<span class="detail_data">' . $item->category_title . '</span>';
}

if ($postinfo && Factory::getDocument()->getDirection() != 'rtl') {
	echo '<span class="detail_post">' . $postinfo . '</span>';
}

if ($label && Factory::getDocument()->getDirection() == 'rtl') {
	echo '<span class="detail_label">' . $label . '</span>';
}

if ($show_icon && Factory::getDocument()->getDirection() == 'rtl') {
	echo '<i class="' . $icon . '"></i>';
}

echo '</span>';
