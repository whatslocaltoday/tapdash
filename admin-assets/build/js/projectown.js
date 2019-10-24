function checkvalstatus(userid,statusid)
{

	var r=confirm("Do you want to update this?")
    if (r==true)
		{
			
			$.ajax({
				type: 'post',
				url: '<?=base_url(); ?>admin/Dashboard/update_project_flag',
				data: 'ajuserid='+userid+'&ajdevice='+statusid, // Send dataFields var
					success:function(data) {		
							return true;
						}
				});
		}
			else
			{
				return false;
			}
     
      
}



function generatePassworduser() {
	
	var length = 10;
	
        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
	}
	
	document.getElementById("passwod").value = retVal;
   
}





