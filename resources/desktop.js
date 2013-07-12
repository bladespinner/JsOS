var iconArr;
var Processes;
var username;
function ToggleFullScreen()
{
	if($.fullscreen.isFullScreen())
	{
		$.fullscreen.exit();
	}
	else
	{
		$("#desktop").fullscreen();
	}

}
function InitializeClock()
{
	setInterval(function(){
		var d = new Date();
		$("#datetime").text(d.getHours()+":"+d.getMinutes()+":"+d.getSeconds()+" | "+d.getUTCDay()+"."+d.getUTCMonth()+"."+d.getUTCFullYear());
	}
	,1000);
}
function InitializeStartMenu()
{
	$("#startMenu").hide();	
	var offset = $("#startBtn").offset();
	$("#startMenu").css("left",offset.left+$("#startBtn").width()/2);
	$("#startMenu").css("bottom",$(window).height()-offset.top-$("#startBtn").height()/2);
	var hovercount = 0;
	var hovfun = function(){
		hovercount++;
		$("#startMenu").show();
	};
	var nohovfun = function(){
		setTimeout(function()
		{
			hovercount--;
			if(hovercount <= 0)
			{
				hovercount=0;
				$("#startMenu").hide();
			}
		},1000);
	};
	$("#startBtn").mouseenter(hovfun);
	$("#startMenu").mouseenter(hovfun);
	$("#startBtn").mouseout(nohovfun);
	$("#startMenu").mouseout(nohovfun);
	$("#startMenu button").mouseenter(hovfun);

	//Adding logic to elements in it:

	$("#fullscrnBtn").click(ToggleFullScreen);
	$("#marketBtn").click(function(){
		var _window = MarketWindow({
			width:500,
			height:300,
			posx:400,
			posy:300,
			resizable:true
		});

		CreateProcess(_window,"market");
	});
	$("#fileSysBtn").click(function(){
		var _window = DirectoryWindow({
			width:500,
			height:300,
			posx:200,
			posy:200,
			resizable:true,
			title:"File System"},"");
		CreateProcess(_window,"filesys");
	});
}
function InitializeProcessObject()
{
	Processes = new Object();
	Processes.nextId = 10;  //first 10 ids are reserved for system processes
	Processes.GenId = function(_window,icon,name){
		var id = Processes.nextId;
		Processes.nextId++;

		var process = new Object();

		process.id = id;
		process.name = name;
		process.window = _window;
		process.taskbarIcon = icon;

		_window.taskbarIcon = icon;
		_window.processId = id;

		Processes[id] = process;

		$(Processes).trigger("processAdd",id);

		return id;
	};
}
//Prevent context menu from showing
$(document).ready(function(){ 
  document.oncontextmenu = function() {return false;};

});

function LoadSettings()
{
	InitializeClock();
	InitializeStartMenu();
	InitializeProcessObject();

	username = $("#username").val();

	var defaultSettings = new Object();
	defaultSettings.background = "#A7BACC";
	defaultSettings.iconData = new Object();
	defaultSettings.iconData.lastEmpty = {posx:0,posy:0};

	//$('#desktop').css("background-color",defaultSettings.background);
	iconArr.lastEmpty={posx:0,posy:0};
}
function CreateDesktopIcon(posx,posy,effect)
{
	/*TODO
	posx = Math.floor(posx/32);
	posy = Math.floor(posy/32);
	
	
	if(iconArr.lastEmpty === undefined)return undefined;

	var icon = document.createElement("div");

	iconArr[posx][posy] = icon;

	$(icon).addClass("icon");
	$(icon).css("left",lastEmpty.posx*32);
	$(icon).css("top",lastEmpty.posy*32);
	$(icon).dblclick(effect);

	var emptyPos = iconArr.lastEmpty;
	var found = false;

	for(var i=0;i<posx;i++)
	{
		if(found)break;
		for(var j=0;j<posy;j++)
		{
			if(iconArr[i][j] === undefined)
			{
				iconArr.lastEmpty={posx:i,posy:j};
				found = true;
				break;
			}
		}
	}
	if(!found)iconArr.lastEmpty = undefined;

	return icon;*/
}

function StopProcess(id)
{
	$(Processes[id].window).remove();
	$(Processes[id].taskbarIcon).remove();
	delete Processes[id];
}

function CreateProcess(_window,name,background)//background - Possible extention point
{
	var icon = document.createElement("li");
	var iconImg = document.createElement("img");

	$(iconImg).attr("src",_window.icon);
	$(iconImg).addClass("taskBarIcon");
	$(icon).append(iconImg);

	

	var id = Processes.GenId(_window,icon,name);

	$(_window.bar.buttonHolder.closeBtn).click(function(){
		StopProcess(id);
		//delete Processes[id];
		//$(icon).remove();
	});
	var focusWindow = function()
	{
		$(_window).show();
		Focus(_window,"override");
	};
	$(icon).click(focusWindow);
	$(iconImg).click(focusWindow);


	$("#iconHolder").append(icon);
	AddWindow(_window);
}