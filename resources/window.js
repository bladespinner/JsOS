var focusedWindow = undefined;

function WindowDrag()
{

}
function AddWindow(_window)
{
	$('#desktop').append(_window);
}
function CreateCloseBtn(holder,_window,data)
{
	var closeBtn = document.createElement("img");
	$(closeBtn).attr("src",data.closeBtnUrl);
	$(closeBtn).click(function(){
		$(_window).remove();
	});
	$(holder).append(closeBtn);
	holder.closeBtn = closeBtn;
	return closeBtn;
}
function CreateMinimBtn(holder,_window,data)
{
	var minBtn = document.createElement("img");
	$(minBtn).attr("src",data.minBtnUrl);
	$(holder).append(minBtn);
	holder.minBtn = minBtn;
	return minBtn;
}
function CreateMaximBtn(holder,_window,data)
{
	var maxBtn = document.createElement("img");
	_window.maximized = false;
	_window.unMax = new Object();
	$(maxBtn).attr("src",data.maxBtnUrl);
	$(maxBtn).click(function(){
		if(!_window.maximized)
		{
			
			_window.unMax.width = $(_window).width();
			_window.unMax.height = $(_window).height();
			_window.unMax.left = $(_window).css("left");
			_window.unMax.top = $(_window).css("top");

			$(_window).width($("#desktop").width()-10);
			$(_window).height($("#desktop").height() - $("#toolbar").height() - 20);
			$(_window).css("left",5);
			$(_window).css("top",5);
			_window.maximized = true;
			_window.toggleDrag();
		}
		else
		{
			$(_window).width(_window.unMax.width);
			$(_window).height(_window.unMax.height);
			$(_window).css("left",_window.unMax.left);
			$(_window).css("top",_window.unMax.top);
			_window.maximized = false;
			_window.toggleDrag();
		}
	});
	$(holder).append(maxBtn);
	holder.maxBtn = maxBtn;
	return maxBtn;
}
function CreateBar(_window,data)
{
	var bar = document.createElement("div");
	var title = document.createElement("div");
	var icon = document.createElement("img");
	var btns = document.createElement("div");
	var info = document.createElement("div");

	$(icon).attr("src",data.iconUrl);
	$(title).text(data.title);
	$(title).addClass(data.barTitleClass);

	$(btns).addClass(data.barButtonHolderClass);
	$(info).addClass(data.barInfoHolderClass);
	$(bar).addClass(data.barClass);

	$(bar).append(info);
	$(bar).append(btns);
	$(info).append(title);
	$(info).append(icon);
	info.icon = icon;
	bar.buttonHolder = btns;
	bar.infoHolder = info;
	
	if(data.closable)var closeBtn = CreateCloseBtn(btns,_window,data);
	if(data.minimisable)var minBtn = CreateMinimBtn(btns,_window,data);
	if(data.maximisable)var maxBtn = CreateMaximBtn(btns,_window,data);

	$(_window).append(bar);
	_window.bar = bar;
	return bar;
}
function Focus(target,override)
{
	if(override == "override");
	else target = this;
	if(!focusedWindow)
	{
		$(target.focusTarget).css("z-index","500");
		focusedWindow=target.focusTarget;
	}
	else
	{
		$(focusedWindow).css("z-index","2");
		$(target.focusTarget).css("z-index","500");
		focusedWindow=target.focusTarget;
	}
};

