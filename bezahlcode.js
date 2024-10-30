// Generiert BezahlCode

 // Eingaben pruefen
 function checkInput(e, validKeys)
 {
 	var validType = true;
 	var inputText = e.value;
 	
 	if(validKeys == "ganzzahl")
 	{       
      	for(var x = 0; x < inputText.length; x++)
      	{
        	if(inputText.charCodeAt(x) <= 47 || inputText.charCodeAt(x) >= 58){
          		validType = false;
        	}
        }
 	}
 	
 	if(validKeys == "dezimalzahl")
 	{       
      	for(var x = 0; x < inputText.length; x++)
      	{
        	if((inputText.charCodeAt(x) <= 47 || inputText.charCodeAt(x) >= 58) && !(inputText.charCodeAt(x) == 44)){
          		validType = false;
        	}
        }
 	}
 	
 	if(validKeys == "dtaus")
 	{       
      	for(var x = 0; x < inputText.length; x++)
      	{
      		var element = inputText.charCodeAt(x);
        	if(!(element > 47 && element < 58) && !(element > 64 && element < 91) && !(element > 96 && element < 123) && !(element > 41 && element < 48) && !(element > 35 && element < 39) && !(element == 196) && !(element == 228) && !(element == 214) && !(element == 246) && !(element == 220) && !(element == 252) && !(element == 223) && !(element == 32)){
          		validType = false;
        	}
        }
 	}
 	
 	if(validKeys == "ibanundbic")
 	{       
      	for(var x = 0; x < inputText.length; x++)
      	{
      		var element = inputText.charCodeAt(x);
        	if(!(element > 47 && element < 58) && !(element > 64 && element < 91) && !(element > 96 && element < 123)){
          		validType = false;
        	}
        }
 	}
 	
 	if(validType == false)
 	{
 		e.className = "error";
 	}
 	else 
 	{
 		e.className = "";
 	}
 }
 
 $(function() {
	var updatetimer = null, updatepending = false;
	var updateBezahlCode = function() {

		if (updatetimer != null) {
			//clearTimeout(updatetimer);
			updatepending = true;
		} else {
			var updatereal = function() {
				try {
					var options = {ecclevel: 'L'};
					var data;
					
					var amountPossible = 1;
					var isIBANundBIC = 0;
					var isKontakt = 0;
					
					if (document.getElementsByName("gen_type")[0].checked)
					{
						data="bank://singlepayment?";
					}
					if (document.getElementsByName("gen_type")[1].checked)
					{
						data="bank://singlepayment?postingkey=69&";
					}
					if (document.getElementsByName("gen_type")[2].checked)
					{
						data="bank://singledirectdebit?";
					}
					if (document.getElementsByName("gen_type")[3].checked)
					{
						data="bank://singlepaymentsepa?";
						isIBANundBIC=1;
					}
					if (document.getElementsByName("gen_type")[4].checked)
					{
						data="bank://contact_v2?";
						amountPossible=0;
						isKontakt=1;
					}
					
					var gen_name = document.getElementById("gen_name").value.toUpperCase();
					var gen_account = document.getElementById("gen_account").value;
					var gen_BNC = document.getElementById("gen_BNC").value;
					var gen_IBAN = document.getElementById("gen_IBAN").value;
					var gen_BIC = document.getElementById("gen_BIC").value;
					var gen_amount = document.getElementById("gen_amount").value;
					var gen_reason = document.getElementById("gen_reason").value;
					
					if(isIBANundBIC==0 && isKontakt==0)
					{
						gen_reason = gen_reason.toUpperCase();
					}
					
					var gen_IBAN = document.getElementById("gen_IBAN").value.toUpperCase();
					var gen_BIC = document.getElementById("gen_BIC").value.toUpperCase();
					
					
					var dataImg=data+"name="+escape(gen_name)+"&reason="+escape(gen_reason);
					var dataURL=data+"name="+gen_name+"&reason="+gen_reason;
					
					if(isKontakt==1)
					{
						dataImg = dataImg+"&iban="+escape(gen_IBAN)+"&bic="+escape(gen_BIC);
						dataURL = dataURL+"&iban="+gen_IBAN+"&bic="+gen_BIC;
						dataImg = dataImg+"&account="+escape(gen_account)+"&bnc="+escape(gen_BNC);
						dataURL = dataURL+"&account="+gen_account+"&bnc="+gen_BNC;
					}
					else
					{
						if(isIBANundBIC==1)
						{
							dataImg = dataImg+"&iban="+escape(gen_IBAN)+"&bic="+escape(gen_BIC);
							dataURL = dataURL+"&iban="+gen_IBAN+"&bic="+gen_BIC;
						}
						else
						{
							dataImg = dataImg+"&account="+escape(gen_account)+"&bnc="+escape(gen_BNC);
							dataURL = dataURL+"&account="+gen_account+"&bnc="+gen_BNC;
						}
					}
					
					if(amountPossible==1)
					{
						dataImg = dataImg+"&amount="+escape(gen_amount);
						dataURL = dataURL+"&amount="+gen_amount;
					}
					
					var url = QRCode.generatePNG(dataImg, options);
					endtime = +new Date();
					$('#bezahlcodeimage').html('<a href="' + dataImg + '"><img src="' + url + '"></a><br /><input id="bezahlCodeURL" type="text" value="' + dataImg + '"/>');
					
	 				document.getElementById("bezahlCodeURL").select();

				} catch (e) {
					$('#bezahlcodeimage').html('Error: ' + e);
				}

				if (updatepending) {
					updatepending = false;
					updatetimer = setTimeout(updatereal, 300);
				} else {
					updatetimer = null;
				}
			};
			updatetimer = setTimeout(updatereal, 300);
		}
	};

	$('#generateButton').click(updateBezahlCode);


	updateBezahlCode();
});
 
