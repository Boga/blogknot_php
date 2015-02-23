<?
    /** @var $content string  */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
<body>
    <?php echo $content ?>

<!-- TODO: replace with JS -->
    <script type="text/jsx" src="js/src/tags.jsx"></script>
    <script type="text/jsx" src="js/src/notes.jsx"></script>
    <script type="text/jsx" src="js/src/app.jsx"></script>

</body>
</html>