function CreateWindow(dataExt)
{
	var data = {//default data
		width:200,
		height:150,
		posx:5,
		posy:5,
		movable:true,
		resizable:false,
		minWidth:200,
		minHeight:100,
		windowClass:"window",
		barClass:"bar",
		contentClass:"content",
		windowContainer:"window",
		minimisable:"true",
		maximisable:"true",
		closable:"true",
		title:"Window",
		iconUrl:"resources/file.png",
		closeBtnUrl:"resources/close_button.png",
		minBtnUrl:"resources/minimize_button.png",
		maxBtnUrl:"resources/maximize_button.png",
		barTitleClass:"title",
		barButtonHolderClass:"btns",
		barInfoHolderClass:"info"
	};
	$.extend(data,dataExt);

	var _window = document.createElement("div");	
	var content = document.createElement("div");
	
	$(_window).css("position","absolute");
	$(_window).css("width",data.width);
	$(_window).css("height",data.height);
	$(_window).css("left",data.posx);
	$(_window).css("top",data.posy);
	$(_window).addClass(data.windowClass);
	
	var bar = CreateBar(_window,data);

	$(content).addClass(data.contentClass);
	
	if(data.movable)
	{

		$(_window).draggable({
			containment:data.windowContainer,
			handle:bar,
			drag:function()
			{
				Focus(this,"override");
			}
		});

		_window.canDrag = true;

		_window.toggleDrag = function()
		{
			if(_window.canDrag)
			{
				$(_window).draggable("disable");
				$(_window).removeClass("ui-state-disabled");
			}
			else $(_window).draggable("enable");
			_window.canDrag = !_window.canDrag;
		}
	}
	else _window.canDrag = false;


	if(data.resizable)
	{
		if(data.resizable)$(_window).resizable({
			minWidth:data.minWidth,
			minHeight:data.minHeight,
			containment:"parent",
			resize:function(event,ui){
				_window.maximized = false;
				if(!_window.canDrag)
				{
					_window.toggleDrag();
				}
			}
			});
	}
	$(_window).css("z-index","2");
	_window.focusTarget = _window;
	bar.focusTarget = _window;
	content.focusTarget = _window

	$(_window).append(content);

	$(_window).click(Focus);
	$(bar).click(Focus);
	$(content).click(Focus);
	_window.content = content;
	_window.icon = data.iconUrl;
	return _window;
}
function GetExtentionImageUrl(extention)
{
	return "resources/file.png"
}
function GetFileExtention(file)
{

}

function DrawDirectoryInWindow(dirName,path,_window)
{
	var listElement = document.createElement("li");
	var imageUrl = "resources/folder.png";
	var img = document.createElement("img");
	$(img).attr("src",imageUrl);
	$(listElement).append(img);
	var fName = dirName
	listElement.path = path+"\\"+fName;

	//listElement._window = _window;
	$(listElement).click(function()
	{
		getDirectories(this.path,DrawFSResult(_window,this.path,false));
	});
	$(listElement).mousedown(function(e)
	{ 
	    if( e.button == 2 ) 
	    { 
	    	var dirMenu = document.createElement("div");
	    	$(dirMenu).addClass("dirFileMenu");
	    	$(dirMenu).css("top",e.pageY-25);
	    	$(dirMenu).css("left",e.pageX-25);
	    	var deleteBtn = document.createElement("div");
	    	var renameBtn = document.createElement("div");
	    	$(deleteBtn).html("Delete");
	    	$(renameBtn).html("Rename");
	    	$(dirMenu).append(deleteBtn);
	    	$(dirMenu).append(renameBtn);
	    	$("#desktop").append(dirMenu);
	    	dirMenu.hoverCount=1;
	    	var mouseEnterMenuFunct = function(e)
	    	{
	    		dirMenu.hoverCount++;
	    		console.log(dirMenu.hoverCount);
	    	};
	    	var mouseLeaveMenuFunct = function(e)
	    	{
	    		dirMenu.hoverCount--;
	    		console.log(dirMenu.hoverCount);
	    		if(dirMenu.hoverCount <= 0)
	    		{
	    			$(dirMenu).remove();
	    		}
	    	};

	    	$(deleteBtn).click(function()
	    	{
	    		deleteDirectory(listElement.path,function(data)
    			{
    				if(data == 0)
    				{
    					$(listElement).remove();
    					$(dirMenu).remove();
    				}
    			});
	    	});
	    	$(renameBtn).click(function()
	    	{
	    		
	    		//dirToolBar
				var txtArea = document.createElement("input");
				$(txtArea).attr("type","text");
				$(txtArea).addClass("txtArea");
				$(_window.dirToolBar).append(txtArea);
				$(txtArea).focus();
				$(txtArea).focusout(function(){
					$(this).remove();

				});
				$(txtArea).keydown(function(e){
					if(e.keyCode == 13)//enter pressed
					{
						var renameName = $(this).val();
						renameDirectory(listElement.path,path+"\\"+renameName,function(data)
						{
							if(data == 0)
							{
								var img = document.createElement("img");
								$(img).attr("src",imageUrl);
								$(listElement).html("");
								$(listElement).append(img);
								listElement.path = path+"\\"+renameName;
								$(listElement).html($(listElement).html()+renameName);
							}
						});
						$(txtArea).remove();
					}
				});
	    		$(dirMenu).remove();
	    	});
	    	$(deleteBtn).mouseout(mouseLeaveMenuFunct);
	    	$(deleteBtn).mouseenter(mouseEnterMenuFunct);
	    	$(renameBtn).mouseout(mouseLeaveMenuFunct);
	    	$(renameBtn).mouseenter(mouseEnterMenuFunct);
	    	$(dirMenu).mouseenter(mouseEnterMenuFunct);
	    	$(dirMenu).mouseout(mouseLeaveMenuFunct);
			return false;
	    } 
	    return true; 
	}); 
	$(listElement).html($(listElement).html()+fName);
	$(_window.dirList).append(listElement);
}

