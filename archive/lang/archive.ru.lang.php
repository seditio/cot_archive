<?php
/**
* [SEDBY] Archive Plugin / RU Locale
*
* @package archive
* @author Dmitri Beliavski
* @copyright (c) 2023 seditio.by
*/

defined('COT_CODE') or die('Wrong URL');

/**
 * Plugin Info
 */

$L['info_name'] = '[SEDBY] Archive';
$L['info_desc'] = 'Публикации, сгруппированные по месяцам и годам';
$L['info_notes'] = 'Плагин формирует страницу с архивом публикаций и автоматической группировкой по годам и месяцам';

/**
 * Plugin Config
 */

$L['cfg_count_system'] = 'Учитывать статичные страницы из раздела "system"';
$L['cfg_home_style'] = 'По умолчанию показывать только публикации текущего года';
$L['cfg_home_style_hint'] = 'Иначе выводить в начальной локации весь архив';

/**
 * Plugin Admin
 */



/**
 * Plugin Globals
 */

$L['archive_metaTitle'] = 'Архив сайта';
$L['archive_metaDesc'] = 'Архив сайта, упорядоченный по годам и месяцам публикаций';

$L['archive_title'] = 'Архив';
$L['archive_desc'] = 'Публикации нашего сайта с группировкой по годам и месяцам';
$L['archive_all'] = 'Весь архив';

$L['archive_for'] = 'за';
$L['archive_year'] = 'г.';
$L['archive_year_full'] = 'год';

$L['archive_month01'] = 'январь';
$L['archive_month02'] = 'февраль';
$L['archive_month03'] = 'март';
$L['archive_month04'] = 'апрель';
$L['archive_month05'] = 'май';
$L['archive_month06'] = 'июнь';
$L['archive_month07'] = 'июль';
$L['archive_month08'] = 'август';
$L['archive_month09'] = 'сентябрь';
$L['archive_month10'] = 'октябрь';
$L['archive_month11'] = 'ноябрь';
$L['archive_month12'] = 'декабрь';

$Ls['archive_hits'] = 'просмотр,просмотра,просмотров';
$Ls['archive_pages'] = 'страница,страницы,страниц';

$L['archive_since'] = 'с';

$L['archive_wrongYear'] = 'Неправильно указан год!';
