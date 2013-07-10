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

			$(_window).width($("#desktop").width());
			$(_window).height($("#desktop").height());
			$(_window).css("left",0);
			$(_window).css("top",0);
			_window.maximized = true;
		}
		else
		{
			$(_window).width(_window.unMax.width);
			$(_window).height(_window.unMax.height);
			$(_window).css("left",_window.unMax.left);
			$(_window).css("top",_window.unMax.top);
			_window.maximized = false;
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
		iconUrl:"file.png",
		closeBtnUrl:"close_button.png",
		minBtnUrl:"minimize_button.png",
		maxBtnUrl:"maximize_button.png",
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
	
	$(_window).draggable({
		containment:data.windowContainer,
		handle:bar
		});
	if(data.resizable)$(_window).resizable({
		minWidth:data.minWidth,
		minHeight:data.minHeight,
		containment:"parent",
		resize:function(event,ui){
			_window.maximized = false;
		}
		});
	_window.content = content;
	return _window;
}

/*
function DirectoryWindow(width , height , posx , posy ,movable, resizable)
{
	var window = Window(width, height , posx, posy , movable , resizable);
	var leftArrow = document.createElement("div");
	var rightArrow = document.createElement("div");
	
	$(leftArrow)addClass("arrowLeft");
	$(rightArrow)addClass("arrowRight");
}*/