<!DOCTYPE html>  
<html>  
<head>  
<meta charset="utf-8" />  
<title>Bootstrap typeahead with options example by w3resource</title>  
<link href="/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/css/bootstrap.css" rel="stylesheet" type="text/css" />  
</head>  
<body>  
<div class="well">  
<input type="text" class="span3" id="search" data-provide="typeahead" data-items="4" />  
</div>  
<script src="/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/jquery.js"></script>  
<script src="/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/js/bootstrap-typeahead.js"></script>  
<script>  
 var subjects = ['PHP', 'MySQL', 'SQL', 'PostgreSQL', 'HTML', 'CSS', 'HTML5', 'CSS3', 'JSON'];   
$('#search').typeahead({source: subjects})  
</script>  
</body>  
</html> 