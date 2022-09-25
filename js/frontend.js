var useSnap = document.getElementsByClassName('section');
if(useSnap.length > 0) {
  new fullpage('#page', {
    //options here
    autoScrolling:true,
    licenseKey: 'gplv3-license',
  });
}

//Make page visible if javascript is enabled
document.getElementById('page').style.display = 'block';

// Visit project button
function visit_project(button) {
    var url = button.getAttribute('project-url');

    window.location.href = url+'?utm_source=jamieblomerus&utm_medium=portfolio';
}

// Collapsible
var coll = document.getElementsByClassName("collapsible");
var i;
for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    }
  });
}

