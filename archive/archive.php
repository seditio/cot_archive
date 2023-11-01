<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=standalone
[END_COT_EXT]
==================== */

/**
* Archive Plugin / Setup
*
* @package archive
* @author Dmitri Beliavski
* @copyright (c) 2023 sed.by
*/

defined('COT_CODE') or die('Wrong URL');

include_once cot_incfile('archive', 'plug', 'resources');
include_once cot_incfile('page', 'module');
include_once cot_incfile('cotlib', 'plug');
include_once cot_incfile('hits', 'plug');

$out['subtitle'] = $L['archive_metaTitle'];
$out['desc'] = $L['archive_metaDesc'];

$db_pages = Cot::$db->pages;

$year = cot_import('year', 'G', 'INT');
((empty($year) && Cot::$cfg['plugin']['archive']['home_style'])) && cot_redirect(cot_url('archive', 'year=' . (int)date('Y')));

cot_stat_inc('totalarchive', 1, true);

$catmode = '';
Cot::$cfg['plugin']['archive']['catmode'] && $catmode = 'NOT';
$filterlist = 'AND page_cat ' . $catmode . ' IN ("' . implode('","', explode(',', str_replace(' ', '', Cot::$cfg['plugin']['archive']['catlist']))) . '")';

$filter_year = '';
!empty($year) && $filter_year = "AND FROM_UNIXTIME(page_date, '%Y') = $year";

$no_access = sedby_black_cats();
!empty($no_access) && $no_access = "AND page_cat NOT IN (" . sedby_black_cats() . ")";

if (empty($year)) {
  $title = $L['archive_title'];
  $crumbs[] = [cot_url('archive'), $L['archive_title']];
} else {
  $title = $L['archive_title'] . " " . $L['archive_for'] . " " . $year . " " . $L['archive_year_full'];
  $crumbs[] = [cot_url('archive'), $L['archive_title']];
  $crumbs[] = $year . " " . $L['archive_year'];
  $out['subtitle'] .= " " . $L['archive_for'] . " " . $year . " " . $L['archive_year_full'];
  $out['desc'] .= " " . $L['archive_for'] . " " . $year . " " . $L['archive_year_full'];
}

$total_posts = Cot::$db->query("SELECT COUNT(*) FROM $db_pages WHERE page_state = 0 $filterlist $no_access")->fetchColumn();
$starting = Cot::$db->query("SELECT page_date FROM $db_pages WHERE page_state = 0 $filterlist $no_access ORDER BY page_date ASC LIMIT 1")->fetchColumn();

$t = new XTemplate(cot_tplfile('archive', 'plug'));
$t->assign([
  'ARCHIVE_TITLE'       => $title,
  'ARCHIVE_DESC'        => $L['archive_desc'],
  'ARCHIVE_BREADCRUMBS' => cot_breadcrumbs($crumbs, Cot::$cfg['homebreadcrumb']),
  'ARCHIVE_TOTALPOSTS'  => $total_posts,
  'ARCHIVE_START'       => cot_date('j F Y', $starting),
  'ARCHIVE_COUNT'       => cot_stat_get('totalarchive'),
]);

// Compile Years Block
$query = "SELECT DISTINCT(FROM_UNIXTIME(page_date, '%Y')) AS year FROM $db_pages WHERE page_state = 0 $filterlist $no_access ORDER BY page_date DESC";

$years_array = $db->query($query)->fetchAll(PDO::FETCH_COLUMN);
if (!empty($year) && !in_array($year, $years_array)) {
  cot_message('archive_wrongYear', 'error');
  cot_redirect(cot_url('archive'));
}

$res = $db->query($query);
$jj = 0;

while ($row = $res->fetch()) {
  $jj++;
  $t->assign([
    'YEAR_ROW_NUM'      => $jj,
    'YEAR_ROW_ODDEVEN'  => cot_build_oddeven($jj),
    'YEAR_ROW_YEAR'     => $row['year'] . " " . $L['archive_year_full'],
    'YEAR_ROW_YEAR_URL' => cot_url('archive', 'year=' . $row['year']),
  ]);
  $t->parse("MAIN.YEAR_ROW");
}

$t->assign('ARCHIVE_YEAR', $year);

// Compile Months Block
$res = "SELECT DISTINCT(FROM_UNIXTIME(page_date, '%Y-%m')) AS monthYear FROM $db_pages WHERE page_state = 0 $filter_year $filterlist $no_access ORDER BY page_date DESC";
$res = $db->query($res);
$jj = 0;

while ($row = $res->fetch()) {
  $jj++;
  $monthYear = explode("-", $row['monthYear']);
  // $beg = strtotime(date('Y-m-01 00:00', strtotime($row['monthYear'])));
  // $end = strtotime(date('Y-m-t 23:59', strtotime($row['monthYear'])));
  $t->assign([
    'MONTH_ROW_NUM'     => $jj,
    'MONTH_ROW_ODDEVEN' => cot_build_oddeven($jj),
    'MONTH_ROW_MONTH'   => $L['archive_month' . $monthYear['1']],
    'MONTH_ROW_YEAR'    => $monthYear['0'],
    // 'MONTH_ROW_THISMONTH1' => $beg,
    // 'MONTH_ROW_THISMONTH2' => $end,
  ]);

  $res2 = "SELECT * FROM $db_pages WHERE FROM_UNIXTIME(page_date, '%Y-%m') = ? AND page_state = 0 $filterlist $no_access ORDER BY page_date DESC";
  $res2 = $db->query($res2, $monthYear['0'] . "-" . $monthYear['1']);
  $total2 = $res2->rowCount();

  $t->assign([
    'MONTH_ROW_COUNT'       => $total2,
    'MONTH_ROW_COUNT_PAGES' => cot_declension($total2, 'archive_pages'),
  ]);

  $kk = 0;
  while ($row2 = $res2->fetch()) {
    $kk++;
    $t->assign(cot_generate_pagetags($row2, 'POST_ROW_'));
    $t->assign([
      'POST_ROW_NUM'     => $total2,
      'POST_ROW_ODDEVEN' => cot_build_oddeven($kk),
    ]);
    $total2--;
    $t->parse("MAIN.MONTH_ROW.POST_ROW");
  }
  $t->parse("MAIN.MONTH_ROW");
}

cot_display_messages($t);
