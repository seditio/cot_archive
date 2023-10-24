<!-- BEGIN: MAIN -->
<main id="recent">
	<div class="container">

		<div class="row my-5">
			<div class="col">
				<div class="title px-2 px-sm-0">
					<h1 class="lh-1 mb-1">{ARCHIVE_TITLE}</h1>
					<p class="lh-sm text-secondary">
						{ARCHIVE_DESC} ({ARCHIVE_TOTALPOSTS|cot_declension($this, 'Pages')} {PHP.L.archive_since} {ARCHIVE_START} {PHP.L.archive_year})
					</p>
					<p class="mb-0">
						{ARCHIVE_BREADCRUMBS}
					</p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-9">
				{FILE "{PHP.cfg.themes_dir}/{PHP.theme}/warnings.tpl"}
				<ul class="list-unstyled">
					<!-- BEGIN: MONTH_ROW -->
					<li class="py-3 px-4 {MONTH_ROW_ODDEVEN}">
						<h2 class="fs-3">
							<span class="text-capitalize">{MONTH_ROW_MONTH} {MONTH_ROW_YEAR}</span>
							{PHP.L.archive_year}
							<sup class="fw-normal">({MONTH_ROW_COUNT_PAGES})</sup>
						</h2>
						<ul class="list-unstyled">
							<!-- BEGIN: POST_ROW -->
							<li>
								{POST_ROW_NUM}. <a href="{POST_ROW_URL}">{POST_ROW_SHORTTITLE}</a> ({POST_ROW_DATE_STAMP|cot_date('j F', $this)} / {POST_ROW_COUNT|cot_declension($this, 'archive_hits')})
							</li>
							<!-- END: POST_ROW -->
						</ul>
					</li>
					<!-- END: MONTH_ROW -->
				</ul>
			</div>
			<div class="col-lg-3">
				<ul class="nav nav-pills flex-column mb-3">
					<!-- IF {PHP.cfg.plugin.archive.home_style} == 0 -->
					<li class="nav-item">
						<a class="nav-link text-center<!-- IF !{PHP.year} --> active<!-- ENDIF -->" aria-current="page" href="{PHP|cot_url('archive')}">{PHP.L.archive_all}</a>
					</li>
					<!-- ENDIF -->
					<!-- BEGIN: YEAR_ROW -->
					<li class="nav-item">
						<a class="nav-link text-center<!-- IF {PHP.year} == {YEAR_ROW_YEAR} --> active<!-- ENDIF -->" aria-current="page" href="{YEAR_ROW_YEAR_URL}">{YEAR_ROW_YEAR}</a>
					</li>
					<!-- END: YEAR_ROW -->
				</ul>
			</div>
		</div>

	</div>
</main>
<!-- END: MAIN -->
