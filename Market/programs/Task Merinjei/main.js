var _window = CreateWindow({
	width:500,
	height:300,
	posx:400,
	posy:300,
	iconUrl:path+"/task.png",
	resizable:true,
	title:"Task Merinjei"});
CreateProcess(_window,"taskManager");

var content = _window.content;

function TrackProcesses()
{
	$(content).html("");
	for(var v in Processes)
	{
		if(v != "nextId" && v!="GenId")
		{
			var process = document.createElement("div");
			var terminateBtn = document.createElement("div");
			$(process).html(v+"|"+Processes[v].name);
			terminateBtn.toKill = v;
			$(process).css("width","95%");
			$(process).css("height","1.25em");
			$(process).css("margin-top","2px");
			$(process).css("margin-left","2px");
			$(process).css("border","black solid 1px");
			$(process).css("background","LightGray");
			$(terminateBtn).css("float","right");
			$(terminateBtn).css("color","red");
			$(terminateBtn).css("margin-right","2px");
			$(terminateBtn).append("X");
			$(terminateBtn).click(function(){
				var id = this.toKill;
				StopProcess(id);
			});
			$(process).append(terminateBtn);
			$(content).append(process);
		}
	}
}
setInterval(TrackProcesses,1000);


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