<link rel=StyleSheet href="style/css.css" type="text/css" media=screen>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.js"></script>
<script src="js/validate.js"></script>


<script>
$(function() {
$( "#datepicker" ).datepicker();
});

$(document).ready(function(){
    $("#datepicker").datepicker('option', { dateFormat: 'dd/mm/yy' });
});
</script>