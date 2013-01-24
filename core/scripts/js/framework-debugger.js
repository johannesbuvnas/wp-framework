if(jQuery)
{
	jQuery(document).ready(function()
	{
		// FIX DEBUGGER
		jQuery(".framework-debugger-console").each(function()
			{
				console.log( "Framework::console: " + jQuery(this).find("p").html() );

				jQuery(this).remove();
			});
	});
}
