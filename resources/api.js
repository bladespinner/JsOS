var baseAPIUrl = "http://localhost:8088/JsOS/restAPI/"

function getRoot()
{
	return "Disk\\";
}

function getDirectories(directory,result)
{
	if(directory == "")return getRoot();
	var datum = {json: {dir:directory}};
	$.ajax({
	  url: baseAPIUrl+"/directory.php",
	  type: "GET",
	  data : datum,
	  success : function(data)
	  {
	  	result(data);
	  },
	});
}
function createDirectory(directory,result)
{
	var datum = {json: {dir:directory}};
	$.ajax({
	  url: baseAPIUrl+"/directory.php",
	  type: "POST",
	  data : datum,
	  success : function(data)
	  {
	  	result(data);
	  },
	});
}
function copyDirectory(directory,copyDirectory,result)
{
	var datum = {json: {dir:directory,copyDir:copyDirectory}};
	$.ajax({
	  url: baseAPIUrl+"/directory.php",
	  type: "POST",
	  data : datum,
	  success : function(data)
	  {
	  	result(data);
	  },
	});
}
function renameDirectory(directory,name,result)
{
	var datum = {json: {dir:directory,newName:name}};
	$.ajax({
	  url: baseAPIUrl+"/directory.php",
	  type: "PUT",
	  data : datum,
	  success : function(data)
	  {
	  	result(data);
	  },
	});
}
function deleteDirectory(directory,result)
{
	var datum = {json: {dir:directory}};
	$.ajax({
	  url: baseAPIUrl+"/directory.php",
	  type: "DELETE",
	  data : datum,
	  success : function(data)
	  {
	  	result(data);
	  },
	});
}




