<?php

//////////////////////////////////////////////////////////////////////////////80
// Filmanager Dialog
//////////////////////////////////////////////////////////////////////////////80
// Copyright (c) Atheos & Liam Siira (Atheos.io), distributed as-is and without
// warranty under the modified License: MIT - Hippocratic 1.2: firstdonoharm.dev
// See [root]/license.md for more. This information must remain intact.
//////////////////////////////////////////////////////////////////////////////80
// Authors: Codiad Team, @Fluidbyte, Atheos Team, @hlsiira
//////////////////////////////////////////////////////////////////////////////80

require_once('../../common.php');

//////////////////////////////////////////////////////////////////////////////80
// Verify Session or Key
//////////////////////////////////////////////////////////////////////////////80
Common::checkSession();

$action = Common::data("action");
$path = Common::data("path");


if (!$action) {
	Common::sendJSON("E401m");
	die;
}
switch ($action) {

	//////////////////////////////////////////////////////////////////////////80
	// Upload
	//////////////////////////////////////////////////////////////////////////80
	case 'upload':
		if (!Common::isAbsPath($path)) {
			$path .= "/";
		}
		?>
		<form enctype="multipart/form-data">
			<h3><i class="fas fa-upload"></i><?php i18n("Upload Files"); ?></h3>
			<pre><?php echo($path); ?></pre>
			<label id="upload_wrapper">
				<?php i18n("Drag Files or Click Here to Upload"); ?>
				<input type="file" name="upload[]" multiple>
			</label>
			<div id="progress_wrapper">
			</div>
		</form>

		<?php
		break;

	//////////////////////////////////////////////////////////////////////////80
	// Default: Invalid Action
	//////////////////////////////////////////////////////////////////////////80
	default:
		Common::sendJSON("E401i");
		break;
}