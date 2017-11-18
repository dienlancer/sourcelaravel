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
function submitForm(url){
    $('form[name="frm"]').attr('action', url);
    $('form[name="frm"]').submit();
}
$(document).ready(function(){
	$('table.table-recursive > thead > tr > th > input[name="checkall-toggle"]').change(function(){		
		var checkStatus = this.checked;
		$('table.table-recursive').find(':checkbox').each(function(){
			this.checked = checkStatus;
		});
	});
});
