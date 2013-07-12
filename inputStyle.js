$(document).ready(function()
{
	$("input").focus(function() 
	{
		var defaultText=$(this).data("defaultValue")
		if($(this).val()==defaultText)
        $(this).val("");
    });
    $("input").blur(function() 
	{
		var defaultText=$(this).data("defaultValue");
		if($(this).val()=="")
        $(this).val(defaultText);
    });
    $("textarea").focus(function() 
	{
		var defaultText=$(this).data("defaultValue")
		if($(this).val()==defaultText)
        $(this).val("");
    });
    $("textarea").blur(function() 
	{
		var defaultText=$(this).data("defaultValue")
		if($(this).val()=="")
        $(this).val(defaultText);
    });
   
});
