function enableInputs(){if(jQuery(".submit").is(":visible")){for(var e=document.getElementsByTagName("input"),t=0;t<e.length;t++)e[t].disabled=!0;jQuery(".submit").css("display","none"),jQuery(".passwordinput").css("display","none")}else{for(var e=document.getElementsByTagName("input"),t=0;t<e.length;t++)e[t].disabled=!1;jQuery(".submit").css("display","block"),jQuery(".passwordinput").css("display","block")}}tinymce.init({selector:"#elm1",theme:"modern",plugins:["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","save table contextmenu directionality emoticons template paste textcolor image code"],toolbar:"insertfile undo redo | link image | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",style_formats:[{title:"Bold text",inline:"b"},{title:"Red text",inline:"span",styles:{color:"#ff0000"}},{title:"Red header",block:"h1",styles:{color:"#ff0000"}},{title:"Example 1",inline:"span",classes:"example1"},{title:"Example 2",inline:"span",classes:"example2"},{title:"Table styles"},{title:"Table row 1",selector:"tr",classes:"tablerow1"}],image_title:!0,automatic_uploads:!0,file_picker_types:"image",file_picker_callback:function(e,t,i){var l=document.createElement("input");l.setAttribute("type","file"),l.setAttribute("accept","image/*"),l.onchange=function(){var t=this.files[0],i=new FileReader;i.onload=function(){var l="blobid"+(new Date).getTime(),a=tinymce.activeEditor.editorUpload.blobCache,n=i.result.split(",")[1],s=a.create(l,t,n);a.add(s),e(s.blobUri(),{title:t.name})},i.readAsDataURL(t)},l.click()}}),jQuery(function(){jQuery("#example1").DataTable({paging:!0,lengthChange:!0,searching:!0,ordering:!0,info:!0,autoWidth:!0})});
