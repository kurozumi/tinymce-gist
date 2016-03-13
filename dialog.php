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
	</head>
	<body id="gist">
		<div class="container-fluid" style="padding:15px;">
			<?php foreach ($feed as $item): ?>
				<div class="well">
					<h4><a href="<?php echo $item->html_url; ?>" target="_blank"><?php echo $item->description; ?></a></h4>
					<p><?php echo $item->description; ?></p>
					<div class="text-right"><button class="btn btn-primary" onClick="insert('<?php echo $item->html_url; ?>')">挿入</button></div>
				</div>
			<?php endforeach; ?>
		</div>
		<script type="text/javascript">
            function insert(url) {
                top.tinymce.activeEditor.execCommand('mceInsertContent', false, url);
            }
		</script>
	</body>
</html>