function DrawFSResult(_window,path,noHistory)
{
	return function(data)
	{
		$(_window.dirList).html("");
		$(_window.pathbar).val(path);

		if(!noHistory)
		{
			//$(_window.pathbar).attr("value",path);
			_window.curPath = path;
			var newPathPath = new Object();
			newPathPath.cur = path;
			newPathPath.last = _window.backBtn.pathPath;
			_window.backBtn.pathPath = newPathPath;
		}
		else
		{
			var a=0;
			a++;
		}

		for(var i=0;i<data["folders"].length;i++)
		{
			DrawDirectoryInWindow(data["folders"][i],path,_window);
		}
		for(var i=0;i<data["files"].length;i++)
		{
			var listElement = document.createElement("li");
			var extention = GetFileExtention(data["files"][i]);
			var imageUrl = GetExtentionImageUrl(extention);
			var img = document.createElement("img");
			$(img).attr("src",imageUrl);
			$(listElement).append(img);
			$(listElement).html($(listElement).html()+data["files"][i]);
			$(_window.dirList).append(listElement);
		}
	};
}
function DirFileMenu(clickData)
{
	var menu = document.createElement("div");
	$(menu).addClass("")
}

function DirectoryWindow(data,path)
{
	data.iconUrl="resources/folder.png";
	data.title = "File System"

	var dirList = document.createElement("ul");
	var pathbar = document.createElement("input");
	var dirToolBar = document.createElement("div");
	var backBtn = document.createElement("img");
	var createDirBtn = document.createElement("img")

	var _window = CreateWindow(data);
	if(!path)path="";
	
	$(dirList).addClass("fileList");
	$(dirToolBar).addClass("dirTool");
	$(backBtn).addClass("dButton");
	$(createDirBtn).addClass("dButton");
	$(pathbar).addClass("curdirBar");

	$(backBtn).attr("src","resources/leftarrow.png");
	$(createDirBtn).attr("src","resources/plus.png");
	backBtn.pathPath=new Object();
	backBtn.pathPath.cur = path;

	_window.backBtn = backBtn;
	$(backBtn).click(function(){
		var tmpPath = this.pathPath.cur;
		this.pathPath=this.pathPath.last;
		if(this.pathPath === undefined)
		{
			this.pathPath = new Object();
			this.pathPath.cur = "";
		}
		getDirectories(tmpPath,DrawFSResult(_window,tmpPath,true));
	});
	$(createDirBtn).click(function(){
		var txtArea = document.createElement("input");
		$(txtArea).attr("type","text");
		$(txtArea).addClass("txtArea");
		$(this).after(txtArea);
		$(txtArea).focus();
		$(txtArea).focusout(function(){
			$(this).remove();
		});
		$(txtArea).keydown(function(e){
			if(e.keyCode == 13)//enter pressed
			{
				var createName = $(this).val();
				var createPath = _window.curPath + "\\" + createName;
				createDirectory(createPath,function(data)
				{
					if(data == 0)
					{

						DrawDirectoryInWindow(createName,_window.curPath,_window);
					}
				});
				$(txtArea).remove();
			}
			
		});
	});
	//.focusout()
	$(dirToolBar).append(backBtn);
	$(dirToolBar).append(createDirBtn);

	$(pathbar).attr("type","text");
	$(pathbar).attr("value",path);
	$(pathbar).keydown(function(e){
		if(e.keyCode == 13)//enter pressed
		{
		    getDirectories($(this).val(),DrawFSResult(_window,$(this).val(),false));
		}
	});

	var content = _window.content;
	_window.curPath = path;
	_window.dirList = dirList;
	_window.pathbar = pathbar;
	_window.dirToolBar = dirToolBar;
	$(content).append(pathbar);
	$(content).append(dirToolBar);
	$(content).append(dirList);
	var drawFunction = DrawFSResult(_window,path);
	getDirectories(path,drawFunction);
	//getDirectories(path,GetDataFillWithContext(_window,dirList,path));
	return _window;
}