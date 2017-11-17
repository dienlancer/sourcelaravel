var timeout;
function checkAllAgent(cid){
	var tbl=$(cid).closest("table");	
	var checkStatus = cid.checked;
	var tbody=$(tbl).find("tbody");
	var tr=(tbody).children("tr");	
	$(tr).find(':checkbox').each(function(){
		checkWithList(this);
	});
}   
function showMsg(ctrlID,msg,type_msg){		
	$('#'+ctrlID).removeClass();	
	$('#'+ctrlID).addClass("alert");			
	$('#'+ctrlID).addClass(type_msg);
	$('#'+ctrlID).find("strong").text(msg);		
	$('#'+ctrlID).fadeIn();		
	if (timeout != null){
        clearTimeout(timeout);
	}
	timeout = setTimeout(hideMsg, 1000,ctrlID);			 
}
function hideMsg(ctrlID) {
	$('#'+ctrlID).fadeOut();
}    
$('input[name="checkall-toggle"]').change(function(){
	var checkStatus = this.checked;
	$('form[name="frm"]').find(':checkbox').each(function(){
		this.checked = checkStatus;
	});
});