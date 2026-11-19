(function(){'use strict';
var type=document.getElementById('gcf-shortcode-type');if(!type)return;
var buttonFields=document.getElementById('gcf-button-fields');
var alertFields=document.getElementById('gcf-alert-fields');
var optionFields=document.getElementById('gcf-option-fields');
var output=document.getElementById('gcf-shortcode-output');
function val(id){var el=document.getElementById(id);return el?el.value:'';}
function update(){
 var code;
 if(type.value==='gcf_button'){
  var url=val('gcf-button-url').replace(/"/g,'&quot;');
  var text=val('gcf-button-text').replace(/\[/g,'(').replace(/\]/g,')');
  code='[gcf_button url="'+url+'" target="'+val('gcf-button-target')+'"]'+text+'[/gcf_button]';
 }else if(type.value==='gcf_alert'){
  var title=val('gcf-alert-title').replace(/"/g,'&quot;');
  var message=val('gcf-alert-text').replace(/\[/g,'(').replace(/\]/g,')');
  code='[gcf_alert type="'+val('gcf-alert-type')+'" title="'+title+'"]'+message+'[/gcf_alert]';
 }else{
  code='[gcf_option field="'+val('gcf-option-field')+'" type="'+val('gcf-option-type')+'"]';
 }
 output.value=code;
 buttonFields.hidden=type.value!=='gcf_button';
 alertFields.hidden=type.value!=='gcf_alert';
 optionFields.hidden=type.value!=='gcf_option';
}
document.querySelectorAll('#gcf-shortcode-type,#gcf-button-fields input,#gcf-button-fields select,#gcf-alert-fields input,#gcf-alert-fields select,#gcf-alert-fields textarea,#gcf-option-fields select').forEach(function(el){el.addEventListener('input',update);el.addEventListener('change',update);});
var copy=document.getElementById('gcf-copy-shortcode');
if(copy){copy.addEventListener('click',function(){output.select();if(navigator.clipboard&&navigator.clipboard.writeText){navigator.clipboard.writeText(output.value);}else{document.execCommand('copy');}var status=document.getElementById('gcf-copy-status');if(status)status.textContent='Shortcode copied.';});}
update();
}());