function Directory(path)
{
	this.path = path;
	this.GetParrent = function(){
		var pArr = this.path.split("\\").pop();
		pArr.pop();
		return pArr.pop();
	}
	this.GetContents = function(){
		return [new Directory(path+"\\Movies"),new Directory(path+"\\Music"),new Directory(path+"\\Porn"),new File(path+"\\Hello.txt"),new File("Darkness.http")];
	}
}
function File(path)
{
	this.path = path;
	this.GetParrent = function(){
		var pArr = this.path.split("\\").pop();
		pArr.pop();
		return pArr.pop();
	}
	this.GetExtention = function(){
		return this.path.split("\\").pop().split(".").pop();
	}
}
function GetFileSystemDummy()
{
	var C = new Directory("C");
	return C;
}
function GetFileSystem()
{
	GetFileSystemDummy();
}