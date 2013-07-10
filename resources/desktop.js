
var iconArr;
function LoadSettings()
{
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
function AttachEvents()
{

}