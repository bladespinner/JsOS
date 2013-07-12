var baseAPIUrl = "http://localhost:8088/JsOS/restAPI/"

//DIRECTORY

function getRoot()
{
	return "Disk";
}

function getDirectories(directory,result)
{
	if(directory == "")
	{
		var res=new Object();
		res["folders"]=new Array();
		res["folders"][0] = getRoot();
		res["files"]=new Array();
		result(res);
		return;
	}
	var datum = {json: {dir:directory}};
	$.ajax({
	  url: baseAPIUrl+"/directory.php",
	  type: "GET",
	  data : datum,
	  success : function(data)
	  {
	  	result(JSON.parse(data));
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
	  	result(JSON.parse(data));
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
	  	result(JSON.parse(data));
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
	  	result(JSON.parse(data));
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
	  	result(JSON.parse(data));
	  },
	});
}

//MARKET

function getMarketItem(id,result)
{
	if(!id)id = "";
	var datum = {json: {item:id}};
	$.ajax({
	  url: baseAPIUrl+"/market.php",
	  type: "GET",
	  data : datum,
	  success : function(data)
	  {
	  	result(JSON.parse(data));
	  },
	});
}

//FILE

function uploadFile(filename,data,result,copyFrom)
{
	if(!copyFrom)copyFrom="";
	var datum = {json: {path:filename,data:data,format:"",copyPath:copyFrom}};
	$.ajax({
	  url: baseAPIUrl+"/file.php",
	  type: "POST",
	  data : datum,
	  success : function(data)
	  {
	  	result(JSON.parse(data));
	  }
	});
	
}
function uploadBase64File(filename,data,result,copyFrom)
{
	if(!copyFrom)copyFrom="";
	var datum = {json: {path:filename,data:data,format:"base64",copyPath:copyFrom}};
	$.ajax({
	  url: baseAPIUrl+"/file.php",
	  type: "POST",
	  data : datum,
	  success : function(data)
	  {
	  	result(JSON.parse(data));
	  }
	});
}
function deleteFile(path,result)
{
	var datum = {json: {path:path}};
	$.ajax({
	  url: baseAPIUrl+"/file.php",
	  type: "DELETE",
	  data : datum,
	  success : function(data)
	  {
	  	result(JSON.parse(data));
	  },
	});
}
function getFileBase64(path,result)
{
	var datum = {json: {path:path,format:"base64"}};
	$.ajax({
	  url: baseAPIUrl+"/file.php",
	  type: "GET",
	  data : datum,
	  success : function(data)
	  {
	  	result(JSON.parse(data));
	  },
	});
}

//btoa() and atob()