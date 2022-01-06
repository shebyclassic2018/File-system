$ (document).ready (function () {
  getWidthOnWindowResize ();
  setCertificateStatus ();
  copyShortNotes()
  forwardDocument()
  searchFiles();
  
  alertConfirm(".remove-faculty-btn", "This will also delete department and program relates to it");
});
function MOBILE_MEDIA () {
  $ ('.left-menu-m').css ('transform', 'translateX(-100%)');
}
function TABLET_MEDIA () {
  $ ('.left-menu-m').css ('transform', 'translateX(0)');
}
function DESKTOP_MEDIA () {
  $ ('.left-menu-m').css ('transform', 'translateX(0)');
}
function ALL_MEDIA () {}

function alertConfirm(btn, info) {
  $(btn).click(()=>{
    alert("")
  })
}

function setCertificateStatus () {
  $ ('.approve-btn').click (function () {
    var cid = $ (this).val ();
    try {
      $.post (
        'js_pages/set-certificate-status.php',
        {
          cid: cid,
          status: 'Approved',
        },
        info => {
          if (info != 'Process failed') {
              alert(info);
            $ (this).fadeOut (1);
            $ ('.reject-btn').fadeIn (3000);
            location.reload ();
          }
        }
      );
    } catch (err) {
      console.error (err);
    }
  });

  $ ('.reject-btn').click (function () {
    var cid = $ (this).val ();
    try {
      $.post (
        'js_pages/set-certificate-status.php',
        {
          cid: cid,
          status: 'Rejected',
        },
        info => {
          if (info != 'Process failed') {
              alert(info)
            $ (this).fadeOut (1);
            $ ('.approve-btn').fadeIn (3000);
            location.reload ();
          }
        }
      );
    } catch (err) {
      console.error (err);
    }
  });
}


function forwardDocument() {
    $('.forward-form') . on ('submit', (e) => {
        e.preventDefault();
      
            $.ajax({
                url: 'js_pages/forward-document.php',
                type: "POST",
                data: new FormData($('.forward-form')[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: (info) => {
                    alert(info)
                }
            })
        
    })
}


function searchFiles() {
  var content = $("#search-file") . val();
  if (content.length > 0) {
    $(".direct-fetch") . hide();
    $(".searched-content") . fadeIn();
  } else {
    $(".searched-content") . hide();
    $(".direct-fetch") . fadeIn();
  }

  $("#search-file") . keyup(() => {
    content = $("#search-file") . val();
    if (content.length > 0) {
      $(".direct-fetch") . hide();
      $(".searched-content") . fadeIn();
      $(".searched-item") . html("");

      $.post("backend/custodian/search.php", {content : content}, (data) => {
          if (data != "null") {
              var obj = JSON.parse(data);
              $("#regno").val(obj.regno);
              var regno = $("#regno") . val() . split(',');
              
              $("#uid").val(obj.uid);
              var uid = $("#uid") . val() . split(',');

              $("#count").val(obj.count);
              var count = $("#count") . val() . split(',');
              
              for (var i = 0; i < regno.length; i++) {
                var badge = '';
                if (count[i] > 0) {
                  badge = '<div class="badge badge-danger folder-badge">1</div>';
                } 
                $(".searched-item") . append(
                  '<div class="pointer">'
                  + badge
                  + '<a href="open-file.php?uid="><img src="image/folder4.png" alt="" height="128px"></a>'
                  + '<a href="open-file.php?uid='+ uid[i] +'"><div class="flex-center">'+ regno[i] + '</div></a>'
                  + '</div>'
                );
              }
              
            
          } else {
            $(".searched-item") . html("<div class='alert alert-info pad-15 wt-100' >No match found</div>");
          }
      })

    } else {
      $(".searched-content") . hide();
      $(".direct-fetch") . fadeIn();
    }
  })
}

function copyShortNotes() {
  $("#snotes") . keyup (() => {
    var content = $("#snotes") . val();
    $("#snoteshidden") . val(content);
  })
}