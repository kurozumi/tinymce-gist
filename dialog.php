<?php
require '../../../wp-admin/admin.php';

if (!is_admin())
	die("Error");

$feed_url = "https://api.github.com/users/kurozumi/gists";

$options = array(
	"http" => array(
		"method" => "GET",
		"header" => "User-Agent: wp"
	)
);

$context = stream_context_create($options);

$feed = file_get_contents($feed_url, false, $context);

$feed = json_decode($feed);
?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script type="text/javascript" src="../../../wp-includes/js/tinymce/tiny_mce_popup.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
		<script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery("body#gist button").click(function () {
                    elem = jQuery(this).parents(".well");
                    insert(elem);
                });

                function insert(elem) {
					var url = $('button', elem).data('url');
                    tinyMCEPopup.execCommand('mceInsertContent', false, url);

                    // Refocus in window
                    if (tinyMCEPopup.isWindow)
                        window.focus();

                    tinyMCEPopup.editor.focus();
                    tinyMCEPopup.close();
                }
            });
		</script>
	</head>
	<body id="gist">
		<div class="container-fluid" style="padding:15px;">
			<?php foreach ($feed as $item): ?>
				<div class="well">
					<h4><a href="<?php echo $item->html_url; ?>" target="_blank"><?php echo $item->description; ?></a></h4>
					<p><?php echo $item->description; ?></p>
					<div class="text-right"><button class="btn btn-primary" data-url="<?php echo $item->html_url; ?>">挿入</button></div>
				</div>
			<?php endforeach; ?>
		</div>
	</body>
</html>
