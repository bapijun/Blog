<?php
  require_once('connectvars.php');
  //start the session
  session_start();
  //wait for log in
  $user_id = "15";
  $user_name = "bapijun";
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if(!$dbc) {
    die("Can't connect the database;");
  }
  else {


?>

<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>Tiny, opensource, Bootstrap WYSIWYG rich text editor from MindMup</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="opensource rich wysiwyg text editor jquery bootstrap execCommand html5" />
    <meta name="description" content="This tiny jQuery Bootstrap WYSIWYG plugin turns any DIV into a HTML5 rich text editor" />
    <link rel="apple-touch-icon" href="//mindmup.s3.amazonaws.com/lib/img/apple-touch-icon.png" />
    <link rel="shortcut icon" href="http://mindmup.s3.amazonaws.com/lib/img/favicon.ico" >
    <link href="write_blog/external/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
    <link href="css/write_blog.css" rel="stylesheet">
    <script src="js/jquery-1.91-min.js"></script>
		<script src="external/jquery.hotkeys.js"></script>
    <script src="js/bootstrap-2.3.1-min.js"></script>
    <script src="write_blog/external/google-code-prettify/prettify.js"></script>

    <script src="js/bootstrap-wysiwyg.js"></script>
    <script src="js/username.js"></script>
 
  </head>
  <body>
<!-- 登陆栏 -->

<div class="logininf">  
<ul id="loginname"> 
      <li>
        <a href="#"><?php echo $user_name; ?> </a>
        <ul style="display: none;">
          <li><a href="logout.php" >log out</a></li>
        </ul>
      </li>
</ul>
</div>



<div class="container">
  <div class="hero-unit">
  <div class="inputac"> 
  
    <p class="subtitle">
    标题 
    <span style="color: green; margin-left: 24px; display: none;">尊重原创，请保证您的文章为原创作品</span>
    </p>
    
    <div> 
      <select id="article_type">
        <option value="0">请选择</option>
        <option value="1">原创</option>
        <option value="2">转载</option>
        <option value="3">翻译</option>
      </select>
      <input type="texTitle" id="Title" style="width:560px; height:20px;" maxlength="100">
    </div>
  </div>


  <div id="alerts">
    
  </div>
    <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="icon-font"></i><b class="caret"></b></a>
          <ul class="dropdown-menu">
          </ul>
        </div>
      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>
          <ul class="dropdown-menu">
          <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
          <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
          <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
          </ul>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
        <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
        <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>
        <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a>
        <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a>
        <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a>
        <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a>
        <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a>
        <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a>
        <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a>
      </div>
      <div class="btn-group">
      <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>
        <div class="dropdown-menu input-append">
          <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
          <button class="btn" type="button">Add</button>
        </div>
        <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a>

      </div>
      
      <div class="btn-group">
        <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>
        <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a>
        <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a>
      </div>
      <input type="text" data-edit="inserttext" id="voiceBtn" x-webkit-speech="">
    </div>

    <div id="editor">
      Go ahead&hellip;
    </div>
    <div class="inputac">
      <p class="type_sub">个人分类 </p>
      <div class="articleac">
        <input type="text" id="article_type" style="width:560px; height:20px;" maxlength="100">
        （多个分类之间用“,”分隔）
      </div>
    <div id="typed">
      <table id="typet">
<?php
  $query = "SELECT type_name FROM article_type ORDER BY id";
  $data = mysqli_query($dbc, $query);
  $i = 0;
  while($row = mysqli_fetch_array($data))
  {
    if($i%5 == 0) {
      echo "<tr>";
    }
    
    echo "<td>";
    echo "<input id='chk_type_" . $i . "' type='checkbox' >";
    echo "</td> <td>";
    echo " <label for='chk_type_" . $i . "' class='type_lable'>";
    echo $row['type_name'] . "</label> </td>";
    if($i!=1 && ($i+1)%5 == 0) {
      echo "</tr>";
    }
      
    $i++;
  }
   echo "</tr>";
?>
      </table>
      
    </div>

    <div class="subtitle">
      摘要：（默认自动提取您文章的前200字显示在博客首页作为文章摘要，您也可以在这里自行编辑 ）
    </br>
      <textarea id="texsummary" rows="6" style="width:99%;"></textarea>
    </div>
    <div class="btn_table">
      <input id="btnPublish" type="button" class="btn" value="发表文章" title="保存并跳转">
      <input id="btnPublish" type="button" class="btn" value="保存文章" title="保存并留在当前页">
      <input id="btnPublish" type="button" class="btn" value="存入草稿箱" title="保存并跳转">
      <input id="btnPublish" type="button" class="btn" value="舍弃" title="舍弃并跳转">
    </div>
  
  </div>


<script>
  $(function(){
    function initToolbarBootstrapBindings() {
      var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
            'Times New Roman', 'Verdana'],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
      $.each(fonts, function (idx, fontName) {
          fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
      });
      $('a[title]').tooltip({container:'body'});
      $('.dropdown-menu input').click(function() {return false;})
        .change(function () {$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
        .keydown('esc', function () {this.value='';$(this).change();});

      $('[data-role=magic-overlay]').each(function () { 
        var overlay = $(this), target = $(overlay.data('target')); 
        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
      });
      if ("onwebkitspeechchange"  in document.createElement("input")) {
        var editorOffset = $('#editor').offset();
        $('#voiceBtn').css('position','absolute').offset({top: editorOffset.top, left: editorOffset.left+$('#editor').innerWidth()-35});
      } else {
        $('#voiceBtn').hide();
      }
  };
  function showErrorAlert (reason, detail) {
    var msg='';
    if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
    else {
      console.log("error uploading file", reason, detail);
    }
    $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
     '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
  };
    initToolbarBootstrapBindings();  
  $('#editor').wysiwyg({ fileUploadError: showErrorAlert} );
    window.prettyPrint && prettyPrint();
  });
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-37452180-6', 'github.io');
  ga('send', 'pageview');
</script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "http://connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
 </script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="http://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<?php 
  }//end of else of if(!$dbc)
?>
</html>
