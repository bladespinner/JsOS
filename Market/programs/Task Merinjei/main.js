var _window = CreateWindow({
	width:500,
	height:300,
	posx:400,
	posy:300,
	iconUrl:path+"/task.png",
	resizable:true,
	title:"Task Merinjei"});
CreateProcess(_window,"asdf");

var content = _window.content;

function TrackProcesses
{
	
}

for(var v in Processes)
{
	if(v != "nextId" && v!="GenId")
	{
		$(content).append(v.name+" ");
	}
}
/*
alert("haha");
$(Processes).on("processAdd",function(e)
{
	$(content).append(Processes[e].name);
});*/





/*
var win = MarketWindow({
	width:500,
	height:300,
	posx:400,
	posy:300,
	resizable:true,
	title:"This is a test window"});
CreateProcess(win,"asdf");

var win1 = DirectoryWindow({
	width:500,
	height:300,
	posx:200,
	posy:200,
	resizable:true,
	title:"File System"},"");
CreateProcess(win1,"omg");*/