function showLstInvoiceDetail(lnk_image,value,quantity,total_price){
		var id = value;						
		var dataObj = {
					"action"	: "show_lst_invoice_detail",
					"id"		: id,					
					"security"  : security_code
				};		
		jQuery.ajax({
			url			: ajaxurl,
			type		: "POST",
			data		: dataObj,
			dataType	: "json",
			success		: function(data, status, jsXHR){
							var thead='<thead><tr><th colspan="2">PRODUCT</th><th>PRICE</th><th>QTY</th><th>SUBTOTAL</th></tr></thead>';
							var tbody="<tbody>";		
							var tr="";	
							for(var i=0;i<data.length;i++){
								var product_image=lnk_image + data[i]["product_image"];
								var tdImage='<td align="center" class="com_product17"><img src='+product_image+' width="42" height="56" /></td>';
								var tdName='<td class="com_product20">'+data[i]["product_name"]+'</td>';
								var tdPrice='<td class="com_product21" align="right">'+accounting.formatMoney(data[i]["product_price"], "", 0, ".",",")+'</td>';
								var tdQty='<td align="center" class="com_product22" align="center">'+data[i]["product_quantity"]+'</td>';
								var tdTotalPrice='<td class="com_product23" align="right">'+accounting.formatMoney(data[i]["product_total_price"], "", 0, ".",",")+'</td>';	
								tr+='<tr>'+tdImage+tdName+tdPrice+tdQty+tdTotalPrice+'</tr>';							
							}
							tbody=tbody+tr+'</tbody>';
							var tfoot='<tfoot><tr><td colspan="3" align="center"><b>TOTAL</b></td><td align="center">'+quantity+'</td><td align="right">'+accounting.formatMoney(total_price, "", 0, ".",",")+'</td></tr></tfoot>';
							var str='<table border="0" class="com_product16" cellspacing="0" cellpadding="0" width="100%">'+thead+tbody+tfoot+'</table>';							
							jQuery(".modal-body").empty();
							jQuery(".modal-body").append(str);
						}
		});

	}
function changePaymentMethod(payment_method_id)	{
	var dataObj = {
					"action"	: "load_payment_method_info",
					"payment_method_id"		: payment_method_id,					
					"security"  : security_code
				};
	jQuery.ajax({
			url			: ajaxurl,
			type		: "POST",
			data		: dataObj,
			dataType	: "json",
			success		: function(data, status, jsXHR){
							jQuery("#payment_method_content").empty();
							jQuery("#payment_method_content").append(data.content);
						}
		});
}
function xacnhanxoa(msg){if(window.confirm(msg)){return true;}return false;}
function changePage(page){
	$sjc('input[name=filter_page]').val(page);$sjc('.frm')[0].submit();}
function move(source,destination){
	var groupSource=$sjc("."+source)[0];
	var groupDestination=$sjc("."+destination)[0];
	var selected=$sjc(groupSource).children("option:selected");$sjc(groupDestination).append(selected);
}
function isNumberKey(evt){var hopLe=true;var charCode=(evt.which)?evt.which:event.keyCode;if(charCode>31&&(charCode<48||charCode>57))hopLe=false;return hopLe;}
function checkRegister() {
    var hopLe=true;
    var strMsg="";
    var fullname=document.getElementById("txtFullName").value;
    var phone=document.getElementById("txtPhone").value;
    if(fullname=="") {
        hopLe=false;
        strMsg="Vui lòng điền tên";
    }
    if(phone=="") {
        hopLe=false;
        strMsg="Vui lòng điền điện thoại";
    }
    if(!hopLe)alert(strMsg);
    return hopLe;
}
function addToCart(product_id){
	var id = product_id;						
	var dataObj = {
		"action"	: "add_to_cart",
		"id"		: id,					
		"security"  : security_code
	};		
	jQuery.ajax({
		url			: ajaxurl,
		type		: "POST",
		data		: dataObj,
		dataType	: "json",
		success		: function(data, status, jsXHR){
			var thong_bao='Sản phẩm đã được thêm vào trong <a href="'+data.permalink+'" class="comproduct49" >giỏ hàng</a> ';				
			jQuery("#cart-total").empty();			
			jQuery(".modal-body").empty();		
			jQuery("#cart-total").text(data.quantity);			
			jQuery(".modal-body").append(thong_bao);			
		}
	});
}