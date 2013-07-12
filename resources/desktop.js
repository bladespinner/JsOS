var iconArr;
var Processes;

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
		console.log(hovercount);
		hovercount++;
		$("#startMenu").show();
	};
	var nohovfun = function(){
		console.log(hovercount);
		hovercount--;
		if(hovercount <= 0)
		{
			hovercount=0;
			$("#startMenu").hide();
		}
	};
	$("#startBtn").mouseenter(hovfun);
	$("#startMenu").mouseenter(hovfun);
	$("#startBtn").mouseout(nohovfun);
	$("#startMenu").mouseout(nohovfun);
	$("#startMenu button").mouseenter(hovfun);
	$("#startMenu button").mouseout(nohovfun);

	//Adding logic to elements in it:

	$("#fullscrnBtn").click(ToggleFullScreen);

}
function InitializeProcessObject()
{
	Processes = new Object();
	Processes.nextId = 10;  //first 10 ids are reserved for system processes
	Processes.GenId = function(){
		var result = Processes.nextId;
		Processes.nextId++;
		return result;
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
	var defaultSettings = new Object();
	defaultSettings.background = "#A7BACC"
	defaultSettings.iconData = new Object();
	defaultSettings.iconData.lastEmpty = {posx:0,posy:0};

	$('#desktop').css("background-color","#A7BACC");
	iconArr.lastEmpty={posx:0,posy:0};
}
function CreateDesktopIcon(posx,posy,effect)
{
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

	return icon;
}


function CreateProcess(_window,name,background)//background - Possible extention point
{
	var id = Processes.GenId();
	var icon = document.createElement("li");
	var iconImg = document.createElement("img");

	$(iconImg).attr("src",_window.icon);
	$(iconImg).addClass("taskBarIcon");
	$(icon).append(iconImg);

	var process = new Object();
	process.id = id;
	process.name = name;
	process.window = _window;
	process.taskbarIcon = icon;

	_window.taskbarIcon = icon;

	Processes[id] = process;

	$(_window.bar.buttonHolder.closeBtn).click(function(){
		delete Processes[id];
		$(icon).remove();
	});
	var focusWindow = function()
	{
		Focus(_window,"override");
	};
	$(icon).click(focusWindow);
	$(iconImg).click(focusWindow);


	$("#iconHolder").append(icon);
	AddWindow(_window);
}