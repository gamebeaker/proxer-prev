<script>
function populate(){
  let rownode = document.getElementById("box-table-a").firstChild;
  rownode.firstChild.children[5].outerHTML="<th colspan='2' width='10%'>Bewertungen</th>";
  for (let i = 1; i < rownode.childElementCount; i++) { 
    rownode.children[i].innerHTML += '<td><a data-ajax="true" style="cursor: pointer;" onclick="dynloaddescription(this)">˅</a></td>';
  }
}
function dynloaddescription(obj){
  try {
    document.getElementsByClassName('preview'+obj.parentElement.parentElement.className.replace('entry',''))[0].outerHTML = '';
    obj.innerHTML = "˅";
  } catch{
  obj.innerHTML = '˄';
  let my_array = window.location.href.split("/");
  my_array[my_array.length - 1] = 'phpgetdescription.php?id='+obj.parentElement.parentElement.className.replace('entry','');
  let customurl = '';
  for (let i = 0; i < my_array.length; i++) {
    customurl += my_array[i];
    if (i < my_array.length - 1) {
    customurl += '/';
    }
  }
  console.log(customurl);
  $.get(customurl, function( preview ) {
    document.getElementsByClassName(obj.parentElement.parentElement.className)[0].outerHTML += preview;
    });
  }
}
</script>
<script>
document.addEventListener("DOMContentLoaded", function(event) { 
populate();
});
</script>
<?php include('./phpgetpage.php'); ?>



